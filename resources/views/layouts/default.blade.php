<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" href="/logo_new.ico" type="image/x-icon">
	<title>@yield('title', 'Default Title')</title>
<meta name="csrf-token" content="{{ csrf_token() }}">
	
	
	<link rel="stylesheet" href="{{ asset('css/fancybox.css') }}">
  <link rel="stylesheet" href="{{ asset('lib/animate/animate.min.css') }}">
	<link rel="stylesheet" href="{{ asset('css/swiper-bundle.min.css') }}">
	<link rel="stylesheet" href="{{ asset('css/npm/bootstrap5.3/distcss/bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ asset('css/npm/bootstrap-icons/bootstrap-icons.css') }}">
	<link rel="stylesheet" href="{{ asset('css/style.css?v.1.000012') }}">
  <link rel="stylesheet" href="{{ asset('css/style_template.css?v.1.000012157') }}">
	<link rel="stylesheet" href="{{ asset('css/responsive.css?v.1.0000151') }}">
	
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
  <!--<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css">-->
  
 <!-- <link href="https://fonts.googleapis.com/css?family=Barlow+Condensed&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500&family=Poppins:wght@200;600;700&display=swap" rel="stylesheet">-->

</head>
<script src="{{ asset('js/vue.global.prod.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('js/fancybox.umd.js') }}"></script>
<script src="{{ asset('js/swiper-bundle.min.js') }}"></script>
<script src="{{ asset('axios/dist/axios.min.js') }}"></script>
<script src="{{ asset('chars/loader.js') }}"></script>
<!--<script src="{{ asset('js/vue-router.global.js') }}"></script>-->

<body>

  <main id="app">
	
@auth

<div class="modal fade" id="texteditmodal" tabindex="-1" aria-labelledby="texteditmodallabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="texteditmodallabel">Edit text</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <label for="editFormControlTextarea10" class="form-label">Text</label>
          <textarea class="form-control" id="editFormControlTextarea10" rows="10" v-model="text" placeholder="Text..." maxlength="50000">
            
          </textarea>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button :disabled='isDisabled' @click="update_text" type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

@endauth



  <div :class="{ bgprimary1: not_main_page }" class="container-fluid" style="padding-right: 0px !important; position: sticky;top: 0;z-index: 1020;">
    <div class="container margin-nav">
            <nav class="custom-navbar navbar navbar-expand-lg navbar-light p-0">
                <a href="#" class="navbar-brand">
                    <h2 class="text-white"><img class="logo_navbar" src="/images_folder/logo/logo_main_white_final.png"></h2>
                </a>
                <button type="button" class="navbar-toggler ms-auto me-0" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="navbar-nav ms-auto">
                        <a href="/" class="nav-item nav-link active custom-font-navlink">Главная</a>
                        <a href="/market" class="nav-item nav-link active custom-font-navlink">Товары</a>
                        <a href="/posts" class="nav-item nav-link active custom-font-navlink">Посты</a>
                        <a href="/gallery" class="nav-item nav-link active custom-font-navlink">Галерея</a>
                        <a href="/about" class="nav-item nav-link active custom-font-navlink">О нас</a>
                        <a href="/contact" class="nav-item nav-link active custom-font-navlink">Контакты</a>

                      @auth
                        @if (!Auth::user()->is_locked)
                        <li class="nav-item">
                          <a style="cursor:pointer;" class="nav-link" data-bs-toggle="modal" data-bs-target="#ResetPasswordModal">Change pass</a>
                        </li>
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Admin</a>
                            <div class="dropdown-menu bg-light mt-2">
                                <a href="/all-users" class="dropdown-item">Пользователи</a>
                                <a href="/register" class="dropdown-item">Добавить нового пользователя</a>
                                
                                <a href="/add-new-image" class="dropdown-item">Upload new image</a>
                            
                            </div>
                        </div>


                        
                       
                          
                        <form action="{{ route('logout') }}" method="POST">
                          @csrf
                          <button type="submit" class="nav-item nav-link">Выйти</button>
                        </form>

                        @else
                        <a href="#" class="dropdown-item">Your account is locked</a>
                        @endif
                        @endauth
                    </div>
                </div>
            </nav>
        </div>
  </div>



  <div class="offcanvas offcanvas-end offcanvas-nav" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
  <div class="offcanvas-header px-4" style="margin-top: 15px;">
    <h5 id="offcanvasRightLabel"><img class="logo_navbar" src="/images_folder/logo/logo_main_white_final.png"></h5>
    <button type="button" class="btn-close text-reset text-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>

  </div>
  <div class="offcanvas-body offcanvas-li px-4">
    <a href="/" class="nav-item nav-link active">Главная</a>
    <a href="/market" class="nav-item nav-link">Товары</a>
    <a href="/posts" class="nav-item nav-link">Посты</a>
    <a href="/gallery" class="nav-item nav-link">Галерея</a>
    <a href="/about" class="nav-item nav-link active">О нас</a>
    <a href="/contact" class="nav-item nav-link active">Контакты</a>


                            @auth
                        @if (!Auth::user()->is_locked)
                        <li class="nav-item">
                          <a style="cursor:pointer;" class="nav-link" data-bs-toggle="modal" data-bs-target="#ResetPasswordModal">Change pass</a>
                        </li>
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Admin</a>
                            <div class="dropdown-menu bg-light mt-2">
                                <a href="/all-users" class="dropdown-item">Пользователи</a>
                                <a href="/register" class="dropdown-item">Добавить нового пользователя</a>
                                
                                <a href="/add-new-image" class="dropdown-item">Upload new image</a>
                            
                            </div>
                        </div>


                        
                       
                          
                        <form action="{{ route('logout') }}" method="POST">
                          @csrf
                          <button type="submit" class="nav-item nav-link">Выйти</button>
                        </form>

                        @else
                        <a href="#" class="dropdown-item">Your account is locked</a>
                        @endif
                        @endauth
  </div>
</div>




<div class="offcanvas offcanvas-top offcanvas-nav offcanvas-custom-height shadow" tabindex="-1" id="offcanvasTop" aria-labelledby="offcanvasTopLabel">
    <div class="offcanvas-header container px-4 px-md-3">
    <h5 id="offcanvasRightLabel"><img class="logo_navbar" src="/images_folder/logo/logo_main_white_final.png"></h5>
    <button type="button" class="btn-close text-reset text-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>

  </div>
  <div class="offcanvas-body">
    <div class="container">
         <div class="row">
        <div class="col-12">
            <h5 class="mb-4">Вы можете связаться с нами:</h5>
        </div>
        <div class="col-md-4 col-12 mb-4 mb-md-0">
            <a href="tel:79259130514"><i class="fa fa-phone-alt me-3"></i>+7 (925) 913-05-14</a>
        </div>
        <div class="col-md-4 col-12 mb-4 mb-md-0">
            <a href="mailto:mmsk04@yandex.ru"><i class="fa fa-envelope me-3"></i>mmsk04@yandex.ru</a>
        </div>
        <div class="col-md-4 col-12">
            <p><a href="https://wa.me/79259130514" target="_blank"><i class="fa-brands fa-whatsapp me-3"></i>Написать WhatsApp</a></p>
        </div>
            
        
    </div>
    </div>
   
  </div>
</div>
		
		
	<!--	<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
      	@yield('header')

        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="{{ route('home') }}">Home</a>
        </li>

        @guest
        <li class="nav-item">
          <a class="nav-link" href="{{ route('show.login') }}">Login</a>
        </li>
         <li class="nav-item">
          <a class="nav-link" href="{{ route('show.register') }}">Register</a>
        </li>
        @endguest


        <li class="nav-item">
            <a class="nav-link" href="/contact">Contact</a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="/gallery">Gallery</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/posts">Posts</a>
          </li>

       

        @auth
        	@if (!Auth::user()->is_locked)
	        <li class="nav-item">
	          <a class="nav-link">Hi there, {{ Auth::user()->name }}</a>
	        </li>

	        <li class="nav-item">
	          <a style="cursor:pointer;" class="nav-link" data-bs-toggle="modal" data-bs-target="#ResetPasswordModal">Change pass</a>
	        </li>
          @admin
            <li class="nav-item">
              <a class="nav-link" href="/all-users">Users</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/register">Add new user</a>
            </li>
             <li class="nav-item">
              <a class="nav-link" href="/add-new-image">Upload img</a>
            </li>
          @endadmin

	        <li class="nav-item">
	        	
	        		<form action="{{ route('logout') }}" method="POST" class="m-0">
	        			@csrf
	        			<button type="submit" class="btn">Logout</button>
	        		</form>
	        	
	        </li>
	        @else
		        <li class="nav-item">
		            <span class="nav-link text-danger">Your account is locked.</span>
		        </li>
            <li class="nav-item">
            
              <form action="{{ route('logout') }}" method="POST" class="m-0">
                @csrf
                <button type="submit" class="btn">Logout</button>
              </form>
            
          </li>
		    @endif
        @endauth
        
      </ul>
    </div>
  </div>
</nav>-->



	@yield('maincontent')



<footer>
	@yield('footer')
	

	<div class="container-fluid bg-primary-features footer">
        <div class="container pb-5">
            <div class="row g-5">
                <div class="col-md-6 col-lg-3" data-wow-delay="0.1s">
                    <a href="index.html" class="d-inline-block mb-3">
                        <h1 class="text-primary"><img class="logo_footer" src="/images_folder/logo/logo_main_black_final.png"></h1>
                    </a>
                    <p class="mb-0 footer_text-logo">Мы всегда заботимся о наших клиентах, делаем все качественно</p>
                </div>
                <div class="col-md-6 col-lg-3 wow fadeIn" data-wow-delay="0.3s">
                    <h5 class="mb-4">Контакты</h5>
                    <p><i class="fa fa-map-marker-alt me-3"></i>Московская область, г. Королёв, ул. Школьная, 19</p>
                    <p><i class="fa fa-phone-alt me-3"></i>+7 (925) 913-05-14</p>
                    <p><i class="fa fa-envelope me-3"></i>mmsk04@yandex.ru</p>
                    <p><a href="https://wa.me/79259130514" target="_blank"><i class="fa-brands fa-whatsapp me-3"></i>Написать WhatsApp</a></p>
                    <!--<div class="d-flex pt-2">
                        <a class="btn btn-square me-1" href=""><i class="fa-brands fa-vk"></i></a>
                        <a class="btn btn-square me-1" href="https://wa.me/79259130514"><i class="fa-brands fa-whatsapp"></i></a>
                    </div>-->
                </div>
                <div class="col-md-6 col-lg-3 " data-wow-delay="0.5s">
                    <h5 class="mb-4">Страницы</h5>
                    <a class="btn btn-link" href="/">Главная</a>
                    <a class="btn btn-link" href="/market">Товары</a>
                    <a class="btn btn-link" href="/posts">Посты</a>
                    <a class="btn btn-link" href="/gallery">Галерея</a>
                    <a class="btn btn-link" href="/about">О нас</a>
                    <a class="btn btn-link" href="/contact">Контакты</a>
                </div>
                <div class="col-md-6 col-lg-3 wow fadeIn" data-wow-delay="0.7s">
                    <h5 class="mb-4">Мы в социальных сетях</h5>
                    <a class="btn btn-link" href="#">Авито</a>
                    <a class="btn btn-link" href="#">Яндекс Услуги</a>
                </div>
            </div>
        </div>

</footer>

<div class="modal fade" id="ResetPasswordModal" tabindex="-1" aria-labelledby="ResetPasswordModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ResetPasswordModalLabel">Reset password</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        @verbatim
			 <form class="row g-3 needs-validation" novalidate @submit.prevent="ChangePassword">

    <h2>Log in to your account</h2>

    <div class="col-12">
        <label for="validationCurrentPassword" class="form-label">Current Password</label>
        <input :disabled="isDisabled" type="password" class="form-control" id="validationCurrentPassword" v-model="current_password" 
               required @input="validateField($event)">
        <div class="invalid-feedback">
            Password is required.
        </div>
    </div>

    <div class="mb-3">
      <label for="password" class="form-label">Password:</label>
      <input @input="validatePasswords" minlength="8" maxlength="250" v-model="password" id="password" class="form-control" type="password" required :class="{'is-invalid': submitted && password.length < 8}">
      <div id="password_text" class="invalid-feedback">Password must be at least 8 characters.</div>
    </div>

    <div class="mb-3">
      <label for="password_confirmation" class="form-label">Confirm password:</label>
      <input @input="validatePasswords" minlength="8" maxlength="250" v-model="password_confirmation" id="password_confirmation" class="form-control" type="password" required :class="{'is-invalid': submitted && password !== password_confirmation}">
      <div id="password_confirmation_text" class="invalid-feedback">Passwords do not match.</div>
    </div>

    <div class="col-12">
    <button :disabled="isDisabled" type="submit" class="btn btn-primary mt-2">
        <span v-if="isDisabled" class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
        {{ isDisabled ? "Loading..." : "Change password" }}
    </button>

    <div class="col-12">
        <ul v-if="errors.length" class="px-4">
            <li v-for="error in errors" :key="error" class="text-danger">
                {{ error }}
            </li>
        </ul>
    </div>
</form>


	        @endverbatim
      </div>
     <!-- <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Reset password</button>
      </div>-->
    </div>
  </div>
</div>		
	

</body>
</html>

<script src="{{ asset('js/main.js?v1.000121') }}"></script>