<?php

$uri = explode("=", $_SERVER['REQUEST_URI']);
$member = $uri[count($uri)-1];

$member_image = $database->select_table(1, "image", "members", "id = '$member'","")->fetch()["image"];
unlink("images/$member_image");
$info = $database->drop_table_data("id = '$member'");
$members_data = $database->select_table(30, "id, name, image, email, title, group_name", "members",null,"id DESC");
$recent_members = $database->select_table(4, "id, name, image, group_name", "members", null, "id DESC");

require_once "templates/home.php";
?>