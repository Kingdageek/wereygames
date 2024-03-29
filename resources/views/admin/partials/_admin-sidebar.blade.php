    <nav id="sidebar">
      <!-- Sidebar Scroll Container -->
        <div id="sidebar-scroll">
          <!-- Sidebar Content -->
                    <div class="sidebar-content">
                       <!-- Side Header -->
                        <div class="content-header content-header-fullrow px-15">
                            <!-- Mini Mode -->
                            <div class="content-header-section sidebar-mini-visible-b">
                                <!-- Logo -->
                                <span class="content-header-item font-w700 font-size-xl float-left animated fadeIn">
                                    <span class="text-dual-primary-dark">c</span><span class="text-primary">b</span>
                                </span>
                                <!-- END Logo -->
                            </div>
                            <!-- END Mini Mode -->

                            <!-- Normal Mode -->
                            <div class="content-header-section text-center align-parent sidebar-mini-hidden">
                                <!-- Close Sidebar, Visible only on mobile screens -->
                                <!-- Layout API, functionality initialized in Codebase() -> uiApiLayout() -->
                                <button type="button" class="btn btn-circle btn-dual-secondary d-lg-none align-v-r" data-toggle="layout" data-action="sidebar_close">
                                    <i class="fa fa-times text-danger"></i>
                                </button>

                                <div class="content-header-item">
                                    <a class="link-effect font-w700" href="{{ route('admin.dashboard') }}">
                                        <span class="font-size-xl text-dual-primary-dark">{{ config('app.name', 'Werey Games') }}</span>
                                    </a>
                                </div>
                                <!-- END Logo -->
                            </div>
                            <!-- END Normal Mode -->
                        </div>
                        <!-- END Side Header -->

                        <div class="content-side content-side-full bg-body-light">
                            {{-- <a href="{{ route('admin.story.create') }}" class="btn btn-sm btn-block btn-hero btn-alt-primary">
                                <i class="si si-docs mr-5"></i> New Story
                            </a> --}}
                            <a href="{{ route('admin.stories.createStory') }}" class="btn btn-sm btn-block btn-hero btn-alt-primary">
                                <i class="si si-docs mr-5"></i> New Story
                            </a>
                        </div>

                        <!-- Side Navigation -->
                        <div class="content-side content-side-full">
                            <ul class="nav-main">
                                <li>
                                    <a class="active" href="{{ route('admin.dashboard') }}">
                                    <i class="si si-cup"></i><span class="sidebar-mini-hide">Dashboard</span></a>
                                </li>
                                <li>
                                    <a class="active" href="{{ route('admin.stories') }}">
                                    <i class="si si-docs"></i><span class="sidebar-mini-hide">Stories</span></a>
                                </li>
                                @if ( auth()->user()->is_admin )
                                <li>
                                    <a class="active" href="{{ route('admin.users') }}">
                                    <i class="si si-users"></i><span class="sidebar-mini-hide">Admin Users</span></a>
                                </li>
                                <li>
                                    <a class="active" href="{{ route('admin.settings.index') }}">
                                    <i class="si si-settings"></i><span class="sidebar-mini-hide">Settings</span></a>
                                </li>
                                @endif
                                <li>
                                    <a class="active" href="{{ route('admin.wordgroups.index') }}">
                                    <i class="si si-docs"></i><span class="sidebar-mini-hide">Wordgroups</span></a>
                                </li>
                                <li>
                                    <a class="active" href="{{ route('admin.wereywords.index') }}">
                                    <i class="si si-docs"></i><span class="sidebar-mini-hide">Wereywords</span></a>
                                </li>
                                <li>
                                    <a class="active" href="{{ route('admin.wereyimages.index') }}">
                                    <i class="si si-docs"></i><span class="sidebar-mini-hide">Wereyimages</span></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>
