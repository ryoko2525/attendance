<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BreakTime extends Model
{
    protected $table = 'breaktimes';
    use HasFactory;
    protected $fillable = ['work_id', 'start_time', 'end_time'];

    public function work()
    {
        return $this->belongsTo(Work::class);
    }
}
