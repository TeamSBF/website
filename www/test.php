<pre>
<?php
require_once "config.php";

//QueryTests::All();
/*
Mailer::Send("blah@a.a","sub","message");
$user = QueryFactory::Build("select");
$user->Select("id","email","created","activated")->From("users")->Where(["id","=",$_GET['id']])->Limit();
$res = DatabaseManager::Query($user);

$res = $res->Result();
if($res["activated"])
	die("already activated");

$blah = sha1($res["id"].$res["email"].$res["created"]);
echo $blah ."\n";
echo $_GET['link']."\n";
if($blah === $_GET['link'])
	echo "activate the account";
else
	echo "activation failed";
//*/

/*
$select = QueryFactory::Build("select")->Select("title","content","created","viewby")->From("articles");
$info = DatabaseManager::Query($select);
$articles = $info->Result();
// Result returns the result directly if there is only one result
// This compensates for that by wrapping the single result in an array, like multiple articles would be
// This allows for a simpler code base
if($info->RowCount() < 2)
    $articles = [$articles];

echo PartialParser::Parse("article", $articles[0]);
//*/
/*
$insert = QueryFactory::Build("insert")->Into("parq_form")->Set(["userID", "2"]);
$insert->Set(["q11","No"],["q12","No"],["q13","No"],["q14","No"],["q15","No"],["q16","No"],["q17","No"]);
$insert->Set(["q31","2015-04-20"],["q32","sami"],["q33",""]);
printr($insert->Query(true));
echo "INSERT INTO `parq_form` (`userID`, `q11`, `q12`, `q13`, `q14`, `q15`, `q16`, `q17`, `q31`, `q32`, `q33`) VALUES(2, 'No', 'No', 'No', 'No', 'No', 'No', 'No', '2015-04-20', 'sami', '')";
$res = DatabaseManager::Query($insert);
echo $res->RowCount();
//*/

// tinymce developement
//echo"POST\n" . htmlspecialchars($_POST['content'], ENT_QUOTES);
//echo"\n";
?>
<script src="js/jquery-1.11.2.min.js"></script>
<script src="js/tinymce/tinymce.min.js"></script>
<script>
var youtubeLinkRegex = /^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#\&\?]*).*/;
tinymce.init({
            selector: "textarea",
            plugins: [
                "save advlist autolink lists link image charmap preview anchor",
                "searchreplace visualblocks code fullscreen",
                "insertdatetime media table contextmenu paste youtube"
            ],
            contextmenu: "link image inserttable | cell row column deletetable | youtube",
            toolbar: "save | insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image| youtube"
        });
	$(document).ready(function(){
		
		var content = $("#content");
		var editor = $("#editor");
		var contents = youtubeIframeToImg(content.html());
		
		editor.html(contents);
		content.hide();
	});
    
    function youtubeIframeToImg(contents)
    {
        var iframes = $(contents).find("iframe[src*='youtu']");
        for(i = 0; i < iframes.length; i++)
		{
			var iframe = $(iframes[i]);
			var replace = iframe.wrap('<p/>').parent().html();
			var src = 'http://img.youtube.com/vi/' + getVideoID(iframe.attr("src")) + '/hqdefault.jpg';
			var img = '<img width="'+iframe.attr("width")+'" height="'+iframe.attr("height")+'" src="'+src+'" />';
			contents = contents.replace(replace, img);
		}
        
        return contents;
    }
    
    function getVideoID(url)
    {
        return url.match(youtubeLinkRegex)[7];
    }
</script>
<div id="content">
	<p>Welcome to the Feel the Difference project website. We are reachingout to adults 55+ and/or those managing chronic conditions with an invitationto participate in an important research study to determine the effectivenessof the Sit and Be Fit exercise program</p>
    <p><iframe src="http://www.youtube.com/embed/cm7uURk9mZg" width="449" height="337" frameborder="0" allowfullscreen="allowfullscreen"></iframe></p>
</div>
<form method="POST">
<textarea id="editor" rows="20"></textarea>
</form>
</pre>