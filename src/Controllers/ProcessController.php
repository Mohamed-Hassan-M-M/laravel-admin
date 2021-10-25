<?php

namespace Acmetemplate\LaravelAdmin\Controllers;

use App\Http\Controllers\Controller;
use Artisan;
use File;
use Illuminate\Http\Request;
use Response;
use View;
use Illuminate\Support\Str;

class ProcessController extends Controller
{
    /**
     * Display generator.
     *
     * @return Response
     */
    public function getGenerator()
    {
        return view('laravel-admin::generator');
    }

    /**
     * Process generator.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return Response
     */
    public function postGenerator(Request $request)
    {

        $commandArg = [];
        $commandArg['name'] = $request->crud_name;

        if ($request->has('fields')) {
            $fieldsArray = [];
            $validationsArray = [];
            $x = 0;
            foreach ($request->fields as $field) {
                if ($request->fields_required[$x] == 1) {
                    $validationsArray[] = $field;
                }
                $tmp = 0;
                if ($request->fields_type[$x] == 'select' || $request->fields_type[$x] == 'enum'){
                    $fieldsArray[] = $field . '#' . $request->fields_type[$x] . '#options=' . $request->options[$x] . '#trans='.$request->fields_translated[$x];//edit mhmm
                }else{
                    $fieldsArray[] = $field . '#' . $request->fields_type[$x]. '#trans='.$request->fields_translated[$x];//edit mhmm
                }
                $x++;
            }

            $commandArg['--fields'] = implode(";", $fieldsArray);
        }

        if (!empty($validationsArray)) {
            $commandArg['--validations'] = implode("#required;", $validationsArray) . "#required";
        }

        if ($request->has('route')) {
            $commandArg['--route'] = $request->route;
        }

        if ($request->has('view_path')) {
            $commandArg['--view-path'] = $request->view_path;
        }

        if ($request->has('controller_namespace')) {
            $commandArg['--controller-namespace'] = $request->controller_namespace;
        }

        if ($request->has('model_namespace')) {
            $commandArg['--model-namespace'] = $request->model_namespace;
        }

        if ($request->has('route_group')) {
            $commandArg['--route-group'] = $request->route_group;
        }

        if ($request->has('relationships')) {
            $commandArg['--relationships'] = $request->relationships;
        }

        if ($request->has('form_helper')) {
            $commandArg['--form-helper'] = $request->form_helper;
        }

        if ($request->has('soft_deletes')) {
            $commandArg['--soft-deletes'] = $request->soft_deletes;
        }


        if ($request->has('localize')) {
            $commandArg['--localize'] = $request->localize;

            if($commandArg['--localize'] == 'yes'){
                $langFolders = 'en';
                if(is_dir(\App::langPath()))
                    $langFolders = array_diff(scandir(\App::langPath()), array('..', '.'));
                $commandArg['--locales'] = implode(',', $langFolders);//edit mhmm
            }
        }


        try {
            Artisan::call('crud:generate', $commandArg);

            $menus = json_decode(File::get(base_path('resources/laravel-admin/menus.json')));

            $name = $commandArg['name'];
            $routeName = ($commandArg['--route-group']) ? $commandArg['--route-group'] . '/' . Str::snake($name, '-') : Str::snake($name, '-');

            $menus->menus = array_map(function ($menu) use ($name, $routeName) {
                if ($menu->section == 'Resources') {
                    array_push($menu->items, (object) [
                        'title' => $name,
                        'url' => '/' . $routeName,
                    ]);
                }

                return $menu;
            }, $menus->menus);

            File::put(base_path('resources/laravel-admin/menus.json'), json_encode($menus));

            Artisan::call('migrate');
        } catch (\Exception $e) {
            return Response::make($e->getMessage(), 500);
        }
        return redirect('admin/generator')->with('flash_message', 'Your CRUD has been generated. See on the menu.');
    }
}
