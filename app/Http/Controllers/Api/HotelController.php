<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\HotelResource;
use App\Models\Hotel;
use App\Services\HotelsService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class HotelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): AnonymousResourceCollection
    {
        $hotels = Hotel::all();
        return HotelResource::collection($hotels);
    }

    /**
     * Search resources.
     */
    public function search(HotelsService $hotelsService): array|Collection
    {
        if (count(request()->all())) {
            return $hotelsService->hotelsSearch();
        }
        return Hotel::all();
    }

    /**
     * Display the specified resource.
     */
    public function show(Hotel $hotel)
    {
        //
    }
}
