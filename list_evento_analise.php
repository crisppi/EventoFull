<?php
session_start();
if (!$_SESSION['username']) {
    header("Location: index.php");

    include_once("models/pagination.php");
}; ?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>
<?php

$pesquisa_pac = filter_input(INPUT_GET, 'pesquisa_pac');
$pesquisa_hosp = filter_input(INPUT_GET, 'pesquisa_hosp');
$buscaAtivo = filter_input(INPUT_GET, 'buscaAtivo');

include_once("formularios/form_list_evento_analise.php");
include_once("templates/footer.php");
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>

</html>