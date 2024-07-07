<div class="sidebar sidebar-style-2">
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <ul class="nav nav-primary">
                <li class="nav-item active">
                    <a href="{{url('/qfd-dashboard')}}">
                        <i class="fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                </li>
                <li class="nav-item">
                    <a href="{{url('/quality-for-delivery')}}">
                        <i class="fas fa-th-list"></i>
                        <p>Quality For Delivery</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a data-toggle="collapse" href="#base" class="collapsed" aria-expanded="false">
                        <i class="fas fa-layer-group"></i>
                        <p>Master Data</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="base" style="">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="{{url('/management-end-customer')}}">
                                    <span class="sub-item">Management End Customer</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{url('/management-pic-product')}}">
                                    <span class="sub-item">Management PIC Product</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{url('/management-truck')}}">
                                    <span class="sub-item">Management Truck</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>
        {{-- <div class="sidebar-content"> --}}
            {{-- <ul class="nav nav-primary">
                @foreach ($data['listmenu'] as $i => $rows)
                    @if ($rows['main'] != null || $rows['main'] != '')
                        <li class="nav-item">
                            <a data-toggle="collapse" href="#{{ $rows['main'] }}" class="collapsed" aria-expanded="false">
                                <i class="fa fa-sliders white_color"></i>
                                <p>{{ $rows['main'] }}</p>
                                <span class="caret"></span>
                            </a>
                            <div class="collapse" id="{{ $rows['main'] }}">
                                <ul class="nav nav-collapse">
                                    @foreach ($data['listmenu'][$i]['menu'] as $row)
                                        <li>
                                            <a href="{{ url($row['menu_link']) }}">
                                                <span class="sub-item">{{ $row['app_menu'] }}</span>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </li>
                    @else
                        @foreach ($data['listmenu'][$i]['menu'] as $row)
                            <li class="nav-item">
                                <a href="{{ url($row['menu_link']) }}">
                                    <i class="{{ $row['icon'] }}"></i>
                                    <p>{{ $row['app_menu'] }}</p>
                                </a>
                            </li>
                        @endforeach
                    @endif
                @endforeach --}}
                {{-- <li class="nav-item active">
                    <a  href="#dashboard" aria-expanded="false">
                        <i class="fas fa-home"></i>
                        <p>Dashboard</p>
                        
                    </a>
                    
                </li>

                <li class="nav-item">
                    <a data-toggle="collapse" href="#base">
                        <i class="fas fa-layer-group"></i>
                        <p>Master Data</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="base">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="components/avatars.html">
                                    <span class="sub-item">Avatars</span>
                                </a>
                            </li>
                            <li>
                                <a href="components/buttons.html">
                                    <span class="sub-item">Buttons</span>
                                </a>
                            </li>
                            <li>
                                <a href="components/gridsystem.html">
                                    <span class="sub-item">Grid System</span>
                                </a>
                            </li>
                            <li>
                                <a href="components/panels.html">
                                    <span class="sub-item">Panels</span>
                                </a>
                            </li>
                            <li>
                                <a href="components/notifications.html">
                                    <span class="sub-item">Notifications</span>
                                </a>
                            </li>
                            <li>
                                <a href="components/sweetalert.html">
                                    <span class="sub-item">Sweet Alert</span>
                                </a>
                            </li>
                            <li>
                                <a href="components/font-awesome-icons.html">
                                    <span class="sub-item">Font Awesome Icons</span>
                                </a>
                            </li>
                            <li>
                                <a href="components/simple-line-icons.html">
                                    <span class="sub-item">Simple Line Icons</span>
                                </a>
                            </li>
                            <li>
                                <a href="components/flaticons.html">
                                    <span class="sub-item">Flaticons</span>
                                </a>
                            </li>
                            <li>
                                <a href="components/typography.html">
                                    <span class="sub-item">Typography</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a  href="#dashboard" aria-expanded="false">
                        <i class="fas fa-home"></i>
                        <p>Meeting QFD</p>
                        
                    </a>
                </li>

                <li class="nav-item">
                    <a data-toggle="collapse" href="#sidebarLayouts">
                        <i class="fas fa-th-list"></i>
                        <p>Report</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="sidebarLayouts">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="sidebar-style-1.html">
                                    <span class="sub-item">Sidebar Style 1</span>
                                </a>
                            </li>
                            <li>
                                <a href="overlay-sidebar.html">
                                    <span class="sub-item">Overlay Sidebar</span>
                                </a>
                            </li>
                            <li>
                                <a href="compact-sidebar.html">
                                    <span class="sub-item">Compact Sidebar</span>
                                </a>
                            </li>
                            <li>
                                <a href="static-sidebar.html">
                                    <span class="sub-item">Static Sidebar</span>
                                </a>
                            </li>
                            <li>
                                <a href="icon-menu.html">
                                    <span class="sub-item">Icon Menu</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li> --}}

                {{--
            </ul>
        </div>
    </div>
</div>
