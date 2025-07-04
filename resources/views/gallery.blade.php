<?php $isAdmin = false ?>

@extends('layouts.default')

@section('title', 'Gallery')

@section('maincontent')


<div class="bggallery pt-5">
@auth
@verbatim
<div class="modal modal-xl fade" id="upload_gallery_by_id" tabindex="-1" aria-labelledby="upload_gallery_by_id_label" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="upload_gallery_by_id_label">Upload gallery</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form onsubmit="return false" class="mb-5">

 
 <div class="form-group mt-5">
   <label for="file_image_new" class="form-label">New image</label>
  <input @change="image_changed_multiple_new" class="form-control" type="file" id="file_image_new" accept="image/*" multiple>
  </div>
  <div class="container-fluid">
    <div class="row mt-3">
    <div v-if="multiple_img_arr_upload" v-for="(item, index) in multiple_img_arr_preview_new" class="col-md-3">
      <!--<div class="img-preview" :style="{ backgroundImage: `url(${item})` }" >
        
      </div>-->
      <div class="image-container mt-3">
        <img class="img-preview-pic" v-bind:src="item.url" /> 
        <i @click="delete_img_before_upload(item.name, index)" class="fa-solid fa-trash icon-class"> Delete</i>
        <i v-if="item.size > 1000000" class="icon-class icon-class-large">Large size (more than 1 mb)</i>
      </div>
      </div>
    </div>
  </div>
  <div v-if="load">
    <!--<p id="loadingcomplete_new"></p>-->
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
  </div>
 
  <!--<button type="submit" id="send_file" v-on:click="uploadphoto" class="btn btn-dark btn-sm px-2 pt-2 mt-2 mb-5"><i class="fa-solid fa-image"></i> Upload image</button>-->
</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button id="send_file_new" type="button" class="btn btn-dark" :disabled='isDisabled' @click="uploadphotobyid">Upload images</button>
      </div>
    </div>
  </div>
</div>
@endverbatim


<div class="container">
	
	<div class="row">

		@verbatim
		<div class="col-12">
			        	<h2>Upload Gallery</h2>
        <div class="form-group mt-5">
		   <label for="file_image" class="form-label">New image</label>
		  <input @change="image_changed_multiple" class="form-control" type="file" id="file_image" accept="image/*" multiple>
		  </div>

		  <div class="container-fluid">
    <div class="row mt-3">
    <div v-if="multiple_img_arr_upload" v-for="(item, index) in multiple_img_arr_preview_new" class="col-md-3">
      <!--<div class="img-preview" :style="{ backgroundImage: `url(${item})` }" >
        
      </div>-->
      <div class="image-container mt-3">
        <img class="img-preview-pic" v-bind:src="item.url" /> 
        <i @click="delete_img_before_upload(item.name, index)" class="fa-solid fa-trash icon-class"> Delete</i>
        <i v-if="item.size > 1000000" class="icon-class icon-class-large">Large size (more than 1 mb)</i>
      </div>
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

        <button class="btn btn-dark" @click="uploadMultiImages" :disabled="isUploading">Upload</button>
        <!--<p v-if="uploadProgress">Uploading: {{ uploadProgress }}%</p>-->
        <p v-if="message_for_user">{{ message_for_user }}</p>
			        </div>
		@endverbatim
	</div>
@endauth
	 <div id="fancybox_active"><!--class="bggallery"-->

<div class="container mb-5">
   <div class="row mt-0">
      @auth
               <div class="col-12">
                  <button @click="choose_mode = !choose_mode" type="button" class="btn btn-dark me-2">Choose</button>
                  <button :disabled='!choose_mode' @click="delete_all_picked('delete_all_gallery')" type="button" class="btn btn-success">Delete all</button>
               </div>
               @endauth
      <?php for ($i = 0; $i < 12; $i++): ?>
   <div v-if="page_is_loading" class="col-md-3 col-xl-2 col-6 my-2 gallery-img">
      <div class="gallery-img-template skeleton-loader" style="border-radius: 0px;"></div>
   </div>
   <?php endfor; ?>
   </div>
   <div class="row gallery-fancybox hide-before-load">
         
<div v-if="!page_is_loading && gallery.length > 0" v-for="image in paginatedGallery()" :key="image.id" class="col-md-3 col-xl-2 col-6 my-2 gallery-img fade-in">

  @auth
   <div class="text-center">
        <label class="upload-label" :for="'file_gallery_' + image.id">
            <i class="fa-solid fa-image"></i> change img
        </label>
        <div v-if="!page_is_loading">
            <p :id="'loadingcomplete_gallery_' + image.id"></p>
        </div>
        <div style="width: 50px !important;">
            <input @change="image_changed_gallery(image.id, 'gallery')" :id="'file_gallery_' + image.id" class="upload-input-img" type="file" accept="image/*" />
        </div>
    </div>
    <div class="text-center">
       <button @click="id = image.id" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#upload_gallery_by_id">
           Upload new images
         </button>
    </div>
  <div class="text-center">
    <a role="button" :id="image.id" @click="delete_img(image.id)">
      <i class="fa-solid fa-trash ms-2"></i> Delete
    </a>
  </div>

  <div v-if="choose_mode" class="form-check form-check-custom-form">
    <input
      class="form-check-input form-check-custom-a ms-1"
      type="checkbox"
      :id="'check_item_' + image.id"
      :value="image.id"
      @change="toggleSelection(image.id)"
    />
    <label class="form-check-label text-dark ms-1" :for="'check_item_' + image.id">
      <!--Pick-->
    </label>
  </div>
  @endauth

  <a :href="image.img_full" data-fancybox="gallery" :data-caption="image.title">
    <img :src="image.img_min" />
  </a>

  <!--<a href="#" @click.prevent="openFancybox(image)">
  <img :src="image.img_min" />-->
</a>

</div>




   </div>
   <div class="row">
      <div v-if="!page_is_loading && gallery.length > 0" class="col-12">
   <nav aria-label="Page navigation" class="d-flex justify-content-center mt-5">
    <ul class="pagination">
      <li class="page-item" :class="{ disabled: currentPage === 1 }">
        <a class="page-link" href="#" @click.prevent="previousGalleryPage" aria-label="Previous">
          <i class="icon icon-arrow-left"></i>
        </a>
      </li>

      <li
        class="page-item"
        v-for="page in getGalleryVisiblePages()"
        :key="page"
        :class="{ active: currentPage === page, disabled: page === '...' }"
      >
        <a
          class="page-link bg-dark border border-dark"
          href="#"
          @click.prevent="changeGalleryPage(page)"
          v-html="page === '...' ? '&hellip;' : page"
        ></a>
      </li>

      <li class="page-item" :class="{ disabled: currentPage === galleryTotalPages() }">
        <a class="page-link" href="#" @click.prevent="nextGalleryPage" aria-label="Next">
          <i class="icon icon-arrow-right"></i>
        </a>
      </li>
    </ul>
  </nav>
</div>
   </div>
</div>
</div>

</div>
</div>

@endsection