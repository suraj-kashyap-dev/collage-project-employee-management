<?php

namespace App\Http\Controllers;

use App\Models\OverTime;
use Illuminate\Http\Request;
use App\Models\Employee;
use DateTime;


class OverTimeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = Employee::all();

        return view('admin.attendance.overtime', compact('employees'));
    }

    public static function overTime(Employee $employee)
    {
        $current_t = new DateTime(date('H:i:s'));
        $start_t = new DateTime($employee->schedules->first()->time_out);
        $difference = $start_t->diff($current_t)->format('%H:%I:%S');

        $overtime = new Overtime();
        $overtime->emp_id = $employee->id;
        $overtime->duration = $difference;
        $overtime->overtime_date = date('Y-m-d');
        $overtime->save();
    }
}
