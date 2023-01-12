<?php
require_once("models/evento.php");
require_once("dao/eventoDao.php");
require_once("templates/header.php");

$user = new evento();
$eventoDao = new eventoDAO($conn, $BASE_URL);

// Receber id do usuário
$id_evento = filter_input(INPUT_GET, "id_evento");

$evento = $eventoDao->findById($id_evento);

?>

<!-- formulario update -->
<div id="main-container" class="container-fluid">
    <div class="row">
        <h1 class="page-title">Atualizar evento</h1>
        <p class="page-description">Adicione informações sobre o evento</p>
        <form class="formulario" action="<?= $BASE_URL ?>process_evento.php" id="add-movie-form" method="POST" enctype="multipart/form-data">
            <input type="text" name="type" value="update">
            <div class="form-group row">

                <input type="text" class="form-control" id="id_evento" name="id_evento" value="<?= $evento->id_evento ?>" placeholder="ID">

                <div class="form-group col-sm-4">
                    <label for="paciente">Paciente</label>
                    <input type="text" class="form-control" id="paciente" value="<?= $evento->paciente ?>" name="paciente" placeholder="Digite o nome">
                </div>
                <div class="form-group col-sm-4">
                    <label for="hospital">hospital</label>
                    <input type="text" class="form-control" id="hospital" value="<?= $evento->hospital ?>" name="hospital" placeholder="Digite o nome">
                </div>
                <br>
                <div>
                    <button style="margin:10px" type="submit" class="btn-sm btn-info">Atualizar</button>
                    <br>
                </div>
                <div class="form-group col-sm-4">

                </div>
        </form>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>


<?php include_once("diversos/backbtn_evento.php"); ?>

<?php
require_once("templates/footer.php");
