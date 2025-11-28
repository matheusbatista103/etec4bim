<!-- header.php -->
<?php
/* Base de caminho para links quando dentro de /adm */
$base = (strpos($_SERVER['PHP_SELF'], '/adm/') !== false) ? '../' : '';

/* Processa ações do menu de configurações: atualizar nome ou apagar conta */
if (isset($_SESSION['idUsuario']) && $_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['header_action'])) {
  $action = $_POST['header_action'];
  if ($action === 'update_name') {
    require_once $base . 'conexao.php';
    $new = trim($_POST['new_name'] ?? '');
    $stmt = $pdo->prepare('UPDATE usuarios SET nome = :nome WHERE idUsuario = :id');
    $stmt->execute([':nome' => ($new !== '' ? $new : null), ':id' => $_SESSION['idUsuario']]);
    $_SESSION['nome'] = $new !== '' ? $new : '';
  } elseif ($action === 'delete_account') {
    require_once $base . 'conexao.php';
    $id = (int)$_SESSION['idUsuario'];
    $pdo->prepare('DELETE FROM review WHERE idUsuario = :id')->execute([':id' => $id]);
    $pdo->prepare('DELETE FROM usuarios WHERE idUsuario = :id')->execute([':id' => $id]);
    session_unset();
    session_destroy();
    header('Location: ' . $base . 'index.php');
    exit;
  }
}
?>
<header>
  <nav class="navbar">
    <h1 class="logo">EtecFlix</h1>
    <ul class="menu">
      <?php
      if (isset($_SESSION['idUsuario'])) {
          $nomeSess = trim($_SESSION['nome'] ?? '');
          $primeiroNome = $nomeSess !== '' ? explode(' ', $nomeSess)[0] : 'Anônimo';
          echo '<li>Olá, ' . htmlspecialchars($primeiroNome) . '</li>';
      }
      ?>

      <li><a href="<?php echo $base; ?>principal.php" class="active">Início</a></li>
      <li><a href="<?php echo $base; ?>sobre.php">Sobre</a></li>

      <?php
      if (isset($_SESSION['idUsuario'])) {
          echo '<li class="settings">'
             . '<button type="button" class="settings-toggle">Configurações ⚙️</button>'
             . '<div class="settings-menu">'
               . '<div class="settings-row">'
                 . '<label>Tema</label>'
                 . '<button type="button" id="themeToggle" class="btn-small">Alternar tema</button>'
               . '</div>'
               . '<form method="post" class="settings-row" action="">'
                 . '<input type="hidden" name="header_action" value="update_name">'
                 . '<label>Meu nome</label>'
                 . '<input type="text" name="new_name" value="' . htmlspecialchars($_SESSION['nome'] ?? '') . '" placeholder="Vazio = Anônimo">'
                 . '<button type="submit" class="btn-small">Salvar</button>'
               . '</form>'
               . '<div class="settings-row"><a href="' . $base . 'logout.php" class="btn-small" style="text-decoration:none;">Sair</a></div>'
               . '<form method="post" class="settings-row" action="" onsubmit="return confirm(\'Apagar sua conta? Esta ação é irreversível.\')">'
                 . '<input type="hidden" name="header_action" value="delete_account">'
                 . '<button type="submit" class="btn-danger-small">Apagar conta</button>'
               . '</form>'
             . '</div>'
           . '</li>';
      } else {
          echo '<li><a href="' . $base . 'login.php">Login</a></li>';
      }
      ?>
    </ul>
  </nav>
  <style>
    /* Estilo do menu de configurações no header */
    .settings { position: relative; }
    .settings-toggle { background:#333; color:#fff; border:none; border-radius:8px; padding:8px 10px; cursor:pointer; }
    .settings-menu { position:absolute; right:0; top:120%; background:#1a1a1a; border:1px solid #333; border-radius:10px; padding:12px; width:280px; display:none; box-shadow:0 8px 28px rgba(0,0,0,0.4); }
    .settings.open .settings-menu { display:block; }
    .settings-row { display:flex; flex-direction:column; gap:6px; align-items:stretch; margin-bottom:12px; }
    .settings-row label { color:#ccc; }
    .settings-row input[type=text] { padding:8px 10px; border-radius:8px; border:1px solid #333; background:#141414; color:#fff; }
    .btn-small { padding:8px 10px; border-radius:8px; border:none; background:#333; color:#fff; cursor:pointer; }
    .btn-small:hover { background:#444; }
    .btn-danger-small { padding:8px 10px; border-radius:8px; border:none; background:#222; color:#fff; cursor:pointer; }
    .btn-danger-small:hover { background:#333; }
    /* Overrides de tema claro: superfícies claras e botões em cinza */
    body.light { background:#f5f5f5; color:#111; }
    body.light .logo { color:#111; }
    body.light .menu li a:hover { background:#ddd; color:#111; }
    body.light .settings-toggle, body.light .btn-small, body.light .btn-danger-small { background:#6a6a6a; color:#fff; }
    body.light .settings-toggle:hover, body.light .btn-small:hover, body.light .btn-danger-small:hover { background:#555; color:#fff; }
    body.light .settings-menu { background:#fff; border-color:#ddd; }
    body.light .settings-row input[type=text] { background:#fff; border-color:#ddd; color:#111; }
  </style>
  <script>
    (function(){
      /* Aplica tema salvo no localStorage ao carregar */
      const isLight = localStorage.getItem('theme') === 'light';
      if (isLight) document.body.classList.add('light');

      /* Controle de abertura/fechamento do menu de configurações */
      document.addEventListener('click', function(e){
        const settings = document.querySelector('.settings');
        if (!settings) return;
        if (e.target && e.target.classList.contains('settings-toggle')) {
          settings.classList.toggle('open');
        } else if (!settings.contains(e.target)) {
          settings.classList.remove('open');
        }
      });

      /* Alterna tema e persiste escolha */
      const btn = document.getElementById('themeToggle');
      if (btn) {
        btn.addEventListener('click', function(){
          const light = document.body.classList.toggle('light');
          localStorage.setItem('theme', light ? 'light' : 'dark');
        });
      }
    })();
  </script>
</header>
