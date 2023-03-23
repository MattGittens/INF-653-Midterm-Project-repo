<?php
class Quotes{
    private $conn;
    private $table = 'quotes';

    //Quotes Properties
    public $id;
    public $category_id;
    public $category_name;
    public $author_name
    public $quote;
    public $author_id;

    //Constructor for DB
    public function __construct($db) {
        $this -> conn = $db;
    }

    //Get Quotes
    public function read(){
        //query
        $query = 'SELECT
         c.name as category_name,
         a.name as author_name
        p.id,
        p.category_id,
        p.quote,
        p.author_id,

        FROM 
        ' . $this->table . ' p
        LEFT JOIN
            categories c ON p.category_id = c.id
        LEFT JOIN
            author a ON p.category_id = a.id
        ORDER BY
        p.created_at DESC';

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
         c.name as category_name,
         a.name as author_name
        p.id,
        p.category_id,
        p.quote,
        p.author_id,
        created_at
    FROM 
        ' . $this->table . ' p
     LEFT JOIN
            categories c ON p.category_id = c.id
    LEFT JOIN
            author a ON p.category_id = a.id
     WHERE
        p.id = ? 
    LIMIT 0,1';

        //Prep Statement
        $stmt = $this->conn ->prepare ($query);
        //Bind ID
        $stmt->bindParam(1, $this->id);

         //Execute query
         $stmt->execute();
        
         $row = $stmt->fetch(PDO::FETCH_ASSOC);

         //Set properties
         $this ->quote = $row['quote'];
         $this ->author_id = $row['author_id'];
         $this ->category_id = $row['category_id'];
         $this ->category_name = $row['category_name'];
    }

    //Create Quotes
    public function create(){
      //Create query
      $query = 'INSERT INTO ' .  $this->table . '(author)
       VALUES ( 
        quote = :quote,
        author_id = :author_id,
        category_id = :category_id)';
        
        //Prepare statement
        $stmt = $this->conn->prepare ($query);

        //Clean data
        $this->quote = htmlspecialchars(strip_tags($this->quote));
        $this->author_id = htmlspecialchars(strip_tags($this->author_id));
        $this->category_id = htmlspecialchars(strip_tags($this->category_id));

        //Bind data
        $stmt->bindParam(' :quote' , $this->quote);
        $stmt->bindParam(' :author_id' , $this->author_id);
        $stmt->bindParam(' :category_id' , $this->category_id);

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
          quote = :quote,
          author_id = :author_id,
          category_id = :category_id
          WHERE
          id = :id';
          
          //Prepare statement
          $stmt = $this->conn->prepare ($query);
  
          //Clean data
          $this->quote = htmlspecialchars(strip_tags($this->quote));
          $this->author_id = htmlspecialchars(strip_tags($this->author_id));
          $this->category_id = htmlspecialchars(strip_tags($this->category_id));
          $this->id = htmlspecialchars(strip_tags($this->id));
  
          //Bind data
          $stmt->bindParam(' :quote' , $this->quote);
          $stmt->bindParam(' :author_id' , $this->author_id);
          $stmt->bindParam(' :category_id' , $this->category_id);
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
    