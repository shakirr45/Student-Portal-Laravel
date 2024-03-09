<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\InstitutionClass;

class InstitutionClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
         $data["one"] =  1;
         $data["tow"] =  2;
         $data["three"] =  3;
         $data["four"] =  4;
         $data["five"] =  5;
         $data["six"] =  6;
         $data["seven"] =  7;
         $data["eight"] =  8;
         $data["nine"] =  9;
         $data["ten"] =  10;
         
         //dd($data);
         
         foreach ($data as $key => $value) {
             
            InstitutionClass::create( ['name' => $key, 'code' => $value] );
 
         }



    }
}
