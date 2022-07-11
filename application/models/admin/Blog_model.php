<?php class Blog_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();

        $this->load->helper('string');
    }

    public function listBlog($data = [])
    {

        $condition = array(
            'blog_status' => 1,
        );


        $this->db->select('');
        $this->db->from('blog');
        $this->db->where($condition);
        // $this->db->join('course','course.course_id = batch.course_id');

        //search
        if (isset($data['search'])) {
            $this->db->like('blog_name', $data['search'], 'after');
        }

        //Limit
        if (isset($data['limit']) && isset($data['start'])) {

            if ($data['limit']) {
                $limit = $data['limit'];
            } else {
                $limit = 20;
            }

            if ($data['start']) {
                $start = $data['start'];
            } else {
                $start = 0;
            }

            $this->db->limit($limit, $start);
        }


        //Sort
        if (isset($data['sort'])) {
            $sort = $data['sort'];
        } else {
            $sort = 'blog_id';
        }

        if (isset($data['order'])) {
            $order = $data['order'];
        } else {
            $order = 'DESC';
        }

        $this->db->order_by($sort, $order);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return 0;
        }
    }

    public function getBlogCount()
    {
        $this->db->where('blog_status', 1);
        $query = $this->db->get('blog');
        return  $query->num_rows();
    }

    public function getRecentPost($blog_id)
    {
        $this->db->where('blog_status', 1);
        $this->db->where('blog_id !=', $blog_id);
        $this->db->order_by("created_datetime", "desc");
        $this->db->limit(3);
        $query = $this->db->get('blog');
        return $query->result();
    }
    // public function getComments($blog_id)
    // {
    //     $this->db->where('cmt_status', 1);
    //     $this->db->where('parent_id', 0);
    //     $this->db->where('blog_id', $blog_id);
    //     $this->db->order_by("created_datetime", "desc");
    //     $query = $this->db->get('lib_comments');
    //     return $query->result();
    // }
    // public function getRplyComments($blog_id)
    // {
    //     $this->db->where('cmt_status', 1);
    //     $this->db->where('parent_id !=', 0);
    //     $this->db->where('blog_id', $blog_id);
    //     $this->db->order_by("created_datetime", "desc");
    //     $query = $this->db->get('lib_comments');
    //     return $query->result();
    // }
    public function getCommentsCount($blog_id)
    {
        $this->db->where('cmt_status', 1);
        $this->db->where('blog_id', $blog_id);
        $this->db->order_by("created_datetime", "desc");
        $query = $this->db->get('blog_comments');
        return  $query->num_rows();
    }

    public function listTags($blog_id)
    {

        $condition = array(
            'blog_status' => 1,
            'blog_id' => $blog_id
        );

        $this->db->select('tags');
        $this->db->from('blog');
        // $this->db->join('course','course.course_id = batch.course_id');
        $this->db->where($condition);
        $this->db->order_by('tags');
        return $query = $this->db->get()->result();
    }


    public function addBlog()
    {

        $data = array(
            'blog_name' => $this->input->post('topic_name'),
            'blog_desc' => $this->input->post('descr'),
            'category_id' => $this->input->post('category_select'),
            'creater' => $this->session->userdata('first_name') . " " . $this->session->userdata('last_name'),
            'slug' => url_title($this->input->post('topic_name')),
            'creater_id' => $this->session->userdata('user_id'),
            'tags' => $this->input->post('tagstxt'),
            'blog_status' => 1,
            'created_datetime' => date('Y-m-d H:i:s')
        );
        $result = $this->db->insert('blog', $data);

        $insert_id = $this->db->insert_id();
        $result_array = array(
            'result' => $result,
            'insert_id' => $insert_id
        );
        return $result_array;
    }

    public function addComment($blog_id)
    {

        $data = array(
            'blog_id' => $blog_id,
            //'user_name' => $this->session->userdata('user_fname') . " " . $this->session->userdata('user_lname'),
            'user_id' => $this->session->userdata('user_id'),
            'comment' => $this->input->post('txtCmt'),
            'cmt_status' => 1,
            'created_datetime' => date('Y-m-d H:i:s')
        );
        return $result = $this->db->insert('blog_comments', $data);
    }
    // public function addRplyComment()
    // {

    //     $data = array(
    //         'blog_id' => $this->input->post('txtId'),
    //         'user_name' => $this->session->userdata('user_fname') . " " . $this->session->userdata('user_lname'),
    //         'comment' => $this->input->post('txtCmt'),
    //         'parent_id' => $this->input->post('parent_id'),
    //         'cmt_status' => 1,
    //         'created_datetime' => date('Y-m-d H:i:s')
    //     );
    //     return $result = $this->db->insert('lib_comments', $data);
    // }
    public function getBlogDetails($blog_id)
    {

        $this->db->where('blog_id', $blog_id);
        $query = $this->db->get('blog');
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }

    public function getBlogComment($blog_id)
    {

        $this->db->where('cmt_status', 1);
        $this->db->where('blog_id', $blog_id);
        $this->db->order_by("created_datetime", "desc");
        $query = $this->db->get('blog_comments');
        return $query->result();
    }

    public function editBlog()
    {

        $data = array(
            'blog_name' => $this->input->post('topic_name'),
            'slug' => url_title($this->input->post('topic_name')),
            'category_id' => $this->input->post('category_select'),
            'blog_desc' => $this->input->post('descr'),
            'tags' => $this->input->post('tagstxt'),
            'update_datetime' => date('Y-m-d H:i:s')
        );

        $this->db->where('blog_id', $this->input->post('blog_id'));
        $result = $this->db->update('blog', $data);
        return $result;
    }
    public function deleteComment($cmt_id)
    {
        $this->db->set('cmt_status', 0);
        $this->db->where('cmt_id', $cmt_id);
        return $result = $this->db->update('blog_comments');
    }

    public function deleteBlog($blog_id)
    {
        $this->db->set('blog_status', 0);
        $this->db->where('blog_id', $blog_id);
        return $result = $this->db->update('blog');
    }

    function saveImages($image_name, $blog_id, $column_name)
    {
        $data = array(
            $column_name => $image_name,
            'update_datetime' => date("Y-m-d H:i:s")
        );
        $this->db->where('blog_id', $blog_id);
        $result = $this->db->update('blog', $data);
        return $result;
    }
}
