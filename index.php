<!DOCTYPE html>
<html lang="zh-tw">
  <head>
    <meta charset="big5">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="ygtw">
    <link rel="shortcut icon" href="favicon.ico">
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
    <meta content="Blog2BBS - 部落格文章轉到BBS的小幫手" name="Description" />
    <meta content="Blog, BBS, 轉貼, 文章, 轉換" lang="zh-TW" name="keywords" />
    <meta content="index" name="robots" />
    <title>Blog2BBS</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/jumbotron.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="../../docs-assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

<style type="text/css">

textarea{ 


  height:250px; 
  min-height:250px;  
  max-height:250px;
}

</style>



<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-47489018-1', 'blog2bbs.herokuapp.com');
  ga('send', 'pageview');

</script>

<script type="text/javascript" src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
  <script type="text/javascript" src="http://www.parsecdn.com/js/parse-1.2.17.min.js"></script>

    <script >


      function load() {
        gapi.client.setApiKey('AIzaSyB8lHJokkBISJDt4qpuaYze_MOb6FTZdb0');
        gapi.client.load('urlshortener', 'v1', makeRequest);
        $("#btn_run").removeAttr("disabled");
      }
    </script>


  <script type="text/javascript">
Parse.initialize("KfbJ4kk6hEiVlZoV8pphDMgcGHx30XgxIsgVaD6a", "l4shW7yXeg3LHAqMutJChockG4YfuU1x2hJNfd1E");    
function savedata (htmldata,bbsdata) {
  // body...
    var TestObject = Parse.Object.extend("TestObject");
    var testObject = new TestObject();
      testObject.save({html: htmldata,bbs:bbsdata}, {
      success: function(object) {
        console.log("ok")
//        $(".success").show();
      },
      error: function(model, error) {
        console.log(error)
  //      $(".error").show();
      }
    });

}
  </script>


<script type="text/javascript">

      function makeRequest() {

      var request = gapi.client.urlshortener.url.insert({
          'resource': {'longUrl': 'https://codepen.io/'}
      });


      }

var login = "o_5gjs7hemdi";
var api_key = "R_2cf780fee5348c6bc9b3df4d788fb40f";
var long_url = "http://www.kozlenko.info";

$( document ).ready(function() {
  // Handler for .ready() called.



});

var I;
var html = "";
  var short_arr=[];
    var long_arr = [];
    var mapurl = [];

function init (argument) {
  // body...
html = "";
short_arr=[];
long_arr = [];
mapurl = [];

}
function replaceAll(txt, replace, with_this) {
return txt.replace(new RegExp(replace, 'g'),with_this);
}

function strip(html)
{
   var tmp = document.createElement("DIV");
   tmp.innerHTML = html;
   return tmp.textContent || tmp.innerText || "";
}
function runstrip () {

  init();
  // body...
  html = $("#htmls").val()
  rawhtml = $("#htmls").val()
  html = EncodedUTF8ToBig5(html)
  if(html.length==0) return;

  $('#myModal').modal()

  html=html.replace(/<a.*href="(.*?)".*>(.*?)<\/a>/gi, "$2 ( Link-> $1 )");
//  html=html.replace(/<(?:.|\n)*?>/gm, '');
    html=strip(html)
//  html = $( html.text() ).remove();
console.log( "QQ"  );
console.log( html  );

 
  
   var s = html,
    re = /Link->(.*?)[\s][)]/gi,
    item;

  while (item = re.exec(s))
      long_arr.push(item[1]);

 console.log(long_arr)

  html=replaceAll(html,"Link->", "");

  I = long_arr.length - 1

  for (var i = long_arr.length - 1  ; i >= 0; i--) {

    var long_url = long_arr[i];
    

    google_short_url(long_url, function(short_url) {
     // console.log(short_url)
    //  short_arr.push(short_url)
      I--;
      if(I==-1) replace_url();

    });
  };


  savedata(rawhtml, html)



// get_short_url(long_url, login, api_key, function(short_url) {


//  console.log( jQuery(html).text()   );
}

function replace_url () {
  // body...

  for (var i = long_arr.length - 1  ; i >= 0; i--) {
    html=html.replace(long_arr[i], mapurl[ long_arr[i] ]);
  }
//  console.log(EncodedUTF8ToBig5(html))

//setSaveFile(html,"tt.txt")

$.ajax({
  type: "POST",
  url: "encode.php",
  data: { "html": html }
})
  .done(function( msg ) {
   // console.log( "Data Saved: " + msg );
	
	var adtext = "\n\n// 本文使用 Blog2BBS 自動將Blog文章轉成縮址的BBS純文字 http://goo.gl/TZ4E17 //";
	msg = msg.substr(23) + adtext 
     $("#output").val( msg );
  });


 // $("#output").val( html );



  
  
  $('#myModal').modal('hide');

$('#myModal').on('hidden.bs.modal', function (e) {
  // do something...
    $("#output").select();
//    document.getElementById("myForm").submit();

})
}



function setSaveFile(contents, file_name, mime_type) {
  var a = document.getElementById('save');
  mime_type = mime_type || 'text/html'; // text/html, image/png, et c
  if (file_name) a.setAttribute('download', file_name);
  a.href = 'data:'+ mime_type +';base64,'+ btoa(contents || '');
}

function google_short_url (long_url,func) {
  // body...
        var request = gapi.client.urlshortener.url.insert({
          'resource': {'longUrl': long_url}
      });
        request.execute(function(response) {
          mapurl[long_url] = response.id ;
          func(response.id);
        });
}
function get_short_url(long_url, login, api_key, func)
{
    $.getJSON(
        "http://api.bitly.com/v3/shorten?callback=?", 
        { 
            "format": "json",
            "apiKey": api_key,
            "login": login,
            "longUrl": long_url
        },
        function(response)
        {
          mapurl[long_url] = response.data.url;
          console.log(response)
            func(response.data.url);
        }
    );
}
</script>


<script src="https://apis.google.com/js/client.js?onload=load"></script>



  </head>

  <body>



<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-body"><br>
        <br>
        <br>
        <br>
        
		處理中...
        <br>
        <br>
        <br>
        
        <br>
           <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    
      </div>

    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">

            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <div id="fb-root"></div>

          </button>
          <a class="navbar-brand" href="#">Blog2BBS - 部落格到BBS的小幫手</a> 
<a href="https://github.com/ygtw/Blog2BBS"><img style="position: absolute; top: 0; right: 0; border: 0;" src="https://s3.amazonaws.com/github/ribbons/forkme_right_white_ffffff.png" alt="Fork me on GitHub"></a>


        </div>
        <div class="navbar-collapse collapse">

        </div><!--/.navbar-collapse -->
      </div>
    </div>






    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron" style="">
      <div class="container">
   
        <img src="logo.png" />
<iframe width="400px" src="//www.facebook.com/plugins/like.php?href=http%3A%2F%2Fblog2bbs.herokuapp.com%2F&amp;width&amp;layout=standard&amp;colorscheme=dark&amp;action=recommend&amp;show_faces=true&amp;share=true&amp;height=20&amp;appId=256693654490509" scrolling="no" frameborder="0" style="border:none; overflow:hidden; height:20px;" allowTransparency="true"></iframe>
                <br>

      把圖文並茂的Blog文章轉到PTT這類的BBS是很多部落客在做的事情，可是受限於BBS只支援文字，因此很多部落客只有複製文字轉到BBS，如果能附上圖片與連結的網址，就能讓BBS純文章更加完整。<br><br>
          現在 ~ 使用Blog2BBS，只要將Blog文章的HTML貼到對話框，就可轉成純文字，<br>會特地為您保留文章中的<span style="color:yellow" >超連結，並自動轉成goo.gl縮網址</span>，您就可以把圖文並茂的文章PO到BBS囉！
<br>


      </div>
    </div>

    <div class="container">
      <!-- Example row of columns -->
      <div class="row">
        <div class="col-md-5">
          <h2><span class="glyphicon glyphicon-file"></span> 請貼上部落格文章的HTML</h2>


<textarea id="htmls"  class="form-control" onmouseover="this.select()" >
<h1> 這是範例 </h1>
<div>
  <a href="http://beefsouptn.blogspot.tw"> 我愛吃牛肉湯~  </a>
  <a href="http://tour.tainan.gov.tw/"> 帶我去台南!!!  </a>
  <br>
  <a href="https://github.com/ygtw/Blog2BBS/"> @Github  </a>
</div>


</textarea> 

     </div>


      <div class="col-md-2  container text-center center-block"  style="font-size:xx-large;">

<br>
<br>
<br>
<button type="button" id="btn_run" disabled="disabled" onclick="runstrip()" data-loading-text="Loading..." class="btn btn-lg btn-success">
  轉換 
<span  class="glyphicon glyphicon-arrow-right" ></span>
</button>


  </div>


        <div class="col-md-5">
          <h2><span class="glyphicon glyphicon-ok-sign"></span> 請拿去貼到BBS</h2>

<form id="myForm" method="POST" action="encode.php">

          <textarea id="output" name="html" class="form-control" onmouseover="this.select()" >
          </textarea>
</form>

             </div>

      </div>

	  <br>
喜歡請在到最下面捐款啊>\\<

      <hr>




  <!--


http://stackoverflow.com/questions/4760538/using-only-javascript-to-shrink-urls-using-the-bit-ly-api

http://stackoverflow.com/questions/10864783/javascript-regexp-non-capturing-groups/10864877#10864877
  -->
      <footer >
        <p>&copy; 2014 zjuajun@gmail.com</p>
		<div>
		<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
<input type="hidden" name="cmd" value="_s-xclick">
<table>
<tr><td><input type="hidden" name="on0" value="贊助Blog2BBS">贊助Blog2BBS</td></tr><tr><td><select name="os0">
	<option value="小贊助">小贊助 NT$100 TWD</option>
	<option value="大心贊助">大心贊助 NT$500 TWD</option>
	<option value="土豪贊助">土豪贊助 NT$1,000 TWD</option>
</select> </td></tr>
</table>
<input type="hidden" name="currency_code" value="TWD">
<input type="hidden" name="encrypted" value="-----BEGIN PKCS7-----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-----END PKCS7-----
">
<input type="image" src="https://www.paypalobjects.com/zh_TW/TW/i/btn/btn_buynowCC_LG_wCUP.gif" border="0" name="submit" alt="PayPal － 更安全、更簡單的線上付款方式！">
<img alt="" border="0" src="https://www.paypalobjects.com/zh_TW/i/scr/pixel.gif" width="1" height="1">
</form>
</div>
      </footer>
	  
	  
	  
    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->

    <script src="js/bootstrap.min.js"></script>
    <script src="js/utf8tobig5.js"></script>
  </body>
</html>
