function getByid(id) {
 if (document.getElementById) {
  return document.getElementById(id);
 } else if (document.all) {
  return document.all[id];
 } else if (document.layers) {
  return document.layers[id];
 } else {
  return null;
 }
}
function creatID(DivID){
var objs=getByid(DivID).getElementsByTagName('textarea');
var inps=getByid(DivID).getElementsByTagName('input');
var buts=getByid(DivID).getElementsByTagName('button');
var labs=getByid(DivID).getElementsByTagName('label');
 for (i=0; i<objs.length; i++) {
  objs[i].id="runcode"+i;
  inps[i].id=i
  buts[i].id=i
  labs[i].id=i
 }
}
function runCode(obj){ 
   var code=getByid("runcode"+obj).value;
   var newwin=window.open('','',''); 
   newwin.opener = null 
   newwin.document.write(code); 
   newwin.document.close();
}
function doCopy(obj) { 
 if (document.all){
   textRange = getByid("runcode"+obj).createTextRange(); 
   textRange.execCommand("Copy"); 
   alert("代码已经复制到剪切板");
 }else{
   alert("此功能只能在IE上有效\n\n请在文本域中用Ctrl+A选择再复制")
 }
}
function saveCode(obj) {
        var winname = window.open('','','width=0,height=0,top=1px,left=1px');
        winname.document.open('text/html', 'replace');
        winname.document.write(obj.value);
        winname.document.execCommand('saveas','','code.html');
        winname.close();
}