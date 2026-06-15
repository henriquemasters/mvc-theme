<?php

$autoload = __DIR__ . '/vendor/autoload.php';

if (! file_exists($autoload)) {
    error_log('Tema mvc-theme: vendor/autoload.php nao encontrado. Execute "composer install" em wp-content/themes/mvc-theme.');

    if (is_admin()) {
        add_action('admin_notices', function () {
            echo '<div class="notice notice-error"><p><strong>mvc-theme:</strong> dependencias Composer nao instaladas. Execute <code>composer install</code> em <code>wp-content/themes/mvc-theme</code>.</p></div>';
        });
    }

    return;
}

try {
    require_once $autoload;
} catch (Throwable $e) {
    error_log('Tema mvc-theme: erro ao incluir o autoloader: ' . $e->getMessage());
    return;
}

try {
    require_once __DIR__ . '/config/timber-setup.php';
} catch (Throwable $e) {
    error_log('Tema mvc-theme: erro ao incluir a configuracao do Timber: ' . $e->getMessage());
    return;
}

// Registra os controlador principal
try {
    // $pageModel = new \MvcTheme\Models\PageModel();
    // $pageController = new \MvcTheme\Controllers\PageController($pageModel);
} catch (Throwable $e) {
    error_log('Erro ao instanciar PageController: ' . $e->getMessage());
}
