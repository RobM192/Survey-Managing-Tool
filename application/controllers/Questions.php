<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Questions extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('UserQuestions');
	}

	public function index()
	{
		$this->load->view('dash/add_question');
	}

	public function view_questions()
	{
		$this->load->view('dash/question_list');
	}

	
	public function add_question()
	{	
		if ( $this->input->post('add_question') ) 
		{
			$question_body = $this->input->post('question_body');
			$question_type = $this->input->post('question_type');
			$for_survey_id = $this->input->post('for_survey_id');

			$question_data = array(
				
				'question_body' => $question_body,
				'question_type' => $question_type,
				'survey_id' 	=> $for_survey_id
			);

			$this->UserQuestions->add_question($question_data);

			redirect('questions/view_questions','refresh');
			
		}
	}

	public function add_multiple_choice_question()
	{	
		if ( $this->input->post('add_multiple_choice_question') ) 
		{
			$question_body = $this->input->post('question_body_mc');
			$question_type = 5;
			$for_survey_id = $this->input->post('for_survey_id_mc');
			$choice_1 = $this->input->post('choice_1');
			$choice_2 = $this->input->post('choice_2');
			
			$choice_3 = $this->input->post('choice_3');
			$choice_4 = $this->input->post('choice_4');
			$choice_5 = $this->input->post('choice_5');

			
			if (!empty($choice_3) && !empty($choice_4) && !empty($choice_5)) {
				$question_data = array(
					
					'question_body' => $question_body,
					'question_type' => $question_type,
					'survey_id' 	=> $for_survey_id,
					'choice_1'		=> $choice_1,
					'choice_2'		=> $choice_2,
					'choice_3'		=> $choice_3,
					'choice_4'		=> $choice_4,
					'choice_5'		=> $choice_5
				);
			} elseif (!empty($choice_3) && !empty($choice_4) && empty($choice_5)) {
				$question_data = array(
					
					'question_body' => $question_body,
					'question_type' => $question_type,
					'survey_id' 	=> $for_survey_id,
					'choice_1'		=> $choice_1,
					'choice_2'		=> $choice_2,
					'choice_3'		=> $choice_3,
					'choice_4'		=> $choice_4
				);
			} elseif (!empty($choice_3) && empty($choice_4) && empty($choice_5)) {
				$question_data = array(
					
					'question_body' => $question_body,
					'question_type' => $question_type,
					'survey_id' 	=> $for_survey_id,
					'choice_1'		=> $choice_1,
					'choice_2'		=> $choice_2,
					'choice_3'		=> $choice_3,
				);
			} else {
				$question_data = array(
					
					'question_body' => $question_body,
					'question_type' => $question_type,
					'survey_id' 	=> $for_survey_id,
					'choice_1'		=> $choice_1,
					'choice_2'		=> $choice_2
				);
			}

			$this->UserQuestions->add_question($question_data);

			redirect('questions/view_questions','refresh');
			
		}
	}

	public function update_question( $question_id )
	{
		$this->load->view('dash/update_question', $question_id);
	}

	public function update_process_questions( $question_id )
	{
		if ( $this->input->post('update_question') ) 
		{
			$question_name = $this->input->post('question_name');
			$question_details = array( 
				'question_body'	=> $question_name
			);
			$this->db->where('question_id', $question_id);
			$this->db->update('questions', $question_details);
			redirect('questions/view_questions','refresh');
		}
	}

	public function delete_question( $question_id )
	{
		$this->db->where('question_id', $question_id);
		$this->db->delete('questions');
		redirect('questions/view_questions','refresh');
	}

}

