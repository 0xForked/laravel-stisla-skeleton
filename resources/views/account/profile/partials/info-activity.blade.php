    <div class="col-12 col-md-6">
        <div class="card h-100">
            <div class="card-header">
                <h4>Last Activity</h4>
            </div>
            <div class="card-body">
                 <table class="w-100">
                    <tbody>
                        @if ($activities_count < 1)
                            Access log activities not available
                        @endif
                        @foreach ($activities as $activity)
                            <tr>
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
                                    Action
                                    <span class="badge badge-{{ $methodClass }}">
                                        {{ $activity->methodType }}
                                    </span>
                                    on <span href="#" class="badge badge-light">{{ clean_route_url($activity->route) }}</span>
                                    @php
                                        $eventTime = \Carbon\Carbon::parse($activity->created_at);
                                        $timePassed = $eventTime->diffForHumans();
                                    @endphp
                                    at  {{ $timePassed }}

                                </td>
                            </tr>
                        @endforeach
                    <tbody>

                </table>

            </div>
            <div class="card-footer bg-whitesmoke">
                <a href="{{ route('account.activity') }}"> Show all activities ({{$activities_count}}) </a>
            </div>
        </div>
    </div>