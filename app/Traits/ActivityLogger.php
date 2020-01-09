<?php

namespace App\Traits;

use App\Models\Activity\Access;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Request;
use Jaybizzle\LaravelCrawlerDetect\Facades\LaravelCrawlerDetect as Crawler;
use Validator;

trait ActivityLogger
{

    /**
     * Laravel Logger.
     *
     * @param string $description
     *
     * @return void
     */
    public static function activity($description = null)
    {
        $userType = Lang::get('activity.userTypes.guest');
        $userId = null;
        if (Auth::check()) {
            $userType = Lang::get('activity.userTypes.registered');
            $userId = Request::user()->id;
        }
        if (Crawler::isCrawler()) {
            $userType = Lang::get('activity.userTypes.crawler');
            $description = $userType.' '.Lang::get('activity.verbTypes.crawled').' '.Request::fullUrl();
        }
        if (!$description) {
            switch (strtolower(Request::method())) {
                case 'post':
                    $verb = Lang::get('activity.verbTypes.created');
                    break;
                case 'patch':
                case 'put':
                    $verb = Lang::get('activity.verbTypes.edited');
                    break;
                case 'delete':
                    $verb = Lang::get('activity.verbTypes.deleted');
                    break;
                case 'get':
                default:
                    $verb = Lang::get('activity.verbTypes.viewed');
                    break;
            }
            $description = $verb.' '.Request::path();
        }
        $data = [
            'description'   => $description,
            'userType'      => $userType,
            'userId'        => $userId,
            'route'         => Request::fullUrl(),
            'ipAddress'     => Request::ip(),
            'userAgent'     => Request::header('user-agent'),
            'locale'        => Request::header('accept-language'),
            'referer'       => Request::header('referer'),
            'methodType'    => Request::method(),
        ];
        // Validation Instance
        $validator = Validator::make($data, Access::Rules([]));
        if ($validator->fails()) {
            $errors = self::prepareErrorMessage($validator->errors(), $data);
            if (env('APP_ACCESS_LOG')) {
                Log::error('Failed to record activity event. Failed Validation: '.$errors);
            }
        } else {
            self::storeActivity($data);
        }
    }

    /**
     * Store activity entry to database.
     *
     * @param array $data
     *
     * @return void
     */
    private static function storeActivity($data)
    {
        Access::create([
            'description'   => $data['description'],
            'userType'      => $data['userType'],
            'userId'        => $data['userId'],
            'route'         => $data['route'],
            'ipAddress'     => $data['ipAddress'],
            'userAgent'     => $data['userAgent'],
            'locale'        => $data['locale'],
            'referer'       => $data['referer'],
            'methodType'    => $data['methodType'],
        ]);
    }

    /**
     * Prepare Error Message (add the actual value of the error field).
     *
     * @param $validator
     * @param $data
     *
     * @return string
     */
    private static function prepareErrorMessage($validatorErrors, $data)
    {
        $errors = json_decode(json_encode($validatorErrors, true));
        array_walk($errors, function (&$value, $key) use ($data) {
            array_push($value, "Value: $data[$key]");
        });
        return json_encode($errors, true);
    }
}