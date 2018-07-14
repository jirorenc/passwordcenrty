<?php

class Post
{
    public $conn = null;
    private $table = 'uyeler';

    //Post Properties
    public $id;
    public $kullanici_adi;
    public $sifre;
    public $firma_adi;
    public $email;

    // Consturctor with DB
    public function __construct($db)
    {
        $dbs = new Database();
        $this->conn = $dbs->connect();

    }

    //Get Posts
    public function read()
    {
        // Create query
        $query = 'SELECT * FROM uyeler';

        //Prepare statement

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    //get single post
    public function read_single()
    {
        // Create query
        $query = 'SELECT 
        *
         FROM uyeler as c Where c.kullanici_adi=?
         LIMIT 0,1';
        // prepare statment
        $stmt = $this->conn->prepare($query);
        //Bind ID
        $stmt->bindParam(1, $this->kullanici_adi);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // set properties
        $this->id = $row['id'];
        $this->kullanici_adi = $row['kullanici_adi'];
        $this->firma_adi = $row['firma_adi'];
    }

    //Create Post
    public function create()
    {
        $query = 'INSERT INTO  ' . $this->table . ' 
        SET 
         firma_adi=:firma_adi,
        kullanici_adi=:kullanici_adi,
        sifre=:sifre,
        e_mail=:e_mail
        ';
        //prepare statment
        $stmt = $this->conn->prepare($query);

        //clean data
        $this->firma_adi = (strip_tags($this->firma_adi));
        $this->kullanici_adi = (strip_tags($this->kullanici_adi));
        $this->sifre = (strip_tags($this->sifre));
        $this->email = (strip_tags($this->email));

        //bind data
        $stmt->bindParam(':firma_adi', $this->firma_adi);
        $stmt->bindParam(':kullanici_adi', $this->kullanici_adi);
        $stmt->bindParam(':sifre', $this->sifre);
        $stmt->bindParam(':e_mail', $this->email);

        // execute query
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
        //printf("Error:%s.\n", $stmt->errorInfo());

    }

    public function control()
    {
        $query = 'SELECT 
        *
         FROM uyeler as c Where c.kullanici_adi=?
         LIMIT 0,1';
        // prepare statment
        $stmt = $this->conn->prepare($query);
        //Bind ID
        $stmt->bindParam(1, $this->kullanici_adi);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // set properties
        $this->kullanici_adi = $row['kullanici_adi'];
        if ($this->kullanici_adi === null) {
            return true;
        } else {
            return false;
        }

    }
    public  function login_control(){
        $query = 'SELECT 
        *
         FROM uyeler as c Where c.kullanici_adi=?
         LIMIT 0,1';
        // prepare statment
        $stmt = $this->conn->prepare($query);
        //Bind ID
        $kullanici_kontrol=$this->kullanici_adi;
        $sifre_kontrol=$this->sifre;
        $stmt->bindParam(1, $this->kullanici_adi);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // set properties
        $this->kullanici_adi = $row['kullanici_adi'];
        $this->sifre = $row['sifre'];
        if ($this->kullanici_adi == $kullanici_kontrol && $this->sifre == md5($sifre_kontrol)) {
            return true;
        } else {
            return false;
        }
    }

    //update Post
    public function update()
    {
        $query = 'UPDATE ' . $this->table . ' 
        SET 
        name = :name,
        created_at = :created_at WHERE id=:id';
        //prepare statment
        $stmt = $this->conn->prepare($query);

        //clean data
        $this->kullanici_adi = (strip_tags($this->kullanici_adi));
        $this->created_at = (strip_tags($this->created_at));
        $this->id = (strip_tags($this->id));

        //bind data
        $stmt->bindParam(':name', $this->kullanici_adi);
        $stmt->bindParam(':created_at', $this->created_at);
        $stmt->bindParam(':id', $this->id);

        // execute query
        if ($stmt->execute()) {
            return true;
        }
        printf("Error:%s.\n", $stmt->errorInfo());
        return false;

    }

    //Delete POst
    public function delete()
    {
        // Create query
        $query = 'DELETE FROM ' . $this->table . ' WHERE id= :id ';
        //Clean data
        $this->id = strip_tags($this->id);

        //Preapre statment
        $stmt = $this->conn->prepare($query);

        //Bind data
        $stmt->bindParam(':id', $this->id);

        //Execute query
        if ($stmt->execute()) {
            return true;
        }

        printf("Error:%s.\n", $stmt->errorInfo());

        return false;


    }

}