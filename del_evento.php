<?php

require_once("globals.php");
require_once("db.php");
require_once("models/evento.php");
require_once("models/message.php");
require_once("dao/usuarioDao.php");
require_once("dao/eventoDao.php");

//$message = new Message($BASE_URL);
$eventoDao = new eventoDAO($conn, $BASE_URL);

// Resgata o tipo do formulário

$type = "delete";
//$type = filter_input(INPUT_POST, "type");

if ($type === "delete") {
    // Recebe os dados do form
    $id_evento = filter_input(INPUT_GET, "id_evento");

    $eventoDao = new eventoDAO($conn, $BASE_URL);

    $evento = $eventoDao->findById($id_evento);
    var_dump($id_evento);
    if ($evento) {

        $eventoDao->destroy($id_evento);

        include_once('list_evento.php');
    } else {

        //$message->setMessage("Informações inválidas!", "error", "index.php");
    }
}
