<?php
require_once("func.php");
if (((!empty($_GET["q"])) or (!empty($_GET["url"])) or (!empty($_GET["link"])))) {
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json; charset=utf-8;');
$array=array();
if (!empty($_GET["q"])){
$q=$_GET["q"];
$hedef=crul("http://cebim.org/ara?qe=".urlencode($q));
}
if (!empty($_GET["url"])){
$url=$_GET["url"];
$url=base64_decode($url);
var_dump($url);
$hedef=crul("http://cebim.org/".($url));
}
if (!empty($_GET["link"])){
$link=$_GET["link"];
$link=base64_decode($link);
$hedef=crul($link);	
//var_dump($hedef);
$download_audio=ara("<source src=\"","\" type=",$hedef);
//var_dump($download_audio);
$download_title=ara("<h2>","</h2>",$hedef);
$array["link"][]=$download_audio[0];
$array["title"][]=$download_title[0];
}else{
$liste=ara("<div class=\"link\">","</div>",$hedef);
//var_dump($liste);
foreach($liste as $key=>$parca){
$resimler=ara("<img src='","'",$parca);
if($resimler[0]==null){
	$resimler[0]='https://lh3.googleusercontent.com/lop1k9886mNW_sDou4S4z-Wnd3oSrcHAAMGahvsraOMlzKqpmTJ9f1_cwR3cA7qK2c0=w300';
}
$array[$key]['resim'][]=$resimler[0];
$isimler=ara("<b>","</b>",$parca);
$array[$key]['isim'][]=$isimler[0];
$linkler=ara("<a href=\"","\"",$parca);
$array[$key]['link'][]=base64_encode($linkler[0]);
}
$next_page_link=ara("<span class=\"o\">","</a>",$hedef);
$next_page_link=ara("<a href=\"","\"",$next_page_link[0]);
if($next_page_link[0]=="/"){
	$next_page_link[0]=NULL;
}
$next_page_link=base64_encode($next_page_link[0]);
$array['next_link'][]=$next_page_link;
//var_dump($array);
}
echo json_encode($array, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
}else{
?>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<style>
code .str,pre .str{color:#65B042}code .kwd,pre .kwd{color:#E28964}code .com,pre .com{color:#AEAEAE;font-style:italic}code .typ,pre .typ{color:#89bdff}code .lit,pre .lit{color:#3387CC}code .pln,code .pun,pre .pln,pre .pun{color:#fff}code .tag,pre .tag{color:#89bdff}code .atn,pre .atn{color:#bdb76b}code .atv,pre .atv{color:#65B042}code .dec,pre .dec{color:#3387CC}code.prettyprint,pre.prettyprint{background-color:#000;border-radius:8px}pre.prettyprint{width:95%;margin:1em auto;padding:1em;white-space:pre-wrap}ol.linenums{margin-top:0;margin-bottom:0;color:#AEAEAE}li.L0,li.L1,li.L2,li.L3,li.L5,li.L6,li.L7,li.L8{list-style-type:none}@media print{code .str,pre .str{color:#060}code .kwd,pre .kwd{color:#006;font-weight:700}code .com,pre .com{color:#600;font-style:italic}code .typ,pre .typ{color:#404;font-weight:700}code .lit,pre .lit{color:#044}code .pun,pre .pun{color:#440}code .pln,pre .pln{color:#000}code .tag,pre .tag{color:#006;font-weight:700}code .atn,pre .atn{color:#404}code .atv,pre .atv{color:#060}}
</style>
<div class="mb_content">
								<div class="row">
					<div class="col-lg-9">			
				<div class="developers">
																<h4 class="text-center" style="margin-top:30px">Muzik Ara API</h4>
						<br>
						<h4>Avaiable Methods</h4>
							<div class="panel-title panel-heading">
							<ul style="margin-bottom:0">
								<li>"<b>GET / ?q=</b>" : for search with string</li>
								<li>"<b>GET / ?link=</b>" : for search next page</li>
								<li>"<b>GET / ?url=</b>" : for download selected</li>
							</ul>
						</div>
						<div id="q">
						<hr>
						<h4 class="panel-title panel-heading">Get list with query string:</h4>
						<pre class="prettyprint lang-html prettyprinted" style=""><span class="pln">http://yourserver/?q=</span><b><span class="nocode" style="color:#65b042">{search_term}</span></b></pre>
						<h4 class="panel-title panel-heading"><a href="#q"><code><b>?q=</b></code></a> return like this:</h4>
						<pre><code class="JSON">{
    "0": {
        "resim": [
		"{image}"
        ],
        "isim": [
		"{title}"
        ],
        "link": [
		"{base64_decode(link)}"	//<a href="#url">for ?url= </a>
        ]
    },
    "next_link": [
	"{next_link}"	//<a href="#link">for ?link= </a>
    ]
}</code></pre></div>
<div id="link">
						<hr>
												<h4 class="panel-title panel-heading">Get list with next page link:</h4>
						<pre class="prettyprint lang-html prettyprinted" style=""><span class="pln">http://yourserver/?link=</span><b><span class="nocode" style="color:#65b042">{next_link}</span></b></pre>
						<h4 class="panel-title panel-heading"><a href="#link"><code><b>?link=</b></code></a> return like <a href="#q"><code><b>?q=</b></code></a></h4>
						</div>
<div id="url">
						<hr>
						<h4 class="panel-title panel-heading">Get selected mp3 link:</h4>
						<pre class="prettyprint lang-html prettyprinted" style=""><span class="pln">http://yourserver/?url=</span><b><span class="nocode" style="color:#65b042">{link}</span></b></pre>
						<h4 class="panel-title panel-heading"><a href="#url"><code><b>?url=</b></code></a> return like this:</h4>
						<pre><code class="JSON"></code>{
    "link": [
        "mp3link"
    ],
    "title": [
        "title"
    ]
}</pre>
</div>


				</div><!-- /.developers -->

					</div><!-- /.col-lg-9 -->
				</div><!-- /.row -->
			</div>
			<link rel="stylesheet"
      href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/styles/default.min.css">
<script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/highlight.min.js"></script>
<script>hljs.initHighlightingOnLoad();</script>
			<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<?php
}
?>