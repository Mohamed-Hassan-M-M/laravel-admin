<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class PagesController extends Controller
{

    public function __construct()
    {
        //$this->middleware('auth');
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
            $data = Page::latest();
            return DataTables::of($data)
                ->addColumn('record_select', function ($row){
                    $btn = '<input type="checkbox" id="record-' . $row->id . '" value="' . $row->id . '" class="record__select"/>';
                    $btn .= '<label for="record-' . $row->id . '"></label>';
                    return $btn;
                })
                ->addColumn('actions', function ($row){
                    $btn = '<a href="'. route('admin.pages.edit', $row->id) .'" class="btn btn-warning btn-sm"><i class="la la-lg la-pencil-square-o"></i> </a>';
                    $btn .= '<a href="'. route('admin.pages.show', $row->id) .'" class="btn btn-primary btn-sm ml-1 mr-1"><i class="la la-lg la-eye"></i> </a>';
                    $btn .= '<form action="'. route('admin.pages.destroy', $row->id) .'" class="my-1 my-xl-0" method="post" style="display: inline-block;">';
                    $btn .= '<input name="_method" type="hidden" value="DELETE"><input name="_token" type="hidden" value="'.csrf_token().'">';
                    $btn .= '<button type="submit" class="btn btn-danger btn-sm delete"><i class="la la-lg la-trash"></i> </button>';
                    $btn .= '</form>';
                    return $btn;
                })
                ->rawColumns(['record_select', 'actions'])
                ->make(true);
        }

        return view('admin.pages.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $page = new Page();

        return view('admin.pages.create', compact('page'));
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
        $this->validate($request, [
            'title' => 'required',
            'content' => 'required'
        ]);
        $requestData = $request->all();

        Page::create($requestData);

        return redirect('admin/pages')->with('flash_message', __('general.added_successfully'));
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
        $page = Page::findOrFail($id);

        return view('admin.pages.show', compact('page'));
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
        $page = Page::findOrFail($id);

        return view('admin.pages.edit', compact('page'));
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
        $this->validate($request, [
            'title' => 'required',
            'content' => 'required'
        ]);
        $requestData = $request->all();

        $page = Page::findOrFail($id);
        $page->update($requestData);

        return redirect('admin/pages')->with('flash_message', __('general.updated_successfully'));
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
        Page::destroy($id);

        return redirect('admin/pages')->with('flash_message', __('general.deleted_successfully'));
    }

    public function bulkDelete()
    {
        foreach (json_decode(request()->record_ids) as $recordId) {

            $data = Page::FindOrFail($recordId);
            $data->delete();

        }//end of for each

        return redirect('admin/pages')->with('flash_message',  __('general.deleted_successfully'));
    }// end of bulkDelete
}
