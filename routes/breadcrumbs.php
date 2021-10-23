<?php
use App\Models\MenuItem;
$menu = new MenuItem();
// Home
Breadcrumbs::for('home', function ($trail) {
    $trail->push('Home', route('home'));
});

// Home > News
Breadcrumbs::for('articles', function ($trail) use($menu) {
    $trail->parent('home');
    $type = $menu::TYPE_NEWS;
    $trail->push($menu->getDataNameByTypePage($type)
        ? $menu->getDataNameByTypePage($type)
        : 'News',route('articles'));
});

// Home > Article > [Category]
Breadcrumbs::for('article', function ($trail,$post) use($menu) {
    $trail->parent('home');
    $type = $menu::TYPE_NEWS;
    $trail->push($menu->getDataNameByTypePage($type)
        ? $menu->getDataNameByTypePage($type)
        : 'News',route('articles'));
    $trail->push($post->title, $post->slug);
});

// Home > use-cases
Breadcrumbs::for('use-cases', function ($trail) use($menu) {
    $trail->parent('home');
    $type = $menu::TYPE_USE;
    $trail->push($menu->getDataNameByTypePage($type)
        ? $menu->getDataNameByTypePage($type)
        : 'Use Cases',route('use-cases'));
});

// Home > Article > [Category]
Breadcrumbs::for('use-case', function ($trail,$use_case) use($menu) {
    $trail->parent('home');
    $type = $menu::TYPE_USE;
    $trail->push($menu->getDataNameByTypePage($type)
        ? $menu->getDataNameByTypePage($type)
        : 'Use Cases',route('use-cases'));
    $trail->push($use_case->title, $use_case->slug);
});

// Home > use-cases
Breadcrumbs::for('portfolios', function ($trail) use($menu) {
    $trail->parent('home');
    $type = $menu::TYPE_PORT;
    $trail->push($menu->getDataNameByTypePage($type)
        ? $menu->getDataNameByTypePage($type)
        : 'Projects Portfolio',route('portfolios'));
});

Breadcrumbs::for('portfolio', function ($trail,$portfolio) use($menu) {
    $trail->parent('home');
    $type = $menu::TYPE_PORT;
    $trail->push($menu->getDataNameByTypePage($type)
        ? $menu->getDataNameByTypePage($type)
        : 'Projects Portfolio',route('portfolios'));
    $trail->push($portfolio->title, $portfolio->slug);
});

// Home > use-cases
Breadcrumbs::for('catalog', function ($trail) use($menu) {
    $trail->parent('home');
    $type = $menu::TYPE_CATALOG;
    $trail->push($menu->getDataNameByTypePage($type)
        ? $menu->getDataNameByTypePage($type)
        : 'Catalog',route('catalog'));
});

Breadcrumbs::for('catalog_single', function ($trail,$product) use($menu) {
    $trail->parent('home');
    $type = $menu::TYPE_CATALOG;
    $trail->push($menu->getDataNameByTypePage($type)
        ? $menu->getDataNameByTypePage($type)
        : 'Catalog',route('catalog'));
    $trail->push($product->title, $product->slug);
});


// Home > use-cases
Breadcrumbs::for('key-areas', function ($trail) use($menu) {
    $trail->parent('home');
    $type = $menu::TYPE_KEY;
    $trail->push($menu->getDataNameByTypePage($type)
        ? $menu->getDataNameByTypePage($type)
        : 'Key Areas',route('key-areas'));
});

Breadcrumbs::for('key-area', function ($trail,$key_area) use($menu) {
    $trail->parent('home');
    $type = $menu::TYPE_KEY;
    $trail->push($menu->getDataNameByTypePage($type)
        ? $menu->getDataNameByTypePage($type)
        : 'Key Areas',route('key-areas'));
    $trail->push($key_area->title, $key_area->slug);
});



Breadcrumbs::for('about-us', function ($trail) use($menu) {
    $trail->parent('home');
    $type = $menu::TYPE_ABOUT;
    $trail->push($menu->getDataNameByTypePage($type)
        ? $menu->getDataNameByTypePage($type)
        : 'About Us',route('about-us'));

});

Breadcrumbs::for('distributors', function ($trail) use($menu) {
    $trail->parent('home');
    $type = $menu::TYPE_DIST;
    $trail->push($menu->getDataNameByTypePage($type)
        ? $menu->getDataNameByTypePage($type)
        : 'Distributors',route('distributors'));
});

Breadcrumbs::for('whitepapers', function ($trail) use($menu) {
    $trail->parent('home');
    $type = $menu::TYPE_DIST;
    $trail->push($menu->getDataNameByTypePage($type)
        ? $menu->getDataNameByTypePage($type)
        : 'Whitepapers',route('whitepapers'));
});

Breadcrumbs::for('whitepaper_single', function ($trail,$category,$pdf) use($menu) {
    $trail->parent('home');
    $type = $menu::TYPE_WHITEPAPER;
    $trail->push($menu->getDataNameByTypePage($type)
        ? $menu->getDataNameByTypePage($type)
        : 'knowledge', url('knowledge/whitepapers'));
    $trail->push($menu->getDataNameByTypePage($type)
        ? $menu->getDataNameByTypePage($type)
        : 'Whitepapers',route('whitepapers'));
    $trail->push(str_replace(' ', '-', strtolower($pdf->title)));
});
/* #SID - 44-new-website-page-knowledge */
Breadcrumbs::for('knowledge', function ($trail,$category) use($menu) {
    $trail->parent('home');
    $type = $menu::TYPE_DIST;
    $trail->push($menu->getDataNameByTypePage($type)
        ? $menu->getDataNameByTypePage($type)
        : 'knowledge',url('#'));
    $trail->push(str_replace(' ', ' ', strtolower($category)));
});

Breadcrumbs::for('knowledge_single', function ($trail,$category,$blog) use($menu) {
    //dd($category, $blog);
    $trail->parent('home');
    $type = $menu::TYPE_DIST;
    $trail->push($menu->getDataNameByTypePage($type)
        ? $menu->getDataNameByTypePage($type)
        : 'knowledge', url('knowledge/'.str_replace(' ', '-', strtolower($category))));
    $trail->push($menu->getDataNameByTypePage($type)
        ? $menu->getDataNameByTypePage($type)
        : ucfirst(strtolower($category)), url('knowledge/'.str_replace(' ', '-', strtolower($category))));
    $trail->push(str_replace(' ', ' ', strtolower($blog->title)));
});

/* #SID - #z3c3nz - Career page On Tektelic */
Breadcrumbs::for('career', function ($trail) use($menu) {
    $trail->parent('home');
    $type = $menu::TYPE_DIST;
    $trail->push($menu->getDataNameByTypePage($type)
        ? $menu->getDataNameByTypePage($type)
        : 'career',route('career'));
});

/*// Home > Blog
Breadcrumbs::for('blog', function ($trail) {
    $trail->parent('home');
    $trail->push('Blog', route('blog'));
});

// Home > Blog > [Category] > [Post]
Breadcrumbs::for('post', function ($trail, $post) {
    $trail->parent('category', $post->category);
//    $trail->push($post->title, route('post', $post->id));
});*/
