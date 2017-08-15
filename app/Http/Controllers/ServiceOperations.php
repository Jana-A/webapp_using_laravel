<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Input;

class ServiceOperations extends Controller
{
   public function add_service_ctrl(Request $request)
    {
        $username = Session::get('user_agent');

        $service_category = $request->input('service_category') ? $request->input('service_category') : "";
        $service_type = $request->input('service_type') ? $request->input('service_type') : "";
        $country = $request->input('country') ? $request->input('country') : "";
        $city = $request->input('city') ? strtolower($request->input('city')) : "";
        $start = $request->input('start') ? $request->input('start') : "";
        $end = $request->input('end') ? $request->input('end') : "";
        $description = $request->input('description') ? $request->input('description') : "";

        $service_split = explode("-", $service_category);

        $service_id = DB::table('service_category')->where('category', '=', $service_split[0])->where('subcategory', '=', $service_split[1])->value('service_category_table_id');
        $modify = DB::insert('insert into services(username, service_id, service_type, start, end, city, country, description) values (?, ?, ?, ?, ?, ?, ?, ?)', array($username, $service_id, $service_type, $start, $end, $city, $country, $description));

        return Redirect::to('browse');
    }


   public function search_service_ctrl(Request $request)
    {
        if (Session::has('user_agent')) {
            $flag = true;
            $user_var = Session::get('user_agent');
        } else {
            $flag = false;
            $user_var = "";
        }

        $service_category = $request->input('service_category');
        $service_type = $request->input('service_type') ? $request->input('service_type') : "";
        $user = $request->input('user');
        $city = $request->input('city');

        if ($service_category) {
            $service_split = explode("-", $service_category);
            $category = $service_split[0];
            $subcategory = $service_split[1];
 
            $service_id = DB::table('service_category')
                            ->where('category', '=', $category)
                            ->where('subcategory', '=', $subcategory)
                            ->value('service_category_table_id');
            $db_q1 = DB::table('services')
                            ->leftjoin('service_category', 'services.service_id', '=', 'service_category.service_category_table_id')
                            ->where('service_id', '=', $service_id)
                            ->get();
        } else {
            $category = null;
            $subcategory = null;
            $db_q1 = array();
        }

        $db_q2 = DB::table('services')
                        ->leftjoin('service_category', 'services.service_id', '=', 'service_category.service_category_table_id')
                        ->where('service_type', '=', $service_type)
                        ->get();

        $db_q3 = DB::table('services')
                        ->leftjoin('service_category', 'services.service_id', '=', 'service_category.service_category_table_id')
                        ->where('username', '=', $user)
                        ->get();

        $db_q4 = DB::table('services')
                        ->leftjoin('service_category', 'services.service_id', '=', 'service_category.service_category_table_id')
                        ->where('city', '=', $city)
                        ->get();


        $all_arr = array();
        $counter = 0;
        $arr_pool = array($db_q1, $db_q2, $db_q3, $db_q4);
        foreach ($arr_pool as $arr) {
            foreach ($arr as $dict) {
                $all_arr[$counter] = $dict;
                $counter++;
            }
        }

        $my_arr = array_unique($all_arr, SORT_REGULAR);
        $arr_numb = 0;
        foreach ($my_arr as $an_arr) {
            $arr_category = $an_arr->category;
            $arr_subcategory = $an_arr->subcategory;
            $arr_service_type = $an_arr->service_type;
            $arr_user = $an_arr->username;
            $arr_city = $an_arr->city;

        if ($category) {
            if (strcasecmp($arr_category, $category) != 0) {
                unset($my_arr[$arr_numb]);
                $arr_numb++;
                continue;
            }
        }
        else if ($subcategory) {
            if (strcasecmp($arr_subcategory, $subcategory) != 0) {
                unset($my_arr[$arr_numb]);
                $arr_numb++;
                continue;
            }
        }
        else if (strcasecmp($arr_service_type, $service_type) != 0) {
            unset($my_arr[$arr_numb]);
            $arr_numb++;
            continue;
        }
        else if ($user != "") {
            if (strcasecmp($arr_user, $user) != 0) {
                unset($my_arr[$arr_numb]);
                $arr_numb++;
                continue;
            }
        }
        else if ($city != "") {
            if (strcasecmp($arr_city, $city) != 0) {
                unset($my_arr[$arr_numb]);
                $arr_numb++;
                continue;
            }
        }
        $arr_numb++;
        }

        $reindex_arr = array_values($my_arr);
        $service_html = compile_services_html($reindex_arr, $flag, $user_var);
        return view('services', ['elems' => $service_html]);

    }

   public function browse(Request $request)
    {
        if (Session::has('user_agent')) {
            $flag = true;
            $user_var = Session::get('user_agent');
        } else {
            $flag = false;
            $user_var = "";
        }

        $service_listan = DB::table('services')
    	        ->leftjoin('service_category', 'services.service_id', '=', 'service_category.service_category_table_id')
    	        ->get();

        $service_html = compile_services_html($service_listan, $flag, $user_var);

        return view('services', ['elems' => $service_html]);
    }

   public function service_post(Request $request)
    {
        $id = $request->input('id');
        $service_query = DB::table('services')
        ->leftjoin('service_category', 'services.service_id', '=', 'service_category.service_category_table_id')
        ->where('services.services_table_id', '=', $id)
        ->get();

        $dict = $service_query[0];
        
        $comments_query = DB::table('service_comments')
        ->where('service_number', '=', $id)
        ->get();

        $chat_msgs = '';

        foreach($comments_query as $comment_record) {
            $chat_msgs .= '
                <div class="row message-bubble">
                    <p class="text-muted" style="padding-left:20px;">'.$comment_record->username.'</p>
                    <p style="padding-left:20px;">'.$comment_record->comment.'</p>
                </div>';

        }

$chat_content = '
<div class="container form-control">
    <div class="row">
        <div class="panel panel-default">
          <div class="panel-heading">'.$dict->category.' - '.$dict->subcategory.'</div>
          <div class="panel-body">
            <div class="container">
                <div class="row message-bubble">

              <div class="list-group">
                  <div class="d-flex w-100 justify-content-between">
                    <small class="text-muted"><b>Where</b>: '.$dict->city.'</small>
                    <br />
                    <small class="text-muted"><b>Who</b>: '.$dict->username.'</small>
                    <br />
                    <small class="text-muted"><b>Type</b>: '.$dict->service_type.'</small>
                    <br />
                  </div>
                  <br />
                  <p><b>Description: </b>'.$dict->description.'</div></div> </div>'.$chat_msgs.
            '</div>
            <div class="panel-footer">
                </div>
            </div>
        </div>
    </div>
';


return view('service_post', ['content' => $chat_content]);
        //{{ app('request')->input('id') }}
        //return view('service_post');
//        if (Session::has('user_agent')) {
//            $flag = true;
//        } else {
//            $flag = false;
//        }
//        $service_listan = DB::table('services')
//                ->leftjoin('service_category', 'services.service_id', '=', 'service_category.id')
//                ->get();
//        $service_html = compile_services_html($service_listan, $flag);
//        return view('services', ['elems' => $service_html]);
    }

   public function post_comment(Request $request)
    {
        $username = Session::get('user_agent');
        $service = $request->input('invisible');
        $msg = $request->input('msg');

        //$comments_query = DB::table('service_comments')
        //->where('service_comments_table_id', '=', $id)
        //->get();

        $modify = DB::insert('insert into service_comments(username, service_number, comment) values (?, ?, ?)', array($username, $service, $msg));
        return Redirect::back();
    }

   public function delete_post(Request $request)
    {
        $srv_id = $request->input('id');
        DB::table('services')->where('services_table_id', '=', $srv_id)->delete();
        return Redirect::back();
    }

}
