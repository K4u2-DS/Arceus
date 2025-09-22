<title>Listar Jogos</title>
<link rel="stylesheet" href="estilo.css">

<div class="container">
    <h1>Listar Jogos</h1>
    <form action="" method="post" class="search-form">
        <input type="search" name="buscar" id="buscar" value="<?php echo htmlspecialchars($_POST['buscar'] ?? ''); ?>" placeholder="Buscar jogo...">
    </form>
    <table>
        <tr>
            <th>ID</th>
            <th>Título</th>
            <th>Descrição</th>
            <th>Data de lançamento</th>
            <th>Tipo</th>
            <th>Plataforma</th>
            <th>Criação</th>
            <th>Alteração</th>
            <th style="width: 160px; text-align: center;">Ação</th>
        </tr>
        <?php
        require_once __DIR__ . '/../data/connection.php';
        require_once __DIR__ . '/../model/Jogos.php';

        $jogos = new Jogos($conn);
        $lista = $jogos->consultarTodos(htmlspecialchars($_POST['buscar'] ?? ''));

        foreach ($lista as $item) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($item['id']) . "</td>";
            echo "<td>" . htmlspecialchars($item['titulo']) . "</td>";
            echo "<td>" . htmlspecialchars($item['descricao']) . "</td>";
            echo "<td>" . htmlspecialchars($item['lancamento']) . "</td>";
            echo "<td>" . htmlspecialchars($item['tipo']) . "</td>";
            echo "<td>" . htmlspecialchars($item['plataforma']) . "</td>";
            echo "<td>" . htmlspecialchars($item['createAt']) . "</td>";
            echo "<td>" . htmlspecialchars($item['updateAt']) . "</td>";
            echo "<td style='text-align: center;'>
                    <a href='?page=editar&id=" . $item['id'] . "' class='btn btn-edit'>Editar</a>
                    <a href='?page=deletar&id=" . $item['id'] . "' class='btn btn-delete' onclick=\"return confirm('Tem certeza que deseja deletar este jogo?');\">Deletar</a>
                </td>";
            echo "</tr>";
        }
        ?>
    </table>
</div>
