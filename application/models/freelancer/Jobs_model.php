<?php
class Jobs_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getJobs($data = array())
    {
        $this->db->distinct();
        $this->db->select('j.*, c.company_name AS company_name, c.company_id, u.user_id, u.image AS company_logo');
        $this->db->from('company_freelancer_jobs AS j');
        $this->db->join('company AS c', 'j.company_id = c.company_id');
        $this->db->join('user AS u', 'u.user_id = c.user_id');

        //Filter Condition
        $condition = array();
        $condition['j.status'] = 1;
        if (isset($data['company_id'])) {
            $condition['j.company_id'] = $data['company_id'];
        }

        if ($condition) {
            $this->db->where($condition);
        }


        // For Search Query
        if (isset($data['search'])) {
            if (is_array($data['search'])) {
                if ($data['search']) {
                    //  $this->db->join('job_category AS jc', 'j.job_category = jc.category_id');
                    foreach ($data['search'] as $search) {
                        $this->db->like('j.title', $search);
                    }

                    //  $this->db->like('company_name', $data['search']);
                    //  $this->db->or_where_in('jc.name', $data['search']);
                }
            }
        }



        //Filter Job id
        if (isset($data['filter_jobs_not'])) {
            $this->db->where_not_in('j.job_id', $data['filter_jobs_not']);
        }

        //Filter Title/Category
        if (isset($data['filter_title'])) {
            if ($data['filter_title']) {
                $this->db->like('REPLACE(j.title, " ", "-")', preg_replace('[\s]', '-', $data['filter_title']));
            }
        }

        //Job Filters
        if (isset($data['job_filter'])) {
            if ($data['job_filter'] == 'join') {
                $this->db->join('job_filter AS jfs', 'j.job_id = jfs.job_id');
                $this->db->where('jfs.type', FREELANCER_TYPE);

                //Filter Skills
                if (isset($data['filter_skills'])) {
                    if ($data['filter_skills']) {
                        $this->db->where('jfs.filter_keyword', 'filter_skill');
                        $this->db->where_in('jfs.filter_id', $data['filter_skills']);
                    }
                }

                //Filter language
                if (isset($data['filter_language'])) {
                    if ($data['filter_language']) {
                        $this->db->where('jfs.filter_keyword', 'filter_language');
                        $this->db->where_in('jfs.filter_id', $data['filter_language']);
                    }
                }
            }
        }

        //Filter Location
        if (isset($data['filter_location'])) {
            if ($data['filter_location']) {
                $this->db->where('LOWER(j.location)', strtolower($data['filter_location']));
            }
        }

        //Filter Location
        if (isset($data['filter_budget_type'])) {
            if ($data['filter_budget_type']) {
                $this->db->where('LOWER(j.pay_type)', strtolower($data['filter_budget_type']));
            }
        }

        //Filter Budget Range From
        if (isset($data['filter_budget_range_from'])) {
            if ($data['filter_budget_range_from']) {
                $this->db->where('j.pay_amount >=', $data['filter_budget_range_from']);
            }
        }

        //Filter  Budget Range To
        if (isset($data['filter_budget_range_to'])) {
            if ($data['filter_budget_range_to']) {
                $this->db->where('j.pay_amount <=', $data['filter_budget_range_to']);
            }
        }

        //Filter Experience
        if (isset($data['filter_experience'])) {
            if ($data['filter_experience']) {
                $this->db->where('j.experience', $data['filter_experience']);
            }
        }

        //Filter DatePost
        if (isset($data['filter_datepost'])) {
            if ($data['filter_datepost']) {
                $this->db->where('IF(j.date_modified, DATE(j.date_modified), DATE(j.date_added)) >=', $data['filter_datepost']);
            }
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
            $sort = 'j.job_id';
        }

        if (isset($data['order'])) {
            $order = $data['order'];
        } else {
            $order = 'DESC';
        }

        $this->db->order_by($sort, $order);
        $query = $this->db->get();
        //echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function getTotalJobs($data = array())
    {
        $this->db->distinct();
        $this->db->select('COUNT(*) AS total');
        $this->db->from('company_freelancer_jobs AS j');
        $this->db->join('company AS c', 'j.company_id = c.company_id');
        $this->db->join('user AS u', 'u.user_id = c.user_id');
        //For Search Query
        // For Search Query
        if (isset($data['search'])) {
            if (is_array($data['search'])) {
                if ($data['search']) {
                    //  $this->db->join('job_category AS jc', 'j.job_category = jc.category_id');
                    foreach ($data['search'] as $search) {
                        $this->db->like('j.title', $search);
                    }

                    //  $this->db->like('company_name', $data['search']);
                    //  $this->db->or_where_in('jc.name', $data['search']);
                }
            }
        }

        $condition['j.status'] = 1;
        if (isset($data['company_id'])) {
            $condition['j.company_id'] = $data['company_id'];
        }

        if (isset($data['job_filter'])) {
            if ($data['job_filter'] == 'join') {
                $this->db->join('job_filter AS jfs', 'j.job_id = jfs.job_id');
                $this->db->where('jfs.type', FREELANCER_TYPE);

                //Filter Skills
                if (isset($data['filter_skills'])) {
                    if ($data['filter_skills']) {
                        $this->db->where('jfs.filter_keyword', 'filter_skill');
                        $this->db->where_in('jfs.filter_id', $data['filter_skills']);
                    }
                }

                //Filter language
                if (isset($data['filter_language'])) {
                    if ($data['filter_language']) {
                        $this->db->where('jfs.filter_keyword', 'filter_language');
                        $this->db->where_in('jfs.filter_id', $data['filter_language']);
                    }
                }
            }
        }

        //Filter Title/Category
        if (isset($data['filter_title'])) {
            if ($data['filter_title']) {
                $this->db->like('REPLACE(j.title, " ", "-")', preg_replace('[\s]', '-', $data['filter_title']));
            }
        }

        //Filter Location
        if (isset($data['filter_location'])) {
            if ($data['filter_location']) {
                $condition['LOWER(j.location)'] = strtolower($data['filter_location']);
            }
        }

        //Filter Location
        if (isset($data['filter_budget_type'])) {
            if ($data['filter_budget_type']) {
                $this->db->where('LOWER(j.pay_type)', strtolower($data['filter_budget_type']));
            }
        }

        //Filter Budget Range From
        if (isset($data['filter_budget_range_from'])) {
            if ($data['filter_budget_range_from']) {
                $this->db->where('j.pay_amount >=', $data['filter_budget_range_from']);
            }
        }

        //Filter  Budget Range To
        if (isset($data['filter_budget_range_to'])) {
            if ($data['filter_budget_range_to']) {
                $this->db->where('j.pay_amount <=', $data['filter_budget_range_to']);
            }
        }

        //Filter Experience
        if (isset($data['filter_experience'])) {
            if ($data['filter_experience']) {
                $this->db->where('j.experience', $data['filter_experience']);
            }
        }

        //Filter DatePost
        if (isset($data['filter_datepost'])) {
            if ($data['filter_datepost']) {
                $condition['IF(j.date_modified, DATE(j.date_modified), DATE(j.date_added)) >='] =  $data['filter_datepost'];
            }
        }

        $this->db->where($condition);

        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $row = $query->row();
            return $row->total;
        } else {
            return false;
        }
    }

    public function getJob($job_id)
    {
        $this->db->select('j.*, c.company_name AS company_name, c.company_id, u.user_id, u.image AS company_logo');

        $condition_data = array(
            'j.job_id' => $job_id,
            'j.status' => 1
        );
        $this->db->where($condition_data);

        $this->db->from('company_freelancer_jobs AS j');
        $this->db->join('company AS c', 'j.company_id = c.company_id');
        $this->db->join('user AS u', 'u.user_id = c.user_id');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }

    public function getJobQualifications($job_id, $data = array())
    {
        $this->db->select('job_qualification.*');

        $condition['job_id'] = $job_id;

        if ($condition) {
            $this->db->where($condition);
        }

        $query = $this->db->get('job_qualification');

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    //Freelancer Jobs
    public function getFreelancerJobs($freelancer_id, $data = array())
    {
        $this->db->select('j.*, cj.freelancer_job_id, cj.cj_isApplied, cj.cj_amount, cj.cj_proposal, cj.cj_isCompleted, cj.cj_isAccepted, cj.cj_isRemoved, c.company_name AS company_name, u.image AS company_logo');
        $this->db->from('company_freelancer_jobs AS j');
        $this->db->join('freelancer_jobs AS cj', 'j.job_id = cj.job_id');
        $this->db->join('company AS c', 'j.company_id = c.company_id');
        $this->db->join('user AS u', 'u.user_id = c.user_id');

        //Filter Condition
        $condition = array();
        $condition['j.status'] = 1;
        $condition['cj.freelancer_id'] = $freelancer_id;

        if (isset($data['applied'])) {
            $condition['cj.cj_isApplied'] = $data['applied'];
        }

        if (isset($data['completed'])) {
            $condition['cj.cj_isCompleted'] = $data['completed'];
        }
        if (isset($data['accepted'])) {
            $condition['cj.cj_isAccepted'] = $data['accepted'];
        }

        if (isset($data['saved'])) {
            $condition['cj.cj_isSaved'] = $data['saved'];
        }

        if (isset($data['removed'])) {
            $condition['cj.cj_isRemoved'] = $data['removed'];
        }
        if ($condition) {
            $this->db->where($condition);
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
            $sort = 'j.job_id';
        }

        if (isset($data['order'])) {
            $order = $data['order'];
        } else {
            $order = 'DESC';
        }
        $this->db->order_by($sort, $order);
        $query = $this->db->get()->result();
        //echo $this->db->last_query();
        return $query;
    }

    public function getTotalFreelancerJobs($freelancer_id, $data = array())
    {
        $this->db->select('COUNT(*) AS total');
        $this->db->where('j.status', 1);
        $this->db->from('company_freelancer_jobs AS j');
        $this->db->join('freelancer_jobs AS cj', 'j.job_id = cj.job_id');
        $this->db->join('company AS c', 'j.company_id = c.company_id');
        $this->db->join('user AS u', 'u.user_id = c.user_id');

        //Filter Condition
        $condition = array();
        $condition['j.status'] = 1;
        $condition['cj.freelancer_id'] = $freelancer_id;

        if (isset($data['applied'])) {
            $condition['cj.cj_isApplied'] = $data['applied'];
        }

        if (isset($data['accepted'])) {
            $condition['cj.cj_isAccepted'] = $data['accepted'];
        }

        if (isset($data['saved'])) {
            $condition['cj.cj_isSaved'] = $data['saved'];
        }

        if ($condition) {
            $this->db->where($condition);
        }

        $query = $this->db->get();
        $row = $query->row();
        return $row->total;
    }


    public function getTotalFreelancerJobsByJID($job_id, $data = array())
    {
        $this->db->select('COUNT(*) AS total');
        $this->db->from('company_freelancer_jobs AS j');
        $this->db->join('freelancer_jobs AS cj', 'j.job_id = cj.job_id');
        $this->db->join('company AS c', 'j.company_id = c.company_id');
        $this->db->join('user AS u', 'u.user_id = c.user_id');

        //Filter Condition
        $condition = array();
        $condition['j.status'] = 1;
        $condition['cj.job_id'] = $job_id;

        if (isset($data['applied'])) {
            $condition['cj.cj_isApplied'] = $data['applied'];
        }

        if (isset($data['accepted'])) {
            $condition['cj.cj_isAccepted'] = $data['accepted'];
        }

        if (isset($data['saved'])) {
            $condition['cj.cj_isSaved'] = $data['saved'];
        }

        if ($condition) {
            $this->db->where($condition);
        }

        $query = $this->db->get();
        $row = $query->row();
        return $row->total;
    }

    public function getRecentfreelancerJob($freelancer_id, $job_id, $data = [])
    {
        $this->db->select('j.*, cj.freelancer_job_id, cj.cj_isApplied, cj.cj_isSaved, cj.cj_amount, cj.cj_proposal, cj.cj_isCompleted, cj.cj_isRemoved, c.company_id, c.company_name AS company_name, u.user_id, u.image AS company_logo');

        $condition_data = array(
            'cj.freelancer_id' => $freelancer_id,
            'j.job_id' => $job_id,
            'j.status' => 1
        );

        if (isset($data['removed'])) {
            $condition_data['cj.cj_isRemoved'] = (int)$data['removed'];
        }

        if (isset($data['completed'])) {
            $condition_data['cj.cj_isCompleted'] = (int)$data['completed'];
        }

        $this->db->where($condition_data);

        $this->db->from('company_freelancer_jobs AS j');
        $this->db->join('freelancer_jobs AS cj', 'j.job_id = cj.job_id');
        $this->db->join('company AS c', 'j.company_id = c.company_id');
        $this->db->join('user AS u', 'u.user_id = c.user_id');
        $this->db->limit(1);
        $this->db->order_by('j.job_id', 'DESC');

        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }

    public function addFreelancerjob($job_id, $data)
    {
        $job_data = array(
            'job_id' => $job_id,
            'freelancer_id' => $data['freelancer_id'],
            'cj_isApplied' => 0,
            'cj_isSaved' => 0,
            'cj_date_added' => date('Y-m-d H:i:s')
        );

        $this->db->insert('freelancer_jobs', $job_data);

        return $this->db->insert_id();
    }

    public function saveJob($freelancer_job_id)
    {
        $job_data = array(
            'cj_isSaved' => 1,
            'cj_date_modified' => date('Y-m-d H:i:s')
        );

        $this->db->where('freelancer_job_id', $freelancer_job_id);
        $result = $this->db->update('freelancer_jobs', $job_data);

        return $result;
    }

    public function applyJob($freelancer_job_id, $data)
    {
        $job_data = array(
            'cj_isApplied' => 1,
            'cj_amount' => $data['amount'],
            'cj_proposal' => $data['proposal'],
            'cj_isSaved' => 0,
            'cj_date_modified' => date('Y-m-d H:i:s')
        );

        $this->db->where('freelancer_job_id', $freelancer_job_id);
        $result = $this->db->update('freelancer_jobs', $job_data);

        return $result;
    }

    public function setFreelancerJobActivity($freelancer_job_id, $data)
    {
        if ($data) {
            if (isset($data['shortlisted'])) {
                $update_data['cj_isShortlisted'] = $data['shortlisted'];
            }
            if (isset($data['applied'])) {
                $update_data['cj_isApplied'] = $data['applied'];
            }

            if (isset($data['accepted'])) {
                $update_data['cj_isAccepted'] = $data['accepted'];
            }

            if (isset($data['removed'])) {
                $update_data['cj_isRemoved'] = $data['removed'];
            }

            if (isset($data['saved'])) {
                $update_data['cj_isSaved'] = $data['saved'];
            }

            $update_data['cj_date_modified'] = date('Y-m-d H:i:s');

            $this->db->where('freelancer_job_id', $freelancer_job_id);
            $result = $this->db->update('freelancer_jobs', $update_data);

            return $result;
        } else {
            return false;
        }
    }

    //Milestones
    public function getJobMilestones($freelancer_job_id, $data = array())
    {
        $this->db->where('freelancer_job_id', $freelancer_job_id);
        $query = $this->db->get('freelancer_milestones');

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function getJobMilestone($freelancer_job_milestone_id, $data = array())
    {
        $this->db->where('freelancer_job_milestone_id', $freelancer_job_milestone_id);
        $query = $this->db->get('freelancer_milestones');

        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }

    public function addJobMilestone($freelancer_job_id, $data)
    {
        $milestone_data = array(
            'freelancer_job_id' => $freelancer_job_id,
            'cjm_initiator' => $data['initiator'],
            'cjm_amount' => $data['amount'],
            'cjm_description' => $data['description'],
            'cjm_duration' => $data['duration'],
            'cjm_requirements' => $data['requirements'],
            'cjm_status' => $data['status'],
            'cjm_date_added' => date('Y-m-d H:i:s')
        );

        $result = $this->db->insert('freelancer_milestones', $milestone_data);
        return $this->db->insert_id();
    }

    public function editJobMilestone($freelancer_job_milestone_id, $data)
    {
        $milestone_data = array(
            // 'cjm_amount' => $data['amount'],
            // 'cjm_description' => $data['description'],
            // 'cjm_duration' => $data['duration'],
            // 'cjm_requirements' => $data['requirements'],
            'cjm_status' => $data['status'],
            'cjm_date_modified' => date('Y-m-d H:i:s')
        );
        $this->db->where('freelancer_job_milestone_id', $freelancer_job_milestone_id);
        $result = $this->db->update('freelancer_milestones', $milestone_data);
        return $result;
    }

    public function acceptJobMilestone($freelancer_job_milestone_id, $status)
    {
        $milestone_data = array(
            'cjm_isAccepted' => $status,
            'cjm_isRejected' => 0,
            'cjm_start_date' => date('y-m-d'),
            'cjm_date_modified' => date('Y-m-d H:i:s')
        );
        $this->db->where('freelancer_job_milestone_id', $freelancer_job_milestone_id);
        $result = $this->db->update('freelancer_milestones', $milestone_data);
        return $result;
    }

    public function rejectJobMilestone($freelancer_job_milestone_id, $status)
    {
        $milestone_data = array(
            'cjm_isAccepted' => 0,
            'cjm_isRejected' => $status,
            'cjm_date_modified' => date('Y-m-d H:i:s')
        );
        $this->db->where('freelancer_job_milestone_id', $freelancer_job_milestone_id);
        $result = $this->db->update('freelancer_milestones', $milestone_data);
        return $result;
    }

    public function payReleasedJobMilestone($freelancer_job_milestone_id, $status)
    {
        $milestone_data = array(
            'cjm_isPayReleased' => $status,
            'cjm_date_modified' => date('Y-m-d H:i:s')
        );
        $this->db->where('freelancer_job_milestone_id', $freelancer_job_milestone_id);
        $result = $this->db->update('freelancer_milestones', $milestone_data);
        return $result;
    }

    public function closeJobMilestone($freelancer_job_milestone_id, $status)
    {
        $milestone_data = array(
            'cjm_isClosed' => $status,
            'cjm_date_modified' => date('Y-m-d H:i:s')
        );
        $this->db->where('freelancer_job_milestone_id', $freelancer_job_milestone_id);
        $result = $this->db->update('freelancer_milestones', $milestone_data);
        return $result;
    }

    public function deleteJobMilestone($freelancer_job_milestone_id)
    {
        $this->db->where('freelancer_job_milestone_id', $freelancer_job_milestone_id);
        $result = $this->db->delete('freelancer_milestones');
        return $result;
    }

    //Payment
    public function getTotalMilestonePayments($data = array())
    {
        $this->db->distinct();
        $this->db->select('COUNT(*) AS total');
        $this->db->from('freelancer_milestones_payment AS fmp');
        $this->db->join('freelancer_milestones AS fm', 'fm.freelancer_job_milestone_id = fmp.milestone_id');
        $this->db->join('freelancer_jobs AS fj', 'fj.freelancer_job_id = fm.freelancer_job_id');

        if (isset($data['mpay_status'])) {
            $this->db->where('fmp.status', $data['mpay_status']);
        }
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row()->total;
        } else {
            return false;
        }
    }

    public function getMilestonePayments($data = array())
    {
        $this->db->distinct();
        $this->db->select('fmp.*, fm.*, fj.*');
        $this->db->from('freelancer_milestones_payment AS fmp');
        $this->db->join('freelancer_milestones AS fm', 'fm.freelancer_job_milestone_id = fmp.milestone_id');
        $this->db->join('freelancer_jobs AS fj', 'fj.freelancer_job_id = fm.freelancer_job_id');

        if (isset($data['mpay_status'])) {
            $this->db->where('fmp.status', $data['mpay_status']);
        }
        if (isset($data['complete'])) {
            $this->db->where('fm.cjm_isCompleted', $data['complete']);
        }
        if (isset($data['payer'])) {
            $this->db->where('fmp.payer', $data['payer']);
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
            $sort = 'j.job_id';
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
            return false;
        }
    }

    public function getMilestonePayment($milestone_payment_id)
    {

        $this->db->where('milestone_payment_id', $milestone_payment_id);
        $query = $this->db->get('freelancer_milestones_payment');
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }

    public function getFreelancerpayment($freelancer_id)
    {

        $this->db->where('freelancer_id', $freelancer_id);
        $query = $this->db->get('freelancer_payment');
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }


    public function getMilestonePaymentByMP($freelancer_job_milestone_id, $payer)
    {
        $condition = array(
            'milestone_id' => $freelancer_job_milestone_id,
            'payer' => 'CMP'
        );
        $this->db->where($condition);
        $query = $this->db->get('freelancer_milestones_payment');
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }
    public function getFreelancerMilestonePaymentByMP($freelancer_job_milestone_id, $payer)
    {
        $condition = array(
            'milestone_id' => $freelancer_job_milestone_id,
            'payer' => 'ADM'
        );
        $this->db->where($condition);
        $query = $this->db->get('freelancer_milestones_payment');
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }

    public function addMilestonePayment($data)
    {
        $milestone_data = array(
            'milestone_id' => $data['milestone_id'],
            'payer' => $data['payer'],
            'amount' => $data['amount'],
            'service_fee' => $data['service_fee'],
            'service_fee_type' => $data['service_fee_type'],
            'service_amount' => $data['service_amount'],
            'total' => $data['total'],
            'date_added' => date('Y-m-d H:i:s'),
            'status' => 1,
            'freelancer_transaction_type' => $data['freelancer_transaction_type'],
            'freelancer_transaction_id' => $data['freelancer_transaction_id'],
        );
        $this->db->insert('freelancer_milestones_payment', $milestone_data);
        return $this->db->insert_id();
    }
}
