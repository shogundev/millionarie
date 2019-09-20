<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\QuestionRequest;
use App\Models\Choice;
use App\Models\Question;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questions = Question::with('choices')->paginate(20);
        return view('admin.questions.index', compact('questions'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.questions.create_edit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(QuestionRequest $request)
    {
        $correct = explode('-', $request->correct)[1];
        $question =  Question::create($request->except('choices', '_token','correct'));

        foreach($request->choices as $key => $choice){
            Choice::create([
                'question_id' => $question->id,
                'choice' => $choice,
                'is_correct' => ($key == $correct)? '1' : '0'
            ]);
        }

       $question->load('choices');
       return view('admin.questions.create_edit', compact('question'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    {
        return view('admin.questions.create_edit', compact('question'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(QuestionRequest $request, Question $question)
    {
        $question->Update([
            'question' => $request->question,
            'points' => $request->points,
            'status' => $request->status,
        ]);

        if (strpos($request->correct, 'new') !== false) {
            $new_correct = explode('-', $request->correct)[1];
            $current_correct = 0;
        } else {
            $current_correct =  $request->correct;
            $new_correct = 0;
        }

        if($request->has('current')){
            $updated_keys = [];
            foreach($request->current as $key=>$choice) {
                $updated_keys[] = $key;
                Choice::where('id', $key)->update([
                    'question_id' => $question->id ,
                    'choice' => $choice,
                    'is_correct' => ($key == $current_correct)? '1' : '0'
                ]);
            }
        }
        Choice::where('question_id', $question->id)->whereNotIn('id', $updated_keys)->delete();

        if($request->has('choices')){
            foreach($request->choices as $key => $choice){
                Choice::create([
                    'question_id' => $question->id,
                    'choice' => $choice,
                    'is_correct' => ($key == $new_correct)? '1' : '0'
                ]);
            }
        }

        $question->load('choices');
        return view('admin.questions.create_edit', compact('question'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function delete($id){
        Question::find($id)->delete();
        Choice::where('question_id', $id)->delete();
        return redirect()->back();
    }
}
