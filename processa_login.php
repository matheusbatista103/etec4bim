<?php 
session_start();
include_once 'conexao.php';

$email = $_POST['email'] ?? '';
$senha = $_POST['senha'] ?? '';

$consulta = "SELECT * FROM usuarios WHERE email = :email LIMIT 1";
$stmt = $pdo->prepare($consulta);
$stmt->bindParam(':email', $email);
$stmt->execute();

if ($stmt->rowCount() == 1) {
    $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

    $senhaHash = $resultado['senha'] ?? '';
    $verificado = false;

    if (!empty($senhaHash) && password_get_info($senhaHash)['algo'] !== 0) {
        $verificado = password_verify($senha, $senhaHash);
    } else {
        $verificado = hash_equals($senhaHash, $senha);
        if ($verificado) {
            $novoHash = password_hash($senha, PASSWORD_DEFAULT);
            $upd = $pdo->prepare("UPDATE usuarios SET senha = :senha WHERE idUsuario = :id");
            $upd->execute([':senha' => $novoHash, ':id' => $resultado['idUsuario']]);
            $senhaHash = $novoHash;
        }
    }

    if ($verificado) {
        $_SESSION['idUsuario'] = $resultado['idUsuario'];
        $_SESSION['nome'] = $resultado['nome'];
        $_SESSION['email'] = $resultado['email'];
        $_SESSION['role'] = $resultado['role'] ?? null;

        $isAdmin = (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') || ($_SESSION['email'] === 'admin@gmail.com');
        if ($isAdmin) {
            header('Location: adm/painel.php');
            exit;
        } else {
            header('Location: principal.php');
            exit;
        }
    } else {
        $_SESSION['erro'] = "E-mail ou senha incorretos!";
        header('Location: login.php');
        exit;
    }
} else {
    $_SESSION['erro'] = "E-mail ou senha incorretos!";
    header('Location: login.php');
    exit;
}
?>
