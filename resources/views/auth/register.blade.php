@extends('layouts.default')

@section('maincontent')



<!--<div class="container">
	<div class="row">
		<div class="col-md-4">
			<form action="{{ route('register') }}" method="POST">
				@csrf
				<h2>Register for an account</h2>

				<label for="name">Name:</label>
				<input class="form-control" type="text" name="name" required value="{{ old('name') }}">

				<label for="email">Email:</label>
				<input class="form-control" type="email" name="email" required value="{{ old('email') }}">

				<label for="password">Password:</label>
				<input class="form-control" type="password" name="password" required>

				<label for="password_confirmation">Confirm password:</label>
				<input class="form-control" type="password" name="password_confirmation" required>

				<button type="submit" class="btn btn-primary mt-3">Register</button>

				@if ($errors->any())
					<ul class="px-4 py-2 big-red-100">
						@foreach ($errors->all() as $error)
						<li class="my-2 text-red-500">{{ $error }}</li>
						@endforeach
					</ul>
				@endif
			</form>
		</div>
	</div>
</div>-->
@verbatim

<div class="container my-5 py-5">
    <div class="row">
      <div class="col-md-4">
        
      </div>
        <div class="col-md-4">
            <form class="needs-validation" novalidate @submit.prevent="registerUser">
    <h2>Register for an account</h2>

    <div class="mb-3">
      <label for="name" class="form-label">Name:</label>
      <input @input="validateField($event)" v-model="fullname" id="name" maxlength="250" class="form-control" type="text" required :class="{'is-invalid': submitted && !fullname}">
      <div class="invalid-feedback">Please provide a valid name.</div>
    </div>

    <div class="mb-3">
      <label for="email" class="form-label">Email:</label>
      <input @input="validateField($event)" v-model="email" id="email" maxlength="250" class="form-control" type="email" required :class="{'is-invalid': submitted && !isValidEmail}">
      <div class="invalid-feedback">Please provide a valid email.</div>
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
    <button :disabled="isDisabled" type="submit" class="btn btn-dark mt-2">
        <span v-if="isDisabled" class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
        {{ isDisabled ? "Loading..." : "Register" }}
    </button>
</div>

    <ul v-if="errors.length" class="mt-3 text-danger">
      <li v-for="error in errors" :key="error">{{ error }}</li>
    </ul>
  </form>

        </div>
    </div>
</div>

            @endverbatim

@endsection