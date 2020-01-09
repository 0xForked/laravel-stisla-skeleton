{!! Form::open(array('route' => 'account.restore-activity', 'method' => 'POST', 'class' => 'mb-0')) !!}
    {!! Form::button('<i class="fas fa-history fa-fw" aria-hidden="true"></i>' . ' Restore All', array('type' => 'button', 'class' => 'text-success dropdown-item', 'data-toggle' => 'modal', 'data-target' => '#confirmRestore', 'data-title' => 'Restore Cleared Activity Log','data-message' => 'Are you sure you want to restore the cleared activity logs?')) !!}
{!! Form::close() !!}
