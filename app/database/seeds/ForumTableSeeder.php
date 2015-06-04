<?php

class ForumTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('forum_groups')->delete();
        DB::table('forum_categories')->delete();

        $groups = array(
            array('id' => 1, 'user_id' => 1, 'title' => 'Latvia'),
            array('id' => 2, 'user_id' => 1, 'title' => 'Croatia')
        );

        $categories = array(
            array('id' => 1, 'user_id' => 1, 'group_id' => 1, 'title' => 'Hotels'),
            array('id' => 2, 'user_id' => 1, 'group_id' => 1, 'title' => 'Restaurants'),
            array('id' => 3, 'user_id' => 1, 'group_id' => 2, 'title' => 'Hotels'),
            array('id' => 4, 'user_id' => 1, 'group_id' => 2, 'title' => 'Restaurants'),
        );

        DB::table('forum_groups')->insert($groups);
        DB::table('forum_categories')->insert($categories);
    }
}