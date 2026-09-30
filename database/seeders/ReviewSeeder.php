<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Review;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Create a pool of verified customer accounts
        $sampleUsers = [
            [
                'name' => 'Trần Minh Quang',
                'email' => 'quangtm@example.com',
                'password' => Hash::make('password'),
                'role' => 'user',
                'avatar' => 'https://images.unsplash.com/photo-1535713875002-d1d0cf377fde?w=150&h=150&fit=crop',
            ],
            [
                'name' => 'Lê Hoàng Yến',
                'email' => 'yenlh@example.com',
                'password' => Hash::make('password'),
                'role' => 'user',
                'avatar' => 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=150&h=150&fit=crop',
            ],
            [
                'name' => 'Phạm Thu Hương',
                'email' => 'huongpt@example.com',
                'password' => Hash::make('password'),
                'role' => 'user',
                'avatar' => 'https://images.unsplash.com/photo-1438761681033-6461ffad8d80?w=150&h=150&fit=crop',
            ],
            [
                'name' => 'Đặng Anh Tuấn',
                'email' => 'tuanda@example.com',
                'password' => Hash::make('password'),
                'role' => 'user',
                'avatar' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=150&h=150&fit=crop',
            ],
            [
                'name' => 'Vũ Mai Phương',
                'email' => 'phuongvm@example.com',
                'password' => Hash::make('password'),
                'role' => 'user',
                'avatar' => 'https://images.unsplash.com/photo-1544005313-94ddf0286df2?w=150&h=150&fit=crop',
            ],
        ];

        $users = [];
        foreach ($sampleUsers as $userData) {
            $users[] = User::firstOrCreate(
                ['email' => $userData['email']],
                $userData
            );
        }

        // Include admin/existing users if present
        $existingUsers = User::all();

        // 2. Realistic review comments pool
        $commentsPool = [
            ['rating' => 5, 'comment' => 'Sản phẩm rất tươi ngon, đóng gói cẩn thận có túi giữ nhiệt chuyên dụng. Giao hàng hỏa tốc chỉ trong 2 tiếng, shipper nhiệt tình!'],
            ['rating' => 5, 'comment' => 'Chất lượng đúng như cam kết, date sản xuất mới tinh. Nấu ăn gia đình ai cũng khen ngon và thanh mát.'],
            ['rating' => 5, 'comment' => 'Hàng organic chuẩn sạch, bao bì đóng gói hút chân không chuyên nghiệp. Cực kỳ an tâm khi dùng cho các bé nhỏ.'],
            ['rating' => 4, 'comment' => 'Sản phẩm tốt, giá cả hợp lý khi săn được mã giảm giá. Lần sau sẽ tiếp tục ủng hộ siêu thị!'],
            ['rating' => 5, 'comment' => 'Hương vị tự nhiên, giữ được độ tươi ngon mọng nước. Tem nhãn truy xuất nguồn gốc rõ ràng, minh bạch.'],
            ['rating' => 5, 'comment' => 'Trái cây/thực phẩm tươi rói, không bị cấn hay dập nát hạt nào. Trải nghiệm mua sắm online tại MiniMart quá tiện lợi.'],
            ['rating' => 4, 'comment' => 'Chất lượng đồng đều, giao đúng hẹn. Khối lượng đóng gói chuẩn xác, có cân lại không bị hao hụt.'],
            ['rating' => 5, 'comment' => 'Đã mua ở đây nhiều lần và chưa lần nào thất vọng. Vote 5 sao cho chất lượng dịch vụ của MiniMart!'],
            ['rating' => 4, 'comment' => 'Hàng tươi ngon, chất lượng ổn định. Hy vọng cửa hàng thường xuyên có thêm nhiều deal giảm giá hời.'],
        ];

        // 3. Attach 3 to 7 reviews to each product
        $products = Product::all();
        foreach ($products as $product) {
            // Avoid duplicate seeding if reviews already exist
            if ($product->reviews()->count() > 0) {
                continue;
            }

            $numReviews = rand(3, 7);
            $shuffledComments = $commentsPool;
            shuffle($shuffledComments);

            for ($i = 0; $i < $numReviews; $i++) {
                $commentData = $shuffledComments[$i % count($shuffledComments)];
                $randomUser = $existingUsers->random();

                Review::create([
                    'product_id' => $product->id,
                    'user_id' => $randomUser->id,
                    'rating' => $commentData['rating'],
                    'comment' => $commentData['comment'],
                    'created_at' => now()->subDays(rand(1, 45))->subHours(rand(1, 23)),
                ]);
            }
        }
    }
}
