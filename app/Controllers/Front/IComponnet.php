<?php

namespace App\Controllers\Front;

interface IComponnet {
    public function publicData(int $compomnent_id): array;
}