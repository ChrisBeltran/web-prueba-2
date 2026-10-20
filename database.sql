-- ============================================
-- Base de datos: Tienda de Productos Naturales
-- Importar en phpMyAdmin (XAMPP) o en el panel SQL del hosting
-- ============================================

CREATE DATABASE IF NOT EXISTS tienda_natural
  CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE tienda_natural;

CREATE TABLE productos (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(120) NOT NULL,
  descripcion TEXT,
  precio DECIMAL(10,2) NOT NULL,
  categoria VARCHAR(60) DEFAULT 'General',
  icono VARCHAR(8) DEFAULT '🌿',
  stock INT DEFAULT 0,
  activo TINYINT(1) DEFAULT 1,
  creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE posts (
  id INT AUTO_INCREMENT PRIMARY KEY,
  titulo VARCHAR(180) NOT NULL,
  icono VARCHAR(8) DEFAULT '📝',
  resumen VARCHAR(255),
  contenido TEXT,
  fecha DATE DEFAULT (CURRENT_DATE)
);

-- PRODUCTOS DE EJEMPLO (edítalos o elimínalos)
INSERT INTO productos (nombre, descripcion, precio, categoria, icono, stock) VALUES
('Miel de abeja pura 500 ml', 'Miel 100% natural de colmenas locales, sin pasteurizar.', 8.50, 'Alimentos', '🍯', 20),
('Aceite de coco extra virgen 250 ml', 'Prensado en frío, ideal para cocinar y para el cuidado del cabello.', 6.90, 'Bienestar', '🥥', 15),
('Té de hierbas Relax', 'Mezcla de manzanilla, lavanda y tilo para calmar el estrés. 20 bolsitas.', 3.50, 'Infusiones', '🍵', 30),
('Jabón artesanal de lavanda', 'Elaborado a mano con aceites esenciales naturales. 100 g.', 2.80, 'Cuidado personal', '🧼', 25),
('Quinoa orgánica 1 kg', 'Grano andino de agricultura familiar, libre de químicos.', 5.20, 'Alimentos', '🌾', 40),
('Mascarilla de arcilla verde', 'Purifica y equilibra la piel grasa. Apto para todo tipo de piel.', 4.00, 'Cuidado personal', '✨', 12);

-- ARTÍCULOS DE BLOG DE EJEMPLO
INSERT INTO posts (titulo, icono, resumen, contenido) VALUES
('5 beneficios de la miel pura que no conocías', '🍯',
 'Más que un endulzante: descubre por qué la miel natural debería estar en tu despensa todos los días.',
 'La miel pura es uno de los alimentos más completos que existen.

1. Energía natural: sus azúcares naturales se absorben rápido sin picos de insulina.
2. Antibacteriana: ideal para el cuidado de la garganta y la piel.
3. Rica en antioxidantes que protegen tus células.
4. Mejora la digestión gracias a sus enzimas vivas.
5. Endulza sin químicos: una cucharada alcanza para endulzar tus infusiones.

En nuestra tienda encuentras miel 100% pura de colmenas locales. ¡Pide la tuya por WhatsApp!'),
('Infusiones para dormir mejor (receta de la casa)', '🌙',
 'La mezcla Relax de manzanilla, lavanda y tilo que recomendamos a todos nuestros clientes.',
 'Dormir bien cambia todo: tu energía, tu piel y tu ánimo.

Nuestra mezcla Relax combina:
- Manzanilla: calma natural y suave.
- Lavanda: relaja el sistema nervioso.
- Tilo: favorece el sueño profundo.

Preparación: hierve agua, vierte sobre la bolsita y deja reposar 5 minutos. Tómala 30 minutos antes de dormir, sin azúcar.

Disponible en la tienda en caja de 20 bolsitas.'),
('Rutina natural de skincare en 3 pasos', '🌸',
 'Menos es más: limpieza suave, arcilla verde e hidratación con aceite de coco.',
 'Una rutina natural no necesita 10 productos.

Paso 1 — Limpieza: usa nuestro jabón artesanal de lavanda, suave y sin sulfatos.
Paso 2 — Mascarilla: aplica la arcilla verde 2 veces por semana, 10 minutos.
Paso 3 — Hidratación: unas gotas de aceite de coco extra virgen sellan la humedad.

Con constancia verás tu piel más limpia y luminosa en 4 semanas.');
