<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use Illuminate\Support\Facades\DB;

class ItemController extends Controller
{
    public function index(Request $request)
    {
        $query = Item::query();

        // Dynamic search based on user input for name and description
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('name', 'like', "%$search%")
                  ->orWhere('description', 'like', "%$search%");
        }

        $items = $query->get();
        return response()->json($items);
    }

    public function show($id)
    {
        $item = Item::findOrFail($id);
        return response()->json($item);
    }

    public function store(Request $request)
    {
        // Implement store method as per your requirements
    }

    public function update(Request $request, $id)
    {
        // Implement update method as per your requirements
    }

    public function destroy($id)
    {
        // Implement destroy method as per your requirements
    }

    public function itemsWithCategory()
    {
        $items = Item::raw(function ($collection) {
            return $collection->aggregate([
                [
                    '$lookup' => [
                        'from' => 'categories',
                        'localField' => 'category_id',
                        'foreignField' => '_id',
                        'as' => 'category_details',
                    ],
                ],
            ]);
        });

        return response()->json($items);
    }
}
