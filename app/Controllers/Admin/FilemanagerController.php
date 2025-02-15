<?php

namespace App\Controllers\Admin;

use App\Controllers\Admin\AdminController;


class FilemanagerController extends AdminController
{
    /**
     * Use method for get view
     */
    public function index()
    {
        return view('Admin/Components/elfinder');
    }

    /**
     * Filemanager work
     */
    public function connector()
    {
        $opts = [
            'roots' => [
                [
                    'driver' => 'LocalFileSystem',
                    'path' => FCPATH . 'uploads/files',
                    'URL' => base_url('uploads/files'),         
                ],
            ],
        ];
    
        $connector = new \elFinderConnector(new \elFinder($opts));
        $connector->run();
    }
}