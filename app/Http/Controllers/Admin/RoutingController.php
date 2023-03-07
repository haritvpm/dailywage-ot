<?php

namespace App\Http\Controllers\Admin;

use App\Models\Routing;
use Illuminate\Http\Request;
use Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRoutingsRequest;
use App\Http\Requests\UpdateRoutingsRequest;
use App\Models\User;

class RoutingController extends Controller
{
    /**
     * Display a listing of Routing.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      //  if (! Gate::allows('user_access')) {
        //    return abort(401);
       // }
        
      
        $routings = Routing::with('user')->latest()->get();


        return view('admin.routings.index', compact('routings'));
    }

    /**
     * Show the form for creating new Routing.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // if (! Gate::allows('user_create')) {
        //     return abort(401);
        // }
        
        $users = User::get()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.routings.create', compact('users'));
    }

    /**
     * Store a newly created Routing in storage.
     *
     * @param  \App\Http\Requests\StoreRoutingsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRoutingsRequest $request)
    {
        if (! Gate::allows('user_create')) {
            return abort(401);
        }

       
        $routing = Routing::create($request->all());


        return redirect()->route('admin.routings.index');
    }


    /**
     * Show the form for editing Routing.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      //  if (! Gate::allows('user_edit')) {
       //     return abort(401);
      //  }
        
        $users = User::get()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $routing = Routing::findOrFail($id);

        return view('admin.routings.edit', compact('routing', 'users'));
    }

    /**
     * Update Routing in storage.
     *
     * @param  \App\Http\Requests\UpdateRoutingsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRoutingsRequest $request, $id)
    {
        if (! Gate::allows('user_edit')) {
            return abort(401);
        }
        $routing = Routing::findOrFail($id);
        $routing->update($request->all());


        return redirect()->route('admin.routings.index');
    }


    /**
     * Display Routing.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      //  if (! Gate::allows('user_view')) {
        //    return abort(401);
      //  }
       // $routing = Routing::findOrFail($id);

      //  return view('admin.routings.show', compact('routing'));
      return redirect()->route('admin.routings.index');
    }


    /**
     * Remove Routing from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      //  if (! Gate::allows('user_delete')) {
       //     return abort(401);
       // }
        $routing = Routing::findOrFail($id);
        $routing->delete();

        return redirect()->route('admin.routings.index');
    }

    /**
     * Delete all selected Routing at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('user_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Routing::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
              //  $entry->delete();
            }
        }
    }

}