<?php

namespace App\Http\Controllers;

use App\Http\Requests\AskQuestionRequest;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class QuestionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth',['except' => ['index','show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // DB::enableQueryLog();
        $questions = Question::orderBy('created_at','desc')->paginate(5);
        return view('questions.index',compact('questions'));
        // dd(DB::getQueryLog());
        // return response()->json(['questions'=>$questions]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $question = new Question();
        return view("questions.create",compact('question'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AskQuestionRequest $request)
    {
        $request->user()->questions()->create($request->only(['title','body']));
        return redirect()->route('questions.index')->with('success','Cau hoi cua ban da duoc gui');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        $question->increment('views');//mỗi lần user vào route này tức là 1 lượt view nên cần tăng view lê 1 đơn vị
        return view('questions.show',compact('question'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    {
        //cách 1
        if(Gate::allows('update-question',$question)){
            return view('questions.edit',compact('question'));
        }
        abort(403,"Access denial");
        //cách 2 để tạo authorization gõ : php artisan make:policy <tên polycy> --model=<tên model áp dụng policy>
        //sau đó vào AuthServideProvider sửa trong mảng policies để policy có hiệu lực
        // $this->authorize('update',$question);
        // return view('questions.edit',compact('question'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(AskQuestionRequest $request, Question $question)
    {
        //cách 1
        if(Gate::allows('update-question',$question)){
            $question->update($request->only('title','body'));
            return redirect('/questions')->with('success','Cap nhat thanh cong');
        }
        abort(403,"Access denial");
        //cách 2
        // $this->authorize('update',$question);
        // $question->update($request->only('title','body'));
        // return redirect('/questions')->with('success','Cap nhat thanh cong');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
        //cách 1
        if(Gate::allows('delete-question',$question)){
            $question->delete();
            return redirect('/questions')->with('success','Xoa thanh cong');
        }
        abort(403,"Access denial");
        //cách 2
        // $this->authorize('delete',$question);
        // $question->delete();
        // return redirect('/questions')->with('success','Xoa thanh cong');
    }
}
