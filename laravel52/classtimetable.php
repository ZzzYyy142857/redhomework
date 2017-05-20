<?php

$info = $_POST['stunum'];
$add = 'Location: public/' . $info;
header($add);