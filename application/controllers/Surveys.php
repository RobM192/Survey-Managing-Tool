<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Surveys extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('UserSurveys');
	}

	public function index()
	{
		$this->load->view('dash/add_survey');
	}

	public function view_surveys()
	{
		$this->load->view('dash/survey_list');
	}

	public function add_survey()
	{	
		if ( $this->input->post('add_survey') ) 
		{
			$survey_name = $this->input->post('survey_name');
			
			$u_id = $_SESSION['u_id'];
			
			
			$survey_data = array(
				'survey_name' => $survey_name,
				'user_id' => $u_id
			);

			$this->UserSurveys->add_survey($survey_data);

			redirect('surveys/view_surveys','refresh');
			
		}
	}

	public function update_survey( $survey_id )
	{
		$this->load->view('dash/update_survey', $survey_id);
	}

	public function update_process_surveys( $survey_id )
	{
		if ( $this->input->post('update_survey') ) 
		{
			$survey_name = $this->input->post('survey_name');
			$survey_details = array( 
				'survey_name'	=> $survey_name
			);
			$this->db->where('survey_id', $survey_id);
			$this->db->update('surveys', $survey_details);
			redirect('surveys/view_surveys','refresh');
		}
	}

	public function delete_survey( $survey_id )
	{

		$this->db->where('survey_id', $survey_id);
		$this->db->delete('surveys');
		redirect('surveys/view_surveys','refresh');
	}

}

?>