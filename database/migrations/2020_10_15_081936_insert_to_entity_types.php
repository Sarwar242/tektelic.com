<?php

use App\Models\EntityType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class InsertToEntityTypes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       $entity_type = new EntityType;

       $entity_type->title='benefits';
       $entity_type->status=1;
        $entity_type->save();

        $entity_type = new EntityType;
        $entity_type->title='quality lives';
        $entity_type->status=1;
        $entity_type->save();

        $entity_type = new EntityType;
        $entity_type->title='technologies';
        $entity_type->status=1;
        $entity_type->save();

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

    }
}
