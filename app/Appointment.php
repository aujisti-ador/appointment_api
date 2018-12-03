<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $fillable = ['host_id', 'guest_id', 'note', 'location', 'appointment_status_id', 'assistant_id', 'avatar'];
    protected $visible = ['host_id', 'guest_id', 'note', 'location', 'appointment_status_id', 'assistant_id', 'avatar'];
}
