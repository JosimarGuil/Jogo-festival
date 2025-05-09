<?php

require 'config.php';

$conexao = getConnection();

if ($_SERVER['REQUEST_METHOD'] !== 'GET')
    getResponse(false, 'Método de envio não autorizado!', [], []);

if (!$_GET['id'])
    getResponse(false, 'É necessário!', [], []);

$aluno = $conexao->prepare("SELECT * FROM  alunos WHERE  id = ?");
$aluno->execute([$_GET['id']]);
$alunoSingle= $aluno->fetch(PDO::FETCH_ASSOC);

if ($aluno->rowCount() == 0)
    getResponse(false, 'Aluno não registrado!', [], []);

$presenc = $conexao->prepare("SELECT * FROM  prsenca WHERE  nome = ?");
$presenc->execute([$alunoSingle['nome']]);

if ($presenc->rowCount() > 0)
    getResponse(false, 'O aluno já está presente!', [], []);

$stmt = $conexao->prepare("INSERT INTO prsenca (nome, school_id) VALUES (?, ?)");
$stmt->execute([$alunoSingle['nome'], $alunoSingle['school_id']]);
getResponse(true, 'Presença confirmada com sucesso!', [], []);
