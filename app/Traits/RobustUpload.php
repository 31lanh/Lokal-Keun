<?php

namespace App\Traits;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

trait RobustUpload
{
    /**
     * Upload file to Cloudinary using raw REST API (Bypassing broken Composer package)
     */
    protected function uploadFile(UploadedFile $file, string $folder)
    {
        // 1. Try Cloudinary REST API
        try {
            $cloudinaryUrl = env('CLOUDINARY_URL');
            
            if (!$cloudinaryUrl) {
                throw new \Exception("CLOUDINARY_URL not found in .env");
            }

            // Parse CLOUDINARY_URL=cloudinary://API_KEY:API_SECRET@CLOUD_NAME
            $parsed = parse_url($cloudinaryUrl);
            $apiKey = $parsed['user'];
            $apiSecret = $parsed['pass'];
            $cloudName = $parsed['host'];

            // Prepare Upload
            $timestamp = time();
            $params = [
                'folder' => $folder,
                'timestamp' => $timestamp,
            ];

            // Generate Signature
            // Signature is created by sorting params and appending secret
            ksort($params);
            $stringToSign = "";
            foreach ($params as $key => $value) {
                $stringToSign .= "{$key}={$value}&";
            }
            $stringToSign = rtrim($stringToSign, "&");
            $stringToSign .= $apiSecret;
            
            $signature = sha1($stringToSign);
            
            // Add signature and api_key to params to send
            $params['api_key'] = $apiKey;
            $params['signature'] = $signature;

            // Send Request
            $response = Http::asMultipart()
                ->attach('file', file_get_contents($file->getRealPath()), $file->getClientOriginalName())
                ->post("https://api.cloudinary.com/v1_1/{$cloudName}/image/upload", $params);

            if ($response->successful()) {
                $data = $response->json();
                return (object) [
                    'path' => $data['secure_url'],
                    'url'  => $data['secure_url']
                ];
            } else {
                throw new \Exception("Cloudinary API Error: " . $response->body());
            }

        } catch (\Exception $e) {
            Log::error("Cloudinary Manual Upload Failed: " . $e->getMessage());
            
            // Re-throw if user forced strict mode, OR fallback if we decided to go back to fallback.
            // User asked: "Should we switch?" -> I say stick with Cloudinary but use API.
            throw $e; 
        }
    }
}
