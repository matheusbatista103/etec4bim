<?php
session_start();
include_once 'conexao.php';  // Usa PDO, como no resto do projeto

if (!isset($_SESSION['idUsuario'])) {
    header('Location: login.php');  // Redireciona se não logado
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $data_lancamento = $_POST['data_lancamento'] ?? null;  // Opcional
    $tempo_filme = $_POST['tempo_filme'] ?? null;  // Opcional
    $nota = $_POST['nota'] ?? null;  // Nota inicial (opcional)

    // Upload de imagem
    $imagem = null;
    if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] == 0) {
        $extensao = pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION);
        $extensoesPermitidas = ['jpg', 'jpeg', 'png', 'gif'];
        if (in_array(strtolower($extensao), $extensoesPermitidas)) {
            $nomeImagem = uniqid() . '.' . $extensao;
            $caminho = 'uploads/' . $nomeImagem;
            if (move_uploaded_file($_FILES['imagem']['tmp_name'], $caminho)) {
                $imagem = $caminho;
            } else {
                echo "Erro ao fazer upload da imagem.";
                exit;
            }
        } else {
            echo "Extensão de imagem inválida.";
            exit;
        }
    }

    // Inserir filme
    $sql = "INSERT INTO filmes (nome, descricao, data_lancamento, tempo_filme, imagem) VALUES (?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$nome, $descricao, $data_lancamento, $tempo_filme, $imagem]);
    $idFilme = $pdo->lastInsertId();

    // Adicionar review inicial se nota fornecida
    if (!empty($nota) && is_numeric($nota) && $nota >= 1 && $nota <= 10) {
        $idUsuario = $_SESSION['idUsuario'];
        $sqlReview = "INSERT INTO review (idUsuario, idFilmes, nota, descricao) VALUES (?, ?, ?, '')";
        $stmtReview = $pdo->prepare($sqlReview);
        $stmtReview->execute([$idUsuario, $idFilme, $nota]);
    }

    header("Location: filme.php?id=$idFilme");  // Redireciona para a página do filme
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Adicionar Filme</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Adicionar Filme</h2>
        <form method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label>Imagem:</label>
                <input type="file" name="imagem" class="form-control" accept="image/*" required>
            </div>
            <div class="mb-3">
                <label>Nome do Filme:</label>
                <input type="text" name="nome" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Descrição:</label>
                <textarea name="descricao" class="form-control" required></textarea>
            </div>
            <div class="mb-3">
                <label>Data de Lançamento (Ano, opcional):</label>
                <input type="number" name="data_lancamento" class="form-control" min="1900" max="2100">
            </div>
            <div class="mb-3">
                <label>Tempo do Filme (ex.: 120 min, opcional):</label>
                <input type="text" name="tempo_filme" class="form-control">
            </div>
            <div class="mb-3">
                <label>Avaliação Inicial (Nota 1-10, opcional):</label>
                <input type="number" name="nota" min="1" max="10" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Enviar</button>
        </form>
        <a href="principal.php" class="btn btn-secondary mt-3">Voltar</a>
    </div>
</body>
</html>