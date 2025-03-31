function updateClock() {
    const elements = document.querySelectorAll(".clock-now");
    const now = new Date();
    const hours = String(now.getHours()).padStart(2, '0');
    const minutes = String(now.getMinutes()).padStart(2, '0');
    const seconds = String(now.getSeconds()).padStart(2, '0');
    const timeString = `${hours}:${minutes}:${seconds}`;
    
    elements.forEach(el => {
        el.textContent = timeString;
    });
}

updateClock();
setInterval(updateClock, 1000);


function updateTanggal() {
    const hariIndo = [
        "Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu"
    ];
    const bulanIndo = [
        "Januari", "Februari", "Maret", "April", "Mei", "Juni",
        "Juli", "Agustus", "September", "Oktober", "November", "Desember"
    ];

    const now = new Date();
    const hari = hariIndo[now.getDay()];
    const tanggal = now.getDate();
    const bulan = bulanIndo[now.getMonth()];
    const tahun = now.getFullYear();

    // Update elemen dengan class "hari-now" dan "tanggal-now"
    document.querySelectorAll(".hari-now").forEach(el => {
        el.textContent = hari;
    });

    document.querySelectorAll(".tanggal-now").forEach(el => {
        el.textContent = `${tanggal} ${bulan} ${tahun}`;
    });
}

updateTanggal();
setInterval(updateTanggal, 1000);
