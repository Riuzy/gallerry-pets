</main>
<footer class="bg-gray-800 text-white pt-10 pb-6 mt-auto">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8 border-b border-gray-700 pb-8">
            
            <div>
                <div class="flex items-center space-x-3 mb-3">
                    <img src="<?= $project_root ?>/assets/logo/logo.png" alt="Logo" class="w-8 h-8 rounded-full">
                    <h5 class="text-xl font-bold">Gallery<span class="text-blue-400">Pet</span></h5>
                </div>
                <p class="text-gray-400 text-sm max-w-xs">
                    Platform sistem pakar yang membantu Anda menemukan hewan peliharaan ideal dan mendiagnosa penyakit.
                </p>
                <div class="flex space-x-3 mt-4">
                    <a href="#" class="text-gray-400 hover:text-blue-400"><i class="fab fa-facebook"></i></a>
                    <a href="#" class="text-gray-400 hover:text-blue-400"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="text-gray-400 hover:text-blue-400"><i class="fab fa-instagram"></i></a>
                </div>
            </div>

            <div>
                <h6 class="text-lg font-semibold text-white mb-3">Produk</h6>
                <ul class="space-y-2 text-sm">
                    <li><a href="<?= $project_root ?>/gallery.php" class="text-gray-400 hover:text-white">Galeri Pets</a></li>
                    <li><a href="<?= $project_root ?>/konsultasi.php" class="text-gray-400 hover:text-white">Sistem Konsultasi</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-white">Pricing (Placeholder)</a></li>
                </ul>
            </div>

            <div>
                <h6 class="text-lg font-semibold text-white mb-3">Perusahaan</h6>
                <ul class="space-y-2 text-sm">
                    <li><a href="#" class="text-gray-400 hover:text-white">Tentang Kami</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-white">Karir</a></li>
                    <li><a href="<?= $project_root ?>/admin/index.php" class="text-gray-400 hover:text-white">Akses Admin</a></li>
                </ul>
            </div>

            <div>
                <h6 class="text-lg font-semibold text-white mb-3">Dukungan</h6>
                <ul class="space-y-2 text-sm">
                    <li><a href="#" class="text-gray-400 hover:text-white">FAQ</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-white">Kontak</a></li>
                    <li><a href="https://discord.gg/z8VjdAY2" class="text-gray-400 hover:text-white">Bergabung Discord</a></li>
                </ul>
            </div>
        </div>

        <div class="mt-6 flex flex-col md:flex-row justify-between items-center text-sm text-gray-500">
            <p>&copy; 2025 Gallery Pet. All rights reserved.</p>
            <div class="md:space-x-4 mt-3 md:mt-0">
                <a href="#" class="hover:text-white">Privacy Policy</a>
                <a href="#" class="hover:text-white">Terms</a>
            </div>
        </div>
    </div>
</footer>

<script src="<?= $project_root ?>/js/main.js"></script>

</body>
</html>