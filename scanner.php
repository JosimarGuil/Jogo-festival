<?php require_once 'header.php'; ?>
<style>
    .containerqr {
        width: 100%;
        max-width: 500px;
        margin: 5px;
    }

    .containerqr h1 {
        color: #ffffff;
    }

    .section {
        background-color: #ffffff;
        padding: 50px 30px;
        border: 1.5px solid #b2b2b2;
        border-radius: 0.25em;
        box-shadow: 0 20px 25px rgba(0, 0, 0, 0.25);
    }

    #my-qr-reader {
        padding: 20px !important;
        border: 1.5px solid #b2b2b2 !important;
        border-radius: 8px;
    }

    #my-qr-reader img[alt="Info icon"] {
        display: none;
    }

    #my-qr-reader img[alt="Camera based scan"] {
        width: 100px !important;
        height: 100px !important;
    }

    button {
        padding: 10px 20px;
        border: 1px solid #b2b2b2;
        outline: none;
        border-radius: 0.25em;
        color: white;
        font-size: 15px;
        cursor: pointer;
        margin-top: 15px;
        margin-bottom: 10px;
        background-color: #008000ad;
        transition: 0.3s background-color;
    }

    button:hover {
        background-color: #008000;
    }

    #html5-qrcode-anchor-scan-type-change {
        text-decoration: none !important;
        color: #1d9bf0;
    }

    video {
        width: 100% !important;
        border: 1px solid #b2b2b2 !important;
        border-radius: 0.25em;
    }
</style>
<main class="container">

    <section class="qrcode">
        <div>
            <div class="topo">
                <h1 class="leitor" style="margin-bottom: 10px;">Leitor de QR Code</h1>
                <span id="error" style="color: red; font-size:12px; margin-bottom:20px"></span>
                <a href="scanner.php" style="
                     text-align: center;
                     display: block;
                     padding: 10px 30px;
                   background-color: #f39402; color: #fff; border-radius: 10px;"> Marcar presença novamente</a>
            </div>
            <div class="relative">
                <div id="reader" class="overflow-hidden rounded-xl border-2 border-blue-200"></div>

                <!-- Overlay com as guias de scan -->
                <div class="absolute inset-0 pointer-events-none">
                    <div class="absolute inset-0 border-2 border-dashed border-blue-400 m-8 rounded-lg"></div>
                    <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-48 h-48 border-2 border-blue-500"></div>
                </div>
            </div>
    </section>
</main>

<script src="assets/js/scanner.js"></script>
<script>
    let html5QRCodeScanner = new Html5QrcodeScanner(
        "reader", {
            fps: 10,
            qrbox: {
                width: 200,
                height: 200,
            },
        }
    );

    function onScanSuccess(decodedText) {
        // Usa o texto decodificado corretamente
       // window.location.href = decodedText;
        fetch(decodedText,
            {
                method:"GET",
            }
        ).then(response => response.json()).
        then(data =>
        {
            if (data.success)
            {
                swal("Sucesso!", "Presença confirmada com sucess", "success");
            }
            else
            {
                document.getElementById("error").innerText=data.message;
            }
        }).catch(error => console.log('Error:', error));
        html5QRCodeScanner.clear();
    }

    html5QRCodeScanner.render(onScanSuccess);
</script>

<?php require_once 'footer.php' ?>