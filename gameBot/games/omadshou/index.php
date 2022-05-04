<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="images/wheel.png">
    <title>Omad shou</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="game__box">
        <div class="game__app  animate__animated animate__bounceInLeft">
            <img src="images/arrow.png" alt="arrow image" class="game__arrow">
            <img src="images/wheel.png" alt="wheel image" class="game__wheel">
        </div>
        <p class="game__gift">o'yinni boshlash uchun tugmani bosing !</p>
        <div class="game__btns  animate__animated animate__bounceInRight">
            <button class="game__start">Boshlash</button>
        </div>
    </div>
    <audio src="images/game.mp3" id="game_music"></audio>
    <script src="script.js"></script>
</body>
</html>