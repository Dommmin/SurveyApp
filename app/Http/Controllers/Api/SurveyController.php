<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAnswerRequest;
use App\Http\Requests\StoreSurveyRequest;
use App\Http\Resources\EntryResource;
use App\Http\Resources\SurveyResource;
use App\Models\Answer;
use App\Models\Entry;
use App\Models\Question;
use App\Models\Survey;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class SurveyController extends Controller
{
    public function index()
    {
        // TODO Pagination
//        return SurveyResource::collection(Survey::paginate(10));
        return SurveyResource::collection(Survey::all());
    }

    public function store(StoreSurveyRequest $request)
    {
        $data = $request->validated();

        $survey = Survey::create($data);

        foreach ($data['questions'] as $question )
        {
            $question['survey_id'] = $survey->id;
            $this->createQuestion($question);
        }

        return new SurveyResource($survey);
    }

    public function show(Survey $survey)
    {
        return new SurveyResource($survey);
    }

    public function entry(Survey $survey)
    {
        if (!$survey->is_public) {
            return abort(401);
        }

        return new SurveyResource($survey);
    }

    public function storeAnswer(StoreAnswerRequest $request, Survey $survey)
    {
        $validated = $request->validated();

        $entry = Entry::where('survey_id', '=', $survey->id)
//            ->where('participant_id', '=', auth()->id())
            ->where('ip', '=', $request->getClientIp())
            ->first();

        if ($entry) return response('', 401);
            $entry = new Entry();
            $entry->participant()->associate(auth()->id());
            $entry->survey()->associate($survey);
            $entry->ip = $request->getClientIp();
            $entry->save();

            foreach ($validated['answers'] as $questionId => $answer) {
                $question = Question::where(['id' => $questionId, 'survey_id' => $survey->id])->get();
                if (!$question)
                {
                    return response("Invalid question ID: \"$questionId\"", 400);
                }

                $data = [
                    'question_id' => $questionId,
                    'entry_id' => $entry->id,
                    'answer' => $answer
                ];

                Answer::create($data);
            }

        return response('', 201);
    }

    public function update(Survey $survey, StoreSurveyRequest $request)
    {
        $data = $request->validated();

        $survey->update($data);

        // Get ids as plain array of existing questions
        $existingIds = $survey->questions()->pluck('id')->toArray();

        // Get ids as plain array of new questions
        $newIds = Arr::pluck($data['questions'], 'id');

        // Find questions to delete
        $toDelete = array_diff($existingIds, $newIds);

        //Find questions to add
        $toAdd = array_diff($newIds, $existingIds);

        // Delete questions by $toDelete array
        Question::destroy($toDelete);

        // Create new questions
        foreach ($data['questions'] as $question)
        {
            if (in_array($question['id'], $toAdd, true))
            {
                $question['survey_id'] = $survey->id;
                $this->createQuestion($question);
            }
        }

        // Update existing questions
        $questionMap = collect($data['questions'])->keyBy('id');
        foreach ($survey->questions as $question)
        {
            if (isset($questionMap[$question->id]))
            {
                $this->updateQuestion($question, $questionMap[$question->id]);
            }
        }

        return new SurveyResource($survey);
    }

    public function destroy(Survey $survey)
    {
        $survey->delete();
        $survey->questions()->delete();
        $survey->entries()->delete();

        return response()->noContent();
    }

    protected function createQuestion($data)
    {
        if (is_array($data['data']))
        {
            if ($data['data'])
            {
                $data['data'] = json_encode($data['data']);
            }
            else
            {
                $data['data'] = '{}';
            }
        }

        $validator = Validator::make($data, [
            'question' => 'required|string',
            'type' => ['required', Rule::in([
                Survey::TYPE_TEXT,
                Survey::TYPE_RADIO,
            ])],
            'data' => 'present',
            'survey_id' => 'exists:App\Models\Survey,id'
        ]);

        return Question::create($validator->validated());
    }

    protected function updateQuestion(Question $question, $data)
    {
        if (is_array($data['data']))
        {
            if ($data['data'])
            {
                $data['data'] = json_encode($data['data']);
            }
            else
            {
                $data['data'] = '{}';
            }
        }

        $validator = Validator::make($data, [
            'id' => 'exists:App\Models\Question,id',
            'question' => 'required|string',
            'type' => ['required', Rule::in([
                Survey::TYPE_TEXT,
                Survey::TYPE_RADIO,
            ])],
            'data' => 'present',
        ]);

        return $question->update($validator->validated());
    }

    public function entries()
    {
        return EntryResource::collection(Entry::alL());
    }

    public function destroyEntry(Entry $entry)
    {
        $entry->delete();
        $entry->answers()->delete();

        return response()->noContent();
    }

    public function home()
    {
        return SurveyResource::collection(Survey::where('is_public', '=', true)->get());
    }
}
