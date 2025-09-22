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
            if (isset($_GET['page']) && $_GET['page'] === 'cadastrar') {
                require_once __DIR__ . '/pages/Jogos_cadastrar.php';
            } 
            elseif (isset($_GET['page']) && $_GET['page'] === 'editar') {
                require_once __DIR__ . '/pages/Jogos_editar.php';
            }
            elseif (isset($_GET['page']) && $_GET['page'] === 'deletar') {
                require_once __DIR__ . '/pages/Jogos_deletar.php';
            }
            else {
                require_once __DIR__ . '/pages/jogos_listar.php';
                if(isset($_GET['deleted']) && $_GET['deleted'] === 'true') {
                    echo '<script> alert("Jogo deletado com sucesso."); limparParametrosURL();</script>';
                }
            }
        ?>
    </div>


   
</body>
</html>
