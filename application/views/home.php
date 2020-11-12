<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>


<div class="container">
	<div class="row">
		<div class="col-lg-4 col-md-4 col-lg-oush-4 col-md-push-4">
			<div class="panel panel-default" style="margin-top: 50px">
				<div class="panel-heading">Login</div>
				<div class="panel-body">
					<?php echo form_open('home/login_process'); ?>
					<div class="form-group">
						<input type="text" name="u_name" class="form-control input-sm" placeholder="Username" required>
					</div>
					<div class="form-group">
						<input type="password" name="u_pass" class="form-control input-sm" placeholder="Password" required>
					</div>
					<div class="form-group">
						<input type="submit" name="u_login" value="Login" class="btn btn-success btn-sm">
						<a href="<?php echo site_url('home/register'); ?>" class="btn btn-warning btn-sm">Register</a>
					</div>
					<?php echo form_close(); ?>
				</div>
			</div>
		</div>
	</div>
</div>

    