<?php
require_once __DIR__ . '/includes/config.php';
$id = (int)($_GET['id'] ?? 0);
$stmt = $pdo->prepare("SELECT * FROM posts WHERE id = ?");
$stmt->execute([$id]);
$post = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$post) {
    http_response_code(404);
    die('Artículo no encontrado. <a href="blog.php">Volver al blog</a>');
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= e($post['titulo']) ?> — Raíces &amp; Vida</title>
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

<main class="container container-narrow">
  <article class="post-full">
    <div class="post-hero"><span><?= e($post['icono']) ?></span></div>
    <span class="badge badge-soft"><?= date('d/m/Y', strtotime($post['fecha'])) ?></span>
    <h1><?= e($post['titulo']) ?></h1>
    <div class="post-content"><?= nl2br(e($post['contenido'])) ?></div>
    <hr>
    <div class="center">
      <a class="btn btn-wsp" href="<?= WHATSAPP_LINK ?>?text=<?= urlencode('Hola, leí el artículo "' . $post['titulo'] . '" y quiero hacer un pedido 🌿') ?>" target="_blank">Hacer un pedido por WhatsApp</a>
      <a class="btn btn-outline" href="blog.php">← Volver al blog</a>
    </div>
  </article>
</main>

<footer class="footer">
  <p class="copy">© <?= date('Y') ?> Raíces&amp;Vida</p>
</footer>
</body>
</html>
