<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Subject;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $data["Bangla 1st Paper"] =  101;
        $data["Bangla 2nd Paper"] =  102;
        $data["English 1st Paper"] =  107;
        $data["English 2nd Paper"] =  108;
        $data["Mathematics"] =  109;
        $data["Physics"] =  136;
        $data["Chemistry"] =  137;
        $data["Biology"] =  138;
        $data["Higher Math"] =  126;
        $data["Information & Technology"] =  154;
        $data["Islam & Moral Education"] =  111;
        $data["Bangladesh & World"] =  150;
        $data["Agriculture Studies"] =  134;
        $data["Home Science"] =  151;
        $data["Off Time"] =  00;
        
        foreach ($data as $key => $value) {
            
            Subject::create( ['name' => $key, 'sub_code' => $value] );

        }
    }
}
