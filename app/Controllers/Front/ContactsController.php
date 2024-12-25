<?php 

namespace App\Controllers\Front;

use App\Models\ContactsComponentModel;
use App\Models\ComponentsModel;

class ContactsController extends FrontController implements IComponnet
{
    private ComponentsModel $component_model;
    private ContactsComponentModel $model;

    public function __construct()
    {
        $this->component_model = new ComponentsModel();
        $this->model = new ContactsComponentModel();
    }

    public function publicData(int $component_id): array
    {
        $component = $this->component_model
                          ->select('title')
                          ->find($component_id);
        
        $component_data = $this->model
                               ->select('email, phones, work_time, map')
                               ->where('component_id', $component_id)
                               ->find()[0];

        if (isset($component_data['phones'])) {
            $phones_array = explode(',', $component_data['phones']);

            $component_data['phones'] = $phones_array;
        }
        
        $data = array_merge($component, $component_data);

        return $data;
    }
}