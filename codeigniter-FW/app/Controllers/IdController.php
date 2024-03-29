<?php

namespace App\Controllers;

use App\Models\IdModel;

class IdController extends BaseController
{
    public function index()
    {
        $model = model(IdModel::class);

        $data = [
            'internaute'=> $model->getAll(),
            'title' => 'Liste Identifiants',
        ];

        echo view('templates/header', $data);
        echo view('IdView/connexion', $data);
        echo view('templates/footer', $data);
        
    }

    

    public function view($Identifiant = null)
    {
        $model = model(IdModel::class);

        $data['internaute'] = $model->getByKey($Identifiant);

        if (empty($data['internaute'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Cannot find the login item: ' . $Identifiant);
        }

        $data['title'] = $data['internaute']['Identifiant'];

        echo view('templates/header', $data);
        echo view('IdView/view', $data);
        echo view('templates/footer', $data);
    }

    public function create()
    {
        $model = model(IdModel::class);

        if ($this->request->getMethod() === 'post' && $this->validate([
            'Identifiant' => 'required|min_length[3]|max_length[255]',
            'mdp'  => 'required',]) && $model->identifiantCheck($this->request->getPost('Identifiant'))==false) 
        {  
            $model->subscribe(
                $this->request->getPost('Identifiant'),
                md5($this->request->getPost('mdp')),
            );
           
            echo view('IdView/success');
            echo view('templates/footer');
        } 
        else if ($model->identifiantCheck($this->request->getPost('Identifiant'))==true){
            echo view('IdView/errorSubscribe');
            echo view('templates/footer');
        }
        else 
        {
            echo view('IdView/inscription');
            echo view('templates/footer');
        }
    }

    public function connexion()
    {
        $model = model(IdModel::class);

        if ($this->request->getMethod() === 'post' && $model->identifiantCheck($this->request->getPost('Identifiant'))) 
        {  

            //echo md5($this->request->getPost('mdp'));
            if ($this->request->getMethod() === 'post' && $model->mdpCheck($this->request->getPost('Identifiant'), md5($this->request->getPost('mdp'))))
            {
                $session = \Config\Services::session();  
                $session->set('id', $this->request->getPost('Identifiant'));
                return redirect()->to('start');
                echo view('templates/header', ['title' => 'Accueil']);
                //echo view('start/index.php');
                echo view('templates/footer');
            }
            echo view('IdView/errorMdp');
            echo view('templates/footer');
        } 

        else if ($model->identifiantCheck($this->request->getPost('Identifiant'))==false){
            echo view('IdView/errorId');
            echo view('templates/footer');
        }
        else 
        {
            echo view('templates/header', ['title' => 'Accueil']);
            echo view('IdView/connexion');
            echo view('templates/footer');
        }
    }

    //logout function
    public function logout(){
        $session = \Config\Services::session(); //access to the session
        $session->destroy(); //destroy the session to disconnect the user
        
        return redirect()->to(''); //redirect to root
        
    }
}

    