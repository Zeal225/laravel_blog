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
        console.log(url);
        $.ajax({
            method: 'POST',
            url: url,
            data: {
                tagName: thisValue,
                _token: token
            },
            dataType: 'html'
        }).done(function (data) {
            $('.teste-ajax').append(data.html);
            console.log(data)
            // console.log(data['articles']);data["articles"][i]["titre"]
            // $('.list-article').html('');
            // for (var i=0; i<data['articles'].length; i++){
            //     const teste = `
            //     <div class="col-md-4">
            //         <div style="padding: 0.6rem; background: whitesmoke; margin-bottom: 1rem;">
            //             <h1>${data['articles'][i]['titre']}</h1>
            //             <div>
            //                 ${data['articles'][i]['contenu']}
            //                 <div><a class="btn btn-info small" href="articles/${data['articles'][i]['id']}">Lire la suite</a></div>
            //                 <div>
            //                     Tags:
            //                 </div>
            //             </div>
            //         </div>
            //     </div>
            //     `;
            //     $('.list-article').append(teste)
            // }
        })
    })
});