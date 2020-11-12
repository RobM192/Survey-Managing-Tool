<?php 
  class Question {
    // DB stuff
    private $conn;
    private $table = 'questions';

    // Post Properties
    public $question_id;
    public $survey_id;
    public $question_body;
    public $question_type;

    public $choice_1;
    public $choice_2;
    public $choice_3;
    public $choice_4;
    public $choice_5;
    
    // Constructor with DB
    public function __construct($db) {
      $this->conn = $db;
    }

    // Get Posts
    public function read_all() {
      // Create query
      $query = 'SELECT * FROM ' . $this->table . ';' ;
      
      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Execute query
      $stmt->execute();

      return $stmt;
    }

    public function read_where() {
      // Create query
      $query = 'SELECT question_id, survey_id, question_body, question_type, choice_1, choice_2, choice_3, choice_4, choice_5
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