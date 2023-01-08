<?php
include_once("globals.php");

include_once("models/evento.php");
include_once("dao/eventoDao.php");
include_once("templates/header.php");

// Pegar o id do paceinte
$id_evento = filter_input(INPUT_GET, "id_evento", FILTER_SANITIZE_NUMBER_INT);

$evento;

$eventoDao = new eventoDAO($conn, $BASE_URL);
// instanciar msg
$message = new Message($BASE_URL);

$flassMessage = $message->getMessage();
if (!empty($flassMessage["msg"])) {
    // Limpar a mensagem
    $message->clearMessage();
}
//Instanciar o metodo evento   
$evento = $eventoDao->findById($id_evento);
?> <h4 style="margin-left:20px">Dados do evento: <?= $evento->id_evento ?></h4>
<div class="container">

    <div class="form-group row">

        <div class="card-header" id="show-paciente">
            <span class="card-title bold show">Paciente: </span>
            <span class="card-title bold show-dados"><?= $evento->paciente ?></span>
            <br>
        </div>
        <div id="show-hospital">
            <span class="card-title bold show">Hospital:</span>
            <span class="show-dados" class="card-title bold"><?= $evento->hospital ?></span>
            <br>
        </div>



    </div>
    <br>
    <div id="id-confirmacao" class="btn_acoes visible">
        <p style="font-weight: bold; font-size:1.0em">Deseja deletar este evento: <?= $evento->paciente ?>?</p>
        <button class="btn btn-success styled" onclick=cancelar() type="button" id="cancelar" name="cancelar">Cancelar</button>
        <button class="btn btn-danger styled" onclick=deletar() value="default" type="button" id="deletar-btn" name="deletar">Deletar</button>
    </div>
</div>
<!-- mensagem de apagar -->
<div styled="margin:0 auto" class="mensagem-apgar">
    <p styled="margin:0 auto">Apagado</p>
</div>
<?php include_once("diversos/backbtn_evento.php"); ?>
<script>
    function apareceOpcoes() {
        $('#deletar-btn').val('nao');
        let mudancaStatus = ($('#deletar-btn').val())
        console.log(mudancaStatus);
        let idAcoes = (document.getElementById('id-confirmacao'));
        idAcoes.style.display = 'block';
    }

    function deletar() {
        let idAcoes = (document.getElementById('id-confirmacao'));
        idAcoes.style.display = 'none';
        window.location = "<?= $BASE_URL ?>del_evento.php?id_evento=<?= $id_evento ?>";

    };

    function cancelar() {
        let idAcoes = (document.getElementById('id-confirmacao'));
        idAcoes.style.display = 'none';
        console.log("chegou no cancelar");
        window.location = "<?= $BASE_URL ?>del_evento.php?id_evento=<?= $id_evento ?>";


    };
    src = "https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js";
</script>
<?php
include_once("templates/footer.php");
