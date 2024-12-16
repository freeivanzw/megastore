<?php

namespace App\Controllers\Admin;

use App\Models\BannerComponentModel;
use App\Controllers\Admin\IComponent;
use CodeIgniter\HTTP\IncomingRequest;
use Exception;

class BannerComponentController extends AdminController implements IComponent
{
    private BannerComponentModel $model;

    public function __construct()
    {
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
     * @param IncomingRequest $request
     */
    public function edit(int $component_id, IncomingRequest $request) {
        $data = $request->getPost('data');
        $component = $this->model->where('component_id', $component_id)
                                 ->find()[0];

        $image = $request->getFile('image');

        $validation = \Config\Services::validation();
        $validation->setRules([
            'image' => [
                'uploaded[image]',
                'is_image[image]',
            ],
        ]);

        if ($validation->run($request->getPost())) {
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

    /**
     * Delete slide image
     * @param int $component_id
     */
    public function removeImage(int $component_id)
    {
        $component = $this->model->where('component_id', $component_id)
                                 ->find()[0];

        if (!isset($component['image']) || $component === '') {
            throw new Exception('file not found');
        }

        $this->model->deleteImage($component_id);

        return redirect()->to('admin/component/' . $component_id);
    }
}
