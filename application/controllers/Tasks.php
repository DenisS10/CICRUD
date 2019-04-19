<?php
/**
 * Created by PhpStorm.
 * User: Ден
 * Date: 18.04.2019
 * Time: 14:29
 */

class Tasks extends CI_Controller
{


    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
       // $this->load->database();
    }


    public function Login()
    {
        $this->load->view('header', ['title' => 'Login']);

        $this->load->database();
        $query = $this->db->query('SELECT `id`,`login`,`password`,`user_name` FROM users');


        $login = $this->input->post('login');
        $pass = $this->input->post('login');


        foreach ($query->result() as $user) {
            $logPass = password_verify($pass, $user->password);
            if ($login == $user->login && $logPass == true) {
            //    print_r($user->login);

                $this->session->id = $user->id;
                $this->session->auth = 'ok';
                header('location: index');

            }
        }
        $this->load->view('tasks/login');
        $this->load->view('footer');
    }

    public function index()
    {
        if (!$this->session->auth = 'ok' || $this->session->auth != 'ok')
            header('location: login');
        $id = $this->session->id;
        $this->load->view('header', ['title' => 'Index']);
        $this->load->database();
        $query = $this->db->query("SELECT `id`,`user_id`,`task`,`deadline` FROM task WHERE `user_id` = $id");

       // print_r($query->result());
//        foreach ($query->result() as $task) {
//
//        }

        $this->load->view('tasks/task_view',['res'=>$query->result()]);
        $this->load->view('footer');
    }

    public function Add($task, $deadline)
    {
        $this->load->view('header', ['title' => 'Index']);

        $this->load->view('footer');
    }

    public function MgetSession()
    {
        $id = $this->session->id;
        return $id;
    }
}