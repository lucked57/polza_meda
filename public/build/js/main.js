axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
const EventHandling = {
  data() {
    return {
      status:1,
      not_main_page:false,
      text:'',
      uploadProgress: {},
      users_return:"",
      show_more:false,
      description:"",
      title:"",
      id:0,
      choose_mode:false,
      page_is_loading:true,
      currentPage: 1,
      itemsPerPage: 12,
      gallery_all:false,
      gallery:false,
      errors: [],
      file: null,
      message: "this is my text",
      email:"",
      fullname:"",
      password: "",
      password_confirmation: "",
      error: false,
      load:false,
      isDisabled:false,
      isUploading: false,
      uploadProgress: 0,
      images: [],
      loading: false,
      current_password:"",
      main_page: false,
      counter:0,
      multiple_img_arr_preview: [],
      multiple_img_arr_preview_new: [],
      multiple_img_arr_preview_reverse:[],
      multiple_img_arr_upload: new FormData(),
      errorshowo:false,
      message_for_user:false,
      selected_delete:new Set(),
      post_image_upload_preview_1:false,
      post_image_upload_1:"",
      post_image_upload_preview_2:false,
      post_image_upload_2:"",
      post_image_upload_preview_3:false,
      post_image_upload_3:"",
      post_image_upload_preview_4:false,
      post_image_upload_4:"",
      post_image_upload_preview_5:false,
      post_image_upload_5:"",
      post_image_upload_preview_6:false,
      post_image_upload_6:"",
      post_image_upload_preview_7:false,
      post_image_upload_7:"",
      post_image_upload_preview_8:false,
      post_image_upload_8:"",
      post_image_upload_preview_9:false,
      post_image_upload_9:"",
      post_image_upload_preview_arr:[],
      post_image_upload_arr:[],
      post_image_upload_preview:false,
      post_image_upload: "",
      upload_post: false,
    }
  },
  methods: {
    validatePasswords() {
        let form = document.querySelector(".needs-validation");


        let passwordInput = document.querySelector("#password");
        let confirmPasswordInput = document.querySelector("#password_confirmation");
        let passwordError = document.querySelector("#password_text");
        let confirmPasswordError = document.querySelector("#password_confirmation_text");

        this.errors = []; 

        passwordInput.classList.remove("is-invalid", "is-valid");
        confirmPasswordInput.classList.remove("is-invalid", "is-valid");

       
        if (this.password.length < 8) {
            this.errors.push("Password must be at least 8 characters.");
            passwordInput.classList.add("is-invalid"); // Add red border
            passwordError.style.display = "block";
        } else {
            passwordInput.classList.add("is-valid"); // Green border if valid
            passwordError.style.display = "none";
        }

        // Check if passwords match
        if (this.password !== this.password_confirmation) {
          form.classList.remove("was-validated");
            this.errors.push("Passwords do not match.");
            confirmPasswordInput.classList.add("is-invalid"); // Add red border
            confirmPasswordError.style.display = "block";

        } else {
            confirmPasswordInput.classList.add("is-valid"); // Green border if valid
            confirmPasswordError.style.display = "none";
        }
    },
    addBeforeUnloadListener() {
        console.log("added");
        window.onbeforeunload = function() {
                return "Are you sure you want to leave?";
            }
    },
    openFancybox(clickedImage) {
      const images = this.paginatedGallery().map(image => ({
        src: image.img_full,
        type: 'image',
        caption: image.title
      }));

      const startIndex = images.findIndex(img => img.src === clickedImage.img_full);

      Fancybox.show(images, {
        startIndex: startIndex
      });
    },
    removeBeforeUnloadListener() {
        window.onbeforeunload="";
        },
    truncateText(text, limit) {
      if (!text) return '';
      if (text.length <= limit) return text;

      let trimmed = text.substr(0, limit);
      return trimmed.substr(0, Math.min(trimmed.length, trimmed.lastIndexOf(" "))) + '...';
    },
    fetchUsers() {
        this.page_is_loading = true;
                    this.loading = true;
                    axios.get('/api/get-users')
                        .then(response => {
                          console.log(response.data);
                            this.users_return = response.data;
                            this.loading = false;
                            this.page_is_loading = false;
                            this.posts_all = response.data;
                        })
                        .catch(error => {
                            this.isDisabled = false;
                            this.error = "Failed to load users.";
                            console.error(error);
                            this.loading = false;
                            this.page_is_loading = false;
                        });
        },
    fetchPosts(type = "post") {
        this.page_is_loading = true;
                    this.loading = true;
                    let url = type === "market" ? "/api/market" : "/api/posts";
                    axios.get(url)
                        .then(response => {
                          console.log(response.data);
                            this.posts = response.data;
                            this.loading = false;
                            this.page_is_loading = false;
                            this.posts_all = response.data;
                            document.querySelectorAll('.hide-before-load').forEach(element => {
                              element.classList.remove('hide-before-load');
                            });
                        })
                        .catch(error => {
                          this.isDisabled = false;
                            this.error = "Failed to load posts.";
                            console.error(error);
                            this.loading = false;
                            this.page_is_loading = false;
                        });
        },
    fetchGallery() {
                    this.page_is_loading = true;
                    this.loading = true;
                    axios.get('/api/gallery')
                        .then(response => {
                          console.log(response.data);
                            this.gallery = response.data;
                            this.loading = false;
                            this.page_is_loading = false;
                            this.gallery_all = response.data;
                            document.querySelectorAll('.hide-before-load').forEach(element => {
                              element.classList.remove('hide-before-load');
                            });
                        })
                        .catch(error => {
                          this.isDisabled = false;
                            this.error = "Failed to load gallery.";
                            console.error(error);
                            this.loading = false;
                            this.page_is_loading = false;
                        });
        },
    delete_img: function (id) {
    if (confirm("Are you sure that you want to delete this image?")) {
        axios.delete('/delete-image-gallery/' + id)
        .then(response => {
            this.gallery = this.gallery.filter((item) => item.id !== id);
            console.log("Deleted:", response.data);
        })
        .catch(error => {
            console.error("Delete failed:", error.response.data);
        });
    } 
  },
  delete_post: function (id) {
    if (confirm("Are you sure that you want to delete this post?")) {
        axios.delete('/delete-post/' + id)
        .then(response => {
            let currentPath = window.location.pathname;
            let type = 'post';

            if (currentPath.includes('/market')) {
              type = 'market';
            }

            this.fetchPosts(type);
            console.log("Deleted:", response.data);
        })
        .catch(error => {
            console.error("Delete failed:", error.response.data);
        });
    } 
  },
  toggleSelection(id) {
      if (this.selected_delete.has(id)) {
        this.selected_delete.delete(id);
      } else {
        this.selected_delete.add(id);
      }
      //console.log(Array.from(this.selected_delete));
    },
  delete_all_picked: function (target){
    if (confirm("Are you sure that you want to delete all picked items?")) {
      let delete_array = Array.from(this.selected_delete);
      if (this.selected_delete.size === 0) {
        alert("Please select items");
        return;
      }
      axios.delete('/delete-multiple-gallery', {
            data: { ids: delete_array }
        })
                .then(response => {
                    alert(response.data.message); 
                    this.fetchGallery();
                    this.selected_delete = [];
                    this.choose_mode = false;
                    console.log(response.data.message);
                })
                .catch(error => {
                    //alert(error.response.data.message);
                    console.log(error);
                    //console.log(error.response.data.message);
                });
    }
  },
  blocked_picked: function (){
    if (confirm("Are you sure that you want to block all picked users?")) {

      let delete_array = Array.from(this.selected_delete);
      if (this.selected_delete.size === 0) {
        alert("Please select items");
        return;
      }
      this.isDisabled = true;
      axios.put('/block-users', {
              ids: delete_array
            })
                .then(response => {
                    this.isDisabled = false;
                    alert(response.data.message); 
                    //this.fetchUsers();
                    window.location.reload();
                    this.selected_delete = [];
                    this.choose_mode = false;
                    console.log(response.data.message);
                })
                .catch(error => {
                    this.isDisabled = false;
                    console.log(error);
                });
    }
  },
  unlock_picked: function (){
    if (confirm("Are you sure that you want to unlock all picked users?")) {
      let delete_array = Array.from(this.selected_delete);
      if (this.selected_delete.size === 0) {
        alert("Please select items");
        return;
      }
      this.isDisabled = true;
      axios.put('/unlock-users', {
              ids: delete_array
            })
                .then(response => {
                    this.isDisabled = false;
                    alert(response.data.message); 
                    //this.fetchUsers();
                    window.location.reload();
                    this.selected_delete = [];
                    this.choose_mode = false;
                    console.log(response.data.message);
                })
                .catch(error => {
                    this.isDisabled = false;
                    console.log(error);
                });
    }
  },
  delete_all_picked_posts: function (){
    if (confirm("Are you sure that you want to delete all picked items?")) {
      let delete_array = Array.from(this.selected_delete);
      if (this.selected_delete.size === 0) {
        alert("Please select items");
        return;
      }
      axios.delete('/delete-multiple-posts', {
            data: { ids: delete_array }
        })
                .then(response => {
                    alert(response.data.message); 
                     let currentPath = window.location.pathname;
                    let type = 'post';

                    if (currentPath.includes('/market')) {
                      type = 'market';
                    }

                    this.fetchPosts(type);
                    this.selected_delete = [];
                    this.choose_mode = false;
                    console.log(response.data.message);
                })
                .catch(error => {
                    //alert(error.response.data.message);
                    console.log(error);
                    //console.log(error.response.data.message);
                });
    }
  },
  uploadphotobyid: function () {
    const config = {
        headers: { "Content-Type": "multipart/form-data" },
         onUploadProgress: progressEvent => {
            this.uploadProgress = Math.round((progressEvent.loaded * 100) / progressEvent.total);
   }
 };
  //console.log('img_add id: ' + this.id);
    document.querySelector('#send_file_new').disabled = true;
    this.load = true;
    let error = false;
    if(Object.keys(this.multiple_img_arr_preview_new).length == 0){
      error = "Select img";
    }
    this.addBeforeUnloadListener();
    if(!error){
      this.multiple_img_arr_upload.append("img_add_id", this.id);
      //this.multiple_img_arr_upload.append("title", title);
    axios.post('/upload-gallery-byid', this.multiple_img_arr_upload, config,{
        headers: {
          'Content-Type': 'multipart/form-data'
        }
    })
    .then(response => {
            alert(response.data.message);
            document.querySelector('#send_file_new').disabled = false;
            this.load = false;
            this.loadcontent = true;
            document.querySelector('#file_image_new').value = '';
            this.multiple_img_arr_upload = new FormData();
            this.multiple_img_arr_preview_new = [];
            this.uploadProgress = 0;
            this.removeBeforeUnloadListener();
            window.location.reload();
            //this.fetchGallery();
          })
          .catch(error => {
            console.log(error);
            document.querySelector('#send_file_new').disabled = false;
            this.load = false;
            this.uploadProgress = 0;
          });

          }
          else{
            this.uploadProgress = 0;
            console.log(error);
            document.querySelector('#send_file_new').disabled = false;
            this.load = false;
          }
  },
  imagechanged: function(){
        this.error = false;
        this.errorshowo = {};
        let formData = new FormData();
        let imagefile = document.querySelector('#file');
        if(Object.keys(this.errorshowo).length === 0 ){
          this.post_image_upload_preview = URL.createObjectURL(imagefile.files[0]);
          this.post_image_upload = imagefile.files[0];
        }
      },
  delete_img_product_db: function(number) {
    if (confirm("Are you sure that you want to delete this picture from database?")) {
        this.error = false;
        let img_path_number = number + 1;
        //console.log(img_path_number);
        this.id;
        if(!this.error){
        this.isDisabled = true;
              axios.delete('/delete-post-img/' + this.id + '/' + img_path_number)
                  .then(response => {
                      this.isDisabled = false;
                      //console.log(response.data); 
                      
                      this[`post_image_upload_preview_${number + 1}`] = false;
                      this[`post_image_upload_${number + 1}`] = "";
                      alert(response.data.message);
                  })

                  .catch(error => {
                      this.isDisabled = false;
                      console.log(error);
                      console.log(error.response.data.message);
                  });
              }
    }
},
  imagechanged_update_post: function(){
        this.error = false;
        this.errorshowo = {};
        let formData = new FormData();
        let imagefile = document.querySelector('#file_update');
        if(Object.keys(this.errorshowo).length === 0 ){
          this.post_image_upload_preview = URL.createObjectURL(imagefile.files[0]);
          this.post_image_upload = imagefile.files[0];
        }
      },
  image_changed_gallery: function(id){
        const config = {
          onUploadProgress: function(progressEvent) {
            let percentCompleted = Math.round((progressEvent.loaded * 100) / progressEvent.total);
            //console.log(percentCompleted);
            document.querySelector('#loadingcomplete_gallery_' + id).innerHTML = percentCompleted + "%";
            
          }
        }
        this.error = false;
        this.errorshowo = {};
        let formData = new FormData();
        let imagefile;
        imagefile = document.querySelector('#file_gallery_' + id);
        if(imagefile.files[0].size == 0){
          this.errorshowo.imagefile = "Please upload image";
        }
        if(imagefile.files[0].size > 1000000){
          if(!confirm('This image is more than 1mb, it might significantly affect loading speed, continue?')){
            this.errorshowo.imagefile = "You can use compressor";
          }
        }
        if(Object.keys(this.errorshowo).length === 0 ){
          this.post_image_upload_preview = URL.createObjectURL(imagefile.files[0]);
          this.post_image_upload = imagefile.files[0];

          formData.append("image", this.post_image_upload);
          formData.append("id", id);
    
              if(confirm('This image will be changed, continue?')){

                document.querySelector('#file_gallery_' + id).disabled = true;
                
                axios.post('/change-gallery', formData, config, {
                    headers: {
                      'Content-Type': 'multipart/form-data'
                    }
                })
                .then(response => {
                        alert(response.data.message);
                        document.querySelector('#file_gallery_' + id).disabled = false;
                        document.querySelector('#file_gallery_' + id).value = '';
                        //console.log(response.data);
                        this.percentcompleteaxios = 0;
                        document.querySelector('#loadingcomplete_gallery_' + id).innerHTML = "";
                        //this.fetchGallery();
                        window.location.reload();
                      })
                      .catch(error => {
                        alert(error);
                        console.log(error);
                        document.querySelector('#file_gallery_' + id).disabled = false;
                        document.querySelector('#loadingcomplete_gallery_' + id).innerHTML = "";
                        this.percentcompleteaxios = 0;
                      });
              }
            
          
        }
        else{
          alert(this.errorshowo.imagefile);
        }
      },
      image_changed_images: function(id){
        const wrapper = document.querySelector('#progress_wrapper_' + id);
              const bar = document.querySelector('#progress_bar_' + id);
        const config = {
            headers: { "Content-Type": "multipart/form-data" },
            onUploadProgress: progressEvent => {
              const percentCompleted = Math.round((progressEvent.loaded * 100) / progressEvent.total);

              

              if (wrapper && bar) {
                wrapper.style.display = 'block';
                bar.style.width = percentCompleted + '%';
                bar.setAttribute('aria-valuenow', percentCompleted);
                bar.textContent = percentCompleted + '%';
              }
            }
          };
        this.error = false;
        this.errorshowo = {};
        let formData = new FormData();
        let imagefile;
        imagefile = document.querySelector('#file_img_def_' + id);
        if(imagefile.files[0].size == 0){
          this.errorshowo.imagefile = "Please upload image";
        }
        if(imagefile.files[0].size > 1000000){
          if(!confirm('This image is more than 1mb, it might significantly affect loading speed, continue?')){
            this.errorshowo.imagefile = "You can use compressor";
          }
        }
        if(Object.keys(this.errorshowo).length === 0 ){
          this.post_image_upload_preview = URL.createObjectURL(imagefile.files[0]);
          this.post_image_upload = imagefile.files[0];

          formData.append("image", this.post_image_upload);
          formData.append("id", id);
    
              if(confirm('This image will be changed, continue?')){

                document.querySelector('#file_img_def_' + id).disabled = true;
                
                axios.post('/change-img-images', formData, config, {
                    headers: {
                      'Content-Type': 'multipart/form-data'
                    }
                })
                .then(response => {
                    if (wrapper && bar) {
                      bar.style.width = '0%';
                      bar.setAttribute('aria-valuenow', 0);
                      bar.textContent = '0%';
                      wrapper.style.display = 'none';
                    }

                        alert(response.data.message);
                        document.querySelector('#file_img_def_' + id).disabled = false;
                        document.querySelector('#file_img_def_' + id).value = '';
                        //console.log(response.data);
                        this.percentcompleteaxios = 0;
                        //document.querySelector('#loadingcomplete_img_def_' + id).innerHTML = "";
                        //this.fetchGallery();
                        window.location.reload();
                      })
                      .catch(error => {
                        if (wrapper && bar) {
                          bar.style.width = '0%';
                          bar.setAttribute('aria-valuenow', 0);
                          bar.textContent = '0%';
                          wrapper.style.display = 'none';
                        }

                        alert(error);
                        console.log(error);
                        document.querySelector('#file_img_def_' + id).disabled = false;
                        //document.querySelector('#loadingcomplete_img_def_' + id).innerHTML = "";
                        this.percentcompleteaxios = 0;
                      });
              }
            
          
        }
        else{
          alert(this.errorshowo.imagefile);
        }
      },
      change_text: function (id, text) {
  this.text = text;
  this.id = id;
},
update_text: function () {
  let error = false;
  if(this.text.length == 0){
      error = "Text is empty";
    }
    if(!error){
      this.isDisabled = true;
      let param = {
                  id: this.id,
                  text: this.text,
                  page: "default",
            };
            const str = JSON.stringify(param);
            axios.post('/updatetext', str, {
  headers: {
    'Content-Type': 'application/json'
  }
})
.then(response => {
    this.isDisabled = false;
    alert(response.data.message); 
    this.load = true;
    window.location.reload();
})
.catch(error => {
    this.isDisabled = false;
    this.load = true;
    console.log(error);
    if (error.response && error.response.data && error.response.data.error) {
        console.log(error.response.data.error);
    } else {
        console.log('Unknown error occurred');
    }
});

    }
    else{
      alert(error);
    }
},
    change_post: function (id, description, title, status, post_image_upload_preview, post_image_upload_preview_1 = false, post_image_upload_preview_2 = false, post_image_upload_preview_3 = false, post_image_upload_preview_4 = false, post_image_upload_preview_5 = false, post_image_upload_preview_6 = false, post_image_upload_preview_7 = false, post_image_upload_preview_8 = false, post_image_upload_preview_9 = false) {
      this.description = description;
      this.id = id;
      this.title = title;
      this.status = status;
      this.post_image_upload_preview = post_image_upload_preview;
      const post_image_upload_previews = [
        post_image_upload_preview_1,
        post_image_upload_preview_2,
        post_image_upload_preview_3,
        post_image_upload_preview_4,
        post_image_upload_preview_5,
        post_image_upload_preview_6,
        post_image_upload_preview_7,
        post_image_upload_preview_8,
        post_image_upload_preview_9,
      ];
      for (let i = 1; i <= 9; i++) {
        const preview = post_image_upload_previews[i - 1];
        if (preview) {
          this[`post_image_upload_preview_${i}`] = preview;
        } else {
          this[`post_image_upload_preview_${i}`] = "";
        }
      }
      
    },
    image_changed: function(id){
        const config = {
          onUploadProgress: function(progressEvent) {
            let percentCompleted = Math.round((progressEvent.loaded * 100) / progressEvent.total);
            //console.log(percentCompleted);
            document.querySelector('#loadingcomplete_gallery_' + id).innerHTML = percentCompleted + "%";
            
          }
        }
        this.error = false;
        this.errorshowo = {};
        let formData = new FormData();
        let imagefile;
        imagefile = document.querySelector('#file_gallery_' + id);
        if(imagefile.files[0].size == 0){
          this.errorshowo.imagefile = "Please upload image";
        }
        if(imagefile.files[0].size > 1000000){
          if(!confirm('This image is more than 1mb, it might significantly affect loading speed, continue?')){
            this.errorshowo.imagefile = "You can use compressor";
          }
        }
        if(Object.keys(this.errorshowo).length === 0 ){
          this.post_image_upload_preview = URL.createObjectURL(imagefile.files[0]);
          this.post_image_upload = imagefile.files[0];

          formData.append("image", this.post_image_upload);
          formData.append("id", id);
    
              if(confirm('This image will be changed, continue?')){

                document.querySelector('#file_gallery_' + id).disabled = true;
                
                axios.post('/change-img-post', formData, config, {
                    headers: {
                      'Content-Type': 'multipart/form-data'
                    }
                })
                .then(response => {
                        alert(response.data.message);
                        document.querySelector('#file_gallery_' + id).disabled = false;
                        document.querySelector('#file_gallery_' + id).value = '';
                        //console.log(response.data);
                        this.percentcompleteaxios = 0;
                        document.querySelector('#loadingcomplete_gallery_' + id).innerHTML = "";
                        //this.fetchGallery();
                        window.location.reload();
                      })
                      .catch(error => {
                        alert(error);
                        console.log(error);
                        document.querySelector('#file_gallery_' + id).disabled = false;
                        document.querySelector('#loadingcomplete_gallery_' + id).innerHTML = "";
                        this.percentcompleteaxios = 0;
                      });
              }
            
          
        }
        else{
          alert(this.errorshowo.imagefile);
        }
      },
    UpdatePost(type = "post") {
        const config = {
        headers: { "Content-Type": "multipart/form-data" },
                 onUploadProgress: progressEvent => {
                    this.uploadProgress = Math.round((progressEvent.loaded * 100) / progressEvent.total);
           }
         };
        let error = false;
        this.errors = [];
        this.submitted = true;
        let form = document.querySelector(".needs-validation-update");
        if (!form.checkValidity()){
            //alert("not valid");
            form.classList.add("was-validated");
            return;
        }
        if(this.upload_post && !this.post_image_upload){
            form.classList.remove("was-validated");
            return;
        }
        this.addBeforeUnloadListener();
        this.load = true;
        this.isDisabled = true;
        let formData = new FormData();

        if(this.post_image_upload){
            formData.append("image", this.post_image_upload);
        }
        formData.append("id", this.id);
        formData.append("title", this.title);
        formData.append("description", this.description);
        formData.append("type", type);
        formData.append("status", this.status);
        if(this.post_image_upload && this.post_image_upload.size > 1000000) {
                  if (!confirm("Main image size is more than 1 MB, it might significantly affect page speed loading, continue uploading?")) {
                      error = "You can use an image compressor to make the image smaller";
                  }
              }
        for (let i = 1; i <= 9; i++) {
          const previewProp = `post_image_upload_preview_${i}`;
          const imageProp = `post_image_upload_${i}`;

          if (this[previewProp] && this[imageProp]) {
              formData.append(`image_${i}`, this[imageProp]);
              //console.log("img has been added " + this[previewProp] + " number " + i);
              if (this[imageProp].size > 1000000) {
                  if (!confirm(`Image ${i} size is more than 1 MB, it might significantly affect page speed loading, continue uploading?`)) {
                      error = "You can use an image compressor to make the image smaller";
                  }
              }
          }
      }
      if(!error){
        let url;
    if(!this.upload_post){
        url = '/update-post-new';
    }
    else{
        url = '/upload-post-withid';
    }
    axios.post(url, formData, config, {
        headers: {
          'Content-Type': 'multipart/form-data'
        }
    })
    .then(response => {
            form.classList.remove("was-validated");
            form.querySelectorAll(".is-valid, .is-invalid").forEach((el) => {
              el.classList.remove("is-valid", "is-invalid");
            });
            this.submitted = false;
            let modalEl = document.getElementById('update_post');
            let modalInstance = bootstrap.Modal.getInstance(modalEl);
            let instance = modalInstance || new bootstrap.Modal(modalEl);
            instance.hide();
            alert(response.data.message);
            this.title = '';
            this.description = '';
            this.post_image_upload = null;
            this.post_image_upload_preview = null;

            for (let i = 1; i <= 9; i++) {
                this[`post_image_upload_${i}`] = null;
                this[`post_image_upload_preview_${i}`] = null;
            }

            document.querySelector('#file_update').value = '';
            this.load = false;
            this.isDisabled = false;
            //document.querySelector('#send_file').disabled = false;
            this.percentcompleteaxios = 0;
            this.uploadProgress = 0;
            this.fetchPosts(type);
            this.removeBeforeUnloadListener();
          })
          .catch(error => {
            this.submitted = false;
            if (error.response && error.response.status === 422) {
                   this.handleServerErrors(error.response.data.errors);
                    this.errors = Object.values(error.response.data.errors).flat();
                } else {
                    this.errors.push("An error occurred. Please try again.");
                }
            //alert(error.response.data.message);
            console.log(error);
            this.load = false;
            this.isDisabled = false;
            this.percentcompleteaxios = 0;
            this.uploadProgress = 0;
            this.show_more = false;
          });

          }
          else{
            alert(error);
            console.log(error);
            //document.querySelector('#send_file').disabled = false;
            this.load = false;
            this.uploadProgress = 0;
            this.isDisabled = false;
          }


    },
    UploadNewImage() {
        const config = {
        headers: { "Content-Type": "multipart/form-data" },
                 onUploadProgress: progressEvent => {
                    this.uploadProgress = Math.round((progressEvent.loaded * 100) / progressEvent.total);
           }
         };
        let error = false;
        this.errors = [];
        this.submitted = true;
        if (!this.post_image_upload) {
        error = "Select img";
          } else {
              if (this.post_image_upload.size > 1000000) {
                  if (!confirm("Image size is more than 1 MB, it might significantly affect page speed loading, continue uploading?")) {
                      error = "You can use an image compressor to make the image smaller";
                  }
              }
          }
        this.load = true;
        this.isDisabled = true;
        let formData = new FormData();
        formData.append("image", this.post_image_upload);
        formData.append("page", "default");

         if(!error){
    axios.post('/upload-new-image', formData, config, {
        headers: {
          'Content-Type': 'multipart/form-data'
        }
    })
    .then(response => {
            this.submitted = false;
            alert(response.data.message);
            this.title = '';
            this.description = '';
            this.post_image_upload = null;
            this.post_image_upload_preview = null;

            document.querySelector('#file_update').value = '';
            this.load = false;
            this.isDisabled = false;
            this.percentcompleteaxios = 0;
            this.uploadProgress = 0;
          })
          .catch(error => {
            this.submitted = false;
            if (error.response && error.response.status === 422) {
                   this.handleServerErrors(error.response.data.errors);
                    this.errors = Object.values(error.response.data.errors).flat();
                } else {
                    this.errors.push("An error occurred. Please try again.");
                }
            //alert(error.response.data.message);
            console.log(error);
            this.load = false;
            this.isDisabled = false;
            this.percentcompleteaxios = 0;
            this.uploadProgress = 0;
          });

          }
          else{
            alert(error);
            console.log(error);
            //document.querySelector('#send_file').disabled = false;
            this.load = false;
            this.uploadProgress = 0;
            this.isDisabled = false;
          }

    },
    UploadNewPost(type = "post") {
        const config = {
        headers: { "Content-Type": "multipart/form-data" },
                 onUploadProgress: progressEvent => {
                    this.uploadProgress = Math.round((progressEvent.loaded * 100) / progressEvent.total);
           }
         };
        let error = false;
        this.errors = [];
        this.submitted = true;
        let form = document.querySelector(".needs-validation");
        if (!form.checkValidity()){
            //alert("not valid");
            form.classList.add("was-validated");
            return;
        }

        this.addBeforeUnloadListener();
        
        //document.querySelector('#send_file').disabled = true;
        this.load = true;
        this.isDisabled = true;
        let formData = new FormData();
        formData.append("image", this.post_image_upload);
        formData.append("title", this.title);
        formData.append("description", this.description);
        formData.append("type", type);
        formData.append("status", this.status);
        if (!this.post_image_upload) {
        error = "Select img";
          } else {
              if (this.post_image_upload.size > 1000000) {
                  if (!confirm("Main image size is more than 1 MB, it might significantly affect page speed loading, continue uploading?")) {
                      error = "You can use an image compressor to make the image smaller";
                  }
              }
          }
        for (let i = 1; i <= 9; i++) {
          const previewProp = `post_image_upload_preview_${i}`;
          const imageProp = `post_image_upload_${i}`;

          if (this[previewProp]) {
              formData.append(`image_${i}`, this[imageProp]);

              if (this[imageProp].size > 1000000) {
                  if (!confirm(`Image ${i} size is more than 1 MB, it might significantly affect page speed loading, continue uploading?`)) {
                      error = "You can use an image compressor to make the image smaller";
                  }
              }
          }
      }

      if(!error){
    axios.post('/upload-post', formData, config, {
        headers: {
          'Content-Type': 'multipart/form-data'
        }
    })
    .then(response => {
            form.classList.remove("was-validated");
            form.querySelectorAll(".is-valid, .is-invalid").forEach((el) => {
              el.classList.remove("is-valid", "is-invalid");
            });
            this.submitted = false;
            alert(response.data.message);
            this.title = '';
            this.description = '';
            this.post_image_upload = null;
            this.post_image_upload_preview = null;

            for (let i = 1; i <= 9; i++) {
                this[`post_image_upload_${i}`] = null;
                this[`post_image_upload_preview_${i}`] = null;
            }

            document.querySelector('#file').value = '';
            this.load = false;
            this.isDisabled = false;
            //document.querySelector('#send_file').disabled = false;
            this.percentcompleteaxios = 0;
            this.uploadProgress = 0;
            this.fetchPosts(type);
            this.removeBeforeUnloadListener();
          })
          .catch(error => {
            this.submitted = false;
            if (error.response && error.response.status === 422) {
                   this.handleServerErrors(error.response.data.errors);
                    this.errors = Object.values(error.response.data.errors).flat();
                } else {
                    this.errors.push("An error occurred. Please try again.");
                }
            //alert(error.response.data.message);
            console.log(error);
            this.load = false;
            this.isDisabled = false;
            this.percentcompleteaxios = 0;
            this.uploadProgress = 0;
            this.show_more = false;
          });

          }
          else{
            alert(error);
            console.log(error);
            //document.querySelector('#send_file').disabled = false;
            this.load = false;
            this.uploadProgress = 0;
            this.isDisabled = false;
          }



    },
    delete_img_product: function(number) {
        if (confirm("Delete this image?")) {
            this[`post_image_upload_preview_${number + 1}`] = false;
            this[`post_image_upload_${number + 1}`] = "";
        }
    },
    imagechanged_product: function(number) {
        this.error = false;
        this.errorshowo = {};
        let formData = new FormData();
        let imagefile = document.querySelector('#file_' + number);

        if (imagefile.files[0].size > 20000000) {
            this.errorshowo.imagefile = 'Not more than 20 mb';
        }

        if (Object.keys(this.errorshowo).length === 0) {
            this[`post_image_upload_preview_${number + 1}`] = URL.createObjectURL(imagefile.files[0]);
            this[`post_image_upload_${number + 1}`] = imagefile.files[0];
        }

        //console.log(number);
    },
    registerUser() {
            this.errors = [];
            let form = document.querySelector(".needs-validation");

            if (!form.checkValidity() || this.password !== this.password_confirmation) {
                form.classList.add("was-validated");

                if (this.password !== this.password_confirmation) {
                    this.errors.push("Passwords do not match.");
                    //this.handleServerErrors(this.errors);
                    //this.validatePasswords();
                }
                return;
            }

            this.isDisabled = true;
            this.message = "Registering...";

            axios.post('/register', {
                name: this.fullname,
                email: this.email,
                password: this.password,
                password_confirmation: this.password_confirmation
            })
            .then(response => {
              this.isDisabled = false;
                //window.location.href = response.data.redirect || '/';
              alert(response.data);
            })
            .catch(error => {
                this.isDisabled = false;
                this.message = "Register";
                if (error.response && error.response.status === 422) {
                   this.handleServerErrors(error.response.data.errors);
                    this.errors = Object.values(error.response.data.errors).flat();
                } else {
                    this.errors.push("An error occurred. Please try again.");
                }
            });
        },
     ChangePassword() {
            this.errors = [];
            let form = document.querySelector(".needs-validation");

            if (!form.checkValidity() || this.password !== this.password_confirmation) {
                form.classList.add("was-validated");

                if (this.password !== this.password_confirmation) {
                    this.errors.push("Passwords do not match.");
                    //this.handleServerErrors(this.errors);
                    //this.validatePasswords();
                }
                return;
            }

            if (this.current_password == this.password) {
                    this.errors.push("New password has to be different from current password");
                    return;
                }
                

            this.isDisabled = true;
            this.message = "Changing pass...";

            axios.post('/updatepass', {
                current_password: this.current_password,
                password: this.password,
                password_confirmation: this.password_confirmation
            })
            .then(response => {
              this.isDisabled = false;
              alert(response.data);
            })
            .catch(error => {
                this.isDisabled = false;
                //this.message = "Register";
                if (error.response && error.response.status === 422) {
                   this.handleServerErrors(error.response.data.errors);
                    this.errors = Object.values(error.response.data.errors).flat();
                } else {
                    this.errors.push("An error occurred. Please try again.");
                }
            });
        },
     handleServerErrors(errors) {
        let form = document.querySelector(".needs-validation");

    form.classList.remove("was-validated");

    form.querySelectorAll("input").forEach(input => {
        input.classList.remove("is-invalid", "is-valid");

        let feedback = input.closest(".mb-3")?.querySelector(".invalid-feedback");
        if (feedback) {
            feedback.style.display = "none";
        }
    });

    this.errors = Object.values(errors).flat();
    },
    validateField(event) {
        let input = event.target;

        if (!input.checkValidity()) {
            input.classList.add("is-invalid");
            input.classList.remove("is-valid");
        } else {
            input.classList.add("is-valid");
            input.classList.remove("is-invalid");
        }
    },
    ResetPass() {
      this.errors = [];
        let form = document.querySelector(".needs-validation");

        if (!form.checkValidity()) {
            form.classList.add("was-validated");
            return;
        }

        this.isDisabled = true;
        this.message = "Sending email...";


        axios.post('/resetpass', { email: this.email })
            .then(response => {
                this.isDisabled = false;
                console.log(response.data);
                alert(response.data);
            })

        .catch(error => {
            this.isDisabled = false;

              let errors = error.response?.data?.errors || { custom: ["Something went wrong. Please try again."] }; 
              //errors = { custom: ["Something went wrong. Please try again."] };
              
              this.handleServerErrors(errors);
        });

    },
    loginUser() {
        this.errors = [];
        let form = document.querySelector(".needs-validation");

        if (!form.checkValidity()) {
            form.classList.add("was-validated");
            return;
        }

        let maxAttempts = 5;
        let attemptsLeft = localStorage.getItem("loginAttempts");

        if (attemptsLeft === null) {
            attemptsLeft = maxAttempts;
        } else {
            attemptsLeft = parseInt(attemptsLeft);
        }

        this.isDisabled = true;
        this.message = "Logging in...";

        axios.post('/login', { email: this.email, password: this.password })
            .then(response => {
                localStorage.removeItem("loginAttempts");
                window.location.href = response.data.redirect || '/';
            })
            .catch(error => {
            this.isDisabled = false;

              let errors = error.response?.data?.errors || {}; // Ensure it's always an object

              if(error.response.status === 405){
                this.askForVerificationCode();
                errors = { custom: ["⛔ Please check your email for the code. Your account has been locked due to multiple failed login attempts"] };
              }
              else if (error.response.status === 403) {
                  errors = { custom: ["⛔ Your account has been locked due to multiple failed login attempts. Please reset your password or contact support."] };
              }
              else if (error.response.status === 406) {
                  errors = { custom: ["⛔ Your account has been blocked by admin. Please contact support."] };
              }
               else if (error.response.status === 429) {
                  const minutes = error.response.data.minutes_left || 1;
                  console.log(error.response.data.minutes_left);
                  console.log(error.response.data.message);
                  errors = { custom: [`🚨 Too many login attempts. Try again later.`] };
              } else if (error.response.status === 422) {
                  attemptsLeft = Math.max(0, attemptsLeft - 1);
                  localStorage.setItem("loginAttempts", attemptsLeft);
                  errors.custom = [`⚠️ Warning: You have ${attemptsLeft} attempts left.`];
              } else {
                  errors = { custom: ["Something went wrong. Please try again."] };
              }

              this.handleServerErrors(errors);
        });
    },
    askForVerificationCode() {
    let userCode = prompt("A verification code was sent to your email. Enter the code:");

    if (userCode) {
      console.log(userCode);
        axios.post('/verify-email-code', { email: this.email, password: this.password, verification_code: userCode })
            .then(response => {
                window.location.href = response.data.redirect || '/';
            })
            .catch(error => {
                alert("Invalid verification code. Please try again.");
            });
    }
},
    /*updatePost(postId, updatedName, updatedEmail) {
    axios.put(`/update-post/${postId}`, {
        fullname: updatedName,
        email: updatedEmail
    }).then(response => {
        console.log("Post updated:", response.data);
    }).catch(error => {
        console.error("Update failed:", error.response.data);
    });
},*/
    deleteimage(id){
      axios.delete('/delete-image/' + id)
    .then(response => {
        console.log("Deleted:", response.data);
    })
    .catch(error => {
        console.error("Delete failed:", error.response.data);
    });

    },
    fetchImages() {
                    this.loading = true;
                    axios.get('/api/images')
                        .then(response => {
                          console.log(response.data);
                            this.images = response.data;
                            this.loading = false;
                        })
                        .catch(error => {
                          this.isDisabled = false;
                            this.error = "Failed to load images.";
                            console.error(error);
                            this.loading = false;
                        });
                },
        delete_img_before_upload: function(img_name, index){
      if(confirm("Delete this image?")){
        //console.log(img_name);
        //console.log(index);
        this.multiple_img_arr_preview_new.splice(index, 1);
        //this.multiple_img_arr_preview_reverse = this.multiple_img_arr_preview_new.reverse();
        this.multiple_img_arr_upload.delete(img_name);

        this.multiple_img_arr_upload.forEach((value, key) => {
          //console.log("Key:", key, "Value:", value);
        });
      }
      
    },
        image_changed_multiple: function(){
    this.error = false;
    this.errorshowo = {};
    //let formData = new FormData();
    let imagefile = document.querySelector('#file_image');
    //console.log(imagefile.files.length);
    let number = imagefile.files.length;
    for (let i = 0; i < imagefile.files.length; i++) {
      //this.multiple_img_arr_preview.push(URL.createObjectURL(imagefile.files[i]));
     /* if(imagefile.files[i].size > 1000000){
        let too_large = true;
      }
      else{
        let too_large = false;
      }*/
      let imageInfo = {
        url: URL.createObjectURL(imagefile.files[i]),
        name: "image_" + this.counter,
        description: "",
        size:imagefile.files[i].size,
      };
      this.multiple_img_arr_preview_new.unshift(imageInfo);
      this.multiple_img_arr_upload.append("image_" + this.counter, imagefile.files[i]);
      console.log(this.multiple_img_arr_upload);
      this.counter++;
      
    }

  },
  image_changed_multiple_new: function(){
    this.error = false;
    this.errorshowo = {};
    //let formData = new FormData();
    let imagefile = document.querySelector('#file_image_new');
    //console.log(imagefile.files.length);
    let number = imagefile.files.length;
    for (let i = 0; i < imagefile.files.length; i++) {
      //this.multiple_img_arr_preview.push(URL.createObjectURL(imagefile.files[i]));
     /* if(imagefile.files[i].size > 1000000){
        let too_large = true;
      }
      else{
        let too_large = false;
      }*/
      let imageInfo = {
        url: URL.createObjectURL(imagefile.files[i]),
        name: "image_" + this.counter,
        description: "",
        size:imagefile.files[i].size,
      };
      this.multiple_img_arr_preview_new.unshift(imageInfo);
      this.multiple_img_arr_upload.append("image_" + this.counter, imagefile.files[i]);
      console.log(this.multiple_img_arr_upload);
      this.counter++;
      
    }

  },
    onFileChange(event) {
                    this.file = event.target.files[0];
                },
                uploadImage() {
                    if (!this.file) {
                        this.message = "Please select a file!";
                        return;
                    }
                    this.isUploading = true;
                    let formData = new FormData();
                    formData.append("image", this.file);
                    formData.append("fullname", this.fullname);

                    const config = {
                        headers: { "Content-Type": "multipart/form-data" },
                        onUploadProgress: progressEvent => {
                            this.uploadProgress = Math.round((progressEvent.loaded * 100) / progressEvent.total);
                        }
                    };

                    axios.post("/upload-image", formData, config)
                    .then(response => {
                        this.message = response.data.message; // Show success message
                        this.isUploading = false;
                        this.file = null;
                        this.uploadProgress = 0;
                    })
                    .catch(error => {
                      this.uploadProgress = 0;
                        this.isUploading = false;
                        this.message = "An error occurred. Please try again.";
                        console.error(error);
                        //alert(error);
                        if (error.response) {
                          // Laravel validation errors
                          console.error('Error:', error.response.data);
                          //alert(error.response.data);
                          if (error.response.status === 422) {
                              console.error("Validation Error: " + JSON.stringify(error.response.data.errors));
                          } else {
                              console.error("Upload failed: " + error.response.data.error);
                              alert(error.response.data.error);
                          }
                      } else {
                          console.error("Network error or server is down.");
                      }
                    });
                },
  galleryTotalPages() {
    return Math.ceil(this.gallery.length / this.itemsPerPage);
  },
  paginatedGallery() {
    const start = (this.currentPage - 1) * this.itemsPerPage;
    const end = start + this.itemsPerPage;
    return this.gallery.slice(start, end);
  },
  changeGalleryPage(page) {
    if (page === '...') return;
    this.currentPage = page;
  },
  previousGalleryPage() {
    if (this.currentPage > 1) {
      this.currentPage--;
    }
  },
  nextGalleryPage() {
    if (this.currentPage < this.galleryTotalPages()) {
      this.currentPage++;
    }
  },
  getGalleryVisiblePages() {
    const totalPages = this.galleryTotalPages();
    const maxVisible = 5; 
    const pages = [];

    if (totalPages <= maxVisible) {
      for (let i = 1; i <= totalPages; i++) {
        pages.push(i);
      }
    } else {
      if (this.currentPage <= 3) {
        pages.push(1, 2, 3, 4, '...', totalPages);
      } else if (this.currentPage >= totalPages - 2) {
        pages.push(1, '...', totalPages - 3, totalPages - 2, totalPages - 1, totalPages);
      } else {
        pages.push(1, '...', this.currentPage - 1, this.currentPage, this.currentPage + 1, '...', totalPages);
      }
    }
    return pages;
  },
  //posts pagination
  postsTotalPages() {
    return Math.ceil(this.posts.length / this.itemsPerPage);
  },
  paginatedPosts() {
    const start = (this.currentPage - 1) * this.itemsPerPage;
    const end = start + this.itemsPerPage;
    return this.posts.slice(start, end);
  },
  changePostsPage(page) {
    if (page === '...') return;
    this.currentPage = page;
  },
  previousPostsPage() {
    if (this.currentPage > 1) {
      this.currentPage--;
    }
  },
  nextPostsPage() {
    if (this.currentPage < this.postsTotalPages()) {
      this.currentPage++;
    }
  },
  getPostsVisiblePages() {
    const totalPages = this.postsTotalPages();
    const maxVisible = 5; 
    const pages = [];

    if (totalPages <= maxVisible) {
      for (let i = 1; i <= totalPages; i++) {
        pages.push(i);
      }
    } else {
      if (this.currentPage <= 3) {
        pages.push(1, 2, 3, 4, '...', totalPages);
      } else if (this.currentPage >= totalPages - 2) {
        pages.push(1, '...', totalPages - 3, totalPages - 2, totalPages - 1, totalPages);
      } else {
        pages.push(1, '...', this.currentPage - 1, this.currentPage, this.currentPage + 1, '...', totalPages);
      }
    }
    return pages;
  },
  //end post pagination
        uploadMultiImages() {
                    if(Object.keys(this.multiple_img_arr_preview_new).length == 0){
                      this.message_for_user = "Please select a file!";
                      return;
                    }
                    this.isUploading = true;

                    this.addBeforeUnloadListener();
                    
                    //this.multiple_img_arr_upload.append("type", "gallery");

                    const config = {
                        headers: { "Content-Type": "multipart/form-data" },
                        onUploadProgress: progressEvent => {
                            this.uploadProgress = Math.round((progressEvent.loaded * 100) / progressEvent.total);
                        }
                    };
                    this.message_for_user = false;
                    axios.post("/upload-gallery", this.multiple_img_arr_upload, config)
                    .then(response => {
                        this.message_for_user = response.data.message;
                        this.isUploading = false;
                        this.file = null;
                        this.uploadProgress = 0;
                        document.querySelector('#file_image').value = '';
                        this.multiple_img_arr_upload = new FormData();
                        this.multiple_img_arr_preview_new = [];
                        this.fetchGallery();
                        this.removeBeforeUnloadListener();
                    })
                    .catch(error => {
                      this.uploadProgress = 0;
                        this.isUploading = false;
                        this.message_for_user = "An error occurred. Please try again.";
                        console.error(error);
                        //alert(error);
                        if (error.response) {
                          // Laravel validation errors
                          console.error('Error:', error.response.data);
                          //alert(error.response.data);
                          if (error.response.status === 422) {
                              console.error("Validation Error: " + JSON.stringify(error.response.data.errors));
                          } else {
                              console.error("Upload failed: " + error.response.data.error);
                              alert(error.response.data.error);
                          }
                      } else {
                          console.error("Network error or server is down.");
                      }
                    });
                },
    resetUpdatePostForm() {
        this.title = '';
        this.description = '';
        this.post_image_upload = null;
        this.post_image_upload_preview = null;
        this.upload_post = false;

        for (let i = 1; i <= 9; i++) {
            this[`post_image_upload_${i}`] = null;
            this[`post_image_upload_preview_${i}`] = null;
        }

        const fileInput = document.querySelector('#file_update');
        const fileInput_1 = document.querySelector('#file');
        if (fileInput) fileInput.value = '';
        if (fileInput_1) fileInput_1.value = '';
    },
    submitForm() {
      this.isDisabled = true;
      this.message = "Submitting...";

      let param = {
        fullname: this.fullname,
        email: this.email,
      };

      axios.post('/formsubmitted', param)
        .then(response => {
          this.message = response.data; // Show success message
          this.isDisabled = false;
          this.fullname = '';
          this.email = '';
        })
        .catch(error => {
          this.isDisabled = false;
          this.message = "An error occurred. Please try again.";
          console.error(error);
        });
    },
  },
    mounted(){
    let modalEl = document.getElementById('update_post');
    if (modalEl) {
        modalEl.addEventListener('hidden.bs.modal', () => {
                this.resetUpdatePostForm();
        });
    }
        if(document.querySelector("#fancybox_active")){
        Fancybox.bind("[data-fancybox]", {
          // Your custom options
        });
      }
     let hrefthis = window.location.href;
     let main_url = window.location.protocol + "//" + window.location.host;
     let main_url_2 = main_url + '/';
     let main_url_3 = main_url + '/#';
     if(hrefthis == main_url || hrefthis == main_url_2 || hrefthis == main_url_3){
        this.main_page = true;
        this.not_main_page = false;
      }
      else{
        this.main_page = false;
        this.not_main_page = true;
      }
     if(hrefthis.lastIndexOf('gallery') != -1){
        this.itemsPerPage = 100;
        this.fetchGallery();
     }
     if(hrefthis.lastIndexOf('single-post/') != -1){
        this.not_main_page = false; //it's only for header
     }
     if(hrefthis.lastIndexOf('posts') != -1){
        this.itemsPerPage = 12;
        this.fetchPosts('post');
     }
     if(hrefthis.lastIndexOf('market') != -1){
        this.itemsPerPage = 12;
        this.fetchPosts('market');
     }
     if(hrefthis.lastIndexOf('all-users') != -1){
        this.fetchUsers();
     }
     if(this.main_page){
        //this.fetchImages();
    }
     //this.updatePost(59, 'updated17','updatedemail15@gmail.com');
     //this.deleteimage(67);
      console.log(Vue.version);
      /*console.log(axios); 
      axios.get("https://jsonplaceholder.typicode.com/todos/1")
      .then(response => console.log("Axios works:", response.data))
      .catch(error => console.error("Axios error:", error));*/
      
    
  }
}

Vue.createApp(EventHandling).mount('#app');