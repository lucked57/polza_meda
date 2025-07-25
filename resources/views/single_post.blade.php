@extends('layouts.default')

@section('title', $post['title'])

@section('maincontent')
<div>
<div class="bg-primary hero-header mb-5 main-page-bg post-header" style="background: url(/<?=$post['main_img']?>) center center no-repeat, linear-gradient(to right,#BD480E 0%,#C46F2B 100%);background-size: cover;">
        <div class="container">
            <div class="row g-5 align-items-center">
                <div class="col-lg-12 text-center">
                    <h1 class="display-4 text-white text-bold-lg"><?=$post['title']?></h1>
                </div>
            </div>
        </div>
       
            <svg class="svg-main-page" xmlns:xlink="http://www.w3.org/1999/xlink" id="wave" style="transform:rotate(0deg); transition: 0.3s" viewBox="0 0 1440 140" version="1.1" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="sw-gradient-0" x1="0" x2="0" y1="1" y2="0"><stop stop-color="#F7A823" offset="0%"/><stop stop-color="#F7A823" offset="100%"/></linearGradient></defs><path style="transform:translate(0, 0px); opacity:1" fill="url(#sw-gradient-0)" d="M0,98L17.1,95.7C34.3,93,69,89,103,81.7C137.1,75,171,65,206,67.7C240,70,274,84,309,95.7C342.9,107,377,117,411,119C445.7,121,480,117,514,109.7C548.6,103,583,93,617,93.3C651.4,93,686,103,720,107.3C754.3,112,789,112,823,93.3C857.1,75,891,37,926,39.7C960,42,994,84,1029,98C1062.9,112,1097,98,1131,84C1165.7,70,1200,56,1234,58.3C1268.6,61,1303,79,1337,93.3C1371.4,107,1406,117,1440,109.7C1474.3,103,1509,79,1543,77C1577.1,75,1611,93,1646,93.3C1680,93,1714,75,1749,56C1782.9,37,1817,19,1851,14C1885.7,9,1920,19,1954,35C1988.6,51,2023,75,2057,70C2091.4,65,2126,33,2160,30.3C2194.3,28,2229,56,2263,58.3C2297.1,61,2331,37,2366,37.3C2400,37,2434,61,2451,72.3L2468.6,84L2468.6,140L2451.4,140C2434.3,140,2400,140,2366,140C2331.4,140,2297,140,2263,140C2228.6,140,2194,140,2160,140C2125.7,140,2091,140,2057,140C2022.9,140,1989,140,1954,140C1920,140,1886,140,1851,140C1817.1,140,1783,140,1749,140C1714.3,140,1680,140,1646,140C1611.4,140,1577,140,1543,140C1508.6,140,1474,140,1440,140C1405.7,140,1371,140,1337,140C1302.9,140,1269,140,1234,140C1200,140,1166,140,1131,140C1097.1,140,1063,140,1029,140C994.3,140,960,140,926,140C891.4,140,857,140,823,140C788.6,140,754,140,720,140C685.7,140,651,140,617,140C582.9,140,549,140,514,140C480,140,446,140,411,140C377.1,140,343,140,309,140C274.3,140,240,140,206,140C171.4,140,137,140,103,140C68.6,140,34,140,17,140L0,140Z"/></svg>
       
    </div>

    <div class="container mb-5 pb-5">
    	<h1 class="text-white text-bold-m"><img class="logo_in_text" src="/images_folder/logo/logo_circle.png"> <span class="fw-light text-dark"><?=$post['title']?></span></h1>
    	<p class="main-text"><?=$post['description']?></p>
    </div>

    </div>

@endsection