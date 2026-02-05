<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
         * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            color: var(--tg-theme-text-color);
            background: var(--tg-theme-bg-color);
        }

        .Main {
            width: 100%;
            padding: 25px;
            text-align: center;

        }

        h1 {
            margin-top: 40px;
            margin-bottom: 10px;
        }

        img {
            width: 70px;
            margin: 30px auto;
        }

        .btn {
            border: 0;
            border-radius: 5px;
            margin-top: 50px;
            height: 60px;
            width: 200px;
            font-style: 20px;
            font-weight: 500;
            cursor: pointer;
            color: var(--tg-theme-button-text-color);
            background: var(--tg-theme-button-color);
        }

        form {
            display: none;
            text-align: center;
        }
        
        input {
            outline: none;
            border-radius: 5px;
            border: 2px solid #535353;
            padding: 15px 10px;
            margin: 10px 0 0;
            background: var(--tg-theme-section-separator-color);
            color: var(--tg-theme-text-color);
            transition: all .2s;
        }
        
        input:focus {
            border-color: var(--tg-theme-secondary-bg-color)
        }

        #feedbackForm {
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 15px;
        }

        textarea {
            border-radius: 5px;
            border: 2px solid #535353;
            padding: 15px 10px;
            margin: 10px 0 0;
        }
    </style>
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

    document.getElementById('feedbackForm').addEventListener('submit', async (e) => {
        e.preventDefault();

        const formData = new FormData(e.target);
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