<style>
    #logo {
        display: none;
    }

    .loader {
        background: radial-gradient(#0c121f, #0c121f);
        font-family: 'Source Code Pro', monospace;
        font-weight: 400;
        overflow: hidden;
        padding: 30px 0 0 30px;
        text-align: center;
        position: absolute;
        width: 100%;
        height: 100%;
    }

    svg {
        display: block;
        position: absolute;
        top: 50%;
        left: 50%;
        margin-top: -50px;
        margin-left: -50px;
    }
</style>
<div class="loader">
    <svg width="100" height="100" viewBox="0 0 75 75">
        <circle cx="37.5" cy="37.5" r="24" stroke="#ff7f00" fill="none" stroke-width="3" />
        <circle cx="37.5" cy="37.5" r="37" stroke="#333" fill="none" stroke-width="1" />
        <g transform="rotate(-86.303, 37.5, 37.5)">
            <circle cx="37.5" cy="37.5" r="31" stroke="#333" fill="none" stroke-width="5" stroke-dasharray="28.463, 4" />
            <circle id="wedge" cx="37.5" cy="37.5" r="31" stroke="#ff7f00" fill="none" stroke-width="5" stroke-dasharray="28.463, 166.316" />
        </g>
    </svg>
    <h2 style="color: #f39402; font-size: 40px; margin-top: 20px;">Processando o Jogo...</h2>
    <p>Buscando perguntas se o candidato acertar tudo receberá presente!</p>
</div>

<!DOCTYPE html>

<html lang="pt-br">

<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jogo</title>
    <link href="https://fonts.googleapis.com/css2?family=Alice&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@tsparticles/confetti@3.0.3/tsparticles.confetti.bundle.min.js"></script>

    <link rel="stylesheet" href="sweetalert2.min.css">
    <link rel="stylesheet" href="assets/css/jogo.css">

</head>

<body>

    <div class="menu">
        <header class="container">
            <nav>
                <div class="elemento">
                    <img class="logo" id="logo" src="assets/icons/Preview-removebg-preview.png" alt="">
                </div>

                <div class="lista">
                    <ul>
                        <li><a href="index.php">Inicio</a></li>
                        <li><a href="add-aluno.php">Registrar Participantes</a></li>
                        <li><a href="scanner.php">Ler Presença</a></li>
                        <li><a href="escolherAluno.php">Jogo</a></li>
                    </ul>
                </div>
                <div class="icon-mobile">
                    <img class="icons" src="assets/icons/menu_24dp_E8EAED_FILL0_wght400_GRAD0_opsz24.png" alt="">
                </div>
            </nav>
        </header>
    </div>

    <main class="container" >
        <section class="Quiz">
            <div class="Quizs">
                <div class="total">
                    <div class="pulse">
                        <span class="counter"></span>
                    </div>
                </div><br>
                <p style="text-align: center; font-size: 20px; color: #f39402;" class="pergunta"></p>
                <span class="error" style="color: red; text-align: center; display: block;"></span>
                <span class="success" style="color: green; text-align: center; display: block;"></span>

                <div class="opcoes"></div>

                <div class="element">
                    <a class="btn" onclick="proximaPergunta()" id="resp" style="display: none; text-align: center;">Enviar Resposta</a>

                    <a class="btn" href="escolherAluno.php" id="reiniciar" style="background-color: red;
                    display: none; text-align: center;">Reiniciar jogo</a>

                    <a href="presents.php" class="btn" id="present" style="background-color: green;
                    display: none; text-align: center;">Escolher presente</a>
                </div>

            </div>

        </section>

    </main>
    <script src="assets/js/js.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        var angle = 0;
        var increment = 60;
        var wedge = document.getElementById('wedge');
        var cx = wedge.getAttribute('cx');
        var cy = wedge.getAttribute('cy');
        var interval = 2000 / 6;

        setInterval(function() {
            wedge.setAttribute('transform', 'rotate(' + angle + ', ' + cx + ', ' + cy + ')');
            angle = (angle >= 360 - increment) ? 0 : angle + increment;
        }, 333.333);

        document.body.style.overflow = 'hidden';
        setTimeout(() => {
            document.querySelector(".loader").style = "display:none"
            document.body.style.overflow = 'scroll';
            document.getElementById("logo").style.display = "block";
            document.querySelector(".btn").style.display = "block";
        }, 4000);
    </script>
</body>

</html>