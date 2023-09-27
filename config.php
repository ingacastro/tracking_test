<?php
    define('DB_SERVER', 'localhost');
    define('DB_SERVER_USERNAME', 'root');
    define('DB_SERVER_PASSWORD', '1234');
    define('DB_DATABASE', 'emarke26_example');
    define('NUM_ITEMS_BY_PAGE', 20);
    
    $connexion = new mysqli(DB_SERVER, DB_SERVER_USERNAME, DB_SERVER_PASSWORD, DB_DATABASE);
?>