<?php

// Necessário enviar a operação
if(!isset($_GET['op']) || $_GET['op'] == '') {
    header('Location: ./'); die;
}

require_once(__DIR__.'/app/Exercicio1.php');

$retorno = [];
switch($_GET['op']) {
    // INSERE DADOS DO FORM
    case 'ex1-insert':
        
        // Verifica se o POST tem conteúdo
        if(empty($_POST)) {
            header('Location: ./'); die;
        }


        $ex1 = new Exercicio1();
        $resultado = $ex1->setNovo($_POST);
        if(is_string($resultado)) {
            $retorno = ['success' => false, 'mensagem' => $resultado];
        } else {
            $retorno = ['success' => $resultado];
        }

        break;

    // RETORNA DADOS DO BANCO
    case 'ex1-select':
        $ex1 = new Exercicio1();
        $resultado = $ex1->getLista();
        $retorno = ['success' => true, 'dados' => $resultado];
        break;

    default:
        $retorno = ['success' => false, 'mensagem' => 'Operação inválida'];
        die;
    break;
}
echo json_encode($retorno);
die;