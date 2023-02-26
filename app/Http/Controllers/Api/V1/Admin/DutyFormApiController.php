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
        // dump($duty);

        return new DutyFormResource( $duty);
    }

    public function store(Request $request)
    {
    //    dump($request->all());
       
       $session = Session::latest()->where('status', 'active')->first();

       // dump( $session);
       $user = auth()->user();

       $errors = [];

       if('oneday-multiemp' === $request->form_type){

            if (!$request->date) {
                $errors[] = 'Date is needed';
            }
         
       } else {

            if (!$request->employee) {
                $errors[] = 'Employee is needed';
            }
       }

        if (count($errors)) {
            $responseArr = array('errors' => $errors );
            return response()->json($responseArr, 422);
        }
    
     
       $dutyForm = DutyForm::create(
        [
            'form_type' => $request->form_type,
            'date_id' =>  $request->date ? $request->date['id'] : null,
            'session_id' => $session->id,
            'owned_by_id' => auth()->user()->id,
            'employee_id' =>  $request->employee ?  $request->employee['id'] :null ,
            'total_hours'  => $request->total_hours ? $request->total_hours : null,

        ]
       );

       $dutyItems = [];

       if('oneday-multiemp' === $request->form_type){
            
            $requestData = $request->duty_items;
            foreach ($requestData as $item) {
                $dutyItems[] = new DutyFormItem([
                    'employee_id' => $item['employee_id'],
                    'fn_from' => $item['fn_from'],
                    'fn_to' => $item['fn_to'],
                    'an_from' => $item['an_from'],
                    'an_to' => $item['an_to'],
                    'total_hours' => $item['total_hours'],
                ]);
            }
       } else {
        
            $requestData = $request->dates;
            foreach ($requestData as $item) {
                $dutyItems[] = new DutyFormItem([
                    'date_id' => $item['date']['id'],
                    'fn_from' => $item['fn_from'],
                    'fn_to' => $item['fn_to'],
                    'an_from' => $item['an_from'],
                    'an_to' => $item['an_to'],
                    'total_hours' => $item['total_hours'],
                ]);
            }
       }
      
       $dutyForm->dutyItems()->saveMany($dutyItems);

        return (new DutyFormResource($dutyForm))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(DutyForm $dutyForm)
    {
       // abort_if(Gate::denies('duty_form_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new DutyFormResource($dutyForm->load(['dutyItems', 'dutyItems.date','dutyItems.employee', 'date', 'session', 'employee', 'owned_by', 'created_by']));
    }

    public function update(Request $request, DutyForm $dutyForm)
    {
        // dump($request->all());
       abort_if($dutyForm->owned_by_id != auth()->user()->id, Response::HTTP_FORBIDDEN, '403 Forbidden');
        
       $errors = [];
       if('oneday-multiemp' === $request->form_type){

        if (!$request->date) {
            $errors[] = 'Date is needed';
        }
            
        } else {

                if (!$request->employee) {
                    $errors[] = 'Employee is needed';
                }
        }

        if (count($errors)) {
            $responseArr = array('errors' => $errors );
            return response()->json($responseArr, 422);
        }
    
        if('oneday-multiemp' === $request->form_type){
            $dutyForm->update( [
                // 'form_type' => $request->form_type,
                'date_id' =>  $request->date['id'],
            ]);
        } else {
            $dutyForm->update( [
                 'employee_id' =>  $request->employee['id'],
                 'total_hours'=>  $request->total_hours,
            ]);
        }
        $requestData = $request->duty_items;

        if('oneday-multiemp' === $request->form_type){
         

            $dutyItems = [];
            foreach ($requestData as $item) {
                $dutyItems[] = new DutyFormItem([
                    'employee_id' => $item['employee_id'],
                    'fn_from' => $item['fn_from'],
                    'fn_to' => $item['fn_to'],
                    'an_from' => $item['an_from'],
                    'an_to' => $item['an_to'],
                    'total_hours' => $item['total_hours'],
                ]);
            }

            $dutyForm->dutyItems()->delete();
            $dutyForm->dutyItems()->saveMany($dutyItems);
        
       } else {

            //todo update each row not delete entire items
            //$dutyItems = [];
            foreach ($requestData as $item) {
                $dutyFormItem = DutyFormItem::find( $item['id'] );
                $dutyFormItem->update
                /*
                $dutyItems[] = new DutyFormItem*/
                    (
                    [
                    'date_id' => $item['date_id'],
                    'fn_from' => $item['fn_from'],
                    'fn_to' => $item['fn_to'],
                    'an_from' => $item['an_from'],
                    'an_to' => $item['an_to'],
                    'total_hours' => $item['total_hours'],
                    ]
                );
            }

          //  $dutyForm->dutyItems()->delete();
          //  $dutyForm->dutyItems()->saveMany($dutyItems);
        
       }


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

    public function submit(Request $request)
    {
       // dump($request->all());

       $dutyForm = DutyForm::find($request->id);

       $admin = User::with(['roles' => function($q){
            $q->where('title', 'Admin');
        }])->first();

        //dump( $dutyForm->id);
       $dutyForm->update( [
             'owned_by_id' => $admin->id,
        ]);

        return (new DutyFormResource($dutyForm))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }
}
