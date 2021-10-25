<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Spatie\Activitylog\Models\Activity;
use Illuminate\Http\Request;

class ActivityLogsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
//        $this->middleware('can:read_roles')->only(['index']);
//        $this->middleware('can:create_roles')->only(['create', 'store']);
//        $this->middleware('can:update_roles')->only(['edit', 'update']);
//        $this->middleware('can:delete_roles')->only(['delete', 'bulk_delete']);
    }// end of __construct

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $activitylogs = Activity::get();

        return view('admin.activitylogs.index', compact('activitylogs'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $activitylog = Activity::findOrFail($id);

        return view('admin.activitylogs.show', compact('activitylog'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        Activity::destroy($id);

        return redirect('admin/activitylogs')->with('flash_message', __('general.deleted_successfully'));
    }

    public function bulkDelete()
    {
        foreach (json_decode(request()->record_ids) as $recordId) {

            $data = Activity::FindOrFail($recordId);
            $data->delete();

        }//end of for each

        return redirect('admin/activitylogs')->with('flash_message',  __('general.deleted_successfully'));
    }// end of bulkDelete
}
