<?php
 namespace Haidara\Models;
 use Illuminate\Database\Eloquent\Model;

 class User extends Model
 {
    protected $table='mdl_users';
     protected $fillable =[
         'username',
         'password',
         'email'
     ];

     /**
      * @param null $username
      * @param null $password
      * @return bool|null
      */
    public static  function find($username = null, $password=null)
    {
        $user  = null;
        if($username)
        {
            $user =  self::query()->where(function($query) use ($username) {
            $query->where('nom', '=', $username)
                ->orWhere('email', '=',$username);
        })->get()->first();

            var_dump($user);die;
          // $user =  self::query()->where('username', "=",[$username])->first();
            if($user){
                if(password_verify($password,$user->password,PASSWORD_BCRYPT))
                {
                    return true;
                }else{
                    return null;
                }
            }
        }else
        {
            return null;
        }
        return false;
    }

     public static function findModo(){
       return  self::query()
             ->join('mdl_role', function($join){
                 $join->on('mdl_users.role', '=', 'mdl_role.id');
             })
             ->get();

     }

     /**
      * @return mixed
      */
     public static function findAllMember(){
         return  self::query()
             ->join('mdl_role', function($join){
                 $join->on('mdl_users.role', '=', 'mdl_role.id');
             })
             ->get();
     }

     /**
      * @return bool
      */
     public static function isLogged()
     {
         return (!empty($_SESSION['user']) && isset($_SESSION['user'])) ? true : false;
     }

     public static function bannedUser($userID){
         self::update(['id' => $userID, 'activated' => '0']);
     }

     public static function activatedUser($userID){
         self::update(['id' => $userID, 'activated' => '1']);
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
