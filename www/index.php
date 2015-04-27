<?php
require_once"header.php";

$select = QueryFactory::Build("select")->Select("title","content","created","viewby")->From("articles");
$info = DatabaseManager::Query($select);
$articles = $info->Result();
// Result returns the result directly if there is only one result
// This compensates for that by wrapping the single result in an array, like multiple articles would be
// This allows for a simpler code base
if($info->RowCount() < 2) $articles = [$articles];
?>
<script>
    $(document).ready(function(){
        var articles = $("#articlesList");
        articles.on('click', '#edit', function (e) {
            var edit = $('<div id="editor">' +
                        '<input type="text" name="title" id="title" value="" style="width:100%" />' +
                        '<textarea name="richTextField" id="richTextField"></textarea></div>');
            p = $(e.target).parent().parent();

            edit.insertAfter(p);
            var title = edit.children("#title");
            var editor = edit.children("#richTextField");
            title.val(p.children("#title").text());
            editor.text(p.children("#content").html());
            editor.height(p.height() - p.children("#title").height());
            tinymce.EditorManager.execCommand("mceAddEditor", false, editor.attr('id'));
            p.hide();
        });
    });
</script>
    <div class="background">
        <div class="articleWrapper" id="articlesList">
        <?php for($i = 0; $i < count($articles); $i++) {?>
            <div class="article" id="article<?=$i;?>">
                <div class="title" id="title"><h1><?=$articles[$i]["title"];?></h1></div>
                <?php if($user && $user->AccessLevel > 1){?><div class="edit"><img src="img/gear.png" id="edit" /></div><?php } ?>
                <div class="content" id="content"><?=$articles[$i]["content"];?></div>
            </div>
        <?php } ?>
        </div>
    </div>
<?php require_once"footer.php";?>