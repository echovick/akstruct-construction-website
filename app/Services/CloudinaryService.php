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
            $defaultOptions = [
                'folder' => $folder,
                'resource_type' => 'image',
                'transformation' => [
                    'quality' => 'auto',
                    'fetch_format' => 'auto'
                ]
            ];

            $uploadOptions = array_merge($defaultOptions, $options);

            $result = Cloudinary::upload($file->getRealPath(), $uploadOptions);

            return $result->getSecurePath();
        } catch (\Exception $e) {
            Log::error('Cloudinary upload failed: ' . $e->getMessage());
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
            $result = Cloudinary::destroy($publicId);
            return $result['result'] === 'ok';
        } catch (\Exception $e) {
            Log::error('Cloudinary delete failed: ' . $e->getMessage());
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
            $defaultOptions = [
                'folder' => $folder,
                'resource_type' => 'raw',
            ];

            $uploadOptions = array_merge($defaultOptions, $options);

            $result = Cloudinary::upload($file->getRealPath(), $uploadOptions);

            return $result->getSecurePath();
        } catch (\Exception $e) {
            Log::error('Cloudinary document upload failed: ' . $e->getMessage());
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

            $result = Cloudinary::upload($file->getRealPath(), $uploadOptions);

            return $result->getSecurePath();
        } catch (\Exception $e) {
            Log::error('Cloudinary video upload failed: ' . $e->getMessage());
            return null;
        }
    }
}
