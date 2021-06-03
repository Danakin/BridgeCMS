<?php

namespace Database\Factories;

use App\Models\Page;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Page::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title = $this->faker->words(rand(1, 3), true);
        return [
            "title" => $title,
            "slug" => Str::slug($title),
            "description" => $this->faker->sentences(3, true),
            "can_have_posts" => $this->faker->boolean(),
            "content" => $this->faker->paragraphs(3, true),
        ];
    }
}
