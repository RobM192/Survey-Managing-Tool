<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserSurveys extends CI_Model {

	public function add_survey( $survey_details )
	{
		$this->db->insert('surveys', $survey_details);
	}

}

/* End of file Surveys.php */
/* Location: ./application/models/Surveys.php */