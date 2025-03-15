<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Depart;
use App\Models\Employee;
use Illuminate\Http\Request;

class CheckController extends Controller
{
    public function CheckStore(Request $request)
    {
        if (isset($request->attd)) {
            foreach ($request->attd as $keys => $values) {
                foreach ($values as $key => $value) {
                    if ($employee = Employee::whereId(request('employee_id'))->first()) {

                        $isFriday = \Carbon\Carbon::createFromFormat('Y-m-d', $keys)->isFriday();

                        $checkboxValue = $request->has("attd.$keys.$key") ? 1 : 0;
                        if (
                            !Attendance::whereAttendance_date($keys)
                                ->whereEmployee_id($key)
                                ->whereType(0)
                                ->first()
                        ) {
                            $data = new Attendance();
                            
                            $data->employee_id = $key;
                            $emp_req = Employee::whereId($data->employee_id)->first();
                            $data->attendance_time = date('H:i:s', strtotime($emp_req->schedule->first()->time_in));
                            $data->attendance_date = $keys;

                            $data->status = $isFriday && $checkboxValue === 0 ? null : $checkboxValue;

                            $data->save();
                        }
                    }
                }
            }
        }
        if (isset($request->depart)) {
            foreach ($request->depart as $keys => $values) {
                foreach ($values as $key => $value) {
                    if ($employee = Employee::whereId(request('employee_id'))->first()) {
                        if (
                            !Depart::whereDepart_date($keys)
                                ->whereEmployee_id($key)
                                ->whereType(1)
                                ->first()
                        ) {
                            $data = new Depart();
                            $data->employee_id = $key;
                            $emp_req = Employee::whereId($data->employee_id)->first();
                            $data->depart_time = $emp_req->schedule->first()->time_out;
                            $data->depart_date = $keys;
                            if ($employee->schedule->first()->time_out <= $data->depart_time) {
                                $data->status = 1;
                            } else {
                                $data->status = null;
    
                            }
                            
                            $data->save();
                        }
                    }
                }
            }
        }

        return back();
    }

    public function sheetReport()
    {

    return view('admin.attendance.report')->with(['employees' => Employee::all()]);
    }
}
