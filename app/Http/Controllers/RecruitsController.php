<?php

namespace App\Http\Controllers;

use App\RecruitSkills;
use Illuminate\Http\Request;
use App\Recruit;
use Illuminate\Support\Facades\Log;
use App\Enums\SkillType;
use App\Http\Requests\RecruitRequest;

class RecruitsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['create', 'store', 'finish', 'confirm']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $recruits = Recruit::all();
        return view('recruits.index', compact('recruits'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $recruit = new Recruit;
        $skills = SkillType::getValues();
        return view('recruits.create', compact('recruit', 'skills'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->merge(["is_mobile" => Recruit::isMobile($request)]);
        $recruit = new Recruit($request->all());
        $recruit->save();
        $recruit->bulkCreateRecruitSkills($request->skills);
        $recruit->sendMail();
        return redirect()->route('recruits.finish');
    }

    public function confirm(RecruitRequest $request)
    {
        $recruit = new Recruit($request->all());
        $skills = $request->skills;
        return view('recruits.confirm', compact('recruit', 'skills'));
    }

    public function finish()
    {
        return view('recruits.finish');
    }

    public function isCompleted(Recruit $recruit)
    {
        $recruit->update(['is_completed' => true]);
        return redirect()->route('recruits.show', $recruit);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Recruit $recruit)
    {
        return view('recruits.show', compact('recruit'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Recruit $recruit)
    {
        $skills = SkillType::getValues();
        return view('recruits.edit', compact('recruit', 'skills'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Recruit $recruit)
    {
        $recruit->update($request->all());
        $recruit->recruitSkills()->delete();
        $recruit->bulkCreateRecruitSkills($request->skills);
        return redirect()->route('recruits.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Recruit $recruit)
    {
        $recruit->delete();
        return redirect()->route('recruits.index');
    }

    public function analysis()
    {
        $monthly_total = Recruit::getMonthlyTotal();
        $experienced_total = Recruit::getExperiencedTotal();
        $skill_total = RecruitSkills::getSkillTotal();
        $medium_total = Recruit::getMediumTotal();
        return view('recruits.analysis', compact('monthly_total', 'experienced_total', 'skill_total', 'medium_total'));
    }
}
