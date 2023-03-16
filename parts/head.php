<?php
global $pageTitle;
global $keyword;
global $description;
global $thisPage;
global $company_name;
?>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta charset="utf-8">
<title><?php echo $pageTitle; ?></title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="keywords" content="<?php echo $keyword; ?>">
<meta name="description" content="<?php echo $description; ?>">
<meta name="author" content="" />
<meta name="format-detection" content="telephone=no">

<link rel="icon" href="<?php echo get_template_directory_uri(); ?>/images/common/favicon.ico">

<?php
$ogp_type = "article";
if ( is_home() || is_front_page() ) :
    $ogp_type = "website";
endif;
?>
<meta property="og:type" content="<?php echo $ogp_type; ?>" />
<meta property="og:title" content="<?php echo $pageTitle; ?>" />
<meta property="og:url" content="<?php echo (empty($_SERVER['HTTPS']) ? 'http://' : 'https://') . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>" />
<meta property="og:site_name" content="<?php echo $company_name; ?>" />
<meta property="og:image" content="<?php echo get_template_directory_uri(); ?>/images/common/OGP.jpg" />
<meta property="og:description" content="<?php echo $description; ?>" />

<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/shared/css/bootstrap.min.css" type="text/css">
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/shared/css/common.css" type="text/css">
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/shared/css/header.css" type="text/css">
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/shared/css/footer.css" type="text/css">

<script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="<?php echo get_template_directory_uri(); ?>/shared/js/bootstrap.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/shared/js/common.js"></script>
