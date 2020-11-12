<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/Survey.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog post object
  $survey = new Survey($db);

  $survey->survey_id = isset($_GET['survey_id']) ? $_GET['survey_id'] : die();

  // Blog post query
  $result = $survey->read_where();
  // Get row count
  $num = $result->rowCount();

  // Check if any posts
  if($num > 0) {
    // Post array
    
    //$posts_arr = array();
    $posts_arr['surveys'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
      extract($row);

      $post_item = array(
        'survey_id' => $survey_id,
        'survey_name' => $survey_name,
        'user_id' => $user_id,
        
        
      );

      // Push to "data"
      //array_push($posts_arr, $post_item);
      array_push($posts_arr['surveys'], $post_item);
    }

    // Turn to JSON & output
    echo json_encode($posts_arr);

  } else {
    // No Posts
    echo json_encode(
      array('message' => 'No Questions Found')
    );
  }