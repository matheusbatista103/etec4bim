<?php
session_start();
$isAdmin = (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') || (isset($_SESSION['email']) && $_SESSION['email'] === 'admin@gmail.com');
if (!$isAdmin) { header('Location: ../login.php'); exit; }
require_once '../conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'] ?? '';
    $descricao = $_POST['descricao'] ?? '';
    $data_lancamento = $_POST['data_lancamento'] ?? null;
    $tempo_filme = $_POST['tempo_filme'] ?? null;
    $genero = $_POST['genero'] ?? 'Outros';

    $imagem = null;
    if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === 0) {
        $ext = strtolower(pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION));
        if (in_array($ext, ['jpg','jpeg','png','gif'])) {
            $nomeImagem = time() . '_' . preg_replace('/[^a-zA-Z0-9_\.]/', '_', $_FILES['imagem']['name']);
            $dest = '../uploads/' . $nomeImagem;
            if (!is_dir('../uploads')) { mkdir('../uploads', 0755, true); }
            if (move_uploaded_file($_FILES['imagem']['tmp_name'], $dest)) {
                $imagem = 'uploads/' . $nomeImagem;
            }
        }
    }

    $stmt = $pdo->prepare('INSERT INTO filmes (nome, descricao, data_lancamento, tempo_filme, genero, imagem) VALUES (:nome, :descricao, :data, :tempo, :genero, :imagem)');
    $stmt->execute([':nome'=>$nome, ':descricao'=>$descricao, ':data'=>$data_lancamento, ':tempo'=>$tempo_filme, ':genero'=>$genero, ':imagem'=>$imagem]);
    $id = $pdo->lastInsertId();
    header('Location: ../filme.php?id=' . (int)$id);
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Adicionar Filme (Admin)</title>
  <link rel="stylesheet" href="../css/style_cadastro.css">
</head>
<body>
  <div class="container">
    <h2>Adicionar Filme</h2>
    <form method="POST" enctype="multipart/form-data">
      <div class="mb-3">
        <label>Imagem</label>
        <input type="file" name="imagem" class="form-control" accept="image/*">
      </div>
      <div class="mb-3">
        <label>Nome do Filme</label>
        <input type="text" name="nome" class="form-control" required>
      </div>
      <div class="mb-3">
        <label>Descrição</label>
        <textarea name="descricao" class="form-control" required></textarea>
      </div>
      <div class="mb-3">
        <label>Data de Lançamento (Ano)</label>
        <input type="number" name="data_lancamento" class="form-control" min="1900" max="2100">
      </div>
      <div class="mb-3">
        <label>Tempo do Filme (ex.: 120 min)</label>
        <input type="text" name="tempo_filme" class="form-control">
      </div>
      <div class="mb-3">
        <label>Gênero</label>
        <select name="genero" class="form-control" required>
          <option value="Ação">Ação</option>
          <option value="Drama">Drama</option>
          <option value="Comédia">Comédia</option>
          <option value="Ficção Científica">Ficção Científica</option>
          <option value="Terror">Terror</option>
          <option value="Romance">Romance</option>
          <option value="Animação">Animação</option>
          <option value="Thriller">Thriller</option>
          <option value="Aventura">Aventura</option>
          <option value="Fantasia">Fantasia</option>
          <option value="Crime">Crime</option>
          <option value="Mistério">Mistério</option>
          <option value="Biografia">Biografia</option>
          <option value="Guerra">Guerra</option>
          <option value="Western">Western</option>
          <option value="Musical">Musical</option>
          <option value="Documentário">Documentário</option>
          <option value="Outros">Outros</option>
        </select>
      </div>
      <button type="submit" class="btn btn-primary">Salvar</button>
      <a href="painel.php" class="btn btn-secondary" style="margin-left:8px;">Voltar</a>
    </form>
  </div>
</body>
</html>
