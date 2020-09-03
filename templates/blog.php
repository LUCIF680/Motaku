<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>MasterOtaku | Love anime, write anime</title>
    <!-- Mobile Specific Meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon-->
    <link rel="icon" href="https://lucif680.github.io/images/masterotaku/favicon.jpg">
    <!-- Author Meta -->
    <meta name="author" content="otakukart">
    <!-- Meta Description -->
    <meta name="description" content="<?php echo $array["title"]?>">
    <!-- Meta Keyword -->
    <meta name="keywords" content="<?php echo $array["keywordString"]?>">
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display:700|Roboto:400,500" rel="stylesheet">
    <!--
			CSS
			============================================= -->
    <link rel="stylesheet" href="templates/colorlib/blog/css/linearicons.css">
    <link rel="stylesheet" href="templates/colorlib/blog/css/font-awesome.min.css">
    <link rel="stylesheet" href="templates/colorlib/blog/css/bootstrap.css">
    <link rel="stylesheet" href="templates/colorlib/blog/css/magnific-popup.css">
    <link rel="stylesheet" href="templates/colorlib/blog/css/nice-select.css">
    <link rel="stylesheet" href="templates/colorlib/blog/css/animate.min.css">
    <link rel="stylesheet" href="templates/colorlib/blog/css/owl.carousel.css">
    <link rel="stylesheet" href="templates/colorlib/blog/css/main.css">
    <link rel="stylesheet" href="templates/view/css/icons.css">
    <link rel="stylesheet" href="templates/view/css/colorlib.css">
    <link rel="stylesheet" href="templates/view/css/responsive/edit.css">
    <script src="templates/js/main.js"></script>
    <script src="templates/js/header.js"></script>
</head>

<body>
    <header></header>
    <input type="hidden" class="hiddenServer" value='<?php echo ($array['images']) ?>'/>
    <input type="hidden" class="hiddenServer" value="<?php echo  $array['user_id'] ?>"/>
    <form id = "search" action="search"></form> <!--search form for the input field at the menu bar-->
    <!-- Blog Area -->
    <section class="blog_area section-gap single-post-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="main_blog_details">
                        <h4><?php echo $array['title']?></h4>
                        <div class="user_details">
                            <div class="float-left tags"><?php echo $array['tags']?></div>
                        </div>
                        <div class="blogSection"><?php echo $array['blogContent']?></div>
                    </div>
                    <div class="navigation-area">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-12 nav-left flex-row d-flex justify-content-start align-items-center">
                            <i class="fa fa-angle-left" style="font-size:30px"></i>&nbsp;&nbsp;&nbsp;&nbsp;
                                <div class="detials">
                                    <p>Prev Post</p>
                                    <a id="prev_a" href="">
                                        <h4 id="prev"></h4>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12 nav-right flex-row d-flex justify-content-end align-items-center">
                                <div class="detials">
                                    <p>Next Post</p>
                                    <a id= "next_a" href="">
                                        <h4 id="next"></h4>
                                    </a>
                                </div>&nbsp;&nbsp;&nbsp;&nbsp;
                                <i class="fa fa-angle-right" style="font-size:30px"></i>
                                <div class="arrow">
                               
                                </div>
                                <div class="thumb">
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                
                <div class="col-lg-4 sidebar">
                    <div class="single-widget protfolio-widget">
                        <!--<img class="img-fluid" src="img/blog/user2.png" alt="Manga,anime,otaku,one piece,boku no hero,top 10,dragon ball z">-->
                        <a href="#">
                            <h4>Pratik Mazumdar</h4>
                        </a>
                        <div class="desigmation">
                            <p>Otaku,Developer,Founder</p>
                        </div>
                        <p>
                            200+ shows experience in anime. Founder of MasterOtaku. Love to write about anime and provide recommendation.
                        </p>
                    </div>
                    <div class="single-widget popular-posts-widget">
                        <h4 class="title">Popular Posts</h4>
                        <div class="blog-list ">
                            <?php for($i = 0; $i < count($array['popularBlogs']); $i++) {?>
                            <div class="single-popular-post d-flex flex-row">
                                <div class="popular-thumb">
                                    <a href="showblog?id=<?php echo $array['popularBlogs'][$i]['id']?>">
                                        <img class="img-fluid" src="blog/<?php echo $array['popularBlogs'][$i]['user_id'].'/images/'.$array['popularBlogs'][$i]['thumbnail'] ?>" alt="Manga,anime,otaku,one piece,boku no hero,top 10,dragon ball z">
                                    </a>
                                </div>
                                <div class="popular-details">
                                    <a href="showblog?id=<?php echo $array['popularBlogs'][$i]['id']?>">
                                        <h4><?php echo $array['popularBlogs'][$i]['title']?></h4>
                                    </a>
                                    <p>Views:<?php echo $array['popularBlogs'][$i]['views']?></p>
                                </div>
                            </div>
                            <?php }?>
                        </div>
                    </div>

                  <!--  <div class="single-widget category-widget">
                        <h4 class="title">Post Categories</h4>
                        <ul>
                            <li><a href="#" class="justify-content-between align-items-center d-flex">
                                    <p>Techlology</p> <span>37</span>
                                </a></li>
                            <li><a href="#" class="justify-content-between align-items-center d-flex">
                                    <p>Lifestyle</p> <span>24</span>
                                </a></li>
                            <li><a href="#" class="justify-content-between align-items-center d-flex">
                                    <p>Fashion</p> <span>59</span>
                                </a></li>
                            <li><a href="#" class="justify-content-between align-items-center d-flex">
                                    <p>Art</p> <span>29</span>
                                </a></li>
                            <li><a href="#" class="justify-content-between align-items-center d-flex">
                                    <p>Food</p> <span>15</span>
                                </a></li>
                            <li><a href="#" class="justify-content-between align-items-center d-flex">
                                    <p>Architecture</p> <span>09</span>
                                </a></li>
                            <li><a href="#" class="justify-content-between align-items-center d-flex">
                                    <p>Adventure</p> <span>44</span>
                                </a></li>
                        </ul>
                    </div>

                    <div class="single-widget newsletter-widget">
                        <h4 class="title">Newsletter</h4>
                        <div id="mc_embed_signup">
                            <form target="_blank" novalidate="true" action="https://spondonit.us12.list-manage.com/subscribe/post?u=1462626880ade1ac87bd9c93a&amp;id=92a4423d01"
                                method="get" class="">
                                <div class="form-group" style="width: 100%">
                                    <input name="EMAIL" placeholder="Email Address" onfocus="this.placeholder = ''"
                                        onblur="this.placeholder = 'Email Address '" required="" type="email">
                                    <div style="position: absolute; left: -5000px;">
                                        <input name="b_36c4fd991d266f23781ded980_aefe40901a" tabindex="-1" value=""
                                            type="text">
                                    </div>

                                    <button class="primary-btn text-uppercase">
                                        Subscribe Now
                                        <span class="lnr lnr-arrow-right"></span>
                                    </button>
                                </div>
                                <div class="info"></div>
                            </form>
                        </div>
                    </div>-->

                </div>
            </div>
        </div>
    </section>
    <!-- Blog Area -->

    <!-- start footer Area -->
    <footer class="footer-area section-gap">
        <div class="container box_1170">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="single-footer-widget">
                        <h6 class="footer_title">About Us</h6>
                        <p>We provide a landing ground for all the otaku out their to write and read about recent anime and manga with your loved ones.</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <script src="templates/js/main.js"></script>
    <script src="templates/js/blog.js"></script>
</body>
</html>