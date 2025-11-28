<?php
$host = 'localhost';
$dbname = 'sistema';
$user = 'root';
$pass = '';
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    try {
        $check = $pdo->query("SELECT COUNT(*) AS cnt FROM information_schema.COLUMNS WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'usuarios' AND COLUMN_NAME = 'role'");
        $exists = (int)$check->fetch(PDO::FETCH_ASSOC)['cnt'] > 0;
        if (!$exists) {
            $pdo->exec("ALTER TABLE usuarios ADD COLUMN role ENUM('user','admin') NOT NULL DEFAULT 'user'");
            $stmtAdmin = $pdo->prepare("UPDATE usuarios SET role = 'admin' WHERE email = :email");
            $stmtAdmin->execute([':email' => 'admin@gmail.com']);
        }
        $checkGenero = $pdo->query("SELECT COUNT(*) AS cnt FROM information_schema.COLUMNS WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'filmes' AND COLUMN_NAME = 'genero'");
        $existsGenero = (int)$checkGenero->fetch(PDO::FETCH_ASSOC)['cnt'] > 0;
        if (!$existsGenero) {
            $pdo->exec("ALTER TABLE filmes ADD COLUMN genero VARCHAR(100) DEFAULT 'Outros'");
        }
    } catch (Throwable $e) {
    }
} catch (PDOException $e) {
    echo "Erro na conexão: " . $e->getMessage();
}
?>
