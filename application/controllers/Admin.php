<?php if ( !defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Tenant_model');
        $this->load->library('session');

        // Check if user is logged in for all methods except login
        if ($this->router->fetch_method() != 'login') {
            if (!$this->session->userdata('admin_logged_in')) {
                redirect('admin/login');
            }
        }
    }

    public function dashboard()
    {
        $data['title'] = 'Dashboard';
        $data['tenants'] = $this->Tenant_model->get_all();
        $this->load->view('admin/dashboard', $data);
    }

    public function login()
    {
        if ($this->session->userdata('admin_logged_in')) {
            redirect('admin/dashboard');
        }

        if ($this->input->post()) {
            $username = $this->input->post('username');
            $password = $this->input->post('password');

            // Hardcoded credentials as requested
            if ($username === 'afifi' && $password === 'okebos') {
                $session_data = [
                    'admin_logged_in' => TRUE,
                    'username' => 'afifi'
                ];
                $this->session->set_userdata($session_data);
                redirect('admin/dashboard');
            } else {
                $this->session->set_flashdata('error', 'Invalid Username or Password');
                redirect('admin/login');
            }
        }

        $data['title'] = 'Login';
        $this->load->view('admin/login', $data);
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('admin/login');
    }

    // Tenant Management

    public function tenant_create()
    {
        if ($this->input->post()) {
            $data = [
                'domain' => $this->input->post('domain'),
                'google_sheet_id' => $this->input->post('google_sheet_id'),
                'google_api_key' => $this->input->post('google_api_key'),
                'email' => $this->input->post('email'),
                'username' => $this->input->post('username'),
                'phone' => $this->input->post('phone'),
                'ends_on' => $this->input->post('ends_on') ? $this->input->post('ends_on') : NULL
            ];

            if ($this->Tenant_model->insert($data)) {
                $this->session->set_flashdata('success', 'Tenant created successfully');
                redirect('admin/dashboard');
            } else {
                $this->session->set_flashdata('error', 'Failed to create tenant');
            }
        }

        $data['title'] = 'Add New Tenant';
        $this->load->view('admin/form', $data);
    }

    public function tenant_edit($id)
    {
        $data['tenant'] = $this->Tenant_model->get_by_id($id);
        if (!$data['tenant']) {
            show_404();
        }

        if ($this->input->post()) {
            $update_data = [
                'domain' => $this->input->post('domain'),
                'google_sheet_id' => $this->input->post('google_sheet_id'),
                'google_api_key' => $this->input->post('google_api_key'),
                'email' => $this->input->post('email'),
                'username' => $this->input->post('username'),
                'phone' => $this->input->post('phone'),
                'ends_on' => $this->input->post('ends_on') ? $this->input->post('ends_on') : NULL
            ];

            if ($this->Tenant_model->update($id, $update_data)) {
                $this->session->set_flashdata('success', 'Tenant updated successfully');
                redirect('admin/dashboard');
            } else {
                $this->session->set_flashdata('error', 'Failed to update tenant');
            }
        }

        $data['title'] = 'Edit Tenant';
        $this->load->view('admin/form', $data);
    }
    
    public function tenant_delete($id)
    {
        if ($this->Tenant_model->delete($id)) {
            $this->session->set_flashdata('success', 'Tenant deleted successfully');
        } else {
            $this->session->set_flashdata('error', 'Failed to delete tenant');
        }
        redirect('admin/dashboard');
    }
}
