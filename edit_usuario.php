<?php
require_once("models/usuario.php");
require_once("models/usuario.php");
require_once("dao/usuarioDao.php");
require_once("templates/header.php");

$user = new Usuario();
$usuarioDao = new UserDAO($conn, $BASE_URL);

// Receber id do usuário
$id_usuario = filter_input(INPUT_GET, "id_usuario");

$usuario = $usuarioDao->findById_user($id_usuario);

?>

<!-- formulario update -->
<div id="main-container" class="container">
    <div class="row">
        <h1 class="page-title">Atualizar usuario</h1>
        <p class="page-description">Adicione informações sobre o usuario</p>
        <form class="formulario" action="<?= $BASE_URL ?>process_usuario.php" id="add-movie-form" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="type" value="update">
            <div class="form-group row">

                <input type="hidden" class="form-control" id="id_usuario" name="id_usuario" value="<?= $usuario->id_usuario ?>" placeholder="ID">

                <div class="form-group col-sm-4">
                    <label for="nome">Nome</label>
                    <input type="text" class="form-control" id="usuario_user" value="<?= $usuario->usuario_user ?>" name="usuario_user" placeholder="Digite o nome" required>
                </div>
            </div>
            <div class="form-group row">
            </div>
            <div class="form-group row">
                <div class="form-group col-sm-2">
                    <label for="email">E-mail01</label>
                    <input type="email" class="form-control" id="email_user" value="<?= $usuario->email_user ?>" name="email_user" placeholder="Digite o email">
                </div>
            </div>
            <br>
    </div>
    <br>
    <button style="margin:10px" type="submit" class="btn-sm btn-info">Atualizar</button>
    <br>
</div>
</form>
</div>
</div>

<script>
    function mascara(i) {

        var v = i.value;

        if (isNaN(v[v.length - 1])) { // impede entrar outro caractere que não seja número
            i.value = v.substring(0, v.length - 1);
            return;
        }

        i.setAttribute("maxlength", "14");
        if (v.length == 3 || v.length == 7) i.value += ".";
        if (v.length == 11) i.value += "-";

    }
</script>
<!-- mascara de cpf, telefone  -->
<script>
    function mascara(i, t) {

        var v = i.value;

        if (isNaN(v[v.length - 1])) {
            i.value = v.substring(0, v.length - 1);
            return;
        }

        if (t == "data") {
            i.setAttribute("maxlength", "10");
            if (v.length == 2 || v.length == 5) i.value += "/";
        }

        if (t == "cpf") {
            i.setAttribute("maxlength", "14");
            if (v.length == 3 || v.length == 7) i.value += ".";
            if (v.length == 11) i.value += "-";
        }

        if (t == "cnpj") {
            i.setAttribute("maxlength", "18");
            if (v.length == 2 || v.length == 6) i.value += ".";
            if (v.length == 10) i.value += "/";
            if (v.length == 15) i.value += "-";
        }

        if (t == "cep") {
            i.setAttribute("maxlength", "9");
            if (v.length == 5) i.value += "-";
        }

        if (t == "tel") {
            if (v[0] == 12) {

                i.setAttribute("maxlength", "10");
                if (v.length == 5) i.value += "-";
                if (v.length == 0) i.value += "(";

            } else {
                i.setAttribute("maxlength", "9");
                if (v.length == 4) i.value += "-";
            }
        }
    }

    function mascaraTelefone(event) {
        let tecla = event.key;
        let telefone = event.target.value.replace(/\D+/g, "");

        if (/^[0-9]$/i.test(tecla)) {
            telefone = telefone + tecla;
            let tamanho = telefone.length;

            if (tamanho >= 12) {
                return false;
            }

            if (tamanho > 10) {
                telefone = telefone.replace(/^(\d\d)(\d{5})(\d{4}).*/, "($1) $2-$3");
            } else if (tamanho > 5) {
                telefone = telefone.replace(/^(\d\d)(\d{4})(\d{0,4}).*/, "($1) $2-$3");
            } else if (tamanho > 2) {
                telefone = telefone.replace(/^(\d\d)(\d{0,5})/, "($1) $2");
            } else {
                telefone = telefone.replace(/^(\d*)/, "($1");
            }

            event.target.value = telefone;
        }

        if (!["Backspace", "Delete"].includes(tecla)) {
            return false;
        }
    }
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

<?php include_once("diversos/backbtn_usuario.php"); ?>

<?php
require_once("templates/footer.php");
