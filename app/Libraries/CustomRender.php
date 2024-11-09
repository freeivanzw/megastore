<?php

namespace App\Libraries;

class CustomRender {
    private $view;
    private $layout = 'Admin/Default';
    private $components = [];

    public function __construct()
    {
        $this->view = service('renderer');
    }

    public function setLayout(string $layout)
    {
        $this->layout = $layout;

        return $this;
    }

    public function addComponent(string $view, $data = [])
    {
        $this->components[] = $this->view->setData($data)->render($view);

        return $this;
    }

    public function render()
    {
        $content = '';

        foreach ($this->components as $component) {
            $content .= $component;
        }

        return $this->view->setData(['content' => $content])->render($this->layout);        
    }
}