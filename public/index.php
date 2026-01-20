    <?php
    session_start();
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
    ini_set('display_errors', 0); // Supaya PHP notice/warning tidak tampil di browser

    // PATH BENAR & AMAN
    require_once dirname(__DIR__) . '/app/core/App.php';
    require_once dirname(__DIR__) . '/app/core/Router.php';
    require_once dirname(__DIR__) . '/app/core/Controller.php';

    new App();
