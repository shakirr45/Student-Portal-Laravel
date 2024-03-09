<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ClassSection;



class ClassSectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        $sections = [
            'A',
            'B',
            'C',
            'D',
            'E',
            'F',
         ];
      
         foreach ($sections as $section) {
            ClassSection::create(['name' => $section]);
         }
    }
}
