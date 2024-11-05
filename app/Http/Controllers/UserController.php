<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Post;
use App\Models\Application;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function show_login () {
        
        return view('login');
    }
    public function show_reg () {
        return view('reg');
    }

    public function login (Request $request) {


        $validator = Validator::make($request->all(), [
            "email"=>["required", "email"],
            "password"=>["required"],
        ],
        $messages = [
            'email.required' => 'Не введена электронная почта',
            'password.required' => 'Не введен пароль',
            'email.email' => 'Неверный формат почты',
        ]
    );
    if ($validator->fails()) {
        return redirect()->route('login')->withErrors($validator);
    }
    else {

        $user = User::where('email', $request->email)->exists();
        if ($user != false) {
        $user = User::where('email', $request->email)->first();
        $pass = $user->password;
        $id = $user->id;
        $role = $user->role;

        if (Hash::check($request->password, $pass)) {
            Auth::login(User::find($id));
            if ($role == 'user') {
                session_start();
                $_SESSION['role'] = 'user';
                return redirect()->route('index');
            }
            else {
                session_start();
                $_SESSION['role'] = 'admin';
                return redirect()->route('admin');
            }
            
        } else {
            return redirect()->route('login')->withErrors(['password' => 'Неверный пароль']);
     }  
    }
    else {
        return redirect()->route('login')->withErrors(['email' => 'Такого пользователя нет']);
    }
}
    }

    public function reg (Request $request) {

        $validator = Validator::make($request->all(), [
            "name"=>["required"],
            "email"=>["required", "email", "unique:users"],
            "password"=>["required", "min:8"],
        ],
        $messages = [
            'name.required' => 'Не введено имя',
            'email.required' => 'Не введена электронная почта',
            'password.required' => 'Не введен пароль',
            'email.email' => 'Неверный формат почты',
            'email.unique' => 'Пользователь с такой почтой уже есть',
            'password.min' => 'Пароль должен быть не менее 8 символов',
        ]
    );
    if ($validator->fails()) {
        return redirect()->route('reg')->withErrors($validator);
    }
    else {
        $user = User::create(['name'=>$request->name,
        'email'=>$request->email,
        'password'=>Hash::make($request->password)]);

        Auth::login($user);
        return redirect()->route('index');
    }
        
    }


    public function exit() {
        Auth::logout();
        return redirect()->route('index');
    }

    public function admin () {
        $data =  ['appls'=>Application::latest()->get()];
        return view('admin/index', $data);
    }

    public function show_appl () {
        return view('appl');
    }

    public function my_appl () {
        $data =  ['appls'=>Application::where('id_user', Auth::id())->latest()->get()];
        return view('my_appl', $data);
    }
    

    public function appl (Request $request) {

        $validator = Validator::make($request->all(), [
            "appl"=>["required", "max:1000"],
        ],
        $messages = [
            'appl.required' => 'Не введен текст заявки',
            'appl.max' => 'Слишком длинный текст заявки',
        ]
    );
    if ($validator->fails()) {
        return redirect()->route('appl')->withErrors($validator);
    }
    else {
        
        $user = Application::create(['text'=>$request->appl, 'id_user'=>Auth::id(),]);

        return redirect()->route('my_appl')->withErrors(['success' => 'Заявка отправлена!']);
    }
        
    }

    public function reject (Application $id) {
        // DB::table('applications')->where('id', $id)->update(['status' => 'rejected']);
        
        $id->update(['status' => 'rejected']);
        $id->save();
        return redirect()->route('admin')->withErrors(['success' => 'Заявка отклонена!']);
    }
    public function accept (Application $id) {
        // dump($id);
        $id->update(['status' => 'accepted']);
        $id->save();
        return redirect()->route('admin')->withErrors(['success' => 'Заявка принята!']);
    }

    public function admin_posts () {
        $data =  ['posts'=>Post::latest()->get()];
        return view('admin/posts', $data);
    }

    public function show_edit (Application $id) {
        $data =  ['posts'=>Post::where('id', $id->id)->latest()->get()];
        return view('admin/edit', $data);
    }

    public function show_create () {
        return view('admin/create');
    }

    public function create (Request $request) {

        $validator = Validator::make($request->all(), [
            "title"=>["required", "max:40"],
            "text"=>["required"],
            "image"=>["required", "image"],
        ],
        $messages = [
            'title.required' => 'Не введено имя',
            'text.required' => 'Не введена электронная почта',
            'title.max' => 'Название должно быть не более 40 символов',
            'image.required' => 'Не отправлено фото',
            'image.image' => 'Отправлено не изображение',
        ]
    );
    if ($validator->fails()) {
        return back()->withErrors($validator);
    }
    else {
        $user = Post::create(['title'=>$request->title,
        'text'=>$request->text,
        'image'=>$request->image]);

        return redirect()->route('admin/posts');
    }
        
    }

    public function edit (Request $request) {

        $validator = Validator::make($request->all(), [
            "title"=>["required", "max:40"],
            "text"=>["required"],
        ],
        $messages = [
            'title.required' => 'Не введено имя',
            'text.required' => 'Не введена электронная почта',
            'title.max' => 'Название должно быть не более 40 символов',
        ]
    );
    if ($validator->fails()) {
        return back()->withErrors($validator);
    }
    else {
        // $user = Application::fill(['title'=>$request->name,
        // 'email'=>$request->email,
        // 'password'=>Hash::make($request->password)]);

        // Auth::login($user);
        return redirect()->route('admin/posts')->withErrors(['success' => 'Пост изменен!']);
    }
        
    }

}