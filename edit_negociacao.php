<?php
session_start();
require_once("models/evento.php");
require_once("dao/eventoDao.php");
require_once("templates/header.php");

$user = new evento();
$eventoDao = new eventoDAO($conn, $BASE_URL);

// Receber id do usuário
$id_evento = filter_input(INPUT_GET, "id_evento");

$evento = $eventoDao->findById($id_evento);
include_once("array_dados.php");
?>

<!-- formulario update -->

<script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js"></script>
<div id="main-container" class="container">
    <div class="row">
        <h4 class="page-title">Negociações do EA</h4>

        <p class="page-description">Adicione informações sobre o evento</p>
        <form class="formulario" action="<?= $BASE_URL ?>process_evento.php" id="update-form" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="type" value="update">
            <div class="form-group row">

                <input type="hidden" class="form-control" id="id_evento" name="id_evento" value="<?= $evento->id_evento ?>" placeholder="ID">

                <div class="form-group col-sm-4">
                    <label for="paciente">Paciente</label>
                    <input style="font-weight:600;" type="text" class="form-control" id="paciente" value="<?= $evento->paciente ?>" name="paciente" placeholder="Digite o nome">
                </div>
                <div class="form-group col-sm-2">
                    <label class="control-label" for="hospital">Hospital</label>
                    <select class="form-control" id="hospital" name="hospital">
                        <option value="">Selecione</option>
                        <?php
                        foreach ($dados_hospital as $hosp) {
                            if ($evento->hospital == $hosp) { ?>
                                <option selected value="<?= $evento->hospital; ?>"><?= $hosp; ?></option>
                            <?php } else { ?>
                                <option value="<?= $hosp; ?>"><?= $hosp; ?></option>
                        <?php  }
                        } ?>
                    </select>
                </div>
                <div class="form-group col-sm-1">
                    <label for="senha">Senha</label>
                    <input type="text" class="form-control" id="senha" value="<?= $evento->senha ?>" name="senha" placeholder="Digite a senha">
                </div>
                <div class="form-group col-sm-1">
                    <label for="data_evento">Data do EA</label>
                    <input type="date" class="form-control" value="<?= $evento->data_evento ?>" id="data_evento" name="data_evento">
                </div>
            </div>
            <div class="form-group row">
                <div class="form-group col-sm-2 ">
                    <label class="control-label" for="negociado">Negociado</label>
                    <select class="form-control" id="negociado" name="negociado">
                        <option value="s">Sim</option>
                        <option value="s" <?= $evento->negociado == 's' ? ' selected ' : '' ?>>Sim</option>
                        <option value="n" <?= $evento->negociado == 'n' ? ' selected ' : '' ?>>Não</option>
                    </select>
                    <p style="text-align:justify;font-size:0.6em;padding-left:7px">Evento foi negociado?</p>
                </div>
                <div class="form-group col-sm-2 ">
                    <label class="control-label" for="ativo">Ativo</label>
                    <select class="form-control" id="ativo" name="ativo">
                        <option value="n">Não</option>
                        <option value="s" <?= $evento->ativo == 's' ? ' selected ' : '' ?>>Sim</option>
                        <option value="n" <?= $evento->ativo == 'n' ? ' selected ' : '' ?>>Não</option>
                    </select>
                </div>
                <div class="form-group col-sm-2 ">
                    <label class="control-label" for="valor_negociado">Valor negociado</label>
                    <input id="valor_negociado" type="text" name="valor_negociado" placeholder="Valor Negociado" class="form-control dinheiro">
                </div>
                <div class="form-group col-sm-2 ">
                    <label class="control-label" for="status">Status</label>
                    <select class="form-control" id="status" name="status">
                        <option value="Concluído">Concluído</option>
                        <?php
                        sort($dadosStatus, SORT_ASC);
                        foreach ($dadosStatus as $stat) {
                            if ($evento->status == $stat) { ?>
                                <option selected value="<?= $stat; ?>"><?= $stat; ?></option>
                            <?php } else { ?>
                                <option value="<?= $stat; ?>"><?= $stat; ?></option>
                        <?php  }
                        } ?>
                    </select>
                </div>
            </div>

    </div>

    <div>
        <button style="margin:10px" type="submit" class="btn-sm btn-info">Atualizar</button>
        <br>
    </div>
    <div class="form-group col-sm-4">

    </div>
    </form>
    <?php if (!empty($flassMessage["msg"])) : ?>
        <div class="msg-container">
            <p class="msg <?= $flassMessage["type"] ?>"><?= $flassMessage["msg"] ?></p>
        </div>
    <?php endif; ?>
    <hr>
    <?php include_once("diversos/backbtn_evento.php"); ?>

</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
<script src="js/scriptMoeda.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>

<?php
require_once("templates/footer.php");
