<?php
namespace Haidara\Auth;
use Haidara\Models\User;
use Haidara\Models\Session;
use Haidara\Models\StringRandom;
use Haidara\Models\Google2FA;
/**
 * Created by PhpStorm.
 * User: haida
 * Date: 08/07/2018
 * Time: 15:24
 */

class Auth {
  /**
   * Undocumented function
   *
   * @return void
   */
    public function user()
    {
        return User::findbyId(Session::read('user'));
      //return User::findbyId(isset($_SESSION['user'])?$_SESSION['user']:null);
    }

    /**
     * Undocumented function
     *
     * @param boolean $ok
     * @return boolean
     */
   
     public static function isConnected($ok = true) : bool{
            
        return $ok;
    }

    

    /**
     * Undocumented function
     *
     * @return void
     */
    public static  function check()
    {
        return Session::isDefine('user');
    }

    /**
     * Send mail to user using mail function
     *
     * @param [type] $to
     * @param [type] $subject
     * @param [type] $message
     * @return void
     */
     static function sendMail($to, $subject, $message)
    {
       
        $headers = 'From: webmaster@example.com' . "\r\n" .
            'Reply-To: webmaster@example.com' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();
        mail($to, $subject, $message, $headers);

    }

    /**
     * Undocumented function
     *
     * @param [type] $email
     * @param [type] $password
     * 
     */
    public function atempt($email, $password)
    {
       return  User::find($email,$password);
    }

    /**
     * Undocumented function
     *
     * @param [type] $length
     * @return string
     */
     static function generateToken($length):string {
         return StringRandom::random($length);
    }

    /**
     * Undocumented function
     *
     * @param [type] $token
     * 
     */
    static function  checkTokenIsValide($token){
       $user =  User::findUserByToken($token);
       if($user)
       {
           return $user->setStatutNew();     
       }else{
           return false;
       }
    }

/**
 * Undocumented function
 *
 * @return string
 */
    static function optImplement():string{
        $InitalizationKey = "PEHMPSDNLXIOG65U"; //initializer
        //Get current time-stamp, it’s very useful to generate one time tokens according to the current time-stamp.
        $TimeStamp = Google2FA::get_timestamp();
        //decode into binary 
        $secretkey = Google2FA::base32_decode($InitalizationKey);
        // get opt code
        $otp = Google2FA::oath_hotp($secretkey, $TimeStamp); 
        //Verify Current Token , Use this code to verify a key as it allows for some time drift.
        $result = Google2FA::verify_key($InitalizationKey, "123456");
        //Save OTP To Database as Temporary Value / Data
        $user = User::findbyId($id);
        $user->update([
           'otp_code'=>$otp
        ]);

      return $otp;
    }
 
 /**
  * Undocumented function
  *
  * @param [type] $mobile
  * @param [type] $subject
  * @return void
  */
    static function sendSMS($mobile=null, $subject=null, $emailContent = null)
    {
    $SMSapiKey = 'XYZ';
    $url = 'http://example.com/api_2.0/SendSMS.php?APIKEY='.$SMSapiKey.'&MobileNo='.urlencode($mobile).'&SenderID=SAMPLE_MSG&Message='.urlencode($subject).'&ServiceName=TEMPLATE_BASED';
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $returndata = curl_exec($ch);
    curl_close($ch);
    self::sendMail($mobile, $subject, $emailContent);
   }
 
}