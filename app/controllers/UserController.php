<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


class UserController extends BaseController {

	

	public function showWelcome()
	{
        return $this->theme->of('hello')->render();
	}
    public function getLogin()
	{
        return $this->theme->of('user.login')->render();
	}
     public function getLogout(){
         
        Sentry::logout();
        return Redirect::to('user/login');
    }
    public function postLogin()
	{
        
	$input = array(
			'email' => Input::get('email'),
			'password' => Input::get('password'),
			'rememberMe' => Input::get('rememberMe')
			);

		// Set Validation Rules
		$rules = array (
			'email' => 'required|min:4|max:32|email',
			'password' => 'required|min:6'
			);

		//Run input validation
		$v = Validator::make($input, $rules);

		if ($v->fails())
		{
			// Validation has failed
			return Redirect::to('user/login')->withErrors($v)->withInput();
		}
		else
		{
			try
			{
			    //Check for suspension or banned status
				$user = Sentry::getUserProvider()->findByLogin($input['email']);
				$throttle = Sentry::getThrottleProvider()->findByUserId($user->id);
			    $throttle->check();

			    // Set login credentials
			    $credentials = array(
			        'email'    => $input['email'],
			        'password' => $input['password']
			    );

			    // Try to authenticate the user
			    $user = Sentry::authenticate($credentials, $input['rememberMe']);

			}
			catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
			{
			    
			    Session::flash('error', 'Invalid username or password.' );
				return Redirect::to('user/login')->withErrors($v)->withInput();
			}
			catch (Cartalyst\Sentry\Users\UserNotActivatedException $e)
			{
			    
			     Session::flash('error', 'You have not yet activated this account. <a href="/users/resend">Resend actiavtion?</a>');
				return Redirect::to('user/login')->withErrors($v)->withInput();
			}
            Session::flash('msg', 'Login Successfully' );
			//Login was succesful.
			return Redirect::to('/');
		}
	}

    public function getRegister()
	{
        return $this->theme->of('user.register')->render();
	}
   
    public function postRegister(){

    $input = array(
			'email' => Input::get('email'),
			'password' => Input::get('password'),
			'password_confirmation' => Input::get('password_confirmation')
			);

		// Set Validation Rules
		$rules = array (
			'email' => 'required|min:4|max:32|email',
			'password' => 'required|min:6|confirmed',
			'password_confirmation' => 'required'
			);

		//Run input validation
		$v = Validator::make($input, $rules);

		if ($v->fails())
		{
			// Validation has failed
			return Redirect::to('user/register')->withErrors($v)->withInput();
		}
		else
		{

			try {
				//Attempt to register the user.
				$user = Sentry::register(array('email' => $input['email'], 'password' => $input['password']));

				//Get the activation code & prep data for email
				$data['activationCode'] = $user->GetActivationCode();
				$data['email'] = $input['email'];
				$data['userId'] = $user->getId();

				//send email with link to activate.
				Mail::send('emails.auth.welcome', $data, function($m) use($data)
				{
				    $m->to($data['email'])->subject('Welcome to Laravel4 With Sentry');
				});

				//success!
		    	Session::flash('success', 'Your account has been created. Check your email for the confirmation link.');
		    	return Redirect::to('/');
                
			}
			catch (Cartalyst\Sentry\Users\LoginRequiredException $e)
			{
			    Session::flash('error', 'Login field required.');
                //echo 'error';
			    return Redirect::to('user/register')->withErrors($v)->withInput();
			}
			catch (Cartalyst\Sentry\Users\UserExistsException $e)
			{
			    Session::flash('error', 'User already exists.');
			    return Redirect::to('user/register')->withErrors($v)->withInput();
			}

		}
	}

	
    public function getResetpassword(){
         return $this->theme->of('user.resetpassword')->render();
         
    }
    
     public function login()
	{
        $name = Input::get('name');
	}


}
?>
