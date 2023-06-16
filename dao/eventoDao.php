<?php

require_once("./models/evento.php");
require_once("./models/message.php");

// Review DAO

class eventoDAO implements eventoDAOInterface
{

    private $conn;
    private $url;
    public $message;

    public function __construct(PDO $conn, $url)
    {
        $this->conn = $conn;
        $this->url = $url;
        $this->message = new Message($url);
    }

    public function buildevento($data)
    {
        $evento = new evento();

        $evento->id_evento = $data["id_evento"];
        $evento->paciente = $data["paciente"];
        $evento->sexo = $data["sexo"];
        $evento->idade = $data["idade"];
        $evento->hospital = $data["hospital"];
        $evento->data_evento = $data["data_evento"];
        $evento->data_visita = $data["data_visita"];
        $evento->seguradora = $data["seguradora"];
        $evento->rel_impacto = $data["rel_impacto"];
        $evento->rel_evento = $data["rel_evento"];
        $evento->rel_prolongamento = $data["rel_prolongamento"];
        $evento->impacto = $data["impacto"];
        $evento->classificacao = $data["classificacao"];
        $evento->senha = $data["senha"];
        $evento->evitavel = $data["evitavel"];
        $evento->alta = $data["alta"];
        $evento->prolongamento = $data["prolongamento"];
        $evento->obito = $data["obito"];
        $evento->gravidade = $data["gravidade"];
        $evento->propria = $data["propria"];
        $evento->empresa = $data["empresa"];
        $evento->ativo = $data["ativo"];
        $evento->negociado = $data["negociado"];
        $evento->valor_negociado = $data["valor_negociado"];
        $evento->status = $data["status"];
        $evento->tipo_evento = $data["tipo_evento"];

        return $evento;
    }

    public function findAll()
    {
        $evento = [];

        $stmt = $this->conn->prepare("SELECT * FROM tb_evento
        ORDER BY id_evento asc");

        $stmt->execute();

        $evento = $stmt->fetchAll();
        return $evento;
    }

    public function getevento()
    {

        $evento = [];

        $stmt = $this->conn->query("SELECT * FROM tb_evento ORDER BY id_evento asc");

        $stmt->execute();

        if ($stmt->rowCount() > 0) {

            $eventoArray = $stmt->fetchAll();

            foreach ($eventoArray as $evento) {
                $evento[] = $this->buildevento($evento);
            }
        }

        return $evento;
    }

    public function geteventoByNome($nome)
    {

        $evento = [];

        $stmt = $this->conn->prepare("SELECT * FROM tb_evento
                                    WHERE evento = :evento
                                    ORDER BY id_evento asc");

        $stmt->bindParam(":evento", $evento);

        $stmt->execute();

        if ($stmt->rowCount() > 0) {

            $eventoArray = $stmt->fetchAll();

            foreach ($eventoArray as $evento) {
                $evento[] = $this->buildevento($evento);
            }
        }

        return $evento;
    }

    public function findById($id_evento)
    {
        $evento = [];
        $stmt = $this->conn->prepare("SELECT * FROM tb_evento
                                    WHERE id_evento = :id_evento");

        $stmt->bindParam(":id_evento", $id_evento);
        $stmt->execute();

        $data = $stmt->fetch();
        $evento = $this->buildevento($data);

        return $evento;
    }

    public function findBypaciente($pesquisa_nome, $pesquisa_ativo)
    {

        $evento = [];

        $stmt = $this->conn->prepare("SELECT * FROM tb_evento
                                    WHERE paciente LIKE :paciente AND ativo =:ativo ");

        $stmt->bindValue(":paciente", '%' . $pesquisa_nome . '%');
        $stmt->bindValue(":ativo", $pesquisa_ativo);

        $stmt->execute();

        $evento = $stmt->fetchAll();
        return $evento;
    }
    public function findByHospital($pesquisa_hospital)
    {

        $evento = [];

        $stmt = $this->conn->prepare("SELECT * FROM tb_evento
                                    WHERE hospital like :hospital");

        $stmt->bindValue(":hospital", $pesquisa_hospital);

        $stmt->execute();

        $evento = $stmt->fetchAll();
        return $evento;
    }

    public function findByPacHosp($pesquisa_nome, $pesquisa_hospital)
    {

        $evento = [];

        $stmt = $this->conn->prepare("SELECT * FROM tb_evento
                                    WHERE paciente LIKE :paciente AND hospital = :hospital ");

        $stmt->bindValue(":paciente", '%' . $pesquisa_nome . '%');
        $stmt->bindValue(":hospital", $pesquisa_hospital);

        $stmt->execute();

        $evento = $stmt->fetchAll();
        return $evento;
    }

    public function create(evento $evento)
    {

        $stmt = $this->conn->prepare("INSERT INTO tb_evento (
        paciente,
        sexo,
        idade,
        hospital,
        seguradora,
        data_evento,
        data_visita,
        rel_impacto,
        rel_evento,
        rel_prolongamento,
        prolongamento,
        impacto,
        classificacao,
        senha,
        evitavel,
        alta,
        obito,
        gravidade,
        ativo,
        negociado,
        status,
        propria,
        empresa,
        tipo_evento,
        valor_negociado

      ) VALUES (
        :paciente,
        :sexo,
        :idade,
        :hospital,
        :seguradora,
        :data_evento,
        :data_visita,
        :rel_impacto,
        :rel_evento,
        :rel_prolongamento,
        :prolongamento,
        :impacto,
        :classificacao,
        :senha,
        :evitavel,
        :alta,
        :obito,
        :gravidade,
        :ativo,
        :negociado,
        :status,
        :propria,
        :empresa,
        :tipo_evento,
        :valor_negociado
    )");

        $stmt->bindParam(":paciente", $evento->paciente);
        $stmt->bindParam(":sexo", $evento->sexo);
        $stmt->bindParam(":idade", $evento->idade);
        $stmt->bindParam(":hospital", $evento->hospital);
        $stmt->bindParam(":data_evento", $evento->data_evento);
        $stmt->bindParam(":data_visita", $evento->data_visita);
        $stmt->bindParam(":seguradora", $evento->seguradora);
        $stmt->bindParam(":rel_impacto", $evento->rel_impacto);
        $stmt->bindParam(":rel_evento", $evento->rel_evento);
        $stmt->bindParam(":rel_prolongamento", $evento->rel_prolongamento);
        $stmt->bindParam(":prolongamento", $evento->prolongamento);
        $stmt->bindParam(":impacto", $evento->impacto);
        $stmt->bindParam(":classificacao", $evento->classificacao);
        $stmt->bindParam(":senha", $evento->senha);
        $stmt->bindParam(":evitavel", $evento->evitavel);
        $stmt->bindParam(":alta", $evento->alta);
        $stmt->bindParam(":obito", $evento->obito);
        $stmt->bindParam(":gravidade", $evento->gravidade);
        $stmt->bindParam(":ativo", $evento->ativo);
        $stmt->bindParam(":negociado", $evento->negociado);
        $stmt->bindParam(":valor_negociado", $evento->valor_negociado);
        $stmt->bindParam(":status", $evento->status);
        $stmt->bindParam(":propria", $evento->propria);
        $stmt->bindParam(":empresa", $evento->empresa);
        $stmt->bindParam(":tipo_evento", $evento->tipo_evento);
        $stmt->execute();
        $cad_antec = 1;
        // Mensagem de sucesso por adicionar evento
        $this->message->setMessage("Adicionado com sucesso!", "success", "cad_evento.php");
    }

    public function update(evento $evento)
    {
        $stmt = $this->conn->prepare("UPDATE tb_evento SET 
        paciente = :paciente,
        sexo = :sexo,
        idade = :idade,
        hospital = :hospital,
        seguradora = :seguradora,
        data_evento = :data_evento,
        data_visita = :data_visita,
        rel_impacto = :rel_impacto,
        rel_evento = :rel_evento,
        rel_prolongamento = :rel_prolongamento,
        prolongamento = :prolongamento,
        impacto = :impacto,
        classificacao = :classificacao,
        senha = :senha,
        evitavel = :evitavel,
        alta = :alta,
        obito = :obito,
        gravidade = :gravidade,
        ativo = :ativo,
        negociado = :negociado,
        valor_negociado = :valor_negociado,
        status = :status,
        propria = :propria,
        empresa = :empresa,
        tipo_evento = :tipo_evento
        
        WHERE id_evento = :id_evento 
      ");

        $stmt->bindParam(":id_evento", $evento->id_evento);
        $stmt->bindParam(":paciente", $evento->paciente);
        $stmt->bindParam(":sexo", $evento->sexo);
        $stmt->bindParam(":idade", $evento->idade);
        $stmt->bindParam(":hospital", $evento->hospital);
        $stmt->bindParam(":seguradora", $evento->seguradora);
        $stmt->bindParam(":data_evento", $evento->data_evento);
        $stmt->bindParam(":data_visita", $evento->data_visita);
        $stmt->bindParam(":rel_impacto", $evento->rel_impacto);
        $stmt->bindParam(":rel_evento", $evento->rel_evento);
        $stmt->bindParam(":rel_prolongamento", $evento->rel_prolongamento);
        $stmt->bindParam(":prolongamento", $evento->prolongamento);
        $stmt->bindParam(":impacto", $evento->impacto);
        $stmt->bindParam(":classificacao", $evento->classificacao);
        $stmt->bindParam(":senha", $evento->senha);
        $stmt->bindParam(":evitavel", $evento->evitavel);
        $stmt->bindParam(":alta", $evento->alta);
        $stmt->bindParam(":obito", $evento->obito);
        $stmt->bindParam(":gravidade", $evento->gravidade);
        $stmt->bindParam(":ativo", $evento->ativo);
        $stmt->bindParam(":negociado", $evento->negociado);
        $stmt->bindParam(":valor_negociado", $evento->valor_negociado);
        $stmt->bindParam(":status", $evento->status);
        $stmt->bindParam(":propria", $evento->propria);
        $stmt->bindParam(":empresa", $evento->empresa);
        $stmt->bindParam(":ativo", $evento->ativo);
        $stmt->bindParam(":tipo_evento", $evento->tipo_evento);
        $stmt->execute();

        // Mensagem de sucesso por editar evento
        $this->message->setMessage("Atualizado com sucesso!", "success", "list_evento.php");
    }

    public function destroy($id_evento)
    {
        $stmt = $this->conn->prepare("DELETE FROM tb_evento WHERE id_evento = :id_evento");

        $stmt->bindParam(":id_evento", $id_evento);

        $stmt->execute();

        // Mensagem de sucesso por remover filme
        $this->message->setMessage("Removido com sucesso!", "success", "list_evento.php");
    }


    public function findGeral($pesquisa_ativo)
    {

        $evento = [];

        $stmt = $this->conn->prepare("SELECT * FROM tb_evento
        WHERE ativo = :ativo ORDER BY id_evento asc");

        $stmt->bindValue(":ativo", $pesquisa_ativo);

        $stmt->execute();

        $evento = $stmt->fetchAll();
        return $evento;
    }

    # METODO DE SELECAO COM VARIAVEIS NO QUERY
    public function selectAllEvento($where = null, $order = null, $limit = null)
    {
        //DADOS DA QUERY
        $where = strlen($where) ? 'WHERE ' . $where : '';
        $order = strlen($order) ? 'ORDER BY ' . $order : '';
        $limit = strlen($limit) ? 'LIMIT ' . $limit : '';

        //MONTA A QUERY
        $query = $this->conn->query('SELECT * FROM tb_evento ' . $where . ' ' . $order . ' ' . $limit);

        $query->execute();

        $evento = $query->fetchAll();

        return $evento;
    }

    public function QtdEvento()
    {
        $evento = [];

        $stmt = $this->conn->query("SELECT COUNT(id_evento) FROM tb_evento");

        $stmt->execute();

        $QtdTotalEve = $stmt->fetch();

        return $QtdTotalEve;
    }
}

# Limita o número de registros a serem mostrados por página
$limite = 10;

# Se pg não existe atribui 1 a variável pg
$pg = (isset($_GET['pg'])) ? (int)$_GET['pg'] : 1;

# Atribui a variável inicio o inicio de onde os registros vão ser
# mostrados por página, exemplo 0 à 10, 11 à 20 e assim por diante
$inicio = ($pg * $limite) - $limite;
$pesquisa_hosp = "";
# seleciona o total de registros  
$sql_Total = 'SELECT id_evento FROM tb_evento';
