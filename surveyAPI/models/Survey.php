<?php 
  class Survey {
    // DB stuff
    private $conn;
    private $table = 'surveys';

    // Post Properties
    public $survey_id;
    public $survey_name;
    public $user_id;
    
    // public $body;
    // public $author;
    // public $created_at;

    // Constructor with DB
    public function __construct($db) {
      $this->conn = $db;
    }

    // Get Posts
    public function read_all() {
      // Create query
      $query = 'SELECT question_id, survey_id, question_body, question_type
                                FROM ' . $this->table . ';' ;
      
      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Execute query
      $stmt->execute();

      return $stmt;
    }

    public function read_where() {
      // Create query
      $query = 'SELECT survey_id, survey_name, user_id
                                FROM ' . $this->table . ' 
                                    WHERE survey_id = ?';
      
      // Prepare statement
      $stmt = $this->conn->prepare($query);

      $stmt->bindParam(1, $this->survey_id);

      // Execute query
      $stmt->execute();

      return $stmt;
    }

}