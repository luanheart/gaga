<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Tag;
use App\Models\UserTag;
use App\Models\DreamTag;

class UserTagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 获取 Faker 实例
        $faker = app(Faker\Generator::class);

        $tag_ids = Tag::all()->pluck('id')->toArray();
        $user_ids = User::all()->pluck('id')->toArray();
        $now = \Carbon\Carbon::now()->toDateTimeString();

        //我是 tag
        $insert = [];
        foreach ($user_ids as $user_id) {
            $tags = $faker->randomElements($tag_ids, 5);
            foreach ($tags as $tag_id) {
                $insert[] = [
                    'user_id' => $user_id,
                    'tag_id' => $tag_id,
                    'created_at' => $now,
                    'updated_at' => $now
                ];
            }
        }
        UserTag::insert($insert);

        //我想找 tag
        $insert = [];
        foreach ($user_ids as $user_id) {
            $tags = $faker->randomElements($tag_ids, 5);
            foreach ($tags as $tag_id) {
                $insert[] = [
                    'user_id' => $user_id,
                    'tag_id' => $tag_id,
                    'created_at' => $now,
                    'updated_at' => $now
                ];
            }
        }
        DreamTag::insert($insert);
    }
}
