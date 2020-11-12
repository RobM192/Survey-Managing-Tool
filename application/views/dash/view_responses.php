<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if ( !$_SESSION['u_name'] ) {
	# code...
	redirect('home','refresh');
}

?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Survey Master</title>
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css">
	<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    
    <!-- dash nav -->
    <?php $this->load->view('dash/inc/nav'); ?>
    <!-- dash nav -->

    <!-- dash data -->
    <div class="container">
      <div class="row">
        <div class="col-lg-3 col-md-3">
          <!-- sidebar -->
          <?php $this->load->view('dash/inc/sidebar'); ?>
          <!-- sidebar -->
        </div>
        <div class="col-lg-9 col-md-9">
          <div class="panel panel-default">
            <div class="panel-heading">View Responses</div>
            <div class="panel-body">
              <?php echo form_open('responses/view_responses', 'class="form-horizontal"'); ?>

              <div class="form-group">
                  <label class="col-sm-2 control-label">For Question: </label>
                  <div class="col-sm-10">
                    <select name = "for_question_id" class="form-control input-sm">
                      <option value="-">-</option>

                      <?php

                      $u_id = $_SESSION['u_id'];

                      $question_list = $this->db->select('questions.question_id, questions.question_body, surveys.user_id')
					          ->from('questions')
					          ->where('surveys.user_id',$u_id)
					          ->join('surveys','questions.survey_id = surveys.survey_id')
					          ->get();

                      //$survey_list = $this->db->get_where('surveys', array('user_id' => $u_id));

                      foreach ($question_list->result() as $question) 
                      { ?>
                      <option value="<?php echo $question->question_id; ?>"><?php echo "ID " .$question->question_id . ": " . $question->question_body; ?></option>
                      <?php }

                      ?>
                    </select>
                  </div>
                </div>

                <div class="form-group">
                <div class="button-box col-sm-offset-2 col-sm-10">
                <input type="submit" name="view_responses" class="btn btn-sm btn-success" value="View" role="button"></a>
                
                
            </div>
            </div>
              </form>
            </div>
            
          </div>

        </div>
      </div>
    </div>
    <!-- dash data -->

    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
  </body>
</html>