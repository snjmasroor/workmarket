<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tests;
use App\Models\Option;
use App\Models\Question;
use Yajra\DataTables\DataTables;


class QuestionController extends Controller
{
    public function create(Tests $test) {
        
        return view('admin.questions.create', compact('test'));
    }
    public function store(Request $request, Tests $test)
    {
        $request->validate([
            'question_text' => 'required|string|max:1000',
            'options' => 'required|array|min:2',
            'options.*' => 'required|string|max:255',
            'correct_option' => 'required|integer|min:0',
        ]);

        $question = new Question();
        $question->test_id = $test->id;
        $question->question = $request->question_text;
        $question->type = $test->test_type;
        $question->save();

        foreach ($request->options as $index => $text) {
            $option = new Option();
            $option->question_id = $question->id;
            $option->option_text = $text;
            if ($index == $request->correct_option) {
                $option->addFlag(Option::FLAG_IS_CORRECT);
            }
           
            $option->save();
        }

        return redirect()->route('admin.tests.add_question', $test->id)->with('success', 'Question added successfully!');
    }

    public function data(Request $request)
    {
        $query = Question::query(); // No with('options')
        if ($request->has('test_id')) {
            $query->where('test_id', $request->test_id);
        }
        $query->with('test');
        $query->orderBy('id', 'desc');

        return DataTables::of($query)
        ->addColumn('test_title', function ($row) {
            return $row->test->title ?? 'N/A';
        })
        ->addColumn('flags', function ($row) {
            if ($row->active === true || $row->active == 1) {
                return '<span class="badge bg-label-success me-1">Active</span>';
            } elseif ($row->active === false || $row->active == 0) {
                return '<span class="badge bg-label-warning me-1">Inactive</span>';
            } else {
                return '<span class="badge bg-secondary">None</span>';
            }
        })
        ->addColumn('action', function ($row) {
            $editUrl = route('admin.questions.edit', ['question' => $row->id]) . '?test_id=' . $row->test_id;
            $detailsUrl = route('admin.questions.show', $row->test_id);
            return '<div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                              <i class="ti ti-dots-vertical"></i>
                            </button>
                            <div class="dropdown-menu">
                              <a class="dropdown-item" href="'.$editUrl.'"
                                ><i class="ti ti-pencil me-1"></i> Edit</a
                              >
                              <a class="dropdown-item" href="'.$detailsUrl.'"
                                ><i class="ti ti-eye me-1"></i> Detail</a
                              >
                            </div>
                          </div>';
        })
        ->rawColumns(['flags', 'action']) // allow HTML rendering
        ->make(true);
    }

    public function edit(Question $question, Request $request)
    {
        $testId = $request->query('test_id'); // optional, for redirect/use
        $question->load('options');

        return view('admin.questions.edit', compact('question', 'testId'));
    }

    public function update(Request $request, Question $question)
    {
        $request->validate([
            'question_text' => 'required|string',
            'options' => 'required|array|min:2',
            'correct_option' => 'required|integer',
        ]);

        $question->question = $request->question_text;
        $question->save();

        foreach ($request->options as $index => $opt) {
            $option = Option::find($opt['id']);
            if ($option) {
                $option->option_text = $opt['text'];
                $option->flags = ($index == $request->correct_option) ? Option::FLAG_IS_CORRECT : 0;
                $option->save();
            }
        }

        return redirect()->back()->with('success', 'Question updated.');
    }

     public function allShow() {
        return view('admin.questions.all-question');
    } 

}
