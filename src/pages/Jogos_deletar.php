<?php
require_once __DIR__ . '/../data/connection.php';
require_once __DIR__ . '/../model/Jogos.php';

// Validar o ID recebido
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo '<p style="color: red; text-align: center;">ID de jogo inválido.</p>';
    echo '<p style="text-align: center;"><a href="/">Voltar para a lista de jogos</a></p>';
    exit;
}

$id = (int) $_GET['id'];

// Criar instância da classe Jogos
$jogo = new Jogos($conn);

// Verificar se o jogo existe
$jogo_atual = $jogo->consultarPorId($id);
if (!$jogo_atual) {
    echo '<p style="color: red; text-align: center;">Jogo não encontrado.</p>';
    echo '<p style="text-align: center;"><a href="/">Voltar para a lista de jogos</a></p>';
    exit;
}

try {
    // Tentar deletar o jogo
    $resultado = $jogo->deletar($id);

    if ($resultado) {
        // Redirecionar para a página principal com flag de sucesso
        header('Location: /?deletar=true');
        exit;
    } else {
        // Se não deletou nenhum registro
        echo '<p style="color: red; text-align: center;">Erro ao deletar jogo. Tente novamente.</p>';
        echo '<p style="text-align: center;"><a href="/">Voltar para a lista de jogos</a></p>';
    }
} catch (Exception $e) {
    // Tratar erros do banco de dados
    error_log("Erro ao deletar jogo: " . $e->getMessage());
    echo '<p style="color: red; text-align: center;">Ocorreu um erro ao deletar o jogo.</p>';
    echo '<p style="text-align: center;"><a href="/">Voltar para a lista de jogos</a></p>';
}
