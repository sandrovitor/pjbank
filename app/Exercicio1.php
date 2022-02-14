<?php

class Exercicio1
{

    private $pdo;

    public function __construct() {
        $DB_CONNECTION = 'mysql';
        $DB_HOST = 'localhost';
        $DB_DATABASE = 'pjbank';
        $DB_USERNAME = 'root';
        $DB_PASSWORD = '';
        $dsn = $DB_CONNECTION.':host='.$DB_HOST.';dbname='.$DB_DATABASE;

        try {
            $this->pdo = new PDO($dsn, $DB_USERNAME, $DB_PASSWORD);
        } catch(PDOException $e) {
            print 'Erro no Banco de Dados.';
            die();
        }
        $this->pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    }

    /**
     * Insere novo valor no banco de dados.
     * @param array Objeto default do PHP, com os dados a serem inseridos.
     * 
     * @return string|true
     */
    public function setNovo(array $dados) {
        // Valida campos.
        foreach($dados as $k => $d) {
            $d = trim($d);
            if($d == '') {
                return 'Todos os campos devem ser preenchidos. Tente novamente.';
            }

            if($k == 'zipCode') {
                $valido = preg_match('/^\d{8}$/i', $d);
                if($valido === 0) {
                    return 'CEP informado inválido. Tente novamente.';
                }
            } else if($k == 'email') {
                $valido = preg_match('/[a-z0-9_-]+@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?/i', $d);
                if($valido === 0) {
                    return 'E-mail informado inválido. Tente novamente.';
                }
            } else if($k == 'password') {
                $valido = preg_match('/^(?=.*\d)(?=.*[a-zA-Z]).{8,}$/i', $d);
                if($valido === 0) {
                    return 'Senha informada inválida. Tente novamente.';
                }
            }

            // Devolve o valor já com um TRIM.
            $dados[$k] = $d;
        }


        $abc = $this->pdo->prepare("INSERT INTO exercicio1
        (id, nome, nome_usuario, cep, email, senha)
        VALUES
        (NULL, :nome, :nome_usuario, :cep, :email, :senha)");

        $abc->bindValue(':nome', $dados['name'], PDO::PARAM_STR);
        $abc->bindValue(':nome_usuario', $dados['userName'], PDO::PARAM_STR);
        $abc->bindValue(':cep', $dados['zipCode'], PDO::PARAM_STR);
        $abc->bindValue(':email', $dados['email'], PDO::PARAM_STR);
        $abc->bindValue(':senha', hash('sha256', $dados['password']), PDO::PARAM_STR);

        $abc->execute();
        return true;
    }

    /**
     * Retorna lista de valores inseridos na tabela.
     * 
     * @return array
     */
    public function getLista() {
        $abc = $this->pdo->query('SELECT
        id,
        nome,
        nome_usuario as userName,
        cep as zipCode,
        email,
        senha as password,
        dt_criacao
        FROM exercicio1');

        $reg = $abc->fetchAll(PDO::FETCH_OBJ);
        return $reg;
    }

    /**
     * Cria a tabela necessária para o exercício 1.
     */
    public function createDatabase() {
        echo "- Conexão ao banco de dados bem-sucedida.<br>\n";
        echo "- Criando tabelas.<br>\n";
        $this->pdo->query("CREATE TABLE IF NOT EXISTS exercicio1 (
            id SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT ,
            nome VARCHAR(120) NOT NULL ,
            nome_usuario VARCHAR(60) NOT NULL ,
            cep VARCHAR(8) NOT NULL ,
            email VARCHAR(120) NOT NULL ,
            senha VARCHAR(64) NOT NULL ,
            dt_criacao DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ,
            PRIMARY KEY (id))");


        echo "- Tabelas criadas.<br>\n";
        echo '<a href="./">< Voltar à tela anterior</a><br>';
        return true;
    }
}