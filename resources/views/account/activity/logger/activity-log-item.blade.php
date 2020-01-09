@extends('layouts._body.activity')

@include('account.activity.partials.styles')

@section('template_title', "Activity Log $activity->id")

@php
    $containerClass = 'card';
    $containerHeaderClass = 'card-header';
    $containerBodyClass = 'card-body';
    $bootstrapCardClasses = '';

    switch ($activity->userType) {
        case 'Registered':
            $userTypeClass = 'success';
            break;

        case 'Crawler':
            $userTypeClass = 'danger';
            break;

        case 'Guest':
        default:
            $userTypeClass = 'warning';
            break;
    }

    switch (strtolower($activity->methodType)) {
        case 'get':
            $methodClass = 'info';
            break;

        case 'post':
            $methodClass = 'primary';
            break;

        case 'put':
            $methodClass = 'caution';
            break;

        case 'delete':
            $methodClass = 'danger';
            break;

        default:
            $methodClass = 'info';
            break;
    }

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

@section('content')
<div class="container-fluid">

    @include('account.activity.partials.form-status')

    <div class="panel @if($isClearedEntry) panel-danger @else panel-default @endif">
        <div class="{{ $containerClass }} @if($isClearedEntry) panel-danger @else panel-default @endif">
        <div class="{{ $containerHeaderClass }} @if($isClearedEntry) bg-danger text-white @else @endif " >
            {!! trans('Activity Log :id', ['id' => $activity->id]) !!}
            <a href="@if($isClearedEntry) {{route('account.cleared')}} @else {{route('account.activity')}} @endif " class="ml-3 btn @if($isClearedEntry) btn-default @else btn-info @endif btn-sm float-right">
                <i class="fas fa-reply fa-fw" aria-hidden="true"></i>
                {!! '<span class="hidden-xs hidden-sm">Back to </span><span class="hidden-xs">Activity Log</span>' !!}
            </a>
        </div>
        <div class="{{ $containerBodyClass }}">
            <div class="row">
                <div class="col-xs-12 col-12">
                    <div class="row">

                        <div class="col-md-6 col-lg-4">
                            <ul class="list-group">
                                <li class="list-group-item @if($isClearedEntry) list-group-item-danger @else active @endif">
                                    {!! 'Activity Details' !!}
                                </li>
                                <li class="list-group-item">
                                    <dl class="dl-horizontal">
                                        <dt>Activity Log ID:</dt>
                                        <dd>{{$activity->id}}</dd>

                                        <dt>Description</dt>
                                        <dd>{{$activity->description}}</dd>

                                        <dt>Route</dt>
                                        <dd>
                                            <a href="@if($activity->route != '/')/@endif{{$activity->route}}">
                                                {{$activity->route}}
                                            </a>
                                        </dd>

                                        <dt>User Agent</dt>
                                        <dd>
                                            <i class="{{ $platformIcon }} fa-fw" aria-hidden="true">
                                                <span class="sr-only">
                                                    {{ $platform }}
                                                </span>
                                            </i>
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
                                        </dd>

                                        <dt>Locale</dt>
                                        <dd>
                                            {{ $langDetails }}
                                        </dd>

                                        <dt>Referer</dt>
                                        <dd>
                                            <a href="{{ $activity->referer }}">
                                                {{ $activity->referer }}
                                            </a>
                                        </dd>

                                        <dt>Method Type</dt>
                                        <dd>
                                            <span class="badge badge-{{$methodClass}}">
                                                {{ $activity->methodType }}
                                            </span>
                                        </dd>

                                        <dt>Time Passed</dd>

                                        <dt>Event Time</dt>
                                        <dd>{{$activity->created_at}}</dd>

                                    </dl>
                                </li>
                            </ul>
                            <br />
                        </div>

                        <div class="col-md-6 col-lg-4">
                            <ul class="list-group">
                                <li class="list-group-item @if($isClearedEntry) list-group-item-danger @else active @endif">
                                    Ip Address Details
                                </li>
                                <li class="list-group-item">
                                    <dl class="dl-horizontal">
                                        <dt>Ip Address</dt>
                                        <dd>{{$activity->ipAddress}}</dd>
                                        @if($ipAddressDetails)
                                            @foreach($ipAddressDetails as $ipAddressDetailKey => $ipAddressDetailValue)
                                                <dt>{{$ipAddressDetailKey}}</dt>
                                                <dd>{{$ipAddressDetailValue}}</dd>
                                            @endforeach
                                        @else
                                            <p class="text-center disabled">
                                                <br />
                                                Additional Ip Address Data Not Available.
                                            </p>
                                        @endif
                                    </dl>
                                </li>
                            </ul>

                            <br />
                        </div>

                        <div class="col-md-12 col-lg-4">
                            <ul class="list-group">
                                <li class="list-group-item @if($isClearedEntry) list-group-item-danger @else active @endif">
                                    User Details
                                </li>
                                <li class="list-group-item">
                                    <dl class="dl-horizontal">
                                        <dt>User Type</dt>
                                        <dd>
                                            <span class="badge badge-{{$userTypeClass}}">
                                                {{$activity->userType}}
                                            </span>
                                        </dd>

                                        @if($userDetails)

                                            <dt>User Id</dt>
                                            <dd>{{$userDetails->id}}</dd>
                                            <dt>User Roles</dt>

                                            @foreach ($userDetails->roles as $user_role)
                                                @if ($user_role->name == 'User')
                                                    @php $labelClass = 'primary' @endphp
                                                @elseif ($user_role->name == 'Admin')
                                                    @php $labelClass = 'warning' @endphp
                                                @elseif ($user_role->name == 'Unverified')
                                                    @php $labelClass = 'danger' @endphp
                                                @else
                                                    @php $labelClass = 'default' @endphp
                                                @endif
                                                <dd>
                                                    <span class="badge badge-{{$labelClass}}">
                                                        {{ $user_role->name }} - Level {{ $user_role->level }}
                                                    </span>
                                                </dd>
                                            @endforeach
                                            <dt>Username</dt>
                                            <dd>{{$userDetails->name}}</dd>
                                            <dt>User Email</dt>
                                            <dd>
                                                <a href="mailto:{{$userDetails->email}}">
                                                    {{$userDetails->email}}
                                                </a>
                                            </dd>
                                            @if($userDetails->last_name || $userDetails->first_name)
                                                <dt>Full Name</dt>
                                                <dd>{{$userDetails->last_name}}, {{$userDetails->first_name}}</dd>
                                            @endif
                                            @if($userDetails->signup_ip_address)
                                                <dt>Signup Ip</dt>
                                                <dd>{{$userDetails->signup_ip_address}}</dd>
                                            @endif
                                            <dt>Created</dt>
                                            <dd>{{$userDetails->created_at}}</dd>
                                            <dt>Updated</dt>
                                            <dd>{{$userDetails->updated_at}}</dd>

                                        @endif

                                    </dl>
                                </li>
                            </ul>

                            <br />
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
  </div>
@endsection

@section('custom-script')
    @include('account.activity.partials.scripts', ['activities' => $userAgentDetails])
@endsection
