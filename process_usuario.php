<?php

require_once("globals.php");
require_once("db.php");
require_once("models/message.php");
require_once("dao/usuarioDao.php");

$message = new Message($BASE_URL);
$userDao = new UserDAO($conn, $BASE_URL);

// Resgata o tipo do formulário
$type = filter_input(INPUT_POST, "type");

// Resgata dados do usuário

if ($type === "create") {

    // Receber os dados dos inputs
    $usuario_user = filter_input(INPUT_POST, "usuario_user");
    $email_user = filter_input(INPUT_POST, "email_user");
    $ativo_user = filter_input(INPUT_POST, "ativo_user");
    $senha_user = password_hash($_POST["senha_user"], PASSWORD_DEFAULT);

    $usuario = new Usuario();

    // Validação mínima de dados
    if (!empty($usuario_user)) {

        $usuario->usuario_user = $usuario_user;
        $usuario->email_user = $email_user;
        $usuario->ativo_user = $ativo_user;
        $usuario->senha_user = $senha_user;

        $userDao->create($usuario);
    } else {

        //$message->setMessage("Você precisa adicionar pelo menos: nome do paciente!", "error", "back");
    }
} else if ($type === "update") {

    $usuarioDao = new userDAO($conn, $BASE_URL);

    // Receber os dados dos inputs
    $id_usuario = filter_input(INPUT_POST, "id_usuario");
    $usuario_user = filter_input(INPUT_POST, "usuario_user");
    $ativo_user = filter_input(INPUT_POST, "ativo_user");
    $email_user = filter_input(INPUT_POST, "email_user");
    $senha_user = password_hash(filter_input(INPUT_POST, "senha_user"), PASSWORD_DEFAULT);

    $usuarioData = $usuarioDao->findById_user($id_usuario);

    $usuarioData->id_usuario = $id_usuario;
    $usuarioData->usuario_user = $usuario_user;
    $usuarioData->ativo_user = $ativo_user;
    $usuarioData->email_user = $email_user;
    $usuarioData->senha_user = $senha_user;

    $usuarioDao->update($usuarioData);

    include_once('list_usuario.php');
}

if ($type === "delete") {
    // Recebe os dados do form
    $id_usuario = filter_input(INPUT_GET, "id_usuario");

    $usuarioDao = new userDAO($conn, $BASE_URL);

    $usuario = $usuarioDao->findById_user($id_usuario);

    if ($usuario) {

        $usuarioDao->destroy($id_usuario);

        //include_once('list_usuario.php');
    } else {

        $message->setMessage("Informações inválidas!", "error", "list_usuario.php");
    }
}
