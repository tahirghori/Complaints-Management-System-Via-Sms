<?php

class Login extends CI_Controller {
	
	 function __construct()
 {
   parent::__construct();
  
 }
	function index()
	{
		$data['main_content'] = 'login_form';
		$this->load->view('includes/template', $data);		
	}
//---------------------------------
// AJAX REQUEST, IF EMAIL EXISTS
//---------------------------------
   function username_exists()
{  
   $username = $this->input->post("username");
   $query = $this->login_m->userNameExist($username);

  if ($query >0) {
    echo  "User already exists with the same email";
  }
  
}
//---------------------------------
// AJAX REQUEST, IF EMAIL EXISTS
//---------------------------------
	// ---------------------------------
	// AJAX REQUEST, IF EMAIL EXISTS
	// ---------------------------------
	function _404() {
		$this->load->view ( "error_404" );
	}
	
	function validate_credentials()
	{		
		$this->load->model('login_m');
		$query = $this->login_m->validate();
		
		if($query) // if the user's credentials validated...
		{
				$data = array(
			    'username' => $this->input->post('username'),
			    'user_role_id' => $query['0']['id'],
			    'is_logged_in' => true
			   );
			$this->session->set_userdata($data);
			redirect('complaint/complaint_list');
		}
		else // incorrect username or password
		{
			$this->index();
		}
	}	
	
	function signup()
	{
		$data['main_content'] = 'signup_form';
		$this->load->view('includes/template', $data);
	}
	
	
	function create_member()
	{
		$this->load->library('form_validation');
		
		// field name, error message, validation rules
		$this->form_validation->set_rules('first_name', 'Name', 'trim|required');
		$this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
		$this->form_validation->set_rules('email_address', 'Email Address', 'trim|required|valid_email');
		$this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[4]');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[4]|max_length[32]');
		$this->form_validation->set_rules('password2', 'Password Confirmation', 'trim|required|matches[password]');
		
		
		if($this->form_validation->run() == FALSE)
		{
			$this->load->view('signup_form');
		}
		
		else
		{			
			$this->load->model('login_m');
			
			if($query = $this->login_m->create_member())
			{
				$data['main_content'] = 'signup_successful';
				$this->load->view('includes/template', $data);
			}
			else
			{
				$this->load->view('signup_form');			
			}
		}
		
	}
	
	function logout()
	{
		$this->session->sess_destroy();
		$this->index();
	}

}