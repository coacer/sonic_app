<?php

namespace App;

use App\Mail\RecruitMail;
use Illuminate\Database\Eloquent\Model;
use App\RecruitSkills;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Mail;

class Recruit extends Model
{
    public function recruitSkills()
    {
        return $this->hasMany(RecruitSkills::class);
    }

    public function bulkCreateRecruitSkills(?array $skills)
    {
        if ($skills === null) return;
        $recruit_skills = array_map(function ($skill) {
            return new RecruitSkills(['skill_type' => $skill]);
        }, $skills);
        $this->recruitSkills()->saveMany($recruit_skills);
    }

    public function displaySkills()
    {
        $skills = $this->recruitSkills->map(function ($recruit_skill) {
            return $recruit_skill->skill_type;
        })->toArray();
        return empty($skills) ? 'なし' : join(' / ', $skills);
    }

    public function getGender()
    {
        switch ($this->gender) {
        case 0:
            return '男性';
            break;
        case 1:
            return '女性';
            break;
        case 2:
            return 'その他';
            break;
        default:
            return null;
            break;
        }
    }

    public function getIsExperienced()
    {
        switch ($this->is_experienced) {
        case 0:
            return 'なし';
            break;
        case 1:
            return 'あり';
            break;
        default:
            return null;
            break;
        }
    }

    public static function getMonthlyTotal(): Collection
    {
        return self::orderBy('created_at')
            ->get()
            ->groupBy(function ($row) {
                return $row->created_at->format('n月');
            })
            ->map(function ($record) {
                return $record->count();
            });
    }

    public static function getExperiencedTotal(): array
    {
        return [
            'experienced' => self::where('is_experienced', true)->count(),
            'unexperienced' => self::where('is_experienced', false)->count()
        ];
    }

    public static function getMediumTotal(): array
    {
        return [
            'mobile' => self::where('is_mobile', true)->count(),
            'pc' => self::where('is_mobile', false)->count()
        ];
    }

    public function sendMail()
    {
        Mail::to(User::first()->email)
            ->send(new RecruitMail($this));
    }

    public function getIsCompleted()
    {
        return $this->is_completed ? '対応済み' : '未対応';
    }

    public static function getIsNotCompletedThreeDaysMore()
    {
        $now = Carbon::now();
        return self::where('created_at', '<=', $now->subDay(3))
            ->where('is_completed', false)
            ->get();
    }

    public function getShowUrl()
    {
        return url(route('recruits.show', $this));
    }

    protected $fillable= array(
        'name',
        'name_kana',
        'birthday',
        'gender',
        'email',
        'phone',
        'is_mobile',
        'is_experienced',
        'is_completed'
    );

    protected $casts = [
        'is_mobile' => 'boolean',
        'is_experienced' => 'boolean',
    ];

    public static function isMobile($request): bool
    {
        $user_agent =  $request->header('User-Agent');
        if ((strpos($user_agent, 'iPhone') !== false)
            || (strpos($user_agent, 'iPod') !== false)
            || (strpos($user_agent, 'Android') !== false)) {
            return true;
        } else {
            return false;
        }
    }
}
