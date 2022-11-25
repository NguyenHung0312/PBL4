<?php
class easysecure {
   
   var $curr_user;
   var $curr_permission;
   var $curr_task;
   var $validpermission;
   var $error;
  
  
   function &setVar( $name, $value=null ) {
       if (!is_null( $value )) {
           $this->$name = $value;
       }
       return $this->$name;
   }

   function maketoken($formname, $id){
      
       $token = md5(uniqid(rand(), true));
      
       $_SESSION[$formname.$id] = $token;
      
       return $token;
   }
  
   function checktoken($token, $formname, $id){
       //print_r($_SESSION);
       //echo ($token);
       //if we dont have a valid token, return invalid;
       if(!$token){
           $this->setVar('validpermission', 0);
           $this->setVar('error', 'no token found, security bridgedetected');
           return false;
       }
      
       //if we have a valid token check that is is valid
       $key = $_SESSION[$formname.$id];
       if($key !== $token ){
           $this->setVar('validpermission', 0);
           $this->setVar('error', 'invalid token');
           return false;
       }
      
       if($this->validpermission !==1){
             echo 'invalid Permissions to run this script';
             return false;   
       }else{
           return true;
       }
   }
  
}
?>

<!-- //<?php $userid = 1 ?> -->
<form name="newform" action="index.php" method="post">
<input type="text" name="potentialeveilfield" value="" size 30 />
<input type="hidden" name="token" value="<?php echo maketoken('newform', 123); //$userid here could be user profile id ?>" />
<input type="submit" />
</form>

Now when processing the form... check the value of your token

<?php

//well you know the form name
if(!checktoken($_POST['token'], 'newform', $userid))
{ //failed
exit(); //or what ever termination and notification method best suits you.
//you could also design the class your way to get more accurate fail (error messages from the var)
}

//you can now continue with input data clean up (validation)

?>