<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function CategoryView(){
        $categories = DB::table('categories')->where('category_delete',1)->get();
        return view('admin.category',compact('categories'));
    }
    public function CategoryInsert(Request $data){
        $data->validate([
            'category_name' => 'required|unique:categories',
            'category_details' => 'required'
        ]);
        DB::table('categories')->insert([
            'category_name' => $data->category_name,
            'category_details' => $data->category_details
        ]);
        return redirect()->back()->with('success_insert',1);
    }

    public function CategoryUpdate(Request $data){
        $data->validate([
            'category_name' => 'required',
            'category_details' => 'required'
        ]);
        DB::table('categories')->where('id',$data->category_id)->update([
            'category_name' => $data->category_name,
            'category_details' => $data->category_details
        ]);
        return redirect()->back()->with('success_updated',1);
    }
    public function CategoryStatusUpdate(Request $data){
        DB::table('categories')->where('id',$data->id)->update([
            'category_status' => $data->status,
        ]);
        return redirect()->back()->with('success_updated',1);
    }

    public function CategoryDelete(Request $data){
        DB::table('categories')->where('id',$data->id)->update([
            'category_delete' => 0,
        ]);
        return redirect()->back()->with('success_delete',1);
    }
    //sub-category
    public function SubCategoryView(){
        $sub_categories = DB::table('subcategories')->where('sub_category_delete',1)->get();
        return view('admin.sub_category',compact('sub_categories'));
    }
    public function SubCategoryInsert(Request $data){
        $data->validate([
            'category_id' => 'required',
            'sub_category_name' => 'required',
            'sub_category_details' => 'required'
        ]);
        $cat = DB::table('categories')->where('id',$data->category_id)->first();
        DB::table('subcategories')->insert([
            'category_id' => $data->category_id,
            'category_name' => $cat->category_name,
            'sub_category_name' => $data->sub_category_name,
            'sub_category_details' => $data->sub_category_details
        ]);
        return redirect()->back()->with('success_insert',1);
    }
    public function SubCategoryUpdate(Request $data){
        $data->validate([
            'category_id' => 'required',
            'sub_category_name' => 'required',
            'sub_category_details' => 'required'
        ]);
        $cat = DB::table('categories')->where('id',$data->category_id)->first();
        DB::table('subcategories')->where('id',$data->sub_category_id)->update([
            'category_id' => $data->category_id,
            'category_name' => $cat->category_name,
            'sub_category_name' => $data->sub_category_name,
            'sub_category_details' => $data->sub_category_details
        ]);
        return redirect()->back()->with('success_updated',1);
    }
    public function SubCategoryStatusUpdate(Request $data){
        DB::table('subcategories')->where('id',$data->id)->update([
            'sub_category_status' => $data->status,
        ]);
        return redirect()->back()->with('success_updated',1);
    }

    public function SubCategoryDelete(Request $data){
        DB::table('subcategories')->where('id',$data->id)->update([
            'sub_category_delete' => 0,
        ]);
        return redirect()->back()->with('success_delete',1);
    }
    //logo

    public function AdminLogo(){
        $logos = DB::table('logos')->get();
        return view('admin.admin_logo',compact('logos'));
    }
    public function AdminLogoInsert(Request $data){
        $image = $data->logo;

        if($image){
            $file = Image::make($image);
            $size = $file->filesize();
            $image_ext = $image->getClientOriginalExtension();
            $format = array('jpg','jpeg','png');
            if(in_array($image_ext,$format)){
                if($size<20097152){
                    $post_image = time().".".$image_ext;
                    Image::make($image)->resize(300,70)->save('public/logos/'.$post_image);
                    $product_image='public/logos/'.$post_image;
                }else{
                    return redirect()->back()->with('err_file_format','1');
                }
            }else{
                return redirect()->back()->with('err_file_size','1');
            }

        }else{
            $product_image = NULL;
        }
        DB::table('logos')->insert([
            'logo' => $product_image,
            'logo_for' => $data->logo_for,
        ]);
        return redirect()->back()->with('success_insert',1);
    }
    public function LogoDelete(request $data){
        DB::table('logos')->where('id',$data->id)->delete();
        return redirect()->back()->with('success_delete',1);
    }
    //json dependency
    public function GetSubCategory(Request $data){
        $sub_category = DB::table('subcategories')->where('category_id',$data->category_id)->where('sub_category_status','Enable')->where('sub_category_delete',1)->get();
        return response()->json($sub_category);
    }
}
