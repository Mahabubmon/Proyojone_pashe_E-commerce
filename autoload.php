<?php
require_once 'config.php';
spl_autoload_register(function ($className) {
    require_once 'classes/$className.php';
});

?>