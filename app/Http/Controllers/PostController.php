<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Posts;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Models\Image;
use App\Models\Usertext;
use App\Models\Gallery;
use App\Helpers\ImageHelper;

class PostController extends Controller
{
  public function updateText(Request $request)
    {
        try {
            $request->validate([
                'id' => 'required|integer|min:0',
                'text' => 'required|min:5|max:15000',
                'page' => 'nullable|min:5|max:50',
            ]);
            $id = (int) $request->input('id');
            $Usertext = Usertext::findOrFail($id);

            $Usertext->update([
                'text' => $request->input('text'),
                'page' => $request->input('page'),
            ]);

            return response()->json([
                'message' => "Post updated successfully!",
                'post' => $Usertext
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Update failed: ' . $e->getMessage()], 500);
        }
    }
    public function uploadNewPostWithID(Request $request)
{
    try {
        $request->validate([
            'title' => 'required|string|min:3|max:250',
            'description' => 'required|string|min:3|max:15000',
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,webp,avif|max:20480',
            'id' => 'required|integer|min:0',
            'type' => 'nullable|string|min:3|max:250',
            'status' => 'nullable',
            'image_1' => 'nullable|image|mimes:jpg,png,jpeg,gif,webp,avif|max:20480',
            'image_2' => 'nullable|image|mimes:jpg,png,jpeg,gif,webp,avif|max:20480',
            'image_3' => 'nullable|image|mimes:jpg,png,jpeg,gif,webp,avif|max:20480',
            'image_4' => 'nullable|image|mimes:jpg,png,jpeg,gif,webp,avif|max:20480',
            'image_5' => 'nullable|image|mimes:jpg,png,jpeg,gif,webp,avif|max:20480',
            'image_6' => 'nullable|image|mimes:jpg,png,jpeg,gif,webp,avif|max:20480',
            'image_7' => 'nullable|image|mimes:jpg,png,jpeg,gif,webp,avif|max:20480',
            'image_8' => 'nullable|image|mimes:jpg,png,jpeg,gif,webp,avif|max:20480',
            'image_9' => 'nullable|image|mimes:jpg,png,jpeg,gif,webp,avif|max:20480',
        ]);

        $add_id = (int) $request->input('id');

        \DB::statement("UPDATE posts SET id = id + 1 WHERE id > ? ORDER BY id DESC", [$add_id]);

        $mainImage = $request->file('image');
        $mainImageName = uniqid('img_', true) . '_'. time() . '.' . $mainImage->getClientOriginalExtension();
        $mainImage->move(public_path('images_folder/posts'), $mainImageName);

        $type = $request->filled('type') ? $request->input('type') : 'post';
        $status = $request->filled('status') ? $request->input('status') : 0;

        $postData = [
            'id' => $add_id + 1,
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'main_img' => 'images_folder/posts/' . $mainImageName,
            'type' => $type,
            'status_sold' => $status,
            'created_at' => now(),
            'updated_at' => now(),
        ];

        for ($i = 1; $i <= 9; $i++) {
            $key = 'image_' . $i;

            if ($request->hasFile($key) && $request->file($key)->isValid()) {
                $file = $request->file($key);
                $uniqueName = uniqid('img_', true) . '_'. time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('images_folder/posts'), $uniqueName);
                $postData['img_path_' . $i] = 'images_folder/posts/' . $uniqueName;
            }
        }

        Posts::insert($postData);

        return response()->json(['message' => 'Post uploaded and inserted successfully!']);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Something went wrong: ' . $e->getMessage()], 500);
    }
}

    public function uploadNewPost(Request $request)
    {
        try {
            $request->validate([
                'title' => 'required|string|min:3|max:250',
                'description' => 'required|string|min:3|max:15000',
                'type' => 'nullable|string|min:3|max:250',
                'status' => 'nullable',
                'image' => 'required|image|mimes:jpg,png,jpeg,gif,webp,avif|max:20480',
                'image_1' => 'nullable|image|mimes:jpg,png,jpeg,gif,webp,avif|max:20480',
                'image_2' => 'nullable|image|mimes:jpg,png,jpeg,gif,webp,avif|max:20480',
                'image_3' => 'nullable|image|mimes:jpg,png,jpeg,gif,webp,avif|max:20480',
                'image_4' => 'nullable|image|mimes:jpg,png,jpeg,gif,webp,avif|max:20480',
                'image_5' => 'nullable|image|mimes:jpg,png,jpeg,gif,webp,avif|max:20480',
                'image_6' => 'nullable|image|mimes:jpg,png,jpeg,gif,webp,avif|max:20480',
                'image_7' => 'nullable|image|mimes:jpg,png,jpeg,gif,webp,avif|max:20480',
                'image_8' => 'nullable|image|mimes:jpg,png,jpeg,gif,webp,avif|max:20480',
                'image_9' => 'nullable|image|mimes:jpg,png,jpeg,gif,webp,avif|max:20480',
            ]);

            if (!$request->hasFile('image')) {
                return response()->json(['message' => 'No main image uploaded'], 422);
            }
            $type = $request->filled('type') ? $request->input('type') : 'post';
            $status = $request->has('status') ? $request->input('status') : 0;

            $mainImage = $request->file('image');
            $mainImageName = uniqid('img_', true) . '_'. time() . '.' . $mainImage->getClientOriginalExtension();
            $mainImage->move(public_path('images_folder/posts'), $mainImageName);

            // Create post
            $post = Posts::create([
                'title' => $request->input("title"),
                'description' => $request->input("description"),
                'main_img' => 'images_folder/posts/' . $mainImageName,
                'type' => $type,
                'status_sold' => $status,
            ]);

            // Upload other images (image_1 to image_9)
            for ($i = 1; $i <= 9; $i++) {
                $key = 'image_' . $i;

                if ($request->hasFile($key) && $request->file($key)->isValid()) {
                    $file = $request->file($key);
                    $uniqueName = uniqid('img_', true) . '_'. time() . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('images_folder/posts'), $uniqueName);

                    $attribute = 'img_path_' . $i;

                    if (in_array($attribute, \Schema::getColumnListing('posts'))) {
                        $post->{$attribute} = 'images_folder/posts/' . $uniqueName;
                    }
                }
            }

            $post->save();

            return response()->json(['message' => 'Post uploaded successfully!']);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Something went wrong: ' . $e->getMessage()], 422);
        }
    }

    public function updatePost(Request $request)
{
    try {
        $request->validate([
            'id' => 'required|integer|exists:posts,id',
            'title' => 'required|string|min:3|max:250',
            'description' => 'required|string|min:3|max:15000',
            'status' => 'nullable',
            'image' => 'nullable|image|mimes:jpg,png,jpeg,gif,webp,avif|max:20480',
            'image_1' => 'nullable|image|mimes:jpg,png,jpeg,gif,webp,avif|max:20480',
            'image_2' => 'nullable|image|mimes:jpg,png,jpeg,gif,webp,avif|max:20480',
            'image_3' => 'nullable|image|mimes:jpg,png,jpeg,gif,webp,avif|max:20480',
            'image_4' => 'nullable|image|mimes:jpg,png,jpeg,gif,webp,avif|max:20480',
            'image_5' => 'nullable|image|mimes:jpg,png,jpeg,gif,webp,avif|max:20480',
            'image_6' => 'nullable|image|mimes:jpg,png,jpeg,gif,webp,avif|max:20480',
            'image_7' => 'nullable|image|mimes:jpg,png,jpeg,gif,webp,avif|max:20480',
            'image_8' => 'nullable|image|mimes:jpg,png,jpeg,gif,webp,avif|max:20480',
            'image_9' => 'nullable|image|mimes:jpg,png,jpeg,gif,webp,avif|max:20480',
        ]);

        $post = Posts::findOrFail($request->input('id'));
        $post->title = $request->input('title');
        $post->description = $request->input('description');
        $post->status_sold = $request->filled('status') ? $request->input('status') : 0;

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            if ($post->main_img && File::exists(public_path($post->main_img))) {
                File::delete(public_path($post->main_img));
            }

            $mainImage = $request->file('image');
            $mainImageName = uniqid('img_', true) . '_' . time() . '.' . $mainImage->getClientOriginalExtension();
            $mainImage->move(public_path('images_folder/posts'), $mainImageName);
            $post->main_img = 'images_folder/posts/' . $mainImageName;
        }

        for ($i = 1; $i <= 9; $i++) {
            $key = 'image_' . $i;
            $attribute = 'img_path_' . $i;

            if ($request->hasFile($key) && $request->file($key)->isValid()) {
                if (!empty($post->{$attribute}) && File::exists(public_path($post->{$attribute}))) {
                    File::delete(public_path($post->{$attribute}));
                }

                $file = $request->file($key);
                $uniqueName = uniqid('img_', true) . '_' . time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('images_folder/posts'), $uniqueName);

                if (in_array($attribute, \Schema::getColumnListing('posts'))) {
                    $post->{$attribute} = 'images_folder/posts/' . $uniqueName;
                }
            }
        }

        $post->save();

        return response()->json(['message' => 'Post updated successfully!']);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Something went wrong: ' . $e->getMessage()], 422);
    }
}


    /*public function uploadWithImage(Request $request)
    {
         try {
            $request->validate([
                'fullname' => 'required|string|max:255',
                'image' => 'required|image|mimes:jpg,png,jpeg,gif,webp,avif|max:20480' // Max 20MB
            ]);

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '_' . $image->getClientOriginalName();
                $imagePath = public_path('images/' . $imageName);


    
                $fileName = time() . '_' . $image->getClientOriginalName();
                $extension = $image->getClientOriginalExtension();
                $copyPath = public_path('images/' . pathinfo($fileName, PATHINFO_FILENAME) . '_min.' . $extension);

                $image->move(public_path('images'), $imageName);

                if (!copy($imagePath, $copyPath)) {
                    return response()->json(['error' => "Failed to copy the file."], 500);
                }
                $compressed = ImageHelper::compressImg($copyPath, 500, 500, 70, 60000);

                Image::create([
                    'fullname' => $request->input('fullname'),
                    'imagename' => $imageName
                ]);

                return response()->json(['message' => 'Image uploaded successfully!', 'image' => '/images/' . $imageName]);
            }

            return response()->json(['message' => 'No image uploaded'], 400);
            } catch (\Exception $e) {
                    return response()->json(['error' => 'Something went wrong: ' . $e->getMessage()], 500);
        }

    }*/
    public function uploadWithImagesGallery(Request $request)
    {
    try {
        $saved = [];
        $image_save_folder = 'images_folder/gallery';

        foreach ($request->allFiles() as $key => $file) {

            $validator = \Validator::make([$key => $file], [
                $key => 'image|mimes:jpg,png,jpeg,gif,webp,avif|max:20480'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'error' => "Validation failed for $key",
                    'details' => $validator->errors()
                ], 422);
            }

            $imageName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $imageMinName = pathinfo($imageName, PATHINFO_FILENAME) . '_min.' . $file->getClientOriginalExtension();

            $imageFullPath = public_path($image_save_folder.'/' . $imageName);
            $imageMinPath = public_path($image_save_folder.'/' . $imageMinName);

            $file->move(public_path($image_save_folder), $imageName);

            if (!copy($imageFullPath, $imageMinPath)) {
                return response()->json(['error' => "Failed to copy the file."], 500);
            }
            if (filesize($imageMinPath) > 20 * 1024) {
                $compressed = ImageHelper::compressImg($imageMinPath, 500, 500, 70, 60000);
            }

            Gallery::create([
                'img_full' => $image_save_folder.'/' . $imageName,
                'img_min' => $image_save_folder.'/' . $imageMinName
            ]);

            $saved[] = ['img_full' => $image_save_folder.'/' . $imageName, 'img_min' => $image_save_folder. '/' . $imageMinName];
        }

        return response()->json(['message' => 'All images uploaded successfully!', 'files' => $saved]);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Something went wrong: ' . $e->getMessage()], 500);
    }

    }
    public function uploadWithImagesGalleryByID(Request $request)
    {
        try {
            $saved = [];
            $image_save_folder = 'images_folder/gallery';

            // Get ID after which to insert
            $img_add_id = $request->input('img_add_id');
            if (!$img_add_id || !is_numeric($img_add_id)) {
                return response()->json(['error' => 'Invalid or missing img_add_id.'], 422);
            }

            $files = $request->allFiles();
            $fileCount = count($files);

            // Shift existing IDs
            \DB::statement("UPDATE gallery SET id = id + ? WHERE id > ? ORDER BY id DESC", [$fileCount, $img_add_id]);

            $nextInsertId = $img_add_id + 1;

            foreach ($files as $key => $file) {
                $validator = \Validator::make([$key => $file], [
                    $key => 'image|mimes:jpg,png,jpeg,gif,webp,avif|max:20480'
                ]);

                if ($validator->fails()) {
                    return response()->json([
                        'error' => "Validation failed for $key",
                        'details' => $validator->errors()
                    ], 422);
                }

                $imageName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $imageMinName = pathinfo($imageName, PATHINFO_FILENAME) . '_min.' . $file->getClientOriginalExtension();

                $imageFullPath = public_path($image_save_folder.'/' . $imageName);
                $imageMinPath = public_path($image_save_folder.'/' . $imageMinName);

                $file->move(public_path($image_save_folder), $imageName);

                if (!copy($imageFullPath, $imageMinPath)) {
                    return response()->json(['error' => "Failed to copy the file."], 500);
                }

                if (filesize($imageMinPath) > 20 * 1024) {
                    ImageHelper::compressImg($imageMinPath, 500, 500, 70, 60000);
                }

                // Insert at a specific ID
                Gallery::insert([
                    'id' => $nextInsertId++,
                    'img_full' => $image_save_folder . '/' . $imageName,
                    'img_min' => $image_save_folder . '/' . $imageMinName,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                $saved[] = [
                    'img_full' => $image_save_folder.'/' . $imageName,
                    'img_min' => $image_save_folder.'/' . $imageMinName
                ];
            }

            return response()->json(['message' => 'All images uploaded successfully!', 'files' => $saved]);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Something went wrong: ' . $e->getMessage()], 500);
        }
    }

    public function changeWithImageGallery(Request $request)
    {
        try {
            $id = $request->input('id');
            $file = $request->file('image');

            if (!$id || !$file) {
                return response()->json(['error' => 'Missing ID or image file.'], 422);
            }

            $validator = \Validator::make(['image' => $file], [
                'image' => 'image|mimes:jpg,png,jpeg,gif,webp,avif|max:20480'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'error' => 'Validation failed.',
                    'details' => $validator->errors()
                ], 422);
            }

            $gallery = Gallery::findOrFail($id);

            $oldFullPath = public_path($gallery->img_full);
            $oldMinPath = public_path($gallery->img_min);

            if (File::exists($oldFullPath)) File::delete($oldFullPath);
            if (File::exists($oldMinPath)) File::delete($oldMinPath);

            $image_save_folder = 'images_folder/gallery';
            $imageName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $imageMinName = pathinfo($imageName, PATHINFO_FILENAME) . '_min.' . $file->getClientOriginalExtension();

            $file->move(public_path($image_save_folder), $imageName);

            $imageFullPath = public_path($image_save_folder . '/' . $imageName);
            $imageMinPath = public_path($image_save_folder . '/' . $imageMinName);

            copy($imageFullPath, $imageMinPath);

            if (filesize($imageMinPath) > 20 * 1024) {
                ImageHelper::compressImg($imageMinPath, 500, 500, 70, 60000);
            }

            $gallery->update([
                'img_full' => $image_save_folder . '/' . $imageName,
                'img_min' => $image_save_folder . '/' . $imageMinName
            ]);

            return response()->json(['message' => 'Image updated successfully.']);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Something went wrong: ' . $e->getMessage()], 500);
        }
    }

    public function changeWithImagePosts(Request $request)
    {
        try {
            $id = $request->input('id');
            $file = $request->file('image');

            if (!$id || !$file) {
                return response()->json(['error' => 'Missing ID or image file.'], 422);
            }

            $validator = \Validator::make(['image' => $file], [
                'image' => 'image|mimes:jpg,png,jpeg,gif,webp,avif|max:20480'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'error' => 'Validation failed.',
                    'details' => $validator->errors()
                ], 422);
            }

            $posts = Posts::findOrFail($id);

            $oldFullPath = public_path($posts->main_img);

            if (File::exists($oldFullPath)) File::delete($oldFullPath);

            $image_save_folder = 'images_folder/posts';
            $imageName = uniqid('img_', true) . '_'. time() . '.' . $file->getClientOriginalExtension();

            $file->move(public_path($image_save_folder), $imageName);

            $imageFullPath = public_path($image_save_folder . '/' . $imageName);

            $posts->update([
                'main_img' => $image_save_folder . '/' . $imageName,
            ]);

            return response()->json(['message' => "Post's main img updated successfully."]);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Something went wrong: ' . $e->getMessage()], 500);
        }
    }


    public function changeImageImages(Request $request)
    {
        try {
            $id = $request->input('id');
            $file = $request->file('image');

            if (!$id || !$file) {
                return response()->json(['error' => 'Missing ID or image file.'], 422);
            }

            $validator = \Validator::make(['image' => $file], [
                'image' => 'image|mimes:jpg,png,jpeg,gif,webp,avif|max:20480'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'error' => 'Validation failed.',
                    'details' => $validator->errors()
                ], 422);
            }

            $image_db = Image::findOrFail($id);

            $oldFullPath = public_path($image_db->imagename);

            if (File::exists($oldFullPath)) File::delete($oldFullPath);

            $image_save_folder = 'images/';
            $imageName = uniqid('img_', true) . '_'. time() . '.' . $file->getClientOriginalExtension();

            $file->move(public_path($image_save_folder), $imageName);

            $image_db->update([
                'imagename' => $image_save_folder . '/' . $imageName,
            ]);

            return response()->json(['message' => "Img updated successfully."]);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Something went wrong: ' . $e->getMessage()], 500);
        }
    }

    public function deleteImagePost($id)
    {
        try {
            $image = Image::findOrFail($id);
            $imagePath = public_path('images/' . $image->imagename);

            if (File::exists($imagePath) && is_file($imagePath)) {
                File::delete($imagePath); 
            }
            /*
            if (file_exists($imagePath) && is_file($imagePath)) {
            unlink($imagePath); 
        }
        */

            $image->delete();

            return response()->json(['message' => 'Image deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Something went wrong: ' . $e->getMessage()], 500);
        }
    }
    public function deleteImageGallery($id)
    {
        try {
            $image = Gallery::findOrFail($id);
            $imagePath = public_path($image->img_full);
            $imagePath_min = public_path($image->img_min);

            if (File::exists($imagePath) && is_file($imagePath) & File::exists($imagePath_min) && is_file($imagePath_min)) {
                File::delete($imagePath); 
                File::delete($imagePath_min); 
            }
            /*
            if (file_exists($imagePath) && is_file($imagePath)) {
            unlink($imagePath); 
        }
        */

            $image->delete();

            return response()->json(['message' => 'Image deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Something went wrong: ' . $e->getMessage()], 500);
        }
    }
    public function deletePost($id)
    {
        try {
            $post = Posts::findOrFail($id);
            $imagePath_main = public_path($post->main_img);

            if (File::exists($imagePath_main) && is_file($imagePath_main)) {
                File::delete($imagePath_main); 
            }

            for ($i = 1; $i <= 9; $i++) {
            $field = 'img_path_' . $i;
            if (!empty($post->$field)) {
                    $path = public_path($post->$field);
                    if (File::exists($path) && is_file($path)) {
                        File::delete($path);
                    }
                }
            }

            $post->delete();

            return response()->json(['message' => 'Post deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Something went wrong: ' . $e->getMessage()], 500);
        }
    }
    public function deletePostImg($id,$img_path_number)
    {
        try {
            $post = Posts::findOrFail($id);
            $field = 'img_path_' . $img_path_number;
            if (!empty($post->$field)) {
                $path = public_path($post->$field);
                if (File::exists($path) && is_file($path)) {
                    File::delete($path); 
                }
            }

            $post->update([
                $field => '',
            ]);

            return response()->json(['message' => "Post's image deleted successfully"]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Something went wrong: ' . $e->getMessage()], 500);
        }
    }
    public function deleteMultipleGallery(Request $request)
    {
        try {
            $ids = $request->json('ids'); 

            if (!is_array($ids) || empty($ids)) {
                return response()->json(['error' => 'Invalid or empty ID list.'], 422);
            }

            $deletedCount = 0;
            $errors = "";
            foreach ($ids as $id) {
                $image = Gallery::find($id);
                if ($image) {
                    $imageFullPath = public_path($image->img_full);
                    $imageMinPath = public_path($image->img_min);

                    if (File::exists($imageFullPath) && is_file($imageFullPath) && File::exists($imageMinPath) && is_file($imageMinPath)) {
                        File::delete($imageFullPath);
                        File::delete($imageMinPath);
                        $image->delete();
                        $deletedCount++;
                    }
                    else{
                        $errors = $errors + " file not found, id: " + $id;
                    }
                    
                }
            }

            return response()->json(['message' => 'Images deleted successfully '.$errors]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Something went wrong: ' . $e->getMessage()], 500);
        }

        //return response()->json(['message' => $deletedCount." images have been deleted."]);
    }
    public function deleteMultiplePosts(Request $request)
    {
        try {
            $ids = $request->json('ids'); 

            if (!is_array($ids) || empty($ids)) {
                return response()->json(['error' => 'Invalid or empty ID list.'], 422);
            }

            $deletedCount = 0;
            $errors = "";
            foreach ($ids as $id) {
                $post = Posts::findOrFail($id);
                $imagePath_main = public_path($post->main_img);

                if (File::exists($imagePath_main) && is_file($imagePath_main)) {
                    File::delete($imagePath_main); 
                }

                for ($i = 1; $i <= 9; $i++) {
                $field = 'img_path_' . $i;
                if (!empty($post->$field)) {
                        $path = public_path($post->$field);
                        if (File::exists($path) && is_file($path)) {
                            File::delete($path);
                        }
                    }
                }

                $post->delete();
            }

            return response()->json(['message' => 'Posts deleted successfully '.$errors]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Something went wrong: ' . $e->getMessage()], 500);
        }

        //return response()->json(['message' => $deletedCount." images have been deleted."]);
    }
}
