<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Keys
 * @package App
 */
class Keys extends Model
{
    /**
     * @var string
     */
    protected $table = 'keys';


    public function type()
    {
        return KeysType::where('id',$this->type)->first();
    }
}
