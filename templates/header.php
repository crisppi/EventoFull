<?php
if (!isset($_SESSION)) {
  session_start();
}

include_once("globals.php");
include_once("db.php");
date_default_timezone_set('America/Sao_Paulo');
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gestão Qualidade-2022</title>
  <!-- Boostrap -->
  <link href="<?php $BASE_URL ?>css/style.css" rel="stylesheet">
  <link href="<?php $BASE_URL ?>css/login.css" rel="stylesheet">
  <link href="<?php $BASE_URL ?>css/styleMenu.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

</head>

<body>
  <div class="col-md-12">
    <nav style="background-image: linear-gradient(to right, #949494, #d3d3d3 , #e9e9e9)" class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container-fluid">
        <a class="navbar-brand" href="index.php">
          <img src="img/full-03.jpeg" style="width:70px; height:70px " alt="Full">
        </a> <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarScroll">
          <ul class="nav-tabs navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="<?php $BASE_URL ?>index.php">Home</a>
            </li>

            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarScrollingDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Cadastro
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
                <li><a class="dropdown-item" href="<?php $BASE_URL ?>cad_evento.php">Cadastrar novo evento</a></li>
            </li>
          </ul>

          </li>
          <?php
          if (isset($_SESSION) && $_SESSION['nivel'] >= 2) {
          ?>

            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarScrollingDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Pesquisas
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
                <li><a class="dropdown-item" href="<?php $BASE_URL ?>list_evento.php"><i class="bi bi-book" style="font-size: 1rem;margin-right:5px; color: rgb(27, 156, 55);"></i> Evento Adverso</a></li>

                <li><a class="dropdown-item" href="<?php $BASE_URL ?>list_evento_analise.php"><i class="bi bi-book" style="font-size: 1rem;margin-right:5px; color: rgb(255, 25, 55);"></i> Evento em análise</a></li>
              </ul>
            </li>

            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarScrollingDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Usuário
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
                <li><a class="dropdown-item" href="cad_usuario.php"><i class="bi bi-person-add" style="font-size: 1rem; margin-right:5px; color: rgb(15, 15, 276);"></i> Cadastrar usuário</a></li>
                <hr class="dropdown-divider">
                <li><a class="dropdown-item" href="list_usuario.php"><i class="bi bi-file-medical" style="font-size: 1rem; margin-right:5px; color: rgb(155, 95, 76);"></i> Listar usuário</a></li>
              </ul>
            </li>
            <!-- <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarScrollingDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Pesquisas
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
                <li><a class="dropdown-item" href="<?php $BASE_URL ?>list_usuario.php">Listar Usuário</a></li>
              </ul>
            </li> -->
          <?php } ?>
        </div>
      </div>
      <div class="col-md-2" style="margin-left:200px; font-weight:600 ;font-size:12px">
        <?php
        if ($_SESSION) {
          echo "<span style='color:green; font-size:1.2em'>Bem vindo!!  " . $_SESSION['username'] . "</span><br>";
          $agora = date('d/m/Y H:i');
        } else {
          echo "<span style='color:red'> Você não esta logado!!</span>" . "<br>";
        }

        $agora = date('d/m/Y H:i');
        echo "Local: " . $agora ?>
        <div>
          <a class="dropdown-item" style="margin-left:20px; color:red; font-size:larger; font-weight:600" href="<?php $BASE_URL ?>destroi.php"> Sair</a>
        </div>
      </div>
  </div>
  </nav>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

</html>