<?php

namespace App\Models;

use \DateTimeInterface;
//use App\Traits\MultiTenantModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DutyForm extends Model
{
  //  use MultiTenantModelTrait;
    use HasFactory;

    public const FORM_TYPE_SELECT = [
        'oneday-multiemp'     => 'oneday-multiemp',
        'alldays-oneemp' => 'alldays-oneemp',
        'alldays-multiemp' => 'alldays-multiemp',
    ];

    public $table = 'duty_forms';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'form_num',
        'form_type',
        'date_id',
        'session_id',
        'employee_id',
        'total_hours',
        'created_at',
        'owned_by_id',
        'updated_at',
        'deleted_at',
        'created_by_id',
        'creator', //need separate field from created_by, because created_by_id can change later. but we need the original approver
        'approver',
      
    ];

    protected $appends = array('section');
   
    public function date()
    {
        return $this->belongsTo(Calender::class, 'date_id');
    }

    public function session()
    {
        return $this->belongsTo(Session::class, 'session_id');
    }

    public function employee()
    {
        return $this->belongsTo(DailyWageEmployee::class, 'employee_id');
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
    public function dutyItems()
    {
        return $this->hasMany(DutyFormItem::class, 'form_id', 'id');
    }

    public function getSectionAttribute()
    {
        $section = Section::where( 'user_id' ,  $this->created_by_id)->first();

        return  $section?->name ?? '' ;

     
    }

}
