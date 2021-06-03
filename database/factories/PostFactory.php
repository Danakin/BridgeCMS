<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title = $this->faker->words(rand(3, 7), true);

        $publishedAt = NULL;
        if(rand(0, 3) > 0) {
            $mode = rand(0, 1);
            if ($mode === 0) {
                $publishedAt = now()
                    ->subYears(rand(0,2))
                    ->subMonths(rand(0,12))
                    ->subDays(rand(0,31))
                    ->subHours(rand(1,24))
                    ->subMinutes(rand(1,60))
                    ->subSeconds(rand(1,60));
            } else {
                $publishedAt = now()
                    ->addYears(rand(0,2))
                    ->addMonths(rand(0,12))
                    ->addDays(rand(0,31))
                    ->addHours(rand(1,24))
                    ->addMinutes(rand(1,60))
                    ->addSeconds(rand(1,60));
            }
        }

        return [
            'title' => $title,
            'description' => $this->faker->sentences(3, true),
            'slug' => Str::slug($title),
            'published_at' => $publishedAt,
            'published' => rand(0,1),
        ];
    }
}
