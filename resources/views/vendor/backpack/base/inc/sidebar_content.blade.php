<!-- This file is used to store sidebar items, starting with Backpack\Base 0.9.0 -->
<li class="nav-item">
    <a class="nav-link" href="{{ backpack_url('dashboard') }}">
        <i class="la la-home nav-icon"></i>
        {{ trans('backpack::base.dashboard') }}
    </a>
</li>
<li class="nav-item nav-dropdown">
    <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-users"></i> Authentication</a>
    <ul class="nav-dropdown-items">
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('user') }}"><i class="nav-icon la la-user"></i> <span>Users</span></a></li>
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('role') }}"><i class="nav-icon la la-id-badge"></i> <span>Roles</span></a></li>
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('permission') }}"><i class="nav-icon la la-key"></i> <span>Permissions</span></a></li>
    </ul>
</li>

<li class="nav-item nav-dropdown">
    <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-boxes"></i> Products</a>
    <ul class="nav-dropdown-items">
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('products') }}'><i class='nav-icon la la-list'></i> List </a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('productstype') }}'><i class='nav-icon la la-project-diagram'></i> Types</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('propductcharacteristics') }}'><i class='nav-icon la la-book'></i> Characteristics</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('propductcharacteristicsblock') }}'><i class='nav-icon la la-bookmark'></i> Characteristics Blocks</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('producttypeitemfilter') }}'><i class='nav-icon la la-question'></i>Filter type item</a></li>
    </ul>
</li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('category') }}'><i class='nav-icon la la-list'></i> <span>Categories</span></a></li>
<li class="nav-item nav-dropdown">
    <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-keyboard-o"></i> Keys</a>
    <ul class="nav-dropdown-items">
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('keys') }}'><i class='nav-icon la la-key'></i> Keys list</a></li>
{{--        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('keystypes') }}'><i class='nav-icon la la-circle'></i>Keys types</a></li>--}}
    </ul>
</li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('youtube') }}'><i class='nav-icon la la-youtube'></i> Youtube Videos</a></li>
<li class="nav-item nav-dropdown">
    <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-newspaper-o"></i>Knowledge Base</a>
    <ul class="nav-dropdown-items">
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('article') }}"><i class="nav-icon la la-newspaper-o"></i> Articles</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('tag') }}"><i class="nav-icon la la-tag"></i> Tags</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('whitepapers') }}"><i class="nav-icon la la-blog"></i> Whitepapers</a></li>
    </ul>
</li>
<!-- #SID - 44-new-website-page-knowledge  -->
<li class="nav-item nav-dropdown">
    <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-blog"></i>Blogs</a>
    <ul class="nav-dropdown-items">
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('blogcategory') }}"><i class="nav-icon la la-list"></i> Categories</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('blogs') }}"><i class="nav-icon la la-blog"></i> All Blogs</a></li>
    </ul>
</li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('testimonials') }}'><i class='nav-icon la la-terminal'></i> Testimonials</a></li>
<!-- #SID - #z3c3nz - Career page On Tektelic -->
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('career') }}'><i class='nav-icon la la-terminal'></i> Career</a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('log') }}'><i class='nav-icon la la-terminal'></i> Logs</a></li>

<li class='nav-item'><a class='nav-link' href='{{ backpack_url('portfoliolang') }}'><i class='nav-icon la la-database'></i>Case Studies</a></li>

<li class="nav-item nav-dropdown">
    <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-newspaper-o"></i>Keys Areas</a>
    <ul class="nav-dropdown-items">
        <li class='nav-item'>
            <a class='nav-link' href='{{ backpack_url('keysarealang') }}'><i class='nav-icon la la-newspaper-o'></i> Keys Areas List</a>
        </li>
                <li class='nav-item'><a class='nav-link' href='{{ url('/admin/technologylang?&type=1') }}'><i class='nav-icon '></i> Sections</a></li>
                <li class='nav-item'><a class='nav-link' href='{{ backpack_url('entitytype?&type=2') }}'><i class='nav-icon '></i> Entity Types</a></li>
               {{-- <li class='nav-item'><a class='nav-link' href='{{ backpack_url('keyareabenefit') }}'><i class='nav-icon '></i>Bind Benefits</a></li>
                <li class='nav-item'><a class='nav-link' href='{{ backpack_url('keyareaqualitylife') }}'><i class='nav-icon '></i>Bind Quality Lives</a></li>
                <li class='nav-item'><a class='nav-link' href='{{ backpack_url('keyareatechnology') }}'><i class='nav-icon '></i>Bind  Technologies</a></li>--}}



    </ul>
</li>

<li class="nav-item nav-dropdown">
    <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon fa fa-newspaper-o"></i>Use Cases</a>
    <ul class="nav-dropdown-items">

        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('usecaselang') }}'><i class='nav-icon la la-book'></i>Use Cases List</a></li>
                <li class='nav-item'><a class='nav-link' href='{{ backpack_url('technologylang?&type=2') }}'><i class='nav-icon '></i> Sections </a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('entitytype?&type=2') }}'><i class='nav-icon'></i> Entity Types</a></li>
    </ul>
</li>

<li class='nav-item'><a class='nav-link' href='{{ backpack_url('langs') }}'><i class='nav-icon las la-globe'></i> Langs</a></li>

<li class="nav-item nav-dropdown">
    <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon fa fa-newspaper-o"></i>Sliders</a>
    <ul class="nav-dropdown-items">
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('sliders') }}'><i class='nav-icon la la-list'></i> Main Slider</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('secndslider') }}'><i class='nav-icon la la-question'></i> Second Sliders</a></li>
    </ul>
</li>


<li class="nav-item"><a class="nav-link" href="{{ backpack_url('elfinder') }}"><i class="nav-icon la la-files-o"></i> <span>{{ trans('backpack::crud.file_manager') }}</span></a></li>

{{--<li class='nav-item'><a class='nav-link' href='{{ backpack_url('menu-item') }}'><i class='nav-icon la la-list'></i> <span>Menu</span></a></li>--}}
{{--<li class='nav-item'><a class='nav-link' href='{{ backpack_url('page') }}'><i class='nav-icon fa fa-file-o'></i> <span>Pages</span></a></li>--}}


<li class="nav-item nav-dropdown">
    <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon fa fa-newspaper-o"></i>Distributors</a>
    <ul class="nav-dropdown-items">
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('pagelang') }}'><i class='nav-icon la la-list'></i> Content</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('distributorlang') }}'><i class='nav-icon la la-list'></i> Distributors</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('countrylang') }}'><i class='nav-icon la la-list'></i> Countries</a></li>
    </ul>
</li>


<li class="nav-item nav-dropdown">
    <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon fa fa-newspaper-o"></i>About Us</a>
    <ul class="nav-dropdown-items">
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('pagelang') }}'><i class='nav-icon la la-list'></i> Content</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('contact') }}'><i class='nav-icon la la-list'></i> Contacts</a></li>
    </ul>
</li>


<li class='nav-item'><a class='nav-link' href='{{ backpack_url('statictext') }}'><i class='nav-icon la la-list'></i> Static Texts</a></li>

<li class="nav-item nav-dropdown">
    <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon fa fa-newspaper-o"></i>Requests</a>
    <ul class="nav-dropdown-items">
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('request') }}'><i class='nav-icon la la-list'></i> All</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('request?type=footer') }}'><i class='nav-icon la la-list'></i> Footer</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('request?type=product') }}'><i class='nav-icon la la-list'></i> Product</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('request?type=about_us') }}'><i class='nav-icon la la-list'></i> About Us</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('request?type=index_page') }}'><i class='nav-icon la la-list'></i> Index Page</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('request?type=header') }}'><i class='nav-icon la la-list'></i> Header</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('request?type=whitepapers') }}'><i class='nav-icon la la-list'></i> Whitepapers</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('request?type=get-in-touch') }}'><i class='nav-icon la la-list'></i> Get In Touch</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('request?type=contact_ehealth') }}'><i class='nav-icon la la-list'></i> Contact e-health</a></li>
    </ul>

</li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('menu-item') }}'><i class='nav-icon la la-list'></i> <span>Menu</span></a></li>

<li class='nav-item'><a class='nav-link' href='{{ backpack_url('homedata') }}'><i class='nav-icon la la-list'></i> Home Data</a></li>

<li class='nav-item'><a class='nav-link' href='{{ backpack_url('headings') }}'><i class='nav-icon la la-question'></i> Headings</a></li>
