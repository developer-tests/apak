@extends('layouts.app', ['class' => 'bg-default'])

@section('content')
        <section class="account-info">
            <div class="inner-container">
                <div class="row">
				<div class="col-sm-12 mt-20">
					<h1 class="center">{{$content['page_title']}}</h1>
				</div>
				</div>
				<div class="row">
				<div class="col-sm-12">
				{!! $content['page_description'] !!}
				</div>
				</div>
				</div>
			</div>
</section>			

@endsection
