<?php
namespace Haidara\Models;
use Illuminate\Database\Eloquent\Model;

class Cours extends Model
{
    protected $fillable =[
        'Course_name',
        'content',
        'created_at',
        'cost',
        'slug' ,
        'categoryID',
        'idPrim',
        'visibled',
        'publisher'
    ];
    protected  $table = 'mdl_courses';


    public static function find($ref)
    {
        return self::query()->where('id',"=",$ref)->first();
    }

    public static function allFormation(){
        return  Cours::query()
            ->join('mdl_users', function($join){
                $join->on('mdl_courses.publisher', '=', 'mdl_users.id');
            })
            ->join('mdl_cours_categories', function($join){
                $join->on('mdl_courses.CategoryID', '=', 'mdl_cours_categories.id');
            })
            ->get();

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