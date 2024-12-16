<?php

namespace App\Controllers\Admin;

use App\Models\BannerComponentModel;
use App\Controllers\Admin\IComponent;

class BannerComponentController extends AdminController implements IComponent
{
    private BannerComponentModel $model;

    public function __construct($request)
    {
        $this->request = $request;
        $this->model = new BannerComponentModel();
    }

    /**
     * Get banner by component id
     * @param int $component_id
     * @return array
     */
    public function get(int $component_id): array {
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
            'title' => '',
            'subtitle' => '',
            'image' => '',
            'component_id' => $component_id,
        ];

        $this->model->save($data);
    }

    /**
     * Change component data 
     * @param int $component_id 
     * @param array $data
     */
    public function edit(int $component_id, array $data) {
        $component = $this->model->where('component_id', $component_id)
                                 ->find()[0];

        $image_validate = $this->validate([
            'image' => [
                'uploaded[image]',
                'is_image[image]',
            ],
        ]);

        if ($image_validate) {
            $image = $this->request->getFile('image');

            $image_path = $this->model->saveImage($component, $image);
            $component['image'] = $image_path;
        }

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
