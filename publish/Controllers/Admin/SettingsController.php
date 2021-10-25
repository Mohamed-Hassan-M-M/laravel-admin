<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Setting;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class SettingsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
//        $this->middleware('can:read_users')->only(['index']);
//        $this->middleware('can:create_users')->only(['create', 'store']);
//        $this->middleware('can:update_users')->only(['edit', 'update']);
//        $this->middleware('can:delete_users')->only(['delete', 'bulk_delete']);
    }// end of __construct

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Setting::query();
            return DataTables::of($data)
                ->addColumn('record_select', function ($row){
                    $btn = '<input type="checkbox" id="record-' . $row->id . '" value="' . $row->id . '" class="record__select"/>';
                    $btn .= '<label for="record-' . $row->id . '"></label>';
                    return $btn;
                })
                ->addColumn('actions', function ($row){
                    $btn = '<a href="'. route('admin.settings.edit', $row->id) .'" class="btn btn-warning btn-sm"><i class="la la-lg la-pencil-square-o"></i> </a>';
                    $btn .= '<a href="'. route('admin.settings.show', $row->id) .'" class="btn btn-primary btn-sm ml-1 mr-1"><i class="la la-lg la-eye"></i> </a>';
                    $btn .= '<form action="'. route('admin.settings.destroy', $row->id) .'" class="my-1 my-xl-0" method="post" style="display: inline-block;">';
                    $btn .= '<input name="_method" type="hidden" value="DELETE"><input name="_token" type="hidden" value="'.csrf_token().'">';
                    $btn .= '<button type="submit" class="btn btn-danger btn-sm delete"><i class="la la-lg la-trash"></i> </button>';
                    $btn .= '</form>';
                    return $btn;
                })
                ->rawColumns(['record_select', 'actions'])
                ->make(true);
        }

        return view('admin.settings.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $setting = new Setting();

        return view('admin.settings.create', compact('setting'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $this->validate(
            $request,
            [
                'key' => 'required|string|unique:settings',
                'value' => 'required'
            ]
        );

        $requestData = $request->all();

        Setting::create($requestData);

        return redirect('admin/settings')->with('flash_message', __('general.added_successfully'));
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
        $setting = Setting::findOrFail($id);

        return view('admin.settings.show', compact('setting'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $setting = Setting::findOrFail($id);

        return view('admin.settings.edit', compact('setting'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $this->validate(
            $request,
            [
                'key' => 'required|string|unique:settings,key,' . $id,
                'value' => 'required'
            ]
        );
        $requestData = $request->all();

        $setting = Setting::findOrFail($id);
        $setting->update($requestData);

        return redirect('admin/settings')->with('flash_message', __('general.updated_successfully'));
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
        Setting::destroy($id);

        return redirect('admin/settings')->with('flash_message', __('general.deleted_successfully'));
    }

    public function bulkDelete()
    {
        foreach (json_decode(request()->record_ids) as $recordId) {

            $data = Setting::FindOrFail($recordId);
            $data->delete();

        }//end of for each

        return redirect('admin/settings')->with('flash_message',  __('general.deleted_successfully'));
    }// end of bulkDelete
}
