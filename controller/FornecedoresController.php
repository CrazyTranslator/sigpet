<?php
require_once '../model/fornecedor.php';
require_once 'Controller.php';

class FornecedoresController extends Controller
{
    /**
     * Lista os cliente
     */
    public function listar()
    {
        $fornecedores = Fornecedor::all();
        return $this->view('gradeFornecedores', ['fornecedores' => $fornecedores]);
    }

    public function RelFor()
    {
        $fornecedores = Fornecedor::all();
        return $this->view('RelFornecedor', ['fornecedores' => $fornecedores]);
    }
    /**
     * Mostrar formulario para criar um novo cliente
     */
    public function criar()
    {
        return $this->view('formFornecedor');
    }
    /**
     * Mostrar formulário para editar um cliente
     */
    public function editar($dados)
    {
        $id      = (int) $dados['id'];
        $fornecedor = Fornecedor::find($id);
        return $this->view('formFornecedor', ['fornecedor' => $fornecedor]);
    }
    public function relatorio($dados)
    {
        $id      = (int) $dados['id'];
        $fornecedor = Fornecedor::find($id);
        return $this->view('RelformFornecedor', ['fornecedor' => $fornecedor]);
    }
    /**
     * Salvar o cliente submetido pelo formulário
     */
    public function salvar()
    {
        $fornecedor           = new Fornecedor;
        $fornecedor->NOME_FORNECEDOR     = $this->request->NOME_FORNECEDOR;
        $fornecedor->CNPJ_FORNECEDOR = $this->request->CNPJ_FORNECEDOR;
        $fornecedor->CPF_FORNECEDOR    = $this->request->CPF_FORNECEDOR;
        $fornecedor->INSCRICAOESTADUAL_FORNECEDOR    = $this->request->INSCRICAOESTADUAL_FORNECEDOR;
        $fornecedor->TIPO_FORNECEDOR    = $this->request->TIPO_FORNECEDOR;
        $fornecedor->NDERECO_FORNECEDOR_7    = $this->request->NDERECO_FORNECEDOR_7;
        $fornecedor->BAIRRO_FORNECEDOR    = $this->request->BAIRRO_FORNECEDOR;
        $fornecedor->CIDADE_FORNECEDOR    = $this->request->CIDADE_FORNECEDOR;
        $fornecedor->UF_FORNECEDOR    = $this->request->CEP_FORNECEDOR;
        $fornecedor->CEP_FORNECEDOR    = $this->request->CEP_FORNECEDOR;
        $fornecedor->EMAIL_FORNECEDOR    = $this->request->EMAIL_FORNECEDOR;
        $fornecedor->TELEFONE_FORNECEDOR    = $this->request->TELEFONE_FORNECEDOR;
        $fornecedor->CELULAR_FORNECEDOR    = $this->request->CELULAR_FORNECEDOR;

        if ($fornecedor->save()) {
            return $this->listar();
        }
    }
    /**
     * Atualizar o cliente conforme dados submetidos
     */
    public function atualizar($dados)
    {
        $id                = (int) $dados['id'];
        $fornecedor           = Fornecedor::find($id);
        $fornecedor->NOME_FORNECEDOR     = $this->request->NOME_FORNECEDOR;
        $fornecedor->CNPJ_FORNECEDOR = $this->request->CNPJ_FORNECEDOR;
        $fornecedor->CPF_FORNECEDOR    = $this->request->CPF_FORNECEDOR;
        $fornecedor->INSCRICAOESTADUAL_FORNECEDOR    = $this->request->INSCRICAOESTADUAL_FORNECEDOR;
        $fornecedor->TIPO_FORNECEDOR    = $this->request->TIPO_FORNECEDOR;
        $fornecedor->NDERECO_FORNECEDOR_7    = $this->request->NDERECO_FORNECEDOR_7;
        $fornecedor->BAIRRO_FORNECEDOR    = $this->request->BAIRRO_FORNECEDOR;
        $fornecedor->CIDADE_FORNECEDOR    = $this->request->CIDADE_FORNECEDOR;
        $fornecedor->UF_FORNECEDOR    = $this->request->CEP_FORNECEDOR;
        $fornecedor->CEP_FORNECEDOR    = $this->request->CEP_FORNECEDOR;
        $fornecedor->EMAIL_FORNECEDOR    = $this->request->EMAIL_FORNECEDOR;
        $fornecedor->TELEFONE_FORNECEDOR    = $this->request->TELEFONE_FORNECEDOR;
        $fornecedor->CELULAR_FORNECEDOR    = $this->request->CELULAR_FORNECEDOR;

        if ($fornecedor->save()) {
            return $this->listar();
        }
    }
    /**
     * Apagar um cliente conforme o id informado
     */
    public function excluir($dados)
    {
        $id      = (int) $dados['id'];
        $fornecedor = Fornecedor::destroy($id);
        return $this->listar();
    }
}
