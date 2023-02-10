<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\MultiTenantModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SessionDuty extends Model
{
    use MultiTenantModelTrait;
    use HasFactory;

    public $table = 'session_duties';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'employee_id',
        'session_id',
        'created_at',
        'owned_by_id',
        'section_name',
        'updated_at',
        'deleted_at',
        'created_by_id',
    ];

    public function employee()
    {
        return $this->belongsTo(DailyWageEmployee::class, 'employee_id');
    }

    public function session()
    {
        return $this->belongsTo(Session::class, 'session_id');
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
