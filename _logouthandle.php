<?php

session_start();

session_destroy();
header("location: /forum_website");
exit();


?>