<?php

namespace App\Http\Controllers\Account;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use App\Traits\IpAddressDetails;
use App\Traits\UserAgentDetails;
use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
use App\Models\Activity\Access as AccessLogActivity;
use Illuminate\Foundation\Validation\ValidatesRequests;

class ActivityController extends Controller
{

    use IpAddressDetails, UserAgentDetails, ValidatesRequests;

    protected $repository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $activities = AccessLogActivity::where('userId', Auth::user()->id)
                                    ->orderBy('created_at', 'desc');

        if (config('app.accessLogEnableSearch')) {
            $activities = $this->repository->searchAccessActivityLog($activities, $request);
        }

        $activities = $activities->paginate(config('app.accessLogPaginationPerPage'));
        $totalActivities = $activities->total();

        self::mapAdditionalDetails($activities);

        $users = User::all();

        $data = [
            'activities'        => $activities,
            'totalActivities'   => $totalActivities,
            'users'             => $users,
        ];

        return View('account.activity.logger.activity-log', $data);
    }

    /**
     * Show an individual activity log entry.
     *
     * @param Request $request
     * @param int     $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $activity = AccessLogActivity::where('userId', Auth::user()->id)->findOrFail($id);
        $userDetails = User::find($activity->userId);
        $userAgentDetails = UserAgentDetails::details($activity->useragent);
        $ipAddressDetails = IpAddressDetails::checkIP($activity->ipAddress);
        $langDetails = UserAgentDetails::localeLang($activity->locale);
        $eventTime = Carbon::parse($activity->created_at);
        $timePassed = $eventTime->diffForHumans();

        $userActivities = AccessLogActivity::where('userId', $activity->userId)
            ->orderBy('created_at', 'desc')
            ->paginate(config('app.accessLogPaginationPerPage'));
        $totalUserActivities = $userActivities->total();

        self::mapAdditionalDetails($userActivities);

        $data = [
            'activity'              => $activity,
            'userDetails'           => $userDetails,
            'ipAddressDetails'      => $ipAddressDetails,
            'timePassed'            => $timePassed,
            'userAgentDetails'      => $userAgentDetails,
            'langDetails'           => $langDetails,
            'userActivities'        => $userActivities,
            'totalUserActivities'   => $totalUserActivities,
            'isClearedEntry'        => false,
        ];

        return View('account.activity.logger.activity-log-item', $data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function clearActivityLog()
    {
        $activities = AccessLogActivity::where('userId', Auth::user()->id)->get();
        foreach ($activities as $activity) {
            $activity->delete();
        }
        return redirect('account/activity')->with('success', 'Success clear activity');
    }

    /**
     * Show the cleared activity log - soft deleted records.
     *
     * @return \Illuminate\Http\Response
     */
    public function showClearedActivityLog()
    {
        $activities = AccessLogActivity::where('userId', Auth::user()->id)->onlyTrashed()
            ->orderBy('created_at', 'desc')
            ->paginate(config('app.accessLogPaginationPerPage'));
        $totalActivities = $activities->total();

        self::mapAdditionalDetails($activities);
        $data = [
            'activities'        => $activities,
            'totalActivities'   => $totalActivities,
        ];
        return View('account.activity.logger.activity-log-cleared', $data);
    }


    /**
     * Show an individual cleared (soft deleted) activity log entry.
     *
     * @param Request $request
     * @param int     $id
     *
     * @return \Illuminate\Http\Response
     */
    public function showClearedAccessLogEntry(Request $request, $id)
    {
        $activity = $this->repository->getClearedActivity($id);
        $userDetails = User::find($activity->userId);
        $userAgentDetails = UserAgentDetails::details($activity->useragent);
        $ipAddressDetails = IpAddressDetails::checkIP($activity->ipAddress);
        $langDetails = UserAgentDetails::localeLang($activity->locale);
        $eventTime = Carbon::parse($activity->created_at);
        $timePassed = $eventTime->diffForHumans();
        $data = [
            'activity'              => $activity,
            'userDetails'           => $userDetails,
            'ipAddressDetails'      => $ipAddressDetails,
            'timePassed'            => $timePassed,
            'userAgentDetails'      => $userAgentDetails,
            'langDetails'           => $langDetails,
            'isClearedEntry'        => true,
        ];
        return View('account.activity.logger.activity-log-item', $data);
    }

    /**
     * Destroy the specified resource from storage.
     *
     */
    public function destroyAccessActivityLog()
    {
        $activities = AccessLogActivity::where('userId', Auth::user()->id)->onlyTrashed()->get();
        foreach ($activities as $activity) {
            $activity->forceDelete();
        }
        return redirect('account/activity')->with('success', 'Success permanently delete cleared activity');
    }

    /**
     * Restore the specified resource from soft deleted storage.
     *
     */
    public function restoreClearedAccessActivityLog()
    {
        $activities = AccessLogActivity::where('userId', Auth::user()->id)->onlyTrashed()->get();
        foreach ($activities as $activity) {
            $activity->restore();
        }
        return redirect('account/activity')->with('success','Success restore all cleared activity');
    }

    /**
     * Add additional details to a collections.
     *
     * @param collection $collectionItems
     *
     * @return collection
     */
    private function mapAdditionalDetails($collectionItems)
    {
        $collectionItems->map(function ($collectionItem) {
            $eventTime = Carbon::parse($collectionItem->updated_at);
            $collectionItem['timePassed'] = $eventTime->diffForHumans();
            $collectionItem['userAgentDetails'] = UserAgentDetails::details($collectionItem->useragent);
            $collectionItem['langDetails'] = UserAgentDetails::localeLang($collectionItem->locale);
            $collectionItem['userDetails'] = User::find($collectionItem->userId);
            return $collectionItem;
        });
        return $collectionItems;
    }
}
