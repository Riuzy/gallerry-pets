const params = new URLSearchParams(window.location.search);
const petId = params.get("id");

const detailContainer = document.getElementById("detailContainer");
const petData = pet.find(p => p.id === petId);

if (!petData) {
  detailContainer.innerHTML = `
      <p>Data hewan tidak ditemukan</p>
  `;
} else {
  detailContainer.innerHTML = `
    <div class="detail-card">
      <img src="${petData.image}" alt="${petData.ras}">
      <div class="detail-info">
        <h2>${petData.ras}</h2>
        
        <div class="detail-info-wrapper">
          <p><strong>Jenis Hewan</strong> <span>${petData.jenis_hewan}</span></p>
          <p><strong>Ras</strong> <span>${petData.ras}</span></p>
          <p><strong>Asal</strong> <span>${petData.asal}</span></p>
          <p><strong>Karakter</strong> <span>${petData.karakter}</span></p>
        </div>
        
        <p class="desc">${petData.deskripsi}</p>
        <a href="gallery.html" class="back-btn">← Kembali ke Galeri</a>
      </div>
    </div>
  `;
}