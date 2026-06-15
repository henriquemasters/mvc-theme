<?php

// WordPress loads functions.php before this template file.
$controller = new MvcTheme\Controllers\IndexController();
$controller->render();
