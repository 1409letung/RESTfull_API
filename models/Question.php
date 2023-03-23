<?php
   class Question
   {
      private $conn;

      //table question
      public $id_cauhoi;
      public $title;
      public $cau_a;
      public $cau_b;
      public $cau_c;
      public $cau_d;
      public $caudung;

      //connect db
      public function __construct($db)
      {
        $this->conn = $db;
      }

      //read table question
      public function Read()
      {
        $query = "SELECT * FROM cauhoi ORDER BY id_cauhoi DESC";
        $stmt  = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt; 
      }
      //show data
      public function Show()
      {
        $query = "SELECT * FROM cauhoi WHERE id_cauhoi=? LIMIT 1";
        $stmt  = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id_cauhoi);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->title = $row['title'];
        $this->cau_a = $row['cau_a'];
        $this->cau_b = $row['cau_b'];
        $this->cau_c = $row['cau_c'];
        $this->cau_d = $row['cau_d'];
        $this->caudung = $row['caudung'];
      }
      //create data
      public function Create()
      {
        $query = "INSERT INTO cauhoi(title,cau_a,cau_b,cau_c,cau_d,caudung) VALUES (:title, :cau_a, :cau_b, :cau_c, :cau_d, :caudung)";
        $stmt  = $this->conn->prepare($query);
        //clean data
        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->cau_a = htmlspecialchars(strip_tags($this->cau_a));
        $this->cau_b = htmlspecialchars(strip_tags($this->cau_b));
        $this->cau_c = htmlspecialchars(strip_tags($this->cau_c));
        $this->cau_d = htmlspecialchars(strip_tags($this->cau_d));
        $this->caudung = htmlspecialchars(strip_tags($this->caudung));
        //bind data
        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':cau_a', $this->cau_a);
        $stmt->bindParam(':cau_b', $this->cau_b);
        $stmt->bindParam(':cau_c', $this->cau_c);
        $stmt->bindParam(':cau_d', $this->cau_d);
        $stmt->bindParam(':caudung', $this->caudung);
  
        if($stmt->execute())
        {
          return true;
        }
        printf("Error %s.\n", $stmt->error);
        return false;

        $this->conn = null;
      }

      //update
      public function Update()
      {
        $query = "UPDATE cauhoi SET title=:title, cau_a=:cau_a, cau_b=:cau_b, cau_c=:cau_c, cau_d=:cau_d, caudung=:caudung WHERE id_cauhoi=:id_cauhoi";
        $stmt  = $this->conn->prepare($query);
        //clean data
        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->cau_a = htmlspecialchars(strip_tags($this->cau_a));
        $this->cau_b = htmlspecialchars(strip_tags($this->cau_b));
        $this->cau_c = htmlspecialchars(strip_tags($this->cau_c));
        $this->cau_d = htmlspecialchars(strip_tags($this->cau_d));
        $this->caudung = htmlspecialchars(strip_tags($this->caudung));
        $this->id_cauhoi = htmlspecialchars(strip_tags($this->id_cauhoi));
        //bind data
        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':cau_a', $this->cau_a);
        $stmt->bindParam(':cau_b', $this->cau_b);
        $stmt->bindParam(':cau_c', $this->cau_c);
        $stmt->bindParam(':cau_d', $this->cau_d);
        $stmt->bindParam(':caudung', $this->caudung);
        $stmt->bindParam(':id_cauhoi', $this->id_cauhoi);
  
        if($stmt->execute())
        {
          return true;
        }
        printf("Error %s.\n", $stmt->error);
        return false;

        $this->conn = null;
      }

      //delete
      public function Delete()
      {
        $query = "DELETE FROM cauhoi WHERE id_cauhoi=:id_cauhoi";
        $stmt  = $this->conn->prepare($query);
        //clean data
        $this->id_cauhoi = htmlspecialchars(strip_tags($this->id_cauhoi));
        //bind data
        $stmt->bindParam(':id_cauhoi', $this->id_cauhoi);
  
        if($stmt->execute())
        {
          return true;
        }
        printf("Error %s.\n", $stmt->error);
        return false;

        $this->conn = null;
      }
   }
?>