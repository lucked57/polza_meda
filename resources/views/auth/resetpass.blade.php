@extends('layouts.default')

@section('maincontent')

<div class="container">
	<div class="row">
		<div class="col-md-4">
			@verbatim
			 <form class="row g-3 needs-validation" novalidate @submit.prevent="ResetPass">

    <h2>Reset password</h2>

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
    <button :disabled="isDisabled" type="submit" class="btn btn-primary mt-2">
        <span v-if="isDisabled" class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
        {{ isDisabled ? "Loading..." : "Send" }}
    </button>
</div>

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