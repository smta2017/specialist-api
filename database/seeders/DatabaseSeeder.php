<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(1000)->create();
        \App\Models\SpecialTypes::factory(1000)->create();
        \App\Models\Plan::factory(1000)->create();
        \App\Models\SpecialistArea::factory(1000)->create();
        \App\Models\SpecialistType::factory(1000)->create();
        \App\Models\Subscription::factory(1000)->create();
        \App\Models\CustomerAddress::factory(1000)->create();
        \App\Models\Order::factory(1000)->create();
        \App\Models\OrderComment::factory(1000)->create();

    }
}
