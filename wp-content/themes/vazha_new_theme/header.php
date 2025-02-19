<!DOCTYPE html>
<html class="mt-0" lang="zxx">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="seo & digital marketing">
    <meta name="keywords"
        content="marketing,digital marketing,creative, agency, startup,promodise,onepage, clean, modern,seo,business, company">
    <meta name="author" content="dreambuzz">
    <?php wp_head(); ?>



</head>

<body data-spy="scroll" data-target=".fixed-top">

    <nav class="navbar navbar-expand-lg fixed-top trans-navigation">
        <div class="container">

            <?php if ($logo = get_custom_logo()) {
                echo $logo;
            } ?>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mainNav"
                aria-controls="mainNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon">
                    <i class="fa fa-bars"></i>
                </span>
            </button>

            <div class="collapse navbar-collapse justify-content-end" id="mainNav">
                <?php wp_nav_menu([
                    'theme_location' => 'header',
                    'menu' => false,
                    'container' => 'div',
                    'menu_class' => 'navbar-nav',
                    'menu_id' => false,
                    'echo' => true,
                    'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                    'depth' => 2,
                    'walker' => new wp_bootstrap4_navwalker(),
                ]); ?>
            </div>
        </div>
    </nav>
    <!--MAIN HEADER AREA END -->