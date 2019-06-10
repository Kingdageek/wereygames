  <div class="row gutters-tiny">
   <!-- Earnings -->
        <div class="col-md-6 col-xl-3">
                            <a class="block block-rounded block-transparent bg-gd-elegance" href="{{ route('admin.stories') }}">
                                <div class="block-content block-content-full block-sticky-options">
                                    <div class="block-options">
                                        <div class="block-options-item">
                                            <i class="fa fa-area-chart text-white-op"></i>
                                        </div>
                                    </div>
                                    <div class="py-20 text-center">
                                        <div class="font-size-h2 font-w700 mb-0 text-white js-count-to-enabled" data-toggle="countTo" data-to="{{ $data['totalStories'] }}" data-before="">{{ $data['totalStories'] }}</div>
                                        <div class="font-size-sm font-w600 text-uppercase text-white-op">Total Stories</div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <!-- END Earnings -->

                        <!-- Orders -->
                        <div class="col-md-6 col-xl-3">
                            <a class="block block-rounded block-transparent bg-gd-dusk" href="#">
                                <div class="block-content block-content-full block-sticky-options">
                                    <div class="block-options">
                                        <div class="block-options-item">
                                            <i class="fa fa-archive text-white-op"></i>
                                        </div>
                                    </div>
                                    <div class="py-20 text-center">
                                        <div class="font-size-h2 font-w700 mb-0 text-white js-count-to-enabled" data-toggle="countTo" data-to="{{ $data['totalViewsStories'] }}">{{ $data['totalViewsStories'] }}</div>
                                        <div class="font-size-sm font-w600 text-uppercase text-white-op">Total Stories Views</div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <!-- END Orders -->

                        <!-- New Customers -->
                        <div class="col-md-6 col-xl-3">
                            <a class="block block-rounded block-transparent bg-gd-sea" href="#">
                                <div class="block-content block-content-full block-sticky-options">
                                    <div class="block-options">
                                        <div class="block-options-item">
                                            <i class="fa fa-area-chart text-white-op"></i>
                                        </div>
                                    </div>
                                    <div class="py-20 text-center">
                                        <div class="font-size-h2 font-w700 mb-0 text-white js-count-to-enabled" data-toggle="countTo" data-to="{{ $data['totalUserStories'] }}">{{ $data['totalUserStories'] }}</div>
                                        <div class="font-size-sm font-w600 text-uppercase text-white-op">Total User Stories</div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <!-- END New Customers -->

                        <!-- Conversion Rate -->
                        <div class="col-md-6 col-xl-3">
                            <a class="block block-rounded block-transparent bg-gd-aqua" href="javascript:void(0)">
                                <div class="block-content block-content-full block-sticky-options">
                                    <div class="block-options">
                                        <div class="block-options-item">
                                            <i class="fa fa-archive text-white-op"></i>
                                        </div>
                                    </div>
                                    <div class="py-20 text-center">
                                        <div class="font-size-h2 font-w700 mb-0 text-white js-count-to-enabled" data-toggle="countTo" data-to="{{ $data['totalViewsUserStories'] }}">{{ $data['totalViewsUserStories'] }}</div>
                                        <div class="font-size-sm font-w600 text-uppercase text-white-op">Total User Stories Views</div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <!-- END Conversion Rate -->

                        <!-- Wordgroups -->
                        <div class="col-md-6 col-xl-3">
                            <a class="block block-rounded block-transparent bg-gd-elegance" href="{{ route('admin.wordgroups.index') }}">
                                <div class="block-content block-content-full block-sticky-options">
                                    <div class="block-options">
                                        <div class="block-options-item">
                                            <i class="fa fa-area-chart text-white-op"></i>
                                        </div>
                                    </div>
                                    <div class="py-20 text-center">
                                        <div class="font-size-h2 font-w700 mb-0 text-white js-count-to-enabled" data-toggle="countTo" data-to="{{ $data['totalWordgroups'] }}" data-before="">{{ $data['totalWordgroups'] }}</div>
                                        <div class="font-size-sm font-w600 text-uppercase text-white-op">Total Wordgroups</div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <!-- END Earnings -->

                        <!-- Orders -->
                        <div class="col-md-6 col-xl-3">
                            <a class="block block-rounded block-transparent bg-gd-dusk" href="{{ route('admin.wereywords.index') }}">
                                <div class="block-content block-content-full block-sticky-options">
                                    <div class="block-options">
                                        <div class="block-options-item">
                                            <i class="fa fa-archive text-white-op"></i>
                                        </div>
                                    </div>
                                    <div class="py-20 text-center">
                                        <div class="font-size-h2 font-w700 mb-0 text-white js-count-to-enabled" data-toggle="countTo" data-to="{{ $data['totalWereywords'] }}">{{ $data['totalWereywords'] }}</div>
                                        <div class="font-size-sm font-w600 text-uppercase text-white-op">Total Wereywords</div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <!-- END Orders -->

                    </div>
