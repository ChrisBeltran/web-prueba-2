<?php
require_once __DIR__ . '/includes/config.php';
$posts = $pdo->query("SELECT * FROM posts ORDER BY fecha DESC")->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Blog — Raíces &amp; Vida</title>
<link rel="icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='.9em' font-size='90'>🌿</text></svg>">
<link rel="stylesheet" href="css/style.css">
</head>
<body>
<header class="header">
  <div class="container header-inner">
    <a class="logo" href="index.php">🌿 Raíces<span>&amp;Vida</span></a>
    <nav class="nav">
      <a href="index.php#productos">Productos</a>
      <a href="blog.php">Blog</a>
      <a href="index.php#contacto">Contacto</a>
    </nav>
    <a class="btn-cart" href="index.php">🛒</a>
  </div>
</header>

<main class="container">
  <h2 class="section-title">Blog 🌱</h2>
  <div class="grid grid-3">
    <?php foreach ($posts as $post): ?>
    <a class="card post-card" href="post.php?id=<?= (int)$post['id'] ?>">
      <div class="card-img post-img"><span><?= e($post['icono']) ?></span></div>
      <div class="card-body">
        <span class="badge badge-soft"><?= date('d/m/Y', strtotime($post['fecha'])) ?></span>
        <h3><?= e($post['titulo']) ?></h3>
        <p class="desc"><?= e($post['resumen']) ?></p>
        <span class="leer-mas">Leer artículo →</span>
      </div>
    </a>
    <?php endforeach; ?>
  </div>
</main>

<footer class="footer">
  <p class="copy">© <?= date('Y') ?> Raíces&amp;Vida</p>
</footer>
</body>
</html>
