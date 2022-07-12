<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $table = 'employee';
    protected $attributes = [
        'first_name' => null,
        'last_name' => null,
        'email' => null,
    ];
    protected $fillable = [
        'id',
        'first_name',
        'last_name',
        'email',
    ];
    protected $hidden = [];
    protected $casts = [];
    protected $appends = [];

    public function employee_e_bike() {
        return $this->belongsTo(Employee_e_bike::class);
    }
}

