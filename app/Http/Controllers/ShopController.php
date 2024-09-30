<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreShopRequest;
use App\Http\Requests\UpdateShopRequest;
use App\Models\Shop;
use Illuminate\Support\Facades\Log;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $shops = Shop::all();

        return response()->json($shops);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreShopRequest $request)
    {
        // Log the request user
        Log::info('User:', ['user' => $request->user()]);

        // // Check if the request is authorized
        // if ($request->user()->cannot('create', Shop::class)) {
        //     abort(403, 'Unauthorized action.');
        // }

        $request->validated();

        $user = $request->user();
        $request->merge(['user_id' => $user->id]);

        $shop = Shop::create($request->all());

        return response()->json($shop, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Shop $shop)
    {
        return response()->json($shop);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Shop $shop)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateShopRequest $request, Shop $shop)
    {
        // Log the request user
        Log::info('User:', ['user' => $request->user()]);

        // Check if the request is authorized
        if ($request->user()->cannot('update', $shop)) {
            abort(403, 'Unauthorized action.');
        }
        
        $request->validated();

        $shop->update($request->all());

        return response()->json($shop, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Shop $shop)
    {
        // check if shop exists
        if (!$shop) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Shop not found',
                ], 404);
        }

        $shop->delete();

        return response()->json(
            [
                'success' => true,
                'message' => 'Shop deleted successfully',
            ], 200);
    }
}
