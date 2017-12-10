<?php
header('Content-Type: text/html;charset=utf-8');
$output = [];
function make_request($xml, &$output){
    $options = [
        'http' => [
            'method' => "POST",
            'header' => "User-Agent: PHPRPC/1.0\r\n"
            . "Content-Type: text/xml\r\n"
            . "Content-length: " . strlen($xml) . "\r\n",
            'content'=> "$xml"
        ]
    ];
    $context = stream_context_create($options);
    $retval = file_get_contents('http://mysite.local/PHP-2017/course_3/xml-rpc/xml-rpc-server.php', false, $context);
    $data = xmlrpc_decode($retval);
    if(is_array($data) && xmlrpc_is_fault($data)){
        $output = $data;
    }else{
        $output = unserialize(base64_decode($data));
    }
}
$id = 5;
$request_xml = xmlrpc_encode_request("getNewsById", array($id));
make_request($request_xml, $output);
var_dump($output);
?>