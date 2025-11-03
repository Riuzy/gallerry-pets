// File: js/gallery.js

document.addEventListener('DOMContentLoaded', () => {
    // VARIABEL GLOBAL 'pet' SEKARANG DIAMBIL DARI js/variables.js

    const galleryContainer = document.getElementById("galleryContainer");
    const filterJenis = document.getElementById("filterJenis");

    // Periksa apakah array 'pet' telah didefinisikan oleh variables.js
    if (typeof pet === 'undefined') {
        console.error("ERROR: Array 'pet' tidak ditemukan. Periksa kembali urutan script di gallery.html.");
        return; 
    }

    function renderGallery(petsToRender) {
        galleryContainer.innerHTML = "";
        if (petsToRender.length === 0) {
            galleryContainer.innerHTML = "<p class='no-results'>Tidak ada hewan yang ditemukan sesuai filter.</p>";
            return;
        }
        
        petsToRender.forEach(p => {
            galleryContainer.innerHTML += `
                <div class="pet-card" onclick="goDetail('${p.id}')">
                    <img src="${p.image}" alt="${p.ras}">
                    <h4>${p.ras}</h4>
                    <p>${p.jenis_hewan}</p>
                </div>
            `;
        });
    }

    function populateFilters() {
        // Logika ini yang mengisi dropdown dengan kategori unik
        const uniqueJenis = [...new Set(pet.map(p => p.jenis_hewan))].sort();

        // Pastikan opsi 'Semua Jenis' tidak terhapus (sudah ada di HTML)
        
        // Mengisi filter Jenis Hewan dengan kategori unik (Anjing, Kucing, dll.)
        uniqueJenis.forEach(jenis => {
            filterJenis.innerHTML += `<option value="${jenis}">${jenis}</option>`;
        });
    }

    function filterGallery() {
        const selectedJenis = filterJenis.value;
        
        const filteredPets = pet.filter(p => {
            const matchesJenis = selectedJenis === "all" || p.jenis_hewan === selectedJenis;
            return matchesJenis;
        });

        renderGallery(filteredPets);
    }

    // Tambahkan event listener dan inisialisasi
    filterJenis.addEventListener("change", filterGallery);
    
    populateFilters();
    filterGallery(); 

    // Fungsi Navigasi (harus diakses global dari HTML)
    window.goDetail = function(id) {
        window.location.href = `detail.html?id=${id}`;
    }

    // Logika Menu Mobile (di luar DOMContentLoaded jika ada di file terpisah)
    const menuBtn = document.getElementById("menuBtn");
    const navLinks = document.querySelector(".nav-links");

    if (menuBtn && navLinks) {
        menuBtn.addEventListener("click", () => {
            navLinks.classList.toggle("active");
            menuBtn.classList.toggle("open");
        });
    }
});