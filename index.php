<?php 
    require_once 'classUser.php';

    $p = New User("quality","localhost", "root", "");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Teste</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="font-awesome/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="./css/main.css">
</head>

<body>
    <?php 
        
        if(isset($_POST['name']))
        { 
            if(isset($_GET['id_up'])&&!empty($_GET['id_up'])){
                $id_update=addslashes($_GET['id_up']);
                $name=addslashes($_POST['name']);
                $CPF_CNPJ=addslashes($_POST['CPF_CNPJ']);
                $cep=addslashes($_POST['CEP']);
                $logr=addslashes($_POST['logr']);
                $endereco=addslashes($_POST['endereco']);
                $numero=addslashes($_POST['numero']);
                $bairro=addslashes($_POST['bairro']);
                $cidade=addslashes($_POST['cidade']);
                $UF=addslashes($_POST['UF']);
                $compl=addslashes($_POST['compl']);
                $fone=addslashes($_POST['fone']);
                $limit=addslashes($_POST['limit']);
                
            
                if(!empty($name && $CPF_CNPJ &&  $cep &&  $logr &&  $endereco &&  $numero &&  $bairro &&  $cidade &&  $UF &&  $compl &&  $fone && $limit)){
                    $p->updateUser($id_update,$name, $CPF_CNPJ, $cep, $logr, $endereco, $numero, $bairro, $cidade, $UF, $compl, $fone, $limit);
                    header("location: index.php");
                }
            }
            else{
                $name=addslashes($_POST['name']);
                $CPF_CNPJ=addslashes($_POST['CPF_CNPJ']);
                $cep=addslashes($_POST['CEP']);
                $logr=addslashes($_POST['logr']);
                $endereco=addslashes($_POST['endereco']);
                $numero=addslashes($_POST['numero']);
                $bairro=addslashes($_POST['bairro']);
                $cidade=addslashes($_POST['cidade']);
                $UF=addslashes($_POST['UF']);
                $compl=addslashes($_POST['compl']);
                $fone=addslashes($_POST['fone']);
                $limit=addslashes($_POST['limit']);

                
                if(!empty($name && $CPF_CNPJ &&  $cep &&  $logr &&  $endereco &&  $numero &&  $bairro &&  $cidade &&  $UF &&  $compl &&  $fone && $limit)){
                    if(!$p->registerUser($name, $CPF_CNPJ, $cep, $logr, $endereco, $numero, $bairro, $cidade, $UF, $compl, $fone, $limit))
                    {
                        echo"Usuario já cadastrado!!";
                    }
                }
                else{
                    echo"<script> alert('Preencha todos os campos!!!')</script>";
                }
            }
            
        }
    ?>
    <?php
        if(isset($_GET['id_up'])){
            $id_update = addslashes($_GET['id_up']);
            $res = $p->searchDataUser($id_update);
            //var_dump($res);
        }
    ?>
    <section id="left">
        <form method="POST">
            <h5> CADASTRAR USUÁRIO</h5>
            <label for="name">NOME</label>
            <input type="text" name="name" id="name" value="<?php if(isset($res)){echo $res['usr_name'];}?>" />

            <label for="CPF_CNPJ">CPF/CNPJ</label>
            <input type="text" name="CPF_CNPJ" id="CPF_CNPJ" value="<?php if(isset($res)){echo $res['cpf_cnpj'];}?>" />

            <label for="CEP">CEP</label>
            <input type="text" name="CEP" id="CEP" value="<?php if(isset($res)){echo $res['cep'];}?>" />

            <label for="logr">LOGRADOURO</label>
            <input type="text" name="logr" id="logr" value="<?php if(isset($res)){echo $res['logradouro'];}?>" />

            <label for="endereco">ENDERECO</label>
            <input type="text" name="endereco" id="endereco" value="<?php if(isset($res)){echo $res['endereco'];}?>" />

            <label for="numero">NUMERO</label>
            <input type="text" name="numero" id="numero" value="<?php if(isset($res)){echo $res['numero'];}?>" />

            <label for="bairro">BAIRRO</label>
            <input type="text" name="bairro" id="bairro" value="<?php if(isset($res)){echo $res['bairro'];}?>" />

            <label for="cidade">CIDADE</label>
            <input type="text" name="cidade" id="cidade" value="<?php if(isset($res)){echo $res['cidade'];}?>" />

            <label for="UF">UF</label>
            <input type="text" name="UF" id="UF" value="<?php if(isset($res)){echo $res['UF'];}?>" />

            <label for="compl">COMPLEMENTO</label>
            <input type="text" name="compl" id="compl" value="<?php if(isset($res)){echo $res['complemento'];}?>" />

            <label for="fone">FONE</label>
            <input type="text" name="fone" id="fone" value="<?php if(isset($res)){echo $res['fone'];}?>" />

            <label for="fone">Limite Cred</label>
            <input type="text" name="limit" id="limt" value="<?php if(isset($res)){echo $res['lim_cred'];}?>" />

            <input type="submit" value="<?php if(isset($res)){echo "Atualizar";}else{echo "Salvar";}?>">
        </form>

    </section>
    <section id="rigth">

        <table class="table table-blue" id="tbluser">
            <thead>
                <tr>
                    <th>NOME</th>
                    <th>CPF/CNPJ</th>
                    <th>CEP</th>
                    <th>LOGRADOURO</th>
                    <th>ENDERECO</th>
                    <th>NUMERO</th>
                    <th>BAIRRO</th>
                    <th>CIDADE</th>
                    <th>UF</th>
                    <th>COMPLEMENTO</th>
                    <th>FONE</th>
                    <th>Limite Cred</th>
                    <th> Data</th>
                </tr>
                <?php  
                    $data = $p->searchData();
                    if(count($data)>0){
                        for($i=0; $i<count($data);$i++){
                            echo"<tr>";
                            foreach($data[$i] as $k => $v){
                             if($k != "id"){
                                    echo"<td>".$v." </td>";
                                }
                            }
                ?>
                <td><a href="index.php?id_up=<?php echo $data[$i]['id'];?>">Editar</a></td>
                <td><a href="index.php?id=<?php echo $data[$i]['id'];?>">Excluir</a></td>
                <?php
                            echo"</tr>";   
                
                        } 
                
                    }
                    else{
                        echo"Ainda não há pessoas cadastradas";
                    }
                ?>
            </thead>
            <tbody></tbody>
        </table>
    </section>


    <script type="text/javascript" src="jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="./js/cep.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    <script type="text/javascript" src="./index.js"></script>
</body>

</html>
<?php
    if(isset($_GET['id'])){
        $id_user=addslashes($_GET['id']);
        $p->deleteUser($id_user);
        header("location:index.php");
    }
?>