<?php
  $curent_pag = $current_page??'Aniha Store';
?>


<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>
    <?=$curent_pag?>
  </title>

  <link rel="shortcut icon" href="/img/logo.png" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" />


  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="/css/style.css" />
</head>

<body>
  <header class="container-fluid bg-light ">
    <div class="row justify-content-center">
      <div class="col-0 col-md-3"></div>
      <div class="col-12 col-md-6 order-md-2 text-center">
        <a href="/"><img src="/img/header-img.jpg" class="img-fluid" width="80%" /></a>
      </div>

      <div class="col-12 col-md-3 order-3 d-flex align-items-center justify-content-end">
        <nav class="btn-group group">
          <?php
          if (isset($_SESSION['user_id']) || isset($_SESSION['admin_id'])) {
            echo '<a class="btn m-1 text-center text-nowrap" href="/logout"><b id="log-out">Log Out</b></a>';
          } else {
            echo '<a class="btn mb-1 text-center text-nowrap" href="/login"><b id="log-in">Log In</b></a>';
          }
          ?>
        </nav>
        <?php
        if (isset($_SESSION['admin_id'])) {
          echo '<a class="p-3 btn-cart btn-go-to-admin text-center text-nowrap" href="/admin"><b><i class=" fa-solid fa-user-shield fa-lg"></i></b></a>';
        }
        ?>
        <?php if (isset($_SESSION['user_id'])) : ?>
          <a href="/user/edit" class=" btn-cart p-3"><i class="fa-solid fa-user-pen fa-lg"></i></i></a>
        <?php endif ?>
        <?php if (!isset($_SESSION['admin_id'])) : ?>
          <a href="/user/cart" class="p-2 btn-cart btn-go-to-cart"><i class=" fa-solid fa-cart-shopping fa-bounce fa-lg"></i></i></a>
        <?php endif ?>

      </div>
    </div>
  </header>
  <nav class="sticky-top navbar navbar-expand-lg bg-col navbar-dark">
    <div class="container-fluid">

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-between" id="collapsibleNavbar">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link 
            <?php
            if($curent_pag=='Home') echo'actives';
            ?>" 
            href="/">Trang Chủ</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php
            if($curent_pag=='Accessory') echo'actives';
            ?> " href="/product?type=accessory">Phụ Kiện</a>
          </li>
          <li class="nav-item">
            <a class="nav-link 
            <?php
            if($curent_pag=='Food') echo'actives';
            ?>" href="/product?type=food">Thức ăn</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle <?php
            if($curent_pag=='Product' || $curent_pag=='Cat' || $curent_pag=='Dog' || $curent_pag=='Mouse' || $curent_pag=='Rabbit') echo'actives';
            ?>"  href="#" role="button" data-bs-toggle="dropdown">Thú Cưng</a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="/product?type=dog">Chó</a></li>
              <li><a class="dropdown-item" href="/product?type=cat">Mèo</a></li>
              <li><a class="dropdown-item" href="/product?type=mouse">Chuột</a></li>
              <li><a class="dropdown-item" href="/product?type=rabbit">Thỏ</a></li>
            </ul>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php
            if($curent_pag=='Contact') echo'actives';
            ?>" href="/contact">Liên hệ</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php
            if($curent_pag=='About') echo'actives';
            ?>" href="/about">Về Aniha</a>
          </li>
        </ul>
        <form id='search-form' action="/product" method="get" class="d-flex jutify-content-center align-items-center mt-4 mt-lg-0">
          <input id="search-input" class="form-control me-2" name="search_key" type="search" placeholder="Tìm kiếm" aria-label="Search">
          <button id='search-button' class=" jutify-content-center btn btn-outline-light" type="submit"> <i class="fa-solid fa-magnifying-glass"></i></button>
        </form>
      </div>
    </div>
  </nav>