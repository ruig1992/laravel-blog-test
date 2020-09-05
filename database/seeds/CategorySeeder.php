<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dtNow = Carbon::now()->format('Y-m-d H:i:s');

        DB::table('categories')->insert([
            [
                'name' => 'Programming',
                'slug' => 'programming',
                'created_at' => $dtNow,
                'updated_at' => $dtNow,
            ],
            [
                'name' => 'Football',
                'slug' => 'football',
                'created_at' => $dtNow,
                'updated_at' => $dtNow,
            ],
            [
                'name' => 'Nature',
                'slug' => 'nature',
                'created_at' => $dtNow,
                'updated_at' => $dtNow,
            ],
        ]);
    }
}
