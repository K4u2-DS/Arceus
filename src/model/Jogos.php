<?php
class Jogos
{
    // Atributos correspondentes à tabela de jogos
    public $id;
    public $titulo;
    public $descricao;
    public $lancamento;
    public $tipo;
    public $plataforma;
    
    private $conn;

    public function __construct(PDO $conn)
    {
        $this->conn = $conn;
    }

    // Método para cadastrar um novo jogo
    public function cadastrar(): bool
    {
        try {
            $sql = "INSERT INTO jogos (`titulo`, `descricao`, `lancamento`, `tipo`, `plataforma`) VALUES (?, ?, ?, ?, ?)";
            $dados = [
                $this->titulo,
                $this->descricao,
                $this->lancamento,
                $this->tipo,
                $this->plataforma,
            ];
            $stmt = $this->conn->prepare($sql);
            $stmt->execute($dados);
            return ($stmt->rowCount() > 0); 
        } catch (PDOException $e) {
            // Tratar erro de banco de dados
            error_log("Erro ao cadastrar jogo: " . $e->getMessage());
            throw new Exception(message: "Erro ao cadastrar jogo: " . $e->getMessage());
        }
    }

    // Método para consultar todos os jogos, com busca opcional
    public function consultarTodos($search = '')
    {
        try {            
            if ($search) {
                $sql = "SELECT * FROM jogos WHERE titulo LIKE ? OR descricao LIKE ?";
                $search = trim(string: $search);
                $search = "%{$search}%";
                $stmt = $this->conn->prepare($sql);
                $stmt->execute([$search, $search]);
            } else {
                $sql = "SELECT * FROM jogos";
                $stmt = $this->conn->query($sql);
            }
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Tratar erro de banco de dados
            error_log("Erro ao consultar jogo: " . $e->getMessage());
            throw new Exception(message: "Erro ao consultar jogo: " . $e->getMessage());
        }
    }

    // Método para consultar jogo por ID
    public function consultarPorId($id)
    {
        try {
            $sql = "SELECT * FROM jogos WHERE id = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Tratar erro de banco de dados
            error_log("Erro ao consultar jogo por ID: " . $e->getMessage());
            throw new Exception(message: "Erro ao consultar jogo por ID: " . $e->getMessage());
        }
    }

    // Método para alterar um jogo existente
    public function editar()
    {
        try {
            $sql = "UPDATE jogos SET titulo = ?, descricao = ?, lancamento = ?, tipo = ?, plataforma = ? WHERE id = ?";
            $dados = [
                $this->titulo,
                $this->descricao,
                $this->lancamento,
                $this->tipo,
                $this->plataforma,
                $this->id
            ];
            $stmt = $this->conn->prepare($sql);
            $stmt->execute($dados);
            return ($stmt->rowCount() > 0); 
        } catch (PDOException $e) {
            // Tratar erro de banco de dados
            error_log("Erro ao alterar jogo: " . $e->getMessage());
            throw new Exception(message: "Erro ao alterar jogo: " . $e->getMessage());
        }
    }

    // Método para deletar um jogo
    public function deletar($id): bool
    {
        try {
            $sql = "DELETE FROM jogos WHERE id = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$id]);
            return ($stmt->rowCount() > 0); 
        } catch (PDOException $e) {
            // Tratar erro de banco de dados
            error_log("Erro ao deletar jogo: " . $e->getMessage());
            throw new Exception(message: "Erro ao deletar jogo: " . $e->getMessage());
        }
    }
}