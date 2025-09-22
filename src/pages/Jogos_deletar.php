<?php
    require_once __DIR__ . '/../data/connection.php';
    require_once __DIR__ . '/../model/Jogos.php';

    if(!isset($_GET['id']) || !is_numeric($_GET['id'])) {
        echo '<p style="color: red; text-align: center;">ID de jogo inválido.</p>';
        echo '<p style="text-align: center;"><a href="/">Voltar para a lista de jogos</a></p>';
        exit;
    } 

    $id = $_GET['id'];

    $jogo = new Jogos($conn);
    $jogo_atual = $jogo->consultarPorId($id);

    if (!$jogo_atual) {
        echo '<p style="color: red; text-align: center;">Jogo não encontrado.</p>';
        echo '<p style="text-align: center;"><a href="/">Voltar para a lista de jogos</a></p>';
        exit;
    }

    $resultado = $jogo->deletar($id);

    if ($resultado) {               
        header('Location: /?deleted=true');
    } else {
        echo '<p style="color: red; text-align: center;">Erro ao deletar jogo. Tente novamente.</p>';
        echo '<p style="text-align: center;"><a href="/">Voltar para a lista de jogos</a></p>';
    }
