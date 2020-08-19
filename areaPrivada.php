<?php
    session_start();
    if(!isset($_SESSION['id_usuario']))
    {
        header("location: index.php");
    }
?>
<html lang="pt-br">

<head>
    <meta charset="uft-8" />
    <title>Lead</title>
    <link rel="stylesheet" href="css/estilo.css" />
    <meta name="viewport" content="width=device-width">
</head>

<body id="privado">
<div >
        <img src="imagens/img3.png" width="300" heigt="0">
        <hr class ="img">
    </div>

<nav id="menu">
<ul type="disc">
    <li>Nome Completo</li>
    <li>Idade</li>
    <li>Altura</li>
    <li>Peso</li>
    <li>IMC</li>
    <li>Incluir</li>
    <li>Excluir</li>
    <li>Alterar</li>
    <li><a href="sair.php"> Sair</a></li>
</ul>
</nav>



</body>
</html>