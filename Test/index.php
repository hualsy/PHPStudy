<?php
//framework/index2.php
//$input = $_GET['name'];
require_once __DIR__ . '/vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

$request = Request::createFromGlobals();
//$request = Request::create('index2.php?name=543');



$input = $request->get('name','World');

$response = new Response(sprintf('Hello %s\n',htmlspecialchars($input,ENT_QUOTES,'UTF-8')));

$response ->send();

function ResponseSend($l,$input){
    (new Response(sprintf($l.' : %s\n',htmlspecialchars($input,ENT_QUOTES,'UTF-8')))) -> send();
}
// the URI being requested (e.g. /about) minus any query parameters
//
$getPathInfo = $request->getPathInfo();
ResponseSend('getPathInfo',$getPathInfo);
// retrieve GET and POST variables respectively
// 分别取出GET和POST变量
$foo = $request->query->get('foo');
ResponseSend('foo',$foo);
$bar = $request->request->get('bar', 'default value if bar does not exist');
ResponseSend('bar',$bar);
// retrieve SERVER variables
// 取出SERVER变量
$HTTP_HOST = $request->server->get('HTTP_HOST');
ResponseSend('HTTP_HOST',$HTTP_HOST);

// retrieves an instance of UploadedFile identified by foo
// 通过foo取出一个UploadedFile实例
$fileFoo = $request->files->get('foo');
ResponseSend('fileFoo',$fileFoo);
// retrieve a COOKIE value
// 取出一个COOKIE值
$PHPSESSID = $request->cookies->get('PHPSESSID');
ResponseSend('PHPSESSID',$PHPSESSID);
// retrieve an HTTP request header, with normalized, lowercase keys
// 通过取出一个HTTP请求头
$host = $request->headers->get('host');
ResponseSend('host',$host);

$content_type = $request->headers->get('content_type');
ResponseSend('content_type',$content_type);

$getMethod = $request->getMethod();    // GET, POST, PUT, DELETE, HEAD
ResponseSend('getMethod',$getMethod);
// an array of languages the client accepts
// 客户端所能接受的语言之数组
$getLanguages = $request->getLanguages();
ResponseSend('getLanguages',$getLanguages);

//$input = isset($_GET['name']) ? $_GET['name'] : 'World';
//
//header('Content-Type: text/html; charset = utf-8');
//
////printf('Hello %s',$input);
//printf('Hello %s',htmlspecialchars($input,ENT_QUOTES,'UTF-8'));