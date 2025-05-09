<?php

function getConnection()
{
    try 
    {
        $conexao = new PDO("mysql:host=localhost;dbname=jogo","root","");
        $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conexao;
    } catch (\PDOException $th) 
    {
        echo "error". $th->getMessage();
    }
}


function getResponse(bool $success, string $message, $data = [], $validate = [])
{
    header('Content-Type: application/json');
    $datas = [
        'success' => $success, // <- CORRETO
        'message' => $message,
        'data' => $data,
        'validate' => $validate
    ];

    echo json_encode($datas);
    exit;
}
