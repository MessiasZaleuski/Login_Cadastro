<?php
require 'classes/usuarios.php';
$u = new Usuario;
?>

<html lang="pt-br">

<head>
    <meta charset="uft-8" />
    <title>Cadastro</title>
    <link rel="stylesheet" href="css/estilo.css">
</head>

<body>
    <div class="topo">
        <img src="imagens/img3.png" width="400" heigt="0">
        <hr>
    </div>

    <div id="formulario">
        <h1>CADASTRAR<h1>
                <form method="POST">
                    <input type="text" name="nome" placeholder="Nome Completo">
                    <input type="email" name="email" placeholder="Usuário">
                    <input type="date" name="data_nasc" placeholder="Data nascimento">
                    <input type="text" name="altura" placeholder="Altura">
                    <input type="text" name="peso" placeholder="Peso">
                    <input type="password" name="senha" placeholder="Senha">
                    <input type="password" name="confsenha" placeholder="Confirmar Senha">
                    <input type="submit" value="CADASTRAR">
                </form>
    </div>

    <?php
 //VEREFICAR SE USUARIO CLICOU NO BOTÃO
 if(isset($_POST['nome']))
 {
     $nome = addslashes ($_POST['nome']);
     $email = addslashes ($_POST['email']);
     $data = filter_input(INPUT_POST, 'data_nasc');
     $altura = addslashes ($_POST['altura']);
     $peso = addslashes ($_POST['peso']);
     $senha = addslashes ($_POST['senha']);
     $confirmarSenha = addslashes ($_POST['confsenha']);
     //VEREFICA SE OS CAMPOS NÃO ESTÃO VAZIOS
     if (!empty($nome) && !empty($email) && !empty($data) && !empty($altura) 
        && !empty($peso) && !empty($senha) && !empty($confirmarSenha))
     {
         $u->conectar("lead","loalhost","root","");
        if($u->msgErro == "")
        {
            if($senha == $confirmarSenha)
            {
                if ($u->cadastrar($nome, $email, $senha, $data, $altura, $peso, $confirmarSenha))
             {
                ?>
    <div id="msg_sucesso">
        Cadastrado com sucesso! Acesse para entrar!
    </div>
    <?php
            }
            else 
            {
                ?>
    <div class="msg_erro">
        Email já cadastrado!
    </div>
    <?php           
            }
        }
        else
        {
            ?>
    <div class="msg_erro">
        Senha e confirmar senha, não correspondem
    </div>
    <?php

        }
    }
    else
    {
    ?>
    <div class="msg_erro">
        <?php echo "Erro: " .$u->msgErro; ?>
    </div>
    <?php
    }
}
    else
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