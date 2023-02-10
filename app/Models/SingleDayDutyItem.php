<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\MultiTenantModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SingleDayDutyItem extends Model
{
    use MultiTenantModelTrait;
    use HasFactory;

    public $table = 'single_day_duty_items';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'employee_id',
        'fn_from',
        'fn_to',
        'an_from',
        'an_to',
        'total_hours',
        'created_at',
        'form_id',
        'updated_at',
        'deleted_at',
        'created_by_id',
    ];

    public function employee()
    {
        return $this->belongsTo(DailyWageEmployee::class, 'employee_id');
    }

    public function form()
    {
        return $this->belongsTo(SingleDayDuty::class, 'form_id');
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
