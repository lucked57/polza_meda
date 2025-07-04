@extends('layouts.default')

@section('title', 'New image')

@section('maincontent')

@auth
<div class="container my-5 py-5">
	<div class="row">
		<div class="col-12">
			<h1 class="text-center">Add new Image</h1>
			
		</div>
		<div class="col-md-3">
				
			</div>
			<div class="col-md-6 text-center">
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
					/>
					<div class="invalid-feedback">Please upload an image.</div>

				  </div>
@verbatim
				  <div class="progress my-2" v-if="uploadProgress > 0">
				  <div
				    class="progress-bar"
				    role="progressbar"
				    :style="{ width: uploadProgress + '%' }"
				    :aria-valuenow="uploadProgress"
				    aria-valuemin="0"
				    aria-valuemax="100"
				  >
				    {{ uploadProgress }}%
				  </div>
				</div>

				<button @click="UploadNewImage" type="submit"  class="btn btn-primary text-center mt-3" :disabled="isDisabled">
        			{{ isDisabled ? "Loading..." : "Upload new image" }}
		        </button>
@endverbatim
				  </div>
	</div>
</div>


@endauth

@endsection