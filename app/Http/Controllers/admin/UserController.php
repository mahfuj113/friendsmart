<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
Use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function ViewUsers(){
        $users = DB::table('users')->where('user_role','!=',1)->get();
        return view('admin.view_user',compact('users'));
    }
    public function AddUser(Request $data){
        $data->validate([
            'name' => 'required',
            'user_role' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'address' => 'required',
            'user_image' => 'required',
            'password' => 'required'
        ]);

        $image = $data->user_image;
        if($image){
            $file = Image::make($image);
            $size = $file->filesize();
            $image_ext = $image->getClientOriginalExtension();
            $format = array('jpg','jpeg','png');
            if(in_array($image_ext,$format)){
                if($size<20097152){
                    $post_image = time().".".$image_ext;
                    Image::make($image)->resize(300,300)->save('public/user_images/'.$post_image);
                    $user_image='public/user_images/'.$post_image;
                }else{
                    return redirect()->back()->with('err_file_format','1');
                }
            }else{
                return redirect()->back()->with('err_file_size','1');
            }

        }else{
            $user_image =NULL;
        }
        DB::table('users')->insert([
            'name' => $data->name,
            'user_role' => $data->user_role,
            'email' => $data->email,
            'phone' => $data->phone,
            'address' => $data->address,
            'password' => Hash::make($data->password),
            'created_at' => Carbon::now(),
            'user_image' => $user_image
        ]);
        return redirect()->back()->with('success_insert',1);
    }
    public function UpdateUser(Request $data){
        $data->validate([
            'name' => 'required',
            'user_role' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'address' => 'required',
        ]);

        $image = $data->user_image;

        if($image){
            $file = Image::make($image);
            $size = $file->filesize();
            $image_ext = $image->getClientOriginalExtension();
            $format = array('jpg','jpeg','png');
            if(in_array($image_ext,$format)){
                if($size<20097152){
                    $post_image = time().".".$image_ext;
                    Image::make($image)->resize(300,300)->save('public/user_images/'.$post_image);
                    $user_image='public/user_images/'.$post_image;
                }else{
                    // return redirect()->back()->with('err_file_format','1');
                }
            }else{
                // return redirect()->back()->with('err_file_size','1');
            }

        }else{
            $user = DB::table('users')->where('id',$data->id)->first();
            $user_image =$user->user_image;
        }
        DB::table('users')->where('id',$data->id)->update([
            'name' => $data->name,
            'user_role' => $data->user_role,
            'email' => $data->email,
            'phone' => $data->phone,
            'address' => $data->address,
            'updated_at' => Carbon::now(),
            'user_image' => $user_image
        ]);
        return redirect()->back()->with('success_updated',1);
    }
    public function UpdateUserStatus(Request $data){
        DB::table('users')->where('id',$data->id)->update([
            'user_status' => $data->status,
        ]);
        return redirect()->back()->with('success_updated',1);
    }
    public function DeleteUser(Request $data){
        DB::table('users')->where('id',$data->id)->delete();
        return redirect()->back()->with('success_delete',1);
    }
    public function MyProfile(){
        return view('admin.my_profile');
    }
    public function UpdateMyProfile(Request $data){
        $data->validate([
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'address' => 'required',
        ]);

        $image = $data->user_image;

        if($image){
            $file = Image::make($image);
            $size = $file->filesize();
            $image_ext = $image->getClientOriginalExtension();
            $format = array('jpg','jpeg','png');
            if(in_array($image_ext,$format)){
                if($size<20097152){
                    $post_image = time().".".$image_ext;
                    Image::make($image)->resize(300,300)->save('public/user_images/'.$post_image);
                    $user_image='public/user_images/'.$post_image;
                }else{
                    return redirect()->back()->with('err_file_format','1');
                }
            }else{
                return redirect()->back()->with('err_file_size','1');
            }

        }else{
            $user = DB::table('users')->where('id',Auth::user()->id)->first();
            $user_image =$user->user_image;
        }
        DB::table('users')->where('id',Auth::user()->id)->update([
            'name' => $data->name,
            'email' => $data->email,
            'phone' => $data->phone,
            'address' => $data->address,
            'updated_at' => Carbon::now(),
            'user_image' => $user_image
        ]);
        return redirect()->back()->with('success_updated',1);
    }
    public function ChangePassword(){
        return view('admin.change_password');
    }
    public function UpdatePassword(Request $data){
        $pass = $data->current_password;
        if($data->new_password==$data->r_new_password){
            if(Hash::check($pass,Auth::user()->password)){
                DB::table('users')->where('id',Auth::user()->id)->update([
                    'password' => Hash::make($data->new_password),
                ]);
                return redirect()->back()->with('success_change',1);
            }else{
                return redirect()->back()->with('err1','Invalid Password');
            }
        }else{
            return redirect()->back()->with('err','Password Does not Match');
        }
    }
}
