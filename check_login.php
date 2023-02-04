<?php

session_start();
if (!$_SESSION['username']) {
    header("Location: index.php");
}; ?>
<?php
print_r($_POST);
$username = filter_input(INPUT_POST, 'username');
$senha_login = filter_input(INPUT_POST, 'senha_login');
$login = filter_input(INPUT_POST, 'login');

//include_once("./models/message.php");

//Instanciando a classe

//Instanciando a classe
$usuario = new UserDAO($conn, $BASE_URL);
$QtdTotalUser = new UserDAO($conn, $BASE_URL);

// METODO DE BUSCA DE PAGINACAO
$pesquisa_pac = filter_input(INPUT_GET, 'pesquisa_pac');
$pesquisa_hosp = filter_input(INPUT_GET, 'pesquisa_hosp');
$buscaAtivo = filter_input(INPUT_GET, 'buscaAtivo');
// $buscaAtivo = in_array($buscaAtivo, ['s', 'n']) ?: "";

$condicoes = [
    strlen($pesquisa_pac) ? 'paciente LIKE "%' . $pesquisa_pac . '%"' : null,
    strlen($pesquisa_hosp) ? 'hospital LIKE "%' . $pesquisa_hosp . '%"' : null,
    strlen($buscaAtivo) ? 'ativo = "' . $buscaAtivo . '"' : null
];
$condicoes = array_filter($condicoes);

// REMOVE POSICOES VAZIAS DO FILTRO
$where = implode(' AND ', $condicoes);

// QUANTIDADE UsuarioS
$qtdUserItens1 = $QtdTotalUser->QtdUsuario($where);

$qtdUserItens = ($qtdUserItens1['0']);
// PAGINACAO
$obPagination = new pagination($qtdUserItens, $_GET['pag'] ?? 1, 10);
$obLimite = $obPagination->getLimit();

?>