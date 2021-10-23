/* for search */
var loadmore = $('.load-more').data("page");
$(document).on('click', '.search-panel-button',function(e){
    e.preventDefault();

    var searchcat =  $('.filter-panel-button.active').data('searchcat');
    var page = $(".current-page").data("page");

    searching(searchcat,page);
});
$(document).on('click', '.filter-panel-button',function(e){
    e.preventDefault();

    var searchcat =  $(this).data('searchcat');
    $( ".filter-panel-button" ).removeClass( "active" );
    searching(searchcat);
    $(this).addClass( "active" );
});


$(document).on('click', '.pagination-link',function(e){
    e.preventDefault();

    var searchcat =  $('.filter-panel-button.active').data('searchcat');
    var page = $(this).data("page");
    loadmore=page;

    searching(searchcat,page);

    var total_pages =  $('.total_pages').val();

    if((loadmore)<total_pages) {
        loadmore+=1;
        $('.load-more').attr({'data-page': loadmore});
        console.log('on');
    }
    else{
        $('.load-more').hide();
        console.log('en');
    }
    console.log(searchcat);

    $(this).addClass( "active" );
});


$(document).on('click', '.load-more',function(e){
    e.preventDefault();

    var searchcat =  $('.filter-panel-button.active').data('searchcat');
    var page = $(".current-page").data("page");
    // console.log(page);
    //console.log(searchcat);
    loadmore=page + 1;
    searching(searchcat,loadmore,'loadmore');

    var total_pages =  $('.total_pages').val();
    var load_more_count =  $('.load_more_count').val();

    if(loadmore>=2){
        console.log(loadmore);
        var html=
            "<a class='prev-page-link' href='JavaScript:Void(0);'>\n" +
            "                            <svg width='6' height='11' viewBox='0 0 6 11' fill='none' xmlns='http://www.w3.org/2000/svg'>\n" +
            "                                <path d='M5 0.499998L1 5.25L5 10' stroke='#2CABE1' stroke-linecap='round'/>\n" +
            "                            </svg>\n" +
            "                        </a>"
        ;
        $('.prev-page').html(html);
    }

    if(loadmore>=total_pages){
        var html="  <svg width=\"6\" height=\"11\" viewBox=\"0 0 6 11\" fill=\"none\" xmlns=\"http://www.w3.org/2000/svg\">\n" +
            "                            <path d=\"M1 0.499998L5 5.25L1 10\" stroke=\"#C4C4C4\" stroke-linecap=\"round\"/>\n" +
            "                        </svg>"
        ;
        $('.next-page').html(html);
    }

    // console.log(loadmore);
    if((loadmore)<total_pages) {

        $('.load-more').attr({'data-page': loadmore});
    }
    else{
        $('.load-more').hide();
    }
    // $(this).addClass( "active" );
});

$(document).on('click', '.next-page-link',function(e){
    e.preventDefault();

    var searchcat =  $('.filter-panel-button.active').data('searchcat');
    var page = $(".current-page").data("page");
    // console.log(page);
    //console.log(searchcat);
    var total_pages =  $('.total_pages').val();


    if(page<=total_pages) {
        searching(searchcat, page + 1);

        // console.log(loadmore);
        if ((loadmore) < total_pages) {
            // loadmore += 1;
            $('.load-more').attr({'data-page': loadmore});
        } else {
            $('.load-more').hide();
        }
    }
});

$(document).on('click', '.prev-page-link',function(e){
    e.preventDefault();

    var searchcat =  $('.filter-panel-button.active').data('searchcat');
    var page = $(".current-page").data("page");
    // console.log(page);
    //console.log(searchcat);
    var total_pages =  $('.total_pages').val();

    if(page>1) {
        searching(searchcat, page - 1);

        // console.log(loadmore);
        /* if ((loadmore) < total_pages) {
            // loadmore += 1;
             $('.load-more').attr({'data-page': loadmore});
         } else {
             $('.load-more').hide();
         }*/
    }
});

function searching(searchcat='',page=1,type='page'){
    var search_text =  $('.search-panel-input').val();

    // var searchcat =  $('.filter-panel-button').data('searchcat');
    //console.log(search_text);
    // console.log(searchcat);
    $.ajax({
        url: '/search-result',
        data: {search_text:search_text,searchcat:searchcat,page:page,type:type},
        type: 'POST',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        success: function (res) {
            if (!res) console.log('Error!');

            if(type!='loadmore') {
                $('.search-results').html(res);
            }
            else{
                $('.append_items').append(res);
            }
            //  var  search_text =  $('.search_text').val();
            var count =  $('.count').val()?$('.count').val():0;
            $('.result_count').text(count);
            $('.result_search').text(search_text);
            $(".pagination-link").removeClass("current-page");
            $("#"+page).addClass("current-page");
          
            console.log('saerch ajax');
            Blazy();
        },
        error: function () {
            alert('Error!');
        }
    });
    
}
