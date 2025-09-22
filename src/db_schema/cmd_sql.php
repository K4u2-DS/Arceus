<?php
require_once __DIR__ .'/../data/db_config.php';

$deleteDB = 'DROP DATABASE IF EXISTS '.DB_Prova.';';
$criarDB = 'CREATE DATABASE IF NOT EXISTS '.DB_Prova.';';
$usarDB = 'USE '.DB_Prova.';';

$crearTabela = "
    CREATE TABLE IF NOT EXISTS jogos (
        id INT AUTO_INCREMENT PRIMARY KEY,
        titulo VARCHAR(255) NOT NULL,
        descricao TEXT,
        lancamento DATE,
        tipo VARCHAR(100),
        `plataforma` ENUM('switch1', 'switch2', 'ambos') DEFAULT 'ambos',
        createAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updateAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    );
";

$insertDados = "
  INSERT INTO Jogos (titulo, descricao, lancamento, tipo, `plataforma`) VALUES
    ('The Legend of Zelda: Tears of the Kingdom', 'Continuação épica de Breath of the Wild.', '2023-05-12', 'Aventura', 'ambos'),
    ('Super Mario Odyssey', 'Mario em uma jornada por vários mundos usando seu chapéu mágico.', '2017-10-27', 'Plataforma', 'ambos'),
    ('Animal Crossing: New Horizons', 'Simulador de vida em uma ilha paradisíaca.', '2020-03-20', 'Simulação', 'ambos'),
    ('Metroid Dread', 'Samus enfrenta novos perigos em um planeta desconhecido.', '2021-10-08', 'Ação', 'switch2'),
    ('Fire Emblem: Three Houses', 'Jogo de estratégia e RPG com escolhas impactantes.', '2019-07-26', 'Estratégia', 'switch1'),
    ('Splatoon 3', 'Combates de tinta em equipe com novos modos de jogo.', '2022-09-09', 'Multiplayer', 'switch2'),
    ('Xenoblade Chronicles 3', 'Uma jornada épica em um mundo vasto e rico.', '2022-07-29', 'RPG', 'ambos'),
    ('Luigi’s Mansion 3', 'Luigi explora um hotel mal-assombrado para resgatar seus amigos.', '2019-10-31', 'Aventura', 'switch1'),
    ('Mario Kart 8 Deluxe', 'Corridas malucas com personagens da Nintendo.', '2017-04-28', 'Corrida', 'ambos'),
    ('Bayonetta 3', 'Combate intenso com a bruxa Bayonetta em sua nova aventura.', '2022-10-28', 'Hack and Slash', 'switch2'),
    ('Pokémon Scarlet', 'Explore novas regiões e capture novos Pokémon.', '2022-11-18', 'RPG', 'switch2'),
    ('Kirby and the Forgotten Land', 'Kirby em uma aventura 3D em um mundo misterioso.', '2022-03-25', 'Plataforma', 'switch2'),
    ('Mario Party Superstars', 'Minijogos divertidos para jogar com amigos.', '2021-10-29', 'Party', 'ambos'),
    ('Donkey Kong Country: Tropical Freeze', 'Ação e plataforma com Donkey Kong e sua turma.', '2018-05-04', 'Plataforma', 'switch2'),
    ('The Legend of Zelda: Breath of the Wild', 'Aventuras em um mundo aberto incrível.', '2017-03-03', 'Aventura', 'ambos'),
    ('Pikmin 4', 'Comande pequenos seres em desafios estratégicos.', '2023-07-21', 'Estratégia', 'switch2'),
    ('Monster Hunter Rise', 'Caça a monstros em combates épicos.', '2021-03-26', 'Ação', 'switch2'),
    ('Mario Tennis Aces', 'Partidas de tênis divertidas com personagens da Nintendo.', '2018-06-22', 'Esporte', 'switch2'),
    ('Fire Emblem Warriors: Three Hopes', 'Combate tático em estilo musou.', '2022-06-24', 'Estratégia', 'switch2'),
    ('Metroid Prime Remastered', 'Remasterização do clássico Metroid Prime.', '2023-02-08', 'Ação', 'switch2');
";

try {
    // Conexão inicial sem banco de dados
    $pdo = new PDO(
        dsn: 'mysql:host='.DB_HOST, 
        username: DB_USER, 
        password: DB_PASS
    );

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Deletar banco de dados se existir
    $pdo->exec(statement: $deleteDB);

    // Criar banco de dados
    $pdo->exec(statement: $criarDB);
    // Selecionar banco de dados
    $pdo->exec(statement: $usarDB);

    // Criar tabela
    $pdo->exec($crearTabela);

    // Inserir dados   
    $pdo->exec(statement: $insertDados);

    echo "Banco de dados, tabela e dados criados com sucesso!";
} catch (PDOException $e) {
    die("Erro: " . $e->getMessage());
}
