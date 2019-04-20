<?php
/**
 * Created by PhpStorm.
 * User: haida
 * Date: 13/03/2018
 * Time: 20:51
 */

namespace Haidara\Models;


use Illuminate\Database\Eloquent\Model;

class CategoryPost extends  Model
{
    /************************ Properties *********************************/
    protected $designation;
    protected  $table='mdl_categorypost';

    /******************RELATIONSHIP***************************/

    public function products()
    {
        return $this->belongsToMany(Post::class);
    }

    /************************** Operations on models **************************************/

    public static function find($ref)
    {
        return self::query()->where('id',"=",$ref)->first();
    }
    public static function getAllCategories(){
        return self::all();
    }
    public function __toString(){
        return printf("%s", $this->designation )  . "";
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