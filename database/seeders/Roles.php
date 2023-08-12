<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Roles extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
    	$status = 'ACTIVE';

        DB::table('roles')->insert([
            [
            	'name' => 'root',
            	'status' => $status,
            	'created_at' =>  date('Y-m-d H:i:s'),
            	'updated_at' => date('Y-m-d H:i:s')
            ],
            [
            	'name' => 'admin',
            	'status' => $status,
            	'created_at' =>  date('Y-m-d H:i:s'),
            	'updated_at' => date('Y-m-d H:i:s')
            ],
            [
            	'name' => 'premium user',
            	'status' => $status,
            	'created_at' =>  date('Y-m-d H:i:s'),
            	'updated_at' => date('Y-m-d H:i:s')
            ],
            [
            	'name' => 'regular user',
            	'status' => $status,
            	'created_at' =>  date('Y-m-d H:i:s'),
            	'updated_at' => date('Y-m-d H:i:s')
            ]
        ]);
    }
}
