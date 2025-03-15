<?php

namespace App\Http\Controllers;

use App\Models\LateTime;
use App\Models\Employee;
use DateTime;


class LateTimeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = Employee::all();

        return view('admin.attendance.latetime', compact('employees'));
    }

    public static function lateTime(Employee $employee)
    {
        $current_t = new DateTime(date('H:i:s'));
        $start_t = new DateTime($employee->schedules->first()->time_in);
        $difference = $start_t->diff($current_t)->format('%H:%I:%S');

        $latetime = new Latetime();
        $latetime->emp_id = $employee->id;
        $latetime->duration = $difference;
        $latetime->latetime_date = date('Y-m-d');
        $latetime->save();
     }
}
