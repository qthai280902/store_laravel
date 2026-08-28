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
                'title' => 'Cách bảo quản Cải bó xôi Đà Lạt tươi lâu',
                'category' => 'Mẹo vặt',
                'image' => 'https://images.unsplash.com/photo-1576045057995-568f588f82fb?w=800',
                'content' => '<p>Cải bó xôi (spinach) rất nhanh héo nếu không được bảo quản đúng cách. Dưới đây là cách giữ rau tươi lâu:</p><ul><li>Không rửa rau trước khi cất tủ lạnh.</li><li>Dùng giấy ăn bọc kín rau rồi cho vào túi zip.</li><li>Bảo quản ở ngăn mát tủ lạnh từ 1-4 độ C.</li></ul><p>Cách này giúp cải bó xôi có thể giữ độ tươi ngon tới 5 ngày.</p>'
            ],
            [
                'title' => 'Top 5 trái cây nhập khẩu tốt cho sức khỏe',
                'category' => 'Sản phẩm sức khỏe',
                'image' => 'https://images.unsplash.com/photo-1610832958506-aa56368176cf?w=800',
                'content' => '<p>Trái cây nhập khẩu không chỉ ngon miệng mà còn chứa nhiều vitamin và khoáng chất quan trọng.</p><ol><li><strong>Kiwi vàng New Zealand:</strong> Gấp đôi lượng Vitamin C so với cam.</li><li><strong>Cherry Mỹ:</strong> Giúp chống viêm và giảm đau khớp.</li><li><strong>Nho mẫu đơn:</strong> Giàu chất chống oxy hóa, tốt cho tim mạch.</li><li><strong>Táo Fuji:</strong> Rất tốt cho hệ tiêu hóa nhờ lượng xơ dồi dào.</li><li><strong>Cam vàng Úc:</strong> Tăng sức đề kháng mùa dịch bệnh.</li></ol>'
            ],
            [
                'title' => 'Phân biệt Nho mẫu đơn thật và giả',
                'category' => 'Mẹo vặt',
                'image' => 'https://images.unsplash.com/photo-1596363505729-f14d87ec0968?w=800',
                'content' => '<p>Nho mẫu đơn (Shine Muscat) có giá trị cao nên thường bị làm giả trên thị trường. Hãy chú ý các điểm sau:</p><ul><li><strong>Vị giác:</strong> Nho mẫu đơn chuẩn Hàn/Nhật có hương thơm mùi sữa đặc trưng, vị ngọt thanh không gắt.</li><li><strong>Hình dáng:</strong> Quả nho to đều, da mỏng, không có hạt.</li><li><strong>Màu sắc:</strong> Xanh ngọc trong suốt, cuống còn rất xanh và tươi.</li></ul>'
            ],
            [
                'title' => 'Lợi ích bất ngờ của Cà chua cherry',
                'category' => 'Sản phẩm sức khỏe',
                'image' => 'https://images.unsplash.com/photo-1561136594-7f68413baa99?w=800',
                'content' => '<p>Cà chua bi (cherry tomato) tuy nhỏ nhưng mang lại lợi ích khổng lồ. Chúng chứa lycopene giúp bảo vệ da khỏi tia UV, phòng chống ung thư và rất thân thiện với thực đơn giảm cân. Bạn có thể ăn sống, trộn salad hoặc nướng kèm dầu oliu.</p>'
            ],
            [
                'title' => 'Vì sao Thịt bò Wagyu A5 lại đắt đỏ?',
                'category' => 'Sản phẩm nông sản',
                'image' => 'https://images.unsplash.com/photo-1603360946369-dc9bb6258143?w=800',
                'content' => '<p>Thịt bò Wagyu A5 có vân mỡ chằng chịt như đá cẩm thạch (Marbling), đây là yếu tố tạo nên hương vị béo ngậy tan chảy. Bò được nuôi trong điều kiện khắt khe, nghe nhạc, massage và uống bia, khiến giá thành của nó luôn nằm trong top thực phẩm đắt nhất thế giới.</p>'
            ],
            [
                'title' => 'Gạo ST25 Ông Cua - Niềm tự hào nông sản Việt',
                'category' => 'Sản phẩm nông sản',
                'image' => 'https://images.unsplash.com/photo-1586201375761-83865001e8ac?w=800',
                'content' => '<p>Gạo ST25 do kỹ sư Hồ Quang Cua lai tạo đã vinh dự đạt giải Gạo ngon nhất thế giới. Hạt gạo dài, trong, khi nấu lên dẻo mềm, thơm mùi lá dứa và cốm non. Đây là minh chứng rõ nét cho sự phát triển của nông sản Việt Nam.</p>'
            ],
            [
                'title' => 'Cách nấu Mì cay kimchi chuẩn vị Hàn Quốc',
                'category' => 'Mẹo vặt',
                'image' => 'https://images.unsplash.com/photo-1612929633738-8fe01f728091?w=800',
                'content' => '<p>Đừng chỉ nấu mì bằng nước sôi thông thường! Hãy làm theo cách sau: 1. Đun sôi nước, cho gói gia vị vào trước. 2. Cho thêm một chút nước kim chi và xúc xích. 3. Cho vắt mì vào đun đúng 3 phút. 4. Đập thêm một quả trứng và thưởng thức ngay khi còn nóng!</p>'
            ],
            [
                'title' => 'Mật ong hoa rừng: Kháng sinh tự nhiên tuyệt vời',
                'category' => 'Sản phẩm sức khỏe',
                'image' => 'https://images.unsplash.com/photo-1587049352847-4d4b126a3dcb?w=800',
                'content' => '<p>Mật ong nguyên chất chứa nhiều enzyme, khoáng chất và chất kháng khuẩn tự nhiên. Mỗi sáng uống một cốc nước ấm pha mật ong và chanh giúp thanh lọc cơ thể, làm dịu họng và hỗ trợ tiêu hóa cực kỳ hiệu quả.</p>'
            ],
            [
                'title' => 'Phân biệt cá hồi tự nhiên và cá hồi nuôi',
                'category' => 'Mẹo vặt',
                'image' => 'https://images.unsplash.com/photo-1574484284002-952d92456975?w=800',
                'content' => '<p>Cá hồi tự nhiên có màu cam đậm hơn, vân mỡ mỏng và thịt chắc. Trong khi đó, cá hồi nuôi thường có màu cam nhạt, vân mỡ trắng dày và thịt béo hơn. Tùy vào sở thích ăn uống mà bạn có thể chọn loại phù hợp.</p>'
            ],
            [
                'title' => 'Nấm hương rừng - Vị thuốc quý từ thiên nhiên',
                'category' => 'Sản phẩm nông sản',
                'image' => 'https://images.unsplash.com/photo-1506509709230-07eebc5d6c5c?w=800',
                'content' => '<p>Nấm hương không chỉ là gia vị làm ngọt nước dùng mà còn là dược liệu giúp tăng sức đề kháng, chống lão hóa và phòng ngừa cao huyết áp. Trước khi nấu, ngâm nấm hương với một chút nước ấm và muối sẽ làm nấm nở mềm và giữ nguyên dưỡng chất.</p>'
            ],
        ];

        foreach ($posts as $item) {
            Post::create([
                'title' => $item['title'],
                'slug' => Str::slug($item['title']),
                'category' => $item['category'],
                'image_url' => $item['image'],
                'content' => $item['content'],
                'is_published' => true
            ]);
        }
    }
}
