{!! Form::open(array('route' => 'account.clear-activity')) !!}
    {!! Form::hidden('_method', 'DELETE') !!}
    {!! Form::button('<i class="fas fa-fw fa-trash" aria-hidden="true"></i>' . 'Clear Activity Log', array('type' => 'button', 'data-toggle' => 'modal', 'data-target' => '#confirmDelete', 'data-title' => 'Clear Activity Log','data-message' => 'Are you sure you want to clear the activity log?', 'class' => 'dropdown-item')) !!}
{!! Form::close() !!}
