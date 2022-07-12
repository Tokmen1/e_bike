<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ebike extends Model
{
    use HasFactory;

    protected $table = 'e_bike';
    protected $attributes = [
        'brand' => null,
        'odometer' => null,
    ];
    protected $fillable = [
        'id',
        'brand',
        'odometer',
    ];
    protected $hidden = [];
    protected $casts = [];
    protected $appends = [];

    public function employee_e_bike() {
        return $this->belongsTo(Employee_e_bike::class);
    }
}
