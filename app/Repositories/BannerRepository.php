<?php

namespace App\Repositories;

use App\Models\Banner;
use Illuminate\Support\Facades\Storage;

class BannerRepository
{
    /**
     * Get all banners sorted by order.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllBanners()
    {
        return Banner::orderBy('order')->get();
    }
    
    /**
     * Get active banners sorted by order.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getActiveBanners()
    {
        return Banner::where('is_active', true)
            ->orderBy('order')
            ->get();
    }
    
    /**
     * Get deleted banners.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getDeletedBanners()
    {
        return Banner::onlyTrashed()
            ->orderBy('deleted_at', 'desc')
            ->get();
    }
    
    /**
     * Create a new banner.
     *
     * @param array $data
     * @return Banner
     */
    public function createBanner(array $data)
    {
        // Store image and get path
        $imagePath = $data['image']->store('banners', 'public');
        
        // Replace image file with its path
        $data['image_path'] = $imagePath;
        unset($data['image']);
        
        return Banner::create($data);
    }
    
    /**
     * Update an existing banner.
     *
     * @param Banner $banner
     * @param array $data
     * @return Banner
     */
    public function updateBanner(Banner $banner, array $data)
    {
        // Handle image update if provided
        if (isset($data['image'])) {
            // Delete old image
            if ($banner->image_path) {
                Storage::disk('public')->delete($banner->image_path);
            }
            
            // Store new image
            $data['image_path'] = $data['image']->store('banners', 'public');
            unset($data['image']);
        }
        
        $banner->update($data);
        
        return $banner;
    }
    
    /**
     * Delete a banner.
     *
     * @param Banner $banner
     * @return boolean
     */
    public function deleteBanner(Banner $banner)
    {
        // When soft deleting, we keep the image file
        // because we might need it if the banner is restored
        
        return $banner->delete();
    }
    
    /**
     * Permanently delete a banner.
     *
     * @param int $id
     * @return boolean
     */
    public function permanentlyDeleteBanner($id)
    {
        $banner = Banner::withTrashed()->findOrFail($id);
        
        // Delete the banner image
        if ($banner->image_path) {
            Storage::disk('public')->delete($banner->image_path);
        }
        
        return $banner->forceDelete();
    }
    
    /**
     * Restore a deleted banner.
     *
     * @param int $id
     * @return Banner
     */
    public function restoreBanner($id)
    {
        $banner = Banner::withTrashed()->findOrFail($id);
        $banner->restore();
        
        return $banner;
    }
} 