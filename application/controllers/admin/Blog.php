<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Blog extends CI_Controller
{
    private $subscriber_type_id;
    private $user_id;
    private $adminArr = array();

    function __construct()
    {
        parent::__construct();
        $this->load->library('admin');
        $this->validate(); // Check if admin is loggedin
        $this->lang->load(array('admin/category'));    //Load Language  
        $this->load->model('admin/Blog_model', 'blog_model');
        $this->load->model('Users_model', 'model_users');
    }
    public function index()
    {


        $data = array();
        $data['no_fw'] = true;

        //Get Page Number
        if ($this->uri->segment(4)) {
            $page = (int)$this->uri->segment(4);
        } else {
            $page = 1;
        }

        $limit = 10;

        $data['logged'] = true;
        $data['heading_title'] = 'Blog';    //Heading Title
        $data['breadcrumb'] = array();    //Breadcrumb
        $data['breadcrumb'][] = array(
            'name' => 'Home',
            'href' => base_url() . 'admin/dashboard'
        );
        $data['breadcrumb'][] = array(
            'name' => 'Blog',
            'href' => base_url() . 'admin/blog'
        );
        $data['active_menu'] = 'mnu-blog';

        $data['breadcrumb_actions'][] = array(
            'type' => '',
            'name' => 'Add',
            'icon' => 'fas fa-plus',
            'id' => 'add-blog',
            'href' => base_url() . 'admin/blog/add',
        );

        //Get Admin Detail
        $data['admin'] = get_user_account($this->user_id);

        if ($this->session->userdata('success')) {
            $data['success'] = $this->session->userdata('success');
            $this->session->unset_userdata('success');
        }

        if ($this->session->userdata('error')) {
            $data['error'] = $this->session->userdata('error');
            $this->session->unset_userdata('error');
        }

        // $course_id = $this->uri->segment('4');   
        //Filter Data
        $filter_data = array(
            'start' => ($limit * ($page - 1)),
            'limit' => $limit,
            'sort' => 'blog_id',
            'order' => 'DESC'
        );
        if ($this->input->get('search')) {
            $filter_data['search'] = $this->input->get('search');
        } else {
            $filter_data[] = '';
        }

        $blog_list = $this->blog_model->listBlog($filter_data);
        // $ins_id = $this->BM->getInsId($course_id);  
        $data['blog'] = array(
            'blog_list' => $blog_list,
        );
        $blog_id = $this->uri->segment('4');

        //$data['blog_view'] = base_url() . 'admin/blog/view';
        //$data['blog_edit'] = base_url() . 'admin/blog/edit';

        $blog_count = $this->blog_model->getBlogCount();

        //Pagination
        $this->load->library('pagination');

        $config['base_url'] = base_url() . 'admin/blog/index/';
        $config['total_rows'] = $blog_count;
        $config['per_page'] = $limit;
        $config['use_page_numbers'] = TRUE;
        $config['attributes'] = array('class' => 'page-link');
        $config['prev_link'] = false;
        $config['next_link'] = false;
        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';
        $config['first_tag_open'] = '<li class="page-item">';
        $config['first_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li class="page-item">';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="page-item active"><a href="#" class="page-link">';
        $config['cur_tag_close'] = '</a></li>';


        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();

        $this->load->view('header', $data);
        $this->load->view('admin/blog/blog_list');
        $this->load->view('footer');
    }

    public function add()
    {

        $data = array();
        $data['no_fw'] = true;

        //Get Page Number
        if ($this->uri->segment(5)) {
            $page = (int)$this->uri->segment(5);
        } else {
            $page = 1;
        }

        $limit = 10;

        $data['logged'] = true;
        $data['heading_title'] = 'Blog Add';    //Heading Title
        $data['breadcrumb'] = array();    //Breadcrumb
        $data['breadcrumb'][] = array(
            'name' => 'Home',
            'href' => base_url() . 'admin/dashboard'
        );
        $data['breadcrumb'][] = array(
            'name' => 'Blog',
            'href' => base_url() . 'admin/blog'
        );
        $data['active_menu'] = 'mnu-blog';

        //Get Admin Detail
        $data['admin'] = get_user_account($this->user_id);

        if ($this->session->userdata('success')) {
            $data['success'] = $this->session->userdata('success');
            $this->session->unset_userdata('success');
        }

        if ($this->session->userdata('error')) {
            $data['error'] = $this->session->userdata('error');
            $this->session->unset_userdata('error');
        }

        //$category_list = $this->blog_model->listCategory();
        $this->load->model('admin/Jobcategory_model', 'model_jobcategory'); //Load Job_category model
        $filter_data = array(
            'status' => 1,
        );

        $data['job_categories'] = $this->model_jobcategory->getCategories(JOB_CATEGORY_TYPE, $filter_data);

        $this->load->view('header', $data);
        $this->load->view('admin/blog/blog_add');
        $this->load->view('footer');
    }

    public function add_blog()
    {
        $json = array();

        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            // print_r($_FILES);
            // exit;
            $result = $this->blog_model->addBlog();
            $blog_id =   $result['insert_id'];
            $data =   $result['result'];
            if ($data) {
                if (!empty($_FILES['topic_img']['name'])) {
                    $upload_path = APPPATH . 'assets/images/blog/blog_image';

                    $file_name = 'topic_img';

                    $image_name = $this->upload_image($upload_path, $file_name, $blog_id);
                    $save_image = $this->blog_model->saveImages($image_name, $blog_id, 'blog_image');
                }
                $json['success'] = true;
                $json['message'] = 'Blog details added successfully';
            } else {
                $json['error'] = true;
                $json['message'] = 'Blog details not added!';
            }
        } else {
            $json['error'] = true;
            $json['message'] = $this->loadErrors();
        }
        echo json_encode($json);
    }

    public function add_comment($blog_id)
    {
        $json = array();
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $result = $this->blog_model->addComment($blog_id);
            if ($result) {
                $json['success'] = true;
                $json['message'] = 'Comment added successfully';
            } else {
                $json['error'] = true;
                $json['message'] = 'Comment not added!';
            }
        } else {
            $json['error'] = true;
            $json['message'] = $this->loadErrors();
        }
        echo json_encode($json);
    }

    public function delete_comment($cmt_id)
    {
        $json = array();
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $result = $this->blog_model->deleteComment($cmt_id);
            if ($result) {
                $json['success'] = true;
                $json['message'] = 'Comment deleted successfully';
            } else {
                $json['error'] = true;
                $json['message'] = 'Comment not deleted!';
            }
        } else {
            $json['error'] = true;
            $json['message'] = $this->loadErrors();
        }
        echo json_encode($json);
    }

    public function addRplyComment()
    {
        $result = $this->blog_model->addRplyComment();
        echo json_encode($result);
    }


    public function view($slug,$blog_id)
    {

        $data = array();

        $data['logged'] = true;
        $data['heading_title'] = 'Blog Edit';    //Heading Title
        $data['breadcrumb'] = array();    //Breadcrumb
        $data['breadcrumb'][] = array(
            'name' => 'Home',
            'href' => base_url() . 'admin/dashboard'
        );
        $data['breadcrumb'][] = array(
            'name' => 'Blog',
            'href' => base_url() . 'admin/blog'
        );
        $data['active_menu'] = 'mnu-blog';

        //Get Admin Detail
        $data['admin'] = get_user_account($this->user_id);

        if ($this->session->userdata('success')) {
            $data['success'] = $this->session->userdata('success');
            $this->session->unset_userdata('success');
        }

        if ($this->session->userdata('error')) {
            $data['error'] = $this->session->userdata('error');
            $this->session->unset_userdata('error');
        }

        $blog_data = $this->blog_model->getBlogDetails($blog_id);
        $blog_comment = $this->blog_model->getBlogComment($blog_id);

        $recent_post = $this->blog_model->getRecentPost($blog_id);
        // $comments = $this->blog_model->getComments($blog_id);
        // $rply_comments = $this->blog_model->getRplyComments($blog_id);
        $comments_count = $this->blog_model->getCommentsCount($blog_id);
        //$user = $this->model_users->getUser($this->user_id);
        $tags_data = $this->blog_model->listTags($blog_id);
        //$categories_data = $this->blog_model->listCategory();

        $data['blog_details'] = array(
            'blog_id' => $blog_id,
            'blog_data' => $blog_data,
            'recent_post' => $recent_post,
            'blog_comment' => $blog_comment,
            'comment_count' => $comments_count,
            'tags_data' => $tags_data,
        );

        $this->load->model('admin/Jobcategory_model', 'model_jobcategory'); //Load Job_category model
        $filter_data = array(
            'status' => 1,
        );

        $data['job_categories'] = $this->model_jobcategory->getCategories(JOB_CATEGORY_TYPE, $filter_data);
        $data['user'] = $this->model_users->getUserDetails($filter_data);
        $this->load->view('header', $data);
        $this->load->view('admin/blog/blog_view');
        $this->load->view('footer');
    }

    public function edit($blog_id)
    {
        $data = array();

        $data['logged'] = true;
        $data['heading_title'] = 'Blog Edit';    //Heading Title
        $data['breadcrumb'] = array();    //Breadcrumb
        $data['breadcrumb'][] = array(
            'name' => 'Home',
            'href' => base_url() . 'admin/dashboard'
        );
        $data['breadcrumb'][] = array(
            'name' => 'Blog',
            'href' => base_url() . 'admin/blog'
        );
        $data['active_menu'] = 'mnu-blog';

        //Get Admin Detail
        $data['admin'] = get_user_account($this->user_id);

        if ($this->session->userdata('success')) {
            $data['success'] = $this->session->userdata('success');
            $this->session->unset_userdata('success');
        }

        if ($this->session->userdata('error')) {
            $data['error'] = $this->session->userdata('error');
            $this->session->unset_userdata('error');
        }


        $blog_data = $this->blog_model->getBlogDetails($blog_id);


        $data['blog_details'] = array(
            'blog_id' => $blog_id,
            'blog_data' => $blog_data,
        );
        //$category_list = $this->blog_model->listCategory();
        $this->load->model('admin/Jobcategory_model', 'model_jobcategory'); //Load Job_category model
        $filter_data = array(
            'status' => 1,
        );

        $data['job_categories'] = $this->model_jobcategory->getCategories(JOB_CATEGORY_TYPE, $filter_data);

        $this->load->view('header', $data);
        $this->load->view('admin/blog/blog_edit');
        $this->load->view('footer');
    }

    public function edit_blog($blog_id)
    {
        $json = array();

        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $data = $this->blog_model->editBlog();

            if ($data) {
                if (!empty($_FILES['topic_img']['name'])) {
                    $upload_path = APPPATH . 'assets/images/blog/blog_image';

                    $file_name = 'topic_img';

                    $image_name = $this->upload_image($upload_path, $file_name, $blog_id);
                    $this->blog_model->saveImages($image_name, $blog_id, 'blog_image');
                }
                $json['success'] = true;
                $json['message'] = 'Blog details updated successfully';
            } else {
                $json['error'] = true;
                $json['message'] = 'Blog details not updated!';
            }
        } else {
            $json['error'] = true;
            $json['message'] = $this->loadErrors();
        }
        echo json_encode($json);
    }

    public function delete_blog($blog_id)
    {
        $json = array();

        if ($this->input->server('REQUEST_METHOD') == 'POST') {

            $data = $this->blog_model->deleteBlog($blog_id);
            if ($data) {
                $json['success'] = true;
                $json['message'] = 'Blog details deleted successfully';
            } else {
                $json['error'] = true;
                $json['message'] = 'Blog details not deleted!';
            }
        } else {
            $json['error'] = true;
            $json['message'] = $this->loadErrors();
        }
        echo json_encode($json);
    }

    function upload_image($path, $file_name, $blog_id)
    {
        $config['upload_path'] = $path;
        $config['allowed_types'] = 'jpg|jpeg|png';
        $config['overwrite'] = TRUE;
        $config['file_name'] = $blog_id;

        //Load upload library and initialize configuration
        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        if ($this->upload->do_upload($file_name)) {
            $uploadData = $this->upload->data();
            return $picture = $uploadData['file_name'];
        } else {
            // echo $this->upload->display_error();
            return false;
        }
    }

    function uploadEditorImage()
    {
        $json = array();
        if (!empty($_FILES['efile']['name'])) {
            $upload_path = APPPATH . 'assets/images/blog/editor';

            $file_name = 'efile';
            $config['upload_path'] = $upload_path;
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['overwrite'] = TRUE;
            $config['file_name'] = 'editor_img' . time();

            //Load upload library and initialize configuration
            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if ($this->upload->do_upload($file_name)) {
                $uploadData = $this->upload->data();
                //return $picture = $uploadData['file_name'];
                $json = array(
                    'status' => 'success',
                    'link' => base_url() . 'application/assets/images/blog/editor/' . $uploadData['file_name'],
                );
            } else {
                // echo $this->upload->display_error();
                $json = array(
                    'status' => 'error',
                    'message' => $this->upload->display_error()
                );
            }
        } else {
            $json = array(
                'status' => 'error',
                'message' => 'please upload file'
            );
        }
        echo json_encode($json);
    }
    protected function loadDetails()
    {
        $this->load->helper('user'); // Load user helper
        $this->load->model('Users_model', 'model_user');
        $this->adminArr = $this->model_user->getUser($this->user_id);
    }

    protected function validate()
    {
        $this->user_id = $this->admin->isLogged();
        if (!$this->user_id) {
            redirect(base_url());
        } else {
            $this->loadDetails();
        }
    }

    protected function loadErrors()
    {
        $errorContent = '';
        if (isset($this->error['login'])) {
            $errorContent = $this->error['login'];
        } elseif (isset($this->error['profile'])) {
            $errorContent = $this->error['profile'];
        } elseif (isset($this->error['commission'])) {
            $errorContent = $this->error['commission'];
        }

        return $errorContent;
    }
}
