<?php
require_once 'classes/usuarios.php';
$us = new Usuario;
?>

<html lang="pt-br">

<head>
    <meta charset="uft-8" />
    <title>Login</title>
    <link rel="stylesheet" href="css/estilo.css" />
    <meta name="viewport" content="width=device-width">
</head>

<body>
    <div class="topo">
        <img src="imagens/img3.png" width="400" heigt="0">
        <hr>
    </div>

    <div id="formulario">
        <h1>LOGIN<h1>
                <form method="POST">
                    <input type="email" placeholder="Usuário" name="email">
                    <input type="password" placeholder="Senha" name="senha">
                    <input type="submit" value="ACESSAR">
                    <a href="cadastrar.php">
                        <h6>Ainda não cadastrado? Cadastre-se!<h6>
                    </a>

                </form>
    </div>
    <?php

    if(isset($_POST['email']))
    {
        $email = addslashes ($_POST['email']);
        $senha = addslashes ($_POST['senha']);
        
        if(!empty($email) && !empty($senha))
        {
            $us->conectar("login_cadastro","loalhost","root","");
            if($us->msgErro =="")
            {
           if($us->logar($email, $senha))
           {
                header("location: areaPrivada.php");
           }
           else 
           {
               ?>
    <div class="msg_erro">
        Email e/ou senha estão incorretos!
    </div>
    <?php
           }
        }
           else{
            ?>
    <div class="msg_erro">
        <?php echo "Erro: ".$u->msgErro; ?>
    </div>
    <?php
           }
        }else
        {
            ?>
    <div class="msg_erro">
        Preencha todos os campos!
    </div>
    <?php
        }
    }
    
    ?>

</body>

</html>