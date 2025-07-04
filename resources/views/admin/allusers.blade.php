@extends('layouts.default')

@section('title', 'Users')

@section('maincontent')

@admin

<div class="container my-5 py-5">
	<div class="row">
		<div class="col-12">
			<h1>All users</h1>
		</div>
		<div class="col-12">
                  <button @click="choose_mode = !choose_mode" type="button" class="btn btn-dark me-2">Choose</button>
                  <button :disabled='!choose_mode' @click="blocked_picked()" type="button" class="btn btn-success me-2">Blocked selected</button>
                  <button :disabled='!choose_mode' @click="unlock_picked()" type="button" class="btn btn-success">Unlocked selected</button>
               </div>
	</div>
	<div class="table-responsive mt-3">
	<table class="table table-borderless table-dark">
  		<thead>
	    <tr>
	      <th scope="col">Select</th>
	      <th scope="col">#</th>
	      <th scope="col">Email</th>
	      <th scope="col">Admin</th>
	      <th scope="col">Blocked</th>
	      <th scope="col">Email_verified_at</th>
	      <th scope="col">created_at</th>
	      <th scope="col">updated_at</th>
	      <th scope="col">failed_lockouts</th>
	    </tr>
	  </thead>
	  <tbody v-if="page_is_loading">
	    <tr>
	      <td>
	      	<div class="skeleton-loader"></div>
	      </td>
	      <td><div class="skeleton-loader"></div></td>
	      <td><div class="skeleton-loader"></div></td>
	      <td><div class="skeleton-loader"></div></td>
	      <td><div class="skeleton-loader"></div></td>
	      <td><div class="skeleton-loader"></div></td>
	      <td><div class="skeleton-loader"></div></td>
	      <td><div class="skeleton-loader"></div></td>
	      <td><div class="skeleton-loader"></div></td>
	    </tr>
	    <tr>
	      <td>
	      	<div class="skeleton-loader"></div>
	      </td>
	      <td><div class="skeleton-loader"></div></td>
	      <td><div class="skeleton-loader"></div></td>
	      <td><div class="skeleton-loader"></div></td>
	      <td><div class="skeleton-loader"></div></td>
	      <td><div class="skeleton-loader"></div></td>
	      <td><div class="skeleton-loader"></div></td>
	      <td><div class="skeleton-loader"></div></td>
	      <td><div class="skeleton-loader"></div></td>
	    </tr>
	  </tbody>
	  <tbody v-if="!page_is_loading">
	  	@verbatim
	  	<tr v-for="(item, index) in users_return">
	  		<td>
	  			<div v-if="choose_mode" class="form-check form-check-custom-form">
		    <input
		      class="form-check-input form-check-custom-a ms-1"
		      type="checkbox"
		      :id="'check_item_' + item.id"
		      :value="item.id"
		      @change="toggleSelection(item.id)"
		    />
		    <label class="form-check-label text-dark ms-1" :for="'check_item_' + item.id">
		     
		    </label>
		  </div>
	  		</td>
	  		<td>{{index + 1}}</td>
	  		<td>{{item.email}}</td>
	  		<td v-if="item.is_admin == 1">Admin</td>
	  		<td v-else>User</td>
	  		<td v-if="item.is_locked == 1">Blocked</td>
	  		<td v-else>Not blocked</td>
	  		<td v-if="item.email_verified_at == NULL">Not verified</td>
	  		<td v-else>{{item.email_verified_at}}</td>
	  		<td>{{item.created_at}}</td>
	  		<td>{{item.updated_at}}</td>
	  		<td>{{item.failed_lockouts}}</td>
	  	</tr>
	  	@endverbatim
	  </tbody>
	</table>
</div>
</div>

@endadmin

@endsection