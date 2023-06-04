<?php
class Usuario
{
    public $id_usuario;
    public $usuario_user;
    public $email_user;
    public $ativo_user;
    public $nivel_user;
    public $senha_user;
    public $hash_senha;
}

interface UserDAOInterface
{

    public function buildUser($data);
    public function create(Usuario $usuario);
    public function update(Usuario $usuario);
    public function verifyToken($protected = false);
    public function setTokenToSession($token, $redirect = true);
    public function authenticateUser($senha);
    public function findByEmail($email);
    public function findById_user($id_usuario);
    public function findByToken($token);
    public function destroy($id_usuario);
    public function changePassword(Usuario $user);
    public function findGeral();

    public function selectAllUsuario($where = null, $order = null, $limit = null);
    public function QtdUsuario();
}
