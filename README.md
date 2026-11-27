# Sistema web de gestión de inventarios y ventas

Proyecto académico de Análisis y Desarrollo de Software (SENA). Aplicación web para centralizar la gestión de inventarios y operaciones comerciales.

## Funcionalidades
- Gestión de empleados, categorías, productos y clientes.
- Registro de movimientos de inventario y ventas.
- Panel de indicadores.
- Autenticación y controles de acceso por roles en el módulo de productos.

## Tecnologías
PHP 8.2+, Laravel 12, Composer, JavaScript, Bootstrap y Vite.

## Estructura
- `app/`: modelos y controladores.
- `routes/web.php`: rutas de la aplicación.
- `resources/`: vistas y recursos frontend.
- `database/`: migraciones y datos de inicialización.

## Instalación local (Git Bash)
Requiere PHP, Composer, Node.js, npm y una base de datos local compatible con la configuración del proyecto.

```bash
git clone https://github.com/AstharoXs/Sistema.git
cd Sistema
composer install
cp .env.example .env
php artisan key:generate
npm ci
```

Configura la conexión a una base de datos de pruebas en .env antes de continuar.

```bash
php artisan migrate
npm run build
php artisan serve
```

Abre http://127.0.0.1:8000. Revisa los seeders para preparar usuarios de prueba si son necesarios. Para ejecutar las pruebas disponibles: `php artisan test`.

## Estado
Proyecto académico; instalación y pruebas pendientes de validación en un entorno limpio. No utilizar datos reales ni publicar credenciales.
