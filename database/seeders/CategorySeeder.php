<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Rau củ hữu cơ & Đà Lạt',
                'slug' => 'rau-cu-huu-co-da-lat',
                'description' => 'Rau củ hữu cơ tươi ngon trồng theo chuẩn VietGAP, GlobalGAP trực tiếp từ Đà Lạt.',
            ],
            [
                'name' => 'Trái cây đặc sản & Nhập khẩu',
                'slug' => 'trai-cay-dac-san-nhap-khau',
                'description' => 'Trái cây đặc sản 3 miền và trái cây nhập khẩu tươi mới, vị ngọt tự nhiên chuẩn mùa.',
            ],
            [
                'name' => 'Thịt sạch & Trứng tươi',
                'slug' => 'thit-sach-trung-tuoi',
                'description' => 'Thịt bò, thịt heo, thịt gà kiểm dịch nghiêm ngặt và trứng tươi an toàn sinh học.',
            ],
            [
                'name' => 'Thủy hải sản tươi sống & Đóng khay',
                'slug' => 'thuy-hai-san-tuoi-song',
                'description' => 'Tôm, cá, hải sản tươi sống đánh bắt trong ngày, bảo quản tiêu chuẩn cấp đông sâu.',
            ],
            [
                'name' => 'Gạo, Ngũ cốc & Lương thực sạch',
                'slug' => 'gao-ngu-coc-luong-thuc',
                'description' => 'Gạo đặc sản ST25, yến mạch nguyên cám, đậu hạt thuần chủng tốt cho sức khỏe.',
            ],
            [
                'name' => 'Gia vị truyền thống & Tự nhiên',
                'slug' => 'gia-vi-truyen-thong-tu-nhien',
                'description' => 'Nước mắm truyền thống Phú Quốc, tiêu chín, muối khoáng và mật ong rừng nguyên chất.',
            ],
            [
                'name' => 'Món sơ chế sẵn (Ready-to-cook)',
                'slug' => 'mon-so-che-san-ready-to-cook',
                'description' => 'Khay nguyên liệu sơ chế sạch, kèm gói gia vị hoàn chỉnh tiện lợi cho bữa cơm gia đình.',
            ],
        ];

        foreach ($categories as $cat) {
            Category::updateOrCreate(
                ['slug' => $cat['slug']],
                [
                    'name' => $cat['name'],
                    'description' => $cat['description'],
                    'is_active' => true,
                ]
            );
        }
    }
}
