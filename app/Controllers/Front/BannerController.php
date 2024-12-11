<?php 

namespace App\Controllers\Front;

use App\Models\BannerComponentModel;
use App\Models\ComponentsModel;

class BannerController extends FrontController implements IComponnet
{
    private ComponentsModel $component_model;
    private BannerComponentModel $model;

    public function __construct()
    {
        $this->component_model = new ComponentsModel();
        $this->model = new BannerComponentModel();
    }

    public function publicData(int $component_id): array
    {
        $component = $this->component_model->select('title')
                                           ->find($component_id);
        
        $component_data = $this->model->select('subtitle, image')
                                      ->where('component_id', $component_id)
                                      ->find()[0];
        
        $data = array_merge($component, $component_data);
        
        return $data;
    }
}