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
        .services .full::before, .services .half::before {content: ''; position: absolute; left: 0; top: 0; width: 100%; height: 25%; backdrop-filter: blur(1px); z-index: -1;}
        .services .half *, .services .full * {color: var(--tg-theme-link-color); font-size: 16px;}
    </style>
</head>
<body>
    <div class="Main">
        <div class="info">
            <h1>Здравствуйте, {name}</h1>
            <div class="subtext">Рады видеть вас с нами!</div>
        </div>
        <div class="little-slider owl-carousel">
            <a href="#"><img src="../image/abstract-earth.jpg" alt="image"></a>
            <a href="#"><img src="../image/gold-monstera.jpg" alt="image"></a>
            <a href="#"><img src="../image/tropical-swiss.jpg" alt="image"></a>
        </div>
        <div class="services d-flex gap-3 align-items-stretch justify-content-stretch">
            <a href="#" class="full d-block position-relative w-100 rounded-4 text-decoration-none p-3 z-1">
                <div class="name">Мои предложения</div>
            </a>
            <div class="d-flex flex-column gap-3">
                <a href="#" class="half d-block position-relative w-100 rounded-4 text-decoration-none p-3 z-1">
                    <div class="name">CLUB PLAY</div>
                    <div><sub>Начнём собирать баллы?</sub></div>
                </a>
                <a href="#" class="half d-block position-relative w-100 rounded-4 text-decoration-none p-3 z-1">
                    <div class="name">Мои задания</div>
                </a>
            </div>
        </div>
    </div>
    <script src="https://telegram.org/js/telegram-web-app.js"></script>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="/library/owl-carousel/owl.carousel.min.js"></script>
    <script>
        $(document).ready(function(){
            $('.little-slider.owl-carousel').owlCarousel({
                loop: true,
                dots: false,
                nav: false,
                margin: 10,
                items: 1,
            });
        });
    </script>
</body>
</html>