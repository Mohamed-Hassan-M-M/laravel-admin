<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Models\Language;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class LanguagesController extends Controller
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
            $data = Language::latest();
            return DataTables::of($data)
                ->addColumn('record_select', function ($row){
                    $btn = '<input type="checkbox" id="record-' . $row->id . '" value="' . $row->id . '" class="record__select"/>';
                    $btn .= '<label for="record-' . $row->id . '"></label>';
                    return $btn;
                })
                ->addColumn('actions', function ($row){
                    $btn = '<a href="'. route('admin.languages.edit', $row->id) .'" class="btn btn-jinja btn-sm"><i class="fa fa-edit"></i> </a>';
                    $btn .= '<a href="'. route('admin.languages.show', $row->id) .'" class="btn btn-jinja btn-sm ml-1 mr-1"><i class="fa  fa-eye"></i> </a>';
                    $btn .= '<form action="'. route('admin.languages.destroy', $row->id) .'" class="my-1 my-xl-0" method="post" style="display: inline-block;">';
                    $btn .= '<input name="_method" type="hidden" value="DELETE"><input name="_token" type="hidden" value="'.csrf_token().'">';
                    $btn .= '<button type="submit" class="btn btn-jinja btn-sm delete"><i class="fa fa-trash"></i> </button>';
                    $btn .= '</form>';
                    return $btn;
                })
                ->rawColumns(['record_select', 'actions'])
                ->make(true);
        }

        return view('admin.languages.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $language = new Language();
        return view('admin.languages.create', compact(['language']));
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
			'code' => 'required',
			'name' => 'required',
			'icon' => 'required'
		]);
        $requestData = $request->all();

        Language::create($requestData);

        return redirect('admin/languages')->with('flash_message',  __('general.added_successfully'));
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
        $language = Language::findOrFail($id);

        return view('admin.languages.show', compact('language'));
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
        $language = Language::findOrFail($id);

        return view('admin.languages.edit', compact('language'));
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
			'code' => 'required',
			'name' => 'required',
            'icon' => 'required'
		]);
        $requestData = $request->all();

        $language = Language::findOrFail($id);
        $language->update($requestData);

        return redirect('admin/languages')->with('flash_message', __('general.updated_successfully'));
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
        Language::destroy($id);

        return redirect('admin/languages')->with('flash_message', __('general.deleted_successfully'));
    }

    public function bulkDelete()
    {
        foreach (json_decode(request()->record_ids) as $recordId) {

            $data = Language::FindOrFail($recordId);
            $data->delete();

        }//end of for each

        return redirect('admin/languages')->with('flash_message',  __('general.deleted_successfully'));
    }// end of bulkDelete
}
