<?php

class MemoApp {
	
	public function __construct() {
		//$this->log = $GLOBALS['log'];

		define('THUMBNAIL_IMAGE_MAX_WIDTH', 150);
		define('THUMBNAIL_IMAGE_MAX_HEIGHT', 150);

		define('IOS_APP_VERSION', '1.0.7');
		define('ANDROID_APP_VERSION', '1.0.7');
		define('VERSION_CODE_IOS', 2);
		define('VERSION_CODE_ANDROID', 8);
		//define('LINK_DOWNLOAD', 'http://onlineoffice.shinee.com/application/demo/memo.html'); //demo
		define('LINK_DOWNLOAD', 'http://onlineoffice.shinee.com/application/production/memo.html'); //production
	}
	
    public function handler($post , $file) {
		//$this->log->info('Service', 'handler', 'input data', func_get_args());
		//$return = 'Invalid command';
		//$data = json_decode($message, TRUE);
    	
		$data = $post;
		$data_file = $file;
		$json_return = new stdClass();

		if(!(isset($data['command']))){
			$json_return->command = '0000';
			$json_return->message = 'Please enter your command.';
			$return = $json_return;
		}
		else{
			switch ($data['command']) {
	            case '0100': 
	            	if(!(isset($data['username'])) || !(isset($data['password'])) || !(isset($data['device_token'])) || !(isset($data['push_token'])) || !(isset($data['device_type']))){ 
						$json_return->command = '0101';
						$json_return->message = 'Params are missing.';
						$return = $json_return;
					}
					else{
						$return = $this->login($data);
					}
					break;
				case '0200':
					if(!(isset($data['username'])) || !(isset($data['device_token']))){
						$json_return->command = '0201';
						$json_return->message = 'Params are missing.';
						$return = $json_return;
					}
					else{
						$return = $this->logout($data);
					}
					break;
				case '0300':
					if(!(isset($data['email']))){
						$json_return->command = '0301';
						$json_return->message = 'Params are missing.';
						$return = $json_return;
					}
					else{
						$return = $this->forgot_password($data);
					}
					break;
				case '0400':
					if(!(isset($data['otp_code'])) || !(isset($data['otp_email']))){
						$json_return->command = '0401';
						$json_return->message = 'Params are missing.';
						$return = $json_return;
					}
					else{
						$return = $this->check_otp_forgot_password($data);
					}
					break;
				case '0500':
					if(!(isset($data['username']))){
						$json_return->command = '0501';
						$json_return->message = 'Params are missing.';
						$return = $json_return;
					}
					else{
						$return = $this->set_log_out($data);
					}
					break;
				case '0600':
					if(!(isset($data['email'])) || !(isset($data['password']))){
						$json_return->command = '0601';
						$json_return->message = 'Params are missing.';
						$return = $json_return;
					}
					else{
						$return = $this->change_password_by_forgot_password($data);
					}
					break;
				case '0700':
					if(!(isset($data['username'])) || !(isset($data['password']))){
						$json_return->command = '0701';
						$json_return->message = 'Params are missing.';
						$return = $json_return;
					}
					else{
						$return = $this->check_account($data);
					}
					break;
				case '0800':
	            	if(!(isset($data['company_id'])) || !(isset($data['employee_id']))){
						$json_return->command = '0801';
						$json_return->message = 'Params are missing.';
						$return = $json_return;
					}
					else{
						$return = $this->get_employee_info($data);
					}
					break;
				case '0900':
					if(!(isset($data['company_id'])) || !(isset($data['employee_id']))){
						$json_return->command = '0901';
						$json_return->message = 'Params are missing.';
						$return = $json_return;
					}
					else{
						$return = $this->get_division_list($data);
					}
					break;
				case '1000':
					if(!(isset($data['company_id'])) || !(isset($data['division_id']))){
						$json_return->command = '1001';
						$json_return->message = 'Params are missing.';
						$return = $json_return;
					}
					else{
						$return = $this->get_department_list($data);
					}
					break;
				case '1100':
					if(!(isset($data['company_id'])) || !(isset($data['department_id']))){
						$json_return->command = '1101';
						$json_return->message = 'Params are missing.';
						$return = $json_return;
					}
					else{
						$return = $this->get_section_list($data);
					}
					break;
				case '1200':
					if(!(isset($data['company_id'])) || !(isset($data['employee_code']))){
						$json_return->command = '1201';
						$json_return->message = 'Params are missing.';
						$return = $json_return;
					}
					else{
						$return = $this->get_my_profile($data);
					}
					break;
				case '1300':
					if(!(isset($data['company_id'])) || !(isset($data['employee_id']))){
						$json_return->command = '1301';
						$json_return->message = 'Params are missing.';
						$return = $json_return;
					}
					else{
						$return = $this->get_draft_list($data);
					}
					break;
				case '1400':
					if(!(isset($data['company_id'])) || !(isset($data['year']))){
						$json_return->command = '1401';
						$json_return->message = 'Params are missing.';
						$return = $json_return;
					}
					else{
						$return = $this->get_summary_memo_report($data);
					}
					break;
				case '1500':
					if(!(isset($data['company_id']))){
						$json_return->command = '1501';
						$json_return->message = 'Params are missing.';
						$return = $json_return;
					}
					else{
						$return = $this->get_form_list($data);
					}
					break;
				case '1600':
					if(!(isset($data['company_id'])) || !(isset($data['memo_type_id'])) || !(isset($data['division_id'])) || !(isset($data['department_id'])) || !(isset($data['section_id']))){
						$json_return->command = '1601';
						$json_return->message = 'Params are missing.';
						$return = $json_return;
					}
					else{
						$return = $this->get_memo_no_list($data);
					}
					break;
				case '1700':
					if(!(isset($data['company_id'])) || !(isset($data['memo_type_id']))){
						$json_return->command = '1701';
						$json_return->message = 'Params are missing.';
						$return = $json_return;
					}
					else{
						$return = $this->get_prelist_list($data);
					}
					break;
				case '1800':
					if(!(isset($data['company_id'])) || !(isset($data['form_id']))){
						$json_return->command = '1801';
						$json_return->message = 'Params are missing.';
						$return = $json_return;
					}
					else{
						$return = $this->get_memo_type_list($data);
					}
					break;
				case '1900':
					$return = $this->get_year_list();
					break;
				case '2000':
					if(!(isset($data['company_id'])) || !(isset($data['employee_id'])) || !(isset($data['memo_type_id'])) || !(isset($data['prelist_id']))){
						$json_return->command = '2001';
						$json_return->message = 'Params are missing.';
						$return = $json_return;
					}
					else{
						$return = $this->get_approver_list($data);
					}
					break;
				case '2100':
					if(!(isset($data['company_id'])) || !(isset($data['employee_id']))  || !(isset($data['prelist_id']))){
						$json_return->command = '2101';
						$json_return->message = 'Params are missing.';
						$return = $json_return;
					}
					else{
						$return = $this->get_employee_list($data);
					}
					break;
				case '2200':
					if(!(isset($data['company_id'])) || !(isset($data['employee_id'])) || !(isset($data['memo_id'])) || !(isset($data['memo_form_id'])) || !(isset($data['notice_type'])) || !(isset($data['memo_no_id'])) || !(isset($data['prelist_id'])) || !(isset($data['prelist_name'])) || !(isset($data['memo_type'])) || !(isset($data['memo_amount'])) || !(isset($data['memo_budget'])) || !(isset($data['to_employee'])) || !(isset($data['concurred_employee'])) || !(isset($data['cc_employee'])) || !(isset($data['memo_detail']))){
						$json_return->command = '2201';
						$json_return->message = 'Params are missing.';
						$return = $json_return;
					}
					else{
						$return = $this->save_draft_memo($data , $file);
					}
					break;
				case '2300':
					if(!(isset($data['company_id'])) || !(isset($data['employee_id'])) || !(isset($data['memo_form_id'])) || !(isset($data['notice_type'])) || !(isset($data['memo_no_id'])) || !(isset($data['prelist_id'])) || !(isset($data['prelist_name'])) || !(isset($data['memo_type'])) || !(isset($data['memo_amount'])) || !(isset($data['memo_budget'])) || !(isset($data['to_employee'])) || !(isset($data['concurred_employee'])) || !(isset($data['cc_employee'])) || !(isset($data['memo_detail']))){
						$json_return->command = '2301';
						$json_return->message = 'Params are missing.';
						$return = $json_return;
					}
					else{
						$return = $this->insert_memo($data , $file);
					}
					break;
				case '2400':
					if(!(isset($data['company_id'])) || !(isset($data['employee_id'])) || !(isset($data['memo_id'])) || !(isset($data['memo_form_id'])) || !(isset($data['notice_type'])) || !(isset($data['prelist_id'])) || !(isset($data['prelist_name'])) || !(isset($data['memo_type'])) || !(isset($data['memo_amount'])) || !(isset($data['memo_budget'])) || !(isset($data['to_employee'])) || !(isset($data['concurred_employee'])) || !(isset($data['cc_employee'])) || !(isset($data['memo_detail'])) || !(isset($data['is_revise']))){
						$json_return->command = '2401';
						$json_return->message = 'Params are missing.';
						$return = $json_return;
					}
					else{
						$return = $this->update_memo($data , $file);
					}
					break;
				case '2500':
					if(!(isset($data['company_id'])) || !(isset($data['employee_id'])) || !(isset($data['memo_id'])) || !(isset($data['memo_form_id'])) || !(isset($data['notice_type'])) || !(isset($data['memo_no_id'])) || !(isset($data['prelist_id'])) || !(isset($data['prelist_name'])) || !(isset($data['memo_type'])) || !(isset($data['memo_amount'])) || !(isset($data['memo_budget'])) || !(isset($data['to_employee'])) || !(isset($data['concurred_employee'])) || !(isset($data['cc_employee'])) || !(isset($data['memo_detail']))){
						$json_return->command = '2501';
						$json_return->message = 'Params are missing.';
						$return = $json_return;
					}
					else{
						$return = $this->insert_memo_from_draft($data , $file);
					}
					break;		
				case '2600':
					if(!(isset($data['company_id'])) || !(isset($data['employee_id'])) || !(isset($data['form_id']))){
						$json_return->command = '2601';
						$json_return->message = 'Params are missing.';
						$return = $json_return;
					}
					else{
						$return = $this->get_favorite_list($data);
					}
					break;
				case '2700':
					if(!(isset($data['company_id'])) || !(isset($data['employee_code'])) || !(isset($data['memo_type_id'])) || !(isset($data['memo_amount']))){
						$json_return->command = '2701';
						$json_return->message = 'Params are missing.';
						$return = $json_return;
					}
					else{
						$return = $this->check_approve_budget($data);
					}
					break;
				case '2800':
					if(!(isset($data['company_id'])) || !(isset($data['employee_id']))){
						$json_return->command = '2801';
						$json_return->message = 'Params are missing.';
						$return = $json_return;
					}
					else{
						$return = $this->get_memo_list($data);
					}
					break;
				case '2900':
					if(!(isset($data['company_id'])) || !(isset($data['employee_code'])) || !(isset($data['memo_id']))){
						$json_return->command = '2901';
						$json_return->message = 'Params are missing.';
						$return = $json_return;
					}
					else{
						$return = $this->get_memo_detail($data);
					}
					break;
				case '3000':
					if(!(isset($data['company_id'])) || !(isset($data['memo_id']))){
						$json_return->command = '3001';
						$json_return->message = 'Params are missing.';
						$return = $json_return;
					}
					else{
						$return = $this->get_memo_history($data);
					}
					break;
				case '3100':			
					$return = $this->get_memo_status_list();
					break;
				case '3200':
					if(!(isset($data['company_id'])) || !(isset($data['employee_id'])) || !(isset($data['memo_id']))){
						$json_return->command = '3201';
						$json_return->message = 'Params are missing.';
						$return = $json_return;
					}
					else{
						$return = $this->favorite_memo($data);
					}
					break;
				case '3300':
					if(!(isset($data['company_id'])) || !(isset($data['memo_id']))){
						$json_return->command = '3301';
						$json_return->message = 'Params are missing.';
						$return = $json_return;
					}
					else{
						$return = $this->resent_memo($data);
					}
					break;
				case '3400':
					if(!(isset($data['company_id'])) || !(isset($data['memo_id']))){
						$json_return->command = '3401';
						$json_return->message = 'Params are missing.';
						$return = $json_return;
					}
					else{
						$return = $this->export_memo($data);
					}
					break;
				case '3500':
					if(!(isset($data['company_id'])) || !(isset($data['memo_id'])) || !(isset($data['memo_comment']))){
						$json_return->command = '3501';
						$json_return->message = 'Params are missing.';
						$return = $json_return;
					}
					else{
						$return = $this->agree_memo($data);
					}
					break;
				case '3600':
					if(!(isset($data['company_id'])) || !(isset($data['memo_id'])) || !(isset($data['memo_comment']))){
						$json_return->command = '3601';
						$json_return->message = 'Params are missing.';
						$return = $json_return;
					}
					else{
						$return = $this->disagree_memo($data);
					}
					break;
				case '3700':
					if(!(isset($data['company_id'])) || !(isset($data['memo_id'])) || !(isset($data['memo_comment']))){
						$json_return->command = '3701';
						$json_return->message = 'Params are missing.';
						$return = $json_return;
					}
					else{
						$return = $this->approve_memo($data);
					}
					break;
				case '3800':
					if(!(isset($data['company_id'])) || !(isset($data['memo_id'])) || !(isset($data['memo_comment']))){
						$json_return->command = '3801';
						$json_return->message = 'Params are missing.';
						$return = $json_return;
					}
					else{
						$return = $this->disapprove_memo($data);
					}
					break;
				case '3900':
					if(!(isset($data['company_id'])) || !(isset($data['employee_id'])) || !(isset($data['memo_id'])) || !(isset($data['memo_comment'])) || !(isset($data['memo_status_id']))){
						$json_return->command = '3901';
						$json_return->message = 'Params are missing.';
						$return = $json_return;
					}
					else{
						$return = $this->terminate_memo($data);
					}
					break;
				case '4000':
					if(!(isset($data['company_id'])) || !(isset($data['employee_id']))){
						$json_return->command = '4001';
						$json_return->message = 'Params are missing.';
						$return = $json_return;
					}
					else{
						$return = $this->update_profile_image($data , $data_file);
					}
					break;
				case '4100':
					if(!(isset($data['company_id'])) || !(isset($data['memo_id'])) || !(isset($data['memo_attach_file_id'])) || !(isset($data['memo_attach_file_name']))){
						$json_return->command = '4101';
						$json_return->message = 'Params are missing.';
						$return = $json_return;
					}
					else{
						$return = $this->delete_attach_file($data);
					}
					break;
				case '4200':
					if(!(isset($data['company_id'])) || !(isset($data['employee_code'])) || !(isset($data['notice_type_id'])) || !(isset($data['notice_status']))){
						$json_return->command = '4201';
						$json_return->message = 'Params are missing.';
						$return = $json_return;
					}
					else{
						$return = $this->set_memo_notice($data);
					}
					break;
				


				case '5000':
					if(!(isset($data['advance_form_type']))){
						$json_return->command = '5001';
						$json_return->message = 'Params are missing.';
						$return = $json_return;
					}
					else{
						$return = $this->get_sub_type_list($data);
					}
					break;
				case '5100':
					if(!(isset($data['company_id'])) || !(isset($data['employee_id'])) || !(isset($data['withdrawal_emp_id'])) || !(isset($data['paid_date'])) || !(isset($data['done_date'])) || !(isset($data['total_amount'])) || !(isset($data['advance_detail']))){
						$json_return->command = '5101';
						$json_return->message = 'Params are missing.';
						$return = $json_return;
					}
					else{
						$return = $this->insert_advance_form($data);
					}
					break;
				case '5200':
					if(!(isset($data['company_id'])) || !(isset($data['employee_id'])) || !(isset($data['withdrawal_emp_id'])) || !(isset($data['total_amount'])) || !(isset($data['amount'])) || !(isset($data['use'])) || !(isset($data['return'])) || !(isset($data['over'])) || !(isset($data['advance_form_type'])) || !(isset($data['advance_detail'])) || !(isset($data['total_file']))){
						$json_return->command = '5201';
						$json_return->message = 'Params are missing.';
						$return = $json_return;
					}
					else{
						$return = $this->insert_reimbursement_form($data , $file);
					}
					break;
				case '5300':
					if(!(isset($data['company_id'])) || !(isset($data['employee_id'])) || !(isset($data['advance_form_id'])) || !(isset($data['advance_no'])) || !(isset($data['withdrawal_emp_id'])) || !(isset($data['total_amount'])) || !(isset($data['amount'])) || !(isset($data['use'])) || !(isset($data['return'])) || !(isset($data['over'])) || !(isset($data['advance_form_type'])) || !(isset($data['advance_detail'])) || !(isset($data['total_file']))){
						$json_return->command = '5301';
						$json_return->message = 'Params are missing.';
						$return = $json_return;
					}
					else{
						$return = $this->update_reimbursement_form($data , $file);
					}
					break;
				case '5400':
					if(!(isset($data['company_id'])) || !(isset($data['advance_form_id']))){
						$json_return->command = '5401';
						$json_return->message = 'Params are missing.';
						$return = $json_return;
					}
					else{
						$return = $this->get_reimbursement_form_detail($data , $file);
					}
					break;
				case '5500':
					if(!(isset($data['company_id'])) || !(isset($data['employee_id'])) || !(isset($data['advance_form_id'])) || !(isset($data['advance_status_id'])) || !(isset($data['use'])) || !(isset($data['return'])) || !(isset($data['over'])) || !(isset($data['comment']))){
						$json_return->command = '5501';
						$json_return->message = 'Params are missing.';
						$return = $json_return;
					}
					else{
						$return = $this->confirm_payment($data , $file);
					}
					break;
				case '5600':
					if(!(isset($data['company_id'])) || !(isset($data['employee_id']))){
						$json_return->command = '5601';
						$json_return->message = 'Params are missing.';
						$return = $json_return;
					}
					else{
						$return = $this->get_cashier_list($data);
					}
					break;
				case '5700':
					if(!(isset($data['company_id'])) || !(isset($data['memo_id']))){
						$json_return->command = '5701';
						$json_return->message = 'Params are missing.';
						$return = $json_return;
					}
					else{
						$return = $this->get_cashier_detail($data);
					}
					break;
				case '5800':
					if(!(isset($data['advance_form_id']))){
						$json_return->command = '5801';
						$json_return->message = 'Params are missing.';
						$return = $json_return;
					}
					else{
						$return = $this->get_cashier_history($data);
					}
					break;

				case '6000':
					if(!(isset($data['company_id'])) || !(isset($data['employee_id']))){
						$json_return->command = '6001';
						$json_return->message = 'Params are missing.';
						$return = $json_return;
					}
					else{
						$return = $this->get_cash_advance_list($data);
					}
					break;
				case '6100':
					if(!(isset($data['company_id'])) || !(isset($data['memo_id']))){
						$json_return->command = '6101';
						$json_return->message = 'Params are missing.';
						$return = $json_return;
					}
					else{
						$return = $this->get_cash_advance_detail($data);
					}
					break;
				case '6200':
					if(!(isset($data['company_id'])) || !(isset($data['memo_id']))){
						$json_return->command = '6101';
						$json_return->message = 'Params are missing.';
						$return = $json_return;
					}
					else{
						$return = $this->get_cash_advance_paid_detail($data);
					}
					break;

					
				


				case '6300':			
					$return = $this->get_advance_status_list();
					break;
				case '6400':
					if(!(isset($data['company_id']))){
						$json_return->command = '6401';
						$json_return->message = 'Params are missing.';
						$return = $json_return;
					}
					else{
						$return = $this->get_accounting_list($data);
					}
					break;
				case '6900':
					if(!(isset($data['company_id'])) || !(isset($data['year']))){
						$json_return->command = '6901';
						$json_return->message = 'Params are missing.';
						$return = $json_return;
					}
					else{
						$return = $this->get_summary_advance_report($data);
					}
					break;
				case '7000':
					if(!(isset($data['employee_id']))){
						$json_return->command = '7001';
						$json_return->message = 'Params are missing.';
						$return = $json_return;
					}
					else{
						$return = $this->set_read_notice($data);
					}
					break;
				case '7100':
					if(!(isset($data['memo_form_id']))){
						$json_return->command = '7101';
						$json_return->message = 'Params are missing.';
						$return = $json_return;
					}
					else{
						$return = $this->get_example_memo_detail($data);
					}
					break;
				case '8000':
					$return = $this->get_app_version();
					break;

				/*
				case '9000':
					$return = $this->check_get_emp_info();
					break;
				*/
					
					
				/*
				case '9900':
					$return = $this->aaa($data , $data_file);
					break;
				*/

				default: 
					$json_return->command = '0001';
					$json_return->message = 'Command not found.';
					$return = $json_return;
					break;
			}
		}
		return $return;
	}

	/*-----Memo Module-----*/
    //0100 -- OK //edit api doc
	public function login($params) {
		$json_obj = new stdClass();
		$obj_global = new GlobalConstant();		
		$obj_log = new LogFile();		
		$save_data_log = $_SERVER["HTTP_HOST"].$_SERVER["PHP_SELF"];

		$obj_class = new Connectdb($obj_global->getHOST_CMS(), $obj_global->getUSER_CMS() , $obj_global->getPWD_CMS(), "employee",0,FALSE);
		$obj_class_2 = new Connectdb($obj_global->getHOST_CMS(), $obj_global->getUSER_CMS() , $obj_global->getPWD_CMS(), "memo",0,FALSE);
		$obj_class_3 = new Connectdb($obj_global->getHOST_CMS(), $obj_global->getUSER_CMS() , $obj_global->getPWD_CMS(), "employee",0,FALSE);
		$obj_class_4 = new Connectdb($obj_global->getHOST_CMS(), $obj_global->getUSER_CMS() , $obj_global->getPWD_CMS(), "employee",0,FALSE);
		$obj_class_5 = new Connectdb($obj_global->getHOST_CMS(), $obj_global->getUSER_CMS() , $obj_global->getPWD_CMS(), "employee",0,FALSE);
		$obj_class_6 = new Connectdb($obj_global->getHOST_CMS(), $obj_global->getUSER_CMS() , $obj_global->getPWD_CMS(), "employee",0,FALSE);
		$obj_class_7 = new Connectdb($obj_global->getHOST_CMS(), $obj_global->getUSER_CMS() , $obj_global->getPWD_CMS(), "employee",0,FALSE);
		$obj_class_8 = new Connectdb($obj_global->getHOST_CMS(), $obj_global->getUSER_CMS() , $obj_global->getPWD_CMS(), "employee",0,FALSE);
		$obj_class_9 = new Connectdb($obj_global->getHOST_CMS(), $obj_global->getUSER_CMS() , $obj_global->getPWD_CMS(), "memo",0,FALSE);
		$obj_class_10 = new Connectdb($obj_global->getHOST_CMS(), $obj_global->getUSER_CMS() , $obj_global->getPWD_CMS(), "memo",0,FALSE);

		//$params['username']
		//$params['password']
		//$params['device_token']
		//$params['push_token']
		//$params['device_type']
		
		$s_sql = "SELECT * from employee e LEFT JOIN company c ON e.com_id_pk = c.com_id_pk WHERE e.emp_username = '".$params['username']."' AND e.emp_password = '".md5($params['password'])."' ";
		$b_resp = $obj_class->selectproc($s_sql);
		$datas = array();
		$company_info = new stdClass();

		if($b_resp && $obj_class->n_row>0) {
			if(($obj_class->getitem("com_status") == 1) && ($obj_class->getitem("emp_status") == 1)){ //check company status and employee status

				$com_id = $obj_class->getitem("com_id_pk");
				$emp_id = $obj_class->getitem("emp_id_pk");
				$advance_no_fornamt = 'A'.date("Y").'/xxxxx';


				if($_SERVER['HTTP_HOST'] == 'localhost'){
					$com_logo_path = "http://localhost/var_www/verkplus/";
					$com_doc_logo_path = "http://localhost/var_www/verkplus/";
				}
				else{
					if($_SERVER['HTTP_HOST'] == '58.137.222.81'){
						//58.137.222.81
						$com_logo_path = "http://".$_SERVER['HTTP_HOST']."/var_www/verkplus/";
						$com_doc_logo_path = "http://".$_SERVER['HTTP_HOST']."/var_www/verkplus/";
					}
					else{
						//58.137.160.130
						$com_logo_path = "http://".$_SERVER['HTTP_HOST']."/";
						$com_doc_logo_path = "http://".$_SERVER['HTTP_HOST']."/";
					}
				}


				$company_info->com_name = $obj_class->getitem("com_name");
				$company_info->com_logo = $com_logo_path.$obj_class->getitem("com_logo");
				$company_info->com_doc_logo = ($com_doc_logo_path.$obj_class->getitem("com_doc_logo"))?$com_doc_logo_path.$obj_class->getitem("com_doc_logo"):$com_logo_path.$obj_class->getitem("com_logo");
				$company_info->com_memo_noti = $obj_class->getitem("com_memo_noti");

				$buy_advance = $this->check_buy_advance($com_id);

				if($buy_advance){
					$s_sql_00 = "SELECT * from advance_NO WHERE com_id_pk = ".$com_id." AND avn_end_date > NOW() ";
					$b_resp_00 = $obj_class_9->selectproc($s_sql_00);

					if($b_resp_00 && $obj_class_9->n_row>0) {	
						$advance_no_fornamt = $obj_class_9->getitem("avn_key_name").$obj_class_9->getitem("avn_year").'/xxxxx';
					}
				}
				//$buy_advance = false;

				//setting first use in memo
				$s_sql_03 = "SELECT * from employee WHERE com_id_pk = ".$com_id." AND emp_status = 1 ";
				$b_resp_03 = $obj_class_3->selectproc($s_sql_03);
				$n_row_3 = $obj_class_3->n_row;

				if($b_resp_03 && $obj_class_3->n_row>0) {
					for($i=0;$i<$obj_class_3->n_row;$i++){	
						$s_sql_06 = "SELECT * from map_emp_module WHERE memd_module = 'memo' AND emp_ID = '".$obj_class_3->getitem("emp_ID")."' AND com_id_pk = ".$com_id." ";
						$b_resp_06 = $obj_class_6->selectproc($s_sql_06);

						if($obj_class_6->n_row == 0){
							//insert employee to table map_emp_module
							$s_sql_04 = "INSERT INTO map_emp_module ";
							$s_sql_04.= "(emp_id_pk , emp_ID , memd_device_token , memd_gcm_token , memd_device_type , memd_module , memd_created_date , memd_modified_date , com_id_pk , memd_flag) VALUES (".$obj_class_3->getitem("emp_id_pk")." , '".$obj_class_3->getitem("emp_ID")."' , NULL , NULL , NULL , 'memo' , NOW() , NOW() , ".$com_id." , 1)";
							$b_flag_04 = $obj_class_4->manageproc($s_sql_04);

						    
						    $s_sql_05 = "INSERT INTO map_emp_notification (emp_ID , men_module , men_noti_type ";
							$s_sql_05.= ", men_created_date , men_modified_date , men_status , com_id_pk) VALUES ";
							$s_sql_05.= "('".$obj_class_3->getitem("emp_ID")."' , 'memo' , 1 , NOW() , NOW() , 0 , ".$com_id.") ";
							$s_sql_05.= ", ('".$obj_class_3->getitem("emp_ID")."' , 'memo' , 2 , NOW() , NOW() , 1 , ".$com_id.") ";
							$s_sql_05.= ", ('".$obj_class_3->getitem("emp_ID")."' , 'memo' , 3 , NOW() , NOW() , 1 , ".$com_id.") ";
							$b_flag_05 = $obj_class_5->manageproc($s_sql_05);
						}

						$obj_class_3->movenext();
					}
				}

				$emp_info = $this->get_emp_info_by_emp_id($com_id , $emp_id);

				//check online status //1 = online , 0 = offline
				$s_sql_2 = "SELECT * from access_history WHERE emp_ID = '".$emp_info[0]['emp_com_id']."' AND ah_module = 'memo' ORDER BY ah_getdate DESC ";
				$b_resp_2 = $obj_class->selectproc($s_sql_2);

				if ($b_resp && $obj_class->n_row>0) {
					if($obj_class->getitem("ah_type") == 'login'){
						if($obj_class->getitem("ah_device_token") == $params['device_token']){
							$online_status = 0;
						}
						else{
							$online_status = 1;
						}
					}
					else{
						$online_status = 0;
					}
				}
				else{
					$online_status = 0;
				}

				//$online_status = 0;

				if($online_status == 0){
					$level_info = $this->get_level_by_company_id($com_id);
					$emp_menu = array();

					if(sizeof($emp_info[0]) > 1){

						//check accounting authorize
						$is_accounting = $this->check_accounting_authorize($emp_id);

						//check summary memo authorize
						$summary_memo_auth = $this->check_summary_memo_authorize($emp_id);

						//check summary advance authorize
						$summary_advance_auth = $this->check_summary_advance_authorize($emp_id);

						if($_SERVER['HTTP_HOST'] == 'localhost'){
							$path = "http://localhost/var_www/verkplus/sub-verk/memo/EdC/".$com_id."/profile_image/";
							$default_path = "http://localhost/var_www/verkplus/sub-verk/memo/EdC/";
						}
						else{
							if($_SERVER['HTTP_HOST'] == '58.137.222.81'){
								//58.137.222.81
								$path = "http://".$_SERVER['HTTP_HOST']."/var_www/verkplus/sub-verk/memo/EdC/".$com_id."/profile_image/";
								$default_path = "http://".$_SERVER['HTTP_HOST']."/var_www/verkplus/sub-verk/memo/EdC/";
							}
							else{
								//58.137.160.130
								$path = "http://".$_SERVER['HTTP_HOST']."/sub-verk/memo/EdC/".$com_id."/profile_image/";
								$default_path = "http://".$_SERVER['HTTP_HOST']."/sub-verk/memo/EdC/";
							}
						}

						if($emp_info[0]['emp_profile_image']){
							$emp_profile_image = $path.$emp_info[0]['emp_profile_image'];
						}
						else{
							$emp_profile_image = $default_path.'default.jpg';
						}
						
						$datas[0]['emp_id'] = $emp_id;
						$datas[0]['emp_com_id'] = $emp_info[0]['emp_com_id'];
						$datas[0]['emp_name'] = $emp_info[0]['emp_name'];  
						$datas[0]['emp_email'] = $emp_info[0]['emp_email'];  
						$datas[0]['emp_username'] = $emp_info[0]['emp_username'];  
						$datas[0]['emp_start_work_date'] = $emp_info[0]['emp_start_work_date'];  
						$datas[0]['emp_position'] = $emp_info[0]['emp_position'];  
						$datas[0]['emp_pos_initial'] = $emp_info[0]['emp_pos_initial'];  
						$datas[0]['emp_phone'] = $emp_info[0]['emp_phone']; 
						$datas[0]['emp_sex'] = $emp_info[0]['emp_sex'];  
						$datas[0]['emp_level'] = $emp_info[0]['emp_level'];  
						$datas[0]['emp_type_id'] = $emp_info[0]['emp_type_id'];  
						$datas[0]['emp_dv_id'] = $emp_info[0]['emp_dv_id']; 
						$datas[0]['emp_dp_id'] = $emp_info[0]['emp_dp_id']; 
						$datas[0]['emp_st_id'] = $emp_info[0]['emp_st_id']; 
						$datas[0]['emp_company_id'] = $emp_info[0]['emp_company_id']; 
						$datas[0]['emp_status'] = $emp_info[0]['emp_status'];
						$datas[0]['emp_profile_image'] = $emp_profile_image;

						$menu[1]['id'] = 1;
						$menu[1]['name'] = 'My Profile';
						$menu[2]['id'] = 2;
						$menu[2]['name'] = 'Create Memo';
						$menu[3]['id'] = 3;
						$menu[3]['name'] = 'Draft Memo';
						$menu[4]['id'] = 4;
						$menu[4]['name'] = 'Memo Status';	
						$menu[5]['id'] = 5;
						$menu[5]['name'] = 'Cash Advance List';	
						$menu[6]['id'] = 6;
						$menu[6]['name'] = 'Reimbursement Form';	
						$menu[7]['id'] = 7;
						$menu[7]['name'] = 'Cashier';	
						$menu[8]['id'] = 8;
						$menu[8]['name'] = 'Summary Memo';	
						$menu[9]['id'] = 9;
						$menu[9]['name'] = 'Summary Advance';				

						$ceo_level = $level_info[0]['ceo_level'];
						$deputy_ceo_level = ($level_info[0]['ceo_level'] + 1);

						if($emp_info[0]['emp_level'] == $ceo_level){ //ceo
							if($buy_advance){
								$emp_menu[0]['menu_id'] = $menu[1]['id'];
								$emp_menu[0]['menu_name'] = $menu[1]['name'];
								$emp_menu[1]['menu_id'] = $menu[2]['id'];
								$emp_menu[1]['menu_name'] = $menu[2]['name'];
								$emp_menu[2]['menu_id'] = $menu[3]['id'];
								$emp_menu[2]['menu_name'] = $menu[3]['name'];
								$emp_menu[3]['menu_id'] = $menu[4]['id'];
								$emp_menu[3]['menu_name'] = $menu[4]['name'];

								$emp_menu[4]['menu_id'] = $menu[5]['id'];
								$emp_menu[4]['menu_name'] = $menu[5]['name'];
								$emp_menu[5]['menu_id'] = $menu[6]['id'];
								$emp_menu[5]['menu_name'] = $menu[6]['name'];

								//check accounting
								if($is_accounting){
									$emp_menu[6]['menu_id'] = $menu[7]['id'];
									$emp_menu[6]['menu_name'] = $menu[7]['name'];
									$emp_menu[7]['menu_id'] = $menu[8]['id'];
									$emp_menu[7]['menu_name'] = $menu[8]['name'];
									$emp_menu[8]['menu_id'] = $menu[9]['id'];
									$emp_menu[8]['menu_name'] = $menu[9]['name'];
								}
								else{
									$emp_menu[6]['menu_id'] = $menu[8]['id'];
									$emp_menu[6]['menu_name'] = $menu[8]['name'];
									$emp_menu[7]['menu_id'] = $menu[9]['id'];
									$emp_menu[7]['menu_name'] = $menu[9]['name'];
								}
							}
							else{
								$emp_menu[0]['menu_id'] = $menu[1]['id'];
								$emp_menu[0]['menu_name'] = $menu[1]['name'];
								$emp_menu[1]['menu_id'] = $menu[2]['id'];
								$emp_menu[1]['menu_name'] = $menu[2]['name'];
								$emp_menu[2]['menu_id'] = $menu[3]['id'];
								$emp_menu[2]['menu_name'] = $menu[3]['name'];
								$emp_menu[3]['menu_id'] = $menu[4]['id'];
								$emp_menu[3]['menu_name'] = $menu[4]['name'];
								$emp_menu[4]['menu_id'] = $menu[8]['id'];
								$emp_menu[4]['menu_name'] = $menu[8]['name'];
							}
						}
						else{ //employee
							if($buy_advance){
								$emp_menu[0]['menu_id'] = $menu[1]['id'];
								$emp_menu[0]['menu_name'] = $menu[1]['name'];
								$emp_menu[1]['menu_id'] = $menu[2]['id'];
								$emp_menu[1]['menu_name'] = $menu[2]['name'];
								$emp_menu[2]['menu_id'] = $menu[3]['id'];
								$emp_menu[2]['menu_name'] = $menu[3]['name'];
								$emp_menu[3]['menu_id'] = $menu[4]['id'];
								$emp_menu[3]['menu_name'] = $menu[4]['name'];

								$emp_menu[4]['menu_id'] = $menu[5]['id'];
								$emp_menu[4]['menu_name'] = $menu[5]['name'];
								$emp_menu[5]['menu_id'] = $menu[6]['id'];
								$emp_menu[5]['menu_name'] = $menu[6]['name'];

								$x = 5;

								//check accounting
								if($is_accounting){
									$x++;
									$emp_menu[$x]['menu_id'] = $menu[7]['id'];
									$emp_menu[$x]['menu_name'] = $menu[7]['name'];

									if($summary_memo_auth){
										$x++;
										$emp_menu[$x]['menu_id'] = $menu[8]['id'];
										$emp_menu[$x]['menu_name'] = $menu[8]['name'];
									}
									if($summary_advance_auth){
										$x++;
										$emp_menu[$x]['menu_id'] = $menu[9]['id'];
										$emp_menu[$x]['menu_name'] = $menu[9]['name'];
									}
								}
								else{
									if($summary_memo_auth){
										$x++;
										$emp_menu[$x]['menu_id'] = $menu[8]['id'];
										$emp_menu[$x]['menu_name'] = $menu[8]['name'];
									}
									if($summary_advance_auth){
										$x++;
										$emp_menu[$x]['menu_id'] = $menu[9]['id'];
										$emp_menu[$x]['menu_name'] = $menu[9]['name'];
									}
								}
							}
							else{
								$emp_menu[0]['menu_id'] = $menu[1]['id'];
								$emp_menu[0]['menu_name'] = $menu[1]['name'];
								$emp_menu[1]['menu_id'] = $menu[2]['id'];
								$emp_menu[1]['menu_name'] = $menu[2]['name'];
								$emp_menu[2]['menu_id'] = $menu[3]['id'];
								$emp_menu[2]['menu_name'] = $menu[3]['name'];
								$emp_menu[3]['menu_id'] = $menu[4]['id'];
								$emp_menu[3]['menu_name'] = $menu[4]['name'];

								$x = 3;

								if($summary_memo_auth){
									$x++;
									$emp_menu[$x]['menu_id'] = $menu[8]['id'];
									$emp_menu[$x]['menu_name'] = $menu[8]['name'];
								}
								if($summary_advance_auth){
									$x++;
									$emp_menu[$x]['menu_id'] = $menu[9]['id'];
									$emp_menu[$x]['menu_name'] = $menu[9]['name'];
								}
							}
						}


						$check_notice = 0;

						$s_sql_11 = "SELECT * , DATE_FORMAT(sp_created_date, '%Y-%m-%d') AS today from summary_profile WHERE com_id_pk = ".$com_id." AND Emp_ID = '".$emp_info[0]['emp_com_id']."' AND sp_status LIKE 'Wait for Agree' ";
						$b_resp_11 = $obj_class_10->selectproc($s_sql_11);
						$datas_11 = array();

						if($b_resp_11 && $obj_class_10->n_row>0){	
							$wfag_total = $obj_class_10->getitem("sp_total");
						}
						else{
							$wfag_total = 0;
						}

						$s_sql_12 = "SELECT * , DATE_FORMAT(sp_created_date, '%Y-%m-%d') AS today from summary_profile WHERE com_id_pk = ".$com_id." AND Emp_ID = '".$emp_info[0]['emp_com_id']."' AND sp_status LIKE 'Wait for Approve' ";
						$b_resp_12 = $obj_class_10->selectproc($s_sql_12);
						$datas_12 = array();

						if($b_resp_12 && $obj_class_10->n_row>0){	
							$wfap_total = $obj_class_10->getitem("sp_total");
						}
						else{
							$wfap_total = 0;
						}

						if(($wfag_total > 0) || ($wfap_total > 0)){
							$check_notice = 1;
						}


						//insert access_history
						$s_sql = "INSERT INTO access_history (emp_ID , ah_module , ah_device_token , ah_getdate , ah_type) VALUES ('".$emp_info[0]['emp_com_id']."' , 'memo' , '".$params['device_token']."' , NOW() , 'login') ";
						$b_flag = $obj_class->manageproc($s_sql);
						$obj_log->savelog($save_data_log,"login -> insert -> access_history","sql=[$s_sql]");

						$params['device_token'] = ($params['device_token'] != '')?$params['device_token']:'null';
						$params['push_token'] = ($params['push_token'] != '')?$params['push_token']:'null';

						if($b_flag){

							$s_sql_2 = "SELECT * from map_emp_module WHERE emp_id_pk = ".$emp_id." AND memd_module LIKE 'memo' ";
							$b_resp_2 = $obj_class->selectproc($s_sql_2);

							if($b_resp_2 && $obj_class->n_row>0){
								//update
								$s_sql_3 = "UPDATE map_emp_module ";
								$s_sql_3.= "SET memd_device_token = '".$params['device_token']."' , memd_gcm_token = '".$params['push_token']."' , memd_device_type = '".$params['device_type']."' , memd_modified_date = NOW() ";
								$s_sql_3.= "WHERE emp_id_pk = '".$emp_id."' AND memd_module LIKE 'memo' ";
								$b_flag_3 = $obj_class->manageproc($s_sql_3);
								$obj_log->savelog($save_data_log,"login -> update -> map_emp_module","sql=[$s_sql_3]");

								if($b_flag_3){
									$json_obj->command = '0100';
									$json_obj->message = 'Login success.';
									$json_obj->data = $datas;
									$json_obj->emp_menu = $emp_menu;
									$json_obj->check_notice = $check_notice;
									$json_obj->advance_no_fornamt = $advance_no_fornamt;
									$json_obj->company_info = $company_info;
								}
								else{
									$json_obj->command = '0109';
									$json_obj->message = 'Login failed - update map_emp_module failed.';
								}
							}
							else{
								//insert
								$s_sql_3 = "INSERT INTO map_emp_module ";
								$s_sql_3.= "(emp_id_pk , emp_ID , memd_device_token , memd_gcm_token , memd_device_type , memd_module , memd_created_date , memd_modified_date , com_id_pk , memd_flag) VALUES (".$emp_id." , '".$emp_info[0]['emp_com_id']."' , '".$params['device_token']."' , '".$params['push_token']."' , '".$params['device_type']."' , 'memo' , NOW() , NOW() , ".$com_id." , 1)";
								$b_flag_3 = $obj_class->manageproc($s_sql_3);
								$obj_log->savelog($save_data_log,"login -> insert -> map_emp_module","sql=[$s_sql_3]");

								if($b_flag_3){
									$s_sql_4 = "INSERT INTO map_emp_notification (emp_ID , men_module , men_noti_type ";
									$s_sql_4.= ", men_created_date , men_modified_date , men_status , com_id_pk) VALUES ";
									$s_sql_4.= "('".$emp_info[0]['emp_com_id']."' , 'memo' , 1 , NOW() , NOW() , 0 , ".$com_id.") ";
									$s_sql_4.= ", ('".$emp_info[0]['emp_com_id']."' , 'memo' , 2 , NOW() , NOW() , 1 , ".$com_id.") ";
									$s_sql_4.= ", ('".$emp_info[0]['emp_com_id']."' , 'memo' , 3 , NOW() , NOW() , 1 , ".$com_id.") ";
									$b_flag_4 = $obj_class->manageproc($s_sql_4);
									$obj_log->savelog($save_data_log,"login -> insert -> map_emp_notification","sql=[$s_sql_4]");

									if($b_flag_4){
										$json_obj->command = '0100';
										$json_obj->message = 'Login success.';
										$json_obj->data = $datas;
										$json_obj->emp_menu = $emp_menu;
										$json_obj->check_notice = $check_notice;
										$json_obj->advance_no_fornamt = $advance_no_fornamt;
										$json_obj->company_info = $company_info;
									}
									else{
										$json_obj->command = '0108';
										$json_obj->message = 'Login failed - insert map_emp_notification failed.';
									}
								}
								else{
									$json_obj->command = '0107';
									$json_obj->message = 'Login failed - insert map_emp_module failed.';
								}
							}
						}
						else{
							$json_obj->command = '0106';
							$json_obj->message = 'Login failed - update data failed.';
						}
						
					}
					else{
						$json_obj->command = '0105';
						$json_obj->message = 'Data is invalid.';
					}
				}
				else{
					$json_obj->command = '0104';
					$json_obj->message = 'Your account is currently being used';
				}
				
			}
			else{
				$json_obj->command = '0103';
				$json_obj->message = 'Your account is inactive.';
			}		
		}
		else {
			$json_obj->command = '0102';
			$json_obj->message = 'Your username or password is invalid.';
		}

		$obj_class->closedb();
		return $json_obj;
    }

    //0200 -- OK
	public function logout($params) {
		$json_obj = new stdClass();
		$obj_global = new GlobalConstant();		
		$obj_log = new LogFile();		
		$save_data_log = $_SERVER["HTTP_HOST"].$_SERVER["PHP_SELF"];

		$obj_class = new Connectdb($obj_global->getHOST_CMS(), $obj_global->getUSER_CMS() , $obj_global->getPWD_CMS(), "employee",0,FALSE);
		$obj_class_2 = new Connectdb($obj_global->getHOST_CMS(), $obj_global->getUSER_CMS() , $obj_global->getPWD_CMS(), "employee",0,FALSE);

		//$params['username']
		//$params['device_token']

		$s_sql = "SELECT * from employee WHERE emp_username = '".$params['username']."' ";
		$b_resp = $obj_class->selectproc($s_sql);
		$datas = array();

		$online_status = 1; //1 = online , 0 = offline

		if($b_resp && $obj_class->n_row>0) {
			$emp_id = $obj_class->getitem("emp_ID");

			//check online status //1 = online , 0 = offline
			$s_sql_2 = "SELECT * from access_history WHERE emp_ID = '".$emp_id."' AND ah_device_token = '".$params['device_token']."' AND ah_module = 'memo' ORDER BY ah_getdate DESC ";
			$b_resp_2 = $obj_class_2->selectproc($s_sql_2);

			if ($b_resp && $obj_class_2->n_row>0) {
				if($obj_class_2->getitem("ah_type") == 'login'){
					$online_status = 1; 
				}
				else{
					$online_status = 0;
				}
			}
			else{
				$online_status = 0;
			}

			if($online_status == 1){
				//insert access_history
				$s_sql_3 = "INSERT INTO access_history (emp_ID , ah_module , ah_device_token , ah_getdate , ah_type) VALUES ('".$emp_id."' , 'memo' , '".$params['device_token']."' , NOW() , 'logout') ";
				$b_flag_3 = $obj_class->manageproc($s_sql_3);
				$obj_log->savelog($save_data_log,"request_leave -> insert -> leave_list","sql=[$s_sql_3]");

				if($b_flag_3){
					//update map_emp_module
					$s_sql_4 = "UPDATE map_emp_module ";
					$s_sql_4.= "SET memd_device_token = NULL , memd_gcm_token = NULL , memd_device_type = NULL , memd_modified_date = NOW() ";
					$s_sql_4.= "WHERE emp_ID = '".$emp_id."' AND memd_module LIKE 'memo' ";
					$b_flag_4 = $obj_class->manageproc($s_sql_4);

					$json_obj->command = '0200';
					$json_obj->message = 'Log out success.';
				}
				else{
					$json_obj->command = '0204';
					$json_obj->message = 'Data not found.';
				}
			}
			else{
				$json_obj->command = '0203';
				$json_obj->message = 'Your account is not login.';
			}
		}
		else{
			$json_obj->command = '0202';
			$json_obj->message = 'Data is invalid.';
		}

		$obj_class->closedb();
		return $json_obj;
    }

    //0300 -- OK
	public function forgot_password($params) {
		$json_obj = new stdClass();
		$obj_global = new GlobalConstant();		
		$obj_log = new LogFile();		
		$save_data_log = $_SERVER["HTTP_HOST"].$_SERVER["PHP_SELF"];

		$obj_class = new Connectdb($obj_global->getHOST_CMS(), $obj_global->getUSER_CMS() , $obj_global->getPWD_CMS(), "employee",0,FALSE);

		//$params['email']

		$s_sql = "SELECT * from employee WHERE emp_email = '".$params['email']."' ";
		$b_resp = $obj_class->selectproc($s_sql);
		$obj_log->savelog($save_data_log,"forgot_password","sql=[$s_sql]");
		$datas = array();

		if ($b_resp && $obj_class->n_row>0) {
			$otp_random = rand(10000,99999);

			$s_sql_2 = "INSERT INTO otp (otp_code , otp_email , otp_status , otp_created_date , otp_modified_date) VALUES (".$otp_random." , '".$params['email']."' , 0 , NOW() , NOW()) ";
			$b_flag_2 = $obj_class->manageproc($s_sql_2);
			$obj_log->savelog($save_data_log,"forgot_password -> insert -> otp","sql=[$s_sql_2]");

			if($b_flag_2){
				$email_from = "verkapp@teleinfomedia.co.th";
				//$email_from = "godlikenokia@gmail.com";
				$email_to = $params['email'];
		    	
				$strTo = $params['email'];
		     	$strSubject = "Your Account information OTP.".date("Y-m-d H:i:s");
		     	$strHeader = "Content-type: text/html; charset=UTF-8\n"; // or  //
		     	$strHeader.= "From: ".$email_from."\n";
		     	$strMessage = "";
		     	$strMessage.= "Hello,  ".$email_to."<br>";
		     	$strMessage.= "OTP  : ".$otp_random."<br>";
		     	$strMessage.= "ใช้รหัส OTP เพื่อขอรหัสผ่านใหม่ <br>";
		     	$strMessage.= "=================================<br>";
		     	$strMessage.= "Best regards,<br>Memo system<br>";

		     	if(mail($strTo,$strSubject,$strMessage,$strHeader)){
		     		$status = true;
		     	}
		     	else{
		     		$status = false;
		     	}

				$json_obj->command = '0300';
				$json_obj->message = 'Request forgot password success.';
				$json_obj->send_email_status = ($status)?'Success':'Failed';
			}
			else{
				$json_obj->command = '0303';
				$json_obj->message = 'Request forgot password fail - insert otp fail.';
			}
		}
		else {
			$json_obj->command = '0302';
			$json_obj->message = 'Request forgot password fail - your email is invalid.';
		}

		$obj_class->closedb();
		return $json_obj;
    }

    //0400 -- OK
	public function check_otp_forgot_password($params) {
		$json_obj = new stdClass();
		$obj_global = new GlobalConstant();		
		$obj_log = new LogFile();		
		$save_data_log = $_SERVER["HTTP_HOST"].$_SERVER["PHP_SELF"];

		$obj_class = new Connectdb($obj_global->getHOST_CMS(), $obj_global->getUSER_CMS() , $obj_global->getPWD_CMS(), "employee",0,FALSE);

		//$params['otp_code']
		//$params['otp_email']

		$s_sql = "SELECT * from otp WHERE otp_code = '".$params['otp_code']."' AND otp_email = '".$params['otp_email']."' ORDER BY otp_id_pk DESC";
		$b_resp = $obj_class->selectproc($s_sql);
		$obj_log->savelog($save_data_log,"check_otp_forgot_password","sql=[$s_sql]");
		$datas = array();

		if ($b_resp && $obj_class->n_row>0) {	
			if($obj_class->getitem("otp_status") == 0){ //0 = not use

				$s_sql_2 = "UPDATE otp SET otp_status = 1 , otp_modified_date = NOW() WHERE otp_code = '".$params['otp_code']."' AND otp_email = '".$params['otp_email']."' ";
				$b_flag_2 = $obj_class->manageproc($s_sql_2);
				$obj_log->savelog($save_data_log,"check_otp_forgot_password -> update -> otp","sql=[$s_sql_2]");

				if($b_flag_2){
					$json_obj->command = '0400';
					$json_obj->message = 'Data is valid.';
				}
				else{
					$json_obj->command = '0404';
					$json_obj->message = 'Data is invalid.';
				}	
			}
			else{ //1 = used
				$json_obj->command = '0403';
				$json_obj->message = 'Data is used.';
			}
		}
		else {
			$json_obj->command = '0402';
			$json_obj->message = 'Data not found.';
		}

		$obj_class->closedb();
		return $json_obj;
    }

    //0500 -- OK
	public function set_log_out($params) {
		$json_obj = new stdClass();
		$obj_global = new GlobalConstant();		
		$obj_log = new LogFile();		
		$save_data_log = $_SERVER["HTTP_HOST"].$_SERVER["PHP_SELF"];

		$obj_class = new Connectdb($obj_global->getHOST_CMS(), $obj_global->getUSER_CMS() , $obj_global->getPWD_CMS(), "employee",0,FALSE);

		//$params['username']

		$s_sql = "SELECT emp.* , memd.memd_gcm_token , memd.memd_device_type ";
		$s_sql.= "from employee emp LEFT JOIN map_emp_module memd ON emp.emp_id_pk = memd.emp_id_pk ";
		$s_sql.= "WHERE emp.emp_username = '".$params['username']."' AND memd.memd_module LIKE 'memo' ";
		$b_resp = $obj_class->selectproc($s_sql);
		$datas = array();

		if ($b_resp && $obj_class->n_row>0) {

			$emp_com_id = $obj_class->getitem("emp_ID");
			$push_token = $obj_class->getitem("memd_gcm_token");
			$device_type = $obj_class->getitem("memd_device_type");
			$company_id = $obj_class->getitem("com_id_pk");
			$emp_email = $obj_class->getitem("emp_email");
			$emp_id = $obj_class->getitem("emp_id_pk");

			$s_sql_2 = "SELECT * from access_history WHERE emp_ID = '".$emp_com_id."' AND ah_module = 'memo' ORDER BY ah_getdate DESC LIMIT 1 ";
			$b_resp_2 = $obj_class->selectproc($s_sql_2);

			if ($b_resp_2 && $obj_class->n_row>0) {
				
				$device_token = $obj_class->getitem("ah_device_token");
				$s_sql_3 = "INSERT INTO access_history (emp_ID , ah_module , ah_device_token , ah_getdate , ah_type) VALUES ('".$emp_com_id."' , 'memo' , '".$device_token."' , NOW() , 'logout') ";
				$b_flag_3 = $obj_class->manageproc($s_sql_3);
				$obj_log->savelog($save_data_log,"set_log_out","sql=[$s_sql_3]");

				if($b_flag_3){
					$map_emp_notice = $this->get_map_emp_notice($company_id , $emp_com_id);

					$json_obj->command = '0500';
					$json_obj->message = 'Set logout success.';			

					for($i=0;$i<count($map_emp_notice);$i++){

						if(($map_emp_notice[$i]['notice_type'] == 3) && ($push_token != '')){ //send notice

							$notice_title = "Memo";
							$notice_content = "มีผู้อื่นเข้าสู่ระบบโดยใช้บัญชีผู้ใช้ของคุณ\nคุณต้องการยืนยันการเข้าสู่ระบบ หรือไม่";

							if($device_type == 'ios'){
								$data['aps'] = array(
												"alert"	=> array(
													"title" => $notice_title ,
													"body" => $notice_content
													 ),
												"system" => "kick" ,
												"content-available" => 1
											);
								
								$ios[$push_token] = $data;
								$rs = $this->send_push_notice_ios($ios);
							}
							else if($device_type == 'android'){
						     	$data = array(
									"data" => array(
										"title" => $notice_title , 
										"content" => $notice_content ,
										"system" => "kick" ,
										"badge" => 0
									) , 
									"priority" => "high", 
									"to" => $push_token
								);

								$data_string = json_encode($data);  

								$result = $this->send_push_notice_android($data_string);
								$rs = $result->success;
							}
							
							if($rs){
								$json_obj->send_notice_status = 'Send notice success.';
					     	}
					     	else{
								$json_obj->send_notice_status = 'Send notice failed.';
					     	}
						}
						else if($map_emp_notice[$i]['notice_type'] == 2){ //send email
							/*
							$emp_email = "lookbaar@gmail.com";
							$send_email = $this->send_email($emp_email);

							if($send_email){
								$json_obj->send_email_status = 'Send email success.';
					     	}
					     	else{
								$json_obj->send_email_status = 'Send email failed.';
					     	}
					     	*/
						}
						//else if($map_emp_notice[$i]['notice_type'] == 1){ //send notice to verk

						//}
					}					
				}
				else{
					$json_obj->command = '0504';
					$json_obj->message = 'Set logout failed.';
				}	
			}
			else{
				$json_obj->command = '0503';
				$json_obj->message = 'Your account is not login.';
			}
		}
		else{
			$json_obj->command = '0502';
			$json_obj->message = 'Data is invalid.';
		}

		$obj_class->closedb();
		return $json_obj;
    }

    //0600 -- OK
	public function change_password_by_forgot_password($params) {
		$json_obj = new stdClass();
		$obj_global = new GlobalConstant();		
		$obj_log = new LogFile();		
		$save_data_log = $_SERVER["HTTP_HOST"].$_SERVER["PHP_SELF"];

		$obj_class = new Connectdb($obj_global->getHOST_CMS(), $obj_global->getUSER_CMS() , $obj_global->getPWD_CMS(), "employee",0,FALSE);

		//$params['email']
		//$params['password']

		$s_sql = "UPDATE employee SET emp_password = '".md5($params['password'])."' , emp_modified_date = NOW() WHERE emp_email LIKE '".$params['email']."' ";
		$b_flag = $obj_class->manageproc($s_sql);
		$obj_log->savelog($save_data_log,"change_password_by_forgot_password","sql=[$s_sql]");

		if($b_flag){
			$json_obj->command = '0600';
			$json_obj->message = 'Change password success.';
		}
		else{
			$json_obj->command = '0602';
			$json_obj->message = 'Change password fail.';
		}	

		$obj_class->closedb();
		return $json_obj;
    }

    //0700 -- OK
	public function check_account($params) {
		$json_obj = new stdClass();
		$obj_global = new GlobalConstant();		
		$obj_log = new LogFile();		
		$save_data_log = $_SERVER["HTTP_HOST"].$_SERVER["PHP_SELF"];

		$obj_class = new Connectdb($obj_global->getHOST_CMS(), $obj_global->getUSER_CMS() , $obj_global->getPWD_CMS(), "employee",0,FALSE);

		//$params['username']
		//$params['password']

		$s_sql = "SELECT * from employee e LEFT JOIN company c ON e.com_id_pk = c.com_id_pk WHERE e.emp_username = '".$params['username']."' AND e.emp_password = '".md5($params['password'])."' ";
		$b_resp = $obj_class->selectproc($s_sql);
		$obj_log->savelog($save_data_log,"get_employee_type_list","sql=[$s_sql]");

		if ($b_resp && $obj_class->n_row>0) {
			if($obj_class->getitem("com_status") == 1){ //check company status
				if($obj_class->getitem("emp_status") == 1){ //check employee status
					
					$s_sql_2 = "SELECT * from company WHERE com_id_pk = ".$obj_class->getitem("com_id_pk")." AND com_module LIKE '%memo%' ";
					$b_resp_2 = $obj_class->selectproc($s_sql_2);
					
					$datas = array();

					if ($b_resp && $obj_class->n_row>0) {
						$json_obj->command = '0700';
						$json_obj->message = 'Your account is valid.';
					}
					else {
						$json_obj->command = '0705';
						$json_obj->message = 'Your account can not use this module.';	
					}
				}
				else{
					$json_obj->command = '0704';
					$json_obj->message = 'Your account is inactive.';
				}
			}
			else{
				$json_obj->command = '0703';
				$json_obj->message = 'Your company status is invalid.';
			}	
		}
		else{
			$json_obj->command = '0702';
			$json_obj->message = 'Your username or password is invalid.';
		}

		$obj_class->closedb();
		return $json_obj;
    }

    //0800 -- OK
	public function get_employee_info($params) {
		$json_obj = new stdClass();
		$obj_global = new GlobalConstant();		
		$obj_log = new LogFile();		
		$save_data_log = $_SERVER["HTTP_HOST"].$_SERVER["PHP_SELF"];

		$obj_class = new Connectdb($obj_global->getHOST_CMS(), $obj_global->getUSER_CMS() , $obj_global->getPWD_CMS(), "employee",0,FALSE);

		//$params['company_id']
		//$params['employee_id']

		$s_sql = "SELECT * from employee e LEFT JOIN department d ON e.dp_id_pk = d.dp_id_pk WHERE e.com_id_pk = ".$params['company_id']." AND e.emp_id_pk = ".$params['employee_id'];
		$b_resp = $obj_class->selectproc($s_sql);
		$obj_log->savelog($save_data_log,"get_employee_info","sql=[$s_sql]");
		$datas = array();

		if ($b_resp && $obj_class->n_row>0) {	
			$datas[0]['el_emp_id'] = $obj_class->getitem("emp_ID");
			$datas[0]['el_emp_name'] = $obj_class->getitem("emp_name");
			$datas[0]['el_department'] = ($obj_class->getitem("dp_name"))?$obj_class->getitem("dp_name"):'-';
			$datas[0]['el_position'] = $obj_class->getitem("emp_position");
			$datas[0]['el_start_work_date'] = $obj_class->getitem("emp_start_work_date");

			$json_obj->command = '0800';
			$json_obj->message = 'Get data success.';
			$json_obj->data = $datas;
		}
		else {
			$json_obj->command = '0802';
			$json_obj->message = 'Data not found.';
		}
		$obj_class->closedb();
		return $json_obj;
    }

    //0900 -- OK
	public function get_division_list($params) {
		$json_obj = new stdClass();
		$obj_global = new GlobalConstant();		
		$obj_log = new LogFile();		
		$save_data_log = $_SERVER["HTTP_HOST"].$_SERVER["PHP_SELF"];

		$obj_class = new Connectdb($obj_global->getHOST_CMS(), $obj_global->getUSER_CMS() , $obj_global->getPWD_CMS(), "employee",0,FALSE);

		//$params['company_id']
		//$params['employee_id']

		$emp_info = $this->get_emp_info_by_emp_id($params['company_id'] , $params['employee_id']);

		$s_sql = "SELECT * from division WHERE com_id_pk = ".$params['company_id']." ";

		if($emp_info[0]['emp_dv_id'] != 0){
			$s_sql.= "AND dv_id_pk = ".$emp_info[0]['emp_dv_id']." ";
		}

		$s_sql.= "ORDER BY dv_id_pk ASC";
		$b_resp = $obj_class->selectproc($s_sql);
		$obj_log->savelog($save_data_log,"get_division_list","sql=[$s_sql]");
		$datas = array();

		if ($b_resp && $obj_class->n_row>0) {
			for($i=0;$i<$obj_class->n_row;$i++){	
				$datas[$i]['dl_division_id'] = $obj_class->getitem("dv_id_pk");
				$datas[$i]['dl_division_name'] = $obj_class->getitem("dv_name");
				$datas[$i]['dl_division_initial'] = $obj_class->getitem("dv_initial");
				$datas[$i]['dl_company_id'] = $obj_class->getitem("com_id_pk");

			    $obj_class->movenext();
			}

			$json_obj->command = '0900';
			$json_obj->message = 'Get data success.';
			$json_obj->data = $datas;


			/*
			//test push notice
			$notice_title = 'Memo';
			$notice_content = 'Verk โคตรๆ';
			$push_token = 'd0bNL9eu1k4:APA91bHQcBcIHthqdA5jeStuA35oj8ayyAip-_xFbbG9jE5x3Uo053INJKxHWePBUmUcE0cWn-vCp1BATM_8ZIqKsTsjw2vaKd4InzyhNYT6lOolJC-sAFKmx7iQMacO75ygMvV-TkrD';

			$data = array(
						"data" => array(
							"title" => $notice_title,
							"content" => $notice_content,
							"badge" => 0//$this->get_badge_notice($emp_id_get_notice)
						) , 
						"priority" => "high", 
						"to" => $push_token
					);

			$data_string = json_encode($data);  

			$result = $this->send_push_notice_android($data_string);
			$rs = ($result->success)?true:false;
		
			if($rs){
				$json_obj->send_notice_status = 'Send notice success.';
	     	}
	     	else{
				$json_obj->send_notice_status = 'Send notice failed.';
	     	}
			*/
		}
		else {
			$json_obj->command = '0902';
			$json_obj->message = 'Data not found.';
		}

		$obj_class->closedb();
		return $json_obj;
    }

    //1000 -- OK
	public function get_department_list($params) {
		$json_obj = new stdClass();
		$obj_global = new GlobalConstant();		
		$obj_log = new LogFile();		
		$save_data_log = $_SERVER["HTTP_HOST"].$_SERVER["PHP_SELF"];

		$obj_class = new Connectdb($obj_global->getHOST_CMS(), $obj_global->getUSER_CMS() , $obj_global->getPWD_CMS(), "employee",0,FALSE);

		//$params['company_id']
		//$params['division_id']

		$s_sql = "SELECT * from department WHERE com_id_pk = ".$params['company_id']." AND dv_id_pk = ".$params['division_id']." ORDER BY dp_id_pk ASC";
		$b_resp = $obj_class->selectproc($s_sql);
		$obj_log->savelog($save_data_log,"get_department_list","sql=[$s_sql]");
		$datas = array();

		if ($b_resp && $obj_class->n_row>0) {
			for($i=0;$i<$obj_class->n_row;$i++){	
				$datas[$i]['dpl_department_id'] = $obj_class->getitem("dp_id_pk");
				$datas[$i]['dpl_department_name'] = $obj_class->getitem("dp_name");
				$datas[$i]['dpl_department_initial'] = ($obj_class->getitem("dp_initial"))?$obj_class->getitem("dp_initial"):'null';
				$datas[$i]['dpl_company_id'] = $obj_class->getitem("com_id_pk");
				$datas[$i]['dpl_division_id'] = $obj_class->getitem("dv_id_pk");

			    $obj_class->movenext();
			}

			$json_obj->command = '1000';
			$json_obj->message = 'Get data success.';
			$json_obj->data = $datas;
		}
		else {
			$json_obj->command = '1002';
			$json_obj->message = 'Data not found.';
		}

		$obj_class->closedb();
		return $json_obj;
    }

    //1100 -- OK
	public function get_section_list($params) {
		$json_obj = new stdClass();
		$obj_global = new GlobalConstant();		
		$obj_log = new LogFile();		
		$save_data_log = $_SERVER["HTTP_HOST"].$_SERVER["PHP_SELF"];

		$obj_class = new Connectdb($obj_global->getHOST_CMS(), $obj_global->getUSER_CMS() , $obj_global->getPWD_CMS(), "employee",0,FALSE);

		//$params['company_id'] 
		//$params['department_id']

		$s_sql = "SELECT * from section WHERE com_id_pk = ".$params['company_id']." AND dp_id_pk = ".$params['department_id']." ORDER BY st_id_pk ASC";
		$b_resp = $obj_class->selectproc($s_sql);
		$obj_log->savelog($save_data_log,"get_section_list","sql=[$s_sql]");
		$datas = array();

		if ($b_resp && $obj_class->n_row>0) {
			for($i=0;$i<$obj_class->n_row;$i++){	
				$datas[$i]['sl_section_id'] = $obj_class->getitem("st_id_pk");
				$datas[$i]['sl_section_name'] = $obj_class->getitem("st_name");
				$datas[$i]['sl_section_initial'] = ($obj_class->getitem("st_initial"))?$obj_class->getitem("st_initial"):'null';
				$datas[$i]['sl_company_id'] = $obj_class->getitem("com_id_pk");
				$datas[$i]['sl_department_id'] = $obj_class->getitem("dp_id_pk");

			    $obj_class->movenext();
			}

			$json_obj->command = '1100';
			$json_obj->message = 'Get data success.';
			$json_obj->data = $datas;
		}
		else {
			$json_obj->command = '1102';
			$json_obj->message = 'Data not found.';
		}

		$obj_class->closedb();
		return $json_obj;
    }




    //1200 -- OK
	public function get_my_profile($params) {
		$json_obj = new stdClass();
		$obj_global = new GlobalConstant();		
		$obj_log = new LogFile();		
		$save_data_log = $_SERVER["HTTP_HOST"].$_SERVER["PHP_SELF"];

		$obj_class_1 = new Connectdb($obj_global->getHOST_CMS(), $obj_global->getUSER_CMS() , $obj_global->getPWD_CMS(), "memo",0,FALSE);
		$obj_class_2 = new Connectdb($obj_global->getHOST_CMS(), $obj_global->getUSER_CMS() , $obj_global->getPWD_CMS(), "employee",0,FALSE);

		//$params['company_id']
		//$params['employee_code']	

		$s_sql_1 = "SELECT * , DATE_FORMAT(sp_created_date, '%Y-%m-%d') AS today from summary_profile WHERE com_id_pk = ".$params['company_id']." AND Emp_ID = '".$params['employee_code']."' AND sp_status LIKE 'Wait for Agree' ";
		$b_resp_1 = $obj_class_1->selectproc($s_sql_1);
		//$obj_log->savelog($save_data_log,"get_my_profile","sql=[$s_sql_1]");
		$datas_1 = array();

		if($b_resp_1 && $obj_class_1->n_row>0){	
			$wfag_total = $obj_class_1->getitem("sp_total");
		}
		else{
			$wfag_total = 0;
		}

		$s_sql_2 = "SELECT * , DATE_FORMAT(sp_created_date, '%Y-%m-%d') AS today from summary_profile WHERE com_id_pk = ".$params['company_id']." AND Emp_ID = '".$params['employee_code']."' AND sp_status LIKE 'Wait for Approve' ";
		$b_resp_2 = $obj_class_1->selectproc($s_sql_2);
		//$obj_log->savelog($save_data_log,"get_my_profile","sql=[$s_sql_2]");
		$datas_2 = array();

		if($b_resp_2 && $obj_class_1->n_row>0){	
			$wfap_total = $obj_class_1->getitem("sp_total");
		}
		else{
			$wfap_total = 0;
		}


		$notice[0]['id'] = 1;
		$notice[0]['name'] = 'Verk';
		$notice[1]['id'] = 2;
		$notice[1]['name'] = 'Email';
		$notice[2]['id'] = 3;
		$notice[2]['name'] = 'Memo';

		for($i=0;$i<count($notice);$i++){
			$s_sql_3 = "SELECT * from map_emp_notification WHERE com_id_pk = ".$params['company_id']." AND emp_ID = ".$params['employee_code']." AND men_module LIKE 'memo' AND men_status = 1 AND men_noti_type = ".$notice[$i]['id'];
			$b_resp_3 = $obj_class_2->selectproc($s_sql_3);
			$obj_log->savelog($save_data_log,"get_my_profile","sql=[$s_sql_3]");

			if($b_resp_3 && $obj_class_2->n_row>0){	
				$notice[$i]['send'] = 1;
			}
			else{
				$notice[$i]['send'] = 0;
			}
		}

		$json_obj->command = '1200';
		$json_obj->message = 'Get data success.';
		$json_obj->wait_for_agree_total = $wfag_total;
		$json_obj->wait_for_approve_total = $wfap_total;
		$json_obj->notice = $notice;
		
		$obj_class_2->closedb();
		$obj_class_1->closedb();
		return $json_obj;
    }

    //1300 -- OK
	public function get_draft_list($params) {
		$json_obj = new stdClass();
		$obj_global = new GlobalConstant();		
		$obj_log = new LogFile();		
		$save_data_log = $_SERVER["HTTP_HOST"].$_SERVER["PHP_SELF"];

		$obj_class = new Connectdb($obj_global->getHOST_CMS(), $obj_global->getUSER_CMS() , $obj_global->getPWD_CMS(), "memo",0,FALSE);

		//$params['company_id']
		//$params['employee_id']

		//select -> tb memo , draft_memo
		$s_sql = "SELECT * from memo mm LEFT JOIN draft_memo dm ON mm.mm_id_pk = dm.mm_id_pk ";
		$s_sql.= "WHERE mm.com_id_pk = ".$params['company_id']." AND mm.mm_NO IS NULL ";
		$s_sql.= "AND dm.emp_id_pk = ".$params['employee_id']." AND dm.dm_status = 1 ";
		$s_sql.= "ORDER BY mm.mm_created_date DESC";
		$b_resp = $obj_class->selectproc($s_sql);
		$obj_log->savelog($save_data_log,"get_draft_list","sql=[$s_sql]");
		$datas = array();

		if ($b_resp && $obj_class->n_row>0) {
			for($i=0;$i<$obj_class->n_row;$i++){	
				$datas[$i]['memo_id'] = $obj_class->getitem("mm_id_pk");
				$datas[$i]['memo_subject'] = $obj_class->getitem("mm_subject");
				$datas[$i]['memo_form_id'] = $obj_class->getitem("mm_format_id");
				$datas[$i]['memo_create_date'] = date("Y-m-d", strtotime($obj_class->getitem("mm_modified_date")));
				$datas[$i]['memo_create_time'] = date("H:i", strtotime($obj_class->getitem("mm_modified_date")));
				$datas[$i]['memo_type_name'] = $obj_class->getitem("mm_sub_type");

			    $obj_class->movenext();
			}

			$json_obj->command = '1300';
			$json_obj->message = 'Get data success.';
			$json_obj->data = $datas;
		}
		else {
			$json_obj->command = '1302';
			$json_obj->message = 'Data not found.';
		}
		
		$obj_class->closedb();
		return $json_obj;
    }

    //1400 -- OK
	public function get_summary_memo_report($params) {
		$json_obj = new stdClass();
		$obj_global = new GlobalConstant();		
		$obj_log = new LogFile();		
		$save_data_log = $_SERVER["HTTP_HOST"].$_SERVER["PHP_SELF"];

		$obj_class = new Connectdb($obj_global->getHOST_CMS(), $obj_global->getUSER_CMS() , $obj_global->getPWD_CMS(), "memo",0,FALSE);
		$obj_class_2 = new Connectdb($obj_global->getHOST_CMS(), $obj_global->getUSER_CMS() , $obj_global->getPWD_CMS(), "memo",0,FALSE);
		$obj_class_3 = new Connectdb($obj_global->getHOST_CMS(), $obj_global->getUSER_CMS() , $obj_global->getPWD_CMS(), "memo",0,FALSE);

		//$params['company_id']
		//$params['year']

		//$params['division_id']
		//$params['department_id']
		//$params['section_id']

		$params['year'] = (isset($params['year']) && ($params['year'] != ''))?$params['year']:'';
		$params['division_id'] = (isset($params['division_id']) && ($params['division_id'] != ''))?$params['division_id']:'';
		$params['department_id'] = (isset($params['department_id']) && ($params['department_id'] != ''))?$params['department_id']:'';
		$params['section_id'] = (isset($params['section_id']) && ($params['section_id'] != ''))?$params['section_id']:'';

		if(($params['division_id'] == '') && ($params['department_id'] == '') && ($params['section_id'] == '')){
			//select -> tb summary_memo
			$s_sql = "SELECT sm.* , SUM(sm.sm_total) AS total , dv.dv_name ";
			$s_sql.= "from memo.summary_memo sm JOIN employee.division dv ON sm.dv_id_pk = dv.dv_id_pk ";
			$s_sql.= "WHERE sm.com_id_pk = ".$params['company_id']." ";

			if($params['year'] != ''){ 
				$s_sql.= "AND DATE_FORMAT(sm.sm_trans_date , '%Y') = '".$params['year']."' ";
			}
			if(($params['division_id'] == '') && ($params['department_id'] == '') && ($params['section_id'] == '')){
				$s_sql.= "GROUP BY sm.dv_id_pk ";
			}

			$s_sql.= " ORDER BY sm.dv_id_pk ASC";
		}
		else if(($params['division_id'] != '') && ($params['department_id'] == '') && ($params['section_id'] == '')){
			//select -> tb summary_memo
			$s_sql = "SELECT sm.* , SUM(sm.sm_total) AS total , dv.dv_name , dp.dp_name ";
			$s_sql.= "from memo.summary_memo sm JOIN employee.division dv ON sm.dv_id_pk = dv.dv_id_pk ";
			$s_sql.= "JOIN employee.department dp ON sm.dp_id_pk = dp.dp_id_pk ";
			$s_sql.= "WHERE sm.com_id_pk = ".$params['company_id']." ";
			$s_sql.= "AND dv.dv_id_pk = ".$params['division_id']." ";
			
			if($params['year'] != ''){ 
				$s_sql.= "AND DATE_FORMAT(sm.sm_trans_date , '%Y') = '".$params['year']."' ";
			}

			$s_sql.= "GROUP BY sm.dp_id_pk ";
			$s_sql.= "ORDER BY sm.dv_id_pk ASC";
		}
		else if(($params['division_id'] != '') && ($params['department_id'] != '') && ($params['section_id'] == '')){
			//select -> tb summary_memo
			$s_sql = "SELECT sm.* , SUM(sm.sm_total) AS total , dv.dv_name , dp.dp_name , st.st_name ";
			$s_sql.= "from memo.summary_memo sm JOIN employee.division dv ON sm.dv_id_pk = dv.dv_id_pk ";
			$s_sql.= "JOIN employee.department dp ON sm.dp_id_pk = dp.dp_id_pk ";
			$s_sql.= "JOIN employee.section st ON sm.st_id_pk = st.st_id_pk ";
			$s_sql.= "WHERE sm.com_id_pk = ".$params['company_id']." ";
			$s_sql.= "AND dv.dv_id_pk = ".$params['division_id']." ";
			$s_sql.= "AND dp.dp_id_pk = ".$params['department_id']." ";
			
			if($params['year'] != ''){ 
				$s_sql.= "AND DATE_FORMAT(sm.sm_trans_date , '%Y') = '".$params['year']."' ";
			}

			$s_sql.= "GROUP BY sm.st_id_pk ";
			$s_sql.= "ORDER BY sm.dv_id_pk ASC";
		}
		else if(($params['division_id'] != '') && ($params['department_id'] != '') && ($params['section_id'] != '')){
			//select -> tb summary_memo
			$s_sql = "SELECT sm.* , SUM(sm.sm_total) AS total , dv.dv_name ";
			$s_sql.= ", dp.dp_name , st.st_name ";
			$s_sql.= "from memo.summary_memo sm JOIN employee.division dv ON sm.dv_id_pk = dv.dv_id_pk ";
			$s_sql.= "JOIN employee.department dp ON sm.dp_id_pk = dp.dp_id_pk ";	
			$s_sql.= "JOIN employee.section st ON sm.st_id_pk = st.st_id_pk ";
			$s_sql.= "WHERE sm.com_id_pk = ".$params['company_id']." ";
			$s_sql.= "AND dv.dv_id_pk = ".$params['division_id']." ";
			$s_sql.= "AND dp.dp_id_pk = ".$params['department_id']." ";
			$s_sql.= "AND st.st_id_pk = ".$params['section_id']." ";
			
			if($params['year'] != ''){ 
				$s_sql.= "AND DATE_FORMAT(sm.sm_trans_date , '%Y') = '".$params['year']."' ";
			}

			$s_sql.= "GROUP BY sm.st_id_pk ";
			$s_sql.= "ORDER BY sm.dv_id_pk ASC";
		}

		$b_resp = $obj_class->selectproc($s_sql);
		$obj_log->savelog($save_data_log,"get_summary_memo_report","sql=[$s_sql]");
		$datas = array();
		

		if($b_resp && $obj_class->n_row>0) {
			$all_sm_total = 0;

			for($i=0;$i<$obj_class->n_row;$i++){	
				$division_id = $obj_class->getitem("dv_id_pk");
				$department_id = $obj_class->getitem("dp_id_pk");
				$section_id = $obj_class->getitem("st_id_pk");

				$datas[$i]['sm_id_pk'] = $obj_class->getitem("sm_id_pk");
				$datas[$i]['sm_trans_date'] = $obj_class->getitem("sm_trans_date");
				$datas[$i]['company_id'] = $obj_class->getitem("com_id_pk");
				$datas[$i]['division_id'] = ($obj_class->getitem("dv_id_pk"))?$obj_class->getitem("dv_id_pk"):0;
				$datas[$i]['department_id'] = ($obj_class->getitem("dp_id_pk"))?$obj_class->getitem("dp_id_pk"):0;
				$datas[$i]['section_id'] = ($obj_class->getitem("st_id_pk"))?$obj_class->getitem("st_id_pk"):0;
				$datas[$i]['division_name'] = $obj_class->getitem("dv_name");
				$datas[$i]['department_name'] = ($obj_class->getitem("dp_name") != '')?$obj_class->getitem("dp_name"):'-';
				$datas[$i]['section_name'] = ($obj_class->getitem("st_name") != '')?$obj_class->getitem("st_name"):'-';
				$datas[$i]['sm_total'] = $obj_class->getitem("total");

				$all_sm_total = $all_sm_total+$obj_class->getitem("total");

				$datas[$i]['show_status'] = $this->get_summary_memo_status($params , $obj_class->getitem("com_id_pk") , $obj_class->getitem("dv_id_pk") , $obj_class->getitem("dp_id_pk") , $obj_class->getitem("st_id_pk"));

			    $obj_class->movenext();
			}

			$json_obj->command = '1400';
			$json_obj->message = 'Get data success.';
			$json_obj->summary_total = $all_sm_total;
			$json_obj->data = $datas;
		}
		else {
			$json_obj->command = '1402';
			$json_obj->message = 'Data not found.';
		}
		
		$obj_class->closedb();
		return $json_obj;
    }





    //1500 -- OK //edit api doc
	public function get_form_list($params) {
		$json_obj = new stdClass();
		$obj_global = new GlobalConstant();		
		$obj_log = new LogFile();		
		$save_data_log = $_SERVER["HTTP_HOST"].$_SERVER["PHP_SELF"];

		$obj_class = new Connectdb($obj_global->getHOST_CMS(), $obj_global->getUSER_CMS() , $obj_global->getPWD_CMS(), "memo",0,FALSE);
		
		//$params['company_id'] //edit api doc

		//$params['is_favorite'] favorite = 1 / etc = 0
		//$params['show_form_format'] show = 1 

		$buy_advance = $this->check_buy_advance($params['company_id']);

		//select -> tb memo_form_position
		$s_sql = "SELECT * from memo_form_position WHERE com_id_pk IN (0 , ".$params['company_id'].") AND mf_status = 1 ";

		if($params['is_favorite'] == 1){
			$s_sql.= "AND mf_id_pk != 3 ";
		}

		$s_sql.= " ORDER BY mf_id_pk ASC";
		$b_resp = $obj_class->selectproc($s_sql);
		$obj_log->savelog($save_data_log,"get_employee_cc_list","sql=[$s_sql]");
		$datas = array();

		if ($b_resp && $obj_class->n_row>0) {
			for($i=0;$i<$obj_class->n_row;$i++){	

				if($params['show_form_format'] == 1){
					$datas[$i]['form_format_id'] = $obj_class->getitem("mf_id_pk");
					$datas[$i]['form_format_name'] = $obj_class->getitem("mf_form_name");
					$datas[$i]['form_format_detail'] = $obj_class->getitem("mf_form_detail");
				}
				else{
					if($obj_class->getitem("mf_id_pk") < 3){
						$datas[$i]['mf_id_pk'] = $obj_class->getitem("mf_id_pk");
						$datas[$i]['mf_form_name'] = $obj_class->getitem("mf_form_name");
						$datas[$i]['mf_form_detail'] = $obj_class->getitem("mf_form_detail");
					}
					else if(($buy_advance) && ($obj_class->getitem("mf_id_pk") == 3)){
						$datas[$i]['mf_id_pk'] = $obj_class->getitem("mf_id_pk");
						$datas[$i]['mf_form_name'] = $obj_class->getitem("mf_form_name");
						$datas[$i]['mf_form_detail'] = $obj_class->getitem("mf_form_detail");
					}
				}
				
			    $obj_class->movenext();
			}

			$json_obj->command = '1500';
			$json_obj->message = 'Get data success.';
			$json_obj->data = $datas;
			$json_obj->default_format = $datas;
		}
		else {
			$json_obj->command = '1502';
			$json_obj->message = 'Data not found.';
		}

		$obj_class->closedb();
		return $json_obj;
    }

    //1600 -- OK
	public function get_memo_no_list($params) {
		$json_obj = new stdClass();
		$obj_global = new GlobalConstant();		
		$obj_log = new LogFile();		
		$save_data_log = $_SERVER["HTTP_HOST"].$_SERVER["PHP_SELF"];

		$obj_class = new Connectdb($obj_global->getHOST_CMS(), $obj_global->getUSER_CMS() , $obj_global->getPWD_CMS(), "memo",0,FALSE);

		//$params['company_id'] 
		//$params['memo_type_id']
		//$params['division_id']
		//$params['department_id']
		//$params['section_id']

		//select -> tb memo_no
		//$s_sql = "SELECT * from memo_NO WHERE com_id_pk = ".$params['company_id']." AND mt_id_pk IN (0,".$params['memo_type_id'].") AND (dv_id_pk IN (0,".$params['division_id'].") AND dp_id_pk IN (0,".$params['department_id'].") AND st_id_pk IN (0,".$params['section_id'].")) AND (NOW() BETWEEN mno_start_date AND mno_end_date) ORDER BY mno_key_name ASC";

		$s_sql = "SELECT * from memo_NO WHERE com_id_pk = ".$params['company_id']." ";
		$s_sql.= "AND mt_id_pk IN (0,".$params['memo_type_id'].") AND (dv_id_pk IN (0,".$params['division_id'].") ";

		if($params['department_id'] > 0){
			$s_sql.= "AND dp_id_pk IN (0,".$params['department_id'].") ";
		}
		if($params['section_id'] > 0){
			$s_sql.= "AND st_id_pk IN (0,".$params['section_id'].") ";
		}
		
		$s_sql.= ") AND (NOW() BETWEEN mno_start_date AND mno_end_date) ";
		$s_sql.= "ORDER BY mno_key_name ASC";
		$b_resp = $obj_class->selectproc($s_sql);
		$obj_log->savelog($save_data_log,"get_memo_no_list","sql=[$s_sql]");
		$datas = array();

		if ($b_resp && $obj_class->n_row>0) {
			for($i=0;$i<$obj_class->n_row;$i++){	
				$datas[$i]['mno_id_pk'] = $obj_class->getitem("mno_id_pk");
				$datas[$i]['mno_key_name'] = $obj_class->getitem("mno_key_name");
				$datas[$i]['mno_year'] = $obj_class->getitem("mno_year");
				$datas[$i]['mno_running_no'] = $obj_class->getitem("mno_running_no");
				$datas[$i]['mno_format_memoNo'] = $obj_class->getitem("mno_format_memoNo");
				$datas[$i]['mno_format_date'] = $obj_class->getitem("mno_format_date");
				$datas[$i]['prelist_concurred'] = $obj_class->getitem("pl_concurred");

				/*
				if($obj_class->getitem("mno_format_memoNo") == 'C-xxxxx-YYYYMMDDhhmm'){
					$datas[$i]['show_format'] = $obj_class->getitem("mno_key_name").'-'.$obj_class->getitem("mno_running_no").'-'.$obj_class->getitem("mno_year").date("mdHi");
				}
				else if($obj_class->getitem("mno_format_memoNo") == 'CYYYY/xxxxx'){
					$datas[$i]['show_format'] = $obj_class->getitem("mno_key_name").'/'.$obj_class->getitem("mno_running_no");
				}
				else if($obj_class->getitem("mno_format_memoNo") == 'C/YYYYxxxxx'){
					$datas[$i]['show_format'] = $obj_class->getitem("mno_key_name").'/'.$obj_class->getitem("mno_year").$obj_class->getitem("mno_running_no");
				}
				else if($obj_class->getitem("mno_format_memoNo") == 'C xxxxx/YYYY'){
					$datas[$i]['show_format'] = $obj_class->getitem("mno_key_name").' '.$obj_class->getitem("mno_running_no").'/'.$obj_class->getitem("mno_year");
				}
				*/

				switch ($obj_class->getitem("mno_format_date")) {
		            case 'YYYY/MM/DD': 
		            	$datas[$i]['mno_show_date'] = date("Y/m/d");
						break;
					case 'MM/DD/YYYY': 
		            	$datas[$i]['mno_show_date'] = date("m/d/Y");
						break;
					case 'DD/MM/YYYY': 
		            	$datas[$i]['mno_show_date'] = date("d/m/Y");
						break;
					case 'YYYY-MM-DD': 
		            	$datas[$i]['mno_show_date'] = date("Y-m-d");
						break;
					case 'MM-DD-YYYY': 
		            	$datas[$i]['mno_show_date'] = date("m-d-Y");
						break;
					case 'DD-MM-YYYY': 
		            	$datas[$i]['mno_show_date'] = date("d-m-Y");
						break;
					default: 
						$datas[$i]['mno_show_date'] = date("Y-m-d");
						break;
				}


				if(($obj_class->getitem("mno_format_memoNo") == 'C-xxxxx-YYYYMMDDhhmm') || ($obj_class->getitem("mno_format_memoNo") == 'CC-xxxxx-YYYYMMDDhhmm')){
					$datas[$i]['show_format'] = $obj_class->getitem("mno_key_name").'-'.$obj_class->getitem("mno_running_no").'-'.$obj_class->getitem("mno_year").date("mdHi");
				}
				else if(($obj_class->getitem("mno_format_memoNo") == 'CYYYY/xxxxx') || ($obj_class->getitem("mno_format_memoNo") == 'CCYYYY/xxxxx')){
					$datas[$i]['show_format'] = $obj_class->getitem("mno_key_name").'/'.$obj_class->getitem("mno_running_no");
				}
				else if(($obj_class->getitem("mno_format_memoNo") == 'C/YYYYxxxxx') || ($obj_class->getitem("mno_format_memoNo") == 'CC/YYYYxxxxx')){
					$datas[$i]['show_format'] = $obj_class->getitem("mno_key_name").'/'.$obj_class->getitem("mno_year").$obj_class->getitem("mno_running_no");
				}
				else if(($obj_class->getitem("mno_format_memoNo") == 'C xxxxx/YYYY') || ($obj_class->getitem("mno_format_memoNo") == 'CC xxxxx/YYYY')){
					$datas[$i]['show_format'] = $obj_class->getitem("mno_key_name").' '.$obj_class->getitem("mno_running_no").'/'.$obj_class->getitem("mno_year");
				}
				
			    $obj_class->movenext();
			}

			$json_obj->command = '1600';
			$json_obj->message = 'Get data success.';
			$json_obj->data = $datas;
		}
		else {
			$json_obj->command = '1602';
			$json_obj->message = 'Data not found.';
		}

		$obj_class->closedb();
		return $json_obj;
    }

    //1700 -- OK
	public function get_prelist_list($params) {
		$json_obj = new stdClass();
		$obj_global = new GlobalConstant();		
		$obj_log = new LogFile();		
		$save_data_log = $_SERVER["HTTP_HOST"].$_SERVER["PHP_SELF"];

		$obj_class = new Connectdb($obj_global->getHOST_CMS(), $obj_global->getUSER_CMS() , $obj_global->getPWD_CMS(), "memo",0,FALSE);

		//$params['company_id'] 
		//$params['memo_type_id']

		//select -> tb prelist
		$s_sql = "SELECT * from prelist WHERE com_id_pk = ".$params['company_id']." AND mt_id_pk = ".$params['memo_type_id']." ";
		$s_sql.= "ORDER BY pl_name ASC";
		$b_resp = $obj_class->selectproc($s_sql);
		$obj_log->savelog($save_data_log,"get_prelist_list","sql=[$s_sql]");
		$datas = array();

		if ($b_resp && $obj_class->n_row>0) {
			for($i=0;$i<$obj_class->n_row;$i++){	
				$datas[$i]['prelist_id'] = $obj_class->getitem("pl_id_pk");
				$datas[$i]['prelist_code'] = $obj_class->getitem("pl_code");
				$datas[$i]['prelist_name'] = $obj_class->getitem("pl_name");
				$datas[$i]['memo_type_id'] = $obj_class->getitem("mt_id_pk");
				$datas[$i]['company_id'] = $obj_class->getitem("com_id_pk");
				$datas[$i]['prelist_approve'] = $obj_class->getitem("pl_approve");
				$datas[$i]['prelist_concurred'] = $obj_class->getitem("pl_concurred");

			    $obj_class->movenext();
			}

			$json_obj->command = '1700';
			$json_obj->message = 'Get data success.';
			$json_obj->data = $datas;
		}
		else {
			$json_obj->command = '1702';
			$json_obj->message = 'Data not found.';
		}

		$obj_class->closedb();
		return $json_obj;
    }

    //1800 -- OK
	public function get_memo_type_list($params) {
		$json_obj = new stdClass();
		$obj_global = new GlobalConstant();		
		$obj_log = new LogFile();		
		$save_data_log = $_SERVER["HTTP_HOST"].$_SERVER["PHP_SELF"];

		$obj_class = new Connectdb($obj_global->getHOST_CMS(), $obj_global->getUSER_CMS() , $obj_global->getPWD_CMS(), "memo",0,FALSE);

		//$params['company_id'] 
		//$params['form_id'] 

		//select -> tb memo_type
		$s_sql = "SELECT * from memo_type WHERE com_id_pk IN (0 , ".$params['company_id'].") ";
		if($params['form_id'] == 1){ //Financial
			$s_sql.= "AND (mt_budget LIKE '%yes%' OR mt_budget LIKE '%no%') AND mt_name NOT LIKE 'Advance' ";
		}
		else if($params['form_id'] == 2){ //Non Financial
			$s_sql.= "AND mt_budget = 'N/A' AND mt_name NOT LIKE 'Advance' ";
		}
		else if($params['form_id'] == 3){ //Advance Form
			$s_sql.= "AND mt_name LIKE 'Advance' ";
		}
		$s_sql.= "ORDER BY mt_name ASC";
		$b_resp = $obj_class->selectproc($s_sql);
		$obj_log->savelog($save_data_log,"get_employee_cc_list","sql=[$s_sql]");
		$datas = array();

		if ($b_resp && $obj_class->n_row>0) {
			for($i=0;$i<$obj_class->n_row;$i++){	
				$datas[$i]['memo_type_id'] = $obj_class->getitem("mt_id_pk");
				$datas[$i]['memo_type_name'] = $obj_class->getitem("mt_name");
				$datas[$i]['memo_type_detail'] = $obj_class->getitem("mt_detail");
			    $obj_class->movenext();
			}

			$json_obj->command = '1800';
			$json_obj->message = 'Get data success.';
			$json_obj->data = $datas;
		}
		else {
			$json_obj->command = '1802';
			$json_obj->message = 'Data not found.';
		}

		$obj_class->closedb();
		return $json_obj;
    }

    //1900 -- OK
	public function get_year_list() {
		$json_obj = new stdClass();
		$obj_global = new GlobalConstant();		
		$obj_log = new LogFile();		
		$save_data_log = $_SERVER["HTTP_HOST"].$_SERVER["PHP_SELF"];

		$obj_class = new Connectdb($obj_global->getHOST_CMS(), $obj_global->getUSER_CMS() , $obj_global->getPWD_CMS(), "employee",0,FALSE);

		$limit_year = 3;
		
		for($i=0;$i<=$limit_year;$i++){
			$year[$i] = intval(date("Y")) - $i;
		}

		$json_obj->command = '1900';
		$json_obj->message = 'Get data success.';
		$json_obj->year = $year;
		
		$obj_class->closedb();
		return $json_obj;
    }

    //2000 -- OK //edit api doc
	public function get_approver_list($params) {
		$json_obj = new stdClass();
		$obj_global = new GlobalConstant();		
		$obj_log = new LogFile();		
		$save_data_log = $_SERVER["HTTP_HOST"].$_SERVER["PHP_SELF"];

		$obj_class = new Connectdb($obj_global->getHOST_CMS(), $obj_global->getUSER_CMS() , $obj_global->getPWD_CMS(), "employee",0,FALSE);
		$obj_class_2 = new Connectdb($obj_global->getHOST_CMS(), $obj_global->getUSER_CMS() , $obj_global->getPWD_CMS(), "memo",0,FALSE);

		//$params['company_id'] 
		//$params['employee_id']
		//$params['memo_type_id']
		//$params['prelist_id']

		$params['employee_key'] = isset($params['employee_key'])?$params['employee_key']:'';

		if($params['prelist_id'] == 0){
			//select -> tb employee
			$s_sql = "SELECT * from memo.approval_permission ap LEFT JOIN employee.employee emp ON ap.emp_id_pk = emp.emp_id_pk WHERE emp.com_id_pk = ".$params['company_id']." AND emp.emp_status = 1 AND ap.mt_id_pk = ".$params['memo_type_id']." ";

			$s_sql.= "AND ap.emp_id_pk != ".$params['employee_id']." ";
			$s_sql.= "ORDER BY emp.emp_pos_initial ASC";
			$b_resp = $obj_class->selectproc($s_sql);
			$obj_log->savelog($save_data_log,"get_approver_list","sql=[$s_sql]");
			$datas = array();

			if ($b_resp && $obj_class->n_row>0) {
				for($i=0;$i<$obj_class->n_row;$i++){	
					$datas[$i]['employee_id'] = $obj_class->getitem("emp_id_pk");
					$datas[$i]['emp_com_id'] = $obj_class->getitem("emp_ID");
					$datas[$i]['emp_name'] = $obj_class->getitem("emp_name");
					$datas[$i]['emp_position'] = $obj_class->getitem("emp_position");
					$datas[$i]['emp_pos_initial'] = $obj_class->getitem("emp_pos_initial");
					$datas[$i]['division_id'] = $obj_class->getitem("dv_id_pk");
					$datas[$i]['department_id'] = $obj_class->getitem("dp_id_pk");
					$datas[$i]['section_id'] = $obj_class->getitem("st_id_pk");

				    $obj_class->movenext();
				}

				$json_obj->command = '2000';
				$json_obj->message = 'Get data success.';
				$json_obj->data = $datas;
			}
			else {
				$json_obj->command = '2002';
				$json_obj->message = 'Data not found.';
			}
		}
		else{
			$s_sql = "SELECT * from prelist WHERE pl_id_pk = ".$params['prelist_id']." ";
			$b_resp = $obj_class_2->selectproc($s_sql);
			$datas = array();

			if ($b_resp && $obj_class_2->n_row>0) {
				$to_emp = array();
				$count_to = 0;

				$to_emp_info = $this->get_emp_info_by_pos_initial($params['company_id'] , $obj_class_2->getitem("pl_approve"));

				if(sizeof($to_emp_info[0]) > 1){
					$count_to_emp_info = count($to_emp_info);

					for($i=0;$i<$count_to_emp_info;$i++){
						if($params['employee_id'] != $to_emp_info[$i]['emp_id']){
							$datas[$count_to]['employee_id'] = $to_emp_info[$i]['emp_id'];
							$datas[$count_to]['emp_com_id'] = $to_emp_info[$i]['emp_com_id'];
							$datas[$count_to]['emp_name'] = $to_emp_info[$i]['emp_name'];
							$datas[$count_to]['emp_position'] = $to_emp_info[$i]['emp_position'];
							$datas[$count_to]['emp_pos_initial'] = $to_emp_info[$i]['emp_pos_initial'];
							$datas[$count_to]['division_id'] = $to_emp_info[$i]['emp_dv_id'];
							$datas[$count_to]['department_id'] = $to_emp_info[$i]['emp_dp_id'];
							$datas[$count_to]['section_id'] = $to_emp_info[$i]['emp_st_id'];

							$count_to++;
						}
					}
				}

				if(count($datas) > 0){
					$json_obj->command = '2000';
					$json_obj->message = 'Get data success.';
					$json_obj->data = $datas;
				}
				else{
					$json_obj->command = '2002';
					$json_obj->message = 'Data not found.';
				}
			}
			else{
				$json_obj->command = '2002';
				$json_obj->message = 'Data not found.';
			}
		}

		$obj_class->closedb();
		return $json_obj;
    }

    //2100 -- OK //edit api doc
	public function get_employee_list($params) {
		$json_obj = new stdClass();
		$obj_global = new GlobalConstant();		
		$obj_log = new LogFile();		
		$save_data_log = $_SERVER["HTTP_HOST"].$_SERVER["PHP_SELF"];

		$obj_class = new Connectdb($obj_global->getHOST_CMS(), $obj_global->getUSER_CMS() , $obj_global->getPWD_CMS(), "employee",0,FALSE);
		$obj_class_2 = new Connectdb($obj_global->getHOST_CMS(), $obj_global->getUSER_CMS() , $obj_global->getPWD_CMS(), "memo",0,FALSE);
		$obj_class_3 = new Connectdb($obj_global->getHOST_CMS(), $obj_global->getUSER_CMS() , $obj_global->getPWD_CMS(), "employee",0,FALSE);

		//$params['company_id'] 
		//$params['employee_id']
		//$params['prelist_id']
		//$params['user_type'] -- cc / concurred / division
		
		//$params['division_id']

		$params['employee_key'] = isset($params['employee_key'])?$params['employee_key']:'';

		if($params['prelist_id'] == 0){
			if($params['user_type'] == "concurred"){
				//select -> tb employee
				$s_sql = "SELECT emp1.* from employee.employee AS emp1 ";
                $s_sql.= "WHERE emp_level NOT IN ( ";
                $s_sql.= "SELECT max(emp_level) from employee.employee AS emp2 ";
                $s_sql.= "WHERE emp1.com_id_pk in (".$params['company_id']." , 0) ";
                $s_sql.= "AND emp1.emp_status = 1 ";
                $s_sql.= "AND emp1.dv_id_pk in (emp2.dv_id_pk,0) ";
                $s_sql.= "AND emp1.dp_id_pk in (emp2.dp_id_pk,0) ";
                $s_sql.= "AND emp1.st_id_pk in (emp2.st_id_pk,0) ";
                $s_sql.= ") ";
				$s_sql.= "ORDER BY emp1.emp_name ASC ";
				$b_resp = $obj_class->selectproc($s_sql);
				$obj_log->savelog($save_data_log,"get_employee_list","sql=[$s_sql]");
				$datas = array();

				if($b_resp && $obj_class->n_row>0) { 
					$count_concurred = 0;

					for($i=0;$i<$obj_class->n_row;$i++){	
						if($params['employee_id'] != $obj_class->getitem("emp_id_pk")){
							$datas[$count_concurred]['employee_id'] = $obj_class->getitem("emp_id_pk");
							$datas[$count_concurred]['emp_com_id'] = $obj_class->getitem("emp_ID");
							$datas[$count_concurred]['emp_name'] = $obj_class->getitem("emp_name");
							$datas[$count_concurred]['emp_position'] = $obj_class->getitem("emp_position");
							$datas[$count_concurred]['emp_pos_initial'] = $obj_class->getitem("emp_pos_initial");
							$datas[$count_concurred]['division_id'] = $obj_class->getitem("dv_id_pk");
							$datas[$count_concurred]['department_id'] = $obj_class->getitem("dp_id_pk");
							$datas[$count_concurred]['section_id'] = $obj_class->getitem("st_id_pk");
							$datas[$count_concurred]['emp_dp_name'] = '-';

							$count_concurred++;
						}
						
					    $obj_class->movenext();
					}

					$json_obj->command = '2100';
					$json_obj->message = 'Get data success.';
					$json_obj->data = $datas;
				}
				else {
					$json_obj->command = '2102';
					$json_obj->message = 'Data not found.';
				}
			}
			else if($params['user_type'] == "cc"){
				//select -> tb employee
				$s_sql = "SELECT * from employee WHERE com_id_pk = ".$params['company_id']." AND emp_status = 1 ";
				$s_sql.= "ORDER BY emp_name ASC";
				$b_resp = $obj_class->selectproc($s_sql);
				$obj_log->savelog($save_data_log,"get_employee_list","sql=[$s_sql]");
				$datas = array();
				
				if($b_resp && $obj_class->n_row>0) {
					for($i=0;$i<$obj_class->n_row;$i++){	
						$datas[$i]['employee_id'] = $obj_class->getitem("emp_id_pk");
						$datas[$i]['emp_com_id'] = $obj_class->getitem("emp_ID");
						$datas[$i]['emp_name'] = $obj_class->getitem("emp_name");
						$datas[$i]['emp_position'] = $obj_class->getitem("emp_position");
						$datas[$i]['emp_pos_initial'] = $obj_class->getitem("emp_pos_initial");
						$datas[$i]['division_id'] = $obj_class->getitem("dv_id_pk");
						$datas[$i]['department_id'] = $obj_class->getitem("dp_id_pk");
						$datas[$i]['section_id'] = $obj_class->getitem("st_id_pk");
						$datas[$i]['emp_dp_name'] = '-';

					    $obj_class->movenext();
					}

					$json_obj->command = '2100';
					$json_obj->message = 'Get data success.';
					$json_obj->data = $datas;
				}
				else {
					$json_obj->command = '2102';
					$json_obj->message = 'Data not found.';
				}
			}
			else{ //$params['user_type'] == "division"
				//select -> tb employee
				$s_sql = "SELECT * from employee WHERE com_id_pk = ".$params['company_id']." AND emp_status = 1 ";
				$s_sql.= "AND dv_id_pk = ".$params['division_id']." ";
				$s_sql.= "ORDER BY emp_name ASC";
				$b_resp = $obj_class->selectproc($s_sql);
				$obj_log->savelog($save_data_log,"get_employee_list","sql=[$s_sql]");
				$datas = array();
				
				if($b_resp && $obj_class->n_row>0) {
					for($i=0;$i<$obj_class->n_row;$i++){	
						$datas[$i]['employee_id'] = $obj_class->getitem("emp_id_pk");
						$datas[$i]['emp_com_id'] = $obj_class->getitem("emp_ID");
						$datas[$i]['emp_name'] = $obj_class->getitem("emp_name");
						$datas[$i]['emp_position'] = $obj_class->getitem("emp_position");
						$datas[$i]['emp_pos_initial'] = $obj_class->getitem("emp_pos_initial");
						$datas[$i]['division_id'] = $obj_class->getitem("dv_id_pk");
						$datas[$i]['department_id'] = $obj_class->getitem("dp_id_pk");
						$datas[$i]['section_id'] = $obj_class->getitem("st_id_pk");
						$datas[$i]['emp_dp_name'] = '-';

					    $obj_class->movenext();
					}

					$json_obj->command = '2100';
					$json_obj->message = 'Get data success.';
					$json_obj->data = $datas;
				}
				else {
					$json_obj->command = '2102';
					$json_obj->message = 'Data not found.';
				}
			}
		}
		else{
			if($params['user_type'] == "concurred"){
				$s_sql = "SELECT * from prelist WHERE pl_id_pk = ".$params['prelist_id']." ";
				$b_resp = $obj_class_2->selectproc($s_sql);
				$datas = array();

				if ($b_resp && $obj_class_2->n_row>0) {
					$concurred_pos_initial_array = explode("," , $obj_class_2->getitem("pl_concurred"));
					$count_pos = count($concurred_pos_initial_array);
					$concurred_emp = array();
					$count_concurred = 0;

					for($x=0;$x<$count_pos;$x++){
						$concurred_emp_info = $this->get_emp_info_by_pos_initial($params['company_id'] , $concurred_pos_initial_array[$x]);

						if(sizeof($concurred_emp_info[0]) > 1){
							$count_concurred_emp_info = count($concurred_emp_info);

							for($i=0;$i<$count_concurred_emp_info;$i++){
								if($params['employee_id'] != $to_emp_info[$i]['emp_id']){
									$datas[$count_concurred]['employee_id'] = $concurred_emp_info[$i]['emp_id'];
									$datas[$count_concurred]['emp_com_id'] = $concurred_emp_info[$i]['emp_com_id'];
									$datas[$count_concurred]['emp_name'] = $concurred_emp_info[$i]['emp_name'];
									$datas[$count_concurred]['emp_position'] = $concurred_emp_info[$i]['emp_position'];
									$datas[$count_concurred]['emp_pos_initial'] = $concurred_emp_info[$i]['emp_pos_initial'];
									$datas[$count_concurred]['division_id'] = $concurred_emp_info[$i]['emp_dv_id'];
									$datas[$count_concurred]['department_id'] = $concurred_emp_info[$i]['emp_dp_id'];
									$datas[$count_concurred]['section_id'] = $concurred_emp_info[$i]['emp_st_id'];
									$datas[$count_concurred]['emp_dp_name'] = '-';

									$count_concurred++;
								}
							}
						}
					}

					if(count($datas) > 0){
						$json_obj->command = '2100';
						$json_obj->message = 'Get data success.';
						$json_obj->data = $datas;
					}
					else{
						$json_obj->command = '2102';
						$json_obj->message = 'Data not found.';
					}
				}
				else{
					$json_obj->command = '2102';
					$json_obj->message = 'Data not found.';
				}
			}
			else{ //$params['user_type'] == "cc"
				//select -> tb employee
				$s_sql = "SELECT * from employee WHERE com_id_pk = ".$params['company_id']." AND emp_status = 1 ";
				$s_sql.= "ORDER BY emp_name ASC";
				$b_resp = $obj_class->selectproc($s_sql);
				$obj_log->savelog($save_data_log,"get_employee_list","sql=[$s_sql]");
				$datas = array();

				if($b_resp && $obj_class->n_row>0) {
					for($i=0;$i<$obj_class->n_row;$i++){	
						$datas[$i]['employee_id'] = $obj_class->getitem("emp_id_pk");
						$datas[$i]['emp_com_id'] = $obj_class->getitem("emp_ID");
						$datas[$i]['emp_name'] = $obj_class->getitem("emp_name");
						$datas[$i]['emp_position'] = $obj_class->getitem("emp_position");
						$datas[$i]['emp_pos_initial'] = $obj_class->getitem("emp_pos_initial");
						$datas[$i]['division_id'] = $obj_class->getitem("dv_id_pk");
						$datas[$i]['department_id'] = $obj_class->getitem("dp_id_pk");
						$datas[$i]['section_id'] = $obj_class->getitem("st_id_pk");
						$datas[$i]['emp_dp_name'] = ($obj_class->getitem("dp_name"))?$obj_class->getitem("dp_name"):'-';

					    $obj_class->movenext();
					}

					$json_obj->command = '2100';
					$json_obj->message = 'Get data success.';
					$json_obj->data = $datas;
				}
				else {
					$json_obj->command = '2102';
					$json_obj->message = 'Data not found.';
				}
			}
		}		

		$obj_class->closedb();
		return $json_obj;
    }



    //2200 -- OK //edit api doc **
	public function save_draft_memo($params , $files) {
		$json_obj = new stdClass();
		$obj_global = new GlobalConstant();		
		$obj_log = new LogFile();		
		$save_data_log = $_SERVER["HTTP_HOST"].$_SERVER["PHP_SELF"];

		$obj_class = new Connectdb($obj_global->getHOST_CMS(), $obj_global->getUSER_CMS() , $obj_global->getPWD_CMS(), "memo",0,FALSE);

		//$params['company_id']
		//$params['employee_id']
		//$params['memo_id']
		//$params['memo_form_id'] //1 = finanace , 2 = non finance , 3 = advance
		//$params['notice_type'] //1 = send to level , 2 = send all
		//$params['memo_no_id']	
		//$params['prelist_id'] //0 = other
		//$params['prelist_name']
		//$params['memo_type']
		//$params['memo_budget'] //yes , no
		//$params['memo_amount'] 
		//$params['to_employee']
		//$params['concurred_employee'] 
		//$params['cc_employee']
		//$params['memo_detail']

		//$params['memo_format_id']

		//advance memo
		//$params['advance_form_id']
		//$params['advance_no']
		//$params['confirm_payment_employee']
		//$params['sub_type'] -- Approve / Clear / Over paid

		//$params['attach_file_x']


		//'{"to_emp" :[{"to_emp_com_id": "34664", "to_emp_pos_initial": "MACM"}]}'
		
		//'{"concurred_emp" :[{"concurred_emp_com_id": "34666", "concurred_emp_pos_initial": "CEM"},{"concurred_emp_com_id": "44037","concurred_emp_pos_initial": "SA"}]}'
		//'{"concurred_emp" :[{"concurred_emp_com_id":"","concurred_emp_pos_initial":""}]}'
		
		//'{"cc_emp" :[{"cc_emp_com_id": "43460", "cc_emp_pos_initial": "WMPA"},{"cc_emp_com_id": "42674","cc_emp_pos_initial": "WMPA"}]}'
		//'{"cc_emp" :[{"cc_emp_com_id":"","cc_emp_pos_initial":""}]}'

		//'{"memo_type" :[{"memo_type_id": "11", "memo_type_name": "Non Financial"}]}'

		//'{"confirm_payment_emp" :[{"confirm_payment_emp_com_id": "43460", "confirm_payment_emp_name": "สันติพงศ์ จารัตน์"}]}'


		$params['memo_format_id'] = (isset($params['memo_format_id']) && ($params['memo_format_id'] != ''))?$params['memo_format_id']:$params['memo_form_id'];

		$mm_format_id = $params['memo_form_id'];
		$mf_id_pk = $params['memo_format_id'];

		
		$to_employee = json_decode(str_replace("\\",'',$params['to_employee']));
		$concurred_employee = json_decode(str_replace("\\",'',$params['concurred_employee']));
		$cc_employee = json_decode(str_replace("\\",'',$params['cc_employee']));
		$mm_type = json_decode(str_replace("\\",'',$params['memo_type']));

		$to_emp_com_id = $to_employee->to_emp[0]->to_emp_com_id;
		$to_emp_pos_initial = $to_employee->to_emp[0]->to_emp_pos_initial;

		$count_concurred = count($concurred_employee->concurred_emp);
		for($i=0;$i<$count_concurred;$i++){
			if($i == 0){
				$concurred_emp_com_id = ($concurred_employee->concurred_emp[$i]->concurred_emp_com_id)?$concurred_employee->concurred_emp[$i]->concurred_emp_com_id:null;
				$concurred_emp_pos_initial = ($concurred_employee->concurred_emp[$i]->concurred_emp_pos_initial)?$concurred_employee->concurred_emp[$i]->concurred_emp_pos_initial:null;
			}
			else{
				$concurred_emp_com_id.= ",".$concurred_employee->concurred_emp[$i]->concurred_emp_com_id;
				$concurred_emp_pos_initial.= ",".$concurred_employee->concurred_emp[$i]->concurred_emp_pos_initial;
			}
		}

		$count_cc = count($cc_employee->cc_emp);
		for($i=0;$i<$count_cc;$i++){
			if($i == 0){
				$cc_emp_com_id = ($cc_employee->cc_emp[$i]->cc_emp_com_id != '')?$cc_employee->cc_emp[$i]->cc_emp_com_id:null;
				$cc_emp_pos_initial = ($cc_employee->cc_emp[$i]->cc_emp_pos_initial != '')?$cc_employee->cc_emp[$i]->cc_emp_pos_initial:null;
			}
			else{
				$cc_emp_com_id.= ",".$cc_employee->cc_emp[$i]->cc_emp_com_id;
				$cc_emp_pos_initial.= ",".$cc_employee->cc_emp[$i]->cc_emp_pos_initial;
			}
		}

		$memo_type_id = $mm_type->memo_type[0]->memo_type_id;
		$memo_type_name = $mm_type->memo_type[0]->memo_type_name;

		//advance memo
		if($params['confirm_payment_employee'] != ''){
			$confirm_payment_employee = json_decode(str_replace("\\",'',$params['confirm_payment_employee']));

			$confirm_payment_emp_com_id = $confirm_payment_employee->confirm_payment_emp[0]->confirm_payment_emp_com_id;
			$confirm_payment_emp_name = $confirm_payment_employee->confirm_payment_emp[0]->confirm_payment_emp_name;
		}

		$emp_info = $this->get_emp_info_by_emp_id($params['company_id'] , $params['employee_id']);
		
		if(sizeof($emp_info[0]) > 1){
			if($concurred_emp_com_id != null){	
				$memo_status_id = 1;
				$memo_status_name = 'Wait for Agree';
			}
			else{
				$memo_status_id = 3;
				$memo_status_name = 'Wait for Approve';
			}

			if($params['memo_id'] == 0){
				//insert
				$s_sql_1 = "INSERT INTO memo (mm_NO , pl_id_pk , mm_subject ";
				$s_sql_1.= ", mt_id_pk , mm_sub_type , mno_id_pk ";
				$s_sql_1.= ", mm_amount , mm_budget ";
				$s_sql_1.= ", mm_to , mm_to_emp_ID ";
				$s_sql_1.= ", mm_concurred , mm_concurred_emp_ID ";
				$s_sql_1.= ", mm_cc , mm_cc_emp_ID ";
				$s_sql_1.= ", mm_from , mm_from_emp_ID ";
				$s_sql_1.= ", mm_detail , mm_created_date , mm_modified_date , mst_id_pk , mm_status ";
				$s_sql_1.= ", mf_id_pk , mm_format_id , com_id_pk , emp_id_pk ";
				$s_sql_1.= ", emp_ID , mm_approve_date , mm_revise , mm_noti_type , mm_path , mm_issue_date ";
				$s_sql_1.= ", mm_sub_type_ad , avf_id_pk , mm_advancefromNO , mm_confirm_payment , mm_confirm_payment_emp_ID) ";
				$s_sql_1.= "VALUES (NULL , ".$params['prelist_id']." , '".$params['prelist_name']."' ";
				$s_sql_1.= ", ".$memo_type_id." , '".$memo_type_name."' , ".$params['memo_no_id']." ";
				$s_sql_1.= ", ".$params['memo_amount']." , '".strtolower($params['memo_budget'])."' ";
				$s_sql_1.= ", '".$to_emp_pos_initial."' , '".$to_emp_com_id."' ";

				if($concurred_emp_com_id != null){
					$s_sql_1.= ", '".$concurred_emp_pos_initial."' , '".$concurred_emp_com_id."' ";
				}
				else{
					$s_sql_1.= ", NULL , NULL ";
				}

				if($cc_emp_com_id != null){
					$s_sql_1.= ", '".$cc_emp_pos_initial."' , '".$cc_emp_com_id."' ";
				}
				else{
					$s_sql_1.= ", NULL , NULL ";
				}

				$s_sql_1.= ", '".$emp_info[0]['emp_pos_initial']."' , '".$emp_info[0]['emp_com_id']."' ";
				$s_sql_1.= ", '".$params['memo_detail']."' , NOW() , NOW() , ".$memo_status_id." , '".$memo_status_name."' ";
				$s_sql_1.= ", ".$mf_id_pk." , ".$mm_format_id." , ".$params['company_id']." , ".$params['employee_id']." ";
				$s_sql_1.= ", '".$emp_info[0]['emp_com_id']."' , NULL , 0 , ".$params['notice_type']." , NULL , NULL ";

				//advance memo
				if($mm_format_id == 3){
					$s_sql_1.= ", '".$params['sub_type']."' , ".$params['advance_form_id']." , '".$params['advance_no']."' ";
					$s_sql_1.= ", '".$confirm_payment_emp_name."' , '".$confirm_payment_emp_com_id."' ";
				}
				else{
					$s_sql_1.= ", NULL , NULL , NULL , NULL , NULL ";
				}

				$s_sql_1.= ") ";

				$b_flag_1 = $obj_class->manageproc($s_sql_1);
				$obj_log->savelog($save_data_log,"save_draft_memo -> insert -> memo","sql=[$s_sql_1]");

				$mm_last_id = $this->get_memo_last_id();
			}
			else{
				//update
				$s_sql_1 = "UPDATE memo ";
				$s_sql_1.= "SET pl_id_pk = ".$params['prelist_id']." , mm_subject = '".$params['prelist_name']."' ";
				$s_sql_1.= ", mt_id_pk = ".$memo_type_id." , mm_sub_type = '".$memo_type_name."' ";
				$s_sql_1.= ", mno_id_pk = ".$params['memo_no_id']." ";
				$s_sql_1.= ", mm_amount = ".$params['memo_amount']." , mm_budget = '".strtolower($params['memo_budget'])."' ";
				$s_sql_1.= ", mm_to = '".$to_emp_pos_initial."' , mm_to_emp_ID = '".$to_emp_com_id."' ";
				
				if($concurred_emp_com_id != null){
					$s_sql_1.= ", mm_concurred = '".$concurred_emp_pos_initial."' , mm_concurred_emp_ID = '".$concurred_emp_com_id."' ";
				}
				else{
					$s_sql_1.= ", mm_concurred = NULL , mm_concurred_emp_ID = NULL ";
				}

				if($cc_emp_com_id != null){
					$s_sql_1.= ", mm_cc = '".$cc_emp_pos_initial."' , mm_cc_emp_ID = '".$cc_emp_com_id."' ";
				}
				else{
					$s_sql_1.= ", mm_cc = NULL , mm_cc_emp_ID = NULL ";
				}

				$s_sql_1.= ", mm_from = '".$emp_info[0]['emp_pos_initial']."' , mm_from_emp_ID = '".$emp_info[0]['emp_com_id']."' ";
				$s_sql_1.= ", mm_detail = '".$params['memo_detail']."' , mm_modified_date = NOW() ";
				$s_sql_1.= ", mst_id_pk = ".$memo_status_id." , mm_status = '".$memo_status_name."' , mf_id_pk = ".$mf_id_pk." ";
				$s_sql_1.= ", com_id_pk = ".$params['company_id']." , emp_id_pk = ".$params['employee_id']." ";
				$s_sql_1.= ", emp_ID = '".$emp_info[0]['emp_com_id']."' , mm_revise = 0 ";
				$s_sql_1.= ", mm_noti_type = ".$params['notice_type']." ";

				//advance memo
				if($mm_format_id == 3){
					$s_sql_1.= ", mm_sub_type_ad = '".$params['sub_type']."' , mm_confirm_payment = '".$confirm_payment_emp_name."' ";
					$s_sql_1.= ", mm_confirm_payment_emp_ID = '".$confirm_payment_emp_com_id."' ";
				}

				$s_sql_1.= "WHERE mm_id_pk = ".$params['memo_id']." ";
				$b_flag_1 = $obj_class->manageproc($s_sql_1);
				$obj_log->savelog($save_data_log,"save_draft_memo -> update -> memo","sql=[$s_sql_1]");

				$mm_last_id = $params['memo_id'];
			}	

			if($b_flag_1){
				if($params['memo_id'] == 0){
					$s_sql_2 = "INSERT INTO draft_memo (mm_id_pk , dm_status , dm_created_date , dm_modified_date , emp_id_pk , com_id_pk) ";
					$s_sql_2.= "VALUES (".$mm_last_id." , 1 , NOW() , NOW() , ".$params['employee_id']." , ".$params['company_id'].") ";
					$b_flag_2 = $obj_class->manageproc($s_sql_2);
					$obj_log->savelog($save_data_log,"save_draft_memo -> insert -> draft_memo","sql=[$s_sql_2]");

					if($b_flag_2){
						$count_file = count($files);
						if($count_file > 0){
							$path = "../EdC/".$params['company_id']."/memo_attach_file/".$mm_last_id."/";
							$thumb_path = "../EdC/".$params['company_id']."/memo_thumb_attach_file/".$mm_last_id."/";

							if(!(file_exists($path))){
								mkdir($path, 0777, true);
							}
							if(!(file_exists($thumb_path))){
								mkdir($thumb_path, 0777, true);
							}

							for($i=0;$i<$count_file;$i++){
								$j = $i+1;

								$files['attach_file_'.$i] = isset($files['attach_file_'.$i])?$files['attach_file_'.$i]:'';
								
								$file_name = date('Ymd_His_').$j.'_'.$mm_last_id.'.jpg';
								$file_size = $files['attach_file_'.$i]['size'];
								$file_tmp = $files['attach_file_'.$i]['tmp_name'];
								$file_type = $files['attach_file_'.$i]['type'];
								$file_ext = strtolower(end(explode('.',$files['attach_file_'.$i]['name'])));
							
								$expensions = array("jpeg","jpg","png");

								$errors = '{"result_code":1,"result_desc":"success"}';
								if(in_array($file_ext,$expensions) === false){
									$json_obj->command = '2206';
									$json_obj->message = 'Save draft memo fail - please choose a JPEG or PNG file.';
								}
								else if($files['attach_file_'.$i]['size'] == 0){
									$json_obj->command = '2207';
									$json_obj->message = 'Save draft memo fail - post max file must be exactly 8 MB.';
								}
								else if($files['attach_file_'.$i]['size'] > 2097152){
									$json_obj->command = '2208';
									$json_obj->message = 'Save draft memo fail - file size must be exactly 2 MB.';
								}
								else {
									move_uploaded_file($file_tmp , $path.$file_name);
									$this->generate_image_thumbnail($path.$file_name, $thumb_path.$file_name);

									$s_sql_3 = "INSERT INTO memo_attachfile (mm_id_pk , ma_path , ma_created_date , ma_modified_date , com_id_pk) VALUES (".$mm_last_id." , '".$file_name."' , NOW() , NOW() , ".$params['company_id'].") ";
									$b_flag_3 = $obj_class->manageproc($s_sql_3);
									$obj_log->savelog($save_data_log,"save_draft_memo -> insert -> memo_attachfile","sql=[$s_sql_3]");

									if($b_flag_3){
										$json_obj->command = '2200';
										$json_obj->message = 'Save draft memo success.';
									}
									else{
										$json_obj->command = '2205';
										$json_obj->message = 'Save draft memo fail - insert memo_attachfile fail.';
									}
								}
							}
						}
						else{
							$json_obj->command = '2200';
							$json_obj->message = 'Save draft memo success.';
						}
					}
					else{
						$json_obj->command = '2204';
						$json_obj->message = 'Save draft memo fail - insert draft_memo fail.';
					}
				}
				else{
					$s_sql_2 = "UPDATE draft_memo ";
					$s_sql_2.= "SET dm_modified_date = NOW() ";
					$s_sql_2.= "WHERE mm_id_pk = ".$params['memo_id']." ";
					$b_flag_2 = $obj_class->manageproc($s_sql_2);
					$obj_log->savelog($save_data_log,"save_draft_memo -> update -> draft_memo","sql=[$s_sql_2]");

					if($b_flag_2){
						$count_file = count($files);
						if($count_file > 0){
							$path = "../EdC/".$params['company_id']."/memo_attach_file/".$params['memo_id']."/";
							$thumb_path = "../EdC/".$params['company_id']."/memo_thumb_attach_file/".$params['memo_id']."/";
							
							if(!(file_exists($path))){
								mkdir($path, 0777, true);
							}
							if(!(file_exists($thumb_path))){
								mkdir($thumb_path, 0777, true);
							}
							
							
							//delete old attach file (files and db)
							// $s_sql_0 = "SELECT * FROM memo_attachfile WHERE mm_id_pk = ".$params['memo_id']." ";
							// $b_resp_0 = $obj_class->selectproc($s_sql_0);
							// if($b_resp_0 && $obj_class->n_row>0) {
							// 	for($i=0;$i<$obj_class->n_row;$i++){	
							// 		$old_attach_file = $obj_class->getitem("ma_path");
							// 		unlink($path.$old_attach_file);

							// 	    $obj_class->movenext();
							// 	}

							// 	$s_sql_00 = "DELETE FROM memo_attachfile WHERE mm_id_pk = ".$params['memo_id']." ";
							// 	$b_resp_00 = $obj_class->manageproc($s_sql_00);
							// }
							

							for($i=0;$i<$count_file;$i++){
								$j = $i+1;

								$files['attach_file_'.$i] = isset($files['attach_file_'.$i])?$files['attach_file_'.$i]:'';
								
								$file_name = date('Ymd_His_').$j.'_'.$params['memo_id'].'.jpg';
								$file_size = $files['attach_file_'.$i]['size'];
								$file_tmp = $files['attach_file_'.$i]['tmp_name'];
								$file_type = $files['attach_file_'.$i]['type'];
								$file_ext = strtolower(end(explode('.',$files['attach_file_'.$i]['name'])));
							
								$expensions = array("jpeg","jpg","png");

								$errors = '{"result_code":1,"result_desc":"success"}';
								if(in_array($file_ext,$expensions) === false){
									$json_obj->command = '2206';
									$json_obj->message = 'Save draft memo fail - please choose a JPEG or PNG file.';
								}
								else if($files['attach_file_'.$i]['size'] == 0){
									$json_obj->command = '2207';
									$json_obj->message = 'Save draft memo fail - post max file must be exactly 8 MB.';
								}
								else if($files['attach_file_'.$i]['size'] > 2097152){
									$json_obj->command = '2208';
									$json_obj->message = 'Save draft memo fail - file size must be exactly 2 MB.';
								}
								else {
									move_uploaded_file($file_tmp , $path.$file_name);
									$this->generate_image_thumbnail($path.$file_name, $thumb_path.$file_name);

									$s_sql_3 = "INSERT INTO memo_attachfile (mm_id_pk , ma_path , ma_created_date , ma_modified_date , com_id_pk) ";
									$s_sql_3.= "VALUES (".$params['memo_id']." , '".$file_name."' , NOW() , NOW() , ".$params['company_id'].") ";
									$b_flag_3 = $obj_class->manageproc($s_sql_3);
									$obj_log->savelog($save_data_log,"save_draft_memo -> insert -> memo_attachfile","sql=[$s_sql_3]");

									if($b_flag_3){
										$json_obj->command = '2200';
										$json_obj->message = 'Save draft memo success.';
									}
									else{
										$json_obj->command = '2205';
										$json_obj->message = 'Save draft memo fail - insert memo_attachfile fail.';
									}
								}
							}
						}
						else{
							$json_obj->command = '2200';
							$json_obj->message = 'Save draft memo success.';
						}
					}
					else{
						$json_obj->command = '2204';
						$json_obj->message = 'Save draft memo fail - update draft_memo fail.';
					}
				}		
			}
			else{
				$json_obj->command = '2203';
				$json_obj->message = 'Save draft memo fail - insert memo fail.';
				$json_obj->sql = $s_sql_1;
			}
		}
		else{
			$json_obj->command = '2202';
			$json_obj->message = 'Data is invalid. (emp_info)';
		}
		
		$obj_class->closedb();
		return $json_obj;
    }

    //2300 -- OK //edit api doc **
	public function insert_memo($params , $files) {
		$json_obj = new stdClass();
		$obj_global = new GlobalConstant();		
		$obj_log = new LogFile();		
		$save_data_log = $_SERVER["HTTP_HOST"].$_SERVER["PHP_SELF"];

		$obj_class = new Connectdb($obj_global->getHOST_CMS(), $obj_global->getUSER_CMS() , $obj_global->getPWD_CMS(), "memo",0,FALSE);
		$obj_class_2 = new Connectdb($obj_global->getHOST_CMS(), $obj_global->getUSER_CMS() , $obj_global->getPWD_CMS(), "memo",0,FALSE);

		//$params['company_id']
		//$params['employee_id']
		//$params['memo_form_id'] //1 = finanace , 2 = non finance , 3 = advance
		//$params['notice_type'] //1 = send to level , 2 = send all
		//$params['memo_no_id']	
		//$params['prelist_id'] //0 = other
		//$params['prelist_name']
		//$params['memo_type']
		//$params['memo_budget'] //yes , no
		//$params['memo_amount'] 
		//$params['to_employee']
		//$params['concurred_employee'] 
		//$params['cc_employee']
		//$params['memo_detail']

		//$params['memo_format_id']

		//advance memo
		//$params['advance_form_id']
		//$params['advance_no']
		//$params['confirm_payment_employee']
		//$params['sub_type'] -- Approve / Clear / Overpaid

		//$params['attach_file_x']


		//'{"to_emp" :[{"to_emp_com_id": "34664", "to_emp_pos_initial": "MACM"}]}'
		
		//'{"concurred_emp" :[{"concurred_emp_com_id": "34666", "concurred_emp_pos_initial": "CEM"},{"concurred_emp_com_id": "44037","concurred_emp_pos_initial": "SA"}]}'
		//'{"concurred_emp" :[{"concurred_emp_com_id":"","concurred_emp_pos_initial":""}]}'
		
		//'{"cc_emp" :[{"cc_emp_com_id": "43460", "cc_emp_pos_initial": "WMPA"},{"cc_emp_com_id": "42674","cc_emp_pos_initial": "WMPA"}]}'
		//'{"cc_emp" :[{"cc_emp_com_id":"","cc_emp_pos_initial":""}]}'

		//'{"memo_type" :[{"memo_type_id": "11", "memo_type_name": "Non Financial"}]}'

		//'{"confirm_payment_emp" :[{"confirm_payment_emp_com_id": "43460", "confirm_payment_emp_name": "สันติพงศ์ จารัตน์"}]}'


		$params['memo_format_id'] = (isset($params['memo_format_id']) && ($params['memo_format_id'] != ''))?$params['memo_format_id']:$params['memo_form_id'];

		$mm_format_id = $params['memo_form_id'];
		$mf_id_pk = $params['memo_format_id'];


		//get now running no
		$s_sql = "SELECT * from memo_NO WHERE mno_id_pk = ".$params['memo_no_id']." ";
		$b_resp = $obj_class->selectproc($s_sql);
		$datas = array();

		if($b_resp && $obj_class->n_row>0) {	
			$now_running_no = $obj_class->getitem("mno_running_no");
			$next_running_no = ((int)$obj_class->getitem("mno_running_no"))+1;
			$show_running_no = str_pad($next_running_no, 5, "0", STR_PAD_LEFT);

			if($obj_class->getitem("mno_format_memoNo") == 'C-xxxxx-YYYYMMDDhhmm'){
				$memo_no = $obj_class->getitem("mno_key_name").'-'.$show_running_no.'-'.$obj_class->getitem("mno_year").date("mdHi");
			}
			else if($obj_class->getitem("mno_format_memoNo") == 'CYYYY/xxxxx'){
				$memo_no = $obj_class->getitem("mno_key_name").'/'.$show_running_no;
			}
			else if($obj_class->getitem("mno_format_memoNo") == 'C/YYYYxxxxx'){
				$memo_no = $obj_class->getitem("mno_key_name").'/'.$obj_class->getitem("mno_year").$show_running_no;
			}
			else if($obj_class->getitem("mno_format_memoNo") == 'C xxxxx/YYYY'){
				$memo_no = $obj_class->getitem("mno_key_name").' '.$show_running_no.'/'.$obj_class->getitem("mno_year");
			}

			$memo_format_date = $obj_class->getitem("mno_format_date");

			//update next running no
			$s_sql_3 = "UPDATE memo_NO ";
			$s_sql_3.= "SET mno_running_no = '".$show_running_no."' , mno_modified_date = NOW() ";
			$s_sql_3.= "WHERE mno_id_pk = '".$params['memo_no_id']."' ";
			$b_flag_3 = $obj_class->manageproc($s_sql_3);
		}

		
		$to_employee = json_decode(str_replace("\\",'',$params['to_employee']));
		$concurred_employee = json_decode(str_replace("\\",'',$params['concurred_employee']));
		$cc_employee = json_decode(str_replace("\\",'',$params['cc_employee']));
		$mm_type = json_decode(str_replace("\\",'',$params['memo_type']));

		$to_emp_com_id = $to_employee->to_emp[0]->to_emp_com_id;
		$to_emp_pos_initial = $to_employee->to_emp[0]->to_emp_pos_initial;

		$count_concurred = count($concurred_employee->concurred_emp);
		for($i=0;$i<$count_concurred;$i++){
			if($i == 0){
				$concurred_emp_com_id = ($concurred_employee->concurred_emp[$i]->concurred_emp_com_id != '')?$concurred_employee->concurred_emp[$i]->concurred_emp_com_id:null;
				$concurred_emp_pos_initial = ($concurred_employee->concurred_emp[$i]->concurred_emp_pos_initial != '')?$concurred_employee->concurred_emp[$i]->concurred_emp_pos_initial:null;
			}
			else{
				$concurred_emp_com_id.= ",".$concurred_employee->concurred_emp[$i]->concurred_emp_com_id;
				$concurred_emp_pos_initial.= ",".$concurred_employee->concurred_emp[$i]->concurred_emp_pos_initial;
			}
		}

		$count_cc = count($cc_employee->cc_emp);
		for($i=0;$i<$count_cc;$i++){
			if($i == 0){
				$cc_emp_com_id = ($cc_employee->cc_emp[$i]->cc_emp_com_id != '')?$cc_employee->cc_emp[$i]->cc_emp_com_id:null;
				$cc_emp_pos_initial = ($cc_employee->cc_emp[$i]->cc_emp_pos_initial != '')?$cc_employee->cc_emp[$i]->cc_emp_pos_initial:null;
			}
			else{
				$cc_emp_com_id.= ",".$cc_employee->cc_emp[$i]->cc_emp_com_id;
				$cc_emp_pos_initial.= ",".$cc_employee->cc_emp[$i]->cc_emp_pos_initial;
			}
		}

		$memo_type_id = $mm_type->memo_type[0]->memo_type_id;
		$memo_type_name = $mm_type->memo_type[0]->memo_type_name;

		//advance memo
		if($params['confirm_payment_employee'] != ''){
			$confirm_payment_employee = json_decode(str_replace("\\",'',$params['confirm_payment_employee']));

			$confirm_payment_emp_com_id = $confirm_payment_employee->confirm_payment_emp[0]->confirm_payment_emp_com_id;
			$confirm_payment_emp_name = $confirm_payment_employee->confirm_payment_emp[0]->confirm_payment_emp_name;
		}

		$emp_info = $this->get_emp_info_by_emp_id($params['company_id'] , $params['employee_id']);
		$from_emp_name = $emp_info[0]['emp_name'];
		
		if(sizeof($emp_info[0]) > 1){
			if($concurred_emp_com_id != null){
				$first_notice_emp_com_id = $concurred_employee->concurred_emp[0]->concurred_emp_com_id;
				$first_notice_emp_info = $this->get_emp_info_by_emp_com_id($params['company_id'] , $first_notice_emp_com_id);	
				$memo_status_id = 1;
				$memo_status_name = 'Wait for Agree';
			}
			else{
				$first_notice_emp_com_id = $to_emp_com_id;
				$first_notice_emp_info = $this->get_emp_info_by_emp_com_id($params['company_id'] , $first_notice_emp_com_id);
				$memo_status_id = 3;
				$memo_status_name = 'Wait for Approve';
			}

			$s_sql_1 = "INSERT INTO memo (mm_NO , pl_id_pk , mm_subject ";
			$s_sql_1.= ", mt_id_pk , mm_sub_type , mno_id_pk ";
			$s_sql_1.= ", mm_amount , mm_budget ";
			$s_sql_1.= ", mm_to , mm_to_emp_ID ";
			$s_sql_1.= ", mm_concurred , mm_concurred_emp_ID ";
			$s_sql_1.= ", mm_cc , mm_cc_emp_ID ";
			$s_sql_1.= ", mm_from , mm_from_emp_ID ";
			$s_sql_1.= ", mm_detail , mm_created_date , mm_modified_date , mst_id_pk , mm_status ";
			$s_sql_1.= ", mf_id_pk , mm_format_id , com_id_pk , emp_id_pk ";
			$s_sql_1.= ", emp_ID , mm_approve_date , mm_revise , mm_noti_type , mm_path , mm_issue_date ";
			$s_sql_1.= ", mm_sub_type_ad , avf_id_pk , mm_advancefromNO , mm_confirm_payment , mm_confirm_payment_emp_ID) ";
			$s_sql_1.= "VALUES ('".$memo_no."' , ".$params['prelist_id']." , '".$params['prelist_name']."' ";
			$s_sql_1.= ", ".$memo_type_id." , '".$memo_type_name."' , ".$params['memo_no_id']." ";
			$s_sql_1.= ", ".$params['memo_amount']." , '".strtolower($params['memo_budget'])."' ";
			$s_sql_1.= ", '".$to_emp_pos_initial."' , '".$to_emp_com_id."' ";

			if($concurred_emp_com_id != null){
				$s_sql_1.= ", '".$concurred_emp_pos_initial."' , '".$concurred_emp_com_id."' ";
			}
			else{
				$s_sql_1.= ", NULL , NULL ";
			}

			if($cc_emp_com_id != null){
				$s_sql_1.= ", '".$cc_emp_pos_initial."' , '".$cc_emp_com_id."' ";
			}
			else{
				$s_sql_1.= ", NULL , NULL ";
			}

			$s_sql_1.= ", '".$emp_info[0]['emp_pos_initial']."' , '".$emp_info[0]['emp_com_id']."' ";
			$s_sql_1.= ", '".$params['memo_detail']."' , NOW() , NOW() , ".$memo_status_id." , '".$memo_status_name."' ";
			$s_sql_1.= ", ".$mf_id_pk." , ".$mm_format_id." , ".$params['company_id']." , ".$params['employee_id']." ";
			$s_sql_1.= ", '".$emp_info[0]['emp_com_id']."' , NULL , 0 , ".$params['notice_type']." , NULL , NOW() ";

			//advance memo
			if($mm_format_id == 3){
				$s_sql_1.= ", '".$params['sub_type']."' , ".$params['advance_form_id']." , '".$params['advance_no']."' ";
				$s_sql_1.= ", '".$confirm_payment_emp_name."' , '".$confirm_payment_emp_com_id."' ";
			}
			else{
				$s_sql_1.= ", NULL , NULL , NULL , NULL , NULL ";
			}

			$s_sql_1.= ") ";

			$b_flag_1 = $obj_class->manageproc($s_sql_1);
			$obj_log->savelog($save_data_log,"insert_memo -> insert -> memo","sql=[$s_sql_1]");

			$mm_last_id = $this->get_memo_last_id();

			if($b_flag_1){
				$s_sql_2 = "INSERT INTO memo_history (mm_id_pk , mmh_status , mmh_comment , mmh_name , mmh_pos , emp_id_pk , emp_ID ";
				$s_sql_2.= ", mmh_approve_date , mmh_issue_date , mmh_created_date , mmh_modified_date , mmh_signature , com_id_pk) ";
				$s_sql_2.= "VALUES (".$mm_last_id." , '".$memo_status_name."' , NULL , '".$first_notice_emp_info[0]['emp_name']."' ";
				$s_sql_2.= ", '".$first_notice_emp_info[0]['emp_position']."' , ".$first_notice_emp_info[0]['emp_id']." ";
				$s_sql_2.= ", '".$first_notice_emp_com_id."' , NULL , NOW() , NOW() , NOW() , NULL ";
				$s_sql_2.= ", ".$params['company_id'].") ";
				$b_flag_2 = $obj_class->manageproc($s_sql_2);
				$obj_log->savelog($save_data_log,"insert_memo -> insert -> memo_history","sql=[$s_sql_2]");

				if($b_flag_2){
					if($mm_format_id == 3){
						$confirm_payment_emp_info = $this->get_emp_info_by_emp_com_id($params['company_id'] , $confirm_payment_emp_com_id);
	
						//insert -> tb advance_history
						$s_sql_4 = "INSERT INTO advance_history (avf_id_pk , avh_emp_ID ";
						$s_sql_4.= ", avh_emp_name , avh_pos ";
						$s_sql_4.= ", avh_type , avh_created_date , avh_remark) ";
						$s_sql_4.= "VALUES (".$params['advance_form_id']." , '".$confirm_payment_emp_com_id."' ";
						$s_sql_4.= ", '".$confirm_payment_emp_info[0]['emp_name']."' , '".$confirm_payment_emp_info[0]['emp_pos_initial']."' ";
						$s_sql_4.= ", 'Wait for Payment' , NOW() , NULL)";
						$b_flag_4 = $obj_class_2->manageproc($s_sql_4);
					}

					$count_file = count($files);

					if($count_file > 0){
						$path = "../EdC/".$params['company_id']."/memo_attach_file/".$mm_last_id."/";
						$thumb_path = "../EdC/".$params['company_id']."/memo_thumb_attach_file/".$mm_last_id."/";

						if(!(file_exists($path))){
							mkdir($path, 0777, true);
						}
						if(!(file_exists($thumb_path))){
							mkdir($thumb_path, 0777, true);
						}

						for($i=0;$i<$count_file;$i++){
							$j = $i+1;

							$files['attach_file_'.$i] = isset($files['attach_file_'.$i])?$files['attach_file_'.$i]:'';
							
							$file_name = date('Ymd_His_').$j.'_'.$mm_last_id.'.jpg';
							$file_size = $files['attach_file_'.$i]['size'];
							$file_tmp = $files['attach_file_'.$i]['tmp_name'];
							$file_type = $files['attach_file_'.$i]['type'];
							$file_ext = strtolower(end(explode('.',$files['attach_file_'.$i]['name'])));
						
							$expensions = array("jpeg","jpg","png");

							$errors = '{"result_code":1,"result_desc":"success"}';
							if(in_array($file_ext,$expensions) === false){
								$json_obj->command = '2306';
								$json_obj->message = 'Insert memo fail - please choose a JPEG or PNG file.';
							}
							else if($files['attach_file_'.$i]['size'] == 0){
								$json_obj->command = '2307';
								$json_obj->message = 'Insert memo fail - post max file must be exactly 8 MB.';
							}
							else if($files['attach_file_'.$i]['size'] > 2097152){
								$json_obj->command = '2308';
								$json_obj->message = 'Insert memo fail - file size must be exactly 2 MB.';
							}
							else {
								move_uploaded_file($file_tmp , $path.$file_name);
								$this->generate_image_thumbnail($path.$file_name, $thumb_path.$file_name);

								$s_sql_3 = "INSERT INTO memo_attachfile (mm_id_pk , ma_path , ma_created_date , ma_modified_date , com_id_pk) ";
								$s_sql_3.= "VALUES (".$mm_last_id." , '".$file_name."' , NOW() , NOW() , ".$params['company_id'].") ";
								$b_flag_3 = $obj_class->manageproc($s_sql_3);
								$obj_log->savelog($save_data_log,"insert_memo -> insert -> memo_attachfile","sql=[$s_sql_3]");

								if($b_flag_3){
									$json_obj->command = '2300';
									$json_obj->message = 'Insert memo success.';
								}
								else{
									$json_obj->command = '2305';
									$json_obj->message = 'Insert memo fail - insert memo_attachfile fail.';
								}
							}
						}
					}
					else{
						$json_obj->command = '2300';
						$json_obj->message = 'Insert memo success.';
					}
				}
				else{
					$json_obj->command = '2304';
					$json_obj->message = 'Insert memo fail - insert memo_history fail.';
				}
			}
			else{
				$json_obj->command = '2303';
				$json_obj->message = 'Insert memo fail - insert memo fail.'; 
			}
		}
		else{
			$json_obj->command = '2302';
			$json_obj->message = 'Data is invalid. (emp_info)';
		}


		

		if($json_obj->command == '2300'){

			/*
			if($concurred_emp_com_id != null){
				$first_notice_emp_com_id = $concurred_employee->concurred_emp[0]->concurred_emp_com_id;
				$first_notice_emp_info = $this->get_emp_info_by_emp_com_id($params['company_id'] , $first_notice_emp_com_id);	
				$memo_status_name = 'Wait for Agree';
			}
			else{
				$first_notice_emp_com_id = $to_emp_com_id;
				$first_notice_emp_info = $this->get_emp_info_by_emp_com_id($params['company_id'] , $first_notice_emp_com_id);
				$memo_status_name = 'Wait for Approve';
			}
			*/

			$result = $this->add_summary_profile($params['company_id'] , $first_notice_emp_com_id , $memo_status_name);

			if($result){
				if($params['notice_type'] == 1){ //1 = send to level 
					//send notice to first concurred employee or to employee
					$emp_com_id = $first_notice_emp_com_id;
					$emp_id_get_notice = $first_notice_emp_info[0]['emp_id'];
					$device_type = $first_notice_emp_info[0]['emp_device_type'];
					$push_token = $first_notice_emp_info[0]['emp_gcm_token'];
					$emp_name = $first_notice_emp_info[0]['emp_name'];
					$emp_email = $first_notice_emp_info[0]['emp_email'];
					
					$map_emp_notice = $this->get_map_emp_notice($params['company_id'] , $emp_com_id);

			     	for($j=0;$j<count($map_emp_notice);$j++){
			     		if(($map_emp_notice[$j]['notice_type'] == 3) && ($push_token != '')){ //send notice
							
							$notice_title = "Memo";
							$notice_content = "คุณ ".$from_emp_name."\nทำการยื่นเอกสาร ".$memo_no."\nสถานะเอกสาร ".$memo_status_name;	

			     			//insert data to table notification
					     	$s_sql_7 = "INSERT INTO notification_memo (emp_id_pk , mm_id_pk , nm_title , nm_content , nm_status , nm_notice_type , nm_readed_date , nm_created_date , nm_modified_date) VALUES (".$emp_id_get_notice." , ".$mm_last_id." , '".$notice_title."' , '".$notice_content."' , 'U' , '3' , null , NOW() , NOW()) ";
							$b_flag_7 = $obj_class->manageproc($s_sql_7);
							$obj_log->savelog($save_data_log,"insert_memo -> insert -> notification_leave (memo)","sql=[$s_sql_7]");

							if($device_type == "ios"){
								$data["aps"] = array(
												"alert"	=> array(
													"title" => $notice_title,
													"body" => $notice_content
													 ),
												"badge" => $this->get_badge_notice($emp_id_get_notice),
												"content-available" => 1
											);
								
								$ios[$push_token] = $data;
								$rs = $this->send_push_notice_ios($ios);
							}
							else if($device_type == "android"){
						     	$data = array(
									"data" => array(
										"title" => $notice_title,
										"content" => $notice_content,
										"badge" => $this->get_badge_notice($emp_id_get_notice)
									) , 
									"priority" => "high", 
									"to" => $push_token
								);

								$data_string = json_encode($data);  

								$result = $this->send_push_notice_android($data_string);
								$rs = ($result->success)?true:false;
							}
							
							if($rs){
								$json_obj->send_notice_status = 'Send notice success.';
					     	}
					     	else{
								$json_obj->send_notice_status = 'Send notice failed.';
					     	}
					    }
					    else if($map_emp_notice[$j]['notice_type'] == 2){ //send email

					    	$email_from = "verkapp@teleinfomedia.co.th";
					    	//$email_from = "godlikenokia@gmail.com";						    	
					    	//$emp_email = "lookbaar@gmail.com";

							$email_send_to = $emp_email;
					     	$email_subject = "Insert memo ".date("Y-m-d H:i:s");
					     	$email_header = "Content-type: text/html; charset=UTF-8\n"; // or  //
					     	$email_header.= "From: ".$email_from."\n";
					     	$email_message = "";
					     	$email_message.= "คุณ ".$from_emp_name."<br>";
					     	$email_message.= "ทำการยื่นเอกสาร ".$memo_no."<br>";
					     	$email_message.= "สถานะเอกสาร ".$memo_status_name."<br>";
					     	$email_message.= "=================================<br>";
					     	$email_message.= "Best regards,<br>".$email_from."<br>";

					     	if(mail($email_send_to , $email_subject , $email_message , $email_header)){
					     		$send_email_status = 'S';
					     		$json_obj->send_email_status = 'Send email success.';
					     	}
					     	else{
					     		$send_email_status = 'F';
					     		$json_obj->send_email_status = 'Send email failed.';
					     	}

					     	//insert data to table notification
					     	$s_sql_7 = "INSERT INTO notification_memo (emp_id_pk , mm_id_pk , nm_title , nm_content , nm_status , nm_notice_type , nm_readed_date , nm_created_date , nm_modified_date) VALUES (".$emp_id_get_notice." , ".$mm_last_id." , '".$email_subject."' , '".$email_message."' , '".$send_email_status."' , '2' , null , NOW() , NOW()) ";
							$b_flag_7 = $obj_class->manageproc($s_sql_7);
							$obj_log->savelog($save_data_log,"insert_memo -> insert -> notification_leave (email)","sql=[$s_sql_7]");
						}
						//else if($map_emp_notice[$i]['notice_type'] == 1){ //send notice to verk

						//}
			     	}
				}
				else{ //2 = send all
					//send notice to all concurred_employee
					for($i=0;$i<$count_concurred;$i++){
						$concurred_emp_info = $this->get_emp_info_by_emp_com_id($params['company_id'] , $concurred_employee->concurred_emp[$i]->concurred_emp_com_id);	

						$emp_com_id = $concurred_employee->concurred_emp[$i]->concurred_emp_com_id;
						$emp_id_get_notice = $concurred_emp_info[0]['emp_id'];
						$device_type = $concurred_emp_info[0]['emp_device_type'];
						$push_token = $concurred_emp_info[0]['emp_gcm_token'];
						$emp_name = $concurred_emp_info[0]['emp_name'];
						$emp_email = $concurred_emp_info[0]['emp_email'];
						
						$map_emp_notice = $this->get_map_emp_notice($params['company_id'] , $emp_com_id);

				     	for($j=0;$j<count($map_emp_notice);$j++){
				     		if(($map_emp_notice[$j]['notice_type'] == 3) && ($push_token != '')){ //send notice
								
								$notice_title = "Memo";
				     			$notice_content = "คุณ ".$from_emp_name."\nทำการยื่นเอกสาร ".$memo_no."\nสถานะเอกสาร ".$memo_status_name;

				     			//insert data to table notification
						     	$s_sql_7 = "INSERT INTO notification_memo (emp_id_pk , mm_id_pk , nm_title , nm_content , nm_status , nm_notice_type , nm_readed_date , nm_created_date , nm_modified_date) VALUES (".$emp_id_get_notice." , ".$mm_last_id." , '".$notice_title."' , '".$notice_content."' , 'U' , '3' , null , NOW() , NOW()) ";
								$b_flag_7 = $obj_class->manageproc($s_sql_7);
								$obj_log->savelog($save_data_log,"insert_memo -> insert -> notification_leave (memo)","sql=[$s_sql_7]");

								if($device_type == "ios"){
									$data["aps"] = array(
													"alert"	=> array(
														"title" => $notice_title,
														"body" => $notice_content
														 ),
													"badge" => $this->get_badge_notice($emp_id_get_notice),
													"content-available" => 1
												);
									
									$ios[$push_token] = $data;
									$rs = $this->send_push_notice_ios($ios);
								}
								else if($device_type == "android"){
							     	$data = array(
										"data" => array(
											"title" => $notice_title,
											"content" => $notice_content,
											"badge" => $this->get_badge_notice($emp_id_get_notice)
										) , 
										"priority" => "high", 
										"to" => $push_token
									);

									$data_string = json_encode($data);  

									$result = $this->send_push_notice_android($data_string);
									$rs = ($result->success)?true:false;
								}
								
								if($rs){
									$json_obj->send_notice_status = 'Send notice success.';
						     	}
						     	else{
									$json_obj->send_notice_status = 'Send notice failed.';
						     	}
						    }
						    else if($map_emp_notice[$j]['notice_type'] == 2){ //send email

						    	$email_from = "verkapp@teleinfomedia.co.th";
						    	//$email_from = "godlikenokia@gmail.com";						    	
						    	//$emp_email = "lookbaar@gmail.com";

								$email_send_to = $emp_email;
						     	$email_subject = "Insert memo ".date("Y-m-d H:i:s");
						     	$email_header = "Content-type: text/html; charset=UTF-8\n"; // or  //
						     	$email_header.= "From: ".$email_from."\n";
						     	$email_message = "";
						     	$email_message.= "คุณ ".$from_emp_name."<br>";
					     		$email_message.= "ทำการยื่นเอกสาร ".$memo_no."<br>";
					     		$email_message.= "สถานะเอกสาร ".$memo_status_name."<br>";
						     	$email_message.= "=================================<br>";
						     	$email_message.= "Best regards,<br>".$email_from."<br>";

						     	if(mail($email_send_to , $email_subject , $email_message , $email_header)){
						     		$send_email_status = 'S';
						     		$json_obj->send_email_status = 'Send email success.';
						     	}
						     	else{
						     		$send_email_status = 'F';
						     		$json_obj->send_email_status = 'Send email failed.';
						     	}

						     	//insert data to table notification
						     	$s_sql_7 = "INSERT INTO notification_memo (emp_id_pk , mm_id_pk , nm_title , nm_content , nm_status , nm_notice_type , nm_readed_date , nm_created_date , nm_modified_date) VALUES (".$emp_id_get_notice." , ".$mm_last_id." , '".$email_subject."' , '".$email_message."' , '".$send_email_status."' , '2' , null , NOW() , NOW()) ";
								$b_flag_7 = $obj_class->manageproc($s_sql_7);
								$obj_log->savelog($save_data_log,"insert_memo -> insert -> notification_leave (email)","sql=[$s_sql_7]");
							}
							//else if($map_emp_notice[$i]['notice_type'] == 1){ //send notice to verk

							//}
				     	}
					}

					//send notice to to_employee
					$to_emp_info = $this->get_emp_info_by_emp_com_id($params['company_id'] , $to_emp_com_id);

					$emp_com_id = $to_emp_com_id;
					$emp_id_get_notice = $to_emp_info[0]['emp_id'];
					$device_type = $to_emp_info[0]['emp_device_type'];
					$push_token = $to_emp_info[0]['emp_gcm_token'];
					$emp_name = $to_emp_info[0]['emp_name'];
					$emp_email = $to_emp_info[0]['emp_email'];

					$map_emp_notice = $this->get_map_emp_notice($params['company_id'] , $emp_com_id);

			     	for($j=0;$j<count($map_emp_notice);$j++){
			     		if(($map_emp_notice[$j]['notice_type'] == 3) && ($push_token != '')){ //send notice
							
							$notice_title = "Memo";
			     			$notice_content = "คุณ ".$from_emp_name."\nทำการยื่นเอกสาร ".$memo_no."\nสถานะเอกสาร ".$memo_status_name;

			     			//insert data to table notification
					     	$s_sql_7 = "INSERT INTO notification_memo (emp_id_pk , mm_id_pk , nm_title , nm_content , nm_status , nm_notice_type , nm_readed_date , nm_created_date , nm_modified_date) VALUES (".$emp_id_get_notice." , ".$mm_last_id." , '".$notice_title."' , '".$notice_content."' , 'U' , '3' , null , NOW() , NOW()) ";
							$b_flag_7 = $obj_class->manageproc($s_sql_7);
							$obj_log->savelog($save_data_log,"insert_memo -> insert -> notification_leave (memo)","sql=[$s_sql_7]");

							if($device_type == "ios"){
								$data["aps"] = array(
												"alert"	=> array(
													"title" => $notice_title,
													"body" => $notice_content
													 ),
												"badge" => $this->get_badge_notice($emp_id_get_notice),
												"content-available" => 1
											);
								
								$ios[$push_token] = $data;
								$rs = $this->send_push_notice_ios($ios);
							}
							else if($device_type == "android"){
						     	$data = array(
									"data" => array(
										"title" => $notice_title,
										"content" => $notice_content,
										"badge" => $this->get_badge_notice($emp_id_get_notice)
									) , 
									"priority" => "high", 
									"to" => $push_token
								);

								$data_string = json_encode($data);  

								$result = $this->send_push_notice_android($data_string);
								$rs = ($result->success)?true:false;
							}
							
							if($rs){
								$json_obj->send_notice_status = 'Send notice success.';
					     	}
					     	else{
								$json_obj->send_notice_status = 'Send notice failed.';
					     	}
					    }
					    else if($map_emp_notice[$j]['notice_type'] == 2){ //send email

					    	$email_from = "verkapp@teleinfomedia.co.th";
					    	//$email_from = "godlikenokia@gmail.com";						    	
					    	//$emp_email = "lookbaar@gmail.com";

							$email_send_to = $emp_email;
					     	$email_subject = "Insert memo ".date("Y-m-d H:i:s");
					     	$email_header = "Content-type: text/html; charset=UTF-8\n"; // or  //
					     	$email_header.= "From: ".$email_from."\n";
					     	$email_message = "";
					     	$email_message.= "คุณ ".$from_emp_name."<br>";
					     	$email_message.= "ทำการยื่นเอกสาร ".$memo_no."<br>";
					     	$email_message.= "สถานะเอกสาร ".$memo_status_name."<br>";
					     	$email_message.= "=================================<br>";
					     	$email_message.= "Best regards,<br>".$email_from."<br>";

					     	if(mail($email_send_to , $email_subject , $email_message , $email_header)){
					     		$send_email_status = 'S';
					     		$json_obj->send_email_status = 'Send email success.';
					     	}
					     	else{
					     		$send_email_status = 'F';
					     		$json_obj->send_email_status = 'Send email failed.';
					     	}

					     	//insert data to table notification
					     	$s_sql_7 = "INSERT INTO notification_memo (emp_id_pk , mm_id_pk , nm_title , nm_content , nm_status , nm_notice_type , nm_readed_date , nm_created_date , nm_modified_date) VALUES (".$emp_id_get_notice." , ".$mm_last_id." , '".$email_subject."' , '".$email_message."' , '".$send_email_status."' , '2' , null , NOW() , NOW()) ";
							$b_flag_7 = $obj_class->manageproc($s_sql_7);
							$obj_log->savelog($save_data_log,"insert_memo -> insert -> notification_leave (email)","sql=[$s_sql_7]");
						}
						//else if($map_emp_notice[$i]['notice_type'] == 1){ //send notice to verk

						//}
			     	}

					//send notice to all cc_employee
					for($i=0;$i<$count_cc;$i++){
						$cc_emp_info = $this->get_emp_info_by_emp_com_id($params['company_id'] , $cc_employee->cc_emp[$i]->cc_emp_com_id);	

						$emp_com_id = $cc_employee->cc_emp[$i]->cc_emp_com_id;
						$emp_id_get_notice = $cc_emp_info[0]['emp_id'];
						$device_type = $cc_emp_info[0]['emp_device_type'];
						$push_token = $cc_emp_info[0]['emp_gcm_token'];
						$emp_name = $cc_emp_info[0]['emp_name'];
						$emp_email = $cc_emp_info[0]['emp_email'];
						
						$map_emp_notice = $this->get_map_emp_notice($params['company_id'] , $emp_com_id);

				     	for($j=0;$j<count($map_emp_notice);$j++){
				     		if(($map_emp_notice[$j]['notice_type'] == 3) && ($push_token != '')){ //send notice
								
								$notice_title = "Memo";
				     			$notice_content = "คุณ ".$from_emp_name."\nทำการยื่นเอกสาร ".$memo_no."\nสถานะเอกสาร ".$memo_status_name;

				     			//insert data to table notification
						     	$s_sql_7 = "INSERT INTO notification_memo (emp_id_pk , mm_id_pk , nm_title , nm_content , nm_status , nm_notice_type , nm_readed_date , nm_created_date , nm_modified_date) VALUES (".$emp_id_get_notice." , ".$mm_last_id." , '".$notice_title."' , '".$notice_content."' , 'U' , '3' , null , NOW() , NOW()) ";
								$b_flag_7 = $obj_class->manageproc($s_sql_7);
								$obj_log->savelog($save_data_log,"insert_memo -> insert -> notification_leave (memo)","sql=[$s_sql_7]");

								if($device_type == "ios"){
									$data["aps"] = array(
													"alert"	=> array(
														"title" => $notice_title,
														"body" => $notice_content
														 ),
													"badge" => $this->get_badge_notice($emp_id_get_notice),
													"content-available" => 1
												);
									
									$ios[$push_token] = $data;
									$rs = $this->send_push_notice_ios($ios);
								}
								else if($device_type == "android"){
							     	$data = array(
										"data" => array(
											"title" => $notice_title,
											"content" => $notice_content,
											"badge" => $this->get_badge_notice($emp_id_get_notice)
										) , 
										"priority" => "high", 
										"to" => $push_token
									);

									$data_string = json_encode($data);  

									$result = $this->send_push_notice_android($data_string);
									$rs = ($result->success)?true:false;
								}
								
								if($rs){
									$json_obj->send_notice_status = 'Send notice success.';
						     	}
						     	else{
									$json_obj->send_notice_status = 'Send notice failed.';
						     	}
						    }
						    else if($map_emp_notice[$j]['notice_type'] == 2){ //send email

						    	$email_from = "verkapp@teleinfomedia.co.th";
						    	//$email_from = "godlikenokia@gmail.com";						    	
						    	//$emp_email = "lookbaar@gmail.com";

								$email_send_to = $emp_email;
						     	$email_subject = "Insert memo ".date("Y-m-d H:i:s");
						     	$email_header = "Content-type: text/html; charset=UTF-8\n"; // or  //
						     	$email_header.= "From: ".$email_from."\n";
						     	$email_message = "";
						     	$email_message.= "คุณ ".$from_emp_name."<br>";
					     		$email_message.= "ทำการยื่นเอกสาร ".$memo_no."<br>";
					     		$email_message.= "สถานะเอกสาร ".$memo_status_name."<br>";
						     	$email_message.= "=================================<br>";
						     	$email_message.= "Best regards,<br>".$email_from."<br>";

						     	if(mail($email_send_to , $email_subject , $email_message , $email_header)){
						     		$send_email_status = 'S';
						     		$json_obj->send_email_status = 'Send email success.';
						     	}
						     	else{
						     		$send_email_status = 'F';
						     		$json_obj->send_email_status = 'Send email failed.';
						     	}

						     	//insert data to table notification
						     	$s_sql_7 = "INSERT INTO notification_memo (emp_id_pk , mm_id_pk , nm_title , nm_content , nm_status , nm_notice_type , nm_readed_date , nm_created_date , nm_modified_date) VALUES (".$emp_id_get_notice." , ".$mm_last_id." , '".$email_subject."' , '".$email_message."' , '".$send_email_status."' , '2' , null , NOW() , NOW()) ";
								$b_flag_7 = $obj_class->manageproc($s_sql_7);
								$obj_log->savelog($save_data_log,"insert_memo -> insert -> notification_leave (email)","sql=[$s_sql_7]");
							}
							//else if($map_emp_notice[$i]['notice_type'] == 1){ //send notice to verk

							//}
				     	}
					}
				}
			}
	    }

		$obj_class->closedb();
		return $json_obj;
    }

    //2400 -- OK //edit api doc **
	public function update_memo($params , $files) {
		$json_obj = new stdClass();
		$obj_global = new GlobalConstant();		
		$obj_log = new LogFile();		
		$save_data_log = $_SERVER["HTTP_HOST"].$_SERVER["PHP_SELF"];

		$obj_class = new Connectdb($obj_global->getHOST_CMS(), $obj_global->getUSER_CMS() , $obj_global->getPWD_CMS(), "memo",0,FALSE);
		$obj_class_2 = new Connectdb($obj_global->getHOST_CMS(), $obj_global->getUSER_CMS() , $obj_global->getPWD_CMS(), "memo",0,FALSE);

		//$params['company_id']
		//$params['employee_id']
		//$params['memo_id']
		//$params['memo_form_id'] //1 = finanace , 2 = non finance , 3 = advance
		//$params['notice_type'] //1 = send to level , 2 = send all	
		//$params['prelist_id'] //0 = other
		//$params['prelist_name']
		//$params['memo_type']
		//$params['memo_budget'] //yes , no
		//$params['memo_amount'] 
		//$params['to_employee']
		//$params['concurred_employee'] 
		//$params['cc_employee']
		//$params['memo_detail']
		//$params['is_revise'] //1 = Yes , 0 = No

		//$params['memo_format_id']

		//advance memo
		//$params['advance_form_id']
		//$params['advance_no']
		//$params['confirm_payment_employee']
		//$params['sub_type'] -- Approve / Clear / Overpaid

		//$params['attach_file_x']


		//'{"to_emp" :[{"to_emp_com_id": "34664", "to_emp_pos_initial": "MACM"}]}'
		
		//'{"concurred_emp" :[{"concurred_emp_com_id": "34666", "concurred_emp_pos_initial": "CEM"},{"concurred_emp_com_id": "44037","concurred_emp_pos_initial": "SA"}]}'
		//'{"concurred_emp" :[{"concurred_emp_com_id":"","concurred_emp_pos_initial":""}]}'
		
		//'{"cc_emp" :[{"cc_emp_com_id": "43460", "cc_emp_pos_initial": "WMPA"},{"cc_emp_com_id": "42674","cc_emp_pos_initial": "WMPA"}]}'
		//'{"cc_emp" :[{"cc_emp_com_id":"","cc_emp_pos_initial":""}]}'

		//'{"memo_type" :[{"memo_type_id": "11", "memo_type_name": "Non Financial"}]}'

		//'{"confirm_payment_emp" :[{"confirm_payment_emp_com_id": "43460", "confirm_payment_emp_name": "สันติพงศ์ จารัตน์"}]}'


		$params['memo_format_id'] = (isset($params['memo_format_id']) && ($params['memo_format_id'] != ''))?$params['memo_format_id']:$params['memo_form_id'];

		$mm_format_id = $params['memo_form_id'];
		$mf_id_pk = $params['memo_format_id'];


		//set memo revise
		$s_sql = "SELECT * from memo WHERE mm_id_pk = ".$params['memo_id']." ";
		$b_resp = $obj_class->selectproc($s_sql);
		$datas = array();

		if($b_resp && $obj_class->n_row>0) {	
			$memo_revise = $obj_class->getitem("mm_revise");
			$memo_no = $obj_class->getitem("mm_NO");
		}

		if($params['is_revise'] == 1){
			$memo_revise = $memo_revise + 1;
		}
		

		$to_employee = json_decode(str_replace("\\",'',$params['to_employee']));
		$concurred_employee = json_decode(str_replace("\\",'',$params['concurred_employee']));
		$cc_employee = json_decode(str_replace("\\",'',$params['cc_employee']));
		$mm_type = json_decode(str_replace("\\",'',$params['memo_type']));

		$to_emp_com_id = $to_employee->to_emp[0]->to_emp_com_id;
		$to_emp_pos_initial = $to_employee->to_emp[0]->to_emp_pos_initial;

		$count_concurred = count($concurred_employee->concurred_emp);
		for($i=0;$i<$count_concurred;$i++){
			if($i == 0){
				$concurred_emp_com_id = ($concurred_employee->concurred_emp[$i]->concurred_emp_com_id)?$concurred_employee->concurred_emp[$i]->concurred_emp_com_id:null;
				$concurred_emp_pos_initial = ($concurred_employee->concurred_emp[$i]->concurred_emp_pos_initial)?$concurred_employee->concurred_emp[$i]->concurred_emp_pos_initial:null;
			}
			else{
				$concurred_emp_com_id.= ",".$concurred_employee->concurred_emp[$i]->concurred_emp_com_id;
				$concurred_emp_pos_initial.= ",".$concurred_employee->concurred_emp[$i]->concurred_emp_pos_initial;
			}
		}

		$count_cc = count($cc_employee->cc_emp);
		for($i=0;$i<$count_cc;$i++){
			if($i == 0){
				$cc_emp_com_id = ($cc_employee->cc_emp[$i]->cc_emp_com_id != '')?$cc_employee->cc_emp[$i]->cc_emp_com_id:null;
				$cc_emp_pos_initial = ($cc_employee->cc_emp[$i]->cc_emp_pos_initial != '')?$cc_employee->cc_emp[$i]->cc_emp_pos_initial:null;
			}
			else{
				$cc_emp_com_id.= ",".$cc_employee->cc_emp[$i]->cc_emp_com_id;
				$cc_emp_pos_initial.= ",".$cc_employee->cc_emp[$i]->cc_emp_pos_initial;
			}
		}

		$memo_type_id = $mm_type->memo_type[0]->memo_type_id;
		$memo_type_name = $mm_type->memo_type[0]->memo_type_name;

		//advance memo
		if($params['confirm_payment_employee'] != ''){
			$confirm_payment_employee = json_decode(str_replace("\\",'',$params['confirm_payment_employee']));

			$confirm_payment_emp_com_id = $confirm_payment_employee->confirm_payment_emp[0]->confirm_payment_emp_com_id;
			$confirm_payment_emp_name = $confirm_payment_employee->confirm_payment_emp[0]->confirm_payment_emp_name;
		}

		$emp_info = $this->get_emp_info_by_emp_id($params['company_id'] , $params['employee_id']);
		$from_emp_name = $emp_info[0]['emp_name'];
		
		if(sizeof($emp_info[0]) > 1){
			if($concurred_emp_com_id != null){
				$first_notice_emp_com_id = $concurred_employee->concurred_emp[0]->concurred_emp_com_id;
				$first_notice_emp_info = $this->get_emp_info_by_emp_com_id($params['company_id'] , $first_notice_emp_com_id);	
				$memo_status_id = 1;
				$memo_status_name = 'Wait for Agree';
			}
			else{
				$first_notice_emp_com_id = $to_emp_com_id;
				$first_notice_emp_info = $this->get_emp_info_by_emp_com_id($params['company_id'] , $first_notice_emp_com_id);
				$memo_status_id = 3;
				$memo_status_name = 'Wait for Approve';
			}

			$s_sql_1 = "UPDATE memo ";
			$s_sql_1.= "SET pl_id_pk = ".$params['prelist_id']." , mm_subject = '".$params['prelist_name']."' ";
			$s_sql_1.= ", mt_id_pk = ".$memo_type_id." , mm_sub_type = '".$memo_type_name."' , avf_id_pk = 0 ";
			$s_sql_1.= ", mm_amount = ".$params['memo_amount']." , mm_budget = '".strtolower($params['memo_budget'])."' ";
			$s_sql_1.= ", mm_to = '".$to_emp_pos_initial."' , mm_to_emp_ID = '".$to_emp_com_id."' ";

			if($concurred_emp_com_id != null){
				$s_sql_1.= ", mm_concurred = '".$concurred_emp_pos_initial."' , mm_concurred_emp_ID = '".$concurred_emp_com_id."' ";
			}
			else{
				$s_sql_1.= ", mm_concurred = NULL , mm_concurred_emp_ID = NULL ";
			}

			if($cc_emp_com_id != null){
				$s_sql_1.= ", mm_cc = '".$cc_emp_pos_initial."' , mm_cc_emp_ID = '".$cc_emp_com_id."' ";
			}
			else{
				$s_sql_1.= ", mm_cc = NULL , mm_cc_emp_ID = NULL ";
			}

			$s_sql_1.= ", mm_from = '".$emp_info[0]['emp_pos_initial']."' , mm_from_emp_ID = '".$emp_info[0]['emp_com_id']."' ";
			$s_sql_1.= ", mm_detail = '".$params['memo_detail']."' , mm_modified_date = NOW() ";
			$s_sql_1.= ", mst_id_pk = ".$memo_status_id." , mm_status = '".$memo_status_name."' , mm_revise = ".$memo_revise." ";
			$s_sql_1.= ", mm_noti_type = ".$params['notice_type']." , mf_id_pk = ".$mf_id_pk." ";

			if($params['is_revise'] == 1){
				$s_sql_1.= ", mm_issue_date = NOW() ";
			}

			//advance memo
			if($mm_format_id == 3){
				$s_sql_1.= ", mm_sub_type_ad = '".$params['sub_type']."' , mm_confirm_payment = '".$confirm_payment_emp_name."' ";
				$s_sql_1.= ", mm_confirm_payment_emp_ID = '".$confirm_payment_emp_com_id."' ";
			}

			$s_sql_1.= "WHERE mm_id_pk = ".$params['memo_id']." ";
			$b_flag_1 = $obj_class->manageproc($s_sql_1);
			$obj_log->savelog($save_data_log,"update_memo -> update -> memo","sql=[$s_sql_1]");

			if($b_flag_1){
				$s_sql_2 = "INSERT INTO memo_history (mm_id_pk , mmh_status , mmh_comment , mmh_name , mmh_pos , emp_id_pk , emp_ID ";
				$s_sql_2.= ", mmh_approve_date , mmh_issue_date , mmh_created_date , mmh_modified_date , mmh_signature , com_id_pk) ";
				$s_sql_2.= "VALUES (".$params['memo_id']." , '".$memo_status_name."' , NULL , '".$first_notice_emp_info[0]['emp_name']."' ";
				$s_sql_2.= ", '".$first_notice_emp_info[0]['emp_position']."' , ".$first_notice_emp_info[0]['emp_id']." ";
				$s_sql_2.= ", '".$first_notice_emp_com_id."' , NULL , NOW() , NOW() , NOW() , NULL ";
				$s_sql_2.= ", ".$params['company_id'].") ";
				$b_flag_2 = $obj_class->manageproc($s_sql_2);
				$obj_log->savelog($save_data_log,"update_memo -> insert -> memo_history","sql=[$s_sql_2]");

				if($b_flag_2){
					if($mm_format_id == 3){
						$confirm_payment_emp_info = $this->get_emp_info_by_emp_com_id($params['company_id'] , $confirm_payment_emp_com_id);
	
						//insert -> tb advance_history
						$s_sql_4 = "INSERT INTO advance_history (avf_id_pk , avh_emp_ID ";
						$s_sql_4.= ", avh_emp_name , avh_pos ";
						$s_sql_4.= ", avh_type , avh_created_date , avh_remark) ";
						$s_sql_4.= "VALUES (".$params['advance_form_id']." , '".$confirm_payment_emp_com_id."' ";
						$s_sql_4.= ", '".$confirm_payment_emp_info[0]['emp_name']."' , '".$confirm_payment_emp_info[0]['emp_pos_initial']."' ";
						$s_sql_4.= ", 'Wait for Payment' , NOW() , NULL)";
						$b_flag_4 = $obj_class_2->manageproc($s_sql_4);
					}
					
					$count_file = count($files);
					if($count_file > 0){
						$path = "../EdC/".$params['company_id']."/memo_attach_file/".$params['memo_id']."/";
						$thumb_path = "../EdC/".$params['company_id']."/memo_thumb_attach_file/".$params['memo_id']."/";

						if(!(file_exists($path))){
							mkdir($path, 0777, true);
						}
						if(!(file_exists($thumb_path))){
							mkdir($thumb_path, 0777, true);
						}
						
						//delete old attach file (files and db)
						$s_sql_0 = "SELECT * FROM memo_attachfile WHERE mm_id_pk = ".$params['memo_id']." ";
						$b_resp_0 = $obj_class->selectproc($s_sql_0);
						if($b_resp_0 && $obj_class->n_row>0) {
							for($i=0;$i<$obj_class->n_row;$i++){	
								$old_attach_file = $obj_class->getitem("ma_path");
								unlink($path.$old_attach_file);

							    $obj_class->movenext();
							}

							$s_sql_00 = "DELETE FROM memo_attachfile WHERE mm_id_pk = ".$params['memo_id']." ";
							$b_resp_00 = $obj_class->manageproc($s_sql_00);
						}

						for($i=0;$i<$count_file;$i++){
							$j = $i+1;

							$files['attach_file_'.$i] = isset($files['attach_file_'.$i])?$files['attach_file_'.$i]:'';
							
							$file_name = date('Ymd_His_').$j.'_'.$params['memo_id'].'.jpg';
							$file_size = $files['attach_file_'.$i]['size'];
							$file_tmp = $files['attach_file_'.$i]['tmp_name'];
							$file_type = $files['attach_file_'.$i]['type'];
							$file_ext = strtolower(end(explode('.',$files['attach_file_'.$i]['name'])));
						
							$expensions = array("jpeg","jpg","png");

							$errors = '{"result_code":1,"result_desc":"success"}';
							if(in_array($file_ext,$expensions) === false){
								$json_obj->command = '2406';
								$json_obj->message = 'Update memo fail - please choose a JPEG or PNG file.';
							}
							else if($files['attach_file_'.$i]['size'] == 0){
								$json_obj->command = '2407';
								$json_obj->message = 'Update memo fail - post max file must be exactly 8 MB.';
							}
							else if($files['attach_file_'.$i]['size'] > 2097152){
								$json_obj->command = '2408';
								$json_obj->message = 'Update memo fail - file size must be exactly 2 MB.';
							}
							else {
								move_uploaded_file($file_tmp , $path.$file_name);
								$this->generate_image_thumbnail($path.$file_name, $thumb_path.$file_name);

								$s_sql_3 = "INSERT INTO memo_attachfile (mm_id_pk , ma_path , ma_created_date , ma_modified_date , com_id_pk) ";
								$s_sql_3.= "VALUES (".$params['memo_id']." , '".$file_name."' , NOW() , NOW() , ".$params['company_id'].") ";
								$b_flag_3 = $obj_class->manageproc($s_sql_3);
								$obj_log->savelog($save_data_log,"update_memo -> insert -> memo_attachfile","sql=[$s_sql_3]");

								if($b_flag_3){
									$json_obj->command = '2400';
									$json_obj->message = 'Update memo success.';
								}
								else{
									$json_obj->command = '2405';
									$json_obj->message = 'Update memo fail - insert memo_attachfile fail.';
								}
							}
						}
					}
					else{
						$json_obj->command = '2400';
						$json_obj->message = 'Update memo success.';
					}
				}
				else{
					$json_obj->command = '2404';
					$json_obj->message = 'Update memo fail - insert memo_history fail.';
				}
			}
			else{
				$json_obj->command = '2403';
				$json_obj->message = 'Update memo fail - update memo fail.';
			}
		}
		else{
			$json_obj->command = '2402';
			$json_obj->message = 'Data is invalid. (emp_info)';
		}

		if($json_obj->command == '2400'){

			/*
			if($concurred_emp_com_id != null){
				$first_notice_emp_com_id = $concurred_employee->concurred_emp[0]->concurred_emp_com_id;
				$first_notice_emp_info = $this->get_emp_info_by_emp_com_id($params['company_id'] , $first_notice_emp_com_id);	
				$memo_status_name = 'Wait for Agree';
			}
			else{
				$first_notice_emp_com_id = $to_emp_com_id;
				$first_notice_emp_info = $this->get_emp_info_by_emp_com_id($params['company_id'] , $first_notice_emp_com_id);
				$memo_status_name = 'Wait for Approve';
			}
			*/

			$result = $this->add_summary_profile($params['company_id'] , $first_notice_emp_com_id , $memo_status_name);

			if($result){
				if($params['notice_type'] == 1){ //1 = send to level 
					//send notice to first concurred employee or to employee
					$emp_com_id = $first_notice_emp_com_id;
					$emp_id_get_notice = $first_notice_emp_info[0]['emp_id'];
					$device_type = $first_notice_emp_info[0]['emp_device_type'];
					$push_token = $first_notice_emp_info[0]['emp_gcm_token'];
					$emp_name = $first_notice_emp_info[0]['emp_name'];
					$emp_email = $first_notice_emp_info[0]['emp_email'];
					
					$map_emp_notice = $this->get_map_emp_notice($params['company_id'] , $emp_com_id);

			     	for($j=0;$j<count($map_emp_notice);$j++){
			     		if(($map_emp_notice[$j]['notice_type'] == 3) && ($push_token != '')){ //send notice
							
							$notice_title = "Memo";
			     			$notice_content = "คุณ ".$from_emp_name."\nทำการยื่นเอกสาร ".$memo_no."\nสถานะเอกสาร ".$memo_status_name;

			     			//insert data to table notification
					     	$s_sql_7 = "INSERT INTO notification_memo (emp_id_pk , mm_id_pk , nm_title , nm_content , nm_status , nm_notice_type , nm_readed_date , nm_created_date , nm_modified_date) VALUES (".$emp_id_get_notice." , ".$params['memo_id']." , '".$notice_title."' , '".$notice_content."' , 'U' , '3' , null , NOW() , NOW()) ";
							$b_flag_7 = $obj_class->manageproc($s_sql_7);
							$obj_log->savelog($save_data_log,"update_memo -> insert -> notification_leave (memo)","sql=[$s_sql_7]");

							if($device_type == "ios"){
								$data["aps"] = array(
												"alert"	=> array(
													"title" => $notice_title,
													"body" => $notice_content
													 ),
												"badge" => $this->get_badge_notice($emp_id_get_notice),
												"content-available" => 1
											);
								
								$ios[$push_token] = $data;
								$rs = $this->send_push_notice_ios($ios);
							}
							else if($device_type == "android"){
						     	$data = array(
									"data" => array(
										"title" => $notice_title,
										"content" => $notice_content,
										"badge" => $this->get_badge_notice($emp_id_get_notice)
									) , 
									"priority" => "high", 
									"to" => $push_token
								);

								$data_string = json_encode($data);  

								$result = $this->send_push_notice_android($data_string);
								$rs = ($result->success)?true:false;
							}
							
							if($rs){
								$json_obj->send_notice_status = 'Send notice success.';
					     	}
					     	else{
								$json_obj->send_notice_status = 'Send notice failed.';
					     	}
					    }
					    else if($map_emp_notice[$j]['notice_type'] == 2){ //send email

					    	$email_from = "verkapp@teleinfomedia.co.th";
					    	//$email_from = "godlikenokia@gmail.com";						    	
					    	//$emp_email = "lookbaar@gmail.com";

							$email_send_to = $emp_email;
					     	$email_subject = "Update memo ".date("Y-m-d H:i:s");
					     	$email_header = "Content-type: text/html; charset=UTF-8\n"; // or  //
					     	$email_header.= "From: ".$email_from."\n";
					     	$email_message = "";
					     	$email_message.= "คุณ ".$from_emp_name."<br>";
							$email_message.= "ทำการยื่นเอกสาร ".$memo_no."<br>";
							$email_message.= "สถานะเอกสาร ".$memo_status_name."<br>";
					     	$email_message.= "=================================<br>";
					     	$email_message.= "Best regards,<br>".$email_from."<br>";

					     	if(mail($email_send_to , $email_subject , $email_message , $email_header)){
					     		$send_email_status = 'S';
					     		$json_obj->send_email_status = 'Send email success.';
					     	}
					     	else{
					     		$send_email_status = 'F';
					     		$json_obj->send_email_status = 'Send email failed.';
					     	}

					     	//insert data to table notification
					     	$s_sql_7 = "INSERT INTO notification_memo (emp_id_pk , mm_id_pk , nm_title , nm_content , nm_status , nm_notice_type , nm_readed_date , nm_created_date , nm_modified_date) VALUES (".$emp_id_get_notice." , ".$params['memo_id']." , '".$email_subject."' , '".$email_message."' , '".$send_email_status."' , '2' , null , NOW() , NOW()) ";
							$b_flag_7 = $obj_class->manageproc($s_sql_7);
							$obj_log->savelog($save_data_log,"update_memo -> insert -> notification_leave (email)","sql=[$s_sql_7]");
						}
						//else if($map_emp_notice[$j]['notice_type'] == 1){ //send notice to verk

						//}
			     	}
				}
				else{ //2 = send all
					//send notice to all concurred_employee
					for($i=0;$i<$count_concurred;$i++){
						$concurred_emp_info = $this->get_emp_info_by_emp_com_id($params['company_id'] , $concurred_employee->concurred_emp[$i]->concurred_emp_com_id);	

						$emp_com_id = $concurred_employee->concurred_emp[$i]->concurred_emp_com_id;
						$emp_id_get_notice = $concurred_emp_info[0]['emp_id'];
						$device_type = $concurred_emp_info[0]['emp_device_type'];
						$push_token = $concurred_emp_info[0]['emp_gcm_token'];
						$emp_name = $concurred_emp_info[0]['emp_name'];
						$emp_email = $concurred_emp_info[0]['emp_email'];
						
						$map_emp_notice = $this->get_map_emp_notice($params['company_id'] , $emp_com_id);

				     	for($j=0;$j<count($map_emp_notice);$j++){
				     		if(($map_emp_notice[$j]['notice_type'] == 3) && ($push_token != '')){ //send notice
								
								$notice_title = "Memo";
				     			$notice_content = "คุณ ".$from_emp_name."\nทำการยื่นเอกสาร ".$memo_no."\nสถานะเอกสาร ".$memo_status_name;

				     			//insert data to table notification
						     	$s_sql_7 = "INSERT INTO notification_memo (emp_id_pk , mm_id_pk , nm_title , nm_content , nm_status , nm_notice_type , nm_readed_date , nm_created_date , nm_modified_date) VALUES (".$emp_id_get_notice." , ".$params['memo_id']." , '".$notice_title."' , '".$notice_content."' , 'U' , '3' , null , NOW() , NOW()) ";
								$b_flag_7 = $obj_class->manageproc($s_sql_7);
								$obj_log->savelog($save_data_log,"update_memo -> insert -> notification_leave (memo)","sql=[$s_sql_7]");

								if($device_type == "ios"){
									$data["aps"] = array(
													"alert"	=> array(
														"title" => $notice_title,
														"body" => $notice_content
														 ),
													"badge" => $this->get_badge_notice($emp_id_get_notice),
													"content-available" => 1
												);
									
									$ios[$push_token] = $data;
									$rs = $this->send_push_notice_ios($ios);
								}
								else if($device_type == "android"){
							     	$data = array(
										"data" => array(
											"title" => $notice_title,
											"content" => $notice_content,
											"badge" => $this->get_badge_notice($emp_id_get_notice)
										) , 
										"priority" => "high", 
										"to" => $push_token
									);

									$data_string = json_encode($data);  

									$result = $this->send_push_notice_android($data_string);
									$rs = ($result->success)?true:false;
								}
								
								if($rs){
									$json_obj->send_notice_status = 'Send notice success.';
						     	}
						     	else{
									$json_obj->send_notice_status = 'Send notice failed.';
						     	}
						    }
						    else if($map_emp_notice[$j]['notice_type'] == 2){ //send email

						    	$email_from = "verkapp@teleinfomedia.co.th";
						    	//$email_from = "godlikenokia@gmail.com";						    	
						    	//$emp_email = "lookbaar@gmail.com";

								$email_send_to = $emp_email;
						     	$email_subject = "Update memo ".date("Y-m-d H:i:s");
						     	$email_header = "Content-type: text/html; charset=UTF-8\n"; // or  //
						     	$email_header.= "From: ".$email_from."\n";
						     	$email_message = "";
						     	$email_message.= "คุณ ".$from_emp_name."<br>";
								$email_message.= "ทำการยื่นเอกสาร ".$memo_no."<br>";
								$email_message.= "สถานะเอกสาร ".$memo_status_name."<br>";
						     	$email_message.= "=================================<br>";
						     	$email_message.= "Best regards,<br>".$email_from."<br>";

						     	if(mail($email_send_to , $email_subject , $email_message , $email_header)){
						     		$send_email_status = 'S';
						     		$json_obj->send_email_status = 'Send email success.';
						     	}
						     	else{
						     		$send_email_status = 'F';
						     		$json_obj->send_email_status = 'Send email failed.';
						     	}

						     	//insert data to table notification
						     	$s_sql_7 = "INSERT INTO notification_memo (emp_id_pk , mm_id_pk , nm_title , nm_content , nm_status , nm_notice_type , nm_readed_date , nm_created_date , nm_modified_date) VALUES (".$emp_id_get_notice." , ".$params['memo_id']." , '".$email_subject."' , '".$email_message."' , '".$send_email_status."' , '2' , null , NOW() , NOW()) ";
								$b_flag_7 = $obj_class->manageproc($s_sql_7);
								$obj_log->savelog($save_data_log,"update_memo -> insert -> notification_leave (email)","sql=[$s_sql_7]");
							}
							//else if($map_emp_notice[$i]['notice_type'] == 1){ //send notice to verk

							//}
				     	}
					}

					//send notice to to_employee
					$to_emp_info = $this->get_emp_info_by_emp_com_id($params['company_id'] , $to_emp_com_id);

					$emp_com_id = $to_emp_com_id;
					$emp_id_get_notice = $to_emp_info[0]['emp_id'];
					$device_type = $to_emp_info[0]['emp_device_type'];
					$push_token = $to_emp_info[0]['emp_gcm_token'];
					$emp_name = $to_emp_info[0]['emp_name'];
					$emp_email = $to_emp_info[0]['emp_email'];

					$map_emp_notice = $this->get_map_emp_notice($params['company_id'] , $emp_com_id);

			     	for($j=0;$j<count($map_emp_notice);$j++){
			     		if(($map_emp_notice[$j]['notice_type'] == 3) && ($push_token != '')){ //send notice
							
							$notice_title = "Memo";
			     			$notice_content = "คุณ ".$from_emp_name."\nทำการยื่นเอกสาร ".$memo_no."\nสถานะเอกสาร ".$memo_status_name;

			     			//insert data to table notification
					     	$s_sql_7 = "INSERT INTO notification_memo (emp_id_pk , mm_id_pk , nm_title , nm_content , nm_status , nm_notice_type , nm_readed_date , nm_created_date , nm_modified_date) VALUES (".$emp_id_get_notice." , ".$params['memo_id']." , '".$notice_title."' , '".$notice_content."' , 'U' , '3' , null , NOW() , NOW()) ";
							$b_flag_7 = $obj_class->manageproc($s_sql_7);
							$obj_log->savelog($save_data_log,"update_memo -> insert -> notification_leave (memo)","sql=[$s_sql_7]");

							if($device_type == "ios"){
								$data["aps"] = array(
												"alert"	=> array(
													"title" => $notice_title,
													"body" => $notice_content
													 ),
												"badge" => $this->get_badge_notice($emp_id_get_notice),
												"content-available" => 1
											);
								
								$ios[$push_token] = $data;
								$rs = $this->send_push_notice_ios($ios);
							}
							else if($device_type == "android"){
						     	$data = array(
									"data" => array(
										"title" => $notice_title,
										"content" => $notice_content,
										"badge" => $this->get_badge_notice($emp_id_get_notice)
									) , 
									"priority" => "high", 
									"to" => $push_token
								);

								$data_string = json_encode($data);  

								$result = $this->send_push_notice_android($data_string);
								$rs = ($result->success)?true:false;
							}
							
							if($rs){
								$json_obj->send_notice_status = 'Send notice success.';
					     	}
					     	else{
								$json_obj->send_notice_status = 'Send notice failed.';
					     	}
					    }
					    else if($map_emp_notice[$j]['notice_type'] == 2){ //send email

					    	$email_from = "verkapp@teleinfomedia.co.th";
					    	//$email_from = "godlikenokia@gmail.com";						    	
					    	//$emp_email = "lookbaar@gmail.com";

							$email_send_to = $emp_email;
					     	$email_subject = "Update memo ".date("Y-m-d H:i:s");
					     	$email_header = "Content-type: text/html; charset=UTF-8\n"; // or  //
					     	$email_header.= "From: ".$email_from."\n";
					     	$email_message = "";
					     	$email_message.= "คุณ ".$from_emp_name."<br>";
							$email_message.= "ทำการยื่นเอกสาร ".$memo_no."<br>";
							$email_message.= "สถานะเอกสาร ".$memo_status_name."<br>";
					     	$email_message.= "=================================<br>";
					     	$email_message.= "Best regards,<br>".$email_from."<br>";

					     	if(mail($email_send_to , $email_subject , $email_message , $email_header)){
					     		$send_email_status = 'S';
					     		$json_obj->send_email_status = 'Send email success.';
					     	}
					     	else{
					     		$send_email_status = 'F';
					     		$json_obj->send_email_status = 'Send email failed.';
					     	}

					     	//insert data to table notification
					     	$s_sql_7 = "INSERT INTO notification_memo (emp_id_pk , mm_id_pk , nm_title , nm_content , nm_status , nm_notice_type , nm_readed_date , nm_created_date , nm_modified_date) VALUES (".$emp_id_get_notice." , ".$params['memo_id']." , '".$email_subject."' , '".$email_message."' , '".$send_email_status."' , '2' , null , NOW() , NOW()) ";
							$b_flag_7 = $obj_class->manageproc($s_sql_7);
							$obj_log->savelog($save_data_log,"update_memo -> insert -> notification_leave (email)","sql=[$s_sql_7]");
						}
						//else if($map_emp_notice[$i]['notice_type'] == 1){ //send notice to verk

						//}
			     	}

					//send notice to all cc_employee
					for($i=0;$i<$count_cc;$i++){
						$cc_emp_info = $this->get_emp_info_by_emp_com_id($params['company_id'] , $cc_employee->cc_emp[$i]->cc_emp_com_id);	

						$emp_com_id = $cc_employee->cc_emp[$i]->cc_emp_com_id;
						$emp_id_get_notice = $cc_emp_info[0]['emp_id'];
						$device_type = $cc_emp_info[0]['emp_device_type'];
						$push_token = $cc_emp_info[0]['emp_gcm_token'];
						$emp_name = $cc_emp_info[0]['emp_name'];
						$emp_email = $cc_emp_info[0]['emp_email'];
						
						$map_emp_notice = $this->get_map_emp_notice($params['company_id'] , $emp_com_id);

				     	for($j=0;$j<count($map_emp_notice);$j++){
				     		if(($map_emp_notice[$j]['notice_type'] == 3) && ($push_token != '')){ //send notice
								
								$notice_title = "Memo";
				     			$notice_content = "คุณ ".$from_emp_name."\nทำการยื่นเอกสาร ".$memo_no."\nสถานะเอกสาร ".$memo_status_name;

				     			//insert data to table notification
						     	$s_sql_7 = "INSERT INTO notification_memo (emp_id_pk , mm_id_pk , nm_title , nm_content , nm_status , nm_notice_type , nm_readed_date , nm_created_date , nm_modified_date) VALUES (".$emp_id_get_notice." , ".$params['memo_id']." , '".$notice_title."' , '".$notice_content."' , 'U' , '3' , null , NOW() , NOW()) ";
								$b_flag_7 = $obj_class->manageproc($s_sql_7);
								$obj_log->savelog($save_data_log,"update_memo -> insert -> notification_leave (memo)","sql=[$s_sql_7]");

								if($device_type == "ios"){
									$data["aps"] = array(
													"alert"	=> array(
														"title" => $notice_title,
														"body" => $notice_content
														 ),
													"badge" => $this->get_badge_notice($emp_id_get_notice),
													"content-available" => 1
												);
									
									$ios[$push_token] = $data;
									$rs = $this->send_push_notice_ios($ios);
								}
								else if($device_type == "android"){
							     	$data = array(
										"data" => array(
											"title" => $notice_title,
											"content" => $notice_content,
											"badge" => $this->get_badge_notice($emp_id_get_notice)
										) , 
										"priority" => "high", 
										"to" => $push_token
									);

									$data_string = json_encode($data);  

									$result = $this->send_push_notice_android($data_string);
									$rs = ($result->success)?true:false;
								}
								
								if($rs){
									$json_obj->send_notice_status = 'Send notice success.';
						     	}
						     	else{
									$json_obj->send_notice_status = 'Send notice failed.';
						     	}
						    }
						    else if($map_emp_notice[$j]['notice_type'] == 2){ //send email

						    	$email_from = "verkapp@teleinfomedia.co.th";
						    	//$email_from = "godlikenokia@gmail.com";						    	
						    	//$emp_email = "lookbaar@gmail.com";

								$email_send_to = $emp_email;
						     	$email_subject = "Update memo ".date("Y-m-d H:i:s");
						     	$email_header = "Content-type: text/html; charset=UTF-8\n"; // or  //
						     	$email_header.= "From: ".$email_from."\n";
						     	$email_message = "";
						     	$email_message.= "คุณ ".$from_emp_name."<br>";
								$email_message.= "ทำการยื่นเอกสาร ".$memo_no."<br>";
								$email_message.= "สถานะเอกสาร ".$memo_status_name."<br>";
						     	$email_message.= "=================================<br>";
						     	$email_message.= "Best regards,<br>".$email_from."<br>";

						     	if(mail($email_send_to , $email_subject , $email_message , $email_header)){
						     		$send_email_status = 'S';
						     		$json_obj->send_email_status = 'Send email success.';
						     	}
						     	else{
						     		$send_email_status = 'F';
						     		$json_obj->send_email_status = 'Send email failed.';
						     	}

						     	//insert data to table notification
						     	$s_sql_7 = "INSERT INTO notification_memo (emp_id_pk , mm_id_pk , nm_title , nm_content , nm_status , nm_notice_type , nm_readed_date , nm_created_date , nm_modified_date) VALUES (".$emp_id_get_notice." , ".$params['memo_id']." , '".$email_subject."' , '".$email_message."' , '".$send_email_status."' , '2' , null , NOW() , NOW()) ";
								$b_flag_7 = $obj_class->manageproc($s_sql_7);
								$obj_log->savelog($save_data_log,"update_memo -> insert -> notification_leave (email)","sql=[$s_sql_7]");
							}
							//else if($map_emp_notice[$i]['notice_type'] == 1){ //send notice to verk

							//}
				     	}
					}
				}
			}
	    }
		
		$obj_class->closedb();
		return $json_obj;
    }

    //2500 -- OK //edit api doc **
	public function insert_memo_from_draft($params , $files) {
		$json_obj = new stdClass();
		$obj_global = new GlobalConstant();		
		$obj_log = new LogFile();		
		$save_data_log = $_SERVER["HTTP_HOST"].$_SERVER["PHP_SELF"];

		$obj_class = new Connectdb($obj_global->getHOST_CMS(), $obj_global->getUSER_CMS() , $obj_global->getPWD_CMS(), "memo",0,FALSE);
		$obj_class_2 = new Connectdb($obj_global->getHOST_CMS(), $obj_global->getUSER_CMS() , $obj_global->getPWD_CMS(), "memo",0,FALSE);

		//$params['company_id']
		//$params['employee_id']
		//$params['memo_id']
		//$params['memo_form_id'] //1 = finanace , 2 = non finance , 3 = advance
		//$params['notice_type'] //1 = send to level , 2 = send all
		//$params['memo_no_id']	
		//$params['prelist_id'] //0 = other
		//$params['prelist_name']
		//$params['memo_type']
		//$params['memo_budget'] //yes , no
		//$params['memo_amount'] 
		//$params['to_employee']
		//$params['concurred_employee'] 
		//$params['cc_employee']
		//$params['memo_detail']

		//$params['memo_format_id']

		//advance memo
		//$params['advance_form_id']
		//$params['advance_no']
		//$params['confirm_payment_employee']
		//$params['sub_type'] -- Approve / Clear / Overpaid

		//$files['attach_file_x']


		//'{"to_emp" :[{"to_emp_com_id": "34664", "to_emp_pos_initial": "MACM"}]}'
		
		//'{"concurred_emp" :[{"concurred_emp_com_id": "34666", "concurred_emp_pos_initial": "CEM"},{"concurred_emp_com_id": "44037","concurred_emp_pos_initial": "SA"}]}'
		//'{"concurred_emp" :[{"concurred_emp_com_id":"","concurred_emp_pos_initial":""}]}'
		
		//'{"cc_emp" :[{"cc_emp_com_id": "43460", "cc_emp_pos_initial": "WMPA"},{"cc_emp_com_id": "42674","cc_emp_pos_initial": "WMPA"}]}'
		//'{"cc_emp" :[{"cc_emp_com_id":"","cc_emp_pos_initial":""}]}'

		//'{"memo_type" :[{"memo_type_id": "11", "memo_type_name": "Non Financial"}]}'

		//'{"confirm_payment_emp" :[{"confirm_payment_emp_com_id": "43460", "confirm_payment_emp_name": "สันติพงศ์ จารัตน์"}]}'

		
		$params['memo_format_id'] = (isset($params['memo_format_id']) && ($params['memo_format_id'] != ''))?$params['memo_format_id']:$params['memo_form_id'];

		$mm_format_id = $params['memo_form_id'];
		$mf_id_pk = $params['memo_format_id'];


		//get now running no
		$s_sql = "SELECT * from memo_NO WHERE mno_id_pk = ".$params['memo_no_id']." ";
		$b_resp = $obj_class->selectproc($s_sql);
		$datas = array();

		if($b_resp && $obj_class->n_row>0) {	
			$now_running_no = $obj_class->getitem("mno_running_no");
			$next_running_no = ((int)$obj_class->getitem("mno_running_no"))+1;
			$show_running_no = str_pad($next_running_no, 5, "0", STR_PAD_LEFT);

			if($obj_class->getitem("mno_format_memoNo") == 'C-xxxxx-YYYYMMDDhhmm'){
				$memo_no = $obj_class->getitem("mno_key_name").'-'.$show_running_no.'-'.$obj_class->getitem("mno_year").date("mdHi");
			}
			else if($obj_class->getitem("mno_format_memoNo") == 'CYYYY/xxxxx'){
				$memo_no = $obj_class->getitem("mno_key_name").'/'.$show_running_no;
			}
			else if($obj_class->getitem("mno_format_memoNo") == 'C/YYYYxxxxx'){
				$memo_no = $obj_class->getitem("mno_key_name").'/'.$obj_class->getitem("mno_year").$show_running_no;
			}
			else if($obj_class->getitem("mno_format_memoNo") == 'C xxxxx/YYYY'){
				$memo_no = $obj_class->getitem("mno_key_name").' '.$show_running_no.'/'.$obj_class->getitem("mno_year");
			}

			$memo_format_date = $obj_class->getitem("mno_format_date");

			//update next running no
			$s_sql_3 = "UPDATE memo_NO ";
			$s_sql_3.= "SET mno_running_no = '".$show_running_no."' , mno_modified_date = NOW() ";
			$s_sql_3.= "WHERE mno_id_pk = '".$params['memo_no_id']."' ";
			$b_flag_3 = $obj_class->manageproc($s_sql_3);
		}

		
		$to_employee = json_decode(str_replace("\\",'',$params['to_employee']));
		$concurred_employee = json_decode(str_replace("\\",'',$params['concurred_employee']));
		$cc_employee = json_decode(str_replace("\\",'',$params['cc_employee']));
		$mm_type = json_decode(str_replace("\\",'',$params['memo_type']));

		$to_emp_com_id = $to_employee->to_emp[0]->to_emp_com_id;
		$to_emp_pos_initial = $to_employee->to_emp[0]->to_emp_pos_initial;

		$count_concurred = count($concurred_employee->concurred_emp);
		for($i=0;$i<$count_concurred;$i++){
			if($i == 0){
				$concurred_emp_com_id = ($concurred_employee->concurred_emp[$i]->concurred_emp_com_id)?$concurred_employee->concurred_emp[$i]->concurred_emp_com_id:null;
				$concurred_emp_pos_initial = ($concurred_employee->concurred_emp[$i]->concurred_emp_pos_initial)?$concurred_employee->concurred_emp[$i]->concurred_emp_pos_initial:null;
			}
			else{
				$concurred_emp_com_id.= ",".$concurred_employee->concurred_emp[$i]->concurred_emp_com_id;
				$concurred_emp_pos_initial.= ",".$concurred_employee->concurred_emp[$i]->concurred_emp_pos_initial;
			}
		}

		$count_cc = count($cc_employee->cc_emp);
		for($i=0;$i<$count_cc;$i++){
			if($i == 0){
				$cc_emp_com_id = ($cc_employee->cc_emp[$i]->cc_emp_com_id != '')?$cc_employee->cc_emp[$i]->cc_emp_com_id:null;
				$cc_emp_pos_initial = ($cc_employee->cc_emp[$i]->cc_emp_pos_initial != '')?$cc_employee->cc_emp[$i]->cc_emp_pos_initial:null;
			}
			else{
				$cc_emp_com_id.= ",".$cc_employee->cc_emp[$i]->cc_emp_com_id;
				$cc_emp_pos_initial.= ",".$cc_employee->cc_emp[$i]->cc_emp_pos_initial;
			}
		}

		$memo_type_id = $mm_type->memo_type[0]->memo_type_id;
		$memo_type_name = $mm_type->memo_type[0]->memo_type_name;

		//advance memo
		if($params['confirm_payment_employee'] != ''){
			$confirm_payment_employee = json_decode(str_replace("\\",'',$params['confirm_payment_employee']));

			$confirm_payment_emp_com_id = $confirm_payment_employee->confirm_payment_emp[0]->confirm_payment_emp_com_id;
			$confirm_payment_emp_name = $confirm_payment_employee->confirm_payment_emp[0]->confirm_payment_emp_name;
		}

		$emp_info = $this->get_emp_info_by_emp_id($params['company_id'] , $params['employee_id']);
		$from_emp_name = $emp_info[0]['emp_name'];
		
		if(sizeof($emp_info[0]) > 1){
			if($concurred_emp_com_id != null){
				$first_notice_emp_com_id = $concurred_employee->concurred_emp[0]->concurred_emp_com_id;
				$first_notice_emp_info = $this->get_emp_info_by_emp_com_id($params['company_id'] , $first_notice_emp_com_id);	
				$memo_status_id = 1;
				$memo_status_name = 'Wait for Agree';
			}
			else{
				$first_notice_emp_com_id = $to_emp_com_id;
				$first_notice_emp_info = $this->get_emp_info_by_emp_com_id($params['company_id'] , $first_notice_emp_com_id);
				$memo_status_id = 3;
				$memo_status_name = 'Wait for Approve';
			}

			$s_sql_1 = "UPDATE memo ";
			$s_sql_1.= "SET mm_NO = '".$memo_no."' , pl_id_pk = ".$params['prelist_id']." , mm_subject = '".$params['prelist_name']."' ";
			$s_sql_1.= ", mt_id_pk = ".$memo_type_id." , mm_sub_type = '".$memo_type_name."' ";
			$s_sql_1.= ", mno_id_pk = ".$params['memo_no_id']." ";
			$s_sql_1.= ", mm_amount = ".$params['memo_amount']." , mm_budget = '".strtolower($params['memo_budget'])."' ";
			$s_sql_1.= ", mm_to = '".$to_emp_pos_initial."' , mm_to_emp_ID = '".$to_emp_com_id."' ";

			if($concurred_emp_com_id != null){
				$s_sql_1.= ", mm_concurred = '".$concurred_emp_pos_initial."' , mm_concurred_emp_ID = '".$concurred_emp_com_id."' ";
			}
			else{
				$s_sql_1.= ", mm_concurred = NULL , mm_concurred_emp_ID = NULL ";
			}

			if($cc_emp_com_id != null){
				$s_sql_1.= ", mm_cc = '".$cc_emp_pos_initial."' , mm_cc_emp_ID = '".$cc_emp_com_id."' ";
			}
			else{
				$s_sql_1.= ", mm_cc = NULL , mm_cc_emp_ID = NULL ";
			}

			$s_sql_1.= ", mm_from = '".$emp_info[0]['emp_pos_initial']."' , mm_from_emp_ID = '".$emp_info[0]['emp_com_id']."' ";
			$s_sql_1.= ", mm_detail = '".$params['memo_detail']."' , mm_modified_date = NOW() ";
			$s_sql_1.= ", mst_id_pk = ".$memo_status_id." , mm_status = '".$memo_status_name."' , mf_id_pk = ".$params['memo_form_id']." ";
			$s_sql_1.= ", com_id_pk = ".$params['company_id']." , emp_id_pk = ".$params['employee_id']." ";
			$s_sql_1.= ", emp_ID = '".$emp_info[0]['emp_com_id']."' , mm_revise = 0 ";
			$s_sql_1.= ", mm_noti_type = ".$params['notice_type']." , mm_issue_date = NOW() , mf_id_pk = ".$mf_id_pk." ";

			//advance memo
			if($mm_format_id == 3){
				$s_sql_1.= ", mm_sub_type_ad = '".$params['sub_type']."' ";
				$s_sql_1.= ", mm_confirm_payment = '".$confirm_payment_emp_name."' ";
				$s_sql_1.= ", mm_confirm_payment_emp_ID = '".$confirm_payment_emp_com_id."' ";
			}

			$s_sql_1.= "WHERE mm_id_pk = ".$params['memo_id']." ";

			$b_flag_1 = $obj_class->manageproc($s_sql_1);
			$obj_log->savelog($save_data_log,"insert_memo_fron_draft -> insert -> memo","sql=[$s_sql_1]");


			if($b_flag_1){
				$s_sql_2 = "INSERT INTO memo_history (mm_id_pk , mmh_status , mmh_comment , mmh_name , mmh_pos , emp_id_pk , emp_ID ";
				$s_sql_2.= ", mmh_approve_date , mmh_issue_date , mmh_created_date , mmh_modified_date , mmh_signature , com_id_pk) ";
				$s_sql_2.= "VALUES (".$params['memo_id']." , '".$memo_status_name."' , NULL , '".$first_notice_emp_info[0]['emp_name']."' ";
				$s_sql_2.= ", '".$first_notice_emp_info[0]['emp_position']."' , ".$first_notice_emp_info[0]['emp_id']." ";
				$s_sql_2.= ", '".$first_notice_emp_com_id."' , NULL , NOW() , NOW() , NOW() , NULL ";
				$s_sql_2.= ", ".$params['company_id'].") ";
				$b_flag_2 = $obj_class->manageproc($s_sql_2);
				$obj_log->savelog($save_data_log,"insert_memo_fron_draft -> insert -> memo_history","sql=[$s_sql_2]");

				if($b_flag_2){
					if($mm_format_id == 3){
						$confirm_payment_emp_info = $this->get_emp_info_by_emp_com_id($params['company_id'] , $confirm_payment_emp_com_id);
	
						//insert -> tb advance_history
						$s_sql_4 = "INSERT INTO advance_history (avf_id_pk , avh_emp_ID ";
						$s_sql_4.= ", avh_emp_name , avh_pos ";
						$s_sql_4.= ", avh_type , avh_created_date , avh_remark) ";
						$s_sql_4.= "VALUES (".$params['advance_form_id']." , '".$confirm_payment_emp_com_id."' ";
						$s_sql_4.= ", '".$confirm_payment_emp_info[0]['emp_name']."' , '".$confirm_payment_emp_info[0]['emp_pos_initial']."' ";
						$s_sql_4.= ", 'Wait for Payment' , NOW() , NULL)";
						$b_flag_4 = $obj_class_2->manageproc($s_sql_4);
					}

					$count_file = count($files);
					if($count_file > 0){
						$path = "../EdC/".$params['company_id']."/memo_attach_file/".$params['memo_id']."/";
						$thumb_path = "../EdC/".$params['company_id']."/memo_thumb_attach_file/".$params['memo_id']."/";

						if(!(file_exists($path))){
							mkdir($path, 0777, true);
						}
						if(!(file_exists($thumb_path))){
							mkdir($thumb_path, 0777, true);
						}
						
						//delete old attach file (files and db)
						$s_sql_0 = "SELECT * FROM memo_attachfile WHERE mm_id_pk = ".$params['memo_id']." ";
						$b_resp_0 = $obj_class->selectproc($s_sql_0);
						if($b_resp_0 && $obj_class->n_row>0) {
							for($i=0;$i<$obj_class->n_row;$i++){	
								$old_attach_file = $obj_class->getitem("ma_path");
								unlink($path.$old_attach_file);

							    $obj_class->movenext();
							}

							$s_sql_00 = "DELETE FROM memo_attachfile WHERE mm_id_pk = ".$params['memo_id']." ";
							$b_resp_00 = $obj_class->manageproc($s_sql_00);
						}

						for($i=0;$i<$count_file;$i++){
							$j = $i+1;

							$files['attach_file_'.$i] = isset($files['attach_file_'.$i])?$files['attach_file_'.$i]:'';
							
							$file_name = date('Ymd_His_').$j.'_'.$params['memo_id'].'.jpg';
							$file_size = $files['attach_file_'.$i]['size'];
							$file_tmp = $files['attach_file_'.$i]['tmp_name'];
							$file_type = $files['attach_file_'.$i]['type'];
							$file_ext = strtolower(end(explode('.',$files['attach_file_'.$i]['name'])));
						
							$expensions = array("jpeg","jpg","png");

							$errors = '{"result_code":1,"result_desc":"success"}';
							if(in_array($file_ext,$expensions) === false){
								$json_obj->command = '2506';
								$json_obj->message = 'Insert memo from draft fail - please choose a JPEG or PNG file.';
							}
							else if($files['attach_file_'.$i]['size'] == 0){
								$json_obj->command = '2507';
								$json_obj->message = 'Insert memo from draft fail - post max file must be exactly 8 MB.';
							}
							else if($files['attach_file_'.$i]['size'] > 2097152){
								$json_obj->command = '2508';
								$json_obj->message = 'Insert memo from draft fail - file size must be exactly 2 MB.';
							}
							else {
								move_uploaded_file($file_tmp , $path.$file_name);
								$this->generate_image_thumbnail($path.$file_name, $thumb_path.$file_name);

								$s_sql_3 = "INSERT INTO memo_attachfile (mm_id_pk , ma_path , ma_created_date , ma_modified_date , com_id_pk) ";
								$s_sql_3.= "VALUES (".$params['memo_id']." , '".$file_name."' , NOW() , NOW() , ".$params['company_id'].") ";
								$b_flag_3 = $obj_class->manageproc($s_sql_3);
								$obj_log->savelog($save_data_log,"insert_memo_fron_draft -> insert -> memo_attachfile","sql=[$s_sql_3]");

								if($b_flag_3){
									//update draft status
									$s_sql_4 = "UPDATE draft_memo ";
									$s_sql_4.= "SET dm_status = 0 , dm_modified_date = NOW() ";
									$s_sql_4.= "WHERE mm_id_pk = ".$params['memo_id']." ";
									$b_flag_4 = $obj_class->manageproc($s_sql_4);

									$json_obj->command = '2500';
									$json_obj->message = 'Insert memo from draft success.';
								}
								else{
									$json_obj->command = '2505';
									$json_obj->message = 'Insert memo from draft fail - insert memo_attachfile fail.';
								}
							}
						}
					}
					else{
						$json_obj->command = '2500';
						$json_obj->message = 'Insert memo from draft success.';
					}
				}
				else{
					$json_obj->command = '2504';
					$json_obj->message = 'Insert memo from draft fail - insert memo_history fail.';
				}
			}
			else{
				$json_obj->command = '2503';
				$json_obj->message = 'Insert memo from draft fail - update memo fail.';
			}
		}
		else{
			$json_obj->command = '2502';
			$json_obj->message = 'Data is invalid. (emp_info)';
		}
		
		if($json_obj->command == '2500'){

			/*
			if($concurred_emp_com_id != null){
				$first_notice_emp_com_id = $concurred_employee->concurred_emp[0]->concurred_emp_com_id;
				$first_notice_emp_info = $this->get_emp_info_by_emp_com_id($params['company_id'] , $first_notice_emp_com_id);	
				$memo_status_name = 'Wait for Agree';
			}
			else{
				$first_notice_emp_com_id = $to_emp_com_id;
				$first_notice_emp_info = $this->get_emp_info_by_emp_com_id($params['company_id'] , $first_notice_emp_com_id);
				$memo_status_name = 'Wait for Approve';
			}
			*/

			$result = $this->add_summary_profile($params['company_id'] , $first_notice_emp_com_id , $memo_status_name);

			if($result){
				if($params['notice_type'] == 1){ //1 = send to level 
					//send notice to first concurred employee or to employee
					$emp_com_id = $first_notice_emp_com_id;
					$emp_id_get_notice = $first_notice_emp_info[0]['emp_id'];
					$device_type = $first_notice_emp_info[0]['emp_device_type'];
					$push_token = $first_notice_emp_info[0]['emp_gcm_token'];
					$emp_name = $first_notice_emp_info[0]['emp_name'];
					$emp_email = $first_notice_emp_info[0]['emp_email'];
					
					$map_emp_notice = $this->get_map_emp_notice($params['company_id'] , $emp_com_id);

			     	for($j=0;$j<count($map_emp_notice);$j++){
			     		if(($map_emp_notice[$j]['notice_type'] == 3) && ($push_token != '')){ //send notice
							
							$notice_title = "Memo";
			     			$notice_content = "คุณ ".$from_emp_name."\nทำการยื่นเอกสาร ".$memo_no."\nสถานะเอกสาร ".$memo_status_name;

			     			//insert data to table notification
					     	$s_sql_7 = "INSERT INTO notification_memo (emp_id_pk , mm_id_pk , nm_title , nm_content , nm_status , nm_notice_type , nm_readed_date , nm_created_date , nm_modified_date) VALUES (".$emp_id_get_notice." , ".$params['memo_id']." , '".$notice_title."' , '".$notice_content."' , 'U' , '3' , null , NOW() , NOW()) ";
							$b_flag_7 = $obj_class->manageproc($s_sql_7);
							$obj_log->savelog($save_data_log,"insert_memo_fron_draft -> insert -> notification_leave (memo)","sql=[$s_sql_7]");

							if($device_type == "ios"){
								$data["aps"] = array(
												"alert"	=> array(
													"title" => $notice_title,
													"body" => $notice_content
													 ),
												"badge" => $this->get_badge_notice($emp_id_get_notice),
												"content-available" => 1
											);
								
								$ios[$push_token] = $data;
								$rs = $this->send_push_notice_ios($ios);
							}
							else if($device_type == "android"){
						     	$data = array(
									"data" => array(
										"title" => $notice_title,
										"content" => $notice_content,
										"badge" => $this->get_badge_notice($emp_id_get_notice)
									) , 
									"priority" => "high", 
									"to" => $push_token
								);

								$data_string = json_encode($data);  

								$result = $this->send_push_notice_android($data_string);
								$rs = ($result->success)?true:false;
							}
							
							if($rs){
								$json_obj->send_notice_status = 'Send notice success.';
					     	}
					     	else{
								$json_obj->send_notice_status = 'Send notice failed.';
					     	}
					    }
					    else if($map_emp_notice[$j]['notice_type'] == 2){ //send email

					    	$email_from = "verkapp@teleinfomedia.co.th";
					    	//$email_from = "godlikenokia@gmail.com";						    	
					    	//$emp_email = "lookbaar@gmail.com";

							$email_send_to = $emp_email;
					     	$email_subject = "Insert memo ".date("Y-m-d H:i:s");
					     	$email_header = "Content-type: text/html; charset=UTF-8\n"; // or  //
					     	$email_header.= "From: ".$email_from."\n";
					     	$email_message = "";
					     	$email_message.= "คุณ ".$from_emp_name."<br>";
							$email_message.= "ทำการยื่นเอกสาร ".$memo_no."<br>";
							$email_message.= "สถานะเอกสาร ".$memo_status_name."<br>";
					     	$email_message.= "=================================<br>";
					     	$email_message.= "Best regards,<br>".$email_from."<br>";

					     	if(mail($email_send_to , $email_subject , $email_message , $email_header)){
					     		$send_email_status = 'S';
					     		$json_obj->send_email_status = 'Send email success.';
					     	}
					     	else{
					     		$send_email_status = 'F';
					     		$json_obj->send_email_status = 'Send email failed.';
					     	}

					     	//insert data to table notification
					     	$s_sql_7 = "INSERT INTO notification_memo (emp_id_pk , mm_id_pk , nm_title , nm_content , nm_status , nm_notice_type , nm_readed_date , nm_created_date , nm_modified_date) VALUES (".$emp_id_get_notice." , ".$params['memo_id']." , '".$email_subject."' , '".$email_message."' , '".$send_email_status."' , '2' , null , NOW() , NOW()) ";
							$b_flag_7 = $obj_class->manageproc($s_sql_7);
							$obj_log->savelog($save_data_log,"insert_memo_fron_draft -> insert -> notification_leave (email)","sql=[$s_sql_7]");
						}
						//else if($map_emp_notice[$j]['notice_type'] == 1){ //send notice to verk

						//}
			     	}
				}
				else{ //2 = send all
					//send notice to all concurred_employee
					for($i=0;$i<$count_concurred;$i++){
						$concurred_emp_info = $this->get_emp_info_by_emp_com_id($params['company_id'] , $concurred_employee->concurred_emp[$i]->concurred_emp_com_id);	

						$emp_com_id = $concurred_employee->concurred_emp[$i]->concurred_emp_com_id;
						$emp_id_get_notice = $concurred_emp_info[0]['emp_id'];
						$device_type = $concurred_emp_info[0]['emp_device_type'];
						$push_token = $concurred_emp_info[0]['emp_gcm_token'];
						$emp_name = $concurred_emp_info[0]['emp_name'];
						$emp_email = $concurred_emp_info[0]['emp_email'];
						
						$map_emp_notice = $this->get_map_emp_notice($params['company_id'] , $emp_com_id);

				     	for($j=0;$j<count($map_emp_notice);$j++){
				     		if(($map_emp_notice[$j]['notice_type'] == 3) && ($push_token != '')){ //send notice
								
								$notice_title = "Memo";
				     			$notice_content = "คุณ ".$from_emp_name."\nทำการยื่นเอกสาร ".$memo_no."\nสถานะเอกสาร ".$memo_status_name;

				     			//insert data to table notification
						     	$s_sql_7 = "INSERT INTO notification_memo (emp_id_pk , mm_id_pk , nm_title , nm_content , nm_status , nm_notice_type , nm_readed_date , nm_created_date , nm_modified_date) VALUES (".$emp_id_get_notice." , ".$params['memo_id']." , '".$notice_title."' , '".$notice_content."' , 'U' , '3' , null , NOW() , NOW()) ";
								$b_flag_7 = $obj_class->manageproc($s_sql_7);
								$obj_log->savelog($save_data_log,"insert_memo_fron_draft -> insert -> notification_leave (memo)","sql=[$s_sql_7]");

								if($device_type == "ios"){
									$data["aps"] = array(
													"alert"	=> array(
														"title" => $notice_title,
														"body" => $notice_content
														 ),
													"badge" => $this->get_badge_notice($emp_id_get_notice),
													"content-available" => 1
												);
									
									$ios[$push_token] = $data;
									$rs = $this->send_push_notice_ios($ios);
								}
								else if($device_type == "android"){
							     	$data = array(
										"data" => array(
											"title" => $notice_title,
											"content" => $notice_content,
											"badge" => $this->get_badge_notice($emp_id_get_notice)
										) , 
										"priority" => "high", 
										"to" => $push_token
									);

									$data_string = json_encode($data);  

									$result = $this->send_push_notice_android($data_string);
									$rs = ($result->success)?true:false;
								}
								
								if($rs){
									$json_obj->send_notice_status = 'Send notice success.';
						     	}
						     	else{
									$json_obj->send_notice_status = 'Send notice failed.';
						     	}
						    }
						    else if($map_emp_notice[$j]['notice_type'] == 2){ //send email

						    	$email_from = "verkapp@teleinfomedia.co.th";
						    	//$email_from = "godlikenokia@gmail.com";						    	
						    	//$emp_email = "lookbaar@gmail.com";

								$email_send_to = $emp_email;
						     	$email_subject = "Insert memo ".date("Y-m-d H:i:s");
						     	$email_header = "Content-type: text/html; charset=UTF-8\n"; // or  //
						     	$email_header.= "From: ".$email_from."\n";
						     	$email_message = "";
						     	$email_message.= "คุณ ".$from_emp_name."<br>";
								$email_message.= "ทำการยื่นเอกสาร ".$memo_no."<br>";
								$email_message.= "สถานะเอกสาร ".$memo_status_name."<br>";
						     	$email_message.= "=================================<br>";
						     	$email_message.= "Best regards,<br>".$email_from."<br>";

						     	if(mail($email_send_to , $email_subject , $email_message , $email_header)){
						     		$send_email_status = 'S';
						     		$json_obj->send_email_status = 'Send email success.';
						     	}
						     	else{
						     		$send_email_status = 'F';
						     		$json_obj->send_email_status = 'Send email failed.';
						     	}

						     	//insert data to table notification
						     	$s_sql_7 = "INSERT INTO notification_memo (emp_id_pk , mm_id_pk , nm_title , nm_content , nm_status , nm_notice_type , nm_readed_date , nm_created_date , nm_modified_date) VALUES (".$emp_id_get_notice." , ".$params['memo_id']." , '".$email_subject."' , '".$email_message."' , '".$send_email_status."' , '2' , null , NOW() , NOW()) ";
								$b_flag_7 = $obj_class->manageproc($s_sql_7);
								$obj_log->savelog($save_data_log,"insert_memo_fron_draft -> insert -> notification_leave (email)","sql=[$s_sql_7]");
							}
							//else if($map_emp_notice[$i]['notice_type'] == 1){ //send notice to verk

							//}
				     	}
					}

					//send notice to to_employee
					$to_emp_info = $this->get_emp_info_by_emp_com_id($params['company_id'] , $to_emp_com_id);

					$emp_com_id = $to_emp_com_id;
					$emp_id_get_notice = $to_emp_info[0]['emp_id'];
					$device_type = $to_emp_info[0]['emp_device_type'];
					$push_token = $to_emp_info[0]['emp_gcm_token'];
					$emp_name = $to_emp_info[0]['emp_name'];
					$emp_email = $to_emp_info[0]['emp_email'];

					$map_emp_notice = $this->get_map_emp_notice($params['company_id'] , $emp_com_id);

			     	for($j=0;$j<count($map_emp_notice);$j++){
			     		if(($map_emp_notice[$j]['notice_type'] == 3) && ($push_token != '')){ //send notice
							
							$notice_title = "Memo";
			     			$notice_content = "คุณ ".$from_emp_name."\nทำการยื่นเอกสาร ".$memo_no."\nสถานะเอกสาร ".$memo_status_name;

			     			//insert data to table notification
					     	$s_sql_7 = "INSERT INTO notification_memo (emp_id_pk , mm_id_pk , nm_title , nm_content , nm_status , nm_notice_type , nm_readed_date , nm_created_date , nm_modified_date) VALUES (".$emp_id_get_notice." , ".$params['memo_id']." , '".$notice_title."' , '".$notice_content."' , 'U' , '3' , null , NOW() , NOW()) ";
							$b_flag_7 = $obj_class->manageproc($s_sql_7);
							$obj_log->savelog($save_data_log,"insert_memo_fron_draft -> insert -> notification_leave (memo)","sql=[$s_sql_7]");

							if($device_type == "ios"){
								$data["aps"] = array(
												"alert"	=> array(
													"title" => $notice_title,
													"body" => $notice_content
													 ),
												"badge" => $this->get_badge_notice($emp_id_get_notice),
												"content-available" => 1
											);
								
								$ios[$push_token] = $data;
								$rs = $this->send_push_notice_ios($ios);
							}
							else if($device_type == "android"){
						     	$data = array(
									"data" => array(
										"title" => $notice_title,
										"content" => $notice_content,
										"badge" => $this->get_badge_notice($emp_id_get_notice)
									) , 
									"priority" => "high", 
									"to" => $push_token
								);

								$data_string = json_encode($data);  

								$result = $this->send_push_notice_android($data_string);
								$rs = ($result->success)?true:false;
							}
							
							if($rs){
								$json_obj->send_notice_status = 'Send notice success.';
					     	}
					     	else{
								$json_obj->send_notice_status = 'Send notice failed.';
					     	}
					    }
					    else if($map_emp_notice[$j]['notice_type'] == 2){ //send email

					    	$email_from = "verkapp@teleinfomedia.co.th";
					    	//$email_from = "godlikenokia@gmail.com";						    	
					    	//$emp_email = "lookbaar@gmail.com";

							$email_send_to = $emp_email;
					     	$email_subject = "Insert memo ".date("Y-m-d H:i:s");
					     	$email_header = "Content-type: text/html; charset=UTF-8\n"; // or  //
					     	$email_header.= "From: ".$email_from."\n";
					     	$email_message = "";
					     	$email_message.= "Insert memo no : ".$memo_no;
					     	$email_message.= "คุณ ".$from_emp_name."<br>";
							$email_message.= "ทำการยื่นเอกสาร ".$memo_no."<br>";
							$email_message.= "สถานะเอกสาร ".$memo_status_name."<br>";
					     	$email_message.= "=================================<br>";
					     	$email_message.= "Best regards,<br>".$email_from."<br>";

					     	if(mail($email_send_to , $email_subject , $email_message , $email_header)){
					     		$send_email_status = 'S';
					     		$json_obj->send_email_status = 'Send email success.';
					     	}
					     	else{
					     		$send_email_status = 'F';
					     		$json_obj->send_email_status = 'Send email failed.';
					     	}

					     	//insert data to table notification
					     	$s_sql_7 = "INSERT INTO notification_memo (emp_id_pk , mm_id_pk , nm_title , nm_content , nm_status , nm_notice_type , nm_readed_date , nm_created_date , nm_modified_date) VALUES (".$emp_id_get_notice." , ".$params['memo_id']." , '".$email_subject."' , '".$email_message."' , '".$send_email_status."' , '2' , null , NOW() , NOW()) ";
							$b_flag_7 = $obj_class->manageproc($s_sql_7);
							$obj_log->savelog($save_data_log,"insert_memo_fron_draft -> insert -> notification_leave (email)","sql=[$s_sql_7]");
						}
						//else if($map_emp_notice[$i]['notice_type'] == 1){ //send notice to verk

						//}
			     	}

					//send notice to all cc_employee
					for($i=0;$i<$count_cc;$i++){
						$cc_emp_info = $this->get_emp_info_by_emp_com_id($params['company_id'] , $cc_employee->cc_emp[$i]->cc_emp_com_id);	

						$emp_com_id = $cc_employee->cc_emp[$i]->cc_emp_com_id;
						$emp_id_get_notice = $cc_emp_info[0]['emp_id'];
						$device_type = $cc_emp_info[0]['emp_device_type'];
						$push_token = $cc_emp_info[0]['emp_gcm_token'];
						$emp_name = $cc_emp_info[0]['emp_name'];
						$emp_email = $cc_emp_info[0]['emp_email'];
						
						$map_emp_notice = $this->get_map_emp_notice($params['company_id'] , $emp_com_id);

				     	for($j=0;$j<count($map_emp_notice);$j++){
				     		if(($map_emp_notice[$j]['notice_type'] == 3) && ($push_token != '')){ //send notice
								
								$notice_title = "Memo";
				     			$notice_content = "คุณ ".$from_emp_name."\nทำการยื่นเอกสาร ".$memo_no."\nสถานะเอกสาร ".$memo_status_name;

				     			//insert data to table notification
						     	$s_sql_7 = "INSERT INTO notification_memo (emp_id_pk , mm_id_pk , nm_title , nm_content , nm_status , nm_notice_type , nm_readed_date , nm_created_date , nm_modified_date) VALUES (".$emp_id_get_notice." , ".$params['memo_id']." , '".$notice_title."' , '".$notice_content."' , 'U' , '3' , null , NOW() , NOW()) ";
								$b_flag_7 = $obj_class->manageproc($s_sql_7);
								$obj_log->savelog($save_data_log,"insert_memo_fron_draft -> insert -> notification_leave (memo)","sql=[$s_sql_7]");

								if($device_type == "ios"){
									$data["aps"] = array(
													"alert"	=> array(
														"title" => $notice_title,
														"body" => $notice_content
														 ),
													"badge" => $this->get_badge_notice($emp_id_get_notice),
													"content-available" => 1
												);
									
									$ios[$push_token] = $data;
									$rs = $this->send_push_notice_ios($ios);
								}
								else if($device_type == "android"){
							     	$data = array(
										"data" => array(
											"title" => $notice_title,
											"content" => $notice_content,
											"badge" => $this->get_badge_notice($emp_id_get_notice)
										) , 
										"priority" => "high", 
										"to" => $push_token
									);

									$data_string = json_encode($data);  

									$result = $this->send_push_notice_android($data_string);
									$rs = ($result->success)?true:false;
								}
								
								if($rs){
									$json_obj->send_notice_status = 'Send notice success.';
						     	}
						     	else{
									$json_obj->send_notice_status = 'Send notice failed.';
						     	}
						    }
						    else if($map_emp_notice[$j]['notice_type'] == 2){ //send email

						    	$email_from = "verkapp@teleinfomedia.co.th";
						    	//$email_from = "godlikenokia@gmail.com";						    	
						    	//$emp_email = "lookbaar@gmail.com";

								$email_send_to = $emp_email;
						     	$email_subject = "Insert memo ".date("Y-m-d H:i:s");
						     	$email_header = "Content-type: text/html; charset=UTF-8\n"; // or  //
						     	$email_header.= "From: ".$email_from."\n";
						     	$email_message = "";
						     	$email_message.= "คุณ ".$from_emp_name."<br>";
								$email_message.= "ทำการยื่นเอกสาร ".$memo_no."<br>";
								$email_message.= "สถานะเอกสาร ".$memo_status_name."<br>";
						     	$email_message.= "=================================<br>";
						     	$email_message.= "Best regards,<br>".$email_from."<br>";

						     	if(mail($email_send_to , $email_subject , $email_message , $email_header)){
						     		$send_email_status = 'S';
						     		$json_obj->send_email_status = 'Send email success.';
						     	}
						     	else{
						     		$send_email_status = 'F';
						     		$json_obj->send_email_status = 'Send email failed.';
						     	}

						     	//insert data to table notification
						     	$s_sql_7 = "INSERT INTO notification_memo (emp_id_pk , mm_id_pk , nm_title , nm_content , nm_status , nm_notice_type , nm_readed_date , nm_created_date , nm_modified_date) VALUES (".$emp_id_get_notice." , ".$params['memo_id']." , '".$email_subject."' , '".$email_message."' , '".$send_email_status."' , '2' , null , NOW() , NOW()) ";
								$b_flag_7 = $obj_class->manageproc($s_sql_7);
								$obj_log->savelog($save_data_log,"insert_memo_fron_draft -> insert -> notification_leave (email)","sql=[$s_sql_7]");
							}
							//else if($map_emp_notice[$i]['notice_type'] == 1){ //send notice to verk

							//}
				     	}
					}
				}		
			}

			
	    }

		$obj_class->closedb();
		return $json_obj;
    }



    //2600 -- OK
	public function get_favorite_list($params) {
		$json_obj = new stdClass();
		$obj_global = new GlobalConstant();		
		$obj_log = new LogFile();		
		$save_data_log = $_SERVER["HTTP_HOST"].$_SERVER["PHP_SELF"];

		$obj_class = new Connectdb($obj_global->getHOST_CMS(), $obj_global->getUSER_CMS() , $obj_global->getPWD_CMS(), "memo",0,FALSE);

		//$params['company_id']
		//$params['employee_id']
		//$params['form_id']
		
		//select -> tb favorite_list
		$s_sql = "SELECT mm.* , fl.fl_id_pk , fl.fl_status from memo mm ";
		$s_sql.= "LEFT JOIN favorite_list fl ON mm.mm_id_pk = fl.mm_id_pk ";
		$s_sql.= "WHERE fl.com_id_pk = '".$params['company_id']."' AND fl.emp_id_pk = '".$params['employee_id']."' ";
		$s_sql.= "AND mm.mm_format_id = ".$params['form_id']." AND fl_status = 1 ORDER BY mm.mm_created_date DESC ";
		$b_resp = $obj_class->selectproc($s_sql);
		$obj_log->savelog($save_data_log,"check_approve_budget","sql=[$s_sql]");
		$datas = array();
		
		if($b_resp && $obj_class->n_row>0) {
			for($i=0;$i<$obj_class->n_row;$i++){	
				$today = date_create(date("Y-m-d H:i:s"));
				$modified_date = date_create($obj_class->getitem("mm_modified_date"));

				$diff_day = date_diff($today,$modified_date)->format("%d");
				$diff_hour = date_diff($today,$modified_date)->format("%h");
				$diff_minute = date_diff($today,$modified_date)->format("%i");
				
				$modified_time = strtotime($obj_class->getitem("mm_modified_date"));   
				$now = strtotime(date("Y-m-d H:i:s"));

				if($diff_day == 0) { 
					if($diff_hour > 0){
						$last_update = $diff_hour.' ชั่วโมง '.$diff_minute.' นาที';
					}
					else{
						$last_update = $diff_minute.' นาที';
					}
				}
				else{
					$last_update = $diff_day.' วัน';
				}

				$datas[$i]['favorite_id'] = $obj_class->getitem("fl_id_pk");
				$datas[$i]['memo_id'] = $obj_class->getitem("mm_id_pk");
				$datas[$i]['memo_no'] = $obj_class->getitem("mm_NO");
				$datas[$i]['memo_subject'] = $obj_class->getitem("mm_subject");
				$datas[$i]['memo_form_id'] = $obj_class->getitem("mm_format_id");
				$datas[$i]['memo_type_name'] = $obj_class->getitem("mm_sub_type");
				$datas[$i]['memo_create_date'] = date("Y-m-d", strtotime($obj_class->getitem("mm_created_date")));
				$datas[$i]['memo_create_time'] = date("H:i", strtotime($obj_class->getitem("mm_created_date")));
				$datas[$i]['memo_type_name'] = $obj_class->getitem("mm_sub_type");

			    $obj_class->movenext();
			}

			$json_obj->command = '2600';
			$json_obj->message = 'Get data success.';
			$json_obj->data = $datas;
		}
		else{
			$json_obj->command = '2602';
			$json_obj->message = 'Data not found.';
		}
		
		$obj_class->closedb();
		return $json_obj;
    }

    //2700 -- OK
	public function check_approve_budget($params) {
		$json_obj = new stdClass();
		$obj_global = new GlobalConstant();		
		$obj_log = new LogFile();		
		$save_data_log = $_SERVER["HTTP_HOST"].$_SERVER["PHP_SELF"];

		$obj_class = new Connectdb($obj_global->getHOST_CMS(), $obj_global->getUSER_CMS() , $obj_global->getPWD_CMS(), "memo",0,FALSE);

		//$params['company_id']
		//$params['employee_code']
		//$params['memo_type_id']
		//$params['memo_amount']

		$emp_info = $this->get_emp_info_by_emp_com_id($params['company_id'] , $params['employee_code']);	
		
		//select -> tb approval_permission
		$s_sql = "SELECT * from approval_permission WHERE com_id_pk = '".$params['company_id']."' AND emp_id_pk = '".$emp_info[0]['emp_id']."' AND mt_id_pk = ".$params['memo_type_id'];
		$b_resp = $obj_class->selectproc($s_sql);
		$obj_log->savelog($save_data_log,"check_approve_budget","sql=[$s_sql]");
		$datas = array();
		
		if ($b_resp && $obj_class->n_row>0) {

			if($params['memo_amount'] <= $obj_class->getitem("ap_budget")){
				$json_obj->command = '2700';
				$json_obj->message = 'Data is valid.';
			}
			else{
				$json_obj->command = '2703';
				$json_obj->message = 'Over budget.';
			}
		}
		else{
			$json_obj->command = '2702';
			$json_obj->message = 'Permission not found.';
		}
		
		$obj_class->closedb();
		return $json_obj;
    }

    
 

    //2800 -- OK //edit api doc
	public function get_memo_list($params) {
		$json_obj = new stdClass();
		$obj_global = new GlobalConstant();		
		$obj_log = new LogFile();		
		$save_data_log = $_SERVER["HTTP_HOST"].$_SERVER["PHP_SELF"];

		$obj_class = new Connectdb($obj_global->getHOST_CMS(), $obj_global->getUSER_CMS() , $obj_global->getPWD_CMS(), "memo",0,FALSE);
		$obj_class_2 = new Connectdb($obj_global->getHOST_CMS(), $obj_global->getUSER_CMS() , $obj_global->getPWD_CMS(), "employee",0,FALSE);
		$obj_class_3 = new Connectdb($obj_global->getHOST_CMS(), $obj_global->getUSER_CMS() , $obj_global->getPWD_CMS(), "memo",0,FALSE);

		//$params['company_id']
		//$params['employee_id']

		//$params['division_id']
		//$params['department_id']
		//$params['section_id']
		//$params['memo_key'] (memo_NO , memo_subject)
		//$params['memo_type_id']
		//$params['start_date']
		//$params['end_date']
		//$params['memo_status_id']

		//$params['action_emp_com_id']

		$params['division_id'] = (isset($params['division_id']) && ($params['division_id'] != ''))?$params['division_id']:'';
		$params['department_id'] = (isset($params['department_id']) && ($params['department_id'] != ''))?$params['department_id']:'';
		$params['section_id'] = (isset($params['section_id']) && ($params['section_id'] != ''))?$params['section_id']:'';
		$params['memo_key'] = (isset($params['memo_key']) && ($params['memo_key'] != ''))?$params['memo_key']:'';
		$params['memo_type_id'] = (isset($params['memo_type_id']) && ($params['memo_type_id'] != ''))?$params['memo_type_id']:'';
		$params['start_date'] = (isset($params['start_date']) && ($params['start_date'] != ''))?$params['start_date']:'';
		$params['end_date'] = (isset($params['end_date']) && ($params['end_date'] != ''))?$params['end_date']:'';
		$params['memo_status_id'] = (isset($params['memo_status_id']) && ($params['memo_status_id'] != ''))?$params['memo_status_id']:'';

		$params['action_emp_com_id'] = (isset($params['action_emp_com_id']) && ($params['action_emp_com_id'] != ''))?$params['action_emp_com_id']:'';

		$emp_info = $this->get_emp_info_by_emp_id($params['company_id'] , $params['employee_id']);

		//$emp_info[0]['emp_com_id']

		//$emp_info[0]['emp_leval'] = 1;
		if($emp_info[0]['emp_level'] == 1){ //CEO
			//select -> tb memo
			$s_sql = "SELECT mm.* , fl.fl_id_pk , fl.fl_status , emp.dv_id_pk , emp.dp_id_pk , emp.st_id_pk from memo.memo mm ";
			$s_sql.= "LEFT JOIN memo.favorite_list fl ON mm.mm_id_pk = fl.mm_id_pk AND fl.emp_ID = '".$emp_info[0]['emp_com_id']."' ";
			$s_sql.= "LEFT JOIN employee.employee emp ON mm.emp_id_pk = emp.emp_id_pk ";
			$s_sql.= "WHERE mm.com_id_pk = ".$params['company_id']." AND mm.mm_NO IS NOT NULL ";
			
			
			if($params['division_id'] != ''){
				$s_sql.= "AND emp.dv_id_pk = ".$params['division_id']." ";
			}
			if($params['department_id'] != ''){
				$s_sql.= "AND emp.dp_id_pk = ".$params['department_id']." ";
			}
			if($params['section_id'] != ''){
				$s_sql.= "AND emp.st_id_pk = ".$params['section_id']." ";
			}
		

			if($params['memo_key'] != ''){
				$s_sql.= "AND (mm.mm_NO LIKE '%".$params['memo_key']."%' OR mm.mm_subject LIKE '%".$params['memo_key']."%') ";
			}
			if($params['memo_type_id'] != ''){
				$s_sql.= "AND mm.mt_id_pk = ".$params['memo_type_id']." ";
			}
			if( ($params['start_date'] != '') && ($params['end_date'] != '') ){
				$s_sql.= "AND mm.mm_created_date BETWEEN '".$params['start_date']."' AND '".$params['end_date']."' ";
			}
			if($params['memo_status_id'] != ''){
				$s_sql.= "AND mm.mst_id_pk = ".$params['memo_status_id']." ";

				if(($params['memo_status_id'] == 1) && ($params['action_emp_com_id'] != '')){
					$s_sql.= "AND mm.mm_concurred_emp_ID LIKE '%".$params['action_emp_com_id']."%' ";
				}
				else if(($params['memo_status_id'] == 3) && ($params['action_emp_com_id'] != '')){
					$s_sql.= "AND mm.mm_to_emp_ID LIKE '%".$params['action_emp_com_id']."%' ";
				}
			}

			$s_sql.= "ORDER BY mm.mm_modified_date DESC , mm.mm_status DESC , mm.mm_issue_date DESC ";
		}
		else if(($emp_info[0]['emp_dv_id'] != 0) && ($emp_info[0]['emp_dp_id'] == 0) && ($emp_info[0]['emp_st_id'] == 0)){ //manager
			//select -> tb memo
			$s_sql = "SELECT mm.* , fl.fl_id_pk , fl.fl_status , emp.dv_id_pk , emp.dp_id_pk , emp.st_id_pk from memo.memo mm ";
			$s_sql.= "LEFT JOIN memo.favorite_list fl ON mm.mm_id_pk = fl.mm_id_pk AND fl.emp_ID = '".$emp_info[0]['emp_com_id']."' ";
			$s_sql.= "LEFT JOIN employee.employee emp ON mm.emp_id_pk = emp.emp_id_pk ";
			$s_sql.= "WHERE mm.com_id_pk = ".$params['company_id']." AND mm.mm_NO IS NOT NULL ";


			
			//created
			$s_sql.= "AND (mm.emp_ID = '".$emp_info[0]['emp_com_id']."' ";
			
			//wait for agree
			$s_sql.= "OR mm.mm_concurred_emp_ID LIKE '%".$emp_info[0]['emp_com_id']."%' ";

			//wait for approve
			$s_sql.= "OR mm.mm_to_emp_ID LIKE '%".$emp_info[0]['emp_com_id']."%' ";

			//approve
			$s_sql.= "OR mm.mm_cc_emp_ID LIKE '%".$emp_info[0]['emp_com_id']."%' ";

			//disapprove , terminate , disagree
			$s_sql.= "OR mm.mm_from_emp_ID LIKE '%".$emp_info[0]['emp_com_id']."%' ";

			//create by division
			$s_sql.= "OR emp.dv_id_pk = ".$emp_info[0]['emp_dv_id']." )";
			


			$s_sql.= "AND emp.emp_level >= '".$emp_info[0]['emp_level']."' ";	
			
			if($params['department_id'] != ''){
				$s_sql.= "AND emp.dp_id_pk = ".$params['department_id']." ";
			}
			if($params['section_id'] != ''){
				$s_sql.= "AND emp.st_id_pk = ".$params['section_id']." ";
			}
			
			

			if($params['memo_key'] != ''){
				$s_sql.= "AND (mm.mm_NO LIKE '%".$params['memo_key']."%' OR mm.mm_subject LIKE '%".$params['memo_key']."%') ";
			}
			if($params['memo_type_id'] != ''){
				$s_sql.= "AND mm.mt_id_pk = ".$params['memo_type_id']." ";
			}
			if( ($params['start_date'] != '') && ($params['end_date'] != '') ){
				$s_sql.= "AND mm.mm_created_date BETWEEN '".$params['start_date']."' AND '".$params['end_date']."' ";
			}
			if($params['memo_status_id'] != ''){
				$s_sql.= "AND mm.mst_id_pk = ".$params['memo_status_id']." ";

				if(($params['memo_status_id'] == 1) && ($params['action_emp_com_id'] != '')){
					$s_sql.= "AND mm.mm_concurred_emp_ID LIKE '%".$params['action_emp_com_id']."%' ";
				}
				else if(($params['memo_status_id'] == 3) && ($params['action_emp_com_id'] != '')){
					$s_sql.= "AND mm.mm_to_emp_ID LIKE '%".$params['action_emp_com_id']."%' ";
				}
			}

			$s_sql.= "ORDER BY mm.mm_modified_date DESC , mm.mm_status DESC , mm.mm_issue_date DESC ";
		}	
		else{ //employee
			//get min level
			$s_sql_2 = "SELECT emp_level from employee WHERE com_id_pk = ".$params['company_id']." AND dv_id_pk = ".$params['division_id']." AND dp_id_pk = ".$params['department_id']." AND st_id_pk = ".$params['section_id']." ORDER BY emp_level DESC LIMIT 1 ";
			$b_resp_2 = $obj_class_2->selectproc($s_sql_2);

			$is_min_level = false;

			if($b_resp_2 && $obj_class_2->n_row>0) {
				if($obj_class_2->getitem("emp_level") != $emp_info[0]['emp_level']){
					$is_min_level = true;
				}
			}


			//select -> tb memo
			$s_sql = "SELECT mm.* , fl.fl_id_pk , fl.fl_status , emp.dv_id_pk , emp.dp_id_pk , emp.st_id_pk from memo.memo mm ";
			$s_sql.= "LEFT JOIN memo.favorite_list fl ON mm.mm_id_pk = fl.mm_id_pk AND fl.emp_ID = '".$emp_info[0]['emp_com_id']."' ";
			$s_sql.= "LEFT JOIN employee.employee emp ON mm.emp_id_pk = emp.emp_id_pk ";
			$s_sql.= "WHERE mm.com_id_pk = ".$params['company_id']." AND mm.mm_NO IS NOT NULL ";
			
			//created
			$s_sql.= "AND (mm.emp_ID = '".$emp_info[0]['emp_com_id']."' ";
			
			//wait for agree
			$s_sql.= "OR mm.mm_concurred_emp_ID LIKE '%".$emp_info[0]['emp_com_id']."%' ";

			//wait for approve
			$s_sql.= "OR mm.mm_to_emp_ID LIKE '%".$emp_info[0]['emp_com_id']."%' ";

			//approve
			$s_sql.= "OR mm.mm_cc_emp_ID LIKE '%".$emp_info[0]['emp_com_id']."%' ";

			//disapprove , terminate , disagree
			$s_sql.= "OR mm.mm_from_emp_ID LIKE '%".$emp_info[0]['emp_com_id']."%' ";
			
			if($is_min_level) {
				//create by division or department
				$s_sql.= "OR emp.dv_id_pk = ".$emp_info[0]['emp_dv_id']." ";
				$s_sql.= "OR emp.dp_id_pk = ".$emp_info[0]['emp_dp_id']." ";
			}
			$s_sql.= ") ";

			if($is_min_level) {
				$s_sql.= "AND emp.emp_level >= '".$emp_info[0]['emp_level']."' ";
			}

			if($params['section_id'] != ''){
				$s_sql.= "AND emp.st_id_pk = ".$params['section_id']." ";
			}
			
			

			if($params['memo_key'] != ''){
				$s_sql.= "AND (mm.mm_NO LIKE '%".$params['memo_key']."%' OR mm.mm_subject LIKE '%".$params['memo_key']."%') ";
			}
			if($params['memo_type_id'] != ''){
				$s_sql.= "AND mm.mt_id_pk = ".$params['memo_type_id']." ";
			}
			if( ($params['start_date'] != '') && ($params['end_date'] != '') ){
				$s_sql.= "AND mm.mm_created_date BETWEEN '".$params['start_date']."' AND '".$params['end_date']."' ";
			}
			if($params['memo_status_id'] != ''){
				$s_sql.= "AND mm.mst_id_pk = ".$params['memo_status_id']." ";

				if(($params['memo_status_id'] == 1) && ($params['action_emp_com_id'] != '')){
					$s_sql.= "AND mm.mm_concurred_emp_ID LIKE '%".$params['action_emp_com_id']."%' ";
				}
				else if(($params['memo_status_id'] == 3) && ($params['action_emp_com_id'] != '')){
					$s_sql.= "AND mm.mm_to_emp_ID LIKE '%".$params['action_emp_com_id']."%' ";
				}
			}

			$s_sql.= "ORDER BY mm.mm_modified_date DESC , mm.mm_status DESC , mm.mm_issue_date DESC ";
		}

		$b_resp = $obj_class->selectproc($s_sql);
		$obj_log->savelog($save_data_log,"get_employee_cc_list","sql=[$s_sql]");
		$datas = array();

		if($b_resp && $obj_class->n_row>0) {
			for($i=0;$i<$obj_class->n_row;$i++){	

				$today = date_create(date("Y-m-d H:i:s"));
				$modified_date = date_create($obj_class->getitem("mm_modified_date"));

				$diff_day = date_diff($today,$modified_date)->format("%d");
				$diff_hour = date_diff($today,$modified_date)->format("%h");
				$diff_minute = date_diff($today,$modified_date)->format("%i");
				
				$modified_time = strtotime($obj_class->getitem("mm_modified_date"));   
				$now = strtotime(date("Y-m-d H:i:s"));

				if($diff_day == 0) { 
					if($diff_hour > 0){
						$last_update = $diff_hour.' ชั่วโมง '.$diff_minute.' นาที';
					}
					else{
						$last_update = $diff_minute.' นาที';
					}
				}
				else{
					$last_update = $diff_day.' วัน';
				}

				//check show resent button
				$show_resent_button = 0;

				if($obj_class->getitem("mst_id_pk") == 4){ //approve
					if($emp_info[0]['emp_com_id'] == $obj_class->getitem("mm_from_emp_ID")){
						$show_resent_button = 1;
					}
				}

				if($obj_class->getitem("mm_revise") > 0){
					$show_revise = "(".$obj_class->getitem("mm_revise").")";
				}
				else{
					$show_revise = "";
				}

				
				$s_sql_3 = "SELECT * from memo_history ";
				$s_sql_3.= "WHERE mm_id_pk = ".$obj_class->getitem("mm_id_pk")." ";
				$s_sql_3.= "ORDER BY mmh_id_pk DESC LIMIT 1";
				$b_resp_3 = $obj_class_3->selectproc($s_sql_3);

				$show_view_icon = 1;
				$action_title = "ผ่าน";

				if($b_resp_3 && $obj_class_3->n_row>0) {

					$from_emp_info = $this->get_emp_info_by_emp_com_id($params['company_id'] , $obj_class->getitem("mm_from_emp_ID"));

					if(($emp_info[0]['emp_com_id'] == $obj_class->getitem("mm_from_emp_ID")) || ($emp_info[0]['emp_com_id'] == $obj_class->getitem("mm_to_emp_ID")) || ($emp_info[0]['emp_com_id'] == $obj_class->getitem("mm_concurred_emp_ID"))){
						$show_view_icon = 0;
					}

					if($obj_class_3->getitem("emp_ID") == $obj_class->getitem("mm_to_emp_ID")){
						$action_title = "เรียน";
					}		
				}
				

				$datas[$i]['memo_id'] = $obj_class->getitem("mm_id_pk");
				$datas[$i]['memo_no'] = $obj_class->getitem("mm_NO").$show_revise;
				$datas[$i]['memo_subject'] = $obj_class->getitem("mm_subject");
				$datas[$i]['memo_form_id'] = $obj_class->getitem("mm_format_id");
				$datas[$i]['memo_status_id'] = $obj_class->getitem("mst_id_pk");
				$datas[$i]['memo_status_name'] = $obj_class->getitem("mm_status");
				$datas[$i]['memo_type_name'] = $obj_class->getitem("mm_sub_type");
				$datas[$i]['memo_create_date'] = date("Y-m-d", strtotime($obj_class->getitem("mm_created_date")));
				$datas[$i]['memo_create_time'] = date("H:i", strtotime($obj_class->getitem("mm_created_date")));
				$datas[$i]['memo_last_update'] = $last_update;
				$datas[$i]['memo_favorite_status'] = ($obj_class->getitem("fl_status") == 1)?1:0;
				$datas[$i]['show_resent_button'] = $show_resent_button;
				$datas[$i]['memo_revise'] = $obj_class->getitem("mm_revise");
				$datas[$i]['memo_action_name'] = $action_title." ".$obj_class_3->getitem("mmh_name"); //edit api doc
				$datas[$i]['memo_from_name'] = "จาก ".$from_emp_info[0]['emp_name']; //edit api doc		
				$datas[$i]['show_view_icon'] = $show_view_icon; //edit api doc

			    $obj_class->movenext();
			}

			$json_obj->command = '2800';
			$json_obj->message = 'Get data success.';
			$json_obj->data = $datas;
		}
		else {
			$json_obj->command = '2802';
			$json_obj->message = 'Data not found.';
		}
		
		$obj_class->closedb();
		return $json_obj;
    }

    //2900 -- OK //edit api doc
    public function get_memo_detail($params) {
		$json_obj = new stdClass();
		$obj_global = new GlobalConstant();		
		$obj_log = new LogFile();		
		$save_data_log = $_SERVER["HTTP_HOST"].$_SERVER["PHP_SELF"];

		$obj_class = new Connectdb($obj_global->getHOST_CMS(), $obj_global->getUSER_CMS() , $obj_global->getPWD_CMS(), "memo",0,FALSE);
		$obj_class_2 = new Connectdb($obj_global->getHOST_CMS(), $obj_global->getUSER_CMS() , $obj_global->getPWD_CMS(), "memo",0,FALSE);
		$obj_class_3 = new Connectdb($obj_global->getHOST_CMS(), $obj_global->getUSER_CMS() , $obj_global->getPWD_CMS(), "memo",0,FALSE);
		$obj_class_4 = new Connectdb($obj_global->getHOST_CMS(), $obj_global->getUSER_CMS() , $obj_global->getPWD_CMS(), "memo",0,FALSE);

		//$params['company_id']
		//$params['employee_code']
		//$params['memo_id']

		//select -> tb memo , favorite_list , memo_attachfile , memo_form_position , memo_history , memo_status , draft_memo , prelist , memo_type

		$s_sql = "SELECT mm.* , mf.mf_form_name , mno.mno_format_date , mno.mno_key_name ";
		$s_sql.= "from memo mm LEFT JOIN memo_form_position mf ON mm.mm_format_id = mf.mf_id_pk ";
		$s_sql.= "LEFT JOIN memo_NO mno ON mm.mno_id_pk = mno.mno_id_pk ";
		$s_sql.= "WHERE mm.com_id_pk = ".$params['company_id']." AND mm.mm_id_pk = ".$params['memo_id']." ";
		$s_sql.= "ORDER BY mm.mm_id_pk DESC";
		$b_resp = $obj_class->selectproc($s_sql);
		$obj_log->savelog($save_data_log,"get_memo_detail","sql=[$s_sql]");
		$datas = array();

		if($b_resp && $obj_class->n_row>0) {
			$mm_format_id = $obj_class->getitem("mm_format_id");
			
			$from_emp_info = $this->get_emp_info_by_emp_com_id($params['company_id'] , $obj_class->getitem("mm_from_emp_ID"));	
			$confirm_payment_emp_info = $this->get_emp_info_by_emp_com_id($params['company_id'] , $obj_class->getitem("mm_confirm_payment_emp_ID"));

			if(sizeof($from_emp_info[0]) > 1){

				if($obj_class->getitem("mm_issue_date")){
					$issue_date = $obj_class->getitem("mm_issue_date");
				}
				else{
					$issue_date = date("Y-m-d H:i:s");
				}

				switch ($obj_class->getitem("mno_format_date")) {
		            case 'YYYY/MM/DD': 
		            	$issue_date_format = date("Y/m/d",strtotime($issue_date));
						break;
					case 'MM/DD/YYYY': 
		            	$issue_date_format = date("m/d/Y",strtotime($issue_date));
						break;
					case 'DD/MM/YYYY': 
		            	$issue_date_format = date("d/m/Y",strtotime($issue_date));
						break;
					case 'YYYY-MM-DD': 
		            	$issue_date_format = date("Y-m-d",strtotime($issue_date));
						break;
					case 'MM-DD-YYYY': 
		            	$issue_date_format = date("m-d-Y",strtotime($issue_date));
						break;
					case 'DD-MM-YYYY': 
		            	$issue_date_format = date("d-m-Y",strtotime($issue_date));
						break;
					default: 
						$issue_date_format = date("Y-m-d",strtotime($issue_date));
						break;
				}

				if($obj_class->getitem("mm_revise") > 0){
					$show_revise = "(".$obj_class->getitem("mm_revise").")";
				}
				else{
					$show_revise = "";
				}

				$form_format_name = $this->get_form_format_name($params['company_id'] , $obj_class->getitem("mf_id_pk"));

				$datas[0]['memo_id'] = $obj_class->getitem("mm_id_pk");
				$datas[0]['memo_no_id'] = $obj_class->getitem("mno_id_pk");
				$datas[0]['memo_no'] = ($obj_class->getitem("mm_NO"))?$obj_class->getitem("mm_NO").$show_revise:null;
				$datas[0]['prelist_id'] = $obj_class->getitem("pl_id_pk");
				$datas[0]['memo_subject'] = $obj_class->getitem("mm_subject");
				$datas[0]['memo_type_id'] = $obj_class->getitem("mt_id_pk");
				$datas[0]['memo_type_name'] = $obj_class->getitem("mm_sub_type");
				$datas[0]['advance_form_id'] = ($obj_class->getitem("avf_id_pk"))?$obj_class->getitem("avf_id_pk"):0;
				$datas[0]['advance_no'] = ($obj_class->getitem("mm_advancefromNO"))?$obj_class->getitem("mm_advancefromNO"):null;
				$datas[0]['memo_amount'] = $obj_class->getitem("mm_amount");
				$datas[0]['memo_budget'] = strtolower($obj_class->getitem("mm_budget"));
				$datas[0]['to_pos_initial'] = $obj_class->getitem("mm_to");
				$datas[0]['to_emp_com_id'] = $obj_class->getitem("mm_to_emp_ID");
				$datas[0]['concurred_pos_initial'] = $obj_class->getitem("mm_concurred");
				$datas[0]['concurred_emp_com_id'] = $obj_class->getitem("mm_concurred_emp_ID");
				$datas[0]['cc_pos_initial'] = $obj_class->getitem("mm_cc");
				$datas[0]['cc_emp_com_id'] = $obj_class->getitem("mm_cc_emp_ID");
				$datas[0]['from_pos_initial'] = $obj_class->getitem("mm_from");
				$datas[0]['from_emp_com_id'] = $obj_class->getitem("mm_from_emp_ID");
				$datas[0]['from_emp_name'] = $from_emp_info[0]['emp_name'];
				$datas[0]['memo_detail'] = $obj_class->getitem("mm_detail");
				$datas[0]['created_date'] = ($obj_class->getitem("mm_issue_date"))?$obj_class->getitem("mm_issue_date"):date("Y-m-d H:i:s");
				$datas[0]['created_date_format'] = $issue_date_format;
				$datas[0]['modified_date'] = $obj_class->getitem("mm_modified_date");
				$datas[0]['memo_status_id'] = $obj_class->getitem("mst_id_pk");
				$datas[0]['memo_status_name'] = $obj_class->getitem("mm_status");
				$datas[0]['memo_form_id'] = $obj_class->getitem("mm_format_id");
				$datas[0]['memo_form_name'] = $obj_class->getitem("mf_form_name");
				$datas[0]['memo_form_format_id'] = $obj_class->getitem("mf_id_pk");
				$datas[0]['memo_form_format_name'] = ($form_format_name)?$form_format_name:'-';

				$datas[0]['company_id'] = $obj_class->getitem("com_id_pk");
				$datas[0]['emp_id'] = $obj_class->getitem("emp_id_pk");
				$datas[0]['emp_com_id'] = $obj_class->getitem("emp_ID");
				$datas[0]['approve_date'] = ($obj_class->getitem("mm_approve_date"))?$obj_class->getitem("mm_approve_date"):'null';
				$datas[0]['memo_notice_type'] = $obj_class->getitem("mm_noti_type");
				$datas[0]['memo_revise'] = $obj_class->getitem("mm_revise");

				$datas[0]['sub_type_name'] = ($obj_class->getitem("mm_sub_type_ad"))?$obj_class->getitem("mm_sub_type_ad"):'';
				$datas[0]['advance_form_id'] = ($obj_class->getitem("avf_id_pk"))?$obj_class->getitem("avf_id_pk"):'';
				$datas[0]['advance_no'] = ($obj_class->getitem("mm_advancefromNO"))?$obj_class->getitem("mm_advancefromNO"):'';
				$datas[0]['confirm_payment_name'] = ($obj_class->getitem("mm_confirm_payment"))?$obj_class->getitem("mm_confirm_payment"):'';
				$datas[0]['confirm_payment_emp_com_id'] = ($obj_class->getitem("mm_confirm_payment_emp_ID"))?$obj_class->getitem("mm_confirm_payment_emp_ID"):'';
				$datas[0]['confirm_payment_pos_initial'] = ($confirm_payment_emp_info[0]['emp_pos_initial'])?$confirm_payment_emp_info[0]['emp_pos_initial']:''; //edit api doc

				$datas[0]['show_button_terminate'] = 0;
				$datas[0]['show_button_disagree'] = 0;
				$datas[0]['show_button_agree'] = 0;
				$datas[0]['show_button_disapprove'] = 0;
				$datas[0]['show_button_approve'] = 0;
				$datas[0]['show_button_copy'] = 0;
				$datas[0]['show_button_export'] = 0;
				$datas[0]['show_button_revise'] = 0;
				$datas[0]['show_form'] = 0;


				$is_relate_emp = 0;

				$s_sql_4 = "SELECT * from memo WHERE mm_id_pk = ".$params['memo_id']." ";
				$s_sql_4.= "AND (mm_from_emp_ID LIKE '%".$params['employee_code']."%' ";
				$s_sql_4.= "OR mm_to_emp_ID LIKE '%".$params['employee_code']."%' ";
				$s_sql_4.= "OR mm_concurred_emp_ID LIKE '%".$params['employee_code']."%' ";
				$s_sql_4.= "OR mm_cc_emp_ID LIKE '%".$params['employee_code']."%' ) ";
				$b_resp_4 = $obj_class_4->selectproc($s_sql_4);

				if($b_resp_4 && $obj_class_4->n_row>0) {
					$is_relate_emp = 1;
				}



				if($obj_class->getitem("mst_id_pk") == 1){ //Wait for Agree
					$s_sql_2 = "SELECT * from memo_history WHERE com_id_pk = ".$params['company_id']." AND mm_id_pk = ".$params['memo_id']." AND emp_ID = '".$params['employee_code']."' AND mmh_status = 'Wait for Agree' AND mmh_approve_date IS NULL ORDER BY mmh_id_pk DESC LIMIT 1";
					$b_resp_2 = $obj_class_2->selectproc($s_sql_2);

					if($b_resp_2 && $obj_class_2->n_row>0) {
						$datas[0]['show_button_terminate'] = 1;
						$datas[0]['show_button_disagree'] = 1;
						$datas[0]['show_button_agree'] = 1;
						$datas[0]['show_form'] = 1;
					}
				}
				else if($obj_class->getitem("mst_id_pk") == 2){ //Disagree 
					if($params['employee_code'] == $datas[0]['from_emp_com_id']){
						if($mm_format_id < 3){ //Advance
							$datas[0]['show_button_copy'] = 1;
						}
						$datas[0]['show_button_revise'] = 1;
						$datas[0]['show_form'] = 1;
					}
					else if($is_relate_emp == 1){
						if($mm_format_id < 3){ //Advance
							$datas[0]['show_button_copy'] = 1;
						}
						$datas[0]['show_form'] = 1;
					}
				}
				else if($obj_class->getitem("mst_id_pk") == 3){ //Wait for Approve
					$s_sql_2 = "SELECT * from memo_history WHERE com_id_pk = ".$params['company_id']." AND mm_id_pk = ".$params['memo_id']." AND emp_ID = '".$params['employee_code']."' AND mmh_status = 'Wait for Approve' AND mmh_approve_date IS NULL ORDER BY mmh_id_pk DESC LIMIT 1";
					$b_resp_2 = $obj_class_2->selectproc($s_sql_2);

					if($b_resp_2 && $obj_class_2->n_row>0) {
						$datas[0]['show_button_terminate'] = 1;
						$datas[0]['show_button_disapprove'] = 1;
						$datas[0]['show_button_approve'] = 1;
						$datas[0]['show_form'] = 1;
					}
				}
				else if($obj_class->getitem("mst_id_pk") == 4){ //Approve
					if($is_relate_emp == 1){
						if($mm_format_id < 3){ //Advance
							$datas[0]['show_button_copy'] = 1;
						}
						$datas[0]['show_button_export'] = 1;
						$datas[0]['show_form'] = 1;
					}
				}
				else if($obj_class->getitem("mst_id_pk") == 5){ //Disapprove
					if($params['employee_code'] == $datas[0]['from_emp_com_id']){
						if($mm_format_id < 3){ //Advance
							$datas[0]['show_button_copy'] = 1;
						}
						$datas[0]['show_button_revise'] = 1;
						$datas[0]['show_form'] = 1;
					}
					else if($is_relate_emp == 1){
						if($mm_format_id < 3){ //Advance
							$datas[0]['show_button_copy'] = 1;
						}
						$datas[0]['show_form'] = 1;
					}
				}
				else if($obj_class->getitem("mst_id_pk") == 6){ //Terminate
					if($is_relate_emp == 1){
						if($mm_format_id < 3){ //Advance
							$datas[0]['show_button_copy'] = 1;
						}
						$datas[0]['show_form'] = 1;
					}
				}

				if($_SERVER['HTTP_HOST'] == 'localhost'){
					$path = "http://localhost/var_www/verkplus/sub-verk/memo/EdC/".$params['company_id']."/memo_attach_file/".$params['memo_id']."/";
					$thumb_path = "http://localhost/var_www/verkplus/sub-verk/memo/EdC/".$params['company_id']."/memo_thumb_attach_file/".$params['memo_id']."/"; 
				}
				else{
					if($_SERVER['HTTP_HOST'] == '58.137.222.81'){
						//58.137.222.81
						$path = "http://".$_SERVER['HTTP_HOST']."/var_www/verkplus/sub-verk/memo/EdC/".$params['company_id']."/memo_attach_file/".$params['memo_id']."/";
						$thumb_path = "http://".$_SERVER['HTTP_HOST']."/var_www/verkplus/sub-verk/memo/EdC/".$params['company_id']."/memo_thumb_attach_file/".$params['memo_id']."/";
					}
					else{
						//58.137.160.130
						$path = "http://".$_SERVER['HTTP_HOST']."/sub-verk/memo/EdC/".$params['company_id']."/memo_attach_file/".$params['memo_id']."/";
						$thumb_path = "http://".$_SERVER['HTTP_HOST']."/sub-verk/memo/EdC/".$params['company_id']."/memo_thumb_attach_file/".$params['memo_id']."/";
					}
				}

				$s_sql_3 = "SELECT * from memo_attachfile WHERE com_id_pk = ".$params['company_id']." AND mm_id_pk = ".$params['memo_id']."  ORDER BY ma_id_pk ASC ";
				$b_resp_3 = $obj_class_3->selectproc($s_sql_3);
				$attachfiles = array();

				if($b_resp_3 && $obj_class_3->n_row>0) {
					for($i=0;$i<$obj_class_3->n_row;$i++){
						$attachfiles[$i]['id'] = $obj_class_3->getitem("ma_id_pk");
						$attachfiles[$i]['path'] = $path.$obj_class_3->getitem("ma_path");
						$attachfiles[$i]['thumb_path'] = $thumb_path.$obj_class_3->getitem("ma_path");

						$obj_class_3->movenext();
					}
				}

				$to_emp_info = $this->get_emp_info_by_emp_com_id($params['company_id'] , $obj_class->getitem("mm_to_emp_ID"));

				$to_emp[0]['emp_com_id'] = $obj_class->getitem("mm_to_emp_ID");
				$to_emp[0]['emp_name'] = $to_emp_info[0]['emp_name'];
				$to_emp[0]['emp_pos_initial'] = $to_emp_info[0]['emp_pos_initial'];



				$cc_emp_com_id_array = explode("," , $obj_class->getitem("mm_cc_emp_ID"));
				$count_cc = count($cc_emp_com_id_array);
				$cc_emp = array();

				if($obj_class->getitem("mm_cc_emp_ID") != null){
					for($x=0;$x<$count_cc;$x++){
						$cc_emp_info = $this->get_emp_info_by_emp_com_id($params['company_id'] , $cc_emp_com_id_array[$x]);

						$cc_emp[$x]['emp_com_id'] = $cc_emp_com_id_array[$x];
						$cc_emp[$x]['emp_name'] = $cc_emp_info[0]['emp_name'];
						$cc_emp[$x]['emp_pos_initial'] = $cc_emp_info[0]['emp_pos_initial'];
					}
				}
				


				$concurred_emp_com_id_array = explode("," , $obj_class->getitem("mm_concurred_emp_ID"));
				$count_concurred = count($concurred_emp_com_id_array);
				$concurred_emp = array();

				if($obj_class->getitem("mm_concurred_emp_ID") != null){
					for($x=0;$x<$count_concurred;$x++){
						$concurred_emp_info = $this->get_emp_info_by_emp_com_id($params['company_id'] , $concurred_emp_com_id_array[$x]);

						$concurred_emp[$x]['emp_com_id'] = $concurred_emp_com_id_array[$x];
						$concurred_emp[$x]['emp_name'] = $concurred_emp_info[0]['emp_name'];
						$concurred_emp[$x]['emp_pos_initial'] = $concurred_emp_info[0]['emp_pos_initial'];
					}
				}


				$memo_no_info[0]['memo_no_id'] = $obj_class->getitem("mno_id_pk");
				$memo_no_info[0]['memo_no_key'] = $obj_class->getitem("mno_key_name");

				$json_obj->command = '2900';
				$json_obj->message = 'Get data success.';
				$json_obj->data = $datas;
				$json_obj->attachfile = $attachfiles;
				$json_obj->to_emp = $to_emp;
				$json_obj->concurred_emp = $concurred_emp;
				$json_obj->cc_emp = $cc_emp;

				// $json_obj->count_concurred = $count_concurred;
				// $json_obj->concurred_emp_com_id_array = $concurred_emp_com_id_array[0];
				// $json_obj->concurred_emp_info = $concurred_emp_info;

				$json_obj->memo_no_info = $memo_no_info;

			}
			else {
				$json_obj->command = '2903';
				$json_obj->message = 'Data is invalid.';
			}
		}
		else {
			$json_obj->command = '2902';
			$json_obj->message = 'Data not found.';
		}
		
		$obj_class->closedb();
		return $json_obj;
    }

    //3000 -- OK
	public function get_memo_history($params) {
		$json_obj = new stdClass();
		$obj_global = new GlobalConstant();		
		$obj_log = new LogFile();		
		$save_data_log = $_SERVER["HTTP_HOST"].$_SERVER["PHP_SELF"];

		$obj_class = new Connectdb($obj_global->getHOST_CMS(), $obj_global->getUSER_CMS() , $obj_global->getPWD_CMS(), "memo",0,FALSE);

		//$params['company_id']
		//$params['memo_id']
		
		//select -> tb memo_history
		$s_sql = "SELECT * from memo_history WHERE com_id_pk = ".$params['company_id']." AND mm_id_pk = ".$params['memo_id']." AND mmh_approve_date IS NOT NULL ORDER BY mmh_id_pk ";
		$b_resp = $obj_class->selectproc($s_sql);
		$obj_log->savelog($save_data_log,"get_memo_history","sql=[$s_sql]");
		$datas = array();

		if ($b_resp && $obj_class->n_row>0) {
			for($i=0;$i<$obj_class->n_row;$i++){	
				$datas[$i]['memo_history_id'] = $obj_class->getitem("mmh_id_pk");
				$datas[$i]['memo_id'] = $obj_class->getitem("mm_id_pk");
				$datas[$i]['memo_status_name'] = $obj_class->getitem("mmh_status");
				$datas[$i]['memo_comment'] = ($obj_class->getitem("mmh_comment"))?$obj_class->getitem("mmh_comment"):'null';
				$datas[$i]['emp_name'] = $obj_class->getitem("mmh_name");
				$datas[$i]['emp_pos_initial'] = $obj_class->getitem("mmh_pos");
				$datas[$i]['emp_id'] = $obj_class->getitem("emp_id_pk");
				$datas[$i]['emp_com_id'] = $obj_class->getitem("emp_ID");
				$datas[$i]['approve_date'] = ($obj_class->getitem("mmh_approve_date"))?date("Y-m-d", strtotime($obj_class->getitem("mmh_approve_date"))):'null';
				$datas[$i]['approve_time'] = ($obj_class->getitem("mmh_approve_date"))?date("H:i", strtotime($obj_class->getitem("mmh_approve_date"))):'null';
				$datas[$i]['issue_date'] = date("Y-m-d", strtotime($obj_class->getitem("mmh_issue_date")));
				$datas[$i]['issue_time'] = date("H:i", strtotime($obj_class->getitem("mmh_issue_date")));

				$datas[$i]['company_id'] = $obj_class->getitem("com_id_pk");

			    $obj_class->movenext();
			}

			$json_obj->command = '3000';
			$json_obj->message = 'Get data success.';
			$json_obj->data = $datas;
		}
		else {
			$json_obj->command = '3002';
			$json_obj->message = 'Data not found.';
		}

		$obj_class->closedb();
		return $json_obj;
    }

    //3100 -- OK
	public function get_memo_status_list() {
		$json_obj = new stdClass();
		$obj_global = new GlobalConstant();		
		$obj_log = new LogFile();		
		$save_data_log = $_SERVER["HTTP_HOST"].$_SERVER["PHP_SELF"];

		$obj_class = new Connectdb($obj_global->getHOST_CMS(), $obj_global->getUSER_CMS() , $obj_global->getPWD_CMS(), "memo",0,FALSE);

		//select -> tb memo_status
		$s_sql = "SELECT * from memo_status ORDER BY mst_id_pk ASC";
		$b_resp = $obj_class->selectproc($s_sql);
		$obj_log->savelog($save_data_log,"get_memo_status_list","sql=[$s_sql]");
		$datas = array();

		if ($b_resp && $obj_class->n_row>0) {
			for($i=0;$i<$obj_class->n_row;$i++){	
				$datas[$i]['memo_status_id'] = $obj_class->getitem("mst_id_pk");
				$datas[$i]['memo_status_name'] = $obj_class->getitem("mst_name");
			    $obj_class->movenext();
			}

			$json_obj->command = '3100';
			$json_obj->message = 'Get data success.';
			$json_obj->data = $datas;
		}
		else {
			$json_obj->command = '3101';
			$json_obj->message = 'Data not found.';
		}

		$obj_class->closedb();
		return $json_obj;
    }

    //3200 -- OK
	public function favorite_memo($params) {
		$json_obj = new stdClass();
		$obj_global = new GlobalConstant();		
		$obj_log = new LogFile();		
		$save_data_log = $_SERVER["HTTP_HOST"].$_SERVER["PHP_SELF"];

		$obj_class = new Connectdb($obj_global->getHOST_CMS(), $obj_global->getUSER_CMS() , $obj_global->getPWD_CMS(), "memo",0,FALSE);

		//$params['company_id']
		//$params['employee_id']
		//$params['memo_id']

		//insert or update -> tb favorite_list

		$s_sql = "SELECT * from favorite_list WHERE com_id_pk = ".$params['company_id']." AND emp_id_pk = ".$params['employee_id']." AND mm_id_pk = ".$params['memo_id']." ";
		$b_resp = $obj_class->selectproc($s_sql);
		$datas = array();

		if($b_resp && $obj_class->n_row>0){ //update
			$fl_status = ($obj_class->getitem("fl_status")==0)?1:0;

			$s_sql_2 = "UPDATE favorite_list SET fl_status = ".$fl_status." , fl_modified_date = NOW() WHERE com_id_pk = ".$params['company_id']." AND emp_id_pk = ".$params['employee_id']." AND mm_id_pk = ".$params['memo_id']." ";
			$b_flag_2 = $obj_class->manageproc($s_sql_2);
			$obj_log->savelog($save_data_log,"favorite_memo","sql=[$s_sql_2]");

			if($b_flag_2){
				$json_obj->command = '3200';
				$json_obj->message = ($fl_status==1)?'Add favorite memo success.':'Remove favorite memo success.';
			}
			else{
				$json_obj->command = '3203';
				$json_obj->message = ($fl_status==1)?'Add favorite memo fail.':'Remove favorite memo fail.';
			}
		}
		else{ //insert
			$emp_info = $this->get_emp_info_by_emp_id($params['company_id'] , $params['employee_id']);

			$s_sql = "SELECT * from memo WHERE mm_id_pk = ".$params['memo_id']." ";
			$b_resp = $obj_class->selectproc($s_sql);
			$datas = array();

			if($b_resp && $obj_class->n_row>0) {	
				$fl_status = 1;

				$s_sql_2 = "INSERT INTO favorite_list (emp_id_pk , emp_ID , mm_id_pk , fl_name , fl_status , fl_created_date , fl_modified_date , com_id_pk) VALUES (".$params['employee_id']." , '".$emp_info[0]['emp_com_id']."' , ".$params['memo_id']." , '".$obj_class->getitem("mm_subject")."' , ".$fl_status." , NOW() , NOW() , ".$params['company_id'].") ";
				$b_flag_2 = $obj_class->manageproc($s_sql_2);
				$obj_log->savelog($save_data_log,"favorite_memo","sql=[$s_sql_2]");

				if($b_flag_2){
					$json_obj->command = '3200';
					$json_obj->message = 'Add favorite memo success.';
				}
				else{
					$json_obj->command = '3203';
					$json_obj->message = 'Add favorite memo fail.';
				}
			}
			else {
				$json_obj->command = '3202';
				$json_obj->message = 'Data is invalid.';
			}
		}
				
		$obj_class->closedb();
		return $json_obj;
    }

    //3300 -- OK
	public function resent_memo($params) {
		$json_obj = new stdClass();
		$obj_global = new GlobalConstant();		
		$obj_log = new LogFile();		
		$save_data_log = $_SERVER["HTTP_HOST"].$_SERVER["PHP_SELF"];

		$obj_class = new Connectdb($obj_global->getHOST_CMS(), $obj_global->getUSER_CMS() , $obj_global->getPWD_CMS(), "memo",0,FALSE);
		$obj_class_2 = new Connectdb($obj_global->getHOST_CMS(), $obj_global->getUSER_CMS() , $obj_global->getPWD_CMS(), "memo",0,FALSE);

		//$params['company_id']
		//$params['memo_id']

		$s_sql = "SELECT * from memo WHERE com_id_pk = ".$params['company_id']." AND mm_id_pk = ".$params['memo_id']." ";
		$b_resp = $obj_class_2->selectproc($s_sql);
		$obj_log->savelog($save_data_log,"resent_memo","sql=[$s_sql]");
		$datas = array();

		if($b_resp && $obj_class_2->n_row>0) {	
			$memo_no = $obj_class_2->getitem("mm_NO");
			$memo_revise = $obj_class_2->getitem("mm_revise")+1;
			
			$emp_info = $this->get_emp_info_by_emp_id($params['company_id'] , $obj_class_2->getitem("emp_id_pk"));
			$from_emp_name = $emp_info[0]['emp_name'];
			$from_emp_com_id = $obj_class_2->getitem("emp_ID");

			$concurred_emp_com_id_array = explode("," , $obj_class_2->getitem("mm_concurred_emp_ID"));
			$count_concurred = count($concurred_emp_com_id_array);

			$cc_emp_com_id_array = explode("," , $obj_class_2->getitem("mm_cc_emp_ID"));
			$count_cc = ($obj_class_2->getitem("mm_cc_emp_ID") != null)?count($cc_emp_com_id_array):0;

			$to_emp_com_id = $obj_class_2->getitem("mm_to_emp_ID");

			$json_obj->command = '3300';
			$json_obj->message = 'Resent memo success.';
		
			//send notice to all concurred_employee
			for($i=0;$i<$count_concurred;$i++){
				$concurred_emp_info = $this->get_emp_info_by_emp_com_id($params['company_id'] , $concurred_emp_com_id_array[$i]);	

				$emp_com_id = $concurred_emp_com_id_array[$i];
				$emp_id_get_notice = $concurred_emp_info[0]['emp_id'];
				$device_type = $concurred_emp_info[0]['emp_device_type'];
				$push_token = $concurred_emp_info[0]['emp_gcm_token'];
				$emp_name = $concurred_emp_info[0]['emp_name'];
				$emp_email = $concurred_emp_info[0]['emp_email'];
				
				$map_emp_notice = $this->get_map_emp_notice($params['company_id'] , $emp_com_id);

		     	for($j=0;$j<count($map_emp_notice);$j++){
		     		if(($map_emp_notice[$j]['notice_type'] == 3) && ($push_token != '')){ //send notice
						
						$notice_title = "Memo";
		     			$notice_content = "คุณ ".$from_emp_name."\nทำการยื่นเอกสาร ".$memo_no."\nสถานะเอกสาร Approved";

		     			//insert data to table notification
				     	$s_sql_7 = "INSERT INTO notification_memo (emp_id_pk , mm_id_pk , nm_title , nm_content , nm_status , nm_notice_type , nm_readed_date , nm_created_date , nm_modified_date) VALUES (".$emp_id_get_notice." , ".$params['memo_id']." , '".$notice_title."' , '".$notice_content."' , 'U' , '3' , null , NOW() , NOW()) ";
						$b_flag_7 = $obj_class->manageproc($s_sql_7);
						$obj_log->savelog($save_data_log,"insert_memo -> insert -> notification_leave (memo)","sql=[$s_sql_7]");

						if($device_type == "ios"){
							$data["aps"] = array(
											"alert"	=> array(
												"title" => $notice_title,
												"body" => $notice_content
												 ),
											"badge" => $this->get_badge_notice($emp_id_get_notice),
											"content-available" => 1
										);
							
							$ios[$push_token] = $data;
							$rs = $this->send_push_notice_ios($ios);
						}
						else if($device_type == "android"){
					     	$data = array(
								"data" => array(
									"title" => $notice_title,
									"content" => $notice_content,
									"badge" => $this->get_badge_notice($emp_id_get_notice)
								) , 
								"priority" => "high", 
								"to" => $push_token
							);

							$data_string = json_encode($data);  

							$result = $this->send_push_notice_android($data_string);
							$rs = ($result->success)?true:false;
						}
						
						if($rs){
							$json_obj->send_notice_status = 'Send notice success.';
				     	}
				     	else{
							$json_obj->send_notice_status = 'Send notice failed.';
				     	}
				    }
				    else if($map_emp_notice[$j]['notice_type'] == 2){ //send email

				    	$email_from = "verkapp@teleinfomedia.co.th";
				    	//$email_from = "godlikenokia@gmail.com";						    	
				    	//$emp_email = "lookbaar@gmail.com";

						$email_send_to = $emp_email;
				     	$email_subject = "Resent memo ".date("Y-m-d H:i:s");
				     	$email_header = "Content-type: text/html; charset=UTF-8\n"; // or  //
				     	$email_header.= "From: ".$email_from."\n";
				     	$email_message = "";
				     	$email_message.= "คุณ ".$from_emp_name."<br>";
						$email_message.= "ทำการยื่นเอกสาร ".$memo_no."<br>";
						$email_message.= "สถานะเอกสาร Approved<br>";
				     	$email_message.= "=================================<br>";
				     	$email_message.= "Best regards,<br>".$email_from."<br>";

				     	if(mail($email_send_to , $email_subject , $email_message , $email_header)){
				     		$send_email_status = 'S';
				     		$json_obj->send_email_status = 'Send email success.';
				     	}
				     	else{
				     		$send_email_status = 'F';
				     		$json_obj->send_email_status = 'Send email failed.';
				     	}

				     	//insert data to table notification
				     	$s_sql_7 = "INSERT INTO notification_memo (emp_id_pk , mm_id_pk , nm_title , nm_content , nm_status , nm_notice_type , nm_readed_date , nm_created_date , nm_modified_date) VALUES (".$emp_id_get_notice." , ".$params['memo_id']." , '".$email_subject."' , '".$email_message."' , '".$send_email_status."' , '2' , null , NOW() , NOW()) ";
						$b_flag_7 = $obj_class->manageproc($s_sql_7);
						$obj_log->savelog($save_data_log,"insert_memo -> insert -> notification_leave (email)","sql=[$s_sql_7]");
					}
					//else if($map_emp_notice[$i]['notice_type'] == 1){ //send notice to verk

					//}
		     	}
			}

			//send notice to to_employee
			$to_emp_info = $this->get_emp_info_by_emp_com_id($params['company_id'] , $to_emp_com_id);

			$emp_com_id = $to_emp_com_id;
			$emp_id_get_notice = $to_emp_info[0]['emp_id'];
			$device_type = $to_emp_info[0]['emp_device_type'];
			$push_token = $to_emp_info[0]['emp_gcm_token'];
			$emp_name = $to_emp_info[0]['emp_name'];
			$emp_email = $to_emp_info[0]['emp_email'];

			$map_emp_notice = $this->get_map_emp_notice($params['company_id'] , $emp_com_id);

	     	for($j=0;$j<count($map_emp_notice);$j++){
	     		if(($map_emp_notice[$j]['notice_type'] == 3) && ($push_token != '')){ //send notice
					
					$notice_title = "Memo";
	     			$notice_content = "คุณ ".$from_emp_name."\nทำการยื่นเอกสาร ".$memo_no."\nสถานะเอกสาร Approved";

	     			//insert data to table notification
			     	$s_sql_7 = "INSERT INTO notification_memo (emp_id_pk , mm_id_pk , nm_title , nm_content , nm_status , nm_notice_type , nm_readed_date , nm_created_date , nm_modified_date) VALUES (".$emp_id_get_notice." , ".$params['memo_id']." , '".$notice_title."' , '".$notice_content."' , 'U' , '3' , null , NOW() , NOW()) ";
					$b_flag_7 = $obj_class->manageproc($s_sql_7);
					$obj_log->savelog($save_data_log,"insert_memo -> insert -> notification_leave (memo)","sql=[$s_sql_7]");

					if($device_type == "ios"){
						$data["aps"] = array(
										"alert"	=> array(
											"title" => $notice_title,
											"body" => $notice_content
											 ),
										"badge" => $this->get_badge_notice($emp_id_get_notice),
										"content-available" => 1
									);
						
						$ios[$push_token] = $data;
						$rs = $this->send_push_notice_ios($ios);
					}
					else if($device_type == "android"){
				     	$data = array(
							"data" => array(
								"title" => $notice_title,
								"content" => $notice_content,
								"badge" => $this->get_badge_notice($emp_id_get_notice)
							) , 
							"priority" => "high", 
							"to" => $push_token
						);

						$data_string = json_encode($data);  

						$result = $this->send_push_notice_android($data_string);
						$rs = ($result->success)?true:false;
					}
					
					if($rs){
						$json_obj->send_notice_status = 'Send notice success.';
			     	}
			     	else{
						$json_obj->send_notice_status = 'Send notice failed.';
			     	}
			    }
			    else if($map_emp_notice[$j]['notice_type'] == 2){ //send email

			    	$email_from = "verkapp@teleinfomedia.co.th";
			    	//$email_from = "godlikenokia@gmail.com";						    	
			    	//$emp_email = "lookbaar@gmail.com";

					$email_send_to = $emp_email;
			     	$email_subject = "Resent memo ".date("Y-m-d H:i:s");
			     	$email_header = "Content-type: text/html; charset=UTF-8\n"; // or  //
			     	$email_header.= "From: ".$email_from."\n";
			     	$email_message = "";
			     	$email_message.= "คุณ ".$from_emp_name."<br>";
					$email_message.= "ทำการยื่นเอกสาร ".$memo_no."<br>";
					$email_message.= "สถานะเอกสาร Approved<br>";
			     	$email_message.= "=================================<br>";
			     	$email_message.= "Best regards,<br>".$email_from."<br>";

			     	if(mail($email_send_to , $email_subject , $email_message , $email_header)){
			     		$send_email_status = 'S';
			     		$json_obj->send_email_status = 'Send email success.';
			     	}
			     	else{
			     		$send_email_status = 'F';
			     		$json_obj->send_email_status = 'Send email failed.';
			     	}

			     	//insert data to table notification
			     	$s_sql_7 = "INSERT INTO notification_memo (emp_id_pk , mm_id_pk , nm_title , nm_content , nm_status , nm_notice_type , nm_readed_date , nm_created_date , nm_modified_date) VALUES (".$emp_id_get_notice." , ".$params['memo_id']." , '".$email_subject."' , '".$email_message."' , '".$send_email_status."' , '2' , null , NOW() , NOW()) ";
					$b_flag_7 = $obj_class->manageproc($s_sql_7);
					$obj_log->savelog($save_data_log,"insert_memo -> insert -> notification_leave (email)","sql=[$s_sql_7]");
				}
				//else if($map_emp_notice[$i]['notice_type'] == 1){ //send notice to verk

				//}
	     	}

	     	//send notice to from_employee
			$emp_com_id = $from_emp_com_id;
			$emp_id_get_notice = $emp_info[0]['emp_id'];
			$device_type = $emp_info[0]['emp_device_type'];
			$push_token = $emp_info[0]['emp_gcm_token'];
			$emp_name = $emp_info[0]['emp_name'];
			$emp_email = $emp_info[0]['emp_email'];

			$map_emp_notice = $this->get_map_emp_notice($params['company_id'] , $emp_com_id);

	     	for($j=0;$j<count($map_emp_notice);$j++){
	     		if(($map_emp_notice[$j]['notice_type'] == 3) && ($push_token != '')){ //send notice
					
					$notice_title = "Memo";
	     			$notice_content = "คุณ ".$from_emp_name."\nทำการยื่นเอกสาร ".$memo_no."\nสถานะเอกสาร Approved";

	     			//insert data to table notification
			     	$s_sql_7 = "INSERT INTO notification_memo (emp_id_pk , mm_id_pk , nm_title , nm_content , nm_status , nm_notice_type , nm_readed_date , nm_created_date , nm_modified_date) VALUES (".$emp_id_get_notice." , ".$params['memo_id']." , '".$notice_title."' , '".$notice_content."' , 'U' , '3' , null , NOW() , NOW()) ";
					$b_flag_7 = $obj_class->manageproc($s_sql_7);
					$obj_log->savelog($save_data_log,"insert_memo -> insert -> notification_leave (memo)","sql=[$s_sql_7]");

					if($device_type == "ios"){
						$data["aps"] = array(
										"alert"	=> array(
											"title" => $notice_title,
											"body" => $notice_content
											 ),
										"badge" => $this->get_badge_notice($emp_id_get_notice),
										"content-available" => 1
									);
						
						$ios[$push_token] = $data;
						$rs = $this->send_push_notice_ios($ios);
					}
					else if($device_type == "android"){
				     	$data = array(
							"data" => array(
								"title" => $notice_title,
								"content" => $notice_content,
								"badge" => $this->get_badge_notice($emp_id_get_notice)
							) , 
							"priority" => "high", 
							"to" => $push_token
						);

						$data_string = json_encode($data);  

						$result = $this->send_push_notice_android($data_string);
						$rs = ($result->success)?true:false;
					}
					
					if($rs){
						$json_obj->send_notice_status = 'Send notice success.';
			     	}
			     	else{
						$json_obj->send_notice_status = 'Send notice failed.';
			     	}
			    }
			    else if($map_emp_notice[$j]['notice_type'] == 2){ //send email

			    	$email_from = "verkapp@teleinfomedia.co.th";
			    	//$email_from = "godlikenokia@gmail.com";						    	
			    	//$emp_email = "lookbaar@gmail.com";

					$email_send_to = $emp_email;
			     	$email_subject = "Resent memo ".date("Y-m-d H:i:s");
			     	$email_header = "Content-type: text/html; charset=UTF-8\n"; // or  //
			     	$email_header.= "From: ".$email_from."\n";
			     	$email_message = "";
			     	$email_message.= "คุณ ".$from_emp_name."<br>";
					$email_message.= "ทำการยื่นเอกสาร ".$memo_no."<br>";
					$email_message.= "สถานะเอกสาร Approved<br>";
			     	$email_message.= "=================================<br>";
			     	$email_message.= "Best regards,<br>".$email_from."<br>";

			     	if(mail($email_send_to , $email_subject , $email_message , $email_header)){
			     		$send_email_status = 'S';
			     		$json_obj->send_email_status = 'Send email success.';
			     	}
			     	else{
			     		$send_email_status = 'F';
			     		$json_obj->send_email_status = 'Send email failed.';
			     	}

			     	//insert data to table notification
			     	$s_sql_7 = "INSERT INTO notification_memo (emp_id_pk , mm_id_pk , nm_title , nm_content , nm_status , nm_notice_type , nm_readed_date , nm_created_date , nm_modified_date) VALUES (".$emp_id_get_notice." , ".$params['memo_id']." , '".$email_subject."' , '".$email_message."' , '".$send_email_status."' , '2' , null , NOW() , NOW()) ";
					$b_flag_7 = $obj_class->manageproc($s_sql_7);
					$obj_log->savelog($save_data_log,"insert_memo -> insert -> notification_leave (email)","sql=[$s_sql_7]");
				}
				//else if($map_emp_notice[$i]['notice_type'] == 1){ //send notice to verk

				//}
	     	}

	     	
			//send notice to all cc_employee
			if($count_cc > 0){
				for($i=0;$i<$count_cc;$i++){
					$cc_emp_info = $this->get_emp_info_by_emp_com_id($params['company_id'] , $cc_emp_com_id_array[$i]);	

					$emp_com_id = $cc_emp_com_id_array[$i];
					$emp_id_get_notice = $cc_emp_info[0]['emp_id'];
					$device_type = $cc_emp_info[0]['emp_device_type'];
					$push_token = $cc_emp_info[0]['emp_gcm_token'];
					$emp_name = $cc_emp_info[0]['emp_name'];
					$emp_email = $cc_emp_info[0]['emp_email'];
					
					$map_emp_notice = $this->get_map_emp_notice($params['company_id'] , $emp_com_id);

			     	for($j=0;$j<count($map_emp_notice);$j++){
			     		if(($map_emp_notice[$j]['notice_type'] == 3) && ($push_token != '')){ //send notice
							
							$notice_title = "Memo";
			     			$notice_content = "คุณ ".$from_emp_name."\nทำการยื่นเอกสาร ".$memo_no."\nสถานะเอกสาร Approved";

			     			//insert data to table notification
					     	$s_sql_7 = "INSERT INTO notification_memo (emp_id_pk , mm_id_pk , nm_title , nm_content , nm_status , nm_notice_type , nm_readed_date , nm_created_date , nm_modified_date) VALUES (".$emp_id_get_notice." , ".$params['memo_id']." , '".$notice_title."' , '".$notice_content."' , 'U' , '3' , null , NOW() , NOW()) ";
							$b_flag_7 = $obj_class->manageproc($s_sql_7);
							$obj_log->savelog($save_data_log,"insert_memo -> insert -> notification_leave (memo)","sql=[$s_sql_7]");

							if($device_type == "ios"){
								$data["aps"] = array(
												"alert"	=> array(
													"title" => $notice_title,
													"body" => $notice_content
													 ),
												"badge" => $this->get_badge_notice($emp_id_get_notice),
												"content-available" => 1
											);
								
								$ios[$push_token] = $data;
								$rs = $this->send_push_notice_ios($ios);
							}
							else if($device_type == "android"){
						     	$data = array(
									"data" => array(
										"title" => $notice_title,
										"content" => $notice_content,
										"badge" => $this->get_badge_notice($emp_id_get_notice)
									) , 
									"priority" => "high", 
									"to" => $push_token
								);

								$data_string = json_encode($data);  

								$result = $this->send_push_notice_android($data_string);
								$rs = ($result->success)?true:false;
							}
							
							if($rs){
								$json_obj->send_notice_status = 'Send notice success.';
					     	}
					     	else{
								$json_obj->send_notice_status = 'Send notice failed.';
					     	}
					    }
					    else if($map_emp_notice[$j]['notice_type'] == 2){ //send email

					    	$email_from = "verkapp@teleinfomedia.co.th";
					    	//$email_from = "godlikenokia@gmail.com";						    	
					    	//$emp_email = "lookbaar@gmail.com";

							$email_send_to = $emp_email;
					     	$email_subject = "Resent memo ".date("Y-m-d H:i:s");
					     	$email_header = "Content-type: text/html; charset=UTF-8\n"; // or  //
					     	$email_header.= "From: ".$email_from."\n";
					     	$email_message = "";
					     	$email_message.= "คุณ ".$from_emp_name."<br>";
							$email_message.= "ทำการยื่นเอกสาร ".$memo_no."<br>";
							$email_message.= "สถานะเอกสาร Approved<br>";
					     	$email_message.= "=================================<br>";
					     	$email_message.= "Best regards,<br>".$email_from."<br>";

					     	if(mail($email_send_to , $email_subject , $email_message , $email_header)){
					     		$send_email_status = 'S';
					     		$json_obj->send_email_status = 'Send email success.';
					     	}
					     	else{
					     		$send_email_status = 'F';
					     		$json_obj->send_email_status = 'Send email failed.';
					     	}

					     	//insert data to table notification
					     	$s_sql_7 = "INSERT INTO notification_memo (emp_id_pk , mm_id_pk , nm_title , nm_content , nm_status , nm_notice_type , nm_readed_date , nm_created_date , nm_modified_date) VALUES (".$emp_id_get_notice." , ".$params['memo_id']." , '".$email_subject."' , '".$email_message."' , '".$send_email_status."' , '2' , null , NOW() , NOW()) ";
							$b_flag_7 = $obj_class->manageproc($s_sql_7);
							$obj_log->savelog($save_data_log,"insert_memo -> insert -> notification_leave (email)","sql=[$s_sql_7]");
						}
						//else if($map_emp_notice[$i]['notice_type'] == 1){ //send notice to verk

						//}
			     	}
			    }
			}
				
		}
		else {
			$json_obj->command = '3302';
			$json_obj->message = 'Data not found.';
		}
		
		$obj_class->closedb();
		return $json_obj;
    }

    //3400 -- OK
	public function export_memo($params) {
		$json_obj = new stdClass();
		$obj_global = new GlobalConstant();		
		$obj_log = new LogFile();		
		$save_data_log = $_SERVER["HTTP_HOST"].$_SERVER["PHP_SELF"];

		$obj_class = new Connectdb($obj_global->getHOST_CMS(), $obj_global->getUSER_CMS() , $obj_global->getPWD_CMS(), "memo",0,FALSE);
		$obj_class_2 = new Connectdb($obj_global->getHOST_CMS(), $obj_global->getUSER_CMS() , $obj_global->getPWD_CMS(), "memo",0,FALSE);

		//$params['company_id']
		//$params['memo_id']

		if($_SERVER['HTTP_HOST'] == 'localhost'){
			$export_url = "http://localhost/var_www/verkplus/sub-verk/memo/web/memo_api_export.php?company_id=".$params['company_id']."&memo_id=".$params['memo_id'];
		}
		else{
			if($_SERVER['HTTP_HOST'] == '58.137.222.81'){
				//58.137.222.81
				$export_url = "http://".$_SERVER['HTTP_HOST']."/var_www/verkplus/sub-verk/memo/web/memo_api_export.php?company_id=".$params['company_id']."&memo_id=".$params['memo_id'];
			}
			else{
				//58.137.160.130
				$export_url = "http://".$_SERVER['HTTP_HOST']."/sub-verk/memo/web/memo_api_export.php?company_id=".$params['company_id']."&memo_id=".$params['memo_id'];
			}
		}

		$json_obj->command = '3400';
		$json_obj->message = 'Get data success.';
		$json_obj->export_url = $export_url;
		
		$obj_class->closedb();
		return $json_obj;
    }

    //3500 -- OK
	public function agree_memo($params) {
		$json_obj = new stdClass();
		$obj_global = new GlobalConstant();		
		$obj_log = new LogFile();		
		$save_data_log = $_SERVER["HTTP_HOST"].$_SERVER["PHP_SELF"];

		$obj_class = new Connectdb($obj_global->getHOST_CMS(), $obj_global->getUSER_CMS() , $obj_global->getPWD_CMS(), "memo",0,FALSE);

		//$params['company_id']
		//$params['employee_id']
		//$params['memo_id']
		//$params['memo_comment']

		//update -> tb memo 
		//update -> tb memo_history lastest record

		$s_sql = "SELECT * from memo WHERE com_id_pk = ".$params['company_id']." AND mm_id_pk = ".$params['memo_id']." ";
		$b_resp = $obj_class->selectproc($s_sql);
		$obj_log->savelog($save_data_log,"agree_memo","sql=[$s_sql]");
		$datas = array();

		if($b_resp && $obj_class->n_row>0) {
			//concurred emp info
			$concurred_emp_info = $this->get_emp_info_by_emp_id($params['company_id'] , $params['employee_id']);

			//from emp info
			$from_emp_info = $this->get_emp_info_by_emp_id($params['company_id'] , $obj_class->getitem("emp_id_pk"));
			$from_emp_name = $from_emp_info[0]['emp_name'];	

			$memo_no = $obj_class->getitem("mm_NO");
			$concurred_emp_com_id_array = explode("," , $obj_class->getitem("mm_concurred_emp_ID"));
			$count_concurred = count($concurred_emp_com_id_array);
			$last_concurred_emp_ID = $count_concurred - 1;

			$to_emp_com_id = $obj_class->getitem("mm_to_emp_ID");

			if($concurred_emp_info[0]['emp_com_id'] == $concurred_emp_com_id_array[$last_concurred_emp_ID]){
				//update -> tb memo
				$s_sql_2 = "UPDATE memo ";
				$s_sql_2.= "SET mm_modified_date = NOW() , mst_id_pk = 3 , mm_status = 'Wait for approve' ";
				$s_sql_2.= "WHERE mm_id_pk = ".$params['memo_id']." ";
				$b_flag_2 = $obj_class->manageproc($s_sql_2);
				$obj_log->savelog($save_data_log,"agree_memo -> update -> memo","sql=[$s_sql_2]");

				if($b_flag_2){
					//update -> tb memo_history for last_concurred_employee
					$s_sql_3 = "UPDATE memo_history ";
					$s_sql_3.= "SET mmh_status = 'Agree' , mmh_comment = '".$params['memo_comment']."' ";
					$s_sql_3.= ", mmh_approve_date = NOW() , mmh_modified_date = NOW() ";
					$s_sql_3.= "WHERE com_id_pk = ".$params['company_id']." AND mm_id_pk = ".$params['memo_id']." ";
					$s_sql_3.= "AND emp_id_pk = ".$params['employee_id']." AND mmh_approve_date IS NULL ";
					$b_flag_3 = $obj_class->manageproc($s_sql_3);
					$obj_log->savelog($save_data_log,"agree_memo -> update -> memo_history","sql=[$s_sql_3]");

					if($b_flag_3){
						//get to_emp_info
						$to_emp_info = $this->get_emp_info_by_emp_com_id($params['company_id'] , $to_emp_com_id);

						$emp_com_id = $to_emp_com_id;
						$emp_id_get_notice = $to_emp_info[0]['emp_id'];
						$device_type = $to_emp_info[0]['emp_device_type'];
						$push_token = $to_emp_info[0]['emp_gcm_token'];
						$emp_name = $to_emp_info[0]['emp_name'];
						$emp_email = $to_emp_info[0]['emp_email'];
						
						//insert -> tb memo_history new record for to_employee
						$s_sql_4 = "INSERT INTO memo_history (mm_id_pk , mmh_status , mmh_comment , mmh_name , mmh_pos ";
						$s_sql_4.= ", emp_id_pk , emp_ID , mmh_approve_date , mmh_issue_date , mmh_created_date ";
						$s_sql_4.= ", mmh_modified_date , mmh_signature , com_id_pk) VALUES ";
						$s_sql_4.= "(".$params['memo_id']." , 'Wait for Approve' , NULL , '".$to_emp_info[0]['emp_name']."' ";
						$s_sql_4.= ", '".$to_emp_info[0]['emp_position']."' , ".$to_emp_info[0]['emp_id']." ";
						$s_sql_4.= ", '".$emp_com_id."' , NULL , NOW() , NOW() , NOW() , NULL , ".$params['company_id'].") ";
						$b_flag_4 = $obj_class->manageproc($s_sql_4);
						$obj_log->savelog($save_data_log,"agree_memo -> insert -> memo_history","sql=[$s_sql_4]");

						if($b_flag_4){
							$json_obj->command = '3500';
							$json_obj->message = 'Agree memo success.';
						}
						else{
							$json_obj->command = '3505';
							$json_obj->message = 'Agree memo fail - insert memo_history fail.';
						}

						$json_obj->command = '3500';
						$json_obj->message = 'Agree memo success.';
						$json_obj->last_concurred = $concurred_emp_com_id_array[$last_concurred_emp_ID];
						$json_obj->sql = $s_sql_3;
					}
					else{
						$json_obj->command = '3504';
						$json_obj->message = 'Agree memo fail - update memo_history fail.';
					}

					//send notice to to_employee
					if($json_obj->command == '3500'){

						$status_1 = 'Wait for Agree';
						$result_1 = $this->delete_summary_profile($params['company_id'] , $concurred_emp_info[0]['emp_com_id'] , $status_1);

						$status_2 = 'Wait for Approve';
						$result_2 = $this->add_summary_profile($params['company_id'] , $emp_com_id , $status_2);

						if($result_1 && $result_2){
							$map_emp_notice = $this->get_map_emp_notice($params['company_id'] , $emp_com_id);

					     	for($i=0;$i<count($map_emp_notice);$i++){
					     		if(($map_emp_notice[$i]['notice_type'] == 3) && ($push_token != '')){ //send notice
									
									$notice_title = "Memo";
					     			$notice_content = "คุณ ".$from_emp_name."\nทำการยื่นเอกสาร ".$memo_no."\nสถานะเอกสาร Wait for Approve";

					     			//insert data to table notification
							     	$s_sql_7 = "INSERT INTO notification_memo (emp_id_pk , mm_id_pk , nm_title , nm_content , nm_status , nm_notice_type , nm_readed_date , nm_created_date , nm_modified_date) VALUES (".$emp_id_get_notice." , ".$params['memo_id']." , '".$notice_title."' , '".$notice_content."' , 'U' , '3' , null , NOW() , NOW()) ";
									$b_flag_7 = $obj_class->manageproc($s_sql_7);
									$obj_log->savelog($save_data_log,"agree_memo -> insert -> notification_leave (memo)","sql=[$s_sql_7]");

									if($device_type == "ios"){
										$data["aps"] = array(
														"alert"	=> array(
															"title" => $notice_title,
															"body" => $notice_content
															 ),
														"badge" => $this->get_badge_notice($emp_id_get_notice),
														"content-available" => 1
													);
										
										$ios[$push_token] = $data;
										$rs = $this->send_push_notice_ios($ios);
									}
									else if($device_type == "android"){
								     	$data = array(
											"data" => array(
												"title" => $notice_title,
												"content" => $notice_content,
												"badge" => $this->get_badge_notice($emp_id_get_notice)
											) , 
											"priority" => "high", 
											"to" => $push_token
										);

										$data_string = json_encode($data);  

										$result = $this->send_push_notice_android($data_string);
										$rs = ($result->success)?true:false;
									}
									
									if($rs){
										$json_obj->send_notice_status = 'Send notice success.';
							     	}
							     	else{
										$json_obj->send_notice_status = 'Send notice failed.';
							     	}
							    }
							    else if($map_emp_notice[$i]['notice_type'] == 2){ //send email

							    	$email_from = "verkapp@teleinfomedia.co.th";
							    	//$email_from = "godlikenokia@gmail.com";						    	
							    	//$emp_email = "lookbaar@gmail.com";

									$email_send_to = $emp_email;
							     	$email_subject = "Agree memo ".date("Y-m-d H:i:s");
							     	$email_header = "Content-type: text/html; charset=UTF-8\n"; // or  //
							     	$email_header.= "From: ".$email_from."\n";
							     	$email_message = "";
							     	$email_message.= "คุณ ".$from_emp_name."<br>";
									$email_message.= "ทำการยื่นเอกสาร ".$memo_no."<br>";
									$email_message.= "สถานะเอกสาร Wait for Approve<br>";
							     	$email_message.= "=================================<br>";
							     	$email_message.= "Best regards,<br>".$email_from."<br>";

							     	if(mail($email_send_to , $email_subject , $email_message , $email_header)){
							     		$send_email_status = 'S';
							     		$json_obj->send_email_status = 'Send email success.';
							     	}
							     	else{
							     		$send_email_status = 'F';
							     		$json_obj->send_email_status = 'Send email failed.';
							     	}

							     	//insert data to table notification
							     	$s_sql_7 = "INSERT INTO notification_memo (emp_id_pk , mm_id_pk , nm_title , nm_content , nm_status , nm_notice_type , nm_readed_date , nm_created_date , nm_modified_date) VALUES (".$emp_id_get_notice." , ".$params['memo_id']." , '".$email_subject."' , '".$email_message."' , '".$send_email_status."' , '2' , null , NOW() , NOW()) ";
									$b_flag_7 = $obj_class->manageproc($s_sql_7);
									$obj_log->savelog($save_data_log,"agree_memo -> insert -> notification_leave (email)","sql=[$s_sql_7]");
								}
								//else if($map_emp_notice[$i]['notice_type'] == 1){ //send notice to verk

								//}
					     	}
						}
					}
				}
				else{
					$json_obj->command = '3503';
					$json_obj->message = 'Agree memo fail - update memo fail.';
				}
			}
			else{
				//update -> tb memo
				$s_sql_2 = "UPDATE memo ";
				$s_sql_2.= "SET mm_modified_date = NOW() , mst_id_pk = 1 , mm_status = 'Wait for agree' ";
				$s_sql_2.= "WHERE mm_id_pk = ".$params['memo_id']." ";
				$b_flag_2 = $obj_class->manageproc($s_sql_2);
				$obj_log->savelog($save_data_log,"agree_memo -> update -> memo","sql=[$s_sql_2]");

				if($b_flag_2){
					//update -> tb memo_history for last_concurred_employee
					$s_sql_3 = "UPDATE memo_history ";
					$s_sql_3.= "SET mmh_status = 'Agree' , mmh_comment = '".$params['memo_comment']."' ";
					$s_sql_3.= ", mmh_approve_date = NOW() , mmh_modified_date = NOW() ";
					$s_sql_3.= "WHERE com_id_pk = ".$params['company_id']." AND mm_id_pk = ".$params['memo_id']." ";
					$s_sql_3.= "AND emp_id_pk = ".$params['employee_id']." ";
					$b_flag_3 = $obj_class->manageproc($s_sql_3);
					$obj_log->savelog($save_data_log,"agree_memo -> update -> memo_history","sql=[$s_sql_3]");

					if($b_flag_3){
						//get next concurred_emp_info
						$next_concurred_order = 0;
						for($x=0;$x<$count_concurred;$x++){
							if($concurred_emp_info[0]['emp_com_id'] == $concurred_emp_com_id_array[$x]){
								$next_concurred_order = $x+1;
							}
						}

						$next_concurred_emp_info = $this->get_emp_info_by_emp_com_id($params['company_id'] , $concurred_emp_com_id_array[$next_concurred_order]);

						//insert -> tb memo_history new record for next concurred_employee
						$emp_com_id = $concurred_emp_com_id_array[$next_concurred_order];
						$emp_id_get_notice = $next_concurred_emp_info[0]['emp_id'];
						$device_type = $next_concurred_emp_info[0]['emp_device_type'];
						$push_token = $next_concurred_emp_info[0]['emp_gcm_token'];
						$emp_name = $next_concurred_emp_info[0]['emp_name'];
						$emp_email = $next_concurred_emp_info[0]['emp_email'];
						
						//insert -> tb memo_history new record for to_employee
						$s_sql_4 = "INSERT INTO memo_history (mm_id_pk , mmh_status , mmh_comment , mmh_name , mmh_pos ";
						$s_sql_4.= ", emp_id_pk , emp_ID , mmh_approve_date , mmh_issue_date , mmh_created_date ";
						$s_sql_4.= ", mmh_modified_date , mmh_signature , com_id_pk) VALUES ";
						$s_sql_4.= "(".$params['memo_id']." , 'Wait for Agree' , NULL , '".$next_concurred_emp_info[0]['emp_name']."' ";
						$s_sql_4.= ", '".$next_concurred_emp_info[0]['emp_position']."' , ".$next_concurred_emp_info[0]['emp_id']." ";
						$s_sql_4.= ", '".$emp_com_id."' , NULL , NOW() , NOW() , NOW() , NULL ";
						$s_sql_4.= ", ".$params['company_id'].") ";
						$b_flag_4 = $obj_class->manageproc($s_sql_4);
						$obj_log->savelog($save_data_log,"agree_memo -> insert -> memo_history","sql=[$s_sql_4]");

						if($b_flag_4){
							$json_obj->command = '3500';
							$json_obj->message = 'Agree memo success.';
						}
						else{
							$json_obj->command = '3505';
							$json_obj->message = 'Agree memo fail - insert memo_history fail.';
						}
					}
					else{
						$json_obj->command = '3504';
						$json_obj->message = 'Agree memo fail - update memo_history fail.';
					}

					
					//send notice to concurred_employee
					if($json_obj->command == '3500'){

						$status_1 = 'Wait for Agree';
						$result_1 = $this->delete_summary_profile($params['company_id'] , $concurred_emp_info[0]['emp_com_id'] , $status_1);

						$status_2 = 'Wait for Agree';
						$result_2 = $this->add_summary_profile($params['company_id'] , $emp_com_id , $status_2);

						if($result_1 && $result_2){
							$map_emp_notice = $this->get_map_emp_notice($params['company_id'] , $emp_com_id);

					     	for($i=0;$i<count($map_emp_notice);$i++){
					     		if(($map_emp_notice[$i]['notice_type'] == 3) && ($push_token != '')){ //send notice
									
									$notice_title = "Memo";
					     			$notice_content = "คุณ ".$from_emp_name."\nทำการยื่นเอกสาร ".$memo_no."\nสถานะเอกสาร Wait for Agree";

					     			//insert data to table notification
							     	$s_sql_7 = "INSERT INTO notification_memo (emp_id_pk , mm_id_pk , nm_title , nm_content , nm_status , nm_notice_type , nm_readed_date , nm_created_date , nm_modified_date) VALUES (".$emp_id_get_notice." , ".$params['memo_id']." , '".$notice_title."' , '".$notice_content."' , 'U' , '3' , null , NOW() , NOW()) ";
									$b_flag_7 = $obj_class->manageproc($s_sql_7);
									$obj_log->savelog($save_data_log,"agree_memo -> insert -> notification_leave (memo)","sql=[$s_sql_7]");

									if($device_type == "ios"){
										$data["aps"] = array(
														"alert"	=> array(
															"title" => $notice_title,
															"body" => $notice_content
															 ),
														"badge" => $this->get_badge_notice($emp_id_get_notice),
														"content-available" => 1
													);
										
										$ios[$push_token] = $data;
										$rs = $this->send_push_notice_ios($ios);
									}
									else if($device_type == "android"){
								     	$data = array(
											"data" => array(
												"title" => $notice_title,
												"content" => $notice_content,
												"badge" => $this->get_badge_notice($emp_id_get_notice)
											) , 
											"priority" => "high", 
											"to" => $push_token
										);

										$data_string = json_encode($data);  

										$result = $this->send_push_notice_android($data_string);
										$rs = ($result->success)?true:false;
									}
									
									if($rs){
										$json_obj->send_notice_status = 'Send notice success.';
							     	}
							     	else{
										$json_obj->send_notice_status = 'Send notice failed.';
							     	}
							    }
							    else if($map_emp_notice[$i]['notice_type'] == 2){ //send email

							    	$email_from = "verkapp@teleinfomedia.co.th";
							    	//$email_from = "godlikenokia@gmail.com";						    	
							    	//$emp_email = "lookbaar@gmail.com";

									$email_send_to = $emp_email;
							     	$email_subject = "Agree memo ".date("Y-m-d H:i:s");
							     	$email_header = "Content-type: text/html; charset=UTF-8\n"; // or  //
							     	$email_header.= "From: ".$email_from."\n";
							     	$email_message = "";
							     	$email_message.= "คุณ ".$from_emp_name."<br>";
									$email_message.= "ทำการยื่นเอกสาร ".$memo_no."<br>";
									$email_message.= "สถานะเอกสาร Wait for Agree<br>";
							     	$email_message.= "=================================<br>";
							     	$email_message.= "Best regards,<br>".$email_from."<br>";

							     	if(mail($email_send_to , $email_subject , $email_message , $email_header)){
							     		$send_email_status = 'S';
							     		$json_obj->send_email_status = 'Send email success.';
							     	}
							     	else{
							     		$send_email_status = 'F';
							     		$json_obj->send_email_status = 'Send email failed.';
							     	}

							     	//insert data to table notification
							     	$s_sql_7 = "INSERT INTO notification_memo (emp_id_pk , mm_id_pk , nm_title , nm_content , nm_status , nm_notice_type , nm_readed_date , nm_created_date , nm_modified_date) VALUES (".$emp_id_get_notice." , ".$params['memo_id']." , '".$email_subject."' , '".$email_message."' , '".$send_email_status."' , '2' , null , NOW() , NOW()) ";
									$b_flag_7 = $obj_class->manageproc($s_sql_7);
									$obj_log->savelog($save_data_log,"agree_memo -> insert -> notification_leave (email)","sql=[$s_sql_7]");
								}
								//else if($map_emp_notice[$i]['notice_type'] == 1){ //send notice to verk

								//}
					     	}
						}
					}
				}
				else{
					$json_obj->command = '3503';
					$json_obj->message = 'Agree memo fail - update memo fail.';
				}	
				
			}
			
		}
		else{
			$json_obj->command = '3502';
			$json_obj->message = 'Data not found.';
		}

		$obj_class->closedb();
		return $json_obj;
    }

    //3600 -- OK
	public function disagree_memo($params) {
		$json_obj = new stdClass();
		$obj_global = new GlobalConstant();		
		$obj_log = new LogFile();		
		$save_data_log = $_SERVER["HTTP_HOST"].$_SERVER["PHP_SELF"];

		$obj_class = new Connectdb($obj_global->getHOST_CMS(), $obj_global->getUSER_CMS() , $obj_global->getPWD_CMS(), "memo",0,FALSE);

		//$params['company_id']
		//$params['employee_id']
		//$params['memo_id']
		//$params['memo_comment']

		$concurred_emp_info = $this->get_emp_info_by_emp_id($params['company_id'] , $params['employee_id']);

		$s_sql = "SELECT * from memo WHERE com_id_pk = ".$params['company_id']." AND mm_id_pk = ".$params['memo_id']." ";
		$b_resp = $obj_class->selectproc($s_sql);
		$obj_log->savelog($save_data_log,"disagree_memo","sql=[$s_sql]");
		$datas = array();

		if($b_resp && $obj_class->n_row>0) {	
			$emp_info = $this->get_emp_info_by_emp_id($params['company_id'] , $obj_class->getitem("emp_id_pk"));
			$from_emp_name = $emp_info[0]['emp_name'];

			$memo_no = $obj_class->getitem("mm_NO");
			$from_emp_com_id = $obj_class->getitem("mm_from_emp_ID");

			//update -> tb memo
			$s_sql_2 = "UPDATE memo ";
			$s_sql_2.= "SET mm_modified_date = NOW() , mst_id_pk = 2 , mm_status = 'Disagree' ";
			$s_sql_2.= "WHERE mm_id_pk = ".$params['memo_id']." ";
			$b_flag_2 = $obj_class->manageproc($s_sql_2);
			$obj_log->savelog($save_data_log,"disagree_memo -> update -> memo","sql=[$s_sql_2]");

			if($b_flag_2){
				//update -> tb memo_history
				$s_sql_3 = "UPDATE memo_history ";
				$s_sql_3.= "SET mmh_status = 'Disagree' , mmh_comment = '".$params['memo_comment']."' ";
				$s_sql_3.= ", mmh_approve_date = NOW() , mmh_modified_date = NOW() ";
				$s_sql_3.= "WHERE com_id_pk = ".$params['company_id']." AND mm_id_pk = ".$params['memo_id']." ";
				$s_sql_3.= "AND emp_id_pk = ".$params['employee_id']." AND mmh_approve_date IS NULL ";
				$b_flag_3 = $obj_class->manageproc($s_sql_3);
				$obj_log->savelog($save_data_log,"disagree_memo -> update -> memo_history","sql=[$s_sql_3]");

				if($b_flag_3){
					$json_obj->command = '3600';
					$json_obj->message = 'Disagree memo success.';
				}
				else{
					$json_obj->command = '3604';
					$json_obj->message = 'Disagree memo fail - update memo_history fail.';
				}
			}
			else{
				$json_obj->command = '3603';
				$json_obj->message = 'Disagree memo fail - update memo fail.';
			}
		}
		else{
			$json_obj->command = '3602';
			$json_obj->message = 'Data not found.';
		}

		//send notice to from_emp
		if($json_obj->command == '3600'){

			$status = 'Wait for Agree';
			$result = $this->delete_summary_profile($params['company_id'] , $concurred_emp_info[0]['emp_com_id'] , $status);

			if($result){
				$from_emp_info = $this->get_emp_info_by_emp_com_id($params['company_id'] , $from_emp_com_id);

				$emp_com_id = $from_emp_com_id;
				$emp_id_get_notice = $from_emp_info[0]['emp_id'];
				$device_type = $from_emp_info[0]['emp_device_type'];
				$push_token = $from_emp_info[0]['emp_gcm_token'];
				$emp_name = $from_emp_info[0]['emp_name'];
				$emp_email = $from_emp_info[0]['emp_email'];

				$map_emp_notice = $this->get_map_emp_notice($params['company_id'] , $emp_com_id);

		     	for($i=0;$i<count($map_emp_notice);$i++){
		     		if(($map_emp_notice[$i]['notice_type'] == 3) && ($push_token != '')){ //send notice
						
						$notice_title = "Memo";
		     			$notice_content = "คุณ ".$from_emp_name."\nทำการยื่นเอกสาร ".$memo_no."\nสถานะเอกสาร Disagree";

		     			//insert data to table notification
				     	$s_sql_7 = "INSERT INTO notification_memo (emp_id_pk , mm_id_pk , nm_title , nm_content , nm_status , nm_notice_type , nm_readed_date , nm_created_date , nm_modified_date) VALUES (".$emp_id_get_notice." , ".$params['memo_id']." , '".$notice_title."' , '".$notice_content."' , 'U' , '3' , null , NOW() , NOW()) ";
						$b_flag_7 = $obj_class->manageproc($s_sql_7);
						$obj_log->savelog($save_data_log,"disagree_memo -> insert -> notification_leave (memo)","sql=[$s_sql_7]");

						if($device_type == "ios"){
							$data["aps"] = array(
											"alert"	=> array(
												"title" => $notice_title,
												"body" => $notice_content
												 ),
											"badge" => $this->get_badge_notice($emp_id_get_notice),
											"content-available" => 1
										);
							
							$ios[$push_token] = $data;
							$rs = $this->send_push_notice_ios($ios);
						}
						else if($device_type == "android"){
					     	$data = array(
								"data" => array(
									"title" => $notice_title,
									"content" => $notice_content,
									"badge" => $this->get_badge_notice($emp_id_get_notice)
								) , 
								"priority" => "high", 
								"to" => $push_token
							);

							$data_string = json_encode($data);  

							$result = $this->send_push_notice_android($data_string);
							$rs = ($result->success)?true:false;
						}
						
						if($rs){
							$json_obj->send_notice_status = 'Send notice success.';
				     	}
				     	else{
							$json_obj->send_notice_status = 'Send notice failed.';
				     	}
				    }
				    else if($map_emp_notice[$i]['notice_type'] == 2){ //send email

				    	$email_from = "verkapp@teleinfomedia.co.th";
				    	//$email_from = "godlikenokia@gmail.com";						    	
				    	//$emp_email = "lookbaar@gmail.com";

						$email_send_to = $emp_email;
				     	$email_subject = "Disagree memo ".date("Y-m-d H:i:s");
				     	$email_header = "Content-type: text/html; charset=UTF-8\n"; // or  //
				     	$email_header.= "From: ".$email_from."\n";
				     	$email_message = "";
				     	$email_message.= "คุณ ".$from_emp_name."<br>";
						$email_message.= "ทำการยื่นเอกสาร ".$memo_no."<br>";
						$email_message.= "สถานะเอกสาร Disagree<br>";
				     	$email_message.= "=================================<br>";
				     	$email_message.= "Best regards,<br>".$email_from."<br>";

				     	if(mail($email_send_to , $email_subject , $email_message , $email_header)){
				     		$send_email_status = 'S';
				     		$json_obj->send_email_status = 'Send email success.';
				     	}
				     	else{
				     		$send_email_status = 'F';
				     		$json_obj->send_email_status = 'Send email failed.';
				     	}

				     	//insert data to table notification
				     	$s_sql_7 = "INSERT INTO notification_memo (emp_id_pk , mm_id_pk , nm_title , nm_content , nm_status , nm_notice_type , nm_readed_date , nm_created_date , nm_modified_date) VALUES (".$emp_id_get_notice." , ".$params['memo_id']." , '".$email_subject."' , '".$email_message."' , '".$send_email_status."' , '2' , null , NOW() , NOW()) ";
						$b_flag_7 = $obj_class->manageproc($s_sql_7);
						$obj_log->savelog($save_data_log,"disagree_memo -> insert -> notification_leave (email)","sql=[$s_sql_7]");
					}
					//else if($map_emp_notice[$i]['notice_type'] == 1){ //send notice to verk

					//}
		     	}
			}
		}
		
		$obj_class->closedb();
		return $json_obj;
    }

    //3700 -- OK
	public function approve_memo($params) {
		$json_obj = new stdClass();
		$obj_global = new GlobalConstant();		
		$obj_log = new LogFile();		
		$save_data_log = $_SERVER["HTTP_HOST"].$_SERVER["PHP_SELF"];

		$obj_class = new Connectdb($obj_global->getHOST_CMS(), $obj_global->getUSER_CMS() , $obj_global->getPWD_CMS(), "memo",0,FALSE);
		$obj_class_2 = new Connectdb($obj_global->getHOST_CMS(), $obj_global->getUSER_CMS() , $obj_global->getPWD_CMS(), "memo",0,FALSE);

		//$params['company_id']
		//$params['employee_id']
		//$params['memo_id']
		//$params['memo_comment']

		$to_emp_info = $this->get_emp_info_by_emp_id($params['company_id'] , $params['employee_id']);

		$s_sql = "SELECT * from memo WHERE com_id_pk = ".$params['company_id']." AND mm_id_pk = ".$params['memo_id']." ";
		$b_resp = $obj_class->selectproc($s_sql);
		$obj_log->savelog($save_data_log,"approve_memo","sql=[$s_sql]");
		$datas = array();
		
		if($b_resp && $obj_class->n_row>0) {
			$emp_info = $this->get_emp_info_by_emp_id($params['company_id'] , $obj_class->getitem("emp_id_pk"));
			$from_emp_name = $emp_info[0]['emp_name'];

			$memo_no = $obj_class->getitem("mm_NO");	
			$cc_emp_com_id_array = explode("," , $obj_class->getitem("mm_cc_emp_ID"));
			$count_cc = ($obj_class->getitem("mm_cc_emp_ID") != null)?count($cc_emp_com_id_array):0;

			$from_emp_com_id = $obj_class->getitem("mm_from_emp_ID");
			
			$memo_form_id = $obj_class->getitem("mf_id_pk");
			$confirm_payment_emp_com_id = $obj_class->getitem("mm_confirm_payment_emp_ID");
			$advance_form_id = $obj_class->getitem("avf_id_pk");
			
			//update -> tb memo
			$s_sql_2 = "UPDATE memo ";
			$s_sql_2.= "SET mm_approve_date = NOW() , mm_modified_date = NOW() , mst_id_pk = 4 , mm_status = 'Approved' ";
			$s_sql_2.= "WHERE mm_id_pk = ".$params['memo_id']." ";
			$b_flag_2 = $obj_class->manageproc($s_sql_2);
			$obj_log->savelog($save_data_log,"approve_memo -> update -> memo","sql=[$s_sql_2]");

			if($b_flag_2){
				//update -> tb memo_history
				$s_sql_3 = "UPDATE memo_history ";
				$s_sql_3.= "SET mmh_status = 'Approved' , mmh_comment = '".$params['memo_comment']."' ";
				$s_sql_3.= ", mmh_approve_date = NOW() , mmh_modified_date = NOW() ";
				$s_sql_3.= "WHERE com_id_pk = ".$params['company_id']." AND mm_id_pk = ".$params['memo_id']." ";
				$s_sql_3.= "AND emp_id_pk = ".$params['employee_id']." AND mmh_approve_date IS NULL ";
				$b_flag_3 = $obj_class->manageproc($s_sql_3);
				$obj_log->savelog($save_data_log,"approve_memo -> update -> memo_history","sql=[$s_sql_3]");

				if($b_flag_3){
					if($memo_form_id == 3){
						$s_sql_4 = "SELECT * from advance_form WHERE com_id_pk = ".$params['company_id']." AND avf_id_pk = ".$advance_form_id." ";
						$b_resp_4 = $obj_class_2->selectproc($s_sql_4);

						if($b_resp_4 && $obj_class_2->n_row>0){
							//update -> tb advance_form
							$s_sql_5 = "UPDATE advance_form ";
							$s_sql_5.= "SET avf_modified_date = NOW() ";

							if($obj_class_2->getitem("avst_id_pk") == 1){
								$s_sql_5.= ", avf_approve_date = NOW() ";
							}
							else if($obj_class_2->getitem("avst_id_pk") == 3){
								$s_sql_5.= ", avf_cleared_approve_date = NOW() ";
							}
							else if($obj_class_2->getitem("avst_id_pk") == 5){
								$s_sql_5.= ", avf_over_paid_approve_date = NOW() ";
							}

							$s_sql_5.= "WHERE com_id_pk = ".$params['company_id']." AND avf_id_pk = ".$advance_form_id." ";
							$b_flag_5 = $obj_class->manageproc($s_sql_5);
						}
						else{
							$json_obj->command = '3705';
							$json_obj->message = 'Approve memo fail - select advance_form fail.';
						}
					}

					$json_obj->command = '3700';
					$json_obj->message = 'Approve memo success.';
				}
				else{
					$json_obj->command = '3704';
					$json_obj->message = 'Approve memo fail - update memo_history fail.';
				}
			}
			else{
				$json_obj->command = '3703';
				$json_obj->message = 'Approve memo fail - update memo fail.';
			}
		}
		else{
			$json_obj->command = '3702';
			$json_obj->message = 'Data not found.';
		}
		
		if($json_obj->command == '3700'){

			$status = 'Wait for Approve';
			$result = $this->delete_summary_profile($params['company_id'] , $to_emp_info[0]['emp_com_id'] , $status);

			if($result){
				//send notice to from_emp
				$from_emp_info = $this->get_emp_info_by_emp_com_id($params['company_id'] , $from_emp_com_id);

				$emp_com_id = $from_emp_com_id;
				$emp_id_get_notice = $from_emp_info[0]['emp_id'];
				$device_type = $from_emp_info[0]['emp_device_type'];
				$push_token = $from_emp_info[0]['emp_gcm_token'];
				$emp_name = $from_emp_info[0]['emp_name'];
				$emp_email = $from_emp_info[0]['emp_email'];

				$map_emp_notice = $this->get_map_emp_notice($params['company_id'] , $emp_com_id);
				
				
		     	for($i=0;$i<count($map_emp_notice);$i++){
		     		if(($map_emp_notice[$i]['notice_type'] == 3) && ($push_token != '')){ //send notice
						
						$notice_title = "Memo";
		     			$notice_content = "คุณ ".$from_emp_name."\nทำการยื่นเอกสาร ".$memo_no."\nสถานะเอกสาร Approved";

		     			//insert data to table notification
				     	$s_sql_7 = "INSERT INTO notification_memo (emp_id_pk , mm_id_pk , nm_title , nm_content , nm_status , nm_notice_type , nm_readed_date , nm_created_date , nm_modified_date) VALUES (".$emp_id_get_notice." , ".$params['memo_id']." , '".$notice_title."' , '".$notice_content."' , 'U' , '3' , null , NOW() , NOW()) ";
						$b_flag_7 = $obj_class->manageproc($s_sql_7);
						$obj_log->savelog($save_data_log,"approve_memo -> insert -> notification_leave (memo)","sql=[$s_sql_7]");

						if($device_type == "ios"){
							$data["aps"] = array(
											"alert"	=> array(
												"title" => $notice_title,
												"body" => $notice_content
												 ),
											"badge" => $this->get_badge_notice($emp_id_get_notice),
											"content-available" => 1
										);
							
							$ios[$push_token] = $data;
							$rs = $this->send_push_notice_ios($ios);
						}
						else if($device_type == "android"){
					     	$data = array(
								"data" => array(
									"title" => $notice_title,
									"content" => $notice_content,
									"badge" => $this->get_badge_notice($emp_id_get_notice)
								) , 
								"priority" => "high", 
								"to" => $push_token
							);

							$data_string = json_encode($data);  

							$result = $this->send_push_notice_android($data_string);
							$rs = ($result->success)?true:false;
						}
						
						if($rs){
							$json_obj->send_notice_status = 'Send notice success.';
				     	}
				     	else{
							$json_obj->send_notice_status = 'Send notice failed.';
				     	}
				    }
				    else if($map_emp_notice[$i]['notice_type'] == 2){ //send email

				    	$email_from = "verkapp@teleinfomedia.co.th";
				    	//$email_from = "godlikenokia@gmail.com";						    	
				    	//$emp_email = "lookbaar@gmail.com";

						$email_send_to = $emp_email;
				     	$email_subject = "Approve memo ".date("Y-m-d H:i:s");
				     	$email_header = "Content-type: text/html; charset=UTF-8\n"; // or  //
				     	$email_header.= "From: ".$email_from."\n";
				     	$email_message = "";
				     	$email_message.= "คุณ ".$from_emp_name."<br>";
						$email_message.= "ทำการยื่นเอกสาร ".$memo_no."<br>";
						$email_message.= "สถานะเอกสาร Approved<br>";
				     	$email_message.= "=================================<br>";
				     	$email_message.= "Best regards,<br>".$email_from."<br>";

				     	if(mail($email_send_to , $email_subject , $email_message , $email_header)){
				     		$send_email_status = 'S';
				     		$json_obj->send_email_status = 'Send email success.';
				     	}
				     	else{
				     		$send_email_status = 'F';
				     		$json_obj->send_email_status = 'Send email failed.';
				     	}

				     	//insert data to table notification
				     	$s_sql_7 = "INSERT INTO notification_memo (emp_id_pk , mm_id_pk , nm_title , nm_content , nm_status , nm_notice_type , nm_readed_date , nm_created_date , nm_modified_date) VALUES (".$emp_id_get_notice." , ".$params['memo_id']." , '".$email_subject."' , '".$email_message."' , '".$send_email_status."' , '2' , null , NOW() , NOW()) ";
						$b_flag_7 = $obj_class->manageproc($s_sql_7);
						$obj_log->savelog($save_data_log,"approve_memo -> insert -> notification_leave (email)","sql=[$s_sql_7]");
					}
					//else if($map_emp_notice[$i]['notice_type'] == 1){ //send notice to verk

					//}
		     	}

		     	//send notice to cc_emp
		     	if($count_cc > 0){
			     	for($x=0;$x<$count_cc;$x++){
						$cc_emp_info = $this->get_emp_info_by_emp_com_id($params['company_id'] , $cc_emp_com_id_array[$x]);

						$emp_com_id = $cc_emp_com_id_array[$x];
						$emp_id_get_notice = $cc_emp_info[0]['emp_id'];
						$device_type = $cc_emp_info[0]['emp_device_type'];
						$push_token = $cc_emp_info[0]['emp_gcm_token'];
						$emp_name = $cc_emp_info[0]['emp_name'];
						$emp_email = $cc_emp_info[0]['emp_email'];

						$map_emp_notice = $this->get_map_emp_notice($params['company_id'] , $emp_com_id);

				     	for($y=0;$y<count($map_emp_notice);$y++){
				     		if(($map_emp_notice[$y]['notice_type'] == 3) && ($push_token != '')){ //send notice
								
								$notice_title = "Memo";
				     			$notice_content = "คุณ ".$from_emp_name."\nทำการยื่นเอกสาร ".$memo_no."\nสถานะเอกสาร Approved";

				     			//insert data to table notification
						     	$s_sql_7 = "INSERT INTO notification_memo (emp_id_pk , mm_id_pk , nm_title , nm_content , nm_status , nm_notice_type , nm_readed_date , nm_created_date , nm_modified_date) VALUES (".$emp_id_get_notice." , ".$params['memo_id']." , '".$notice_title."' , '".$notice_content."' , 'U' , '3' , null , NOW() , NOW()) ";
								$b_flag_7 = $obj_class->manageproc($s_sql_7);
								$obj_log->savelog($save_data_log,"approve_memo -> insert -> notification_leave (memo)","sql=[$s_sql_7]");

								if($device_type == "ios"){
									$data["aps"] = array(
													"alert"	=> array(
														"title" => $notice_title,
														"body" => $notice_content
														 ),
													"badge" => $this->get_badge_notice($emp_id_get_notice),
													"content-available" => 1
												);
									
									$ios[$push_token] = $data;
									$rs = $this->send_push_notice_ios($ios);
								}
								else if($device_type == "android"){
							     	$data = array(
										"data" => array(
											"title" => $notice_title,
											"content" => $notice_content,
											"badge" => $this->get_badge_notice($emp_id_get_notice)
										) , 
										"priority" => "high", 
										"to" => $push_token
									);

									$data_string = json_encode($data);  

									$result = $this->send_push_notice_android($data_string);
									$rs = ($result->success)?true:false;
								}
								
								if($rs){
									$json_obj->send_notice_status = 'Send notice success.';
						     	}
						     	else{
									$json_obj->send_notice_status = 'Send notice failed.';
						     	}
						    }
						    else if($map_emp_notice[$y]['notice_type'] == 2){ //send email

						    	$email_from = "verkapp@teleinfomedia.co.th";
						    	//$email_from = "godlikenokia@gmail.com";						    	
						    	//$emp_email = "lookbaar@gmail.com";

								$email_send_to = $emp_email;
						     	$email_subject = "Approve memo ".date("Y-m-d H:i:s");
						     	$email_header = "Content-type: text/html; charset=UTF-8\n"; // or  //
						     	$email_header.= "From: ".$email_from."\n";
						     	$email_message = "";
						     	$email_message.= "คุณ ".$from_emp_name."<br>";
								$email_message.= "ทำการยื่นเอกสาร ".$memo_no."<br>";
								$email_message.= "สถานะเอกสาร Approved<br>";
						     	$email_message.= "=================================<br>";
						     	$email_message.= "Best regards,<br>".$email_from."<br>";

						     	if(mail($email_send_to , $email_subject , $email_message , $email_header)){
						     		$send_email_status = 'S';
						     		$json_obj->send_email_status = 'Send email success.';
						     	}
						     	else{
						     		$send_email_status = 'F';
						     		$json_obj->send_email_status = 'Send email failed.';
						     	}

						     	//insert data to table notification
						     	$s_sql_7 = "INSERT INTO notification_memo (emp_id_pk , mm_id_pk , nm_title , nm_content , nm_status , nm_notice_type , nm_readed_date , nm_created_date , nm_modified_date) VALUES (".$emp_id_get_notice." , ".$params['memo_id']." , '".$email_subject."' , '".$email_message."' , '".$send_email_status."' , '2' , null , NOW() , NOW()) ";
								$b_flag_7 = $obj_class->manageproc($s_sql_7);
								$obj_log->savelog($save_data_log,"approve_memo -> insert -> notification_leave (email)","sql=[$s_sql_7]");
							}
							//else if($map_emp_notice[$y]['notice_type'] == 1){ //send notice to verk

							//}
				     	}

					}
				}

				//send notice to confirm_payment_emp
				if($memo_form_id == 3){
					$confirm_payment_emp_info = $this->get_emp_info_by_emp_com_id($params['company_id'] , $confirm_payment_emp_com_id);

					$emp_com_id = $confirm_payment_emp_com_id;
					$emp_id_get_notice = $confirm_payment_emp_info[0]['emp_id'];
					$device_type = $confirm_payment_emp_info[0]['emp_device_type'];
					$push_token = $confirm_payment_emp_info[0]['emp_gcm_token'];
					$emp_name = $confirm_payment_emp_info[0]['emp_name'];
					$emp_email = $confirm_payment_emp_info[0]['emp_email'];

					$map_emp_notice = $this->get_map_emp_notice($params['company_id'] , $emp_com_id);

			     	for($i=0;$i<count($map_emp_notice);$i++){
			     		if(($map_emp_notice[$i]['notice_type'] == 3) && ($push_token != '')){ //send notice
							
							$notice_title = "Memo";
			     			$notice_content = "คุณ ".$from_emp_name."\nทำการยื่นเอกสาร ".$memo_no."\nสถานะเอกสาร Approved";

			     			//insert data to table notification
					     	$s_sql_7 = "INSERT INTO notification_memo (emp_id_pk , mm_id_pk , nm_title , nm_content , nm_status , nm_notice_type , nm_readed_date , nm_created_date , nm_modified_date) VALUES (".$emp_id_get_notice." , ".$params['memo_id']." , '".$notice_title."' , '".$notice_content."' , 'U' , '3' , null , NOW() , NOW()) ";
							$b_flag_7 = $obj_class->manageproc($s_sql_7);
							$obj_log->savelog($save_data_log,"approve_memo -> insert -> notification_leave (memo)","sql=[$s_sql_7]");

							if($device_type == "ios"){
								$data["aps"] = array(
												"alert"	=> array(
													"title" => $notice_title,
													"body" => $notice_content
													 ),
												"badge" => $this->get_badge_notice($emp_id_get_notice),
												"content-available" => 1
											);
								
								$ios[$push_token] = $data;
								$rs = $this->send_push_notice_ios($ios);
							}
							else if($device_type == "android"){
						     	$data = array(
									"data" => array(
										"title" => $notice_title,
										"content" => $notice_content,
										"badge" => $this->get_badge_notice($emp_id_get_notice)
									) , 
									"priority" => "high", 
									"to" => $push_token
								);

								$data_string = json_encode($data);  

								$result = $this->send_push_notice_android($data_string);
								$rs = ($result->success)?true:false;
							}
							
							if($rs){
								$json_obj->send_notice_status = 'Send notice success.';
					     	}
					     	else{
								$json_obj->send_notice_status = 'Send notice failed.';
					     	}

					     	$json_obj->memo_form_id = $memo_form_id;
							$json_obj->confirm_payment = $confirm_payment_emp_info;
					    }
					    else if($map_emp_notice[$i]['notice_type'] == 2){ //send email

					    	$email_from = "verkapp@teleinfomedia.co.th";
					    	//$email_from = "godlikenokia@gmail.com";						    	
					    	//$emp_email = "lookbaar@gmail.com";

							$email_send_to = $emp_email;
					     	$email_subject = "Approve memo ".date("Y-m-d H:i:s");
					     	$email_header = "Content-type: text/html; charset=UTF-8\n"; // or  //
					     	$email_header.= "From: ".$email_from."\n";
					     	$email_message = "";
					     	$email_message.= "คุณ ".$from_emp_name."<br>";
							$email_message.= "ทำการยื่นเอกสาร ".$memo_no."<br>";
							$email_message.= "สถานะเอกสาร Approved<br>";
					     	$email_message.= "=================================<br>";
					     	$email_message.= "Best regards,<br>".$email_from."<br>";

					     	if(mail($email_send_to , $email_subject , $email_message , $email_header)){
					     		$send_email_status = 'S';
					     		$json_obj->send_email_status = 'Send email success.';
					     	}
					     	else{
					     		$send_email_status = 'F';
					     		$json_obj->send_email_status = 'Send email failed.';
					     	}

					     	//insert data to table notification
					     	$s_sql_7 = "INSERT INTO notification_memo (emp_id_pk , mm_id_pk , nm_title , nm_content , nm_status , nm_notice_type , nm_readed_date , nm_created_date , nm_modified_date) VALUES (".$emp_id_get_notice." , ".$params['memo_id']." , '".$email_subject."' , '".$email_message."' , '".$send_email_status."' , '2' , null , NOW() , NOW()) ";
							$b_flag_7 = $obj_class->manageproc($s_sql_7);
							$obj_log->savelog($save_data_log,"approve_memo -> insert -> notification_leave (email)","sql=[$s_sql_7]");
						}
						//else if($map_emp_notice[$i]['notice_type'] == 1){ //send notice to verk

						//}



			     	}
				}
			}
		}
		
		$obj_class->closedb();
		return $json_obj;
    }

    //3800 -- OK
	public function disapprove_memo($params) {
		$json_obj = new stdClass();
		$obj_global = new GlobalConstant();		
		$obj_log = new LogFile();		
		$save_data_log = $_SERVER["HTTP_HOST"].$_SERVER["PHP_SELF"];

		$obj_class = new Connectdb($obj_global->getHOST_CMS(), $obj_global->getUSER_CMS() , $obj_global->getPWD_CMS(), "memo",0,FALSE);

		//$params['company_id']
		//$params['employee_id']
		//$params['memo_id']
		//$params['memo_comment']

		$to_emp_info = $this->get_emp_info_by_emp_id($params['company_id'] , $params['employee_id']);

		$s_sql = "SELECT * from memo WHERE com_id_pk = ".$params['company_id']." AND mm_id_pk = ".$params['memo_id']." ";
		$b_resp = $obj_class->selectproc($s_sql);
		$obj_log->savelog($save_data_log,"disapprove_memo","sql=[$s_sql]");
		$datas = array();

		if($b_resp && $obj_class->n_row>0) {
			$emp_info = $this->get_emp_info_by_emp_id($params['company_id'] , $obj_class->getitem("emp_id_pk"));
			$from_emp_name = $emp_info[0]['emp_name'];

			$memo_no = $obj_class->getitem("mm_NO");	
			$from_emp_com_id = $obj_class->getitem("mm_from_emp_ID");

			//update -> tb memo
			$s_sql_2 = "UPDATE memo ";
			$s_sql_2.= "SET mm_modified_date = NOW() , mst_id_pk = 5 , mm_status = 'Disapproved' ";
			$s_sql_2.= "WHERE mm_id_pk = ".$params['memo_id']." ";
			$b_flag_2 = $obj_class->manageproc($s_sql_2);
			$obj_log->savelog($save_data_log,"disapprove_memo -> update -> memo","sql=[$s_sql_2]");

			if($b_flag_2){
				//update -> tb memo_history
				$s_sql_3 = "UPDATE memo_history ";
				$s_sql_3.= "SET mmh_status = 'Disapproved' , mmh_comment = '".$params['memo_comment']."' ";
				$s_sql_3.= ", mmh_approve_date = NOW() , mmh_modified_date = NOW() ";
				$s_sql_3.= "WHERE com_id_pk = ".$params['company_id']." AND mm_id_pk = ".$params['memo_id']." ";
				$s_sql_3.= "AND emp_id_pk = ".$params['employee_id']." AND mmh_approve_date IS NULL ";
				$b_flag_3 = $obj_class->manageproc($s_sql_3);
				$obj_log->savelog($save_data_log,"disapprove_memo -> update -> memo_history","sql=[$s_sql_3]");

				if($b_flag_3){
					$json_obj->command = '3800';
					$json_obj->message = 'Disapprove memo success.';
				}
				else{
					$json_obj->command = '3804';
					$json_obj->message = 'Disapprove memo fail - update memo_history fail.';
				}
			}
			else{
				$json_obj->command = '3803';
				$json_obj->message = 'Disapprove memo fail - update memo fail.';
			}
		}
		else{
			$json_obj->command = '3802';
			$json_obj->message = 'Data not found.';
		}

		//send notice to from_emp
		if($json_obj->command == '3800'){

			$status = 'Wait for Approve';
			$result = $this->delete_summary_profile($params['company_id'] , $to_emp_info[0]['emp_com_id'] , $status);

			if($result){
				$from_emp_info = $this->get_emp_info_by_emp_com_id($params['company_id'] , $from_emp_com_id);

				$emp_com_id = $from_emp_com_id;
				$emp_id_get_notice = $from_emp_info[0]['emp_id'];
				$device_type = $from_emp_info[0]['emp_device_type'];
				$push_token = $from_emp_info[0]['emp_gcm_token'];
				$emp_name = $from_emp_info[0]['emp_name'];
				$emp_email = $from_emp_info[0]['emp_email'];

				$map_emp_notice = $this->get_map_emp_notice($params['company_id'] , $emp_com_id);

		     	for($i=0;$i<count($map_emp_notice);$i++){
		     		if(($map_emp_notice[$i]['notice_type'] == 3) && ($push_token != '')){ //send notice
						
						$notice_title = "Memo";
		     			$notice_content = "คุณ ".$from_emp_name."\nทำการยื่นเอกสาร ".$memo_no."\nสถานะเอกสาร Disapproved";

		     			//insert data to table notification
				     	$s_sql_7 = "INSERT INTO notification_memo (emp_id_pk , mm_id_pk , nm_title , nm_content , nm_status , nm_notice_type , nm_readed_date , nm_created_date , nm_modified_date) VALUES (".$emp_id_get_notice." , ".$params['memo_id']." , '".$notice_title."' , '".$notice_content."' , 'U' , '3' , null , NOW() , NOW()) ";
						$b_flag_7 = $obj_class->manageproc($s_sql_7);
						$obj_log->savelog($save_data_log,"disapprove_memo -> insert -> notification_leave (memo)","sql=[$s_sql_7]");

						if($device_type == "ios"){
							$data["aps"] = array(
											"alert"	=> array(
												"title" => $notice_title,
												"body" => $notice_content
												 ),
											"badge" => $this->get_badge_notice($emp_id_get_notice),
											"content-available" => 1
										);
							
							$ios[$push_token] = $data;
							$rs = $this->send_push_notice_ios($ios);
						}
						else if($device_type == "android"){
					     	$data = array(
								"data" => array(
									"title" => $notice_title,
									"content" => $notice_content,
									"badge" => $this->get_badge_notice($emp_id_get_notice)
								) , 
								"priority" => "high", 
								"to" => $push_token
							);

							$data_string = json_encode($data);  

							$result = $this->send_push_notice_android($data_string);
							$rs = ($result->success)?true:false;
						}
						
						if($rs){
							$json_obj->send_notice_status = 'Send notice success.';
				     	}
				     	else{
							$json_obj->send_notice_status = 'Send notice failed.';
				     	}
				    }
				    else if($map_emp_notice[$i]['notice_type'] == 2){ //send email

				    	$email_from = "verkapp@teleinfomedia.co.th";
				    	//$email_from = "godlikenokia@gmail.com";						    	
				    	//$emp_email = "lookbaar@gmail.com";

						$email_send_to = $emp_email;
				     	$email_subject = "Disapprove memo ".date("Y-m-d H:i:s");
				     	$email_header = "Content-type: text/html; charset=UTF-8\n"; // or  //
				     	$email_header.= "From: ".$email_from."\n";
				     	$email_message = "";
				     	$email_message.= "คุณ ".$from_emp_name."<br>";
						$email_message.= "ทำการยื่นเอกสาร ".$memo_no."<br>";
						$email_message.= "สถานะเอกสาร Disapproved<br>";
				     	$email_message.= "=================================<br>";
				     	$email_message.= "Best regards,<br>".$email_from."<br>";

				     	if(mail($email_send_to , $email_subject , $email_message , $email_header)){
				     		$send_email_status = 'S';
				     		$json_obj->send_email_status = 'Send email success.';
				     	}
				     	else{
				     		$send_email_status = 'F';
				     		$json_obj->send_email_status = 'Send email failed.';
				     	}

				     	//insert data to table notification
				     	$s_sql_7 = "INSERT INTO notification_memo (emp_id_pk , mm_id_pk , nm_title , nm_content , nm_status , nm_notice_type , nm_readed_date , nm_created_date , nm_modified_date) VALUES (".$emp_id_get_notice." , ".$params['memo_id']." , '".$email_subject."' , '".$email_message."' , '".$send_email_status."' , '2' , null , NOW() , NOW()) ";
						$b_flag_7 = $obj_class->manageproc($s_sql_7);
						$obj_log->savelog($save_data_log,"disapprove_memo -> insert -> notification_leave (email)","sql=[$s_sql_7]");
					}
					//else if($map_emp_notice[$i]['notice_type'] == 1){ //send notice to verk

					//}
		     	}
			}
		}
		
		$obj_class->closedb();
		return $json_obj;
    }

    //3900 -- OK //edit api doc
	public function terminate_memo($params) {
		$json_obj = new stdClass();
		$obj_global = new GlobalConstant();		
		$obj_log = new LogFile();		
		$save_data_log = $_SERVER["HTTP_HOST"].$_SERVER["PHP_SELF"];

		$obj_class = new Connectdb($obj_global->getHOST_CMS(), $obj_global->getUSER_CMS() , $obj_global->getPWD_CMS(), "memo",0,FALSE);

		//$params['company_id']
		//$params['employee_id']
		//$params['memo_id']
		//$params['memo_comment']
		//$params['memo_status_id'] 

		$params['memo_status_id'] = 1;

		$terminate_emp_info = $this->get_emp_info_by_emp_id($params['company_id'] , $params['employee_id']);

		$s_sql = "SELECT * from memo WHERE com_id_pk = ".$params['company_id']." AND mm_id_pk = ".$params['memo_id']." ";
		$b_resp = $obj_class->selectproc($s_sql);
		$obj_log->savelog($save_data_log,"terminate_memo","sql=[$s_sql]");
		$datas = array();

		if($b_resp && $obj_class->n_row>0) {	
			$emp_info = $this->get_emp_info_by_emp_id($params['company_id'] , $obj_class->getitem("emp_id_pk"));
			$from_emp_name = $emp_info[0]['emp_name'];

			$memo_no = $obj_class->getitem("mm_NO");
			$from_emp_com_id = $obj_class->getitem("mm_from_emp_ID");
			$advance_form_id = $obj_class->getitem("avf_id_pk");

			//update -> tb memo
			$s_sql_2 = "UPDATE memo ";
			$s_sql_2.= "SET mm_modified_date = NOW() , mm_approve_date = NOW() , mst_id_pk = 6 , mm_status = 'Terminate' ";
			$s_sql_2.= "WHERE mm_id_pk = ".$params['memo_id']." ";
			$b_flag_2 = $obj_class->manageproc($s_sql_2);
			$obj_log->savelog($save_data_log,"terminate_memo -> update -> memo","sql=[$s_sql_2]");

			if($b_flag_2){
				//update -> tb memo_history
				$s_sql_3 = "UPDATE memo_history ";
				$s_sql_3.= "SET mmh_status = 'Terminate' , mmh_comment = '".$params['memo_comment']."' ";
				$s_sql_3.= ", mmh_approve_date = NOW() , mmh_modified_date = NOW() ";
				$s_sql_3.= "WHERE com_id_pk = ".$params['company_id']." AND mm_id_pk = ".$params['memo_id']." ";
				$s_sql_3.= "AND emp_id_pk = ".$params['employee_id']." AND mmh_approve_date IS NULL ";
				$b_flag_3 = $obj_class->manageproc($s_sql_3);
				$obj_log->savelog($save_data_log,"terminate_memo -> update -> memo_history","sql=[$s_sql_3]");

				if($b_flag_3){
					if(($advance_form_id) && ($advance_form_id != '')){
						//update -> tb advance_form
						$s_sql_4 = "UPDATE advance_form ";
						$s_sql_4.= "SET avf_modified_date = NOW() , avf_approve_date = NOW() , avst_id_pk = 7 , avf_status = 'Terminate' ";
						$s_sql_4.= "WHERE com_id_pk = ".$params['company_id']." AND avf_id_pk = ".$advance_form_id." ";
						$b_flag_4 = $obj_class->manageproc($s_sql_4);

						if($b_flag_4){ 
							//insert -> tb advance_history
							$s_sql_5 = "INSERT INTO advance_history (avf_id_pk , avh_emp_ID ";
							$s_sql_5.= ", avh_emp_name , avh_pos ";
							$s_sql_5.= ", avh_type , avh_created_date , avh_remark) ";
							$s_sql_5.= "VALUES (".$advance_form_id." , '".$terminate_emp_info[0]['emp_com_id']."' ";
							$s_sql_5.= ", '".$terminate_emp_info[0]['emp_name']."' , '".$terminate_emp_info[0]['emp_pos_initial']."' ";
							$s_sql_5.= ", 'Terminate' , NOW() , '".$params['memo_comment']."')";
							$b_flag_5 = $obj_class->manageproc($s_sql_5);

							if($b_flag_5){
								$json_obj->command = '3900';
								$json_obj->message = 'Terminate memo success.';
							}
							else{
								$json_obj->command = '3906';
								$json_obj->message = 'Terminate memo fail - insert advance_history fail.';
							}
						}
						else{
							$json_obj->command = '3905';
							$json_obj->message = 'Terminate memo fail - update advance_form fail.';
						}
					}
					else{
						$json_obj->command = '3900';
						$json_obj->message = 'Terminate memo success.';
					}
				}
				else{
					$json_obj->command = '3904';
					$json_obj->message = 'Terminate memo fail - update memo_history fail.';
				}


				
			}
			else{
				$json_obj->command = '3903';
				$json_obj->message = 'Terminate memo fail - update memo fail.';
			}
		}
		else{
			$json_obj->command = '3902';
			$json_obj->message = 'Data not found.';
		}

		//send notice to from_emp
		if($json_obj->command == '3900'){
		
			$status = ($params['memo_status_id'] == 1)?'Wait for Agree':'Wait for Approve';
			$result = $this->delete_summary_profile($params['company_id'] , $terminate_emp_info[0]['emp_com_id'] , $status);

			if($result){
				$from_emp_info = $this->get_emp_info_by_emp_com_id($params['company_id'] , $from_emp_com_id);

				$emp_com_id = $from_emp_com_id;
				$emp_id_get_notice = $from_emp_info[0]['emp_id'];
				$device_type = $from_emp_info[0]['emp_device_type'];
				$push_token = $from_emp_info[0]['emp_gcm_token'];
				$emp_name = $from_emp_info[0]['emp_name'];
				$emp_email = $from_emp_info[0]['emp_email'];

				$map_emp_notice = $this->get_map_emp_notice($params['company_id'] , $emp_com_id);

		     	for($i=0;$i<count($map_emp_notice);$i++){
		     		if(($map_emp_notice[$i]['notice_type'] == 3) && ($push_token != '')){ //send notice
						
						$notice_title = "Memo";
		     			$notice_content = "คุณ ".$from_emp_name."\nทำการยื่นเอกสาร ".$memo_no."\nสถานะเอกสาร Terminate"; 

		     			//insert data to table notification
				     	$s_sql_7 = "INSERT INTO notification_memo (emp_id_pk , mm_id_pk , nm_title , nm_content , nm_status , nm_notice_type , nm_readed_date , nm_created_date , nm_modified_date) VALUES (".$emp_id_get_notice." , ".$params['memo_id']." , '".$notice_title."' , '".$notice_content."' , 'U' , '3' , null , NOW() , NOW()) ";
						$b_flag_7 = $obj_class->manageproc($s_sql_7);
						$obj_log->savelog($save_data_log,"terminate_memo -> insert -> notification_leave (memo)","sql=[$s_sql_7]");

						if($device_type == "ios"){
							$data["aps"] = array(
											"alert"	=> array(
												"title" => $notice_title,
												"body" => $notice_content
												 ),
											"badge" => $this->get_badge_notice($emp_id_get_notice),
											"content-available" => 1
										);
							
							$ios[$push_token] = $data;
							$rs = $this->send_push_notice_ios($ios);
						}
						else if($device_type == "android"){
					     	$data = array(
								"data" => array(
									"title" => $notice_title,
									"content" => $notice_content,
									"badge" => $this->get_badge_notice($emp_id_get_notice)
								) , 
								"priority" => "high", 
								"to" => $push_token
							);

							$data_string = json_encode($data);  

							$result = $this->send_push_notice_android($data_string);
							$rs = ($result->success)?true:false;
						}
						
						if($rs){
							$json_obj->send_notice_status = 'Send notice success.';
				     	}
				     	else{
							$json_obj->send_notice_status = 'Send notice failed.';
				     	}
				    }
				    else if($map_emp_notice[$i]['notice_type'] == 2){ //send email

				    	$email_from = "verkapp@teleinfomedia.co.th";
				    	//$email_from = "godlikenokia@gmail.com";						    	
				    	//$emp_email = "lookbaar@gmail.com";

						$email_send_to = $emp_email;
				     	$email_subject = "Terminate memo ".date("Y-m-d H:i:s");
				     	$email_header = "Content-type: text/html; charset=UTF-8\n"; // or  //
				     	$email_header.= "From: ".$email_from."\n";
				     	$email_message = "";
				     	$email_message.= "คุณ ".$from_emp_name."<br>";
						$email_message.= "ทำการยื่นเอกสาร ".$memo_no."<br>";
						$email_message.= "สถานะเอกสาร Terminate<br>";
				     	$email_message.= "=================================<br>";
				     	$email_message.= "Best regards,<br>".$email_from."<br>";

				     	if(mail($email_send_to , $email_subject , $email_message , $email_header)){
				     		$send_email_status = 'S';
				     		$json_obj->send_email_status = 'Send email success.';
				     	}
				     	else{
				     		$send_email_status = 'F';
				     		$json_obj->send_email_status = 'Send email failed.';
				     	}

				     	//insert data to table notification
				     	$s_sql_7 = "INSERT INTO notification_memo (emp_id_pk , mm_id_pk , nm_title , nm_content , nm_status , nm_notice_type , nm_readed_date , nm_created_date , nm_modified_date) VALUES (".$emp_id_get_notice." , ".$params['memo_id']." , '".$email_subject."' , '".$email_message."' , '".$send_email_status."' , '2' , null , NOW() , NOW()) ";
						$b_flag_7 = $obj_class->manageproc($s_sql_7);
						$obj_log->savelog($save_data_log,"terminate_memo -> insert -> notification_leave (email)","sql=[$s_sql_7]");
					}
					//else if($map_emp_notice[$i]['notice_type'] == 1){ //send notice to verk

					//}
		     	}
			}
		}
		
		$obj_class->closedb();
		return $json_obj;
    }

    //4000 -- OK
	public function update_profile_image($params , $files) {
		$json_obj = new stdClass();
		$obj_global = new GlobalConstant();		
		$obj_log = new LogFile();		
		$save_data_log = $_SERVER["HTTP_HOST"].$_SERVER["PHP_SELF"];

		$obj_class = new Connectdb($obj_global->getHOST_CMS(), $obj_global->getUSER_CMS() , $obj_global->getPWD_CMS(), "employee",0,FALSE);

		//$params['company_id']
		//$params['employee_id']
		//$params['profile_image_path']

		$params['profile_image_path'] = isset($files['profile_image_path'])?$files['profile_image_path']:'';

		//update -> tb employee 
		if($files['profile_image_path']['name'] != ''){
			$path = "../EdC/".$params['company_id']."/profile_image/";
			if(!(file_exists($path))){
				mkdir($path, 0777, true);
			}

			$file_name = date('Ymd_His_').$params['employee_id'].'.jpg';
			$file_size = $files['profile_image_path']['size'];
			$file_tmp = $files['profile_image_path']['tmp_name'];
			$file_type = $files['profile_image_path']['type'];
			$file_ext = strtolower(end(explode('.',$files['profile_image_path']['name'])));
		
			$expensions = array("jpeg","jpg","png");

			$errors = '{"result_code":1,"result_desc":"success"}';

			if(in_array($file_ext,$expensions) === false){
				$json_obj->command = '4004';
				$json_obj->message = 'Update leave info fail - please choose a JPEG or PNG file.';
			}
			else if($files['profile_image_path']['size'] == 0){
				$json_obj->command = '4005';
				$json_obj->message = 'Update leave info fail - post max file must be exactly 8 MB.';
			}
			else if($files['profile_image_path']['size'] > 2097152){
				$json_obj->command = '4006';
				$json_obj->message = 'Update leave info fail - file size must be exactly 2 MB.';
			}
			else {
				if($_SERVER['HTTP_HOST'] == 'localhost'){
					$url_path = "http://localhost/var_www/verkplus/sub-verk/memo/EdC/".$params['company_id']."/profile_image/";
				}
				else{
					if($_SERVER['HTTP_HOST'] == '58.137.222.81'){
						//58.137.222.81
						$url_path = "http://".$_SERVER['HTTP_HOST']."/var_www/verkplus/sub-verk/memo/EdC/".$params['company_id']."/profile_image/";
					}
					else{
						//58.137.160.130
						$url_path = "http://".$_SERVER['HTTP_HOST']."/sub-verk/memo/EdC/".$params['company_id']."/profile_image/";
					}
				}

				//default path : '../EdC/default.jpg'
				$s_sql_0 = "SELECT * FROM employee WHERE com_id_pk = ".$params['company_id']." AND emp_id_pk = ".$params['employee_id']." ";
				$b_resp_0 = $obj_class->selectproc($s_sql_0);
				if($b_resp_0 && $obj_class->n_row>0) {
					if($obj_class->getitem("emp_display")){
						$old_file_name = $obj_class->getitem("emp_display");
						unlink($path.$old_file_name);
					}
				}
				
				move_uploaded_file($file_tmp , $path.$file_name);

				//update
				$s_sql_3 = "UPDATE employee ";
				$s_sql_3.= "SET emp_display = '".$file_name."' , emp_modified_date = NOW() ";
				$s_sql_3.= "WHERE com_id_pk = ".$params['company_id']." AND emp_id_pk = ".$params['employee_id']." ";
				$b_flag_3 = $obj_class->manageproc($s_sql_3);
				$obj_log->savelog($save_data_log,"update_profile_image","sql=[$s_sql_3]");

				if($b_flag_3){
					$json_obj->command = '4000';
					$json_obj->message = 'Update profile image success.';
					$json_obj->emp_profile_image = $url_path.$file_name;
				}
				else{
					$json_obj->command = '4003';
					$json_obj->message = 'Update profile image fail - update employee fail.';
				}
			}
		}
		else{
			$json_obj->command = '4002';
			$json_obj->message = 'Data is invalid.';
		}
		
		$obj_class->closedb();
		return $json_obj;
    }

    //4100 -- OK
	public function delete_attach_file($params) {
		$json_obj = new stdClass();
		$obj_global = new GlobalConstant();		
		$obj_log = new LogFile();		
		$save_data_log = $_SERVER["HTTP_HOST"].$_SERVER["PHP_SELF"];

		$obj_class = new Connectdb($obj_global->getHOST_CMS(), $obj_global->getUSER_CMS() , $obj_global->getPWD_CMS(), "memo",0,FALSE);

		//$params['company_id']
		//$params['memo_id']
		//$params['memo_attach_file_id']
		//$params['memo_attach_file_name']

		$path = "../EdC/".$params['company_id']."/memo_attach_file/".$params['memo_id']."/";	
		$thumb_path = "../EdC/".$params['company_id']."/memo_thumb_attach_file/".$params['memo_id']."/";
		
		if(unlink($path.$params['memo_attach_file_name']) && unlink($thumb_path.$params['memo_attach_file_name'])){
			$s_sql_1 = "DELETE FROM memo_attachfile WHERE mm_id_pk = ".$params['memo_id']." AND ma_id_pk = ".$params['memo_attach_file_id'];
			$b_resp_1 = $obj_class->manageproc($s_sql_1);
			$obj_log->savelog($save_data_log,"delete_attach_file","sql=[$s_sql_1]");

			$json_obj->command = '4100';
			$json_obj->message = 'Delete attach file success.';
		}
		else{
			$json_obj->command = '4102';
			$json_obj->message = 'Data is invalid.';
		}

		$obj_class->closedb();
		return $json_obj;
    }

    //4200 -- OK
	public function set_memo_notice($params) {
		$json_obj = new stdClass();
		$obj_global = new GlobalConstant();		
		$obj_log = new LogFile();		
		$save_data_log = $_SERVER["HTTP_HOST"].$_SERVER["PHP_SELF"];

		$obj_class = new Connectdb($obj_global->getHOST_CMS(), $obj_global->getUSER_CMS() , $obj_global->getPWD_CMS(), "employee",0,FALSE);

		//$params['company_id']
		//$params['employee_code']
		//$params['notice_type_id']
		//$params['notice_status']

		$notice_status = ($params['notice_status'] == 1)?0:1;

		$s_sql_1 = "UPDATE map_emp_notification ";
		$s_sql_1.= "SET men_status = ".$notice_status." , men_modified_date = NOW() ";
		$s_sql_1.= "WHERE com_id_pk = ".$params['company_id']." AND emp_ID = ".$params['employee_code']." AND men_noti_type = ".$params['notice_type_id'];
		$b_flag_1 = $obj_class->manageproc($s_sql_1);
		$obj_log->savelog($save_data_log,"set_memo_notice","sql=[$s_sql_1]");

		if($b_flag_1){
			$json_obj->command = '4200';
			$json_obj->message = 'Set memo_notice success.';
			$json_obj->notice_status = $notice_status;
		}
		else{
			$json_obj->command = '4202';
			$json_obj->message = 'Data is invalid.';
		}

		$obj_class->closedb();
		return $json_obj;
    }

   

    
    
    

	








    
    
    //5000 -- OK
	public function get_sub_type_list($params) {
		$json_obj = new stdClass();
		$obj_global = new GlobalConstant();		
		$obj_log = new LogFile();		
		$save_data_log = $_SERVER["HTTP_HOST"].$_SERVER["PHP_SELF"];

		//$params['advance_form_type'] -- 0 = create advance / 1 = balance / 2 = less than paid / 3 = over paid / 4 = all

		$datas = array();

		if(($params['advance_form_type'] == 1) || ($params['advance_form_type'] == 2)){
			$datas[0]['sub_type_key'] = 'Receive';
			$datas[0]['sub_type_name'] = 'Receive';
		}
		else if($params['advance_form_type'] == 3){
			$datas[0]['sub_type_key'] = 'Over paid';
			$datas[0]['sub_type_name'] = 'Over paid';
		}
		else if($params['advance_form_type'] == 0){
			$datas[0]['sub_type_key'] = 'Approve';
			$datas[0]['sub_type_name'] = 'Approve';
		}
		else if($params['advance_form_type'] == 4){
			$datas[0]['sub_type_key'] = 'Approve';
			$datas[0]['sub_type_name'] = 'Approve';
			$datas[1]['sub_type_key'] = 'Receive';
			$datas[1]['sub_type_name'] = 'Receive';
			$datas[2]['sub_type_key'] = 'Over paid';
			$datas[2]['sub_type_name'] = 'Over paid';
		}

		$json_obj->command = '5000';
		$json_obj->message = 'Get data success.';
		$json_obj->data = $datas;
		
		return $json_obj;
    }

    //5100 -- OK //edit api doc
	public function insert_advance_form($params) {
		$json_obj = new stdClass();
		$obj_global = new GlobalConstant();		
		$obj_log = new LogFile();		
		$save_data_log = $_SERVER["HTTP_HOST"].$_SERVER["PHP_SELF"];

		$obj_class = new Connectdb($obj_global->getHOST_CMS(), $obj_global->getUSER_CMS() , $obj_global->getPWD_CMS(), "memo",0,FALSE);
		$obj_class_1 = new Connectdb($obj_global->getHOST_CMS(), $obj_global->getUSER_CMS() , $obj_global->getPWD_CMS(), "memo",0,FALSE);
		$obj_class_2 = new Connectdb($obj_global->getHOST_CMS(), $obj_global->getUSER_CMS() , $obj_global->getPWD_CMS(), "memo",0,FALSE);
		$obj_class_3 = new Connectdb($obj_global->getHOST_CMS(), $obj_global->getUSER_CMS() , $obj_global->getPWD_CMS(), "memo",0,FALSE);
		$obj_class_4 = new Connectdb($obj_global->getHOST_CMS(), $obj_global->getUSER_CMS() , $obj_global->getPWD_CMS(), "memo",0,FALSE);

		//$params['company_id']
		//$params['employee_id']
		//$params['withdrawal_emp_id']
		//$params['paid_date'] -- วันที่สั่งจ่าย
		//$params['done_date'] -- วันที่เสร็จกิจ
		//$params['total_amount']
		//$params['advance_detail']

		//'{"adv_detail" :[{"objective": "เบิกค่าเดินทางไปปฏิบัติงานต่างจังหวัด", "amount": "2000"},{"objective": "เบิกค่าที่พักไปปฏิบัติงานต่างจังหวัด", "amount": "3000"}]}'
		

		$s_sql = "SELECT * from limit_cash WHERE com_id_pk = ".$params['company_id']." AND lc_end_date > NOW() ";
		$b_resp = $obj_class->selectproc($s_sql);

		if($b_resp && $obj_class->n_row>0) {	
			$limit_amount = $obj_class->getitem("lc_limit_amount");
			$cash_type = ($params['total_amount'] <= $limit_amount)?'Cash':'Transfer';
		}
		else{
			$cash_type = 'Cash';
		}	

		//get now running no
		$s_sql_1 = "SELECT * from advance_NO WHERE com_id_pk = ".$params['company_id']." AND avn_end_date > NOW() ";
		$b_resp_1 = $obj_class_1->selectproc($s_sql_1);

		if($b_resp_1 && $obj_class_1->n_row>0) {	
			$now_running_no = $obj_class_1->getitem("avn_running_no");
			$next_running_no = ((int)$obj_class_1->getitem("avn_running_no"))+1;
			$show_running_no = str_pad($next_running_no, 5, "0", STR_PAD_LEFT);

			$advance_no = $obj_class_1->getitem("avn_key_name").$obj_class_1->getitem("avn_year").'/'.$show_running_no;
			
			
			//update next running no
			$s_sql_2 = "UPDATE advance_NO ";
			$s_sql_2.= "SET avn_running_no = '".$show_running_no."' , avn_modified_date = NOW() ";
			$s_sql_2.= "WHERE avn_id_pk = ".$obj_class_1->getitem("avn_id_pk")." ";
			$b_flag_2 = $obj_class_2->manageproc($s_sql_2);
		}

		$emp_info = $this->get_emp_info_by_emp_id($params['company_id'] , $params['employee_id']);
		$created_emp_com_id = $emp_info[0]['emp_com_id'];
		$created_emp_name = $emp_info[0]['emp_name'];

		$withdrawal_emp_info = $this->get_emp_info_by_emp_id($params['company_id'] , $params['withdrawal_emp_id']);
		$withdrawal_emp_com_id = $withdrawal_emp_info[0]['emp_com_id'];
		$withdrawal_emp_name = $withdrawal_emp_info[0]['emp_name'];
		$withdrawal_emp_pos_initial = $withdrawal_emp_info[0]['emp_pos_initial'];	
		
		if((sizeof($emp_info[0]) > 1) && (sizeof($withdrawal_emp_info[0]) > 1)){
			//insert -> tb advance_form
			$s_sql_3 = "INSERT INTO advance_form (avf_NO , avf_withdrawal_name , avf_withdrawal_ID , avf_cash_type ";
			$s_sql_3.= ", avf_account_payee , avf_withdrawal_pos , avf_paid_date ";
			$s_sql_3.= ", avf_done_date , avf_created_date , avf_modified_date , avf_creator_ID , avst_id_pk , avf_status ";
			$s_sql_3.= ", avf_amount , avf_total_file , avf_created_name , com_id_pk) ";
			$s_sql_3.= "VALUES ('".$advance_no."' , '".$withdrawal_emp_name."' , '".$withdrawal_emp_com_id."' , '".$cash_type."' ";
			$s_sql_3.= ", '".$withdrawal_emp_name."' , '".$withdrawal_emp_pos_initial."' , '".$params['paid_date']."' ";
			$s_sql_3.= ", '".$params['done_date']."' , NOW() , NOW() , '".$created_emp_com_id."' , 1 , 'Wait for Payment' ";
			$s_sql_3.= ", ".$params['total_amount']." , 0 , '".$created_emp_name."' , ".$params['company_id'].") ";
			$b_flag_3 = $obj_class_3->manageproc($s_sql_3);

			$adv_last_id = $this->get_advance_last_id();

			if($b_flag_3){
				$advance_detail = json_decode(str_replace("\\",'',$params['advance_detail']));
				$count_advance_detail = count($advance_detail->adv_detail);
		
				for($i=0;$i<$count_advance_detail;$i++){
					$adv_detail_objective[$i] = $advance_detail->adv_detail[$i]->objective;
					$adv_detail_amount[$i] = $advance_detail->adv_detail[$i]->amount;

					//insert -> tb advance_form_detail
					$s_sql_4 = "INSERT INTO advance_form_detail (avf_id_pk , avfd_objective , avfd_amount ";
					$s_sql_4.= ", avfd_unit , avfd_unit_price , avfd_created_date , avfd_modified_date , com_id_pk , avfd_flag) ";
					$s_sql_4.= "VALUES (".$adv_last_id." , '".$adv_detail_objective[$i]."' , ".$adv_detail_amount[$i]." ";
					$s_sql_4.= ", 1 , ".$adv_detail_amount[$i]." , NOW() , NOW() , ".$params['company_id']." , 1) ";
					$b_flag_4 = $obj_class_4->manageproc($s_sql_4);
				}	

				$datas = array();
				$datas[0]['advance_form_id'] = $adv_last_id;
				$datas[0]['advance_no'] = $advance_no;
				$datas[0]['form_id'] = 3; //advance
				$datas[0]['total_amount'] = $params['total_amount'];
				$datas[0]['current_date'] = date("Y-m-d");
				$datas[0]['withdrawal_emp_id'] = $params['withdrawal_emp_id']; //edit api doc
				$datas[0]['form_format_id'] = 3;
				$datas[0]['form_format_name'] = 'Advance Form';

				$json_obj->command = '5100';
				$json_obj->message = 'Insert advance form success.';
				$json_obj->data = $datas;
			}
			else{
				$json_obj->command = '5103';
				$json_obj->message = 'Insert advance form fail - insert advance_form fail.';
			}
		}
		else{
			$json_obj->command = '5102';
			$json_obj->message = 'Data is invalid.';
		}
		
		$obj_class->closedb();
		return $json_obj;
    }
    
    //5200 -- OK //edit api doc
	public function insert_reimbursement_form($params , $files) {
		$json_obj = new stdClass();
		$obj_global = new GlobalConstant();		
		$obj_log = new LogFile();		
		$save_data_log = $_SERVER["HTTP_HOST"].$_SERVER["PHP_SELF"];

		$obj_class = new Connectdb($obj_global->getHOST_CMS(), $obj_global->getUSER_CMS() , $obj_global->getPWD_CMS(), "memo",0,FALSE);
		$obj_class_1 = new Connectdb($obj_global->getHOST_CMS(), $obj_global->getUSER_CMS() , $obj_global->getPWD_CMS(), "memo",0,FALSE);
		$obj_class_2 = new Connectdb($obj_global->getHOST_CMS(), $obj_global->getUSER_CMS() , $obj_global->getPWD_CMS(), "memo",0,FALSE);
		$obj_class_3 = new Connectdb($obj_global->getHOST_CMS(), $obj_global->getUSER_CMS() , $obj_global->getPWD_CMS(), "memo",0,FALSE);
		$obj_class_4 = new Connectdb($obj_global->getHOST_CMS(), $obj_global->getUSER_CMS() , $obj_global->getPWD_CMS(), "memo",0,FALSE);
		$obj_class_5 = new Connectdb($obj_global->getHOST_CMS(), $obj_global->getUSER_CMS() , $obj_global->getPWD_CMS(), "memo",0,FALSE);

		//$params['company_id']
		//$params['employee_id']
		//$params['withdrawal_emp_id']
		//$params['total_amount']
		//$params['amount']
		//$params['use']
		//$params['return']
		//$params['over']
		//$params['advance_form_type'] -- 1 = balance / 2 = less than paid / 3 = over paid
		//$params['advance_detail']
		//$params['total_file']

		//$params['attach_file_x']

		//'{"adv_detail" :[{"objective": "เบิกค่าเดินทางไปปฏิบัติงานต่างจังหวัด", "unit": "1", "unit_price": "2000", "amount": "2000", "remark": ""},{"objective": "เบิกค่าที่พักไปปฏิบัติงานต่างจังหวัด", "unit": "1", "unit_price": "2000", "amount": "2000", "remark": ""}]}'
		
		

		if($params['advance_form_type'] == 1){
			$advance_form_type = 'Balance';
			$avst_id_pk = 3;
			$avf_status = 'Wait for clear';
		}
		else if($params['advance_form_type'] == 2){
			$advance_form_type = 'Less than paid';
			$avst_id_pk = 3;
			$avf_status = 'Wait for clear';
		}
		else if($params['advance_form_type'] == 3){
			$advance_form_type = 'Over paid';
			$avst_id_pk = 5;
			$avf_status = 'Wait for over paid';
		}

		$s_sql = "SELECT * from limit_cash WHERE com_id_pk = ".$params['company_id']." AND lc_end_date > NOW() ";
		$b_resp = $obj_class->selectproc($s_sql);

		if($b_resp && $obj_class->n_row>0) {	
			$limit_amount = $obj_class->getitem("lc_limit_amount");
			$cash_type = ($params['amount'] <= $limit_amount)?'Cash':'Transfer';
		}
		else{
			$cash_type = 'Cash';
		}

		//get now running no
		$s_sql_1 = "SELECT * from advance_NO WHERE com_id_pk = ".$params['company_id']." AND avn_end_date > NOW() ";
		$b_resp_1 = $obj_class_1->selectproc($s_sql_1);

		if($b_resp_1 && $obj_class_1->n_row>0) {	
			$now_running_no = $obj_class_1->getitem("avn_running_no");
			$next_running_no = ((int)$obj_class_1->getitem("avn_running_no"))+1;
			$show_running_no = str_pad($next_running_no, 5, "0", STR_PAD_LEFT);

			$advance_no = $obj_class_1->getitem("avn_key_name").$obj_class_1->getitem("avn_year").'/'.$show_running_no;

			//update next running no
			$s_sql_2 = "UPDATE advance_NO ";
			$s_sql_2.= "SET avn_running_no = '".$show_running_no."' , avn_modified_date = NOW() ";
			$s_sql_2.= "WHERE avn_id_pk = ".$obj_class_1->getitem("avn_id_pk")." ";
			$b_flag_2 = $obj_class_2->manageproc($s_sql_2);
		}

		$emp_info = $this->get_emp_info_by_emp_id($params['company_id'] , $params['employee_id']);
		$created_emp_com_id = $emp_info[0]['emp_com_id'];
		$created_emp_name = $emp_info[0]['emp_name'];

		$withdrawal_emp_info = $this->get_emp_info_by_emp_id($params['company_id'] , $params['withdrawal_emp_id']);
		$withdrawal_emp_com_id = $withdrawal_emp_info[0]['emp_com_id'];
		$withdrawal_emp_name = $withdrawal_emp_info[0]['emp_name'];
		$withdrawal_emp_pos_initial = $withdrawal_emp_info[0]['emp_pos_initial'];
		
		if((sizeof($emp_info[0]) > 1) && (sizeof($withdrawal_emp_info[0]) > 1)){
			//insert -> tb advance_form
			$s_sql_3 = "INSERT INTO advance_form (avf_NO , avf_withdrawal_name , avf_withdrawal_ID , avf_cash_type ";
			$s_sql_3.= ", avf_account_payee , avf_withdrawal_pos ";
			$s_sql_3.= ", avf_created_date , avf_modified_date , avf_creator_ID , avst_id_pk , avf_status ";
			$s_sql_3.= ", avf_amount , avf_use , avf_return , avf_over ";
			$s_sql_3.= ", avf_type , avf_total_file , avf_created_name , com_id_pk) ";
			$s_sql_3.= "VALUES ('".$advance_no."' , '".$withdrawal_emp_name."' , '".$withdrawal_emp_com_id."' , '".$cash_type."' ";
			$s_sql_3.= ", '".$withdrawal_emp_name."' , '".$withdrawal_emp_pos_initial."' ";
			$s_sql_3.= ", NOW() , NOW() , '".$created_emp_com_id."' , ".$avst_id_pk." , '".$avf_status."' ";
			$s_sql_3.= ", ".$params['amount']." , ".$params['use']." , ".$params['return']." , ".$params['over']." ";
			$s_sql_3.= ", '".$advance_form_type."' , ".$params['total_file']." , '".$created_emp_name."' , ".$params['company_id'].") ";
			$b_flag_3 = $obj_class_3->manageproc($s_sql_3);

			
			$adv_last_id = $this->get_advance_last_id();

			if($b_flag_3){
				$advance_detail = json_decode(str_replace("\\",'',$params['advance_detail']));
				$count_advance_detail = count($advance_detail->adv_detail);

				for($i=0;$i<$count_advance_detail;$i++){
					$adv_detail_objective[$i] = $advance_detail->adv_detail[$i]->objective;
					$adv_detail_unit[$i] = $advance_detail->adv_detail[$i]->unit;
					$adv_detail_unit_price[$i] = $advance_detail->adv_detail[$i]->unit_price;
					$adv_detail_amount[$i] = $advance_detail->adv_detail[$i]->amount;
					$adv_detail_remark[$i] = $advance_detail->adv_detail[$i]->remark;

					//insert -> tb advance_form_detail
					$s_sql_4 = "INSERT INTO advance_form_detail (avf_id_pk , avfd_objective , avfd_amount ";
					$s_sql_4.= ", avfd_unit , avfd_unit_price , avfd_created_date , avfd_modified_date ";
					$s_sql_4.= ", com_id_pk , avfd_remark , avfd_flag) ";
					$s_sql_4.= "VALUES (".$adv_last_id." , '".$adv_detail_objective[$i]."' , ".$adv_detail_amount[$i]." ";
					$s_sql_4.= ", ".$adv_detail_unit[$i]." , ".$adv_detail_unit_price[$i]." , NOW() , NOW() ";
					$s_sql_4.= ", ".$params['company_id']." , '".$adv_detail_remark[$i]."' , 2) ";
					$b_flag_4 = $obj_class_4->manageproc($s_sql_4);
				}

				
				$count_file = count($files);

				if($count_file > 0){
					$path = "../EdC/".$params['company_id']."/advance_attach_file/".$adv_last_id."/";
					$thumb_path = "../EdC/".$params['company_id']."/advance_thumb_attach_file/".$adv_last_id."/";

					if(!(file_exists($path))){
						mkdir($path, 0777, true);
					}
					if(!(file_exists($thumb_path))){
						mkdir($thumb_path, 0777, true);
					}

					for($i=0;$i<$count_file;$i++){
						$j = $i+1;

						$files['attach_file_'.$i] = isset($files['attach_file_'.$i])?$files['attach_file_'.$i]:'';
						
						$file_name = date('Ymd_His_').$j.'_'.$adv_last_id.'.jpg';
						$file_size = $files['attach_file_'.$i]['size'];
						$file_tmp = $files['attach_file_'.$i]['tmp_name'];
						$file_type = $files['attach_file_'.$i]['type'];
						$file_ext = strtolower(end(explode('.',$files['attach_file_'.$i]['name'])));
					
						$expensions = array("jpeg","jpg","png");

						$errors = '{"result_code":1,"result_desc":"success"}';
						if(in_array($file_ext,$expensions) === false){
							$json_obj->command = '5205';
							$json_obj->message = 'Insert reimbursement fail - please choose a JPEG or PNG file.';
						}
						else if($files['attach_file_'.$i]['size'] == 0){
							$json_obj->command = '5206';
							$json_obj->message = 'Insert reimbursement fail - post max file must be exactly 8 MB.';
						}
						else if($files['attach_file_'.$i]['size'] > 2097152){
							$json_obj->command = '5207';
							$json_obj->message = 'Insert reimbursement fail - file size must be exactly 2 MB.';
						}
						else{
							move_uploaded_file($file_tmp , $path.$file_name);
							$this->generate_image_thumbnail($path.$file_name, $thumb_path.$file_name);

							$s_sql_5 = "INSERT INTO advance_attachfile (avf_id_pk , ava_path , ava_created_date , ava_modified_date , com_id_pk) ";
							$s_sql_5.= "VALUES (".$adv_last_id." , '".$file_name."' , NOW() , NOW() , ".$params['company_id'].") ";
							$b_flag_5 = $obj_class_5->manageproc($s_sql_5);

							if($b_flag_5){
								$json_obj->command = '5200';
								$json_obj->message = 'Insert reimbursement form success.';
							}
							else{
								$json_obj->command = '5204';
								$json_obj->message = 'Insert reimbursement form fail - insert advance_attachfile fail.';
							}
						}
					}
				}
				else{
					$json_obj->command = '5200';
					$json_obj->message = 'Insert reimbursement form success.';
				}
				
				if($json_obj->command == '5200'){
					$datas = array();
					$datas[0]['advance_form_id'] = $adv_last_id;
					$datas[0]['advance_no'] = $advance_no;
					$datas[0]['form_id'] = 3; //advance
					$datas[0]['total_amount'] = $params['total_amount'];
					$datas[0]['current_date'] = date("Y-m-d");
					$datas[0]['withdrawal_emp_id'] = $params['withdrawal_emp_id']; //edit api doc
					$datas[0]['form_format_id'] = 3;
					$datas[0]['form_format_name'] = 'Advance Form';

					$json_obj->data = $datas;
				}		
			}
			else{
				$json_obj->command = '5203';
				$json_obj->message = 'Insert reimbursement form fail - insert advance_form fail.';
			}	
		}
		else{
			$json_obj->command = '5202';
			$json_obj->message = 'Data is invalid.';
		}
		
		$obj_class->closedb();
		return $json_obj;
    }

    //5300 -- OK //edit api doc
	public function update_reimbursement_form($params , $files) {
		$json_obj = new stdClass();
		$obj_global = new GlobalConstant();		
		$obj_log = new LogFile();		
		$save_data_log = $_SERVER["HTTP_HOST"].$_SERVER["PHP_SELF"];

		$obj_class = new Connectdb($obj_global->getHOST_CMS(), $obj_global->getUSER_CMS() , $obj_global->getPWD_CMS(), "memo",0,FALSE);
		$obj_class_1 = new Connectdb($obj_global->getHOST_CMS(), $obj_global->getUSER_CMS() , $obj_global->getPWD_CMS(), "memo",0,FALSE);
		$obj_class_2 = new Connectdb($obj_global->getHOST_CMS(), $obj_global->getUSER_CMS() , $obj_global->getPWD_CMS(), "memo",0,FALSE);
		$obj_class_3 = new Connectdb($obj_global->getHOST_CMS(), $obj_global->getUSER_CMS() , $obj_global->getPWD_CMS(), "memo",0,FALSE);
		$obj_class_4 = new Connectdb($obj_global->getHOST_CMS(), $obj_global->getUSER_CMS() , $obj_global->getPWD_CMS(), "memo",0,FALSE);
		$obj_class_5 = new Connectdb($obj_global->getHOST_CMS(), $obj_global->getUSER_CMS() , $obj_global->getPWD_CMS(), "memo",0,FALSE);

		//$params['company_id']
		//$params['employee_id']
		//$params['advance_form_id']
		//$params['advance_no']
		//$params['withdrawal_emp_id']
		//$params['total_amount']
		//$params['amount']
		//$params['use']
		//$params['return']
		//$params['over']
		//$params['advance_form_type'] -- 1 = balance / 2 = less than paid / 3 = over paid
		//$params['advance_detail']
		//$params['total_file']

		//$params['attach_file_x']

		//'{"adv_detail" :[{"advance_detail_id": "1","objective": "เบิกค่าเดินทางไปปฏิบัติงานต่างจังหวัด", "unit": "1", "unit_price": "2000", "amount": "2000", "remark": ""},{"advance_detail_id": "","objective": "เบิกค่าที่พักไปปฏิบัติงานต่างจังหวัด", "unit": "1", "unit_price": "2000", "amount": "2000", "remark": ""}]}'

		if($params['advance_form_type'] == 1){
			$advance_form_type = 'Balance';
			$avst_id_pk = 3;
			$avf_status = 'Wait for clear';
		}
		else if($params['advance_form_type'] == 2){
			$advance_form_type = 'Less than paid';
			$avst_id_pk = 3;
			$avf_status = 'Wait for clear';
		}
		else if($params['advance_form_type'] == 3){
			$advance_form_type = 'Over paid';
			$avst_id_pk = 5;
			$avf_status = 'Wait for over paid';
		}

		$s_sql = "SELECT * from limit_cash WHERE com_id_pk = ".$params['company_id']." AND lc_end_date > NOW() ";
		$b_resp = $obj_class->selectproc($s_sql);

		if($b_resp && $obj_class->n_row>0) {	
			$limit_amount = $obj_class->getitem("lc_limit_amount");
			$cash_type = ($params['amount'] <= $limit_amount)?'Cash':'Transfer';
		}
		else{
			$cash_type = 'Cash';
		}


		$emp_info = $this->get_emp_info_by_emp_id($params['company_id'] , $params['employee_id']);
		$created_emp_com_id = $emp_info[0]['emp_com_id'];
		$created_emp_name = $emp_info[0]['emp_name'];

		$withdrawal_emp_info = $this->get_emp_info_by_emp_id($params['company_id'] , $params['withdrawal_emp_id']);
		$withdrawal_emp_com_id = $withdrawal_emp_info[0]['emp_com_id'];
		$withdrawal_emp_name = $withdrawal_emp_info[0]['emp_name'];
		$withdrawal_emp_pos_initial = $withdrawal_emp_info[0]['emp_pos_initial'];
		
		if((sizeof($emp_info[0]) > 1) && (sizeof($withdrawal_emp_info[0]) > 1)){
			//update advance_form
			$s_sql_3 = "UPDATE advance_form ";
			$s_sql_3.= "SET avf_withdrawal_name = '".$withdrawal_emp_name."' , avf_withdrawal_ID = '".$withdrawal_emp_com_id."' ";
			$s_sql_3.= ", avf_cash_type = '".$cash_type."' , avf_account_payee = '".$withdrawal_emp_name."' ";
			$s_sql_3.= ", avf_withdrawal_pos = '".$withdrawal_emp_pos_initial."' , avf_modified_date = NOW() ";
			$s_sql_3.= ", avst_id_pk = ".$avst_id_pk." , avf_status = '".$avf_status."' ";
			$s_sql_3.= ", avf_use = ".$params['use']." , avf_return = ".$params['return']." ";
			$s_sql_3.= ", avf_over = ".$params['over']." , avf_type = '".$advance_form_type."' , avf_total_file = ".$params['total_file']." ";
			$s_sql_3.= "WHERE com_id_pk = ".$params['company_id']." AND avf_id_pk = ".$params['advance_form_id']." ";
			$b_flag_3 = $obj_class_3->manageproc($s_sql_3);
			
			$adv_last_id = $params['advance_form_id'];

			if($b_flag_3){
				$advance_detail = json_decode(str_replace("\\",'',$params['advance_detail']));
				$count_advance_detail = count($advance_detail->adv_detail);

				for($i=0;$i<$count_advance_detail;$i++){
					$adv_detail_id[$i] = $advance_detail->adv_detail[$i]->advance_detail_id;
					$adv_detail_objective[$i] = $advance_detail->adv_detail[$i]->objective;
					$adv_detail_unit[$i] = $advance_detail->adv_detail[$i]->unit;
					$adv_detail_unit_price[$i] = $advance_detail->adv_detail[$i]->unit_price;
					$adv_detail_amount[$i] = $advance_detail->adv_detail[$i]->amount;
					$adv_detail_remark[$i] = $advance_detail->adv_detail[$i]->remark;

					//insert -> tb advance_form_detail
					$s_sql_4 = "INSERT INTO advance_form_detail (avf_id_pk , avfd_objective , avfd_amount ";
					$s_sql_4.= ", avfd_unit , avfd_unit_price , avfd_created_date , avfd_modified_date ";
					$s_sql_4.= ", com_id_pk , avfd_remark , avfd_flag) ";
					$s_sql_4.= "VALUES (".$adv_last_id." , '".$adv_detail_objective[$i]."' , ".$adv_detail_amount[$i]." ";
					$s_sql_4.= ", ".$adv_detail_unit[$i]." , ".$adv_detail_unit_price[$i]." , NOW() , NOW() ";
					$s_sql_4.= ", ".$params['company_id']." , '".$adv_detail_remark[$i]."' , 2) ";
					$b_flag_4 = $obj_class_4->manageproc($s_sql_4);
				}

				
				$count_file = count($files);

				if($count_file > 0){
					$path = "../EdC/".$params['company_id']."/advance_attach_file/".$adv_last_id."/";
					$thumb_path = "../EdC/".$params['company_id']."/advance_thumb_attach_file/".$adv_last_id."/";

					if(!(file_exists($path))){
						mkdir($path, 0777, true);
					}
					if(!(file_exists($thumb_path))){
						mkdir($thumb_path, 0777, true);
					}

					for($i=0;$i<$count_file;$i++){
						$j = $i+1;

						$files['attach_file_'.$i] = isset($files['attach_file_'.$i])?$files['attach_file_'.$i]:'';
						
						$file_name = date('Ymd_His_').$j.'_'.$adv_last_id.'.jpg';
						$file_size = $files['attach_file_'.$i]['size'];
						$file_tmp = $files['attach_file_'.$i]['tmp_name'];
						$file_type = $files['attach_file_'.$i]['type'];
						$file_ext = strtolower(end(explode('.',$files['attach_file_'.$i]['name'])));
					
						$expensions = array("jpeg","jpg","png");

						$errors = '{"result_code":1,"result_desc":"success"}';
						if(in_array($file_ext,$expensions) === false){
							$json_obj->command = '5305';
							$json_obj->message = 'Update reimbursement fail - please choose a JPEG or PNG file.';
						}
						else if($files['attach_file_'.$i]['size'] == 0){
							$json_obj->command = '5306';
							$json_obj->message = 'Update reimbursement fail - post max file must be exactly 8 MB.';
						}
						else if($files['attach_file_'.$i]['size'] > 2097152){
							$json_obj->command = '5307';
							$json_obj->message = 'Update reimbursement fail - file size must be exactly 2 MB.';
						}
						else{
							move_uploaded_file($file_tmp , $path.$file_name);
							$this->generate_image_thumbnail($path.$file_name, $thumb_path.$file_name);

							$s_sql_5 = "INSERT INTO advance_attachfile (avf_id_pk , ava_path , ava_created_date , ava_modified_date , com_id_pk) ";
							$s_sql_5.= "VALUES (".$adv_last_id." , '".$file_name."' , NOW() , NOW() , ".$params['company_id'].") ";
							$b_flag_5 = $obj_class_5->manageproc($s_sql_5);

							if($b_flag_5){
								$json_obj->command = '5300';
								$json_obj->message = 'Update reimbursement form success.';
							}
							else{
								$json_obj->command = '5304';
								$json_obj->message = 'Update reimbursement form fail - insert advance_attachfile fail.';
							}
						}
					}
				}
				else{
					$json_obj->command = '5300';
					$json_obj->message = 'Update reimbursement form success.';
				}
				
				if($json_obj->command == '5300'){
					$datas = array();
					$datas[0]['advance_form_id'] = $adv_last_id;
					$datas[0]['advance_no'] = $params['advance_no'];
					$datas[0]['form_id'] = 3; //advance
					$datas[0]['total_amount'] = $params['total_amount'];
					$datas[0]['current_date'] = date("Y-m-d");
					$datas[0]['withdrawal_emp_id'] = $params['withdrawal_emp_id']; //edit api doc

					$json_obj->data = $datas;
				}		
			}
			else{
				$json_obj->command = '5303';
				$json_obj->message = 'Update reimbursement form fail - insert advance_form fail.';
			}	
		}
		else{
			$json_obj->command = '5302';
			$json_obj->message = 'Data is invalid.';
		}
		
		$obj_class->closedb();
		return $json_obj;
    }
    
    //5400 -- OK //edit api doc
	public function get_reimbursement_form_detail($params) {
		$json_obj = new stdClass();
		$obj_global = new GlobalConstant();		
		$obj_log = new LogFile();		
		$save_data_log = $_SERVER["HTTP_HOST"].$_SERVER["PHP_SELF"];

		$obj_class = new Connectdb($obj_global->getHOST_CMS(), $obj_global->getUSER_CMS() , $obj_global->getPWD_CMS(), "memo",0,FALSE);
		$obj_class_2 = new Connectdb($obj_global->getHOST_CMS(), $obj_global->getUSER_CMS() , $obj_global->getPWD_CMS(), "memo",0,FALSE);

		//$params['company_id']
		//$params['advance_form_id']

		$s_sql = "SELECT * from advance_form ";
		$s_sql.= "WHERE com_id_pk = ".$params['company_id']." AND avf_id_pk = ".$params['advance_form_id']." ";
		$b_resp = $obj_class->selectproc($s_sql);
		$obj_log->savelog($save_data_log,"get_reimbursement_form_detail","sql=[$s_sql]");
		$datas = array();

		if($b_resp && $obj_class->n_row>0) {
			$creator_emp_info = $this->get_emp_info_by_emp_com_id($params['company_id'] , $obj_class->getitem("avf_creator_ID"));
			$withdrawal_emp_info = $this->get_emp_info_by_emp_com_id($params['company_id'] , $obj_class->getitem("avf_withdrawal_ID"));

			$datas[0]['advance_no'] = $obj_class->getitem("avf_NO");	
			$datas[0]['creator_emp_name'] = $obj_class->getitem("avf_created_name");
			$datas[0]['creator_emp_id'] = $creator_emp_info[0]['emp_id'];
			$datas[0]['creator_emp_com_id'] = $obj_class->getitem("avf_creator_ID");
			$datas[0]['creator_position'] = $creator_emp_info[0]['emp_position'];
			$datas[0]['creator_department_name'] = $creator_emp_info[0]['emp_dp_name'];
			$datas[0]['withdrawal_emp_name'] = $obj_class->getitem("avf_withdrawal_name");
			$datas[0]['withdrawal_emp_id'] = $withdrawal_emp_info[0]['emp_id'];
			$datas[0]['withdrawal_emp_com_id'] = $obj_class->getitem("avf_withdrawal_ID");
			$datas[0]['withdrawal_position'] = $obj_class->getitem("avf_withdrawal_pos");
			$datas[0]['withdrawal_department_name'] = $withdrawal_emp_info[0]['emp_dp_name'];
			$datas[0]['amount'] = ($obj_class->getitem("avf_amount"))?$obj_class->getitem("avf_amount"):0;
			$datas[0]['use'] = ($obj_class->getitem("avf_use"))?$obj_class->getitem("avf_use"):0;
			$datas[0]['return'] = ($obj_class->getitem("avf_return"))?$obj_class->getitem("avf_return"):0;
			$datas[0]['over'] = ($obj_class->getitem("avf_over"))?$obj_class->getitem("avf_over"):0;


			$s_sql_2 = "SELECT * from advance_form_detail ";
			$s_sql_2.= "WHERE com_id_pk = ".$params['company_id']." AND avf_id_pk = ".$params['advance_form_id']." ";
			$s_sql_2.= "ORDER BY avfd_id_pk ASC ";
			$b_resp_2 = $obj_class_2->selectproc($s_sql_2);
			$details = array();

			if($b_resp_2 && $obj_class_2->n_row>0) {
				for($i=0;$i<$obj_class_2->n_row;$i++){
					$details[$i]['advance_detail_id'] = $obj_class_2->getitem("avfd_id_pk");
					$details[$i]['objective'] = $obj_class_2->getitem("avfd_objective");
					$details[$i]['unit'] = $obj_class_2->getitem("avfd_unit");
					$details[$i]['unit_pric'] = $obj_class_2->getitem("avfd_unit_price");
					$details[$i]['amount'] = ($obj_class_2->getitem("avfd_amount"))?$obj_class_2->getitem("avfd_amount"):0;
					$details[$i]['remark'] = ($obj_class_2->getitem("avfd_remark"))?$obj_class_2->getitem("avfd_remark"):'';

					$obj_class_2->movenext();
				}
			}

			$json_obj->command = '5400';
			$json_obj->message = 'Get data success.';
			$json_obj->data = $datas;
			//$json_obj->detail = $details;	
		}
		else{
			$json_obj->command = '5402';
			$json_obj->message = 'Data not found.';
		}
		
		$obj_class->closedb();
		return $json_obj;
    }



    //5500 -- OK
    public function confirm_payment($params) {
		$json_obj = new stdClass();
		$obj_global = new GlobalConstant();		
		$obj_log = new LogFile();		
		$save_data_log = $_SERVER["HTTP_HOST"].$_SERVER["PHP_SELF"];

		$obj_class = new Connectdb($obj_global->getHOST_CMS(), $obj_global->getUSER_CMS() , $obj_global->getPWD_CMS(), "memo",0,FALSE);

		//$params['company_id']
		//$params['employee_id']
		//$params['advance_form_id']
		//$params['advance_status_id'] -- 1 = Wait for Payment , 3 = Wait for Clear , 5 = Wait for Over paid
		//$params['use']
		//$params['return']
		//$params['over']
		//$params['comment']

		$emp_info = $this->get_emp_info_by_emp_id($params['company_id'] , $params['employee_id']);

		if($params['advance_status_id'] == 1){
			$avst_id_pk = 2;
			$avf_status = 'Payment';
		}
		else if($params['advance_status_id'] == 3){
			$avst_id_pk = 4;
			$avf_status = 'Receive';
		}
		else if($params['advance_status_id'] == 5){
			$avst_id_pk = 6;
			$avf_status = 'Pay over paid';
		}

		//update advance_form
		$s_sql = "UPDATE advance_form ";
		$s_sql.= "SET avf_payment_date = NOW() , avf_modified_date = NOW() , avst_id_pk = ".$avst_id_pk." , avf_status = '".$avf_status."' ";

		if(($params['advance_status_id'] == 3) || ($params['advance_status_id'] == 5)){
			$s_sql.= ", avf_use = ".$params['use']." , avf_return = ".$params['return']." , avf_over = ".$params['over']." ";
		}

		//update date
		if($params['advance_status_id'] == 1){
			$s_sql.= ", avf_payment_date = NOW() ";
		}
		else if($params['advance_status_id'] == 3){
			$s_sql.= ", avf_received_approve_date = NOW() ";
		}
		else if($params['advance_status_id'] == 5){
			$s_sql.= ", avf_over_paid_date = NOW() ";
		}

		$s_sql.= "WHERE avf_id_pk = ".$params['advance_form_id']." ";
		$b_flag = $obj_class->manageproc($s_sql);
		$obj_log->savelog($save_data_log,"confirm_payment","sql=[$s_sql]");

		if($b_flag) { 
			//insert -> tb advance_history
			$s_sql_2 = "INSERT INTO advance_history (avf_id_pk , avh_emp_ID ";
			$s_sql_2.= ", avh_emp_name , avh_pos , avh_type , avh_created_date , avh_remark) ";
			$s_sql_2.= "VALUES (".$params['advance_form_id']." , '".$emp_info[0]['emp_com_id']."' ";
			$s_sql_2.= ", '".$emp_info[0]['emp_name']."' , '".$emp_info[0]['emp_pos_initial']."' , '".$avf_status."' , NOW() , '".$params['comment']."')";
			$b_flag_2 = $obj_class->manageproc($s_sql_2);

			if($b_flag_2){
				$json_obj->command = '5500';
				$json_obj->message = 'Confirm payment success.';
				$json_obj->data = $datas;
			}
			else{
				$json_obj->command = '5503';
				$json_obj->message = 'Confirm payment fail - insert advance_history fail.';
			}
		}
		else{
			$json_obj->command = '5502';
			$json_obj->message = 'Confirm payment fail - update advance_form fail.';
		}
		
		$obj_class->closedb();
		return $json_obj;
    }
    
    //5600 -- OK
	public function get_cashier_list($params) {
		$json_obj = new stdClass();
		$obj_global = new GlobalConstant();		
		$obj_log = new LogFile();		
		$save_data_log = $_SERVER["HTTP_HOST"].$_SERVER["PHP_SELF"];

		$obj_class = new Connectdb($obj_global->getHOST_CMS(), $obj_global->getUSER_CMS() , $obj_global->getPWD_CMS(), "memo",0,FALSE);

		//$params['company_id']
		//$params['employee_id']

		//$params['advance_key'] (advance_NO , memo_subject)
		//$params['sub_type']
		//$params['advance_status_id']

		$params['advance_key'] = (isset($params['advance_key']) && ($params['advance_key'] != ''))?$params['advance_key']:'';
		$params['sub_type'] = (isset($params['sub_type']) && ($params['sub_type'] != ''))?$params['sub_type']:'';
		$params['advance_status_id'] = (isset($params['advance_status_id']) && ($params['advance_status_id'] != ''))?$params['advance_status_id']:'';

		$emp_info = $this->get_emp_info_by_emp_id($params['company_id'] , $params['employee_id']);

		$s_sql = "SELECT mm.* , avf.avst_id_pk , avf.avf_status , avf.avf_modified_date , avf.avf_withdrawal_name ";
		$s_sql.= "from memo mm LEFT JOIN advance_form avf ON mm.avf_id_pk = avf.avf_id_pk ";
		$s_sql.= "WHERE mm.com_id_pk = ".$params['company_id']." AND mm.mf_id_pk = 3 AND mm.mst_id_pk = 4 ";
		$s_sql.= "AND mm.mm_advancefromNO IS NOT NULL AND mm.mm_confirm_payment_emp_ID = '".$emp_info[0]['emp_com_id']."' ";
		$s_sql.= "AND (((avf.avst_id_pk = 1) && (avf.avf_approve_date IS NOT NULL)) ";
		$s_sql.= "|| ((avf.avst_id_pk = 3) && (avf.avf_cleared_approve_date IS NOT NULL)) ";

		$s_sql.= "|| (avf.avst_id_pk = 2) || (avf.avst_id_pk = 4) || (avf.avst_id_pk = 6) ";

		$s_sql.= "|| ((avf.avst_id_pk = 5) && (avf.avf_over_paid_approve_date IS NOT NULL))) ";

		if($params['advance_key'] != ''){
			$s_sql.= "AND (mm.mm_advancefromNO LIKE '%".$params['advance_key']."%' OR mm.mm_subject LIKE '%".$params['advance_key']."%') ";
		}
		if($params['sub_type'] != ''){
			$s_sql.= "AND mm.mm_sub_type_ad LIKE '%".$params['sub_type']."%' ";
		}
		if($params['advance_status_id'] != ''){
			$s_sql.= "AND avf.avst_id_pk = ".$params['advance_status_id']." ";
		}
		else{
			$s_sql.= "AND avf.avst_id_pk IN (1,3,5) ";
		}

		$s_sql.= "ORDER BY mm.mm_issue_date DESC";

		$b_resp = $obj_class->selectproc($s_sql);
		$obj_log->savelog($save_data_log,"get_cashier_list","sql=[$s_sql]");
		$datas = array();

		if($b_resp && $obj_class->n_row>0) {
			for($i=0;$i<$obj_class->n_row;$i++){	

				$today = date_create(date("Y-m-d H:i:s"));
				$modified_date = date_create($obj_class->getitem("avf_modified_date"));

				$diff_day = date_diff($today,$modified_date)->format("%d");
				$diff_hour = date_diff($today,$modified_date)->format("%h");
				$diff_minute = date_diff($today,$modified_date)->format("%i");
				
				$modified_time = strtotime($obj_class->getitem("avf_modified_date"));   
				$now = strtotime(date("Y-m-d H:i:s"));

				if($diff_day == 0) { 
					if($diff_hour > 0){
						$last_update = $diff_hour.' ชั่วโมง '.$diff_minute.' นาที';
					}
					else{
						$last_update = $diff_minute.' นาที';
					}
				}
				else{
					$last_update = $diff_day.' วัน';
				}


				$datas[$i]['memo_id'] = $obj_class->getitem("mm_id_pk");
				$datas[$i]['advance_form_id'] = $obj_class->getitem("avf_id_pk");
				$datas[$i]['advance_no'] = $obj_class->getitem("mm_advancefromNO");
				$datas[$i]['memo_subject'] = $obj_class->getitem("mm_subject");
				$datas[$i]['advance_status_id'] = $obj_class->getitem("avst_id_pk");
				$datas[$i]['advance_status_name'] = $obj_class->getitem("avf_status");
				$datas[$i]['memo_status_name'] = $obj_class->getitem("mm_status");
				
				// $datas[$i]['memo_issue_time'] = date("H:i", strtotime($obj_class->getitem("mm_issue_date")));
				// $datas[$i]['memo_issue_day'] = date("d", strtotime($obj_class->getitem("mm_issue_date")));
				// $datas[$i]['memo_issue_month_year'] = date("M Y", strtotime($obj_class->getitem("mm_issue_date")));


				if(($obj_class->getitem("avst_id_pk") == 1) || ($obj_class->getitem("avst_id_pk") == 2)){ //Wait for Payment or Payment
					$datas[$i]['memo_issue_time'] = date("H:i", strtotime($obj_class->getitem("avf_approve_date")));
					$datas[$i]['memo_issue_day'] = date("d", strtotime($obj_class->getitem("avf_approve_date")));
					$datas[$i]['memo_issue_month_year'] = date("M Y", strtotime($obj_class->getitem("avf_approve_date")));
				}
				else if(($obj_class->getitem("avst_id_pk") == 3) || ($obj_class->getitem("avst_id_pk") == 4)){ //Wait for Clear or Clear
					$datas[$i]['memo_issue_time'] = date("H:i", strtotime($obj_class->getitem("avf_cleared_approve_date")));
					$datas[$i]['memo_issue_day'] = date("d", strtotime($obj_class->getitem("avf_cleared_approve_date")));
					$datas[$i]['memo_issue_month_year'] = date("M Y", strtotime($obj_class->getitem("avf_cleared_approve_date")));
				}
				else if(($obj_class->getitem("avst_id_pk") == 5) || ($obj_class->getitem("avst_id_pk") == 6)){ //Wait for Over paid or Pay over paid
					$datas[$i]['memo_issue_time'] = date("H:i", strtotime($obj_class->getitem("avf_over_paid_approve_date")));
					$datas[$i]['memo_issue_day'] = date("d", strtotime($obj_class->getitem("avf_over_paid_approve_date")));
					$datas[$i]['memo_issue_month_year'] = date("M Y", strtotime($obj_class->getitem("avf_over_paid_approve_date")));
				}
				
				$datas[$i]['advance_modified_time'] = date("H:i", strtotime($obj_class->getitem("avf_modified_date")));
				$datas[$i]['advance_modified_day'] = date("d", strtotime($obj_class->getitem("avf_modified_date")));
				$datas[$i]['advance_modified_month_year'] = date("M Y", strtotime($obj_class->getitem("avf_modified_date")));
				
				$datas[$i]['advance_last_update'] = $last_update;

				$datas[$i]['withdrawal_name'] = "ผู้เบิก ".$obj_class->getitem("avf_withdrawal_name");
				$datas[$i]['confirm_payment_name'] = "บัญชี ".$obj_class->getitem("mm_confirm_payment");

			    $obj_class->movenext();
			}

			$json_obj->command = '5600';
			$json_obj->message = 'Get data success.';
			$json_obj->data = $datas;
		}
		else {
			$json_obj->command = '5602';
			$json_obj->message = 'Data not found.';
		} 
		
		$obj_class->closedb();
		return $json_obj;
    }

    //5700 -- OK
	public function get_cashier_detail($params) {
		$json_obj = new stdClass();
		$obj_global = new GlobalConstant();		
		$obj_log = new LogFile();		
		$save_data_log = $_SERVER["HTTP_HOST"].$_SERVER["PHP_SELF"];

		$obj_class = new Connectdb($obj_global->getHOST_CMS(), $obj_global->getUSER_CMS() , $obj_global->getPWD_CMS(), "memo",0,FALSE);

		//$params['company_id']
		//$params['memo_id']

		$s_sql = "SELECT mm.* , avf.* from memo mm ";
		$s_sql.= "LEFT JOIN advance_form avf ON mm.avf_id_pk = avf.avf_id_pk ";
		$s_sql.= "WHERE mm.com_id_pk = ".$params['company_id']." AND mm.mf_id_pk = 3 AND mm.mst_id_pk = 4 ";
		$s_sql.= "AND mm.mm_id_pk = ".$params['memo_id']." ";

		$b_resp = $obj_class->selectproc($s_sql);
		$obj_log->savelog($save_data_log,"get_cashier_detail","sql=[$s_sql]");
		$datas = array();

		if($b_resp && $obj_class->n_row>0) { 
			$emp_info = $this->get_emp_info_by_emp_com_id($params['company_id'] , $obj_class->getitem("avf_withdrawal_ID"));

			$datas[0]['memo_id'] = $obj_class->getitem("mm_id_pk");
			$datas[0]['advance_form_id'] = $obj_class->getitem("avf_id_pk");
			$datas[0]['withdrawal_name'] = $obj_class->getitem("avf_withdrawal_name");
			$datas[0]['withdrawal_emp_com_id'] = $obj_class->getitem("avf_withdrawal_ID");
			$datas[0]['department_name'] = $emp_info[0]['emp_dp_name'];
			$datas[0]['amount'] = $obj_class->getitem("avf_amount");
			$datas[0]['advance_no'] = $obj_class->getitem("mm_advancefromNO");
			$datas[0]['memo_no'] = $obj_class->getitem("mm_NO");
			$datas[0]['advance_status_id'] = $obj_class->getitem("avst_id_pk"); //(edit doc)
			$datas[0]['advance_status_name'] = $obj_class->getitem("avf_status");;

			$datas[0]['use'] = ($obj_class->getitem("avf_use"))?$obj_class->getitem("avf_use"):'';
			$datas[0]['return'] = ($obj_class->getitem("avf_return"))?$obj_class->getitem("avf_return"):'';
			$datas[0]['over'] = ($obj_class->getitem("avf_over"))?$obj_class->getitem("avf_over"):'';

			$json_obj->command = '5700';
			$json_obj->message = 'Get data success.';
			$json_obj->data = $datas;
		}
		else{
			$json_obj->command = '5702';
			$json_obj->message = 'Data not found.';
		}
		
		$obj_class->closedb();
		return $json_obj;
    }

    //5800 -- OK 
	public function get_cashier_history($params) {
		$json_obj = new stdClass();
		$obj_global = new GlobalConstant();		
		$obj_log = new LogFile();		
		$save_data_log = $_SERVER["HTTP_HOST"].$_SERVER["PHP_SELF"];

		$obj_class = new Connectdb($obj_global->getHOST_CMS(), $obj_global->getUSER_CMS() , $obj_global->getPWD_CMS(), "memo",0,FALSE);
		
		//$params['advance_form_id']

		$s_sql = "SELECT avh.* , mm.mm_issue_date from memo mm ";
		$s_sql.= "LEFT JOIN advance_form avf ON mm.avf_id_pk = avf.avf_id_pk ";
		$s_sql.= "LEFT JOIN advance_history avh ON avf.avf_id_pk = avh.avf_id_pk ";
		$s_sql.= "WHERE avh.avf_id_pk = ".$params['advance_form_id']." AND avh.avh_type NOT LIKE '%Wait for%' "; 
		$s_sql.= "ORDER BY avh.avh_created_date ASC";

		$b_resp = $obj_class->selectproc($s_sql);
		$obj_log->savelog($save_data_log,"get_cashier_history","sql=[$s_sql]");
		$datas = array();

		if($b_resp && $obj_class->n_row>0) { 
			for($i=0;$i<$obj_class->n_row;$i++){
				$datas[$i]['avf_id_pk'] = $obj_class->getitem("avf_id_pk");
				$datas[$i]['emp_com_id'] = $obj_class->getitem("avh_emp_ID");
				$datas[$i]['emp_name'] = $obj_class->getitem("avh_emp_name");
				$datas[$i]['emp_pos_initial'] = $obj_class->getitem("avh_pos");
				$datas[$i]['advance_status'] = $obj_class->getitem("avh_type");

				$datas[$i]['memo_issue_time'] = date("H:i", strtotime($obj_class->getitem("mm_issue_date"))); 
				$datas[$i]['memo_issue_day'] = date("d", strtotime($obj_class->getitem("mm_issue_date")));
				$datas[$i]['memo_issue_month_year'] = date("M Y", strtotime($obj_class->getitem("mm_issue_date")));
				
				$datas[$i]['avh_created_time'] = date("H:i", strtotime($obj_class->getitem("avh_created_date")));
				$datas[$i]['avh_created_day'] = date("d", strtotime($obj_class->getitem("avh_created_date")));
				$datas[$i]['avh_advance_month_year'] = date("M Y", strtotime($obj_class->getitem("avh_created_date")));

				$datas[$i]['remark'] = ($obj_class->getitem("avh_remark"))?$obj_class->getitem("avh_remark"):'';
								
				$obj_class->movenext();
			}

			$json_obj->command = '5800';
			$json_obj->message = 'Get data success.';
			$json_obj->data = $datas;
		}
		else{
			$json_obj->command = '5802';
			$json_obj->message = 'Data not found.';
		}

		$obj_class->closedb();
		return $json_obj;
    }





    //6000 -- OK
    public function get_cash_advance_list($params) {
		$json_obj = new stdClass();
		$obj_global = new GlobalConstant();		
		$obj_log = new LogFile();		
		$save_data_log = $_SERVER["HTTP_HOST"].$_SERVER["PHP_SELF"];

		$obj_class = new Connectdb($obj_global->getHOST_CMS(), $obj_global->getUSER_CMS() , $obj_global->getPWD_CMS(), "memo",0,FALSE);
		$obj_class_2 = new Connectdb($obj_global->getHOST_CMS(), $obj_global->getUSER_CMS() , $obj_global->getPWD_CMS(), "memo",0,FALSE);

		//$params['company_id']
		//$params['employee_id']

		//$params['division_id']
		//$params['department_id']
		//$params['section_id']
		//$params['advance_key'] (advance_NO , memo_subject)
		//$params['sub_type']
		//$params['advance_status_id']

		$params['division_id'] = (isset($params['division_id']) && ($params['division_id'] != ''))?$params['division_id']:'';
		$params['department_id'] = (isset($params['department_id']) && ($params['department_id'] != ''))?$params['department_id']:'';
		$params['section_id'] = (isset($params['section_id']) && ($params['section_id'] != ''))?$params['section_id']:'';
		$params['advance_key'] = (isset($params['advance_key']) && ($params['advance_key'] != ''))?$params['advance_key']:'';
		$params['sub_type'] = (isset($params['sub_type']) && ($params['sub_type'] != ''))?$params['sub_type']:'';
		$params['advance_status_id'] = (isset($params['advance_status_id']) && ($params['advance_status_id'] != ''))?$params['advance_status_id']:'';

		$emp_info = $this->get_emp_info_by_emp_id($params['company_id'] , $params['employee_id']);
	

		if(($emp_info[0]['emp_dv_id'] == 0) && ($emp_info[0]['emp_dp_id'] == 0) && ($emp_info[0]['emp_st_id'] == 0)){ //ceo
			$s_sql = "SELECT mm.* , avf.* from memo.memo mm ";
			$s_sql.= "LEFT JOIN memo.advance_form avf ON mm.avf_id_pk = avf.avf_id_pk ";
			$s_sql.= "LEFT JOIN employee.employee emp ON mm.emp_id_pk = emp.emp_id_pk ";
			$s_sql.= "WHERE mm.com_id_pk = ".$params['company_id']." AND mm.mf_id_pk = 3 ";
			$s_sql.= "AND mm.mm_advancefromNO IS NOT NULL ";
			$s_sql.= "AND ((mm.mm_confirm_payment_emp_ID = '".$emp_info[0]['emp_com_id']."') ";
			$s_sql.= "OR (avf.avf_withdrawal_ID = '".$emp_info[0]['emp_com_id']."')) ";

			if($params['division_id'] != ''){
				$s_sql.= "AND emp.dv_id_pk = ".$params['division_id']." ";
			}
			if($params['department_id'] != ''){
				$s_sql.= "AND emp.dp_id_pk = ".$params['department_id']." ";
			}
			if($params['section_id'] != ''){
				$s_sql.= "AND emp.st_id_pk = ".$params['section_id']." ";
			}

			if($params['advance_key'] != ''){
				$s_sql.= "AND (mm.mm_advancefromNO LIKE '%".$params['advance_key']."%' OR mm.mm_subject LIKE '%".$params['advance_key']."%') ";
			}
			if($params['sub_type'] != ''){
				$s_sql.= "AND mm.mm_sub_type_ad LIKE '%".$params['sub_type']."%' ";
			}
			if($params['advance_status_id'] != ''){
				$s_sql.= "AND avf.avst_id_pk = ".$params['advance_status_id']." ";
			}

			$s_sql.= "ORDER BY mm.mm_modified_date DESC";
		}
		else if(($emp_info[0]['emp_dv_id'] != 0) && ($emp_info[0]['emp_dp_id'] == 0) && ($emp_info[0]['emp_st_id'] == 0)){ //manager
			$s_sql = "SELECT mm.* , avf.* from memo.memo mm ";
			$s_sql.= "LEFT JOIN memo.advance_form avf ON mm.avf_id_pk = avf.avf_id_pk ";
			$s_sql.= "LEFT JOIN employee.employee emp ON mm.emp_id_pk = emp.emp_id_pk ";
			$s_sql.= "WHERE mm.com_id_pk = ".$params['company_id']." AND mm.mf_id_pk = 3 ";
			$s_sql.= "AND mm.mm_advancefromNO IS NOT NULL ";
			$s_sql.= "AND ((mm.mm_confirm_payment_emp_ID = '".$emp_info[0]['emp_com_id']."') ";
			$s_sql.= "OR (avf.avf_withdrawal_ID = '".$emp_info[0]['emp_com_id']."') ";
			$s_sql.= "OR (emp.dv_id_pk = ".$emp_info[0]['emp_dv_id'].")) ";
			$s_sql.= "AND emp.emp_level >= '".$emp_info[0]['emp_level']."' ";		
			
			if($params['department_id'] != ''){
				$s_sql.= "AND emp.dp_id_pk = ".$params['department_id']." ";
			}
			if($params['section_id'] != ''){
				$s_sql.= "AND emp.st_id_pk = ".$params['section_id']." ";
			}

			if($params['advance_key'] != ''){
				$s_sql.= "AND (mm.mm_advancefromNO LIKE '%".$params['advance_key']."%' OR mm.mm_subject LIKE '%".$params['advance_key']."%') ";
			}
			if($params['sub_type'] != ''){
				$s_sql.= "AND mm.mm_sub_type_ad LIKE '%".$params['sub_type']."%' ";
			}
			if($params['advance_status_id'] != ''){
				$s_sql.= "AND avf.avst_id_pk = ".$params['advance_status_id']." ";
			}

			$s_sql.= "ORDER BY mm.mm_modified_date DESC";
		}
		else{
			//get min level
			$s_sql_2 = "SELECT emp_level from employee WHERE com_id_pk = ".$params['company_id']." AND dv_id_pk = ".$params['division_id']." AND dp_id_pk = ".$params['department_id']." AND st_id_pk = ".$params['section_id']." ORDER BY emp_level DESC LIMIT 1 ";
			$b_resp_2 = $obj_class_2->selectproc($s_sql_2);

			$is_min_level = false;

			if($b_resp_2 && $obj_class_2->n_row>0) {
				if($obj_class_2->getitem("emp_level") != $emp_info[0]['emp_level']){
					$is_min_level = true;
				}
			}


			$s_sql = "SELECT mm.* , avf.* from memo.memo mm ";
			$s_sql.= "LEFT JOIN memo.advance_form avf ON mm.avf_id_pk = avf.avf_id_pk ";
			$s_sql.= "LEFT JOIN employee.employee emp ON mm.emp_id_pk = emp.emp_id_pk ";
			$s_sql.= "WHERE mm.com_id_pk = ".$params['company_id']." AND mm.mf_id_pk = 3 ";
			$s_sql.= "AND mm.mm_advancefromNO IS NOT NULL ";
			$s_sql.= "AND ((mm.mm_confirm_payment_emp_ID = '".$emp_info[0]['emp_com_id']."') ";
			$s_sql.= "OR (avf.avf_withdrawal_ID = '".$emp_info[0]['emp_com_id']."') ";

			if($is_min_level) {
				//create by division or department
				$s_sql.= "OR emp.dv_id_pk = ".$emp_info[0]['emp_dv_id']." ";
				$s_sql.= "OR emp.dp_id_pk = ".$emp_info[0]['emp_dp_id']." ";
			}

			$s_sql.= ") ";


			if($is_min_level) {
				$s_sql.= "AND emp.emp_level >= '".$emp_info[0]['emp_level']."' ";
			}

			if($params['section_id'] != ''){
				$s_sql.= "AND emp.st_id_pk = ".$params['section_id']." ";
			}

			if($params['advance_key'] != ''){
				$s_sql.= "AND (mm.mm_advancefromNO LIKE '%".$params['advance_key']."%' OR mm.mm_subject LIKE '%".$params['advance_key']."%') ";
			}
			if($params['sub_type'] != ''){
				$s_sql.= "AND mm.mm_sub_type_ad LIKE '%".$params['sub_type']."%' ";
			}
			if($params['advance_status_id'] != ''){
				$s_sql.= "AND avf.avst_id_pk = ".$params['advance_status_id']." ";
			}

			$s_sql.= "ORDER BY mm.mm_modified_date DESC";
		}

		$b_resp = $obj_class->selectproc($s_sql);
		$obj_log->savelog($save_data_log,"get_cash_advance_list","sql=[$s_sql]");
		$datas = array();

		if($b_resp && $obj_class->n_row>0) {
			for($i=0;$i<$obj_class->n_row;$i++){	
				$datas[$i]['memo_id'] = $obj_class->getitem("mm_id_pk");
				$datas[$i]['advance_form_id'] = $obj_class->getitem("avf_id_pk");
				$datas[$i]['advance_no'] = $obj_class->getitem("avf_NO");
				$datas[$i]['withdrawal_emp_com_id'] = $obj_class->getitem("avf_withdrawal_ID");
				$datas[$i]['memo_subject'] = $obj_class->getitem("mm_subject");
				$datas[$i]['memo_status_id'] = $obj_class->getitem("mst_id_pk");
				$datas[$i]['advance_status_id'] = $obj_class->getitem("avst_id_pk");
				$datas[$i]['advance_status_name'] = $obj_class->getitem("avf_status");

				if(($obj_class->getitem("avst_id_pk") == 1) || ($obj_class->getitem("avst_id_pk") == 2)){ //Wait for Payment or Payment
					$datas[$i]['advance_approve_time'] = date("H:i", strtotime($obj_class->getitem("avf_approve_date")));
					$datas[$i]['advance_approve_day'] = date("d", strtotime($obj_class->getitem("avf_approve_date")));
					$datas[$i]['advance_approve_month_year'] = date("M Y", strtotime($obj_class->getitem("avf_approve_date")));
				}
				else if(($obj_class->getitem("avst_id_pk") == 3) || ($obj_class->getitem("avst_id_pk") == 4)){ //Wait for Clear or Clear
					$datas[$i]['advance_approve_time'] = date("H:i", strtotime($obj_class->getitem("avf_cleared_approve_date")));
					$datas[$i]['advance_approve_day'] = date("d", strtotime($obj_class->getitem("avf_cleared_approve_date")));
					$datas[$i]['advance_approve_month_year'] = date("M Y", strtotime($obj_class->getitem("avf_cleared_approve_date")));
				}
				else if(($obj_class->getitem("avst_id_pk") == 5) || ($obj_class->getitem("avst_id_pk") == 6)){ //Wait for Over paid or Pay over paid
					$datas[$i]['advance_approve_time'] = date("H:i", strtotime($obj_class->getitem("avf_over_paid_approve_date")));
					$datas[$i]['advance_approve_day'] = date("d", strtotime($obj_class->getitem("avf_over_paid_approve_date")));
					$datas[$i]['advance_approve_month_year'] = date("M Y", strtotime($obj_class->getitem("avf_over_paid_approve_date")));
				}
					
				$datas[$i]['advance_modified_time'] = date("H:i", strtotime($obj_class->getitem("avf_modified_date")));
				$datas[$i]['advance_modified_day'] = date("d", strtotime($obj_class->getitem("avf_modified_date")));
				$datas[$i]['advance_modified_month_year'] = date("M Y", strtotime($obj_class->getitem("avf_modified_date")));

				$datas[$i]['withdrawal_name'] = "ผู้เบิก ".$obj_class->getitem("avf_withdrawal_name");
				$datas[$i]['confirm_payment_name'] = "บัญชี ".$obj_class->getitem("mm_confirm_payment");

			    $obj_class->movenext();
			}

			$json_obj->command = '6000';
			$json_obj->message = 'Get data success.';
			$json_obj->data = $datas;
		}
		else {
			$json_obj->command = '6002';
			$json_obj->message = 'Data not found.';
		} 
		
		//$json_obj->s_sql = $s_sql;
		
		$obj_class->closedb();
		return $json_obj;
    }

    //6100 -- OK 
	public function get_cash_advance_detail($params) {
		$json_obj = new stdClass();
		$obj_global = new GlobalConstant();		
		$obj_log = new LogFile();		
		$save_data_log = $_SERVER["HTTP_HOST"].$_SERVER["PHP_SELF"];

		$obj_class = new Connectdb($obj_global->getHOST_CMS(), $obj_global->getUSER_CMS() , $obj_global->getPWD_CMS(), "memo",0,FALSE);
		$obj_class_2 = new Connectdb($obj_global->getHOST_CMS(), $obj_global->getUSER_CMS() , $obj_global->getPWD_CMS(), "memo",0,FALSE);

		//$params['company_id']
		//$params['memo_id']

		$s_sql = "SELECT mm.* , avf.* from memo mm ";
		$s_sql.= "LEFT JOIN advance_form avf ON mm.avf_id_pk = avf.avf_id_pk ";
		$s_sql.= "WHERE mm.com_id_pk = ".$params['company_id']." AND mm.mf_id_pk = 3 ";
		$s_sql.= "AND mm.mm_id_pk = ".$params['memo_id']." ";

		$b_resp = $obj_class->selectproc($s_sql);
		$obj_log->savelog($save_data_log,"get_cash_advance_detail","sql=[$s_sql]");
		$datas = array();

		if($b_resp && $obj_class->n_row>0) { 
			$emp_info = $this->get_emp_info_by_emp_com_id($params['company_id'] , $obj_class->getitem("avf_withdrawal_ID"));

			if(strtolower($obj_class->getitem("avf_cash_type")) == 'cash'){
				$cash_type_display = 'Cash receive / ขอรับเป็นเงินสด';
			}
			else if(strtolower($obj_class->getitem("avf_cash_type")) == 'transfer'){
				$cash_type_display = 'Transfer receive / โอนเงินเข้าบัญชี';
			}

			$datas[0]['memo_id'] = $obj_class->getitem("mm_id_pk");
			$datas[0]['advance_form_id'] = $obj_class->getitem("avf_id_pk");
			$datas[0]['advance_no'] = $obj_class->getitem("mm_advancefromNO");
			$datas[0]['advance_created_date'] = date("Y-m-d", strtotime($obj_class->getitem("avf_created_date")));
			$datas[0]['withdrawal_name'] = $obj_class->getitem("avf_withdrawal_name");
			$datas[0]['withdrawal_emp_com_id'] = $obj_class->getitem("avf_withdrawal_ID");
			$datas[0]['department_name'] = $emp_info[0]['emp_dp_name'];
			$datas[0]['memo_subject'] = $obj_class->getitem("mm_subject");
			$datas[0]['cash_type'] = $cash_type_display;
			$datas[0]['account_payee_name'] = $obj_class->getitem("avf_account_payee");
			$datas[0]['paid_date'] = ($obj_class->getitem("avf_paid_date"))?date("Y-m-d", strtotime($obj_class->getitem("avf_paid_date"))):''; 
			$datas[0]['done_date'] = ($obj_class->getitem("avf_done_date"))?date("Y-m-d", strtotime($obj_class->getitem("avf_done_date"))):''; 
			$datas[0]['amount'] = ($obj_class->getitem("avf_amount"))?$obj_class->getitem("avf_amount"):0;
			$datas[0]['use'] = ($obj_class->getitem("avf_use"))?$obj_class->getitem("avf_use"):0;
			$datas[0]['return'] = ($obj_class->getitem("avf_return"))?$obj_class->getitem("avf_return"):0;
			$datas[0]['over'] = ($obj_class->getitem("avf_over"))?$obj_class->getitem("avf_over"):0;
			$datas[0]['advance_status_id'] = $obj_class->getitem("avst_id_pk");

			$datas[0]['approve_date'] = ($obj_class->getitem("avf_approve_date"))?$obj_class->getitem("avf_approve_date"):''; 
			$datas[0]['payment_date'] = ($obj_class->getitem("avf_payment_date"))?$obj_class->getitem("avf_payment_date"):'';
			$datas[0]['cleared_approve_date'] = ($obj_class->getitem("avf_cleared_approve_date"))?$obj_class->getitem("avf_cleared_approve_date"):'';
			$datas[0]['received_approve_date'] = ($obj_class->getitem("avf_received_approve_date"))?$obj_class->getitem("avf_received_approve_date"):'';
			$datas[0]['over_paid_approve_date'] = ($obj_class->getitem("avf_over_paid_approve_date"))?$obj_class->getitem("avf_over_paid_approve_date"):'';
			$datas[0]['over_paid_date'] = ($obj_class->getitem("avf_over_paid_date"))?$obj_class->getitem("avf_over_paid_date"):'';


			$s_sql_2 = "SELECT * from advance_form_detail ";
			$s_sql_2.= "WHERE com_id_pk = ".$params['company_id']." AND avf_id_pk = ".$obj_class->getitem("avf_id_pk")." ";

			if(($obj_class->getitem("avst_id_pk") == 1) || ($obj_class->getitem("avst_id_pk") == 2)){
				$s_sql_2.= "AND avfd_flag = 1 ";
			}
			else{
				$s_sql_2.= "AND avfd_flag = 2 ";
			}

			$s_sql_2.= "ORDER BY avfd_id_pk ASC ";
			$b_resp_2 = $obj_class_2->selectproc($s_sql_2);
			$details = array();

			if($b_resp_2 && $obj_class_2->n_row>0) {
				for($i=0;$i<$obj_class_2->n_row;$i++){
					$details[$i]['objective'] = $obj_class_2->getitem("avfd_objective");
					$details[$i]['amount'] = $obj_class_2->getitem("avfd_amount");

					$obj_class_2->movenext();
				}
			}

			$json_obj->command = '6100';
			$json_obj->message = 'Get data success.';
			$json_obj->data = $datas;
			$json_obj->detail = $details;
		} 
		else{
			$json_obj->command = '6102';
			$json_obj->message = 'Data not found.';
		}
		
		$obj_class->closedb();
		return $json_obj;
    }

    //6200 -- OK
	public function get_cash_advance_paid_detail($params) {
		$json_obj = new stdClass();
		$obj_global = new GlobalConstant();		
		$obj_log = new LogFile();		
		$save_data_log = $_SERVER["HTTP_HOST"].$_SERVER["PHP_SELF"];

		$obj_class = new Connectdb($obj_global->getHOST_CMS(), $obj_global->getUSER_CMS() , $obj_global->getPWD_CMS(), "memo",0,FALSE);
		$obj_class_2 = new Connectdb($obj_global->getHOST_CMS(), $obj_global->getUSER_CMS() , $obj_global->getPWD_CMS(), "memo",0,FALSE);
		$obj_class_3 = new Connectdb($obj_global->getHOST_CMS(), $obj_global->getUSER_CMS() , $obj_global->getPWD_CMS(), "memo",0,FALSE);

		//$params['company_id']
		//$params['memo_id']

		$s_sql = "SELECT mm.* , avf.* from memo mm ";
		$s_sql.= "LEFT JOIN advance_form avf ON mm.avf_id_pk = avf.avf_id_pk ";
		$s_sql.= "WHERE mm.com_id_pk = ".$params['company_id']." AND mm.mf_id_pk = 3 ";
		$s_sql.= "AND mm.mm_id_pk = ".$params['memo_id']." ";

		$b_resp = $obj_class->selectproc($s_sql);
		$obj_log->savelog($save_data_log,"get_cash_advance_detail","sql=[$s_sql]");
		$datas = array();

		if($b_resp && $obj_class->n_row>0) { 
			$emp_info = $this->get_emp_info_by_emp_com_id($params['company_id'] , $obj_class->getitem("avf_withdrawal_ID"));
			
			$advance_form_id = $obj_class->getitem("avf_id_pk");

			if(strtolower($obj_class->getitem("avf_type")) == 'balance'){
				$advance_form_type = 1;
			}
			else if(strtolower($obj_class->getitem("avf_type")) == 'less than paid'){
				$advance_form_type = 2;
			}
			else if(strtolower($obj_class->getitem("avf_type")) == 'over paid'){
				$advance_form_type = 3;
			}
			else{
				$advance_form_type = 0;
			}

			$datas[0]['memo_id'] = $obj_class->getitem("mm_id_pk");
			$datas[0]['advance_form_id'] = $obj_class->getitem("avf_id_pk");
			$datas[0]['advance_no'] = $obj_class->getitem("mm_advancefromNO");
			$datas[0]['advance_created_date'] = date("Y-m-d", strtotime($obj_class->getitem("avf_created_date")));
			$datas[0]['withdrawal_name'] = $obj_class->getitem("avf_withdrawal_name");
			$datas[0]['withdrawal_emp_com_id'] = $obj_class->getitem("avf_withdrawal_ID");
			$datas[0]['department_name'] = $emp_info[0]['emp_dp_name'];
			$datas[0]['memo_subject'] = $obj_class->getitem("mm_subject");
			$datas[0]['amount'] = ($obj_class->getitem("avf_amount"))?$obj_class->getitem("avf_amount"):0;
			$datas[0]['use'] = ($obj_class->getitem("avf_use"))?$obj_class->getitem("avf_use"):0;
			$datas[0]['return'] = ($obj_class->getitem("avf_return"))?$obj_class->getitem("avf_return"):0;
			$datas[0]['over'] = ($obj_class->getitem("avf_over"))?$obj_class->getitem("avf_over"):0;
			$datas[0]['advance_form_type'] = $advance_form_type;
			$datas[0]['total_file'] = ($obj_class->getitem("avf_total_file"))?$obj_class->getitem("avf_total_file"):0;

			$s_sql_2 = "SELECT * from advance_form_detail ";
			$s_sql_2.= "WHERE com_id_pk = ".$params['company_id']." AND avf_id_pk = ".$obj_class->getitem("avf_id_pk")." ";
			
			if(($obj_class->getitem("avst_id_pk") == 1) || ($obj_class->getitem("avst_id_pk") == 2)){
				$s_sql_2.= "AND avfd_flag = 1 ";
			}
			else{
				$s_sql_2.= "AND avfd_flag = 2 ";
			}

			$s_sql_2.= "ORDER BY avfd_id_pk ASC ";
			$b_resp_2 = $obj_class_2->selectproc($s_sql_2);
			$details = array();

			if($b_resp_2 && $obj_class_2->n_row>0) {
				for($i=0;$i<$obj_class_2->n_row;$i++){
					$details[$i]['objective'] = $obj_class_2->getitem("avfd_objective");
					$details[$i]['unit'] = $obj_class_2->getitem("avfd_unit");
					$details[$i]['unit_pric'] = $obj_class_2->getitem("avfd_unit_price");
					$details[$i]['amount'] = $obj_class_2->getitem("avfd_amount");
					$details[$i]['remark'] = ($obj_class_2->getitem("avfd_remark"))?$obj_class_2->getitem("avfd_remark"):'';

					$obj_class_2->movenext();
				}
			}

			if($_SERVER['HTTP_HOST'] == 'localhost'){
				$path = "http://localhost/var_www/verkplus/sub-verk/memo/EdC/".$params['company_id']."/advance_attach_file/".$advance_form_id."/";
				$thumb_path = "http://localhost/var_www/verkplus/sub-verk/memo/EdC/".$params['company_id']."/advance_thumb_attach_file/".$advance_form_id."/"; 
			}
			else{
				if($_SERVER['HTTP_HOST'] == '58.137.222.81'){
					//58.137.222.81
					$path = "http://".$_SERVER['HTTP_HOST']."/var_www/verkplus/sub-verk/memo/EdC/".$params['company_id']."/advance_attach_file/".$advance_form_id."/";
					$thumb_path = "http://".$_SERVER['HTTP_HOST']."/var_www/verkplus/sub-verk/memo/EdC/".$params['company_id']."/advance_thumb_attach_file/".$advance_form_id."/";
				}
				else{
					//58.137.160.130
					$path = "http://".$_SERVER['HTTP_HOST']."/sub-verk/memo/EdC/".$params['company_id']."/advance_attach_file/".$advance_form_id."/";
					$thumb_path = "http://".$_SERVER['HTTP_HOST']."/sub-verk/memo/EdC/".$params['company_id']."/advance_thumb_attach_file/".$advance_form_id."/";
				}
			}

			$s_sql_3 = "SELECT * from advance_attachfile WHERE com_id_pk = ".$params['company_id']." AND avf_id_pk = ".$advance_form_id."  ORDER BY ava_id_pk ASC ";
			$b_resp_3 = $obj_class_3->selectproc($s_sql_3);
			$attachfiles = array();

			if($b_resp_3 && $obj_class_3->n_row>0) {
				for($i=0;$i<$obj_class_3->n_row;$i++){
					$attachfiles[$i]['id'] = $obj_class_3->getitem("ava_id_pk");
					$attachfiles[$i]['path'] = $path.$obj_class_3->getitem("ava_path");
					$attachfiles[$i]['thumb_path'] = $thumb_path.$obj_class_3->getitem("ava_path");

					$obj_class_3->movenext();
				}
			}

			$json_obj->command = '6200';
			$json_obj->message = 'Get data success.';
			$json_obj->data = $datas;
			$json_obj->detail = $details;
			$json_obj->attachfile = $attachfiles;
		} 
		else{
			$json_obj->command = '6202';
			$json_obj->message = 'Data not found.';
		}

		$obj_class->closedb();
		return $json_obj;
    }

    //6300 -- OK
	public function get_advance_status_list() {
		$json_obj = new stdClass();
		$obj_global = new GlobalConstant();		
		$obj_log = new LogFile();		
		$save_data_log = $_SERVER["HTTP_HOST"].$_SERVER["PHP_SELF"];

		$obj_class = new Connectdb($obj_global->getHOST_CMS(), $obj_global->getUSER_CMS() , $obj_global->getPWD_CMS(), "memo",0,FALSE);

		//select -> tb advance_status
		$s_sql = "SELECT * from advance_status ORDER BY avst_id_pk ASC";
		$b_resp = $obj_class->selectproc($s_sql);
		$obj_log->savelog($save_data_log,"get_advance_status_list","sql=[$s_sql]");
		$datas = array();

		if ($b_resp && $obj_class->n_row>0) {
			for($i=0;$i<$obj_class->n_row;$i++){	
				$datas[$i]['advance_status_id'] = $obj_class->getitem("avst_id_pk");
				$datas[$i]['advance_status_name'] = $obj_class->getitem("avst_name");
			    $obj_class->movenext();
			}

			$json_obj->command = '6300';
			$json_obj->message = 'Get data success.';
			$json_obj->data = $datas;
		}
		else {
			$json_obj->command = '6301';
			$json_obj->message = 'Data not found.';
		}
		
		$obj_class->closedb();
		return $json_obj;
    }

    //6400 -- OK
	public function get_accounting_list($params) {
		$json_obj = new stdClass();
		$obj_global = new GlobalConstant();		
		$obj_log = new LogFile();		
		$save_data_log = $_SERVER["HTTP_HOST"].$_SERVER["PHP_SELF"];

		$obj_class = new Connectdb($obj_global->getHOST_CMS(), $obj_global->getUSER_CMS() , $obj_global->getPWD_CMS(), "employee",0,FALSE);

		//$params['company_id']

		//select -> tb employee
		$s_sql = "SELECT emp.* FROM employee.map_emp_menu mem ";
		$s_sql.= "LEFT JOIN sys_admin.sub_menu sm ON mem.smn_id_pk = sm.smn_id_pk ";
		$s_sql.= "LEFT JOIN employee.employee emp ON mem.emp_id_pk = emp.emp_id_pk ";
		$s_sql.= "WHERE sm.mn_id_pk = 23 AND emp.com_id_pk = ".$params['company_id']." ";
		$s_sql.= "GROUP BY mem.emp_id_pk";
		$b_resp = $obj_class->selectproc($s_sql);
		$datas = array();

		if($b_resp && $obj_class->n_row>0){		
			for($i=0;$i<$obj_class->n_row;$i++){
				$datas[$i]['employee_id'] = $obj_class->getitem("emp_id_pk");
				$datas[$i]['emp_com_id'] = $obj_class->getitem("emp_ID");
				$datas[$i]['emp_name'] = $obj_class->getitem("emp_name");
				$datas[$i]['emp_position'] = $obj_class->getitem("emp_position");
				$datas[$i]['emp_pos_initial'] = $obj_class->getitem("emp_pos_initial");
				$datas[$i]['division_id'] = $obj_class->getitem("dv_id_pk");
				$datas[$i]['department_id'] = $obj_class->getitem("dp_id_pk");
				$datas[$i]['section_id'] = $obj_class->getitem("st_id_pk");
				
				$obj_class->movenext();
			}

			$json_obj->command = '6400';
			$json_obj->message = 'Get data success.';
			$json_obj->data = $datas;
		}
		else {
			$json_obj->command = '6402';
			$json_obj->message = 'Data not found.';
		}
		
		$obj_class->closedb();
		return $json_obj;
    }
    



    //6900 -- OK
	public function get_summary_advance_report($params) {
		$json_obj = new stdClass();
		$obj_global = new GlobalConstant();		
		$obj_log = new LogFile();		
		$save_data_log = $_SERVER["HTTP_HOST"].$_SERVER["PHP_SELF"];

		$obj_class = new Connectdb($obj_global->getHOST_CMS(), $obj_global->getUSER_CMS() , $obj_global->getPWD_CMS(), "memo",0,FALSE);
		$obj_class_2 = new Connectdb($obj_global->getHOST_CMS(), $obj_global->getUSER_CMS() , $obj_global->getPWD_CMS(), "memo",0,FALSE);
		$obj_class_3 = new Connectdb($obj_global->getHOST_CMS(), $obj_global->getUSER_CMS() , $obj_global->getPWD_CMS(), "memo",0,FALSE);

		//$params['company_id']
		//$params['year']

		//$params['division_id']
		//$params['department_id']
		//$params['section_id']

		$params['year'] = (isset($params['year']) && ($params['year'] != ''))?$params['year']:'';
		$params['division_id'] = (isset($params['division_id']) && ($params['division_id'] != ''))?$params['division_id']:'';
		$params['department_id'] = (isset($params['department_id']) && ($params['department_id'] != ''))?$params['department_id']:'';
		$params['section_id'] = (isset($params['section_id']) && ($params['section_id'] != ''))?$params['section_id']:'';

		if(($params['division_id'] == '') && ($params['department_id'] == '') && ($params['section_id'] == '')){
			//select -> tb summary_memo
			$s_sql = "SELECT smav.* , SUM(smav.smav_total) AS total , dv.dv_name ";
			$s_sql.= "from memo.summary_memo_advance smav JOIN employee.division dv ON smav.dv_id_pk = dv.dv_id_pk ";
			$s_sql.= "WHERE smav.com_id_pk = ".$params['company_id']." ";

			if($params['year'] != ''){ 
				$s_sql.= "AND DATE_FORMAT(smav.smav_trans_date , '%Y') = '".$params['year']."' ";
			}
			if(($params['division_id'] == '') && ($params['department_id'] == '') && ($params['section_id'] == '')){
				$s_sql.= "GROUP BY smav.dv_id_pk ";
			}

			$s_sql.= "ORDER BY smav.dv_id_pk ASC";
		}
		else if(($params['division_id'] != '') && ($params['department_id'] == '') && ($params['section_id'] == '')){
			//select -> tb summary_memo
			$s_sql = "SELECT smav.* , SUM(smav.smav_total) AS total , dv.dv_name , dp.dp_name ";	
			$s_sql.= "from memo.summary_memo_advance smav JOIN employee.division dv ON smav.dv_id_pk = dv.dv_id_pk ";
			$s_sql.= "LEFT JOIN employee.department dp ON smav.dp_id_pk = dp.dp_id_pk ";
			$s_sql.= "WHERE smav.com_id_pk = ".$params['company_id']." ";
			$s_sql.= "AND dv.dv_id_pk = ".$params['division_id']." ";
	
			if($params['year'] != ''){ 
				$s_sql.= "AND DATE_FORMAT(smav.smav_trans_date , '%Y') = '".$params['year']."' ";
			}

			$s_sql.= "GROUP BY smav.dp_id_pk ";
			$s_sql.= "ORDER BY smav.dv_id_pk ASC";
		}
		else if(($params['division_id'] != '') && ($params['department_id'] != '') && ($params['section_id'] == '')){
			//select -> tb summary_memo
			$s_sql = "SELECT smav.* , SUM(smav.smav_total) AS total , dv.dv_name , dp.dp_name , st.st_name ";
			$s_sql.= "from memo.summary_memo_advance smav JOIN employee.division dv ON smav.dv_id_pk = dv.dv_id_pk ";
			$s_sql.= "LEFT JOIN employee.department dp ON smav.dp_id_pk = dp.dp_id_pk ";
			$s_sql.= "LEFT JOIN employee.section st ON smav.st_id_pk = st.st_id_pk ";
			$s_sql.= "WHERE smav.com_id_pk = ".$params['company_id']." ";
			$s_sql.= "AND dv.dv_id_pk = ".$params['division_id']." ";
			$s_sql.= "AND dp.dp_id_pk = ".$params['department_id']." ";
			
			if($params['year'] != ''){ 
				$s_sql.= "AND DATE_FORMAT(smav.smav_trans_date , '%Y') = '".$params['year']."' ";
			}

			$s_sql.= "GROUP BY smav.st_id_pk ";
			$s_sql.= "ORDER BY smav.dv_id_pk ASC";
		}
		else if(($params['division_id'] != '') && ($params['department_id'] != '') && ($params['section_id'] != '')){
			//select -> tb summary_memo
			$s_sql = "SELECT smav.* , SUM(smav.smav_total) AS total , dv.dv_name , dp.dp_name , st.st_name ";
			$s_sql.= "from memo.summary_memo_advance smav JOIN employee.division dv ON smav.dv_id_pk = dv.dv_id_pk ";
			$s_sql.= "LEFT JOIN employee.department dp ON smav.dp_id_pk = dp.dp_id_pk ";
			$s_sql.= "LEFT JOIN employee.section st ON smav.st_id_pk = st.st_id_pk ";
			$s_sql.= "WHERE smav.com_id_pk = ".$params['company_id']." ";
			$s_sql.= "AND dv.dv_id_pk = ".$params['division_id']." ";
			$s_sql.= "AND dp.dp_id_pk = ".$params['department_id']." ";
			$s_sql.= "AND st.st_id_pk = ".$params['section_id']." ";
			
			if($params['year'] != ''){ 
				$s_sql.= "AND DATE_FORMAT(smav.smav_trans_date , '%Y') = '".$params['year']."' ";
			}

			$s_sql.= "GROUP BY smav.st_id_pk ";
			$s_sql.= "ORDER BY smav.dv_id_pk ASC";
		}

		$b_resp = $obj_class->selectproc($s_sql);
		$obj_log->savelog($save_data_log,"get_summary_advance_report","sql=[$s_sql]");
		$datas = array();

		if($b_resp && $obj_class->n_row>0) {
			$all_smav_total = 0;

			for($i=0;$i<$obj_class->n_row;$i++){	
				$division_id = $obj_class->getitem("dv_id_pk");
				$department_id = $obj_class->getitem("dp_id_pk");
				$section_id = $obj_class->getitem("st_id_pk");

				$datas[$i]['smav_id_pk'] = $obj_class->getitem("smav_id_pk");
				$datas[$i]['smav_trans_date'] = $obj_class->getitem("smav_trans_date");
				$datas[$i]['company_id'] = $obj_class->getitem("com_id_pk");
				$datas[$i]['division_id'] = ($obj_class->getitem("dv_id_pk"))?$obj_class->getitem("dv_id_pk"):0;
				$datas[$i]['department_id'] = ($obj_class->getitem("dp_id_pk"))?$obj_class->getitem("dp_id_pk"):0;
				$datas[$i]['section_id'] = ($obj_class->getitem("st_id_pk"))?$obj_class->getitem("st_id_pk"):0;
				$datas[$i]['division_name'] = $obj_class->getitem("dv_name");
				$datas[$i]['department_name'] = ($obj_class->getitem("dp_name") != '')?$obj_class->getitem("dp_name"):'-';
				$datas[$i]['section_name'] = ($obj_class->getitem("st_name") != '')?$obj_class->getitem("st_name"):'-';
				$datas[$i]['smav_total'] = $obj_class->getitem("total");

				$all_smav_total = $all_smav_total+$obj_class->getitem("total");

				$datas[$i]['show_status'] = $this->get_summary_advance_status($params , $obj_class->getitem("com_id_pk") , $obj_class->getitem("dv_id_pk") , $obj_class->getitem("dp_id_pk") , $obj_class->getitem("st_id_pk"));

			    $obj_class->movenext();
			}

			$json_obj->command = '6900';
			$json_obj->message = 'Get data success.';
			$json_obj->summary_total = $all_smav_total;
			$json_obj->data = $datas;
		}
		else {
			$json_obj->command = '6902';
			$json_obj->message = 'Data not found.';
		}  
		
		$obj_class->closedb();
		return $json_obj;
    }

    //7000 -- OK //edit api doc
    public function set_read_notice($params) {
		$json_obj = new stdClass();
		$obj_global = new GlobalConstant();		
		$obj_log = new LogFile();		
		$save_data_log = $_SERVER["HTTP_HOST"].$_SERVER["PHP_SELF"];

		$obj_class = new Connectdb($obj_global->getHOST_CMS(), $obj_global->getUSER_CMS() , $obj_global->getPWD_CMS(), "memo",0,FALSE);

		//$params['employee_id']

		//update advance_form
		$s_sql = "UPDATE notification_memo SET nm_status = 'R' , nm_readed_date = NOW() , nm_modified_date = NOW() ";
		$s_sql.= "WHERE emp_id_pk = ".$params['employee_id']." ";
		$s_sql.= "AND nm_notice_type = 3 AND nm_status = 'U' ";
		$b_flag = $obj_class->manageproc($s_sql);
		
		if($b_flag){
			$json_obj->command = '7000';
			$json_obj->message = 'Update data success.';
		}
		else{
			$json_obj->command = '7002';
			$json_obj->message = 'Update data fail.';
		}
		
		$obj_class->closedb();
		return $json_obj;
    }

    //7100 -- OK //edit api doc
    public function get_example_memo_detail($params) {
		$json_obj = new stdClass();
		$obj_global = new GlobalConstant();		
		$obj_log = new LogFile();		
		$save_data_log = $_SERVER["HTTP_HOST"].$_SERVER["PHP_SELF"];

		$obj_class = new Connectdb($obj_global->getHOST_CMS(), $obj_global->getUSER_CMS() , $obj_global->getPWD_CMS(), "memo",0,FALSE);

		//$params['memo_form_id']

		if($params['memo_form_id'] == 1){
			$datas[0]['memo_no'] = 'ABC';
			$datas[0]['created_date'] = date("Y/m/d");
			$datas[0]['from'] = 'สมชาย แข็งแรง';
			$datas[0]['to'] = 'MD สุชาติ บารมีอนันต์';
			$datas[0]['concurred'] = 'MKTD ศิริพร อยู่ดี';
			$datas[0]['cc'] = 'MKTM ชัยชนะ ศัตรูพินาจ';

			$datas[0]['confirm_payment'] = ''; // 3

			$datas[0]['subject'] = 'xxxxxxxxxx';
			$datas[0]['form'] = 'Financial';
			$datas[0]['format'] = 'Financial';
			$datas[0]['type'] = 'Financial';

			$datas[0]['sub_type'] = ''; // 3
			$datas[0]['advance_no'] = ''; // 3

			$datas[0]['amount'] = '10,000.00';
			$datas[0]['budget'] = 'Yes';
			$datas[0]['detail'] = 'xxxxxxxxxx';
			$datas[0]['from_position'] = 'Marketing Officer';

			$json_obj->command = '7100';
			$json_obj->message = 'Get data success.';
			$json_obj->data = $datas;
		}
		else if($params['memo_form_id'] == 2){
			$datas[0]['memo_no'] = 'ABC';
			$datas[0]['created_date'] = date("Y/m/d");
			$datas[0]['from'] = 'สมชาย แข็งแรง';
			$datas[0]['to'] = 'MD สุชาติ บารมีอนันต์';
			$datas[0]['concurred'] = 'MKTD ศิริพร อยู่ดี';
			$datas[0]['cc'] = 'MKTM ชัยชนะ ศัตรูพินาจ';

			$datas[0]['confirm_payment'] = ''; //3

			$datas[0]['subject'] = 'xxxxxxxxxx';
			$datas[0]['form'] = 'Non Financial';
			$datas[0]['format'] = 'Non Financial';
			$datas[0]['type'] = 'Non Financial';

			$datas[0]['sub_type'] = ''; //3
			$datas[0]['advance_no'] = ''; //3

			$datas[0]['amount'] = '';
			$datas[0]['budget'] = '';
			$datas[0]['detail'] = 'xxxxxxxxxxx';
			$datas[0]['from_position'] = 'Marketing Officer';

			$json_obj->command = '7100';
			$json_obj->message = 'Get data success.';
			$json_obj->data = $datas;
		}
		else if($params['memo_form_id'] == 3){
			$datas[0]['memo_no'] = 'ABC';
			$datas[0]['created_date'] = date("Y/m/d");
			$datas[0]['from'] = 'สมชาย แข็งแรง';
			$datas[0]['to'] = 'MD สุชาติ บารมีอนันต์';
			$datas[0]['concurred'] = 'MKTD ศิริพร อยู่ดี';
			$datas[0]['cc'] = 'MKTM ชัยชนะ ศัตรูพินาจ';

			$datas[0]['confirm_payment'] = 'ACO กรกนก บุญรักษา'; // 3

			$datas[0]['subject'] = 'xxxxxxxxxx';
			$datas[0]['form'] = 'Advance';
			$datas[0]['format'] = 'Advance';
			$datas[0]['type'] = 'Advance';

			$datas[0]['sub_type'] = 'Approve'; // 3
			$datas[0]['advance_no'] = 'ABCD'.date("Y").'/xxxxx'; // 3

			$datas[0]['amount'] = '10,000.00';
			$datas[0]['budget'] = 'Yes';
			$datas[0]['detail'] = 'xxxxxxxxxx';	
			$datas[0]['from_position'] = 'Marketing Officer';

			$json_obj->command = '7100';
			$json_obj->message = 'Get data success.';
			$json_obj->data = $datas;
		}
		else {
			$json_obj->command = '7102';
			$json_obj->message = 'Data is invalid.';
		}
		
		$obj_class->closedb();
		return $json_obj;
    }

    //8000 -- OK //edit api doc
    public function get_app_version() {
		$json_obj = new stdClass();
		$obj_global = new GlobalConstant();		
		$obj_log = new LogFile();		
		$save_data_log = $_SERVER["HTTP_HOST"].$_SERVER["PHP_SELF"];

		$obj_class = new Connectdb($obj_global->getHOST_CMS(), $obj_global->getUSER_CMS() , $obj_global->getPWD_CMS(), "memo",0,FALSE);

		$app_version['ios'] = IOS_APP_VERSION;
		$app_version['android'] = ANDROID_APP_VERSION;
		$app_version['link_download'] = LINK_DOWNLOAD;
		$app_version['version_code_ios'] = VERSION_CODE_IOS;
		$app_version['version_code_android'] = VERSION_CODE_ANDROID;
	
		$json_obj->command = '8000';
		$json_obj->message = 'Get data success.';
		$json_obj->data = $app_version;
		
		$obj_class->closedb();
		return $json_obj;
    }






    /*
    //9000 -- OK
	public function check_get_emp_info() {
		$json_obj = new stdClass();
		$obj_global = new GlobalConstant();		
		$obj_log = new LogFile();		
		$save_data_log = $_SERVER["HTTP_HOST"].$_SERVER["PHP_SELF"];

		$obj_class = new Connectdb($obj_global->getHOST_CMS(), $obj_global->getUSER_CMS() , $obj_global->getPWD_CMS(), "employee",0,FALSE);

		$company_id = 45;

		$s_sql = "SELECT emp.* , dp.dp_name , memd.memd_device_token , memd.memd_gcm_token , memd.memd_device_type ";
		$s_sql.= "FROM employee emp LEFT JOIN department dp ON emp.dp_id_pk = dp.dp_id_pk ";
		$s_sql.= "LEFT JOIN map_emp_module memd ON emp.emp_id_pk = memd.emp_id_pk ";
		$s_sql.= "WHERE emp.com_id_pk = ".$company_id." AND memd.memd_module LIKE 'memo' "; 
		$b_resp = $obj_class->selectproc($s_sql);
		$obj_log->savelog($save_data_log,"get_emp_info_by_emp_id","sql=[$s_sql]");
		$datas = array();

		if($b_resp && $obj_class->n_row>0) {	
			for($i=0;$i<$obj_class->n_row;$i++){
				$datas[$i]['emp_com_id'] = $obj_class->getitem("emp_ID");
				$datas[$i]['emp_name'] = $obj_class->getitem("emp_name");
				$datas[$i]['emp_email'] = $obj_class->getitem("emp_email");
				$datas[$i]['emp_username'] = $obj_class->getitem("emp_username");
				$datas[$i]['emp_start_work_date'] = $obj_class->getitem("emp_start_work_date");
				$datas[$i]['emp_position'] = $obj_class->getitem("emp_position");
				$datas[$i]['emp_pos_initial'] = ($obj_class->getitem("emp_pos_initial"))?$obj_class->getitem("emp_pos_initial"):'-'; 
				$datas[$i]['emp_phone'] = ($obj_class->getitem("emp_phone"))?$obj_class->getitem("emp_phone"):'-';
				$datas[$i]['emp_sex'] = ($obj_class->getitem("emp_sex"))?$obj_class->getitem("emp_sex"):'-'; 
				$datas[$i]['emp_level'] = $obj_class->getitem("emp_level");
				$datas[$i]['emp_type_id'] = $obj_class->getitem("empt_id_pk");
				$datas[$i]['emp_dv_id'] = $obj_class->getitem("dv_id_pk");
				$datas[$i]['emp_dp_id'] = $obj_class->getitem("dp_id_pk");
				$datas[$i]['emp_st_id'] = $obj_class->getitem("st_id_pk");
				$datas[$i]['emp_company_id'] = $obj_class->getitem("com_id_pk");
				$datas[$i]['emp_status'] = $obj_class->getitem("emp_status");
				$datas[$i]['emp_dp_name'] = ($obj_class->getitem("dp_name"))?$obj_class->getitem("dp_name"):'-';
				$datas[$i]['emp_profile_image'] = $obj_class->getitem("emp_display");

				$datas[$i]['emp_device_token'] = $obj_class->getitem("memd_device_token");
				$datas[$i]['emp_gcm_token'] = $obj_class->getitem("memd_gcm_token");
				$datas[$i]['emp_device_type'] = $obj_class->getitem("memd_device_type");

				$obj_class->movenext();
			}

			$json_obj->command = '8000';
			$json_obj->message = 'Get data success.';
			$json_obj->data = $datas;
			$json_obj->count_data = count($datas);
		}
		else {
			$json_obj->command = '8002';
			$json_obj->message = 'Data not found.';
		}
		
		$obj_class->closedb();
		return $json_obj;
    }
    */

	/*
    //9900 -- OK
	public function aaa($params , $files) {
		$json_obj = new stdClass();
		$obj_global = new GlobalConstant();		
		$obj_log = new LogFile();		
		$save_data_log = $_SERVER["HTTP_HOST"].$_SERVER["PHP_SELF"];

		$obj_class = new Connectdb($obj_global->getHOST_CMS(), $obj_global->getUSER_CMS() , $obj_global->getPWD_CMS(), "employee",0,FALSE);

		$url_path = "http://".$_SERVER['HTTP_HOST']."/sub-verk/memo/EdC/";

		$params['path'] = isset($files['path'])?$files['path']:'';

		//update -> tb employee 
		if($files['path']['name'] != ''){
			$path = "../EdC/";
			if(!(file_exists($path))){
				mkdir($path, 0777, true);
			}

			$file_name = 'default.jpg';
			$file_size = $files['path']['size'];
			$file_tmp = $files['path']['tmp_name'];
			$file_type = $files['path']['type'];
			$file_ext = strtolower(end(explode('.',$files['path']['name'])));
		
			$expensions = array("jpeg","jpg","png");

			$errors = '{"result_code":1,"result_desc":"success"}';

		}

		move_uploaded_file($file_tmp , $path.$file_name);
		
		$json_obj->command = '4202';
		$json_obj->message = 'Data is invalid.';
		

		$obj_class->closedb();
		return $json_obj;
    }
    */




    public function send_email($email_to) {
    	//$email_from = "godlikenokia@gmail.com";
    	$email_from = "verkapp@teleinfomedia.co.th";
		$strTo = $email_to;
     	$strSubject = "Your Account information OTP.".date("Y-m-d H:i:s");
     	$strHeader = "Content-type: text/html; charset=UTF-8\n"; // or  //
     	$strHeader.= "From: ".$email_from."\n";
     	$strMessage = "";
     	$strMessage.= "Hello,  ".$email_to."<br>";
     	$strMessage.= "OTP  : 999999<br>";
     	$strMessage.= "ใช้รหัส OTP เพื่อขอรหัสผ่านใหม่ <br>";
     	$strMessage.= "=================================<br>";
     	$strMessage.= "Best regards,<br>Memo system<br>";

     	if(mail($strTo,$strSubject,$strMessage,$strHeader)){
     		$status = true;
     	}
     	else{
     		$status = false;
     	}

     	return $status;
    }

    public function send_push_notice_android($data) {
    	$url = 'https://fcm.googleapis.com/fcm/send';

		$header = array(
				'Content-Type: application/json',
				'Authorization: key=AAAAaD5b69c:APA91bHLsaFTr9IgOI_NtQ-47CpzrLspNSDvMsbNpMKODNPD5UFHj4C4F7iKu8JKvtiMBPt2ynuZa5lrKZXx7TmnsPmuhy_VHhurIHJ8vFoRwvYnPVP8-MUK9FCEDjwb9wF_Dzo91xkkkEp-oPN1_1KJvHyOQFL4tw'
				);

		$ch = curl_init();                                  
		curl_setopt($ch, CURLOPT_URL, $url);  
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
		curl_setopt($ch, CURLOPT_POST, true);               
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false );                                                   
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $header);                                                                               

		$result = curl_exec($ch);
		$rs = json_decode($result);

		curl_close($ch);

		return $rs;
    }

    public function send_push_notice_ios($payloads) {
		// Prepare data
		$result = new stdClass();
		$result->status = true;
		$result->success = 0;	

		$ctx = stream_context_create();
		stream_context_set_option($ctx, 'ssl', 'local_cert', 'CertificatesDis.pem');
		stream_context_set_option($ctx, 'ssl', 'passphrase', '10203040');

	  	// Open a connection to the APNS server
	  	$fp = stream_socket_client(
	  	//'ssl://gateway.sandbox.push.apple.com:2195', $err,
	   	'ssl://gateway.push.apple.com:2195', $err,
	   	$errstr, 60, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $ctx);

		if(!$fp)
	    	exit("Failed to connect: $err $errstr" . PHP_EOL);

		$result->status = 'Connected to APNS' . PHP_EOL;
		$msg = "";
			
	  	foreach($payloads as $token => $value) {
			$value['aps']['sound'] = 'default';
			$payload = json_encode($value);

			// Build the binary notification
			$msg = chr(0) . pack('n', 32) . pack('H*', str_replace(' ', '', $token)) . pack('n', strlen($payload)) . $payload;
			
			// Send it to the server
			$rs = fwrite($fp, $msg, strlen($msg));
			if($rs) {
				$result->success++;
			}	
		}
		
		if($result){
			$status = true;
		}
		else{
		   	$status = false;
		}
		fclose($fp);

		return $status;
	}

	public function get_map_emp_notice($company_id , $emp_com_id) {
		$json_obj = new stdClass();
		$obj_global = new GlobalConstant();		
		$obj_log = new LogFile();		
		$save_data_log = $_SERVER["HTTP_HOST"].$_SERVER["PHP_SELF"];

		$obj_class = new Connectdb($obj_global->getHOST_CMS(), $obj_global->getUSER_CMS() , $obj_global->getPWD_CMS(), "employee",0,FALSE);

		$s_sql = "SELECT * from map_emp_notification WHERE com_id_pk = ".$company_id." AND emp_ID = '".$emp_com_id."' AND men_module LIKE 'memo' AND men_status = 1 ";
		$b_resp = $obj_class->selectproc($s_sql);
		$obj_log->savelog($save_data_log,"get_map_emp_notice","sql=[$s_sql]");
		$datas = array();

		if ($b_resp && $obj_class->n_row>0) {	
			for($i=0;$i<$obj_class->n_row;$i++){
				$datas[$i]['notice_type'] = $obj_class->getitem("men_noti_type"); //1=send to verk,2=send to mail,3=send by module

				$obj_class->movenext();
			}
		}
		else {
			//$datas[0]['notice_type'] = 3; //send notice to memo
			$datas[0]['notice_type'] = 2; //send email
		}
		
		$obj_class->closedb();
		return $datas;
    }

    public function get_badge_notice($employee_id) {
		$json_obj = new stdClass();
		$obj_global = new GlobalConstant();		
		$obj_log = new LogFile();		
		$save_data_log = $_SERVER["HTTP_HOST"].$_SERVER["PHP_SELF"];

		$obj_class = new Connectdb($obj_global->getHOST_CMS(), $obj_global->getUSER_CMS() , $obj_global->getPWD_CMS(), "memo",0,FALSE);

		$s_sql = "SELECT * from notification_memo WHERE emp_id_pk = ".$employee_id." AND nm_status = 'U' AND nm_notice_type = 3 ";
		$b_resp = $obj_class->selectproc($s_sql);
		$obj_log->savelog($save_data_log,"get_badge_notice","sql=[$s_sql]");
		$datas = array();

		if ($b_resp && $obj_class->n_row>0) {
			$count_badge = $obj_class->n_row;
		}
		else {
			$count_badge = 0;
		}
		
		$obj_class->closedb();
		return $count_badge;
    }

    public function check_accounting_authorize($employee_id) {
		$json_obj = new stdClass();
		$obj_global = new GlobalConstant();		
		$obj_log = new LogFile();		
		$save_data_log = $_SERVER["HTTP_HOST"].$_SERVER["PHP_SELF"];

		$obj_class = new Connectdb($obj_global->getHOST_CMS(), $obj_global->getUSER_CMS() , $obj_global->getPWD_CMS(), "employee",0,FALSE);

		$s_sql = "SELECT emp.* FROM employee.map_emp_menu mem ";
		$s_sql.= "LEFT JOIN sys_admin.sub_menu sm ON mem.smn_id_pk = sm.smn_id_pk ";
		$s_sql.= "LEFT JOIN employee.employee emp ON mem.emp_id_pk = emp.emp_id_pk ";
		$s_sql.= "WHERE sm.mn_id_pk = 23 AND mem.emp_id_pk = ".$employee_id." ";
		$s_sql.= "GROUP BY mem.emp_id_pk";
		$b_resp = $obj_class->selectproc($s_sql);
		$datas = array();

		if ($b_resp && $obj_class->n_row>0) {
			$accounting = true;
		}
		else {
			$accounting = false;
		}
		
		$obj_class->closedb();
		return $accounting;
    }

    public function check_summary_memo_authorize($employee_id) {
		$json_obj = new stdClass();
		$obj_global = new GlobalConstant();		
		$obj_log = new LogFile();		
		$save_data_log = $_SERVER["HTTP_HOST"].$_SERVER["PHP_SELF"];

		$obj_class = new Connectdb($obj_global->getHOST_CMS(), $obj_global->getUSER_CMS() , $obj_global->getPWD_CMS(), "employee",0,FALSE);

		$s_sql = "SELECT emp.* FROM employee.map_emp_menu mem ";
		$s_sql.= "LEFT JOIN sys_admin.sub_menu sm ON mem.smn_id_pk = sm.smn_id_pk ";
		$s_sql.= "LEFT JOIN employee.employee emp ON mem.emp_id_pk = emp.emp_id_pk ";
		$s_sql.= "WHERE sm.mn_id_pk = 24 AND mem.emp_id_pk = ".$employee_id." ";
		$s_sql.= "GROUP BY mem.emp_id_pk";
		$b_resp = $obj_class->selectproc($s_sql);
		$datas = array();

		if ($b_resp && $obj_class->n_row>0) {
			$summary_memo_auth = true;
		}
		else {
			$summary_memo_auth = false;
		}
		
		$obj_class->closedb();
		return $summary_memo_auth;
    }

    public function check_summary_advance_authorize($employee_id) {
		$json_obj = new stdClass();
		$obj_global = new GlobalConstant();		
		$obj_log = new LogFile();		
		$save_data_log = $_SERVER["HTTP_HOST"].$_SERVER["PHP_SELF"];

		$obj_class = new Connectdb($obj_global->getHOST_CMS(), $obj_global->getUSER_CMS() , $obj_global->getPWD_CMS(), "employee",0,FALSE);

		$s_sql = "SELECT emp.* FROM employee.map_emp_menu mem ";
		$s_sql.= "LEFT JOIN sys_admin.sub_menu sm ON mem.smn_id_pk = sm.smn_id_pk ";
		$s_sql.= "LEFT JOIN employee.employee emp ON mem.emp_id_pk = emp.emp_id_pk ";
		$s_sql.= "WHERE sm.mn_id_pk = 25 AND mem.emp_id_pk = ".$employee_id." ";
		$s_sql.= "GROUP BY mem.emp_id_pk";
		$b_resp = $obj_class->selectproc($s_sql);
		$datas = array();

		if ($b_resp && $obj_class->n_row>0) {
			$summary_advance_auth = true;
		}
		else {
			$summary_advance_auth = false;
		}
		
		$obj_class->closedb();
		return $summary_advance_auth;
    }

    public function get_emp_info_by_emp_id($company_id , $employee_id) {
		$json_obj = new stdClass();
		$obj_global = new GlobalConstant();		
		$obj_log = new LogFile();		
		$save_data_log = $_SERVER["HTTP_HOST"].$_SERVER["PHP_SELF"];

		$obj_class = new Connectdb($obj_global->getHOST_CMS(), $obj_global->getUSER_CMS() , $obj_global->getPWD_CMS(), "employee",0,FALSE);

		$s_sql = "SELECT emp.* , dp.dp_name , memd.memd_device_token , memd.memd_gcm_token , memd.memd_device_type ";
		$s_sql.= "FROM employee emp LEFT JOIN department dp ON emp.dp_id_pk = dp.dp_id_pk ";
		$s_sql.= "LEFT JOIN map_emp_module memd ON emp.emp_id_pk = memd.emp_id_pk ";
		$s_sql.= "WHERE emp.com_id_pk = ".$company_id." AND emp.emp_id_pk = ".$employee_id." AND memd.memd_module LIKE 'memo' "; 
		$b_resp = $obj_class->selectproc($s_sql);
		$obj_log->savelog($save_data_log,"get_emp_info_by_emp_id","sql=[$s_sql]");
		$datas = array();

		if ($b_resp && $obj_class->n_row>0) {	
			$datas[0]['emp_com_id'] = $obj_class->getitem("emp_ID");
			$datas[0]['emp_name'] = $obj_class->getitem("emp_name");
			$datas[0]['emp_email'] = $obj_class->getitem("emp_email");
			$datas[0]['emp_username'] = $obj_class->getitem("emp_username");
			$datas[0]['emp_start_work_date'] = $obj_class->getitem("emp_start_work_date");
			$datas[0]['emp_position'] = $obj_class->getitem("emp_position");
			$datas[0]['emp_pos_initial'] = ($obj_class->getitem("emp_pos_initial"))?$obj_class->getitem("emp_pos_initial"):'-'; 
			$datas[0]['emp_phone'] = ($obj_class->getitem("emp_phone"))?$obj_class->getitem("emp_phone"):'-';
			$datas[0]['emp_sex'] = ($obj_class->getitem("emp_sex"))?$obj_class->getitem("emp_sex"):'-'; 
			$datas[0]['emp_level'] = $obj_class->getitem("emp_level");
			$datas[0]['emp_type_id'] = $obj_class->getitem("empt_id_pk");
			$datas[0]['emp_dv_id'] = $obj_class->getitem("dv_id_pk");
			$datas[0]['emp_dp_id'] = $obj_class->getitem("dp_id_pk");
			$datas[0]['emp_st_id'] = $obj_class->getitem("st_id_pk");
			$datas[0]['emp_company_id'] = $obj_class->getitem("com_id_pk");
			$datas[0]['emp_status'] = $obj_class->getitem("emp_status");
			$datas[0]['emp_dp_name'] = ($obj_class->getitem("dp_name"))?$obj_class->getitem("dp_name"):'-';
			$datas[0]['emp_profile_image'] = $obj_class->getitem("emp_display");

			$datas[0]['emp_device_token'] = $obj_class->getitem("memd_device_token");
			$datas[0]['emp_gcm_token'] = $obj_class->getitem("memd_gcm_token");
			$datas[0]['emp_device_type'] = $obj_class->getitem("memd_device_type");
		}
		else {
			$datas[0] = null;
		}
		
		$obj_class->closedb();
		return $datas;
    }

    public function get_emp_info_by_emp_com_id($company_id , $emp_com_id) {
		$json_obj = new stdClass();
		$obj_global = new GlobalConstant();		
		$obj_log = new LogFile();		
		$save_data_log = $_SERVER["HTTP_HOST"].$_SERVER["PHP_SELF"];

		$obj_class = new Connectdb($obj_global->getHOST_CMS(), $obj_global->getUSER_CMS() , $obj_global->getPWD_CMS(), "employee",0,FALSE);

		$s_sql = "SELECT emp.* , dp.dp_name , memd.memd_device_token , memd.memd_gcm_token , memd.memd_device_type ";
		$s_sql.= "FROM employee emp LEFT JOIN department dp ON emp.dp_id_pk = dp.dp_id_pk ";
		$s_sql.= "LEFT JOIN map_emp_module memd ON emp.emp_id_pk = memd.emp_id_pk ";
		$s_sql.= "WHERE emp.com_id_pk = ".$company_id." AND emp.emp_ID = ".$emp_com_id." AND memd.memd_module LIKE 'memo' "; 
		$b_resp = $obj_class->selectproc($s_sql);
		$obj_log->savelog($save_data_log,"get_emp_info_by_emp_com_id","sql=[$s_sql]");
		$datas = array();

		if ($b_resp && $obj_class->n_row>0) {	
			$datas[0]['emp_id'] = $obj_class->getitem("emp_id_pk");
			$datas[0]['emp_name'] = $obj_class->getitem("emp_name");
			$datas[0]['emp_email'] = $obj_class->getitem("emp_email");
			$datas[0]['emp_username'] = $obj_class->getitem("emp_username");
			$datas[0]['emp_start_work_date'] = $obj_class->getitem("emp_start_work_date");
			$datas[0]['emp_position'] = $obj_class->getitem("emp_position");
			$datas[0]['emp_pos_initial'] = $obj_class->getitem("emp_pos_initial");
			$datas[0]['emp_phone'] = $obj_class->getitem("emp_phone");
			$datas[0]['emp_sex'] = $obj_class->getitem("emp_sex");
			$datas[0]['emp_level'] = $obj_class->getitem("emp_level");
			$datas[0]['emp_type_id'] = $obj_class->getitem("empt_id_pk");
			$datas[0]['emp_dv_id'] = $obj_class->getitem("dv_id_pk");
			$datas[0]['emp_dp_id'] = $obj_class->getitem("dp_id_pk");
			$datas[0]['emp_st_id'] = $obj_class->getitem("st_id_pk");
			$datas[0]['emp_company_id'] = $obj_class->getitem("com_id_pk");
			$datas[0]['emp_status'] = $obj_class->getitem("emp_status");
			$datas[0]['emp_dp_name'] = ($obj_class->getitem("dp_name"))?$obj_class->getitem("dp_name"):'-';
			$datas[0]['emp_profile_image'] = $obj_class->getitem("emp_display");

			$datas[0]['emp_device_token'] = $obj_class->getitem("memd_device_token");
			$datas[0]['emp_gcm_token'] = $obj_class->getitem("memd_gcm_token");
			$datas[0]['emp_device_type'] = $obj_class->getitem("memd_device_type");
		}
		else {
			$datas[0] = null;
		}
		
		$obj_class->closedb();
		return $datas;
    }

    public function get_emp_info_by_pos_initial($company_id , $employee_pos_initial) {
		$json_obj = new stdClass();
		$obj_global = new GlobalConstant();		
		$obj_log = new LogFile();		
		$save_data_log = $_SERVER["HTTP_HOST"].$_SERVER["PHP_SELF"];

		$obj_class = new Connectdb($obj_global->getHOST_CMS(), $obj_global->getUSER_CMS() , $obj_global->getPWD_CMS(), "employee",0,FALSE);

		$s_sql = "SELECT emp.* , dp.dp_name FROM employee emp LEFT JOIN department dp ON emp.dp_id_pk = dp.dp_id_pk ";
		$s_sql.= "WHERE emp.com_id_pk = ".$company_id." AND emp.emp_pos_initial = '".$employee_pos_initial."' ORDER BY emp.emp_name ASC "; 
		$b_resp = $obj_class->selectproc($s_sql);
		$obj_log->savelog($save_data_log,"get_emp_info_by_pos_initial","sql=[$s_sql]");
		$datas = array();

		if ($b_resp && $obj_class->n_row>0) {	
			for($i=0;$i<$obj_class->n_row;$i++){
				$datas[$i]['emp_id'] = $obj_class->getitem("emp_id_pk");
				$datas[$i]['emp_com_id'] = $obj_class->getitem("emp_ID");
				$datas[$i]['emp_name'] = $obj_class->getitem("emp_name");
				$datas[$i]['emp_email'] = $obj_class->getitem("emp_email");
				$datas[$i]['emp_username'] = $obj_class->getitem("emp_username");
				$datas[$i]['emp_start_work_date'] = $obj_class->getitem("emp_start_work_date");
				$datas[$i]['emp_position'] = $obj_class->getitem("emp_position");
				$datas[$i]['emp_pos_initial'] = ($obj_class->getitem("emp_pos_initial"))?$obj_class->getitem("emp_pos_initial"):'-'; 
				$datas[$i]['emp_phone'] = ($obj_class->getitem("emp_phone"))?$obj_class->getitem("emp_phone"):'-';
				$datas[$i]['emp_sex'] = ($obj_class->getitem("emp_sex"))?$obj_class->getitem("emp_sex"):'-'; 
				$datas[$i]['emp_level'] = $obj_class->getitem("emp_level");
				$datas[$i]['emp_type_id'] = $obj_class->getitem("empt_id_pk");
				$datas[$i]['emp_dv_id'] = $obj_class->getitem("dv_id_pk");
				$datas[$i]['emp_dp_id'] = $obj_class->getitem("dp_id_pk");
				$datas[$i]['emp_st_id'] = $obj_class->getitem("st_id_pk");
				$datas[$i]['emp_company_id'] = $obj_class->getitem("com_id_pk");
				$datas[$i]['emp_status'] = $obj_class->getitem("emp_status");
				$datas[$i]['emp_dp_name'] = ($obj_class->getitem("dp_name"))?$obj_class->getitem("dp_name"):'-';
				$datas[$i]['emp_profile_image'] = $obj_class->getitem("emp_display");

				$obj_class->movenext();
			}
			
		}
		else {
			$datas[0] = null;
		}
		
		$obj_class->closedb();
		return $datas;
    }

    public function get_form_format_name($company_id , $memo_form_id) {
		$json_obj = new stdClass();
		$obj_global = new GlobalConstant();		
		$obj_log = new LogFile();		
		$save_data_log = $_SERVER["HTTP_HOST"].$_SERVER["PHP_SELF"];

		$obj_class = new Connectdb($obj_global->getHOST_CMS(), $obj_global->getUSER_CMS() , $obj_global->getPWD_CMS(), "memo",0,FALSE);

		$s_sql = "SELECT mf_form_name FROM memo_form_position WHERE com_id_pk IN (0 , ".$company_id.") AND mf_id_pk = ".$memo_form_id." "; 
		$b_resp = $obj_class->selectproc($s_sql);
		$obj_log->savelog($save_data_log,"get_form_format_name","sql=[$s_sql]");
		$datas = array();

		if($b_resp && $obj_class->n_row>0) {	
			$form_format_name = $obj_class->getitem("mf_form_name");
		}
		else {
			$form_format_name = $s_sql;
		}
		
		$obj_class->closedb();
		return $form_format_name;
    }

    public function get_division_name($division_id) {
		$json_obj = new stdClass();
		$obj_global = new GlobalConstant();		
		$obj_log = new LogFile();		
		$save_data_log = $_SERVER["HTTP_HOST"].$_SERVER["PHP_SELF"];

		$obj_class = new Connectdb($obj_global->getHOST_CMS(), $obj_global->getUSER_CMS() , $obj_global->getPWD_CMS(), "employee",0,FALSE);

		$s_sql = "SELECT * from division WHERE dv_id_pk = ".$division_id;
		$b_resp = $obj_class->selectproc($s_sql);
		$obj_log->savelog($save_data_log,"get_division_name","sql=[$s_sql]");
		$datas = array();

		if ($b_resp && $obj_class->n_row>0) {	
			$datas[0]['dv_name'] = $obj_class->getitem("dv_name");
		}
		else {
			$datas[0] = null;
		}

		$obj_class->closedb();
		return $datas;
    }

    public function get_department_name($department_id) {
		$json_obj = new stdClass();
		$obj_global = new GlobalConstant();		
		$obj_log = new LogFile();		
		$save_data_log = $_SERVER["HTTP_HOST"].$_SERVER["PHP_SELF"];

		$obj_class = new Connectdb($obj_global->getHOST_CMS(), $obj_global->getUSER_CMS() , $obj_global->getPWD_CMS(), "employee",0,FALSE);

		$s_sql = "SELECT * from department WHERE dp_id_pk = ".$department_id;
		$b_resp = $obj_class->selectproc($s_sql);
		$obj_log->savelog($save_data_log,"get_department_name","sql=[$s_sql]");
		$datas = array();

		if ($b_resp && $obj_class->n_row>0) {	
			$datas[0]['dp_name'] = $obj_class->getitem("dp_name");
		}
		else {
			$datas[0] = null;
		}

		$obj_class->closedb();
		return $datas;
    }

    public function get_section_name($section_id) {
		$json_obj = new stdClass();
		$obj_global = new GlobalConstant();		
		$obj_log = new LogFile();		
		$save_data_log = $_SERVER["HTTP_HOST"].$_SERVER["PHP_SELF"];

		$obj_class = new Connectdb($obj_global->getHOST_CMS(), $obj_global->getUSER_CMS() , $obj_global->getPWD_CMS(), "employee",0,FALSE);

		$s_sql = "SELECT * from section WHERE st_id_pk = ".$section_id;
		$b_resp = $obj_class->selectproc($s_sql);
		$obj_log->savelog($save_data_log,"get_section_name","sql=[$s_sql]");
		$datas = array();

		if ($b_resp && $obj_class->n_row>0) {	
			$datas[0]['st_name'] = $obj_class->getitem("st_name");
		}
		else {
			$datas[0] = null;
		}

		$obj_class->closedb();
		return $datas;
    }

    public function get_level_by_company_id($company_id) {
		$json_obj = new stdClass();
		$obj_global = new GlobalConstant();		
		$obj_log = new LogFile();		
		$save_data_log = $_SERVER["HTTP_HOST"].$_SERVER["PHP_SELF"];

		$obj_class = new Connectdb($obj_global->getHOST_CMS(), $obj_global->getUSER_CMS() , $obj_global->getPWD_CMS(), "employee",0,FALSE);

		$s_sql = "SELECT DISTINCT emp_level from employee WHERE com_id_pk = ".$company_id." ORDER BY emp_level ASC";
		$b_resp = $obj_class->selectproc($s_sql);
		$obj_log->savelog($save_data_log,"get_level_by_company_id","sql=[$s_sql]");
		$level = array();

		if ($b_resp && $obj_class->n_row>0) {
			for($i=0;$i<$obj_class->n_row;$i++){	

				if($i == 0){
					$level[0]['ceo_level'] = $obj_class->getitem("emp_level");
				}
				else if($i == ($obj_class->n_row - 1)){
					$level[0]['emp_level'] = $obj_class->getitem("emp_level");
				}

			    $obj_class->movenext();
			}
		}
		else {
			$level[0] = null;
		}

		$obj_class->closedb();
		return $level;
    }

    public function check_buy_advance($company_id) {
		$json_obj = new stdClass();
		$obj_global = new GlobalConstant();		
		$obj_log = new LogFile();		
		$save_data_log = $_SERVER["HTTP_HOST"].$_SERVER["PHP_SELF"];

		$obj_class = new Connectdb($obj_global->getHOST_CMS(), $obj_global->getUSER_CMS() , $obj_global->getPWD_CMS(), "employee",0,FALSE);

		$s_sql = "SELECT * from company WHERE com_id_pk = ".$company_id." AND com_module LIKE '%advance%' ";
		$b_resp = $obj_class->selectproc($s_sql);
		$obj_log->savelog($save_data_log,"check_buy_advance","sql=[$s_sql]");
		$level = array();

		if($b_resp && $obj_class->n_row>0) {
			$buy_advance = true;
		}
		else {
			$buy_advance = false;
		}

		$obj_class->closedb();
		return $buy_advance;
    }

    public function get_summary_memo_status($params , $company_id , $division_id , $department_id , $section_id){
		$json_obj = new stdClass();
		$obj_global = new GlobalConstant();		
		$obj_log = new LogFile();		
		$save_data_log = $_SERVER["HTTP_HOST"].$_SERVER["PHP_SELF"];

		$obj_class_2 = new Connectdb($obj_global->getHOST_CMS(), $obj_global->getUSER_CMS() , $obj_global->getPWD_CMS(), "memo",0,FALSE);
		$obj_class_3 = new Connectdb($obj_global->getHOST_CMS(), $obj_global->getUSER_CMS() , $obj_global->getPWD_CMS(), "memo",0,FALSE);

		//$params['company_id']

		//$params['year']
		//$params['division_id']
		//$params['department_id']
		//$params['section_id']

		$params['year'] = (isset($params['year']) && ($params['year'] != ''))?$params['year']:'';
		$params['division_id'] = (isset($params['division_id']) && ($params['division_id'] != ''))?$params['division_id']:'';
		$params['department_id'] = (isset($params['department_id']) && ($params['department_id'] != ''))?$params['department_id']:'';
		$params['section_id'] = (isset($params['section_id']) && ($params['section_id'] != ''))?$params['section_id']:'';

		$s_sql_2 = "SELECT * from memo_status ORDER BY mst_id_pk ASC";
		$b_resp_2 = $obj_class_2->selectproc($s_sql_2);
		$datas_2 = array();
		
		if($b_resp_2 && $obj_class_2->n_row>0) {
			for($j=0;$j<$obj_class_2->n_row;$j++){	

				/*
				if(($params['division_id'] == '') && ($params['department_id'] == '') && ($params['section_id'] == '')){
					$s_sql_3 = "SELECT SUM(sm_total) AS total from summary_memo WHERE com_id_pk = ".$company_id." ";
					$s_sql_3.= "AND dv_id_pk = ".$division_id." ";
						
						
					if($params['year'] != ''){ 
						$s_sql_3.= "AND DATE_FORMAT(sm_trans_date , '%Y') = '".$params['year']."' ";
					}

					$s_sql_3.= "AND sm_status = '".$obj_class_2->getitem("mst_name")."' ";
					$s_sql_3.= "GROUP BY dv_id_pk ";
					
				}
				else if($params['division_id'] != ''){
					$s_sql_3 = "SELECT SUM(sm_total) AS total from summary_memo WHERE com_id_pk = ".$company_id." ";
					$s_sql_3.= "AND dv_id_pk = ".$division_id." ";
						
					if($params['department_id'] != ''){
						$s_sql_3.= "AND dp_id_pk = ".$department_id." ";
					}
					if($params['section_id'] != ''){
						$s_sql_3.= "AND st_id_pk = ".$section_id." ";
					}	
					if($params['year'] != ''){ 
						$s_sql_3.= "AND DATE_FORMAT(sm_trans_date , '%Y') = '".$params['year']."' ";
					}

					$s_sql_3.= "AND sm_status = '".$obj_class_2->getitem("mst_name")."' ";

					if(($params['division_id'] == '') && ($params['department_id'] == '') && ($params['section_id'] == '')){
						$s_sql_3.= "GROUP BY dv_id_pk ";
					}
					else if(($params['division_id'] != '') && ($params['department_id'] == '') && ($params['section_id'] == '')){
						$s_sql_3.= "GROUP BY dp_id_pk ";
					}
					else if(($params['division_id'] != '') && ($params['department_id'] != '') && ($params['section_id'] == '')){
						$s_sql_3.= "GROUP BY st_id_pk ";
					}
					else if(($params['division_id'] != '') && ($params['department_id'] != '') && ($params['section_id'] != '')){
						$s_sql_3.= "GROUP BY st_id_pk ";
					}
				}
				*/



				
				if(($params['division_id'] == '') && ($params['department_id'] == '') && ($params['section_id'] == '')){
					$s_sql_3 = "SELECT SUM(sm_total) AS total from summary_memo WHERE com_id_pk = ".$company_id." ";
					$s_sql_3.= "AND dv_id_pk = ".$division_id." ";
						
					if($params['year'] != ''){ 
						$s_sql_3.= "AND DATE_FORMAT(sm_trans_date , '%Y') = '".$params['year']."' ";
					}

					$s_sql_3.= "AND sm_status = '".$obj_class_2->getitem("mst_name")."' ";
					$s_sql_3.= "GROUP BY dv_id_pk ";
				}
				else if(($params['division_id'] != '') && ($params['department_id'] == '') && ($params['section_id'] == '')){
					$s_sql_3 = "SELECT SUM(sm_total) AS total from summary_memo WHERE com_id_pk = ".$company_id." ";
					$s_sql_3.= "AND dv_id_pk = ".$division_id." ";
					$s_sql_3.= "AND dp_id_pk = ".$department_id." ";
					$s_sql_3.= "AND st_id_pk = ".$section_id." ";
					
					if($params['year'] != ''){ 
						$s_sql_3.= "AND DATE_FORMAT(sm_trans_date , '%Y') = '".$params['year']."' ";
					}

					$s_sql_3.= "AND sm_status = '".$obj_class_2->getitem("mst_name")."' ";
					$s_sql_3.= "GROUP BY dp_id_pk ";
				}
				else if(($params['division_id'] != '') && ($params['department_id'] != '') && ($params['section_id'] == '')){
					$s_sql_3 = "SELECT SUM(sm_total) AS total from summary_memo WHERE com_id_pk = ".$company_id." ";
					$s_sql_3.= "AND dv_id_pk = ".$division_id." ";
					$s_sql_3.= "AND dp_id_pk = ".$department_id." ";
					$s_sql_3.= "AND st_id_pk = ".$section_id." ";
					
					if($params['year'] != ''){ 
						$s_sql_3.= "AND DATE_FORMAT(sm_trans_date , '%Y') = '".$params['year']."' ";
					}

					$s_sql_3.= "AND sm_status = '".$obj_class_2->getitem("mst_name")."' ";
					$s_sql_3.= "GROUP BY st_id_pk ";
				}
				else if(($params['division_id'] != '') && ($params['department_id'] != '') && ($params['section_id'] != '')){
					$s_sql_3 = "SELECT SUM(sm_total) AS total from summary_memo WHERE com_id_pk = ".$company_id." ";
					$s_sql_3.= "AND dv_id_pk = ".$division_id." ";
					$s_sql_3.= "AND dp_id_pk = ".$department_id." ";
					$s_sql_3.= "AND st_id_pk = ".$section_id." ";
					
					if($params['year'] != ''){ 
						$s_sql_3.= "AND DATE_FORMAT(sm_trans_date , '%Y') = '".$params['year']."' ";
					}

					$s_sql_3.= "AND sm_status = '".$obj_class_2->getitem("mst_name")."' ";
					$s_sql_3.= "GROUP BY st_id_pk ";
				}
				

				$b_resp_3 = $obj_class_3->selectproc($s_sql_3);
				
				$datas_2[$j]['memo_status_id'] = $obj_class_2->getitem("mst_id_pk");
				$datas_2[$j]['memo_status_name'] = $obj_class_2->getitem("mst_name");

				if($b_resp_3 && $obj_class_3->n_row>0) {
					$datas_2[$j]['memo_status_sum'] = $obj_class_3->getitem("total");
				}
				else{
					$datas_2[$j]['memo_status_sum'] = 0;
				}

				$obj_class_2->movenext();
			}
		}

		return $datas_2;
    }

    public function get_summary_advance_status($params , $company_id , $division_id , $department_id , $section_id){
		$json_obj = new stdClass();
		$obj_global = new GlobalConstant();		
		$obj_log = new LogFile();		
		$save_data_log = $_SERVER["HTTP_HOST"].$_SERVER["PHP_SELF"];

		$obj_class_2 = new Connectdb($obj_global->getHOST_CMS(), $obj_global->getUSER_CMS() , $obj_global->getPWD_CMS(), "memo",0,FALSE);
		$obj_class_3 = new Connectdb($obj_global->getHOST_CMS(), $obj_global->getUSER_CMS() , $obj_global->getPWD_CMS(), "memo",0,FALSE);

		//$params['company_id']

		//$params['year']
		//$params['division_id']
		//$params['department_id']
		//$params['section_id']

		$params['year'] = (isset($params['year']) && ($params['year'] != ''))?$params['year']:'';
		$params['division_id'] = (isset($params['division_id']) && ($params['division_id'] != ''))?$params['division_id']:'';
		$params['department_id'] = (isset($params['department_id']) && ($params['department_id'] != ''))?$params['department_id']:'';
		$params['section_id'] = (isset($params['section_id']) && ($params['section_id'] != ''))?$params['section_id']:'';

		$s_sql_2 = "SELECT * from advance_status ORDER BY avst_id_pk ASC";
		$b_resp_2 = $obj_class_2->selectproc($s_sql_2);
		$datas_2 = array();

		if($b_resp_2 && $obj_class_2->n_row>0) {
			for($j=0;$j<$obj_class_2->n_row;$j++){	

				if(($params['division_id'] == '') && ($params['department_id'] == '') && ($params['section_id'] == '')){
					$s_sql_3 = "SELECT SUM(smav_total) AS total from summary_memo_advance WHERE com_id_pk = ".$company_id." ";
					$s_sql_3.= "AND dv_id_pk = ".$division_id." ";
						
					if($params['year'] != ''){ 
						$s_sql_3.= "AND DATE_FORMAT(smav_trans_date , '%Y') = '".$params['year']."' ";
					}

					$s_sql_3.= "AND smav_status = '".$obj_class_2->getitem("avst_name")."' ";
					$s_sql_3.= "GROUP BY dv_id_pk ";
				}
				else if(($params['division_id'] != '') && ($params['department_id'] == '') && ($params['section_id'] == '')){
					$s_sql_3 = "SELECT SUM(smav_total) AS total from summary_memo_advance WHERE com_id_pk = ".$company_id." ";
					$s_sql_3.= "AND dv_id_pk = ".$division_id." ";
					$s_sql_3.= "AND dp_id_pk = ".$department_id." ";
					$s_sql_3.= "AND st_id_pk = ".$section_id." ";
					
					if($params['year'] != ''){ 
						$s_sql_3.= "AND DATE_FORMAT(smav_trans_date , '%Y') = '".$params['year']."' ";
					}

					$s_sql_3.= "AND smav_status = '".$obj_class_2->getitem("avst_name")."' ";
					$s_sql_3.= "GROUP BY dp_id_pk ";
				}
				else if(($params['division_id'] != '') && ($params['department_id'] != '') && ($params['section_id'] == '')){
					$s_sql_3 = "SELECT SUM(smav_total) AS total from summary_memo_advance WHERE com_id_pk = ".$company_id." ";
					$s_sql_3.= "AND dv_id_pk = ".$division_id." ";
					$s_sql_3.= "AND dp_id_pk = ".$department_id." ";
					$s_sql_3.= "AND st_id_pk = ".$section_id." ";
					
					if($params['year'] != ''){ 
						$s_sql_3.= "AND DATE_FORMAT(smav_trans_date , '%Y') = '".$params['year']."' ";
					}

					$s_sql_3.= "AND smav_status = '".$obj_class_2->getitem("avst_name")."' ";
					$s_sql_3.= "GROUP BY st_id_pk ";
				}
				else if(($params['division_id'] != '') && ($params['department_id'] != '') && ($params['section_id'] != '')){
					$s_sql_3 = "SELECT SUM(smav_total) AS total from summary_memo_advance WHERE com_id_pk = ".$company_id." ";
					$s_sql_3.= "AND dv_id_pk = ".$division_id." ";
					$s_sql_3.= "AND dp_id_pk = ".$department_id." ";
					$s_sql_3.= "AND st_id_pk = ".$section_id." ";
					
					if($params['year'] != ''){ 
						$s_sql_3.= "AND DATE_FORMAT(smav_trans_date , '%Y') = '".$params['year']."' ";
					}

					$s_sql_3.= "AND smav_status = '".$obj_class_2->getitem("avst_name")."' ";
					$s_sql_3.= "GROUP BY st_id_pk ";
				}
				
				$b_resp_3 = $obj_class_3->selectproc($s_sql_3);
				
				$datas_2[$j]['advance_status_id'] = $obj_class_2->getitem("avst_id_pk");
				$datas_2[$j]['advance_status_name'] = $obj_class_2->getitem("avst_name");

				if($b_resp_3 && $obj_class_3->n_row>0) {
					$datas_2[$j]['advance_status_sum'] = $obj_class_3->getitem("total");
				}
				else{
					$datas_2[$j]['advance_status_sum'] = 0;
				}

				$obj_class_2->movenext();
			}
		}
		
		return $datas_2;
    }

    public function get_memo_last_id() {
		$json_obj = new stdClass();
		$obj_global = new GlobalConstant();		
		$obj_log = new LogFile();		
		$save_data_log = $_SERVER["HTTP_HOST"].$_SERVER["PHP_SELF"];

		$obj_class = new Connectdb($obj_global->getHOST_CMS(), $obj_global->getUSER_CMS() , $obj_global->getPWD_CMS(), "memo",0,FALSE);

		$s_sql = "SELECT mm_id_pk from memo ORDER BY mm_id_pk DESC";
		$b_resp = $obj_class->selectproc($s_sql);
		$obj_log->savelog($save_data_log,"get_memo_last_id","sql=[$s_sql]");
		$datas = array();

		if ($b_resp && $obj_class->n_row>0) {
			$mm_last_id = $obj_class->getitem("mm_id_pk");
		}
		else {
			$mm_last_id = null;
		}

		$obj_class->closedb();
		return $mm_last_id;
    }

    public function get_advance_last_id() {
		$json_obj = new stdClass();
		$obj_global = new GlobalConstant();		
		$obj_log = new LogFile();		
		$save_data_log = $_SERVER["HTTP_HOST"].$_SERVER["PHP_SELF"];

		$obj_class = new Connectdb($obj_global->getHOST_CMS(), $obj_global->getUSER_CMS() , $obj_global->getPWD_CMS(), "memo",0,FALSE);

		$s_sql = "SELECT avf_id_pk from advance_form ORDER BY avf_id_pk DESC";
		$b_resp = $obj_class->selectproc($s_sql);
		$obj_log->savelog($save_data_log,"get_advance_last_id","sql=[$s_sql]");
		$datas = array();

		if ($b_resp && $obj_class->n_row>0) {
			$avf_last_id = $obj_class->getitem("avf_id_pk");
		}
		else {
			$avf_last_id = null;
		}

		$obj_class->closedb();
		return $avf_last_id;
    }

    public function generate_image_thumbnail($source_image_path, $thumbnail_image_path){
	    list($source_image_width, $source_image_height, $source_image_type) = getimagesize($source_image_path);
	    switch ($source_image_type) {
	        case IMAGETYPE_GIF:
	            $source_gd_image = imagecreatefromgif($source_image_path);
	            break;
	        case IMAGETYPE_JPEG:
	            $source_gd_image = imagecreatefromjpeg($source_image_path);
	            break;
	        case IMAGETYPE_PNG:
	            $source_gd_image = imagecreatefrompng($source_image_path);
	            break;
	    }
	    if ($source_gd_image === false) {
	        return false;
	    }
	    $source_aspect_ratio = $source_image_width / $source_image_height;
	    $thumbnail_aspect_ratio = THUMBNAIL_IMAGE_MAX_WIDTH / THUMBNAIL_IMAGE_MAX_HEIGHT;
	    if ($source_image_width <= THUMBNAIL_IMAGE_MAX_WIDTH && $source_image_height <= THUMBNAIL_IMAGE_MAX_HEIGHT) {
	        $thumbnail_image_width = $source_image_width;
	        $thumbnail_image_height = $source_image_height;
	    } elseif ($thumbnail_aspect_ratio > $source_aspect_ratio) {
	        $thumbnail_image_width = (int) (THUMBNAIL_IMAGE_MAX_HEIGHT * $source_aspect_ratio);
	        $thumbnail_image_height = THUMBNAIL_IMAGE_MAX_HEIGHT;
	    } else {
	        $thumbnail_image_width = THUMBNAIL_IMAGE_MAX_WIDTH;
	        $thumbnail_image_height = (int) (THUMBNAIL_IMAGE_MAX_WIDTH / $source_aspect_ratio);
	    }
	    $thumbnail_gd_image = imagecreatetruecolor($thumbnail_image_width, $thumbnail_image_height);
	    imagecopyresampled($thumbnail_gd_image, $source_gd_image, 0, 0, 0, 0, $thumbnail_image_width, $thumbnail_image_height, $source_image_width, $source_image_height);

	    $img_disp = imagecreatetruecolor(THUMBNAIL_IMAGE_MAX_WIDTH,THUMBNAIL_IMAGE_MAX_WIDTH);
	    $backcolor = imagecolorallocate($img_disp,0,0,0);
	    imagefill($img_disp,0,0,$backcolor);

	        imagecopy($img_disp, $thumbnail_gd_image, (imagesx($img_disp)/2)-(imagesx($thumbnail_gd_image)/2), (imagesy($img_disp)/2)-(imagesy($thumbnail_gd_image)/2), 0, 0, imagesx($thumbnail_gd_image), imagesy($thumbnail_gd_image));

	    imagejpeg($img_disp, $thumbnail_image_path, 90);
	    imagedestroy($source_gd_image);
	    imagedestroy($thumbnail_gd_image);
	    imagedestroy($img_disp);

	    return true;
	}

	public function add_summary_profile($company_id , $emp_com_id , $status) {
		$json_obj = new stdClass();
		$obj_global = new GlobalConstant();		
		$obj_log = new LogFile();		
		$save_data_log = $_SERVER["HTTP_HOST"].$_SERVER["PHP_SELF"];

		$obj_class = new Connectdb($obj_global->getHOST_CMS(), $obj_global->getUSER_CMS() , $obj_global->getPWD_CMS(), "memo",0,FALSE);

		$s_sql_1 = "SELECT * from summary_profile WHERE com_id_pk = ".$company_id." ";
		$s_sql_1.= "AND Emp_ID = '".$emp_com_id."' AND sp_status = '". $status."' ";
		$b_resp_1 = $obj_class->selectproc($s_sql_1);

		if($b_resp_1 && $obj_class->n_row>0) {
			$update_total = $obj_class->getitem("sp_total")+1;

			//update
			$s_sql_2 = "UPDATE summary_profile SET sp_total = ".$update_total." , sp_modified_date = NOW() ";
			$s_sql_2.= "WHERE com_id_pk = ".$company_id." ";
			$s_sql_2.= "AND Emp_ID = '".$emp_com_id."' ";
			$s_sql_2.= "AND sp_status = '". $status."' ";
			$b_flag_2 = $obj_class->manageproc($s_sql_2);
		}
		else{
			//insert
			$s_sql_2 = "INSERT INTO summary_profile (com_id_pk , Emp_ID , sp_status , sp_total , sp_created_date , sp_modified_date) ";
			$s_sql_2.= "VALUES (".$company_id." , '".$emp_com_id."' ";
			$s_sql_2.= ", '". $status."' , 1 ,  NOW() , NOW()) ";
			$b_flag_2 = $obj_class->manageproc($s_sql_2);
		}

		if($b_flag_2) {
			$result = true;
		}
		else {
			$result = false;
		}

		$obj_class->closedb();
		return $result;
    }

    public function delete_summary_profile($company_id , $emp_com_id , $status) {
		$json_obj = new stdClass();
		$obj_global = new GlobalConstant();		
		$obj_log = new LogFile();		
		$save_data_log = $_SERVER["HTTP_HOST"].$_SERVER["PHP_SELF"];

		$obj_class = new Connectdb($obj_global->getHOST_CMS(), $obj_global->getUSER_CMS() , $obj_global->getPWD_CMS(), "memo",0,FALSE);

		$s_sql_1 = "SELECT * from summary_profile WHERE com_id_pk = ".$company_id." ";
		$s_sql_1.= "AND Emp_ID = '".$emp_com_id."' AND sp_status = '". $status."' ";
		$b_resp_1 = $obj_class->selectproc($s_sql_1);

		if($b_resp_1 && $obj_class->n_row>0) {
			$update_total = $obj_class->getitem("sp_total")-1;

			//update
			$s_sql_2 = "UPDATE summary_profile SET sp_total = ".$update_total." , sp_modified_date = NOW() ";
			$s_sql_2.= "WHERE com_id_pk = ".$company_id." ";
			$s_sql_2.= "AND Emp_ID = '".$emp_com_id."' ";
			$s_sql_2.= "AND sp_status = '". $status."' ";
			$b_flag_2 = $obj_class->manageproc($s_sql_2);
		}
		else{
			//insert
			$s_sql_2 = "INSERT INTO summary_profile (com_id_pk , Emp_ID , sp_status , sp_total , sp_created_date , sp_modified_date) ";
			$s_sql_2.= "VALUES (".$company_id." , '".$emp_com_id."' ";
			$s_sql_2.= ", '". $status."' , 0 ,  NOW() , NOW()) ";
			$b_flag_2 = $obj_class->manageproc($s_sql_2);
		}

		if($b_flag_2) {
			$result = true;
		}
		else {
			$result = false;
		}

		$obj_class->closedb();
		return $result;
    }
}
?>