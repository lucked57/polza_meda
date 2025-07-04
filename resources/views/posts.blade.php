@extends('layouts.default')

@section('title', 'Посты')

@section('maincontent')
<div class="bggallery pt-5">
<div class="container">
	<div class="row row-custom-margin">
		<div class="col-12">
			<h1 class="text-md-start text-center">Посты</h1>
		</div>
	

@auth

	@verbatim
<div class="modal modal-xl fade" id="update_post" tabindex="-1" aria-labelledby="update_post_label" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="update_post_label">Update post</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">


       <form class="needs-validation-update" novalidate @submit.prevent="UpdatePost('post')">
		 <h2>Upload Post</h2>
		 <div class="row mt-5 mb-3">
		 	<div class="col-lg-4">
		 		<div class="col-12">
		 			<label for="title_" class="form-label">Title:</label>
				      <input @input="validateField($event)" v-model="title" id="title_" minlength="3" maxlength="250" class="form-control" type="text" required :class="{'is-invalid': submitted && !title}" placeholder="Title...">
				      <div class="invalid-feedback">Please provide a valid title. Min 3 characters</div>
		 		</div>

		 		<div class="col-12">
		 			<label for="description_" class="form-label">Description:</label>
				      <textarea minlength="3" @input="validateField($event)" v-model="description" id="description_" maxlength="15000" class="form-control"  rows="5" v-model="text" placeholder="Description..." required :class="{'is-invalid': submitted && !description}">
				      	</textarea>

				      <div class="invalid-feedback">Please provide a valid description. Min 3 characters</div>
		 		</div>
			      
		 	</div>
		 	<div class="col-lg-8">
		 		<div class="col-lg-6">
				 <div class="form-group ">
				  <label class="upload-label" for="file_update">
				      <div v-if="post_image_upload_preview" class="upload-label-preview text-center" >
				        <img class="img-preview-pic" v-bind:src="post_image_upload_preview" /> 
				      </div>
				        <div v-if="!post_image_upload_preview" class="upload-label-preview text-center" >
				        <p class="pt-5">Upload image</p>
				    
				    </div>
				    
				  </label>
				<input
					  @change="imagechanged_update_post"
					  id="file_update"
					  class="upload-input-img form-control"
					  type="file"
					  accept="image/*"
					  :class="{'is-invalid': submitted && !post_image_upload}"
					/>
					<div class="invalid-feedback">Please upload an image.</div>

				  </div>

				  <div class="form-check form-switch mt-3" style="margin-left: 2.5rem;">
				  <input @click="show_more = !show_more" class="form-check-input" type="checkbox" id="flexSwitchCheckChecked10_">
				  <label class="form-check-label" for="flexSwitchCheckChecked10_">Show more pictures</label>
				</div>
				  </div>
		 	</div>
		 </div>
		 <div v-if="show_more" class="container-fluid">
    <div class="row mt-3">


      <div class="col-md-4" v-for="i in 9" :key="i">
    <label class="upload-label mt-3" :for="'file_' + (i - 1)">
        <div v-if="this['post_image_upload_preview_' + i] && this['post_image_upload_' + i]" class="upload-label-preview text-center">
            <div class="image-container">
                <img class="img-preview-pic" :src="this['post_image_upload_preview_' + i]" />
                <i @click="delete_img_product(i - 1)" class="fa-solid fa-trash icon-class"> Remove</i>
            </div>
        </div>
        <div v-else-if="this['post_image_upload_preview_' + i]" class="upload-label-preview text-center">
            <div class="image-container">
                <img class="img-preview-pic" :src="this['post_image_upload_preview_' + i]" />
                <i @click="delete_img_product_db(i - 1)" class="fa-solid fa-trash icon-class"> Delete</i>
            </div>
        </div>
        <div v-else class="upload-label-preview text-center">
            <p class="pt-5">Upload image</p>
        </div>
    </label>
    <input @change="imagechanged_product(i - 1)" :id="'file_' + (i - 1)" class="upload-input-img" type="file" accept="image/*" />
</div>




    </div>
  </div>
		 

				
		  <div class="progress my-2" v-if="uploadProgress > 0">
		  <div
		    class="progress-bar bg-dark"
		    role="progressbar"
		    :style="{ width: uploadProgress + '%' }"
		    :aria-valuenow="uploadProgress"
		    aria-valuemin="0"
		    aria-valuemax="100"
		  >
		    {{ uploadProgress }}%
		  </div>
		</div>

		        <button v-if="!upload_post" type="submit"  class="btn btn-dark" :disabled="isDisabled">
		        	<span v-if="isDisabled" class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
        			{{ isDisabled ? "Loading..." : "Update" }}
		        </button>
		        <button v-if="upload_post" type="submit"  class="btn btn-dark" :disabled="isDisabled">
		        	<span v-if="isDisabled" class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
        			{{ isDisabled ? "Loading..." : "Upload new post" }}
		        </button>

		        <p v-if="message_for_user">{{ message_for_user }}</p>
		        <ul v-if="errors.length" class="mt-3 text-danger">
			      <li v-for="error in errors" :key="error">{{ error }}</li>
			    </ul>
					        </form>
      </div>
      <div class="modal-footer">
        <!--<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button id="send_file_new" type="button" class="btn btn-dark" :disabled='isDisabled' @click="updatePost">Update post</button>-->
      </div>
    </div>
  </div>
</div>




		<div class="col-12">
			        	
        <form class="needs-validation" novalidate @submit.prevent="UploadNewPost('post')">
		 <h2>Upload Post</h2>
		 <div class="row mt-5 mb-3">
		 	<div class="col-lg-4">
		 		<div class="col-12">
		 			<label for="title" class="form-label">Title:</label>
				      <input @input="validateField($event)" v-model="title" id="title" minlength="3" maxlength="250" class="form-control" type="text" required :class="{'is-invalid': submitted && !title}" placeholder="Title...">
				      <div class="invalid-feedback">Please provide a valid title. Min 3 characters</div>
		 		</div>

		 		<div class="col-12">
		 			<label for="description" class="form-label">Description:</label>
				      <textarea minlength="3" @input="validateField($event)" v-model="description" id="description" maxlength="15000" class="form-control"  rows="5" v-model="text" placeholder="Description..." required :class="{'is-invalid': submitted && !description}">
				      	</textarea>

				      <div class="invalid-feedback">Please provide a valid description. Min 3 characters</div>
		 		</div>
			      
		 	</div>
		 	<div class="col-lg-8">
		 		<div class="col-lg-6">
				 <div class="form-group ">
				  <label class="upload-label" for="file">
				      <div v-if="post_image_upload_preview" class="upload-label-preview text-center" >
				        <img class="img-preview-pic" v-bind:src="post_image_upload_preview" /> 
				      </div>
				        <div v-if="!post_image_upload_preview" class="upload-label-preview text-center" >
				        <p class="pt-5">Upload image</p>
				    
				    </div>
				    
				  </label>
				<input
					  @change="imagechanged"
					  id="file"
					  class="upload-input-img form-control"
					  type="file"
					  accept="image/*"
					  required
					  :class="{'is-invalid': submitted && !post_image_upload}"
					/>
					<div class="invalid-feedback">Please upload an image.</div>

				  </div>

				  <div class="form-check form-switch mt-3" style="margin-left: 2.5rem;">
				  <input @click="show_more = !show_more" class="form-check-input" type="checkbox" id="flexSwitchCheckChecked10">
				  <label class="form-check-label" for="flexSwitchCheckChecked10">Add more pictures</label>
				</div>
				  </div>
		 	</div>
		 </div>
		 <div v-if="show_more" class="container-fluid">
    <div class="row mt-3">


      <div class="col-md-4" v-for="i in 9" :key="i">
    <label class="upload-label mt-3" :for="'file_' + (i - 1)">
        <div v-if="this['post_image_upload_preview_' + i]" class="upload-label-preview text-center">
            <div class="image-container">
                <img class="img-preview-pic" :src="this['post_image_upload_preview_' + i]" />
                <i @click="delete_img_product(i - 1)" class="fa-solid fa-trash icon-class"> Delete</i>
            </div>
        </div>
        <div v-else class="upload-label-preview text-center">
            <p class="pt-5">Upload image</p>
        </div>
    </label>
    <input @change="imagechanged_product(i - 1)" :id="'file_' + (i - 1)" class="upload-input-img" type="file" accept="image/*" />
</div>




    </div>
  </div>
		 

				
		  <div class="progress my-2" v-if="uploadProgress > 0">
		  <div
		    class="progress-bar bg-dark"
		    role="progressbar"
		    :style="{ width: uploadProgress + '%' }"
		    :aria-valuenow="uploadProgress"
		    aria-valuemin="0"
		    aria-valuemax="100"
		  >
		    {{ uploadProgress }}%
		  </div>
		</div>

		        <button type="submit"  class="btn btn-dark" :disabled="isDisabled">
		        	<span v-if="isDisabled" class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
        			{{ isDisabled ? "Loading..." : "Upload" }}
		        </button>

		        <p v-if="message_for_user">{{ message_for_user }}</p>
		        <ul v-if="errors.length" class="mt-3 text-danger">
			      <li v-for="error in errors" :key="error">{{ error }}</li>
			    </ul>
					        </form>

	@endverbatim

	<div class="col-12 mt-5">
          			<button @click="choose_mode = !choose_mode" type="button" class="btn btn-dark me-2">Choose</button>
          			<button :disabled='!choose_mode' @click="delete_all_picked_posts()" type="button" class="btn btn-success">Delete all</button>
          		</div>

@endauth

<div v-if="page_is_loading" class="row mt-0 row-custom-margin ps-0 pe-0">
  <?php for ($i = 0; $i < 4; $i++): ?>
    <div class="col-10 col-md-4 col-lg-3 mt-3 mx-auto mx-md-0">
      <div class="card w-100 card-custom-bg">
        <div class="skeleton-loader product-item-size-img-skeleton"></div>
        <div class="card-body">
          <h5 class="card-title"><div class="skeleton-loader"></div></h5>
          <p class="card-text"><div class="skeleton-loader"></div></p>
        </div>
      </div>
    </div>
  <?php endfor; ?>
</div>


<div class="row mt-3 row-custom-margin ps-0 pe-0">
	

	<div v-if="!page_is_loading"
    v-for="item in paginatedPosts()"
    :key="item.id"
    class="col-10 col-md-4 col-lg-3 mb-3 d-flex align-items-stretch mx-auto mx-md-0"
    >
    

		<div class="card w-100 card-custom-bg position-relative">
			@auth
    <div class="text-center">
       <button @click="id = item.id, upload_post = true" type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#update_post">
           Upload Post
         </button>
    </div>
    <div class="text-center">
        <a @click="change_post(item.id, item.description, item.title, item.status_sold, item.main_img, item.img_path_1, item.img_path_2, item.img_path_3, item.img_path_4, item.img_path_5, item.img_path_6, item.img_path_7, item.img_path_8, item.img_path_9)" type="button" data-bs-toggle="modal" data-bs-target="#update_post">
            <i class="fa-solid fa-pen-to-square ms-2"></i> Edit
        </a>
    </div>
    <div class="text-center">
        <a @click="delete_post(item.id)" role="button">
            <i class="fa-solid fa-trash ms-2"></i> Delete
        </a>
    </div>
    <div v-if="choose_mode" class="form-check form-check-custom-form">
	    <input
	      class="form-check-input form-check-custom-a ms-1"
	      type="checkbox"
	      :id="'check_item_' + item.id"
	      :value="item.id"
	      @change="toggleSelection(item.id)"
	    />
	    <label class="form-check-label" :for="'check_item_' + item.id">
	      
	    </label>
  </div>
  @endauth
  @verbatim
		  <img :src="item.main_img" class="card-img-top w-100 card-custom-img">
		  <div class="card-body">
		    <h5 class="card-title">{{item.title}}</h5>
		    <p class="card-text">{{ truncateText(item.description, 100) }}</p>
		    <a :href="'/single-post/' + item.id" class="btn btn-dark">Подробнее</a>
		  </div>
		</div>
	</div>

	<div class="col-12 mb-5">
      <div v-if="!page_is_loading && posts.length > 0" class="col-12">
   <nav aria-label="Page navigation" class="d-flex justify-content-center mt-5">
    <ul class="pagination">
      <li class="page-item" :class="{ disabled: currentPage === 1 }">
        <a class="page-link" href="#" @click.prevent="previousPostsPage" aria-label="Previous">
          <i class="icon icon-arrow-left"></i>
        </a>
      </li>

      <li
        class="page-item"
        v-for="page in getPostsVisiblePages()"
        :key="page"
        :class="{ active: currentPage === page, disabled: page === '...' }"
      >
        <a
          class="page-link bg-dark border border-dark"
          href="#"
          @click.prevent="changePostsPage(page)"
          v-html="page === '...' ? '&hellip;' : page"
        ></a>
      </li>

      <li class="page-item" :class="{ disabled: currentPage === postsTotalPages() }">
        <a class="page-link" href="#" @click.prevent="nextPostsPage" aria-label="Next">
          <i class="icon icon-arrow-right"></i>
        </a>
      </li>
    </ul>
  </nav>
</div>
   </div>


	@endverbatim
	
</div>

	</div>
</div>
</div>
<div class="pt-5">
@endsection