<!DOCTYPE html>
<html lang="en">
<head>
    <!--- basic page needs
       ================================================== -->
    <meta charset="UTF-8">
    <title>Write your own blog || Motaku</title>
    <meta name="Description" content="Write your own article, share with friends family and the world.">
    <!-- mobile specific metas
        ================================================== -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <!-- favicons
    ================================================== -->
    <link rel="icon" href="https://lucif680.github.io/images/masterotaku/favicon.jpg">
    <!--Icons
    ================================================== -->
    <link rel="stylesheet" href="templates/view/css/icons.css">
    <link href="templates/view/css/icomoon.css" rel="stylesheet">
    <!--All CSS
    =================================================-->
    <link rel="stylesheet" href="templates/view/css/bootstrap.min.css">
    <link rel="stylesheet" href="templates/view/css/main.css">
    <link rel="stylesheet" href="templates/view/css/edit.css">
    <link rel="stylesheet" href="templates/view/css/responsive/edit.css">
    <link href="library/filepond/filepond.css" rel="stylesheet">
    <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css" rel="stylesheet">
    <!--All Javascript
    =================================================-->
    <script src="templates/js/main.js"></script>
    <script src="templates/js/header.js"></script>
</head>
<body>
<!--Header
=================================================-->
<header></header>
<nav class="navbar navbar-light bg-dark justify-content-between">
    <input form="form" type="submit" value="Publish">
    <div class="navbar-text">
        <label id="imageIcon" title="Add Image" class="icon-file-image-o add"></label>
    </div>
</nav>
<br>

<div id="popup" class="modal">
    <form class="modal-content animate">
        Upload Image just before Publishing....<br>
        <input id="thumbnail" class="filepond" name="<?php echo $_SESSION['name']['thumbnail']?>" type="file" accept="image/*" >
        <input id="image" class="filepond" name="<?php echo $_SESSION['name']['image']?>" type="file" accept="image/*" multiple >
    </form>
</div>

<div class="container editor">
    <form id="form" action="<?php echo $action?>" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <h6>Title</h6>
            <input id="title" name="<?php echo $_SESSION['name']['title']?>" class="form-control textarea" placeholder="Your Blog Title......" required/>
            <h6>Your Article</h6>
            <textarea name="<?php echo $_SESSION['name']['blog']?>" class="form-control textarea" rows="12" placeholder="What's in your mind......" required></textarea>
            <h6>Tags</h6>
            <input id="tags" name="<?php echo $_SESSION['name']['tags']?>" class="form-control textarea" value="#" required />
            <input type="hidden" id="hidden" value="" name="<?php echo $_SESSION['name']['hidden']?>" required/>
        </div>
    </form>
</div>
<form id = "search" action="search"></form> <!--search form for the input field at the menu bar-->
<script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
<script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>
<script src="library/filepond/filepond.js"></script>
<script src="templates/js/editor.js"></script>
</body>
</html>
