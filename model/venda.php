<?php
require_once '../config/conexao.php';


class Venda
{
    private $atributos;
    public function __construct()
    {
    }
    public function __set(string $atributo, $valor)
    {
        $this->atributos[$atributo] = $valor;
        return $this;
    }
    public function __get(string $atributo)
    {
        return $this->atributos[$atributo];
    }
    public function __isset($atributo)
    {
        return isset($this->atributos[$atributo]);
    }
    /**
     * Salvar o cliente
     * @return boolean
     */
    public function save()
    {
        $colunas = $this->preparar($this->atributos);
        if (!isset($this->ID)) {
            $query = "INSERT INTO venda_cabs (".
                implode(', ', array_keys($colunas)).
                ") VALUES (".
                implode(', ', array_values($colunas)).");";
        } else {
            foreach ($colunas as $key => $value) {
                if ($key !== 'ID') {
                    $definir[] = "{$key}={$value}";
                }
            }
            $query = "UPDATE venda_cabs SET ".implode(', ', $definir)." WHERE ID='{$this->ID}';";
        }
        if ($conexao = Conexao::getInstance()) {
            $stmt = $conexao->prepare($query);
            if ($stmt->execute()) {
                return $stmt->rowCount();
            }
        }
        return false;
    }
    /**
     * Tornar valores aceitos para sintaxe SQL
     * @param type $dados
     * @return string
     */
    private function escapar($dados)
    {
        if (is_string($dados) & !empty($dados)) {
            return "'".addslashes($dados)."'";
        } elseif (is_bool($dados)) {
            return $dados ? 'TRUE' : 'FALSE';
        } elseif ($dados !== '') {
            return $dados;
        } else {
            return 'NULL';
        }
    }
    /**
     * Verifica se dados são próprios para ser salvos
     * @param array $dados
     * @return array
     */
    private function preparar($dados)
    {
        $resultado = array();
        foreach ($dados as $k => $v) {
            if (is_scalar($v)) {
                $resultado[$k] = $this->escapar($v);
            }
        }
        return $resultado;
    }
    /**
     * Retorna uma lista de vendas
     * @return array/boolean
     */
    public static function all()
    {
        $conexao = Conexao::getInstance();
        $stmt    = $conexao->prepare("SELECT a.*,
        b.NOME_CLIENTE, c.DESCRICAO_PAGAMT FROM heroku_87bfe723a0b6070.venda_cabs as a
        LEFT JOIN heroku_87bfe723a0b6070.clientes as b ON a.CLIENTE_ID = b.id
        LEFT JOIN heroku_87bfe723a0b6070.tipo_pagamentos as c on a.TIPO_PAGAMENTO_ID = c.ID;");
        $result  = array();
        if ($stmt->execute()) {
            while ($rs = $stmt->fetchObject(Venda::class)) {
                $result[] = $rs;
            }
        }
        if (count($result) > 0) {
            return $result;
        }
        return false;
    }
    /**
     * Retornar o número de registros
     * @return int/boolean
     */
    public static function count()
    {
        $conexao = Conexao::getInstance();
        $count   = $conexao->exec("SELECT count(*) FROM venda_cabs;");
        if ($count) {
            return (int) $count;
        }
        return false;
    }
    /**
     * Encontra um recurso pelo id
     * @param type $id
     * @return type
     */
    public static function find($id)
    {
        $conexao = Conexao::getInstance();
        $stmt    = $conexao->prepare("SELECT * FROM venda_cabs WHERE id='{$id}';");
        if ($stmt->execute()) {
            if ($stmt->rowCount() > 0) {
                $resultado = $stmt->fetchObject('Venda');
                if ($resultado) {
                    return $resultado;
                }
            }
        }
        return false;
    }
    /** pegar lista de clientes */
    public static function findCliente()
    {
        $conexao = Conexao::getInstance();
        $stmt    = $conexao->prepare("SELECT * FROM clientes");
        if ($stmt->execute()) {
            while ($rs = $stmt->fetchObject(Venda::class)) {
                $result[] = $rs;
            }
        }
        if (count($result) > 0) {
            return $result;
        }
        return false;
    }
    /** pegar lista de produtos */
    public static function findProduto()
    {
        $conexao = Conexao::getInstance();
        $stmt    = $conexao->prepare("SELECT * FROM produtos");
        if ($stmt->execute()) {
            while ($rs = $stmt->fetchObject(Venda::class)) {
                $result[] = $rs;
            }
        }
        if (count($result) > 0) {
            return $result;
        }
        return false;
    }
    /**
     * Destruir um recurso
     * @param type $id
     * @return boolean
     */
    public static function destroy($id)
    {
        $conexao = Conexao::getInstance();
        if ($conexao->exec("DELETE FROM venda_cabs WHERE id='{$id}';")) {
            return true;
        }
        return false;
    }
}
