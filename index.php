<?php
$domainArr = array_reverse(explode('.', $_SERVER ['HTTP_HOST']));
$domain = $domainArr[1].'.'.$domainArr[0];
$domainExt = $domainArr[0];
$domainExtLen = mb_strlen($domainExt);
//echo $domainExtLen
$json_string = file_get_contents('./config.json');
$data = json_decode($json_string, true);
$siteName = $data['name'];
$siteDescription = $data['description'];
$siteKeywords = $data['keywords'];
$siteLogo = $data['logo'];
$initialSlide = 1;
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
  <meta content="<?php echo $siteDescription ?>" name="description">
  <meta content="<?php echo $siteKeywords ?>">
  <meta name="theme-color" content="#5f18d3">
  <link rel="icon" type="image/png" href="./assets/images/<?php echo $siteName ?>">
  <link rel="icon" type="image/png" sizes="144x144" href="./assets/images/<?php echo $siteLogo ?>">
  <link rel="apple-touch-icon" type="image/png" href="./assets/images/<?php echo $siteLogo ?>">
  <link rel="stylesheet" href="./assets/styles/swiper-bundle.min.css"/>
  <script src="./assets/scripts/swiper-bundle.min.js"></script>
  <script src="./assets/scripts/jquery-2.2.4.min.js"></script>
  <title><?php echo $siteName ?></title>
  <style>
    @font-face {
      font-family: 'Montserrat';
      font-style: normal;
      font-weight: 200;
      font-display: swap;
      src: url(./assets/fonts/montserrat/200.woff2) format('woff2');
    }
    @font-face {
      font-family: 'Montserrat';
      font-style: normal;
      font-weight: 400;
      font-display: swap;
      src: url(./assets/fonts/montserrat/400.woff2) format('woff2');
    }
    @font-face {
      font-family: 'Montserrat';
      font-style: normal;
      font-weight: 800;
      font-display: swap;
      src: url(./assets/fonts/montserrat/800.woff2) format('woff2');
    }
    @font-face {
      font-family: 'SourceHanSerifCN';
      src: url('./assets/fonts/SourceHanSerifCN.ttf') format('TrueType');
      font-weight: normal;
      font-style: normal;
      font-display: swap;
    }
    html {
      font-size: 13.3333vw;
      --max-width: 750px;
      --grid-cols: 5;
      --grid-rows: 5;
      --grid-ext7-cols: 3;
      --grid-ext7-rows: 4;
      --grid-gap-width: 1px;
      --grid-gap-line: clac(var(--grid-cols) - 1);
      --grid-wrap-width: calc(var(--max-width) + (var(--grid-cols) - 1) * var(--grid-gap-width));
      --grid-col-width: calc( var(--max-width) / var(--grid-cols) );
    }
    html,body {
      height: 100%;
      width: 100%;
      margin: 0;
    }
    body {
      font-size: 16px;
      display: flex;
      align-items: center;
      flex-direction: column;
      background-color: #fff;
      font-family: Montserrat,sans-serif;
    }

    a, a:visited {
      text-decoration: none;
      color: inherit;
    }
    a:hover {
      font-weight: bold;
      color: #1156e0;
    }

    ul {
      list-style: none;
      margin: 0;
      padding: 0;
    }
    .wrap {
      width: 100%;
      border-top: 1px solid #ccc;
    }
    .inner {
      width: var(--grid-wrap-width);
      margin: 0 auto;
      border: 1px solid #ccc;
      border-width: 0 1px;
    }
    
    h1 {
      background-image: url(assets/images/boring.domains.svg);
      background-size: auto 100%;
      background-position: 50% 50%;
      background-repeat: no-repeat;
      color: transparent;
      font-size: .72rem;
    }

    nav {
      display: flex;
      height: 48px;
    }
    nav a {
      flex: 1;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .domains {
      display: flex;
      flex-wrap: wrap;
      position: relative;
    }
    .domains .inner {
      order: 2;
    }
    /* .domain-list {
      display: flex;
      align-items: center;
    } */

    .domain-item {
      display: grid;
      gap: var(--grid-gap-width);
      grid-template: repeat(var(--grid-rows), calc(var(--max-width) / var(--grid-rows))) / repeat(var(--grid-cols), calc(var(--max-width) / var(--grid-cols)));
      background-color: #ccc;
      -webkit-touch-callout: none;
      -webkit-user-select: none;
      -moz-user-select: none;
      -ms-user-select: none;
      user-select: none;
    }
    .domain-item span {
      display: flex;
      align-items: center;
      justify-content: center;
      background-color: #fff;
      font-size: .36rem;
      font-weight: 800;
      text-transform: uppercase;
      position: relative;
    }
    .domain-item span:hover {
      color: transparent;
    }
    .domain-item span img {
      position: absolute;
      left: 0;
      top: 0;
      right: 0;
      bottom: 0;
      object-fit:cover;
      width: 50%;
      margin: auto;
    }
    .domain-item span:last-child {
      grid-area: 4/4/6/6;
      font-size: .6rem;
    }
    .domain-item span:last-child::after {
      visibility: hidden;
      content: attr(desc);
      position: absolute;
      left: 0;
      top: 0;
      right: 0;
      bottom: 0;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: calc(var(--max-width) / var(--grid-cols));
      font-family: SourceHanSerifCN;
    }
    .domain-item span:last-child:hover {
      color: transparent;
    }
    .domain-item span:last-child:hover::after {
      visibility: visible;
      color: #000;
    }

    .domain-item span:hover {
      background-color: #f7f8fe;
      background-image: url(attr(hover-icon));
    }

    /* .monster */
    .domain-item.ext7 {
      grid-template: repeat(var(--grid-ext7-rows), calc((var(--max-width) + var(--grid-rows) - var(--grid-ext7-rows)) / var(--grid-ext7-rows))) / repeat(var(--grid-ext7-cols), calc((var(--max-width) + var(--grid-cols) - var(--grid-ext7-cols)) / var(--grid-ext7-cols)));
    }
    .domain-item.monster span {
      font-size: .28rem;
    }
    .domain-item.monster span:last-child {
      grid-area: 4/1/5/4;
    }

    .btn {
      display: flex;
      align-items: center;
      justify-content: center;
      order: 1;
      flex: 1;
      border: 0 none;
      padding: 0;
      margin: 0;
      background: none;
      font-size: .6rem;
      font-family: inherit;
      font-weight: 200;
      cursor: pointer;
      color: #999;
      background-image: url(assets/images/Clipped.svg);
      background-size: cover;
      background-position: 50% 50%;
      -webkit-touch-callout: none;
      -webkit-user-select: none;
      -moz-user-select: none;
      -ms-user-select: none;
      user-select: none;
    }
    .btn:hover {
      color: #000;
      background-color: #f7f8fe;
    }
    .btn-prev {
      order: 1;
    }
    .btn-next {
      order: 3;
    }

    .domain-detail a {
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 0 .15rem;
      height: 48px;
      font-size: .14rem;
      font-family: monospace;
      word-break: break-all;
      word-wrap: break-word;
    }
    .domain-detail a:hover {
      background-color: #f7f8fe;
    }


    .site-infos,footer {
      width: 100%;
      border-top: 1px solid #ccc;
    }
    .site-infos h2 {
      margin: 0;
    }
    .site-infos section {
      border-top: 1px solid #ccc;
      padding: 20px;
    }

    .slogan {
      font-family: SourceHanSerifCN;
      font-size: .6rem;
      text-align: center;
      padding: .5em 0;
    }
    .site-infos ul {
      margin: .3rem 0 0;
    }
    .site-infos li {
      border-top: 1px solid #e5e5e5;
      display: flex;
      align-items: center;
      padding: 15px 0;
    }
    .site-infos li:first-child {
      border: 0 none;
    }

    .site-infos .links li {
      justify-content: space-between;
    }
    .about h2 {
      margin: 0 0 .3rem;
    }
    .tools img {
      width: .8rem;
      margin-right: .15rem;
    }
    .tools h3 {
      font-size: .24rem;
      margin: 0;
    }

    article p {
      color: #878b99;
      margin: .66em 0 0;
    }

    .links span {
      color: #878b99;
    }

    .copyright {
      display: flex;
      justify-content: center;
      padding: 15px 0;
    }
    .copyright a {
      display: block;
      width: 32px;
      height: 32px;
      overflow: hidden;
      color: transparent;
      background-image: url(assets/images/boring.studio.ico.svg);
      background-size: cover;
      background-position: 50% 50%;
      background-repeat: no-repeat;
    }

    @media screen and (min-width:750px) {
      html {
        font-size: 100px;
      }
    }
    @media (orientation: portrait) or (max-width:1280px) {
      .btn .txt {
        display: block;
        overflow: hidden;
        width: 0;
        height: 0;
        border-width: 8px 16px 8px 0;
        border-style: dashed solid dashed dashed;
        border-color: transparent #aaa transparent transparent;
      }
      .btn-next .txt {
        transform: scaleX(-1);
      }
    }
    @media (orientation: portrait) and (max-width:900px) {
      .btn {
        position: absolute;
        left: 0;
        top: 0;
        width: 60px;
        height: 60px;
        background: #f7f8fe;
        border-radius: 100%;
        margin: auto auto auto 10px;
        right: 0;
        bottom: 0;
        z-index: 3;
      }
      .btn-next {
        margin: auto 10px auto auto;
      }
    }
    @media (orientation: portrait) and (max-width:750px) {
      html {
        --max-width: 90vw;
      }
      .domains .inner {
        order: 1;
      }

      .btn {
        position: absolute;
        left: 0;
        top: 0;
      }
    }

  </style>
</head>
<body>
<h1>Boring Domains</h1>
<div class="wrap navigation">
  <nav class="inner">
    <a href="/#about" title="The Boring Stuido">About</a>
    <a href="/#tools" title="What's a boring domain?">Tools</a>
    <a href="/#links" title="What's a boring domain?">Links</a>
    <a href="" title="Add your boring domains">Submit</a>
  </nav>
</div>

<div class="wrap domains">
  <div class="inner swiper">
    <ul class="domain-list swiper-wrapper">
<?php
$domainItemHtml = '';
foreach($data['domains'] as $index => $subdata) {
  $domainItemName = $subdata['name'];
  $domainItemDesc = $subdata['description'];
  $domainItemArr = array_reverse(explode('.', $domainItemName));
  $domainItemSub = $domainItemArr[1];
  $domainItemExt = $domainItemArr[0];
  if( $domainItemExt == $domainExt ) {
    $initialSlide = $index;
  };
  $domainItemLen = mb_strlen($domainItemExt);
  $domainItemHtml .= '<li class="domain-item swiper-slide '. $domainItemExt .' ext'. $domainItemLen .'">';
  foreach(str_split($domainItemSub,$domainItemLen) as $index => $domainItemSplit) {
    $domainItemHtml .= '<span data-img="'. $domainItemExt .'" data-id="'. $index .'">'. $domainItemSplit .'</span>';
  };
  $domainItemHtml .= '<span desc="'. $domainItemDesc .'">.'. $domainItemExt .'</span>';
  $domainItemHtml .= '</li>' . PHP_EOL;
}
echo $domainItemHtml
?>
    </ul>
  </div>
  <button class="btn btn-prev"><span class="txt">PREV</span></button>
  <button class="btn btn-next"><span class="txt">NEXT</span></button>
</div>

<div class="wrap domain-detail">
  <div class="inner">
    <a class="url" href="">https://fanfanfanfanfanfanfanfanfanfanfanfanfanfanfanfanfanfanfanfanfan.fan/</a>
  </div>
</div>



<div class="wrap site-infos">
  <div class="inner">
    <div class="slogan"><?php echo $siteDescription ?></div>
    <section id="about" class="about">
      <h2>What's a boring domain?</h2>
      <p>Four attributes of boring domain: <strong>hard to remember</strong>, <strong>worthless</strong>, <strong>meaningless</strong>, and <strong>the only use to renewal</strong>.</p>
      <p>If your domain name has these four attributes, please <a href="">submit</a>. </p>
    </section>
    <section id="tools" class="tools">
      <h2>Tools</h2>
      <ul>
<?php
$toolsHtml = '';
foreach($data['tools'] as $index => $tools) {
  $toolName = $tools['name'];
  $toolDesc = $tools['description'];
  $toolUrl = $tools['url'];
  $toolImg = $tools['img'];
  $toolsHtml .= '<li><img src="./assets/images/'. $toolImg .'" alt="'. $toolName .'"><article><h3><a href="'. $toolUrl .'" target="_blank">'. $toolName .'</a></h3><p>'. $toolDesc .'</p></article></li>'. PHP_EOL;
}
echo $toolsHtml;
?>
      </ul>
    </section>
    <section id="links" class="links">
      <h2>Links</h2>
      <ul>
<?php
$linksHtml = '';
foreach($data['links'] as $index => $links) {
  $linkName = $links['name'];
  $linkDesc = $links['description'];
  $linkUrl = $links['url'];
  $linksHtml .= '<li><a href="'. $linkUrl .'" target="_blank">'. $linkName .'</a><span>'. $linkDesc .'</span></li>'. PHP_EOL;
}
echo $linksHtml
?>
      </ul>
    </section>
  </div>
</div>

<footer class="wrap">
  <div class="inner">
    <div class="copyright">
      <a href="https://boring.studio/" title="The Boring Studio" target="_blank">The Boring Studio</a>
    </div>
  </div>
</footer>


<script>
  $(function(){
    $('[data-img]').hover(function(){
      var imgCate = $(this).data('img');
      var imgId = $(this).data('id');
      $(this).append('<img src="./assets/images/'+imgCate+'/'+imgId+'.svg"/>')
    },
    function(){
      $('img',this).remove();
    })
  })
  const swiper = new Swiper('.swiper', {
    direction: 'horizontal',
    loop: true,
    initialSlide: <?php echo $initialSlide ?>,
    navigation: {
      nextEl: ".btn-next",
      prevEl: ".btn-prev",
    },
    on: {
      slideChange: function () {
        // console.log(this)
        var obj = this.slides[this.activeIndex];
        var currentDomain = obj.innerText.replace(/[\r\n]/g,"").toLowerCase();
        var currentDomainLink = '<a href="https://' + currentDomain + '/" target="_blank">'+ currentDomain +'</a>'
        document.querySelector('.domain-detail .inner').innerHTML = currentDomainLink;
        // console.log(currentDomain);
      },
    }
  });
</script>
</body>
</html>