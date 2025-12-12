<?php
require_once '../inc/koneksi.php';

$query = "SELECT * FROM gejala_diagnosa ORDER BY id_gejala";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Error: Tabel 'gejala_diagnosa' tidak ditemukan atau Query Gagal. Pesan MySQL: " . mysqli_error($conn));
}

$pageTitle = "Diagnosa Penyakit (CF)"; 
require_once '../inc/header.php';
?>

<section class="container mx-auto px-4 md:px-6 pt-24 md:pt-32 pb-12">
    <div class="bg-white p-8 md:p-12 rounded-xl mx-auto border-t-4 border-indigo-500 max-w-5xl">
      <h2 class="text-3xl font-extrabold mb-10 text-center text-gray-800">Diagnosa Penyakit Hewan (Certainty Factor)</h2>
      <form method="POST" action="hasil_diagnosa.php">
        <p class="mb-10 text-lg text-gray-700 text-center">Jawab setiap pertanyaan dengan memilih tingkat keyakinan (CF User) Anda terhadap gejala yang dialami hewan peliharaan:</p>

        <?php $no = 1; while ($row = mysqli_fetch_assoc($result)) { ?>
                    <div class="mb-6 p-6 border border-gray-200 rounded-xl bg-gray-50 flex flex-col sm:flex-row justify-between items-start sm:items-center transition duration-200 hover:border-indigo-400">
               <label class="text-gray-800 text-lg font-medium w-full sm:w-3/4 mb-3 sm:mb-0">
                    <span class="font-bold text-indigo-700 mr-2 text-xl"><?= $no++ ?>.</span>
                    Seberapa yakin Anda bahwa hewan peliharaan menunjukkan gejala **"<?= $row['nama_gejala'] ?>"**?
               </label>

               <select name="gejala_diagnosa[<?= $row['id_gejala'] ?>]" 
                         class="p-2 border border-gray-400 rounded-lg focus:ring-indigo-600 focus:border-indigo-600 transition duration-150 w-full sm:w-1/4" required>
                    <option value="0.0" selected>0.0 - Tidak Ada/Tidak Tahu</option>
                    <option value="0.2">0.2 - Sedikit Yakin (20%)</option>
                    <option value="0.4">0.4 - Agak Yakin (40%)</option>
                    <option value="0.6">0.6 - Cukup Yakin (60%)</option>
                    <option value="0.8">0.8 - Yakin (80%)</option>
                    <option value="1.0">1.0 - Sangat Yakin (100%)</option>
               </select>
          </div>
        <?php } ?>
    
        <div class="text-center mt-10">
                    <button type="submit" class="px-10 py-3 bg-indigo-500 text-white font-semibold text-lg rounded-full hover:bg-indigo-600 transition duration-300">
             Proses Diagnosa CF
          </button>
        </div>
     </form>
   </div>
</section>

<?php require_once '../inc/footer.php'; ?>