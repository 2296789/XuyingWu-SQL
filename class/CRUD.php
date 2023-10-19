<?php

class CRUD extends PDO {

    public function __construct(){
        //parent::__construct('mysql:host=localhost; dbname=blog; port=3306; charset=utf8', 'root', 'root');
        parent::__construct('mysql:host=localhost; dbname=e2296789; port=3306; charset=utf8', 'root', 'JLl2AH6eOoD6Ru7pOjhO');
    }

    public function select($table, $field='id', $order='ASC'){
        $sql = "SELECT * FROM $table ORDER BY $field $order";
        $stmt = $this->query($sql);
        return $stmt->fetchAll();
    }

    public function selectId($table, $value, $field = 'id'){
        $sql = "SELECT * FROM $table WHERE $field = '$value'";
        $stmt = $this->query($sql);
        $count = $stmt->rowCount();

        if($count == 1){
            return $stmt->fetch();
        }else{
            header('location: index.php');
        }  
    }

    public function insert($table, $data){
        //if(($table == 'article' && $data !== "")){
            $nomChamp = implode(", ",array_keys($data));
            $valeurChamp = ":".implode(", :", array_keys($data));
            $sql = "INSERT INTO $table ($nomChamp) VALUES ($valeurChamp)";
            $stmt = $this->prepare($sql);

            foreach($data as $key => $value){
                $stmt->bindValue(":$key", $value);
            }
            $stmt->execute();
            return $this->lastInsertId();
        // }else{
        //     echo "Veuillez saisir le titre et le texte.";
            header('location: index.php');
        // }  
    }

    public function delete($table, $value, $field = 'id'){
        if ($table == 'article' && $this->ilYaComments($value)) {
            return false;
        } else {
            $sql = "DELETE FROM $table WHERE $field = :$field";
            $stmt = $this->prepare($sql);
            $stmt->bindValue(":$field", $value);
            $stmt->execute();
            header('location: index.php');
            return true;
        }
    }
    public function ilYaComments($articleId){
        $sql = "SELECT COUNT(*) FROM commentaire WHERE article_id = :articleId";
        $stmt = $this->prepare($sql);
        $stmt->bindValue(":articleId", $articleId);
        $stmt->execute();
        $count = $stmt->fetchColumn();
        return ($count > 0);
    }

    public function update($table, $data, $field='id'){
        $queryField = null;

        foreach($data as $key=>$value){
            $queryField .="$key =:$key, ";
        }
        $queryField = rtrim($queryField, ", ");
        $sql = "UPDATE $table SET $queryField WHERE $field = :$field";
        $stmt = $this->prepare($sql);
        
        foreach($data as $key => $value){
            $stmt->bindValue(":$key", $value);
        }
        $stmt->execute();
        header('Location: index.php');
    }
}
?>