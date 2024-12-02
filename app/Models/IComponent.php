<?php

namespace App\Models;

interface IComponent {
    public function add(int $component_id);
    public function edit(int $component_id, array $data);
    public function remove(int $component_id);
}