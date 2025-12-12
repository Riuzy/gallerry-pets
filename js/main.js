document.addEventListener('DOMContentLoaded', () => {
    // 1. Logic untuk Menu Toggle Mobile (Icon SVG)
    const menuToggle = document.getElementById('menu-toggle');
    const menuLinks = document.getElementById('menu-links');
    const iconOpen = document.getElementById('icon-menu-open');
    const iconClose = document.getElementById('icon-menu-close');

    if (menuToggle && menuLinks) {
        menuToggle.addEventListener('click', () => {
            // Mengubah display dari hidden menjadi flex
            menuLinks.classList.toggle('hidden'); 
            menuLinks.classList.toggle('flex');
            
            // Mengganti icon X dan Hamburger
            iconOpen.classList.toggle('hidden');
            iconClose.classList.toggle('hidden');
        });
    }

    // 2. Logic untuk Animasi Hover Kartu Galeri (Menggunakan Class Sederhana)
    const petCards = document.querySelectorAll('.pet-card-animation');

    petCards.forEach(card => {
        // Menggunakan event mouseenter dan mouseleave untuk menambahkan class hover
        card.addEventListener('mouseenter', () => {
            // Ganti class ini untuk efek lift yang terlihat
            card.classList.add('shadow-xl', 'ring-2', 'ring-blue-500'); 
            card.classList.remove('shadow-md');
        });

        card.addEventListener('mouseleave', () => {
            // Kembalikan ke class normal
            card.classList.remove('shadow-xl', 'ring-2', 'ring-blue-500');
            card.classList.add('shadow-md');
        });
    });
});