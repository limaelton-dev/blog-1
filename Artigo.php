<?php

require_once 'config.php';

class Artigo 
{
    private $mysql;

    public function __construct(mysqli $mysql)
    {
        $this->mysql = $mysql;
    }
    public function exibeTodos(): array 
    {

        $resultado = $this->mysql->query('SELECT id, titulo, conteudo FROM artigos');
        $artigos = $resultado->fetch_all(MYSQLI_ASSOC);
        
        return $artigos;
    }
}
?>