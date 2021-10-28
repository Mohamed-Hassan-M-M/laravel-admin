<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class PagesController extends Controller
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
            $data = Page::latest();
            return DataTables::of($data)
                ->removeColumn('content')
                ->addColumn('record_select', function ($row){
                    $btn = '<input type="checkbox" id="record-' . $row->id . '" value="' . $row->id . '" class="record__select"/>';
                    $btn .= '<label for="record-' . $row->id . '"></label>';
                    return $btn;
                })
                ->addColumn('actions', function ($row){
                    $btn = '<a href="'. route('admin.pages.edit', $row->id) .'" class="btn btn-warning btn-sm"><i class="fas fa-lg fa-edit"></i> </a>';
                    $btn .= '<a href="'. route('admin.pages.show', $row->id) .'" class="btn btn-primary btn-sm ml-1 mr-1"><i class="fas fa-lg fa-eye"></i> </a>';
                    $btn .= '<form action="'. route('admin.pages.destroy', $row->id) .'" class="my-1 my-xl-0" method="post" style="display: inline-block;">';
                    $btn .= '<input name="_method" type="hidden" value="DELETE"><input name="_token" type="hidden" value="'.csrf_token().'">';
                    $btn .= '<button type="submit" class="btn btn-danger btn-sm delete"><i class="fas fa-lg fa-trash"></i> </button>';
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
        $languages = \App\Models\Language::select('code', 'name', 'id')->get();
        return view('admin.pages.create', compact(['page', 'languages']));
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
            'required_without_all:title_ar' => 'required_without_all:title_ar',
            'content' => 'required'
        ]);

        $requestData = $request->all();
        $requestData['slug'] = str_slug($request->title_en, '-');
        $requestExceptData = $request->except(['title_en', 'title_ar']);
        $requestTranslatableData = $request->only(['title_en', 'title_ar']);
        if(count($requestTranslatableData) > 0){
            $requestTranslatableData = \App\Helpers\GettingMultiLanguagesFields::getMultiLanguage(['title'], $requestTranslatableData);
            $requestData = array_merge($requestExceptData, $requestTranslatableData);
        }

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
        $languages = \App\Models\Language::select('code', 'name', 'id')->get();
        return view('admin.pages.show', compact(['page', 'languages']));
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
        $languages = \App\Models\Language::select('code', 'name', 'id')->get();
        return view('admin.pages.edit', compact(['page', 'languages']));
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
        $requestData['slug'] = str_slug($request->title_en, '-');
        $requestExceptData = $request->except(['title_en', 'title_ar']);
        $requestTranslatableData = $request->only(['title_en', 'title_ar']);
        if(count($requestTranslatableData) > 0){
            $requestTranslatableData = \App\Helpers\GettingMultiLanguagesFields::getMultiLanguage(['title'], $requestTranslatableData);
            $requestData = array_merge($requestExceptData, $requestTranslatableData);
        }


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
