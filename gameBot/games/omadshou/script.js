function randomInt(min, max) {
    let rand = min + Math.random() * (max - min);
    return Math.round(rand);
}
const giftList = [
    "50 mln sum.",
    "Nexia 3.",
    "Cobalt",
    "30 mln sum.",
    "Mega Baraban.",
    "2 honali uy",
    "70 mln sum.",
    "Nexia 3.",
    "Cobalt",
    "40 mln sum.",
    "Super Baraban.",
    "3 honali uy",
];
const getGift = (position) => giftList[position - 1];
document.addEventListener("DOMContentLoaded", () => {
    const play_button = document.querySelector(".game__start"),
        gameWheel = document.querySelector(".game__wheel"),
        gameAudio = document.querySelector("#game_music"),
        giftBox = document.querySelector(".game__gift");
    play_button.addEventListener("click", () => {
        giftBox.innerText = "Natijani kutamiz...";
        gameWheel.style.transitionDuration = "5s";
        play_button.setAttribute("disabled", "disabled");
        gameAudio.play();
        random = randomInt(1, 12);
        gameWheel.style.transform = "rotate(" + (random * 30 + 3600) + "deg)";
        setTimeout(() => {
            giftBox.innerText = getGift(random);
            setTimeout(() => {
                gameWheel.style.transitionDuration = "0s";
                gameWheel.style.transform = "rotate(0deg)";
                play_button.removeAttribute("disabled");
            }, 2000);
        }, 5000);
    });
});