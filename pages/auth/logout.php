<?php
session_destroy();
header("HTTP/1.1 301 Moved permanently");
header("location:../../index.php?page=login");
exit();
