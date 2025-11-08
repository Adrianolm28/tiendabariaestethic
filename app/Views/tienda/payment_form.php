<?php

use App\Libraries\IzipayController;

$payment = new IzipayController();
$error = "";

// Verificar si el token de formulario está presente y es válido
if (isset($_GET['formToken'])) {
    $formToken = $_GET['formToken'];

  

?>





    <!DOCTYPE html>
    <html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Formulario de Pago</title>

        <!-- Javascript library. Should be loaded in head section -->
        <!-- Javascript library. Should be loaded in head section -->
        <script src="<?= esc($payment->getEndpointApiRest()) ?>/static/js/krypton-client/V4.0/stable/kr-payment-form.min.js" kr-public-key="<?= esc($payment->getPublicKey()) ?>" kr-post-url-success="<?= site_url('payment/handlePaymentResponse') ?>" kr-language="es">
        </script>


        <!-- theme and plugins. should be loaded after the javascript library -->
        <!-- not mandatory but helps to have a nice payment form out of the box -->
        <link rel="stylesheet" href="<?= $payment->getEndpointApiRest() ?>/static/js/krypton-client/V4.0/ext/classic-reset.css">
        <script src="<?= $payment->getEndpointApiRest() ?>/static/js/krypton-client/V4.0/ext/classic.js">
        </script>


        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" />

        <style>
            :root {
                --red-izi: #ff4240;
                --green-izi: #00a09d;
                --white-izi: #fff;
            }

            * {
                box-sizing: border-box;
                margin: 0;
                padding: 0;
            }

            body {
                background-color: var(--white-izi);
                font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', 'Roboto', 'Oxygen',
                    'Ubuntu', 'Cantarell', 'Fira Sans', 'Droid Sans', 'Helvetica Neue',
                    sans-serif;
                margin: 0;
            }

            .App {
                background-color: #fff;
                border-radius: 10px;
                box-shadow: 0 8px 16px #ccc;
                /* height: 500px; */
                height: auto;
                margin: 3rem auto;
                text-align: center;
                width: 1000px;
            }

            .App h2 {
                color: var(--white-izi);
                background-color: var(--red-izi);
                border-bottom: 5px solid var(--green-izi);
                border-top-left-radius: 10px;
                border-top-right-radius: 10px;
                display: flex;
                font-weight: 600;
                justify-content: center;
                padding: 1rem;
            }

            .App h2 img {
                margin-left: 1rem;
                width: 110px;
            }

            .List-Product {
                display: flex;
            }

            .Product {
                box-shadow: 0 8px 16px #ccc;
                border-radius: 5px;
                height: auto;
                margin: 2rem 1rem;
                padding: 1rem;
                text-align: center;
                width: 220px;

            }

            .Product h4 {
                color: var(--red-izi);
                margin: 0;
                padding: 0 0.8rem 0.8rem;
                width: 100%;
            }

            .Product img {
                height: 180px;
            }

            .Product img {
                color: var(--red-izi);
                font-weight: 600;
                display: block;
                margin: auto;
            }

            .Product p {
                color: var(--red-izi);
                font-weight: 600;
                display: block;
                margin: 0.5rem auto;
            }

            .Product p span {
                font-size: 11px;
            }

            .Product button {
                background-color: var(--green-izi);
                border: none;
                border-radius: 12px;
                color: var(--white-izi);
                font-weight: 600;
                margin: 1rem auto 0;
                padding: 0.5rem;
                width: 150px;

            }

            .Product button:hover {
                cursor: pointer;
                opacity: 0.8;
            }

            .Pay {
                margin-bottom: 2rem;
                text-align: center;
            }

            .Content-Form-Izipay {
                /* border: 1px solid #000; */
                margin: auto;
                width: 400px;
            }

            .Content-Form-Izipay p {
                margin: 2rem;
            }


            .Soporte-Ecommerce {
                align-items: center;
                background-color: var(--white-izi);
                border-radius: 5px;
                bottom: 30px;
                box-shadow: 0 8px 16px #ccc;
                display: flex;
                height: 120px;
                padding: 12px 10px 12px 0;
                position: fixed;
                outline: none;
                right: 40px;
                width: 390px;
            }

            .Soporte-Ecommerce figure {
                margin-bottom: 0;
                margin-top: 0;
                padding: 10px 5px 5px 10px;
                position: relative;
                text-align: center;
            }

            .Soporte-Ecommerce figure img {
                width: 80px;
            }

            .Soporte-Ecommerce div {
                margin-left: 5px;
                padding-left: 23px;
                position: relative;
            }

            .Soporte-Ecommerce div::before {
                height: 80px;
                background-color: #000;
                content: "";
                left: 0;
                opacity: .1;
                position: absolute;
                top: 50%;
                transform: translateY(-50%);
                width: 1px;
            }

            .Soporte-Ecommerce div h4 a {
                color: var(--red-izi);
                display: block;
                text-decoration: none;
                font-size: 1rem;
            }

            .Soporte-Ecommerce div p {
                margin-bottom: 0;
                font-weight: 400;
                color: #666
            }

            /* info payment */
            .content-checkout {
                display: flex;
                justify-content: center;
                margin: 22px auto;
                padding: 1rem;
                width: 600px;

            }

            .content-checkout .checkout {
                width: 300px;
                margin-left: 30px;
            }

            .content-checkout h3 {
                color: var(--red-izi);
                margin-bottom: 1rem;
            }

            .content-checkout .control-group {
                margin: 10px auto;
                padding: 5px;
                position: relative;
                width: 100%;
            }

            .content-checkout .control-group label {
                align-items: center;
                color: var(--green-izi);
                display: flex;
                font-size: 16px;
                font-weight: 300;
                left: 5px;
                top: 12px;
                pointer-events: none;
                position: absolute;
                transition: all .2s ease;
            }

            .content-checkout .control-group input {
                background-color: #fff;
                border: none;
                border-bottom: 1px solid var(--green-izi);
                font-size: 16px;
                font-weight: 400;
                padding: 10px 0;
                outline: none;
                width: 100%;
            }

            .content-checkout .control-group input:required {
                box-shadow: none;
            }

            .content-checkout button {
                appearance: button;
                background-color: var(--white-izi);
                border: 1px solid var(--red-izi);
                border-radius: 3px;
                color: var(--red-izi);
                cursor: pointer;
                font-size: 16px;
                font-weight: 600;
                height: 42px;
                margin-top: 2rem;
                position: relative;
                width: 190px;
            }

            .content-checkout button:hover {
                top: 0;
                left: 0;
                width: 190px;
                height: 42px;
                background-color: rgba(255, 94, 94, 0.1);
                /* opacity: .3; */
            }

            .cart {
                margin-right: 30px;
                width: 300px;
            }

            .content-respuesta {
                width: 100%;
            }

            .content-respuesta h4 {
                margin-bottom: 10px;
            }

            .content-respuesta .respuesta {
                box-shadow: 0 8px 16px #ccc;
                color: var(--red-izi);
                padding: 10px;
                text-align: start;

            }

            /* Pago Finalizado */
            .App .App>h2 {
                margin-bottom: 20px;
            }

            .App>p {
                display: flex;
                padding: 0 20px;
                background-color: #212529;
                color: #f8f9fa;
            }

            .App>p>span {
                color: #0dcaf0;
                margin-right: 10px;
            }

            .App>div.kr-answer {
                background-color: #212529;
                color: #f8f9fa;
            }
        </style>

    </head>

    <body>
        <div class="root">
            <div><?= $error ?></div>
            <div class="App">
                <h2>Confirmar compra <img src="https://iziweb001.s3.amazonaws.com/webresources/img/logo.png" alt="Logo de Izipay"></h2>
                <div class="content-checkout">

                    <div class='checkout' id="checkoutForm">
                        <!-- Formulario de pago de Izipay con el token -->
                        <div class="kr-embedded" style="display: none;" kr-form-token="<?= $formToken ?>">

                            <!-- Campos del formulario de pago -->
                            <div class="kr-pan"></div>
                            <div class="kr-expiry"></div>
                            <div class="kr-security-code"></div>

                            <!-- Botón de pago -->
                            <button class="kr-payment-button" style="background-color: #00A09D;"></button>

                            <!-- Zona de error del formulario -->
                            <div class="kr-form-error"></div>
                        </div>

                    </div>
                </div>
            </div>
        </div>


      

        <!-- Pie de página con información de soporte -->
<!--         <footer class="Soporte-Ecommerce">
            <figure><img src="https://iziweb001.s3.amazonaws.com/webresources/img/img-ico-call.png" alt="imagen de call center"></figure>
            <div>
                <h4><a href="tel:012130808">(01) 213-0808</a><a href="tel:010801-18181">0801-18181</a><a href="mailto:soporteecommerce@izipay.pe" style="color: rgb(0, 160, 157);">SoporteEcommerce@izipay.pe</a></h4>
                <p>Estaremos felices de ayudarte.</p>
            </div>
        </footer> -->

        <!--  manejar el formulario de pago -->
        <script>
            window.onload = function() {
                // Ejemplo de manejo adicional del formulario
                document.querySelector("#checkoutForm").addEventListener("submit", (e) => {
                    e.preventDefault();
                    handleDisplay("#checkoutForm", "none");
                    handleDisplay(".checkout > div", "block")
                })

                const handleDisplay = (element, display) => {
                    document.querySelector(element).style.display = display;
                }
            }
        </script>

    </body>

    </html>

<?php
} else {
    // Manejar el caso donde no se proporciona el token correctamente
    echo "Error: Token de formulario no válido.";
}
?>

