<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    private function randdate()
    {
        return \Carbon\Carbon::createFromDate(null, rand(1, 12), rand(1, 28));
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i<40; $i++){
            $date = $this->randdate();
            DB::table('tags')->insert([
                'tag' => 'tags'.$i,
                'tag_url' => 'tag'.$i,
                'created_at' => $date,
                'updated_at' => $date,
            ]);
        }
        // $this->call(UsersTableSeeder::class);
//        factory(App\User::class, 40)->create();
//        factory(App\Article::class, 100)->create();
//        factory(App\Commentaire::class, 100)->create();
//        factory(App\Reponse::class, 100)->create();
//        factory(App\Tag::class, 40);

//        for ($i = 1; $i < 41; $i++) {
//            $number = rand(2, 8);
//            for ($j = 1; $j <= $number; $j++) {
//                DB::table('tag_article')->insert([
//                    'article_id' => rand(1, 100),
//                    'tag_id' => $i
//                ]);
//            }
//        }
    }
}
