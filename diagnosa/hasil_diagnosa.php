<?php
require_once '../inc/koneksi.php'; 
require_once 'certainty_factor.php';

$cf_results = [];
$top_penyakit = null;
$top_cf = 0;
$data = null; 
$cf_keterangan = null;
$gejala_input = []; 

if (isset($_POST['gejala_diagnosa']) && is_array($_POST['gejala_diagnosa'])) {
  $jawaban = [];
  foreach ($_POST['gejala_diagnosa'] as $id => $cf_value) {
    $jawaban[$id] = floatval($cf_value);
  }
  
  $cf_results = calculateCF($conn, $jawaban);
  
  if (!empty($cf_results)) {
    $top_penyakit = key($cf_results);
    $top_cf = reset($cf_results);
    
    $top_penyakit_aman = mysqli_real_escape_string($conn, $top_penyakit);
    $query = "SELECT * FROM penyakit WHERE nama_penyakit = '$top_penyakit_aman'";
    $res = mysqli_query($conn, $query);
    $data = mysqli_fetch_assoc($res);

    $query_cf_ket = "SELECT keterangan, deskripsi_cf FROM cf_keterangan WHERE $top_cf BETWEEN nilai_min AND nilai_max";
    $res_cf_ket = mysqli_query($conn, $query_cf_ket);
    if ($res_cf_ket && mysqli_num_rows($res_cf_ket) > 0) {
      $cf_keterangan = mysqli_fetch_assoc($res_cf_ket);
    }
    
    $gejala_ids = array_keys(array_filter($jawaban, function($cf) { return $cf > 0; }));
    if (!empty($gejala_ids)) {
      $ids_string = "'" . implode("','", $gejala_ids) . "'";
      $query_gejala = "SELECT id_gejala, nama_gejala FROM gejala_diagnosa WHERE id_gejala IN ($ids_string)";
      $res_gejala = mysqli_query($conn, $query_gejala);
      
      while ($row = mysqli_fetch_assoc($res_gejala)) {
        $gejala_input[] = [
          'id' => $row['id_gejala'],
          'nama' => $row['nama_gejala'],
          'cf_user' => $jawaban[$row['id_gejala']] 
        ];
      }
    }
  }
}

$pageTitle = "Hasil Konsultasi"; 
require_once '../inc/header.php';
?>

<section class="container mx-auto px-4 md:px-6 py-12 flex-grow flex items-center justify-center">
     <div class="bg-white p-6 md:p-8 rounded-lg max-w-4xl w-full border border-gray-200">
  
  <?php if ($top_penyakit && $top_cf > 0.01) { ?>
   <div class="overflow-hidden">
    
        <div class="bg-indigo-600 text-white font-medium p-3 text-lg text-center rounded-t-lg">
     Laporan Hasil Konsultasi
    </div>

    <div class="p-4 border-b border-gray-200">
      <h3 class="font-semibold mb-3 text-gray-700 text-base">Gejala Yang Dipilih :</h3>
      
                  <table class="min-w-full divide-y divide-gray-200 border border-gray-100">
        <thead class="bg-gray-50">
          <tr>
            <th class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase">No.</th>
            <th class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase">Kode</th>
            <th class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase">Gejala</th>
            <th class="px-3 py-2 text-center text-xs font-medium text-gray-500 uppercase">CF User</th>
          </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-100">
          <?php foreach ($gejala_input as $index => $gj) { ?>
          <tr class="<?= ($index % 2 == 1) ? 'bg-gray-50' : 'bg-white' ?> hover:bg-indigo-50 transition duration-150">
            <td class="px-3 py-2 whitespace-nowrap text-sm text-gray-600"><?= $index + 1 ?></td>
            <td class="px-3 py-2 whitespace-nowrap text-sm text-gray-800 font-medium"><?= $gj['id'] ?></td>
            <td class="px-3 py-2 text-sm text-gray-800"><?= $gj['nama'] ?></td>
            <td class="px-3 py-2 whitespace-nowrap text-sm text-center text-indigo-700 font-semibold"><?= $gj['cf_user'] ?></td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
    
        <div class="p-4 bg-indigo-50 border-y border-indigo-200">
      <p class="font-bold text-lg text-indigo-800 mb-1">
        Diagnosa Penyakit : <?= $data['nama_penyakit'] ?>
      </p>
      <p class="font-bold text-2xl text-orange-600">
        Tingkat Kepastian : <?= number_format($top_cf * 100, 2) ?>% 
    </div>

        <div class="p-4 text-gray-700 text-sm leading-relaxed border-b border-gray-200">
      <p class="mb-3">
        Deskripsi Penyakit: <?= $data['deskripsi_singkat'] ?>
      </p>
      <p class="font-semibold text-gray-800 mt-3 mb-1">
        Saran Penanganan Awal:
      </p>
      <p class="italic text-gray-600">
        <?= $data['penanganan_awal'] ?>
      </p>
    </div>

   </div>
   
      <div class="text-center mt-6 flex justify-end space-x-4">
     <button class="px-6 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 font-medium transition duration-200">
       CETAK
     </button>
     
     <a href="../konsultasi.php" class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 font-medium transition duration-200">
       Mulai Konsultasi Lain
     </a>
   </div>

  <?php } else { ?>
      <div class="text-center p-8 border border-gray-200 rounded-lg">
          <svg class="w-16 h-16 text-red-500 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
          <h2 class="text-3xl font-light mb-4 text-red-600">Tidak Ada Diagnosa Kuat</h2>
          <p class="text-gray-700 mb-8 text-lg">Sistem tidak dapat menemukan penyakit dengan tingkat keyakinan yang memadai berdasarkan gejala yang Anda masukkan.</p>
          
          <a href="pilih_gejala.php" class="px-8 py-3 bg-indigo-600 text-white font-medium rounded-lg hover:bg-indigo-700 transition duration-300">
              Coba Lagi dengan Gejala Lain
          </a>
      </div>
  <?php } ?>
 </div>
</section>

<?php require_once '../inc/footer.php'; ?>