<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


/** Route for home page */
Route::get('/','SiteController@index')->name('home');

/** Route for portfolio */
Route::get('projects-portfolio','PortfolioController@index')->name('portfolios');
Route::get('projects-portfolio/category/{category_slug}','PortfolioController@index')->name('portfolios_cat');
Route::get('projects-portfolio/{slug}','PortfolioController@show')->name('portfolio');

/** Route for use cases */
Route::get('use-cases','UseCasesController@index')->name('use-cases');
Route::get('use-cases/{slug}','UseCasesController@show');
Route::get('use-cases/category/{category_slug}','UseCasesController@index');

/** Route for key-area */
Route::get('key-areas','KeyAreasController@index')->name('key-areas');
Route::get('key-areas/{slug}','KeyAreasController@show')->name('key-area');

/** Route for articles */
// Route::match(['POST','GET'],'/articles','ArticlesController@index')->name('articles');
// Route::get('/articles/{slug}','ArticlesController@show');
// Route::match(['POST','GET'],'/articles/category/{category_slug}','ArticlesController@index')
//     ->name('category_articles');

Route::match(['POST','GET'],'catalog','CatalogController@index')->name('catalog');
Route::get('catalog/{slug}','CatalogController@show');
Route::match(['POST','GET'],'catalog/category/{category_slug}','CatalogController@index');

/** Route for distributors */
Route::get('distributors','DistributorsController@index')->name('distributors');
Route::post('distributor-country','DistributorsController@distributorCountry');

/** Route for about us */
Route::get('about-us','AboutUsController@index')->name('about-us');


/** Route for search */
Route::match(['POST','GET'],'search','SearchController@index');
//Route::post('search-dif','SearchController@index');
//Route::post('search-dif','SearchController@index');
Route::post('search-result','SearchController@searchResult');

/** Route for email */
Route::post('send-email','EmailController@sendEmail');
Route::post('about-us-email','EmailController@aboutUsEmail');
Route::post('add-request','EmailController@addRequest');
Route::post('contact-us','EmailController@contactUs');

Route::get('parse','ParserSocialController@index')->name('parse');
Route::get('linkedin','ParserSocialController@linkedin')->name('linkedin');
Route::get('linkedin-redirect','ParserSocialController@linkedinRedirect')->name('linkedin-redirect');
Route::get('twitter','ParserSocialController@twitter')->name('twitter');

/** Route for wish list and compare */
Route::post('add-wishlist','WishlistController@addWishlist');
Route::post('add-comparison','ComparisonController@addComparison');

Route::get('wishlist','WishlistController@index');
Route::post('delete-wishlist','WishlistController@deleteWishlist');
Route::get('compare','ComparisonController@index');
Route::post('delete-comparison','ComparisonController@deleteComparison');
Route::post('compare-type','ComparisonController@compareType');
Route::post('compare-aside','ComparisonController@compareAside');

/** PDF/Blog Routes */
// Route::get('whitepapers','PdfController@index')->name('whitepapers');
Route::get('knowledge/whitepaper/{slug}','PdfController@show');
//Route::match(['POST','GET'],'knowledge','BlogController@index')->name('knowledge');/*#SID - 44-new-website-page-knowledge */
Route::any('knowledge/{category}','BlogController@index')->name('knowledge');/*#SID - 44-new-website-page-knowledge */
Route::get('knowledge/{category}/{slug}','BlogController@single');/*#SID - 44-new-website-page-knowledge */
Route::get('knowledge/category/{category}','BlogController@index');/*#SID - 44-new-website-page-knowledge */
Route::post('download-now','PdfController@downloadNow');

Route::get('careers','CareerController@index')->name('career');


/* e-health Routes */
Route::get('e-health','MinisiteController@index')->name('e-health');/* #SID - #zhby1t - Ehealth Landing Page */
Route::get('e-doctor','MinisiteController@edoctor')->name('e-doctor');/* #SID - #zhby1t - Ehealth Landing Page */
Route::post('get-in-touch','MinisiteController@getInTouch');/* #SID - #zhby1t - Ehealth Landing Page */
Route::post('contact-us-mini','MinisiteController@contactUs');/* #SID - #zhby1t - Ehealth Landing Page */

/* T&C Route*/
Route::get('termsconditions','SiteController@tnc');

Auth::routes();


Route::get('/clearCache', function() {
    \Artisan::call('cache:clear');
    \Artisan::call('config:clear');
    \Artisan::call('view:clear');
    \Artisan::call('route:clear');
    return 'Hurry!! Cleared all cache successfully.';
});

