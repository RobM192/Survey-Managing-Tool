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
				<table class="table table-bordered table-hover table-striped">
					<tr>
						<th>Survey ID</th>
						<th>Survey Title</th>
						<th>Edit</th>
						<th>Delete</th>
					</tr>
					<?php

					$u_id = $_SESSION['u_id'];

					//$survey_list = $this->db->get('surveys');
					//$survey_list = $this->db->Where('user_id', $user_id);
					$survey_list = $this->db->get_where('surveys', array('user_id' => $u_id));

					foreach ($survey_list->result() as $survey) 
					{ ?>
						
					<tr>
						<td><?php echo $survey->survey_id; ?></td>
						<td><?php echo $survey->survey_name; ?></td>
						<td><a href="<?php echo site_url(); ?>surveys/update_survey/<?php echo $survey->survey_id; ?>" class="btn btn-warning btn-block btn-xs">Edit</a></td>
						<td><a href="<?php echo site_url(); ?>surveys/delete_survey/<?php echo $survey->survey_id; ?>" class="btn btn-danger btn-block btn-xs" onclick="return confirm('Are you sure you want to delete this survey?\nAll associated questions will also be deleted!')">Delete</a></td>
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