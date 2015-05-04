<?php
require_once"header.php";

if(isset($_POST['id']))
{
printr(htmlspecialchars($_POST['editor']));

preg_match_all('/<img[^>]+>/i', $_POST['editor'], $results);
$imgs = array();
$found = array();
foreach($results as $result)
{
    foreach($result as $img_tag)
    {
        $found[] = $img_tag;
        preg_match_all('/(alt|title|src|width|height|id)=("[^"]*")/i',
        $img_tag,
        $imgs[htmlspecialchars($img_tag)]);
    }
}

$contentImgs = array();
foreach($imgs as $img)
{
    $contentImgs[] = array();
    $j = count($contentImgs) - 1;
    for($i = 0; $i < count($img[1]); $i++)
    {
        $contentImgs[$j][$img[1][$i]] = str_replace("\"", "", $img[2][$i]);
    }
}

$parsedImgs = array();
foreach($contentImgs as $img)
{
    if($img['id'] === "youtubevideo")
    {
        $src = 'http://www.youtube.com/embed/' . linkifyYouTubeURLs($img['src']);
        $parsedImgs[] = '<iframe width="'.$img['width'].'" height="'.$img['height'].'" src="'.$src.'" frameborder="0" allowfullscreen="allowfullscren"></iframe>';
    }
}
$_POST['editor'] = str_replace($found, $parsedImgs, $_POST['editor']);
$_POST['editor'] = htmlspecialchars($_POST['editor']);
preg_match('!\d+!', $_POST['id'], $results);
$_POST['id'] = $results[0];
echo $_POST['title']."<br>";
echo $_POST['editor'];
printr($_POST);
$update = QueryFactory::Build("update")->Table("articles")->Where(["id","=",$_POST['id']]);
$update->Set(["title", $_POST['title']],['content', $_POST['editor']], ['updated', "UNIX_TIMESTAMP()"]);
DatabaseManager::Query($update);
}

// Linkify youtube URLs which are not already links.
function linkifyYouTubeURLs($text) {
    $text = preg_match('~
        # Match non-linked youtube URL in the wild. (Rev:20130823)
        https?://         # Required scheme. Either http or https.
        (?:[0-9A-Z-]+\.)? # Optional subdomain.
        (?:               # Group host alternatives.
          youtu\.be/      # Either youtu.be,
        | youtube         # or youtube.com or
          (?:-nocookie)?  # youtube-nocookie.com
          \.com           # followed by
          \S*             # Allow anything up to VIDEO_ID,
          [^\w\s-]       # but char before ID is non-ID char.
        )                 # End host alternatives.
        ([\w-]{11})      # $1: VIDEO_ID is exactly 11 chars.
        (?=[^\w-]|$)     # Assert next char is non-ID or EOS.
        (?!               # Assert URL is not pre-linked.
          [?=&+%\w.-]*    # Allow URL (query) remainder.
          (?:             # Group pre-linked alternatives.
            [\'"][^<>]*>  # Either inside a start tag,
          | </a>          # or inside <a> element text contents.
          )               # End recognized pre-linked alts.
        )                 # End negative lookahead assertion.
        [?=&+%\w.-]*        # Consume any URL (query) remainder.
        ~ix', 
        $text,
        $result);
    return $result[1];
}
$select = QueryFactory::Build("select")->Select("id","title","content","created","viewby")->From("articles");
$info = DatabaseManager::Query($select);
$articles = $info->Result();
// Result returns the result directly if there is only one result
// This compensates for that by wrapping the single result in an array, like multiple articles would be
// This allows for a simpler code base
if($info->RowCount() < 2) $articles = [$articles];
?>
<script>
    $(document).ready(function(){
        var editors = 0;
        var articles = $("#articlesList");
        articles.on('click', '#edit', function (e) {
            p = $(e.target).parent().parent();
            var edit = $('<div id="editor">' +
                        '<form method="POST">' +
                        '   <input type="hidden" name="id" value="'+p.attr("id")+'" />'+
                        '   <input type="text" name="title" id="title" value="" style="width:100%" />' +
                        '   <textarea name="editor" id="articleEditor'+editors+'"></textarea>' +
                        '</form></div>');
            

            edit.insertAfter(p);
            var title = edit.find("#title");
            var editor = edit.find("textarea");
            title.val(p.find("#title").text());
            // TODO: convert all iframe tags in #content into images using the
            // specified preview image.
            editor.text(p.find("#content").html());
            editor.height(p.height() - p.find("#title").height());
            tinymce.EditorManager.execCommand("mceAddEditor", false, editor.attr('id'));
            p.hide();
            editors++;
        });
    });
</script>
    <div class="background">
        <div class="articleWrapper" id="articlesList">
        <?php for($i = 0; $i < count($articles); $i++) {?>
            <div class="article" id="article<?=$articles[$i]['id'];?>">
                <div class="title" id="title"><h1><?=$articles[$i]["title"];?></h1></div>
                <?php if($user && $user->AccessLevel > 1){?><div class="edit"><img src="img/gear.png" id="edit" /></div><?php } ?>
                <div class="content" id="content"><?=htmlspecialchars_decode($articles[$i]["content"]);?></div>
            </div>
        <?php } ?>
        </div>
    </div>
<?php require_once"footer.php";?>