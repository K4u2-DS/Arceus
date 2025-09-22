# Organizador de Tarefas (PHP)

Repositório: https://github.com/ElitonCamargo/organizador_tarefas_php.git

Descrição
--------
Aplicação simples de gerenciamento de tarefas (CRUD) em PHP usando PDO + MySQL. Permite cadastrar, listar, buscar, editar e deletar tarefas através de interface web leve.

Funcionalidades
--------------
- Cadastrar nova tarefa ([pages/tarefas_cadastrar.php](pages/tarefas_cadastrar.php))
- Listar tarefas com busca por título/descrição ([pages/tarefas_listar.php](pages/tarefas_listar.php))
- Editar tarefa ([pages/tarefas_editar.php](pages/tarefas_editar.php))
- Deletar tarefa com confirmação ([pages/tarefas_deletar.php](pages/tarefas_deletar.php))
- Persistência com MySQL via PDO (classe [`Tarefas`](model/Tarefas.php) em [model/Tarefas.php](model/Tarefas.php))
  - Métodos principais: [`Tarefas::cadastrar`](model/Tarefas.php), [`Tarefas::consultarTodos`](model/Tarefas.php), [`Tarefas::consultarPorId`](model/Tarefas.php), [`Tarefas::editar`](model/Tarefas.php), [`Tarefas::deletar`](model/Tarefas.php)

Tecnologias
-----------
- PHP (recomendado 7.4+ / 8.x)
- MySQL ou MariaDB
- PDO (extensão do PHP)
- HTML/CSS (arquivo [css/estilo.css](css/estilo.css))
- Servidor web: Apache, Nginx ou servidor embutido do PHP

Estrutura principal do projeto
-----------------------------
- [index.php](index.php) — entrada da aplicação, roteamento simples por query string
- [css/estilo.css](css/estilo.css) — estilos
- [data/db_config.php](data/db_config.php) — configurações de conexão (DB_HOST, DB_USER, DB_PASS, DB_NAME)
- [data/connection.php](data/connection.php) — cria instância PDO
- [db_schema/cmd_sql.php](db_schema/cmd_sql.php) — script para criar BD/tabela e popular dados de exemplo
- [model/Tarefas.php](model/Tarefas.php) — classe de modelo/DAO
- pages/
  - [pages/tarefas_cadastrar.php](pages/tarefas_cadastrar.php)
  - [pages/tarefas_listar.php](pages/tarefas_listar.php)
  - [pages/tarefas_editar.php](pages/tarefas_editar.php)
  - [pages/tarefas_deletar.php](pages/tarefas_deletar.php)

Ambiente de desenvolvimento (pré-requisitos)
-------------------------------------------
- PHP 7.4+ (com PDO e pdo_mysql habilitados)
- MySQL ou MariaDB
- Git (para clonar o repositório)
- Opcional: Composer (não obrigatório para este projeto)

Instalação e execução
---------------------
1. Clone o repositório:
   ```sh
   git clone https://github.com/ElitonCamargo/organizador_tarefas_php.git
   cd organizador_tarefas_php
   ```
2. Configure o banco de dados:
   - Edite o arquivo [data/db_config.php](data/db_config.php) com suas credenciais do MySQL.
   - Execute o script [db_schema/cmd_sql.php](db_schema/cmd_sql.php) no seu terminal ou ferramenta de administração do banco de dados para criar o banco e a tabela de tarefas, além de inserir dados de exemplo.
3. Inicie o servidor web na pasta do projeto (ex: `php -S localhost:8000`).
4. Acesse a aplicação pelo navegador: `http://localhost:8000`.

Uso
---
- Acesse a página de listagem de tarefas para ver as tarefas cadastradas.
- Utilize a barra de busca para filtrar tarefas por título ou descrição.
- Clique em "Cadastrar nova tarefa" para adicionar uma nova tarefa.
- Para editar ou deletar uma tarefa, clique nos respectivos ícones na tabela de tarefas.

Contribuição
------------
Contribuições são bem-vindas! Sinta-se à vontade para abrir issues ou pull requests no repositório do GitHub.

Licença
-------
Este projeto está licenciado sob a Licença MIT. Veja o arquivo [LICENSE](LICENSE) para mais detalhes.