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

        $title1 = 'Why we don’t really know how many lions live in Africa';
        $title2 = 'Мессі офіційно залишається у "Барселоні"';
        $title3 = '[bvblogic] - a technology development company from Ivano-Frankivsk';

        DB::table('articles')->insert([
            [
                'category_id' => 3, // Nature
                'title' => $title1,
                'slug' => Str::slug($title1),
                'description' => 'Counting lions is surprisingly complicated, but a new method promises more accuracy and detail, scientists say.',
                'content' => "<p>A lioness rests in the fork of a tree in Uganda’s Queen Elizabeth National Park. With lion numbers rapidly depleting, researchers say it’s crucial to have clear and accurate population estimates to help guide conservation efforts.</p><p>Lions have experienced a shocking decline; that much is clear. They’ve disappeared from well over 90 percent of their historic range in Africa in the last 120 years. And in the past quarter century alone, their population has declined by about half.</p><p>But just how many lions are left in Africa? The answer is surprisingly fuzzy. The most commonly cited estimate is 20,000, but many lion researchers aren’t entirely comfortable with that number.</p>",
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
                'description' => 'Лідер "Барселони" Ліонель Мессі залишитися у каталонському клубі. Зірковий аргентинський футболіст передумав покидати "Барселону".',
                'content' => '<p>"Я був нещасливий і хотів піти. Мені не дозволили це зробити, і я залишаюся в клубі, щоб не вступати в юридичний конлфікт. Керівництво клубу на чолі з Бартомеу – катастрофа", – заявив Лео.</p><p>Marca пише, що 33-річний Мессі не хоче покидати "Барселону" з конфліктом.</p>',
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
                'description' => 'We develop and implement efficient IT solutions in six key domains: Agriculture, Logistics, and Transportation, eCommerce, eTickets, Retail and FMCG, Marketing and Advertising.',
                'content' => '<p>[bvblogic] creates progressive software with the use of disruptive technologies and intellectual approaches of Data Science, Artificial Intelligence, Machine Learning, and Deep Learning.</p><p>Using the innovations, we help our clients to become more innovative and to successfully achieve their goals.</p><p>We began our operations in 2008 from the small group of developers. Currently, we have evolved into one of the regional leaders serving more than 500 clients all over the world. We have already successfully implemented more than 800 projects in various industries and technological areas.</p><p>Our development centers are located in Ukraine: Ivano-Frankivsk, Sumy, and Chernivtsi.</p>',
                'is_published' => 1,
                'published_at' => $dtNow,
                'created_at' => $dtNow,
                'updated_at' => $dtNow,
            ],
        ]);
    }
}
