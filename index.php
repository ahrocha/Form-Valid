<?php
//Inclui a biblioteca para validação dos formulários
include 'form_valid.php';
?>
<html>
    <body>
     <?php
        //Utilizado para imprimir os erros debaixo dos campos
        $validacao = null;

            if($_POST){

                   //Armazena todos os erros em um array
                   $validacao = formValid('frm_cadastro',$_POST);

                   if(!$validacao){
                      #Se não ocorrer nenhum erro
                      echo "INSERT INTO tabela";
                   }else{ 

                      //Exibe todos os erros pulando uma linha        
                      echo viewErrors($validacao);
                   }
            }
        ?>
        <hr>
        <form action="" method="POST">
            Email: <br/><input name="email" value="<?php echo isset($_POST['email'])? $_POST['email'] : null ?>">
            <br/>
            <?php echo (isset($validacao['email']))?$validacao['email']:null ?>
             <br/>
             <br/>
             Razão Social: <br/><input name="nome_razao" value="<?php echo isset($_POST['nome_razao'])? $_POST['nome_razao'] : null ?>">
             <br/>
            <?php echo (isset($validacao['nome_razao']))?$validacao['nome_razao']:null?>
             <br/>
             <br/>
             Nome: <br/><input name="nome" value="<?php echo isset($_POST['nome'])? $_POST['nome'] : null ?>">
            <br/>
            <?php echo (isset($validacao['nome']))?$validacao['nome']:null?>
             <br/>
             <br/>
           
            
            <input type="submit">
        </form>
    </body>
</html>