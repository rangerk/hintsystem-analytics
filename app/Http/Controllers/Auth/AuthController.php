<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

use App\Snippet;
use App\Repositories\SnippetRepository;
use Socialite;

use Mail;
use App\Translate;
use App\Account;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    // protected $redirectTo = '/snippets';
    // protected $redirectTo = '/admins/show';
    protected $redirectTo = '/tokens/save';
  
    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
        // $user->icons = '/icon/icon1.png,/icon/icon2.png,/icon/icon3.png';
        $user->icons = '/hint-icon-i1.png,/hint-icon-i2.png,/hint-icon-q1.png';
        $user->translate = 'en';
        $user->voting = 'on';
        $user->tab = 'settings';
        $user->columns = 'Id,Nickname,Content,Snippet';
        $user->max = 7;
        $user->domains = '';
        $user->counter = 1;
        $user->test = 'off';
        $user->save();
      
        //User::where('columns', '')->update(['columns' => 'Id,Nickname,Content,Snippet']);
        //User::where('max', 0)->update(['max' => 7]);
      
        $account = $user->accounts()->create([
          'nickname' => 'Main Account',
          
          'domains' => $user->domains,
          'counter' => $user->counter,
          'test' => $user->test,
          'icons' => $user->icons,
          'translate' => $user->translate,
          'tab' => $user->tab,
          'voting' => $user->voting,
          'columns' => $user->columns,
          'max' => $user->max,
          
          'onoff' => 'on',
          
        ]);
      
        $user->select($account->id);
        //$s = $user->snippets()->create([
        $s = $user->account()->snippets()->create([
            'content' => 'Hello, World!',
            // 'snippet' => '<div class="hs"></div>'
            'nickname' => 'my first hint',
            'num' => 1,
            'on' => 'on',
          //  'tags' => 'hello world,first hint',
            'tags' => '',
          
            'header' => '',
            'footer' => '',
          //  'activation' => 'click',
            'activation' => 'persistent',
          //  'icon' => 'info.ico',
            'icon' => explode(',', $user->icons)[0],
          
            'type' => 'inline',
          //  'icons' => 'info.ico,success.ico,default.ico',
            'icons' => $user->icons,
            'voting' => 'on',
        ]);
        $sr = new SnippetRepository();
        $s->snippet = $sr->generate($s->id);
        $s->user_id = $user->id;
        
        $s->save();
       // $t = new Translate();
        /*
        Mail::send('auth.emails.welcome', ['user' => $user], 
          function($m) use ($user) {
            $t = new Translate();
            //$m->from('roman@hintsystem.com', 'Roman Skaskiw');
            //$m->from('roman@hintsystem.com', $t->translate('the Hint System Team'));
            $m->from('no-reply@hintsystem.com', 'No Reply');
            $m->to($user->email, $user->name)->subject($t->translate('Welcome to Hint System'));
        });
        */
      
        /*
        $user->update([
          'icons' => '/icon/icon1.png,/icon/icon2.png,/icon/icon3.png'
        ]);
        */
        /*Account::create([
          'user_id' => $user->id,
          //'user2_id' => $user->id
          'nickname' => 'Main Account',
        ]); */

      
        return $user;
    }
  
    public function redirectToProvider($provider) {
       request()->session()->put('socialite.provider', $provider);
      
       return Socialite::driver($provider)->redirect();
    }
  
    public function handleCallbackProvider() {
        $provider = request()->session()->get('socialite.provider', null);
        if (!$provider) {
            return redirect('/');
        }
       /* if (!request()->state) {
            return redirect('/');
        } */
        // $request()->session()->get('state')
        $user = Socialite::driver($provider)->user();
        if (!$user) {
            return redirect('/');
        }
        $u = User::where('email', '=', $user->getEmail())->first();
        if ($u){
          Auth::loginUsingId($u->id);
          return redirect('/');
        } else {
          return redirect('/register')->with('email', $u->email);
        }
    }
}
