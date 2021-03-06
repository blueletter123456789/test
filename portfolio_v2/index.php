<?php

  session_cache_expire(10);
  session_start();

  if(isset($_SESSION['loading']) == false) {
    $_SESSION['loading'] = 1;
  }else{
    $displayFlg = 1;
  }

?>

<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>portfolio</title>
    <link rel="stylesheet" href="./css/common.css" />
    <link rel="stylesheet" href="./css/style.css" />
    <link rel="shortcut icon" href="./css/img/favicon.ico" type="image/svg+xml"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome-animation/0.2.1/font-awesome-animation.css" type="text/css" media="all" />
    <script src="./js/jquery-3.4.1.min.js" type="text/javascript"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.7/ScrollMagic.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.7/plugins/debug.addIndicators.min.js"></script>
    <script type="text/javascript" src="./js/t.min.js"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.13.0/js/all.js" integrity="sha384-ujbKXb9V3HdK7jcWL6kHL1c+2Lj4MR4Gkjl7UtwpSHg/ClpViddK9TI7yU53frPN" crossorigin="anonymous"></script>
    <script type="text/javascript" src="./js/main.js"></script>
  </head>
  <body>
<?php if ($displayFlg == 0) { ?>
    <div id="loading-page" class="active">
      <div>
        <h1 id="loading-title"></h1>
        <div id="loading-bar"></div>
      </div>
    </div>
<?php } ?>
    <header class="site-header">
      <div class="mobile-menu">
        <div id="menu-wrapper">
          <span></span>
        </div>
          <div id="mobile-navigation" class="hidden">
            <div>
              <ul>
                <li>
                  <a href="./html/service.html">Service</a>
                  <i class="fas fa-laptop-code fa-fw mob-icon"></i>
                </li>
                <li>
                  <a href="./html/works.html">Works</a>
                  <i class="fas fa-database fa-fw mob-icon"></i>
                </li>
                <li>
                  <a href="https://riding.co.jp/portfolio/ShuheiAbe/blog/">Blog</a>
                  <i class="fas fa-book fa-fw mob-icon"></i>
                </li>
              </ul>
            </div>
          </div>
      </div>
      <a id="top-logo" href="./form/test_cache_clear.php">
        <img src="./css/img/main-icon.SVG" alt="">
      </a>
      <nav class="top-nav">
        <ul>
          <li class="nav-about">
            <a href="#about">About</a>
          </li>
          <li class="nav-seravice">
            <a href="./html/service.html">Service</a>
          </li>
          <li class="nav-works">
            <a href="./html/works.html">Works</a>
          </li>
          <li class="nav-blog">
            <a href="https://riding.co.jp/portfolio/ShuheiAbe/blog/">Blog</a>
          </li>
          <li class="nav-contact">
            <a href="#contact">Contact</a>
          </li>
        </ul>
      </nav>
    </header>
    <div class="main-panel">
      <h1 id="top-title">Design is not just <br>what it looks like and feels like. <br>Design is how it works.</h1>
      <section id="top" class="page top">
        <div class="top-base"></div>
        <div class="video-wrapper">
          <!-- <video src="./css/img/test2-movie.mp4" autoplay muted loop playsinline preload="auto"></video> -->
          <img src="./css/img/index_topbg.JPG">
        </div>
      </section>
      <section id="about" class="page about">
        <div class="content-wrapper">
          <div id="about-position">
            <div id="about-title">
              <h1>
                美しく、<br>より正確に、<br>より速く。
              </h1>
            </div>
            <div id="about-content">
              <p>
                <div class="text-bold">
                  <span>エンジニアとして正確さ、</span><span>速さに</span><span>挑戦してくだけで</span><span>いいのでしょうか？</span>
                </div>
                <span>IT技術が</span><span>多様化する</span><span>社会の中で、</span><span>システムエンジニアとして</span><span>あくなき</span><span>探究心を</span><span>持ち、</span><span>正確さ、</span><span>速さを</span><span>追求していく</span><span>だけでなく、</span><span>美しい</span><span>デザイン設計を</span><span>一貫して</span><span>追求して</span><span>いきます。</span><span>ユーザーインタフェースの</span><span>機能美だけでなく、</span><span>システム内部の</span><span>美しさも</span><span>追求することで、</span><span>お客さまの</span><span>印象に</span><span>残る作品を</span><span>生み出し、</span><span>RASISが</span><span>高いシステムを</span><span>作成します。</span>
              </p>
            </div>
          </div>
        </div>
      </section>
      <section id="service" class="page service">
        <div class="service-background"></div>
        <div class="content-wrapper">
          <div id="service-position">
            <div id="service-headline">
              <h1>
                Who decides the border<br>between <span class="text-bold">"Front end"</span> and <span class="text-bold">"Back end"</span>?
              </h1>
            </div>
            <div class="link-info">
              <a href="./html/service.html" target="_blank">
                <i
                  class="fas fa-caret-square-right fa-fw link-arrow"
                  data-fa-transform="grow-16"
                ></i>
                <span>Read more about Service</span>
              </a>
            </div>
          </div>
        </div>
      </section>
      <section id="works" class="page works">
        <div class="works-background"></div>
        <div class="content-wrapper">
          <div id="works-position">
            <div id="works-headline">
              <h1>
                What can I do to improve society.
              </h1>
            </div>
            <div class="link-info">
              <a href="./html/works.html" target="_blank">
                <i
                  class="fas fa-caret-square-right fa-fw link-arrow"
                  data-fa-transform="grow-16"
                ></i>
                <span>Read more about Works</span>
              </a>
            </div>
          </div>
        </div>
      </section>
      <section id="blog" class="page blog">
        <div class="blog-wrapper">
          <div class="blog-content bc1">
            <div id="content1" class="blog-background"></div>
            <div class="blog-text">
              <div class="blog1">
                <h1>blog pages, blog pages, blog pages, blog pages</h1>
                <p>20xx/xx/xx</p>
                <a href="#">
                  <span>Tell me more!</span>
                  <span class="fa-layers fa-fw blog-icon">
                    <i
                      class="fas fa-comment"
                      data-fa-transform="grow-8 up-8"
                    ></i>
                    <i
                      class="fas fa-exclamation"
                      data-fa-transform="shrink-4 up-8"
                      style="color: #33312d;"
                    ></i>
                  </span>
                </a>
              </div>
            </div>
          </div>
          <div class="blog-content bc2">
            <div id="content2" class="blog-background"></div>
            <div class="blog-text">
              <div class="blog2">
                <h1>blog pages, blog pages, blog pages, blog pages</h1>
                <p>20xx/xx/xx</p>
                <a href="#">
                  <span>Tell me more!</span>
                  <span class="fa-layers fa-fw blog-icon">
                    <i
                      class="fas fa-comment"
                      data-fa-transform="grow-8 up-8"
                    ></i>
                    <i
                      class="fas fa-exclamation"
                      data-fa-transform="shrink-4 up-8"
                      style="color: #33312d;"
                    ></i>
                  </span>
                </a>
              </div>
            </div>
          </div>
          <div class="blog-content bc3">
            <div id="content3" class="blog-background"></div>
            <div class="blog-text">
              <div class="blog3">
                <h1>blog pages, blog pages, blog pages, blog pages</h1>
                <p>20xx/xx/xx</p>
                <a href="#">
                  <span>Tell me more!</span>
                  <span class="fa-layers fa-fw blog-icon">
                    <i
                      class="fas fa-comment"
                      data-fa-transform="grow-8 up-8"
                    ></i>
                    <i
                      class="fas fa-exclamation"
                      data-fa-transform="shrink-4 up-8"
                      style="color: #33312d;"
                    ></i>
                  </span>
                </a>
              </div>
            </div>
          </div>
          <div id="page-to-blog">
            <a href="https://riding.co.jp/portfolio/ShuheiAbe/blog/">
                <span>All blog is here</span>
                <i class="fas fa-chevron-right fa-fw blog-icon" data-fa-transform="grow-16 down-18 right-4"></i>
            </a>
          </div>
        </div>
      </section>
      <section id="contact" class="page contact">
        <div class="form-title">
          <h1 id="contact-title">Contact Me</h1>
        </div>
<?php
  
    include_once('./form/form_main.php');
  
 ?>
      </section>
    </div>
    <footer></footer>
  </body>
</html>
