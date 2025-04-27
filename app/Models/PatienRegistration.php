<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PatienRegistration extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'patien_registrations';
    protected $guarded = ["id"];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }

    public function insurance()
    {
        return $this->belongsTo(insurance::class, 'insurance_id');
    }

    public function service_room()
    {
        return $this->belongsTo(ServiceRoom::class, 'service_room_id');
    }
}
