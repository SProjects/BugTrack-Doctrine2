<?php

class Bugs extends CI_Controller{

    public $entityManager;

    public function __construct(){
        parent::__construct();
        $this->entityManager = $this->doctrine->em;
    }

    public function index($id = NULL){
        $user = $this->entityManager->find('Entity\User', $id);
        $bugs = $user->displayInfo('bugs');
        $data['user'] = $user;
        $data['bugs'] = $bugs;
        $this->load->view('template_header');
        $this->load->view('bug/view', $data);
        $this->load->view('template_footer');
    }

    public function show_json($id){
        $bug = $this->entityManager->find('Entity\Bug', $id);
        print_r(Entity\Bug::toJson(array($bug)));
    }

    public function create($id){
        $user = $this->entityManager->find('Entity\User', $id);
        $bug = new Entity\Bug;
        $bug->setTitle($_POST['title']);
        $bug->setDescription($_POST['description']);
        $bug->setUser($user);
        $bug->setStatus($this->entityManager->getRepository('Entity\Status')->findOneBy(array('name'=>'OPEN')));

        try{
            $this->entityManager->persist($bug);
            $this->entityManager->flush();
            redirect('bugs/index/'.$user->displayInfo('id'));
        }catch(Exception $err){
            echo "Error ".$err->getCode().": ".$err->getMessage();
        }
    }

    public function edit($id){
        $users = $this->entityManager->getRepository('Entity\User')->findBy(array());
        $statuses = $this->entityManager->getRepository('Entity\Status')->findBy(array());
        $bug = $this->entityManager->find('Entity\Bug', $id);

        $data = array('users' => $users, 'statuses' => $statuses, 'bug' => $bug);
        $this->load->view('template_header');
        $this->load->view('bug/edit', $data);
        $this->load->view('template_footer');
    }

    public function update($id){
        $bug = $this->entityManager->find('Entity\Bug', $id);
        $bug->setTitle($_POST['title']);
        $bug->setDescription($_POST['description']);
        $bug->setStatus($this->entityManager->find('Entity\Status', $_POST['status']));
        $bug->setUser($this->entityManager->find('Entity\User', $_POST['user']));

        try{
            $this->entityManager->persist($bug);
            $this->entityManager->flush();
            redirect('bugs/index/'.$bug->displayInfo('user')->displayInfo('id'));
        }catch (Exception $err){
            echo "Error ".$err->getCode().": ".$err->getMessage();
        }
    }

    public function delete($id){
        $bug = $this->entityManager->find('Entity\Bug', $id);
        $user_id = $bug->displayInfo('user')->displayInfo('id');
        try{
            $this->entityManager->remove($bug);
            $this->entityManager->flush();
            redirect('bugs/index/'.$user_id);
        }catch(Exception $err){
            echo "Error ".$err->getCode().": ".$err->getMessage();
        }
    }

}