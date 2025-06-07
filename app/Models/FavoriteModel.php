<?php namespace App\Models;

use CodeIgniter\Model;

class FavoriteModel extends Model
{
    protected $table = 'favorites';
    protected $primaryKey = 'id';
    protected $returnType = 'array';

    protected $allowedFields = [
        'userid',
        'questionid',
        'created_at',
    ];

    public function check($userid, $questionid) {
        $db = \Config\Database::connect();
        $builder = $db->table('favorites');
        // $array = ['userid' => $userid, 'questionid' => $questionid];
        // $check = $builder->where($array);
        $check = $builder->getWhere(['userid' => $userid, 'questionid' => $questionid])->getRowArray();
        // return $check;
        if ($check > 0) {
            return true;
        }

        return false;
    }

    public function add($userid, $questionid, $title, $questionusername, $language) {
        $db = \Config\Database::connect();
        $builder = $db->table('favorites');
        $data = [
            'userid' => $userid,
            'questionid' => $questionid,
            'title' => $title,
            'questionusername' => $questionusername,
            'language' => $language,
        ];
        $builder->insert($data);
    }

    public function remove($favoriteid) {
        $db = \Config\Database::connect();
        $builder = $db->table('favorites');
        $builder->where('id', $favoriteid);
        $builder->delete();
    }
}
?>