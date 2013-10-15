<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/
    
	public function showWelcome()
	{
        return $this->theme->of('hello')->render();
	}
    public function mailhistory(){
        $history = MailHistory::all();
        //var_dump($users);
     // return View::make('history',array('histories'=>$history));
        return $this->theme->of('history',array('histories'=>$history))->render();
        
    }
    public function sendmail1(){
        $input = array(
			'email' => Input::get('email'),
			'subject' => Input::get('subject'),
			'content' => Input::get('content')
			);
            $rules = array (
			'email' => 'required|min:4|max:32|email',
			'subject' => 'required|min:6'
			
			);

		//Run input validation
		$v = Validator::make($input, $rules);

		if ($v->fails())
		{
			// Validation has failed
            
			return Redirect::to('/')->withErrors($v)->withInput();
		}
		else{
            $data['subject'] =  $input['subject'];
            $data['from'] = Sentry::getUser()->email;
            $data['data'] = $input['content'];

            $history = new MailHistory;
            $history->from = Sentry::getUser()->email;
            $history->to    = $input['email'];
            $history->subject= $data['subject'];
            $history->msg_body =$data['data'];
            $history->save();
			
            /*Mail::send('sendmail', $data, function($m) use($data)
				{
				    $m->to($data['from'])->subject($data['subject']);
           	}); */
           
        }
            Session::flash("msg","Message sent successfully");

            return Redirect::to("/");
    }
    public function login_view()
	{
        return $this->theme->of('login')->render();
	}
    public function register_view()
	{
        return $this->theme->of('register')->render();
	}
     public function login()
	{
        $name = Input::get('name');
	}
    

}
