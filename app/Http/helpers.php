<?php

function compile_services_html($array_of_dicts, $flag, $user)
    {
        $container = '<div class="container col-md-8 col-md-offset-2" style="margin-top:15px;">';
        $bootstrap_item = '
          <div class="panel panel-default">
            <div class="panel-heading">
              <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapse%u">%s</a>
              </h4>
            </div>
            <div id="collapse%u" class="panel-collapse collapse">
              <div class="list-group">
                <div class="list-group-item list-group-item-action flex-column align-items-start">
                  <div class="d-flex w-100 justify-content-between">
                    <small class="text-muted"><b>Where</b>: %s - %s</small>
                    <br />
                    <small class="text-muted"><b>Who</b>: <a id="who_username" href="http://localhost/blog/profile?user=%s">%s</a></small>
                    <br />
                    <small class="text-muted"><b>Type</b>: %s</small>
                    <br />
                  </div>
                  <br />
                  <p><b>Description</b>: %s</p><hr />';
        if ($flag) {
        	$bootstrap_item .= '<small class="text-muted"><a href="http://localhost/blog/service_post?id=%u" target="_blank">Click here for more info</a></small>';
}

        $count = 1;
        $final = $container;

        if (count($array_of_dicts) == 0) {
        	return $container.'
          <div class="panel panel-default">
            <div class="panel-heading">
              <h4 class="panel-title">
                <div>Nothing Found</div>
              </h4>
            </div>
          </div></div>';
        } else {
            foreach ($array_of_dicts as $dict) {
                $final .=  sprintf($bootstrap_item, $count,
                                                    $dict->category.' - '.$dict->subcategory,
                                                    $count,
                                                    $dict->city,
                                                    $dict->country,
                                                    $dict->username,
                                                    $dict->username,
                                                    $dict->service_type,
                                                    $dict->description,
                                                    $dict->services_table_id
                                                    );
                if ($user == $dict->username) {
                	$render = sprintf('<div><small class="text-muted"><a href="http://localhost/blog/delete_post?id=%u" onclick="return confirm(\'Are you sure you want to delete this Ad?\');" style="color:red;">Delete Ad</a></small></div></div></div></div></div>', $dict->services_table_id);
                	$final .= $render;
                } else {
                	$final .= '</div></div></div></div>';
                }
                $count += 1;
            }
        }
        return $final.'</div>';
    }


?>