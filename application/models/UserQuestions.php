<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserQuestions extends CI_Model {

	public function add_question( $question_data )
	{
		$this->db->insert('questions', $question_data);
	}

}

?>
