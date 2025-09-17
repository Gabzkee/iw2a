<?php
$senha_para_cadastrar = 'manjericao'; // <-- COLOQUE A SENHA DESEJADA AQUI

$hash = password_hash($senha_para_cadastrar, PASSWORD_DEFAULT);

echo "A senha é: " . $senha_para_cadastrar . "<br>";
echo "O hash para salvar no banco é: " . $hash;
?>