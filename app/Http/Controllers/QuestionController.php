<?php
namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use App\Question;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
class QuestionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $question = new Question;
        $edit = FALSE;
        return view('questionForm', ['question' => $question,'edit' => $edit  ]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->validate([
            'body' => 'required|min:5',
        ], [
            'body.required' => 'Body is required',
            'body.min' => 'Question must be at least 5 characters',
        ]);
        $input = request()->all();
        Log::info(print_r($input, true));
        if(!array_key_exists('body', $input)){
            $input['body'] = $input['message'];
        }
        $question = new Question($input);
        $question->user()->associate(Auth::user());
        $question->save();
        return redirect()->route('home')->with('message', 'Question has been created!');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        //dd($question);
        $userID = $question->user_id;
        //dd($userID);
        $questionUser = DB::table('users')->where('id',$userID)->first();
        //dd($questionUser);
        return view('question')->with(['question' => $question, 'user' => $questionUser]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    {
        $edit = TRUE;
        return view('questionForm', ['question' => $question, 'edit' => $edit ]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Question $question)
    {
        $input = $request->validate([
            'body' => 'required|min:5',
        ], [
            'body.required' => 'Body is required',
            'body.min' => 'Body must be at least 5 characters',
        ]);
        $question->body = $request->body;
        $question->save();
        return redirect()->route('question.show',['question_id' => $question->id])->with('message', 'Question Updated!');
    }

    public function destroy(Question $question)
    {
        $question->delete();
        return redirect()->route('home')->with('message', 'Question Deleted!');
    }
    public function allQuestions(){
        $allQuestions = Question::all();
        return view('allQuestions')->with('allQuestions', $allQuestions);
    }
}