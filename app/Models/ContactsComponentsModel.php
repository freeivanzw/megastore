<?php

namespace App\Models;

use CodeIgniter\Model;

class ContactsComponentsModel extends Model
{
    protected $table      = 'contacts_component';
    protected $primaryKey = 'id';

    protected $allowedFields = ['email', 'phones', 'work_time', 'map', 'component_id'];
}