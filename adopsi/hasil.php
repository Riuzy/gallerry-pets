<?php
include '../inc/koneksi.php';
include 'forward_chaining.php';

$data = null; 
$id_link = null; 

if (isset($_POST['gejala'])) {
    $jawaban = array_filter($_POST['gejala']);
    $hasil = forwardChaining($conn, $jawaban);

    if ($hasil) {
        $hasil_aman = mysqli_real_escape_string($conn, $hasil); 
        $query = "SELECT * FROM hewan WHERE nama_hewan = '$hasil_aman'";
        $res = mysqli_query($conn, $query);
        $data = mysqli_fetch_assoc($res);

        $query_link = "SELECT id_ras FROM gallery_pets WHERE ras = '$hasil_aman'";
        $res_link = mysqli_query($conn, $query_link);
        $data_link = mysqli_fetch_assoc($res_link);
        $id_link = $data_link['id_ras'] ?? null;
    }
}

$pageTitle = "Hasil Rekomendasi Adopsi"; 
include '../inc/header.php';
?>

<section class="container mx-auto px-4 md:px-6 py-20 flex-grow flex items-center justify-center">
  <div class="bg-white p-8 md:p-12 rounded-2xl shadow-2xl max-w-xl mx-auto text-center border-t-4 border-blue-600">
    
    <?php if (isset($data)) { ?>
      <svg class="w-16 h-16 text-blue-600 mx-auto mb-4 animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
      <h2 class="text-3xl font-bold mb-2 text-blue-600">Selamat! Hewan Ditemukan!</h2>
      <p class="text-4xl font-extrabold text-blue-600 mb-6"><?= $data['nama_hewan'] ?></p>
      
      <div class="mb-8 p-5 bg-blue-50 rounded-lg border border-blue-200">
          <p class="text-gray-700 text-lg italic leading-relaxed"><?= nl2br($data['deskripsi']) ?></p>
      </div>

      <div class="flex flex-col sm:flex-row justify-center space-y-4 sm:space-y-0 sm:space-x-4 mt-8">
          <?php if ($id_link) { ?>
          <a href="../detail.php?id=<?= $id_link ?>" class="w-full sm:w-auto px-8 py-3 bg-blue-600 text-white rounded-full hover:bg-blue-700 font-semibold transition duration-300 shadow-xl transform hover:scale-105">
              Lihat Detail Ras di Gallery
          </a>
          <?php } ?>
          <a href="../konsultasi.php" class="w-full sm:w-auto px-8 py-3 bg-gray-400 text-white rounded-full hover:bg-gray-500 font-semibold transition duration-300">
              Mulai Konsultasi Lain
          </a>
      </div>
      
    <?php } else { ?>
      <svg class="w-16 h-16 text-red-500 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
      <h2 class="text-3xl font-bold mb-4 text-red-600">❌ Tidak Ada Kecocokan Ditemukan</h2>
      <p class="text-gray-700 mb-8 text-lg">Sistem tidak menemukan hewan yang cocok berdasarkan semua jawaban Anda. Coba revisi jawaban atau pertimbangkan kriteria lain.</p>
      
      <a href="pertanyaan.php" class="px-8 py-3 bg-blue-500 text-white font-semibold rounded-full hover:bg-blue-600 transition duration-300 shadow-lg transform hover:scale-105">
          Kembali dan Coba Lagi
      </a>
    <?php } ?>
  </div>
</section>

<?php include '../inc/footer.php'; ?>