<?php
namespace Haidara\Models;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected  $table='mdl_cours_categories';
    public static function find($ref)
    {
        return self::query()->where('id', $ref)->first();
    }
    public static function getAllCategories(){
        return self::all();
    }


    /**
     * Get the relationships for the entity.
     *
     * @return array
     */
    public function getQueueableRelations()
    {
        // TODO: Implement getQueueableRelations() method.
    }

    /**
     * Get the connection of the entity.
     *
     * @return string|null
     */
    public function getQueueableConnection()
    {
        // TODO: Implement getQueueableConnection() method.
    }

    /**
     * Retrieve the model for a bound value.
     *
     * @param  mixed $value
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function resolveRouteBinding($value)
    {
        // TODO: Implement resolveRouteBinding() method.
    }
}