<?php

namespace Serverfireteam\Panel\Database\Seeders;

use Illuminate\Database\Seeder;

class PanelSeeder extends Seeder
{

    public function run()
    {
        $this->command->info('Seeding...');
        $this->call(LinkSeeder::class);
        $this->call(AdminSeeder::class);
    }
}
