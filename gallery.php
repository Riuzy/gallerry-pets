<?php
include 'inc/koneksi.php';

$pageTitle = "Pet Gallery List";

// --- Ambil filter dari URL ---
$filterJenis = $_GET['jenis'] ?? 'all';
$filterQuery = ($filterJenis != 'all') ? "WHERE jenis_hewan = '" . mysqli_real_escape_string($conn, $filterJenis) . "'" : "";

// --- Query Utama ---
$query = "SELECT id_ras, ras, jenis_hewan, image FROM gallery_pets $filterQuery ORDER BY id_ras ASC";
$result = mysqli_query($conn, $query);

$jenisQuery = "SELECT DISTINCT jenis_hewan FROM gallery_pets ORDER BY jenis_hewan";
$jenisResult = mysqli_query($conn, $jenisQuery);

if (!$jenisResult) { die("Query Filter GAGAL: " . mysqli_error($conn)); }

include 'inc/header.php';
?>

<section class="container mx-auto px-4 md:px-6 pt-24 md:pt-32 py-10">
    <h2 class="text-3xl font-bold text-center text-gray-800 mb-2">Pet Gallery 🐾</h2>
    <p class="text-center text-gray-600 mb-10">Temukan berbagai ras hewan peliharaan favorit Anda.</p>

    <div class="flex justify-center mb-12">
        <form method="GET" action="gallery.php" class="flex flex-col sm:flex-row items-center space-y-3 sm:space-y-0 sm:space-x-4 bg-white p-4 rounded-xl border border-gray-200">
            <label for="filterJenis" class="font-semibold text-gray-700">Filter Jenis Hewan:</label>
            <select name="jenis" id="filterJenis" onchange="this.form.submit()" 
                    class="p-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 transition duration-150 w-full sm:w-auto text-gray-700 appearance-none bg-white">
                <option value="all" <?= ($filterJenis == 'all') ? 'selected' : '' ?>>Semua Jenis</option>
                <?php while ($row = mysqli_fetch_assoc($jenisResult)) { ?>
                    <option value="<?= $row['jenis_hewan'] ?>" 
                            <?= ($filterJenis == $row['jenis_hewan']) ? 'selected' : '' ?>>
                        <?= $row['jenis_hewan'] ?>
                    </option>
                <?php } ?>
            </select>
        </form>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 md:gap-8">
        <?php 
        if (mysqli_num_rows($result) > 0) {
            while ($p = mysqli_fetch_assoc($result)) { 
                $link_id = $p['id_ras']; 
                $img_path = $p['image'] ?: 'assets/img/default.jpg';
        ?>
            <a href="detail.php?id=<?= $link_id ?>" 
               class="block transition duration-300 group bg-white border border-gray-200 rounded-lg overflow-hidden hover:border-blue-500 hover:shadow-lg">
                
                <div class="w-full h-64 sm:h-80 lg:h-96 bg-gray-100 overflow-hidden border-b border-gray-200">
                     <img class="w-full h-full object-cover object-center" 
                         src="<?= $img_path ?>" 
                         alt="<?= $p['ras'] ?>">
                </div>
                
                <div class="p-3 text-center h-20 flex flex-col justify-center">
                    <p class="text-base font-semibold text-gray-900 mb-1 group-hover:text-blue-600 transition truncate whitespace-nowrap">
                        <?= $p['ras'] ?>
                    </p>
                    <p class="text-sm text-gray-500">
                        <?= $p['jenis_hewan'] ?>
                    </p>
                </div>
            </a>
        <?php 
            }
        } else {
            echo "<p class='col-span-full text-center text-gray-500 text-lg py-10'>Tidak ada hewan yang ditemukan sesuai filter. Pastikan tabel gallery_pets terisi.</p>";
        }
        ?>
    </div>
</section>

<?php include 'inc/footer.php'; ?>