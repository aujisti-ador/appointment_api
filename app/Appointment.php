<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
//    protected $fillable = ['host_id', 'guest_id', 'note', 'appointment_status_id', 'assistant_id', 'avatar', 'guest_name', 'date', 'time'];
    protected $guarded = [];
    protected $visible = ['host_id', 'guest_id', 'note', 'guest_name', 'location', 'appointment_status_id', 'assistant_id', 'avatar', 'created_at', 'date', 'time'];
}
