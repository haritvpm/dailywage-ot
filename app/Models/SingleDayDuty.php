<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\MultiTenantModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SingleDayDuty extends Model
{
    use MultiTenantModelTrait;
    use HasFactory;

    public $table = 'single_day_duties';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'date_id',
        'total_hours',
        'created_at',
        'owned_by_id',
        'section_name',
        'updated_at',
        'deleted_at',
        'created_by_id',
    ];

    public function date()
    {
        return $this->belongsTo(Calender::class, 'date_id');
    }

    public function owned_by()
    {
        return $this->belongsTo(User::class, 'owned_by_id');
    }

    public function created_by()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
