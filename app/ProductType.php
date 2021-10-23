<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ProductType
 * @package App
 */
class ProductType extends Model
{
    /**
     * @var string
     */
    protected $table = 'product_type';

    /**
     * @return array
     */
    public function getTypes()
    {
        return self::all()->keyBy('id')->pluck('name', 'id')->toArray();
    }
}
