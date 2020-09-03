<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $array['searchInput']?> || Search Result || Motaku</title>
    <!--Meta Information
        ================================================== -->
    <meta name="Description" content="Search result for <?php echo $array['searchInput']?>">
    <meta name="keyword" content="anime,manga,one piece,zoro,luffy,kaido,naruto,bnha,boku no hero,tokyo ghoul,top 10,blog,recommend">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <!-- favicons
    ================================================== -->
    <link rel="icon" href="https://lucif680.github.io/images/masterotaku/favicon.jpg">
    <link rel="stylesheet" href="templates/view/css/bootstrap.min.css">
    <link rel="stylesheet" href="templates/view/css/icons.css">
    <link rel="stylesheet" href="templates/view/css/main.css">
    <link rel="stylesheet" href="templates/view/css/search.css">
    <script src="templates/js/main.js"></script>
    <script src="templates/js/header.js"></script>
</head>
<body>
    <header></header>
    <div class="container">
        <br/>
        <div class="row justify-content-center">
            <div class="col-12 col-md-10 col-lg-8">
                <form  action="search">
                    <div class="card-body row no-gutters align-items-center">
                        <div class="col">
                            <input value="<?php echo $array['searchInput']?>" name="search" class="form-control form-control-lg form-control-borderless" type="search" placeholder="Search topics or keywords">
                        </div><!--end of col-->
                        <div class="col-auto searchButton">
                            <button class="btn btn-lg btn-success" type="submit">Search</button>
                        </div><!--end of col-->
                    </div>
                </form>
            </div><!--end of col-->
        </div>
    </div>
    <div class="container">
        <?php for ($i = 0;$i < count($array)-1;$i++){?>
            <div class="shadow-sm p-3 mb-5 bg-white rounded-12">
                <div class = "row">
                    <div class="col-lg-4">
                        <img class = "rounded" src="blog/<?php echo $array[$i]['user_id']?>/images/<?php echo $array[$i]['thumbnail']?>">
                    </div>
                    <div class="col-lg-8">
                        <h5><?php echo str_replace("%20"," ",$array[$i]['title'])?></h5>

                    </div>
                </div>

            </div>
        <?php }?>
    </div>

    <script>createMenuBar();</script>
</body>
</html>