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

<section class="container mx-auto px-4 md:px-6 py-32">
  <?php if ($petData) { ?>
        <div class="bg-white p-8 md:p-10 rounded-lg flex flex-col lg:flex-row gap-8 lg:gap-12 max-w-6xl mx-auto border border-gray-200">
      
            <div class="lg:w-1/3 flex-shrink-0">
                <img src="<?= $petData['image'] ?? 'assets/img/default.jpg' ?>" 
          alt="<?= $petData['ras'] ?>" 
          class="w-full h-64 md:h-96 object-cover rounded-lg border-4 border-indigo-100">
      </div>
      
            <div class="lg:w-2/3">
        <h2 class="text-3xl md:text-4xl font-semibold text-gray-800 mb-6 border-b border-gray-200 pb-3"><?= $petData['ras'] ?></h2>
        
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-8">
          <?php 
          $details = [
            'Jenis Hewan' => $petData['jenis_hewan'],
            'Ras' => $petData['ras'], 
            'Asal' => $petData['asal'],
            'Karakter' => $petData['karakter']
          ];
          foreach ($details as $label => $value) {
          ?>
                    <div class="bg-gray-50 p-3 rounded-lg border border-gray-200">
            <strong class="text-indigo-600 text-sm block"><?= $label ?></strong>
            <span class="text-gray-800 font-medium"><?= $value ?></span>
          </div>
          <?php } ?>
        </div>

                <div class="mt-4">
          <h3 class="text-xl font-semibold text-gray-800 mb-3 border-b border-gray-200 pb-2">Deskripsi Lengkap</h3>
          <div class="text-gray-700 bg-gray-50 p-4 rounded-lg border border-gray-200 h-40 overflow-y-auto custom-scrollbar">
            <?= nl2br($petData['deskripsi_lengkap']) ?>
          </div>
        </div>

                <div class="mt-8 flex justify-end">
                    <a href="gallery.php" 
                       class="inline-flex items-center justify-center space-x-2 
                              px-8 py-3 
                              bg-white text-blue-600 
                              rounded-lg border-2 border-blue-600 
                              hover:bg-blue-50 transition duration-300 
                              font-medium text-lg">
                        
                        <span>Kembali ke Galeri</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10.293 15.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L7.414 9H15a1 1 0 110 2H7.414l2.879 2.879a1 1 0 010 1.414z" clip-rule="evenodd" /></svg>
                    </a>
                </div>

      </div>
    </div>
  <?php } else { ?>
    <div class="text-center py-20 bg-white rounded-lg border border-gray-200 max-w-xl mx-auto">
      <h2 class="text-3xl text-red-500 font-semibold mb-4">Data Hewan Tidak Ditemukan</h2>
      <a href="gallery.php" class="text-indigo-600 hover:text-indigo-800 font-medium transition duration-150">Kembali ke Galeri</a>
    </div>
  <?php } ?>
</section>

<?php include 'inc/footer.php'; ?>