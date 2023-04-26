<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    use HasFactory;

    protected $table = 'questionaires';
    protected $fillable = [
        
        'user_id',
        'course',
        'age',
        'year_graduated',
        'permanent_home_address',
        'work_company',
        'employment_status',
        'company_location',
        'position_on_work',
        'date_hired',
        'employed_status',
        'civil_service',
        'awards_received',
        'job_to_course',
        'status'

    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
