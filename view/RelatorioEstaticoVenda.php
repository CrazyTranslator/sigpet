<?php
include_once "index.php";
  $con = mysqli_connect('us-cdbr-iron-east-03.cleardb.net','b91118ec66dcf8','8ed6f6be','heroku_87bfe723a0b6070');
  if(!$con){
    die("Conection failed:" .mysqli_connect_error());
  }
  if(isset($_POST['executar']))
  {
    $DataInicio=$_POST['DataInicio'];
    $DataFim=$_POST['DataFim'];
    $DataInicio2=$_POST['DataInicio2'];
    $DataFim2=$_POST['DataFim2'];
    $projecao1=$_POST['projecao1'];
    $projecao2=$_POST['projecao2'];
    $set1 = mysqli_query ($con, "SET @rank1=0");
    $set2 = mysqli_query ($con, "SET @rank2=0");
    $query = mysqli_query ($con, "select SUM(t1.VALOR_VENDA_CAB) as 'vendas', SUM(t2.VALOR_VENDA_CAB) as 'vendas2' from
(SELECT @rank1 := @rank1+1  as id, VALOR_VENDA_CAB FROM venda_cabs WHERE DATA_VENDA_CAB Between '$DataInicio' and '$DataFim' ) as t1
left join
(SELECT @rank2 := @rank2+1  as id, VALOR_VENDA_CAB FROM venda_cabs WHERE DATA_VENDA_CAB Between '$DataInicio2' and '$DataFim2') t2 on t1.id = t2.id");

    $count = mysqli_num_rows($query);
  }
  global $count;
  global $query;
?>
<h4>Comparativo entre períodos</h4>
<div class="container">
  <div class="section">
	<form method="post">
    <h7>Selecione o primeiro periodo</h7>
		<input type="date" name="DataInicio">
		<input type="date" name="DataFim">
    <p>
    <p>
    <h7>Selecione o segundo periodo</h7>
		<input type="date" name="DataInicio2">
		<input type="date" name="DataFim2">
    <p>
    <p>
    <h7>Digite a projecao do primeiro periodo</h7>
    <input type="text" class=" form-control col-sm-8" name="projecao1" id="projecao1">
    <h7>Digite a projecao do segundo periodo</h7>
    <input type="text" class=" form-control col-sm-8" name="projecao2" id="projecao2">
		<p>
			<input type="submit" name="executar" value="executar">
		</p>
    <table class="highlight" style="top:40px;">
    <thead>
      <tr>
        <th>Período</th>
        <th>Vendas</th>
        <th>Projeção</th>
        <th>Realização da meta em %</th>
        <th>Diferença absoluta</th>

      </tr>
    </thead>
    <tbody>
    <?php
      if($count == "0")
      {
        echo '<h2>Pesquisa Invalida</h2>';
      }
      else{
          while($row = mysqli_fetch_array($query)){
            $result=$row['vendas'];
            $result2=$row['vendas2'];
            $output=$result;
            $output2=$result2;
            $meta1= $output /$projecao1;
            $metapercent1 = round((float)$meta1 * 100 ) . '%';
            $meta2= $output2 /$projecao2;
            $metapercent2 = round((float)$meta2 * 100 ) . '%';
            $diferencaV= ($output+$output2);
            $diferencaPro=  ($projecao1+$projecao2);
            $metaPro=$diferencaV /$diferencaPro;
            $metapercentPro = round((float)$metaPro * 100 ) . '%';
            ?>
            <tr>
              <td>Período 1</td>
              <td><?php echo $output;?> </td>
              <td><?php echo $projecao1;?> </td>
              <td><?php echo $metapercent1?> </td>
              <td><?php echo ($output-$projecao1);?> </td>
            </tr>
            <tr>
              <td>Período 2</td>
              <td><?php echo $output2;?> </td>
              <td><?php echo $projecao2;?> </td>
              <td><?php echo $metapercent2?> </td>
              <td><?php echo ($output2-$projecao2);?> </td>
            </tr>
            <tr>
              <td>Absoluto</td>
              <td><?php echo $diferencaV;?> </td>
              <td><?php echo $diferencaPro;?> </td>
              <td><?php echo $metapercentPro?> </td>
              <td><?php echo ($diferencaV-$diferencaPro);?> </td>
            </tr>
            <?php }
        } ?>
      </tbody>
    </table>
      </form>
 </div>
</div>
