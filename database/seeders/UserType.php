<?php

namespace Database\Seeders;

use App\Models\UserType as ModelsUserType;
use Illuminate\Database\Seeder;

class UserType extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = [
            [
                'name' => 'customer',
            ],
            [
                'name' => 'specialist',
            ],
            [
                'name' => 'center',
            ],
            [
                'name' => 'libirary',
            ]
        ];

        foreach ($types as $type) {
            ModelsUserType::create($type);
        }
    }
}
