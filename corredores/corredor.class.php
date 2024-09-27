<?php
class Corredor {
    public $id;
    public $nome;
    public $email;
    public $idade;
    public $tempo;
    public $senha;

    public function __construct($nome, $email, $idade, $tempo, $senha) {
        $this->nome = $nome;
        $this->email = $email;
        $this->idade = $idade;
        $this->tempo = $tempo;
        $this->senha = $senha;
    }

    public function salvar($pdo) {
        $sql = "INSERT INTO corredores (nome, email, idade, tempo, senha) VALUES (?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$this->nome, $this->email, $this->idade, $this->tempo, $this->senha]);
    }

    public static function todos($pdo) {
        $stmt = $pdo->query("SELECT * FROM corredores");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
