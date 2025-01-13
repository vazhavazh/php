<? get_header(); ?>

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
                    <?php if (have_posts()):
                        while (have_posts()):
                            the_post(); ?>
                            <!-- Вывод постов, функции цикла: the_title() и т.д. -->
                            <div class="col-lg-6">
                                <div class="blog-post">
                                    <img src="assets/img/blog/blog-1.jpg" alt="" class="img-fluid">
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
                                    <a href="<?php echo get_the_permalink(); ?>" class="h4 "><?php the_title(); ?></a>
                                    <p class="mt-3"><?php the_excerpt(); ?></p>
                                    <a href="<?php echo get_the_permalink(); ?>" class="read-more">Read More <i
                                            class="fa fa-angle-right"></i></a>
                                </div>
                            </div>
                        <?php endwhile;
                    else: ?>
                        Записей нет.
                    <?php endif; ?>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="blog-post">
                            <img src="assets/img/blog/blog-1.jpg" alt="" class="img-fluid">
                            <div class="mt-4 mb-3 d-flex">
                                <div class="post-author mr-3">
                                    <i class="fa fa-user"></i>
                                    <span class="h6 text-uppercase">John mackel</span>
                                </div>

                                <div class="post-info">
                                    <i class="fa fa-calendar-check"></i>
                                    <span>19 jun 18</span>
                                </div>
                            </div>
                            <a href="blog-single.html" class="h4 ">Marketing tips to grow your site template</a>
                            <p class="mt-3">Distinctio nulla hic repudiandae aliquid sint architecto dolore similique
                                amet laboriosam suscipit in officia rerum, pariatuz.</p>
                            <a href="blog-single.html" class="read-more">Read More <i class="fa fa-angle-right"></i></a>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="blog-post">
                            <img src="assets/img/blog/blog-2.jpg" alt="" class="img-fluid">
                            <div class="mt-4 mb-3 d-flex">
                                <div class="post-author mr-3">
                                    <i class="fa fa-user"></i>
                                    <span class="h6 text-uppercase">John mackel</span>
                                </div>

                                <div class="post-info">
                                    <i class="fa fa-calendar-check"></i>
                                    <span>19 jun 18</span>
                                </div>
                            </div>
                            <a href="blog-single.html" class="h4 ">Build site tips to grow your site template</a>
                            <p class="mt-3">Distinctio nulla hic repudiandae aliquid sint architecto dolore similique
                                amet laboriosam suscipit in officia rerum, pariatuz.</p>
                            <a href="blog-single.html" class="read-more">Read More <i class="fa fa-angle-right"></i></a>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="blog-post">
                            <img src="assets/img/blog/blog-lg.jpg" alt="" class="img-fluid">
                            <div class="mt-4 mb-3 d-flex">
                                <div class="post-author mr-3">
                                    <i class="fa fa-user"></i>
                                    <span class="h6 text-uppercase">John mackel</span>
                                </div>

                                <div class="post-info">
                                    <i class="fa fa-calendar-check"></i>
                                    <span>19 jun 18</span>
                                </div>
                            </div>
                            <a href="blog-single.html" class="h4 ">Falling in lin in google strategy</a>
                            <p class="mt-3">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Ullam, tenetur
                                debitis iste eos doloremque praesentium nulla numquam nostrum quas distinctio sapiente
                                illum nam laudantium laboriosam nobis odit nesciunt error? Dolor.</p>
                            <a href="blog-single.html" class="read-more">Read More <i class="fa fa-angle-right"></i></a>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6">
                        <div class="blog-post">
                            <img src="assets/img/blog/blog-3.jpg" alt="" class="img-fluid">
                            <div class="mt-4 mb-3 d-flex">
                                <div class="post-author mr-3">
                                    <i class="fa fa-user"></i>
                                    <span class="h6 text-uppercase">John mackel</span>
                                </div>

                                <div class="post-info">
                                    <i class="fa fa-calendar-check"></i>
                                    <span>19 jun 18</span>
                                </div>
                            </div>
                            <a href="blog-single.html" class="h4 ">Best tips to grow your site template</a>
                            <p class="mt-3">Distinctio nulla hic repudiandae aliquid sint architecto dolore similique
                                amet laboriosam suscipit in officia rerum, pariatuz.</p>
                            <a href="blog-single.html" class="read-more">Read More <i class="fa fa-angle-right"></i></a>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="blog-post">
                            <img src="assets/img/blog/blog-4.jpg" alt="" class="img-fluid">
                            <div class="mt-4 mb-3 d-flex">
                                <div class="post-author mr-3">
                                    <i class="fa fa-user"></i>
                                    <span class="h6 text-uppercase">John mackel</span>
                                </div>

                                <div class="post-info">
                                    <i class="fa fa-calendar-check"></i>
                                    <span>19 jun 18</span>
                                </div>
                            </div>
                            <a href="blog-single.html" class="h4 ">Top growing channel tips lets follow</a>
                            <p class="mt-3">Distinctio nulla hic repudiandae aliquid sint architecto dolore similique
                                amet laboriosam suscipit in officia rerum, pariatuz.</p>
                            <a href="blog-single.html" class="read-more">Read More <i class="fa fa-angle-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- BlOG SIDEBAR -->
            <div class="col-lg-4">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="sidebar-widget search">
                            <div class="form-group">
                                <input type="text" placeholder="search" class="form-control">
                                <i class="fa fa-search"></i>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="sidebar-widget about-bar">
                            <h5 class="mb-3">About us</h5>
                            <p>Nostrum ullam porro iusto. Fugit eveniet sapiente nobis nesciunt velit cum fuga
                                doloremque dignissimos asperiores</p>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="sidebar-widget category">
                            <h5 class="mb-3">Category</h5>
                            <ul class="list-styled">
                                <li>Marketing</li>
                                <li>Digiatl</li>
                                <li>SEO</li>
                                <li>Web Design</li>
                                <li>Development</li>
                                <li>video</li>
                                <li>audio</li>
                                <li>slider</li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="sidebar-widget tag">
                            <a href="#">web</a>
                            <a href="#">development</a>
                            <a href="#">seo</a>
                            <a href="#">marketing</a>
                            <a href="#">branding</a>
                            <a href="#">web deisgn</a>
                            <a href="#">Tutorial</a>
                            <a href="#">Tips</a>
                            <a href="#">Design trend</a>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="sidebar-widget download">
                            <h5 class="mb-4">Download Files</h5>
                            <a href="#"> <i class="fa fa-file-pdf"></i>Company Manual</a>
                            <a href="#"> <i class="fa fa-file-pdf"></i>Company Profile</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
<!--  Blog AREA End -->

<? get_footer(); ?>