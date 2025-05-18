<?php
require '../config.php';
$conexao = getConnection();
$busca = $_GET['busca'] ?? '';

$stmt = $conexao->prepare("
    SELECT alunos.id, alunos.nome, alunos.classe, alunos.provincia, schools.nome AS escola_nome
    FROM alunos
    JOIN schools ON alunos.school_id = schools.school_id
    WHERE alunos.nome LIKE ? OR schools.nome LIKE ?
    ORDER BY alunos.id DESC LIMIT 30
");
$stmt->execute(["%$busca%", "%$busca%"]);
$alunos = $stmt->fetchAll(PDO::FETCH_ASSOC);

getResponse(true, 'busca feita',$alunos, []);

