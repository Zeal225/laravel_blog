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
    });
    $('input[type="radio"]').on('click', function () {
        var hidden = $('#route-trie');
        var thisValue = $(this).val();
        var url = hidden.val();
        var token = hidden.attr('data-token');
        $('.list-article').html("<div style='text-align: center; width: 100%'><img src='/images/load.gif'/></div>");
        $.ajax({
            method: 'POST',
            url: url,
            beforeSend: function () {
            },
            data: {
                tagName: thisValue,
                _token: token
            }
        }).done(function (data) {
           $('.list-article').html(data.html);
        })
    })
});