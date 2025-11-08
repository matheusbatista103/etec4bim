<?php
// processa_cadastro.php
session_start();

include_once 'conexao.php';

$nome = $_POST['nome'];
$email = $_POST['email'];
$senha = $_POST['senha'];
$confirmar_senha = $_POST['confirmar_senha'];

// Verificar se as senhas coincidem
if ($senha !== $confirmar_senha) {
    $_SESSION['erro'] = "As senhas não coincidem!";
    header('Location: cadastro.php');
    exit;
}

// Verificar se o e-mail já existe
$consulta = "SELECT * FROM usuarios WHERE email = :email";
$stmt = $pdo->prepare($consulta);
$stmt->bindParam(':email', $email);
$stmt->execute();

if ($stmt->rowCount() > 0) {
    $_SESSION['erro'] = "E-mail já cadastrado!";
    header('Location: cadastro.php');
    exit;
}

// Inserir novo usuário (sem idReview, pois a coluna foi removida do banco)
$inserir = "INSERT INTO usuarios (nome, email, senha) VALUES (:nome, :email, :senha)";
$stmt = $pdo->prepare($inserir);
$stmt->bindParam(':nome', $nome);
$stmt->bindParam(':email', $email);
$stmt->bindParam(':senha', $senha);

if ($stmt->execute()) {
    $_SESSION['sucesso'] = "Cadastro realizado com sucesso! Faça login.";
    header('Location: login.php');
    exit;
} else {
    $_SESSION['erro'] = "Erro ao cadastrar. Tente novamente.";
    header('Location: cadastro.php');
    exit;
}
?>