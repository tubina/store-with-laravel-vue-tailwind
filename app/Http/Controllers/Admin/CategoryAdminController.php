<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Inertia\Inertia;
use Illuminate\Support\Facades\Log;

class CategoryAdminController extends Controller
{
    public function index()
    {
        $category = Category::orderBy('position')->get();
        return Inertia::render('Admin/CategoryEdit', ['category' => $category]);
        //return response()->json(['category' => $category]);
    }
/*******************************************************************/
    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        $category->update([
            'name' => $request->input('name'),
        ]);
        return response()->json(['message' => 'ok']);
    }
/*******************************************************************/
    public function save(Request $request)
    {

        Log::info($request->all('oldCategory'));

        if($request->input('oldCategory') == null)
        {
            $category = new Category();
            $category->name = $request->input('name'); 
            $category->position = Category::max('position') + 1;
            $category->save();
        }else
        {
            $after = Category::where('name', $request->input('oldCategory'))->first();
            Category::where('position', '>', $after->position)->increment('position');

            $category = new Category();
            $category->name = $request->input('name');
            $category->position = $after->position + 1;
            $category->save(); 
        }
 
        //return redirect('/admin/category');
    }
}
