<?php
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'GET')
    header('location:index.php');

if (!$_GET['id'])
    header('location:index.php');


$conexao = getConnection();
$aluno = $conexao->prepare("SELECT * FROM  alunos WHERE  id = ?");
$aluno->execute([$_GET['id']]);
$alunoSingle = $aluno->fetch(PDO::FETCH_ASSOC);

if ($aluno->rowCount() == 0)
    header('location:index.php');

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Code da Loja</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js">
    </script>
    <style>
        body {
            font-family: "Ubuntu", sans-serif;
            background-color: #0c121f;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        /* Style the container */
        .container {
            background-color: #fff;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
            padding: 20px;
            text-align: center;
        }

        /* Style the header */
        .header {
            text-align: center;
        }

        /* Style the h1 element */
        h1 {
            font-size: 28px;
            margin-bottom: 10px;
            color: #333;
        }

        /* Style the hr element */
        hr {
            border: 1px solid #ddd;
            margin: 20px 0;
        }

        /* Style the input field */
        input[type="text"] {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
            outline: none;
        }

        /* Style the QR code div */
        .qrcode {
            margin: 20px 0;
        }

        /* Style the button */
        button {
            background-color: #f39402;
            color: #fff;
            padding: 10px 20px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            outline: none;
        }

        /* Hover effect for the button */
        button:hover {
            background-color: #f39402;
        }
    </style>
</head>

<body>
    <div class="header">
        <div class="box">
            <h1 style="color: #ccc;">
                <?= substr($alunoSingle['nome'] ,0,15) ?>...
            </h1>
            <hr />
            <div class="qrcode"></div>
            <input type="hidden" id="qr-value" value="marcarpresenca.php?id=<?= $_GET['id'] ?>" />
            <button onclick="window.print()" class="btn">Imprimir QR Code</button>
        </div>
    </div>

    <script>
        // Cria uma nova instância do QRCode
        const qrcode = new QRCode(document.querySelector(".qrcode"));

        // Gera o QR Code automaticamente ao carregar a página
        window.onload = function () {
            const qrValue = document.getElementById("qr-value").value;
            qrcode.makeCode(qrValue);
        };
    </script>
</body>



</html>