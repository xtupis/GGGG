<?php
function ValidateEmail($email)
{
   $pattern = '/^([0-9a-z]([-.\w]*[0-9a-z])*@(([0-9a-z])+([-\w]*[0-9a-z])*\.)+[a-z]{2,6})$/i';
   return preg_match($pattern, $email);
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['formid']) && $_POST['formid'] == 'form1')
{
   $mailto = 'profolinm@gmail.com';
   $mailfrom = isset($_POST['email']) ? $_POST['email'] : $mailto;
   $subject = 'Заказ';
   $message = 'Заказ';
   $success_url = '';
   $error_url = '';
   $eol = "\n";
   $error = '';
   $internalfields = array ("submit", "reset", "send", "filesize", "formid", "captcha_code", "recaptcha_challenge_field", "recaptcha_response_field", "g-recaptcha-response");
   $boundary = md5(uniqid(time()));
   $header  = 'From: '.$mailfrom.$eol;
   $header .= 'Reply-To: '.$mailfrom.$eol;
   $header .= 'MIME-Version: 1.0'.$eol;
   $header .= 'Content-Type: multipart/mixed; boundary="'.$boundary.'"'.$eol;
   $header .= 'X-Mailer: PHP v'.phpversion().$eol;

   try
   {
      if (!ValidateEmail($mailfrom))
      {
         $error .= "The specified email address (" . $mailfrom . ") is invalid!\n<br>";
         throw new Exception($error);
      }
      $message .= $eol;
      $message .= "IP Address : ";
      $message .= $_SERVER['REMOTE_ADDR'];
      $message .= $eol;
      foreach ($_POST as $key => $value)
      {
         if (!in_array(strtolower($key), $internalfields))
         {
            if (is_array($value))
            {
               $message .= ucwords(str_replace("_", " ", $key)) . " : " . implode(",", $value) . $eol;
            }
            else
            {
               $message .= ucwords(str_replace("_", " ", $key)) . " : " . $value . $eol;
            }
         }
      }
      $body  = 'This is a multi-part message in MIME format.'.$eol.$eol;
      $body .= '--'.$boundary.$eol;
      $body .= 'Content-Type: text/plain; charset=ISO-8859-1'.$eol;
      $body .= 'Content-Transfer-Encoding: 8bit'.$eol;
      $body .= $eol.stripslashes($message).$eol;
      if (!empty($_FILES))
      {
         foreach ($_FILES as $key => $value)
         {
             if ($_FILES[$key]['error'] == 0)
             {
                $body .= '--'.$boundary.$eol;
                $body .= 'Content-Type: '.$_FILES[$key]['type'].'; name='.$_FILES[$key]['name'].$eol;
                $body .= 'Content-Transfer-Encoding: base64'.$eol;
                $body .= 'Content-Disposition: attachment; filename='.$_FILES[$key]['name'].$eol;
                $body .= $eol.chunk_split(base64_encode(file_get_contents($_FILES[$key]['tmp_name']))).$eol;
             }
         }
      }
      $body .= '--'.$boundary.'--'.$eol;
      if ($mailto != '')
      {
         mail($mailto, $subject, $body, $header);
      }
      header('Location: '.$success_url);
   }
   catch (Exception $e)
   {
      $errorcode = file_get_contents($error_url);
      $replace = "##error##";
      $errorcode = str_replace($replace, $e->getMessage(), $errorcode);
      echo $errorcode;
   }
   exit;
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Мемуары</title>
<meta name="generator" content="WYSIWYG Web Builder 16 - http://www.wysiwygwebbuilder.com">
<link href="invasion.png" rel="icon" sizes="128x128" type="image/png">
<link href="font-awesome.min.css" rel="stylesheet">
<link href="MA_site.css" rel="stylesheet">
<link href="test.css" rel="stylesheet">
<script src="jquery-1.12.4.min.js"></script>
<script src="wb.overlay.min.js"></script>
<script>
$(document).ready(function()
{
   $(".SlideMenu1-folder a").click(function()
   {
      var $popup = $(this).parent().find('ul');
      if ($popup.is(':hidden'))
      {
         $("#SlideMenu1 > ul > li > ul").hide();
         $popup.show();
         $popup.attr('aria-expanded', 'true');
      }
      else
      {
         $popup.hide();
         $popup.attr('aria-expanded', 'false');
      }
   });
   $('#OverlayMenu1-overlay').overlay({hideTransition:true});
   $('#OverlayMenu1').on('click', function(e)
   {
      $.overlay.show($('#OverlayMenu1-overlay'));
      return false;
   });
});
</script>
</head>
<body>
<a id="Button1" href="./index.html" style="position:absolute;left:14px;top:262px;width:131px;height:23px;z-index:7;">О нас</a>
<a id="Button3" href="./vstypit.html" style="position:absolute;left:14px;top:364px;width:131px;height:23px;z-index:8;">Вступить в Альянс</a>
<a id="Button4" href="./sostav.html" style="position:absolute;left:14px;top:312px;width:131px;height:23px;z-index:9;">Наш состав</a>
<div id="wb_MediaPlayer2" style="position:absolute;left:1224px;top:262px;width:540px;height:38px;z-index:10;">
<audio id="MediaPlayer2" controls>
<source src="OST_Star_protiv_sil_zla_Blood_Moon_Ball__(hewbi.com).mp3" type="audio/mpeg">
</audio>
</div>
<div id="wb_Text9" style="position:absolute;left:67px;top:1398px;width:155px;height:19px;z-index:11;">
<span style="color:#FFEBCD;font-family:Arial;font-size:17px;">Наши партнеры:</span></div>
<div id="wb_Text11" style="position:absolute;left:67px;top:1475px;width:200px;height:15px;z-index:12;">
<span style="color:#B0E0E6;font-family:Arial;font-size:13px;">Совет Нагакейборос</span></div>
<div id="wb_IconFont1" style="position:absolute;left:243px;top:1417px;width:61px;height:31px;text-align:center;z-index:13;">
<div id="IconFont1"><i class="fa fa-magic"></i></div></div>
<div id="wb_IconFont2" style="position:absolute;left:190px;top:1463px;width:54px;height:27px;text-align:center;z-index:14;">
<div id="IconFont2"><i class="fa fa-anchor"></i></div></div>
<div id="wb_JavaScript2" style="position:absolute;left:67px;top:1430px;width:188px;height:23px;z-index:15;">
<script>

/*
RAINBOW TEXT Script by Matt Hedgecoe (c) 2002
Featured on JavaScript Kit
For this script, visit http://www.javascriptkit.com
*/

var text="Высшая Магическая Комиссия";
var speed=80;

if (document.all||document.getElementById)
{
   document.write('<div style="font-family:Arial;font-size:13px;font-weight:normal;font-style:normal;text-align:left;text-decoration:none;" id="highlight">' + text + '<\/div>');
   var storetext=document.getElementById? document.getElementById("highlight") : document.all.highlight;
}
else
   document.write(text);

var hex=new Array("00","14","28","3C","50","64","78","8C","A0","B4","C8","DC","F0");
var r=1;
var g=1;
var b=1;
var seq=1;
function changetext()
{
   rainbow="#"+hex[r]+hex[g]+hex[b];
   storetext.style.color=rainbow;
}
function change()
{
   if (seq==6)
   {
      b--;
      if (b==0)
        seq=1;
   }
   if (seq==5)
   {
      r++;
      if (r==12)
         seq=6;
   }
   if (seq==4)
   {
      g--;
      if (g==0)
         seq=5;
   }
   if (seq==3)
   {
      b++;
      if (b==12)
         seq=4;
   }
   if (seq==2)
   {
      r--;
      if (r==0)
         seq=3;
   }
   if (seq==1)
   {
      g++;
      if (g==12)
         seq=2;
   }
   changetext();
}

function starteffect()
{
   if (document.all||document.getElementById)
      flash=setInterval("change()",speed);
}
starteffect();
</script>

</div>
<div id="wb_JavaScript3" style="position:absolute;left:29px;top:1621px;width:510px;height:23px;z-index:16;">
<div style="color:#87CEEB;font-size:16px;font-family:Arial;font-weight:normal;font-style:normal;text-align:left;text-decoration:none" id="copyrightnotice"></div>
<script>
   var now = new Date();
   var startYear = "2018";
   var text =  "Copyright &copy; ";
   if (startYear != '')
   {
      text = text + startYear + "-";
   }
   text = text + now.getFullYear() + ", Олин Михаил. Все права зарегестрированы.";
   var copyrightnotice = document.getElementById('copyrightnotice');
   copyrightnotice.innerHTML = text;
</script>


</div>
<div id="wb_Text3" style="position:absolute;left:576px;top:58px;width:207px;height:45px;z-index:17;">
<span style="color:#FAFAD2;font-family:'Comic Sans MS';font-size:32px;"><strong>Тест формы</strong></span></div>
<div id="SlideMenu1" style="position:absolute;left:0px;top:401px;width:194px;height:234px;z-index:18;">
<ul role="menu">
   <li class="SlideMenu1-folder" aria-haspopup="true"><a>Архив№1</a>
      <ul role="menu" aria-expanded="true">
         <li><a role="menuitem" href="">Приказ №303</a></li>
         <li><a role="menuitem" href="">Мирный договор</a></li>
      </ul>
   </li>
   <li class="SlideMenu1-folder" aria-haspopup="true"><a>Архив№2</a>
      <ul role="menu" aria-expanded="true">
         <li><a role="menuitem" href="">Приказ №5063</a></li>
         <li><a role="menuitem" href="">Приказ №89</a></li>
      </ul>
   </li>
   <li class="SlideMenu1-folder" aria-haspopup="true"><a>Личный Архив Императора</a>
      <ul role="menu" aria-expanded="true">
         <li><a role="menuitem" href="./O_cosmose.html">О космосе</a></li>
         <li><a role="menuitem" href="./O_cosmose(TOM-II).html">О космосе(ТОМ II)</a></li>
         <li><a role="menuitem" href="./O_cosmose(TOM-III).html">О космосе(ТОМ III)</a></li>
      </ul>
   </li>
</ul>
</div>
<div id="wb_OverlayMenu1" style="position:absolute;left:0px;top:31px;width:133px;height:100px;z-index:19;">
<a href="#" id="OverlayMenu1">
<span class="line"></span>
<span class="line">
</span><span class="line"></span>
</a>
</div>
<div id="wb_Form1" style="position:absolute;left:507px;top:186px;width:419px;height:295px;z-index:20;">
<form name="Form1" method="post" action="<?php echo basename(__FILE__); ?>" enctype="multipart/form-data" id="Form1">
<input type="hidden" name="formid" value="form1">
<input type="email" id="Editbox3" style="position:absolute;left:104px;top:115px;width:201px;height:16px;z-index:0;" name="Editbox3" value="" spellcheck="false" placeholder="&#1045;&#1084;&#1077;&#1081;&#1083;">
<input type="text" id="Editbox5" style="position:absolute;left:104px;top:42px;width:201px;height:16px;z-index:1;" name="Editbox3" value="" spellcheck="false" placeholder="&#1048;&#1084;&#1103;">
<input type="text" id="Editbox4" style="position:absolute;left:104px;top:179px;width:201px;height:16px;z-index:2;" name="Editbox3" value="" spellcheck="false" placeholder="&#1047;&#1072;&#1082;&#1072;&#1079;">
<div id="wb_Text1" style="position:absolute;left:38px;top:51px;width:30px;height:15px;z-index:3;">
<span style="color:#000000;font-family:Arial;font-size:13px;">Имя</span></div>
<div id="wb_Text2" style="position:absolute;left:32px;top:121px;width:46px;height:15px;z-index:4;">
<span style="color:#000000;font-family:Arial;font-size:13px;">Емейл</span></div>
<div id="wb_Text4" style="position:absolute;left:34px;top:185px;width:39px;height:15px;z-index:5;">
<span style="color:#000000;font-family:Arial;font-size:13px;">Заказ</span></div>
<input type="submit" id="Button2" name="" value="Отправить" style="position:absolute;left:130px;top:238px;width:96px;height:25px;z-index:6;">
</form>
</div>
<div id="OverlayMenu1-overlay">
<div class="OverlayMenu1">
<ul class="drilldown-menu" role="menu">
<li><a role="menuitem" href="./index.html" class="OverlayMenu1-effect"><i class="fa fa-superpowers overlay-icon"></i>&#1054;&nbsp;&#1085;&#1072;&#1089;</a></li>
<li><a role="menuitem" href="./sostav.html" class="OverlayMenu1-effect"><i class="fa fa-empire overlay-icon"></i>&#1053;&#1072;&#1096;&nbsp;&#1089;&#1086;&#1089;&#1090;&#1072;&#1074;</a></li>
<li><a role="menuitem" href="./vstypit.html" class="OverlayMenu1-effect"><i class="fa fa-first-order overlay-icon"></i>&#1042;&#1089;&#1090;&#1091;&#1087;&#1080;&#1090;&#1100;&nbsp;&#1074;&nbsp;&#1040;&#1083;&#1100;&#1103;&#1085;&#1089;</a></li>
<li><a role="menuitem" href="./For_develop.html" class="OverlayMenu1-effect"><i class="fa fa-connectdevelop overlay-icon"></i>&#1044;&#1083;&#1103;&nbsp;&#1088;&#1072;&#1079;&#1088;&#1072;&#1073;&#1086;&#1090;&#1095;&#1080;&#1082;&#1086;&#1074;</a></li>
   </ul>
</div>
<a class="close-button" id="OverlayMenu1-close" href="#" role="button" aria-hidden="true"><span></span></a>
</div>
<div style="z-index:21">
<marquee id="breakingnews" style="padding:4px 0px 4px 0px;position:absolute;left:0px;top:0;background-color:#4169E1" onMouseover="this.scrollAmount=1" onMouseout="this.scrollAmount=20">
<span style="color:#FF6347;font-size:20px;font-family:Courier New Greek;font-weight:normal;font-style:normal;text-decoration:none">Шок! Господин облысел! ᅠᅠᅠᅠᅠᅠᅠᅠ Корпорация "Green Mesasoid" обогатилась на 15 млрд. кредитов. ᅠᅠᅠᅠᅠᅠᅠ Николай I поел дерьма!!!</span>
</marquee>
<script>
function initBreakingNews()
{
   var docWidth = 800;

   if (typeof window.innerWidth != 'undefined')
   {
      docWidth = window.innerWidth;
   }
   else 
   if (typeof document.documentElement != 'undefined' && typeof document.documentElement.clientWidth != 'undefined' && document.documentElement.clientWidth != 0)
   {
      docWidth = document.documentElement.clientWidth;
   }
   else
   {
      docWidth = document.getElementsByTagName('body')[0].clientWidth;
   }
   document.getElementById("breakingnews").style.width = docWidth.toString() + "px";
   document.getElementById("breakingnews").scrollAmount = 20;
   document.getElementById("breakingnews").scrollDelay = 20;
   document.getElementById("breakingnews").loop = -1;
}
if (document.getElementById)
{
   window.onload = initBreakingNews;
   window.onresize = initBreakingNews;
}
</script>
</div>
</body>
</html>