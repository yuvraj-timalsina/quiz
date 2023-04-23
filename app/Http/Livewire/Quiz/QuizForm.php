<?php

    namespace App\Http\Livewire\Quiz;

    use App\Models\Question;
    use App\Models\Quiz;
    use Illuminate\Contracts\View\View;
    use Illuminate\Http\RedirectResponse;
    use Illuminate\Support\Str;
    use Livewire\Component;
    use Livewire\Redirector;

    class QuizForm extends Component
    {
        public Quiz $quiz;

        public bool $editing = FALSE;

        public array $questions = [];

        public array $listsForFields = [];


        public function mount(Quiz $quiz) : void
        {
            $this->quiz = $quiz;

            $this->initListsForFields();

            if ($this->quiz->exists)
            {
                $this->editing = TRUE;
                $this->questions = $this->quiz->questions()->pluck('id')->toArray();
            } else
            {
                $this->quiz->published = FALSE;
                $this->quiz->public = FALSE;
            }
        }

        protected function initListsForFields() : void
        {
            $this->listsForFields['questions'] = Question::pluck('question_text', 'id')->toArray();
        }

        public function updatedQuizTitle() : void
        {
            $this->quiz->slug = Str::slug($this->quiz->title);
        }

        public function save() : RedirectResponse | Redirector
        {
            $this->validate();

            $this->quiz->save();

            $this->quiz->questions()->sync($this->questions);

            return to_route('quizzes');
        }

        public function render() : View
        {
            return view('livewire.quiz.quiz-form');
        }

        protected function rules() : array
        {
            return [
                'quiz.title' => [
                    'string',
                    'required',
                ],
                'quiz.slug' => [
                    'string',
                    'nullable',
                ],
                'quiz.description' => [
                    'string',
                    'nullable',
                ],
                'quiz.published' => [
                    'boolean',
                ],
                'quiz.public' => [
                    'boolean',
                ],
            ];
        }
    }
