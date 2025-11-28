<?php
session_start();
require '../conexao.php';

$isAdmin = (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') || (isset($_SESSION['email']) && $_SESSION['email'] === 'admin@gmail.com');
if (!$isAdmin) {
    header('Location: ../login.php');
    exit;
}

// Ações de administração: renomear e remover usuários
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    $id = isset($_POST['id']) ? (int)$_POST['id'] : 0;
    if ($id > 0) {
        if ($action === 'delete') {
            // Remove reviews do usuário e depois o usuário
            $pdo->prepare('DELETE FROM review WHERE idUsuario = :id')->execute([':id' => $id]);
            $pdo->prepare('DELETE FROM usuarios WHERE idUsuario = :id')->execute([':id' => $id]);
            header('Location: usuarios.php?deleted=1');
            exit;
        } elseif ($action === 'rename') {
            $novo = trim($_POST['novo_nome'] ?? '');
            // Permite vazio (nome removido) ou novo nome
            $stmt = $pdo->prepare('UPDATE usuarios SET nome = :nome WHERE idUsuario = :id');
            $stmt->execute([':nome' => $novo !== '' ? $novo : null, ':id' => $id]);
            header('Location: usuarios.php?renamed=1');
            exit;
        } elseif ($action === 'role') {
            $role = ($_POST['role'] ?? 'user') === 'admin' ? 'admin' : 'user';
            $pdo->prepare('UPDATE usuarios SET role = :role WHERE idUsuario = :id')->execute([':role' => $role, ':id' => $id]);
            header('Location: usuarios.php?updated=1');
            exit;
        }
    }
}

$stmt = $pdo->query("SELECT idUsuario, nome, email, role FROM usuarios ORDER BY idUsuario ASC");
$usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuários</title>
    <link rel="stylesheet" href="../css/painel.css">
    <link rel="stylesheet" href="../css/style_listagem.css">
</head>
<body>
    <?php include '../includes/header.php'; ?>

    <div class="container">
        <h1>Usuários cadastrados</h1>
        <?php if (isset($_GET['updated'])): ?>
            <div class="alert alert-success">Papel atualizado com sucesso.</div>
        <?php endif; ?>
        <?php if (isset($_GET['deleted'])): ?>
            <div class="alert alert-success">Usuário removido com sucesso.</div>
        <?php endif; ?>
        <?php if (isset($_GET['renamed'])): ?>
            <div class="alert alert-success">Nome de usuário atualizado.</div>
        <?php endif; ?>

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>E-mail</th>
                    <th>Papel</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($usuarios as $u): ?>
                    <tr>
                        <td><?= htmlspecialchars($u['idUsuario']) ?></td>
                        <td><?= htmlspecialchars($u['nome']) ?></td>
                        <td><?= htmlspecialchars($u['email']) ?></td>
                        <td><?= htmlspecialchars($u['role'] ?? 'user') ?></td>
                        <td>
                            <form action="usuarios.php" method="POST" style="display:inline-block;">
                                <input type="hidden" name="action" value="role">
                                <input type="hidden" name="id" value="<?= (int)$u['idUsuario'] ?>">
                                <input type="hidden" name="role" value="admin">
                                <button type="submit" class="btn btn-danger">Tornar admin</button>
                            </form>
                            <form action="usuarios.php" method="POST" style="display:inline-block; margin-left:8px;">
                                <input type="hidden" name="action" value="role">
                                <input type="hidden" name="id" value="<?= (int)$u['idUsuario'] ?>">
                                <input type="hidden" name="role" value="user">
                                <button type="submit" class="btn btn-secondary">Tornar user</button>
                            </form>
                            <form action="usuarios.php" method="POST" style="display:inline-block; margin-left:8px;">
                                <input type="hidden" name="action" value="rename">
                                <input type="hidden" name="id" value="<?= (int)$u['idUsuario'] ?>">
                                <input type="text" name="novo_nome" placeholder="Novo nome" class="form-control" style="width:160px; display:inline-block;">
                                <button type="submit" class="btn btn-warning" style="margin-left:6px;">Renomear</button>
                            </form>
                            <form action="usuarios.php" method="POST" style="display:inline-block; margin-left:8px;" onsubmit="return confirm('Remover este usuário? Esta ação é irreversível.');">
                                <input type="hidden" name="action" value="delete">
                                <input type="hidden" name="id" value="<?= (int)$u['idUsuario'] ?>">
                                <button type="submit" class="btn btn-secondary">Remover</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <a href="painel.php" class="btn btn-warning">Voltar ao painel</a>
    </div>

    <?php include '../includes/rodape.php'; ?>
</body>
</html>
