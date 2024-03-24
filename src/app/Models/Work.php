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
    //work_durationのアクセサを追加
    public function getWorkDurationAttribute()
    {
        $start = Carbon::parse($this->start_time);
        $end = $this->end_time ? Carbon::parse($this->end_time) : Carbon::now();
        $totalDurationInSeconds = $end->diffInSeconds($start);

        // 休憩終了時刻が設定されている休憩のみを計算に含める
        $totalBreakDurationInSeconds = $this->breakTimes->whereNotNull('end_time')->sum(function ($break) {
            $breakStart = Carbon::parse($break->start_time);
            $breakEnd = Carbon::parse($break->end_time);
            return $breakEnd->diffInSeconds($breakStart);
        });

        // 現在休憩中の場合、その休憩時間を勤務時間から除外する
        $ongoingBreak = $this->breakTimes->whereNull('end_time')->first();
        if ($ongoingBreak) {
            $ongoingBreakStart = Carbon::parse($ongoingBreak->start_time);
            $ongoingBreakDurationInSeconds = Carbon::now()->diffInSeconds($ongoingBreakStart);
            // 現在休憩中の時間を休憩時間に加える
            $totalBreakDurationInSeconds += $ongoingBreakDurationInSeconds;
        }

            // 勤務時間から休憩時間を引いた値を秒で返す
            return $totalDurationInSeconds - $totalBreakDurationInSeconds;
        
        return 0; // 勤務終了時刻がない場合は0を返す
    }

}