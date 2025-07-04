@extends('layouts.default')

@section('title', 'Контакты')

@section('maincontent')

<div class="bggallery">

    <div class="container mb-5">
         <div class="row py-5">
            <div class="col-md-6 d-flex align-items-stretch">
                    <div class="feature-item position-relative bg-primary-features shadow-primary text-center p-3 contacts" style="width:100%;">
                        <div class="border-card py-5 px-3">
                            <h5 class="text-white mb-0 main-text mb-4">Наши контакты для связи:</h5>

                           <a href="tel:79259130514" class="text-white"><i class="fa fa-phone-alt me-3"></i>Телефон: +7 (925) 913-05-14</a> <br> <br>

                           <a href="mailto:mmsk04@yandex.ru" class="text-white"><i class="fa fa-envelope me-3"></i>Почта: mmsk04@yandex.ru</a> <br> <br>


                           <a href="https://wa.me/79259130514" class="text-white"><i class="fa-brands fa-whatsapp me-3"></i>Написать WhatsApp +7 (925) 913-05-14</a> <br> <br>


                           <p class="mb-4 text-white"><i class="fa-solid fa-location-dot me-3"></i> Адрес: Фряново, Московская Область</p>


                        </div>
                    </div>
                </div>

                <div class="col-md-6 d-flex align-items-stretch">
                    <div class="position-relative bg-primary-features shadow-primary text-center p-3 contacts mt-md-0 mt-3 border-card" style="width:100%; border-radius: 15px;">
                        
                            <iframe src="https://yandex.ru/map-widget/v1/?um=constructor%3Afa850e2c31aa269fdd4948a63ded97e397ee6eefaab7f1117182b9835b79e8d3&amp;source=constructor" width="100%" height="440" frameborder="0"></iframe>
              
                    </div>
                        </div>
      
            
        
    </div>
    </div>

</div>

@endsection

