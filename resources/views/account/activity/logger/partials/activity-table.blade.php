@php

$drilldownStatus = true;
$prependUrl = '/account/activity/log/';

if (isset($hoverable) && $hoverable === true) {
    $hoverable = true;
} else {
    $hoverable = false;
}

if (Request::is('account/activity/cleared')) {
    $prependUrl = '/account/activity/cleared/log/';
}

@endphp

<div class="table-responsive activity-table">
    <table class="table table-striped table-condensed table-sm table-hover">
        <thead>
            <tr>
                <th>
                    <i class="fa fa-database fa-fw" aria-hidden="true"></i>
                    <span class="hidden-sm hidden-xs">
                        Id
                    </span>
                </th>
                <th>
                    <i class="fas fa-clock fa-fw" aria-hidden="true"></i>
                    Time
                </th>
                <th>
                    <i class="fas fa-file fa-fw" aria-hidden="true"></i>
                    Description
                </th>
                <th>
                    <i class="fas fa-user fa-fw" aria-hidden="true"></i>
                    User
                </th>
                <th>
                    <i class="fa fa-truck fa-fw" aria-hidden="true"></i>
                    <span class="hidden-sm hidden-xs">
                        Method
                    </span>
                </th>
                <th>
                    <i class="fas fa-map fa-fw" aria-hidden="true"></i>
                    Route
                </th>
                <th>
                    <i class="fa fa-map-marker fa-fw" aria-hidden="true"></i>
                    Ip <span class="hidden-sm hidden-xs">Address</span>
                </th>
                <th>
                    <i class="fa fa-laptop fa-fw" aria-hidden="true"></i>
                    <span class="hidden-sm hidden-xs">User </span>Agen
                </th>
                @if(Request::is('activity/cleared'))
                    <th>
                        <i class="fa fa-trash-o fa-fw" aria-hidden="true"></i>
                        <span class="hidden-sm hidden-xs">Date </span>Deleted
                    </th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach($activities as $activity)
                <tr @if($drilldownStatus && $hoverable) class="clickable-row" data-href="{{$prependUrl . $activity->id}}" data-toggle="tooltip" title="View Record Details" @endif >
                    <td>
                        <small>
                            @if($hoverable)
                                {{ $activity->id }}
                            @else
                                <a href="{{$prependUrl . $activity->id}}">
                                    {{ $activity->id }}
                                </a>
                            @endif
                        </small>
                    </td>
                    <td title="{{ $activity->created_at }}">
                        {{ $activity->timePassed }}
                    </td>
                    <td>
                        {{ $activity->description }}
                    </td>
                    <td>
                        @php
                            switch ($activity->userType) {
                                case 'Registered':
                                    $userTypeClass = 'success';
                                    $userLabel = $activity->userDetails['name'];
                                    break;

                                case 'Crawler':
                                    $userTypeClass = 'danger';
                                    $userLabel = $activity->userType;
                                    break;

                                case 'Guest':
                                default:
                                    $userTypeClass = 'warning';
                                    $userLabel = $activity->userType;
                                    break;
                            }

                        @endphp
                        <span class="badge badge-{{$userTypeClass}}">
                            {{$userLabel}}
                        </span>
                    </td>
                    <td>
                        @php
                            switch (strtolower($activity->methodType)) {
                                case 'get':
                                    $methodClass = 'info';
                                    break;

                                case 'post':
                                    $methodClass = 'warning';
                                    break;

                                case 'put':
                                    $methodClass = 'warning';
                                    break;

                                case 'delete':
                                    $methodClass = 'danger';
                                    break;

                                default:
                                    $methodClass = 'info';
                                    break;
                            }
                        @endphp
                        <span class="badge badge-{{ $methodClass }}">
                            {{ $activity->methodType }}
                        </span>
                    </td>
                    <td>
                        @if($hoverable)
                            {{ clean_route_url($activity->route) }}
                        @else
                            <a href="{{ $activity->route }}">
                                {{$activity->route}}
                            </a>
                        @endif
                    </td>
                    <td>
                        {{ $activity->ipAddress }}
                    </td>
                    <td>
                        @php
                            $platform       = $activity->userAgentDetails['platform'];
                            $browser        = $activity->userAgentDetails['browser'];
                            $browserVersion = $activity->userAgentDetails['version'];

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
                        <sup>
                            <small>
                                {{ $activity->langDetails }}
                            </small>
                        </sup>
                    </td>
                    @if(Request::is('activity/cleared'))
                        <td>
                            {{ $activity->deleted_at }}
                        </td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="text-center">
    <div class="d-flex justify-content-center">
        {!! $activities->render() !!}
    </div>
    <p>
        {!! trans('Showing :firstItem - :lastItem of :total results <small>(:perPage per page)</small>', ['firstItem' => $activities->firstItem(), 'lastItem' => $activities->lastItem(), 'total' => $activities->total(), 'perPage' => $activities->perPage()]) !!}
    </p>
</div>
