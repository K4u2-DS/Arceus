<?php
    require_once __DIR__ . '/../data/connection.php';
    require_once __DIR__ . '/../model/Jogos.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = $_POST['id'];
        $titulo = $_POST['titulo'] ?? '';
        $descricao = $_POST['descricao'] ?? '';
        $lancamento = $_POST['lancamento'] ?? '';
        $tipo = $_POST['tipo'] ?? '';
        $plataforma = $_POST['plataforma'] ?? '';

        $jogo = new Jogos($conn);
        $jogo->id = $id;
        $jogo->titulo = $titulo;
        $jogo->descricao = trim($descricao);
        $jogo->lancamento = $lancamento;
        $jogo->tipo = $tipo;
        $jogo->plataforma = $plataforma;
        $resultado = $jogo->editar();
    }

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
    
?>
    
    <div class="form-container">
        <h1>Cadastrar Novo Jogo</h1>
        <form action="" method="post">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($jogo_atual['id']); ?>">
            <div class="form-group">
                <label for="titulo">Título:</label>
                <input type="text" id="titulo" name="titulo" value="<?php echo htmlspecialchars($jogo_atual['titulo']) ?>" required>
            </div>
            <div class="form-group">
                <label for="descricao">Descrição:</label>
                <textarea id="descricao" name="descricao" rows="4" required><?php echo htmlspecialchars($jogo_atual['descricao']); ?></textarea>
            </div>
            <div class="form-group">
                <label for="lancamento">Data de Lançamento:</label>
                <input type="date" id="lancamento" name="lancamento" value="<?php echo htmlspecialchars($jogo_atual['lancamento']) ?>" required>
            </div>
            <div class="form-group">
                <label for="tipo">Tipo:</label>
                <input type="text" id="tipo" name="tipo" value="<?php echo htmlspecialchars($jogo_atual['tipo']) ?>" required>
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
                <button type="submit">Editar Jogo</button>
            </div>
            <?php
            if (isset($resultado)) {
                if ($resultado) {
                    echo '<p style="color: green; text-align: center;">Jogo alterado com sucesso!</p>';
                } else {
                    echo '<p style="color: red; text-align: center;">Erro ao alterar jogo. Tente novamente.</p>';
                }
            }  
            ?>
        </form>
    </div>
