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
<div id="main-container" class="container-fluid">
    <div class="row">
        <h1 class="page-title">Atualizar evento</h1>

        <p class="page-description">Adicione informações sobre o evento</p>
        <form class="formulario" action="<?= $BASE_URL ?>process_evento.php" id="update-form" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="type" value="update">
            <div class="form-group row">

                <input type="hidden" class="form-control" id="id_evento" name="id_evento" value="<?= $evento->id_evento ?>" placeholder="ID">

                <div class="form-group col-sm-4">
                    <label for="paciente">Paciente</label>
                    <input style="font-weight:600;" type="text" class="form-control" id="paciente" value="<?= $evento->paciente ?>" name="paciente" placeholder="Digite o nome">
                </div>

                <div class="form-group col-sm-1">
                    <label for="idade">Idade</label>
                    <input type="text" class="form-control" id="idade" value="<?= $evento->idade ?>" name="idade" placeholder="Digite a idade">
                </div>
                <div class="form-group col-sm-1 ">
                    <label class="control-label" for="sexo">Sexo</label>
                    <select class="form-control" id="sexo" name="sexo">
                        <option value="">Selecione</option>
                        <option <?= $evento->sexo == 'Feminino' ? ' selected ' : '' ?> value="Feminino">Feminino</option>
                        <option <?= $evento->sexo == 'Masculino' ? ' selected ' : '' ?> value="Masculino">Masculino</option>
                    </select>
                </div>
                <div class="form-group col-sm-2">
                    <label class="control-label" for="hospital">Hospital</label>
                    <select class="form-control" id="hospital" name="hospital">
                        <option value="">Selecione</option>
                        <?php
                        foreach ($dados_hospital as $hosp) {
                            if ($evento->hospital == $hosp) { ?>
                                <option selected value="<?= $hosp; ?>"><?= $hosp; ?></option>
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
                <div class="form-group col-sm-1">
                    <label for="data_visita">Data visita</label>
                    <input type="date" class="form-control" value="<?= $evento->data_visita ?>" id="data_visita" name="data_visita">
                </div>
                <div class="form-group row">
                    <div class="form-group col-sm-2">
                        <label class="control-label" for="propria">Auditoria própria</label>
                        <select class="form-control" id="propria" name="propria">
                            <option value="">Selecione</option>
                            <option value="s" <?= $evento->propria == 's' ? ' selected ' : '' ?>>Sim</option>
                            <option value="n" <?= $evento->propria == 'n' ? ' selected ' : '' ?>>Não</option>
                        </select>

                    </div>
                    <div class="form-group col-sm-2">
                        <label class="control-label" for="empresa">Nome da Empresa</label>
                        <select class="form-control" id="empresa" name="empresa">
                            <option value="">Selecione</option>
                            <option value="">Selecione</option>
                            <?php
                            sort($dados_empAuditoria, SORT_ASC);
                            foreach ($dados_empAuditoria as $emp) {
                                if ($evento->empresa == $emp) { ?>
                                    <option selected value="<?= $emp; ?>"><?= $emp; ?></option>
                                <?php } else { ?>
                                    <option value="<?= $emp; ?>"><?= $emp; ?></option>
                            <?php  }
                            } ?>
                        </select>
                    </div>
                    <div class="form-group col-sm-4">
                        <label for="auditor">Nome do auditor</label>
                        <input type="text" class="form-control" id="auditor" value="<?= $evento->auditor ?>" name="auditor" placeholder="Digite o nome do auditor">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="form-group col-sm-2">
                        <label class="control-label" for="prolongamento">Prolongamento da internação</label>
                        <select class="form-control" id="prolongamento" name="prolongamento">
                            <option value="">Selecione</option>
                            <option value="s" <?= $evento->prolongamento == 's' ? ' selected ' : '' ?>>Sim</option>
                            <option value="n" <?= $evento->prolongamento == 'n' ? ' selected ' : '' ?>>Não</option>
                        </select>
                        <p style="text-align:justify;font-size:0.6em;padding-left:7px">Caso entenda que o prolongamento da internação foi causada pelo EA</p>
                    </div>
                    <div class="form-group col-sm-10">
                        <label for="rel_prolongamento">Motivo do prolongamento </label>
                        <textarea rows="10" form="update-form" class="form-control" id="rel_prolongamento" value="<?= $evento->rel_prolongamento ?>" name="rel_prolongamento"><?= $evento->rel_prolongamento ?></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="form-group col-sm-2 ">
                        <label class="control-label" for="impacto">Impacto nos custos da internação</label>
                        <select class="form-control" id="impacto" name="impacto">
                            <option value="">Selecione</option>
                            <option value="s" <?= $evento->impacto == 's' ? ' selected ' : '' ?>>Sim</option>
                            <option value="n" <?= $evento->impacto == 'n' ? ' selected ' : '' ?>>Não</option>
                        </select>
                        <p style="text-align:justify;font-size:0.6em;padding-left:7px">Selecione caso entenda que o evento causou impacto no custo da internação</p>
                    </div>
                    <div class="form-group col-sm-10">
                        <label for="rel_impacto">Relatório sobre impacto nos custos </label>
                        <textarea rows="10" form="update-form" class="form-control" value="<?= $evento->rel_impacto ?>" id="rel_impacto" name="rel_impacto"><?= $evento->rel_impacto ?></textarea>
                    </div>
                </div>
                <div class="form-group col-sm-2 ">
                    <label class="control-label" for="gravidade">Classificação do EA</label>
                    <select class="form-control" id="gravidade" name="gravidade">
                        <option value="">Selecione</option>
                        <option value="Grave" <?= $evento->gravidade == 'Grave' ? ' selected ' : '' ?>>Grave</option>
                        <option value="Moderado" <?= $evento->gravidade == 'Moderado' ? ' selected ' : '' ?>>Moderado</option>
                        <option value="Leve" <?= $evento->gravidade == 'Leve' ? ' selected ' : '' ?>>Leve</option>
                    </select>
                    <p style="text-align:justify;font-size:0.6em;padding-left:7px">Qual sua opinão sobre a gravidade do evento?</p>
                </div>
                <div class="form-group col-sm-2 ">
                    <label class="control-label" for="alta">Evitável</label>
                    <select class="form-control" id="alta" name="alta">
                        <option value="">Selecione</option>
                        <option value="s" <?= $evento->alta == 's' ? ' selected ' : '' ?>>Sim</option>
                        <option value="n" <?= $evento->alta == 'n' ? ' selected ' : '' ?>>Não</option>
                    </select>
                    <p style="text-align:justify;font-size:0.6em;padding-left:7px">Na sua opinião poderia ser evitado?</p>
                </div>
                <div class="form-group col-sm-2 ">
                    <label class="control-label" for="evitavel">Alta</label>
                    <select class="form-control" id="evitavel" name="evitavel">
                        <option value="">Selecione</option>
                        <option value="s" <?= $evento->evitavel == 's' ? ' selected ' : '' ?>>Sim</option>
                        <option value="n" <?= $evento->evitavel == 'n' ? ' selected ' : '' ?>>Não</option>
                    </select>
                    <p style="text-align:justify;font-size:0.6em;padding-left:7px">Paciente recebeu alta?</p>
                </div>
                <div class="form-group col-sm-2 ">
                    <label class="control-label" for="obito">Óbito</label>
                    <select class="form-control" id="obito" name="obito">
                        <option value="">Selecione</option>
                        <option value="s" <?= $evento->obito == 's' ? ' selected ' : '' ?>>Sim</option>
                        <option value="n" <?= $evento->obito == 'n' ? ' selected ' : '' ?>>Não</option>
                    </select>
                    <p style="text-align:justify;font-size:0.6em;padding-left:7px">Paciente foi a óbito?</p>
                </div>
            </div>
            <div class="form-group row">

                <div class="form-group col-sm-2 ">
                    <label class="control-label" for="negociado">Negociado</label>
                    <select class="form-control" id="negociado" name="negociado">
                        <option value="">Selecione</option>
                        <option value="s" <?= $evento->negociado == 's' ? ' selected ' : '' ?>>Sim</option>
                        <option value="n" <?= $evento->negociado == 'n' ? ' selected ' : '' ?>>Não</option>
                    </select>
                    <p style="text-align:justify;font-size:0.6em;padding-left:7px">Evento foi negociado?</p>
                </div>
                <div class="form-group col-sm-2 ">
                    <label class="control-label" for="ativo">Ativo</label>
                    <select class="form-control" id="ativo" name="ativo">
                        <option value="">Selecione</option>
                        <option value="s" <?= $evento->ativo == 's' ? ' selected ' : '' ?>>Sim</option>
                        <option value="n" <?= $evento->ativo == 'n' ? ' selected ' : '' ?>>Não</option>
                    </select>
                </div>
                <div class="form-group col-sm-2 ">
                    <label class="control-label" for="status">Status</label>
                    <select class="form-control" id="status" name="status">
                        <option value="">Selecione</option>
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
            <div class="form-group row">
                <div class="form-group col-sm-12">
                    <label for="rel_evento">Relatório sobre o caso </label>
                    <textarea rows="10" form="update-form" class="form-control" type="text" id="rel_evento" value="<?= $evento->rel_evento ?>" name="rel_evento"><?= $evento->rel_evento ?></textarea>
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

</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>


<?php include_once("diversos/backbtn_evento.php"); ?>

<?php
require_once("templates/footer.php");
