<?php
session_start();

include_once("globals.php");
include_once("db.php");
require_once("dao/eventoDao.php");
require_once("dao/usuarioDao.php");
require_once("models/message.php");
require_once("models/evento.php");
require_once("models/usuario.php");

$usuarioDao = new userDAO($conn, $BASE_URL);

?>
<!DOCTYPE html>
<html>

<head>
    <link href="<?php $BASE_URL ?>css/login.css" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />

    <script type="text/javascript" src="script.js"></script>

</head>

<body>
    <br />
    <div class="container" style="width:500px;">

        <?php
        if (isset($message)) {
            echo '<label class="text-danger">' . $message . '</label>';
        }
        ?>
    </div>

    <div class="login-wrap">
        <div class="login-html">
            <div style="color:white; text-align:center; font-size:1.6em">
                PAINEL - EVENTO ADVERSO
            </div>
            <hr>
            <div>
                <a class="navbar-brand" href="index.php">
                    <img src="img/full-03.jpeg" style="width:70px; height:70px " alt="Full">
                </a> <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
            </div>
            <input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab">Logar</label>
            <input id="tab-2" type="radio" name="tab" class="sign-up"><label for="tab-2" class="tab"></label>

            <div class="login-form">
                <form action="check_login.php" method="POST">
                    <div class="sign-in-htm">
                        <input type="hidden" id="loggedin" name="loggedin" value="loggedin">

                        <div class="group">
                            <label for="username" class="label">Usuário</label>
                            <input name="username" onkeypress="ocultar()" id="username" type="text" class="input" required>
                        </div>
                        <div class="group">
                            <label for="senha_login" class="label">Senha</label>
                            <input name="senha_login" type="password" class="input" required>
                        </div>
                        <div class="group">
                            <input type="submit" class="button" name="login" class="btn btn-info" value="Login">
                        </div>
                </form>

                <?php
                if (isset($_SESSION['mensagem'])) { ?>
                    <div style="background-color:aliceblue; padding:10px; border-radius: 20px;" class="visible" id="msgErr">
                        <?Php echo "<div style='color:red; text-align:center;'>" . $_SESSION['mensagem']; ?>
                    </div>
                <?php  }; ?>

            </div>
        </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

</html>
<script type="text/javascript">
    function ocultar() {
        $("#msgErr").removeClass("visible");
        $("#msgErr").addClass("oculto");

    }
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>