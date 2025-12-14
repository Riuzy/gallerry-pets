<?php
require_once '../inc/koneksi.php';

// --- BAGIAN LOGIKA FILTER GEJALA ---

$gejala_terpilih = $_POST['gejala_terpilih'] ?? [];
$result = false;
$error_message = null;

if (empty($gejala_terpilih) || !is_array($gejala_terpilih)) {
  $error_message = "Anda belum memilih gejala apapun di Langkah 1. Silakan kembali dan pilih gejala yang relevan.";
} else {
  
  // Memproses ID sebagai STRING karena ID Gejala Anda adalah string (e.g. XGH01)
  $safe_gejala_ids = array_map(function($id) use ($conn) {
    // Escape string dan tambahkan quotes untuk SQL: 'XGH01', 'XGH02'
    return "'" . mysqli_real_escape_string($conn, $id) . "'";
  }, $gejala_terpilih);

  $in_clause = implode(',', $safe_gejala_ids);

  // Query HANYA gejala yang dipilih
  $query = "SELECT id_gejala, nama_gejala FROM gejala_diagnosa 
       WHERE id_gejala IN ($in_clause) 
       ORDER BY FIELD(id_gejala, $in_clause)";
       
  $result = mysqli_query($conn, $query);

  if (!$result) {
    $error_message = "SQL ERROR! Periksa koneksi dan query: " . mysqli_error($conn) . ". Query yang gagal: " . $query;
  }
}

$pageTitle = "2. Tentukan Keyakinan CF"; 
require_once '../inc/header.php';
?>

<section class="container mx-auto px-4 md:px-6 pt-24 md:pt-32 pb-12">
      <div class="bg-white p-8 md:p-12 rounded-lg mx-auto border-t-4 border-indigo-600 max-w-5xl">
    <h2 class="text-3xl font-light mb-2 text-center text-gray-800">Langkah 2: **Tentukan Keyakinan (CF)**</h2>
    <p class="mb-8 text-lg text-gray-600 text-center">Masukkan tingkat keyakinan (CF User) Anda terhadap gejala yang sudah dipilih.</p>
  
  <?php if (isset($error_message)) { ?>
        <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg text-center border border-red-400" role="alert">
      <strong class="font-bold">Error:</strong> <?= $error_message ?>
      <div class="text-center mt-6">
        <a href="pilih_gejala.php" class="px-8 py-2 bg-gray-400 text-white font-medium rounded-full hover:bg-gray-500 transition duration-300">Kembali ke Pemilihan Gejala</a>
      </div>
    </div>
  <?php } else { ?>
    
    <form method="POST" action="hasil_diagnosa.php">
            
            <div class="hidden sm:flex bg-gray-100 border-b border-gray-300 rounded-t-lg font-semibold text-gray-700 text-sm">
                <div class="w-1/12 px-4 py-3 text-left">No.</div>
                <div class="w-8/12 px-4 py-3 text-left">Gejala yang Diamati</div>
                <div class="w-3/12 px-4 py-3 text-center">Tingkat Keyakinan (CF)</div>
            </div>

                  <?php $no = 1; 
        if ($result && mysqli_num_rows($result) > 0) {
          while ($row = mysqli_fetch_assoc($result)) { 
                        $is_odd = ($no % 2 != 0); // Untuk striped row
            ?>
                                  <div class="flex flex-wrap sm:flex-nowrap items-center border-b border-gray-200 p-3 sm:p-0 
                            <?= $is_odd ? 'bg-gray-50' : 'bg-white' ?> 
                            hover:bg-indigo-50 transition duration-150">
                            
                            <div class="hidden sm:block w-1/12 px-4 py-3 text-sm text-gray-600 font-medium">
                                <?= $no++ ?>.
                            </div>

                            <div class="w-full sm:w-8/12 px-4 py-3 text-base text-gray-800 font-medium">
                                <span class="block sm:hidden text-sm font-semibold text-indigo-700 mb-1"><?= $no-1 ?>. Gejala:</span>
                                Seberapa yakin Anda bahwa hewan menunjukkan gejala **"<?= $row['nama_gejala'] ?>"**?
                            </div>

                            <div class="w-full sm:w-3/12 px-4 py-3 text-center">
                                <label for="cf_<?= $row['id_gejala'] ?>" class="block sm:hidden text-sm font-medium text-gray-700 mb-1">Tingkat Keyakinan (CF):</label>
                                <select id="cf_<?= $row['id_gejala'] ?>"
                  name="gejala_diagnosa[<?= $row['id_gejala'] ?>]" 
                  class="p-2 border border-gray-400 rounded-lg focus:border-indigo-600 transition duration-150 w-full bg-white text-sm" required>
                  <option value="0.0" selected>Tidak Ada/Tidak Tahu</option>
                  <option value="0.2"> Sedikit Yakin</option>
                  <option value="0.4"> Agak Yakin</option>
                  <option value="0.6"> Cukup Yakin</option>
                  <option value="0.8"> Yakin</option>
                  <option value="1.0"> Sangat Yakin</option>
                </select>
                            </div>
          </div>
      <?php } 
        } else { ?>
          <div class="p-4 mb-4 text-sm text-yellow-700 bg-yellow-100 rounded-lg text-center border border-yellow-400" role="alert">
            Tidak ada gejala yang ditemukan untuk ID yang dipilih.
          </div>
        <?php } ?>
   
      <div class="text-center mt-10">
       <button type="submit" class="wix2-cta-button">
        Proses Diagnosa CF
       </button>
      </div>
     </form>
  <?php } ?>
  </div>
</section>

<?php require_once '../inc/footer.php'; ?>