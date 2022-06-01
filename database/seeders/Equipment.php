<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Illuminate\Support\Collection;
use Faker\Generator as Generator;

class Equipment extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $equipment = [];
        $faker = Faker::create('ru_RU');
        $types = DB::table('equipment_type')
            ->select('id', 'mask')
            ->get()
        ;
        for ($i = 0; $i <= 100; $i++) {
            $randType = $types->get(rand(0, 2));
            $equipment[] = [
                'equipment_type_code' => $randType->id,
                'serial_number' => $this->generateSerial($randType->mask, $faker),
                'comment' => $faker->realText(rand(100, 200), 2),
            ];
        }
        foreach ($equipment as $item) {
            DB::table('equipment')->insert([
                'equipment_type_code' => $item['equipment_type_code'],
                'serial_number' => $item['serial_number'],
                'comment' => $item['comment'],
            ]);
        }
    }

    /**
     * Generate equipment serial.
     *
     * @param string $mask
     * @param Generator $faker
     * @return string
     */
    protected function generateSerial(string $mask, Generator $faker): string
    {
        $serial = '';
        foreach (str_split($mask) as $char) {
            $serial .= $this->generateChar($char, $faker);
        }
        return $serial;
    }

    /**
     * Generate random symbol depends on mask.
     *
     * @param string $mask
     * @return string
     */
    protected function generateChar(string $mask, Generator $faker): string
    {
        $res = '';
        switch($mask) {
            case 'N': $res = $faker->regexify('[0-9]');
                break;
            case 'X': $res = $faker->regexify('[A-Z0-9]');
                break;
            case 'A': $res = $faker->regexify('[A-Z]');
                break;
            case 'a': $res = $faker->regexify('[a-z]');
                break;
            case 'Z': $res = $faker->regexify('(-|_|@)');
                break;
        }
        return $res;
    }
}
