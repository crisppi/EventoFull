<?php

$host = "bd-evento-adver.mysql.uhserver.com";
$user = "dir_event";
$pass = "Guga@0401";
$dbname = "bd_evento_adver";
$port = 3306;
$conn = new PDO("mysql:dbname=$dbname;host=$host", $user, $pass);

// Habilitar erros PDO
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
