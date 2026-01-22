<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

Route::get('/debug-upload', function () {
    return '
    <form action="/debug-upload" method="POST" enctype="multipart/form-data">
        '. csrf_field() .'
        <input type="file" name="test_file">
        <button type="submit">Test Cloudinary Upload</button>
    </form>
    ';
});

Route::post('/debug-upload', function (Request $request) {
    try {
        if (!$request->hasFile('test_file')) {
            return "No file uploaded.";
        }

        $file = $request->file('test_file');
        echo "File detected: " . $file->getClientOriginalName() . "<br>";

        echo "Attempting storeOnCloudinary...<br>";
        
        // Explicitly check env first
        echo "Cloudinary URL configured: " . (env('CLOUDINARY_URL') ? 'Yes' : 'No') . "<br>";
        
        $result = $file->storeOnCloudinary('debug-test');
        
        echo "Upload Result Object: <pre>" . print_r($result, true) . "</pre><br>";
        
        echo "Secure Path: " . $result->getSecurePath() . "<br>";
        echo "Public ID: " . $result->getPublicId() . "<br>";
        
        return "<h3>Success!</h3>";

    } catch (\Exception $e) {
        return "<h3>FAILED</h3>" . 
               "Message: " . $e->getMessage() . "<br>" .
               "Trace: <pre>" . $e->getTraceAsString() . "</pre>";
    }
});
