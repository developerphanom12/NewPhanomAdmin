<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Repositories\BannerRepository;
use Illuminate\Http\Request;

class BannerApiController extends Controller
{
    /**
     * The banner repository instance.
     */
    protected $bannerRepository;

    /**
     * Create a new controller instance.
     *
     * @param BannerRepository $bannerRepository
     * @return void
     */
    public function __construct(BannerRepository $bannerRepository)
    {
        $this->bannerRepository = $bannerRepository;
    }

    /**
     * Get active banners ordered by priority (lowest order number first).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getActiveBanners()
    {
        $banners = $this->bannerRepository->getActiveBanners();
        
        return response()->json([
            'success' => true,
            'data' => $banners->map(function($banner) {
                return [
                    'id' => $banner->id,
                    'title' => $banner->title,
                    'image_url' => $banner->image_path ? asset('storage/' . $banner->image_path) : null,
                    'priority' => $banner->order,
                    'link_url' => $banner->link_url,
                ];
            }),
        ]);
    }
} 