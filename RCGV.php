<?php

require_once '../config/conexao.php';

$conexao = Conexao::getInstance();

$where = ' WHERE ';
if($_GET['VENDEDOR'] != ''){
	$addVendedor = "FUNCIONARIO_ID = ".$_GET['VENDEDOR'];
	$where .= $addVendedor;
}else{
	$addVendedor = "";
}

if($_GET['CLIENTE'] != ''){
	$addCliente = "CLIENTE_ID = ".$_GET['CLIENTE'];
	if($where != " WHERE "){
		$where .= " and ".$addCliente;  
	}else{
		$where .= $addCliente;
	}
}else{
	$addCliente = "";
}

if($_GET['DATAINI'] != ''){
	$date = str_replace('/', '-', $_GET['DATAINI']);
	$addDataini = date('Y-m-d', strtotime($date));
}else{
	$addDataini = "";
}

if($_GET['DATAFIN'] != ''){
	$date = str_replace('/', '-', $_GET['DATAFIN']);
	$addDatafin = date('Y-m-d', strtotime($date));
}else{
	$addDatafin = "";
}

if($addDataini != '' && $addDatafin == ''){
	$addData = " DATE(DATA_VENDA_CAB) BETWEEN '".$addDataini."' AND CURDATE()";
}else if($addDataini == '' && $addDatafin != ''){
	$addData = " DATE(DATA_VENDA_CAB) BETWEEN 2000-01-01 AND '".$addDatafin."'";
}else if($addDataini != '' && $addDatafin != ''){
	$addData = " DATE(DATA_VENDA_CAB) BETWEEN '".$addDataini."' AND '".$addDatafin."'";
}else{
	$addData = '';
}

if($addData != ''){
	if($where != " WHERE "){
		$where .= " and ".$addData;  
	}else{
		$where .= $addData;
	}
}

//print $where;

	/*
$stmt    = $conexao->prepare("SELECT * FROM tipo_pagamentos;");
$tipopg  = array();
if ($stmt->execute()) {
	if ($stmt->rowCount() > 0) {
		while ($rs = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$tipopg[] = $rs;
		}
	}
}
*/

$stmt    = $conexao->prepare("SELECT id, NOME_FUNCIONARIO FROM funcionarios;");
$nomefunc  = array();
if ($stmt->execute()) {
	if ($stmt->rowCount() > 0) {
		while ($rs = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$nomefunc[] = $rs;
		}
	}
}

$stmt    = $conexao->prepare("SELECT id, NOME_CLIENTE FROM clientes;");
$nomecliente  = array();
if ($stmt->execute()) {
	if ($stmt->rowCount() > 0) {
		while ($rs = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$nomecliente[] = $rs;
		}
	}
}

if($where != " WHERE "){
	$sql = "SELECT YEAR(DATA_VENDA_CAB), MONTH(DATA_VENDA_CAB), SUM(VALOR_VENDA_CAB) from venda_cabs".$where." GROUP BY YEAR(DATA_VENDA_CAB), MONTH(DATA_VENDA_CAB);";
}else{
	$sql = "SELECT YEAR(DATA_VENDA_CAB), MONTH(DATA_VENDA_CAB), SUM(VALOR_VENDA_CAB) from venda_cabs GROUP BY YEAR(DATA_VENDA_CAB), MONTH(DATA_VENDA_CAB);";
}
//print $sql;
$stmt    = $conexao->prepare($sql);
$vendas  = array();
if ($stmt->execute()) {
	if ($stmt->rowCount() > 0) {
		while ($rs = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$vendas[] = $rs;
		}
	}
}

$ano = 0;
$primeiroAno = 0;
if(sizeOf($vendas) > 0){
	$lastEl = array_values(array_slice($vendas, -1))[0];
	$ano = ($lastEl["YEAR(DATA_VENDA_CAB)"] - $vendas[0]['YEAR(DATA_VENDA_CAB)']);
	$primeiroAno = $vendas[0]['YEAR(DATA_VENDA_CAB)'];
}
$mes = array("Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro");

//var_dump($primeiroAno);

