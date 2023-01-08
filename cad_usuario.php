<?php
require_once("templates/header.php");
require_once("dao/usuarioDao.php");
require_once("models/message.php");

$usuarioDao = new userDAO($conn, $BASE_URL);

// Receber id do usuário
$id_usuario = filter_input(INPUT_GET, "id_usuario");

if (empty($id_usuario)) {

    if (!empty($userData)) {

        $id = $userData->id_usuario;
    } else {

        //$message->setMessage("Usuário não encontrado!", "error", "index.php");
    }
} else {

    $userData = $userDao->findById($id_usuario);

    // Se não encontrar usuário
    if (!$userData) {
        $message->setMessage("Usuário não encontrado!", "error", "index.php");
    }
}

?>
<div id="main-container" class="container-fluid">
    <div class="row">
        <h4 class="page-title">Cadastrar Usuário</h4>
        <p class="page-description">Adicione informações sobre o usuário</p>
        <form class="formulario" action="<?= $BASE_URL ?>process_usuario.php" id="add-movie-form" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="type" value="create">
            <div class="form-group row">
                <div class="form-group col-sm-4">
                    <label for="usuario_user">Nome do Usuário</label>
                    <input type="text" class="form-control" id="usuario_user" name="usuario_user" placeholder="Digite o nome do usuário" required>
                </div>
            </div>

            <div class="form-group row">

                <div class="form-group col-sm-2">
                    <label for="email_user">email01</label>
                    <input type="email" class="form-control" id="email_user" name="email_user" placeholder="Digite o email">
                </div>

            </div>
            <div class="form-group row">
                <div class="form-group col-sm-2">
                    <label for="senha_user">Senha Default</label>
                    <input type="password" class="form-control" id="senha_user" name="senha_user" placeholder="Digite a senha">
                </div>
            </div>
            <br>
            <button style="margin:10px" type="submit" class="btn-sm btn-info">Cadastrar</button>
            <br>
    </div>
    </form>
</div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>


<?php
require_once("templates/footer.php");
?>