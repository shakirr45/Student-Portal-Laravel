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
        //for class one/two ====>
        $data["আমার বাংলা বই"] =  11;
        $data["English For Today"] =  12;
        $data["প্রাথমিক গণিত"] =  13;
        $data["প্রাথমিক বিজ্ঞান"] =  14;
        $data["বাংলাদেশ ও বিশ্বপরিচয়"] =  15;
        $data["ইসলাম ও নৈতিক শিক্ষা"] =  16;


        // ================  ck
        $data["স্বাস্থ সুরক্ষা "] =  17;
        $data["গণিত "] =  18;
        $data["বিজ্ঞান "] =  19;
        $data["ডিজিটাল প্রযুক্তি "] =  20;
        $data["বাংলা "] =  21;
        $data["ইংরেজি"] =  22;
        $data["ইতিহাস ও সামাজিক বিজ্ঞান"] =  23;
        $data["জীবন ও জীবিকা  "] =  24;
        $data["শিল্প ও সংস্কৃতি"] =  25;
        $data["ধর্ম শিক্ষা "] =  26;

        // ================ 

        
        // $data["Bangla 1st Paper"] =  101;
        // $data["Bangla 2nd Paper"] =  102;
        // $data["English 1st Paper"] =  107;
        // $data["English 2nd Paper"] =  108;
        // $data["Mathematics"] =  109;
        // $data["Physics"] =  136;
        // $data["Chemistry"] =  137;
        // $data["Biology"] =  138;
        // $data["Higher Math"] =  126;
        // $data["Information & Technology"] =  154;
        // $data["Islam & Moral Education"] =  111;
        // $data["Bangladesh & World"] =  150;
        // $data["Agriculture Studies"] =  134;
        // $data["Home Science"] =  151;
        // $data["Off Time"] =  00;
        
        foreach ($data as $key => $value) {
            
            Subject::create( ['name' => $key, 'sub_code' => $value] );

        }
    }
}
