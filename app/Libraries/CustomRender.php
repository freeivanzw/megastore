<?php

namespace App\Libraries;

class CustomRender {
    private $view;
    private $layout;
    private $components = [];
    private $globalData = [];

    public function __construct()
    {
        $this->view = service('renderer');
    }

    /**
     * This method add lauout
     * @param string $layout path to file
     */
    public function setLayout(string $layout)
    {
        $this->layout = $layout;

        return $this;
    }

    /**
     * Method use for adding component and set data
     * @param string $view path to component file
     * @param array $data data for component
     */
    public function addComponent(string $view, $data = [])
    {
        $this->components[] = $this->view->setData($data)->render($view);

        return $this;
    }

    /**
     * Method for adding global data avaliable in all components
     * @param string $key data name
     * @param mixed $value data value
     */
    public function addGlobalData(string $key, mixed $value)
    {
        $this->globalData[$key] = $value;

        return $this;
    }

    /**
     * Method combine layout and components to one page
     * @return string returns page HTML
     */
    public function render(): string
    {
        $content = '';

        foreach ($this->components as $component) {
            $content .= $component;
        }

        return $this->view->setData([
                    ...$this->globalData,
                    'content' => $content,
                ])->render($this->layout);        
    }
}