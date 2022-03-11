<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package gingco
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title>Technical Task</title>
    <meta name="description" content="A WordPress Rest API Task." />
    <meta name="author" content="Gingco Communication GmbH & Co. KG" />

    <meta property="og:title" content="Gingco Communication GmbH & Co. KG" />

    <meta
      property="og:description"
      content="Gingco Communication GmbH & Co. KG"
    />

    <link rel="icon" href="#" />

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">

	<div class="page-header">
        <div class="container">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="page-caption">
                        <h1 class="page-title">Gingco Communication GmbH & Co Technical Task</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
