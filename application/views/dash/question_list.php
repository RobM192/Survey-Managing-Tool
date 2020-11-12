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
				<table class="table table-bordered table-hover">
					<tr>
						<th>Question ID</th>
						<th>Question Body</th>
						<th>Question Type</th>
						<th>From Survey</th>
						<th>Edit</th>
						<th>Delete</th>
					</tr>
					<?php

					$u_id = $_SESSION['u_id'];

					$question_list = $this->db->select('questions.question_id, questions.question_body, questions.question_type, questions.survey_id, surveys.user_id')
					->from('questions')
					->where('surveys.user_id',$u_id)
					->join('surveys','questions.survey_id = surveys.survey_id')
					->get();

					foreach ($question_list->result() as $question) 
					{ ?>
						
					<tr>
						<td><?php echo $question->question_id; ?></td>
						<td><?php echo $question->question_body; ?></td>
						<td>
							<?php  
							if ($question->question_type == 1) {
  							echo "Star Rating";
							} elseif($question->question_type == 2) {
  							echo "Agree Likert Scale";
							} elseif($question->question_type == 3) {
								echo "Satisfaction Likert Scale";
							} elseif($question->question_type == 4) {
								echo "Text Input";
							} else {
  							echo "Multiple Choice";
							}
							?>
						</td>
						
						<td><?php echo $question->survey_id; ?></td>
						<td><a href="<?php echo site_url(); ?>questions/update_question/<?php echo $question->question_id; ?>" class="btn btn-warning btn-block btn-xs">Edit</a></td>
						<td><a href="<?php echo site_url(); ?>questions/delete_question/<?php echo $question->question_id; ?>" class="btn btn-danger btn-block btn-xs" onclick="return confirm('Are you sure you want to delete this question from the survey?')">Delete</a></td>
					</tr>

					<?php }

					?>
				</table>
			</div>
		</div>
	</div>
	<!-- dash data -->


	<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
  </body>
</html>