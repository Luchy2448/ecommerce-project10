<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\Category;
use App\Models\AdminsRole;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Session::put('page', 'products');

        $products = Product::with('category')->get();
        // dd($products);

        $productsModuleCount = AdminsRole::where(['subadmin_id'=>Auth::guard('admin')->user()->id,'module'=>'products'])->count();
        $productsModule = [];
        if(Auth::guard('admin')->user()->type=='admin'){
            $productsModule['view_access'] = 1;
            $productsModule['add_access'] = 1;
            $productsModule['edit_access'] = 1;
            $productsModule['full_access'] = 1;
        }else if($productsModuleCount==0){
            $message = "This feature is restricted for you!";
            return redirect()->route('admin.dashboard')->with('sweet_error_message', $message);
        }else{
            $productsModule = AdminsRole::where(['subadmin_id'=>Auth::guard('admin')->user()->id,'module'=>'products'])->first();
        }
        
        return view('admin.products.index', compact('products', 'productsModule'));
    }

  public function addEditProduct(Request $request, $id = null)
{
     $groupCodes = Product::select('group_code')->distinct()->pluck('group_code');

  if (empty($id) || $id == 0) {
    $title = "Add Product";
    $product = new Product;
    $message = "Product Added Successfully";
} else {
    $title = "Edit Product";
    $product = Product::find($id);
    if (!$product) {
        return redirect()->route('admin.products.index')->with('error_message', 'Product not found');
    }
    $message = "Product Updated Successfully";
}
    // get categories and their subcategories
    $getCategories = Category::getCategories();
    // product filters
    $productsFilters = Product::productsFilters();

    if ($request->isMethod('post')) {

        $data = $request->all();
        // dd($data);
   

        // Upload image
        if ($request->hasFile('image')) {
            $image_tmp = $request->file('image');
           
            if ($image_tmp->isValid()) {
                // Genera nuevo nombre de imagen
                $imageName = rand(111, 99999) . '.' . $image_tmp->getClientOriginalExtension();
                // Define la ruta para guardar la imagen
                $image_path = public_path('front/images/products/');
                // Mueve la imagen a la ruta especificada
                $image_tmp->move($image_path, $imageName);
                $product->image = $imageName;
            }
        }
        $rules = [
            'product_name' => 'required|max:255|regex:/^[\pL\s]+$/u',
            'category_id' => 'required',
            'price' => 'required|numeric',
            'final_price' => 'required|numeric',
            'code' => 'required|regex:/^[\w-]*$/|max:20|unique:products,code,' . $id,
            'color' => 'required|max:200|regex:/^[\pL\s]+$/u',
            'family_color' => 'required|max:200|regex:/^[\pL\s]+$/u',
        ];

        $customMessages = [
            'product_name.required' => 'Product Name is required',
            'category_id.required' => 'Category is required',
            'price.required' => 'Price is required',
            'final_price.required' => 'Final Price is required',
            'code.required' => 'Product Code is required',
            'code.unique' => 'Product Code already exists, please choose another one',
            'code.regex' => 'Product Code can only contain letters, numbers, underscores, and hyphens',
            'price.numeric' => 'Price must be a number',
            'final_price.numeric' => 'Final Price must be a number',
            'color.required' => 'Color is required',
            'color.regex' => 'Color must contain only letters and spaces',
            'family_color.required' => 'Family Color is required',
            'family_color.regex' => 'Family Color must contain only letters and spaces',
            'product_name.regex' => 'Product Name must contain only letters and spaces',
            'product_name.max' => 'Product Name must not exceed 255 characters',
        ];
        $this->validate($request, $rules, $customMessages);

        // upload video if exists
        if ($request->hasFile('video')) {
            $video_tmp = $request->file('video');
            if ($video_tmp->isValid()) {
                $videoExtension = $video_tmp->getClientOriginalExtension();
                $videoName = rand(111, 99999) . '.' . $videoExtension;
                // Define the path to save the video
                $video_path = "front/videos/";
                // Move the video to the specified path
                $video_tmp->move($video_path, $videoName);
                $product->video = $videoName;
            }
            // // delete the old video if exists
            // if ($product->video && file_exists(public_path('front/videos/products/' . $product->video))) {
            //     unlink(public_path('front/videos/products/' . $product->video));
            // }

        }
        $product->name = $data['product_name'];
        $product->category_id = $data['category_id'] ?? null;
        $product->group_code = $data['group_code'] ?? null;
        $product->price = $data['price'] ?? 0;
        $product->discount = $data['discount'] ?? 0;
        $product->discount_type = $data['discount_type'] ?? 0;
        $product->size = $data['size'] ?? '';
        $product->color = $data['color'] ?? '';
        $product->weight = $data['weight'] ?? '';
        $product->stock = $data['stock'] ?? '';
        $product->family_color = $data['family_color'] ?? '';
        $product->final_price = $data['final_price'] ?? 0;
        $product->code = $data['code'] ?? '';
        $product->wash_care = $data['wash_care'] ?? '';
        $product->fabric = $data['fabric'] ?? '';
        $product->pattern = $data['pattern'] ?? '';
        $product->fit = $data['fit'] ?? '';
        $product->sleeve = $data['sleeve'] ?? '';
        $product->occasion = $data['occasion'] ?? '';
        $product->keywords = $data['keywords'] ?? '';
        $product->description = $data['description'] ?? '';
       
        $product->meta_title = $data['meta_title'] ?? '';
        $product->meta_description = $data['meta_description'] ?? '';
        $product->meta_keywords = $data['meta_keywords'] ?? ''; 

        if(!empty($data['is_featured'])){
            $product->is_featured = $data['is_featured'];
        } else {
            $product->is_featured = "No";
        }
        
        $product->status = 1;
        $product->save();

        return redirect()->route('admin.products.index')->with('success_message', $message);
    }

    return view('admin.products.edit', compact('title', 'product', 'id', 'groupCodes', 'getCategories', 'productsFilters'));
}

    /**
     * Update the specified resource in storage.
     */
     public function updateProductStatus(Request $request)
{
    if ($request->ajax()) {
        $data = $request->all();
        if ($data['status'] == "Active") {
            $status = 0;
        } else {
            $status = 1;
        }
        Product::where('id', $data['product_id'])->update(['status' => $status]);
        return response()->json(['status' => $status, 'product_id' => $data['product_id']]);
    }
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //delete CMS page
        Product::where('id', $id)->delete();
        return redirect()->route('admin.products.index')->with('success_message', 'Product Deleted Successfully');
    }

public function destroyImage($id)
    { 
        //delete image from storage
        $productImage = Product::select('image')->where('id', $id)->first();
        $currentImagePath = public_path('front/images/products/' . $productImage->image);
        if (file_exists($currentImagePath)) {
            unlink($currentImagePath);
        }
        // delete image from products table
        Product::where('id', $id)->update(['image' => '']);

        return redirect()->back()->with('success_message', 'Product Image Deleted Successfully');
    }
}
