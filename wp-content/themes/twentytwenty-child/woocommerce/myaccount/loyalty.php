<h2>Gerer vos points de fidelitées et générer vos codes promo.</h2>
<style>
    @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap");

    * {
        font-family: "Poppins", sans-serif;
    }

    .container_perso {
        width: 100%;
        height: 100vh;
        justify-content: center;
        align-items: center;
        display: flex;
        background-color: #dc143c;
    }

    .card_perso {
        width: 400px;
        height: 180px;
        border-radius: 5px;
        box-shadow: 0 4px 6px 0 rgba(0, 0, 0, 0.2);
        /* background-color: #fff; */
        background-color: #dc143c;

        padding: 10px 10px;
        position: relative;
    }

    .main,
    .copy-button {
        display: flex;
        justify-content: space-between;
        padding: 0 10px;
        align-items: center;
    }

    .card_perso::after {
        position: absolute;
        content: "";
        height: 40px;
        right: -20px;
        border-radius: 40px;
        z-index: 1;
        top: 70px;
        /* background-color: #dc143c; */
        /* background-color: #198754 !important; */
        background: white;

        width: 40px;
    }

    .card_perso::before {
        position: absolute;
        content: "";
        height: 40px;
        left: -20px;
        border-radius: 40px;
        z-index: 1;
        top: 70px;
        background: white;

        /* background-color: #dc143c; */
        /* background-color: #198754 !important; */

        width: 40px;
    }

    .co-img img {
        width: 100px;
        height: 100px;
    }

    .vertical {
        border-left: 5px dotted white;
        height: 100px;
        position: absolute;
        left: 40%;
    }

    .content h3 {
        font-size: 35px;
        margin-left: -20px;
        color: #fff;
    }

    .content h2 {
        font-size: 18px;
        margin-left: -20px;
        color: #fff;
        text-transform: uppercase;
    }

    .content p {
        font-size: 16px;
        color: #fff;
        margin-left: -20px;
    }

    .copy-button {
        margin: 20px 0 -5px 0;
        height: 45px;
        border-radius: 4px;
        padding: 0 5px;
        border: 1px solid #e1e1e1;
    }

    .copy-button input {
        width: 75%;
        height: 100%;
        border: none;
        outline: none;
        font-size: 15px;
    }

    .copy-button button {
        width: 25%;

        padding: 5px 5px;
        /* background-color: #dc143c; */
        background-color: white;

        color: #dc143c;
        border: 1px solid transparent;
    }

    .copybtn {
        font-size: 16px;
        font-weight: bold;
    }

    .circlePoints {
        font-size: 45px;
    }

    @media screen and (max-width: 400px) {
        .circlePoints {
            font-size: 25px;
        }

        .card_perso {
            width: 90vw!important;
            height: 180px;
            border-radius: 5px;
            box-shadow: 0 4px 6px 0 rgba(0, 0, 0, 0.2);
            /* background-color: #fff; */
            background-color: #dc143c;

            padding: 10px 10px;
            /* position: absolute; */
        }

        .co-img img {
            width: 75px;
            height: 75px;
        }

        .vertical {
            border-left: 5px dotted white;
            height: 100px;
            position: absolute;
            left: 30%;
        }

        .content h3 {
            font-size: 35px;
            margin-left: -20px;
            color: #fff;
        }

        .content h2 {
            font-size: 18px;
            margin-left: -20px;
            color: #fff;
            text-transform: uppercase;
        }

        .content p {
            font-size: 16px;
            color: #fff;
            margin-left: -20px;
        }

        .copy-button {
            margin: 20px 0 -5px 0;
            height: 45px;
            border-radius: 4px;
            padding: 0 5px;
            border: 1px solid #e1e1e1;
        }

        .copy-button input {
            width: 75%;
            height: 100%;
            border: none;
            outline: none;
            font-size: 15px;
        }

        .copy-button button {
            width: 25%;

            padding: 5px 5px;
            /* background-color: #dc143c; */
            background-color: white;

            color: #dc143c;
            border: 1px solid transparent;
        }

        .copybtn {
            font-size: 10px;
            font-weight: bold;
        }
        .woocommerce-account #site-content .woocommerce {
            padding: 0!important;
        }
    }
</style>

<?php
$current_user = wp_get_current_user();

$user_id = $current_user->ID;
$user_name = $current_user->user_login;
$user_email = $current_user->user_email;



// dd($user_email);

$points = get_user_meta($current_user->ID, "points")[0];

$rangeMax = ($points >= 100) ? 100 : $points;

// add_filter( 'the_title', 'wc_page_endpoint_title' );
// the_title( '<h2>', '</h2>' );

//   dd($points);
?>
<div class="container">
    <div class="row   d-flex justify-content-center ">
        <div class="col-6 ">
            <div class="position-relative   d-flex justify-content-center align-items-center" style="min-height:200px ;">
                <div class="border  border-2 rounded-circle border-5 border-info  " style="padding:30px 35px ;">
                    <p class="text-success pt-2 text-center fw-bold circlePoints"><span id="circleDisplayPoints"><?php echo $points  ?></span> <br> <span class="fs-6 position-absolute start-0 end-0 text-dark ">points </span> </p>

                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-4 mb-5 mb-lg-0  d-flex flex-column justify-content-center align-items-center ">

            <div class="w-100 ">
                <!-- <label for="customRange2" class="form-label">Example range</label>
                <input type="range" class="form-range rs-range" min="0" max="5" id="customRange2"> -->
                <div class="row    ">
                    <div class="col-12">
                        <div class="range-slider ">
                            <span id="rs-bullet" class="rs-label">5</span>
                            <input id="rs-range-line" class="rs-range w-100" type="range" value="0" min="5" max="<?php echo $rangeMax ?>">

                        </div>

                        <div class="box-minmax">
                            <span>0</span><span>200</span>
                        </div>
                    </div>


                </div>
            </div>

        </div>
        <div class="col-12 col-lg-8   col-8 d-flex justify-content-center align-items-center position-relative">
            <div class="card_perso">
                <div class="main">
                    <div class="co-img">
                        <img src="http://localhost/veterino/wp-content/uploads/2022/08/kisspng-singapura-cat-kitten-whiskers-domestic-short-haire-kitten-5a96e2512a1906.5043739815198377771724.png" alt="" />
                    </div>
                    <div class="vertical"></div>
                    <div class="content">
                        <h2 class="my-0">Veterino</h2>
                        <h3 class="my-0 fs-1"><span id="percent_coupon">5</span>% <span>Coupon</span></h3>
                        <p>expire le 20 08 2022</p>
                    </div>
                </div>
                <form class="copy-button" id="generateCoupon">
                    <input type="hidden" name="user_email" value="<?php echo $user_email ?>" />
                    <input type="hidden" name="user_name" value="<?php echo $user_name ?>" />
                    <input id="valuePoints" type="hidden" name="points" value="5" />

                    <input id="copyvalue" type="text" readonly value="" />
                    <button id="submitFormCoupon" class="copybtn btn " type="submit" data-bool="false">génerer</button>
                </form>
            </div>

        </div>
        <div class="col-12">
            <div class=" my-5 ">
                <p id="result">

                </p>
            </div>
        </div>
    </div>


</div>





<style>
    .rs-range {
        margin-top: 29px;
        /* width: 600px; */
        -webkit-appearance: none;
    }

    .rs-range:focus {
        outline: none;
    }

    /* // la barre  */
    .rs-range::-webkit-slider-runnable-track {
        /* width: 100%; */
        height: 10px;
        cursor: pointer;
        box-shadow: none;
        background: rgba(255, 0, 0, 0.3);
        border-radius: 20px;
        border: 0px solid #010101;
    }

    .rs-range::-moz-range-track {
        width: 100%;
        height: 1px;
        cursor: pointer;
        box-shadow: none;
        background: #dc143c;
        border-radius: 0px;
        border: 0px solid #010101;
    }

    .rs-range::-webkit-slider-thumb {
        box-shadow: none;
        border: 0px solid #dc143c;
        box-shadow: 0px 10px 10px rgba(0, 0, 0, 0.25);
        height: 42px;
        width: 22px;
        border-radius: 22px;
        background: #0DCAF0;
        cursor: pointer;
        -webkit-appearance: none;
        margin-top: -20px;
    }

    .rs-range::-moz-range-thumb {
        box-shadow: none;
        border: 0px solid #ffffff;
        box-shadow: 0px 10px 10px rgba(0, 0, 0, 0.25);
        height: 42px;
        width: 22px;
        border-radius: 22px;
        background: white;
        cursor: pointer;
        -webkit-appearance: none;
        margin-top: -20px;
    }

    .rs-range::-moz-focus-outer {
        border: 0;
    }

    .rs-label {
        position: relative;
        transform-origin: center center;
        display: block;
        width: 98px;
        height: 98px;
        background: transparent;
        border-radius: 50%;
        line-height: 30px;
        text-align: center;
        font-weight: bold;
        padding-top: 17px;
        box-sizing: border-box;
        border: 2px solid #dc143c;
        margin-top: 20px;
        margin-left: -38px;
        left: attr(value);
        color: #0DCAF0;
        font-style: normal;
        font-weight: normal;
        line-height: normal;
        font-size: 28px;
    }

    @media screen and (max-width: 400px) {
        .rs-label {
            font-size: 16px;
            width: 68px;
            height: 68px;
            margin-left: calc(50% - 34px);

        }

        .card_perso {
            /* transform: scale(.85); */
        }
    }

    .rs-label::after {
        content: "%";
        display: block;
        font-size: 20px;
        letter-spacing: 0.07em;
        margin-top: -2px;
    }

    .box-minmax {
        margin-top: 30px;
        /* width: 608px; */
        display: flex;
        justify-content: space-between;
        font-size: 20px;
        color: #FFFFFF;
    }

    .box-minmax span:first-child {
        margin-left: 10px;
    }
</style>

<script>
    var rangeSlider = document.getElementById("rs-range-line");
    var rangeBullet = document.getElementById("rs-bullet");
    let percentCoupon = document.getElementById('percent_coupon')
    let valuePoints = document.getElementById('valuePoints')

    let textSubmitBtn = $("#submitFormCoupon")

    let circleDisplayPoints = $("#circleDisplayPoints")


    rangeSlider.addEventListener("input", showSliderValue, false);

    function showSliderValue() {
        rangeBullet.innerHTML = rangeSlider.value;
        valuePoints.value = rangeSlider.value;
        var bulletPosition = (rangeSlider.value / rangeSlider.max);
        // rangeBullet.style.left = (bulletPosition * 578) + "px";
        if (window.matchMedia("(min-width: 600px)").matches) {
            rangeBullet.style.left = (bulletPosition * 250) + "px";

        } else {
            // rangeBullet.style.left = (bulletPosition * 300) + "px";
        }
        percentCoupon.innerHTML = rangeSlider.value;

    }

    function copyIt() {
        let copyInput = document.querySelector('#copyvalue');

        copyInput.select();

        document.execCommand("copy");

        textSubmitBtn.html('copie effectuer')

    }



    $("#generateCoupon").on("submit", function(e) {
        e.preventDefault();

        if (textSubmitBtn.data('bool') == false) {
            var dataString = $(this).serialize();
            console.log(dataString)
            textSubmitBtn.html('en attente ...')

            $.ajax({
                type: 'post',
                url: 'http://localhost/veterino/wp-json/generate/coupon',
                data: $('form').serialize(),
                success: function(data) {
                    console.log(data)

                    if (data.response == 'ko') {
                        textSubmitBtn.html('génerer')

                        output = '<div class="error text-danger">' + data.message + '</div>';
                    } else {
                        textSubmitBtn.data('bool', true)
                        textSubmitBtn.html('copier')
                        console.log(data.newPoints)
                        circleDisplayPoints.html(data.newPoints)
                        output = '<div class="text-success">' + data.message + '</div>';
                        $("#copyvalue").val(data.coupon_code)
                        // $('input[type=text]').val(''); 
                        // $('#contactform textarea').val(''); 
                    }

                    $("#result").hide().html(output).slideDown();
                }
            });
        } else {
            console.log('copier le code')
            copyIt()

        }


    });
</script>