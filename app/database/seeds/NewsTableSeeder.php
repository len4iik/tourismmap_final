<?php

class NewsTableSeeder extends Seeder {

    public function run()
    {
        DB::table('news')->delete();

        $news = array(
            array('id' => 1, 'user_id' => '1', 'subject' => 'First news', 'text' => 'Here is some text to check, how new website\'s thing works. HSh',
                'news_pic' => '/img/news/first.png', 'created_at' => '2015-05-01 16:23:51', 'updated_at' => '2015-05-01 16:23:51'),
            array('id' => 2, 'user_id' => '1', 'subject' => 'Helen', 'text' => 'The work is done. Almost. And we are about to congratulate our favourite head administrator and wish her luck.',
                'news_pic' => '/img/news/helen.jpg', 'created_at' => '2015-06-01 17:18:50', 'updated_at' => '2015-06-01 17:18:50'),
            array('id' => 3, 'user_id' => '1', 'subject' => 'Grand opening', 'text' => 'We are very proud of the work that has been done in these 3.5 month and we hope the project will be popular in future! HSh',
                'news_pic' => '/img/news/grand.png', 'created_at' => '2015-06-02 14:12:30', 'updated_at' => '2015-06-02 14:12:30')
        );

        DB::table('news')->insert($news);
    }
}
