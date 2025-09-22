<?php
// Inicia output buffering para permitir redirecionamentos via header()
ob_start();
require_once __DIR__ . '/data/connection.php';
require_once __DIR__ . '/model/Jogos.php';

// Tratar exclusão antes de enviar qualquer HTML
if (isset($_GET['page']) && $_GET['page'] === 'deletar') {
    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        $jogo = new Jogos($conn);
        try {
            $resultado = $jogo->deletar((int)$_GET['id']);
            if ($resultado) {
                header('Location: /?deleted=true');
                exit;
            } else {
                header('Location: /?deleted=false');
                exit;
            }
        } catch (Exception $e) {
            error_log("Erro ao deletar jogo: " . $e->getMessage());
            header('Location: /?deleted=false');
            exit;
        }
    } else {
        header('Location: /?deleted=false');
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">    
    <link rel="stylesheet" href="css/estilo.css">
    <script>
        function limparParametrosURL() {
            if (window.location.search) {
                window.history.replaceState({}, document.title, window.location.pathname);
            }
        }
    </script>
</head>
<body>
    <nav style="width: 100%; justify-content: center; background: #4b494aff; padding: 10px 0; box-sizing: border-box; display: flex; gap: 20px;">
        <a href="?page=cadastrar" style="text-decoration: none; color: #0ddbffff; font-weight: bold;">Cadastrar novo jogo</a>
        <a href="?page=listar" style="text-decoration: none; color: #ff0404ff; font-weight: bold;">Listar jogos</a>
    </nav>

    <div id="container" style="height: calc(98vh - 50px); overflow-y: auto; padding: 20px; box-sizing: border-box;">
        <?php
            // Incluir páginas de acordo com o parâmetro 'page'
            $page = $_GET['page'] ?? 'listar';

            if ($page === 'cadastrar') {
                require_once __DIR__ . '/pages/Jogos_cadastrar.php';
            } elseif ($page === 'editar') {
                require_once __DIR__ . '/pages/Jogos_editar.php';
            } else {
                // Listar como padrão
                require_once __DIR__ . '/pages/Jogos_listar.php';
            }

            // Mostrar alertas de deleção
            if (isset($_GET['deleted'])) {
                if ($_GET['deleted'] === 'true') {
                    echo '<script>alert("Jogo deletado com sucesso."); limparParametrosURL();</script>';
                } elseif ($_GET['deleted'] === 'false') {
                    echo '<script>alert("Erro ao deletar jogo."); limparParametrosURL();</script>';
                }
            }
        ?>
    </div>
</body>
</html>
<?php
// Envia todo o buffer de saída
ob_end_flush();
?>
