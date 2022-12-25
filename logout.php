<?php


// Kullanıcı oturumları silinir ve kullanıcı çıkış yapar.
session_start();
session_unset();
session_destroy();

header('location: login');

?>