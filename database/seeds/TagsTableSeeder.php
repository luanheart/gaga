<?php

use Illuminate\Database\Seeder;
use App\Models\Tag;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = \Carbon\Carbon::now()->toDateTimeString();
        $tag_names = ['阳光', '孝顺', '壮实', '有房', '长发', '苗条', '要孩子'];

        $tags = [];
        foreach ($tag_names as $item) {
            $tags[] = [
                'name' => $item,
                'created_at' => $now,
                'updated_at' => $now
            ];
        }
        Tag::insert($tags);
    }
}
