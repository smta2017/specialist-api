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
        \App\Models\User::factory(config("app.seeder_count"))->create();
        \App\Models\SpecialTypes::factory(config("app.seeder_count"))->create();
        \App\Models\Plan::factory(config("app.seeder_count"))->create();
        \App\Models\SpecialistArea::factory(config("app.seeder_count"))->create();
        \App\Models\SpecialistType::factory(config("app.seeder_count"))->create();
        \App\Models\Subscription::factory(config("app.seeder_count"))->create();
        \App\Models\CustomerAddress::factory(config("app.seeder_count"))->create();
        \App\Models\Order::factory(config("app.seeder_count"))->create();
        \App\Models\OrderComment::factory(config("app.seeder_count"))->create();
    }
}
