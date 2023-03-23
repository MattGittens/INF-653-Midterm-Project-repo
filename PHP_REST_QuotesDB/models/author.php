<?php
class Author{
    private $conn;
    private $table = 'quotes';

    //Quotes Properties
    public $id;
    public $author;
    public $created_at;

    //Constructor for DB
    public function __construct($db) {
        $this -> conn = $db;
    }

    //Get Quotes
    public function read(){
        //query
        $query = 'SELECT
        p.id,
        p.author,
        created_at
        FROM 
        ' . $this->table .'
        Order BY
        created_at DESC';

        //Prepare statement 
        $stmt = $this->conn ->prepare ($query);

        //Execute query
        $stmt->execute();
        return $stmt;
    }
    //Get SINGLE Quotes
    public function read_single(){
         //query
         $query = 'SELECT
        p.id,
        p.author
    FROM 
        ' . $this->table;

        //Prep Statement
        $stmt = $this->conn ->prepare ($query);
        //Bind ID
        $stmt->bindParam(1, $this->id);

         //Execute query
         $stmt->execute();
        
         $row = $stmt->fetch(PDO::FETCH_ASSOC);

         //Set properties
         $this ->author = $row['author'];
    }

    //Create Quotes
    public function create(){
      //Create query
      $query = 'INSERT INTO ' .  $this->table . '(author)
       VALUES ( author = :author)';
        
        //Prepare statement
        $stmt = $this->conn->prepare ($query);

        //Clean data
        $this->author = htmlspecialchars(strip_tags($this->author));

        //Bind data
        $stmt->bindParam(' :author' , $this->author);
    //Execute query
    if($stmt ->execute()){
        return true;
    }
    //Print Error if Something goes wrong
    printf("Error: %s.\n",  $stmt->error);

    return false;
    }

    //Update Quotes
    public function Update(){
        //Create query
        $query = 'UPDATE ' .  $this->table . '
        SET
    
          author = :author,
          WHERE
          id = :id';
          
          //Prepare statement
          $stmt = $this->conn->prepare ($query);
  
          //Clean data
    
          $this->author = htmlspecialchars(strip_tags($this->author));
          $this->id = htmlspecialchars(strip_tags($this->id));
  
          //Bind data
          $stmt->bindParam(' :author' , $this->author);
          $stmt->bindParam(' :id' , $this->id);
  
      //Execute query
      if($stmt ->execute()){
          return true;
      }
      //Print Error if Something goes wrong
      printf("Error: %s.\n",  $stmt->error);
  
      return false;
      }

      
    }
    
    //Delete Quotes
      public function delete(){
        //Query
        $query ='DELETE FROM ' . $this->table .' WHERE id = :id';
       
        //Prepare statement
         $stmt = $this->conn->prepare ($query);

         //CLean
         $this->id = htmlspecialchars(strip_tags($this->id));

         //Bind
         $stmt->bindParam(' :id' , $this->id);

         //Execute query
      if($stmt ->execute()){
        return true;
        //Print Error if Something goes wrong
        printf("Error: %s.\n",  $stmt->error);

     return false;
      }
    }
  
