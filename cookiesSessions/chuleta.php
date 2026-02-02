<?php
/**
 * GESTIÓN COMPLETA DE COOKIES Y SESIONES EN UN SOLO SCRIPT
 * * Este script ilustra:
 * 1. Inicialización y gestión de la Sesión.
 * 2. Creación, lectura y eliminación de Cookies.
 * 3. Uso combinado de ambos para, por ejemplo, recordar un nombre de usuario.
 */

# ====================================================================
# A. CONFIGURACIÓN E INICIO DE LA SESIÓN (DEBE SER LO PRIMERO)
# ====================================================================

// 1. Iniciar o reanudar la sesión. Es el comando fundamental.
session_start();

// Regeneración del ID de sesión para seguridad (evita Session Fixation).
// Se hace cada 5 peticiones (o al inicio, como buena práctica).
if (!isset($_SESSION['last_regen']) || time() - $_SESSION['last_regen'] > 300) { // Cada 5 minutos
    session_regenerate_id(true);
    $_SESSION['last_regen'] = time();
    $regenerated = true;
} else {
    $regenerated = false;
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <title>Gestión de Cookies y Sesiones en PHP</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; padding: 20px; }
        .section { margin-bottom: 30px; padding: 15px; border: 1px solid #ddd; border-radius: 5px; }
        .success { color: green; font-weight: bold; }
        .info { color: blue; }
        .warning { color: orange; }
    </style>
</head>
<body>

<h1>🔑 Gestión Unificada: Cookies & Sessions</h1>
<p class="info">ID de Sesión Actual: **<?php echo htmlspecialchars(session_id()); ?>**
    <?php if ($regenerated) echo " (ID Regenerado por Seguridad)"; ?></p>
<hr>

<?php

# ====================================================================
# B. GESTIÓN DE LA SESIÓN (Almacenamiento en Servidor)
# ====================================================================

echo '<div class="section">';
echo '<h2>1. Variables de Sesión (`$_SESSION`)</h2>';

// 2. Establecer variables de sesión
if (!isset($_SESSION['visits'])) {
    $_SESSION['visits'] = 1;
    $_SESSION['theme'] = 'light';
    echo '<p class="success">✅ Sesión iniciada: Contador de visitas y tema establecidos.</p>';
} else {
    // 3. Modificar y leer variables de sesión
    $_SESSION['visits']++;
    echo '<p class="info">Contador de visitas en esta sesión: **' . $_SESSION['visits'] . '**</p>';
    echo '<p class="info">Tema preferido (en sesión): **' . $_SESSION['theme'] . '**</p>';
}


// 4. Cierre de Sesión (Llamado vía parámetro URL)
if (isset($_GET['logout'])) {
    // a) Limpiar el array $_SESSION
    $_SESSION = array();

    // b) Eliminar la cookie de sesión del navegador
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }

    // c) Destruir la sesión en el servidor
    session_destroy();
    echo '<p class="warning">⚠️ ¡Sesión Cerrada! Recarga la página para verificar.</p>';
}
echo '</div>';


# ====================================================================
# C. GESTIÓN DE COOKIES (Almacenamiento en Cliente/Navegador)
# ====================================================================

echo '<div class="section">';
echo '<h2>2. Cookies (`setcookie()`, `$_COOKIE`)</h2>';

// 1. Crear/Actualizar una Cookie de "Recuérdame" (Expira en 30 días)
$cookie_name = 'last_user';
$cookie_value = 'UsuarioDIW';
$cookie_expiration = time() + (86400 * 30); // 86400 segundos = 1 día

// setcookie(nombre, valor, expiracion, ruta, dominio, seguro, httponly);
setcookie($cookie_name, $cookie_value, $cookie_expiration, '/', '', false, true); // HttpOnly: true

echo '<p class="success">✅ Cookie **`last_user`** establecida (expira en 30 días, HttpOnly: true).</p>';


// 2. Leer la Cookie (solo accesible en la próxima petición)
if (isset($_COOKIE[$cookie_name])) {
    echo '<p class="info">Cookie leída: Último usuario registrado: **' . htmlspecialchars($_COOKIE[$cookie_name]) . '**</p>';
} else {
    echo '<p class="warning">⚠️ Cookie **`last_user`** no visible todavía (necesitas recargar la página).</p>';
}


// 3. Eliminar una Cookie (Llamado vía parámetro URL)
if (isset($_GET['delete_cookie'])) {
    // Eliminar la cookie estableciendo su expiración en el pasado
    setcookie($cookie_name, '', time() - 3600, '/');
    echo '<p class="warning">⚠️ Cookie **`last_user`** eliminada. Recarga para verificar.</p>';
}

echo '</div>';


# ====================================================================
# D. ENLACES DE ACCIÓN
# ====================================================================

echo '<hr><h2>Enlaces de Acción</h2>';
echo "<ul>";
echo "<li><a href='?'>Recargar la página</a> (Incrementa el contador de sesión y prueba las cookies).</li>";
echo "<li><a href='?delete_cookie=true'>Eliminar la Cookie 'last_user'</a></li>";
echo "<li><a href='?logout=true'>Cerrar la Sesión Actual</a></li>";
echo "</ul>";

?>

</body>
</html>
