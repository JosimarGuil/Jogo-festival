<?php require_once 'header.php';
require 'config.php';

$conexao = getConnection();
$escola = $conexao->prepare("SELECT * FROM schools");
$escola->execute();
?>



<main class="container">
    <form id="addAluno">
        <section class="registra">
              
            <div class="inputs" >
                <small style="color: red; display: block; text-align: center;" id="error"></small>
                <label for="">Nome</label><br>
                <input type="text" placeholder="Nome" id="Nome" name="nome" required ><br><br>
                <small style="color: red; display: block; margin-bottom: 5px;" id="nome"></small>
                <label for="">Seleciona Escola</label><br>
                <select name="school_id" required>
                    <?php  foreach($escola->fetchAll() as $escola) {?>
                        <option value="<?=$escola['school_id']?>"><?=$escola['nome']?></option>
                    <?php  }?>
                </select><br><br>
                <small style="color: red; display: block; margin-bottom: 5px;" id="school_id"></small>

                <label for="">Classe</label><br>
                <select name="classe" required>
                    <option value="10-Classe">10-Classe</option>
                    <option value="11-Classe">11-Classe</option>
                    <option value="12-Classe">12-Classe</option>
                    <option value="13-Classe">13-Classe</option>
                </select>
                <br><br>
                <small style="color: red; display: block; margin-bottom: 5px;" id="classe"></small>

                <label for="">Seleciona Provincia</label><br>
                <select name="provincia" required>
                    <option value="Luanda">Luanda</option>
                    <option value="Malanje">Malanje</option>
                </select><br>
                <small style="color: red; display: block; margin-bottom: 5px;" id="provincia"></small>

                <div class="element">
                    <button class="button" type="submit">Registrar aluno</button>
                </div>
            </div>
            <div class="imagemregister">
                <img class="gif" src="assets/img/register.png" alt="" >
                    
            </div>
        </section>
    </form>
</main>

<script>
    document.getElementById("addAluno").addEventListener('submit', function(e)
    {
        e.preventDefault();
        document.getElementById("nome").innerText = "";
        document.getElementById("classe").innerText = "";
        document.getElementById("provincia").innerText = "";
        document.getElementById("school_id").innerText = "";

        const formData = new FormData(this);

        fetch('actions/addAluno.php',
            {
                method:"POST",
                body:formData
            }
        ).then(response => response.json()).
        then(data =>
        {
            if (data.success)
            {
                swal("Sucesso!", "Novo aluno inserido com sucesso", "success");
                this.reset();
            }
            else
            {
                document.getElementById("nome").innerText=data.validate.nome;
                document.getElementById("provincia").innerText=data.validate.provincia ?? '';
                document.getElementById("classe").innerText=data.validate.classe;
                document.getElementById("school_id").innerText=data.validate.school_id;
            }
        }).catch(error => console.log('Error:', error));
    });
</script>
<?php require_once 'footer.php' ?>