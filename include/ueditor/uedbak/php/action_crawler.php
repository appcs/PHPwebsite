<?php
/**
 * 抓取远程图片
 * User: Jinqn
 * Date: 14-04-14
 * Time: 下午19:18
 */
set_time_limit(0);
include("Uploader.class.php");
require_once(dirname(__file__).'/../../common.inc.php');
require_once(dirname(__file__).'/../../userlogin.class.php');
/* 上传配置 */
$config = array(
    "pathFormat" => $CONFIG['catcherPathFormat'],
    "maxSize" => $CONFIG['catcherMaxSize'],
    "allowFiles" => $CONFIG['catcherAllowFiles'],
    "oriName" => "remote.png"
);
$fieldName = $CONFIG['catcherFieldName'];
 
/* 抓取远程图片 */
$list = array();
if (isset($_POST[$fieldName])) {
    $source = $_POST[$fieldName];
} else {
    $source = $_GET[$fieldName];
}
foreach ($source as $imgUrl) {
    $item = new Uploader($imgUrl, $config, "remote");
    $info = $item->getFileInfo();
    array_push($list, array(
        "state" => $info["state"],
        "url" => $info["url"],
        "size" => $info["size"],
        "title" => htmlspecialchars($info["title"]),
        "original" => htmlspecialchars($info["original"]),
        "source" => htmlspecialchars($imgUrl)
    ));
    SaveUploadInfo($info);
}
 
/* 返回抓取数据 */
return json_encode(array(
    'state'=> count($list) ? 'SUCCESS':'ERROR',
    'list'=> $list
));
function SaveUploadInfo($info)
{
    global $dsql;
    $cuserLogin = new userLogin();
    $url = $info["url"];
    $filename = $info["title"];
    $imgwidthValue = "";
    $imgheightValue = "";
    $imgsize = $info["size"];
    $nowtme = time();
    $mid=$cuserLogin->getUserID();
    $inquery = "INSERT INTO `jcode_uploads`(arcid,title,url,mediatype,width,height,playtime,filesize,uptime,mid)
       VALUES ('0','$filename','$url','1','','','0','$imgsize','$nowtme','$mid'); ";
    $dsql->ExecuteNoneQuery($inquery);
    $fid = $dsql->GetLastID();
    AddMyAddon($fid, $filename);
    return;
}