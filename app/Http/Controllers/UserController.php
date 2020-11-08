<?php

namespace App\Http\Controllers;

use App\Http\Resources\TaskResource;
use App\Model\Setting;
use App\Model\Task;
use App\Roles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function roles(Request $request)
    {
        //validate incoming request
        $this->validate($request, [
            'name' => 'required|string',
        ]);

        try {

            $role = new Roles();
            $role->name = $request->input('name');
            $role->save();

            //return successful response
            return response()->json(['role' => $role, 'message' => 'User role created successfully'], 201);

        } catch (\Exception $e) {
            //return error message
            return response()->json(['message' => 'Error in creating user role!'], 409);
        }
    }

    public function time_setting(Request $request)
    {
        //validate incoming request
        $this->validate($request, [
            'max_hours' => 'required|integer',
        ]);

        try {
            $setting = Setting::updateorcreate(['user_id' => Auth::user()->id], ['max_hours' => $request->input('max_hours')]);

        } catch (\Exception $e) {
            //return error message
            return response()->json(['message' => 'Error in creating user setting!' . $e->getMessage()], 409);
        }
        //return successful response
        return response()->json(['setting' => $setting, 'message' => 'User setting created successfully'], 201);

    }

    public function task(Request $request)
    {
        if ($request->isMethod('get'))
        {
            return new TaskResource(Task::find(1));
        }
        if ($request->isMethod('post'))
        {
            $this->validate($request, [
                'work_type'=>'required',
                'work_hours' => 'required|integer',
                'date'=>'required',
            ]);

            try {
                $setting = Task::updateorcreate(
                    ['date'=>$request->date],
                    ['user_id' => Auth::user()->id,
                        'work_type'=>$request->work_type,
                        'work_hours'=>$request->work_hours]
                );

            } catch (\Exception $e) {
                //return error message
                return response()->json(['message' => 'Error in creating user task!' . $e->getMessage()], 409);
            }
            //return successful response
            return response()->json(['setting' => $setting, 'message' => 'User task created successfully'], 201);
        }

    }
}
