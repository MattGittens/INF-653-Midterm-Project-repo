<<?php
class Category{
    db Stuff
    private $conn;
    private $table = 'categories';

    //Properties
    public $id;
    public $category;
    public $created_at;

 //Constructor for DB
    public function __construct($db) {
        $this -> conn = $db;
    }

    //Read Category
    public function read(){
        //Query
        $query = 'SELECT
        id,
        category,
        created_at
        FROM
        '. $this->table.'
        Order BY
        created_at DESC';
        //STMT
        $stmt = $this->conn->prepare($query);

        //Execute
        $stmt ->execute();
        return $stmt;
    }

    //Read Single 
    public function read_single(){
        //query
        $query = 'SELECT
       id,
       category
       created_at
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
        $this ->category = $row['category'];
   }

    //Create Category
    public function create(){
        //Create query
        $query = 'INSERT INTO ' .  $this->table . '(author)
        VALUES ( category = :category)';
          
          //Prepare statement
          $stmt = $this->conn->prepare ($query);
  
          //Clean data
          $this->category = htmlspecialchars(strip_tags($this->category));
  
          //Bind data
          $stmt->bindParam(' :category' , $this->category);
  
      //Execute query
      if($stmt ->execute()){
          return true;
      }
      //Print Error if Something goes wrong
      printf("Error: %s.\n",  $stmt->error);
  
      return false;
      }
  
       //Update Categories
    public function Update(){
        //Create query
        $query = 'UPDATE ' .  $this->table . '
        SET
          category = :category
          WHERE
          id = :id';
          
          //Prepare statement
          $stmt = $this->conn->prepare ($query);
  
          //Clean data
          $this->category = htmlspecialchars(strip_tags($this->category));
          $this->id = htmlspecialchars(strip_tags($this->id));
  
          //Bind data
          $stmt->bindParam(' :category' , $this->category);
          $stmt->bindParam(' :id' , $this->id);
  
      //Execute query
      if($stmt ->execute()){
          return true;
      }
      //Print Error if Something goes wrong
      printf("Error: %s.\n",  $stmt->error);
  
      return false;
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
    }
    //Print Error if Something goes wrong
    printf("Error: %s.\n",  $stmt->error);

    return false;
      }
}
