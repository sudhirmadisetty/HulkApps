<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class StudentVerify extends Model
{
    use SoftDeletes;
    
    protected $table = 'student_verification';

    protected $fillable = [
        'student_id',
        'status',
        'admin_id',
    ];


    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    protected $appends = ['fmt_created_at'];

    public function getFmtCreatedAtAttribute()
    {
        if (isset($this->attributes['created_at'])) {
            return Carbon::parse($this->attributes['created_at'])->setTimezone('Asia/Kolkata')->format('d M Y h:i A');
        }
    }
}


?>