<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(){
        $users = User::orderBy('id','DESC')->paginate(5);
        return view('users.list',['users'=>$users]);
    }
    public function create(){
        return view('users.create');
    }
    public function store(Request $request) {
        // dd($request->all());
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required',
            'password' => 'required|min:8|max:16|regex:/[a-z]/|regex:/[A-Z]/|regex:/[0-9]/|regex:/[@$!%*#?&]/',
            'hobbies' => 'required|min:2',
            'image' => 'required|image:png,jpeg,jpg|max:300'
        ]);
        if ( $validator->fails() ) {
            // dd($validator->errors()->all());
            return redirect()->route('users.create')->withErrors($validator)->withInput();
        } else {
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->hobbies = implode(',', $request->hobbies);
            $user->save();
            // Upload image here
            if ($request->image) {
                $ext = $request->image->getClientOriginalExtension();
                $newFileName = time().'.'.$ext;
                $request->image->move(public_path().'/uploads/users/',$newFileName); // This will save file in a folder
                
                $user->picture = $newFileName;
                $user->save();
            }
            return redirect()->route('users.index')->with('success','User registred successfully.');
        }
    }
    public function edit($id){
        $user = User::findorfail($id);
        // dd($user);
        return view('users.edit',['user'=>$user,'hobbies' => explode(',', $user->hobbies)]);
    }
    public function update($id,Request $request) {
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required',
            // 'password' => 'required|min:8|max:16|regex:/[a-z]/|regex:/[A-Z]/|regex:/[0-9]/|regex:/[@$!%*#?&]/',
            'hobbies' => 'required|min:2',
            'image' => 'sometimes|image:png,jpeg,jpg|max:300',

        ]);
        if ( $validator->fails() ) {
            return redirect()->route('users.edit',$id)->withErrors($validator)->withInput();
        } else {
            $user = User::find($id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->hobbies = implode(',', $request->hobbies);
            $user->save();
            // Upload image here
            if ($request->image) {
                $oldImage = $user->picture;
                $ext = $request->image->getClientOriginalExtension();
                $newFileName = time().'.'.$ext;
                $request->image->move(public_path().'/uploads/users/',$newFileName); // This will save file in a folder
                $user->picture = $newFileName;
                $user->save();
                File::delete(public_path().'/uploads/users/'.$oldImage);
            }
            return redirect()->route('users.index')->with('success','User Updated successfully.');
        }
    }
    public function delete($id) {
        $user = User::findOrFail($id);                
        File::delete(public_path().'/uploads/users/'.$user->picture);
        $user->delete();        
        return redirect()->route('users.index')->with('success','User deleted successfully.');
    }
}
