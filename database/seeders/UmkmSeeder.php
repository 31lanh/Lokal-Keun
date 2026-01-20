<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Umkm;
use App\Models\UmkmMenu;
use App\Models\UmkmPhoto;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UmkmSeeder extends Seeder
{
    public function run(): void
    {
        // Daftar Data UMKM Lengkap
        $umkmData = [
            // 1. KULINER
            [
                'owner' => 'Bu Tini',
                'email' => 'tini@lokalkeun.com',
                'umkm' => 'Dapur Bu Tini',
                'cat' => 'kuliner',
                'desc' => 'Masakan rumahan khas Sunda dengan cita rasa otentik. Nasi Liwet dan Ayam Goreng Lengkuas adalah andalan kami.',
                'addr' => 'Jl. Merdeka No. 45, Bandung',
                'phone' => '081234567890', // 12 digit
                'founded' => '2015', // Tahun Berdiri
                'banner' => 'https://images.unsplash.com/photo-1555396273-367ea4eb4db5?w=800&q=80',
                'menus' => [
                    ['Nasi Liwet Komplit', 35000, 'Nasi liwet, ayam, tahu, tempe.', 'https://images.unsplash.com/photo-1603088549196-a941c2af0685?w=300'],
                    ['Ayam Goreng Lengkuas', 20000, 'Gurih meresap sampai tulang.', 'https://images.unsplash.com/photo-1626082927389-6cd097cdc6ec?w=300'],
                ]
            ],
            [
                'owner' => 'Mang Oleh',
                'email' => 'oleh@lokalkeun.com',
                'umkm' => 'Odading Mang Oleh',
                'cat' => 'kuliner',
                'desc' => 'Odading dan Cakue yang rasanya seperti Anda menjadi Iron Man. Renyah di luar, lembut di dalam.',
                'addr' => 'Pasar Kosambi, Bandung',
                'phone' => '089988776655', // 12 digit
                'founded' => '2018',
                'banner' => 'https://images.unsplash.com/photo-1627308595229-7830a5c91f9f?w=800&q=80',
                'menus' => [
                    ['Odading Original', 2500, 'Roti goreng manis khas Bandung.', 'https://images.unsplash.com/photo-1555507036-ab1f40388085?w=300'],
                    ['Cakue Gurih', 2500, 'Cocok dicocol saus asam manis.', 'https://images.unsplash.com/photo-1627308595186-e892671458f5?w=300'],
                ]
            ],
            [
                'owner' => 'Barista Jhon',
                'email' => 'jhon@lokalkeun.com',
                'umkm' => 'Kopi Senja Nusantara',
                'cat' => 'kuliner',
                'desc' => 'Menyajikan biji kopi pilihan dari Gayo, Toraja, hingga Papua. Tempat ternyaman untuk bekerja atau sekadar melamun.',
                'addr' => 'Jl. Braga No. 10, Bandung',
                'phone' => '081122334455', // 12 digit
                'founded' => '2020',
                'banner' => 'https://images.unsplash.com/photo-1497935586351-b67a49e012bf?w=800&q=80',
                'menus' => [
                    ['Kopi Susu Gula Aren', 18000, 'Best seller kami.', 'https://images.unsplash.com/photo-1541167760496-1628856ab772?w=300'],
                    ['V60 Gayo Wine', 25000, 'Manual brew dengan notes fruity.', 'https://images.unsplash.com/photo-1495474472287-4d71bcdd2085?w=300'],
                ]
            ],

            // 2. FASHION
            [
                'owner' => 'Budi Santoso',
                'email' => 'budi@lokalkeun.com',
                'umkm' => 'Batik Modern Jaya',
                'cat' => 'fashion',
                'desc' => 'Pusat batik tulis dan cap dengan desain modern. Melestarikan budaya dengan sentuhan kekinian.',
                'addr' => 'Jl. Malioboro No. 12, Yogyakarta',
                'phone' => '089876543210', // 12 digit
                'founded' => '2010',
                'banner' => 'https://images.unsplash.com/photo-1560243563-062bfc001d68?w=800&q=80',
                'menus' => [
                    ['Kemeja Batik Slimfit', 150000, 'Bahan katun prima adem.', 'https://images.unsplash.com/photo-1596755094514-f87e34085b2c?w=300'],
                    ['Outer Batik Wanita', 120000, 'Cocok untuk ke kantor.', 'https://images.unsplash.com/photo-1612336307429-8a898d10e223?w=300'],
                ]
            ],
            [
                'owner' => 'Siska Amelia',
                'email' => 'siska@lokalkeun.com',
                'umkm' => 'Hijab Chic Official',
                'cat' => 'fashion',
                'desc' => 'Hijab voal premium dengan motif eksklusif yang tidak pasaran. Mudah dibentuk dan tegak di dahi.',
                'addr' => 'Tanah Abang Blok A, Jakarta',
                'phone' => '081299887766', // 12 digit
                'founded' => '2019',
                'banner' => 'https://images.unsplash.com/photo-1585728748176-455ac6efac40?w=800&q=80',
                'menus' => [
                    ['Hijab Voal Motif', 75000, 'Motif floral limited edition.', 'https://images.unsplash.com/photo-1596870230751-ebdfce98ec42?w=300'],
                    ['Pashmina Ceruty', 45000, 'Jatuh dan elegan.', 'https://images.unsplash.com/photo-1574297500578-afae55026ff3?w=300'],
                ]
            ],
            [
                'owner' => 'Kang Denim',
                'email' => 'denim@lokalkeun.com',
                'umkm' => 'Denim Lokal Pride',
                'cat' => 'fashion',
                'desc' => 'Jeans raw denim selvedge kualitas ekspor buatan tangan pengrajin lokal Bandung.',
                'addr' => 'Cihampelas, Bandung',
                'phone' => '085623145678', // 12 digit
                'founded' => '2016',
                'banner' => 'https://images.unsplash.com/photo-1542272617-08f086303294?w=800&q=80',
                'menus' => [
                    ['Jaket Denim Vintage', 350000, 'Model trucker classic.', 'https://images.unsplash.com/photo-1576995853123-5a10305d93c0?w=300'],
                    ['Celana Selvedge 14oz', 450000, 'Fading artistik seiring waktu.', 'https://images.unsplash.com/photo-1541099649105-f69ad21f3246?w=300'],
                ]
            ],

            // 3. KERAJINAN
            [
                'owner' => 'Pak Asep',
                'email' => 'asep@lokalkeun.com',
                'umkm' => 'Anyaman Bambu Sejahtera',
                'cat' => 'kerajinan',
                'desc' => 'Kerajinan tangan bambu ramah lingkungan. Tas, keranjang, hingga perabot rumah tangga.',
                'addr' => 'Desa Wisata, Tasikmalaya',
                'phone' => '085678901234', // 12 digit
                'founded' => '1998',
                'banner' => 'https://images.unsplash.com/photo-1513519245088-0e12902e5a38?w=800&q=80',
                'menus' => [
                    ['Tas Bambu Bulat', 85000, 'Tas selempang unik.', 'https://images.unsplash.com/photo-1584917865442-de89df76afd3?w=300'],
                    ['Besek Bambu Warna', 5000, 'Wadah hantaran ramah lingkungan.', 'https://images.unsplash.com/photo-1616401784845-180886ba9ca2?w=300'],
                ]
            ],
            [
                'owner' => 'Bu Made',
                'email' => 'made@lokalkeun.com',
                'umkm' => 'Bali Rattan Crafts',
                'cat' => 'kerajinan',
                'desc' => 'Kerajinan rotan asli Bali. Membawa nuansa tropis ke dalam rumah Anda.',
                'addr' => 'Ubud, Bali',
                'phone' => '081355442211', // 12 digit
                'founded' => '2005',
                'banner' => 'https://images.unsplash.com/photo-1615873968403-89e068629265?w=800&q=80',
                'menus' => [
                    ['Tas Rotan Bulat', 120000, 'Oleh-oleh wajib Bali.', 'https://images.unsplash.com/photo-1598532163257-ae3c6b2524b6?w=300'],
                    ['Kursi Teras Rotan', 450000, 'Kuat dan tahan lama.', 'https://images.unsplash.com/photo-1617364852223-75f57e78dc96?w=300'],
                ]
            ],
            [
                'owner' => 'Mas Tono',
                'email' => 'tono@lokalkeun.com',
                'umkm' => 'Tanah Liat Kreatif',
                'cat' => 'kerajinan',
                'desc' => 'Studio keramik dan gerabah. Menjual pot, piring, gelas, dan menerima custom order.',
                'addr' => 'Kasongan, Bantul',
                'phone' => '087712345678', // 12 digit
                'founded' => '2012',
                'banner' => 'https://images.unsplash.com/photo-1565193566173-0923d53cce6a?w=800&q=80',
                'menus' => [
                    ['Mug Keramik Custom', 45000, 'Bisa request nama.', 'https://images.unsplash.com/photo-1514228742587-6b1558fcca3d?w=300'],
                    ['Vas Bunga Minimalis', 65000, 'Hiasan meja estetik.', 'https://images.unsplash.com/photo-1581338834647-b0fb40704e21?w=300'],
                ]
            ],

            // 4. PERTANIAN
            [
                'owner' => 'Pak Tani Maju',
                'email' => 'tani@lokalkeun.com',
                'umkm' => 'Sayur Organik Lembang',
                'cat' => 'pertanian',
                'desc' => 'Sayuran bebas pestisida langsung dari kebun kami di kaki Gunung Tangkuban Perahu.',
                'addr' => 'Lembang, Bandung Barat',
                'phone' => '082121212121', // 12 digit
                'founded' => '2017',
                'banner' => 'https://images.unsplash.com/photo-1566385101042-1a0aa0c1268c?w=800&q=80',
                'menus' => [
                    ['Paket Sayur Sop', 15000, 'Wortel, kol, kentang, buncis.', 'https://images.unsplash.com/photo-1540420773420-3366772f4999?w=300'],
                    ['Selada Hidroponik', 10000, 'Segar dan renyah.', 'https://images.unsplash.com/photo-1622206151226-18ca2c9ab4a1?w=300'],
                ]
            ],
            [
                'owner' => 'Bu Sri Rejeki',
                'email' => 'sri@lokalkeun.com',
                'umkm' => 'Madu Hutan Sumbawa Asli',
                'cat' => 'pertanian',
                'desc' => 'Madu murni yang dipanen dari hutan liar Sumbawa. Tanpa campuran gula atau pengawet.',
                'addr' => 'Sumbawa Besar, NTB',
                'phone' => '081987654321', // 12 digit
                'founded' => '2014',
                'banner' => 'https://images.unsplash.com/photo-1587049352846-4a222e784d38?w=800&q=80',
                'menus' => [
                    ['Madu Hitam Pahit', 120000, 'Bagus untuk kesehatan.', 'https://images.unsplash.com/photo-1587049352851-8d4e8918683e?w=300'],
                    ['Madu Multiflora 500ml', 90000, 'Manis alami.', 'https://images.unsplash.com/photo-1558642452-9d2a7deb7f62?w=300'],
                ]
            ],
            [
                'owner' => 'Juragan Buah',
                'email' => 'buah@lokalkeun.com',
                'umkm' => 'Istana Buah Segar',
                'cat' => 'pertanian',
                'desc' => 'Menyediakan buah-buahan tropis lokal berkualitas premium. Mangga, Manggis, Durian, dan lainnya.',
                'addr' => 'Pasar Induk Kramat Jati, Jakarta',
                'phone' => '085811223344', // 12 digit
                'founded' => '2008',
                'banner' => 'https://images.unsplash.com/photo-1610832958506-aa56368176cf?w=800&q=80',
                'menus' => [
                    ['Mangga Harum Manis 1kg', 25000, 'Manis legit tanpa serat.', 'https://images.unsplash.com/photo-1553279768-865429fa0078?w=300'],
                    ['Alpukat Mentega 1kg', 35000, 'Daging tebal dan pulen.', 'https://images.unsplash.com/photo-1523049673856-428689c8ae89?w=300'],
                ]
            ],

            // 5. JASA
            [
                'owner' => 'Mas Dedi',
                'email' => 'dedi@lokalkeun.com',
                'umkm' => 'Cukur Rambut Asgar',
                'cat' => 'jasa',
                'desc' => 'Jasa potong rambut pria profesional. Gaya klasik hingga modern. Pijat kepala gratis.',
                'addr' => 'Jl. Pahlawan, Bandung',
                'phone' => '081333444555', // 12 digit
                'founded' => '2019',
                'banner' => 'https://images.unsplash.com/photo-1585747860715-2ba37e788b70?w=800&q=80',
                'menus' => [
                    ['Cukur Dewasa', 25000, 'Termasuk cuci rambut.', 'https://images.unsplash.com/photo-1621605815971-fbc98d665033?w=300'],
                    ['Shaving / Cukur Kumis', 10000, 'Bersih dan rapi.', 'https://images.unsplash.com/photo-1503951914875-befbb6491842?w=300'],
                ]
            ],
            [
                'owner' => 'Mba Rina',
                'email' => 'rina@lokalkeun.com',
                'umkm' => 'Laundry Kilat Wangi',
                'cat' => 'jasa',
                'desc' => 'Jasa cuci setrika cepat, bersih, dan wangi tahan lama. Bisa antar jemput area sekitar.',
                'addr' => 'Apartemen Kalibata City, Jakarta',
                'phone' => '081299887700', // 12 digit
                'founded' => '2021',
                'banner' => 'https://images.unsplash.com/photo-1545173168-9f1947eebb8f?w=800&q=80',
                'menus' => [
                    ['Cuci Komplit /kg', 7000, 'Cuci, kering, setrika, pewangi.', 'https://images.unsplash.com/photo-1517677208171-0bc12dd59915?w=300'],
                    ['Cuci Bed Cover', 25000, 'Bersih dari tungau.', 'https://images.unsplash.com/photo-1582735689369-4fe89db7114c?w=300'],
                ]
            ],
            [
                'owner' => 'Bang Bengkel',
                'email' => 'bengkel@lokalkeun.com',
                'umkm' => 'Service Motor Barokah',
                'cat' => 'jasa',
                'desc' => 'Bengkel motor terpercaya. Ganti oli, tune up, turun mesin, tambal ban.',
                'addr' => 'Jl. Raya Bogor, Depok',
                'phone' => '087811223399', // 12 digit
                'founded' => '2011',
                'banner' => 'https://images.unsplash.com/photo-1619642751034-765dfdf7c58e?w=800&q=80',
                'menus' => [
                    ['Tune Up Ringan', 45000, 'Servis karburator/injeksi.', 'https://images.unsplash.com/photo-1487754180477-01b37d88c344?w=300'],
                    ['Ganti Oli Matic', 55000, 'Oli MPX2 + Jasa.', 'https://images.unsplash.com/photo-1635335499291-7463999e52c6?w=300'],
                ]
            ],
        ];

        // Loop untuk insert data
        foreach ($umkmData as $data) {
            // 1. Buat User
            $user = User::create([
                'name' => $data['owner'],
                'email' => $data['email'],
                'password' => Hash::make('password'),
                'role' => 'penjual',
                'email_verified_at' => now(),
                'profile_photo_path' => null,
            ]);

            // 2. Buat UMKM
            $umkm = Umkm::create([
                'user_id' => $user->id,
                'nama_usaha' => $data['umkm'],
                'slug' => Str::slug($data['umkm']),
                'kategori' => $data['cat'],
                'nama_pemilik' => $data['owner'],
                'deskripsi' => $data['desc'],
                'alamat' => $data['addr'],
                'telepon' => $data['phone'], // Telepon sudah diupdate (08...)
                'tahun_berdiri' => $data['founded'], // Menambahkan Tahun Berdiri
                'status' => 'approved',
                'jam_buka' => '08:00',
                'jam_tutup' => '20:00',
                'rating' => rand(40, 50) / 10,
                'total_reviews' => rand(10, 200),
            ]);

            // 3. Buat Foto Banner
            UmkmPhoto::create([
                'umkm_id' => $umkm->id,
                'photo_path' => $data['banner'],
                'photo_url' => $data['banner'],
                'is_primary' => true,
            ]);

            // 4. Buat Menu
            foreach ($data['menus'] as $menuItem) {
                UmkmMenu::create([
                    'umkm_id' => $umkm->id,
                    'name' => $menuItem[0],
                    'price' => $menuItem[1],
                    'description' => $menuItem[2],
                    'photo_path' => $menuItem[3],
                ]);
            }
        }
    }
}
