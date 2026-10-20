<?php
require_once __DIR__ . '/includes/config.php';

// Consultamos productos activos y los últimos 3 artículos del blog
$productos = $pdo->query("SELECT * FROM productos WHERE activo = 1 ORDER BY id DESC")
                 ->fetchAll(PDO::FETCH_ASSOC);
$posts = $pdo->query("SELECT id, titulo, icono, resumen, fecha FROM posts ORDER BY fecha DESC LIMIT 3")
               ->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Raíces &amp; Vida — Productos Naturales</title>
<meta name="description" content="Tienda de productos naturales: miel pura, aceites, infusiones y cuidado personal. Pide por WhatsApp.">
<link rel="icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='.9em' font-size='90'>🌿</text></svg>">
<link rel="stylesheet" href="css/style.css">
</head>
<body>

<header class="header">
  <div class="container header-inner">
    <a class="logo" href="index.php">🌿 Raíces<span>&amp;Vida</span></a>
    <nav class="nav">
      <a href="#productos">Productos</a>
      <a href="blog.php">Blog</a>
      <a href="#como-comprar">Cómo comprar</a>
      <a href="#contacto">Contacto</a>
    </nav>
    <button class="btn-cart" id="abrirCarrito" aria-label="Abrir carrito">
      🛒 <span class="cart-count" id="cartCount">0</span>
    </button>
  </div>
</header>

<section class="hero">
  <div class="container">
    <h1>Lo natural, directo a tu puerta</h1>
    <p>Productos naturales de productores locales. Sin intermediarios, sin químicos. Haz tu pedido y coordina la entrega por WhatsApp.</p>
    <div class="hero-actions">
      <a class="btn" href="#productos">Ver productos</a>
      <a class="btn btn-wsp" href="<?= WHATSAPP_LINK ?>?text=<?= urlencode('Hola, quiero información sobre sus productos 🌿') ?>" target="_blank">Escríbenos por WhatsApp</a>
    </div>
  </div>
</section>

<main class="container">

  <!-- CÓMO COMPRAR -->
  <section class="steps" id="como-comprar">
    <div class="step"><span>1</span><h4>Elige tus productos</h4><p>Explora el catálogo y agrega al carrito.</p></div>
    <div class="step"><span>2</span><h4>Envía por WhatsApp</h4><p>Tu pedido llega armado a nuestro chat.</p></div>
    <div class="step"><span>3</span><h4>Coordinamos entrega</h4><p>Pago y entrega acordados contigo.</p></div>
  </section>

  <!-- CATÁLOGO -->
  <section id="productos">
    <h2 class="section-title">Nuestros productos</h2>
    <div class="grid" id="gridProductos">
      <?php foreach ($productos as $p): ?>
      <article class="card">
        <div class="card-img"><span><?= e($p['icono']) ?></span></div>
        <div class="card-body">
          <span class="badge"><?= e($p['categoria']) ?></span>
          <h3><?= e($p['nombre']) ?></h3>
          <p class="desc"><?= e($p['descripcion']) ?></p>
          <div class="card-foot">
            <span class="precio"><?= precio((float)$p['precio']) ?></span>
            <div class="qty">
              <button class="qty-btn" data-accion="restar">−</button>
              <input type="number" class="qty-input" value="1" min="1" max="<?= (int)$p['stock'] ?>">
              <button class="qty-btn" data-accion="sumar">+</button>
            </div>
          </div>
          <button class="btn btn-block btn-add"
                  data-id="<?= (int)$p['id'] ?>"
                  data-nombre="<?= e($p['nombre']) ?>"
                  data-precio="<?= (float)$p['precio'] ?>">
            Agregar al pedido 🛒
          </button>
          <a class="btn-wsp-link" target="_blank"
             href="<?= WHATSAPP_LINK ?>?text=<?= urlencode('Hola, quiero comprar: 1 x ' . $p['nombre'] . ' (' . precio((float)$p['precio']) . ')') ?>">
             Comprar ahora por WhatsApp →
          </a>
        </div>
      </article>
      <?php endforeach; ?>
    </div>
  </section>

  <!-- BLOG (vista previa) -->
  <section>
    <h2 class="section-title">Del blog 🌱</h2>
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
    <div class="center"><a class="btn btn-outline" href="blog.php">Ver todos los artículos</a></div>
  </section>
</main>

<footer class="footer" id="contacto">
  <div class="container footer-grid">
    <div>
      <h4>🌿 Raíces&amp;Vida</h4>
      <p>Productos naturales de la tierra a tu hogar.</p>
    </div>
    <div>
      <h4>Contacto</h4>
      <p>📱 <a href="<?= WHATSAPP_LINK ?>" target="_blank">WhatsApp</a><br>
         ✉️ hola@tutienda.com<br>
         📍 Calle Ejemplo 123, Ciudad</p>
    </div>
    <div>
      <h4>Horario</h4>
      <p>Lunes a Sábado<br>9:00 — 18:00</p>
    </div>
  </div>
  <p class="copy">© <?= date('Y') ?> Raíces&amp;Vida — Hecho con HTML, CSS, JS y MySQL ❤️</p>
</footer>

<!-- CARRITO (panel deslizable) -->
<aside class="drawer" id="drawer">
  <div class="drawer-head">
    <h3>Tu pedido 🛒</h3>
    <button id="cerrarCarrito" class="drawer-close" aria-label="Cerrar">✕</button>
  </div>
  <div class="drawer-items" id="carritoItems"></div>
  <div class="drawer-foot">
    <div class="total"><span>Total</span><strong id="carritoTotal">$0.00</strong></div>
    <button class="btn btn-wsp btn-block" id="enviarWhatsApp">Enviar pedido por WhatsApp</button>
    <button class="btn-link" id="vaciarCarrito">Vaciar carrito</button>
  </div>
</aside>
<div class="overlay" id="overlay"></div>
<div class="toast" id="toast"></div>

<script src="js/main.js"></script>
</body>
</html>
