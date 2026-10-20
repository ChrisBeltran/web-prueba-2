/* ============================================
   Carrito de compras + pedido por WhatsApp
   El carrito se guarda en localStorage.
   ============================================ */

// ← CAMBIA esto por tu número (igual que en config.php)
const WHATSAPP = '593990000000';

const CLAVE_CARRITO = 'carrito_razicesyvida';
let carrito = JSON.parse(localStorage.getItem(CLAVE_CARRITO)) || [];

const drawer       = document.getElementById('drawer');
const overlay      = document.getElementById('overlay');
const cartCount    = document.getElementById('cartCount');
const carritoItems = document.getElementById('carritoItems');
const carritoTotal = document.getElementById('carritoTotal');
const toast        = document.getElementById('toast');

/* ---------- Persistencia ---------- */
function guardarCarrito() {
  localStorage.setItem(CLAVE_CARRITO, JSON.stringify(carrito));
}

/* ---------- Render ---------- */
function renderCarrito() {
  const totalItems = carrito.reduce((acc, p) => acc + p.cantidad, 0);
  cartCount.textContent = totalItems;

  if (carrito.length === 0) {
    carritoItems.innerHTML = '<p class="cart-vacio">Tu pedido está vacío 🌿<br>Agrega algunos productos.</p>';
  } else {
    carritoItems.innerHTML = carrito.map((p, i) => `
      <div class="cart-item">
        <div class="cart-item-info">
          <div class="cart-item-nombre">${p.nombre}</div>
          <div class="cart-item-precio">$${(p.precio * p.cantidad).toFixed(2)}</div>
        </div>
        <div class="cart-item-actions">
          <button class="qty-btn" onclick="cambiarCantidad(${i}, -1)">−</button>
          <strong>${p.cantidad}</strong>
          <button class="qty-btn" onclick="cambiarCantidad(${i}, 1)">+</button>
          <button class="qty-btn" onclick="eliminarItem(${i})" title="Quitar">✕</button>
        </div>
      </div>`).join('');
  }

  const total = carrito.reduce((acc, p) => acc + p.precio * p.cantidad, 0);
  carritoTotal.textContent = '$' + total.toFixed(2);
}

/* ---------- Operaciones ---------- */
function agregarAlCarrito(id, nombre, precio, cantidad) {
  const existente = carrito.find(p => p.id === id);
  if (existente) {
    existente.cantidad += cantidad;
  } else {
    carrito.push({ id, nombre, precio, cantidad });
  }
  guardarCarrito();
  renderCarrito();
  mostrarToast('Producto agregado ✓');
}

function cambiarCantidad(i, delta) {
  carrito[i].cantidad += delta;
  if (carrito[i].cantidad <= 0) carrito.splice(i, 1);
  guardarCarrito();
  renderCarrito();
}

function eliminarItem(i) {
  carrito.splice(i, 1);
  guardarCarrito();
  renderCarrito();
}

/* ---------- WhatsApp ---------- */
function enviarPedido() {
  if (carrito.length === 0) {
    mostrarToast('Agrega productos primero 🌿');
    return;
  }
  const lineas = carrito.map(p => `- ${p.cantidad} × ${p.nombre} ($${(p.precio * p.cantidad).toFixed(2)})`);
  const total = carrito.reduce((acc, p) => acc + p.precio * p.cantidad, 0);
  const mensaje = 'Hola, quiero hacer este pedido 🌿\n\n' + lineas.join('\n') +
                  `\n\nTotal: $${total.toFixed(2)}\n\n¿Me confirman disponibilidad?`;
  window.open(`https://wa.me/${WHATSAPP}?text=${encodeURIComponent(mensaje)}`, '_blank');
}

/* ---------- UI ---------- */
function abrirCarrito()  { drawer.classList.add('open'); overlay.classList.add('show'); }
function cerrarCarrito() { drawer.classList.remove('open'); overlay.classList.remove('show'); }

let toastTimer;
function mostrarToast(msg) {
  toast.textContent = msg;
  toast.classList.add('show');
  clearTimeout(toastTimer);
  toastTimer = setTimeout(() => toast.classList.remove('show'), 2200);
}

/* ---------- Eventos ---------- */
document.getElementById('abrirCarrito').addEventListener('click', abrirCarrito);
document.getElementById('cerrarCarrito').addEventListener('click', cerrarCarrito);
overlay.addEventListener('click', cerrarCarrito);
document.getElementById('enviarWhatsApp').addEventListener('click', enviarPedido);
document.getElementById('vaciarCarrito').addEventListener('click', () => {
  carrito = []; guardarCarrito(); renderCarrito();
});

// Botones de cantidad (+ / −) en las tarjetas de producto
document.querySelectorAll('.qty').forEach(qty => {
  const input = qty.querySelector('.qty-input');
  qty.addEventListener('click', e => {
    if (e.target.dataset.accion === 'sumar')   input.value = parseInt(input.value) + 1;
    if (e.target.dataset.accion === 'restar' && input.value > 1) input.value = parseInt(input.value) - 1;
  });
});

// Botón "Agregar al pedido"
document.getElementById('gridProductos').addEventListener('click', e => {
  const btn = e.target.closest('.btn-add');
  if (!btn) return;
  const card = btn.closest('.card');
  const cantidad = parseInt(card.querySelector('.qty-input').value) || 1;
  agregarAlCarrito(
    parseInt(btn.dataset.id),
    btn.dataset.nombre,
    parseFloat(btn.dataset.precio),
    cantidad
  );
});

// Inicializar
renderCarrito();
