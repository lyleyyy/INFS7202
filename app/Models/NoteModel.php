<?php namespace App\Models;

use CodeIgniter\Model;

class NoteModel extends Model
{
    protected $table = 'notes';
    protected $primaryKey = 'id';
    protected $returnType = 'array';

    protected $allowedFields = [
        'userid',
        'username',
        'title',
        'language',
        'description',
        'filename',
        'created_at',
    ];

    // the upload method for store note data into database
    public function upload($userid, $username, $title, $language, $description, $filename)
    {
        $file = [
            'userid' => $userid,
            'username' => $username,
            'title' => $title,
            'language' => $language,
            'description' => $description, 
            'filename' => $filename,
        ];

        $db = \Config\Database::connect();
        $builder = $db->table('notes');
        if ($builder->insert($file)) {
            return true;
        } else {
            return false;
        }
    }
}
?>