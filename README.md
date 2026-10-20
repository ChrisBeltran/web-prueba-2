# 🌿 Tienda Natural — PHP + MySQL + HTML/CSS/JS

Tienda web de productos naturales con catálogo, carrito y pedidos por WhatsApp (sin pasarela de pago), más blog integrado.

## Estructura del proyecto

```
tienda_natural/
├── index.php            ← Página principal (catálogo + carrito + blog)
├── blog.php             ← Listado de artículos
├── post.php             ← Artículo completo
├── includes/
│   └── config.php       ← Conexión a la BD y configuración
├── css/
│   └── style.css        ← Todos los estilos
├── js/
│   └── main.js          ← Carrito + envío por WhatsApp
└── database.sql         ← Estructura y datos de ejemplo
```

## ⚙️ Paso 1: Configurar tu número de WhatsApp

Edita 2 archivos y cambia el número de ejemplo por el tuyo
(código de país + número, sin "+" ni espacios):

1. `includes/config.php` → línea `WHATSAPP_NUMERO`
2. `js/main.js` → constante `WHATSAPP`

## 🖥️ Paso 2: Probar en local con XAMPP

1. Instala [XAMPP](https://www.apachefriends.org) (Apache + MySQL + PHP incluidos).
2. Copia la carpeta `tienda_natural` dentro de `C:\xampp\htdocs\`.
3. Abre el panel de XAMPP e inicia **Apache** y **MySQL**.
4. Entra a `http://localhost/phpmyadmin` → pestaña **Importar** → sube `database.sql`.
5. Abre `http://localhost/tienda_natural` en tu navegador. 🎉

## 🌐 Paso 3: Subir a hosting gratuito

> ⚠️ Importante: GitHub Pages y Netlify NO ejecutan PHP ni MySQL.
> Para este proyecto necesitas un hosting con PHP + MySQL. Opciones gratuitas:

### Opción recomendada: InfinityFree
1. Crea cuenta en [infinityfree.net](https://infinityfree.net) → crea un hosting nuevo.
2. En el panel, abre **MySQL Databases** → crea la base de datos → anota usuario y contraseña.
3. Entra a **phpMyAdmin** desde el panel → Importar → sube `database.sql`.
4. En **File Manager** (o por FTP con FileZilla) sube todos los archivos a `htdocs/`.
5. Edita `includes/config.php` con los datos de tu base de datos de InfinityFree.
6. Tu sitio queda en `http://tunombre.epizy.com`.

### Alternativas con PHP + MySQL gratis
- **Freehostia**
- **AwardSpace**
- **000webhost** (con limitaciones)

## ✏️ Personalizar

- **Productos y artículos:** edítalos directamente en phpMyAdmin (tablas `productos` y `posts`).
- **Nombre y colores:** el nombre "Raíces & Vida" está en los archivos PHP; los colores en las variables `--verde` de `css/style.css`.
- **Imágenes reales:** el diseño usa emojis + degradados para no depender de fotos. Para fotos reales, agrega una columna `imagen` a la tabla y ajusta las tarjetas.

## 🔒 Nota de seguridad

Antes de publicar: cambia las credenciales de la base de datos, usa HTTPS
(activable gratis desde el panel del hosting) y no subas este README a producción.
