<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Invoice_type extends MX_Controller {

	function __construct()
	{
		parent::__construct();
		
		$this->load->model('invoice_type_model');
	}

	function index()
	{
		$this->load->module('layouts');
		$this->load->library('template');
		$this->template->title(lang('invoice_types').' - '.$this->config->item('website_name'). ' '. $this->config->item('version'));
		$data['page'] = lang('invoice_types');
		$this->session->set_userdata('page_header', 'master');		
		$this->session->set_userdata('page_detail', 'invoice_types');
		$data['datatables'] = TRUE;
		$data['form'] = TRUE;
		$data['invoice_types'] = $this->invoice_type_model->get_all_records($table = 'sa_invoice_type', $array = array(
			'rowID >' => 0, 'deleted' => 0), $join_table = '', $join_criteria = '','inv_type_cd','asc');
			
		$this->template
		->set_layout('users')
		->build('invoice_types',isset($data) ? $data : NULL);
	}
	
	
	function create()
	{
		if ($this->input->post()) {
				$this->load->library('form_validation');
				$this->form_validation->set_error_delimiters('<span style="color:red">', '</span><br>');
				$this->form_validation->set_rules('invoice_type_code', 'Code', 'required|xss_clean|is_unique[sa_invoice_type.inv_type_cd]');
				$this->form_validation->set_rules('invoice_type_name', 'Name', 'required|xss_clean');
										
				if ($this->form_validation->run() == FALSE)
				{
					$this->session->set_flashdata('response_status', 'error');
					$this->session->set_flashdata('message', lang('error_in_form'));
					$_POST = '';
					$this->index();
				}else{		
					$data_invoice_type = array(
							'inv_type_cd'=>$this->input->post('invoice_type_code'),
							'inv_type_name'=>strtoupper($this->input->post('invoice_type_name')),
							'user_created'=>$this->session->userdata('user_id'),
							'date_created'=>date('Y-m-d'),
							'time_created'=>date('H:i:s')							
			         );
					$this->db->insert('sa_invoice_type', $data_invoice_type); 
					$invoice_type_id = $this->db->insert_id();

					$params['user_rowID'] = $this->tank_auth->get_user_id();
					$params['module'] = 'invoice_types';
					$params['module_field_id'] = $invoice_type_id;
					$params['activity'] = ucfirst('Added a new Invoice Type '.$this->input->post('invoice_type_name'));
					$params['icon'] = 'fa-user';
					modules::run('activitylog/log',$params); //log activity

					$this->session->set_flashdata('response_status', 'success');
					$this->session->set_flashdata('message', lang('invoice_type_registered_successfully'));
					redirect('invoice_type');
				}
		}else{
			$this->session->set_flashdata('response_status', 'error');
			$this->session->set_flashdata('message', lang('error_in_form'));
			redirect('invoice_type');
		}
	}

}

/* End of file contacts.php */