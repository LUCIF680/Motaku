<!DOCTYPE html>
<html lang="en">
<head>
    <!--- basic page needs
    ================================================== -->
    <meta charset="utf-8">
    <title>MasterOtaku | Love anime, write anime</title>
    <meta name="Description" content="Enjoy the blogs from your favorite writer, write, comment, share with your friends, family and the world">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="keywords" content="anime,blog,manga,one piece,boku no hero,">
    <!-- favicons
    ================================================== -->
    <link rel="icon" href="https://lucif680.github.io/images/masterotaku/favicon.jpg">
    <!--Icons
    ================================================== -->
    <link rel="stylesheet" href="templates/view/css/icons.css">
    <!--All CSS
    =================================================-->
    <link rel="stylesheet" href="templates/view/css/bootstrap.min.css">
    <link rel="stylesheet" href="templates/view/css/preload.css">
    <link rel="stylesheet" href="templates/view/css/main.css">
    <link rel="stylesheet" href="templates/view/css/home.css">
    <link rel="stylesheet" href="templates/view/css/responsive/home.css">
    <!--All Javascript
    =================================================-->
    <script src="templates/js/main.js"></script>
    <script src="templates/js/header.js"></script>
    <script src="templates/js/home.js"></script>
</head>
<body>
<!--Header
=================================================-->
<header></header>
<!--Preloader
 =================================================-->
<div id="preloader">
    <div id="loader"></div>
</div>
<!--Page Content
 =================================================-->
<div id="slider">
    <div class="row text-center">
        <div class="col-sm-12"><p id="catchphrase">Created by Otaku for Otaku,<br> Write about anime, read about manga, a blog website from future.</p></div>
        <div class="centered">
            <form action="search">
                <input title = "Search any anime blog" placeholder="Search..." type="text" id="search_bar" class="col-sm-12" name="search" required><!--Search bar here-->
                <button class="square_btn">Search</button>
            </form>
        </div><!--center the search bar-->
    </div><!--center the text-->
</div><!-- holds the image and search bar-->

<form id = "search" action="search"></form> <!--search form for the input field at the menu bar-->


<section class="blog-area section">
    <div class="container">
        <div class="row">
            <?php
                foreach ($array[0] as $blogInfo){
                    echo '<div class="col-lg-4 col-md-6">
                                    <div class="card h-100">
                                        <div class="single-post post-style-1">
                                            <div class="blog-image"><a href="showblog?id='.$blogInfo["id"].'"><img src="blog/'.$blogInfo['user_id'].'/images/'.$blogInfo['thumbnail'].'" alt="Blog Image"></a></div>
                                            <div class="blog-info">
                                                <h5 class="title"><a href="showblog?id='.$blogInfo["id"].'"><b>'.str_replace("%20"," ",$blogInfo['title']).'</b></a></h5>
                                                <ul class="post-footer">
                                                    <li><a href="#"><i class="ion-eye"></i>'.$blogInfo['views'].'</a></li>
                                                </ul>
                                            </div><!-- blog-info -->
                                        </div><!-- single-post -->
                                    </div><!-- card -->
                                </div><!-- col-lg-4 col-md-6 --><br>';
                }                
            ?>
        </div>
    </div>
</section>
</body>
</html>
