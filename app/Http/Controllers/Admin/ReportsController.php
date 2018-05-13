<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Api\Controller;
use App\Http\Requests\Admin\TagRequest;
use App\Http\Requests\Admin\UsersRequest;
use App\Models\Report;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    public function index(Request $request, Report $report)
    {
        $query = $report->query();

        if ($user_id = $request->user_id) {
            $query->where('user_id', $user_id);
        }
        if ($target_user_id = $request->target_user_id) {
            $query->where('target_user_id', $target_user_id);
        }
        if (isset($request->status)) {
            $query->where('status', $request->status);
        }

        $reports = $query->with('user', 'targetUser')->paginate($request->input('per_page', 20));

        return $this->returnPaginator($reports, $reports->items());
    }

    public function update(Request $request, Report $report)
    {
        $report->status = $request->status;
        $report->save();
        return $this->returnData();
    }
}
