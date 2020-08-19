<?php
class Usuario
{
    private $pdo;
    public $msgErro = "";

    //MÉTODO CONECTAR NO BANCO DE DADOS
    public function conectar($nome, $host, $usuario, $senha)
    {
        global $msgErro;
        global $pdo;
        try {
            $pdo = new PDO("mysql:dbname=".$nome, $usuario, $senha);
        } catch (PDOException $e) {
           $msgErro = $e->getMessage();        
            }
    }

    //MÉTODO PARA CADASTRAR
    public function cadastrar($nome, $email, $senha, $data, $altura, $peso)
    {
        global $pdo;
        //VEREFICAR EMAIL CADASTRADO
     $sql = $pdo->prepare("SELECT id_usuario FROM usuarios WHERE email = :e");
        $sql-> bindValue(':e', $email);
        $sql->execute();
        if($sql->rowCount() > 0){
            return false; //JÁ ESTÁ CADASTRADA
        }
        else
        {
            //NÃO CADASTRADO
            $sql = $pdo-> prepare ("INSERT INTO usuarios (nome, email, senha,
            data_nasc, altura, peso) 
            VALUES (:n, :e, :s, :d, :a, :p)");
            $sql-> bindValue(":n", $nome);
            $sql-> bindValue(":e", $email);
            $sql-> bindValue(":d", $data);
            $sql-> bindValue(":a", $altura);
            $sql-> bindValue(":p", $peso);
            $sql-> bindValue(":s", md5($senha));
            //"md5" SERVE PARA CRIPTOGRAFAR A SENHA
            $sql->execute();
            return true;
        }
        
    }
    public function logar($email, $senha)
    {
        global $pdo;
       
        //VEREFICAR SE O EMAIL E SENHA ESTÃO CADASTRADOS, SE SIM
        $sql = $pdo->prepare("SELECT id_usuario FROM usuarios WHERE
        email = :e AND senha = :s");//CHAMADA DO MÉTODO PREPARE
           $sql-> bindValue(":e", $email);
           $sql-> bindValue(":s", md5($senha));
           $sql->execute();
           if ($sql->rowCount() > 0)
           {
            //ENTRAR NO SISTEMA 
            $dado = $sql->fetch();//PEGA TUDO DO BD E TRANSFORMA EM ARRAY
            session_start();
            $_SESSION['id_usuario'] = $dado['id_usuario'];
            return true; //LOGADO COM SUCESSO
           }
           else
           {
                return false;// NÃO FOI POSSIVEL LOGAR
           }
    }
}

?>