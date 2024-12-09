<?php

namespace App\Controllers\Admin;

use App\Models\ArticleComponentModel;
use App\Controllers\Admin\IComponent;

class ArticleComponentController extends AdminController implements IComponent
{
    private ArticleComponentModel $model;

    public function __construct()
    {
        $this->model = new ArticleComponentModel();
    }

    /**
     * Get articles by component id
     * @param int $component_id
     * @return array
     */
    public function get(int $component_id): array
    {
        return $this->model->where('component_id', $component_id)
                           ->find()[0];
    }

    /**
     * Create component by component id
     * @param int $component_id 
     */
    public function add(int $component_id)
    {
        $data = [
            'description' => '',
            'content' => '',
            'component_id' => $component_id,
        ];

        $this->model->save($data);
    }

    /**
     * Change component data 
     * @param int $component_id 
     * @param array $data
     */
    public function edit(int $component_id, array $data)
    {
        $component = $this->model->where('component_id', $component_id)
                                 ->find()[0];

        $newData = array_merge($component, $data);

        $this->model->update($component['id'], $newData);
    }

    /**
     * Delete component method
     * @param int $component_id
     */
    public function remove(int $component_id)
    {
        $this->model->where('component_id', $component_id)
                    ->delete();
    }
}
