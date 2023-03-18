<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSessionRequest;
use App\Http\Requests\UpdateSessionRequest;
use App\Models\Session;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SessionController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('session_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sessions = Session::all();

        return view('admin.sessions.index', compact('sessions'));
    }

    public function create()
    {
        abort_if(Gate::denies('session_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.sessions.create');
    }

    public function store(StoreSessionRequest $request)
    {
        if( $request->status == 'active' ){
            Session::query()->update( 
                ['status' => 'inactive']
            );
        }
        $session = Session::create($request->all());

        return redirect()->route('admin.sessions.index');
    }

    public function edit(Session $session)
    {
        abort_if(Gate::denies('session_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.sessions.edit', compact('session'));
    }

    public function update(UpdateSessionRequest $request, Session $session)
    {
        if( $request->status == 'active' ){
            Session::query()->update( 
                ['status' => 'inactive']
            );
        }

        $session->update($request->all());

        return redirect()->route('admin.sessions.index');
    }

    public function show(Session $session)
    {
        abort_if(Gate::denies('session_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.sessions.show', compact('session'));
    }
}
