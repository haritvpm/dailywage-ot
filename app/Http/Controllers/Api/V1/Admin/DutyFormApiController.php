<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDutyFormRequest;
use App\Http\Requests\UpdateDutyFormRequest;
use App\Http\Resources\Admin\DutyFormResource;
use App\Models\DutyForm;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Session;
use App\Models\User;
use App\Models\DutyFormItem;


class DutyFormApiController extends Controller
{
    public function index()
    {
        //abort_if(Gate::denies('duty_form_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $duty = DutyForm::with(['dutyItems', 'date', 'session', 'employee', 'owned_by', 'created_by'])->get();
        dump($duty);

        return new DutyFormResource( $duty);
    }

    public function store(Request $request)
    {
        dump($request->all());
       
        $session = Session::latest()->where('status', 'active')->first();

       // dump( $session);
       $user = auth()->user();

       $errors = [];

       if('oneday-multiemp' === $request->type){

            if (!$request->date) {
                $errors[] = 'Date is needed';
            }
         
       }

    if (count($errors)) {
        $responseArr = array('errors' => $errors );
        return response()->json($responseArr, 422);
    }
    
     
       $dutyForm = DutyForm::create(
        [
            'form_type' => $request->type,
            'date_id' =>  $request->date['id'],
            'session_id' => $session->id,
            'owned_by_id' => auth()->user()->id,

        ]
       );

       if('oneday-multiemp' === $request->type){
            
            $requestData = $request->dutyItems;


            $dutyItems = [];
            foreach ($requestData as $item) {
                $dutyItems[] = new DutyFormItem([
                    'employee_id' => $item['id'],
                    'fn_from' => $item['fn_from'],
                    'fn_to' => $item['fn_to'],
                    'an_from' => $item['an_from'],
                    'an_to' => $item['an_to'],
                    'total_hours' => $item['total_hours'],
                ]);
            }

            $dutyForm->dutyItems()->saveMany($dutyItems);
        
       }
      

        return (new DutyFormResource($dutyForm))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(DutyForm $dutyForm)
    {
       // abort_if(Gate::denies('duty_form_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new DutyFormResource($dutyForm->load(['dutyItems', 'date', 'session', 'employee', 'owned_by', 'created_by']));
    }

    public function update(UpdateDutyFormRequest $request, DutyForm $dutyForm)
    {
        $dutyForm->update($request->all());

        return (new DutyFormResource($dutyForm))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(DutyForm $dutyForm)
    {
       // abort_if(Gate::denies('duty_form_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $dutyForm->dutyItems()->delete();

        $dutyForm->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
