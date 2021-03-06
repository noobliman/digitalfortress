<?php

namespace App\Http\Controllers;

use App\Mail\AccountActivation;
use Illuminate\Http\Request;

use App\Http\Requests;
use Socialite;
use App\users;
use App\hints;
use App\leaderboard;
use Illuminate\Validation\Validator;
use Illuminate\Support\Facades\Hash;



class HomeController extends Controller
{
    private function leaderboard_entry($user)
    {
        $lentry = new leaderboard();
        $lentry->email = $user->email;
        $lentry->username = $user->username;
        $lentry->round_id = intval(1);
        $lentry->save();
    }
    private function sortcomp($a,$b){
        if ($a['round_id']>$b['round_id']){
                return -1;
        }
        else if($a['round_id']==$b['round_id']){

            if($a['updated_at']>$b['updated_at'])
                return 1;
            else 
                return -1;
        }
        else{
            return 1;
        }
    }

    public function landing(){
        return view('landing');
    }

    public function rules(){
        return view('quiz/rules')->with(['tab'=>3,'dashname'=>'Rules and Regulations']);
    }

    public function hints(){
        $hints = hints::all()->toArray();
        return view('quiz/hints')->with(['tab'=>5,'dashname'=>'Hints', 'hints'=>$hints]);
    }


    public function dashboard()
    {

        if (session()->has('email'))
        {
            $email = session('email');
            $lboard = leaderboard::all()->toArray();
            $people = count($lboard);

            usort($lboard, array($this,"sortcomp"));

            $key = array_search($email, array_column($lboard, 'email'));
            
            $lboard = array_slice($lboard, ($key-4>0)?$key-4:0, ($key+4<=count($lboard))?$key+4:count($lboard), true);

            $cc = leaderboard::where('round_id','>',$lboard[$key]['round_id'])->count();

            return view('dashboard')->with(['name'=>session('name'),'tab'=>1,'stats'=>$lboard,'people'=>$people,'dashname'=>'My Dashboard', 'key'=>$key, 'cc'=>$cc]);
        }
        else{
            return view('loginregister')->with(['tab'=>1]);
        }
    }

    public function lboard()
    {
        $lboard = leaderboard::all()->toArray();
        $sz = count($lboard);
        usort($lboard, array($this,"sortcomp"));
        return view('quiz/leaderboard')->with(['tab'=>4,'sz'=>$sz,'stand'=>$lboard,'name'=>session('name'),'dashname'=>'Leaderboard']);
    }

    public function scboard()
    {
        $lboard = leaderboard::all()->toArray();
        $sz = count($lboard);
        $llb=array();
        $incI=0;
        usort($lboard, array($this,"sortcomp"));
        foreach ($lboard as $key => $value) {
            $llb[$incI]['email']=$value[0];
            $llb[$incI]['id']=$incI+1;
            $llb[$incI]['name']=$value[1];
            $llb[$incI]['rank']=$incI+1;
            $llb[$incI]['score']=$value[2];
            $incI++;
        }

        $encodedSku = json_encode($lboard);
        echo $encodedSku;
    }

    public function login(Request $requests)
    {
        $email = $requests->input('email');
        $password = $requests->input('password');
        $profile = users::where('email',$email)->where('activation_status', 1)->first();
        if(!empty($profile))
        {
            /*
            Add your code here. The code must sent a verification code to users mail using smtp. store the user's record in
            a separate table. whenever he/she logs in redirect to the enter otp page. after it is verified delete the record from
            that table and push it in the final verified users table
            */
            if (Hash::check($password, $profile->password)){
                session()->put(['name'=>$profile['username'],'email'=>$profile['email']]);
                return redirect('dashboard');
            }else{
                return view('loginregister')->withErrors(['msg' => 'Incorrect Email or Password.']);

            }
        }
        return view('loginregister')->withErrors(['msg' => 'Incorrect Email or you haven\'t activated your account.']);
    }
    public function register(Request $requests)
    {
        $rules = array(
        'username'    => 'required', 
        'email'       => 'required',
        'password'    => 'required|min:3'
        );

        $this->validate($requests, $rules);
        
        $profile = users::where('email',$requests->input('email'))->first();
        if(!empty($profile))
        {
            return view('dashboard')->with(['newusertext'=>'error','tab'=>1]);
        }
        $newuser = new users;
        $newuser->email = $requests->input('email');
        $newuser->username = $requests->input('username');
        $newuser->password = Hash::make($requests->input('password'));
        $newuser->code = $this->generateCode();

        /*
         * Upon registeration send a mail to the User
         *
         * */
        $this->sendEmail($newuser);

        $newuser->save();
        $this->leaderboard_entry($newuser);

        $message = 'BREAK A LEG !!';

        return view('activation')->with(['username' => $newuser->username, 'email' => $newuser->email ]);
    }

    public function sociallogin($id)
    {
        return Socialite::driver($id)->redirect();
    }


    public function socialcallback(Request $requests, $id)
    {
        $user = Socialite::driver($id)->stateless()->user();
        $email = $user->getEmail();
     
        $profile = users::where('email',$email)->first();
        $flag=0;
        $password='';

        if(empty($profile))
        {
            $profile = new users;
            $profile->email     = $user->getEmail();
            $profile->username  = $user->getName();
            $password           = str_random(8);
            $profile->password  = Hash::make($password);
            $profile->save();

            $this->leaderboard_entry($profile);
            $flag=1;
        }
        session()->put(['email'=>$email,'name'=>$profile['username'] ]);

        if($flag==1){
            $message = "Your password is ".$password.'.\n\nUse this to login directly.\n\nBREAK A LEG !!';
            return view('dashboard')->with(['email'=>$email,'name'=>$profile['username'],'newusertext'=>$message,'tab'=>1]);
        }

        return redirect('dashboard');

    }
    public function logout()
    {
        session()->flush();
        return redirect('dashboard');
    }
    
    public function myprofile()
    {
        $username = users::where('email',session('email'))->select('username')->get()->first()['username'];
        return view('quiz/myprofile')->with(['dashname'=>'My Profile','name'=>$username,'email'=>session('email')]);
    }

    public function updatepassword(Request $requests)
    {

        $password = users::where('email',session('email'))->select('password')->get()->first();
        $upassword = $requests->input('cp');
        $npassword = Hash::make($requests->input('np'));
        if(strlen($upassword)<3)
            return 2;
        if (Hash::check($upassword, $password->password)) {
            users::where('email',session('email'))->update(['password'=>$npassword]);
            return 1;
        }
        else
            return 3;
    }


    public function sendEmail($user){
        \Mail::to($user)->send(new AccountActivation($user));
    }

    public function generateCode(){
        return hexdec(uniqid());
    }

    public function activateAccount($email,$code){

        $user = users::where('email', $email)->where('code', $code)->first();

        if ($user){
            $user->update(['activation_status' => 1]);
            return view('activation-success');
        }else{
            return view('activation-failed');
        }
    }

    public function resendActivation(Request $request){
//        return $request->email;
        $user = users::where('email', $request->email)->first();

        if ($user){
            if ($user->activation_status == 1){
                return view('resend-activation')->withErrors(['msg' => 'Account has already been activated. Try to login']);
            }else{
                $this->sendEmail($user);
                return view('activation')->with(['username' => $user->username, 'email' => $user->email ]);
            }
        }else{
            return view('resend-activation')->withErrors(['msg' => 'Invalid email or email does not exist']);
        }
    }

    public function getResendActivation(){
        return view('resend-activation');
    }
}

