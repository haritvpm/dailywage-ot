<?php

namespace App\Models;

use \DateTimeInterface;
//use App\Traits\MultiTenantModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class DutyFormItem extends Model
{
    //use MultiTenantModelTrait;
    use HasFactory;

    public $table = 'duty_form_items';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'form_id',
        'date_id',
        'employee_id',
        'fn_from',
        'fn_to',
        'an_from',
        'an_to',
        'total_hours',
        'created_at',
        'updated_at',
        'deleted_at',
        'created_by_id',
    ];

     protected $casts = [
        'fn_from' => 'datetime:H:i',
        'fn_to' => 'datetime:H:i',
        'an_from' => 'datetime:H:i',
        'an_to' => 'datetime:H:i',
    ];  

    public function form()
    {
        return $this->belongsTo(DutyForm::class, 'form_id');
    }

    public function date()
    {
        return $this->belongsTo(Calender::class, 'date_id');
    }

    public function employee()
    {
        return $this->belongsTo(DailyWageEmployee::class, 'employee_id');
    }

    public function created_by()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i');
    }
    /*
    public function getFnFromAttribute($value)
    {
       
        // return str_replace(":",".", $value);
        return Carbon::createFromFormat('h:i:s', $value)->format('h.i');
    } 
    /*
    public function setFnFromAttribute($value)
    {
        // return str_replace(".",":", $value);
        return Carbon::createFromFormat('h.i', $value)->format('h:i');
    }   */
}