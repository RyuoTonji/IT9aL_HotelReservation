<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function upload(Request $request)
    {
        // Validate the uploaded file
        $request->validate([
            'image' => 'required|image|max:2048', // max 2MB
        ]);

        // Get the file
        $image = $request->file('image');

        // Generate a unique name for the image
        $hotel_lobby = time() . '.' . $image->getClientOriginalExtension();

        // Move the file to the public directory (e.g., public/images)
        $image->move(public_path('images'), $hotel_lobby);

        // Optionally, save the image name to the database
        // $imagePath = 'images/' . $imageName;
        // YourModel::create(['image' => $imagePath]);

        return back()->with('success', 'Image uploaded successfully!');
    }
}
