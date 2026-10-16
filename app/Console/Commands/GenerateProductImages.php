<?php

namespace App\Console\Commands;

use App\Models\Product;
use Database\Seeders\ProductSeeder;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;

class GenerateProductImages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'products:generate-images 
                            {--sku= : Sinh hoặc đồng bộ ảnh cho một mã SKU cụ thể}
                            {--limit= : Giới hạn số lượng sản phẩm xử lý}
                            {--force : Ghi đè lại các file ảnh đã tồn tại}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Tự động hóa chuẩn hóa bộ ảnh thương mại 5 góc chụp chân thực vào storage cục bộ và đồng bộ database';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $this->info('🚀 Bắt đầu tiến trình chuẩn hóa bộ ảnh thương mại sản phẩm MiniMart...');

        $query = Product::with('category');
        if ($sku = $this->option('sku')) {
            $query->where('sku', $sku);
        }

        if ($limit = $this->option('limit')) {
            $query->limit((int) $limit);
        }

        $products = $query->get();
        if ($products->isEmpty()) {
            $this->warn('Không tìm thấy sản phẩm nào phù hợp.');

            return self::FAILURE;
        }

        $force = (bool) $this->option('force');
        $progressBar = $this->output->createProgressBar($products->count());
        $progressBar->start();

        $storageBasePath = storage_path('app/public/products');
        File::ensureDirectoryExists($storageBasePath);

        $totalImagesSynced = 0;

        foreach ($products as $product) {
            $productSku = $product->sku ?: 'MM-PRD-'.str_pad($product->id, 4, '0', STR_PAD_LEFT);
            $productDir = $storageBasePath.DIRECTORY_SEPARATOR.$productSku;
            File::ensureDirectoryExists($productDir);

            // Xây dựng 5 Prompt AI Commercial Studio Photography theo tiêu chuẩn
            $prompts = $this->buildCommercialPrompts($product);

            // Sử dụng bộ URL ảnh studio độ phân giải cao khớp theo ngữ nghĩa
            $sourceImages = ProductSeeder::resolveImagesForProduct(
                $product->name,
                $product->category?->name ?? ''
            );

            $localRelativePaths = [];

            for ($angle = 1; $angle <= 5; $angle++) {
                $fileName = "{$angle}.jpg";
                $filePath = $productDir.DIRECTORY_SEPARATOR.$fileName;
                $relativePath = "storage/products/{$productSku}/{$fileName}";
                $localRelativePaths[] = $relativePath;

                // Nếu là file ảnh thực sự (dung lượng > 5KB) và không có --force thì giữ nguyên (giữ ảnh AI Nano Banana)
                $isRealImage = File::exists($filePath) && File::size($filePath) > 5000;
                if ($isRealImage && ! $force) {
                    continue;
                }

                $sourceUrl = $sourceImages[$angle - 1] ?? null;

                // Tải ảnh studio thương mại chất lượng cao
                $saved = false;
                if ($sourceUrl && (str_starts_with($sourceUrl, 'http://') || str_starts_with($sourceUrl, 'https://'))) {
                    try {
                        $response = Http::withoutVerifying()->timeout(15)->get($sourceUrl);
                        if ($response->successful() && strlen($response->body()) > 5000) {
                            File::put($filePath, $response->body());
                            $saved = true;
                            $totalImagesSynced++;
                        }
                    } catch (\Throwable $e) {
                        // Bỏ qua lỗi kết nối
                    }
                }

                if (! $saved && (! File::exists($filePath) || File::size($filePath) === 0)) {
                    // Tạo ảnh canvas/placeholder chất lượng cao để đảm bảo luôn có ảnh cục bộ
                    $this->createFallbackImage($filePath, $product->name, $angle);
                    $totalImagesSynced++;
                }
            }

            // Đồng bộ lại database trỏ trực tiếp về storage cục bộ
            $product->update([
                'sku' => $productSku,
                'image_url' => $localRelativePaths[0],
                'images' => $localRelativePaths,
            ]);

            $progressBar->advance();
        }

        $progressBar->finish();
        $this->newLine(2);

        $this->info("✅ Đã hoàn tất đồng bộ {$products->count()} sản phẩm!");
        $this->info('📁 Thư mục lưu trữ: storage/app/public/products/{sku}/');
        $this->info("🖼️ Tổng số ảnh mới được đồng bộ/ghi vào đĩa: {$totalImagesSynced}");

        return self::SUCCESS;
    }

    /**
     * Xây dựng 5 Prompts chuẩn AI Commercial Studio Photography.
     */
    protected function buildCommercialPrompts(Product $product): array
    {
        $catName = $product->category?->name ?? 'Fresh Groceries';
        $brand = $product->brand ?: 'MiniMart Organic';
        $baseStyle = 'Hyper-realistic commercial studio photography, professional softbox studio lighting, 8k resolution, crisp clean focus, shallow depth of field, minimalist neutral background, photorealistic texture';

        return [
            1 => "{$baseStyle}, angle_1 front shot 90-degree direct perspective of {$product->name} ({$brand}), authentic packaging and fresh product presentation, centered composition",
            2 => "{$baseStyle}, angle_2 back specs view of {$product->name}, crisp clear nutrition facts label, expiration date, barcode, organic certification seals",
            3 => "{$baseStyle}, angle_3 dynamic isometric 45-degree angle of {$product->name} resting on a premium clean marble studio podium with soft reflective surface",
            4 => "{$baseStyle}, angle_4 macro close-up of {$product->name}, extreme focus on fresh texture, organic condensation water droplets, natural vibrant color fidelity",
            5 => "{$baseStyle}, angle_5 lifestyle context of {$product->name} placed in a contemporary warm kitchen, on a rustic cutting board or clean countertop with fresh culinary garnish",
        ];
    }

    /**
     * Cung cấp URL ảnh chất lượng cao phân chia theo 5 góc chụp nếu sản phẩm thiếu ảnh.
     */
    protected function fallbackImageUrlsForCategory(Product $product): array
    {
        $name = mb_strtolower($product->name, 'UTF-8');

        if (str_contains($name, 'tôm') || str_contains($name, 'hải sản') || str_contains($name, 'cá')) {
            return [
                'https://images.unsplash.com/photo-1565680018434-b513d5e5fd47?w=800&h=800&fit=crop',
                'https://images.unsplash.com/photo-1544551763-46a013bb70d5?w=800&h=800&fit=crop',
                'https://images.unsplash.com/photo-1519708227418-c8fd9a32b7a2?w=800&h=800&fit=crop',
                'https://images.unsplash.com/photo-1534422298391-e4f8c172dddb?w=800&h=800&fit=crop',
                'https://images.unsplash.com/photo-1532550907401-a500c9a57435?w=800&h=800&fit=crop',
            ];
        }

        if (str_contains($name, 'gạo') || str_contains($name, 'yến mạch') || str_contains($name, 'đậu')) {
            return [
                'https://images.unsplash.com/photo-1586201375761-83865001e31c?w=800&h=800&fit=crop',
                'https://images.unsplash.com/photo-1509358271058-acd22cc93898?w=800&h=800&fit=crop',
                'https://images.unsplash.com/photo-1536304993881-ff6e9eefa2a6?w=800&h=800&fit=crop',
                'https://images.unsplash.com/photo-1599940824399-b87987ceb72a?w=800&h=800&fit=crop',
                'https://images.unsplash.com/photo-1512621776951-a57141f2eefd?w=800&h=800&fit=crop',
            ];
        }

        return [
            'https://images.unsplash.com/photo-1540420773420-3366772f4999?w=800&h=800&fit=crop',
            'https://images.unsplash.com/photo-1610832958506-aa56368176cf?w=800&h=800&fit=crop',
            'https://images.unsplash.com/photo-1597362925123-77861d3fbac7?w=800&h=800&fit=crop',
            'https://images.unsplash.com/photo-1587049352846-4a222e784d38?w=800&h=800&fit=crop',
            'https://images.unsplash.com/photo-1518843875459-f738682238a6?w=800&h=800&fit=crop',
        ];
    }

    /**
     * Tạo ảnh fallback chất lượng cao nếu không có kết nối internet hoặc ảnh lỗi.
     */
    protected function createFallbackImage(string $path, string $name, int $angle): void
    {
        $angleNames = [
            1 => 'Chinh dien',
            2 => 'Thong so & Nguon goc',
            3 => 'Goc nghieng 45 do',
            4 => 'Can canh do tuoi',
            5 => 'Mon ngon thuong thuc',
        ];
        $angleName = $angleNames[$angle] ?? "Goc {$angle}";

        if (extension_loaded('gd')) {
            $img = imagecreatetruecolor(800, 800);
            $bg = imagecolorallocate($img, 240, 253, 244); // #f0fdf4
            imagefill($img, 0, 0, $bg);

            $border = imagecolorallocate($img, 134, 239, 172); // #86efac
            imagerectangle($img, 30, 30, 769, 769, $border);
            imagerectangle($img, 32, 32, 767, 767, $border);

            $whiteCard = imagecolorallocate($img, 255, 255, 255);
            imagefilledrectangle($img, 100, 250, 700, 550, $whiteCard);
            imagerectangle($img, 100, 250, 700, 550, $border);

            $darkGreen = imagecolorallocate($img, 20, 83, 45); // #14532d
            $emerald = imagecolorallocate($img, 5, 150, 105); // #059669

            $asciiName = preg_replace('/[^\x20-\x7E]/', '', iconv('UTF-8', 'ASCII//TRANSLIT', $name));

            imagestring($img, 5, 280, 310, 'MiniMart Fresh Studio', $darkGreen);
            imagestring($img, 5, 240, 370, substr($asciiName, 0, 40), $emerald);
            imagestring($img, 4, 300, 430, "Angle {$angle}: {$angleName}", $darkGreen);

            imagejpeg($img, $path, 90);
            imagedestroy($img);

            return;
        }

        $svg = <<<SVG
<svg xmlns="http://www.w3.org/2000/svg" width="800" height="800" viewBox="0 0 800 800">
    <defs>
        <linearGradient id="bg" x1="0%" y1="0%" x2="100%" y2="100%">
            <stop offset="0%" stop-color="#f0fdf4"/>
            <stop offset="50%" stop-color="#ffffff"/>
            <stop offset="100%" stop-color="#ecfdf5"/>
        </linearGradient>
    </defs>
    <rect width="800" height="800" fill="url(#bg)"/>
    <circle cx="400" cy="400" r="260" fill="#166534" opacity="0.06"/>
    <rect x="150" y="250" width="500" height="300" rx="40" fill="#ffffff" stroke="#86efac" stroke-width="4" opacity="0.9"/>
    <text x="400" y="370" font-family="sans-serif" font-size="28" font-weight="bold" fill="#14532d" text-anchor="middle">MiniMart Fresh Studio</text>
    <text x="400" y="420" font-family="sans-serif" font-size="20" fill="#15803d" text-anchor="middle">{$name}</text>
    <text x="400" y="470" font-family="sans-serif" font-size="16" font-weight="bold" fill="#047857" text-anchor="middle">Góc {$angle}: {$angleName}</text>
</svg>
SVG;

        File::put($path, $svg);
    }
}
