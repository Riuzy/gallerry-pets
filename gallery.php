<?php
include 'inc/koneksi.php';

$pageTitle = "Pet Gallery List";

$filterJenis = $_GET['jenis'] ?? 'all';
$searchTerm = $_GET['search'] ?? '';
$sortOrder = $_GET['sort'] ?? 'asc';


$whereClauses = [];

if ($filterJenis !== 'all') {
    $whereClauses[] = "jenis_hewan = '" . mysqli_real_escape_string($conn, $filterJenis) . "'";
}

// Search Term (Pencarian berdasarkan nama ras)
if (!empty($searchTerm)) {
    $safeSearch = mysqli_real_escape_string($conn, $searchTerm);
    $whereClauses[] = "ras LIKE '%$safeSearch%'";
}

$finalWhereClause = !empty($whereClauses) ? " WHERE " . implode(" AND ", $whereClauses) : "";

// --- 3. TENTUKAN URUTAN (SORT) ---
$orderBy = "ORDER BY ras " . (strtolower($sortOrder) === 'desc' ? 'DESC' : 'ASC');


// --- 4. EKSEKUSI QUERY UTAMA ---
$query = "SELECT id_ras, ras, jenis_hewan, image FROM gallery_pets $finalWhereClause $orderBy";
$result = mysqli_query($conn, $query);

// Query untuk filter jenis hewan (tetap sama)
$jenisQuery = "SELECT DISTINCT jenis_hewan FROM gallery_pets ORDER BY jenis_hewan";
$jenisResult = mysqli_query($conn, $jenisQuery);

if (!$jenisResult) { die("Query Filter GAGAL: " . mysqli_error($conn)); }

// Fungsi untuk mempertahankan parameter GET saat mengganti sort/filter
function getQueryString(array $excludeKeys = []) {
    $params = $_GET;
    foreach ($excludeKeys as $key) {
        unset($params[$key]);
    }
    return http_build_query($params);
}

include 'inc/header.php';
?>

<section class="container mx-auto px-4 md:px-6 pt-24 md:pt-32 py-10">
  <h2 class="text-3xl font-extrabold text-center text-gray-800 mb-2">Pet Gallery</h2>
  <p class="text-center text-gray-600 mb-10">Temukan berbagai ras hewan peliharaan favorit Anda.</p>

    <div class="flex justify-center mb-12">
    <form method="GET" action="gallery.php" class="flex flex-col lg:flex-row items-center space-y-3 lg:space-y-0 lg:space-x-4 bg-white p-4 rounded-lg border border-gray-300 w-full max-w-5xl">
            
            <input type="hidden" name="jenis" value="<?= htmlspecialchars($filterJenis) ?>">
            <input type="hidden" name="sort" value="<?= htmlspecialchars($sortOrder) ?>">

            <div class="w-full lg:w-1/3 relative">
                <input type="text" name="search" placeholder="Cari berdasarkan nama Ras..." value="<?= htmlspecialchars($searchTerm) ?>"
                       class="p-2 pl-10 border border-gray-300 rounded-lg w-full focus:border-indigo-500 transition duration-150 text-gray-700">
                <svg class="absolute left-3 top-3 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            </div>
            
            <div class="w-full lg:w-1/3">
                <select name="jenis" onchange="this.form.submit()" 
          class="p-2 border border-gray-300 rounded-lg w-full focus:border-indigo-500 transition duration-150 text-gray-700 bg-white">
          <option value="all">Semua Jenis</option>
          <?php 
                    // Reset pointer jenisResult untuk memastikan loop berjalan
                    mysqli_data_seek($jenisResult, 0); 
                    while ($row = mysqli_fetch_assoc($jenisResult)) { ?>
            <option value="<?= htmlspecialchars($row['jenis_hewan']) ?>" 
                <?= ($filterJenis == $row['jenis_hewan']) ? 'selected' : '' ?>>
              Filter: <?= htmlspecialchars($row['jenis_hewan']) ?>
            </option>
          <?php } ?>
        </select>
            </div>

            <div class="w-full lg:w-1/4">
                <select name="sort" onchange="this.form.submit()" 
          class="p-2 border border-gray-300 rounded-lg w-full focus:border-indigo-500 transition duration-150 text-gray-700 bg-white">
          <option value="asc" <?= (strtolower($sortOrder) == 'asc') ? 'selected' : '' ?>>Urutkan: A - Z</option>
          <option value="desc" <?= (strtolower($sortOrder) == 'desc') ? 'selected' : '' ?>>Urutkan: Z - A</option>
        </select>
            </div>
            
            <button type="submit" class="w-full lg:w-auto px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition duration-150 font-medium">
                Cari
            </button>
            
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
       class="block transition duration-300 group bg-white border border-gray-200 rounded-lg overflow-hidden hover:border-indigo-500">
        
        <div class="w-full h-64 sm:h-80 lg:h-96 bg-gray-100 overflow-hidden border-b border-gray-200">
          <img class="w-full h-full object-cover object-center" 
            src="<?= $img_path ?>" 
            alt="<?= $p['ras'] ?>">
        </div>
        
        <div class="p-3 text-center h-20 flex flex-col justify-center">
          <p class="text-base font-semibold text-gray-900 mb-1 group-hover:text-indigo-600 transition truncate whitespace-nowrap">
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
      echo "<p class='col-span-full text-center text-gray-500 text-lg py-10'>Tidak ada hewan yang ditemukan sesuai kriteria.</p>";
    }
    ?>
  </div>
</section>

<?php include 'inc/footer.php'; ?>