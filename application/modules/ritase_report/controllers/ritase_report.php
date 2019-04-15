<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Ritase_report extends MX_Controller
{

    function __construct()
    {
        parent::__construct();
        
        $this->load->model('ritase_report_model');
        $this->load->library('pdf_generator');
    }

    function index()
    {
        $this->load->module('layouts');
        $this->load->library('template');
        $this->template->title(lang('ritase_report') . ' - ' . $this->config->item('website_name') .
            ' ' . $this->config->item('version'));
        $data['page'] = lang('ritase_report');
        $this->session->set_userdata('page_header', 'reports');
        $this->session->set_userdata('page_detail', 'ritase_report');
        $data['datatables'] = true;
        $data['form'] = true;

        $data['vehicles'] = $this->ritase_report_model->get_data_vehicle();

        $this->template->set_layout('users')->build('ritase_reports', isset($data) ? $data : null);
    }
    
    function print_report(){
        if($this->input->post('start_date') != ''){
            $start_date = date('Y-m-d',strtotime($this->input->post('start_date')));
            $end_date = date('Y-m-d',strtotime($this->input->post('end_date')));
            $vehicle_rowID = $this->input->post('vehicle_rowID');
            $print_type = $this->input->post('print_type');
                  
            $data['start_date'] = $start_date;
            $data['end_date'] = $end_date;
            $data['str_start_date'] = date('d-m-Y',strtotime($start_date));
            $data['str_end_date'] = date('d-m-Y',strtotime($end_date));
            
            if($vehicle_rowID == 'all'){
                $data['police_no'] = 'ALL';
                
                if($print_type == 'pdf'){
                    $html = $this->load->view('all_ritase_report_pdf', $data, true);
                    $this->pdf_generator->generate($html, lang('ritase_report').' pdf',$orientation='Portrait');
                }
                else{
                    header("Content-type: application/octet-stream");
                    header("Content-Disposition: attachment; filename=all_ritase_report.xls");
                    
                    $this->load->view("all_ritase_report_pdf", $data);
                }
            }
            else{
                $get_departement = $this->ritase_report_model->get_data_by_row_id('sa_vehicle',$vehicle_rowID);
                $data['police_no'] = $get_departement->police_no;
                $str_vehicle_rowID = "AND `a`.`vehicle_rowID` = ".$vehicle_rowID;
                
                $str_between = "AND `c`.`until_date` BETWEEN '".$start_date."' and '".$end_date."'";
                
                $sql = "SELECT `b`.`commission_no`, `c`.`until_date`, `c`.`period`, `a`.`vehicle_rowID`, `a`.`deleted`, `b`.`deleted`, `c`.`deleted`, COUNT(`b`.`commission_no`) as total_ritase
                        FROM (`cb_cash_adv` as a)
                            LEFT JOIN `tr_do_trx` as b ON `a`.`trx_no` = `b`.`trx_no` 
                            LEFT JOIN `tr_commission_trx` as c ON `b`.`commission_no` = `c`.`commission_no` 
                        GROUP BY `b`.`commission_no`, `c`.`until_date`, `c`.`period`, `a`.`vehicle_rowID`, `a`.`deleted`, `b`.`deleted`, `c`.`deleted`
                        HAVING `a`.`deleted` = 0 AND `b`.`deleted` = 0 AND `c`.`deleted` = 0 ".$str_vehicle_rowID." ".$str_between."
                        ORDER BY b.commission_no, `c`.`until_date`, `c`.`period`";
                
                $data['ritase_lists'] = $this->db->query($sql)->result();

                if($print_type == 'pdf'){
                    $html = $this->load->view('ritase_report_pdf', $data, true);
                    $this->pdf_generator->generate($html, lang('ritase_report').' pdf',$orientation='Portrait');
                }
                else{
                    header("Content-type: application/octet-stream");
                    header("Content-Disposition: attachment; filename=ritase_report.xls");
                    
                    $this->load->view("ritase_report_pdf", $data);
                }
            }
        }
        else{
            redirect(base_url('ritase_report'));
        }
        
    }
    
}

/* End of file contacts.php */
