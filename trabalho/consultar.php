<HTML>
<BODY>
<?php
$expressao=		$_POST["expressao"];
$bd=mysqli_connect("localhost","root","","estoque") or die ("erro!");


if (isset($_POST ["op"]))
{
	$op = $_POST ["op"];
	if ($op=="produto")
		$consulta=mysqli_query($bd,"select * from estoque where produto='$expressao'");
	if ($op=="id")
		$consulta=mysqli_query($bd,"select * from estoque where id='$expressao'");
	if ($op=="preco")
		$consulta=mysqli_query($bd,"select * from estoque where preco_unitario like '%$expressao%'");
	if ($op=="tipo")
		$consulta=mysqli_query($bd,"select * from estoque where tipo like '$expressao'");	
} else
{
	echo "volte a página e escolha o campo que fará a pesquisa";
	exit;
}
$reg = mysqli_fetch_array($consulta);
if ($reg==0)
{
	echo "Não existem registros para a pesquisa!";
	exit;
}
while ($reg!=0)
{
	$produto = $reg["produto"];
	$quantidade = $reg["quantidade"];
	$id = $reg["id"];
	$tipo = $reg["tipo"];
	
	echo   "Placa: $placa<br>
			Veículo: $produto<br>
			quantidade: $quantidade<br>
			Cor: $cor<br>
			Ano: $tipo<br>
			Proprietário: $proprietario<br>
			Fone: $fone<br>
			Opcionais: $opcionais<br>";
			
	?>
	<?php
	$reg = mysqli_fetch_array($consulta);		
} 
?>
<br><a href="consultar.html">Voltar</a><br>
</body>
</html>