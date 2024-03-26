<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Session;


class SessionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $data["2024-2025"] = 2024;
        $data["2025-2026"] = 2025;
        $data["2026-2027"] = 2026;
        $data["2027-2028"] = 2027;
        $data["2028-2029"] = 2028;
        $data["2029-2030"] = 2029;
        $data["2030-2031"] = 2030;
        $data["2031-2032"] = 2031;
        $data["2032-2033"] = 2032;
        $data["2033-2034"] = 2033;
        $data["2034-2035"] = 2034;
         
         //dd($data);
         
         foreach ($data as $key => $value) {
             
            Session::create( ['session' => $key, 'session_year' => $value] );
         }
    }
}

