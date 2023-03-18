<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public $table = 'categories';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'title',
        'longtitle',
        'max_hours',
        'working_fn_from',
        'working_fn_to',
        'working_an_from',
        'working_an_to',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function categoryDailyWageEmployees()
    {
        return $this->hasMany(DailyWageEmployee::class, 'category_id', 'id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
