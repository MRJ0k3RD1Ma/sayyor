<?php


function get_token($where = 'hamsa'){
    $url = Yii::$app->params[$where]['url']['token'].'?login='.Yii::$app->params[$where]['username'].'&pass='.Yii::$app->params[$where]['password'];

    $options = array(
        CURLOPT_RETURNTRANSFER => true,   // return web page
        CURLOPT_HEADER         => false,  // don't return headers
        CURLOPT_FOLLOWLOCATION => true,   // follow redirects
        CURLOPT_MAXREDIRS      => 10,     // stop after 10 redirects
        CURLOPT_ENCODING       => "",     // handle compressed
        CURLOPT_USERAGENT      => "test", // name of client
        CURLOPT_AUTOREFERER    => true,   // set referrer on redirect
        CURLOPT_CONNECTTIMEOUT => 120,    // time-out on connect
        CURLOPT_TIMEOUT        => 120,    // time-out on response
    );

    $ch = curl_init($url);
    curl_setopt_array($ch, $options);

    $content  = curl_exec($ch);

    curl_close($ch);
    $content = json_decode($content,true);
    if($content['code']['result']=='200'){
        return $content['data']['token'];
    }else{
        return -1;
    }

}

function get_web_page($url,$where) {
    $token = get_token($where);
    $url = $url .'&token='.$token;
    $options = array(
        CURLOPT_RETURNTRANSFER => true,   // return web page
        CURLOPT_HEADER         => false,  // don't return headers
        CURLOPT_FOLLOWLOCATION => true,   // follow redirects
        CURLOPT_MAXREDIRS      => 10,     // stop after 10 redirects
        CURLOPT_ENCODING       => "",     // handle compressed
        CURLOPT_USERAGENT      => "test", // name of client
        CURLOPT_AUTOREFERER    => true,   // set referrer on redirect
        CURLOPT_CONNECTTIMEOUT => 120,    // time-out on connect
        CURLOPT_TIMEOUT        => 120,    // time-out on response
    );

    $ch = curl_init($url);
    curl_setopt_array($ch, $options);

    $content  = curl_exec($ch);

    curl_close($ch);

    return $content;
}



function errdeb($model){
    echo "<pre>";
    var_dump($model);
    exit;
}