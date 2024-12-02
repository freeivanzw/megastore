<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Models\IComponent;

class ArticleComponentModel extends Model implements IComponent
{
    protected $table      = 'article_component';
    protected $primaryKey = 'id';

    protected $allowedFields = ['description', 'content', 'component_id'];

    public function add(int $component_id)
    {
        $this->save([
            'description' => '',
            'content' => '',
            'component_id' => $component_id,
        ]);
    }

    public function edit(int $component_id, array $data) {
        $component = $this->where('component_id', $component_id)->find()[0];

        $newData = array_merge($component, $data);

        $this->update($component['id'], $newData);
    }
    
    public function remove(int $component_id) {

    }

    
}