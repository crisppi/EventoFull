<?php
// Inicialize a sessão
session_start();

// Incluir arquivo de configuração
require_once "db.php";
require_once("globals.php");
require_once("models/evento.php");
require_once("models/usuario.php");

require_once("models/message.php");

require_once("dao/eventoDao.php");
require_once("dao/usuarioDao.php");

require_once("templates/headerBase.php");
$usuarioDao = new userDAO($conn, $BASE_URL);


// Verifique se o usuário já está logado, em caso afirmativo, redirecione-o para a página de boas-vindas
if (isset($_SESSION["loggedin"]) === true) {
    header("location: cad_evento.php");
    exit;
}
if (isset($_POST['username'])) {
    $_SESSION['username'] = $_POST['username'];
    // $_SESSION['senha_user'] = $_POST['senha_user'];
}
// $user = $_POST['username'];
// $senha = $_POST['senha_login'];
// echo "<pre>";
// print_r($_POST);

// Defina variáveis e inicialize com valores vazios
$username = $password = "";
$username_err = $password_err = $login_err = "";

// Verifique se o nome de usuário está vazio
if (empty(trim($_POST["username"]))) {
    $username_err = "Por favor, insira o nome de usuário.";
} else {
    $username = trim($_POST["username"]);
}

// Verifique se a senha está vazia
if (empty(trim($_POST["senha_login"]))) {
    $password_err = "Por favor, insira sua senha.";
} else {
    $password = trim($_POST["senha_login"]);
}

// Validar credenciais
if (empty($username_err) && empty($password_err)) {

    $logados = $usuarioDao->findById_Login($username, $password);
    print_r($logados);


    // Prepare uma declaração selecionada
    $sql = "SELECT * FROM tb_user WHERE usuario_user = :username AND senha_user = :password";
    if ($stmt = $conn->prepare($sql)) {
        // Vincule as variáveis à instrução preparada como parâmetros
        $stmt->bindParam(":usuario_user", $username, PDO::PARAM_STR);

        $stmt->execute();
        $evento = $stmt->fetchAll();

        return $evento;

        print_r($evento);

        // Definir parâmetros
        $param_username = trim($_POST["username"]);

        // Tente executar a declaração preparada
        if ($stmt->execute()) {
            // Verifique se o nome de usuário existe, se sim, verifique a senha
            if ($stmt->rowCount() == 1) {
                if ($row = $stmt->fetch()) {
                    $id = $row["id_usuario"];
                    $username = $row["usuario_user"];
                    $hashed_password = $row["senha_user"];
                    $nivel = $row["nivel_user"];

                    if (password_verify($password, $hashed_password)) {
                        // A senha está correta, então inicie uma nova sessão
                        session_start();

                        // Armazene dados em variáveis de sessão
                        $_SESSION["loggedin"] = true;
                        $_SESSION["id_usuario"] = $id;
                        $_SESSION["username"] = $username;

                        // Redirecionar o usuário para a página de boas-vindas
                        header("location: cad_evento.php");
                    } else {
                        // A senha não é válida, exibe uma mensagem de erro genérica
                        $login_err = "Nome de usuário ou senha inválidos.";
                    }
                }
            } else {
                // O nome de usuário não existe, exibe uma mensagem de erro genérica
                $login_err = "Nome de usuário ou senha inválidos.";
            }
        } else {
            echo "Ops! Algo deu errado. Por favor, tente novamente mais tarde.";
        }

        // Fechar declaração
        unset($stmt);
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Login</title>

    <style>
        body {
            font: 14px sans-serif;
        }

        .wrapper {
            width: 360px;
            padding: 20px;
        }
    </style>
</head>

<?php
// print_r($_SESSION);
// echo "<br>";
// echo $_POST['senha_login'];
// echo "<br>";
// echo $_POST['username'];
// echo "<br>";
// echo "loggedin = " . $_POST['loggedin'];
// echo "nome da entrada = " . $entradaName;

?>
<!-- <div class="login-wrap">
    <div class="login-html">
        <div>
            <a class="navbar-brand" href="index.php">
                <img src="img/full-03.jpeg" style="width:70px; height:70px " alt="Full">
            </a> <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
        </div>
        <input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab">Logar</label>
        <input id="tab-2" type="radio" name="tab" class="sign-up"><label for="tab-2" class="tab"></label>
        <div class="login-form">
            <form method="POST" action="cad_evento.php">
                <div class="sign-in-htm">
                    <input id="loggedin" name="loggedin" />
                    <div class="group">
                        <label for="username" class="label">Usuário</label>
                        <input id="username" name="username" type="text" class="input">
                    </div>
                    <div class="group">
                        <label for="senha_user" class="label">Senha</label>
                        <input id="senha_user" name="senha_user" type="password" class="input" type="password">
                    </div>
                    <div class="group">
                        <button type="submit" class="button" value="Entrar">Entrar</button>
                    </div>
            </form>

        </div>

    </div>
</div> -->
</div>

</html>