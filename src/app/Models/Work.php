<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Work extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'start_time', 'end_time', 'work_date'];

    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function breakTimes()
    {
        return $this->hasMany(BreakTime::class);
    }

    /**
     * 休憩時間の合計を秒で計算
     * 
     * @return int 休憩時間の合計（秒）
     */
    public function calculateTotalBreakDurationInSeconds()
    {
        //終了してる休憩時間合計
        $totalBreakDurationInSeconds = $this->breakTimes->whereNotNull('end_time')->sum(function ($break) {
            return Carbon::parse($break->end_time)->diffInSeconds(Carbon::parse($break->start_time));
        });

        //進行中の休憩時間も➕
        $ongoingBreak = $this->breakTimes->whereNull('end_time')->first();
        if ($ongoingBreak) {
            $ongoingBreakStart = Carbon::parse($ongoingBreak->start_time);
            $ongoingBreakDurationInSeconds = Carbon::now()->diffInSeconds($ongoingBreakStart);
            $totalBreakDurationInSeconds += $ongoingBreakDurationInSeconds;
        }

        return $totalBreakDurationInSeconds;
    }
    /*
     * 勤務時間の取得
     * 
     * @return int 勤務時間（秒）
     */
    public function getWorkDurationAttribute()
    {
        if (is_null($this->start_time)) {
            return 0;
        }

        $start = Carbon::parse($this->start_time);
        $end = $this->end_time ? Carbon::parse($this->end_time) : Carbon::now();
        $totalDurationInSeconds = $end->diffInSeconds($start);

        $totalBreakDurationInSeconds = $this->calculateTotalBreakDurationInSeconds();

        return $totalDurationInSeconds - $totalBreakDurationInSeconds;
    }

    /**
     * 勤務時間と休憩時間の計算を行い、プロパティにセット
     */
    public function calculateDurations()
    {
        $totalBreakDuration = $this->calculateTotalBreakDurationInSeconds();

        $workDuration = 0;
        if (!empty($this->end_time)) {
            $start = Carbon::parse($this->start_time);
            $end = Carbon::parse($this->end_time);
            $workDuration = $end->diffInSeconds($start) - $totalBreakDuration;
        }

        $this->total_break_duration = $totalBreakDuration;
        $this->work_duration = $workDuration;
    }
    
}
