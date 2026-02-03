// Проверка, что Telegram Web App доступен
const tg = window.Telegram.WebApp;

document.getElementById("sendData").addEventListener("click", () => {
    const title = document.getElementById("title").value;
    const desc = document.getElementById("desc").value;

    // Формируем JSON для отправки боту
    const data = {
        title: title,
        desc: desc,
        timestamp: new Date().toISOString()
    };

    tg.sendData(JSON.stringify(data)); // отправляем данные боту
});
