$(function() {
	$('body').on('click', '.filter-checked-item__clear[data-for]', function() {
		$('#' + $(this).data('for')).trigger('click');
		$(this).closest('.filter-checked-item').remove();
	});
});