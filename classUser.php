<?php 
    Class User{
        private $conn;
        public function __construct($database, $host,  $user, $password){
            
            try{
                $this->conn = new PDO("mysql:database=".$database.";host=".$host, $user, $password);
            }
            catch(PDOException $e) { 
                echo "Database connection failed: " . $e->getMessage();
                exit();
            }
            catch(ERRMODE_EXCEPTION $e){
                echo "ERROR: ".$e->getMessage();;
                exit();
            }
        }
        public function searchData(){
            $result = array();
            $cmd = $this->conn->query("SELECT * FROM qualitydb.user ORDER BY id");
            $result=$cmd->fetchAll(PDO::FETCH_ASSOC);
            
            return $result;
        }
        public function registerUser($name, $CPF_CNPJ, $cep, $logr, $endereco, $numero, $bairro, $cidade, $UF, $compl, $fone, $limi){

            $cmd = $this->conn->prepare("SELECT id from qualitydb.user WHERE cpf_cnpj = :CP");
            $cmd->bindParam (":CP", $CPF_CNPJ);
            $cmd->execute();
            $data= date('Y-m-d');


            if($cmd->rowCount() > 0){
                return false;
            }
            else{
                $cmd = $this->conn->prepare("INSERT INTO qualitydb.user (usr_name, cpf_cnpj, cep, logradouro, endereco, numero, bairro, cidade, UF, complemento, fone, lim_cred, datahora)VALUES(:n, :cp, :cep, :logr, :ender, :num, :bairro, :cidade, :UF, :compl, :fone, :limi, :dat)");
                $cmd->bindParam(":n",$name);
                $cmd->bindParam(":cp",$CPF_CNPJ);
                $cmd->bindParam(":cep",$cep);
                $cmd->bindParam(":logr",$logr);
                $cmd->bindParam(":ender",$endereco);
                $cmd->bindParam(":num",$numero);
                $cmd->bindParam(":bairro",$bairro);
                $cmd->bindParam(":cidade",$cidade);
                $cmd->bindParam(":UF",$UF);
                $cmd->bindParam(":compl",$compl);
                $cmd->bindParam(":fone",$fone);
                $cmd->bindParam(":limi",$limi);
                $cmd->bindParam(":dat",$data);
                $cmd->execute();
                return true;
            }
        }

        public function deleteUser($id){
            
            $cmd = $this->conn->prepare("DELETE FROM qualitydb.user WHERE id = :id");
            $cmd->bindParam(":id", $id);
            $cmd->execute();
        }

        public function searchDataUser($id){
            
            //$res = [];
            $cmd = $this->conn->prepare("SELECT * FROM qualitydb.user WHERE id = :id");
            $cmd->bindParam(":id", $id);
            $cmd->execute();
            $res = $cmd->fetch(PDO::FETCH_ASSOC);
            return $res;

        }

        public function updateUser($id, $name, $CPF_CNPJ, $cep, $logr, $endereco, $numero, $bairro, $cidade, $UF, $compl, $fone, $limi){
                
                $data= date('Y-m-d');
                $cmd = $this->conn->prepare("UPDATE qualitydb.user SET usr_name = :n, cpf_cnpj = :cp, cep = :cep, logradouro = :logr, endereco = :ender, numero = :num, bairro = :bairro, cidade = :cidade, UF = :uf, complemento = :compl, fone = :fone, lim_cred = :limi, datahora = :dat WHERE id = :id");
                $cmd->bindParam(":id",$id);
                $cmd->bindParam(":n",$name);
                $cmd->bindParam(":cp",$CPF_CNPJ);
                $cmd->bindParam(":cep",$cep);
                $cmd->bindParam(":logr",$logr);
                $cmd->bindParam(":ender",$endereco);
                $cmd->bindParam(":num",$numero);
                $cmd->bindParam(":bairro",$bairro);
                $cmd->bindParam(":cidade",$cidade);
                $cmd->bindParam(":uf",$UF);
                $cmd->bindParam(":compl",$compl);
                $cmd->bindParam(":fone",$fone);
                $cmd->bindParam(":limi",$limi);
                $cmd->bindParam(":dat",$data);
                $cmd->execute();
            
        }
        public function search($name){
            $cmd = $this->conn->prepare("SELECT * FROM qualitydb.user  WHERE LIKE usr_nome :n ORDER BY usr_nome");
            $cmd->bindParam(":n", $name);
            $cmd->execute();
            $res = $cmd->fetch(PDO::FETCH_ASSOC);
            return $res;
        }
    }

?>