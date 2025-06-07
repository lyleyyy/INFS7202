<?php namespace App\Models;

use CodeIgniter\Model;

class QuestionModel extends Model
{
    protected $table = 'questions';
    protected $primaryKey = 'id';
    protected $returnType = 'array';

    protected $allowedFields = [
        'userid',
        'username',
        'title',
        'language',
        'description',
        'file',
        'created_at',
    ];
}
?>