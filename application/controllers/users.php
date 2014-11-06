<?php

class Users extends CI_Controller{

    public $entityManager;

    public function __construct(){
        parent::__construct();
        $this->entityManager = $this->doctrine->em;
    }

    public function index(){
        $users = $this->entityManager->getRepository('Entity\User')->findBy(array());
        $data['users'] = $users;
        $this->load->view('template_header');
        $this->load->view('user/view', $data);
        $this->load->view('template_footer');
    }

    public function show_json($id){
        $user = $this->entityManager->find('Entity\User', $id);
        print_r(Entity\User::toJson($user));
    }

    public function create(){
        $userArray = array(
            'name' => $_POST['name'],
            'username' => $_POST['username'],
            'password' => $_POST['password'],
            'email' => $_POST['email']
        );
        $user = Entity\User::fromArray($userArray);

        try{
            $this->entityManager->persist($user);
            $this->entityManager->flush();
            redirect('users');
        }catch(Exception $err){
            echo "Error: ".$err->getCode().": ".$err->getMessage();
        }
    }

    public function edit($id){
        if($id == NULL){
            redirect('users');
        }else{
            $user = $this->entityManager->find('Entity\User', $id);
            $data['user'] = $user;
            $this->load->view('template_header');
            $this->load->view('user/edit', $data);
            $this->load->view('template_footer');
        }
    }

    public function update($id = NULL){
        if($id == NULL){
            redirect('users');
        }else{
            $user = $this->entityManager->find('Entity\User', $id);
            $user->setName($_POST['name']);
            $user->setUsername($_POST['username']);
            $user->setEmail($_POST['email']);

            try{
                $this->entityManager->persist($user);
                $this->entityManager->flush();
                redirect('users');
            }catch(Exception $err){
                echo "Error ".$err->getCode().": ".$err->getMessage();
            }
        }
    }

    public function delete($id = NULL){
        if($id == NULL){
            redirect('users');
        }else{
            try{
                $user = $this->entityManager->find('Entity\User', $id);
                $this->entityManager->remove($user);
                $this->entityManager->flush();
                redirect('users');
            }catch (Exception $err){
                echo "Error ".$err->getCode().": ".$err->getMessage();
            }
        }
    }

}