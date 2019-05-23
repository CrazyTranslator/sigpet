<?php
require_once '../model/venda.php';
require_once 'Controller.php';
class VendasController extends Controller
{
    /**
     * Lista vendas
     */
    public function listar()
    {
        $vendas = Venda::all();
        return $this->view('gradeVendas', ['vendas' => $vendas]);
    }

    public function RelVenda()
    {
        $vendas = Venda::all();
        return $this->view('RelVenda', ['vendas' => $vendas]);
    }
    /**
     * Mostrar formulario para criar uma nova venda
     */
    public function criar()
    {
        $clientes = Venda::findcliente();
        $produtos = Venda::findproduto();
        return $this->view2('formVenda',[['clientes' => $clientes],['produtos' => $produtos]]);
    }
    /**
     * Mostrar formulário para editar um cliente
     */
    public function editar($dados)
    {
        $id      = (int) $dados['id'];
        $vendas = Venda::find($id);
		$clientes = Venda::findcliente();
        $produtos = Venda::findproduto();
        return $this->view2('formVenda', [['vendas' => $vendas],['clientes' => $clientes],['produtos' => $produtos]]);
    }

    public function relatorio($dados)
    {
        $id      = (int) $dados['id'];
        $vendas = Venda::find($id);
		$clientes = Venda::findcliente();
        $produtos = Venda::findproduto();
        return $this->view2('RelformVenda', [['vendas' => $vendas],['clientes' => $clientes],['produtos' => $produtos]]);
    }
    /**
     * Salvar o cliente submetido pelo formulário
     */
    public function salvar()
    {
		$valorTotalVenda = 0;
        $vendas = new Venda;
		//dados que vão pro venda_cabs
        $vendas->ID     = $this->request->FOR_ID;
        $vendas->CLIENTE_ID     = $this->request->cliente;
		$vendas->VALOR_VENDA_CAB = $this->request->VALOR_COMPRA;

		//dados que vão pro venda_dets
		$dadosproduto = $this->request->prod;
		$dadosproduto = array_chunk($dadosproduto,5);
		$vendas->PRODUTO_ID = '';
		$vendas->VLR_UNIT_VENDA_DETA   = '';
		$vendas->VLR_TOTAL_VENDA_DETA   = '';
		$vendas->QTD_VENDA_DETA   = '';
		for($i=0;$i<count($dadosproduto);$i++){
			$vendas->PRODUTO_ID .= $dadosproduto[$i][4]."/";
			$vendas->VLR_UNIT_VENDA_DETA   .= $dadosproduto[$i][2]."/";
			$vendas->VLR_TOTAL_VENDA_DETA   .= $dadosproduto[$i][3]."/";
			$vendas->QTD_VENDA_DETA   .= $dadosproduto[$i][1]."/";
		}
		//var_dump($vendas); exit;
        if ($vendas->save()) {
            return $this->listar();
        }
    }
	/*
	object(VendasController)#2 (1) { ["request"]=> object(Request)#3 (1) { ["request":protected]=> array(8) { ["controller"]=> string(16) "VendasController" ["method"]=> string(6) "salvar"
	["FOR_ID"]=> string(0) ""
	["cliente"]=> string(2) "52"
	["prod"]=> array(10) { [0]=> string(8) "editado2" [1]=> string(1) "6" [2]=> string(6) "121212" [3]=> string(6) "727272" [4]=> string(2) "12" [5]=> string(4) "Bolo" [6]=> string(1) "1" [7]=> string(3) "159" [8]=> string(3) "159" [9]=> string(2) "22" }
	["VALOR_COMPRA"]=> string(6) "485166"
	["id"]=> string(2) "62" } } }
	*/
    /**
     * Atualizar o cliente conforme dados submetidos
     */
    public function atualizar($dados)
    {
        $id = (int) $dados['id'];
        //$vendas = Produto::find($id);
        $valorTotalVenda = 0;
        $vendas = new Venda;
		//dados que vão pro venda_cabs
        $vendas->ID     = $this->request->FOR_ID;
        $vendas->CLIENTE_ID     = $this->request->cliente;
		$vendas->VALOR_VENDA_CAB = $this->request->VALOR_COMPRA;

		//dados que vão pro venda_dets
		$dadosproduto = $this->request->prod;
		$dadosproduto = array_chunk($dadosproduto,5);
		$vendas->PRODUTO_ID = '';
		$vendas->VLR_UNIT_VENDA_DETA   = '';
		$vendas->VLR_TOTAL_VENDA_DETA   = '';
		$vendas->QTD_VENDA_DETA   = '';
		for($i=0;$i<count($dadosproduto);$i++){
			$vendas->PRODUTO_ID .= $dadosproduto[$i][4]."/";
			$vendas->VLR_UNIT_VENDA_DETA   .= $dadosproduto[$i][2]."/";
			$vendas->VLR_TOTAL_VENDA_DETA   .= $dadosproduto[$i][3]."/";
			$vendas->QTD_VENDA_DETA   .= $dadosproduto[$i][1]."/";
		}
		//var_dump($vendas); exit;
        if ($vendas->save()) {
            return $this->listar();
        }
    }
    /**
     * Apagar um cliente conforme o id informado
     */
    public function excluir($dados)
    {
        $id      = (int) $dados['id'];
        $vendas = venda::destroy($id);
        return $this->listar();
    }
}
