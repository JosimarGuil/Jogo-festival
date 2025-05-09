<?php require_once 'header.php'; ?>
<style>
    .containerqr {
        width: 90%;
        max-width: 600px;
        margin: 40px auto;
        background-color: #0c121f;
        border-radius: 12px;
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.3);
        overflow: hidden;
        padding: 20px;
    }

    .topo {
        background-color: #0c121f;
        padding: 20px;
        border-radius: 12px 12px 0 0;
        text-align: center;
        margin-bottom: 20px;
    }

    .topo h1 {
        font-size: 28px;
        color: #ffffff;
        margin: 0;
        margin-bottom: 15px;
    }

    .topo a {
        display: inline-block;
        background-color: #f39402;
        color: #ffffff;
        padding: 12px 30px;
        border-radius: 8px;
        text-decoration: none;
        transition: background-color 0.3s;
        box-shadow: 0 2px 15px rgba(0, 0, 0, 0.3);
        font-size: 16px;
    }

    .topo a:hover {
        background-color: #b56d01;
    }

    #reader {
        width: 100%;
        max-width: 350px;
        margin: 0 auto;
        border-radius: 12px;
        border: 2px solid #007bff;
        padding: 15px;
        background-color: #f9f9f9;
        box-shadow: 0 2px 15px rgba(0, 0, 0, 0.2);
    }

    #error {
        color: #ff4d4d;
        font-size: 14px;
        margin-bottom: 15px;
    }

    @media (max-width: 768px) {
        .topo h1 {
            font-size: 24px;
        }

        .topo a {
            padding: 10px 20px;
            font-size: 14px;
        }

        #reader {
            padding: 10px;
        }
    }
</style>

<main class="containerqr">
    <section class="qrcode">
        <div>
            <div class="topo">
                <h1>Leitor de QR Code</h1>
                <span id="error"></span>
                <a href="scanner.php">Marcar presença novamente</a>
            </div>
            <div id="reader"></div>
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
                swal("Sucesso!", "Presença confirmada com sucesso!", "success");
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