<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    const STATUS_ACTIVE = 1;
    const STATUS_NO_ACTIVE = 0;
    protected $table = 'sliders';

    /**
     * @return Slider[]|\Illuminate\Database\Eloquent\Collection
     */
    public static function getSliderItems($type = 1)
    {
        $slider = Slider::orderBy('position','desc')->where('type',$type)->get();
        $images = [];
        foreach ($slider as $item) {
            $images[$item->id] = $item->image;
        }
        return [
            'slider' => $slider,
            'images' => $images,
        ];
    }

}
