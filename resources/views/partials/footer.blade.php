<footer class="bg-white dark:bg-surface-dark border-t border-gray-200 dark:border-gray-800 pt-16 pb-8"
    x-data="{ 
        isOpen: false,
        activeKey: 'about',
        modalContent: {
            'about': {
                title: 'Tentang LokalKeun',
                body: '<p><strong>LokalKeun</strong> adalah inisiatif digital yang lahir dari semangat untuk memberdayakan ekonomi lokal. Kami percaya bahwa UMKM adalah tulang punggung ekonomi bangsa.</p><p class=\'mt-4\'>Misi kami sederhana: Menghubungkan cita rasa dan karya otentik lokal dengan pasar yang lebih luas melalui teknologi yang mudah digunakan, aman, dan transparan.</p>'
            },
            'blog': {
                title: 'Blog & Berita',
                body: '<p>Nantikan update terbaru seputar tips bisnis, kisah inspiratif mitra UMKM, dan tren pasar terkini.</p>'
            },
            'contact': {
                title: 'Hubungi Kami',
                body: '<p>Kami siap membantu Anda 24/7. Jangan ragu untuk menghubungi kami melalui saluran berikut:</p><div class=\'mt-4 p-4 bg-gray-50 dark:bg-gray-700 rounded-xl space-y-2\'><p><strong>📧 Email:</strong> support@lokalkeun.id</p><p><strong>📞 WhatsApp:</strong> +62 812-3456-7890</p><p><strong>🏢 Kantor:</strong> Telkom University</p></div>'
            },
            'help': {
                title: 'Pusat Bantuan',
                body: '<p><strong>Bagaimana cara belanja?</strong><br>Pilih produk, hubungi penjual, dan lakukan transaksi dengan penjual/mitra.</p><p class=\'mt-4\'><strong>Bagaimana cara jadi mitra?</strong><br>Klik tombol \'Gabung Mitra\' di menu atas, isi formulir, dan tunggu verifikasi 1x24 jam.</p>'
            },
            'terms': {
                title: 'Syarat & Ketentuan',
                body: '<p>1. Pengguna wajib memberikan data yang valid.</p><p>2. Dilarang menjual barang ilegal atau berbahaya.</p><p>3. LokalKeun berhak memblokir akun yang melanggar aturan komunitas.</p><p>4. Transaksi diluar platform tidak menjadi tanggung jawab kami.</p>'
            },
            'privacy': {
                title: 'Kebijakan Privasi',
                body: '<p>Kami menghargai privasi Anda. Data pribadi seperti Nama, Email, dan Nomor Telepon hanya digunakan untuk keperluan transaksi dan verifikasi akun.</p><p class=\'mt-4\'>Kami tidak akan pernah menjual data Anda kepada pihak ketiga tanpa persetujuan Anda.</p>'
            }
        }
    }">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-12">
            
            {{-- Kolom 1: Brand --}}
            <div class="lg:col-span-1">
                <div class="flex items-center gap-2 mb-4">
                    <div class="size-10 bg-gradient-to-br from-primary-orange to-primary-green rounded-xl flex items-center justify-center">
                        <span class="material-symbols-outlined text-white text-2xl">store</span>
                    </div>
                    <h3 class="text-xl font-bold gradient-text">LokalKeun</h3>
                </div>
                <p class="text-gray-600 dark:text-gray-400 text-sm leading-relaxed mb-6">
                    Platform digital yang menghubungkan UMKM lokal dengan pelanggan untuk memajukan ekonomi kerakyatan.
                </p>
            </div>

            {{-- Kolom 2: Perusahaan --}}
            <div>
                <h4 class="font-bold text-gray-900 dark:text-white mb-4">Perusahaan</h4>
                <ul class="space-y-3">
                    <li><button @click="activeKey = 'about'; isOpen = true" class="text-gray-600 hover:text-primary-orange transition-colors text-left">Tentang Kami</button></li>
                    <li><button @click="activeKey = 'blog'; isOpen = true" class="text-gray-600 hover:text-primary-orange transition-colors text-left">Blog</button></li>
                    <li><button @click="activeKey = 'contact'; isOpen = true" class="text-gray-600 hover:text-primary-green transition-colors text-left">Kontak</button></li>
                </ul>
            </div>

            {{-- Kolom 3: Layanan --}}
            <div>
                <h4 class="font-bold text-gray-900 dark:text-white mb-4">Layanan</h4>
                <ul class="space-y-3">
                    <li><button @click="activeKey = 'help'; isOpen = true" class="text-gray-600 hover:text-primary-green transition-colors text-left">Pusat Bantuan</button></li>
                    <li><button @click="activeKey = 'terms'; isOpen = true" class="text-gray-600 hover:text-primary-orange transition-colors text-left">Syarat & Ketentuan</button></li>
                    <li><button @click="activeKey = 'privacy'; isOpen = true" class="text-gray-600 hover:text-primary-green transition-colors text-left">Kebijakan Privasi</button></li>
                </ul>
            </div>

            {{-- Kolom 4: Subscribe --}}
            <div>
                <h4 class="font-bold text-gray-900 dark:text-white mb-4">Saran & Masukkan</h4>
                <div class="flex gap-2">
                    <input type="email" placeholder="Saran & Masukkan" class="flex-1 px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm focus:ring-2 focus:ring-primary-orange focus:border-transparent" />
                    <button class="px-4 py-2 bg-gradient-to-r from-primary-orange to-primary-green text-white rounded-lg hover:shadow-lg transition-all">
                        <span class="material-symbols-outlined">send</span>
                    </button>
                </div>
            </div>
        </div>

        <div class="border-t border-gray-200 dark:border-gray-800 pt-8 flex justify-center items-center gap-4">
            <p class="text-sm font-bold text-gray-500">
              © 2026 LokalKeun. All rights reserved.
            </p>
        </div>          
    </div>

    {{-- INCLUDE PARTIAL MODAL DI SINI --}}
    @include('partials.footer-modals')

</footer>