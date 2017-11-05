<?php

Class Users extends CI_Controller {

    public function __construct() {

        parent::__construct();
        // Load form helper library
        $this->load->helper('form');

        // Load form validation library
        $this->load->library('form_validation');

        // Load session library
        $this->load->library('session');

        // Load database
        $this->load->model('user');
    }

    // Show login page
    public function index() {
        $this->load->view('users/login_form');
    }

    // Show registration page
    public function user_registration_show() {
        $this->load->view('users/registration_form');
    }

    // Validate and store registration data in database
    public function new_user_registration() {

        // Check validation for user input in SignUp form
        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('users/registration_form');
        } else {
            $data = array(
                'email' => $this->input->post('email'),
                'username' => $this->input->post('username'),
                'is_admin' => false, 
                'password' => $this->input->post('password')
            );

            $result = $this->user->registration_insert($data);

            if ($result == TRUE) {
                $data['message_display'] = 'Registration Successfully !';
                $this->load->view('users/login_form', $data);
            } else {
                $data['message_display'] = 'Username already exist!';
                $this->load->view('users/registration_form', $data);
            }
        }
    }

// Check for user login process
    public function user_login_process() {

        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            if(isset($this->session->userdata['logged_in'])){
                $this->load->view('users/admin_page');
            } else{
                $this->load->view('users/login_form');
            }

        } else {
            $data = array(
                'username' => $this->input->post('username'),
                'password' => $this->input->post('password')
            );

            $result = $this->user->login($data);
            if ($result == TRUE) {

                $username = $this->input->post('username');
                $result = $this->user->read_user_information($username);
                if ($result != false) {

                    $session_data = array(
                        'username' => $result[0]->username,
                        'email' => $result[0]->email,
                    );
                // Add user data in session
                    $this->session->set_userdata('logged_in', $session_data);
                    $this->load->view('users/admin_page');
                }
            } else {
                $data = array(
                    'error_message' => 'Invalid Username or Password'
                );
                $this->load->view('users/login_form', $data);
            }
        }
    }

// Logout from admin page
    public function logout() {

        // Removing session data
        $sess_array = array(
            'username' => ''
        );
        $this->session->unset_userdata('logged_in', $sess_array);
        $data['message_display'] = 'Successfully Logout';
        $this->load->view('users/login_form', $data);
    }

}

?>