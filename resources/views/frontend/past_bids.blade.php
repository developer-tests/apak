  <!--- Start Auction Categories --->
@extends('layouts.app', ['class' => 'bg-default'])

@section('content')
  <section class="auctions-category">
            <div class="inner-container">
                <div class="row">
                    <div class="tab-link">
                        <ul>
                            <li class="active"><a href="#">Current Bids</a></li>
                            <li><a href="#">Watch List</a></li>
                            <li><a href="#">Top Picks</a></li>
                            <li><a href="#">My Auctions</a></li>
                            <li><a href="#">Past Bids</a></li>
                            <li><a href="#">Past Watch List</a></li>
                        </ul>
                    </div>
                    <div class="category-main currentbid-page">
                        <form action="" class="form-collapse print-hidden" data-breakpoint="sm" data-form-action="currentbids" id="lot-filter-form" method="GET" novalidate="novalidate">	<div class="lot-filter-container form-group inline-block m-y p-x">
                            <label class="sr-only" for="lot-filter-auctions">Auctions</label>
                            <div class="input-group">
                                <select class="form-control" data-val="true" data-val-required="The EventId field is required." id="lot-filter-auctions" name="EventId"><option value="">All Auctions</option>
                    </select>
                                <span class="input-group-btn">
                                    <button id="lot-filter-show-all" class="btn btn-danger hidden" type="button" title="Show All">
                                        <i class="fa fa-times"></i>
                                    </button>
                                    <button id="buyer-lot-refresh" class="lot-filter-refresh btn btn-primary" type="button">Refresh</button>
                                </span>
                            </div>
                        </div>
                        <div class="advanced-search-content form-group m-y p-r-0">
                            <label class="sr-only" for="lot-filter-status">Status</label>
                            <select class="form-control" data-val="true" data-val-required="The Status field is required." id="lot-filter-status" name="Status" aria-required="true" aria-invalid="false" aria-describedby="lot-filter-status-error"><option selected="selected" value="all">All Statuses</option>
                    <option value="winning">Winning / Won</option>
                    <option value="pending">Pending/Sealed</option>
                    <option value="outbid">Outbid/Declined</option>
                    </select>
                        </div>

                        <div class="advanced-search-content form-group m-y p-r-0">
                            <label class="sr-only" for="lot-filter-range">Placed During</label>
                            <select class="form-control" data-val="true" data-val-required="The Range field is required." id="lot-filter-range" name="Range" aria-required="true" aria-invalid="false" aria-describedby="lot-filter-range-error">
                                <option selected="selected" value="3">Past 3 Months</option>
                                <option value="6">Past 6 Months</option>
                                <option value="12">Past 12 Months</option>
                            </select>
                        </div>

                        <div class="advanced-search-content form-group m-y p-r-0">
                            <label class="sr-only" for="lot-filter-sort">Sort By</label>
                            <div class="input-group">
                                <select class="form-control" data-val="true" data-val-required="The S field is required." id="lot-filter-sort" name="S" aria-required="true" aria-invalid="false" aria-describedby="lot-filter-sort-error"><option selected="selected" value="salesorder">Sale Order</option>
                    <option value="lotnumber">Lot #</option>
                    <option value="bidcount">Bid History</option>
                    <option value="timeleft">Time Left</option>
                    <option value="highbid">High</option>
                    <option value="maxbid">Your Max</option>
                    <option value="bidstatus">Bid Status</option>
                    </select>
                                <div class="input-group-btn">
                                    <button id="lot-filter-sort-direction" data-value="asc" type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-sort-amount-asc"></i>
                                    </button>
                                    <ul id="lot-filter-sort-direction-list" class="dropdown-menu">
                                        <li><a herf="#" data-value="asc">ASC</a></li>
                                        <li><a href="#" data-value="desc">DESC</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="advanced-search-content form-group m-y m-x-xs p-r-0">
                            <input id="lot-filter-group-by-auction" name="groupByAuction" value="true" type="checkbox" checked="&quot;checked&quot;">
                            <label for="lot-filter-group-by-auction">Group By Auction</label>
                        </div>
                    </form>
                    </div>

                    <div class="alert alert-warning text-center print-hidden">
                        <i class="fa fa-exclamation-triangle"></i>
                        <strong>WARNING:</strong>
                        <a href="#" class="lot-filter-refresh alert-link">Click here to refresh the page and get updated bid amounts, time left, and bid status.</a>
                    </div>

                    <div id="lot-list-buyer-status-top" class="alert alert-info highbid-alert">
                        <div class="row">
                            <div class="col-12 col-sm-12 col-md-5 col-lg-5 text-center p-x">
                                <h4 class="m-y-0">
                                    Winning "High Bid" Total:
                                    <span id="lot-list-buyer-status-top-high-bid-total">0.00</span>
                                </h4>
                            </div>
                            <div class="col-12 col-sm-12 col-md-5 col-lg-5 text-center p-x">
                                <h4 class="m-y-0">
                                    Winning "Your Max Bid" Total:
                                    <span id="lot-list-buyer-status-top-bid-max-total">0.00</span>
                                </h4>
                            </div>
                            <div class="col-12 col-sm-12 col-md-2 col-lg-2 text-center p-x print-hidden">
                                <a id="lot-list-buyer-status-top-winning" href="#" class="btn btn-xs lot-status lot-status-winning" title="Winning Bids">0</a>
                                <a id="lot-list-buyer-status-top-pending" href="#" class="btn btn-xs lot-status lot-status-pending" title="Sealed and Pending Bids">0</a>
                                <a id="lot-list-buyer-status-top-losing" href="#" class="btn btn-xs lot-status lot-status-losing" title="Losing and Declined Bids">0</a>
                                <a id="lot-list-buyer-status-top-watching" href="#" class="btn btn-xs lot-status lot-status-watching" title="Watched Lots">0</a>
                            </div>
                        </div>
                    </div>

                    <div class="list-options-container m-b">
                        <div class="row"> 
                        <div class="col-6 col-sm-6 col-md-6 col-lg-6">
                            <div class="text-center-xs lot-list-view-switcher-container print-hidden">
                                <input id="lot-list-view-switcher" type="checkbox" checked="checked">
                                <label for="lot-list-view-switcher">Use condensed view</label>
                            </div>
                        </div>
                        <div class="col-6 col-sm-6 col-md-6 col-lg-6">
                            <div class="text-right pull-right print-hidden">
                                <a href="#" class="print-link btn btn-default hidden-xs" target="_blank"><i class="fa fa-print fa-lg"></i> Print</a>
                            </div>
                        </div>
                    </div>
                
                
                    </div>

                    <div class="warning-text">
                        <p>There are no lots that match the search criteria. Please change your search criteria and try again.</p>
                    </div>

                    <div id="lot-list-buyer-status-top" class="alert alert-info highbid-alert">
                        <div class="row">
                            <div class="col-12 col-sm-12 col-md-5 col-lg-5 text-center p-x">
                                <h4 class="m-y-0">
                                    Winning "High Bid" Total:
                                    <span id="lot-list-buyer-status-top-high-bid-total">0.00</span>
                                </h4>
                            </div>
                            <div class="col-12 col-sm-12 col-md-5 col-lg-5 text-center p-x">
                                <h4 class="m-y-0">
                                    Winning "Your Max Bid" Total:
                                    <span id="lot-list-buyer-status-top-bid-max-total">0.00</span>
                                </h4>
                            </div>
                            <div class="col-12 col-sm-12 col-md-2 col-lg-2 text-center p-x print-hidden">
                                <a id="lot-list-buyer-status-top-winning" href="#" class="btn btn-xs lot-status lot-status-winning" title="Winning Bids">0</a>
                                <a id="lot-list-buyer-status-top-pending" href="#" class="btn btn-xs lot-status lot-status-pending" title="Sealed and Pending Bids">0</a>
                                <a id="lot-list-buyer-status-top-losing" href="#" class="btn btn-xs lot-status lot-status-losing" title="Losing and Declined Bids">0</a>
                                <a id="lot-list-buyer-status-top-watching" href="#" class="btn btn-xs lot-status lot-status-watching" title="Watched Lots">0</a>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </section>

    <!--- End of Auction Tab --->
        
    <!--- End of Auctions List --->
    @endsection