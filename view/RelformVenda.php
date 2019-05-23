
<div class="container">
    <form action="?controller=VendasController&<?php echo isset($vendas[0]->ID) ? "method=atualizar&id={$vendas[0]->ID}" : "method=salvar"; ?>" method="post" >
        <div class="card" style="top:40px">
            <div class="card-header">
                <span class="card-title">Vendas</span>
            </div>
            <div class="card-body">
            </div>
			<input type="hidden" name="FOR_ID" id="FOR_ID" value="<?php echo isset($vendas[0]->ID) ? $vendas[0]->ID : null; ?>" />
            <div class="form-group form-row">
                <label class="col-sm-2 col-form-label text-right">Cliente:</label>
                <?php
                //var_dump($vendas->ID);
					if(isset($vendas)){
						$clienteSelected  = $vendas[0]->CLIENTE_ID;
					}
                    if (isset($clientes)){
						echo "<select id='cliente' name='cliente'>";
						  foreach($clientes as $cliente){
							if(isset($clienteSelected) && $clienteSelected == $cliente->id){
								echo "<option readonly value='".$cliente->id."'selected>".$cliente->NOME_CLIENTE."</option>";
							}else{
								echo "<option readonly value='".$cliente->id."'>".$cliente->NOME_CLIENTE."</option>";
							}
						  }
						echo "</select>";
                    }else{echo 'Clientes nao encontrados';}

                ?>
            </div>
            <div class="form-group form-row">
				<table id="carrinho" name="carrinho">
					<thead>
						<td></td>
						<td>Nome do Produto</td>
						<td>Quantidade</td>
						<td>Valor Un.</td>
						<td>Valor Total</td>
						<td>ID Produto</td>
					</thead>
				</table>
            </div>
            <div class="form-group form-row">
                <label class="col-sm-2 col-form-label text-right">Valor de compra:</label>
                <input type="text" readonly class="form-control col-sm-8" name="VALOR_COMPRA" id="VALOR_COMPRA" value=0 />
			<!--
            </div>
            <div class="form-group form-row">
                <label class="col-sm-2 col-form-label text-right">Valor de venda:</label>
                <input type="text" class="form-control col-sm-8" name="VALOR_VENDA" id="VALOR_VENDA" value="<?php
                //echo isset($produto->VALOR_VENDA) ? $produto->VALOR_VENDA : null;
                ?>" />
            </div>
            <div class="form-group form-row">
                <label class="col-sm-2 col-form-label text-right">Estoque:</label>
                <input type="text" class="form-control col-sm-8" name="ESTOQUE" id="ESTOQUE" value="<?php
                //echo isset($produto->ESTOQUE) ? $produto->ESTOQUE : null;
                ?>" />
            </div>
			-->
            <div class="form-group form-row">
            <div class="card-footer">
                    <input type="hidden" name="id" id="id" value="<?php echo isset($cliente->id) ? $cliente->id : null; ?>" />
                    <a class="btn btn-danger" href="?controller=VendasController&method=RelVenda">Voltar</a>
            </div>

        </div>
    </form>
</div>

<?php
	if(isset($vendas)){
			$varVenda = '';
		foreach($vendas as $venda){
			$varVenda .= $venda->ID.'/';					//0
			$varVenda .= $venda->CLIENTE_ID.'/';			//1
			$varVenda .= $venda->VALOR_VENDA_CAB.'/';		//2
			$varVenda .= $venda->PRODUTO_ID.'/';			//3
			$varVenda .= $venda->QTD_VENDA_DETA.'/';		//4
			$varVenda .= $venda->VLR_UNIT_VENDA_DETA.'/';	//5
			$varVenda .= $venda->NOME_CLIENTE.'/';			//6
			$varVenda .= $venda->DESCRICAO.'*';				//7
		}
		//var_dump($varVenda); exit;
	}
	?>


<script type="text/javascript">

select = document.getElementById('nmproduto');
selectqt = document.getElementById('qtproduto');
function atualizaEst() {
	selectqt.innerHTML = "";
	id = select.options[select.selectedIndex].value;
	//alert(id.toString());
	idEst = document.getElementById(id);
	//alert(idEst.innerHTML);
	est = idEst.innerHTML.split('/')[0];
	for(i=0;i<=est;i++){
		var opt = document.createElement('option');
		opt.value = i;
		opt.innerHTML = i;
		selectqt.appendChild(opt);
	}

}

var total = 0;
var id = <?php echo isset($vendas[0]->ID) ? $vendas[0]->ID : 'null'; ?>;
if(id != 'null'){
	incluirTabEdit();
}

function incluirTabEdit(){

	var teste = "<?php echo isset($vendas[0]->ID) ? $varVenda : 'null'; ?>";
	teste = teste.split('*');
	var count = teste.length;
	//alert(teste[0]);
	var table = document.getElementById('carrinho');


	for(i=0;i<count-1;i++){
		var tr = document.createElement('tr');

		var td = document.createElement('td'); //button
		var td1 = document.createElement('td'); //nome produto
		var td2 = document.createElement('td'); //quantidade produto
		var td3 = document.createElement('td'); //preço produto
		var td4 = document.createElement('td'); //preço total produto
		var td5 = document.createElement('td'); //id produto

		content = teste[i].split("/");

		td1.value = content[3];
		td1.innerHTML = "<input type='text' readonly name='prod[]' value="+content[7]+" >";

		td2.value = content[4];
		td2.innerHTML = "<input type='text' readonly name='prod[]' value="+content[4]+" >";

		td3.value = content[3];
		td3.innerHTML = "<input type='text' readonly name='prod[]' value="+content[5]+" >";

		td4.id = content[3];
		multprod = parseFloat(content[5])*parseFloat(content[4]);
		td4.innerHTML = "<input type='text' readonly name='prod[]' value="+multprod+" >";

		td5.value = content[3];
		td5.innerHTML = "<input type='text' readonly name='prod[]' value="+content[3]+">";

		// CREATE BUTTON
		var button = document.createElement('input');

		// SET INPUT ATTRIBUTE.
		button.setAttribute('type', 'button');
		button.setAttribute('display', 'none');

		// ADD THE BUTTON's 'onclick' EVENT.
		//button.setAttribute('onclick', 'removeRow(this)');

		td.appendChild(button);

		tr.appendChild(td);
		tr.appendChild(td1);
		tr.appendChild(td2);
		tr.appendChild(td3);
		tr.appendChild(td4);
		tr.appendChild(td5);

		table.appendChild(tr);
	}

	document.getElementById('VALOR_COMPRA').value = <?php echo isset($vendas[0]->ID) ? $vendas[0]->VALOR_VENDA_CAB : 0; ?>;
}

function incluirTab() {

	//vars do nome do produto
	var selproduto = document.getElementById("nmproduto");
	var vlprod = selproduto.options[selproduto.selectedIndex].value; //id
	var nmprod = selproduto.options[selproduto.selectedIndex].text;  //nome
	var spanprod = document.getElementById(vlprod);  //preço
	precoprod = spanprod.innerHTML.split('/')[1];
    //alert(precoprod);

	//vars do estoque do produto
	var selestoque = document.getElementById("qtproduto");
	var vlqt = selestoque.options[selestoque.selectedIndex].value;


	var table = document.getElementById('carrinho');

	var tr = document.createElement('tr');
	//tr.setAttribute('name',vlprod+"prodrow[]");

	var td = document.createElement('td'); //button
	var td1 = document.createElement('td'); //nome produto
	var td2 = document.createElement('td'); //quantidade produto
	var td3 = document.createElement('td'); //preço produto
	var td4 = document.createElement('td'); //preço total produto
	var td5 = document.createElement('td'); //id produto

	td1.value = vlprod;
	td1.innerHTML = "<input type='text' readonly name='prod[]' value="+nmprod+" >";

	td2.value = vlqt;
	td2.innerHTML = "<input type='text' readonly name='prod[]' value="+vlqt+" >";

	td3.value = vlprod;
	td3.innerHTML = "<input type='text' readonly name='prod[]' value="+precoprod+" >";

	td4.id = vlprod;
	multprod = parseFloat(precoprod)*parseFloat(vlqt);
	td4.innerHTML = "<input type='text' readonly name='prod[]' value="+multprod+" >";

	td5.value = vlprod;
	td5.innerHTML = "<input type='text' readonly name='prod[]' value="+vlprod+">";

	// CREATE BUTTON
	var button = document.createElement('input');

	// SET INPUT ATTRIBUTE.
	button.setAttribute('type', 'button');
	button.setAttribute('value', 'Remove');

	// ADD THE BUTTON's 'onclick' EVENT.
	button.setAttribute('onclick', 'removeRow(this)');

	td.appendChild(button);

	tr.appendChild(td);
	tr.appendChild(td1);
	tr.appendChild(td2);
	tr.appendChild(td3);
	tr.appendChild(td4);
	tr.appendChild(td5);

	table.appendChild(tr);

	total = parseFloat(document.getElementById('VALOR_COMPRA').value);
	total = total + multprod;

	document.getElementById('VALOR_COMPRA').value = total;

}

function removeRow(oButton) {
	var carrinho = document.getElementById('carrinho');
	vlrAtual = document.getElementById('VALOR_COMPRA').value;
	//alert(oButton.parentNode.parentNode.childNodes[4].children[0].value);
	total = parseFloat(vlrAtual) - parseFloat(oButton.parentNode.parentNode.childNodes[4].children[0].value);
	document.getElementById('VALOR_COMPRA').value = total;
	carrinho.deleteRow(oButton.parentNode.parentNode.rowIndex);       // BUTTON -> TD -> TR.
}


</script>
