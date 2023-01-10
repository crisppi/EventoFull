<?php class Conexao
{
    public static function pegarConexao()
    {
        $host = "bd-evento-adver.mysql.uhserver.com";
        $user = "dir_event";
        $pass = "Guga@0401";
        $dbname = "bd_evento_adver";
        $port = 3306;
        $conn = new PDO("mysql:dbname=$dbname;host=$host", $user, $pass);
    }
}
