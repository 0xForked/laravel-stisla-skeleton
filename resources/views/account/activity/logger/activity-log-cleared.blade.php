@extends('layouts._body.activity')

@include('account.activity.partials.styles')

@section('template_title', 'Cleared Activity Logs')

@php
    $containerClass = 'card';
    $containerHeaderClass = 'card-header';
    $containerBodyClass = 'card-body';
    $bootstrapCardClasses = '';
@endphp

@section('content')

    <div class="container-fluid">

        @include('account.activity.partials.form-status')

        <div class="row">
            <div class="col-sm-12">
                <div class="{{ $containerClass }} {{ $bootstrapCardClasses }}">
                    <div class="{{ $containerHeaderClass }}">
                        <div style="display: flex; justify-content: space-between; align-items: center;" class="w-100">
                            <span>
                                Cleared Activity Logs
                                <sup class="label">
                                    {{ $totalActivities }} Cleared Events
                                </sup>
                            </span>
                            <div class="btn-group pull-right btn-group-xs">
                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-ellipsis-v fa-fw" aria-hidden="true"></i>
                                    <span class="sr-only">
                                        Activity Log Menu
                                    </span>
                                </button>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a href="{{route('account.activity')}}" class="dropdown-item text-dark">
                                        <span class="text-primary">
                                            <i class="fa fa-fw fa-mail-reply" aria-hidden="true"></i>
                                            Back to Activity Log
                                        </span>
                                    </a>
                                    @if($totalActivities)
                                        @include('account.activity.forms.delete-activity-log')
                                        @include('account.activity.forms.restore-activity-log')
                                    @endif
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
    @include('account.activity.modals.confirm-modal', ['formTrigger' => 'confirmRestore', 'modalClass' => 'success', 'actionBtnIcon' => 'fas fa-check'])

@endsection

@section('custom-script')
    @include('account.activity.partials.scripts', ['activities' => $activities])
    @include('account.activity.scripts.confirm-modal', ['formTrigger' => '#confirmDelete'])
    @include('account.activity.scripts.confirm-modal', ['formTrigger' => '#confirmRestore'])

    @include('account.activity.scripts.clickable-row')
    @include('account.activity.scripts.tooltip')
@endsection
