<!-- header.php -->
<header>
  <nav class="navbar">
    <h1 class="logo">EtecFlix</h1>
    <ul class="menu">
      <?php
      if (isset($_SESSION['idUsuario'])) {
          // Usuário logado: mostra primeiro nome e "Sair"
          $primeiroNome = explode(' ', $_SESSION['nome'])[0];  // Pega o primeiro nome
          echo '<li>Olá, ' . htmlspecialchars($primeiroNome) . '</li>';
      }
      ?>
      <li><a href="principal.php" class="active">Início</a></li>
      <li><a href="sobre.php">Sobre</a></li>
      <?php
      if (isset($_SESSION['idUsuario'])) {
          // Usuário logado: mostra "Sair"
          echo '<li><a href="../logout.php">Sair</a></li>';
      } else {
          // Usuário não logado: mostra "Login"
          echo '<li><a href="login.php">Login</a></li>';
      }
      ?>
    </ul>
  </nav>
</header>
