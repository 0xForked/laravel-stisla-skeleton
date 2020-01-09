    <div class="col-12 col-md-6">
        <div class="card h-100">
            <div class="card-header">
                <h4>Last login</h4>
            </div>

            <div class="card-body bg-whitesmoke">
                @if (login_activity())
                    <p>
                        <b> {{login_activity()->ip_address}} </b>
                        <span>
                            ({{ date('D, M Y', strtotime(login_activity()->created_at)) }}) -
                        </span>
                        @php
                            $userAgentDetails = user_agent_details(login_activity()->user_agent);
                            $platform       = $userAgentDetails['platform'];
                            $browser        = $userAgentDetails['browser'];
                            $browserVersion = $userAgentDetails['version'];

                            switch ($platform) {
                                case 'Windows':
                                    $platformIcon = 'fab fa-windows';
                                    break;
                                case 'iPad':
                                    $platformIcon = 'fas fa-apple-alt';
                                    break;

                                case 'iPhone':
                                    $platformIcon = 'fas fa-apple-alt';
                                    break;

                                case 'Macintosh':
                                    $platformIcon = 'fas fa-apple-alt';
                                    break;

                                case 'Android':
                                    $platformIcon = 'fab fa-android';
                                    break;

                                case 'Linux':
                                    $platformIcon = 'fab fa-linux';
                                    break;

                                default:
                                    $platformIcon = 'fa-';
                                    break;
                            }

                            switch ($browser) {
                                case 'Chrome':
                                    $browserIcon  = 'fab fa-chrome';
                                    break;
                                case 'Firefox':
                                    $browserIcon  = 'fab fa-firefox';
                                    break;
                                case 'Opera':
                                    $browserIcon  = 'fab fa-opera';
                                    break;
                                case 'Safari':
                                    $browserIcon  = 'fab fa-safari';
                                    break;
                                case 'Internet Explorer':
                                    $browserIcon  = 'fab fa-internet-explore';
                                    break;
                                case 'Edge':
                                    $browserIcon  = 'fab fa-edge';
                                    break;
                                default:
                                    $browserIcon  = 'fa-';
                                    break;
                            }
                        @endphp
                        <i class="{{ $browserIcon }} fa-fw" aria-hidden="true">
                            <span class="sr-only">
                                {{ $browser }}
                            </span>
                        </i>
                        <sup>
                            <small>
                                {{ $browserVersion }}
                            </small>
                        </sup>
                        <i class="{{ $platformIcon }} fa-fw" aria-hidden="true">
                            <span class="sr-only">
                                {{ $platform }}
                            </span>
                        </i>
                        <br>
                        Details: {{login_activity()->user_agent}}
                    </p>
                @else
                    <h3 class="text-center">Data Not Found</h3>
                @endif
            </div>
        </div>
    </div>