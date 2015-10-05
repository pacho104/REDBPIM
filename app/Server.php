<?php
use App\MensajeSala;

require_once __DIR__ . "/../vendor/autoload.php";
$port = 3000;
$server = new MensajeSala();
MensajeSala::run($server, $port);