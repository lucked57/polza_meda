<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Image;

class AdminController extends Controller
{
    public function index()
    {
        return "Hello, Admin " . Auth::user()->name;
    }
    public function uploadNewImage(Request $request)
    {
         try {
            $request->validate([
                'page' => 'nullable|string|max:255',
                'image' => 'required|image|mimes:jpg,png,jpeg,gif,webp,avif|max:20480' // Max 20MB
            ]);

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = uniqid('img_', true) . '_'. time() . '.' . $image->getClientOriginalExtension();
                $imagePath = public_path('images/' . $imageName);

                $image->move(public_path('images'), $imageName);

                $imageName = 'images/'.$imageName;

                Image::create([
                    'page' => $request->input('page'),
                    'imagename' => $imageName
                ]);

                return response()->json(['message' => 'Image uploaded successfully!', 'image' => '/images/' . $imageName]);
            }

            return response()->json(['message' => 'No image uploaded'], 400);
            } catch (\Exception $e) {
                    return response()->json(['error' => 'Something went wrong: ' . $e->getMessage()], 500);
        }

    }
    public function blockUsers(Request $request)
    {
        $ids = $request->input('ids');

        if (!is_array($ids) || empty($ids)) {
            return response()->json(['message' => 'No users selected.'], 400);
        }

        $adminIds = User::whereIn('id', $ids)->where('is_admin', 1)->pluck('id')->toArray();

        $idsToLock = array_diff($ids, $adminIds);

        if (!empty($idsToLock)) {
            User::whereIn('id', $idsToLock)->update([
                'is_locked' => 1,
                'is_blocked_by_admin' => 1
            ]);
        }

        $message = count($idsToLock) . ' user(s) locked.';
        if (!empty($adminIds)) {
            $message .= ' Admin user(s) were skipped.';
        }

        return response()->json(['message' => $message]);
    }

    public function unLockUsers(Request $request)
    {
        $ids = $request->json('ids');

        if (!is_array($ids) || empty($ids)) {
            return response()->json(['message' => 'No users selected.'], 422);
        }

        $adminIds = User::whereIn('id', $ids)->where('is_admin', 1)->pluck('id')->toArray();

        $idsToUnlock = array_diff($ids, $adminIds);

        if (!empty($idsToUnlock)) {
            User::whereIn('id', $idsToUnlock)->update([
                'is_locked' => 0,
                'is_blocked_by_admin' => 0
            ]);
        }

        $message = count($idsToUnlock) . ' user(s) unlocked.';
        if (!empty($adminIds)) {
            $message .= ' Admin user(s) were skipped.';
        }

        return response()->json(['message' => $message]);
    }

}
