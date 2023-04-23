<?php

    namespace Database\Factories;

    use App\Models\Question;
    use App\Models\QuestionOption;
    use Illuminate\Database\Eloquent\Factories\Factory;

    /**
     * @extends Factory<QuestionOption>
     */
    class QuestionOptionFactory extends Factory
    {
        public function definition() : array
        {
            return [
                'option' => fake()->text(),
                'correct' => fake()->boolean(),
                'question_id' => Question::factory(),
            ];
        }
    }
