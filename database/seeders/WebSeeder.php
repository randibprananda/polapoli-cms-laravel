<?php

namespace Database\Seeders;

use App\Models\Web;
use Illuminate\Database\Seeder;

class WebSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Web::create([
            "id"=>1,
            "seo_keyword"=>"Pola Poli, Politik Gaya Baru",
            "hero_title"=>"Bangun Hubungan Dekat Dengan Konstituen Anda Mulai dari Rp 1 Jutaan",
            "hero_subtitle"=>"Polapoli memahami, menjangkau, dan melibatkan konstituen Anda melalui berbagai platform sosial media dengan tujuan meningkatkan hubungan baik, kepercayaan, mengukur kinerja Anda sebagai wakil rakyat, sehingga dapat Terpilih Kembali pada Pemilihan Umum selanjutnya",
            "layanan_title"=>"Bagaimana PolaPoli membuat anda Lebih Dekat dengan konstituen",
            "solusi_title"=>"Hubungkan semua kanal komunikasi konstituen anda melalui kami",
            "solusi_subtitle"=>"CONNECTION",
            "testimonial_title"=>"Ulasan tentang PolaPoli dari para Klien bahagia kami",
            "about_detail_title"=>"Tentang Kami",
            "about_detail_subtitle"=>"Lorem ipsum dolor sit amet consectetur adipisicing elit. At cupiditate ipsam nobis cumque totam deleniti a odio amet eos, labore et? Placeat, cumque? Modi eaque consequuntur illo blanditiis, accusantium sapiente!",
            "pricing_title"=>"Daftar Paket Harga",
            "pricing_subtitle"=>"Perbedaan harga di bawah ini bergantung kepada jenis paket dan lamanya durasi yang anda pilih",
            "pricing_detail_title"=>"Harga Transparan",
            "pricing_detail_subtitle"=>"Lorem ipsum dolor sit amet consectetur adipisicing elit. At cupiditate ipsam nobis cumque totam deleniti a odio amet eos, labore et? Placeat, cumque? Modi eaque consequuntur illo blanditiis, accusantium sapiente!",
            "faq_title"=>"FAQ",
            "cta_title"=>"Tunggu Apalagi, Daftar Sekarang!",
            "cta_subtitle"=>"Kami selalu membantu Anda Sebagai asisten wakil rakyat digital Anda",
            "footer_desc"=>"Lorem ipsum dolor sit amet consectetur adipisicing elit. At cupiditate ipsam nobis cumque totam deleniti a odio amet eos, labore et? Placeat, cumque? Modi eaque consequuntur illo blanditiis, accusantium sapiente!",
        ]);
    }
}
