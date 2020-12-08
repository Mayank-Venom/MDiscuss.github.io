<?php
 session_start();
 echo'logging u out please wait....';
// session_unset();
 session_destroy();

 header("location:/forum");


?>