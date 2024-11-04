<?php

namespace App\Models;

use CodeIgniter\Model;

class ArticleModel extends Model
{
    protected $table      = 'article_component';
    protected $primaryKey = 'id';

    protected $allowedFields = ['description', 'content', 'component_id'];

    
}