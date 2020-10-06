<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Survey;

class SurveyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $survey = Survey::all();
        
        return $this->baseRetrieveResponse('Survey Retrieved Successfully', $survey);
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response  $response
     */
    public function store(Request $request)
    {
        $survey = Survey::create($request->all());

        return $this->baseCreateResponse('Survey created.', $survey);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $survey =  Survey::findOrFail($id);
        return $this->baseRetrieveResponse('Survey Retrieved Successfully', $survey);
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
        $survey = Survey::findOrFail($id);
        $survey->update($request->all());

        return $this->baseUpdateResponse('Survey updated.', $survey);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $survey = Survey::findOrFail($id);
        $survey->delete();
        
        return $this->baseDeleteResponse('Survey deleted.');
    }
}
