<?php

namespace App\Http\Controllers;

use App\Models\Notetaking;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AccountController extends Controller
{
    //This method will show register page
    public function register(){
        return view('account.register');
    }

     //This method will register a user
     public function processRegister(Request $request){

        $validator = Validator::make($request->all(),[

            'name' => 'required|min:3',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:5|same:password_confirmation',
            'password_confirmation' => 'required',

        ]);

        if($validator->fails()){
            return redirect()->route('account.register')->withInput()->withErrors($validator);
        }

        //Now Register User Model
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('account.login')->with('success','You Have register sucessfully');
     }

     public function login(){

      return view('account.login');

     }

     public function authenticate(Request $request){

        $validator = Validator::make($request->all(),[
        
            'email' => 'required|email',
            'password' => 'required'

      ]);

    if($validator->fails()){

        return redirect()->route('account.login')->withInput()->withErrors($validator);
    }

    if(Auth::attempt(['email' => $request->email,'password' => $request->password])){

        return redirect()->route('account.list');
       
    }else{

        return redirect()->route('account.login')->with('error','Either email/password is incorrect.');

    }

    }
    //This Method will show user  page
    public function list(Request $request){

        $user = User::find(Auth::user()->id);
        //dd($user);

        $notetakings = Notetaking::where('user_id', $user->id)->latest();        //that is the pont

        if(!empty($request->get('keyword'))){
            $notetakings =  $notetakings->where('title', 'like','%'.$request->get('keyword').'%');
        }
        $notetakings = $notetakings->paginate(6);

        return view('account.list',[
            'user' => $user,
            'notetakings' => $notetakings,
        ]);
    }

    public function logout(){
       Auth::logout();
        return redirect()->route('account.login');
    }

    public function create(){
        return view('account.create');
       }
   
       public function store(Request $request){
   
           $rules = [
              'title' => 'required|min:5',
              'description' => 'required|min:10',
           ];
   
   
           $validator = Validator::make($request->all(),$rules);
   
           if($validator->fails()){
   
               // dd($validator->errors()->all());
   
               return redirect()->route('account.create')->withInput()->withErrors($validator);
           }
           // product insert
           $notetaking = new Notetaking();
           $notetaking->title = $request->title;
           $notetaking->description = $request->description;
           $notetaking->user_id = Auth::id(); ///That is point
           $notetaking->save();
   
           return redirect()->route('account.list')->with('success','Note added Successfully.');
   
       }
   
       public function edit($id){
   
        $notetaking = Notetaking::findOrfail($id);
   
           return view('account.edit',[
               'notetaking' => $notetaking
           ]);
       }
       public function update($id, Request $request){
   
           $notetaking = Notetaking::findOrfail($id);
   
           $rules = [
               'title' => 'required|min:5',
               'description' => 'required|min:10',
               
            ];
            $validator = Validator::make($request->all(),$rules);
    
            if($validator->fails()){
    
                // dd($validator->errors()->all());
    
                return redirect()->route('account.edit',$notetaking->id)->withInput()->withErrors($validator);
            }
            //insert
            
            $notetaking->title = $request->title;
            $notetaking->description = $request->description;
            $notetaking->save();
    
            return redirect()->route('account.list')->with('success','Note Upadted Successfully.');
       }
       public function destroy($id){
   
           $notetaking = Notetaking::findOrfail($id);
   
           $notetaking->delete();
   
           return redirect()->route('account.list')->with('success','Note deleted Successfully.');
   
   
       }




}
