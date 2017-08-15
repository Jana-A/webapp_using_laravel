<?php

namespace App\Http\Controllers;

use \Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Session\SessionServiceProvider;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class UserSetup extends Controller
{
    public function login_ctrl(Request $request)
    {
        $username = strtolower($request->input('login_username'));
        $password = htmlentities(trim($request->input('login_password')));

        $t_password = DB::table('users')->where('username', $username)->value('password');

        if (password_verify($password, $t_password)) {
            Session::put('user_agent', $username);
            $prev_url = Session::get('prev_url');
            if (preg_match("/search_service_ctrl/", $prev_url)) {
                return Redirect::to('browse');
            } else {
                return Redirect::to($prev_url);
            }
        } else {
            header('HTTP/1.1 401 Unauthorized');
            header('WWW-Authenticate: Basic realm="AWF"');
            exit("You need a valid username and password.");
        }
    }

    public function register_ctrl(Request $request)
    {
        $firstname = $request->input('firstname') ? $request->input('firstname') : "";
        $lastname = $request->input('lastname') ? $request->input('lastname') : "";
        $country = $request->input('country') ? $request->input('country') : "";
        $city = $request->input('city') ? $request->input('city') : "";
        $organisation = $request->input('organisation') ? $request->input('organisation') : "";
        $title = $request->input('occupation') ? $request->input('occupation') : "";
        $username = strtolower($request->input('username'));
        $password = bcrypt($request->input('password'));
        $email = strtolower($request->input('email'));

        if (Input::file('image')) {
        $ext = $request->file('image')->getClientOriginalExtension();
        $image_content = file_get_contents(Input::file('image'));
        $base64 = base64_encode($image_content);
        } else {
            $base64 = '';
        }

        DB::beginTransaction();
        try {
                $username_query = DB::table('users')->select('username')->where('username', '=', $username)->get();
                $email_query = DB::table('users')->select('email')->where('email', '=', $email)->get();
                if (count($username_query) != 0 || count($email_query) != 0) {
                    $msg = "Username or email already exists.";
                    return 'Username or email already exist!';
                } else {
                    $modify = DB::insert('insert into users(firstname, lastname, country, city, organisation, occupation, username, password, email, image) values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', array($firstname, $lastname, $country, $city, $organisation, $title, $username, $password, $email, $base64));
                    DB::commit();
                    return Redirect::to('login');
                }
           } catch (Exception $e) {
        DB::rollBack();
        return 'Registration: something went wrong!';
           }
        }
}