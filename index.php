<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/assets/style.css?v=3.3">
    <link rel="stylesheet" href="/library/owl-carousel/owl.carousel.min.css">
    <link rel="stylesheet" href="/library/owl-carousel/owl.theme.default.min.css">
</head>
<body>
    <div class="Main">
        <h1>Тестовое приложение</h1>
        <img src="static/bot.png" alt="">
        <p></p>
        <button class="btn f-btn">Тест отправки данных</button>
    </div>
    <div class="Main page_wrapper">
        <h2>Выберите куда перейти:</h2>
        <div class="btn_list">
            <a href="/pages/lk.php">Личный кабинет</a>
            <a href="/pages/third.html">Третья страница</a>
        </div>
    </div>
    <form id="feedbackForm">
        <input type="text" name="name" placeholder="Ваше имя" required>
        <input type="email" name="email" placeholder="Email" required>
        <textarea name="message" placeholder="Сообщение" required></textarea>

        <input type="hidden" name="chat_id" id="chatIdField"> 

        <button type="submit">Отправить</button>
    </form>

    <script src="https://telegram.org/js/telegram-web-app.js"></script>
    <script>
    let fBtn = document.getElementsByClassName("f-btn")[0]

    fBtn.addEventListener("click", () => {
        document.getElementsByClassName("Main")[0].style.display = "none";
        document.getElementById('feedbackForm').style.display = "flex";
    });

    // Набор переменных пользователя
    const chatId = Telegram.WebApp.initDataUnsafe.user.id;
    const userName = Telegram.WebApp.initDataUnsafe.user.firstName;
    const userSurname = Telegram.WebApp.initDataUnsafe.user.lastName;
    const userTgname = Telegram.WebApp.initDataUnsafe.user.username;
    const userImg = Telegram.WebApp.initDataUnsafe.user.photo_url;
    // Набор переменных пользователя

    document.getElementById('chatIdField').value = chatId;

    async function Auth(data) {

        try {
            const res = await fetch('https://cw809330.tw1.ru/logic/user.php', {
                method: 'POST',
                body: data
            });

            const msg = await res.json();

            if (!res.ok || !msg.success) {
                const ErrorMessage = msg.error;
                alert('Ошибка ' + ErrorMessage);
                return false;
            }

            alert(msg.message);
            return true;

        } catch (err) {
            alert('Ошибка ' + err.message);
            return false;
        }

    }

    document.getElementById('feedbackForm').addEventListener('submit', async (e) => {
        e.preventDefault();

        const formData = new FormData(e.target);
        const isAuthSuccess = await Auth(formData);

        if (!isAuthSuccess) {
            return;
        }

        const response = await fetch('https://cw809330.tw1.ru/logic/tg_bot.php', {
            method: 'POST',
            body: formData
        });

        const result = await response.json();
        if (result.success) {
            alert('Заявка отправлена!');
        } else {
            alert('Ошибка');
        }

    });
    </script>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="/library/owl-carousel/owl.carousel.min.js"></script>
</body>
</html>