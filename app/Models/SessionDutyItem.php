<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\MultiTenantModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SessionDutyItem extends Model
{
    use MultiTenantModelTrait;
    use HasFactory;

    public $table = 'session_duty_items';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'fn_from',
        'fn_to',
        'an_from',
        'an_to',
        'total_hours',
        'date_id',
        'created_at',
        'form_id',
        'updated_at',
        'deleted_at',
        'created_by_id',
    ];

    public function date()
    {
        return $this->belongsTo(Calender::class, 'date_id');
    }

    public function form()
    {
        return $this->belongsTo(SessionDuty::class, 'form_id');
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
