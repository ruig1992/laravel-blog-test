<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class ArticleExtraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dtNow = Carbon::now()->format('Y-m-d H:i:s');

        $title1 = 'Common species mirror rare animals response to global change';
        $title2 = 'Молодіжна збірна України U-21 вирушила до Фінляндії на матч кваліфікації Євро-2021';
        $title3 = 'PHP 8.0.0 Beta 3 available for testing';

        DB::table('articles')->insert([
            [
                'category_id' => 3, // Nature
                'title' => $title1,
                'slug' => Str::slug($title1),
                'description' => 'The populations of common animals are just as likely to rise or fall in number in a time of accelerating global change as those of rare species, a study suggests.',
                'content' => '<p>A study of more than 2,000 species reveals animal populations around the world -- from the very common to endangered species -- are going up and down as global change alters land, sea and freshwater ecosystems.</p><p>The findings highlight a need to look beyond only rare species in order to improve efforts to conserve global biodiversity, scientists say.</p><p>Critically endangered animals -- such as the Hawksbill sea turtle -- were previously thought to be at greater risk of decline than common species like red deer, but the study found a wide spectrum of changes in animal numbers.</p>',
                'is_published' => 1,
                'published_at' => Carbon::now()->subHours(2)->format('Y-m-d H:i:s'),
                'created_at' => $dtNow,
                'updated_at' => $dtNow,
            ],
        ]);
        DB::table('articles')->insert([
            [
                'category_id' => 2, // Football
                'title' => $title2,
                'slug' => Str::slug($title2),
                'description' => 'У вівторок, 8 вересня, у Гельсінкі підопічні Руслана Ротаня зіграють черговий матч відбірного турніру чемпіонату Європи.',
                'content' => '<p>Сьогодні, 5 вересня о 10.00 чартерним рейсом молодіжна збірна України вирушила з Данії до Фінляндії. У Гельсінкі проти місцевої збірної синьо-жовті проведуть наступний матч відбору до Євро-2021 (U-21).</p><p>По обіді в підопічних Руслана Ротаня заплановано тренування відновлювального характеру. Нагадаємо, що матч проти збірної Фінляндії відбудеться 8 вересня на Олімпійському стадіоні (початок — о 19.00 за Києвом).</p>',
                'is_published' => 1,
                'published_at' => Carbon::now()->subHours(1)->format('Y-m-d H:i:s'),
                'created_at' => $dtNow,
                'updated_at' => $dtNow,
            ],
        ]);
        DB::table('articles')->insert([
            [
                'category_id' => 1, // Programming
                'title' => $title3,
                'slug' => Str::slug($title3),
                'description' => 'The PHP team is pleased to announce the sixth testing release of PHP 8.0.0, Beta 3. This continues the PHP 8.0 release cycle, the rough outline of which is specified in the PHP Wiki.',
                'content' => '<p>For source downloads of PHP 8.0.0 Beta 3 please visit the download page.</p><p>Please carefully test this version and report any issues found in the bug reporting system.</p><p>Please DO NOT use this version in production, it is an early test version.</p><p>For more information on the new features and other changes, you can read the NEWS file, or the UPGRADING file for a complete list of upgrading notes. These files can also be found in the release archive.</p><p>The next release will be the Release Candidate 1, planned for Sep 17 2020.</p><p>The signatures for the release can be found in the manifest or on the QA site.</p><p>Thank you for helping us make PHP better.</p>',
                'is_published' => 1,
                'published_at' => $dtNow,
                'created_at' => $dtNow,
                'updated_at' => $dtNow,
            ],
        ]);
    }
}
