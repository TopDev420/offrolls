<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Blog extends CI_Controller
{
    private $subscriber_type_id;
    private $user_id;
    private $adminArr = array();
    private $error = array();

    function __construct()
    {
        parent::__construct();
        $this->load->library('Users');
        $this->load->helper('user');
        $this->load->model('admin/Blog_model', 'blog_model');
        $this->load->model('Users_model', 'model_users');
    }
    public function index()
    {
        $this->load->helper('category');
        $data = array();
        $data['no_fw'] = true;

        //Get Page Number
        if ($this->uri->segment(3)) {
            $page = (int)$this->uri->segment(3);
        } else {
            $page = 1;
        }

        $limit = 10;

        $logged = $this->users->isLogged();
        $user_id = $logged;
        if ($logged) {
            $data['logged'] = true;
            $user_type = $this->users->getUserType();
            //$redirect_url = getModuleActionURL($user_type);
            //redirect($redirect_url);
        } else {
            $data['logged'] = false;
        }

        $data['moduleAction'] = 'freelancer';

        if ($this->session->userdata('success')) {
            $data['success'] = $this->session->userdata('success');
            $this->session->unset_userdata('success');
        }

        if ($this->session->userdata('error')) {
            $data['error'] = $this->session->userdata('error');
            $this->session->unset_userdata('error');
        }

        $data['login'] = base_url() . 'login';
        $data['register'] = base_url() . 'register';

        if ($this->session->userdata('success')) {
            $data['success'] = $this->session->userdata('success');
            $this->session->unset_userdata('success');
        }

        if ($this->session->userdata('error')) {
            $data['error'] = $this->session->userdata('error');
            $this->session->unset_userdata('error');
        }


        // $blog_count = $this->blog_model->getBlogCount();
        $data['loadBlogDetails'] = base_url() . 'blog/getBlogDetails';

        $this->load->view('header', $data);
        $this->load->view('blog_list');
        $this->load->view('footer');
    }
    public function getBlogDetails()
    {
        $json = array();

        //Get Page Number
        if ($this->uri->segment(3)) {
            $page = (int)$this->uri->segment(3);
        } else {
            $page = 1;
        }

        $limit = 12;
        $logged = $this->users->isLogged();
        if ($logged) {
            $json['logged'] = true;
            $user_type = $this->users->getUserType();
        } else {
            $json['logged'] = false;
            $user_type = 0;
        }

        $moduleAction = getModuleAction($user_type);
        if ($moduleAction) {
            $data['moduleAction'] = $moduleAction;
        } else {
            $data['moduleAction'] = 'freelancer';
        }

        $json['blog'] = array();

        // Get freelancer
        $data['blog'] = array();

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


        // Get Blog List
        $json['blog']['total'] = 0;
        $json['blog']['list'] = array();
        // print_r($filter_data);
        $total_blog = $this->blog_model->getBlogCount();
        $blog_list = $this->blog_model->listBlog($filter_data);

        if ($blog_list) {
            $json['blog']['total'] = $total_blog;
            foreach ($blog_list as $blog) {

                //Load Image
                if ($blog->blog_image && file_exists(APPPATH . 'assets/images/blog/blog_image/' . $blog->blog_image)) {
                    $thumb = base_url() . 'application/assets/images/blog/blog_image/' . $blog->blog_image;
                } else {
                    $thumb = base_url() . 'application/assets/images/blog/blog-1.jpg';
                }

                $postTime = $blog->created_datetime;
                $createdTime = date('d-M-Y', strtotime($postTime));

                $json['blog']['list'][] = array(
                    'blog_id' => $blog->blog_id,
                    'blog_name' => $blog->blog_name,
                    'thumb' => $thumb,
                    'user_id' => $blog->creater_id,
                    'tags' => $blog->tags,
                    'post_date' => $createdTime,
                    'blog_view' => base_url() . 'blog/view/' . $blog->slug . '/' . $blog->blog_id,

                );
            }
        }
        $nextPage = ($limit * $page) <  $total_blog ? $page + 1 : false;
        if ($nextPage &&  $total_blog) {
            $json['blog']['view_more'] = array(
                'page' => $nextPage,
                'href' => base_url() . 'blog/getBlogDetails/' . $nextPage
            );
        }


        $json['success'] = true;

        echo json_encode($json);
    }

    //Blog detail page
    public function view($slug, $blog_id)
    {
        $this->load->helper('category');
        $data = array();
        $data['no_fw'] = true;
        $logged = $this->users->isLogged();
        $user_id = $logged;
        if ($logged) {
            $data['logged'] = true;
            $user_type = $this->users->getUserType();
            //$redirect_url = getModuleActionURL($user_type);
            //redirect($redirect_url);
        } else {
            $data['logged'] = false;
        }

        $data['moduleAction'] = 'freelancer';

        if ($this->session->userdata('success')) {
            $data['success'] = $this->session->userdata('success');
            $this->session->unset_userdata('success');
        }

        if ($this->session->userdata('error')) {
            $data['error'] = $this->session->userdata('error');
            $this->session->unset_userdata('error');
        }

        $data['login'] = base_url() . 'login';
        $data['register'] = base_url() . 'register';

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
        $data['user_details'] = $this->model_users->getUserDetails($filter_data);
        $data['meta_title'] = $blog_data->blog_name;
        $this->load->view('header', $data);
        $this->load->view('blog_view');
        $this->load->view('footer');
    }

    //To add comment to database
    public function add_comment($blog_id)
    {
        $json = array();

        //checking whether request is post type
        if ($this->input->server('REQUEST_METHOD') == 'POST' && $this->validate('return')) {
            $data['logged'] = true;

            //sending data to model file
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

    protected function validate($type = '')
    {
        $this->user_id = $this->users->isLogged();
        if (!$this->user_id) {
            if ($type == 'return') {
                $this->error['warning'] = 'Please login to your account';
            } else {
                redirect(base_url() . 'home');
            }
        } else {
            $this->loadDetails();
        }

        if ($type == 'return') {
            return !$this->error;
        }
    }

    protected function loadDetails()
    {
        $this->load->library('Users');
        $this->load->helper('user');
        $this->load->model('admin/Blog_model', 'blog_model');
        $this->load->model('Users_model', 'model_users');
    }

    protected function loadErrors()
    {
        $errorContent = '';
        if (isset($this->error['warning'])) {
            return $this->error['warning'];
        } elseif (isset($this->error['error'])) {
            return $this->error['error'];
        } else {
            return '';
        }

        return $errorContent;
    }
}
