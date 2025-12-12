<?php 
session_start();
include 'inc/koneksi.php'; 

$pageTitle = "Welcome to Gallery Pet"; 

// LOGIKA FETCH DATA GALERI
$gallery_result = false;
$error_database = "";

if (isset($conn) && $conn) {
    $gallery_query = "SELECT id_ras, ras, jenis_hewan, image FROM gallery_pets ORDER BY id_ras DESC LIMIT 4";
    $gallery_result = mysqli_query($conn, $gallery_query);
    
    if (!$gallery_result) {
        $error_database = "Error: Tabel 'gallery_pets' tidak ditemukan atau kolom salah. Pesan MySQL: " . mysqli_error($conn);
        $gallery_result = false;
    }
} else {
    $error_database = "Koneksi database GAGAL. Periksa inc/koneksi.php.";
}

include 'inc/header.php'; 
?>

<div>
    
    <section class="w-full relative flex items-center justify-center pt-20 pb-20 md:pt-96 md:pb-80" style="min-height: 450px;">
    <div class="absolute inset-0 z-0">
        <div class="w-full h-full bg-cover bg-center" 
             style="background-image: url('<?= $project_root ?>/assets/logo/homepage_bg.jpg');">
        </div>
        
        <div class="absolute inset-0 bg-black opacity-50"></div> 
    </div>

    <div class="container mx-auto px-4 md:px-6 relative z-20 text-center text-white">
        <div class="max-w-4xl mx-auto">
            <h2 class="text-6xl sm:text-7xl font-extrabold mb-4 leading-tight drop-shadow-xl">
                Sahabat Peliharaan
            </h2>
            <p class="text-xl md:text-2xl mb-12 max-w-4xl mx-auto text-gray-200 drop-shadow-lg">
                Sistem pakar yang membantu Anda menemukan hewan peliharaan ideal dan mendiagnosa penyakit.
            </p>
            
            <a href="konsultasi.php" class="wix-cta-button text-xl">
                Mulai Konsultasi Gratis
            </a>
        </div>
    </div>
</section>

<section class="py-20 md:py-24 bg-white shadow-inner">
        <div class="container mx-auto px-4 md:px-6">
            <div class="text-center mb-12">
                <h3 class="text-3xl font-extrabold text-gray-900">Pets Terbaru Kami</h3>
                <p class="text-lg text-gray-500 mt-2">Lihat koleksi hewan terbaru yang tersedia untuk adopsi.</p>
            </div>

            <?php if (!empty($error_database)) { ?>
                <div class="container mx-auto px-4 md:px-6">
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative text-center mb-6">
                        <strong class="font-bold">Database Error:</strong>
                        <span class="block sm:inline"><?= $error_database ?></span>
                    </div>
                </div>
            <?php } ?>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-6 md:gap-8">
                <?php if ($gallery_result && mysqli_num_rows($gallery_result) > 0) { ?>
                    <?php while ($data = mysqli_fetch_assoc($gallery_result)) { ?>
                        <a href="detail.php?id=<?= $data['id_ras'] ?>" 
                           class="block transition duration-300 group bg-white border border-gray-200 rounded-lg overflow-hidden flex flex-col h-full hover:border-blue-500 hover:shadow-lg">
                            
                            <div class="w-full h-64 md:h-96 bg-gray-100 overflow-hidden border-b border-gray-200">
                                 <img class="w-full h-full object-cover object-center" 
                                     src="<?= $data['image'] ?>" 
                                     alt="<?= $data['ras'] ?>">
                            </div>
                            
                            <div class="p-3 text-center h-20 flex flex-col justify-center">
                                <p class="text-base font-semibold text-gray-900 mb-1 group-hover:text-blue-600 transition truncate whitespace-nowrap">
                                    <?= $data['ras'] ?>
                                </p>
                                <p class="text-sm text-gray-500">
                                    <?= $data['jenis_hewan'] ?>
                                </p>
                            </div>
                        </a>
                    <?php } ?>
                <?php } else { ?>
                    <div class="col-span-4 text-center p-5 bg-gray-100 rounded-lg">
                        <p class="text-gray-500">Belum ada data hewan di galeri.</p>
                    </div>
                <?php } ?>
            </div>
            
            <div class="text-center mt-10">
                <a href="gallery.php" class="wix2-cta-button text-xl">
                    Lihat Semua Galeri
                </a>
            </div>
        </div>
    </section>


<section class="py-20 bg-gray-100">
    <div class="w-full mx-auto px-6">

        <div class="text-center mb-12">
            <h3 class="text-3xl font-extrabold text-gray-900">Pilih Layanan Konsultasi Anda</h3>
            <p class="text-lg text-gray-600 mt-2">
                Kami menyediakan dua sistem pakar untuk kebutuhan Anda.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 md:gap-10 max-w-5xl mx-auto">
            
            <div class="bg-white w-full p-8 md:p-10 rounded-xl shadow-lg border border-gray-300 
                        text-center transition duration-300 hover:border-blue-500 hover:shadow-xl
                        min-h-[400px] flex flex-col justify-between">
                
                <div>
                    <i class="fas fa-paw text-6xl text-blue-600 mb-6"></i>
                    <h4 class="text-2xl font-bold text-gray-900 mb-3">Penentuan Hewan Ideal</h4>
                    <p class="text-gray-600 mb-8 text-base">
                        Memilih hewan peliharaan adalah komitmen jangka panjang yang membutuhkan kecocokan sempurna. Sistem pakar ini dirancang untuk memandu Anda melalui proses penentuan hewan ideal berdasarkan detail gaya hidup, lingkungan tempat tinggal, dan preferensi pribadi Anda.
                    </p>
                </div>

                <a href="adopsi/pertanyaan.php" 
                   class="px-8 py-3 wix2-cta-button text-xl">
                    Mulai Tes Adopsi
                </a>
            </div>

            <div class="bg-white w-full p-8 md:p-10 rounded-xl shadow-lg border border-gray-300 
                        text-center transition duration-300 hover:border-indigo-500 hover:shadow-xl
                        min-h-[400px] flex flex-col justify-between">
                
                <div>
                    <i class="fas fa-microscope text-6xl text-indigo-600 mb-6"></i>
                    <h4 class="text-2xl font-bold text-gray-900 mb-3">Diagnosa Penyakit (CF)</h4>
                    <p class="text-gray-600 mb-8 text-base">
                        Kesehatan hewan peliharaan Anda adalah prioritas. Fitur Diagnosa Penyakit kami menyediakan alat bantu yang cepat dan terpercaya untuk membantu Anda mengidentifikasi potensi masalah kesehatan berdasarkan gejala yang Anda amati.
                    </p>
                </div>

                <a href="diagnosa/diagnosa.php" 
                   class="px-8 py-3 wix2-cta-button text-xl">
                    Mulai Diagnosis
                </a>
            </div>
        </div>
    </div>
</section>
</div>

<?php include 'inc/footer.php'; ?>