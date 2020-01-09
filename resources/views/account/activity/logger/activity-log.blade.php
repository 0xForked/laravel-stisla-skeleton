@extends('layouts._body.activity')

@include('account.activity.partials.styles')

@section('template_title', 'Activity Log')

@php
$containerClass = 'card';
$containerHeaderClass = 'card-header';
$containerBodyClass = 'card-body';
$bootstrapCardClasses = '';
@endphp

@section('content')

<div class="container-fluid">
   @include('account.activity.partials.form-search')
   @include('account.activity.partials.form-status')

   <div class="row">
    <div class="col-sm-12">
        <div class="{{ $containerClass }} {{ $bootstrapCardClasses }}">
            <div class="{{ $containerHeaderClass }}">
                <div style="display: flex; justify-content: space-between; align-items: center;" class="w-100">

                    <span>
                        Activity Log
                        <small>
                            <sup class="label label-default">
                                {{ $totalActivities }} Events
                            </sup>
                        </small>
                    </span>

                    <div class="btn-group pull-right btn-group-xs">
                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-ellipsis-v fa-fw" aria-hidden="true"></i>
                            <span class="sr-only">
                                Activity Log Menu
                            </span>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right">
                            @include('account.activity.forms.clear-activity-log')
                            <a href="{{route('account.cleared')}}" class="dropdown-item">
                                <i class="fa fa-fw fa-history" aria-hidden="true"></i>
                                Show Cleared Logs
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="{{ $containerBodyClass }}">
                @include('account.activity.logger.partials.activity-table', ['activities' => $activities, 'hoverable' => true])
            </div>
        </div>
    </div>
</div>
</div>

@include('account.activity.modals.confirm-modal', ['formTrigger' => 'confirmDelete', 'modalClass' => 'danger', 'actionBtnIcon' => 'fas fa-trash'])

@endsection

@section('custom-script')
    @include('account.activity.partials.scripts', ['activities' => $activities])
    @include('account.activity.scripts.confirm-modal', ['formTrigger' => '#confirmDelete'])

    @include('account.activity.scripts.clickable-row')
    @include('account.activity.scripts.tooltip')
@endsection
