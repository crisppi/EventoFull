<?php if ($_SESSION['email_login'] >= 5) {
    session_destroy();
    header("location:/EventoAdverso2/cad_evento.php");
}
