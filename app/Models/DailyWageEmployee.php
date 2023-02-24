<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyWageEmployee extends Model
{
    use HasFactory;

    public $table = 'daily_wage_employees';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'ten',
        'designation_id',
        'category_id',
        'section_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    protected $appends = array('displayname');

    public function getDisplaynameAttribute()
    {
        return  $this->ten . '-' . $this->name . ' (' . $this->designation->title . ')';
     
    }

    public function designation()
    {
        return $this->belongsTo(Designation::class, 'designation_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function section()
    {
        return $this->belongsTo(Section::class, 'section_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
