<?php

class Artigo 
{
    private $mysql;

    public function __construct(mysqli $mysql)
    {
        $this->mysql = $mysql;
    }

    public function adicionar(string $titulo, string $conteudo): void
    {
        $insereArtigo = $this->mysql->prepare('INSERT INTO artigos (titulo, conteudo) VALUES(?,?);');
            #recebi um objeto do tipo MySQLi_SMT, então chamamos o bind_param(), para vincular o valor recebido, com o valor que queremos usar
        $insereArtigo->bind_param('ss', $titulo, $conteudo); //ss pq recebe 2 "?"
        $insereArtigo->execute();
    }
    
    public function remover(string $id): void
    {
        $removerArtigo = $this->mysql->prepare('DELETE FROM artigos WHERE id = ?');
        $removerArtigo->bind_param('s', $id);
        $removerArtigo->execute();
    }

    public function editar(string $id, string $titulo, string $conteudo):void
    {
        $editarArt = $this->mysql->prepare('UPDATE artigos SET titulo = ?, conteudo = ? WHERE id = ?');
        $editarArt->bind_param('sss', $titulo, $conteudo, $id);
        $editarArt->execute();
    }

    public function exibeTodos(): array 
    {

        $resultado = $this->mysql->query('SELECT id, titulo, conteudo FROM artigos'); 
        $artigos = $resultado->fetch_all(MYSQLI_ASSOC);
        
        return $artigos;
    }

    public function encontrarPorId(string $id): array
    {
        $selecionaArtigo = $this->mysql->prepare("SELECT id, titulo, conteudo FROM artigos WHERE id = ?");
        $selecionaArtigo->bind_param('s', $id);
        $selecionaArtigo->execute();
        $artigo = $selecionaArtigo->get_result()->fetch_assoc();
        
        return $artigo;
    }

    

}
?>