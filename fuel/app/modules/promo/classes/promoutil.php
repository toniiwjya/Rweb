<?php
namespace Promo;

class Promoutil{
    
    public static function get_promo_data($type){
        
        $name = 'name_'.\Config::get('language');
        $description = 'description_'.\Config::get('language');
        $promos = \Promo\Model_Promo::query()
            ->related('brand')
            ->where('brand_id', $type)
            ->get();

        $data = array();
        foreach ($promos as $promo){
            $data[] = array(
                'name'     => $promo->$name,
                'description' => $promo->$description,
                'image'     => $promo->image,
                'slot'   => $promo->$slot,
                'end_date'      => $promo->end_date,
            );
        }
        return $data;
    }
}