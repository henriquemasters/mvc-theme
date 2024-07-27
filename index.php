<?php

// ... Configurações de erro ...
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

// Instancia o controlador e renderiza a página
$controller = new MvcTheme\Controllers\IndexController();
$controller->render();