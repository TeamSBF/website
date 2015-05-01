$(document).ready(function(){
	var previews = $("#youtubeImagePreview");
	$("#link").keyup(function()
	{
		// hijacked from
		// http://stackoverflow.com/questions/3452546/javascript-regex-how-to-get-youtube-video-id-from-url
		var regExp = /^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#\&\?]*).*/;
		var match = $(this).val().match(regExp);
		previews.html("");
		if (match&&match[7].length==11)
		{
			for(i = 0; i < 4; i++)
				previews.append('<img src="http://img.youtube.com/vi/' + match[7] + '/'+i+'.jpg" width="100" height="100" class="previewImage" />');
		}
	});
	
	previews.on("mouseenter","img",function(){ $(this).addClass("Hover");});
	previews.on("mouseleave","img",function(){ $(this).removeClass("Hover");});
});