<?php
session_start();

$target_folder = 'files/' . $_SESSION["userId"] . "/" . $_POST["filedir"];

echo $target_folder;
