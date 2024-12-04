<?php

namespace App\Controllers\Admin;

interface IComponent {
    public function get(int $component_id): array;
    public function add(int $component_id);
    public function edit(int $component_id, array $data);
    public function remove(int $component_id);
}