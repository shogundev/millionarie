<?php

namespace App\Http\Controllers;

use App\Models\Choice;
use App\Models\Game;
use App\Models\Question;
use Illuminate\Support\Facades\DB;

class QuizController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function play(){
        $questions = session()->get('questions')? : array();
        $current = session()->get('current_question');

        if($current && !$current['checked']){
            $question = Question::with('choices')->where('id', $current['id'])->where('status', 'active')->first();
        } else {
            $question  = Question::with('choices')->whereNotIn('id', $questions)->where('status', 'active')->inRandomOrder()->first();
        }

         if($question && !in_array($question->id, $questions)){
             $questions[] = $question->id;
         }


        session()->put([
            'current_question' =>[
                'id'=> $question ? $question->id : null,
                'checked'=> false],
            'questions' =>  $questions
        ]);

         $end = count(session()->get('questions')) == 5;

         if(count(session()->get('questions')) > 5) {
             $points = session()->get('points');
             Game::create([
                 'user_id' => auth()->user()->id,
                 'first_name' => auth()->user()->first_name,
                 'last_name' => auth()->user()->last_name,
                 'points' => $points
             ]);
             session()->forget(['questions', 'current_question', 'points']);
             return view('end', compact('points'));
         } else {
             return view('game', compact('question', 'end'));
         }


    }

    public function check($question, $choice){
        if(null != $correct = Choice::where('question_id', $question)->where('is_correct', '1')->first()){
            $correct = $correct->id;
        } else {
            $correct = null;
        }
        session()->put([
            'current_question' =>[
                'id'=> $question,
                'checked'=> true
            ]
        ]);

        if(null != $answer = Choice::where('id', $choice)->where('question_id', $question)->first()){
            if($answer->is_correct){
                $points = Question::find($question)->points;
                $earnedPoints = session()->get('points') ?  : 0;
                session()->put('points', $earnedPoints + $points);
            }
            return response()->json(['answer' => $answer->is_correct, 'correct' => $correct]);
        }

    }

    public function leaderboard() {
        $results = Game::select('user_id', 'first_name','last_name','created_at', DB::raw('MAX(points) AS points'))
            ->groupBy('user_id')->orderBy('points', 'DESC')->limit(10)->get();
        return view('leaderboard', compact('results'));
    }

}
