<?php

class AUTHORIZATION
{
    public static function validateTimestamp($token)
    {
        $CI =& get_instance();
        $token = self::validateToken($token);
        if ($token != false && (now() - $token->timestamp < ($CI->config->item('token_timeout') * 60))) {
            return $token;
        }
        return false;
    }

    public static function validateToken($token)
    {
        $CI =& get_instance();
        return JWT::decode($token, $CI->config->item('jwt_key'));
    }

    public static function generateToken($data)
    {
        $CI =& get_instance();
        return JWT::encode($data, $CI->config->item('jwt_key'));
    }

    public static function data($data){
         $data = trim(htmlentities(strip_tags($data)));
         return (stripslashes($data));
    }
    
    public static function salt()
    {
        return substr(md5(uniqid(rand(), true)), 0, 6);
    }
    
    public static function keygen($length=10)
    {
        $key = '';
        list($usec, $sec) = explode(' ', microtime());
        mt_srand((float) $sec + ((float) $usec * 100000));
        
        $inputs = array_merge(range('z','a'),range(0,9),range('A','Z'));
    
        for($i=0; $i<$length; $i++)
        {
            $key .= $inputs[mt_rand(0,61)];
        }
        return $key;
    }

    public static function hash_password_db($identity, $password)
    {
        $CI =& get_instance();
        if (empty($identity) || empty($password))
        {
            return FALSE;
        }
        
        $CI->db->where('email',AUTHORIZATION::data(trim($identity)));
        $CI->db->where('active','1');
        $res = $CI->db->get('users')->row();
      
        if (!empty($res)) 
        {
            $salt = $res->salt; 
            $pass = sha1($password . $salt);
              
            $CI->db->select("profiles.display_name,users.id,users.travel_id,users.email,users.group_id,users.parent_id,users.fcm");
            $CI->db->join('profiles','profiles.user_id = users.id');
            $CI->db->where('active','1'); 
            $CI->db->where('password',$pass);  
            $CI->db->where('email',AUTHORIZATION::data(trim($identity))); 
            return  $CI->db->get('users')->row();
        }
        else
        {
           return FALSE;
        }
    }

}