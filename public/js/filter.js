if($( window ).width() >= 768) {
    $('#catalog-mobile-filters').remove();
};
if($( window ).width() <= 768) {
    $('#aside-accordion').remove();
};
var formSerialize = $('.form-filter-countainer').serializeArray();
const filter = {
    request: function (data) {
        let action = data.url;
        setTimeout(function () {
            $.ajax({
                url: data.url,
                type: data.method,
                dataType:'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {result:data.result,type:data.type},
                success: function(data) {
                    setTimeout(function () {
                        if(!data.is_sort) {
                            if(data.url) {
                                window.history.pushState({},'',data.url);
                            } else {
                                window.history.pushState({},'',action );
                            }
                        }

                        let containerLoad = $('.load-data-content');
                        let paginationLoad = $('.pagination-list');
                        if(data.element.count < 3 || data.element.count === 0)  {
                            containerLoad.hide()
                            paginationLoad.hide()
                        } else {
                            containerLoad.show()
                            paginationLoad.show()
                        }
                        filter.dropActivePaginatinClass();
                        if(data.element.count === 0) {
                            $('.render-list').html('<div class=\'catalog-showcase-empty\'>No results were found for your search.</div>');
                        } else {
                            $('.firstItem').text(data.element.first_item);
                            $('.count').text(data.element.count);
                            $('.total').text(data.element.total);
                            $('.render-list').html(data.view);
                        }
                    },0);
                },
            });
        },0);
    },
    callAction: function(classes,url,type) {
        $(classes).children('input').click(function (e) {
            let data = {};
            let serialize = $('.form-filter-countainer').serializeArray();
            let category = $('#filter-panel .filter-panel-item .active');
            let url = category.attr('data-url');
            if(category.length > 0) {
                data.name = 'category';
                if(url == 'articles') {
                    data.name = 'category_articles'
                }
                data.value = category.parent().data('category-id').toString()
                serialize.push(data);
            }
            filter.dropActivePaginatinClass();
            filter.request({url:url, result:serialize, method:"post", type:type});
        });
    },
    dropActivePaginatinClass: function() {
        let pagination_parent = $('.pagination-list');
        pagination_parent.find('.pagination-item a').removeClass('current-page')
        pagination_parent.find('.pagination-item a[data-page="1"]').addClass('current-page');
    }
};
$('.filter-panel-catalog').children('.filter-panel-item').find('a').click(function (e) {
    e.preventDefault();
    let item = $(this);
    let url = item.attr('data-url');
    $('.filter-panel-catalog').find('.filter-panel-button').removeClass('active');
    item.find('.filter-panel-button').addClass('active');
    let prepareData = {};
    prepareData.name = 'category';
    if(url == 'articles') {
        prepareData.name = 'category_articles';
    }
    prepareData.value = item.data('category-id').toString();
    let data = $('.form-filter-countainer').serializeArray();
    data.push(prepareData);

    filter.dropActivePaginatinClass();
    filter.request({url:'/'.url, result:data, method:"post", type:'filter'});
});
filter.callAction('#categories .checkbox-item', 'catalog', 'filter');
filter.callAction('#types .checkbox-item', 'catalog', 'filter');
filter.callAction('#characteristic .checkbox-item', 'catalog', 'filter');


$('.knowledge-base-aside-inner .aside-widget .checkbox-item').children('input').click(function (e) {
    let data = {};
    let serialize = $('.form-filter-countainer').serializeArray();
    let category = $('#filter-panel .filter-panel-item .active');
    if(category.length > 0) {
        data.name = 'category_articles'
        data.value = category.parent().data('category-id').toString()
        serialize.push(data);
    }

    filter.dropActivePaginatinClass();
    filter.request({url:'/articles', result:serialize, method:"post", type:'filter'});
});

$('#price-range .range-button').click(function (e) {
    e.preventDefault();
    let data = {};
    let serialize = $('.form-filter-countainer').serializeArray();
    filter.request({url:'/catalog', result:serialize, method:"post", type:'range'});
});

$('.form-sort').find('select').change(function (e) {
    filter.request({url:'/catalog', result:$(this).val(), method:"post", type:'sort'});
});

$(document).on('click','.render-list .article-box-tags .filter_by_tags',function (e) {
    let dataTag = {};
    let data = {};
    let serialize = $('.form-filter-countainer').serializeArray();
    let category = $('#filter-panel .filter-panel-item .active');
    let url = category.attr('data-url');

    dataTag.name = 'tag';
    dataTag.value = $(this).data('tag-name').toString();

    if(category.length > 0) {
        data.name = 'category';
        if(url == 'articles') {
            data.name = 'category_articles'
        }
        data.value = category.parent().data('category-id').toString()
        serialize.push(data);
    }
    serialize.push(dataTag);
    filter.dropActivePaginatinClass();
    filter.request({url:'/articles', result:serialize, method:"post", type:'filter'});
});





