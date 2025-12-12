<?php
// PATH KE KONEKSI: menggunakan path relatif yang benar (sudah dipindah ke /inc/)
require_once '../inc/koneksi.php'; 

$query = "SELECT * FROM gejala ORDER BY id_gejala";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Error: Tabel 'gejala' tidak ditemukan atau Query Gagal. Pesan MySQL: " . mysqli_error($conn));
}

$pageTitle = "Pertanyaan Adopsi"; 
require_once '../inc/header.php';
?>

<section class="container mx-auto px-4 md:px-6 py-12">
  <div class="bg-white p-6 md:p-10 rounded-xl shadow-2xl max-w-3xl mx-auto border-t-4 border-blue-600">
    <h2 class="text-2xl font-bold mb-8 text-center text-gray-800">📋 Tentukan Hewan Peliharaan Ideal</h2>
    <form method="POST" action="hasil.php">
      <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <div class="mb-5 p-4 border border-gray-200 rounded-lg bg-gray-50 shadow-md transition duration-300 hover:shadow-lg hover:border-blue-300">
          <label class="block text-gray-800 font-semibold mb-3 leading-relaxed"><?= $row['pertanyaan'] ?></label>
          <div class="mt-2 flex space-x-8">
            <label class="inline-flex items-center cursor-pointer">
              <input type="radio" name="gejala[<?= $row['id_gejala'] ?>]" value="<?= $row['id_gejala'] ?>" class="form-radio text-blue-600 h-5 w-5 focus:ring-blue-600" required> 
              <span class="ml-3 text-gray-700 font-medium">Ya</span>
            </label>
            <label class="inline-flex items-center cursor-pointer">
              <input type="radio" name="gejala[<?= $row['id_gejala'] ?>]" value="" class="form-radio text-red-500 h-5 w-5 focus:ring-red-500" required>
              <span class="ml-3 text-gray-700 font-medium">Tidak</span>
            </label>
          </div>
        </div>
      <?php } ?>
      <div class="text-center mt-10">
        <button type="submit" class="px-10 py-3 bg-blue-600 text-white font-semibold text-lg rounded-full shadow-lg hover:bg-blue-700 transition duration-300 transform hover:scale-[1.03]">
          Lihat Hasil Rekomendasi
        </button>
      </div>
    </form>
  </div>
</section>

<?php 
require_once '../inc/footer.php'; 
?>