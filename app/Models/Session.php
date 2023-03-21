<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    use HasFactory;

    public const STATUS_SELECT = [
        'active'   => 'Active',
        'inactive' => 'Inactive',
    ];
    public const STATUS_OVER = [
        'no' => 'OnGoing',
        'yes'   => 'Finished',
    ];

    public $table = 'sessions';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'assembly',
        'session',
        'status',
        'viewstatus',
        'over',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function sessionCalenders()
    {
        return $this->hasMany(Calender::class, 'session_id', 'id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
