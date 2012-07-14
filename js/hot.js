jQuery(document).ready(function(){

	var $container = $('#container');

	$container.imagesLoaded( function(){
	  $container.masonry({
	    itemSelector : '.box'
	  });
	});
	
	getData();

	$('.fancy').fancybox();

	$('.box').live('mouseenter', function(){
		$(this).append('<div class="hover">'+$(this).attr('rel')+'</div>');
	}).live('mouseleave', function(){
		$(this).find('div.hover').remove();
	})
})

var loading = false;
var ended 	= false;

$(window).scroll(function()
{
    if($(window).scrollTop() == $(document).height() - $(window).height())
    {
    	if(loading) return;
    	//
    	loading = true;
        $("#loader").show();
        getData();
    }
});

function getData () {
	$.get("page.php", { start_at: $('.box').length || 0 }, function(data){

		if(data == "empty" && ended == false) {
			alert($_TEXT_END);
			ended = true;
			return;
		}

    	$("#container").append(data);
    	$("#container").masonry('reload');
    	//
    	$("#loader").hide();
    	loading = false;
    }, "html");
}