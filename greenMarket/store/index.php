<?
require_once "../config.php";
require_once "../funcs.php";
?>
<!DOCTYPE html>
<html lang="uz">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="icon.png" type="image/png">
    <title>Green Market - Eco Fruites Store.</title>
    <!-- bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <script src="https://telegram.org/js/telegram-web-app.js"></script>
    <!-- fontawesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.1.1/css/all.css">
    <!-- fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 col-lg-8">
                <style>
                #nav-tab {
                    background-color: #85FFBD;
                    background-image: linear-gradient(45deg, #85FFBD 0%, #FFFB7D 100%);
                }

                div.tab-pane {
                    padding-top: 10px;
                }

                .col-4.product>img {
                    height: 120px;
                    display: block;
                    margin: 0 auto 10px;
                    max-width: inherit;
                }

                .col-4.product {
                    text-align: center;
                    margin-bottom: 20px;
                }

                .fa-heart {
                    color: red;
                }

                span.price-badge {
                    position: absolute;
                    bottom: 4px;
                }

                span.badge.rounded-pill.bg-danger.cart-sum,
                .checkout-sum {
                    font-size: xx-small;
                }

                .tab-pane>h2 {
                    margin: 20px auto 30px;
                }

                div#staticBackdrop {
                    background: #000000cf;
                    transition-duration: 1s;
                }
                </style>
                <nav>
                    <div class="nav nav-tabs animate__animated animate__fadeInDown" id="nav-tab" role="tablist">
                        <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#nav-store" type="button"
                            role="tab"><i class="fa-solid fa-store"></i> Dukon</button>
                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#nav-blog" type="button"
                            role="tab"><i class="fa-solid fa-rss"></i> Blog</button>
                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#nav-about" type="button"
                            role="tab"><i class="fa-solid fa-headset"></i> FAQ</button>
                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#nav-checkout" type="button"
                            role="tab"><i class="fa-solid fa-cart-shopping"></i><span
                                class="badge rounded-pill bg-danger cart-sum">0</span></button>
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-store" role="tabpanel">
                        <h2 class="animate__animated animate__fadeInUp text-center">Green Market ECO mahsulotlari</h2>
                        <div class="row">
                            <!-- product -->
                            <? foreach ($products as $product){
                echo '<div class="col-4 product animate__animated animate__fadeInUp">
                        <img src="img/'.$product['photo'].'" alt="product">
                        <div class="position-relative">
                            <span class="badge rounded-pill bg-danger price-badge">'.$product['price'].' s.</span>
                        </div>
                        <div class="btn-group btn-group-sm " role="group" data-product=\''.json_encode($product).'\'>
                            <button type="button" class="btn btn-outline-info" data-rol="info" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fa-solid fa-magnifying-glass-plus"></i></button>
                            <button type="button" class="btn btn-outline-info" data-rol="save"><i class="fa-solid fa-heart"></i></button>
                            <button type="button" class="btn btn-outline-info" data-rol="buy"><i class="fa-solid fa-cart-shopping"></i></button>
                        </div>
                      </div>';
            } ?>
                            <!-- product -->
                        </div>
                        <pre id="logbox"></pre>
                    </div>
                    <div class="tab-pane fade" id="nav-blog" role="tabpanel" aria-labelledby="nav-profile-tab">
                        <h2 class="animate__animated animate__fadeInUp text-center">Do'konimizdagi eng so'ngi
                            yangiliklar</h2>
                        <div id="carouselExampleIndicators" class="carousel slide animate__animated animate__fadeInUp"
                            data-bs-ride="carousel">
                            <div class="carousel-indicators">
                                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0"
                                    class="active" aria-current="true" aria-label="Slide 1"></button>
                                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                                    aria-label="Slide 2"></button>
                                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                                    aria-label="Slide 3"></button>
                            </div>
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img src="img/news1.jpg" class="d-block w-100" alt="...">
                                </div>
                                <div class="carousel-item">
                                    <img src="img/news2.jpg" class="d-block w-100" alt="...">
                                </div>
                                <div class="carousel-item">
                                    <img src="img/news3.jpg" class="d-block w-100" alt="...">
                                </div>
                            </div>
                            <button class="carousel-control-prev" type="button"
                                data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button"
                                data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                        <div class="card" style="margin-top:30px;" class="animate__animated animate__fadeInUp">
                            <img src="img/news3.jpg" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">Card title</h5>
                                <p class="card-text">Some quick example text to build on the card title and make up the
                                    bulk of the
                                    card's
                                    content.</p>
                                <a href="#" class="btn btn-primary">Go somewhere</a>
                            </div>
                        </div>
                        <div class="card" style="margin-top:30px;" class="animate__animated animate__fadeInUp">
                            <img src="img/news1.jpg" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">Card title</h5>
                                <p class="card-text">Some quick example text to build on the card title and make up the
                                    bulk of the
                                    card's
                                    content.</p>
                                <a href="#" class="btn btn-primary">Go somewhere</a>
                            </div>
                        </div>
                        <div class="card" style="margin-top:30px;" class="animate__animated animate__fadeInUp">
                            <img src="img/news2.jpg" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">Card title</h5>
                                <p class="card-text">Some quick example text to build on the card title and make up the
                                    bulk of the
                                    card's
                                    content.</p>
                                <a href="#" class="btn btn-primary">Go somewhere</a>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="nav-about" role="tabpanel" aria-labelledby="nav-contact-tab">
                        <h2 class="animate__animated animate__fadeInUp text-center">Texnik yordam bo'limi</h2>
                        <div class="accordion" id="accordionPanelsStayOpenExample"
                            class="animate__animated animate__fadeInUp">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true"
                                        aria-controls="panelsStayOpen-collapseOne">
                                        Texnik savol #1
                                    </button>
                                </h2>
                                <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show"
                                    aria-labelledby="panelsStayOpen-headingOne">
                                    <div class="accordion-body">
                                        <strong>This is the first item's accordion body.</strong> It is shown by
                                        default, until the
                                        collapse plugin adds the appropriate classes that we use to style each element.
                                        These classes
                                        control the overall appearance, as well as the showing and hiding via CSS
                                        transitions. You can
                                        modify any of this with custom CSS or overriding our default variables. It's
                                        also worth noting
                                        that just about any HTML can go within the <code>.accordion-body</code>, though
                                        the transition
                                        does limit overflow.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="panelsStayOpen-headingTwo">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false"
                                        aria-controls="panelsStayOpen-collapseTwo">
                                        Texnik savol #2
                                    </button>
                                </h2>
                                <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse"
                                    aria-labelledby="panelsStayOpen-headingTwo">
                                    <div class="accordion-body">
                                        <strong>This is the second item's accordion body.</strong> It is hidden by
                                        default, until the
                                        collapse plugin adds the appropriate classes that we use to style each element.
                                        These classes
                                        control the overall appearance, as well as the showing and hiding via CSS
                                        transitions. You can
                                        modify any of this with custom CSS or overriding our default variables. It's
                                        also worth noting
                                        that just about any HTML can go within the <code>.accordion-body</code>, though
                                        the transition
                                        does limit overflow.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="panelsStayOpen-headingThree">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="false"
                                        aria-controls="panelsStayOpen-collapseThree">
                                        Texnik savol #3
                                    </button>
                                </h2>
                                <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse"
                                    aria-labelledby="panelsStayOpen-headingThree">
                                    <div class="accordion-body">
                                        <strong>This is the third item's accordion body.</strong> It is hidden by
                                        default, until the
                                        collapse plugin adds the appropriate classes that we use to style each element.
                                        These classes
                                        control the overall appearance, as well as the showing and hiding via CSS
                                        transitions. You can
                                        modify any of this with custom CSS or overriding our default variables. It's
                                        also worth noting
                                        that just about any HTML can go within the <code>.accordion-body</code>, though
                                        the transition
                                        does limit overflow.
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br><br>
                        <h3 class="animate__animated animate__fadeInUp">Savolingizga javob topolmadingizmi ?</h3>
                        <form class="animate__animated animate__fadeInUp">
                            <div class="mb-3">
                                <div class="input-group flex-nowrap">
                                    <span class="input-group-text" id="addon-wrapping"><i
                                            class="fa-solid fa-mobile-screen"></i></span>
                                    <input type="tel" class="form-control" placeholder="Phone..." name="phone">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="theme" class="form-label">Murojat mavzusi *:</label>
                                <select class="form-select form-control" name="theme" id="theme">
                                    <option value="1" selected>Texnik yordam</option>
                                    <option value="2">Mahsulot sifat nazorati</option>
                                    <option value="3">Chegirmalar va aksiyalar</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="method" class="form-label">Yuborish vositasi *:</label>
                                <select class="form-select form-control" id="method" name="method">
                                    <option value="telegram" selected>Telegram</option>
                                    <option value="email">Email</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="message" class="form-label">Xabar...</label>
                                <textarea class="form-control" id="message" rows="3" name="message"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary" name="sender">Yuborish</button>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="nav-checkout" role="tabpanel">
                        <h2 class="animate__animated animate__fadeInUp text-center">Mahsulotlar savatchasi
                            <span class="btn btn-danger bg-danger checkout-clear"><i
                                    class="fa-solid fa-trash-arrow-up"></i></span>
                        </h2>
                        <style>
                        img.card-thumps {
                            display: block;
                            max-width: inherit;
                            height: 50px;
                        }

                        .checkout-clear {
                            border-radius: 40%;
                        }
                        </style>
                        <ul class="list-group cart-list">
                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="ms-2">
                                    <img src="img/1.png" alt="text" class="card-thumps">
                                </div>
                                <div class="ms-2 me-auto">
                                    <div class="fw-bold">Mahsulot nomi</div>
                                    <span>0.00 sum.</span>
                                </div>
                                <span class="badge bg-danger rounded-pill"><i
                                        class="fa-regular fa-trash-can"></i></span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal hide" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title <span
                            class="badge rounded-pill bg-danger price-badge">0.00 sum.</span></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">...</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal hide" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Haridni tasdiqlash</h5>
                </div>
                <div class="modal-body">
                    <ul class="list-group">
                        <li class="list-group-item active" aria-current="true">Harid summasi</li>
                        <li class="list-group-item bg-success text-white bg-opacity-25 pay-sum">0.00 sum</li>
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary pay-cancel">Haridga qaytish</button>
                    <button type="button" class="btn btn-primary" id="pay-confirm">Tasdiqlash </button>
                </div>
            </div>
        </div>
    </div>
    <script>
    const telegram = window.Telegram.WebApp
    const telegramData = telegram.initDataUnsafe
    if (Object.keys(telegramData).length === 0 || typeof telegramData.user === 'undefined') {
        document.querySelector("body").innerText =
            "Xatolik, Green Market faqat @im_green_market_bot ichida xizmat ko'rsatadi !";
        // window.location.href = "https://mproweb.uz/";
    } else {
        telegram.expand()
        document.querySelector("#logbox").innerText = JSON.stringify(telegram, null, 4)
    }
    const themeParams = telegram.themeParams
    const mainButton = telegram.MainButton
    </script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script defer src="https://use.fontawesome.com/releases/v6.1.1/js/all.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
    let isTab = false
    const showInfo = (product) => {
        document.querySelector("#exampleModalLabel").innerHTML = product.title +
            ` <span class="badge rounded-pill bg-danger">${product.price} sum.</span>`
        document.querySelector(".modal-body").innerText = product.info
    }
    const saveProduct = (product) => {
        console.log("saqlaymiz");
    }
    const totalSum = (products) => {
        let cartSum = 0
        if (products.length > 0) {
            products.forEach(product => {
                cartSum += product.price
            })
        }
        document.querySelector(".cart-sum").innerText = cartSum
        return cartSum
    }
    const getCardList = (products) => {
        const cardList = document.querySelector(".cart-list")
        if (products.length > 0) {
            // renderMainBtn({
            //     'newText': totalSum(products)
            // })
            mainButton.show();
            mainButton.setParams({
                'text': `To'lov ${totalSum(products)} sum.`,
                'color': "#2ECC71",
                'text_color': "#F7F9F9"
            })
            cardList.innerHTML = ""
            let animClass = ''
            products.forEach((product, index) => {
                animClass = (index % 2) ? "animate__fadeInRight" : "animate__fadeInLeft"
                cardList.innerHTML += `<li class="list-group-item d-flex justify-content-between align-items-start animate__animated ${animClass}">
                                <div class="ms-2">
                                    <img src="img/${product.photo}" alt="${product.title}" class="card-thumps">
                                </div>
                                <div class="ms-2 me-auto">
                                    <div class="fw-bold">${product.title}</div>
                                    <span>${product.price} sum.</span>
                                </div>
                                <span class="badge bg-danger rounded-pill remove-product" data-productindex="${index}"><i class="fa-regular fa-trash-can"></i></span>
                            </li>`
            })
        } else {
            // mainButton.hide()
            if (isTab) {
                mainButton.setParams({
                    'text': `Tanlanmagan !!!`,
                    'color': "#7D3C98",
                    'text_color': "#F2F3F4"
                })
            }
            cardList.innerHTML = "Mahsulotlar topilmadi !"
        }
    }
    const getCart = (newCart = false) => {
        if (newCart) localStorage.setItem("cart", JSON.stringify(newCart));
        return localStorage.getItem("cart") ? JSON.parse(localStorage.getItem("cart")) : []
    }
    const addToCart = (product) => {
        cart.push(product)
        getCart(cart)
        isTab = true
        getCardList(cart)
        reConfigBtns()
    }
    const reConfigBtns = () => {
        document.querySelectorAll(".remove-product").forEach(btn => {
            btn.addEventListener("click", () => {
                cart.splice(+btn.dataset.productindex, 1);
                getCart(cart)
                totalSum(cart)
                getCardList(cart)
                reConfigBtns()
            })
        })
    }
    const log = (obj) => {
        document.querySelector("#logbox").innerText = JSON.stringify(obj, null, 4);
    }
    let cart = getCart()
    totalSum(cart)
    getCardList(cart)
    reConfigBtns()
    document.addEventListener("DOMContentLoaded", () => {
        const store = document.querySelectorAll(".btn-outline-info")
        store.forEach(el => {
            el.addEventListener("click", () => {
                switch (el.dataset.rol) {
                    case "info":
                        showInfo(JSON.parse(el.parentElement.dataset.product))
                        break
                    case "save":
                        saveProduct(JSON.parse(el.parentElement.dataset.product))
                        break
                    case "buy":
                        addToCart(JSON.parse(el.parentElement.dataset.product))
                        break
                    default:
                        break
                }
            })
        })
        document.querySelector(".checkout-clear").addEventListener("click", () => {
            cart = getCart([])
            isTab = true
            totalSum(cart)
            getCardList(cart)
        })
        mainButton.onClick(() => {
            log(cart)
            if (totalSum(cart) > 1) {
                // Serverga post uslubida so'rov yuborish
                axios.post('api.php', {
                        user: telegramData.user,
                        orderData: cart,
                        orderPrice: totalSum(cart),
                        currence: "UZS"
                    })
                    // So'rov muvaffaqiyatli yakunlanganda
                    .then(function(response) {
                        // console.log(response);
                        log(response)
                        if (response.data.result) telegram.close()
                    })
                    // So'rov xatolar bilan yakunlanganda
                    .catch(function(error) {
                        // console.log(error);
                        log(error)
                    });
            } else {
                mainButton.setParams({
                    'text': `Mahsulot tanlang !!!`,
                    'color': "#F4D03F",
                    'text_color': "#6C3483",
                })
                // mainButton.hide();
            }
        })
    });
    </script>
</body>

</html>