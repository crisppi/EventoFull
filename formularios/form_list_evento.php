<body>
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <?php
    include_once("globals.php");
    include_once("models/evento.php");
    include_once("dao/eventoDao.php");
    include_once("templates/header.php");
    include_once("array_dados.php");


    //Instanciando a classe
    //Criado o objeto $listareventos
    $evento_geral = new eventoDAO($conn, $BASE_URL);

    //Instanciar o metodo listar evento
    $eventos = $evento_geral->findGeral();
    ?>

    <!--tabela evento-->
    <div class="container-fluid py-2">
        <h4 class="page-title">Relação de eventos</h4>
        <div class="row menu_pesquisa">
            <form id="form_pesquisa" method="POST">

                <div class="form-group row">
                    <h5 class="page-title">Pesquisa</h5>
                    <input type="hidden" name="pesquisa" id="pesquisa" value="sim">
                    <div class="form-group col-sm-2">
                        <input type="text" name="pesquisa_event" id="pesquisa_event" placeholder="Pesquisa por evento">
                    </div>
                    <div class="form-group col-sm-3">
                        <select class="form-control" id="hospital_pes" name="hospital_pes">
                            <option value="">Selecione o Hospital</option>
                            <?php
                            foreach ($dados_hospital as $hospital_pes) { ?>
                                <option value="<?= $hospital_pes; ?>"><?= $hospital_pes; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <button style="margin:10px; font-weight:600" type="submit" class="btn-sm btn-info styled">Pesquisar</button>
            </form>

            <?php

            if (isset($_POST['pesquisa_event'])) {
                $pesquisa_event = $_POST['pesquisa_event'];
                echo "<br>";
                echo $pesquisa_event;
            } else {
                $pesquisa_event = "";
            }
            if (isset($_POST['hospital_pes'])) {
                $hospital_pes = $_POST['hospital_pes'];
                echo "<br>";
                echo $hospital_pes;
            } else {
                $hospital_pes = "";
            }

            if ((isset($_POST['pesquisa_event'])) && (!isset($_POST['hospital_pes']))) {
                $case = 1;
            };

            if (!isset($_POST['pesquisa_event']) && (isset($_POST['hospital_pes']))) {
                $case = 2;
            };
            if ((isset($_POST['pesquisa_event']))  &&  (isset($_POST['hospital_pes']))) {
                $case = 3;
            };
            if (!isset($_POST['pesquisa_event']) && (!isset($_POST['hospital_pes']))) {
                $case = 4;
            };

            ?>
        </div>
        <?php

        switch ($case) {
            case $case = 1:
                $sql = "SELECT * FROM tb_evento WHERE paciente like '$pesquisa_event%' ";
                break;
            case $case = 2:
                $sql = "SELECT * FROM tb_evento WHERE hospital ='$hospital_pes' ";
                break;
            case $case = 3:
                $sql = "SELECT * FROM tb_evento WHERE paciente like '$pesquisa_event%' and hospital ='$hospital_pes' ";
                break;
            case $case = 4:
                $sql = "SELECT * FROM tb_evento ORDER BY id_evento ASC LIMIT " . $inicio . ", " . $limite;
                break;
        }
        print_r($sql);
        echo $case;


        // $sql = "";
        // if (!$pesquisa_event) {
        //     $sql = "SELECT * FROM tb_evento ORDER BY id_evento ASC LIMIT " . $inicio . ", " . $limite;
        // } else {
        //     $sql = "SELECT * FROM tb_evento WHERE paciente like '$pesquisa_event%' and hospital ='$hospital_pes' ";
        // }
        try {

            $query = $conn->prepare($sql);
            $query->execute();
        } catch (PDOexception $error_sql) {

            echo 'Erro ao retornar os Dados.' . $error_sql->getMessage();
        }

        while ($linha = $query->fetch(PDO::FETCH_ASSOC)) { ?>

            <table class="table table-sm table-striped table-bordered table-hover table-condensed">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Paciente</th>
                        <th scope="col">Hospital</th>
                        <th scope="col">Senha</th>
                        <th scope="col">Data Evento</th>
                        <th scope="col">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                    foreach ($query as $evento) :
                        extract($evento);
                    ?>
                        <tr>
                            <td scope="row" class="col-id"><?= $id_evento ?></td>
                            <td scope="row" class="nome-coluna-table"><?= $paciente ?></td>
                            <td scope="row" class="nome-coluna-table"><?= $hospital ?></td>
                            <td scope="row" class="nome-coluna-table"><?= $senha ?></td>
                            <td scope="row" class="nome-coluna-table"><?= date("d-m-Y", strtotime($data_evento)) ?></td>

                            <td class="action">
                                <a href="cad_evento.php"><i name="type" value="create" style="color:green; margin-right:10px" class="bi bi-plus-square-fill edit-icon"></i></a>
                                <a href="<?= $BASE_URL ?>show_evento.php?id_evento=<?= $id_evento ?>"><i style="color:orange; margin-right:10px" class="fas fa-eye check-icon"></i></a>

                                <a href="<?= $BASE_URL ?>edit_evento.php?id_evento=<?= $id_evento ?>"><i style="color:blue" name="type" value="edite" class="aparecer-acoes far fa-edit edit-icon"></i></a>

                                <a href="<?= $BASE_URL ?>show_evento.php?id_evento=<?= $id_evento ?>"><i style="color:red; margin-left:10px" name="type" value="edite" class="d-inline-block bi bi-x-square-fill delete-icon"></i></a>

                                <div id="info"></div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <div id="id-confirmacao" class="btn_acoes oculto">
                <p>Deseja deletar este evento: <?= $evento_ant ?>?</p>
                <button class="btn btn-success styled" onclick=cancelar() type="button" id="cancelar" name="cancelar">Cancelar</button>
                <button class="btn btn-danger styled" onclick=deletar() value="default" type="button" id="deletar-btn" name="deletar">Deletar</button>
            </div>
    </div>

<?php }

        //modo cadastro
        $formData = "0";
        $formData = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        if ($formData !== "0") {
            $_SESSION['msg'] = "<p style='color: green;'>Usuário cadastrado com sucesso!</p>";
            //header("Location: index.php");
        } else {
            echo "<p style='color: #f00;'>Erro: Usuário não cadastrado!</p>";
        };

        try {

            $query_Total = $conn->prepare($sql_Total);
            $query_Total->execute();

            $query_result = $query_Total->fetchAll(PDO::FETCH_ASSOC);

            # conta quantos registros tem no banco de dados
            $query_count = $query_Total->rowCount();

            # calcula o total de paginas a serem exibidas
            $qtdPag = ceil($query_count / $limite);
        } catch (PDOexception $error_Total) {

            echo 'Erro ao retornar os Dados. ' . $error_Total->getMessage();
        }
        echo "<div style=margin-left:20px;>";
        echo "<div style='color:blue; margin-left:20px;'>";
        echo "</div>";
        echo "<nav aria-label='Page navigation example'>";
        echo " <ul class='pagination'>";
        echo " <li class='page-item'><a class='page-link' href='list_evento.php?pg=1'><span aria-hidden='true'>&laquo;</span></a></li>";
        if ($qtdPag > 1 && $pg <= $qtdPag) {
            for ($i = 1; $i <= $qtdPag; $i++) {
                if ($i == $pg) {
                    echo "<li class='page-item active'><a class='page-link' class='ativo'>" . $i . "</a></li>";
                } else {
                    echo "<li class='page-item '><a class='page-link' href='list_evento.php?pg=$i'>" . $i . "</a></li>";
                }
            }
        }
        echo "<li class='page-item'><a class='page-link' href='list_evento.php?pg=$qtdPag'><span aria-hidden='true'>&raquo;</span></a></li>";
        echo " </ul>";
        echo "</nav>";
        echo "</div>"; ?>
<div>
    <hr>
    <a class="btn btn-success styled" style="margin-left:120px" href="cad_evento.php">Novo Evento</a>
</div>
</body>

<script>
    function apareceOpcoes() {
        $('#deletar-btn').val('nao');
        let mudancaStatus = ($('#deletar-btn').val())
        console.log(mudancaStatus);
        let idAcoes = (document.getElementById('id-confirmacao'));
        idAcoes.style.display = 'block';
    }

    function deletar() {
        $('#deletar-btn').val('ok');
        let idAcoes = (document.getElementById('id-confirmacao'));
        idAcoes.style.display = 'none';
        let mudancaStatus = ($('#deletar-btn').val())
        console.log(mudancaStatus);
        window.location = "<?= $BASE_URL ?>del_evento.php?id_evento=<?= $id_evento ?>";
    };

    function cancelar() {
        let idAcoes = (document.getElementById('id-confirmacao'));
        idAcoes.style.display = 'none';
        console.log("chegou no cancelar");

    };
    src = "https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js";
</script>