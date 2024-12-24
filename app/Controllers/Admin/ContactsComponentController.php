<?php

namespace App\Controllers\Admin;

use App\Models\ContactsComponentsModel;
use CodeIgniter\HTTP\IncomingRequest;

class ContactsComponentController extends AdminController implements IComponent
{
    private ContactsComponentsModel $model;

    public function __construct()
    {
        $this->model = new ContactsComponentsModel();
    }

    /**
     * Get contacts by component id
     * @param int $component_id
     * @return array
     */
    public function get(int $component_id): array 
    {
        $component = $this->model->where('component_id', $component_id)
                           ->find()[0];

        // if (isset($component['phones'])) {
        //     $phones_array = explode(',', $component['phones']);

        //     $component['phones'] = $phones_array;
        // }

        return $component;
    }

    /**
     * Create component by component id
     * @param int $component_id 
     */
    public function add(int $component_id)
    {
        $data = [
            'email' => null,
            'phones' => null,
            'work_time' => null,
            'map' => null,
            'component_id' => $component_id,
        ];

        $this->model->save($data);
    }
    
    public function edit(int $component_id, IncomingRequest $request)
    {
        $data = $request->getPost('data');
        $component = $this->model
                          ->where('component_id', $component_id)
                          ->find()[0];

        // if (isset($data['phones'])) {
        //     $phones_str = implode(',', $data['phones']);

        //     $data['phones'] = $phones_str;
        // }

        if (isset($data['map'])) {
            $data['map'] = htmlentities($data['map']);
        }

        $newData = array_merge($component, $data);

        $this->model->update($component['id'], $newData);
    }

    public function remove(int $component_id)
    {
        $this->model
             ->where('component_id', $component_id)
             ->delete();
    }
}