<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee_e_bike extends Model
{
    use HasFactory;

    protected $table = 'employee';
    protected $attributes = [
        'employee_id' => null,
        'e_bike_id' => null,
        'date_from' => null,
        'date_to' => null,
    ];
    protected $fillable = [
        'id',
        'employee_id',
        'e_bike_id',
        'date_from',
        'date_to',
    ];
    protected $hidden = [];
    protected $casts = [];
    protected $appends = [];

    public function employee_e_bike() {
        return $this->belongsTo(Employee_e_bike::class);
    }
}
