<?php
require_once('./controllers/View.php');
$view = new View($_SERVER['REQUEST_URI']);
$view -> renderView();
?>
