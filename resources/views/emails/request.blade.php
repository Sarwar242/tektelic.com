@php
$country= \App\Models\CountryLang::where('country_id',$request->country_id)->first();
@endphp
<p>Country: {{ $country->title  }} </p>
<p>Email:  {{ $request->email  }} </p>
<p>Linkedin or Phone:  {{ $request->linkedin  }} </p>


