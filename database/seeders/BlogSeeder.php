<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BlogSeeder extends Seeder
{
    public function run(): void
    {
        $posts = [
            [
                'title' => 'Cách bảo quản Cải bó xôi Đà Lạt tươi lâu trong 5 ngày',
                'category' => 'Mẹo vặt',
                'image' => 'https://picsum.photos/seed/blog-spinach/800/500',
                'content' => '<p>Cải bó xôi (spinach) là loại rau giàu sắt và vitamin K nhưng rất nhanh héo. Dưới đây là cách giữ rau tươi xanh trong suốt 5 ngày:</p><h3>Bước 1: Không rửa trước khi cất</h3><p>Nhiều người có thói quen rửa rau ngay khi mua về — đây là sai lầm lớn nhất. Nước còn đọng trên lá sẽ khiến rau bị nhớt và hỏng nhanh hơn.</p><h3>Bước 2: Bọc giấy ăn</h3><p>Dùng 2-3 tờ giấy ăn (paper towel) bọc quanh bó rau. Giấy sẽ hút ẩm dư thừa và giữ độ ẩm vừa đủ cho lá.</p><h3>Bước 3: Cho vào túi zip</h3><p>Cho bó rau đã bọc giấy vào túi zip, <strong>ép bớt không khí ra</strong> rồi đóng kín. Bảo quản ở ngăn mát tủ lạnh nhiệt độ 1-4°C.</p><p>Áp dụng đúng 3 bước trên, cải bó xôi của bạn sẽ giữ được độ tươi giòn tới 5 ngày mà không bị vàng úa.</p>',
            ],
            [
                'title' => 'Top 5 trái cây nhập khẩu giàu vitamin C nhất cho mùa hè',
                'category' => 'Sản phẩm sức khỏe',
                'image' => 'https://picsum.photos/seed/blog-fruits/800/500',
                'content' => '<p>Mùa hè nóng bức là lúc cơ thể cần bổ sung vitamin C nhiều nhất để tăng sức đề kháng. Dưới đây là 5 loại trái cây nhập khẩu giàu vitamin C hàng đầu:</p><ol><li><strong>Kiwi vàng New Zealand:</strong> Chứa 161mg vitamin C / 100g — gấp đôi cam! Vị ngọt dịu, thịt vàng mềm mịn.</li><li><strong>Cherry đỏ Mỹ:</strong> Ngoài vitamin C, cherry còn giàu anthocyanin giúp chống viêm và giảm đau khớp hiệu quả.</li><li><strong>Nho mẫu đơn Hàn Quốc:</strong> Giàu resveratrol — chất chống oxy hóa mạnh mẽ tốt cho tim mạch.</li><li><strong>Táo Fuji Nhật Bản:</strong> Rất tốt cho hệ tiêu hóa nhờ lượng chất xơ pectin dồi dào.</li><li><strong>Cam vàng Navel Úc:</strong> Cung cấp 100% nhu cầu vitamin C mỗi ngày chỉ với 1 quả.</li></ol><p>Hãy bổ sung ít nhất 2 loại trái cây trên vào thực đơn hàng ngày để bảo vệ sức khỏe cả gia đình!</p>',
            ],
            [
                'title' => 'Phân biệt Nho mẫu đơn thật và giả trên thị trường',
                'category' => 'Mẹo vặt',
                'image' => 'https://picsum.photos/seed/blog-grapes/800/500',
                'content' => '<p>Nho mẫu đơn (Shine Muscat) có giá trị cao nên thường bị làm giả trên thị trường. Hãy chú ý các dấu hiệu sau để không bị lừa:</p><h3>1. Về mùi vị</h3><p>Nho mẫu đơn chuẩn Hàn/Nhật có <strong>hương thơm mùi sữa đặc trưng</strong>, vị ngọt thanh không gắt. Nho giả thường ngọt lờ nhạt, không có mùi đặc biệt.</p><h3>2. Về hình dáng</h3><p>Quả nho chuẩn có kích thước to đều nhau (đường kính 3-4cm), <strong>da mỏng và hoàn toàn không có hạt</strong>.</p><h3>3. Về màu sắc</h3><p>Nho thật có màu xanh ngọc trong suốt. Cuống nho phải còn rất xanh và tươi — nếu cuống đã nâu khô thì nho đã để quá lâu hoặc không đúng giống.</p><h3>4. Về giá</h3><p>Giá nho mẫu đơn chính hãng thường từ 700.000đ - 1.200.000đ/kg. Nếu bạn thấy giá dưới 400.000đ, hãy cảnh giác — rất có thể đó là nho Trung Quốc trộn giống.</p>',
            ],
            [
                'title' => 'Lợi ích bất ngờ của Cà chua cherry đối với làn da',
                'category' => 'Sản phẩm sức khỏe',
                'image' => 'https://picsum.photos/seed/blog-tomato/800/500',
                'content' => '<p>Cà chua cherry (cà chua bi) tuy nhỏ nhưng chứa hàm lượng <strong>lycopene</strong> cực kỳ cao — một chất chống oxy hóa mạnh mẽ giúp bảo vệ da khỏi tác hại của tia UV.</p><p>Nghiên cứu từ Đại học Manchester (Anh) chỉ ra rằng ăn 5-6 quả cà chua cherry mỗi ngày trong 12 tuần có thể giúp giảm 33% nguy cơ cháy nắng.</p><h3>Cách ăn tốt nhất:</h3><ul><li><strong>Ăn sống:</strong> Trộn salad với dầu oliu để tăng hấp thu lycopene.</li><li><strong>Nướng:</strong> Nướng ở 180°C trong 15 phút với chút dầu oliu — lycopene giải phóng gấp 5 lần.</li><li><strong>Ép nước:</strong> Kết hợp với cà rốt để có cocktail vitamin hoàn hảo.</li></ul><p>Ngoài ra, cà chua cherry chỉ có 18 calo / 100g, rất thân thiện với thực đơn giảm cân.</p>',
            ],
            [
                'title' => 'Vì sao Thịt bò Wagyu A5 lại có giá triệu đồng mỗi lạng?',
                'category' => 'Sản phẩm nông sản',
                'image' => 'https://picsum.photos/seed/blog-wagyu/800/500',
                'content' => '<p>Thịt bò Wagyu A5 là đỉnh cao của ngành chăn nuôi thế giới, với giá từ 3-5 triệu đồng / 100g. Vậy điều gì khiến nó đắt đỏ đến vậy?</p><h3>Vân mỡ cẩm thạch (Marbling)</h3><p>Wagyu A5 có vân mỡ chằng chịt như đá cẩm thạch (marbling score 8-12). Chính các vân mỡ này tạo nên hương vị béo ngậy, tan chảy trong miệng không gì sánh được.</p><h3>Quy trình chăn nuôi khắt khe</h3><p>Bò Wagyu được nuôi trong điều kiện cực kỳ đặc biệt: <strong>nghe nhạc cổ điển, được massage hàng ngày</strong>, và ăn thức ăn phối trộn riêng gồm ngũ cốc, rơm lúa mạch và đôi khi cả bia.</p><h3>Số lượng giới hạn</h3><p>Chỉ có khoảng 3.000 con bò đạt chuẩn A5 mỗi năm trên toàn Nhật Bản. Sự khan hiếm tự nhiên đẩy giá thành lên rất cao.</p>',
            ],
        ];

        foreach ($posts as $item) {
            Post::create([
                'title' => $item['title'],
                'slug' => Str::slug($item['title']),
                'category' => $item['category'],
                'image_url' => $item['image'],
                'content' => $item['content'],
                'is_published' => true,
            ]);
        }
    }
}
