<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Responses extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
	}

	public function index()
	{
		$this->load->view('dash/view_responses');
	}

	public function view_responses()
	{
        $question_id = $this->input->post('for_question_id');
        $this->load->view('dash/view_responses_for', 'refresh');

        
    }
    
    
    public function view_responses_for()
	{
        $question_id = $this->input->post('for_question_id');
		$this->load->view('dash/view_responses_for', 'refresh');
	}

	public function exportCSV(){
		
		// assign the session variable for which user is logged in
		$u_id = $_SESSION['u_id'];
		
		// get the data from the database and put into a list using 2 joins in sql query
		$surveyList = $this->db->select('questions.question_id, questions.question_body, responses.response_body, responses.participant_id, responses.response_date, surveys.survey_id')
		->from('responses')
		->join('questions','responses.question_id = questions.question_id')
		->join('surveys','questions.survey_id = surveys.survey_id')
		->where('surveys.user_id',$u_id)
		->get();

		// create a file name 
		$filename = 'my_survey_data_'.date('Ymd').'.csv';
		header("Content-Description: File Transfer");
		header("Content-Disposition: attachment; filename=$filename");
		header("Content-Type: application/csv; ");
   
		// file creation
		$fp = fopen('php://output', 'w');
   		$header = array("question_id","question_body", "response_body","participant_id", "response_date", "survey_id");
		fputcsv($fp, $header);

		//put each row into the csv file
		foreach ($surveyList->result() as $line){
			fputcsv($fp,array($line->question_id,$line->question_body,$line->response_body,$line->participant_id,$line->response_date,$line->survey_id));
		}
		//close file
		fclose($fp);
		exit();
		
		// go back to responses page and refresh
		$this->load->view('dash/view_responses', 'refresh');
	}

	    

}