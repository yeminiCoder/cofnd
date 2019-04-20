<?php
/**
 * Created by PhpStorm.
 * User: haida
 * Date: 19/03/2018
 * Time: 22:13
 */

namespace Haidara\Models;


use Illuminate\Database\Eloquent\Model;

class Comment extends Model{

    protected $table = "comments";

    protected $fillable = [
          'content',
          'user_id',
          'post_id'
    ];




    public static function show($var = [])
    {
        return self::belongsTo('Models\Post');
    }




    public static function User()
    {
        return self::hasMany('Models\User');
    }


}