<?php
function expexcel($attributes,$labels){
    $label = ['Т\р'];

    $outpul = "
                    <html xmlns:x=\"urn:schemas-microsoft-com:office:excel\">
                    <head>
                        <!--[if gte mso 9]>
                        <xml>
                            <x:ExcelWorkbook>
                                <x:ExcelWorksheets>
                                    <x:ExcelWorksheet>
                                        <x:Name>Sheet 1</x:Name>
                                        <x:WorksheetOptions>
                                            <x:Print>
                                                <x:ValidPrinterInfo/>
                                            </x:Print>
                                        </x:WorksheetOptions>
                                    </x:ExcelWorksheet>
                                </x:ExcelWorksheets>
                            </x:ExcelWorkbook>
                        </xml>
                        <![endif]-->
                        <style>
                        td,th{
                          font-family: 'Times New Roman', sans-serif;
                          border-collapse: collapse;
                          width: 100%;
                        }
                    
                         td,  th {
                          border: 1px solid #000;
                          padding: 4px;
                        }
                        th{
                            font-weight: bold;
                        }
                        </style>
                    </head>
                    
                    <body>
                    <table class='table'><tr><th>Т\р</th>";

    foreach ($labels as $item) {
        $outpul.="<th>$item</th>";
    }
    $outpul.="</tr>";
    return $outpul;
}

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
