<?php
use Illuminate\Support\Facades\Route;

// Rutas de los módulos.
// 👉 Cada módulo maneja sus propias rutas.

// Rutas de usuarios.
//require base_path('app/Modules/Users/Routes/api.php');

// Rutas de ventas.
//require base_path('app/Modules/Sales/Routes/api.php');

// Importa las rutas del módulo inventario.
require base_path('app/Modules/Inventory/Routes/api.php');

// Importa las rutas del módulo personas.
require base_path('app/Modules/People/Routes/api.php');

// Rutas de contabilidad.
//require base_path('app/Modules/Accounting/Routes/api.php');

// Rutas de compras.
//require base_path('app/Modules/Purchases/Routes/api.php');

// Rutas de reportes.
//require base_path('app/Modules/Reports/Routes/api.php');

// Rutas de configuraciones.
//require base_path('app/Modules/Settings/Routes/api.php');

// Rutas de utilidades.
//require base_path('app/Modules/Utilities/Routes/api.php');

// Rutas de notificaciones.
//require base_path('app/Modules/Notifications/Routes/api.php');  