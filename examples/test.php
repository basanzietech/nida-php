<?php

require __DIR__ . "/../vendor/autoload.php";

use Nida\Nida;

$nida = new Nida();

// Example NIDA ID (weka halisi ya test)
$user = $nida->loadUser("1999999999999999");

print_r($user);