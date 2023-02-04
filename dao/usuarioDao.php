<?php

require_once("models/usuario.php");
require_once("models/message.php");

class UserDAO implements UserDAOInterface
{

    private $conn;
    private $url;
    private $message;

    public function __construct(PDO $conn, $url)
    {
        $this->conn = $conn;
        $this->url = $url;
        $this->message = new Message($url);
    }

    public function buildUser($data)
    {

        $user = new Usuario();

        $user->id_usuario = $data["id_usuario"];
        $user->usuario_user = $data["usuario_user"];
        $user->email_user = $data["email_user"];
        $user->senha_user = $data["senha_user"];
        return $user;
    }

    public function create(Usuario $usuario)
    {

        $stmt = $this->conn->prepare("INSERT INTO tb_user(
          usuario_user, email_user, senha_user 
        ) VALUES (
          :usuario_user, :email_user, :senha_user
        )");

        $stmt->bindParam(":usuario_user", $usuario->usuario_user);
        $stmt->bindParam(":email_user", $usuario->email_user);
        $stmt->bindParam(":senha_user", $usuario->senha_user);

        $stmt->execute();

        // Autenticar usuário, caso auth seja true
        if (5 > 3) {
            $this->setTokenToSession($usuario->token);
        }
    }

    public function PassordHash($senha)
    {
        return password_hash($senha, PASSWORD_DEFAULT);
    }

    public function update(Usuario $usuario)
    {

        $stmt = $this->conn->prepare("UPDATE tb_user SET
        usuario_user = :usuario_user,
        email_user = :email_user,
        senha_user = :senha_user

        WHERE id_usuario = :id_usuario
      ");

        $stmt->bindParam(":usuario_user", $usuario->usuario_user);
        $stmt->bindParam(":email_user", $usuario->email_user);
        $stmt->bindParam(":senha_user", $senha_user);

        $stmt->bindParam(":id_usuario", $usuario->id_usuario);

        $stmt->execute();

        if (5 > 3) {

            // Redireciona para o perfil do usuario
            $this->message->setMessage("Dados atualizados com sucesso!", "success", "list_usuario.php");
        }
    }

    public function verifyToken($protected = false)
    {

        if (!empty($_SESSION["token"])) {

            // Pega o token da session
            $token = $_SESSION["token"];

            $usuario = $this->findByToken($token);

            if ($usuario) {
                return $usuario;
            } else if ($protected) {

                // Redireciona usuário não autenticado
                $this->message->setMessage("Faça a autenticação para acessar esta página!", "error", "index.php");
            }
        } else if ($protected) {

            // Redireciona usuário não autenticado
            $this->message->setMessage("Faça a autenticação para acessar esta página!", "error", "index.php");
        }
    }

    public function setTokenToSession($token, $redirect = true)
    {

        // Salvar token na session
        $_SESSION["token"] = $token;

        if ($redirect) {

            // Redireciona para o perfil do usuario
            $this->message->setMessage("Seja bem-vindo!", "success", "list_usuario.php");
        }
    }


    public function findByEmail($email_user)
    {

        if ($email_user != "") {

            $stmt = $this->conn->prepare("SELECT * FROM tb_user WHERE email_user = :email_user");

            $stmt->bindParam(":email_user", $email_user);

            $stmt->execute();

            if ($stmt->rowCount() > 0) {

                $data = $stmt->fetch();
                $user = $this->buildUser($data);

                return $user;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function findById_user($id_usuario)
    {

        if ($id_usuario != "") {

            $stmt = $this->conn->prepare("SELECT * FROM tb_user WHERE id_usuario = :id_usuario");

            $stmt->bindParam(":id_usuario", $id_usuario);

            $stmt->execute();

            if ($stmt->rowCount() > 0) {

                $data = $stmt->fetch();
                $usuario = $this->buildUser($data);

                return $usuario;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function findAll()
    {
        $usuario = [];

        $stmt = $this->conn->prepare("SELECT * FROM tb_user
        ORDER BY id_usuario asc");

        $stmt->execute();

        $usuario = $stmt->fetchAll();
        return $usuario;
    }
    public function findByUser($pesquisa_nome)
    {

        $usuario = [];

        $stmt = $this->conn->prepare("SELECT * FROM tb_user
                                    WHERE usuario_user LIKE :usuario_user ");

        $stmt->bindValue(":usuario_user", '%' . $pesquisa_nome . '%');

        $stmt->execute();

        $usuario = $stmt->fetchAll();
        return $usuario;
    }

    public function findByToken($token)
    {

        if ($token != "") {

            $stmt = $this->conn->prepare("SELECT * FROM tb_user WHERE token = :token");

            $stmt->bindParam(":token", $token);

            $stmt->execute();

            if ($stmt->rowCount() > 0) {

                $data = $stmt->fetch();
                $user = $this->buildUser($data);

                return $user;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function destroy($id_usuario)
    {

        // Remove o token da session
        $stmt = $this->conn->prepare("DELETE FROM tb_user WHERE id_usuario = :id_usuario");

        $stmt->bindParam(":id_usuario", $id_usuario);

        $stmt->execute();

        // Redirecionar e apresentar a mensagem de sucesso
        $this->message->setMessage("Deletado!", "success", "/list_usuario.php");
    }

    public function changePassword(Usuario $user)
    {

        $stmt = $this->conn->prepare("UPDATE tb_user SET
        senha_user = :senha_user
        WHERE id_usuario = :id_usuario
      ");

        $stmt->bindParam(":senha_user", $user->senha_user);
        $stmt->bindParam(":id_usuario", $user->id_usuario);

        $stmt->execute();

        // Redirecionar e apresentar a mensagem de sucesso
        $this->message->setMessage("senha alterada com sucesso!", "success", "editprofile.php");
    }

    public function findGeral()
    {

        $usuarios = [];

        $stmt = $this->conn->query("SELECT * FROM tb_user ORDER BY id_usuario asc");

        $stmt->execute();

        $pacientes = $stmt->fetchAll();

        return $usuarios;
    }
    public function findGeralUsuario()
    {

        $pacientes = [];

        $stmt = $this->conn->query("SELECT * FROM tb_user ORDER BY id_usuario asc");

        $stmt->execute();

        $usuarios = $stmt->fetchAll();

        return $usuarios;
    }

    public function findById_Login($email_user, $senha)
    {

        if ($email_user != "") {

            $stmt = $this->conn->prepare("SELECT * FROM tb_user WHERE email_user = :username AND senha_user= senha_login");

            $stmt->bindParam(":email_user", $email_user);

            $stmt->execute();

            if ($stmt->rowCount() > 0) {

                $data = $stmt->fetch();
                $usuario = $this->buildUser($data);

                return $usuario;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}



# Limita o número de registros a serem mostrados por página
$limite = 10;

# Se pg não existe atribui 1 a variável pg
$pg = (isset($_GET['pg'])) ? (int)$_GET['pg'] : 1;

# Atribui a variável inicio o inicio de onde os registros vão ser
# mostrados por página, exemplo 0 à 10, 11 à 20 e assim por diante
$inicio = ($pg * $limite) - $limite;
$pesquisa_hosp = "";
# seleciona o total de registros  
$sql_Total = 'SELECT id_usuario FROM tb_user';
