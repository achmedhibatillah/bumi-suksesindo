function updateClock() {
    const elements = document.querySelectorAll(".clock-now");
    const now = new Date();
    const hours = String(now.getHours()).padStart(2, '0');
    const minutes = String(now.getMinutes()).padStart(2, '0');
    const timeString = `${hours}:${minutes}`;
    elements.forEach(el => {
        el.textContent = timeString;
    });
}
setInterval(updateClock, 1000);
updateClock();