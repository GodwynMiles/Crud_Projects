<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Category;
use Illuminate\Http\Request;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
}

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::query();
        
        if ($request->has('search')) {
            $search = $request->input('search');
            $categories->where('name', 'like', "%$search%")
                       ->orWhere('description', 'like', "%$search%");
        }
        
        return $categories->get();
    }

    public function show($id)
    {
        return Category::findOrFail($id);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
        ]);

        return Category::create($validatedData);
    }

    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        
        $validatedData = $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
        ]);

        $category->update($validatedData);

        return $category;
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return response()->json(['message' => 'Category deleted successfully']);
    }
}
