<?php
// include_once("check_logado.php");
require_once("templates/header.php");
?>

<div class="container" style="margin-bottom:80px">
    <!-- <?php print_r($_SESSION); ?> -->

    <div class="row" style="margin-top:10px; background-color:#F1F0EF;box-shadow: inset 2px 2px 3px rgba(255, 255, 255, .8), inset -2px -2px 3px rgba(0, 0, 0, .6); border-radius: 10px;">
        <div style="height: 10px;">
        </div>

        <!-- lista producao -->
        <div class="col lista_menu">
            <h4>PRODUÇÃO</h4>
            <hr>
            <li>
                <a href="cad_evento.php" <?php if ($_SESSION['nivel'] < 2) { ?> style="pointer-events: none" ?<?php } ?>><i class="bi bi-book" style="font-size: 1rem;margin-right:5px; color: rgb(255, 25, 55);"></i>Cadastro Evento</a>
            </li>

            <li>
                <a href="list_visita.php" <?php if ($_SESSION['nivel'] < 2) { ?> style="pointer-events: none" ?<?php } ?>><i class="bi bi-pencil-square" style="font-size: 1rem;margin-right:5px; color: rgb(255, 25, 55);"></i>Nova Visita</a>
            </li>
            <hr>

            <li>
                <a href="list_internacao.php" <?php if ($_SESSION['nivel'] < 2) { ?> style="pointer-events: none" ?<?php } ?>><i class="bi bi-calendar2-date" style="font-size: 1rem;margin-right:5px; color: rgb(27,156, 55);"></i>Lista Internação</a>
            </li>

            <hr>

            <li>
                <a href="list_internacao_alta.php" <?php if ($_SESSION['nivel'] < 2) { ?> style="pointer-events: none" ?<?php } ?>><span id="boot-icon3" class="bi bi-box-arrow-left" style="font-size: 1rem; margin-right:5px; color: rgb(16, 15, 155);"></span>Alta Hospitalar</a>
            </li>
            <hr>
            <li>
                <a href="list_gestao.php" <?php if ($_SESSION['nivel'] < 2) { ?> style="pointer-events: none" ?<?php } ?>><i class=" bi bi-clipboard-heart" style="font-size: 1rem;margin-right:5px; color: rgb(142, 15, 15);"></i>Gestão</a>
            </li>
            <hr>
            <li>
                <a href="list_internacao_patologia.php" <?php if ($_SESSION['nivel'] < 2) { ?> style="pointer-events: none" ?<?php } ?>><span id="boot-icon1" class="bi bi-capsule-pill" style="font-size: 1rem; margin-right:5px; color: rgb(77, 155, 67);"> </span>DRG</a>
            </li>
            <br>
        </div>

        <!-- lista admnistrativo -->
        <div class="col lista_menu">

            <h4>ADMINISTRATIVO</h4>
            <hr>

            <li>
                <a href="cad_usuario.php" <?php if ($_SESSION['nivel'] < 4) { ?> style="pointer-events: none" ?<?php } ?>><span class="bi bi-person" style="font-size: 1rem;margin-right:5px; color: rgb(155, 155, 76);"></span>Cadastro Usuários</a>
            </li>
            <li>
                <a href="nova_senha.php" <?php if ($_SESSION['nivel'] < 4) { ?> style="pointer-events: none" ?<?php } ?>><span class="bi bi-person" style="font-size: 1rem;margin-right:5px; color: rgb(15, 15, 76);"></span>Alterar senha</a>
            </li>
            <li>
                <a href="cad_acomodacao.php" <?php if ($_SESSION['nivel'] < 2) { ?> style="pointer-events: none" ?<?php } ?>><span class="bi bi-clipboard-heart" style="font-size: 1rem; margin-right:5px; color: rgb(155, 155, 76);"></span>Cadastro Acomodação</a>
            </li>
            <hr>
            <li>
                <a href="list_usuario.php" <?php if ($_SESSION['nivel'] < 4) { ?> style="pointer-events: none" ?<?php } ?>><span class="bi bi-person" style="font-size: 1rem;margin-right:5px; color: rgb(15, 155, 18);"></span>Relação Usuários</a>
            </li>
        </div>

        <!-- lista cadastro -->
        <div style="margin-bottom:80px" class="col lista_menu">
            <div>
                <h4 class="titulo_menu" <?php if ($_SESSION['nivel'] < 4) { ?> style="pointer-events: none" ?<?php } ?>>CADASTRO</h4>
            </div>
            <hr>
            <li>
                <a href="cad_paciente.php" <?php if ($_SESSION['nivel'] < 2) { ?> style="pointer-events: none" ?<?php } ?>><span class="bi bi-person" style="font-size: 1rem;margin-right:5px; color: rgb(155, 155, 76);"></span>Pacientes</a>
            </li>
            <li>
                <a href="cad_hospital.php" <?php if ($_SESSION['nivel'] < 4) { ?> style="pointer-events: none" ?<?php } ?>><span class="bi bi-hospital" style="font-size: 1rem;margin-right:5px; color: rgb(255, 25, 55);"></span>Hospital</a>
            </li>
            <li>
                <a href="cad_usuario.php" <?php if ($_SESSION['nivel'] < 4) { ?> style="pointer-events: none" ?<?php } ?>><i class="bi bi-person-add" style="font-size: 1rem; margin-right:5px; color: rgb(155, 15, 276);"></i>Usuário</a>
            </li>
            <li>
                <a href="cad_paciente.php" <?php if ($_SESSION['nivel'] < 4) { ?> style="pointer-events: none" ?<?php } ?>><span class="bi bi-building" style="font-size: 1rem; margin-right:5px; color: rgb(145, 25, 177);"></span>Estipulante</a>
            </li>
            <li>
                <a href="cad_seguradora.php" <?php if ($_SESSION['nivel'] < 4) { ?> style="pointer-events: none" ?<?php } ?>><span class="bi bi-heart-pulse" style="font-size: 1rem;margin-right:5px; color: rgb(255, 215, 55);"></span>Seguradora</a>
            </li>
        </div>
        <!-- lista Listas -->
        <div class="col lista_menu">
            <h4>LISTAS</h4>
            <hr>
            <li>
                <a href="list_evento.php" <?php if ($_SESSION['nivel'] < 2) { ?> style="pointer-events: none" ?<?php } ?>><span class="bi bi-person" style="font-size: 1rem;margin-right:5px; color: rgb(155, 155, 76);"></span> Eventos</a>
            </li>
            <li>
                <a href="list_evento_analise.php" <?php if ($_SESSION['nivel'] < 4) { ?> style="pointer-events: none" ?<?php } ?>><span class="bi bi-hospital" style="font-size: 1rem;margin-right:5px; color: rgb(67, 125, 525);"></span> Eventos em análise</a>
            </li>
            <li>
                <a href="list_usuario.php" <?php if ($_SESSION['nivel'] < 4) { ?> style="pointer-events: none" ?<?php } ?>><i class="bi bi-file-medical" style="font-size: 1rem; margin-right:5px; color: rgb(155, 16, 76);"></i> Usuário</a>
            </li>
        </div>

        <hr>

    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
<?php
require_once("templates/footer.php");
?>