<?php

namespace App\Http\Controllers;

use App\Models\Day;
use App\Models\User;
use Carbon\Carbon;
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

        $days = Day::all();

        $user = User::find(auth()->id());

        foreach ($days as $day) {
            if (is_null($day->created_timezone)) {

                // $day->created_at = Carbon::parse($day->created_at)->timezone($user->timezone);
                // $newDay = Carbon::createFromFormat('Y-m-d H:i:s', $day->created_at, $user->timezone)->setTimezone($user->timezone);

                //to keep UTC time in created do this
                $time = Carbon::parse($day->created_at)->timezone($user->timezone);
                $newDay = Carbon::createFromFormat('Y-m-d H:i:s', $time, $user->timezone)->setTimezone($user->timezone);

                $day->created_timezone = $newDay;
                $day->save();
            }


            // $day->created_at = Carbon::parse($day->created_at)->timezone($user->timezone);
            // $newDay = Carbon::createFromFormat('Y-m-d H:i:s', $day->created_at, $user->timezone)->setTimezone($user->timezone);
            // ddd($newDay);
            // ddd($day->created_at->timestamp);
            // ddd($day->created_at->tzName);

            // $day->save();
        }



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

        //Created_at function
        $createdTime = Day::where('user_id', auth()->id())->paginate(28)->map(function ($day) {
            return $day->created_timezone;
        });

        $id = Day::where('user_id', auth()->id())->paginate(28)->map(function ($day) {
            return $day->id;
        });

        $avgCal = $calories->chunk(7)->all();


        return view('table-show', ['weight' => $weight, 'links' => $links, 'avgWeight' => $avgWeight, 'calories' => $calories, 'avgCal' => $avgCal, 'createdTime' => $createdTime, 'id' => $id]);
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
        $attributes = request()->validate([
            'weight' => 'required|numeric',
            'calories' => 'required|numeric',
        ]);
        $day = Day::find($id);
        $day->update($attributes);
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
