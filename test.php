<?php

$var = "Hamdoulilah.jpeg";

$uploadExtensions = substr($var, -4, 2);

$extension = strrchr($var, ".");


$test = strrchr($var, ".");

echo $extension;