<?php
if (!class_exists('Banco')) {
    class Banco
    {
        public $linhas;
        public $array_dados;
        public $pdo;
        public $banco;

        public function __construct()
        {
            try {
                $host = 'localhost';
                $usuario = 'root';
                $senha = '';
                $bd = 'quest_usuario';

                $this->banco = $bd;
                $this->pdo = new PDO("mysql:host=" . $host . ";dbname=" . $bd, $usuario, $senha);
                $this->pdo->exec("set names utf8");
            } catch (PDOException $e) {
                echo "Erro, não foi possivel conectar ao banco de dados: " . $e->getMessage();
            }
        }

        public function query($sql)
        {
            $query = $this->pdo->query($sql);
            $this->linhas = $query->rowCount();
            $this->array_dados = $query->fetchAll();
        }

        public function linhas()
        {
            return $this->linhas;
        }

        public function resultado()
        {
            return $this->array_dados;
        }
    }
}
