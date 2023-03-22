<?php

namespace App\Http\Controllers;

use App\Models\Club;
use Illuminate\Http\Request;

class MainController extends Controller {
    public function index() {
        $clubs = Club::all()->sortByDesc('points');
        return view('home', compact('clubs'));
    }

    public function addClub(Request $request) {

        $request->validate([
            'name' => 'required|string|unique:clubs,name,'.$request->name,
            'city' => 'required|string|unique:clubs,city,'.$request->city,
        ]);

        $club = new Club();
        $club->name = $request->name;
        $club->city = $request->city;
        $club->save();
        return redirect()->route('home')->with('success', 'Klub berhasil ditambahkan!');
    }

    public function updateStandings(Request $request) {
        // dd($request->all());
        
        $request->validate([
            'club1' => 'required|array',
            'club1.*' => 'required|integer|distinct|exists:clubs,id',
            'club2' => 'required|array',
            'club2.*' => 'required|integer|distinct|exists:clubs,id',
            'score1' => 'required|array',
            'score1.*' => 'required|numeric',
            'score2' => 'required|array',
            'score2.*' => 'required|numeric',
        ]);


        // loop array of clubs1 request and update their standings
        foreach ($request->club1 as $key => $club_id) {
            $club = Club::find($club_id);
            $club->matches += 1;
            $club->goals_win += $request->score1[$key];
            $club->goals_lose += $request->score2[$key];
            if ($request->score1[$key] > $request->score2[$key]) {
                $club->wins += 1;
                $club->points += 3;
            } 
            elseif ($request->score1[$key] < $request->score2[$key]) {
                $club->loses += 1;
            } 
            else {
                $club->draws += 1;
                $club->points += 1;
            }
            $club->save();
        }

        // loop array of clubs2 request and update their standings
        foreach ($request->club2 as $key => $club_id) {
            $club = Club::find($club_id);
            $club->matches += 1;
            $club->goals_win += $request->score2[$key];
            $club->goals_lose += $request->score1[$key];
            if ($request->score2[$key] > $request->score1[$key]) {
                $club->wins += 1;
                $club->points += 3;
            } 
            elseif ($request->score2[$key] < $request->score1[$key]) {
                $club->loses += 1;
            } 
            else {
                $club->draws += 1;
                $club->points += 1;
            }
            $club->save();
        }

        return redirect()->route('home')->with('success', 'Klasemen berhasil diperbarui!');
    }

    public function resetStandings() {
        Club::query()->update([
            'matches' => 0,
            'wins' => 0,
            'draws' => 0,
            'loses' => 0,
            'goals_win' => 0,
            'goals_lose' => 0,
            'points' => 0,
        ]);
        return redirect()->route('home')->with('success', 'Klasemen berhasil direset!');
    }
}
