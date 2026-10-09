<?php

require "config.php";

$rota = $_GET["rota"] ?? ($_SERVER["REQUEST_METHOD"] === "POST" ? "Alunos"  : "teste");

function teste(){
    echo "API respondendo com sucesso!";
}

function listarAlunos($con){
    $stmt = $con->query("SELECT * FROM Alunos");
    echo json_encode($stmt ->fetchAll(PDO::FETCH_ASSOC));
}

function listarInstrutores($con){
    $stmt = $con->query("SELECT * FROM Instrutores");
    echo json_encode($stmt ->fetchAll(PDO::FETCH_ASSOC));
}

function adicionarAlunos($con){
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $telefone = $_POST["telefone"];
    $data_nascimento = $_POST["data_nascimento"];
    try{
        $stmt = $con->prepare("INSERT INTO Alunos (nome, email, telefone, data_nascimento) VALUES (?, ?,?,?)");
        $stmt ->execute([$nome,$email,$telefone,$data_nascimento]);
        header("Location: ../front/alunos.html");
    }catch (PDOExcepetion $e){
        header("Location: ../front/erro.html");
    }
    exit;
}

function adicionarInstrutores($con){
    $nomeInstrutores = $_POST["nome"];
    $emailInstrutores = $_POST["email"];
    $telefoneInstrutores = $_POST["telefone"];
    $data_nascimentoInstrutores = $_POST["data_nascimento"];
    try{
        $stmt = $con->prepare("INSERT INTO Aluno (nomeInstrutores, emailInstrutores, telefoneInstrutores, data_nascimentoInstrutores) VALUES (?, ?)");
        $stmt ->execute([$nome,$email,$telefone,$data_nascimento]);
        header("Location: ../front/aluno.html");
    }catch (PDOExcepetion $e){
        header("Location: ../front/erro.html");
    }
    exit;
}

if($_SERVER["REQUEST_METHOD"] === "POST") {
    adicionarAlunos($con);
}else if ($rota === "aluno"){
    listarAlunos($con);
}else if($rota === "instrutor"){
    listarInstrutores($con);
}else {
    teste();
}
    
?>
