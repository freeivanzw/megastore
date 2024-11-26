<?php

namespace App\Models;

use CodeIgniter\Model;

class ArticleComponentModel extends Model
{
    protected $table      = 'article_component';
    protected $primaryKey = 'id';

    protected $allowedFields = ['description', 'content', 'component_id'];

    public function addComponent(int $component_id)
    {
        $this->save([
            'description' => '',
            'content' => '',
            'component_id' => $component_id,
        ]);
    }
}