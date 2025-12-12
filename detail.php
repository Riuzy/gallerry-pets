<?php
include 'inc/koneksi.php';

$id_ras = $_GET['id'] ?? null;
$petData = null;

if ($id_ras) {
    $id_aman = mysqli_real_escape_string($conn, $id_ras);
    $query = "SELECT * FROM gallery_pets WHERE id_ras = '$id_aman'";
    $result = mysqli_query($conn, $query);
    $petData = mysqli_fetch_assoc($result);
}

$pageTitle = $petData ? "Detail: " . $petData['ras'] : "Detail Hewan";
include 'inc/header.php';
?>

<section class="container mx-auto px-4 md:px-6 py-12">
    <?php if ($petData) { ?>
        <div class="bg-white p-8 md:p-12 rounded-xl shadow-2xl flex flex-col lg:flex-row gap-8 lg:gap-12 max-w-6xl mx-auto border border-gray-100">
            
            <div class="lg:w-1/3 flex-shrink-0">
                <img src="<?= $petData['image'] ?? 'assets/img/default.jpg' ?>" 
                     alt="<?= $petData['ras'] ?>" 
                     class="w-full h-64 md:h-96 object-cover rounded-xl shadow-xl border-4 border-gray-100">
            </div>
            
            <div class="lg:w-2/3">
                <h2 class="text-3xl md:text-4xl font-extrabold text-blue-700 mb-4 border-b-2 border-gray-100 pb-3"><?= $petData['ras'] ?></h2>
                
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-6">
                    <?php 
                    $details = [
                        'Jenis Hewan' => $petData['jenis_hewan'],
                        'Ras' => $petData['ras'], 
                        'Asal' => $petData['asal'],
                        'Karakter' => $petData['karakter']
                    ];
                    foreach ($details as $label => $value) {
                    ?>
                    <div class="bg-blue-50 p-3 rounded-lg border border-blue-200">
                        <strong class="text-blue-900 text-sm block"><?= $label ?></strong>
                        <span class="text-gray-700 font-medium"><?= $value ?></span>
                    </div>
                    <?php } ?>
                </div>

                <div class="mt-6">
                    <h3 class="text-xl font-bold text-gray-800 mb-3">Deskripsi Lengkap:</h3>
                    <div class="text-gray-700 bg-gray-50 p-4 rounded-lg border border-gray-200 shadow-inner h-40 overflow-y-auto custom-scrollbar">
                        <?= nl2br($petData['deskripsi_lengkap']) ?>
                    </div>
                </div>

                <a href="gallery.php" class="mt-8 inline-flex items-center space-x-2 px-6 py-3 bg-gray-800 text-white rounded-full hover:bg-gray-900 transition duration-300 shadow-md">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M9.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L7.414 9H15a1 1 0 110 2H7.414l2.293 2.293a1 1 0 010 1.414z" clip-rule="evenodd" /></svg>
                    <span>Kembali ke Galeri</span>
                </a>
            </div>
        </div>
    <?php } else { ?>
        <div class="text-center py-20 bg-white rounded-xl shadow-lg border border-gray-100 max-w-xl mx-auto">
            <h2 class="text-3xl text-red-500 font-bold mb-4">Data Hewan Tidak Ditemukan</h2>
            <a href="gallery.php" class="text-blue-500 hover:text-blue-700 font-medium transition duration-150">Kembali ke Galeri</a>
        </div>
    <?php } ?>
</section>

<?php include 'inc/footer.php'; ?>