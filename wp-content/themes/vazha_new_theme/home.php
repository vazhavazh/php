<?php get_header(); ?>

<!--MAIN BANNER AREA START -->
<div class="page-banner-area page-blog" id="page-banner">
    <div class="overlay dark-overlay"></div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 m-auto text-center col-sm-12 col-md-12">
                <div class="banner-content content-padding">
                    <h1 class="banner-title">Latest news</h1>
                    <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Unde, perferendis?</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!--MAIN HEADER AREA END -->

<!--  Blog AREA START  -->
<section class="section blog-wrap">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="row">
                    <?php
                    $count = 0; // Определяем счётчик
                    if (have_posts()):
                        while (have_posts()):
                            the_post();
                            $count++;
                            switch ($count) {
                                case 3: ?>
                                    <div class="col-lg-12">
                                        <div class="blog-post flex-items-center">
                                            <?php
                                            if (has_post_thumbnail()) {
                                                the_post_thumbnail('post-thumbnail', array(
                                                    'class' => "img-fluid w-75",
                                                ));
                                            } else {
                                                echo '<img class="img-fluid w-100" src="' . esc_url(get_template_directory_uri() . '/assets/img/blog/blog-2.jpg') . '" />';
                                            }
                                            ?>
                                            <div class="mt-4 mb-3 d-flex">
                                                <div class="post-author mr-3">
                                                    <i class="fa fa-user"></i>
                                                    <span class="h6 text-uppercase"><?php the_author(); ?></span>
                                                </div>
                                                <div class="post-info">
                                                    <i class="fa fa-calendar-check"></i>
                                                    <span><?php the_time('j F Y'); ?></span>
                                                </div>
                                            </div>
                                            <a href="<?php echo get_the_permalink(); ?>" class="h4"><?php the_title(); ?></a>
                                            <p class="mt-3"><?php the_excerpt(); ?></p>
                                            <a href="<?php echo get_the_permalink(); ?>" class="read-more">Read More <i
                                                    class="fa fa-angle-right"></i></a>
                                        </div>
                                    </div>
                                    <?php
                                    break;
                                default: ?>
                                    <div class="col-lg-6">
                                        <div class="blog-post">
                                            <?php
                                            if (has_post_thumbnail()) {
                                                the_post_thumbnail('post-thumbnail', array(
                                                    'class' => "img-fluid h-300px",
                                                ));
                                            } else {
                                                echo '<img class="img-fluid w-100" src="' . esc_url(get_template_directory_uri() . '/assets/img/blog/blog-2.jpg') . '" />';
                                            }
                                            ?>
                                            <div class="mt-4 mb-3 d-flex">
                                                <div class="post-author mr-3">
                                                    <i class="fa fa-user"></i>
                                                    <span class="h6 text-uppercase"><?php the_author(); ?></span>
                                                </div>
                                                <div class="post-info">
                                                    <i class="fa fa-calendar-check"></i>
                                                    <span><?php the_time('j F Y'); ?></span>
                                                </div>
                                            </div>
                                            <a href="<?php echo get_the_permalink(); ?>" class="h4"><?php the_title(); ?></a>
                                            <p class="mt-3"><?php the_excerpt(); ?></p>
                                            <a href="<?php echo get_the_permalink(); ?>" class="read-more">Read More <i
                                                    class="fa fa-angle-right"></i></a>
                                        </div>
                                    </div>
                                    <?php
                                    break;
                            }
                        endwhile;
                    else: ?>
                        <p>Записей нет.</p>
                    <?php endif; ?>
                    <div class="col-lg-12">
                        <?php the_posts_pagination(array(
                            'prev_text' => __('<span class="p-2 border">« Предыдущие посты </span>'),
                            'next_text' => __('<span class="p-2 border"> Следущие посты »</span>'),
                            'before_page_number' => '<span class="p-2 border">',
                            'after_page_number' => '</span>'
                        )); ?>
                    </div>
                </div>
            </div>

            <?php get_sidebar();?>
        </div>
    </div>
</section>
<!--  Blog AREA End -->

<?php get_footer(); ?>