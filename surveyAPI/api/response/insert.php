<?php

    include_once '../../config/Database.php';
    $database = new Database();
    $db = $database->connect();

    $url = $_SERVER['QUERY_STRING'];
    $connect=mysqli_connect("localhost","root","","ci");

    //echo $url;

    $query = array();

    $urlArr=parse_url($_SERVER['REQUEST_URI']);

    
    parse_str($urlArr['query'], $output);

    // Get the most recent participant id and increment it by 1
    $result = mysqli_query($connect, "SELECT MAX(participant_id) FROM responses;");
    $row=mysqli_fetch_array($result);
    $participant_id= $row[0] + 1;
    
    // INSERT THE DATA
    $myQuery= "INSERT INTO responses (question_id, participant_id, response_body) VALUES";
    foreach ($output as $key => $value) {

        $value = str_replace("'", "&#39;", $value);
        $myQuery .= "('" . $key . "', '" . $participant_id  . "', '". $value ."'),";
        
        
    }

    $myQuery = rtrim($myQuery, ',');

    $myQuery .= ";";
    
    //echo $myQuery;


    

    $sql=mysqli_query($connect, $myQuery);

    if($sql)

        {

            $response['success']=1;

            $response['message']="success";

        }

        else

        {

            $response['success']=0;

            $response['message']="Error";

        }

        echo json_encode($response);
        

    

?>