<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    protected $visible = ['name', 'domain_name', 'address'];
}
