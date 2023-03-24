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
use App\Models\Calender;
use App\Models\Routing;
use App\Models\DailyWageEmployee;
use App\Models\Section;
use Illuminate\Support\Facades\Log;

class DutyFormApiController extends Controller
{
    public function index()
    {
        //abort_if(Gate::denies('duty_form_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $session = Session::where('status', 'active')->latest()->first();

        $approvers = Routing::where('route_id', auth()->user()->id)->pluck('user_id');

        $duty = DutyForm::with(['dutyItems', 'date', 'session', 'employee', 'owned_by', 'created_by'])
        ->where(function($query) use ( $approvers) {
            $query->where('owned_by_id', auth()->user()->id)
                ->orWhere('created_by_id', auth()->user()->id)
                //show all forms approved by this user.
                ->orwhere(function($query2) use ( $approvers) {
                    $query2->Wherein('created_by_id', $approvers)
                    ->whereColumn('owned_by_id', '<>', 'created_by_id'); //but exclude draft stage in asst;
                 });
        })
        ->where( 'session_id', $session?->id )
        ->latest()
        ->get();
        // dump($duty);

        return new DutyFormResource( $duty);
    }
    public function doValidation( &$errors, Request $request, DutyForm $dutyForm=null)
    {
        if (!$request->session_id) {
            $errors[] = 'Session not found';
            return;
        }

        if('oneday-multiemp' === $request->form_type){

            if (!$request->date) {
                $errors[] = 'Date is needed';
            }
            else{
                //for each emlpoyee, check if data exists already
                $emps = Collect($request->duty_items)->pluck('employee_id');
                $dutyFormItemsExisting = DutyFormItem::with( 'form' )
                    ->whereHas('form', function ($query) use ($request ) {
                        $query->where('date_id',$request->date['id'])
                              ->where('session_id', $request->session_id);
                        })
                    ->wherein('employee_id',  $emps->toArray())
                    ->when($dutyForm, function ($q, $dutyForm){
                        return  $q->wherenot( 'form_id', $dutyForm->id);
                    })
                    ->get();
              if($dutyFormItemsExisting->count() ){
                $empnames = DailyWageEmployee::wherein('id', $dutyFormItemsExisting->pluck('employee_id')->toArray() );
                $errors[] = 'OT for this date already entered for employees: ' . $empnames->pluck('ten')->implode(',');
              }

              //also check if a whole session form exists for these employees. if so, dont allow
                $forms = DutyForm::where('session_id', $request->session_id)
                            ->where('form_type', 'alldays-oneemp')
                            ->wherein('employee_id', $emps->toArray())
                            ->get();

                if( $forms->count() ){
                    $empnames = DailyWageEmployee::wherein('id', $forms->pluck('employee_id')->toArray() );
                    $errors[] = 'Whole-session form for these employees already exists: ' .   $empnames->pluck('ten')->implode(',');
                }

            }
           
                
        } else if('alldays-oneemp' === $request->form_type) { //Whole Session Form, single employee

            if (!$request->employee) {
                $errors[] = 'Employee is needed';
            } else {
                //check if this employee has already been created

                $form = DutyForm::where('session_id', $request->session_id)
                        ->where('employee_id', $request->employee['id'])
                        ->when($dutyForm, function ($q, $dutyForm){
                            return  $q->wherenot( 'id', $dutyForm->id);
                        })
                        ->first();
                if( $form ){
                    $errors[] = 'Form for this employee already exists. Form No: ' . $form->form_num;
                }

                //also check if any one-day multi emp formitem for any date exists for this employee.
                $dutyFormItemsExisting = DutyFormItem::with( 'form' )
                    ->whereHas('form', function ($query) use ($request ) {
                        $query->where('session_id', $request->session_id)
                            ->where('form_type', 'oneday-multiemp');
                        })
                    ->where('employee_id',   $request->employee['id'])
                    ->first();
                    if($dutyFormItemsExisting ){
                        $date = $dutyFormItemsExisting->form->date?->date;
                        $errors[] = 'OT already entered for employee for date: ' . $date;
                    }

            }
        } else { //Whole Session Form, All employees

            //check if any form created for these emps
            $emps = Collect($request->duty_items)->pluck('employee_id');
                $dutyFormItemsExisting = DutyFormItem::with( 'form' )
                    ->whereHas('form', function ($query) use ($request ) {
                        $query->where('session_id', $request->session_id);
                        })
                    ->wherein('employee_id', $emps->toArray())
                    ->when($dutyForm, function ($q, $dutyForm){
                        return  $q->wherenot( 'form_id', $dutyForm->id);
                    })
                  ->get();
              if($dutyFormItemsExisting->count() ){
                $empnames = DailyWageEmployee::wherein('id', $dutyFormItemsExisting->pluck('employee_id')->toArray() );
                $errors[] = 'OT already entered for employees: ' . $empnames->pluck('ten')->implode(',');
              }

            //also check single emp formitem 
            $form = DutyForm::where('session_id', $request->session_id)
                        ->wherein('employee_id',   $emps->toArray() )
                        ->first();

                if($form ){
                    
                    $errors[] = 'OT already entered for employee : form ' . $form->form_num ;
                }


        }
    

    }

    public function store(Request $request)
    {
      // dump($request->all());
        
       

       $user = auth()->user();

       $errors = [];

       $this->doValidation($errors, $request );

        if (count($errors)) {
            $responseArr = array('errors' => $errors );
            return response()->json($responseArr, 422);
        }
    
        $maxform_no = DutyForm::where('session_id', $request->session_id)->max('form_num');
        if($maxform_no < 0){
           $maxform_no = 0; //plan to use form no field to -1 for rejected
        }
     
       $dutyForm = DutyForm::create(
        [
            'form_type' => $request->form_type,
            'date_id' =>  $request->date ? $request->date['id'] : null,
            'session_id' => $request->session_id,
            'owned_by_id' => auth()->user()->id,
            'employee_id' =>  $request->employee ?  $request->employee['id'] :null ,
            'total_hours'  => $request->total_hours ? $request->total_hours : null,
            'form_num' => $maxform_no+1,
            'created_by_id' => auth()->user()->id,
            
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
       } else if('alldays-oneemp' === $request->form_type) {
        
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
       } else{
           // $dates = Calender::where('session_id', $dutyForm->session_id)->orderby('date')->get();

            $requestData = $request->duty_items;
            foreach ($requestData as $item) {
                              
                $dutyItems[] = new DutyFormItem([
                    'employee_id' => $item['employee_id'],
                    'total_hours' => $item['total_hours'],
                    'all_ot_hours' => implode( ',',  $item['all_ot_hours']),
                    'all_ot_dayids' => implode( ',',  $item['all_ot_dayids']),
                    
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

       $dutyForm = $dutyForm->load(['dutyItems', 'dutyItems.date','dutyItems.employee', 'date', 'session', 'employee', 'owned_by', 'created_by']);
       
       if('oneday-multiemp' === $dutyForm->form_type)
       {


       } else if ('alldays-oneemp' === $dutyForm->form_type) {
        //if any new dates have been added to this session after this form was submitted
           $dates = Calender::where('session_id', $dutyForm->session_id)->orderby('date')->get();
           $datesinform = $dutyForm->dutyItems->pluck( 'date_id' );
           //
           foreach ($dates as $key => $date) {
                if( !$datesinform->contains( $date->id ) ){
                    //dump( $date->id);
                    $dutyForm->dutyItems->push( [
                        'id' =>  -1,
                        'date_id' =>  $date->id,
                        'date' =>  $date,
                        'fn_from' =>  '',
                        'fn_to' =>  '',
                        'an_from' =>  '',
                        'an_to' =>  '',
                        'total_hours' =>  '',
                    ] );
                }
           }
            

        } else {
            //convert string all_ot_hours,all_ot_dayids  to array. Also add if there are new dates in session calendar
            $dateids = Calender::where('session_id', $dutyForm->session_id)->orderby('date')->pluck('id');
            foreach ($dutyForm->dutyItems as &$dutyitem) {
                $all_ot_hours = explode(',', $dutyitem->all_ot_hours);
                $all_ot_dayids = explode(',', $dutyitem->all_ot_dayids);
                $idtohour = array();
                foreach ($all_ot_dayids as $index => $id) {
                    $idtohour[$id] =  $all_ot_hours[$index];
                }
                
                //if there are new dates in session calendar, add
                $hoursnew = [];
                foreach ($dateids as $key => $id) {
                    if( !array_key_exists( $id,$idtohour) ){
                        $hoursnew[] = '';
                    } else {
                        $hoursnew[] = $idtohour[$id];
                    }
                }

                $dutyitem->all_ot_hours =  $hoursnew;
                $dutyitem->all_ot_dayids =  $dateids;
              
               // dump($all_ot_dayids);
            }

            //
            //also add any new employees mapped to this section/user
            //
            $sectionids =  Section::where( 'user_id' , $dutyForm->created_by_id)->pluck('id')->toArray();

            $emps =  DailyWageEmployee::with(['designation', 'category', 'section'])
            ->where('status','active')
            ->wherein('section_id', $sectionids)
            ->get();

            //now if there are new employees, add them to dutyforms

            //$emp_ids = $emps->where('in_usersection',true)->pluck('id');
            $emps_in_form = $dutyForm->dutyItems->pluck('employee_id');
            foreach ($emps as $emp) {
                $empty_arr = array_fill(0, count($dateids), "");
               // Log::info(count($empty_arr));

                if(!$emps_in_form->contains($emp->id )){
                    $dutyForm->dutyItems->push( [
                        'id' =>  -1,
                        'employee_id' =>  $emp->id,
                        'employee' =>  $emp,
                        'total_hours' =>  '',
                        'all_ot_hours'=>  $empty_arr,
                        'all_ot_dayids'=>  $dateids,
                    ] );
                }
            }


        }

       return new DutyFormResource($dutyForm);
    }

    public function update(Request $request, DutyForm $dutyForm)
    {
        // dump($request->all());
       abort_if($dutyForm->owned_by_id != auth()->user()->id, Response::HTTP_FORBIDDEN, '403 Forbidden');
        
       $errors = [];
       $this->doValidation($errors, $request, $dutyForm );

        if (count($errors)) {
            $responseArr = array('errors' => $errors );
            return response()->json($responseArr, 422);
        }
    
        if('oneday-multiemp' === $request->form_type){
            $dutyForm->update( [
                // 'form_type' => $request->form_type,
                'date_id' =>  $request->date['id'],
            ]);
        } else  if ('alldays-oneemp' === $request->form_type) {
            $dutyForm->update( [
                 'employee_id' =>  $request->employee['id'],
                 'total_hours'=>  $request->total_hours,
            ]);
        }
        $requestData = $request->duty_items;

        if('oneday-multiemp' === $request->form_type){
         
            //cant just update because some items may be added and removed
            $dutyItems = [];
            foreach ($requestData as $item) {
              //  $dutyFormItem = DutyFormItem::find( $item['id'] );
                $dutyItems[] = new DutyFormItem([
                //$dutyFormItem->update ([
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
        
       } else if ('alldays-oneemp' === $request->form_type) {

            //todo update each row not delete entire items
            //$dutyItems = [];
            foreach ($requestData as $item) {
                if( -1 == $item['id']) //a new date added. sometimes because we edit the old calender and add dates
                {
                    $newdutyItem = new DutyFormItem([
                        'date_id' => $item['date']['id'],
                        'fn_from' => $item['fn_from'],
                        'fn_to' => $item['fn_to'],
                        'an_from' => $item['an_from'],
                        'an_to' => $item['an_to'],
                        'total_hours' => $item['total_hours'],
                    ]);
    
                    $dutyForm->dutyItems()->save($newdutyItem);

                } else {
                    $dutyFormItem = DutyFormItem::find( $item['id'] );
                    $dutyFormItem->update ([
                        'date_id' => $item['date_id'],
                        'fn_from' => $item['fn_from'],
                        'fn_to' => $item['fn_to'],
                        'an_from' => $item['an_from'],
                        'an_to' => $item['an_to'],
                        'total_hours' => $item['total_hours'],
                        ]
                    );
                }
            }
               
       } else{ //all-all
            //since there may be new items if  edited, add todo
            //$dutyItems = [];
            foreach ($requestData as $item) {
                if( -1 == $item['id']) //a new employee added. sometimes because we change employee category. or add missing emps
                {
                    $newdutyItem = new DutyFormItem([
                        'employee_id' => $item['employee_id'],
                        'total_hours' => $item['total_hours'],
                        'all_ot_hours' => implode( ',',  $item['all_ot_hours']),
                        'all_ot_dayids' => implode( ',',  $item['all_ot_dayids']),
                    ]);
    
                    $dutyForm->dutyItems()->save($newdutyItem);

                } else{
                    $dutyFormItem = DutyFormItem::find( $item['id'] );
                    //$dutyItems[] = new DutyFormItem([
                    $dutyFormItem->update ([
                        'employee_id' => $item['employee_id'],
                        'total_hours' => $item['total_hours'],
                        'all_ot_hours' => implode( ',',  $item['all_ot_hours']),
                        'all_ot_dayids' => implode( ',',  $item['all_ot_dayids']),
                        
                    ]);
                }
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
       abort_if($dutyForm->owned_by_id != auth()->user()->id, Response::HTTP_FORBIDDEN, '403 Forbidden');
 
        $dutyForm->dutyItems()->delete();

        $dutyForm->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
    public function routes(Request $request, int $id )
    {
        $dutyForm = DutyForm::with(['owned_by', 'created_by'])->findOrFail($id);
      //  abort_if($dutyForm->owned_by_id != auth()->user()->id, Response::HTTP_FORBIDDEN, '403 Forbidden');
       // dump($dutyForm->owned_by->IsAdmin);

        $routes = [];

        if( $dutyForm->owned_by_id == auth()->user()->id &&  
            $dutyForm->owned_by_id != $dutyForm->created_by_id)
        {
            $routes['return'] = 'Send Back';
        }
        
        //see if there is a routing for this user

        if( $dutyForm->owned_by_id == auth()->user()->id && 
            !$dutyForm->owned_by->IsAdmin )
        {
            $route = Routing::where( 'user_id', $dutyForm->owned_by_id )->get();

            if($route?->count())
            {
              $routes['submit'] = 'Forward';
            } else {
              $routes['submit'] = 'Submit';
            }
        }


        return new DutyFormResource($routes);

    }

    public function route(Request $request)
    {
      

       $dutyForm = DutyForm::findOrFail($request->id);
     
       switch ($request->input('route')) {
        case 'submit':
            if( !$dutyForm->owned_by->IsAdmin )
            {
                $route = Routing::where( 'user_id', $dutyForm->owned_by_id )->first();
                //dump($route);
                if($route?->count())
                {
                  //Forward
                  $dutyForm->update( [
                    'owned_by_id' => $route->route->id,
                    'creator' => auth()->user()->displayname, 
                  ]);

                } else {

                    $admin = User::with(['roles' => function($q){
                        $q->where('title', 'Admin');
                    }])->first();

                    //Submit to HouseKeeping
                    $dutyForm->update( [
                        'owned_by_id' => $admin->id,
                        'approver' => auth()->user()->displayname, 
                   ]);
                }
            }
    
            break;

        case 'return':
            $dutyForm->update( [
                'owned_by_id' => $dutyForm->created_by_id,
           ]);
            break;
       
        }

        return (new DutyFormResource($dutyForm))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
            
    }
    
}
