<?php
session_start();
if ($_SESSION['username']) {
    echo "saiu";
    session_destroy();
    header("Location: cad_evento.php");
}
