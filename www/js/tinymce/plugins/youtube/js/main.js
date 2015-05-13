$(document).ready(function(){
    var selectedItem = top.tinymce.activeEditor.windowManager.getParams().selectedItem,
        previews = $("#youtubeImagePreview"),
        submitButton = $("#submit-btn"),
        previewWidth = 300,
        previewHeight = 225,
        pImage = $("<img />");
	$("#previews").hide();
    
    $("#link").keyup(function()
	{
		// hijacked from
		// http://stackoverflow.com/questions/3452546/javascript-regex-how-to-get-youtube-video-id-from-url
		var regExp = /^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#\&\?]*).*/;
		var match = $(this).val().match(regExp);
        submitButton.prop("disabled", true);
        //alert(match[7]);
		if (match && match[7].length==11)
		{
            $("#videoID").val(match[7]);
            submitButton.prop("disabled", false);
            
            pImage.attr("src","http://img.youtube.com/vi/" + match[7] + "/hqdefault.jpg");
            pImage.attr("width",previewWidth);
            pImage.attr("height",previewHeight);
            pImage.attr("id","previewImage");
            previews.html(pImage);
            
            if(!$("#previews").is(":visible"))
            {
                $("#previews").show("fast");
            }
		}
	});
    submitButton.on("click", function (){
        var link = $("#videoID").val(),
            image = $("#imagePreview").val();
        if(link)
        {
            var content = '<img src="http://img.youtube.com/vi/' + link + '/hqdefault.jpg" id="youtubevideo" width="'+previewWidth+'" height="'+previewHeight+'" />';
            parent.tinymce.activeEditor.insertContent(content);
        }
        parent.tinymce.activeEditor.windowManager.close();
    });
    
    if(selectedItem.nodeName === "IMG")
    {
        selectedItem = $(selectedItem);
        if(selectedItem.attr("src").indexOf("youtu") >= 0)
        {
            previewWidth = selectedItem.attr("width");
            previewHeight = selectedItem.attr("height");
            $("#link").val("http://www.youtube.com/embed/" + selectedItem.attr("src").split("/")[4]);
            $("#link").keyup();
            submitButton.text("Update Video");
        }
    }
});