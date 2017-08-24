
KindEditor编辑器插件
======================
KindEditor 是一套开源的在线HTML编辑器，主要用于让用户在网站上获得所见即所得编辑效果，开发人员可以用 KindEditor 把传统的多行文本输入框(textarea)替换为可视化的富文本输入框。 KindEditor 使用 JavaScript 编写，可以无缝地与 Java、.NET、PHP、ASP 等程序集成，比较适合在 CMS、商城、论坛、博客、Wiki、电子邮件等互联网应用上使用。 


程序兼容版本：
DedeCMS V5.6、V5.7（SP1）


使用方法：
1.解压压缩包，文件夹下有gb2312、utf-8两个版本的文件；
2.将对应版本文件覆盖到系统目录中；
3.系统后台中设置[系统]-[核心设置]，在“Html编辑器（ckeditor,需要fck的用户可以去官网下载）”中设置：kindeditor


2012-10-28已更新为最新版本  kindeditor-4.1.3；
并整合代码运行功能
上次打包忘记语言文件，本次已补上，本站测试目前除图片批量上传浏览器会卡死（本地测试没有问题，不知道是网速问题还是别的什么！）之外，没有发现其他问题，

代码运行使用方法：
前台模板调用：
<link href="/include/kindeditor/plugins/runCode/runCode.css" rel="stylesheet" media="screen" type="text/css" />
<script language="javascript" type="text/javascript" src="/include/kindeditor/plugins/runCode/zztuku_runCode.js"></script>

即可


2012-12-27更新：
代码运行兼容大部分浏览器目前本站测试通过（Firefox、Opera、Safari、搜狗高速浏览器、傲游、IE），复制和保存代码目前只支持IE。
修改编辑器支持GBK编码程序


