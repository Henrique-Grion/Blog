<?php
$PDO = require('./../configuracao/backend.php');
session_destroy();
header('Location: ' . BASE_PATH . '/index.php');
