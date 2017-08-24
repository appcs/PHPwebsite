<?php
/**
 * 上传附件和上传视频
 * User: Jinqn
 * Date: 14-04-09
 * Time: 上午10:17
 */
include "Uploader.class.php";
require_once(dirname(__file__).'/../../common.inc.php');
require_once(dirname(__file__).'/../../userlogin.class.php');
/* 上传配置 */
$base64 = "upload";
switch (htmlspecialchars($_GET['action'])) {
    case 'uploadimage':
        $config = array(
            "pathFormat" => $CONFIG['imagePathFormat'],
            "maxSize" => $CONFIG['imageMaxSize'],
            "allowFiles" => $CONFIG['imageAllowFiles']
        );
        $fieldName = $CONFIG['imageFieldName'];
        break;
    case 'uploadscrawl':
        $config = array(
            "pathFormat" => $CONFIG['scrawlPathFormat'],
            "maxSize" => $CONFIG['scrawlMaxSize'],
            "allowFiles" => $CONFIG['scrawlAllowFiles'],
            "oriName" => "scrawl.png"
        );
        $fieldName = $CONFIG['scrawlFieldName'];
        $base64 = "base64";
        break;
    case 'uploadvideo':
        $config = array(
            "pathFormat" => $CONFIG['videoPathFormat'],
            "maxSize" => $CONFIG['videoMaxSize'],
            "allowFiles" => $CONFIG['videoAllowFiles']
        );
        $fieldName = $CONFIG['videoFieldName'];
        break;
    case 'uploadfile':
    default:
        $config = array(
            "pathFormat" => $CONFIG['filePathFormat'],
            "maxSize" => $CONFIG['fileMaxSize'],
            "allowFiles" => $CONFIG['fileAllowFiles']
        );
        $fieldName = $CONFIG['fileFieldName'];
        break;
}
 
/* 生成上传实例对象并完成上传 */
$up = new Uploader($fieldName, $config, $base64);
$info = $up->getFileInfo();
//$info["url"] = str_replace("../","",$info[ "url" ]);
/**
 * 向浏览器返回数据json数据
 * {
 *   'url'      :'a.jpg',   //保存后的文件路径
 *   'title'    :'hello',   //文件描述，对图片来说在前端会添加到title属性上
 *   'original' :'b.jpg',   //原始文件名
 *   'state'    :'SUCCESS'  //上传状态，成功时返回SUCCESS,其他任何值将原样返回至图片上传框中
 * }
 */
SaveUploadInfo($info);
 
 
 
/**
 * 得到上传文件所对应的各个参数,数组结构
 * array(
 *     "state" => "",          //上传状态，上传成功时必须返回"SUCCESS"
 *     "url" => "",            //返回的地址
 *     "title" => "",          //新文件名
 *     "original" => "",       //原始文件名
 *     "type" => ""            //文件类型
 *     "size" => "",           //文件大小
 * )
 */
 
/* 返回数据 */
return json_encode($up->getFileInfo());
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
  
}