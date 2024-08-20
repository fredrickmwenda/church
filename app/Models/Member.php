<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Member extends Model
{
    protected $table = "members";

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        "branch_id",
        "first_name",
        "middle_name",
        "last_name",
        "user_id",
        "gender",
        "marital_status",
        "status",
        "home_phone",
        "mobile_phone",
        "work_phone",
        "dob",
        "address",
        "notes",
        "email",
        "files",
        "cell_id",
        "membership_id",
    ];



    public function loans()
    {
        return $this->hasMany(Loan::class, 'borrower_id', 'id');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function pledges()
    {
        return $this->hasMany(Pledge::class, 'member_id', 'id');
    }

    public function contributions()
    {
        return $this->hasMany(Contribution::class, 'member_id', 'id');
    }

    public function tags()
    {
        return $this->hasMany(MemberTag::class, 'member_id', 'id');
    }

    public function attendance()
    {
        return $this->hasMany(EventAttendance::class, 'member_id', 'id');
    }
    public function families()
    {
        return $this->hasMany(FamilyMember::class, 'member_id', 'id');
    }
    public function family()
    {
        return $this->hasOne(Family::class, 'member_id', 'id');
    }


    //   Add by  JOJO

    public function cell()
    {
        return $this->belongsTo(Cell::class, 'member_id', 'id');
    }


    public function branch()
    {
        return $this->hasOne(Branch::class, 'member_id', 'id');
    }
    //   Add by  JOJO
}
