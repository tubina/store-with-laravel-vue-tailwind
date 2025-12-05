<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductImages;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductAdminController extends Controller
{

    public function index()
    {
        $products = Product::with(['category', 'productImagesJustOne'])->get();
        $category = DB::table('category')->get();
        return Inertia::render('Admin/ProductMain', ['category' => $category, 'products' => $products]);
    }
/******************************************************/
    public function create()
    {
        $category = DB::table('category')->get();
        return Inertia::render('Admin/ProductAdd', ['categories' => $category]);
    }
/******************************************************/
    public function store(Request $request)
    {
        $product = Product::create([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'from_price' => $request->from_price,
            'price' => $request->price,
            'description' => $request->description,
        ]);

        $product_id = $product->id;

        $product_images = new ProductImages();
        if($request->hasFile('images'))
        {
            foreach($request->file('images') as $image)
            {
                $path = $image->store('products', 'public');
                $product_images->create([
                    'product_id' => $product_id,
                    'path' => $path
                ]);
            }
        }
    }
/******************************************************/
    public function edit($id)
    {
        $category = Category::get();
        $product = Product::with(['category', 'productImages'])->findOrFail($id);
        return Inertia::render('Admin/ProductEdit', ['product' => $product, 'category'=> $category]);
    }
/******************************************************/
    public function update(Request $request, Product $product)
    {
        $this->authorize('update', $product);

        $product->update($request->only(['name', 'category_id', 'from_price', 'price', 'description']));
    }
/******************************************************/
    public function teste(Request $request)
    {
       // return response()->json(['foto'=>$request->query('id')]);

        $idProduct = $request->id_product;
        $idPhoto = $request->id_photo;

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $path = $file->store('products', 'public'); // salva em storage/app/public/uploads

            $productImages = ProductImages::findOrFail($idPhoto);
            $productImages->update(['path' => $path]);

            return response()->json([
                'success' => true,
                'path' => $path,
                'id_product' => $idProduct,
                'id_photo' => $idPhoto
            ]);
        }

        return response()->json([
            'error' => true,
            'message' => 'Nenhum arquivo enviado.'
        ], 400);
    }
/******************************************************/
    public function editOnePhoto(Request $request)
    {
        try {
            if (!$request->hasFile('photo')) {
                return response()->json(['message' => 'Nenhuma imagem recebida'], 400);
            }

            $request->validate([
                'photo' => 'required|image|max:2048'
            ]);

            $file = $request->file('photo');
            $path = $file->store('products', 'public');

            return response()->json([
                'message' => 'Foto salva com sucesso',
                'path' => $path
            ]);
        } catch (\Throwable $e) {
            \Log::error('Erro ao salvar imagem: ' . $e->getMessage(), [
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
            ]);

            return response()->json(['message' => 'Erro no servidor: ' . $e->getMessage()], 500);
        }
    }
/******************************************************/
    public function deletePhoto($id)
    {
        $product = Product::with('productImages')->findOrFail($id);
        $arrr = [];
        foreach ($product->productImages as $image){
           //logger($image->path); // vai aparecer no laravel.log
            if(Storage::disk('public')->exists($image->path)){
                Storage::disk('public')->delete($image->path);
                logger("Arquivo apagado: " . $image->path);
            } else {
                logger("Arquivo não encontrado: " . $image->path);
            }
            $arrr[] = $image->path;
        }
        $product->delete();

        return response()->json(['ok'=> true]);
        return response()->json([
            'pro' => $arrr
        ], 200);
    }
/******************************************************/
}
