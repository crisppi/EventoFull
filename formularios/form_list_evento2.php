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
    $evento = new eventoDAO($conn, $BASE_URL);
    $paciente = "";
    //Instanciar o metodo listar evento
    $query = $evento->findBypaciente($paciente);
    var_dump($query);
    echo "<br>";
    echo "<br>";
    echo "<br>";
    echo "<br>";
    echo "<br>";

    $paciente = "joaq";
    $query = $evento->findBypaciente($paciente);

    var_dump($query[1]['paciente']);

    ?>