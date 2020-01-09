@if (count($activities) > 10)
    @include('account.activity.scripts.datatables')
@endif

@include('account.activity.scripts.add-title-attribute')
