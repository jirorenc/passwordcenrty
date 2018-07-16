<?php

class kategori{
    public $conn = null;
    private $table = 'kategori';

    //Post Properties
    public $id;
    public $uyeler_fk;
    public $sifre;
    public $kategori_adi;
    public $kullanici_adi;
    public $aktif;

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
        $query = 'SELECT * FROM kategori';

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
        $stmt->bindParam(1, $this->uyeler_fk);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // set properties
        $this->id = $row['id'];
        $this->uyeler_fk = $row['kullanici_adi'];
        $this->kategori_adi = $row['firma_adi'];
    }

    //Create Post
    public function create()
    {
        $query = 'INSERT INTO  ' . $this->table . ' 
        SET 
        uyeler_fk=:uyeler_fk,
        kullanici_adi=:kullanici_adi,
        kategori_adi=:kategori_adi,
        sifre=:sifre,
        aktif=:aktif
      
        ';
        //prepare statment
        $stmt = $this->conn->prepare($query);
        //clean data
        $this->kategori_adi = (strip_tags($this->kategori_adi));
        $this->uyeler_fk = (strip_tags($this->id));
        $this->sifre = (strip_tags($this->sifre));
        $this->kullanici_adi = (strip_tags($this->kullanici_adi));
        $this->aktif = true;

        //bind data
        $stmt->bindParam(':kategori_adi', $this->kategori_adi);
        $stmt->bindParam(':uyeler_fk', $this->uyeler_fk);
        $stmt->bindParam(':sifre', $this->sifre);
        $stmt->bindParam(':kullanici_adi', $this->kullanici_adi);
        $stmt->bindParam(':aktif', $this->aktif);

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
         FROM kategori as c Where c.kategori_adi=?
         LIMIT 0,1';
        // prepare statment
        $stmt = $this->conn->prepare($query);
        //Bind ID
        $stmt->bindParam(1, $this->kategori_adi);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // set properties
        $this->kategori_adi = $row['kategori_adi'];
        if ($this->kategori_adi === null) {
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
        $this->uyeler_fk = (strip_tags($this->uyeler_fk));
        $this->created_at = (strip_tags($this->created_at));
        $this->id = (strip_tags($this->id));

        //bind data
        $stmt->bindParam(':name', $this->uyeler_fk);
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