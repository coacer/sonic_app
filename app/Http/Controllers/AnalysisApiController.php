<?php

namespace App\Http\Controllers;

use App\Recruit;
use App\RecruitSkills;
use Illuminate\Http\Request;

class AnalysisApiController extends Controller
{
    public function monthly()
    {
        return Recruit::getMonthlyTotal();
    }

    public function experienced()
    {
        return Recruit::getExperiencedTotal();
    }

    public function skill()
    {
        return RecruitSkills::getSkillTotal();
    }

    public function medium()
    {
        return Recruit::getMediumTotal();
    }

}
