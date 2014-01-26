<!DOCTYPE html>
<html lang="zh-tw">
  <head>
    <meta charset="big5">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../../docs-assets/ico/favicon.png">

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

<script type="text/javascript" src="http://code.jquery.com/jquery-1.11.0.min.js"></script>

    <script >


      function load() {
        gapi.client.setApiKey('AIzaSyB8lHJokkBISJDt4qpuaYze_MOb6FTZdb0');
        gapi.client.load('urlshortener', 'v1', makeRequest);
//        $("#")
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
function runstrip () {

  init();
  // body...
  html = $("#htmls").val()
 html = EncodedUTF8ToBig5(html)
  if(html.length==0) return;

  $('#myModal').modal()

  html=html.replace(/<a.*href="(.*?)".*>(.*?)<\/a>/gi, "$2 ( Link-> $1 )");
  html=jQuery(html).text()
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
    console.log( "Data Saved: " + msg );
     $("#output").val( msg.substr(23) );
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
          <a class="navbar-brand" href="#">Blog2BBS - 部落格文章轉到BBS的小幫手</a> 

        </div>
        <div class="navbar-collapse collapse">

        </div><!--/.navbar-collapse -->
      </div>
    </div>






    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron" style="">
      <div class="container">
   
        <img src="logo.png" /> <iframe src="//www.facebook.com/plugins/like.php?href=http%3A%2F%2Fblog2bbs.herokuapp.com%2F&amp;width&amp;layout=button&amp;action=recommend&amp;show_faces=true&amp;share=true&amp;height=80&amp;appId=256693654490509" scrolling="no" frameborder="0" style="border:none; overflow:hidden; height:20px;" allowTransparency="true"></iframe>
        <br>

      把圖文並茂的Blog文章轉到PTT這類的BBS是很多部落客在做的事情，可是受限於BBS只支援文字，因此很多部落客只有複製文字轉到BBS，如果能附上圖片與連結的網址，就能讓BBS純文章更加完整。<br>
          現在 ~ 使用Blog2BBS，只要將Blog文章的HTML貼到對話框，就可轉成純文字，<br>會特地為您保留文章中的<span style="color:yellow" >超連結，並自動轉成goo.gl縮網址</span>，您就可以把圖文並茂的文章PO到BBS囉!
<br>
      </div>
    </div>

    <div class="container">
      <!-- Example row of columns -->
      <div class="row">
        <div class="col-md-5">
          <h2><span class="glyphicon glyphicon-file"></span> 請貼上部落格文章的HTML</h2>


<textarea id="htmls"  class="form-control" onmouseover="this.select()" >
<h1>這是範例</h1>
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
<button type="button" onclick="runstrip()" data-loading-text="Loading..." class="btn btn-lg btn-primary">
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

      <hr>




  <!--


http://stackoverflow.com/questions/4760538/using-only-javascript-to-shrink-urls-using-the-bit-ly-api

http://stackoverflow.com/questions/10864783/javascript-regexp-non-capturing-groups/10864877#10864877
  -->
      <footer>
        <p>&copy; 2014 zjuajun@gmail.com</p>
      </footer>
    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->

    <script src="js/bootstrap.min.js"></script>
    <script src="js/utf8tobig5.js"></script>
  </body>
</html>
