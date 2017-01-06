<?php
namespace Pages;

class Newsutil{
    
    public static function get_news_data($type){
        
        $title = 'title_'.\Config::get('language');
        $description = 'description_'.\Config::get('language');
        $newses = \Pages\Model_News::query()
            ->related('promo')
            ->where('promo_id',$type)
            ->get();

        $data = array();
        foreach ($newses as $news){
            $data[] = array(
                'title'     => $news->$title,
                'description' => $news->$description,
                'image'     => $news->image,
                'date'      => $news->date,
            );
        }
        return $data;
    }

}