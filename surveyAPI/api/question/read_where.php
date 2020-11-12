<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/Question.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog post object
  $question = new Question($db);

  $question->survey_id = isset($_GET['survey_id']) ? $_GET['survey_id'] : die();

  // Blog post query
  $result = $question->read_where();
  // Get row count
  $num = $result->rowCount();

  // Check if any posts
  if($num > 0) {
    // Post array
    
    //$posts_arr = array();
    $posts_arr['questions'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
      extract($row);

      $post_item = array(
        'question_id' => $question_id,
        'survey_id' => $survey_id,
        'question_body' => $question_body,
        'question_type' => $question_type,
        'choice_1' => $choice_1,
        'choice_2' => $choice_2,
        'choice_3' => $choice_3,
        'choice_4' => $choice_4,
        'choice_5' => $choice_5
        
      );

      // Push to "data"
      //array_push($posts_arr, $post_item);
      array_push($posts_arr['questions'], $post_item);
    }

    // Turn to JSON & output
    echo json_encode($posts_arr);

  } else {
    // No Posts
    echo json_encode(
      array('message' => 'No Questions Found')
    );
  }