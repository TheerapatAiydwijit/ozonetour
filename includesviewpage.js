$(function() {
    var includes = $('[data-include]')
    $.each(includes, function() {
        var file =$(this).data('include') + '.php'
        var redy =unescape(file)
        $(this).load(redy)
    })
})