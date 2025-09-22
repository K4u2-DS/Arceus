<?php

require_once __DIR__ . '/../data/connection.php';
require_once __DIR__ . '/../model/Jogos.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = $_POST['titulo'] ?? '';
    $descricao = $_POST['descricao'] ?? '';
    $lancamento = $_POST['lancamento'] ?? '';
    $tipo = $_POST['tipo'] ?? '';
    $plataforma = $_POST['plataforma'] ?? '';

    $jogo = new Jogos($conn);
    $jogo->titulo = $titulo;
    $jogo->descricao = $descricao;
    $jogo->lancamento = $lancamento;
    $jogo->tipo = $tipo;
    $jogo->plataforma = $plataforma;
    $resultado = $jogo->cadastrar();
}
?>
<div class="form-container">
    <h1>Cadastrar Novo Jogo</h1>
    <form action="" method="post">
        <div class="form-group">
            <label for="titulo">Título:</label>
            <input type="text" id="titulo" name="titulo" required>
        </div>
        <div class="form-group">
            <label for="descricao">Descrição:</label>
            <textarea id="descricao" name="descricao" rows="4" required></textarea>
        </div>
        <div class="form-group">
            <label for="lancamento">Data de Lançamento:</label>
            <input type="date" id="lancamento" name="lancamento" required>
        </div>
        <div class="form-group">
            <label for="tipo">Tipo:</label>
            <input type="text" id="tipo" name="tipo" required>
        </div>
        <div class="form-group plataforma-group">
    <label>Plataforma:</label>
    <div class="radio-container">
        <label class="radio-label">
            <input type="radio" name="plataforma" value="switch1">
            <span>Switch 1</span>
        </label>
        <label class="radio-label">
            <input type="radio" name="plataforma" value="switch2">
            <span>Switch 2</span>
        </label>
        <label class="radio-label">
            <input type="radio" name="plataforma" value="ambos">
            <span>Ambos</span>
        </label>
    </div>
</div>


        <div class="form-group">
            <button type="submit">Cadastrar Jogo</button>
        </div>
        <?php
        if (isset($resultado)) {
            if ($resultado) {
                echo '<p style="color: green; text-align: center;">Jogo cadastrado com sucesso!</p>';
            } else {
                echo '<p style="color: red; text-align: center;">Erro ao cadastrar jogo. Tente novamente.</p>';
            }
        }
        ?>
    </form>
</div>