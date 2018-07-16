<?php

class kategori_entegrasyon{
    public $conn = null;
    private $table = 'kategori_entegrasyon';

    //Post Properties
    public $id;
    public $kategori_fk;
    public $entg_fk;

    // Consturctor with DB
    public function __construct($db)
    {
        $dbs = new Database();
        $this->conn = $dbs->connect();

    }
    //Create Post
    public function ent_create()
    {
        $query = 'INSERT INTO  kategori_entegrasyon
        SET 
         kategori_fk=:kategori_fk,
         entg_fk=:entg_fk
        ';
        //prepare statment
        $stmt = $this->conn->prepare($query);
        //clean data
        $this->kategori_fk = (strip_tags($this->kategori_fk));
        $this->entg_fk = (strip_tags($this->entg_fk));

        //bind data
        $stmt->bindParam(':kategori_fk', $this->kategori_fk);
        $stmt->bindParam(':entg_fk',$this->entg_fk);
        // execute query
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }


}