<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\AdminsRole;
use Illuminate\Http\Request;
use App\Http\Middleware\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function categories()
    { 
        Session::put('page', 'categories');
        // Fetch all categories with their parent category relationship
        $categories = Category::with('parentCategory')->get();

              // set admin/subadmins permissions for categories
        $categoriesModuleCount = AdminsRole::where(['subadmin_id'=>Auth::guard('admin')->user()->id,'module'=>'categories'])->count();
        $categoriesModule = [];
        if(Auth::guard('admin')->user()->type=='admin'){
            $categoriesModule['view_access'] = 1;
            $categoriesModule['add_access'] = 1;
            $categoriesModule['edit_access'] = 1;
            $categoriesModule['full_access'] = 1;
        }else if($categoriesModuleCount==0){
            $message = "This feature is restricted for you!";
            return redirect()->route('admin.dashboard')->with('sweet_error_message', $message);
        }else{
            $categoriesModule = AdminsRole::where(['subadmin_id'=>Auth::guard('admin')->user()->id,'module'=>'categories'])->first();
        }

        return view('admin.categories.index', compact('categories', 'categoriesModule'));
    }
    public function updateCategoryStatus(Request $request)
{
    if ($request->ajax()) {
        $data = $request->all();
        if ($data['status'] == "Active") {
            $status = 0;
        } else {
            $status = 1;
        }
        Category::where('id', $data['category_id'])->update(['status' => $status]);
        return response()->json(['status' => $status, 'category_id' => $data['category_id']]);
    }
}

  public function addEditCategory(Request $request, $id = null)
{
    // create and edit subadmin page
    $getCategories = Category::getCategories();

    if ($id == "") {
        $title = "Add Category";
        $category = new Category;
        $message = "Category Added Successfully";
    } else {
        $title = "Edit Category";
        $category = Category::find($id);
        $message = "Category Updated Successfully";
    }
    //  $categories = Category::where('status', 1)->get();

    if ($request->isMethod('post')) {

        $data = $request->all();
       
        if($id == "") {
            
        $rules = [
            'category_name' => 'required',
            'url' => 'required|unique:categories,url,' . $id,
        ];
        } else {
            $rules = [
                'category_name' => 'required',
                'url' => 'required',
            ];
        }

        $customMessages = [
            'category_name.required' => 'Category Name is required',
            'url.required' => 'Category URL is required',
            'url.unique' => 'Category URL already exists, please choose another one',
        ];
        $this->validate($request, $rules, $customMessages);

        // Upload image
        if ($request->hasFile('image')) {
            $image_tmp = $request->file('image');
           
            if ($image_tmp->isValid()) {
                // Genera nuevo nombre de imagen
                $imageName = rand(111, 99999) . '.' . $image_tmp->getClientOriginalExtension();
                // Define la ruta para guardar la imagen
                $image_path = public_path('front/images/categories/');
                // Mueve la imagen a la ruta especificada
                $image_tmp->move($image_path, $imageName);
                $category->image = $imageName;
            }
        }

        $category->name = $data['category_name'];
        $category->parent_id = $data['parent_id'] ?? null;
        $category->description = $data['description'] ?? '';
        $category->discount = $data['discount'] ?? 0;
        $category->url = $data['url'] ?? '';
        $category->meta_title = $data['meta_title'] ?? '';
        $category->meta_description = $data['meta_description'] ?? '';
        $category->meta_keyword = $data['meta_keyword'] ?? '';
        $category->status = 1;
        $category->save();

        return redirect()->route('admin.categories.index')->with('success_message', $message);
    }

    return view('admin.categories.edit', compact('title', 'category', 'id', 'getCategories'));
}
 public function destroy($id)
    {
        //delete CMS page
        Category::where('id', $id)->delete();
        return redirect()->route('admin.categories.index')->with('success_message', 'Category Deleted Successfully');
    }

public function destroyImage($id)
    {
        //delete image from storage
        $categoryImage = Category::select('image')->where('id', $id)->first();
        $currentImagePath = public_path('front/images/categories/' . $categoryImage->image);
        if (file_exists($currentImagePath)) {
            unlink($currentImagePath);
        }
        // delete image from categories table
        Category::where('id', $id)->update(['image' => '']);

        return redirect()->back()->with('success_message', 'Category Image Deleted Successfully');
    }
}
