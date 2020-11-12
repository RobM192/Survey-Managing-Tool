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
            <div class="panel-heading">New Question with Pre-Defined Responses </div>
            <div class="panel-body">
              <?php echo form_open('questions/add_question', 'class="form-horizontal"'); ?>

                <div class="form-group">
                  <label class="col-sm-2 control-label">Question Text</label>
                  <div class="col-sm-10">
                    <input type="text" name="question_body" class="form-control input-sm" placeholder="Enter new question here" required>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-2 control-label">Question Type</label>
                  <div class="col-sm-10">
                    <select name = "question_type" class="form-control input-sm">
                      <option value="-">-</option>
                      <option value="1">Star Rating</option>
                      <option value="2">5 Point Likert Scale - Agree or Disagree</option>
                      <option value="3">5 Point Likert Scale - Satisfaction Rating</option>
                      <option value="4">Text Box Input</option>
                    </select>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-2 control-label">For Survey</label>
                  <div class="col-sm-10">
                    <select name = "for_survey_id" class="form-control input-sm">
                      <option value="-">-</option>

                      <?php

                      $u_id = $_SESSION['u_id'];

                      $survey_list = $this->db->get_where('surveys', array('user_id' => $u_id));

                      foreach ($survey_list->result() as $survey) 
                      { ?>
                      <option value="<?php echo $survey->survey_id; ?>"><?php echo "ID " .$survey->survey_id . ": " . $survey->survey_name; ?></option>
                      <?php }

                      ?>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-offset-2 col-sm-10">
                    <input type="submit" name="add_question" class="btn btn-sm btn-success" value="Add Question">
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>

        <div class="col-lg-9 col-md-9">
          <div class="panel panel-default">
            <div class="panel-heading">New Custom Multiple Choice Question </div>
            <div class="panel-body">
              <?php echo form_open('questions/add_multiple_choice_question', 'class="form-horizontal"'); ?>

                <div class="form-group">
                  <label class="col-sm-2 control-label">Question Text</label>
                  <div class="col-sm-10">
                    <input type="text" name="question_body_mc" class="form-control input-sm" placeholder="Enter new question here" required>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-2 control-label">Choices (2 min)</label>
                  <div class="col-sm-2">
                    <input type="text" name="choice_1" class="form-control input-sm" placeholder="1 - required" required>
                  </div>
                  <div class="col-sm-2">
                    <input type="text" name="choice_2" class="form-control input-sm" placeholder="2 - required" required>
                  </div>
                  <div class="col-sm-2">
                    <input type="text" name="choice_3" class="form-control input-sm" placeholder="3 - optional" >
                  </div>
                  <div class="col-sm-2">
                    <input type="text" name="choice_4" class="form-control input-sm" placeholder="4 - optional" >
                  </div>
                  <div class="col-sm-2">
                    <input type="text" name="choice_5" class="form-control input-sm" placeholder="5 - optional" >
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-2 control-label">For Survey</label>
                  <div class="col-sm-10">
                    <select name = "for_survey_id_mc" class="form-control input-sm">
                      <option value="-">-</option>

                      <?php

                      $u_id = $_SESSION['u_id'];

                      $survey_list = $this->db->get_where('surveys', array('user_id' => $u_id));

                      foreach ($survey_list->result() as $survey) 
                      { ?>
                      <option value="<?php echo $survey->survey_id; ?>"><?php echo "ID " .$survey->survey_id . ": " . $survey->survey_name; ?></option>
                      <?php }

                      ?>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-offset-2 col-sm-10">
                    <input type="submit" name="add_multiple_choice_question" class="btn btn-sm btn-success" value="Add Question">
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