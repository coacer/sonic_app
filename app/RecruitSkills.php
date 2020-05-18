<?php

namespace App;

use App\Enums\SkillType;
use Illuminate\Database\Eloquent\Model;
use App\Recruit;
use Illuminate\Support\Facades\DB;

class RecruitSkills extends Model
{
    public function recruit()
    {
        $this->belongsTo(Recruit::class);
    }

    public static function getSkillTotal()
    {
        // return RecruitSkills::select('skill_type', DB::raw('count(*) as total'))
        //     ->groupBy('skill_type')
        //     ->get();
        $data = RecruitSkills::select('skill_type', DB::raw('count(*) as total'))
            ->groupBy('skill_type')
            ->get();
        $skill_types = [];
        $totals = [];
        foreach($data as $record) {
            array_push($skill_types, $record->skill_type);
            array_push($totals, $record->total);
        }
        return ['skill_types' => $skill_types, 'totals' => $totals];
    }

    protected $enumCasts = [
        'skill_type' => SkillType::class,
    ];

    protected $fillable= array(
        'recruit_id',
        'skill_type'
    );
}
