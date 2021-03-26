// Theme color settings
$(document).ready(function () {
	function store(name, val) {
		if (typeof (Storage) !== "undefined") {
			localStorage.setItem(name, val);
		} else {
			window.alert('Please use a modern browser to properly view this template!');
		}
	}
	$("*[data-theme]").click(function (e) {
		e.preventDefault();
		var currentStyle = $(this).attr('data-theme');
		store('theme', currentStyle);
		switch (currentStyle) {
			case 'blue-dark':
				$('.to-top').css('cssText', 'border: 2px solid #009efb !important')
					.hover(function () {
						$(this).css('background-color', '#009efb')
					}, function () {
						$(this).css('background-color', 'transparent');
					})
				$('.to-top i').css('cssText', 'color: #009efb !important')
					.hover(function () {
						$(this).css({'color':'#fff'}, {'display': 'block'})
					},function () {
						$(this).css({'color':'#009efb'}, {'display': 'none'})
					})
				$('.btn-service-panel').removeClass('btn-primary btn-secondary btn-success btn-info btn-warning btn-danger btn-light btn-dark')
					.addClass('btn-info')
				break;

			default:
				break;
		}
		$('#theme').attr({
			href: baseUrl('assets/css/colors/' + currentStyle + '.css')
		})
	});

	var currentTheme = localStorage.getItem('theme');
	/*if(currentTheme)
	{
	  $('#theme').attr({href: 'css/colors/'+currentTheme+'.css'});
	}*/
	// color selector
	$('#themecolors').on('click', 'a', function () {
		$('#themecolors li a').removeClass('working');
		$(this).addClass('working')
	});

});
/*function get(name) {
 
}*/
/*
$(document).ready(function(){
  $("*[data-theme]").click(function(e){
    e.preventDefault();
      var currentStyle = $(this).attr('data-theme');
      store('theme', currentStyle);
      $('#theme').attr({href: 'css/colors/'+currentStyle+'.css'})
  });

  var currentTheme = get('theme');
  if(currentTheme)
  {
    $('#theme').attr({href: 'css/colors/'+currentTheme+'.css'});
  }
  // color selector
$('#themecolors').on('click', 'a', function(){
      $('#themecolors li a').removeClass('working');
      $(this).addClass('working')
    });
});*/
