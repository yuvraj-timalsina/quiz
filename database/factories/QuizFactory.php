<?php

    namespace Database\Factories;

    use App\Models\Quiz;
    use Illuminate\Database\Eloquent\Factories\Factory;
    use Illuminate\Support\Str;

    /**
     * @extends Factory<Quiz>
     */
    class QuizFactory extends Factory
    {
        public function definition() : array
        {
            $title = $this->faker->sentence();
            $slug = Str::slug($title);

            return [
                'title' => $title,
                'slug' => $slug,
                'description' => fake()->paragraph(),
                'published' => FALSE,
                'public' => FALSE,
            ];
        }
    }
