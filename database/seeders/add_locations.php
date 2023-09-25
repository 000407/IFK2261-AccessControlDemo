<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class add_locations extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      $status = 'ACTIVE';

      DB::table('locations')->insert([
        [
          'name' => 'NORTH',
          'status' => $status,
          'created_at' =>  date('Y-m-d H:i:s'),
          'updated_at' => date('Y-m-d H:i:s')
        ],
        [
          'name' => 'SOUTH',
          'status' => $status,
          'created_at' =>  date('Y-m-d H:i:s'),
          'updated_at' => date('Y-m-d H:i:s')
        ],
        [
          'name' => 'EAST',
          'status' => $status,
          'created_at' =>  date('Y-m-d H:i:s'),
          'updated_at' => date('Y-m-d H:i:s')
        ],
        [
          'name' => 'WEST',
          'status' => $status,
          'created_at' =>  date('Y-m-d H:i:s'),
          'updated_at' => date('Y-m-d H:i:s')
        ],
        [
          'name' => 'CENTRAL',
          'status' => $status,
          'created_at' =>  date('Y-m-d H:i:s'),
          'updated_at' => date('Y-m-d H:i:s')
        ]
      ]);
    }
}
