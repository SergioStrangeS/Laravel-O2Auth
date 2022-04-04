<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nyako.ru</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<header>
    <div class="container">
        <nav class="d-flex justify-beetween align-center">
            <h1 class="logo">
                <a href="#">
                    <div class="jap">にゃこサイト</div>
                    <div class="eng">Nyako Site</div>
                </a>
            </h1>

            <ul>
                <li><a href="{{ route('index') }}">Home</a></li>
                <li><a href="#">News</a></li>
                <li><a href="#">Story</a></li>
                <li><a href="#">Charaters</a></li>
                <li><a href="{{ route('login') }}">Login</a></li>
            </ul>
        </nav>

        <div class="infocard">
            <h1>Spirited Away</h1>
            <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Nam, eaque voluptate. Enim magni eligendi
                accusamus ut corporis nihil labore minima quos. Maiores, eum aut fuga voluptatem odit commodi odio
                obcaecati?
            </p>
            <button type="button" class="btn btn-watch">Watch Movie</button>
        </div>

        <div class="navlinks">
            <a href="#"><img src="https://img.icons8.com/ios-glyphs/344/ffffff/youtube-play.png" alt="ВК"></a>
            <a href="#"><img src="https://img.icons8.com/ios-filled/344/ffffff/vk-com.png" alt="ВК"></a>
            <a href="#"><img src="https://img.icons8.com/external-kiranshastry-solid-kiranshastry/344/ffffff/external-email-interface-kiranshastry-solid-kiranshastry.png" alt="ВК"></a>
        </div>
    </div>

    <img class="infocard-image" src="https://avatanplus.com/files/resources/original/5c2e5498a9ab716814fa7477.png" alt="Унесенные призраками">
</header>
</body>
</html>
