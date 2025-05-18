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

<?php require_once 'header.php';

require 'config.php';

$conexao = getConnection();

$schools = $conexao->prepare("SELECT * FROM schools");
$schools->execute();

$escola = filter_input(INPUT_POST, 'escola', FILTER_VALIDATE_INT);

if ($escola) {
    $aluno = $conexao->prepare("
    SELECT prsenca.nome, schools.nome as escola_nome
    FROM prsenca
    JOIN schools ON prsenca.school_id = schools.school_id
    WHERE prsenca.school_id = ? 
    ORDER BY RAND() 
    LIMIT 1;
    ");
    $aluno->execute([$escola]);
    $selecionado = $aluno->fetch(PDO::FETCH_ASSOC);
}

?>

<main class="container">
    <section class="registra">
        <div class="inputs">

            <label for="">Seleciona Escola</label><br>
            <form action="" method="post">
                <select name="escola" required>
                    <option selected></option>
                    <?php foreach ($schools as $escola) { ?>
                        <option value="<?= $escola['school_id'] ?>"><?= $escola['nome'] ?></option>
                    <?php  } ?>
                </select>



                <div class="element">
                    <button class="button" type="submit" style="display: none;">Revelar jogador</button>
                </div>
            </form>
        </div>

    </section>
    <?php if (isset($aluno) and $aluno->rowCount() > 0) { ?>
        <a href="jogo.php" style="display: block;">
            <div class="Participante" style="margin-top: 30px;">
                <div class="card">
                    <h3>Participante</h3>
                    <div class="card1" style="
                    width: 100%; color: #ccc; margin-top: 10px;">
                        <div style="border-top:  1px solid #0c121f; padding: 20px 0px;">
                            <p style="font-size: 20px; color: #f39402;"><?= $selecionado['nome'] ?></p>
                            <p style="margin-top: 10px;"><?= $selecionado['escola_nome'] ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    <?php } else { ?>

        <div class="Participante" style="margin-top: 30px;">
            <div class="card">
                <h3>Participante</h3>
                <div class="card1" style=" width: 100%; color: #ccc; margin-top: 10px;">
                    <h4 style="margin-top: 20px; color: red;">Nenhum aluno foi selecionado no momento!</h4>
                </div>
            </div>
        </div>
    <?php } ?>
</main>
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
        document.querySelector(".button").style.display = "block";
    }, 3000);
</script>
<?php require_once 'footer.php' ?>