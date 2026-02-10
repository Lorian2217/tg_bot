<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../library/owl-carousel/owl.carousel.min.css">
    <link rel="stylesheet" href="../library/owl-carousel/owl.theme.default.min.css">
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

        .services {display: flex; gap: 16px; align-items: stretch; justify-content: stretch;}
        .services .full {position: relative; padding: 15px; display: block; text-decoration: none; width: 50%; border-radius: 20px; background: url('../image/abstract-earth.jpg') no-repeat; background-size: cover; background-position: right; z-index: 1;}
        .services .half-wrapper {display: flex; flex-direction: column; gap: 16px;}
        .services .half {position: relative; padding: 15px; display: block; text-decoration: none; width: 100%; height: 100px; overflow: hidden; border-radius: 20px; background: url('../image/tropical-swiss.jpg') no-repeat; background-size: cover; background-position: right; z-index: 1;}
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
        <div class="services">
            <a href="#" class="full"> 
                <div class="name">Мои предложения</div>
            </a>
            <div class="half-wrapper">
                <a href="#" class="half">
                    <div class="name">CLUB PLAY</div>
                    <div><sub>Начнём собирать баллы?</sub></div>
                </a>
                <a href="#" class="half">
                    <div class="name">Мои задания</div>
                </a>
            </div>
        </div>
    </div>

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