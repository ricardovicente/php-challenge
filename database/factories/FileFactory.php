<?php

namespace Database\Factories;

use App\Models\File;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class FileFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = File::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $arrayTypes = ['people', 'shiporders'];
        $arrayStatuses = ['uploading', 'waiting', 'progress', 'processed'];

        return [
            'user_id' => 1,
            'original_name' => $this->faker->md5().'.xml',
            'stored_path' => Str::random(4).'.xml',
            //'stored_path' => $this->faker->file('storage/app/xml/2020/12/10/'.Str::random(10).'.xml'),
            'size' => $this->faker->numberBetween().' kb',
            'records' => $this->faker->randomNumber(),
            'type' => Arr::random($arrayTypes),
            'status' => Arr::random($arrayStatuses),
        ];
    }
}
