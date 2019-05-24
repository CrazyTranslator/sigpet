<?php
require '../model/RCGV.php';
?>
<div id="container">
  <div id="section">
    <div class="container"> <img src="../images/other/subheader_pic.jpg" alt="" />
      <div class="content">
        <h2>Relatório Comparativo de Vendas <strong>Gráfico</strong></h2>
        <div align="center">
		<form name="busca" href="." method="GET">
          <table width="778" border="0" align="center" cellspacing="30">
            <tr>
              <th scope="col">DATA INICIAL:
                <input type="text" name="DATAINI" size="10" /></th>
              <th scope="col">DATA FINAL:
                <input type="text" name="DATAFIN" size="10" />
              </th>
    <th scope="col">VENDEDOR:<select name="VENDEDOR">
		<option value='' selected>Selecione um funcionário</option>
    <?php foreach($nomefunc as $func)
                                {
                                        echo "<option value=$func[id]>$func[NOME_FUNCIONARIO]</option>";
                                }
	?>
</select></th>
    <th scope="col">CLIENTE: <select name="CLIENTE">
		<option value='' selected>Selecione um cliente</option>
    <?php foreach($nomecliente as $cliente)
                                {
                                        echo "<option value=$cliente[id]>$cliente[NOME_CLIENTE]</option>";
                                }
	?>
</select></th>

<!--BOTAO BUSCAR-->
<input type="submit" name="buscar" value="Buscar" />


            </tr>
          </table>
</form>
        </div>
        <p>
        </p>
      </div>
    </div>
  </div>
</div>
<!-- //#sub-header -->

<div id="content" class="clearfix">
  <div class="container">
    <div class="column wide">
      <h2>Tabela Vendas</h2>
      <table border=1>
	  
		<thead>
			<tr >
				<th colspan="13">Vendas</th>
			</tr>
		</thead>
		
		<tbody>
		<?php
		
		if(count($vendas) == 0){
			echo "<tr><td colspan=13 align='center'>Nenhum dado encontrado</td></tr>";
		}
		
		?>
			<tr>
				<td>
				</td>
				<?php 	
					for($i=0;$i<12;$i++){
						echo "<td>$mes[$i]</td>";
					} 
				?>
			</tr>
			<?php
			
			for($i=0;$i<=$ano;$i++){
				echo "<tr>";
					$tabAno = $primeiroAno + $i;
					echo "<td>$tabAno</td>" ;
					for($j=1;$j<=12;$j++){
						$valVenda = 0;
						foreach($vendas as $venda){
							if($venda['MONTH(DATA_VENDA_CAB)'] == $j && $venda['YEAR(DATA_VENDA_CAB)'] == $tabAno){
								$valVenda = $venda['SUM(VALOR_VENDA_CAB)'];
								break;
							}
						}
						echo "<td>$valVenda</td>";
					}
				echo "</tr>";

			}
			?>

		</tbody>
		
	  </table>
    </div>
    <!-- //.column -->
    <div class="column mid">
      <h2></h2>
      <div class="box">
  <head>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<script type="text/javascript">

var javascript_array = Array();
<?php 
	if(count($vendas) != 0){
		$js_array = json_encode($vendas);
		echo "javascript_array = ". $js_array . ";\n";
		echo "var ano = ". $ano . ";\n";
		echo "var pano = ". $primeiroAno . ";\n";
		echo "var mes = ". json_encode($mes) . ";\n";
	}
?>

if(javascript_array.length !== 0){
var mainArray = Array();
var arrCabeca  = Array();
arrCabeca.push("Mês");
for(i=0;i<=ano;i++){
		arrCabeca.push("'"+(parseInt(pano)+i)+"'");
}

mainArray.push(arrCabeca);

for(j=1;j<=12;j++){
	var valArr = Array();
	valArr.push(mes[j-1]);
	for(i=0;i<=ano;i++){
		value = 0;
		for(var n in javascript_array){
			 var arrV = Object.values(javascript_array[n]);
			 if(parseInt(arrV[0]) == parseInt(pano)+i && parseInt(arrV[1]) == j){
				 value = arrV[2];
				 break;
			 }
		}
		valArr.push(parseInt(value));
	}
	mainArray.push(valArr);
}

//console.log(mainArray);


  google.charts.load('current', {'packages':['bar']});
  google.charts.setOnLoadCallback(drawChart);
}
  
  function drawChart() {
	var data = google.visualization.arrayToDataTable(mainArray);

	/*
	
	['Mês','2017','2018','2019'],
	['Janeiro',12000,6000,0],
	['Fevereiro',2000,0,0],
	['Março',0,0,0],
	['Abril',0,2000,0],
	['Maio',0,0,14138742],
	['Junho',2000,0,0],
	['Julho',0,0,0],
	['Agosto',0,0,0],
	['Setembro',0,2000,0],
	['Outubro',0,0,6939],
	['Novembro',0,0,20],
	['Dezembro',0,0,16191]
	
	*/
	var options = {
		width: 900,
		height: 600,
		chart: {
			title: 'Gráfico de Vendas'
		},
		vAxis: {
			title: 'Valor em Reais',
			scaleType: 'mirrorLog',
			ticks: [0, 10000, 1000000, 10000000, 20000000]
		}
	};

	var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

	chart.draw(data, google.charts.Bar.convertOptions(options));
  }
</script>

    <div id="columnchart_material" style="width: 800px; height: 500px;"></div>

      </div>
      <ul id="bottom-opt">
    <li><a onclick="myFunction()"><span>Imprimir</span></a></li>
    <li><a onclick="myFunction()"><span>Salvar PDF</span></a></li>
    <li><a href="../index.html"><span>Fechar</span></a></li>
    </ul>
      </div>
    </div>
    <!-- //.column -->

    <!-- //.column -->
  </div>

