<?php

namespace App\Http\Controllers;

use App\Models\House;
use Illuminate\Http\Request;

class HouseController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $query = House::query();

        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->input('name') . '%');
        }

        if ($request->filled('price')) {
            $priceRange = $request->input('price');
            list($minPrice, $maxPrice) = explode('-', $priceRange);
            $query->whereBetween('price', [$minPrice, $maxPrice]);
        }

        if ($request->filled('bedrooms')) {
            $query->where('bedrooms', $request->input('bedrooms'));
        }

        if ($request->filled('bathrooms')) {
            $query->where('bathrooms', $request->input('bathrooms'));
        }

        if ($request->filled('storeys')) {
            $query->where('storeys', $request->input('storeys'));
        }

        if ($request->filled('garages')) {
            $query->where('garages', $request->input('garages'));
        }

        $data = $query->get();
        return response()->json(['data' => $data], 200);

    }
}
