<?php

namespace App\Models;

use CodeIgniter\Model;

class User_model extends Model
{
    protected $DBGroup = 'default';
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $insertID = 0;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = ['id',
                                'name', 
                                'avatar', 
                                'email', 
                                'password',
                                'q1',
                                'a1',
                                'q2',
                                'a2',
                                'create_at',];

    //Dates
    protected $useTimestamps = false;
    protected $dateFormat = 'datetime';
    protected $createdField = 'create_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    //Validation
    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    //Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert = [];
    protected $afterInsert = [];
    protected $beforeUpdate = [];
    protected $afterUpdate = [];
    protected $beforeFind = [];
    protected $afterFind = [];
    protected $beforeDelte = [];
    protected $afterDelete = [];

    // the upload method for upload and store user profile image
    public function upload($loggedInUserId, $image)
    {
        $file = [
            'avatar' => $image,
        ];
        $db = \Config\Database::connect();
        $builder = $db->table('users');
        $check = $builder->where('id', $loggedInUserId)->update($file);
        if ($check) {
            return true;
        }
        
        return false;
    }

   // the upload method for update and store new user email
    public function updateEmail($userId, $data) {
        $db = \Config\Database::connect();
        $builder = $db->table('users');
        $builder->where('id', $userId);
        $check = $builder->update($data);
        if($check) {
            return true;
        }

        return false;
    }

    public function isAlreadyRegister($googleUserId) {
        $db = \Config\Database::connect();
        $builder = $db->table('users');
        $check = $builder->getWhere(['id' => $googleUserId])->getRowArray();
        if ($check > 0) {
            return true;
        }
        
        return false;
    }

    public function updateUser($userdata, $googleUserId) {
        $db = \Config\Database::connect();
        $builder = $db->table('users');
        $builder->where(['id' => $googleUserId])->update($userdata);
    }

    public function insertUser($userdata) {
        $db = \Config\Database::connect();
        $builder = $db->table('users');
        $builder->insert($userdata);
    }

    public function changePassword($userdata, $userid) {
        $db = \Config\Database::connect();
        $builder = $db->table('users');
        $builder->where(['id' => $userid])->update($userdata);
        session()->remove('userforreset');
    }

}