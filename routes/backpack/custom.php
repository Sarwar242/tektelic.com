<?php

// --------------------------
// Custom Backpack Routes
// --------------------------
// This route file is loaded automatically by Backpack\Base.
// Routes you generate using Backpack\Generators will be placed here.

Route::group([
    'prefix'     => config('backpack.base.route_prefix', 'admin'),
    'middleware' => array_merge(
        (array) config('backpack.base.web_middleware', 'web'),
        (array) config('backpack.base.middleware_key', 'admin')
    ),
    'namespace'  => 'App\Http\Controllers\Admin',
], function () { // custom admin routes

    Route::crud('portfoliolang', 'PortfolioLangCrudController');
    Route::crud('keysarealang', 'KeysAreaLangCrudController');

    Route::crud('usecaselang', 'UseCaseLangCrudController');
    Route::crud('langs', 'LangsCrudController');
    Route::crud('sliders', 'SlidersCrudController');
    Route::crud('benefits', 'BenefitsCrudController');
    Route::crud('benefitlang', 'BenefitLangCrudController');

    Route::crud('qualitylifeslang', 'QualityLifesLangCrudController');
    Route::crud('technologylang', 'TechnologyLangCrudController');
    Route::crud('qualitylife', 'QualityLifeCrudController');
    Route::crud('technology', 'TechnologyCrudController');
    //Route::get('create-link-benefit', 'UseCaseLangCrudController@createLinkBenefit');
    Route::crud('usecasebenefit', 'UseCaseBenefitCrudController');
    Route::crud('usecasequalitylife', 'UseCaseQualityLifeCrudController');
    Route::crud('usecasetechnology', 'UseCaseTechnologyCrudController');
    Route::crud('keyareabenefit', 'KeyAreaBenefitCrudController');
    Route::crud('keyareaqualitylife', 'KeyAreaQualityLifeCrudController');
    Route::crud('keyareatechnology', 'KeyAreaTechnologyCrudController');
    Route::crud('keyarea', 'KeyAreaCrudController');
    Route::crud('portfolio', 'PortfolioCrudController');
    Route::crud('usecase', 'UseCaseCrudController');
    Route::crud('usecaseitem', 'UseCaseItemCrudController');
    Route::crud('usecaseitemlang', 'UseCaseItemLangCrudController');
    Route::crud('keys', 'KeysCrudController');

    Route::crud('pagelang', 'PageLangCrudController');
    Route::crud('distributor', 'DistributorCrudController');
    Route::crud('distributorlang', 'DistributorLangCrudController');
    Route::crud('country', 'CountryCrudController');
    Route::crud('countrylang', 'CountryLangCrudController');
    Route::crud('entitytype', 'EntityTypeCrudController');

    Route::crud('contact', 'ContactCrudController');
    Route::crud('statictextlang', 'StaticTextLangCrudController');
    Route::crud('statictext', 'StaticTextCrudController');
    Route::crud('request', 'RequestCrudController');
    
    Route::crud('whitepapers', 'PdfCrudController');//sd
    Route::crud('youtube', 'YoutubeCrudController');//sd

    Route::crud('keystypes', 'KeysTypesCrudController');
    Route::crud('product', 'ProductCrudController');
    Route::crud('products', 'ProductsCrudController');
    Route::crud('productstype', 'ProductsTypeCrudController');
    Route::crud('propductcharacteristics', 'PropductCharacteristicsCrudController');
    Route::crud('propductcharacteristicsblock', 'PropductCharacteristicsBlockCrudController');
    Route::crud('producttypeitemfilter', 'ProductTypeItemFilterCrudController');
    Route::crud('secndslider', 'SecndSliderCrudController');
    Route::crud('homedata', 'HomeDataCrudController');
    Route::crud('headings', 'HeadingsCrudController');
}); // this should be the absolute last line of this file
Route::redirect('/admin/register', '/admin/login');
