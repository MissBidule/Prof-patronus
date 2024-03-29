<?php

namespace App\Models;

use CodeIgniter\Model;


class reponseModel extends Model
{
    
    protected $table = 'reponse';

    protected $allowedFields =['Libelle','Photo','ID_Q'];

    protected $primaryKey= 'ID_rep';

    protected $useAutoIncrement = true;


    /*GET*/

    public function getAll(){
        return $this->findAll();
    }

    public function getByKey($id_rep){
        return $this->where(['ID_rep' => $id_rep])->first();
    }

    public function getByQuestion($id_q){
        return $this->where(['ID_Q' => $id_q])->findAll();
    }

    // /*ENREGISTREMENT NOUVELLE REPONSE*/

    // public function newResponse($libelle, $photo, $id_q){
    //     $data=[
    //         'Libelle' => $libelle,
    //         'Photo' => $photo,
    //         'ID_Q' => $id_q
    //     ];
    //     $this->insert($data);
    // }

    // /*MODIFICATIONS REPONSE*/

    // //modif libelle
    // public function modifyResponseLibelle($id_rep,$libelle)
    // {
    //     $data=[
    //         'Libelle' => $libelle
    //     ];
    //     $this->update($id_rep,$data);
    // }

    // //modif photo
    // public function modifyResponsePhoto($id_rep,$photo)
    // {
    //     $data=[
    //         'Photo' => $photo
    //     ];
    //     $this->update($id_rep,$data);
    // }

    // /*SUPPRESSION REPONSE*/

    // public function deleteResponse($id_rep){
    //     $this->where(['ID_rep' => $id_rep])->delete();
    // }
}
