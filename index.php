<html>
    <head>
        <title>Teste do PJBANK (Superlógica)</title>
        <!-- CSS only -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <!-- JavaScript Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
        <!-- jQuery -->
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
        <script src="./index.js"></script>
    </head>

    <body class="pt-3">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <a href="./createDatabase.php" class="btn btn-sm btn-primary px-3">Criar tabelas</a>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header py-1">
                            <h5>Exercício 1</h5>
                        </div>
                        <div class="card-body">
                            <form method="post">
                                <div class="form-group">
                                    <label for="name">Nome completo</label>
                                    <input type="text" id="name" name="name" class="form-control form-control-sm">
                                </div>
                                <div class="form-group">
                                    <label for="userName">Nome de login</label>
                                    <input type="text" id="userName" name="userName" class="form-control form-control-sm">
                                </div>
                                <div class="form-group">
                                    <label for="zipCode">CEP</label>
                                    <input type="text" id="zipCode" name="zipCode" data-tipo="cep" class="form-control form-control-sm"
                                placeholder="Somente números" maxlength="8">
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="text" id="email" name="email" data-tipo="email" class="form-control form-control-sm">
                                </div>
                                <div class="form-group">
                                    <label for="password">Senha (8 caracteres mínimo, contendo pelo menos 1 letra
                                    e 1 número)</label>
                                    <input type="password" id="password" name="password" class="form-control form-control-sm">
                                </div>
                                <input type="submit" value="Cadastrar" class="mt-3 btn btn-success" id="submitEx1">
                                <button type="button" class="mt-3 btn btn-info" id="ex1_btn_refresh">Atualizar lista</button>
                            </form>
                            <hr>
                            <table class="table table-sm table-bordered" id="ex1-table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>NOME</th>
                                        <th>USERNAME</th>
                                        <th>CEP</th>
                                        <th>EMAIL</th>
                                        <th>SENHA</th>
                                        <th>DATA_CRIACAO</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    

                </div>
            </div>
<br>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header py-1">
                            <h5>Exercício 2</h5>
                        </div>
                        <div class="card-body">
                            Veja o código fonte! :)<br><br>
                            <?php
                                //1) Crie um array
                                $arr1 = [];

                                //2) Popule este array com 7 números
                                for($i = 0; $i < 7; $i++) {
                                    $arr1[$i] = rand(1, 30);
                                }
                                echo "ARRAY: ";
                                var_export($arr1);
                                echo "<br><br>\n\n";

                                //3) Imprima o número da terceira posição do array
                                echo "Terceira posição: ".$arr1[2]."<br>\n";

                                //4) Crie uma variável com todos os itens do array no formato de string separado por vírgula
                                $string1 = implode(',', $arr1);

                                //5) Crie um novo array a partir da variável no formato de string que foi criada e destrua o array anterior
                                $arr2 = explode(',', $string1);
                                unset($arr1);

                                //6) Crie uma condição para verificar se existe o valor 14 no array
                                if(array_search('14', $arr2) !== false) {
                                    echo "Legal! Encontrei o valor 14 no array. Posição: ".array_search('14', $arr2);
                                    echo "<br>\n";
                                } else {
                                    echo "Não encontrei o valor 14 no array.<br>\n";
                                }

                                //7) Faça uma busca em cada posição. Se o número da posição atual for menor que o
                                //da posição anterior (valor anterior que não foi excluído do array ainda), exclua esta
                                //posição
                                for ($i = 1; $i < count($arr2); $i++) {
                                    if($arr2[$i] < $arr2[$i-1]) {
                                        // Exclui posição atual
                                        unset($arr2[$i]);

                                        // Volta o ponteiro uma casa.
                                        $i--;

                                        // Reordena o array para a condição acima funcionar.
                                        $arr2 = array_merge([], $arr2);

                                    }
                                }

                                //8) Remova a última posição deste array
                                array_pop($arr2);

                                //9) Conte quantos elementos tem neste array
                                echo "Total de itens no array: ". count($arr2). "<br>\n";

                                //10) Inverta as posições deste array
                                $arr3 = array_reverse($arr2);
                                echo "Array invertido:<br>";
                                var_export($arr3);
                                echo "<br>\n";
                               
                            ?>
                        </div>
                    </div>
                </div>
            </div>
<br>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header py-1">
                            <h5>Exercício 3</h5>
                        </div>
                        <div class="card-body">
                            DDL + DML:
                            <pre style="background-color: #ddd; padding: .5rem;">
    /* Exclui a tabela se ela existir. */
    DROP TABLE IF EXISTS USUARIO;
    DROP TABLE IF EXISTS INFO;

    /* Cria as tabelas e as popula. */
    CREATE TABLE USUARIO (
        id SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
        cpf VARCHAR(11) NOT NULL,
        nome VARCHAR(30) NOT NULL,
        PRIMARY KEY (id),
        CONSTRAINT UK_USUARIO UNIQUE (CPF)
    );
    CREATE TABLE INFO (
        id SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
        cpf VARCHAR(11) NOT NULL,
        genero CHAR(1) NOT NULL,
        ano_nascimento YEAR NOT NULL,
        PRIMARY KEY (id),
        CONSTRAINT UK_INFO UNIQUE (CPF)
    );

    INSERT INTO USUARIO (id, cpf, nome)
    VALUES
    (null, '16798125050', 'Luke Skywalker'),
    (null, '59875804045', 'Bruce Wayne'),
    (null, '04707649025', 'Diane Prince'),
    (null, '21142450040', 'Bruce Banner'),
    (null, '83257946074', 'Harley Quinn'),
    (null, '07583509025', 'Peter Parker');

    INSERT INTO INFO (id, cpf, genero, ano_nascimento)
    VALUES
    (null, '16798125050', 'M', 1976),
    (null, '59875804045', 'M', 1960),
    (null, '04707649025', 'F', 1988),
    (null, '21142450040', 'M', 1954),
    (null, '83257946074', 'F', 1970),
    (null, '07583509025', 'M', 1972);

    /* Extrai conteúdo igual a tabela exemplo do exercício. */
    SELECT
        CONCAT (U.nome, ' - ', I.genero) as usuario,
        CASE
            WHEN (YEAR(NOW()) - I.ano_nascimento) > 50 THEN 'SIM'
            ELSE 'NÃO'
        END AS MAIOR_50_ANOS
    FROM USUARIO U
    INNER JOIN INFO I ON (U.CPF = I.CPF)
    WHERE genero = 'M'
    ORDER BY U.cpf ASC
    LIMIT 0, 3;
                            </pre>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-12 mb-2" style="text-align:right">
                    sandro_vitor@hotmail.com<br>
                    &copy; Sandro Vitor 2022.
                </div>
            </div>
        </div>
    </body>
</html>