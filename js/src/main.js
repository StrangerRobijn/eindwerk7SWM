
$('#myModal').modal() 

$('.btnShoppingCart').popover({
    container: 'body',
    html: true,
    content: function () {
        var clone = $( $(this).data('contentid') ).clone(true).removeClass('d-none');
        return clone;
    }
})