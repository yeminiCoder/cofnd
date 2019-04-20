<?php
namespace Haidara\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    private $title;


    protected $fillable = [
        'Title',
        'Description',
        'type',
        'slogan',
        'category',
        'status',
        'publisher'
    ];


    protected $table = 'mdl_posts';


    /**
     * @return mixed
     */
    public function getTitlePost()
    {
        return $this->title;
    }

    /**
     * @param mixed $title_post
     */
    public function setTitlePost($title_post)
    {
        $this->title = $title_post;
    }

    /*************** RELATIONSHIP ********************/

    public function categories()
    {
        return $this->belongsToMany(CategoryPost::class);
    }


    /******************Operations on models****************************/
    //Last post

    public static function getLasts()
    {
        return self::all()->sortBy('date_created_at')->take(4);
    }

    public static function findOne($id)
    {
        return self::find($id);
    }


    public static function random()
    {
        return self::all()->take(3)->random(1);
    }

    public static function find($ref)
    {
        return self::query()->where('id', "=", $ref)->first();
    }

    public function comments()
    {
        return self::hasMany('Models\Comment');
    }

    public static function allTuto(){
        return  Post::query()
            ->join('mdl_users', function($join){
                $join->on('mdl_posts.publisher', '=', 'mdl_users.id');
            })
            ->join('mdl_categorypost', function($join){
                $join->on('mdl_posts.category', '=', 'mdl_categorypost.id');
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