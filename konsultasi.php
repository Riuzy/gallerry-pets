<?php $pageTitle = "Mulai Konsultasi"; include 'inc/header.php'; ?>

<section class="py-32 bg-gray-100">
    <div class="w-full mx-auto px-6">

        <div class="text-center mb-12">
            <h3 class="text-3xl font-extrabold text-gray-900">Pilih Layanan Konsultasi Anda</h3>
            <p class="text-lg text-gray-600 mt-2">
                Kami menyediakan dua sistem pakar untuk kebutuhan Anda.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 md:gap-10 max-w-5xl mx-auto">
            
            <div class="bg-white w-full p-8 md:p-10 rounded-xl shadow-lg border border-gray-300 
                        text-center transition duration-300 hover:border-blue-500 hover:shadow-xl
                        min-h-[400px] flex flex-col justify-between">
                
                <div>
                    <i class="fas fa-paw text-6xl text-blue-600 mb-6"></i>
                    <h4 class="text-2xl font-bold text-gray-900 mb-3">Penentuan Hewan Ideal</h4>
                    <p class="text-gray-600 mb-8 text-base">
                        Memilih hewan peliharaan adalah komitmen jangka panjang yang membutuhkan kecocokan sempurna. Sistem pakar ini dirancang untuk memandu Anda melalui proses penentuan hewan ideal berdasarkan detail gaya hidup, lingkungan tempat tinggal, dan preferensi pribadi Anda.
                    </p>
                </div>

                <a href="adopsi/pertanyaan.php" 
                   class="px-8 py-3 wix2-cta-button text-xl">
                    Mulai Tes Adopsi
                </a>
            </div>

            <div class="bg-white w-full p-8 md:p-10 rounded-xl shadow-lg border border-gray-300 
                        text-center transition duration-300 hover:border-indigo-500 hover:shadow-xl
                        min-h-[400px] flex flex-col justify-between">
                
                <div>
                    <i class="fas fa-microscope text-6xl text-indigo-600 mb-6"></i>
                    <h4 class="text-2xl font-bold text-gray-900 mb-3">Diagnosa Penyakit (CF)</h4>
                    <p class="text-gray-600 mb-8 text-base">
                        Kesehatan hewan peliharaan Anda adalah prioritas. Fitur Diagnosa Penyakit kami menyediakan alat bantu yang cepat dan terpercaya untuk membantu Anda mengidentifikasi potensi masalah kesehatan berdasarkan gejala yang Anda amati.
                    </p>
                </div>

                <a href="diagnosa/pilih_gejala.php" 
                   class="px-8 py-3 wix2-cta-button text-xl">
                    Mulai Diagnosis
                </a>
            </div>
        </div>
    </div>
</section>

<?php include 'inc/footer.php'; ?>