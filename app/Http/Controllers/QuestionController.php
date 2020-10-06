<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Question;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $question = ($request->include == "answers") ? Question::with('answers')->get() : Question::all();
        return $this->successResponse('Questions Retrieved Successfully', $question);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response  $response
     */
    public function store(Request $request)
    {
        $question = Question::create($request->all());

        return $this->createResponse('Question created.', $question);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $question =  Question::findOrFail($id);
        return $this->successResponse('Question Retrieved Successfully', $question);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $question = Question::findOrFail($id);
        $question->update($request->all());

        return $this->successResponse('Question updated.', $question);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $question = Question::findOrFail($id);
        $question->delete();
        
        return $this->successResponse('Question deleted.');
    }
}
