@extends('app')

@section('body')
<div class="main-banner banner text-center" style="background: url({{url(\App\Appconfig::where('key','img_banner')->first()['value'])}}) no-repeat;background-size: cover;background-position: center;">
    <div class="container">    
      <h1>{{\App\Appconfig::where('key','heading')->first()['value']}}</h1>
      <p>{{\App\Appconfig::where('key','subheading')->first()['value']}}</p>
      <a href="{{route(\App\Appconfig::where('key','btn_heading_url')->first()['value'])}}">{{\App\Appconfig::where('key','btn_heading')->first()['value']}}</a>
    </div>
  </div>
<div class="total-ads main-grid-border">
		<div class="container">
			<ol class="breadcrumb" style="margin-bottom: 5px;margin-top: 20px;">
			  <li><a href="{{url()}}">Home</a></li>
			  <li><a href="{{route($brer)}}">{{$bret}}</a></li>
			  <li class="active">{{$name}}</li>
			</ol>
			<div class="ads-grid">
			@if(Auth::check())
			@include('utils.sidebar-seller')
			@else
			@include('utils.sidebar-buyer')
			@endif
				<div class="ads-display col-md-9">
				<h3>{{$name}}</h3>
					<div class="wrapper">					
						<div id="container">
							<div class="clearfix"></div>
							<ul class="list">
							@if(sizeof($data)==0)
								<h2>Sorry, but no one Ad</h2>
								@if($show==1)
								@if(Auth::user()->id==$id_u)
									<h3><a href="{{route('ads_create')}}">Create one here</a></h3>
								@endif
								@endif
							@endif
							@foreach($data as $key)
								<a href="{{route('ad_detail',$key->slug)}}">
									<li>
									<div class="photo">
									<img src="{{sizeof(\App\Image::where('code','product-'.$key->id)->get())==0?url('img-uploader/src/img/icon_add_image2.png'):url('uploads/'.\App\Image::where('code','product-'.$key->id)->first()['image'])}}" title="" alt="" />
									</div>
									<div class="dalam">
									<section class="list-right">
									</section>
									<section class="list-left">
									<h5 class="title">{{$key->name}}</h5>
									<span class="cityname">{{\App\Kios::find($key->id_kios)['name']}} : {{\App\Province::find(\App\Kios::find($key->id_kios)['id_province'])['nama']}}, {{\App\City::find(\App\Kios::find($key->id_kios)['id_city'])['nama']}}</span>
									<span class="catpath">{{\App\Pilar::find($key->id_pilar)['name']}} » {{\App\Kategori::find(\App\ProductCategory::where('id_product',$key->id)->where('id_kategori',\App\JKategori::where('code','make')->first()['id'])->first()['value'])['name']}}</span>
									</section>
									<section class="list-right">
									<span class="adprice">Rp. {{number_format($key->price,2)}}</span>
									<span class="">Posted at {{date_format(date_create($key->created_at),"D, d M Y H:i:s")}}</span>
									</section>
									</div>
									</li> 
								</a>
							@endforeach
							</ul>
					  </div>
				</div>
				</div>
				<div class="clearfix"></div>
			</div>
		</div>	
	</div>
@endsection

@section('footer')
	<script type='text/javascript'>//<![CDATA[ 
	$(window).load(function(){
	 $( "#slider-range" ).slider({
				range: true,
				min: 100000,
				max: 10000000,
				values: [ 200000, 8000000 ],
				slide: function( event, ui ) {  $( "#amount" ).val(rupiah(ui.values[ 0 ]) + " - " + rupiah(ui.values[ 1 ]) );
				}
	 });
	$( "#amount" ).val( rupiah($( "#slider-range" ).slider( "values", 0 )) + " - " + rupiah($( "#slider-range" ).slider( "values", 1 )) );

	});//]]>    
function rupiah(value)
  {
  value += '';
  x = value.split('.');
  x1 = x[0];
  x2 = x.length > 1 ? '.' + x[1] : '';
  var rgx = /(\d+)(\d{3})/;
  while (rgx.test(x1)) {
  x1 = x1.replace(rgx, '$1' + ',' + '$2');
  }
  return 'Rp ' + x1 + x2;
  }


	</script>
@endsection