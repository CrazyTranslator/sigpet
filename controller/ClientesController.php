<?php
require_once '../model/cliente.php';
require_once 'Controller.php';

class ClientesController extends Controller
{
    /**
     * Lista os cliente
     */
    public function listar()
    {
        $clientes = Cliente::all();
        return $this->view('gradeClientes', ['clientes' => $clientes]);
    }
    public function RelCliente()
    {
        $clientes = Cliente::all();
        return $this->view('RelCliente', ['clientes' => $clientes]);
    }
    /**
     * Mostrar formulario para criar um novo cliente
     */
    public function criar()
    {
        return $this->view('formCliente');
    }
    /**
     * Mostrar formulário para editar um cliente
     */
    public function editar($dados)
    {
        $id      = (int) $dados['id'];
        $cliente = Cliente::find($id);
        return $this->view('formCliente', ['cliente' => $cliente]);
    }

    public function relatorio($dados)
    {
        $id      = (int) $dados['id'];
        $cliente = Cliente::find($id);
        $vendas = cliente::relatorio($id);
        return $this->view('RelformCliente', ['cliente' => $cliente, 'vendas' => $vendas]);
    }
    /**
     * Salvar o cliente submetido pelo formulário
     */
    public function salvar()
    {
        $cliente           = new Cliente;
        $cliente->NOME_CLIENTE     = $this->request->NOME_CLIENTE;
        $cliente->CPF_CLIENTE = $this->request->CPF_CLIENTE;
        $cliente->RG_CLIENTE    = $this->request->RG_CLIENTE;
        $cliente->DT_NASCIMENTO    = $this->request->DT_NASCIMENTO;
        $cliente->DT_CADASTRO    = $this->request->DT_CADASTRO;
        $cliente->TELEFONE    = $this->request->TELEFONE;
        $cliente->EMAIL    = $this->request->EMAIL;
        $cliente->TIPO_CLIENTE    = $this->request->TIPO_CLIENTE;
        $cliente->CNPJ_CLIENTE    = $this->request->CNPJ_CLIENTE;
        $cliente->REFERENCIA_CLIENTE    = $this->request->REFERENCIA_CLIENTE;
        $cliente->CELULAR    = $this->request->CELULAR;


        if ($cliente->save()) {
            return $this->listar();
        }
    }
    /**
     * Atualizar o cliente conforme dados submetidos
     */
    public function atualizar($dados)
    {
        $id                = (int) $dados['id'];
        $cliente           = Cliente::find($id);
        $cliente->NOME_CLIENTE     = $this->request->NOME_CLIENTE;
        $cliente->CPF_CLIENTE = $this->request->CPF_CLIENTE;
        $cliente->RG_CLIENTE    = $this->request->RG_CLIENTE;
        $cliente->DT_NASCIMENTO    = $this->request->DT_NASCIMENTO;
        $cliente->DT_CADASTRO    = $this->request->DT_CADASTRO;
        $cliente->TELEFONE    = $this->request->TELEFONE;
        $cliente->EMAIL    = $this->request->EMAIL;
        $cliente->TIPO_CLIENTE    = $this->request->TIPO_CLIENTE;
        $cliente->CNPJ_CLIENTE    = $this->request->CNPJ_CLIENTE;
        $cliente->REFERENCIA_CLIENTE    = $this->request->REFERENCIA_CLIENTE;
        $cliente->CELULAR    = $this->request->CELULAR;
        if ($cliente->save()) {
            return $this->listar();
        }
    }
    /**
     * Apagar um cliente conforme o id informado
     */
    public function excluir($dados)
    {
        $id      = (int) $dados['id'];
        $cliente = Cliente::destroy($id);
        return $this->listar();
    }
}
