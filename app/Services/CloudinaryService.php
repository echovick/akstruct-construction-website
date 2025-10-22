<?php

namespace App\Services;

use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;

class CloudinaryService
{
    /**
     * Upload a single image to Cloudinary
     *
     * @param UploadedFile $file
     * @param string $folder
     * @param array $options
     * @return string|null URL of uploaded image
     */
    public function uploadImage(UploadedFile $file, string $folder = 'projects', array $options = []): ?string
    {
        try {
            // Validate file exists and is readable
            if (!$file->isValid()) {
                Log::error('Invalid file for upload: ' . $file->getClientOriginalName());
                return null;
            }

            $defaultOptions = [
                'folder' => $folder,
            ];

            $uploadOptions = array_merge($defaultOptions, $options);

            // Upload to Cloudinary
            $result = Cloudinary::uploadApi()->upload($file->getRealPath(), $uploadOptions);

            if (!$result) {
                Log::error('Cloudinary upload returned null for file: ' . $file->getClientOriginalName());
                return null;
            }

            $uploadedFileUrl = $result['secure_url'] ?? null;

            if (!$uploadedFileUrl) {
                Log::error('Cloudinary result has no secure URL for file: ' . $file->getClientOriginalName());
                return null;
            }

            return $uploadedFileUrl;
        } catch (\Exception $e) {
            Log::error('Cloudinary upload exception', [
                'message' => $e->getMessage(),
                'file' => $file->getClientOriginalName(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ]);
            return null;
        }
    }

    /**
     * Upload multiple images to Cloudinary
     *
     * @param array $files
     * @param string $folder
     * @param array $options
     * @return array Array of URLs
     */
    public function uploadMultipleImages(array $files, string $folder = 'projects', array $options = []): array
    {
        $urls = [];

        foreach ($files as $file) {
            if ($file instanceof UploadedFile) {
                $url = $this->uploadImage($file, $folder, $options);
                if ($url) {
                    $urls[] = $url;
                }
            }
        }

        return $urls;
    }

    /**
     * Delete an image from Cloudinary
     *
     * @param string $publicId
     * @return bool
     */
    public function deleteImage(string $publicId): bool
    {
        try {
            $result = Cloudinary::uploadApi()->destroy($publicId);

            if (!$result || !is_array($result)) {
                Log::error('Cloudinary delete returned invalid result for: ' . $publicId);
                return false;
            }

            return isset($result['result']) && $result['result'] === 'ok';
        } catch (\Exception $e) {
            Log::error('Cloudinary delete failed: ' . $e->getMessage() . ' | Public ID: ' . $publicId);
            return false;
        }
    }

    /**
     * Delete multiple images from Cloudinary
     *
     * @param array $publicIds
     * @return int Number of successfully deleted images
     */
    public function deleteMultipleImages(array $publicIds): int
    {
        $deleted = 0;

        foreach ($publicIds as $publicId) {
            if ($this->deleteImage($publicId)) {
                $deleted++;
            }
        }

        return $deleted;
    }

    /**
     * Extract public ID from Cloudinary URL
     *
     * @param string $url
     * @return string|null
     */
    public function getPublicIdFromUrl(string $url): ?string
    {
        // Extract public ID from Cloudinary URL
        // Example: https://res.cloudinary.com/demo/image/upload/v1234567/folder/image.jpg
        // Returns: folder/image

        if (preg_match('/\/v\d+\/(.+)\.\w+$/', $url, $matches)) {
            return $matches[1];
        }

        return null;
    }

    /**
     * Upload document (PDF, etc.) to Cloudinary
     *
     * @param UploadedFile $file
     * @param string $folder
     * @param array $options
     * @return string|null URL of uploaded document
     */
    public function uploadDocument(UploadedFile $file, string $folder = 'documents', array $options = []): ?string
    {
        try {
            if (!$file->isValid()) {
                Log::error('Invalid document file for upload: ' . $file->getClientOriginalName());
                return null;
            }

            $defaultOptions = [
                'folder' => $folder,
                'resource_type' => 'raw',
            ];

            $uploadOptions = array_merge($defaultOptions, $options);

            $result = Cloudinary::uploadApi()->upload($file->getRealPath(), $uploadOptions);

            if (!$result) {
                Log::error('Cloudinary document upload returned null for file: ' . $file->getClientOriginalName());
                return null;
            }

            $uploadedFileUrl = $result['secure_url'] ?? null;

            if (!$uploadedFileUrl) {
                Log::error('Cloudinary document result has no secure URL for file: ' . $file->getClientOriginalName());
                return null;
            }

            return $uploadedFileUrl;
        } catch (\Exception $e) {
            Log::error('Cloudinary document upload exception', [
                'message' => $e->getMessage(),
                'file' => $file->getClientOriginalName(),
                'trace' => $e->getTraceAsString()
            ]);
            return null;
        }
    }

    /**
     * Upload video to Cloudinary
     *
     * @param UploadedFile $file
     * @param string $folder
     * @param array $options
     * @return string|null URL of uploaded video
     */
    public function uploadVideo(UploadedFile $file, string $folder = 'videos', array $options = []): ?string
    {
        try {
            $defaultOptions = [
                'folder' => $folder,
                'resource_type' => 'video',
            ];

            $uploadOptions = array_merge($defaultOptions, $options);

            $result = Cloudinary::uploadApi()->upload($file->getRealPath(), $uploadOptions);

            return $result['secure_url'] ?? null;
        } catch (\Exception $e) {
            Log::error('Cloudinary video upload failed: ' . $e->getMessage());
            return null;
        }
    }
}
