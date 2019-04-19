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

        $this->load->view('tasks/task_view', ['res' => $query->result()]);
        $this->load->view('footer');
    }

    public function Add()
    {
        header('location: index');
        $this->load->database();
        $this->load->view('header', ['title' => 'Index']);
        $userId = $this->session->id;


        $task = $this->input->post('task');
        $deadline = $this->input->post('deadline');


        $currDate = time();
        $this->db->query("insert into `task` (`user_id`,`task`, `deadline`,`creation_date`) values($userId,'$task',$deadline,$currDate)");

        //mysqli_query($this->db,$querySave);

        $this->load->view('footer');
    }

    public function Delete()
    {
        header('location: index');
        $this->load->database();
        $this->load->view('header', ['title' => 'Delete']);
        $numberOfRecord = $this->input->get('numberOfRecord');
        $numberOfRecordMod = intval($numberOfRecord);

        $this->db->query("DELETE FROM task WHERE id = $numberOfRecordMod");

        $this->load->view('footer');
    }

    public function Modify()
    {
        $this->load->database();
        $this->load->view('header', ['title' => 'Delete']);
        $id = $this->input->get('id');


        $query = $this->db->query("SELECT `task`,`deadline` FROM task WHERE `id` = $id");
        $this->load->view('tasks/modify_view', ['res' => $query->result()]);

        $this->load->view('footer');

    }

    public function Save()
    {
        header('location: index');
        $this->load->database();

        $id = isset($_GET['id']) ? $_GET['id'] : '';
        $modTask = isset($_GET['modTask']) ? $_GET['modTask'] : '';
        $modDeadline = isset($_GET['modDeadline']) ? $_GET['modDeadline'] : '';
        $this->input->get('id');
        $this->input->get('modTask');
        $this->input->get('modDeadline');


            $currDate = time();

            $this->db->query("UPDATE `task` SET `task` = '$modTask', `deadline` = $modDeadline,`mod_date`= $currDate where id = $id");




        $this->load->view('footer');
    }
}