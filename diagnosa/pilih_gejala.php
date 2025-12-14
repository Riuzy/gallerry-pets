<?php
require_once '../inc/koneksi.php';

$query = "SELECT id_gejala, nama_gejala FROM gejala_diagnosa ORDER BY id_gejala";
$result = mysqli_query($conn, $query);

if (!$result) {
    $error_message = "Error: Tabel 'gejala_diagnosa' tidak ditemukan atau Query Gagal. Pesan MySQL: " . mysqli_error($conn);
}

$pageTitle = "1. Pilih Gejala"; 
require_once '../inc/header.php';
?>

<section class="container mx-auto px-4 md:px-6 pt-24 md:pt-32 pb-12">
    <div class="max-w-6xl mx-auto">
        <h2 class="text-3xl font-extrabold mb-2 text-center text-gray-800">IDENTIFIKASI GEJALA</h2>
        <p class="mb-10 text-lg text-gray-600 text-center">Pilih semua gejala yang dialami hewan Anda. Anda akan menentukan tingkat keyakinan (CF) di langkah berikutnya.</p>

        <?php if (isset($error_message)) { /* ... Error handling ... */ } else { ?>

            <form method="POST" action="diagnosa_cf.php"> 
                
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">

                    <?php $no = 1; while ($row = mysqli_fetch_assoc($result)) { 
                        $input_id = "gejala_" . $row['id_gejala'];
                    ?>
                        <div class="p-4 border border-gray-300 rounded-lg flex justify-start items-center space-x-4 
                                    cursor-pointer transition-all duration-200 bg-white
                                    hover:border-indigo-400 hover:bg-indigo-50 
                                    has-[:checked]:border-indigo-600 has-[:checked]:bg-indigo-100/70">
                            
                            <input type="checkbox" 
                                   id="<?= $input_id ?>" 
                                   name="gejala_terpilih[]" 
                                   value="<?= $row['id_gejala'] ?>" 
                                   class="w-5 h-5 text-indigo-600 bg-gray-100 border-gray-300 rounded focus:ring-indigo-500 flex-shrink-0">
                            
                            <label for="<?= $input_id ?>" 
                                   class="text-left flex-grow cursor-pointer py-1">
                                <p class="text-xs font-medium text-gray-500 mb-0.5"><?= $row['id_gejala'] ?></p>
                                <h3 class="text-base font-medium text-gray-900">
                                    <?= $row['nama_gejala'] ?>
                                </h3>
                            </label>
                            
                        </div>
                    <?php } ?>
                </div>
                <div class="text-center mt-12">
                    <button type="submit" class="wix2-cta-button">
                        Lanjut ke Tingkat Keyakinan (CF) →
                    </button>
                </div>
            </form>
        <?php } ?>
    </div>
</section>

<?php require_once '../inc/footer.php'; ?>