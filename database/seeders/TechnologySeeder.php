<?php

namespace Database\Seeders;

use App\Models\Technology;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $labels = ['Bootstrap', 'Laravel', 'VueJs', 'Vite', 'CSS', 'HTML', 'JavaScript', 'Angular', 'NodeJs'];

        foreach ($labels as $label) {
            $technology = new Technology();

            $technology->label = $label;

            $technology->save();
        }
    }
}
