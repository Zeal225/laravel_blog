/**
 * Created by Ablo on 01/04/2018.
 */
jQuery(function () {
    var btn = jQuery('.repondre');
    btn.on('click', function () {
        var btnClick = $(this);
        var thisCibleId = btnClick.attr('id');
        $('.'+thisCibleId).slideToggle();
    });
    $('.js-like').on('click', function () {
        var $this = $(this);
        var postId = $this.attr('data-postId');
        var likeNumber = $this.find('.count').text();
        var route = $this.attr('data-route');
        var token = $this.attr('data-token');
        $.ajax({
            method: 'POST',
            url: route,
            data: {
                postId: postId,
                likeNumber: likeNumber,
                _token: token
            }
        }).done(function (data) {
            $this.find('.count').text(data['like']);
        })
    })
});