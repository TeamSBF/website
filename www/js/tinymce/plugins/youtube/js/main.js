$(document).ready(function(){
    var submitButton = $("#submit");
	var previews = $("#youtubeImagePreview");
    var leftArrow = $("#leftArrow");
    var rightArrow = $("#rightArrow");
    
	$("#previews").hide();
    submitButton.prop("disabled", true);
    $("#link").keyup(function()
	{
		// hijacked from
		// http://stackoverflow.com/questions/3452546/javascript-regex-how-to-get-youtube-video-id-from-url
		var regExp = /^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#\&\?]*).*/;
		var match = $(this).val().match(regExp);
        // remove all the current image previews
		previews.children('img[id="previewImage"]').remove();
        submitButton.prop("disabled", true);
		if (match && match[7].length==11)
		{
            $("#videoID").val(match[7]);
            submitButton.prop("disabled", false);
            var images = [];
            for(i = 0; i < 4; i++)
            {
                var img = $('<img src="http://img.youtube.com/vi/' + match[7] + '/'+i+'.jpg" width="300" height="225" id="previewImage" />');
                images.push(img);
				img.insertAfter(leftArrow);
                img.hide();
            }
            images[0].show();
            
            if(!$("#previews").is(":visible"))
            {
                $("#previews").show("fast");
            }
		}
	});
	var previewIndex = 0;
    leftArrow.on("click",function(){showNext(-1);});
    rightArrow.on("click", function(){showNext(1);});
    
    function showNext(next)
    {
        var previous = previews.children('#previewImage'+previewIndex);
        previewIndex += next;
        
        if(previewIndex < 0)
            previewIndex = 3;
        else if(previewIndex > 3)
            previewIndex = 0;
        
        var next = previews.children('#previewImage'+previewIndex);
        $("#imagePreview").val(previewIndex);
        
        previous.hide("fast");
        next.show("fast");
    }
    
    $("#submit-btn").on("click", submit);
    function submit()
    {
        var link = $("#videoID").val(), image = $("#imagePreview").val();
        if(link)
        {
            var content = '<img src="http://img.youtube.com/vi/' + link + '/' + image + '.jpg" id="youtubevideo" width="300" height="225" />';
            parent.tinymce.activeEditor.insertContent(content);
        }
        parent.tinymce.activeEditor.windowManager.close();
    }
});