<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');       
       
    }
    
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validation---
        $this->validate($request,[
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'profilelogo' => 'required|string|max:255',
            'password' => 'required|string|min:6|confirmed',

            ]);
            
            // ---Handle File---

            if($request->hasFile('profilelogo')){
                // Get file name with the extension
                $filenameWithExt = $request->file('profilelogo')->getClientOriginalName();
                // get just file name
                $filename=pathinfo($filenameWithExt,PATHINFO_FILENAME);
                // get the extension
                $extension = $request->file('profilelogo')->getClientOriginalExtension();
                // file name to store
                $fileNameToStore = $filename.'_'.time().'.'.$extension;
                // upload image
                $path = $request->file('profilelogo')->storeAs('public/usersimages',$fileNameToStore);
                
            }else{

                $fileNameToStore= 'noimage.jpg';
            }
           
           
           
            // create New User---
        $user= new User;
        $user->name=$request->input('name');
        $user->email=$request->input('email');
        $user->phone=$request->input('phone');
        $user->password=$request->input('password');
        $user->profilelogo=$fileNameToStore;
        $user->save();
        return redirect('/admin')->with('success','user Created Successfully');
    }

    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // --auth--
        if (Auth::user()->role == "owner" || Auth::user()->role == "manager") {
            $user = User::find($id);
        } else {
            return redirect('/')->with('error','Unauthorized Page');
        }

        if ($user->role == "owner" && Auth::user()->role == "owner") {
            return view('pages.users.userprofile') ->with('user',$user);
        } else if ($user->role != "owner") {
            return view('pages.users.userprofile') ->with('user',$user);
        } else {
            return redirect('/admin')->with('error','Unauthorized Page');
        }
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         // --auth--
        if (Auth::user()->role == "owner" || Auth::user()->role == "manager") {
            $user = User::find($id);
        } else {
            return redirect('/')->with('error','Unauthorized Page');
        }

        if ($user->role == "owner" && Auth::user()->role == "owner") {
            return view('pages.users.edituser') ->with('user',$user);
        } else if ($user->role != "owner") {
            return view('pages.users.edituser') ->with('user',$user);
        } else {
            return redirect('/admin')->with('error','Unauthorized Page');
        } 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    
        {
            // validation---
            $this->validate($request,[
                'name' => '|string|max:255',
                'phone' => '|string|max:255',
                'role' => 'required|string|max:255',
                'email' => '|string|email|max:255',
                'profilelogo' => 'image|nullable|max:1999',
                // 'password' => 'required|string|min:6|confirmed',
    
                ]);
                $user=User::find($id);
                // ---Handle File---
    
                if($request->hasFile('profilelogo')){
                    // Get file name with the extension
                    $filenameWithExt = $request->file('profilelogo')->getClientOriginalName();
                    // get just file name
                    $filename=pathinfo($filenameWithExt,PATHINFO_FILENAME);
                    // get the extension
                    $extension = $request->file('profilelogo')->getClientOriginalExtension();
                    // file name to store
                    $fileNameToStore = $filename.'_'.time().'.'.$extension;
                    // upload image
                    $path = $request->file('profilelogo')->storeAs('public/usersimages',$fileNameToStore);
                    
                }else{
    
                    $fileNameToStore= $user->profilelogo;
                }
               
               
               
                // update user---
            
            $user->name=$request->input('name');
            $user->email=$request->input('email');
            $user->phone=$request->input('phone');
            $user->role=$request->input('role');
            // $user->password=$request->input('password');
            $user->profilelogo=$fileNameToStore;
            $user->save();
            return redirect('/admin')->with('success','user Updated Successfully');
        }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
            $user=User::find($id);
            $user->delete();
            return redirect('/admin')->with('success','User Deleted Successfully'); 
    }
}
