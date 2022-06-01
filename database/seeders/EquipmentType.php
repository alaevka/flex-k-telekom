<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EquipmentType extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $types = [
            [
                'name' => 'TP-Link TL-WR74',
                'mask' => 'XXAAAAAXAA',
            ],
            [
                'name' => 'D-Link DIR-300',
                'mask' => 'NXXAAXZXaa',
            ],
            [
                'name' => 'D-Link DIR-300 S',
                'mask' => 'NXXAAXZXXX',
            ],
        ];
        foreach ($types as $type) {
            DB::table('equipment_type')->insert([
                'name' => $type['name'],
                'mask' => $type['mask'],
            ]);
        }
    }
}
