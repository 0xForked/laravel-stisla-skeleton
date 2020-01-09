{!! Form::open(array('route' => 'account.destroy-activity', 'class' => 'mb-0')) !!}
    {!! Form::hidden('_method', 'DELETE') !!}
    {!! Form::button('<i class="fas fa-eraser fa-fw" aria-hidden="true"></i>' . ' Delete All', array('type' => 'button', 'class' => 'text-danger dropdown-item', 'data-toggle' => 'modal', 'data-target' => '#confirmDelete', 'data-title' => 'Permanently Delete Activity Log','data-message' => 'Are you sure you want to permanently DELETE the activity log?')) !!}
{!! Form::close() !!}
