<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSectionRequest;
use App\Http\Requests\UpdateSectionRequest;
use App\Http\Resources\Admin\SectionResource;
use App\Models\Section;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SectionApiController extends Controller
{
    public function index()
    {
       // abort_if(Gate::denies('section_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
       // return new SectionResource(Section::with(['user', 'created_by'])->get());

       $section =  Section::where( 'user_id' , auth()->user()->id)->first();

        $emp = null;
        if( $section ){
            $emp =  $section->sectionDailyWageEmployees()->with(['designation', 'category'])->get();
        }
      
        return new SectionResource($emp);
    }
   

    public function store(StoreSectionRequest $request)
    {
        $section = Section::create($request->all());

        return (new SectionResource($section))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Section $section)
    {
        abort_if(Gate::denies('section_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SectionResource($section->load(['user', 'created_by']));
    }

    public function update(UpdateSectionRequest $request, Section $section)
    {
        $section->update($request->all());

        return (new SectionResource($section))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Section $section)
    {
        abort_if(Gate::denies('section_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $section->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
