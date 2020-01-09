<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Auth;
use App\Models\Activity\Login as LoginActivity;
use App\Models\Activity\Access as AccessActivity;

class UserRepository
{

    protected $accessActivity;

    protected $loginActivity;

    public function __construct(
        AccessActivity $accessActivity,
        LoginActivity $loginActivity
    ) {
        $this->AccessActivity = $accessActivity;
        $this->loginActivity = $loginActivity;
    }

    public function getAccessActivity($userId, $limit)
    {
        return $this->AccessActivity->where('userId', $userId)
                    ->orderBy('created_at', 'desc')
                    ->limit($limit)
                    ->get();
    }

    public function getAccessActivityCount()
    {
        return $this->AccessActivity->where('userId', Auth::user()->id)->get()->count();
    }

    /**
     * Get Cleared (Soft Deleted) Activity - Helper Method.
     *
     * @param int $id
     *
     */
    public function getClearedActivity($id)
    {
        $activity = $this->AccessActivity->onlyTrashed()->where('id', $id)->get();
        if (count($activity) != 1) {
            return abort(404);
        }
        return $activity[0];
    }

    /**
     * Search the activity log according to specific criteria.
     *
     * @param query
     * @param request
     *
     * @return filtered query
     */
    public function searchAccessActivityLog($query, $request)
    {
        if (in_array('description', explode(',', config('app.accessLogSearchFields'))) && $request->get('description')) {
            $query->where('description', 'like', '%'.$request->get('description').'%');
        }
        if (in_array('user', explode(',', config('app.accessLogSearchFields'))) && $request->get('user')) {
            $query->where('userId', '=', $request->get('user'));
        }
        if (in_array('method', explode(',', config('app.accessLogSearchFields'))) && $request->get('method')) {
            $query->where('methodType', '=', $request->get('method'));
        }
        if (in_array('route', explode(',', config('app.accessLogSearchFields'))) && $request->get('route')) {
            $query->where('route', 'like', '%'.$request->get('route').'%');
        }
        if (in_array('ip', explode(',', config('app.accessLogSearchFields'))) && $request->get('ip_address')) {
            $query->where('ipAddress', 'like', '%'.$request->get('ip_address').'%');
        }
        return $query;
    }

}
