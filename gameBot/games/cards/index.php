<!doctype html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="quis.png">
    <script src="main.js" defer></script>
    <title>Mevalar kartalari bilan kichik o'yin !</title>
</head>
<style>
    * {
        padding: 0;
        margin: 0;
        -webkit-box-sizing: border-box;
        box-sizing: border-box;
        font-family: 'Roboto', sans-serif;
    }

    body {
        height: 100vh;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        background: url(img/bg.jpg) 100% 100% no-repeat;
        background-size: cover;
    }

    .memory-game {
        width: 640px;
        height: 640px;
        margin: auto;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -ms-flex-wrap: wrap;
        flex-wrap: wrap;
        -webkit-perspective: 1000px;
        perspective: 1000px;
    }

    .memory-card {
        width: calc(25% - 10px);
        height: calc(33.333% - 10px);
        margin: 5px;
        position: relative;
        -webkit-transform: scale(1);
        -ms-transform: scale(1);
        transform: scale(1);
        -webkit-transform-style: preserve-3d;
        transform-style: preserve-3d;
        -webkit-transition: -webkit-transform .5s;
        transition: -webkit-transform .5s;
        -o-transition: transform .5s;
        transition: transform .5s;
        transition: transform .5s, -webkit-transform .5s;
    }

    .memory-card:active {
        -webkit-transform: scale(.97);
        -ms-transform: scale(.97);
        transform: scale(.97);
        -webkit-transition: -webkit-transform .2s;
        transition: -webkit-transform .2s;
        -o-transition: transform .2s;
        transition: transform .2s;
        transition: transform .2s, -webkit-transform .2s;
    }

    .memory-card.flip {
        -webkit-transform: rotateY(180deg);
        transform: rotateY(180deg);
    }

    .front-face,
    .back-face {
        width: 100%;
        height: 100%;
        padding: 10px;
        position: absolute;
        border-radius: 5px;
        background: rgb(255, 255, 255);
        -webkit-backface-visibility: hidden;
        backface-visibility: hidden;
    }

    .front-face {
        -webkit-transform: rotateY(180deg);
        transform: rotateY(180deg);
    }

    .popup {
        position: fixed;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.8);
        top: 0;
        left: 0;
        opacity: 1;
        visibility: visible;
    }

    .popup__end {
        position: fixed;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.8);
        top: 0;
        left: 0;
        opacity: 0;
        visibility: hidden;
    }

    .popup__body {
        min-height: 100%;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
        -webkit-box-pack: center;
        -ms-flex-pack: center;
        justify-content: center;
        padding: 30px 10px;
    }

    .popup__content {
        background-color: white;
        color: black;
        width: 80%;
        max-width: 500px;
        height: 80vh;
        max-height: 550px;
        border-radius: 15px;
        border: 1px solid black;
    }

    .start_image {
        border-radius: 15px 15px 0px 0px;
    }

    .popup__title {
        font-size: 25px;
        padding-top: 10px;
        padding-left: 20px;
        padding-right: 20px;
        padding-bottom: 20px;
    }

    .popup__text {
        margin-bottom: 20px;
        font-size: 20px;
        padding-top: 0px;
        padding-left: 20px;
        padding-right: 20px;
    }

    .discounts {
        padding-top: 5px;
    }

    .discount {
        list-style: none;
        padding-top: 5px;
    }

    .level__hard {
        width: 60px;
        margin-left: 30px;
        background-color: rgba(199, 12, 0, 0.91);
        color: white;
        border-radius: 5px;
        border: 1px solid white;
        transform: translateY(-2px);
    }

    .level__medium {
        width: 60px;
        margin-left: 30px;
        background-color: rgba(116, 215, 1, 0.91);
        color: white;
        border-radius: 5px;
        border: 1px solid white;
        transform: translateY(-2px);
    }

    .level__easy {
        width: 60px;
        margin-left: 30px;
        background-color: rgba(217, 239, 1, 0.96);
        color: white;
        border-radius: 5px;
        border: 1px solid white;
        transform: translateY(-2px);
    }

    .play_button {
        margin-top: 30px;
        width: 70%;
        position: relative;
        left: 50%;
        transform: translate(-50%, 0);
        text-decoration: none;
        background-color: black;
        border-radius: 15px;
        border: 2px solid black;
    }

    .popup__start {
        font-size: 30px;
        color: white;
        text-decoration: none;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
        -webkit-box-pack: center;
        -ms-flex-pack: center;
        justify-content: center;
        padding-top: 15px;
        padding-left: 20px;
        padding-right: 20px;
        padding-bottom: 10px;
    }

    .play {
        padding-left: 20px;
    }

    .score__now {
        font-size: 20px;
        height: 20px;
        width: 0;
        transform: translateX(calc(50vw - 25px));
        z-index: 1;
    }

    .benefit__text,
    .prize,
    .score {
        font-size: 20px;
        padding-left: 20px;
        background: aqua;
    }

    .benefit {
        font-size: 25px;
        padding-left: 20px;
        color: white;
        background: rgba(36, 36, 36, 0.79);
    }

    .popup__restart {
        margin-left: 15px;
        color: #274580;
        font-size: 35px;
    }

    @media (max-width: 470px) {
        .memory-card {
            width: calc(33.333% - 10px);
            height: calc(25% - 10px);
            margin: 5px;
            position: relative;
            -webkit-transform: scale(1);
            -ms-transform: scale(1);
            transform: scale(1);
            -webkit-transform-style: preserve-3d;
            transform-style: preserve-3d;
            -webkit-transition: -webkit-transform .5s;
            transition: -webkit-transform .5s;
            -o-transition: transform .5s;
            transition: transform .5s;
            transition: transform .5s, -webkit-transform .5s;
        }
    }

    @media (max-height: 330px),
    (max-height: 570px) {
        .popup__title {
            font-size: 25px;
            padding-top: 5px;
            padding-left: 15px;
            padding-right: 15px;
            padding-bottom: 15px;
        }

        .popup__text {
            margin-bottom: 10px;
            font-size: 18px;
            padding-top: 0px;
            padding-left: 15px;
            padding-right: 15px;
        }

        .play_button {
            margin-top: 0px;
            height: 45px;
        }

        .popup__start {
            padding-top: 3px;
        }
    }

    .popup__title {
        font-size: 25px;
        padding-top: 10px;
        padding-left: 20px;
        padding-right: 20px;
        padding-bottom: 20px;
        background: bisque;
        text-align: center;
        margin-bottom: 30px;
    }

    .popup__text {
        margin-bottom: 20px;
        padding: 30px 20px;
        font-size: 20px;
    }

    body {
        height: 100vh;
        display: flex;
        background: antiquewhite;
    }
</style>

<body>
    <p id="score__now" class="score__now"></p>
    <section class="memory-game">
        <div class="memory-card" data-framework="first">
            <img src="img/1.png" alt="first" class="front-face">
            <img src="img/quis.png" alt="Guess" class="back-face">
        </div>
        <div class="memory-card" data-framework="second">
            <img src="img/2.png" alt="second" class="front-face">
            <img src="img/quis.png" alt="Guess" class="back-face">
        </div>
        <div class="memory-card" data-framework="third">
            <img src="img/3.png" alt="third" class="front-face">
            <img src="img/quis.png" alt="Guess" class="back-face">
        </div>
        <div class="memory-card" data-framework="fourth">
            <img src="img/4.png" alt="fourth" class="front-face">
            <img src="img/quis.png" alt="Guess" class="back-face">
        </div>
        <div class="memory-card" data-framework="fifth">
            <img src="img/5.png" alt="fifth" class="front-face">
            <img src="img/quis.png" alt="Guess" class="back-face">
        </div>
        <div class="memory-card" data-framework="sixth">
            <img src="img/6.png" alt="sixth" class="front-face">
            <img src="img/quis.png" alt="Guess" class="back-face">
        </div>
        <div class="memory-card" data-framework="first">
            <img src="img/1.png" alt="first" class="front-face">
            <img src="img/quis.png" alt="Guess" class="back-face">
        </div>
        <div class="memory-card" data-framework="second">
            <img src="img/2.png" alt="second" class="front-face">
            <img src="img/quis.png" alt="Guess" class="back-face">
        </div>
        <div class="memory-card" data-framework="third">
            <img src="img/3.png" alt="third" class="front-face">
            <img src="img/quis.png" alt="Guess" class="back-face">
        </div>
        <div class="memory-card" data-framework="fourth">
            <img src="img/4.png" alt="fourth" class="front-face">
            <img src="img/quis.png" alt="Guess" class="back-face">
        </div>
        <div class="memory-card" data-framework="fifth">
            <img src="img/5.png" alt="fifth" class="front-face">
            <img src="img/quis.png" alt="Guess" class="back-face">
        </div>
        <div class="memory-card" data-framework="sixth">
            <img src="img/6.png" alt="sixth" class="front-face">
            <img src="img/quis.png" alt="Guess" class="back-face">
        </div>
    </section>
    <div id="popup" class="popup">
        <div class="popup__body">
            <div class="popup__content">
                <div class="popup__title">Kartalar ostidan bir hil mevalarni toping va ballarga ega bo'ling !</div>
                <div class="popup__text">
                    <p>Barcha qatnashuvchilar natijalariga ko'ra o'yinda sizning darajangiz.</p>
                    <ul class="discounts">
                        <li class="discount">
                            <p>6 ta urunishda ochsangiz<span type="button" class="level__hard" disabled>Super Pro</span></p>
                        </li>
                        <li class="discount">
                            <p>6 tadan 10 tagacha<span type="button" class="level__medium" disabled>Gamer</span></p>
                        </li>
                        <li class="discount">
                            <p>10 datan 20 tagacha<span type="button" class="level__easy" disabled>Younger :)</span></p>
                        </li>
                    </ul>
                </div>
                <button class="play_button"><a href="#" class="popup__start" id="start">O'yinni boshlash<i class="fas fa-play play"></i></a></button>
            </div>
        </div>
    </div>
    <div id="popup__end" class="popup__end">
        <div class="popup__body">
            <div class="popup__content">
                <div class="popup__title">O'yin yakunlandi !</div>
                <div class="popup__text">
                    <p>Barcha qatnashuvchilar natijalariga ko'ra o'yinda sizning darajangiz. <span class="score">Nomalum !!</span></p>
                    <ul class="discounts">
                        <li class="discount">
                            <p>6 ta urunishda ochsangiz<span type="button" class="level__hard" disabled>Super Pro</span></p>
                        </li>
                        <li class="discount">
                            <p>6 tadan 10 tagacha<span type="button" class="level__medium" disabled>Gamer</span></p>
                        </li>
                        <li class="discount">
                            <p>10 datan 20 tagacha<span type="button" class="level__easy" disabled>Younger :)</span></p>
                        </li>
                    </ul>
                </div>
                <button class="play_button"><a href="#" onClick="window.location.reload()">O'yinni qayta boshlash<i class="fas fa-play play"></i></a></button>
            </div>
        </div>
    </div>
    <!-- <script src="https://kit.fontawesome.com/8eb688fe6b.js" crossorigin="anonymous"></script> -->
    <script>
        // Game
        const cards = document.querySelectorAll(".memory-card");

        let hasFlippedCard = false;
        let lockBoard = false;
        let firstCard, secondCard;

        let randomAbc = "lehaturebashitkur";
        let randomString = "";
        while (randomString.length < 2) {
            randomString +=
                randomAbc[Math.floor(Math.random() * randomAbc.length)].toLocaleUpperCase();
        }

        let date = new Date();
        let month = (date.getMonth() + 1).toString();
        let day = date.getDate().toString();
        let codeDate = day + month;

        let scoreCount = 0;

        function flipCard() {
            scoreCount++;
            document.querySelector(".score").innerText = Math.floor(scoreCount / 2);
            if (lockBoard) return;
            if (this === firstCard) return;
            this.classList.add("flip");
            if (!hasFlippedCard) {
                hasFlippedCard = true;
                firstCard = this;

                return;
            }
            hasFlippedCard = false;
            secondCard = this;

            checkForMatching();
        }

        function checkForMatching() {
            let isMatch = firstCard.dataset.framework === secondCard.dataset.framework;
            isMatch ? (disableCards(), endGame()) : unflipCards();
        }
        let count = 0;

        function endGame() {
            count += 1;
            if (count === 6) {
                showPopup();
            }
        }

        function disableCards() {
            firstCard.removeEventListener("click", flipCard);
            secondCard.removeEventListener("click", flipCard);
            resetBoard();
        }

        function unflipCards() {
            lockBoard = true;
            setTimeout(() => {
                firstCard.classList.remove("flip");
                secondCard.classList.remove("flip");
                resetBoard();
            }, 1300);
        }

        function resetBoard() {
            [hasFlippedCard, lockBoard] = [false, false];
            [firstCard, secondCard] = [null, null];
        }

        (function shuffle() {
            cards.forEach((card) => {
                let randomPos = Math.floor(Math.random() * 12);
                card.style.order = randomPos;
            });
        })();
        cards.forEach((card) => card.addEventListener("click", flipCard));

        // POPUP

        let popup = document.getElementById("popup");
        let start = document.getElementById("start");

        function hidePopup() {
            popup.style.opacity = "0";
            popup.style.visibility = "hidden";
        }

        start.addEventListener("click", hidePopup);

        // Popup Endgame
        let popupend = document.getElementById("popup__end");

        function showPopup() {
            popupend.style.opacity = "1";
            popupend.style.visibility = "visible";
        }

        function randomOne() {
            return Math.floor(Math.random() * 100000);
        }
    </script>
</body>

</html>