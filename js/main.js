const galleryContainer = document.getElementById("galleryContainer");

pet.forEach(p => {
  galleryContainer.innerHTML += `
    <div class="pet-card" onclick="goDetail('${p.id}')">
      <img src="${p.image}" alt="${p.ras}">
      <h4>${p.ras}</h4>
      <p>${p.jenis_hewan}</p>
    </div>
  `;
});

function goDetail(id) {
  window.location.href = `detail.html?id=${id}`;
}

// Bagian navigasi tetap sama
const menuBtn = document.getElementById("menuBtn");
const navLinks = document.querySelector(".nav-links");

menuBtn.addEventListener("click", () => {
  navLinks.classList.toggle("active");
  menuBtn.classList.toggle("open");
});