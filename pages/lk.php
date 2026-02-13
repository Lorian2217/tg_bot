<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../library/owl-carousel/owl.carousel.min.css">
    <link rel="stylesheet" href="../library/owl-carousel/owl.theme.default.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
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
        .Main {width: 100%; padding: 20px;}

        .little-slider {padding-top: 30px; padding-bottom: 15px;}
        .little-slider img {border-radius: 20px; margin-top: 0px; margin-bottom: 0px; min-height: 150px; width: 100%;}

        .services .full {background: url('../image/abstract-earth.jpg') no-repeat; background-size: cover; background-position: right;}
        .services .half {height: 100px; overflow: hidden; background: url('../image/tropical-swiss.jpg') no-repeat; background-size: cover; background-position: right;}
        .services .full::before, .services .half::before {content: ''; position: absolute; left: 0; top: 0; width: 100%; height: 100%; background: #000; opacity: .5; border-radius: inherit; z-index: -1;}
        .services .half *, .services .full * {color: var(--tg-theme-link-color); font-size: 16px;}

        .offers .item {min-height: 100px; background-image: url('../image/sauna.jpg'); background-repeat: no-repeat; background-size: cover; background-position: right;}
        .offers .item button {width: 30px; height: 30px;}
    </style>
    <script>
        $(document).ready(function(){
            const userName = Telegram.WebApp.initDataUnsafe.user.firstName;
            $('.info .name').text(userName);
        });
    </script>
</head>
<body>
    <div class="Main">
        <div class="info">
            <h1>Здравствуйте, <span class="name">{name}</span></h1>
            <div class="subtext">Рады видеть вас с нами!</div>
        </div>
        <div class="little-slider owl-carousel">
            <a href="#"><img src="../image/abstract-earth.jpg" alt="image"></a>
            <a href="#"><img src="../image/gold-monstera.jpg" alt="image"></a>
            <a href="#"><img src="../image/tropical-swiss.jpg" alt="image"></a>
        </div>
        <div class="services d-flex gap-3 align-items-stretch justify-content-stretch">
            <a href="#" class="full d-block position-relative w-50 rounded-4 text-decoration-none p-3 z-1">
                <div class="name text-white">Мои предложения</div>
            </a>
            <div class="d-flex flex-column gap-3">
                <a href="#" class="half d-block position-relative w-100 rounded-4 text-decoration-none p-3 z-1">
                    <div class="name text-white">CLUB PLAY</div>
                    <div class="text-white"><sub>Начнём собирать баллы?</sub></div>
                </a>
                <a href="#" class="half d-block position-relative w-100 rounded-4 text-decoration-none p-3 z-1">
                    <div class="name text-white">Мои задания</div>
                </a>
            </div>
        </div>
        <div class="offers row mx-0 g-3 py-3">
            <?for($i=1;$i<4;$i++):?>
                <div class="col-12">
                    <div class="item d-flex flex-column justify-content-between rounded-4 gap-4 p-3" id="<?=$i;?>">
                        <div class="name fs-3">Предложение <?=$i;?></div>
                        <div>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="fs-5">Кол-во: <span class="count">0</span></div>
                                <div class="d-flex gap-3">
                                    <button type="button" class="add d-flex align-items-center justify-content-center border-0 bg-white rounded-2 fs-4">+</button>
                                    <button type="button" class="remove d-flex align-items-center justify-content-center border-0 bg-white rounded-2 fs-4">-</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?endfor;?>
        </div>
    </div>
    <script src="https://telegram.org/js/telegram-web-app.js"></script>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="/library/owl-carousel/owl.carousel.min.js"></script>
    <script>
        $(document).ready(function(){
            // Набор переменных пользователя
            const chatId = Telegram.WebApp.initDataUnsafe.user.id;
            const userSurname = Telegram.WebApp.initDataUnsafe.user.lastName;
            const userTgname = Telegram.WebApp.initDataUnsafe.user.username;
            const userImg = Telegram.WebApp.initDataUnsafe.user.photo_url;
            // Набор переменных пользователя

            async function Send(data, action){
                try {
                    const res = await fetch('', {
                        method: 'POST',
                        body: data,
                        action: action
                    });

                    const msg = await res.json();

                    if (!res.ok || !msg.success) {
                        const ErrorMessage = msg.error;
                        alert('Ошибка ' + ErrorMessage);
                        return false;
                    }

                } catch (err) {
                    alert('Ошибка ' + err.message);
                    return false;
                }
            }

            $('.little-slider.owl-carousel').owlCarousel({
                loop: true,
                dots: false,
                nav: false,
                margin: 10,
                items: 1,
            });

            $('.offers .item .add').on('click touch', function(){
                let currentCount = parseInt($(this).parents('.item').find('.count').text());
                $(this).parents('.item').find('.count').text(currentCount + 1);
            });

            $('.offers .item .remove').on('click touch', function(){
                let currentCount = parseInt($(this).parents('.item').find('.count').text());

                if (currentCount > 0) {
                    $(this).parents('.item').find('.count').text(currentCount - 1);
                }
            });

            
        });
    </script>
</body>
</html>