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
</div>
<?php
require_once 'header.php';
require 'config.php';

$conexao = getConnection();
// Traz alunos com nome da escola correspondente


$schols = $conexao->prepare("SELECT * FROM schools");
$schols->execute();
$total = 0;
?>

<main class="container" style="padding-bottom: 100px;">
    <section class="card0">
        <?php foreach ($schols->fetchAll(PDO::FETCH_ASSOC) as $schol):
            $presense = $conexao->prepare("SELECT * FROM prsenca WHERE school_id = ?");
            $presense->execute([$schol['school_id']]);
            $total +=  $presense->rowCount();
        ?>
            <div class="card">
                <h1><?= htmlspecialchars($schol['nome']) ?></h1>
                <div class="card1" style="margin-top: 10px;">
                    <span><?= $presense->rowCount() ?>+</span>
                </div>

            </div>
        <?php endforeach; ?>
    </section>


    <div class="total">

        <div class="pulse">
            <span><?= $total ?>+</span>
        </div>

    </div>
    <section class="tabela">
        <div class="pesquisar">
            <input class="search" type="search" placeholder="Pesquisar" id="busca">
            <div class="searchs">
                <img class="search-pesquisar" src="assets/icons/search_24dp_FFFFFF_FILL0_wght400_GRAD0_opsz24.png" alt="">
            </div>
        </div>

        <table>

            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Escola</th>
                    <th>Classe</th>
                    <th>Província</th>
                    <th>Gerar qrCode</th>
                </tr>
            </thead>
            <tbody id="tabela"></table>
    </section>

</main>
<script>
    function carregarAlunos(busca = '') 
    {
        fetch(`actions/buscaAlunos.php?busca=${encodeURIComponent(busca)}`)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    let tabela = document.getElementById("tabela");
                    let html = '';

                    data.data.forEach(aluno => {
                        html += `
                    <tr>
                        <td>${aluno.nome}</td>
                        <td>${aluno.escola_nome}</td>
                        <td>${aluno.classe}</td>
                        <td>${aluno.provincia}</td>
                        <td>
                            <a href="gerarqrcode.php?id=${aluno.id}" style="color: #f39402;">Gerar</a>
                        </td>
                    </tr>
                    `;
                    });

                    // Atualiza o conteúdo da tabela
                    tabela.innerHTML = html;
                } else {
                    alert(data.message);
                }
            })
            .catch(error => console.error('Erro:', error));
    }
    // Busca em tempo real
    document.getElementById('busca').addEventListener('input', function() 
    {
        carregarAlunos(this.value);
    });

    // Carregar alunos ao iniciar
    carregarAlunos();


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
        document.getElementById("logo").style.display = "block"
    }, 3000);
</script>
<?php require_once 'footer.php'   ?>