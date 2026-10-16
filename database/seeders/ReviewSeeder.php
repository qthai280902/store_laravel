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
        // 1. Create a diverse pool of 15 verified Vietnamese customer accounts
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
            [
                'name' => 'Nguyễn Văn Bình',
                'email' => 'binhnv@example.com',
                'password' => Hash::make('password'),
                'role' => 'user',
                'avatar' => 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=150&h=150&fit=crop',
            ],
            [
                'name' => 'Bùi Thị Ngọc Mai',
                'email' => 'maibtn@example.com',
                'password' => Hash::make('password'),
                'role' => 'user',
                'avatar' => 'https://images.unsplash.com/photo-1517841905240-472988babdf9?w=150&h=150&fit=crop',
            ],
            [
                'name' => 'Hoàng Trọng Dũng',
                'email' => 'dunght@example.com',
                'password' => Hash::make('password'),
                'role' => 'user',
                'avatar' => 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=150&h=150&fit=crop',
            ],
            [
                'name' => 'Trịnh Kim Chi',
                'email' => 'chitk@example.com',
                'password' => Hash::make('password'),
                'role' => 'user',
                'avatar' => 'https://images.unsplash.com/photo-1524504388940-b1c1722653e1?w=150&h=150&fit=crop',
            ],
            [
                'name' => 'Đỗ Quốc Huy',
                'email' => 'huydq@example.com',
                'password' => Hash::make('password'),
                'role' => 'user',
                'avatar' => 'https://images.unsplash.com/photo-1519085360753-af0119f7cbe7?w=150&h=150&fit=crop',
            ],
            [
                'name' => 'Phan Thanh Thảo',
                'email' => 'thaopt@example.com',
                'password' => Hash::make('password'),
                'role' => 'user',
                'avatar' => 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=150&h=150&fit=crop',
            ],
            [
                'name' => 'Ngô Hải Đăng',
                'email' => 'dangnh@example.com',
                'password' => Hash::make('password'),
                'role' => 'user',
                'avatar' => 'https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?w=150&h=150&fit=crop',
            ],
            [
                'name' => 'Lâm Mỹ Linh',
                'email' => 'linhlm@example.com',
                'password' => Hash::make('password'),
                'role' => 'user',
                'avatar' => 'https://images.unsplash.com/photo-1517841905240-472988babdf9?w=150&h=150&fit=crop',
            ],
            [
                'name' => 'Đào Xuân Bách',
                'email' => 'bachdx@example.com',
                'password' => Hash::make('password'),
                'role' => 'user',
                'avatar' => 'https://images.unsplash.com/photo-1522075469751-3a6694fb2f61?w=150&h=150&fit=crop',
            ],
            [
                'name' => 'Võ Hồng Hạnh',
                'email' => 'hanhvh@example.com',
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

        $allReviewUsers = collect($users);

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
            ['rating' => 5, 'comment' => 'Nguyên liệu tươi sạch, bảo quản nhiệt độ tốt nên nhận về nấu ăn rất thơm ngon, chuẩn vị tươi mới.'],
            ['rating' => 5, 'comment' => 'Có tem QR quét xuất xứ rõ ràng từ nông trại. Rất an tâm khi mua thực phẩm cho cả nhà.'],
        ];

        // 3. Attach 3 to 6 reviews to each product, ensuring 100% unique reviewers per product
        $products = Product::all();
        foreach ($products as $product) {
            // Avoid duplicate seeding if reviews already exist
            if ($product->reviews()->count() > 0) {
                continue;
            }

            $numReviews = rand(3, 6);
            $selectedUsers = $allReviewUsers->shuffle()->take($numReviews)->values();
            $shuffledComments = $commentsPool;
            shuffle($shuffledComments);

            for ($i = 0; $i < $numReviews; $i++) {
                $commentData = $shuffledComments[$i % count($shuffledComments)];
                $reviewer = $selectedUsers[$i];

                Review::create([
                    'product_id' => $product->id,
                    'user_id' => $reviewer->id,
                    'rating' => $commentData['rating'],
                    'comment' => $commentData['comment'],
                    'created_at' => now()->subDays(rand(1, 30))->subHours(rand(1, 23)),
                ]);
            }
        }
    }
}
