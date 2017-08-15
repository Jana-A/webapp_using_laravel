<?php

namespace App\Http\Controllers;

use \Exception;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Session\SessionServiceProvider;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class UserProfile extends Controller
{
    public function view_profile(Request $request)
    {
    	if (Session::exists('user_agent')) {

    		    $username = $request->input('user');
    		    if ($username == "") {
    	            $username = Session::get('user_agent');
    	        }
            
                $db_query = DB::table('users')->where('username', $username)->get();//value('image_col');
                $user = $db_query[0]->username;
                $firstname = ucfirst($db_query[0]->firstname);
                $lastname = ucfirst($db_query[0]->lastname);
                $organisation = $db_query[0]->organisation;
                $occupation = $db_query[0]->occupation;
                $city = $db_query[0]->city;
                $country = $db_query[0]->country;
                $email = $db_query[0]->email;
                $image = '';
                $image = $db_query[0]->image;
                //$image_src = '"data:image/png;base64,'.$image.'"';
                $image_src = 'data:image/png;base64,'.$image;
    	
            	$query = DB::table('user_ratings')
                    ->where('user', $username)
                    ->get();
                $yes = 0;
                $no = 0;
                foreach($query as $record) {
                	if ($record->score) {
                		$yes++;
                	} else {
                		$no++;
                	}
                }
               $ratings = '<span class="glyphicon glyphicon-thumbs-up" aria-hidden="true">'.$yes.'</span>-'.
                          '-<span class="glyphicon glyphicon-thumbs-down" aria-hidden="true">'.$no.'</span>';

                return view('profile', ['user' => $user, 'firstname' => $firstname, 'lastname' => $lastname, 'organisation' => $organisation, 'occupation' => $occupation, 'city' => $city, 'country' => $country, 'email' => $email, 'image_src' => $image_src, 'ratings' => $ratings]);
            
                
                } else {
        	        exit("Login to view profiles!");
        }
    }


    public function edit_profile(Request $request)
    {
    	$username = Session::get('user_agent');

        $firstname = $request->input('firstname') ? $request->input('firstname') : "";
        $lastname = $request->input('lastname') ? $request->input('lastname') : "";
        $country = $request->input('country') ? $request->input('country') : "";
        $city = $request->input('city') ? $request->input('city') : "";
        $organisation = $request->input('organisation') ? $request->input('organisation') : "";
        $occupation = $request->input('occupation') ? $request->input('occupation') : "";

        $email = $request->input('email');

        if (Input::file('image')) {
        $ext = $request->file('image')->getClientOriginalExtension();
        $image_content = file_get_contents(Input::file('image'));
        $base64 = base64_encode($image_content);
        } else {
            $base64 = '';
        }

        DB::table('users')
            ->where('username', $username)
            ->update(['firstname' => $firstname,'lastname' => $lastname, 'country' => $country, 'city' => $city, 'organisation' => $organisation, 'occupation' => $occupation, 'image' => $base64]);

        return Redirect::to('profile'); 
   }

    public function rate_user(Request $request)
    {
    	$user = $request->input('user');
    	$referee = $request->input('referee');
    	$score = $request->input('score');

        $query = DB::table('user_ratings')
            ->where('user', $user)
            ->where('referee', $referee)
            ->get();
        $query_length = count($query);

        if ($query_length == 0) {
            $modify = DB::insert('insert into user_ratings(user, referee, score) values (?, ?, ?)', array($user, $referee, $score));
            return Redirect::back();
        } elseif ($query_length == 1 and $query[0]->score != $score) {
            $modify = DB::insert('insert into user_ratings(user, referee, score) values (?, ?, ?)', array($user, $referee, $score));
            return Redirect::back();
        } else {
            return Redirect::back();        	
        }
    }

}


