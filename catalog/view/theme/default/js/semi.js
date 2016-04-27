$(function(){
    
    $('#column_left, #column-left').css({
        'padding-top': $('.container-megamenu.container.vertical .megamenu-wrapper').height()-($('#main .breadcrumb').length?$('#main .breadcrumb').height():0)
    });
    $('.breadcrumb').css({
        'padding-left': $('.container-megamenu.container.vertical .megamenu-wrapper').width()
    });
    $('.footer-block').css({
        'height': $('#semi-footer').height()
    });

})