<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnswersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('index');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Question $question)
    {
        return $question->answers()->with('user')->simplePaginate(3);
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
    public function store(Question $question,Request $request)
    {
        // $request->validate([
        //     'body' => 'required'
        // ]);

        $answer = $question->answers()->create($request->validate([
            'body' => 'required'
        ])+ ['user_id' => Auth::id()]);
        if($request->expectsJson()){
            return response()->json([
                'message' => "Your answer has been submited",
                'answer' => $answer->load('user'),
            ],201);
        }
        return back()->with('success','Cau tra loi da duoc gui');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function show(Answer $answer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question, Answer $answer)
    {
        $this->authorize('update',$answer);
        return view('answers.edit',compact(['question','answer']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Question $question, Answer $answer)
    {
        $this->authorize('update',$answer);
        $answer->update($request->validate([
            'body' => 'required',
        ]));
        if($request->expectsJson()){ 
            return response()->json([
                'message' => 'Sửa câu tra lời thành công',
                'body_html' => $answer->body_html
            ]);
        }
        return redirect()->route('questions.show',$question->slug)->with('success','Sửa câu tra lời thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question,Answer $answer)
    {
        $this->authorize('delete',$answer);
        $answer->delete();
        if(request()->expectsJson()){ 
            return response()->json([
                'message' => 'Xóa câu trả lời thành công',
            ]);
        }
        return back()->with('success','Xóa câu trả lời thành công');
    }
}
