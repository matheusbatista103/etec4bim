<?php
session_start();
include_once 'conexao.php';

// Busca de filmes com suporte a pesquisa
$q = isset($_GET['q']) ? trim($_GET['q']) : '';
if ($q !== '') {
    $sql = "SELECT idFilmes, nome, descricao, imagem, genero FROM filmes WHERE nome LIKE :q OR descricao LIKE :q ORDER BY genero ASC, idFilmes DESC";
    $stmt = $pdo->prepare($sql);
    $like = "%" . $q . "%";
    $stmt->bindParam(':q', $like, PDO::PARAM_STR);
    $stmt->execute();
    $filmes = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
    $sql = "SELECT idFilmes, nome, descricao, imagem, genero FROM filmes ORDER BY genero ASC, idFilmes DESC";
    $filmes = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EtecFlix - Principal</title>
    <link rel="stylesheet" href="css/principal.css">
</head>
<body>
    <?php include __DIR__ . '/includes/header.php'; ?>

    <main class="main-content">
        <!-- Barra de pesquisa -->
        <form class="searchbar" method="get" action="principal.php">
            <input type="text" name="q" placeholder="Pesquisar filmes..." value="<?php echo htmlspecialchars($q); ?>">
            <button type="submit">Buscar</button>
        </form>
        <?php if (empty($filmes)): ?>
            <div class="empty-state">
                <div class="empty-state-content">
                    <h3><?php echo $q !== '' ? 'Nenhum resultado para a pesquisa' : 'Nenhum filme cadastrado ainda'; ?></h3>
                    <p><?php echo $q !== '' ? 'Tente outro termo ou limpe a busca.' : 'Compartilhe sua primeira resenha!'; ?></p>
                    <a href="adm/form_cadastrar.php" class="btn-add-film">+ Adicionar Filme</a>
                    <a href="adm/seed_filmes.php" class="btn-add-film" style="margin-left:8px;">Popular filmes</a>
                </div>
            </div>
        <?php else: ?>
            <?php
                $porGenero = [];
                foreach ($filmes as $f) {
                    $g = $f['genero'] ?? 'Outros';
                    if (!isset($porGenero[$g])) { $porGenero[$g] = []; }
                    $porGenero[$g][] = $f;
                }
            ?>
            <?php foreach ($porGenero as $genero => $lista): ?>
                <section>
                    <h2><?php echo htmlspecialchars($genero); ?></h2>
                    <div class="carousel">
                      <div class="carousel-controls">
                        <button class="carousel-btn prev" aria-label="Anterior">‹</button>
                        <button class="carousel-btn next" aria-label="Próximo">›</button>
                      </div>
                      <div class="movie-grid">
                        <?php foreach ($lista as $filme): ?>
                            <div class="movie-card">
                                <div class="movie-image">
                                    <img src="<?php echo htmlspecialchars($filme['imagem'] ?? 'img/default.jpg'); ?>" alt="<?php echo htmlspecialchars($filme['nome']); ?>">
                                </div>
                                <h3><?php echo htmlspecialchars($filme['nome']); ?></h3>
                                <p><?php echo htmlspecialchars(substr($filme['descricao'], 0, 100)) . '...'; ?></p>
                                <a href="filme.php?id=<?php echo $filme['idFilmes']; ?>" class="active">Avaliar</a>
                            </div>
                        <?php endforeach; ?>
                      </div>
                    </div>
                </section>
            <?php endforeach; ?>
        <?php endif; ?>
    </main>
    <script>
      // Carrossel infinito: estabilidade com trava curta para evitar cliques múltiplos
      document.querySelectorAll('.carousel').forEach(function(carousel){
        const grid = carousel.querySelector('.movie-grid');
        const prev = carousel.querySelector('.prev');
        const next = carousel.querySelector('.next');
        if (!grid) return;
        let busy = false;
        function movePrev(){
          if (busy) return; busy = true;
          const last = grid.lastElementChild;
          if (last) grid.insertBefore(last, grid.firstElementChild);
          setTimeout(function(){ busy = false; }, 120);
        }
        function moveNext(){
          if (busy) return; busy = true;
          const first = grid.firstElementChild;
          if (first) grid.appendChild(first);
          setTimeout(function(){ busy = false; }, 120);
        }
        const cardsCount = grid.children.length;
        if (cardsCount < 2) {
          if (prev) prev.disabled = true;
          if (next) next.disabled = true;
        } else {
          if (prev) prev.addEventListener('click', movePrev);
          if (next) next.addEventListener('click', moveNext);
        }
      });
    </script>

    <?php include __DIR__ . '/includes/rodape.php'; ?>
</body>
</html>
