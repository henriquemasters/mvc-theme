<?php

// Inclui o autoloader
try {
    require_once __DIR__ . '/vendor/autoload.php';
} catch (Exception $e) {
    error_log('Erro ao incluir o autoloader: ' . $e->getMessage());
    // Talvez redirecione para uma página de erro ou tome outra ação adequada.
}

// Inclui o autoloader
try {
    require_once __DIR__ . '/config/timber-setup.php';
} catch (Exception $e) {
    error_log('Erro ao incluir a configuração do Timber: ' . $e->getMessage());
    // Talvez redirecione para uma página de erro ou tome outra ação adequada.
}

// Registra os controlador principal
try {
    //  $pageModel = new \MvcTheme\Models\PageModel(); // Instanciação do modelo
    //  $pageController = new \MvcTheme\Controllers\PageController($pageModel); // Injeção da dependência
    //
} catch (Exception $e) {
    error_log('Erro ao instanciar PageController: ' . $e->getMessage());
}

// ... outros códigos ...

