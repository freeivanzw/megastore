<?php

namespace App\Models;

use CodeIgniter\HTTP\Files\UploadedFile;
use CodeIgniter\Model;
use Exception;

class BannerComponentModel extends Model
{
    protected $table      = 'banner_component';
    protected $primaryKey = 'id';

    protected $allowedFields = ['subtitle', 'image', 'component_id'];

    /**
     * Uploading banner image
     * 
     * @param array $component
     * @param UploadedFile $image
     * @return string
     */
    public function saveImage(array $component, UploadedFile $image): string
    {
        if (!$image->isValid() && $image->hasMoved()) {
            throw new Exception('file not found');
        }

        $file_name = $image->getName();

        $dir_path = FCPATH . 'uploads/slide/' . $component['component_id'];

        if (!file_exists($dir_path)) {
            mkdir($dir_path);
        }

        $image->move($dir_path, $file_name, true);
        $image_path = 'uploads/slide/' . $component['component_id'] . '/' . $file_name;

        $this->update($component['id'], [
            'image' => $image_path,
        ]);

        return $image_path;
    }

    public function deleteImage(int $component_id)
    {
        $dir_path = FCPATH . 'uploads/slide/' . $component_id;

        if (!file_exists($dir_path)) {
            throw new Exception('directory not found');
        }

        $component = $this->where('component_id', $component_id)
                          ->find()[0];   

        $file_path = FCPATH . $component['image'];

        if (!file_exists($file_path)) {
            throw new Exception('file not found');
        }

        unlink($file_path);
        rmdir($dir_path);

        $component['image'] = '';
        $this->save($component);
    }
    
}
