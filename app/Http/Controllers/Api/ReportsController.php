<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CallRequest;
use App\Http\Requests\Api\ReportRequest;
use App\Models\Call;
use App\Models\Report;

class ReportsController extends Controller
{

    //交换微信号
    public function create(ReportRequest $request, Report $report)
    {
        $report->fill($request->all());
        $report->user_id = $this->user->id;
        $report->save();
        return $this->returnData();
    }
}
