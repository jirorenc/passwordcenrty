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
    public $aktif_baslangic;
    public $aktif_bitis;
    public $kategori_fk;
    public $e_mail;

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
        $query = 'SELECT * FROM kategori as k Where k.uyeler_fk=?';
        //Prepare statement
        $stmt = $this->conn->prepare($query);
        //Bind ID
        $stmt->bindParam(1, $this->uyeler_fk);
        $stmt->execute();
        return $stmt;
    }



    //Create Post
    public function create()
    {
        $query = 'INSERT INTO ' . $this->table . '
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
        printf("Error:%s.\n", $stmt->errorInfo());
    }
    //Create Post
    public function uye_create()
    {
        $query = 'INSERT INTO alt_uyeler
        SET 
        kategori_fk=:kategori_fk,
        kullanici_adi=:kullanici_adi,
        sifre=:sifre, 
        e_mail=:e_mail,
        aktif=:aktif,
        aktif_baslangic=:aktif_baslangic,
        aktif_bitis=:aktif_bitis
        ';
        //prepare statment
        $stmt = $this->conn->prepare($query);
        //clean data
        $this->kategori_fk = (strip_tags($this->kategori_fk));
        $this->kullanici_adi = (strip_tags($this->kullanici_adi));
        $this->sifre = (strip_tags($this->sifre));
        $this->e_mail = (strip_tags($this->e_mail));
        $this->aktif = (strip_tags($this->aktif));
        $this->aktif_baslangic = (strip_tags($this->aktif_baslangic));
        $this->aktif_bitis = (strip_tags($this->aktif_bitis));
        $this->aktif = true;

        //bind data
        $stmt->bindParam(':kategori_fk', $this->kategori_fk);
        $stmt->bindParam(':kullanici_adi', $this->kullanici_adi);
        $stmt->bindParam(':sifre', $this->sifre);
        $stmt->bindParam(':aktif', $this->aktif);
        $stmt->bindParam(':e_mail', $this->e_mail);
        $stmt->bindParam(':aktif_baslangic', $this->aktif_baslangic);
        $stmt->bindParam(':aktif_bitis', $this->aktif_bitis);

        // execute query
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
        printf("Error:%s.\n", $stmt->errorInfo());
    }

    public function control()
    {
        $query = 'SELECT 
        *
         FROM kategori as c Where c.kategori_adi=? and c.uyeler_fk=?
         LIMIT 0,1';
        // prepare statment
        $stmt = $this->conn->prepare($query);
        //Bind ID
        $stmt->bindParam(1, $this->kategori_adi);
        $stmt->bindParam(2, $this->uyeler_fk);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        // set properties
        $this->kullanici_adi = $row['kullanici_adi'];
        $this->uyeler_fk = $row['uyeler_fk'];

        if ($this->kullanici_adi === null && $this->uyeler_fk===null ) {
            return array(true,0);
        } else {
            return $row['id'];
        }
    }
    //update Post
    public function update()
    {
        $query ='UPDATE kategori
        SET
        aktif=:aktif
        WHERE id=:id ';
        //prepare statment
        $stmt = $this->conn->prepare($query);
        //clean data
        $this->id = (strip_tags($this->id));
        $this->aktif = (strip_tags($this->aktif));


        //bind data
        $stmt->bindParam(':id',$this->id);
        $stmt->bindParam(':aktif',$this->aktif);



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