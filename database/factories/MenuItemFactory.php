<?php

namespace Database\Factories;

use App\Models\MenuItem;
use Illuminate\Database\Eloquent\Factories\Factory;

class MenuItemFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = MenuItem::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "menu_itemable_id" => null,
            "menu_itemable_type" => null,
            "menu_item_id" => null,
            "title" => $this->faker->title,
            "description" => $this->faker->paragraphs(rand(1, 10), true),
            "order" => 0,
        ];
    }
}
