@extends('layouts.default')

@section('title', 'Polza меда')

@section('maincontent')
	<!-- main page start-->

<div class="bg-primary hero-header mb-5 main-page-bg">
        <div class="container">
            <div class="row g-5 align-items-center">
                <div class="col-lg-6 text-center text-lg-start">
                    <h3 class="fw-light text-warning text-bold-lg">Натуральный продукт</h3>
                    <h1 class="display-4 text-white text-bold-lg">Свежий <span class="fw-light text-warning">МЁД</span> для улучшения здоровья</h1>
                    <p class="text-white mb-4 main-text">
                        Наш мёд подойдет для всех возрастов, а также понравится всем желающим
                    </p>
                    <a data-bs-toggle="offcanvas" data-bs-target="#offcanvasTop" aria-controls="offcanvasTop" class="btn btn-warning btn-lg py-2 px-4 me-3 main-btn mb-md-5">Заказать +7 (925) 913-05-14</a>
                </div>
                <div class="col-lg-1"></div>
                <div class="col-lg-4 text-center">
                    <img class="img-fluid animated pulse infinite img-primary mb-md-5" src="images_folder/product/product_v2.png" alt="">
                </div>
            </div>
        </div>
       
            <svg class="svg-main-page" xmlns:xlink="http://www.w3.org/1999/xlink" id="wave" style="transform:rotate(0deg); transition: 0.3s" viewBox="0 0 1440 140" version="1.1" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="sw-gradient-0" x1="0" x2="0" y1="1" y2="0"><stop stop-color="#F7A823" offset="0%"/><stop stop-color="#F7A823" offset="100%"/></linearGradient></defs><path style="transform:translate(0, 0px); opacity:1" fill="url(#sw-gradient-0)" d="M0,98L17.1,95.7C34.3,93,69,89,103,81.7C137.1,75,171,65,206,67.7C240,70,274,84,309,95.7C342.9,107,377,117,411,119C445.7,121,480,117,514,109.7C548.6,103,583,93,617,93.3C651.4,93,686,103,720,107.3C754.3,112,789,112,823,93.3C857.1,75,891,37,926,39.7C960,42,994,84,1029,98C1062.9,112,1097,98,1131,84C1165.7,70,1200,56,1234,58.3C1268.6,61,1303,79,1337,93.3C1371.4,107,1406,117,1440,109.7C1474.3,103,1509,79,1543,77C1577.1,75,1611,93,1646,93.3C1680,93,1714,75,1749,56C1782.9,37,1817,19,1851,14C1885.7,9,1920,19,1954,35C1988.6,51,2023,75,2057,70C2091.4,65,2126,33,2160,30.3C2194.3,28,2229,56,2263,58.3C2297.1,61,2331,37,2366,37.3C2400,37,2434,61,2451,72.3L2468.6,84L2468.6,140L2451.4,140C2434.3,140,2400,140,2366,140C2331.4,140,2297,140,2263,140C2228.6,140,2194,140,2160,140C2125.7,140,2091,140,2057,140C2022.9,140,1989,140,1954,140C1920,140,1886,140,1851,140C1817.1,140,1783,140,1749,140C1714.3,140,1680,140,1646,140C1611.4,140,1577,140,1543,140C1508.6,140,1474,140,1440,140C1405.7,140,1371,140,1337,140C1302.9,140,1269,140,1234,140C1200,140,1166,140,1131,140C1097.1,140,1063,140,1029,140C994.3,140,960,140,926,140C891.4,140,857,140,823,140C788.6,140,754,140,720,140C685.7,140,651,140,617,140C582.9,140,549,140,514,140C480,140,446,140,411,140C377.1,140,343,140,309,140C274.3,140,240,140,206,140C171.4,140,137,140,103,140C68.6,140,34,140,17,140L0,140Z"/></svg>
       
    </div>

    <div class="container-fluid py-5">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-4">
                    <div class="feature-item position-relative bg-primary-features shadow-primary text-center p-3">
                        <div class="border py-5 px-3">
                            <i class="fa fa-leaf fa-3x text-dark mb-4"></i>
                            <h5 class="text-white mb-0 main-text">100% Натуральный</h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="feature-item position-relative bg-primary-features shadow-primary text-center p-3">
                        <div class="border py-5 px-3">
                            <i class="fa-solid fa-ruble-sign fa-3x text-dark mb-4"></i>
                            <h5 class="text-white mb-0 main-text">Доступная цена</h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="feature-item position-relative bg-primary-features shadow-primary text-center p-3">
                        <div class="border py-5 px-3">
                            <i class="fa-solid fa-heart fa-3x text-dark mb-4"></i>
                            <h5 class="text-white mb-0 main-text">Полезный</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="container-fluid py-5">
        <div class="container">
            <div class="row g-5"> <!--align-items-center-->
                <div class="col-lg-6 py-lg-3">


                	
                		@auth
                		<div>


						<div class="progress my-2" id="progress_wrapper_{{ $images[0]->id }}" style="display:none;">
						  <div
						    class="progress-bar bg-dark"
						    id="progress_bar_{{ $images[0]->id }}"
						    role="progressbar"
						    style="width: 0%;"
						    aria-valuenow="0"
						    aria-valuemin="0"
						    aria-valuemax="100"
						  >0%</div>
						</div>



                        <label class="upload-label" :for="'file_img_def_{{ $images[0]->id }}'">
                            <i class="fa-solid fa-image"></i> change img
                        </label>

                        
                        <div v-if="!page_is_loading">
                            <p :id="'loadingcomplete_img_def_{{ $images[0]->id }}'"></p>
                        </div>

                     
                        <div style="width: 50px !important;">
                            <input 
                                @change="image_changed_images({{ $images[0]->id }})" 
                                :id="'file_img_def_{{ $images[0]->id }}'" 
                                class="upload-input-img" 
                                type="file" 
                                accept="image/*" 
                            />
                        </div>
                    </div>
                    @endauth
                	
                    
                    <img class="img-fluid img-primary-main shadow-primary-lg" src="{{ $images[0]->imagename }}">
                </div>
                <div class="col-lg-6">

                    <h1 class="text-white text-bold-m"><img class="logo_in_text" src="images_folder/logo/logo_circle.png"> <span class="fw-light text-dark">Наша история</span></h1>
                    @auth
					<button
					              type="button"
					              class="btn btn-primary"
					              data-bs-toggle="modal"
					              data-bs-target="#texteditmodal"
					              data-id="<?= htmlspecialchars($text[0]['id'], ENT_QUOTES, 'UTF-8') ?>"
					              data-text="<?= htmlspecialchars($text[0]['text'], ENT_QUOTES, 'UTF-8') ?>"
					              @click="change_text($event.currentTarget.dataset.id, $event.currentTarget.dataset.text)"
					            >
					              <i id="<?= htmlspecialchars($text[0]['id']) ?>" class="fa-solid fa-pen-to-square my-3"></i> Edit text
					            </button>
					                        @endauth
                    <p class="mb-4 main-text">
                       <?=$text[0]['text']?>
                    </p>
                    <p class="mb-4 main-text">
                         Тогда у нас завязались теплые отношениями с потомственными пчеловодами. Одно было печально, медовые ярмарки проходили несколько раз в год, и по окончании, как говорится, «цирк уезжал».
                    </p>
                    <a href="/about" class="btn btn-warning btn-main btn-lg py-2 px-4 me-3">Подробнее</a>
                </div>
            </div>
        </div>
    </div>



    <div class="container-fluid deal bg-primary my-5 py-5">
        <div class="container py-5">
            <div class="row g-5 align-items-center">
                <div class="col-lg-1"></div>
                <div class="col-lg-4 text-center" >
                    <img class="img-fluid img-primary animated pulse infinite" src="images_folder/product/product_main_page.png">
                </div>
                <div class="col-lg-1"></div>
                <div class="col-lg-6" >
                    <div class="bg-white feature-item bg-primary-features shadow-primary text-center p-4">
                        <div class="border p-4">
                            <p><img class="logo_in_card" src="images_folder/logo/logo_circle.png"></p>
                            <h4 class="fw-bold text-uppercase mb-4 text-white">Гречишный мёд</h4>
                            <h5 class="text-white">Выберите наиболее подходящий вариант:</h5>
                            <div class="row px-md-5 mb-5">
                                <div class="col-4">
                                    <h1 class="display-4 text-primary">0.5 <small class="text-in-h1">л.</small> </h1>
                                    <h5 class="text-white">400 руб.</h5>
                                </div>
                                <div class="col-4">
                                    <h1 class="display-4 text-primary">1 <small class="text-in-h1">л.</small> </h1>
                                    <h5 class="text-white">700 руб.</h5>
                                </div>
                                <div class="col-4">
                                    <h1 class="display-4 text-primary">2 <small class="text-in-h1">л.</small> </h1>
                                    <h5 class="text-white">1200 руб.</h5>
                                </div>
                            </div>
                            <h5 class="text-white">Мёд в стеклянной баночке</h5>
                            <p class="mb-4 text-white"><i class="fa-solid fa-location-dot"></i> Место сбора: Фряново, Московская Область</p>
                            <a data-bs-toggle="offcanvas" data-bs-target="#offcanvasTop" aria-controls="offcanvasTop" class="btn btn-primary py-2 px-4">Заказать</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- Feature Start -->
    <div class="container-fluid py-5">
        <div class="container">
            <div class="mx-auto text-center" data-wow-delay="0.1s" style="max-width: 600px;">
                <h1 class="text-white mb-3 text-bold-m" style="max-width: 600px;"><span class="fw-light text-dark">О нашем продукте</span></h1>
                <p class="mb-5 main-text">Почему клиенты выбирают именно наш мёд?</p>
            </div>
            <div class="row g-4 align-items-center advantages">
                <div class="col-lg-4">
                    <div class="row g-5">
                        <div class="col-12 d-flex">
                            <div class="btn-square rounded-circle border flex-shrink-0 card-advan">
                                <i class="fa fa-check fa-2x text-primary"></i>
                            </div>
                            <div class="ps-3">
                                <h5 class="main-text">Зрелый</h5>
                                <hr class="w-25 bg-primary my-2 main-text">
                                <span>Зрелый мед не содержит крахмал и сахарозу, а массовая доля воды в нем невысока. </span>
                            </div>
                        </div>
                        <div class="col-12 d-flex">
                            <div class="btn-square rounded-circle border flex-shrink-0 card-advan">
                                <i class="fa fa-check fa-2x text-primary"></i>
                            </div>
                            <div class="ps-3">
                                <h5>Без термообработки</h5>
                                <hr class="w-25 bg-primary my-2">
                                <span>Наш мед не подвергается подогреву и содержит более 15 важных ферментов и 100 полезных веществ, которые разрушаются при нагревании</span>
                            </div>
                        </div>
                        <div class="col-12 d-flex">
                            <div class="btn-square rounded-circle border flex-shrink-0 card-advan">
                                <i class="fa fa-check fa-2x text-primary"></i>
                            </div>
                            <div class="ps-3">
                                <h5>Некупажированный</h5>
                                <hr class="w-25 bg-primary my-2">
                                <span>Мы не продаем искусственные смеси разных сортов. Соотношение медоносов, использованных при его сборе, определяется природным инстинктом пчёл</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 text-center" data-wow-delay="0.1s">
                    <img class="img-fluid img-primary animated pulse infinite" src="images_folder/product/product_main_page.png">
                </div>
                <div class="col-lg-4 wow fadeIn" data-wow-delay="0.5s">
                    <div class="row g-5">
                        <div class="col-12 d-flex">
                            <div class="btn-square rounded-circle border flex-shrink-0 card-advan">
                                <i class="fa fa-check fa-2x text-primary"></i>
                            </div>
                            <div class="ps-3">
                                <h5>С лучших пасек</h5>
                                <hr class="w-25 bg-primary my-2">
                                <span>Наш мед собирается только на пасеках потомственных пчеловодов Алтая, Башкирии, Дальнего Востока, Кавказа и Киргизии, поэтому цена на него не может быть низкой</span>
                            </div>
                        </div>
                        <div class="col-12 d-flex">
                            <div class="btn-square rounded-circle border flex-shrink-0 card-advan">
                                <i class="fa fa-check fa-2x text-primary"></i>
                            </div>
                            <div class="ps-3">
                                <h5>Выберите подходящий вариант</h5>
                                <hr class="w-25 bg-primary my-2">
                                <span>Мы продаем мед в различных форм факторах (вы можете выбрать наиболее удобный вариат для себя)</span>
                            </div>
                        </div>
                        <div class="col-12 d-flex">
                            <div class="btn-square rounded-circle border flex-shrink-0 card-advan">
                                <i class="fa fa-check fa-2x text-primary"></i>
                            </div>
                            <div class="ps-3">
                                <h5>Доставка</h5>
                                <hr class="w-25 bg-primary my-2">
                                <span>Мы предлагаем уникальные сорта меда с потомственных пасек по выгодным ценам. Вам не придется никуда ехать – мы доставляем мед по всей Москве и 20км от Мкада </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Feature End -->


     <!-- How To Use Start -->
    <div class="container-fluid how-to-use bg-primary my-5 py-5">
        <div class="container text-white py-5">
            <div class="mx-auto text-center wow fadeIn" data-wow-delay="0.1s" style="max-width: 600px;">
                <h1 class="text-white mb-3"><span class="fw-light text-dark">Как происходит покупка и оплата</span> нашего меда</h1>
            </div>
            <div class="row g-5">
                <div class="col-lg-4 text-center wow fadeIn" data-wow-delay="0.1s">
                    <div class="btn-square rounded-circle border mx-auto mb-4" style="width: 120px; height: 120px;">
                        <i class="fa-solid fa-phone fa-3x text-dark"></i>
                    </div>
                    <h5 class="text-dark main-text">Свяжитесь с нами</h5>
                    <hr class="w-25 bg-light my-2 mx-auto">
                    <span class="main-text text-dark">Вы можете связаться по телефону +7 (925) 913-05-14 или написать на почту mmsk04@yandex.ru</span>
                </div>
                <div class="col-lg-4 text-center wow fadeIn" data-wow-delay="0.3s">
                    <div class="btn-square rounded-circle border mx-auto mb-4" style="width: 120px; height: 120px;">
                        <i class="fa-solid fa-truck fa-3x text-dark"></i>
                    </div>
                    <h5 class="text-dark main-text">Доставка</h5>
                    <hr class="w-25 bg-light my-2 mx-auto">
                    <span class="main-text text-dark">Мы доставляем мед по всей Москве и в 20км от МКАДА</span>
                </div>
                <div class="col-lg-4 text-center wow fadeIn" data-wow-delay="0.5s">
                    <div class="btn-square rounded-circle border mx-auto mb-4" style="width: 120px; height: 120px;">
                        <i class="fa-solid fa-wallet fa-3x text-dark"></i>
                    </div>
                    <h5 class="text-dark main-text">Оплата</h5>
                    <hr class="w-25 bg-light my-2 mx-auto">
                    <span class="main-text text-dark">После доставки производиться оплата</span>
                </div>
            </div>
        </div>
    </div>
    <!-- How To Use End -->

	<!-- main page end -->
	



@endsection

