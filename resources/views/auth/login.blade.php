@extends('layouts.default')

@section('maincontent')

<div class="container">
	<div class="row my-5 py-5">
        <div class="col-md-4"></div>
		<div class="col-md-4">
			<!--<form action="{{ route('login') }}" method="POST">
				@csrf
				<h2>Log in to your account</h2>

				<label for="email">Email:</label>
				<input class="form-control" type="email" name="email" required value="{{ old('email') }}">

				<label for="password">Password:</label>
				<input class="form-control" type="password" name="password" required>
				<button type="submit" class="btn btn-primary mt-3">Log in</button>

				@if ($errors->any())
					<ul class="px-4 py-2 big-red-100">
						@foreach ($errors->all() as $error)
						<li class="my-2 text-red-500">{{ $error }}</li>
						@endforeach
					</ul>
				@endif
			</form>-->
			@verbatim
			 <form class="row g-3 needs-validation" novalidate @submit.prevent="loginUser">

    <h2 class="text-center">Log in to your account</h2>

    <div class="col-12">
        <label for="validationEmail" class="form-label">Email:</label>
        <input :disabled="isDisabled" type="email" class="form-control" id="validationEmail" v-model="email" 
               required @input="validateField($event)">
        <div class="valid-feedback">
            <!--Looks good!-->
        </div>
        <div class="invalid-feedback">
            Please enter a valid email.
        </div>
    </div>

    <div class="col-12">
        <label for="validationPassword" class="form-label">Password:</label>
        <input :disabled="isDisabled" type="password" class="form-control" id="validationPassword" v-model="password" 
               required @input="validateField($event)"> <!--@blur="validateField($event)"-->
        <div class="valid-feedback">
            <!--Looks good!-->
        </div>
        <div class="invalid-feedback">
            Password is required.
        </div>
    </div>

    <div class="col-12">
    <button :disabled="isDisabled" type="submit" class="btn btn-primary mt-2">
        <span v-if="isDisabled" class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
        {{ isDisabled ? "Loading..." : "Log in" }}
    </button>
    @endverbatim
    <a href="{{ route('show.resetpass') }}" type="button" class="btn btn-link">Reset password</a>
</div>
@verbatim

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
	</div>
</div>


@endsection