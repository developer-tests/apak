@extends('layouts.admin_layout', ['title' => __('Site Settings')])

@section('content')
@include('layouts.headers.cards')

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                           

                        <h3 class="col-12 mb-0">{{ __('Site Setting') }}</h3>


                        </div>
                        
                    </div>
                    <div class="card-body">
                        <form method="post" enctype="multipart/form-data" action="{{ route('site_settings.save') }}" autocomplete="off">
                            @csrf

                     @if (session('status'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('status') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                         
                           <div class="pl-lg-4">
                                <div class="form-group{{ $errors->has('site_name') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-site_name">{{ __('Site Name') }}</label>
                                    <input type="text" name="site_name" id="input-site_name" class="form-control form-control-alternative{{ $errors->has('site_name') ? ' is-invalid' : '' }}"placeholder="{{ __('Site Name') }}" value="{{!empty($data)?$data['site_name']: old('site_name')}}" required >

                                    @if ($errors->has('site_name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('site_name') }}</strong>
                                        </span>
                                    @endif
                                </div>

                    <div class="form-group{{ $errors->has('contact_email') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-email">{{ __('Email') }}</label>
                                    <input type="email" name="contact_email" id="input-contact_email" class="form-control form-control-alternative{{ $errors->has('contact_email') ? ' is-invalid' : '' }}" placeholder="{{ __('Contact Email') }}" value="{{!empty($data)?$data['contact_email']:old('contact_email')}}" required>

                                    @if ($errors->has('contact_email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('contact_email') }}</strong>
                                        </span>
                                    @endif
                                </div>



                       <div class="form-group{{ $errors->has('contact_number') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-contact_number">{{ __('Contact Number') }}</label>
                                    <input type="text" name="contact_number" id="input-contact_number" class="form-control form-control-alternative{{ $errors->has('contact_number') ? ' is-invalid' : '' }}" placeholder="{{ __('Contact Number') }}" value="{{!empty($data)?$data['contact_number']:old('contact_number')}}">
                                    
                                    @if ($errors->has('contact_number'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('contact_number') }}</strong>
                                        </span>
                                    @endif
                                </div>


                     <div class="form-group">
                                    <label class="form-control-label" for="input-role">{{ __('Address') }}</label>
                                     <input  type="text" name="address"  id="autocomplete_search" class="form-control form-control-alternative{{ $errors->has('address') ? ' is-invalid' : '' }}" placeholder="{{ __('Address') }}" value="{{!empty($data)?$data['address']:old('address')}}">
                                          @if ($errors->has('address'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('address') }}</strong>
                                        </span>
                                    @endif
                                </div>
								
                                <div class="form-group{{ $errors->has('site_title') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-site_title">{{ __('Site Title - if site logo no available') }}</label>
                                    <input type="text" name="site_title" id="input-site_title" class="form-control form-control-alternative{{ $errors->has('site_title') ? ' is-invalid' : '' }}"placeholder="{{ __('Site Title') }}" value="{{!empty($data) && !empty($data['site_title'])?$data['site_title']: old('site_title')}}" required >

                                    @if ($errors->has('site_title'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('site_title') }}</strong>
                                        </span>
                                    @endif
                                </div>
							

                            <div class="form-group">
                                <label class="form-control-label" for="input-role">{{ __('Site Logo') }}</label>
                                   <input type="file" name="site_logo">
                                    @if(!empty($data['site_logo']) && $data['site_logo'])
                                    <div class="site-logo">
                                        <img src="{{url('siteimages/'.$data['site_logo'])}}" width="50%">
                                    </div>
                                    @endif
                                    @if ($errors->has('site_logo'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('site_logo') }}</strong>
                                        </span>
                                    @endif
                                </div>


                            <div class="form-group">
                            <label class="form-control-label" for="input-role">{{ __('Site Banner') }}</label>
                                <input type="file" name="site_banner">
                                     @if(!empty($data['site_banner']) && $data['site_banner'])
                                    <div class="site_banner">
                                        <img src="{{url('siteimages/'.$data['site_banner'])}}" width="50%">
                                    </div>
                                    @endif

                                     @if ($errors->has('site_banner'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('site_banner') }}</strong>
                                        </span>
                                    @endif
                                    </div>


                            <div class="form-group{{ $errors->has('banner_heading') ? ' has-danger' : '' }}">
                                 <label class="form-control-label" for="input-banner_heading">{{ __('Banner Heading') }}</label>
                                    <input type="text" name="banner_heading" id="input-banner_heading" class="form-control form-control-alternative{{ $errors->has('banner_heading') ? ' is-invalid' : '' }}" placeholder="{{ __('Banner Heading') }}" value="{{!empty($data)?$data['banner_heading']:old('banner_heading')}}">
                                    
                                    @if ($errors->has('banner_heading'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('banner_heading') }}</strong>
                                        </span>
                                    @endif
                                </div>


                           <div class="form-group{{ $errors->has('meta_desc') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-meta_desc">{{ __('Meta Description') }}</label>
                                 
                                <textarea name="meta_desc" class="form-control form-control-alternative{{ $errors->has('meta_desc') ? ' is-invalid' : '' }}"  placeholder="{{ __('Meta Description') }}">{{!empty($data)?$data['meta_desc']:old('meta_desc')}}</textarea>

                                    @if ($errors->has('meta_desc'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('meta_desc') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group{{ $errors->has('fb_pixel') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-meta_desc">{{ __('FB Pixel') }}</label>
                                 
                                <textarea name="fb_pixel" class="form-control form-control-alternative{{ $errors->has('fb_pixel') ? ' is-invalid' : '' }}"  placeholder="{{ __('Fb Pixel') }}">{{!empty($data)?$data['fb_pixel']:old('fb_pixel')}}</textarea>

                                    @if ($errors->has('fb_pixel'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('fb_pixel') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('google_analytics') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-meta_desc">{{ __('Google Analytics') }}</label>
                                 
                                <textarea name="google_analytics" class="form-control form-control-alternative{{ $errors->has('google_analytics') ? ' is-invalid' : '' }}"  placeholder="{{ __('Google Analytics') }}">{{!empty($data)?$data['google_analytics']:old('google_analytics')}}</textarea>

                                    @if ($errors->has('google_analytics'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('google_analytics') }}</strong>
                                        </span>
                                    @endif
                                </div>



     
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                         <h3 class="col-12 mb-0">{{ __('Social Media') }}</h3>
                           </div>
                             
                                    <div class="form-group">
                                    <label class="form-control-label" for="input-role">{{ __('Facebook') }}</label>
                                     <input  type="text" name="facebook"  id="autocomplete_search" class="form-control form-control-alternative{{ $errors->has('facebook') ? ' is-invalid' : '' }}" placeholder="{{ __('facebook') }}" value="{{!empty($data['facebook'])?$data['facebook']:old('facebook')}}">
                                          @if ($errors->has('facebook'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('facebook') }}</strong>
                                        </span>
                                    @endif
                                </div>
                      
                             
                             <div class="form-group">
                                    <label class="form-control-label" for="input-role">{{ __('Instagram') }}</label>
                                     <input  type="text" name="instagram"  id="autocomplete_search" class="form-control form-control-alternative{{ $errors->has('instagram') ? ' is-invalid' : '' }}" placeholder="{{ __('instagram') }}" value="{{!empty($data['instagram'])?$data['instagram']:old('instagram')}}">
                                          @if ($errors->has('instagram'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('instagram') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                


                                <div class="form-group">
                                    <label class="form-control-label" for="input-role">{{ __('Twitter') }}</label>
                                     <input  type="text" name="twitter"  id="autocomplete_search" class="form-control form-control-alternative{{ $errors->has('twitter') ? ' is-invalid' : '' }}" placeholder="{{ __('twitter') }}" value="{{!empty($data['twitter'])?$data['twitter']:old('twitter')}}">
                                          @if ($errors->has('twitter'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('twitter') }}</strong>
                                        </span>
                                    @endif
                                </div>


                                <div class="form-group">
                                    <label class="form-control-label" for="input-role">{{ __('Records per page') }}</label>
                                     <input  type="number" name="records_per_page"  class="form-control form-control-alternative" placeholder="{{ __('Records per page') }}" value="{{!empty($data['records_per_page'])?$data['records_per_page']:old('records_per_page')}}">
                                </div>


                                    <div class="text-center">
                                    <button type="submit" class="btn btn-success mt-4">{{ __('Save') }}</button>
                                </div>
                              </form>


                            </div> 
                    </div>
                </div>
            </div>
        </div>
        
       
    </div>
@endsection