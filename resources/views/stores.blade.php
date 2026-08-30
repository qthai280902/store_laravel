<x-layouts.app title="Hệ thống cửa hàng - MiniMart">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12"
         x-data="{
            activeStore: 1,
            searchQuery: '',
            selectedCity: 'all',
            selectedCityName: 'Tất cả Tỉnh / Thành phố',
            dropdownOpen: false,
            getMapUrl(id) {
                const maps = {
                    1: 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3919.4602324217154!2d106.70114091533423!3d10.776019462145327!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752f46b4122d1b%3A0xb36fc5b3f2c537d!2zTMOqIEzhu6NpLCBC4bq_biBOZ2jDqSwgUXXhuq1uIDEsIEjhu5MgQ2jDrSBNaW5oLCBWaeG7h3QgTmFt!5e0!3m2!1svi!2s!4v1622340316656!5m2!1svi!2s',
                    2: 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3919.4243642352723!2d106.68748381533418!3d10.778848462121303!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752f3066347fbf%3A0x8670d9124dd7881c!2zVsO1IFbEg24gVOG6p24sIFBoxrDhu51uZyA1LCBRdeG6rW4gMywgSOG7kyBDaMOtIE1pbmgsIFZp4buHdCBOYW0!5e0!3m2!1svi!2s!4v1622340388915!5m2!1svi!2s',
                    3: 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3919.954605990299!2d106.71302831533383!3d10.73800266213898!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752f8295a0aee9%3A0x6474fbcf006a8e80!2zTmd1eeG7hW4gVsSDbiBMaW5oLCBUw6JuIFBob25nLCBRdeG6rW4gNywgSOG7kyBDaMOtIE1pbmgsIFZp4buHdCBOYW0!5e0!3m2!1svi!2s!4v1622340455018!5m2!1svi!2s'
                };
                return maps[id];
            }
         }">
        
        <div class="pt-8 pb-4 w-full flex flex-col items-center justify-center text-center fade-item">
            <div class="w-max mx-auto bg-white/40 backdrop-blur-3xl border border-white/80 shadow-[0_8px_32px_rgba(0,0,0,0.08)] ring-1 ring-white/50 rounded-full px-10 py-3 mb-6">
                <h1 class="text-3xl font-extrabold text-green-900">Hệ thống cửa hàng MiniMart</h1>
            </div>
            <p class="text-gray-600 text-lg mb-4">Tìm địa chỉ MiniMart gần bạn nhất để mua sắm tiện lợi</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Cột Trái: Google Maps (2 phần) -->
            <div class="md:col-span-2 bg-white/40 backdrop-blur-3xl border border-white/80 shadow-[0_8px_32px_rgba(0,0,0,0.08)] ring-1 ring-white/50 rounded-2xl p-2 overflow-hidden fade-item">
                <iframe x-bind:src="getMapUrl(activeStore)" class="w-full h-[500px] rounded-2xl" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>

            <!-- Cột Phải: Danh sách chi nhánh (1 phần) -->
            <div class="space-y-4 fade-item">
                <div class="mb-4 relative">
                    <!-- Dropdown Button -->
                    <button @click="dropdownOpen = !dropdownOpen" @click.away="dropdownOpen = false" class="w-full bg-white/50 backdrop-blur-md border border-white/80 rounded-full px-6 py-4 shadow-sm outline-none text-gray-800 font-medium flex justify-between items-center transition-all hover:bg-white/60">
                        <span x-text="selectedCityName"></span>
                        <span class="material-symbols-outlined transition-transform" :class="dropdownOpen ? 'rotate-180' : ''">expand_more</span>
                    </button>
                    <!-- Dropdown Panel -->
                    <div x-show="dropdownOpen" x-transition.opacity.duration.300ms class="absolute left-0 right-0 mt-2 z-50 bg-white/30 backdrop-blur-2xl border border-white/60 shadow-[0_12px_40px_rgba(0,0,0,0.12)] ring-1 ring-white/50 rounded-2xl overflow-hidden py-2" style="display: none;">
                        <button @click="selectedCity = 'all'; selectedCityName = 'Tất cả Tỉnh / Thành phố'; dropdownOpen = false" class="w-full text-left px-6 py-3 font-medium hover:bg-white/40 transition-colors" :class="selectedCity === 'all' ? 'text-green-700 bg-white/50' : 'text-gray-800'">Tất cả Tỉnh / Thành phố</button>
                        <button @click="selectedCity = 'HCM'; selectedCityName = 'Hồ Chí Minh'; dropdownOpen = false" class="w-full text-left px-6 py-3 font-medium hover:bg-white/40 transition-colors" :class="selectedCity === 'HCM' ? 'text-green-700 bg-white/50' : 'text-gray-800'">Hồ Chí Minh</button>
                        <button @click="selectedCity = 'HN'; selectedCityName = 'Hà Nội'; dropdownOpen = false" class="w-full text-left px-6 py-3 font-medium hover:bg-white/40 transition-colors" :class="selectedCity === 'HN' ? 'text-green-700 bg-white/50' : 'text-gray-800'">Hà Nội</button>
                        <button @click="selectedCity = 'DN'; selectedCityName = 'Đà Nẵng'; dropdownOpen = false" class="w-full text-left px-6 py-3 font-medium hover:bg-white/40 transition-colors" :class="selectedCity === 'DN' ? 'text-green-700 bg-white/50' : 'text-gray-800'">Đà Nẵng</button>
                    </div>
                </div>
                <input type="text" x-model="searchQuery" placeholder="Tìm theo quận, tên đường..." class="w-full bg-white/50 backdrop-blur-md border border-white/80 rounded-full px-6 py-4 shadow-sm mb-6 outline-none focus:ring-2 focus:ring-green-500">
                <!-- Store 1 -->
                <div data-city="HCM" x-show="(selectedCity === 'all' || selectedCity === 'HCM') && $el.innerText.toLowerCase().includes(searchQuery.toLowerCase())" @click="activeStore = 1" class="relative overflow-hidden bg-white/60 backdrop-blur-lg rounded-2xl p-5 shadow-md border cursor-pointer transition-all duration-300" :class="activeStore === 1 ? 'border-green-500 shadow-xl bg-green-50/60' : 'border-white/50 hover:shadow-lg'">
                    <div class="absolute top-4 -right-10 w-40 rotate-45 bg-red-500/70 backdrop-blur-md border-b border-white/40 shadow-lg text-white text-xs font-bold py-1 text-center pointer-events-none z-10">Tạm đóng cửa</div>
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full flex items-center justify-center shrink-0 transition-colors" :class="activeStore === 1 ? 'bg-green-600 text-white' : 'bg-green-100 text-green-700'">
                            <span class="material-symbols-outlined text-[20px]">store</span>
                        </div>
                        <h2 class="text-lg font-bold text-green-900">MiniMart Quận 1</h2>
                    </div>
                    <div x-show="activeStore === 1" x-collapse class="mt-3 pt-3 border-t border-gray-200 space-y-2 text-gray-700 text-sm">
                        <p class="flex items-start gap-2">
                            <span class="material-symbols-outlined text-[18px] text-gray-400 shrink-0">location_on</span>
                            <span>123 Lê Lợi, P. Bến Nghé, Quận 1, TP.HCM</span>
                        </p>
                        <p class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-[18px] text-gray-400 shrink-0">schedule</span>
                            <span>07:00 – 22:00</span>
                        </p>
                        <p class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-[18px] text-gray-400 shrink-0">call</span>
                            <span>028 3822 1234</span>
                        </p>
                        <div class="bg-red-50 text-red-600 rounded-lg p-3 mt-3 text-sm">Tặng voucher 50k cho hóa đơn từ 300k</div>
                        <div class="flex flex-wrap gap-2 mt-4"><span class="px-3 py-1 bg-green-50/80 border border-green-100 rounded-full text-xs text-green-700 font-semibold">🅿️ Bãi đậu xe miễn phí</span><span class="px-3 py-1 bg-green-50/80 border border-green-100 rounded-full text-xs text-green-700 font-semibold">📶 Wifi Free</span></div>
                    </div>
                </div>

                <!-- Store 2 -->
                <div data-city="HCM" x-show="(selectedCity === 'all' || selectedCity === 'HCM') && $el.innerText.toLowerCase().includes(searchQuery.toLowerCase())" @click="activeStore = 2" class="bg-white/60 backdrop-blur-lg rounded-2xl p-5 shadow-md border cursor-pointer transition-all duration-300" :class="activeStore === 2 ? 'border-green-500 shadow-xl bg-green-50/60' : 'border-white/50 hover:shadow-lg'">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full flex items-center justify-center shrink-0 transition-colors" :class="activeStore === 2 ? 'bg-green-600 text-white' : 'bg-green-100 text-green-700'">
                            <span class="material-symbols-outlined text-[20px]">store</span>
                        </div>
                        <h2 class="text-lg font-bold text-green-900">MiniMart Quận 3</h2>
                    </div>
                    <div x-show="activeStore === 2" x-collapse class="mt-3 pt-3 border-t border-gray-200 space-y-2 text-gray-700 text-sm">
                        <p class="flex items-start gap-2">
                            <span class="material-symbols-outlined text-[18px] text-gray-400 shrink-0">location_on</span>
                            <span>456 Võ Văn Tần, P.5, Quận 3, TP.HCM</span>
                        </p>
                        <p class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-[18px] text-gray-400 shrink-0">schedule</span>
                            <span>07:00 – 22:00</span>
                        </p>
                        <p class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-[18px] text-gray-400 shrink-0">call</span>
                            <span>028 3930 5678</span>
                        </p>
                        <div class="bg-red-50 text-red-600 rounded-lg p-3 mt-3 text-sm">Tặng voucher 50k cho hóa đơn từ 300k</div>
                        <div class="flex flex-wrap gap-2 mt-4"><span class="px-3 py-1 bg-green-50/80 border border-green-100 rounded-full text-xs text-green-700 font-semibold">🅿️ Bãi đậu xe miễn phí</span><span class="px-3 py-1 bg-green-50/80 border border-green-100 rounded-full text-xs text-green-700 font-semibold">📶 Wifi Free</span></div>
                    </div>
                </div>

                <!-- Store 3 -->
                <div data-city="HCM" x-show="(selectedCity === 'all' || selectedCity === 'HCM') && $el.innerText.toLowerCase().includes(searchQuery.toLowerCase())" @click="activeStore = 3" class="bg-white/60 backdrop-blur-lg rounded-2xl p-5 shadow-md border cursor-pointer transition-all duration-300" :class="activeStore === 3 ? 'border-green-500 shadow-xl bg-green-50/60' : 'border-white/50 hover:shadow-lg'">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full flex items-center justify-center shrink-0 transition-colors" :class="activeStore === 3 ? 'bg-green-600 text-white' : 'bg-green-100 text-green-700'">
                            <span class="material-symbols-outlined text-[20px]">store</span>
                        </div>
                        <h2 class="text-lg font-bold text-green-900">MiniMart Quận 7</h2>
                    </div>
                    <div x-show="activeStore === 3" x-collapse class="mt-3 pt-3 border-t border-gray-200 space-y-2 text-gray-700 text-sm">
                        <p class="flex items-start gap-2">
                            <span class="material-symbols-outlined text-[18px] text-gray-400 shrink-0">location_on</span>
                            <span>789 Nguyễn Văn Linh, P. Tân Phong, Quận 7, TP.HCM</span>
                        </p>
                        <p class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-[18px] text-gray-400 shrink-0">schedule</span>
                            <span>07:00 – 22:00</span>
                        </p>
                        <p class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-[18px] text-gray-400 shrink-0">call</span>
                            <span>028 3771 9012</span>
                        </p>
                        <div class="bg-red-50 text-red-600 rounded-lg p-3 mt-3 text-sm">Tặng voucher 50k cho hóa đơn từ 300k</div>
                        <div class="flex flex-wrap gap-2 mt-4"><span class="px-3 py-1 bg-green-50/80 border border-green-100 rounded-full text-xs text-green-700 font-semibold">🅿️ Bãi đậu xe miễn phí</span><span class="px-3 py-1 bg-green-50/80 border border-green-100 rounded-full text-xs text-green-700 font-semibold">📶 Wifi Free</span></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
