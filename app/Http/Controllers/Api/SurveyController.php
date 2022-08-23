<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSurveyRequest;
use App\Http\Resources\SurveyResource;
use App\Models\Survey;
use Illuminate\Http\Request;

class SurveyController extends Controller
{
    public function index()
    {
        return SurveyResource::collection(Survey::all());
    }

    public function store(StoreSurveyRequest $request)
    {
        $survey = Survey::create($request->validated());

        return new SurveyResource($survey);
    }

    public function show(Survey $survey)
    {
        return new SurveyResource($survey);
    }

    public function update(Survey $survey, StoreSurveyRequest $request)
    {
        $survey->update($request->validated());

        return new SurveyResource($survey);
    }

    public function destroy(Survey $survey)
    {
        $survey->delete();

        return response()->noContent();
    }
}
