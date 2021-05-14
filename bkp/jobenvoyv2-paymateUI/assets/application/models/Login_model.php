<?php
/**
 * Created by PhpStorm.
 * User: mjyL
 * Date: 8/30/2018
 * Time: 4:37 PM
 */

class Login_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    function verify_login_credentials($user_name)
    {
        $this->db->select('*');
        $this->db->where('email', $user_name);
        $this->db->where_not_in('is_deleted', '1');
        $this->db->from('user');
        return $this->db->get()->row_array();
    }

    function register_jobseeker($data){
        $res = $this->db->insert('user', $data);
        return $this->db->insert_id();
    }

    function add_new_jobseeker_info($data){
        $res = $this->db->insert('jobseeker',$data);
        return $res;
    }

    function register_employer($data){
        $this->db->insert('user', $data);
        return $this->db->insert_id();
    }

    function add_new_employer_info($data){
        $this->db->insert('employer', $data);
        return $this->db->insert_id();
    }

    function add_employer_id_to_user($user_id, $company_id){
        $this->db->where('user_id',$user_id);
        $result = $this->db->update('user', array('company_id'=>$company_id));
        return $result;
    }

    function check_user_exist($user_name){
        $this->db->select('email');
        $this->db->where('email', $user_name);
        $this->db->from('user');
        return $this->db->get()->row_array();
    }
    function check_user_exist_and_return_id($user_name){
        $this->db->select('user_id,email');
        $this->db->where('email', $user_name);
        $this->db->from('user');
        return $this->db->get()->row_array();
    }

    function check_verify_code($email){
        $this->db->select('email,verification_code');
        $this->db->where('email', $email);
        $this->db->from('user');
        return $this->db->get()->row_array();
    }

    function confirm_email($email){
        $this->db->set('verification_status', 1);
        $this->db->where('email', $email);;
        return $this->db->update('user');
    }

    //forget password
    function reset_user_password($data){
        $res = $this->db->insert('forget_password', $data);
        return $res;
    }

    function check_user_name($email){
        $this->db->select('user_id');
        $this->db->where('email', $email);
        $this->db->from('user');
        $res = $this->db->get()->row_array();
        return $res;
    }

    function verify_reset_code($user_id, $email, $code){
        $this->db->select('user_id, email,random_password,is_expired');
        $this->db->where(array('user_id'=>$user_id, 'email'=>$email, 'random_password' => $code));
        $this->db->from('forget_password');
        return $this->db->get()->row_array();
    }

    function set_new_password($email, $password){
        $this->db->where('email', $email);
        $result = $this->db->update('user', array('password'=> $password));
        return $result;
    }

    function disable_reset_code($email){
        $this->db->where('email', $email);
        $result = $this->db->update('forget_password', array('is_expired'=> '1'));
        return $result;
    }
}
