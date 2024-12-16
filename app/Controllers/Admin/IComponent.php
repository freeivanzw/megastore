<?php

namespace App\Controllers\Admin;

use CodeIgniter\HTTP\IncomingRequest;

interface IComponent {
    public function get(int $component_id): array;
    public function add(int $component_id);
    public function edit(int $component_id, IncomingRequest $request);
    public function remove(int $component_id);
}