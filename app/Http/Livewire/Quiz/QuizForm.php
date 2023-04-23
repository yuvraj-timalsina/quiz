<?php

namespace App\Http\Livewire\Quiz;

use App\Models\Quiz;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\Redirector;

class QuizForm extends Component
{
    public Quiz $quiz;

    public bool $editing = false;

    public function mount(Quiz $quiz): void
    {
        $this->quiz = $quiz;

        if ($this->quiz->exists) {
            $this->editing = true;
        } else {
            $this->quiz->published = false;
            $this->quiz->public = false;
        }
    }

    public function updatedQuizTitle(): void
    {
        $this->quiz->slug = Str::slug($this->quiz->title);
    }

    public function save(): RedirectResponse|Redirector
    {
        $this->validate();

        $this->quiz->save();

        return to_route('quizzes');
    }

    public function render(): View
    {
        return view('livewire.quiz.quiz-form');
    }

    protected function rules(): array
    {
        return [
            'quiz.title'       => [
                'string',
                'required',
            ],
            'quiz.slug'        => [
                'string',
                'nullable',
            ],
            'quiz.description' => [
                'string',
                'nullable',
            ],
            'quiz.published'   => [
                'boolean',
            ],
            'quiz.public'      => [
                'boolean',
            ],
        ];
    }
}
