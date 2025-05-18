<?php
require '../config.php';

if ($_SERVER["REQUEST_METHOD"] != "POST") {
    getResponse(false, "Método de envio inválido!");
    exit();
}

$nome = trim(filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS));
$school_id = filter_input(INPUT_POST, 'school_id', FILTER_VALIDATE_INT);
$classe = filter_input(INPUT_POST, 'classe', FILTER_SANITIZE_SPECIAL_CHARS);
$provincia = filter_input(INPUT_POST, 'provincia', FILTER_SANITIZE_SPECIAL_CHARS);

$error = ['nome' => '', 'school_id' => '', 'classe' => '', 'provincia' => ''];

if (!$nome) {
    $error['nome'] = 'O campo nome é obrigatório';
    validate($error);
}

if (strlen($nome) < 8) {
    $error['nome'] = 'O campo nome deve conter no mínimo 8 caracteres';
    validate($error);
}

if (strlen($nome) > 40) {
    $error['nome'] = 'O campo Nome deve conter no máximo 40 caracteres';
    validate($error);
}


if (!$school_id) {
    $error['school_id'] = 'O campo Escola é obrigatório';
    validate($error);
}

if (!$classe) {
    $error['classe'] = 'O campo Classe é obrigatório';
    validate($error);
}

if (!$provincia) {
    $error['provincia'] = 'O campo Provincia é obrigatório';
    validate($error);
}


try {
    $pdo = getConnection();

    $stmt = $pdo->prepare("SELECT * FROM alunos WHERE nome = ? and school_id = ?");
    $stmt->execute([$nome, $school_id]);

    if ($stmt->rowCount() > 0) 
    {
        $error['nome'] = 'Já existe um aluno com este nome!';
        validate($error);
    }
    // Inserir novo aluno
    $stmt = $pdo->prepare("INSERT INTO alunos (nome, school_id, classe, provincia) VALUES (?, ?, ?, ?)");
    $stmt->execute([$nome, $school_id, $classe, $provincia]);
    getResponse(true, 'Aluno cadastrado com sucesso', [], []);
} catch (PDOException $e) {
    getResponse(false, 'Erro no banco de dados: ' . $e->getMessage(), [], []);
}


function validate($error)
{
    getResponse(false, "", [], $error);
    exit();
}
