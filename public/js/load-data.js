jQuery(document).ready(function($) {

    let load_category = Cookies.get('load_category');
    let load_data = 6;
    if(load_category) {
        load_data = 20;
    }
    $(".item-load-data").slice(0, load_data).show();
    if ($(".item-load-data").length < 7 || load_category) {
        $("#load-more-sub").fadeOut('fast');
    }
    $("#load-more-sub").on('click', function (e) {
        e.preventDefault();
        Cookies.set('load_category', true, { expires: 1 })
        $(".item-load-data:hidden").slice(0, 6).fadeIn('fast');
        if ($(".item-load-data:hidden").length == 0) {
            $("#load-more-sub").fadeOut('slow');
        }
    });




    $(document).on('click','.pagination .load-data-content',function (e) {
        e.preventDefault();
        let containerLoad = $(this);
        let urlParams = new URLSearchParams(window.location.search);
        let current_page = parseInt(urlParams.get("page"));
        if(!current_page) current_page = 1;
        current_page++;

        let serializeInit = $('.form-filter-countainer').serialize();
        let serializeArray = $('.form-filter-countainer').serializeArray();
        let category = $('#filter-panel .filter-panel-item .active').parent();
        let urlAction = '';
        let blogCategoryId = '';
        if(category.length == 0)
        {
            var url = window.location.href;
            var parts = url.split("/");
            urlAction = parts[parts.length-1];
            urlType = 'knowledge';
            blogCategoryId = $(".blogCategories form a.active").attr('data-categoryId');
        }
        else
        {
            urlAction = category.attr('data-url');    
        }
        let serialize = "";
        let data = {};
        if(category.length > 0) {
            let name = 'category';
            if(urlAction === 'articles') {
                name = 'category_articles'
            }
            data.name = name;
            data.value = category.data('category-id').toString()
            serializeArray.push(data);

            if (serializeInit.trim() != '')
                serialize = "&"+serializeInit+"&"+name+"="+category.data('category-id').toString();
        }
        $.ajax({
            url: urlAction,
            type: 'POST',
            dataType:'json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {currentPage: current_page,result:serializeArray,type:'filter',categoryId: blogCategoryId},
            success: function(data) {
                let page = data.page;
                let pagination_parent = $('.pagination-list');
                if(!data.is_sort) {
                    if(data.url) {
                        window.history.pushState({},'',data.url);
                    } else {
                        window.history.pushState({},'',urlAction );
                    }
                }
                let item_pagination = pagination_parent.find('.pagination-item a[data-page="'+page+'"]');
                item_pagination.addClass('current-page');
                containerLoad.attr('data-current-page',page);
                if(data.element.count === 0) {
                    $('.render-list').html(containerLoad.attr('data-empty-query'));
                } else {
                    $('.firstItem').text(data.element.first_item);
                    $('.count').text(data.element.count);
                    $('.total').text(data.element.total);
                    $('.render-list').append(data.view);
                }
                let count = 18;
                if(urlAction === 'articles') {
                    count = 5;
                }
                if(urlType === 'knowledge') {
                    count = 6;
                }
                if(data.element.count <= count || data.element.count === 0) containerLoad.hide();
            },
            error: function(result) {
                // console.log(result);
            }
        });
    })


    $(document).on('click','.pagination .pagination-link',function (e) {
        e.preventDefault();
        let containerLoad = $(this).parent().parent().parent();
        let urlParams = new URLSearchParams(window.location.search);
        let current_page = $(this).data('page');
        let serializeInit = $('.form-filter-countainer').serialize();
        let serializeArray = $('.form-filter-countainer').serializeArray();
        let category = $('#filter-panel .filter-panel-item .active').parent();
        let urlAction = '';
        let blogCategoryId = '';
        if(category.length == 0)
        {
            var url = window.location.href;
            var parts = url.split("/");
            urlAction = parts[parts.length-1];
            urlType = 'knowledge';
            blogCategoryId = $(".blogCategories form a.active").attr('data-categoryId');
        }
        else
        {
            urlAction = category.attr('data-url');    
        }
        let serialize = "";
        let data = {};
        if(category.length > 0) {
            let name = 'category';
            if(urlAction === 'articles') {
                name = 'category_articles'
            }
            data.name = name;
            data.value = category.data('category-id').toString()
            serializeArray.push(data);

            if (serializeInit.trim() != '')
                serialize = "&"+serializeInit+"&"+name+"="+category.data('category-id').toString();
        }
        $.ajax({
            url: urlAction,
            type: 'POST',
            dataType:'json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {currentPage: current_page,result:serializeArray,type:'filter',categoryId: blogCategoryId},
            success: function(data) {
                let page = data.page;
                let pagination_parent = $('.pagination-list');
                if(!data.is_sort) {
                    if(data.url) {
                        window.history.pushState({},'',data.url);
                    } else {
                        window.history.pushState({},'',urlAction );
                    }
                }
                // let item_pagination = pagination_parent.find('.pagination-item a[data-page="'+page+'"]');
                // item_pagination.addClass('current-page');
                // containerLoad.attr('data-current-page',page);

                pagination_parent.find('.pagination-item a').removeClass('current-page')
                pagination_parent.find('.pagination-item a[data-page="'+page+'"]').addClass('current-page');
                if(data.element.count === 0) {
                    $('.render-list').html(containerLoad.attr('data-empty-query'));
                } else {
                    // window.location.reload();
                    $('.firstItem').text(data.element.first_item);
                    $('.count').text(data.element.count);
                    $('.total').text(data.element.total);
                    $('.render-list').html(data.view);
                }
                let count = 18;
                if(urlAction === 'articles') {
                    count = 5;
                }
                if(urlType === 'knowledge') {
                    count = 6;
                }
                if(data.element.count < count) containerLoad.hide();
            },
            error: function(result) {
                // console.log(result);
            }
        });
    });
});


