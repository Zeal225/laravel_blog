/**
 * Created by Ablo on 01/04/2018.
 */
jQuery(function () {
    var btn = jQuery('.repondre');
    btn.on('click', function () {
        var btnClick = $(this);
        var thisCibleId = btnClick.attr('id');
        $('.'+thisCibleId).slideToggle();
    })
});