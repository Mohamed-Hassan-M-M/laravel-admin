<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class PermissionsController extends Controller
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
     * @return void
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Permission::latest();
            return DataTables::of($data)
                ->addColumn('record_select', function ($row){
                    $btn = '<input type="checkbox" id="record-' . $row->id . '" value="' . $row->id . '" class="record__select"/>';
                    $btn .= '<label for="record-' . $row->id . '"></label>';
                    return $btn;
                })
                ->addColumn('actions', function ($row){
                    $btn = '<a href="'. route('admin.permissions.edit', $row->id) .'" class="btn btn-jinja btn-sm"><i class="fa fa-edit"></i> </a>';
                    $btn .= '<a href="'. route('admin.permissions.show', $row->id) .'" class="btn btn-jinja btn-sm ml-1 mr-1"><i class="fa  fa-eye"></i> </a>';
                    $btn .= '<form action="'. route('admin.permissions.destroy', $row->id) .'" class="my-1 my-xl-0" method="post" style="display: inline-block;">';
                    $btn .= '<input name="_method" type="hidden" value="DELETE"><input name="_token" type="hidden" value="'.csrf_token().'">';
                    $btn .= '<button type="submit" class="btn btn-jinja btn-sm delete"><i class="fa fa-trash"></i> </button>';
                    $btn .= '</form>';
                    return $btn;
                })
                ->rawColumns(['record_select', 'actions'])
                ->make(true);
        }
        return view('admin.permissions.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {
        $permission = new Permission();
        return view('admin.permissions.create', compact(['permission']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return void
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:permissions,name',
            'label' => 'required|unique:permissions,label'
        ]);
        $requestData = $request->all();

        Permission::create($requestData);

        return redirect('admin/permissions')->with('flash_message',  __('general.added_successfully'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return void
     */
    public function show($id)
    {
        $permission = Permission::findOrFail($id);

        return view('admin.permissions.show', compact('permission'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return void
     */
    public function edit($id)
    {
        $permission = Permission::findOrFail($id);

        return view('admin.permissions.edit', compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return void
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|unique:permissions,name,' . request()->segment(4),
            'label' => 'required|unique:permissions,label,' . request()->segment(4)
        ]);
        $requestData = $request->all();

        $permission = Permission::findOrFail($id);
        $permission->update($requestData);

        return redirect('admin/permissions')->with('flash_message', __('general.updated_successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return void
     */
    public function destroy($id)
    {
        Permission::destroy($id);

        return redirect('admin/permissions')->with('flash_message', __('general.deleted_successfully'));
    }

    public function bulkDelete()
    {
        foreach (json_decode(request()->record_ids) as $recordId) {

            $data = Permission::FindOrFail($recordId);
            $data->delete();

        }//end of for each

        return redirect('admin/permissions')->with('flash_message',  __('general.deleted_successfully'));
    }// end of bulkDelete
}
