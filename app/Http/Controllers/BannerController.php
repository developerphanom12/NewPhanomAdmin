<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Http\Requests\BannerRequest;
use App\Repositories\BannerRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
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
     * Display a listing of the banners.
     */
    public function index()
    {
        $banners = $this->bannerRepository->getAllBanners();
        return view('screen.banner.allbanner', compact('banners'));
    }

    /**
     * Show the form for creating a new banner.
     */
    public function create()
    {
        return view('screen.banner.createbanner');
    }

    /**
     * Store a newly created banner in storage.
     */
    public function store(BannerRequest $request)
    {
        $data = $request->validated();
        
        // Set is_active from checkbox
        $data['is_active'] = $request->has('is_active');
        
        // Set a default title based on order
        $data['title'] = 'Banner ' . $data['order'];
        
        $this->bannerRepository->createBanner($data);

        return redirect()->route('banner.index')
            ->with('success', 'Banner created successfully.');
    }

    /**
     * Display the specified banner.
     */
    public function show(Banner $banner)
    {
        return view('screen.banner.showbanner', compact('banner'));
    }

    /**
     * Show the form for editing the specified banner.
     */
    public function edit(Banner $banner)
    {
        return view('screen.banner.editbanner', compact('banner'));
    }

    /**
     * Update the specified banner in storage.
     */
    public function update(BannerRequest $request, Banner $banner)
    {
        $data = $request->validated();
        
        // Set is_active from checkbox
        $data['is_active'] = $request->has('is_active');
        
        // Update the title if order changed
        if (isset($data['order']) && $data['order'] != $banner->order) {
            $data['title'] = 'Banner ' . $data['order'];
        }
        
        $this->bannerRepository->updateBanner($banner, $data);

        return redirect()->route('banner.index')
            ->with('success', 'Banner updated successfully.');
    }

    /**
     * Remove the specified banner from storage.
     */
    public function destroy(Banner $banner)
    {
        $this->bannerRepository->deleteBanner($banner);

        return redirect()->route('banner.index')
            ->with('success', 'Banner deleted successfully.');
    }
    
    /**
     * Display a listing of the deleted banners.
     */
    public function deleted()
    {
        $deletedBanners = $this->bannerRepository->getDeletedBanners();
        return view('screen.banner.deletedbanner', compact('deletedBanners'));
    }
    
    /**
     * Restore a deleted banner.
     */
    public function restore($id)
    {
        $this->bannerRepository->restoreBanner($id);
        
        return redirect()->route('banner.deleted')
            ->with('success', 'Banner restored successfully.');
    }
    
    /**
     * Permanently delete a banner.
     */
    public function forceDelete($id)
    {
        $this->bannerRepository->permanentlyDeleteBanner($id);
        
        return redirect()->route('banner.deleted')
            ->with('success', 'Banner permanently deleted.');
    }
    
    /**
     * Toggle the active status of a banner.
     */
    public function toggleStatus(Request $request, Banner $banner)
    {
        $status = $request->input('is_active');
        $banner->is_active = $status;
        $banner->save();
        
        return response()->json([
            'success' => true,
            'message' => 'Banner status updated',
            'is_active' => $banner->is_active
        ]);
    }
    public function getBanner()
{
    $banners = $this->bannerRepository->getAllBanners();

    $fullImagePaths = $banners->map(function ($banner) {
        return url('storage/' . $banner->image_path); // Adjust based on your storage setup
    });

    return response()->json([
        'success' => true,
        'images' => $fullImagePaths
    ], 200);
}

}
