<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BlogSeeder extends Seeder
{
    public function run(): void
    {
        $dir = storage_path('app/public/blog');
        if (! file_exists($dir)) {
            mkdir($dir, 0755, true);
        }

        $posts = [
            [
                'title' => 'Cẩm nang chọn & bảo quản Hải Sản Sạch: Từ ngư trường sinh thái Cà Mau đến bàn ăn chuẩn 5 sao',
                'category' => 'Chuyện Nông Trại MiniMart',
                'author_name' => 'Bếp trưởng Hoàng Long',
                'read_time' => '8 phút đọc',
                'image' => 'storage/blog/seafood-guide.jpg',
                'content' => '<p class="first-letter:text-5xl first-letter:font-bold first-letter:text-emerald-800 first-letter:float-left first-letter:mr-3 first-letter:leading-none text-gray-800">Hải sản luôn là nguồn thực phẩm giàu dưỡng chất và quyến rũ bậc nhất trên bàn ăn gia đình Việt. Tuy nhiên, giữa bối cảnh thị trường ngập tràn các sản phẩm ngâm ướp hóa chất hay đánh bắt bừa bãi, việc tìm kiếm và nhận biết "Hải sản sạch" đúng nghĩa đang trở thành mối quan tâm hàng đầu của người nội trợ thông thái. Cùng khám phá hành trình từ đầm rừng Cà Mau đến bàn ăn gia đình và những tiêu chuẩn khắt khe tạo nên đẳng cấp hải sản sinh thái tại MiniMart.</p>

<h2><span class="w-2.5 h-2.5 rounded-full bg-emerald-600 inline-block mr-2"></span> 1. Định nghĩa chuẩn mực: Thế nào là "Hải sản sạch sinh thái"?</h2>
<p>Khác biệt hoàn toàn với hải sản nuôi công nghiệp thâm canh hay hải sản bảo quản bằng hóa chất, <strong>Hải sản sinh thái (Eco-aquaculture)</strong> là dòng sản phẩm được sinh trưởng tự nhiên trong môi trường rừng ngập mặn ngập tràn phù sa. Điển hình như vùng đất Năm Căn, Ngọc Hiển (Cà Mau), tôm cá tự tìm kiếm sinh vật phù du, lá mắm, rễ đước làm thức ăn mà không hề có sự can thiệp của cám tăng trọng hay thuốc kháng sinh.</p>
<ul>
    <li><strong>100% Thuận tự nhiên:</strong> Tôm cá sống trong môi trường nước mặn lưu thông theo thủy triều, vận động liên tục giúp cơ thịt săn chắc và ngọt đậm đà.</li>
    <li><strong>Công nghệ cấp đông rời siêu tốc (IQF - Individual Quick Freezing):</strong> Ngay sau khi đánh bắt, hải sản được phân loại và cấp đông ở nhiệt độ cực sâu <strong>-40°C</strong> chỉ trong 12 phút, khóa chặt tinh chất ngọt và dưỡng chất như lúc vừa vớt lên mạn thuyền.</li>
    <li><strong>Tiêu chuẩn 3 KHÔNG tuyệt đối:</strong> Không ngâm urê giữ tươi giả tạo • Không hàn the tăng độ giòn • Không bơm agar hoặc ngâm polyphosphate ngậm nước gian lận trọng lượng.</li>
</ul>

<figure class="my-8 rounded-2xl overflow-hidden shadow-md bg-gray-50 border border-white/80">
    <img src="/storage/blog/seafood-detail.jpg" alt="Cận cảnh thớ thịt tôm sú sinh thái Cà Mau tại MiniMart" class="w-full h-80 sm:h-96 object-cover select-none">
    <figcaption class="p-4 bg-emerald-50/50 text-gray-600 text-sm italic text-center">
        Hình ảnh: Cận cảnh thớ thịt tôm sú sinh thái Năm Căn tại MiniMart — vỏ mỏng sáng bóng, mắt đen lồi trong veo, cơ thịt săn chắc tuyệt đối không ngậm nước.
    </figcaption>
</figure>

<h2><span class="w-2.5 h-2.5 rounded-full bg-emerald-600 inline-block mr-2"></span> 2. Bảng so sánh trực quan: Hải sản sạch MiniMart vs Hải sản ngâm hóa chất</h2>
<p>Rất nhiều người tiêu dùng nhầm tưởng hải sản "càng to, càng bóng mượt và không có mùi tanh" là hải sản tươi ngon. Trên thực tế, đó thường là dấu hiệu của việc đã qua xử lý hóa chất tẩy trắng và ngâm ướp chất bảo quản. Dưới đây là bảng đối chiếu chi tiết từ các chuyên gia ẩm thực MiniMart:</p>

<div class="overflow-x-auto my-8 rounded-2xl border border-emerald-200/80 shadow-xs bg-white/60">
    <table class="w-full text-left border-collapse text-sm">
        <thead class="bg-emerald-100/70 text-emerald-950 font-bold border-b border-emerald-200/80">
            <tr>
                <th class="p-4">Tiêu chí phân biệt</th>
                <th class="p-4 text-emerald-900">Hải sản sinh thái sạch MiniMart</th>
                <th class="p-4 text-rose-800">Hải sản ươn / Ngâm hóa chất (Urê, Hàn the)</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-emerald-100/60 text-gray-700">
            <tr class="hover:bg-emerald-50/40 transition-colors">
                <td class="p-4 font-bold text-gray-900">Mùi tự nhiên</td>
                <td class="p-4 text-emerald-900 font-medium">Mùi mặn mòi đặc trưng của biển khơi, thoảng hương rong rêu dễ chịu.</td>
                <td class="p-4 text-rose-700">Mùi hắc nồng, thoảng mùi amoniac (khai) của urê hoặc tanh gắt lợm giọng.</td>
            </tr>
            <tr class="hover:bg-emerald-50/40 transition-colors">
                <td class="p-4 font-bold text-gray-900">Độ đàn hồi của thịt</td>
                <td class="p-4 text-emerald-900 font-medium">Thịt chắc nịch, đàn hồi cao, ấn ngón tay vào lập tức phục hồi hình dạng.</td>
                <td class="p-4 text-rose-700">Thịt nhão bở hoặc căng phồng cứng đờ, ấn vào để lại vết lõm sâu không đàn hồi.</td>
            </tr>
            <tr class="hover:bg-emerald-50/40 transition-colors">
                <td class="p-4 font-bold text-gray-900">Mắt, Mang & Vỏ</td>
                <td class="p-4 text-emerald-900 font-medium">Mắt lồi trong veo thấy rõ đồng tử đen, mang đỏ tươi, vỏ bám chắc vào thịt.</td>
                <td class="p-4 text-rose-700">Mắt đục ngầu lõm sâu, mang thâm tím hoặc xám xịt có nhớt đục, đầu lỏng lẻo.</td>
            </tr>
            <tr class="hover:bg-emerald-50/40 transition-colors">
                <td class="p-4 font-bold text-gray-900">Khi rã đông & Chế biến</td>
                <td class="p-4 text-emerald-900 font-medium">Nước rã đông trong vắt, khi xào nấu thịt săn chắc lại, giữ 95% trọng lượng.</td>
                <td class="p-4 text-rose-700">Chảy nhiều nước nhớt đục, khi nấu sôi bọt sủi trắng xoá, thịt teo tóp 30% - 50%.</td>
            </tr>
        </tbody>
    </table>
</div>

<div class="bg-emerald-50/80 border border-emerald-200/80 p-5 rounded-2xl text-emerald-950 text-base my-6 shadow-xs">
    <strong>Mẹo nhỏ từ Bếp trưởng MiniMart:</strong> Để nhận biết tôm có bị bơm rau câu/agar tăng trọng hay không, hãy quan sát đốt thứ 3 trên lưng tôm. Nếu phần giáp này bị phồng to bất thường, các khớp vỏ căng giãn rời rạc và khi bẻ cong có dịch nhờn chảy ra thì tuyệt đối không nên mua.
</div>

<blockquote class="bg-emerald-50/70 border-l-4 border-emerald-600 rounded-2xl p-6 md:p-8 my-8 shadow-sm">
    <div class="flex gap-4">
        <span class="material-symbols-outlined text-emerald-700 text-3xl select-none">format_quote</span>
        <div>
            <p class="text-xl md:text-2xl text-emerald-950 font-semibold leading-snug italic mb-3">
                "Một con tôm sinh thái Cà Mau đúng chuẩn không chỉ mang lại vị ngọt đậm đà giòn sần sật nơi đầu lưỡi, mà còn là lời cam kết bảo tồn vẹn nguyên cánh rừng ngập mặn quê hương — nơi sinh quyển được trân trọng và phát triển bền vững."
            </p>
            <cite class="not-italic text-sm text-gray-600 font-bold block">
                — Kỹ sư Thủy sản Nguyễn Văn Hùng, Hợp tác xã Tôm Sinh Thái Năm Căn (Đối tác cung ứng độc quyền MiniMart)
            </cite>
        </div>
    </div>
</blockquote>

<h2><span class="w-2.5 h-2.5 rounded-full bg-emerald-600 inline-block mr-2"></span> 3. Kỹ thuật rã đông chậm & Bí quyết giữ 100% vị ngọt từ biển</h2>
<p>Rất nhiều đầu bếp tại gia mắc phải sai lầm nghiêm trọng khi rã đông: ngâm hải sản trực tiếp vào nước nóng hoặc để dưới vòi nước xả mạnh. Điều này làm phá vỡ cấu trúc màng tế bào, giải phóng toàn bộ lượng đường tự nhiên (glycogen) và dịch ngọt quý giá trôi theo dòng nước, khiến thịt hải sản trở nên khô xơ và nhạt nhẽo.</p>
<ol>
    <li><strong>Rã đông chậm trong ngăn mát tủ lạnh (Phương pháp vàng):</strong> Chuyển túi hải sản từ ngăn đông xuống ngăn mát (nhiệt độ 2°C – 4°C) trước khi nấu 6 – 8 tiếng. Cấu trúc tinh thể đá tan chảy từ tốn giúp sợi cơ hút lại độ ẩm tự nhiên.</li>
    <li><strong>Rã đông cấp tốc bằng nước lạnh pha muối loãng:</strong> Nếu cần nấu gấp, hãy giữ nguyên túi hút chân không kín, ngâm cả túi vào thau nước lạnh có pha 1 thìa cà phê muối biển và vài viên đá nhỏ. Nồng độ thẩm thấu đẳng trương sẽ bảo vệ thớ thịt không bị úng nước.</li>
    <li><strong>Không bao giờ tái đông (Re-freezing):</strong> Hải sản đã rã đông cần được chế biến ngay trong vòng 24 giờ. Tái cấp đông sẽ làm vi khuẩn sinh sôi gấp bội và phá hủy hoàn toàn hương vị tinh khiết.</li>
</ol>

<figure class="my-8 rounded-2xl overflow-hidden shadow-md bg-gray-50 border border-white/80">
    <img src="/storage/blog/seafood-cooking.jpg" alt="Món tôm sú Cà Mau hấp nước dừa thơm lừng" class="w-full h-80 sm:h-96 object-cover select-none">
    <figcaption class="p-4 bg-emerald-50/50 text-gray-600 text-sm italic text-center">
        Hình ảnh: Tôm sú sinh thái khi hấp nước dừa lửa lớn giữ nguyên độ mọng nước, vỏ đỏ au bóng bẩy và thịt giòn ngọt đậm đà chuẩn phong vị ẩm thực thượng hạng.
    </figcaption>
</figure>

<h2><span class="w-2.5 h-2.5 rounded-full bg-emerald-600 inline-block mr-2"></span> 4. Lời kết: Bữa ăn thịnh soạn khởi nguồn từ sự an tâm</h2>
<p>Lựa chọn hải sản sạch không đơn thuần là việc chăm chút cho một bữa ăn ngon, mà chính là sự đầu tư dài hạn cho sức khỏe của những người thân yêu. Tại MiniMart, mỗi con tôm, lát cá thu hay con mực đều mang theo trọn vẹn sự tinh khôi của biển cả và trách nhiệm tận tâm của đội ngũ kiểm soát chất lượng từ mạn thuyền đến tận bàn ăn của bạn.</p>

<div class="pt-8 pb-4 flex flex-wrap gap-2 border-t border-gray-200/60 not-prose">
    <span class="px-3.5 py-1.5 rounded-full bg-white/80 hover:bg-emerald-50 border border-gray-200/70 text-gray-700 text-xs font-semibold cursor-pointer transition-colors">#HaiSanSach</span>
    <span class="px-3.5 py-1.5 rounded-full bg-white/80 hover:bg-emerald-50 border border-gray-200/70 text-gray-700 text-xs font-semibold cursor-pointer transition-colors">#TomSuSinhThai</span>
    <span class="px-3.5 py-1.5 rounded-full bg-white/80 hover:bg-emerald-50 border border-gray-200/70 text-gray-700 text-xs font-semibold cursor-pointer transition-colors">#HaiSanCaMau</span>
    <span class="px-3.5 py-1.5 rounded-full bg-white/80 hover:bg-emerald-50 border border-gray-200/70 text-gray-700 text-xs font-semibold cursor-pointer transition-colors">#MeoNhaBep</span>
    <span class="px-3.5 py-1.5 rounded-full bg-white/80 hover:bg-emerald-50 border border-gray-200/70 text-gray-700 text-xs font-semibold cursor-pointer transition-colors">#AmThucSach</span>
    <span class="px-3.5 py-1.5 rounded-full bg-white/80 hover:bg-emerald-50 border border-gray-200/70 text-gray-700 text-xs font-semibold cursor-pointer transition-colors">#MiniMartCleanFood</span>
</div>',
            ],
            [
                'title' => '7 Bí quyết giữ rau củ quả luôn tươi xanh mọng nước suốt 7 ngày trong tủ lạnh',
                'category' => 'Mẹo vặt nhà bếp',
                'author_name' => 'Trần Thùy Linh',
                'read_time' => '5 phút đọc',
                'image' => 'https://images.unsplash.com/photo-1540420773420-3366772f4999?auto=format&fit=crop&w=1200&q=80',
                'content' => '<p class="lead">Mua sắm rau củ tươi mỗi cuối tuần là thói quen lành mạnh, nhưng không ít gia đình phải ngậm ngùi vứt bỏ những bó rau úa vàng hay những quả cà chua bị nhũn hỏng chỉ sau 2-3 ngày. Bí quyết nằm ở việc kiểm soát độ ẩm và phân loại đúng cách trong môi trường tủ lạnh.</p>
<h2>1. Nguyên tắc vàng: Không rửa rau củ trước khi cho vào tủ lạnh</h2>
<p>Rất nhiều người có thói quen rửa sạch tất cả nông sản ngay sau khi đi siêu thị về để tiện chế biến. Tuy nhiên, độ ẩm còn sót lại trên phiến lá chính là chất xúc tác sinh học hoàn hảo cho vi khuẩn và nấm mốc sinh sôi với tốc độ chóng mặt. Nước làm mềm lớp biểu bì bảo vệ tự nhiên của thực vật, khiến rau nhanh chóng bị nhớt.</p>
<p><strong>Mẹo nhỏ từ đầu bếp:</strong> Hãy chỉ rửa rau củ ngay trước khi bạn bắt đầu nấu nướng. Nếu bắt buộc phải sơ chế trước, hãy sử dụng rổ quay ly tâm để làm khô hoàn toàn trước khi bảo quản.</p>
<h2>2. Phân loại theo nhóm "Khí Ethylene" — Tránh hiện tượng chín ép</h2>
<p>Ethylene là một loại hormone thực vật dạng khí do một số loại trái cây phát ra khi chín, thúc đẩy sự lão hóa của các loại rau củ xung quanh. Khi đặt chuối, táo hay bơ cạnh các loại rau lá xanh nhạy cảm như cải bó xôi hay súp lơ, khí ethylene sẽ làm lá xanh chuyển vàng rất nhanh.</p>
<ul>
    <li><strong>Nhóm phát khí Ethylene cao:</strong> Chuối chín, táo, lê, cà chua, bơ, dưa gang.</li>
    <li><strong>Nhóm nhạy cảm với Ethylene:</strong> Xà lách, dưa leo, cà rốt, cải thìa, măng tây, súp lơ xanh.</li>
</ul>
<blockquote>
    "Rau củ giống như những sinh thể vẫn tiếp tục trao đổi chất sau thu hoạch. Giữ độ ẩm phù hợp và độ thông thoáng cần thiết chính là chìa khóa vàng giúp duy trì trọn vẹn dưỡng chất và vị ngọt tự nhiên."
</blockquote>
<h2>3. Tận dụng hộp thủy tinh và khăn giấy hút ẩm chuyên dụng</h2>
<p>Đối với các loại rau thơm như ngò rí, húng quế và hành lá, cách bảo quản tối ưu nhất là phương pháp "ủ khô". Bọc nhẹ rau trong một lớp khăn giấy thực phẩm sạch không mùi, sau đó đặt vào hộp kín làm bằng thủy tinh hoặc nhựa an toàn không chứa BPA. Khăn giấy sẽ hút ẩm dư thừa và duy trì môi trường lý tưởng suốt cả tuần.</p>',
            ],
            [
                'title' => '5 Công thức nước ép thanh lọc cơ thể từ rau củ tươi chuẩn chuyên gia',
                'category' => 'Dinh dưỡng & Sức khỏe',
                'author_name' => 'Bác sĩ Lê Hoàng',
                'read_time' => '4 phút đọc',
                'image' => 'https://images.unsplash.com/photo-1613478223719-2ab802602423?auto=format&fit=crop&w=1200&q=80',
                'content' => '<p class="lead">Nước ép rau củ tươi nguyên chất không chỉ cung cấp nguồn vitamin dồi dào mà còn hỗ trợ hệ tiêu hóa thanh lọc độc tố một cách tự nhiên và nhẹ nhàng.</p>
<h2>1. Nước ép Cần tây, Táo xanh & Gừng ấm</h2>
<p>Cần tây giàu chất chống oxy hóa apigenin kết hợp cùng vị chua thanh của táo xanh và chút cay nhẹ của gừng tươi tạo nên một ly nước ép khởi đầu ngày mới tràn đầy năng lượng.</p>
<ul>
    <li>3 nhánh cần tây hữu cơ MiniMart</li>
    <li>1 quả táo xanh Granny Smith</li>
    <li>1 lát gừng tươi 1cm</li>
    <li>1/2 quả chanh vắt lấy nước cốt</li>
</ul>
<h2>2. Nước ép Củ dền, Cà rốt & Cam vàng</h2>
<p>Công thức bổ máu, giàu sắt và carotenoid giúp làn da sáng khỏe tự nhiên từ bên trong. Lưu ý nên uống sau bữa ăn sáng 30 phút để cơ thể hấp thụ tốt nhất.</p>
<blockquote>
    "Hãy ưu tiên các loại rau củ hữu cơ đạt chuẩn VietGAP/GlobalGAP để đảm bảo không tồn dư hóa chất bảo vệ thực vật khi ép sống."
</blockquote>',
            ],
            [
                'title' => 'Cách bảo quản Cải bó xôi Đà Lạt tươi lâu trong 5 ngày không mất chất',
                'category' => 'Mẹo vặt nhà bếp',
                'author_name' => 'Đội ngũ Nông trại MiniMart',
                'read_time' => '3 phút đọc',
                'image' => 'https://images.unsplash.com/photo-1576045057995-568f588f82fb?auto=format&fit=crop&w=1200&q=80',
                'content' => '<p class="lead">Cải bó xôi (rau chân vịt) là siêu thực phẩm giàu sắt, folate và vitamin K. Tuy nhiên loại rau này rất dễ dập nát nếu bảo quản không đúng cách.</p>
<h2>Phương pháp cuốn màng bọc thực phẩm</h2>
<p>Sau khi mua về từ MiniMart, hãy cắt bỏ phần rễ dập, nhặt bỏ lá úa và để nguyên không rửa. Sử dụng khăn giấy bọc quanh phần cuống và thân lá, sau đó cho vào túi zipper đục lỗ thoáng khí.</p>
<p>Đặt túi ở ngăn rau củ (ngăn hộc dưới cùng) với nhiệt độ khoảng 4°C – 6°C. Bằng cách này, cải bó xôi sẽ giữ nguyên độ giòn ngọt trong 5 ngày liên tục.</p>',
            ],
            [
                'title' => 'Top 5 trái cây nhập khẩu giàu vitamin C nhất cho sức đề kháng mùa hè',
                'category' => 'Dinh dưỡng & Sức khỏe',
                'author_name' => 'Mai Anh (Chuyên gia Dinh dưỡng)',
                'read_time' => '5 phút đọc',
                'image' => 'https://images.unsplash.com/photo-1619566636858-adf3ef46400b?auto=format&fit=crop&w=1200&q=80',
                'content' => '<p class="lead">Mùa nắng nóng khiến cơ thể nhanh mất nước và suy giảm hệ miễn dịch. Bổ sung các loại trái cây tự nhiên giàu vitamin C là giải pháp khoa học nhất.</p>
<h2>1. Kiwi vàng Zespri New Zealand</h2>
<p>Một quả kiwi vàng chứa lượng vitamin C gấp 3 lần so với một quả cam thông thường, đáp ứng 100% nhu cầu hàng ngày của người trưởng thành.</p>
<h2>2. Cam vàng Navel Úc không hạt</h2>
<p>Vị ngọt đậm, mọng nước và không hạt, rất phù hợp cho cả người già và trẻ nhỏ ăn trực tiếp hoặc vắt nước.</p>
<h2>3. Dâu tây hữu cơ Hàn Quốc</h2>
<p>Ngoài vitamin C, dâu tây còn giàu axit ellagic giúp ngăn ngừa tổn thương tế bào do tia cực tím gây ra.</p>',
            ],
            [
                'title' => 'Vì sao Thịt bò Wagyu A5 lại có giá hàng triệu đồng mỗi phần?',
                'category' => 'Chuyện Nông Trại MiniMart',
                'author_name' => 'Đầu bếp Hoàng Long',
                'read_time' => '6 phút đọc',
                'image' => 'https://images.unsplash.com/photo-1544025162-d76694265947?auto=format&fit=crop&w=1200&q=80',
                'content' => '<p class="lead">Thịt bò Wagyu A5 được coi là kiệt tác của ngành ẩm thực thế giới. Điểm đặc trưng nhất của nó chính là vân mỡ cẩm thạch hoàn mỹ và hương vị tan chảy trong miệng.</p>
<h2>Tiêu chuẩn Marbling Score (BMS)</h2>
<p>Chỉ những phần thịt đạt điểm vân mỡ từ BMS 8 đến 12 mới đủ điều kiện xếp vào phân hạng A5 cao cấp nhất tại Nhật Bản. Lớp mỡ chưa bão hòa tan chảy ở nhiệt độ thấp hơn thân nhiệt con người (khoảng 25°C), tạo nên cảm giác béo ngậy mà không hề ngấy.</p>
<h2>Quy trình nuôi dưỡng độc bản</h2>
<p>Bò Wagyu được nuôi dưỡng với chế độ thức ăn phối trộn nghiêm ngặt, nguồn nước tinh khiết và không gian sống hoàn toàn không có căng thẳng (stress-free) suốt 30 tháng.</p>',
            ],
            [
                'title' => 'Hướng dẫn làm Salad ức gà sốt mè rang thanh đạm tại nhà chuẩn Eat Clean',
                'category' => 'Công thức nấu ăn',
                'author_name' => 'Trần Thùy Linh',
                'read_time' => '4 phút đọc',
                'image' => 'https://images.unsplash.com/photo-1512621776951-a57141f2eefd?auto=format&fit=crop&w=1200&q=80',
                'content' => '<p class="lead">Một bữa trưa nhẹ nhàng, giàu đạm và chất xơ chỉ mất 15 phút chuẩn bị với các nguyên liệu tươi sạch sẵn có tại MiniMart.</p>
<h2>Nguyên liệu chuẩn bị:</h2>
<ul>
    <li>200g ức gà tươi luộc xé sợi</li>
    <li>100g xà lách Romaine giòn</li>
    <li>50g cà chua bi cherry baby</li>
    <li>1/2 quả bơ sáp cắt hạt lựu</li>
    <li>3 thìa sốt mè rang Kewpie cao cấp</li>
</ul>
<h2>Cách thực hiện:</h2>
<p>Ứng dụng kỹ thuật luộc ức gà ở nhiệt độ chậm 80°C trong 12 phút để thịt giữ trọn độ ẩm, không bị khô xơ. Trộn đều cùng rau sống và sốt mè rang ngay trước khi thưởng thức.</p>',
            ],
            [
                'title' => 'Phân biệt Nho mẫu đơn Hàn Quốc và Nhật Bản chính hiệu tại MiniMart',
                'category' => 'Mẹo vặt nhà bếp',
                'author_name' => 'Minh Tuấn (Thu mua MiniMart)',
                'read_time' => '4 phút đọc',
                'image' => 'https://images.unsplash.com/photo-1537640538966-79f369143f8f?auto=format&fit=crop&w=1200&q=80',
                'content' => '<p class="lead">Nho mẫu đơn (Shine Muscat) là dòng trái cây thượng hạng được ưa chuộng nhờ vị ngọt thanh quý phái và thoang thoảng hương thơm sữa đặc trưng.</p>
<h2>Dấu hiệu nhận biết nho mẫu đơn đạt chuẩn:</h2>
<p>Chùm nho chắc quả, quả to tròn đều từ 13g – 15g/quả, vỏ mỏng căng bóng màu xanh ngọc bích. Đặc biệt, cuống nho phải còn tươi xanh và phủ lớp phấn tự nhiên bảo vệ quả.</p>
<p>Tại MiniMart, toàn bộ nho mẫu đơn đều được nhập khẩu qua đường hàng không (Air Cargo) và bảo quản trong chuỗi lạnh Cold Chain 2°C – 4°C liên tục.</p>',
            ],
            [
                'title' => 'Ưu đãi nông sản VietGAP: Đón mùa vụ bơ 034 Tây Nguyên tại chuỗi cửa hàng',
                'category' => 'Khuyến mãi & Mùa vụ',
                'author_name' => 'Ban Quản trị MiniMart',
                'read_time' => '2 phút đọc',
                'image' => 'https://images.unsplash.com/photo-1523049673857-eb18f1d7b578?auto=format&fit=crop&w=1200&q=80',
                'content' => '<p class="lead">MiniMart đồng hành cùng bà con nông dân Lâm Đồng và Đắk Lắk mang bơ sáp 034 đạt chuẩn VietGAP về từng bàn ăn gia đình với mức giá ưu đãi hấp dẫn.</p>
<h2>Đặc tính bơ 034 đầu mùa:</h2>
<p>Bơ dài thon, cơm vàng dẻo quánh, hạt nhỏ và tỷ lệ sáp cao trên 85%. Chương trình ưu đãi giảm 20% cho tất cả khách hàng thành viên MiniMart Rewards từ ngày 01 đến 15 tháng này.</p>',
            ],
        ];

        // Xóa sạch posts cũ và nạp mới
        Post::truncate();

        foreach ($posts as $idx => $item) {
            if (str_starts_with($item['image'], 'storage/')) {
                $imageUrl = $item['image'];
            } else {
                $localFilename = 'blog/post-'.($idx + 1).'.jpg';
                $fullStoragePath = storage_path('app/public/'.$localFilename);

                // Tải ảnh về lưu cục bộ nếu chưa có
                if (! file_exists($fullStoragePath)) {
                    try {
                        $context = stream_context_create([
                            'http' => [
                                'timeout' => 4,
                                'user_agent' => 'MiniMart/1.0',
                            ],
                        ]);
                        $data = @file_get_contents($item['image'], false, $context);
                        if ($data && strlen($data) > 1000) {
                            file_put_contents($fullStoragePath, $data);
                        }
                    } catch (\Throwable $e) {
                        // Fallback an toàn nếu không có mạng
                    }
                }

                $imageUrl = file_exists($fullStoragePath)
                    ? 'storage/'.$localFilename
                    : $item['image'];
            }

            Post::create([
                'title' => $item['title'],
                'slug' => Str::slug($item['title']),
                'category' => $item['category'],
                'author_name' => $item['author_name'],
                'read_time' => $item['read_time'],
                'image_url' => $imageUrl,
                'content' => $item['content'],
                'is_published' => true,
            ]);
        }
    }
}
