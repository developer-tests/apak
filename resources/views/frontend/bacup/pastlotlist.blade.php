@extends('layouts.app', ['class' => 'bg-default'])
@section('content')
<section class="auctions-category">
  <div class="inner-container">
    <div class="row">
      <div class="tab-link">
        <ul>
          <li ><a href="{{route('auctions.type','past')}}">Auctions</a></li>
          <li class="active"><a href="#">Lot List</a></li>
        </ul>
      </div>
      <form id="items_filter_form">
      <div class="category-main">
        <div class="col-12 col-sm-12 col-md-8 col-lg-8 col-xl-8">
          <div class="search-form">
            
              <input type="text" name="q" id="text" class="form-control" placeholder="Search">
              <button type="button" class="btn btn-primary"><i class="fa fa-search"></i></button>
            
          </div>
        </div>
        <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
          <div class="categories-button">
            <select class="form-control" id="auction-search-category" name="cat">
              <option value="">All Groups &amp; Categories</option>
              @foreach($category as $ct)
              <option value="{{$ct->id}}" {{!empty($data["cat"]) && $ct->id== $data['cat'] ? 'selected':''}}>{{$ct->title}} ({{$ct->item_count}})</option>
              @endforeach
            </select>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!--- End of Auction Tab --->
<!--- Start Auction Categories --->
@if(count($auction_items) > 0)
<section class="auctions-category single-page">
  <div class="inner-container">
    
      <div class="row mt-30">
        <div class="lot-list-view-options col-12 col-sm-12 col-md-12 col-lg-12  text-right text-center-xs pull-right print-hidden p-b-sm p-0">
          <div class="lot-list-view-switcher-container btn-group btn-group-toggle btn-group-sm" data-toggle="buttons">
            <label class="btn btn-default btn-sm p-x-sm {{$data['list_view'] == 'condensed' ? 'active' : ''}}">
            <input type="radio" id="lot-list-view-switcher" value="condensed" class="lot-list-view-switcher" name="list_view" autocomplete="off"><i class="fa fa-lg fa-list-ol m-r-sm"></i>Condensed
            </label>
            <label class="btn btn-default p-x-sm {{$data['list_view'] == 'tile' ? 'active' : ''}}">
            <input type="radio" id="lot-list-view-tile" value="tile" class="lot-list-view-switcher " name="list_view" autocomplete="off"><i class="fa fa-lg fa-th-large m-r-sm"></i>Tile View
            </label>
            <label class="btn btn-default p-x-sm {{$data['list_view'] == 'full' ? 'active' : ''}}">
            <input type="radio" id="lot-list-view-full" value="full" class="lot-list-view-switcher" name="list_view" autocomplete="off"><i class="fa fa-lg fa-th-list m-r-sm"></i>Full View
            </label>
          </div>
        </div>
      </div>
    </form>
  </div>
</section>
<!--- End of Auction Tab --->
<!--- Start lot Box --->
@if($data['list_view'] == 'tile')
<section class="lot-box">
  <div class="inner-container">
    <div class="row">
      <div class="grid-box-main">
        @foreach($auction_items as $key=>$item)
        <div class="wrapper-item">
          <div class="box-title">
            <p><span>Lot {{$item->id}}</span> | {{$item->title}}</p>
            <i class="fa fa-info-circle"></i>
          </div>
          @php
          $image = getAuctionItemImage(1, $item->id);
          @endphp
          <a href="javascript:(0);" data-id="{{$item->id}}" onclick="openGalleria('{{$item->id}}')" class="abcd" data-toggle="modal" data-target="#myModalgallery{{$item->id}}">
          <img src="{{url('auctions/'.$image[0]['image_name'])}}">
          </a>
          <div class="center-content">
            <div class="item-sold-date"><span>Date sold : 02-02-2021</span></div>
            <p>Price Realized Not Uploaded</p>
          </div>
        </div>
        <div class="modal fade" id="myModalgallery{{$item->id}}">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <!-- Modal Header -->
              <div class="modal-header">
                <h4 class="modal-title">{{$item->title}}</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
              <!-- Modal body -->
              <div class="modal-body">
                <div id="galleria{{$item->id}}" class="galleria{{$item->id}}">
                  @php
                  $iimages = getAuctionItemImage(0, $item->id);
                  @endphp
                  @foreach($iimages as $imm)
                  <a href="{{url('auctions/'.$imm->image_name)}}">
                  <img src="{{url('auctions/'.$imm->image_name)}}"
                    data-description="{{$item->title}}"
                    data-title="{{$item->title}}">
                  </a>
                  @endforeach
                </div>
                <p class="text-center">Click Main Image For Fullscreen Mode</p>
                <div class="col-12">
                  <div class="row m-t">
                    <div class="col-sm-4 text-right p-r">
                      Lot # 
                    </div>
                    <div class="col-sm-8 text-left p-l" id="lot-preview-lot-number">{{$item->id}}</div>
                  </div>
                  <div class="row m-t">
                    <div class="col-sm-4 text-right p-r">
                      Quantity 
                    </div>
                    <div class="col-sm-8 text-left p-l" id="lot-preview-lot-number">{{$item->quantity}}</div>
                  </div>
                  <div class="row">
                    <div class="col-sm-4 text-right p-r">
                      Estimate
                    </div>
                    <div class="col-sm-8 text-left p-l" id="lot-preview-estimate"></div>
                  </div>
                  <div class="row">
                    <div class="col-sm-4 text-right p-r">
                      Description
                    </div>
                    <div class="col-sm-8 text-left p-l">
                      <div class="lot-description-container">
                        <div id="lot-preview-description" class="lot-description text-pre-line">
                          {!! $item->description !!}
                        </div>
                        <div class="lot-description-arrow">
                          <i class="fa fa-chevron-circle-down fa-lg text-primary"></i>
                        </div>
						</div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-4 text-right p-r">
                  Estimate
                </div>
                <div class="col-sm-8 text-left p-l" id="lot-preview-estimate"></div>
              </div>
            </div>
          </div>
        </div>
        <!--- End Modal --->
        @endforeach
      </div>
      <input type="hidden" id="oldid" value="">
    </div>
  </div>
</section>
@endif
@endif
@if($data['list_view'] == 'condensed')
<section class="condensed-layout">
  <div class="inner-container">
    <div class="row">
      <div class="col-12">
        <table>
          <tbody>
            @foreach($auction_items as $item)
            <tr>
              <td>
                <div class="lot inline-lot print-border bid-status-border bid-status-border-default">
                  <div class="row m-x-0">
                    <div class="col-8 col-sm-6 col-md-6 col-lg-6 pr-0">
                      <div class="row m-x-0">
                        <div class="col-3 pr-0">
                          @php
                          $image = getAuctionItemImage(1, $item->id);
                          @endphp
                          <a href="javascript:(0);" data-id="{{$item->id}}" onclick="openGalleria('{{$item->id}}')" class="lot-link lot-preview-link" data-toggle="modal" data-target="#myModalgallery{{$item->id}}">
                            <div class="">
                              <img class="inline-lot-thumbnail img-responsive" src="{{url('auctions/'.$image[0]['image_name'])}}">
                              <div class="align-top-absolute">
                                <div class="lot-quantity label label-warning label-transparent hidden"></div>
                                <div class="lot-quantity-sold-container label label-warning label-transparent text-center hidden">
                                  x <span class="lot-quantity-sold"></span>
                                </div>
                              </div>
                         
                            </div>
                          </a>
                         
                        </div>
                        <div class="col-8 pr-0">
                          <div><strong><a href="" ><b>Lot {{$item->id}}</b> | {{$item->title}}</a></strong></div>
                        
                        </div>
						
                      </div>
                    </div>
                    <div class="col-8 col-sm-8 col-md-3 col-lg-3 pr-0">
							<div class="row m-x-0">
								<div class="col-xs-3">
									<div class="lot-date-sold-container">
										<span>Date Sold:</span>
										<span class="lot-date-sold">12-04-2016</span>
									</div>
								</div>
								
							</div>
					</div>
					<div class="col-8 col-sm-8 col-md-3 col-lg-3 pr-0">
						<div class="row m-x-0">
							
							<div class="col-xs-4">
								<div class="lot-price-realized-container">
									<div class="text-center">
										<strong class="lot-price-realized-title">Price Realized:</strong>
									</div>
									<div class="text-center">
										<strong class="lot-price-realized">1,25,500.00 USD</strong>
									</div>
								</div>
							</div>
						</div>
					</div>
                  </div>
                </div>
              </td>
            </tr>
            <div class="modal fade" id="myModalgallery{{$item->id}}">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                  <!-- Modal Header -->
                  <div class="modal-header">
                    <h4 class="modal-title">{{$item->title}}</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                  </div>
                  <!-- Modal body -->
                  <div class="modal-body">
                    <div id="galleria{{$item->id}}" class="galleria{{$item->id}}">
                      @php
                      $iimages = getAuctionItemImage(0, $item->id);
                      @endphp
                      @foreach($iimages as $imm)
                      <a href="{{url('auctions/'.$imm->image_name)}}">
                      <img src="{{url('auctions/'.$imm->image_name)}}"
                        data-description="{{$item->title}}"
                        data-title="{{$item->title}}">
                      </a>
                      @endforeach
                    </div>
                    <p class="text-center">Click Main Image For Fullscreen Mode</p>
                    <div class="col-12">
                      <div class="row m-t">
                        <div class="col-sm-4 text-right p-r">
                          Lot # 
                        </div>
                        <div class="col-sm-8 text-left p-l" id="lot-preview-lot-number">{{$item->id}}</div>
                      </div>
                     <div class="row">
                        <div class="col-sm-4 text-right p-r">
                          Quantity
                        </div>
                        <div class="col-sm-8 text-left p-l" id="lot-preview-estimate">{{$item->quantity}}</div>
                      </div>
                      <div class="row">
                        <div class="col-sm-4 text-right p-r">
                          Estimate
                        </div>
                        <div class="col-sm-8 text-left p-l" id="lot-preview-estimate"></div>
                      </div>
                      
                      <div class="row">
                        <div class="col-sm-4 text-right p-r">
                          Description
                        </div>
                        <div class="col-sm-8 text-left p-l">
                         <div class="lot-description-container">
                        <div id="lot-preview-description" class="lot-description text-pre-line">
                          {!! $item->description !!}
                        </div>
                        <div class="lot-description-arrow">
                          <i class="fa fa-chevron-circle-down fa-lg text-primary"></i>
                        </div>
						</div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <a id="lot-preview-detail" href="" class="btn btn-default m-x-0" target="_blank">Lot Details</a>
                    <button type="button" class="btn btn-primary m-x-0" data-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>
            @endforeach
          </tbody>
        </table>
        <input type="hidden" id="oldid" value="">
      </div>
    </div>
  </div>
</section>
@endif
@if($data['list_view'] == 'full')
<section class="fullview-layout">
  <div class="inner-container">
    @foreach($auction_items as $item)
    <div class="row mb-30">
      <div class="col-12">
        <div class="full-inner">
          <div class="heading-top">
            <h4><span>Lot {{$item->id}}</span> | {{$item->title}}</h4>
          </div>
          <div class="row">
            @php
            $image = getAuctionItemImage(1, $item->id);
            @endphp
            <div class="col-12 col-sm-12 col-md-3 col-lg-3 col-xl-3">
              <div class="img-social">
                <a href="javascript:(0);" data-id="{{$item->id}}" onclick="openGalleria('{{$item->id}}')" class="abcd" data-toggle="modal" data-target="#myModalgallery{{$item->id}}">
                <img src="{{url('auctions/'.$image[0]['image_name'])}}">
                </a>
              </div>
            </div>
            <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                <div class="lot-description-arrow-container">
                  <div class="lot-description text-pre-line">
                    {!! $item->description !!}
                  </div>
                  {{-- 
                  <div class="lot-description-arrow">
                    <i class="fa fa-chevron-circle-down fa-lg text-primary"></i>
                  </div>
                  --}}
              </div>
            </div>
           
            <div class="col-12 col-sm-4 col-md-3 col-lg-3 col-xl-3">
             <div class="row m-x-0">
					<div class="col-xs-3">
						<div class="lot-date-sold-container">
							<span>Date Sold:</span>
							<span class="lot-date-sold">12-04-2016</span>
						</div>
					</div>
					
					<div class="col-xs-3">
						<div class="lot-date-sold-container">
							<span>Price Realized:</span>
							<span class="lot-date-sold">1777 USD</span>
						</div>
					</div>
				</div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="modal fade" id="myModalgallery{{$item->id}}">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title">{{$item->title}}</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <!-- Modal body -->
          <div class="modal-body">
            <div id="galleria{{$item->id}}" class="galleria{{$item->id}}">
              @php
              $iimages = getAuctionItemImage(0, $item->id);
              @endphp
              @foreach($iimages as $imm)
              <a href="{{url('auctions/'.$imm->image_name)}}">
              <img src="{{url('auctions/'.$imm->image_name)}}"
                data-description="{{$item->title}}"
                data-title="{{$item->title}}">
              </a>
              @endforeach
            </div>
            <p class="text-center">Click Main Image For Fullscreen Mode</p>
            <div class="col-12">
              <div class="row m-t">
                <div class="col-sm-4 text-right p-r">
                  Lot # 
                </div>
                <div class="col-sm-8 text-left p-l" id="lot-preview-lot-number">{{$item->id}}</div>
              </div>
              <div class="row">
                <div class="col-sm-4 text-right p-r">
                  Quantity
                </div>
                <div class="col-sm-8 text-left p-l" id="lot-preview-estimate">{{$item->quantity}}</div>
              </div>
             <div class="row">
                <div class="col-sm-4 text-right p-r">
                  Estimate
                </div>
                <div class="col-sm-8 text-left p-l" id="lot-preview-estimate"></div>
              </div>
              <div class="row">
                <div class="col-sm-4 text-right p-r">
                  Description
                </div>
                <div class="col-sm-8 text-left p-l">
                  <div class="lot-description-container">
                        <div id="lot-preview-description" class="lot-description text-pre-line">
                          {!! $item->description !!}
                        </div>
                        <div class="lot-description-arrow">
                          <i class="fa fa-chevron-circle-down fa-lg text-primary"></i>
                        </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
			<a id="lot-preview-detail" href="" class="btn btn-default m-x-0" target="_blank">Lot Details</a>
			<button type="button" class="btn btn-primary m-x-0" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
    <!--- End Modal --->
    @endforeach
  </div>
  <input type="hidden" id="oldid" value="">
</section>
@endif
<div class="min-height"></div>
<!--- End of  lot Box --->
<script>
  $(document).on('change',".categories-button select", function(){
     $("#items_filter_form").submit();
  })
  $("#sortOrder").change(function(){
      $("#items_filter_form").submit();
  })
   $(".search").click(function(){
      $("#items_filter_form").submit();
  })
   $(document).on('change',".lot-list-view-switcher", function(){
  
      $("#items_filter_form").submit();
  })
  
</script>
@endsection