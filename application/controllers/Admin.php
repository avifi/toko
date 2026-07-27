<?php if ( !defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Tenant_model');
        $this->load->model('Product_model');
        $this->load->model('Category_model');
        $this->load->model('Store_model');
        $this->load->library('session');
        $this->load->helper('url');

        // Check if user is logged in for all methods except login
        if ($this->router->fetch_method() != 'login') {
            if (!$this->session->userdata('admin_logged_in')) {
                redirect('admin/login');
            }
        }
    }

    public function dashboard()
    {
        $data['title'] = 'Admin Dashboard';
        $data['tenants'] = $this->Tenant_model->get_all();
        $data['total_products'] = count($this->Product_model->get_admin_list());
        $data['total_categories'] = count($this->Category_model->get_all());
        $data['store_settings'] = $this->Store_model->get_settings();
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

            if ($username === 'afifi' && $password === 'okebos') {
                $session_data = [
                    'admin_logged_in' => TRUE,
                    'username' => 'afifi'
                ];
                $this->session->set_userdata($session_data);
                redirect('admin/dashboard');
            } else {
                $this->session->set_flashdata('error', 'Username atau Password Salah');
                redirect('admin/login');
            }
        }

        $data['title'] = 'Login Admin';
        $this->load->view('admin/login', $data);
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('admin/login');
    }

    // ==========================================
    // PRODUCT MANAGEMENT
    // ==========================================

    public function products()
    {
        $data['title'] = 'Kelola Produk';
        $data['products'] = $this->Product_model->get_admin_list();
        $this->load->view('admin/products/index', $data);
    }

    public function product_add()
    {
        if ($this->input->post()) {
            $thumbnail = $this->input->post('existing_image');
            
            if (!empty($_FILES['thumbnail_image']['name'])) {
                $upload = $this->upload_media('thumbnail_image');
                if ($upload['status']) {
                    $thumbnail = $upload['file_path'];
                } else {
                    $this->session->set_flashdata('error', $upload['error']);
                    redirect('admin/product_add');
                }
            }

            $name = $this->input->post('name');
            $slug = url_title($name, '-', TRUE);

            $data = [
                'category_id'     => $this->input->post('category_id'),
                'name'            => $name,
                'slug'            => $slug,
                'price'           => $this->input->post('price'),
                'stock'           => $this->input->post('stock'),
                'description'     => $this->input->post('description'),
                'thumbnail_image' => $thumbnail ?: 'assets/uploads/kaos.png',
                'prime'           => $this->input->post('prime') ? 'Ya' : 'Tidak'
            ];

            if ($this->Product_model->insert($data)) {
                $this->session->set_flashdata('success', 'Produk berhasil ditambahkan');
                redirect('admin/products');
            } else {
                $this->session->set_flashdata('error', 'Gagal menambahkan produk');
            }
        }

        $data['title'] = 'Tambah Produk Baru';
        $data['categories'] = $this->Category_model->get_all();
        $this->load->view('admin/products/form', $data);
    }

    public function product_edit($id)
    {
        $data['product'] = $this->Product_model->get_by_id($id);
        if (!$data['product']) {
            show_404();
        }

        if ($this->input->post()) {
            $thumbnail = $data['product']['thumbnail_image'];

            if (!empty($_FILES['thumbnail_image']['name'])) {
                $upload = $this->upload_media('thumbnail_image');
                if ($upload['status']) {
                    $thumbnail = $upload['file_path'];
                } else {
                    $this->session->set_flashdata('error', $upload['error']);
                    redirect('admin/product_edit/' . $id);
                }
            }

            $name = $this->input->post('name');
            $slug = url_title($name, '-', TRUE);

            $update_data = [
                'category_id'     => $this->input->post('category_id'),
                'name'            => $name,
                'slug'            => $slug,
                'price'           => $this->input->post('price'),
                'stock'           => $this->input->post('stock'),
                'description'     => $this->input->post('description'),
                'thumbnail_image' => $thumbnail,
                'prime'           => $this->input->post('prime') ? 'Ya' : 'Tidak'
            ];

            if ($this->Product_model->update($id, $update_data)) {
                $this->session->set_flashdata('success', 'Produk berhasil diperbarui');
                redirect('admin/products');
            } else {
                $this->session->set_flashdata('error', 'Gagal memperbarui produk');
            }
        }

        $data['title'] = 'Edit Produk';
        $data['categories'] = $this->Category_model->get_all();
        $this->load->view('admin/products/form', $data);
    }

    public function product_delete($id)
    {
        if ($this->Product_model->delete($id)) {
            $this->session->set_flashdata('success', 'Produk berhasil dihapus');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus produk');
        }
        redirect('admin/products');
    }

    // ==========================================
    // CATEGORY MANAGEMENT
    // ==========================================

    public function categories()
    {
        $data['title'] = 'Kelola Kategori';
        $data['categories'] = $this->Category_model->get_all();
        $this->load->view('admin/categories/index', $data);
    }

    public function category_add()
    {
        if ($this->input->post()) {
            $image = '';
            if (!empty($_FILES['image']['name'])) {
                $upload = $this->upload_media('image');
                if ($upload['status']) {
                    $image = $upload['file_path'];
                }
            }

            $name = $this->input->post('name');
            $data = [
                'name'        => $name,
                'slug'        => url_title($name, '-', TRUE),
                'description' => $this->input->post('description'),
                'image'       => $image
            ];

            if ($this->Category_model->insert($data)) {
                $this->session->set_flashdata('success', 'Kategori berhasil ditambahkan');
                redirect('admin/categories');
            } else {
                $this->session->set_flashdata('error', 'Gagal menambahkan kategori');
            }
        }

        $data['title'] = 'Tambah Kategori';
        $this->load->view('admin/categories/form', $data);
    }

    public function category_edit($id)
    {
        $data['category'] = $this->Category_model->get_by_id($id);
        if (!$data['category']) {
            show_404();
        }

        if ($this->input->post()) {
            $image = $data['category']['image'];
            if (!empty($_FILES['image']['name'])) {
                $upload = $this->upload_media('image');
                if ($upload['status']) {
                    $image = $upload['file_path'];
                }
            }

            $name = $this->input->post('name');
            $update_data = [
                'name'        => $name,
                'slug'        => url_title($name, '-', TRUE),
                'description' => $this->input->post('description'),
                'image'       => $image
            ];

            if ($this->Category_model->update($id, $update_data)) {
                $this->session->set_flashdata('success', 'Kategori berhasil diperbarui');
                redirect('admin/categories');
            } else {
                $this->session->set_flashdata('error', 'Gagal memperbarui kategori');
            }
        }

        $data['title'] = 'Edit Kategori';
        $this->load->view('admin/categories/form', $data);
    }

    public function category_delete($id)
    {
        if ($this->Category_model->delete($id)) {
            $this->session->set_flashdata('success', 'Kategori berhasil dihapus');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus kategori');
        }
        redirect('admin/categories');
    }

    // ==========================================
    // STORE SETTINGS
    // ==========================================

    public function settings()
    {
        if ($this->input->post()) {
            $settings = [
                'name'        => $this->input->post('name'),
                'slogan'      => $this->input->post('slogan'),
                'description' => $this->input->post('description'),
                'hero_title'  => $this->input->post('hero_title'),
                'hero_subtitle' => $this->input->post('hero_subtitle'),
                'whatsapp'    => $this->input->post('whatsapp'),
                'phone'       => $this->input->post('phone'),
                'address'     => $this->input->post('address'),
                'email'       => $this->input->post('email')
            ];

            if (!empty($_FILES['logo']['name'])) {
                $upload = $this->upload_media('logo');
                if ($upload['status']) {
                    $settings['logo'] = $upload['file_path'];
                }
            }

            foreach ($settings as $key => $val) {
                $this->Store_model->set($key, $val);
            }

            $this->session->set_flashdata('success', 'Pengaturan Toko Berhasil Disimpan');
            redirect('admin/settings');
        }

        $data['title'] = 'Pengaturan Toko';
        $data['store'] = $this->Store_model->get_settings();
        $this->load->view('admin/settings', $data);
    }

    // ==========================================
    // TENANT MANAGEMENT
    // ==========================================

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

    /**
     * Upload media file to assets/uploads directory
     * 
     * @param string $field_name HTML form file input field name
     * @return array Result containing status and file_path or error
     */
    public function upload_media($field_name = 'media_file')
    {
        $config['upload_path']   = './assets/uploads/';
        $config['allowed_types'] = 'gif|jpg|jpeg|png|webp|svg';
        $config['max_size']      = 5120; // 5MB
        $config['encrypt_name']  = TRUE;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload($field_name)) {
            return [
                'status' => FALSE,
                'error'  => $this->upload->display_errors('', '')
            ];
        } else {
            $data = $this->upload->data();
            return [
                'status'    => TRUE,
                'file_path' => 'assets/uploads/' . $data['file_name']
            ];
        }
    }
}
