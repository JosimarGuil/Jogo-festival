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
    <h2 style="color: #ccc; font-size: 40px; margin-top: 20px;">🎁 Carregando seu Presente🎁</h2>
</div>
<?php require_once 'header.php'; ?>
<main class="container">
    <div class="modal" style="margin-top: 50px;">
        <div class="Participante">
            <div class="card">
                <h3 class="nomePresente">🎁 Escolha seu presente 🎁</h3><br>
            </div>
        </div>
    </div>
    <div>
        <a class="button" href="escolherAluno.php" style="background-color: red; display: none;
         text-align: center;">Iniciar nova jogada</a>
    </div>
    <div id="presente" style="display: none;">
        <section class="presente" ></section>
    </div>
    
</main>

<script>
    var presets = [1, 2, 3, 4, 5];

    function arrAleatorio(arr) {
        const embaralhado = arr.slice();

        for (let i = embaralhado.length - 1; i > 0; i--) {
            1
            const aleatorio = Math.floor(Math.random() * (i + 1));
            [embaralhado[i], embaralhado[aleatorio]] = [embaralhado[aleatorio], embaralhado[i]];
        }

        return embaralhado;
    }

    var presentAleatoris = arrAleatorio(presets);
    let caixas = document.querySelector('.presente');

    function verPresente(img) {
        if (img) {

        }
        console.log(img);
    }

    presentAleatoris.forEach((presente, index) => {

        caixas.innerHTML += `
        <div class="sobreporta">
            <img   class="sobre" src='assets/presentes/${presente}.jpg'>

            <div  >
                <div class="fila-topo" style="color:white; text-align:center; font-weight: 900; line-height:30px">
                    ${index+1}
                </div>
                <div class="caixa" onclick="verPresente(this, '${presente}')" >
                <div class="fila horizontal">
                </div><div class="fila vertical"></div>
                </div>
            </div>
        </div>
       `
    });

    function verPresente(el, img) {
        el.style = "display:none";

        if (parseInt(img) === 1)
            document.querySelector(".nomePresente").innerHTML = "🎁 Computador Mac All in one 🎁";
        else if (parseInt(img) === 2)
            document.querySelector(".nomePresente").innerHTML = "🎁 SmartWatch 🎁";
        else if (parseInt(img) === 3)
            document.querySelector(".nomePresente").innerHTML = "🎁 Ifone 15 pro max 🎁";
        else if (parseInt(img) === 4)
            document.querySelector(".nomePresente").innerHTML = "🎁 Mack book pro potátil 🎁";
        else if (parseInt(img) === 5)
            document.querySelector(".nomePresente").innerHTML = "🎁 Teclado e mouse sem fio 🎁";

        confetti({
            particleCount: 100,
            spread: 70,
            origin: {
                y: 0.6
            },
        });

        document.querySelector(".button").style.display = "block"
    }
</script>

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
        document.querySelector("#presente").style.display = "block";
    }, 3000);
</script>
<?php require_once 'footer.php' ?>