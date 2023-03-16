<?php
/*
  Template Name: top
 */

global $pageTitle;
global $lang;

// ページのタイトル
$pageTitle = "";

$uniqueLoad = array(
  array("type" => "css", "src" => get_template_directory_uri() . "/top/css/index.css"),
  array("type" => "js", "src" => get_template_directory_uri() . "/top/js/index.js"),
);

// コンテンツファイル
$CONTENT = __DIR__ . "/content.html";

// フレーム取得
include_once(get_template_directory() . "/parts/frame.php");
