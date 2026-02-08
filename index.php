<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/assets/style.css">
</head>
<body>
    <div class="Main">
        <h1>Тестовое приложение</h1>
        <img src="static/bot.png" alt="">
        <p></p>
        <button class="btn f-btn">Тест отправки данных</button>
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


    const chatId = Telegram.WebApp.initDataUnsafe.user.id;
    document.getElementById('chatIdField').value = chatId;

    async function Auth(data) {
        try {
            let res = await fetch('https://cw809330.tw1.ru/logic/user.php', {
                method: 'POST',
                body: data
            });

            let msg = await res.json();
            alert(msg);
        } catch (err) {
            throw new Error(err.message);
        }
    }

    document.getElementById('feedbackForm').addEventListener('submit', async (e) => {
        e.preventDefault();

        const formData = new FormData(e.target);

        await Auth(formData);

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
</body>
</html>