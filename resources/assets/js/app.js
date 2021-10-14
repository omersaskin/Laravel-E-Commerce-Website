
/**
 * First, we will load all of this project's Javascript utilities and other
 * dependencies. Then, we will be ready to develop a robust and powerful
 * application frontend using useful Laravel and JavaScript libraries.
 */

require('./bootstrap');

setTimeout(function() {
	$('.alert').slideUp(500);
}, 5000);

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$('.urun-adet-artir, .urun-adet-azalt').on('click', function() {
	var id= $(this).attr('data-id');
	var adet= $(this).attr('data-adet');
	$.ajax({
		type:'PATCH',
		url:'/sepet/guncelle/' + id,
		data:{adet:adet},
		success: function() {
			window.location.href="/sepet";
		}
	});
});