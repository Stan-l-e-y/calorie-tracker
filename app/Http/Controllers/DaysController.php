<?php

namespace App\Http\Controllers;

use App\Models\Day;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DaysController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $user = User::find(auth()->id());


        $links = Day::where('user_id', auth()->id())->paginate(27);

        //Weight function
        $weight = Day::where('user_id', auth()->id())->paginate(28)->map(function ($day) {
            return $day->weight;
        });

        $test = Day::where('user_id', auth()->id())->get()->map(function ($day) {
            return $day->weight;
        });

        $avgWeight = $test->chunk(7)->all();

        //Calorie function
        $calories = Day::where('user_id', auth()->id())->paginate(28)->map(function ($day) {
            return $day->calories;
        });

        $avgCal = $calories->chunk(7)->all();

        return view('table-show', ['weight' => $weight, 'links' => $links, 'avgWeight' => $avgWeight, 'calories' => $calories, 'avgCal' => $avgCal,]);
    }

    public function apiIndex()
    {
        return Day::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $day = new Day;

        $attributes = request()->validate([
            'weight' => 'required|numeric',
            'calories' => 'required|numeric',
            'user_id' => 'required'
        ]);

        $day = Day::create($attributes);

        return $day;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Day  $day
     * @return \Illuminate\Http\Response
     */
    public function show(Day $day)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Day  $day
     * @return \Illuminate\Http\Response
     */
    public function edit(Day $day)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Day  $day
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // dd($request->all());
        $day = Day::find($id);
        $day->update($request->all());
        return $day;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Day  $day
     * @return \Illuminate\Http\Response
     */
    public function destroy(Day $day)
    {
        //
    }

    public function checkWeightDiff($weight, $weightDropGoalPerWeek = 2)
    {
        //check if you gained weight or lost 
        // $diff = $lastWeek - $currentWeek
        // check if the ratio is good

        // return good or ok or bad, 


        $ratio = ($weight - $weightDropGoalPerWeek) / $weightDropGoalPerWeek * 100;

        return $ratio;
        // >= -30 is bad
        // < -25 && >=-15 is ok
        // < -15 && 35
        // < 35 is concerning
        //
    }
}
