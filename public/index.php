    <?php
    session_start();
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    // PATH BENAR & AMAN
    require_once dirname(__DIR__) . '/app/core/App.php';
    require_once dirname(__DIR__) . '/app/core/Router.php';
    require_once dirname(__DIR__) . '/app/core/Controller.php';

    new App();
