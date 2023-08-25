<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use SoftDeletes;
    
    protected $table = 'students_details';

    protected $fillable = [
        'name',
        'email',
        'dob',
        'date_of_birth',
        'photo',
        'address',
    ];

    public function verification()
    {
        return $this->hasOne(StudentVerify::class);
    }

    protected $appends = ['fmt_created_at'];

    public function getFmtCreatedAtAttribute()
    {
        if (isset($this->attributes['created_at'])) {
            return \Carbon::parse($this->attributes['created_at'])->setTimezone('Asia/Kolkata')->format('d M Y h:i A');
        }
    }

}

?>
