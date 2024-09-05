<?php

namespace App\Http\Controllers;

use App\Models\Autorizaciones;
use Illuminate\Http\Request;
use App\Models\municipio;
use App\Models\provincia;
use Ramsey\Uuid\Type\Integer;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use App\Exports\AutorizacionesExport;

class AutorizacionesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        //$datos['autorizaciones']=Autorizaciones::orderBy('id', 'desc')->where('autstatus','=',1)
        /*$datos['autorizaciones']=Autorizaciones::orderBy('id', 'desc')
        ->where('tecid','=',auth()->user()->username)->paginate(5);

        $AutTotal=Autorizaciones::where('autstatus','=',1)->where('tecid','=',auth()->user()->username)->count('autstatus');
        $DosisTotal=Autorizaciones::where('autstatus','=',1)->where('tecid','=',auth()->user()->username)->sum('autdosis');
        $DosisAftosa=Autorizaciones::where('autstatus','=',1)->where('tecid','=',auth()->user()->username)->where('autvac','=','AFTOSA')->sum('autdosis');
        $DosisRabia=Autorizaciones::where('autstatus','=',1)->where('tecid','=',auth()->user()->username)->where('autvac','=','RABIA')->sum('autdosis');

        return view('autorizaciones.index',$datos)->with('DosisTotal',$DosisTotal)->with('DosisAftosa',$DosisAftosa)->with('DosisRabia',$DosisRabia)->with('AutTotal',$AutTotal);
        */
        $items=5; 
        if(strcmp(auth()->user()->username,'admin')==1){
            $datos['autorizaciones']=Autorizaciones::orderBy('id', 'desc')
            ->where('tecid','=',auth()->user()->username)->paginate($items);
            
            $AutTotal=Autorizaciones::where('autstatus','=',1)->where('tecid','=',auth()->user()->username)->count('autstatus');
            $DosisTotal=Autorizaciones::where('autstatus','=',1)->where('tecid','=',auth()->user()->username)->sum('autdosis');
            $DosisAftosa=Autorizaciones::where('autstatus','=',1)->where('tecid','=',auth()->user()->username)->where('autvac','=','AFTOSA')->sum('autdosis');
            $DosisRabia=Autorizaciones::where('autstatus','=',1)->where('tecid','=',auth()->user()->username)->where('autvac','=','RABIA')->sum('autdosis');
            
        }else {
            $datos['autorizaciones']=Autorizaciones::orderBy('id', 'desc')->paginate($items);
            
            $AutTotal=Autorizaciones::where('autstatus','=',1)->count('autstatus');
            $DosisTotal=Autorizaciones::where('autstatus','=',1)->sum('autdosis');
            $DosisAftosa=Autorizaciones::where('autstatus','=',1)->where('autvac','=','AFTOSA')->sum('autdosis');
            $DosisRabia=Autorizaciones::where('autstatus','=',1)->where('autvac','=','RABIA')->sum('autdosis');
            
        }
        
        
        return view('autorizaciones.index',$datos)->with('DosisTotal',$DosisTotal)->with('DosisAftosa',$DosisAftosa)->with('DosisRabia',$DosisRabia)->with('AutTotal',$AutTotal);
    }
    /*
     * Busqueda de autorizaciones por fecha
     */
    public function searchdate(Request $request)
    {
        /*
        $datos=request();
        echo "<br> Desde :".$datos['from_date'].'<br>';
        echo "<br> Hasta :".$datos['to_date'].'<br>';
        dd($datos);*/
        /*
        if(!empty($request->from_date) and !empty($request->to_date))
        {
            $datos['autorizaciones']=Autorizaciones::whereBetween('updated_at', array($request->from_date, $request->to_date))->first()
            ->where('tecid','=',auth()->user()->username)
            ->where(function($q) use ($request) {
                $q->where('autvac','like','%'.$request->patron.'%')
                ->orWhere('autprod','like','%'.$request->patron.'%')
                ->orwhere('autprop','like','%'.$request->patron.'%');
            })
            ->paginate(5);
            //ddd($request);
        }
        elseif(!empty($request->patron) )
        {
            $datos['autorizaciones']=Autorizaciones::where('tecid','=',auth()->user()->username)
            ->where('autvac','like','%'.$request->patron.'%')
            ->orwhere('autprod','like','%'.$request->patron.'%')
            ->orwhere('autprop','like','%'.$request->patron.'%')
            ->paginate(5);
            //ddd($request);
        }
        else{
            //$datos['autorizaciones']=Autorizaciones::where('autstatus','=',1)
            $datos['autorizaciones']=Autorizaciones::where('tecid','=',auth()->user()->username)
            ->paginate();
            //ddd($datos);
        }

        $AutTotal=Autorizaciones::where('autstatus','=',1)->where('tecid','=',auth()->user()->username)->count('autstatus');
        $DosisTotal=Autorizaciones::where('autstatus','=',1)->where('tecid','=',auth()->user()->username)->sum('autdosis');
        $DosisAftosa=Autorizaciones::where('autstatus','=',1)->where('tecid','=',auth()->user()->username)->where('autvac','=','AFTOSA')->sum('autdosis');
        $DosisRabia=Autorizaciones::where('autstatus','=',1)->where('tecid','=',auth()->user()->username)->where('autvac','=','RABIA')->sum('autdosis');
        */
        $items=5;
        if(!empty($request->export)){
            $items=1000;
        }
        
        if(!empty($request->from_date) and !empty($request->to_date))
        {
            /* Modificacion para el usuario admin*/
            if(strcmp(auth()->user()->username,'admin')==1){
                $datos['autorizaciones']=Autorizaciones::whereBetween('updated_at', array($request->from_date.' 00:00:00', $request->to_date.' 23:59:59'))
                ->orderBy('id', 'desc')
                ->where('tecid','=',auth()->user()->username)
                ->where(function($q) use ($request) {
                    $q->where('autvac','like','%'.$request->patron.'%')
                    ->orWhere('autprod','like','%'.$request->patron.'%')
                    ->orwhere('autprop','like','%'.$request->patron.'%');
                })
                ->paginate($items);
                //ddd($request);
            }else{
                $datos['autorizaciones']=Autorizaciones::whereBetween('updated_at', array($request->from_date.' 00:00:00', $request->to_date.' 23:59:59'))
                ->orderBy('id', 'desc')
                ->where(function($q) use ($request) {
                    $q->where('autvac','like','%'.$request->patron.'%')
                    ->orWhere('autprod','like','%'.$request->patron.'%')
                    ->orwhere('autprop','like','%'.$request->patron.'%');
                })
                ->paginate($items);
                //ddd($request);
                
            }
        }
        elseif(!empty($request->patron) )
        {
            if(strcmp(auth()->user()->username,'admin')==1){
                $datos['autorizaciones']=Autorizaciones::where('tecid','=',auth()->user()->username)
                ->orderBy('id', 'desc')
                ->where('autvac','like','%'.$request->patron.'%')
                ->orwhere('autprod','like','%'.$request->patron.'%')
                ->orwhere('autprop','like','%'.$request->patron.'%')
                ->paginate($items);
                //ddd($request);
            }else{
                $datos['autorizaciones']=Autorizaciones::where('autvac','like','%'.$request->patron.'%')
                ->orwhere('autprod','like','%'.$request->patron.'%')
                ->orwhere('autprop','like','%'.$request->patron.'%')
                ->orderBy('id', 'desc')
                ->paginate($items);
                //ddd($request);
                
            }
        }
        else{
            if(strcmp(auth()->user()->username,'admin')==1){
                //$datos['autorizaciones']=Autorizaciones::where('autstatus','=',1)
                $datos['autorizaciones']=Autorizaciones::where('tecid','=',auth()->user()->username)
                ->orderBy('id', 'desc')
                ->paginate($items);
                //ddd($datos);
            }else{
                //$datos['autorizaciones']=Autorizaciones::where('autstatus','=',1)
                $datos['autorizaciones']=Autorizaciones::where('autstatus','<>',2)
                ->orderBy('id', 'desc')
                ->paginate($items);
                //ddd($datos);
            }
        }
        if(strcmp(auth()->user()->username,'admin')==1){
            $AutTotal=Autorizaciones::where('autstatus','=',1)->where('tecid','=',auth()->user()->username)->count('autstatus');
            $DosisTotal=Autorizaciones::where('autstatus','=',1)->where('tecid','=',auth()->user()->username)->sum('autdosis');
            $DosisAftosa=Autorizaciones::where('autstatus','=',1)->where('tecid','=',auth()->user()->username)->where('autvac','=','AFTOSA')->sum('autdosis');
            $DosisRabia=Autorizaciones::where('autstatus','=',1)->where('tecid','=',auth()->user()->username)->where('autvac','=','RABIA')->sum('autdosis');
        }else{
            $AutTotal=Autorizaciones::where('autstatus','=',1)->count('autstatus');
            $DosisTotal=Autorizaciones::where('autstatus','=',1)->sum('autdosis');
            $DosisAftosa=Autorizaciones::where('autstatus','=',1)->where('autvac','=','AFTOSA')->sum('autdosis');
            $DosisRabia=Autorizaciones::where('autstatus','=',1)->where('autvac','=','RABIA')->sum('autdosis');
            
        }
        
        if(empty($request->export)){
        return view('autorizaciones.index',$datos)
                                                ->with('DosisTotal',$DosisTotal)
                                                ->with('DosisAftosa',$DosisAftosa)
                                                ->with('DosisRabia',$DosisRabia)
                                                ->with('AutTotal',$AutTotal)
                                                ->with('from_date',$request->from_date)
                                                ->with('to_date',$request->to_date)
                                                ->with('patron',$request->patron);
        }else{
            $datas=array();
            $data=array('id' => 'Autorizacion','autvac' =>' Vacuna','autprod' =>'Productor','autprop' =>'Propiedad','autdosis' =>'Dosis',
                'autprov' => 'Provincia','autmun' => 'Municipio', 'autloc' =>'Localidad','updated_at' =>'Fecha','autstatus' =>'Estado','autlocal'=>'DOSIS DESTINO');
            array_push($datas, $data);
            foreach($datos['autorizaciones'] as $autorizacion){
                $data=array('id' =>$autorizacion->id,'autvac' =>$autorizacion->autvac,'autprod' =>$autorizacion->autprod,'autprop' =>$autorizacion->autprop,'autdosis' =>$autorizacion->autdosis,
                    'autprov' =>$autorizacion->autprov,'autmun' =>$autorizacion->autmun, 'autloc' =>$autorizacion->autloc,'updated_at' =>$autorizacion->updated_at,'autstatus' =>$autorizacion->autstatus==1?'Activo':'Anulado','autlocal'=>$autorizacion->autlocal);
                array_push($datas, $data);
            }

            return \Excel::download(new AutorizacionesExport($datas), 'Autorizaciones.xlsx');
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $municipios=Municipio::all();
        $provincias=Provincia::all();
        return view('autorizaciones.create',compact('municipios','provincias'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        //$DatosAutorizacion=request()->all();
        $campos=[

            'autciclo' =>'required',
            'autvac' => 'required|string',
            'autprod' => 'required|string',
            'autprop' => 'required|string',
            'autdosis' => 'required|integer|min:1',
            'autprov' => 'required|string',
            'autmun' => 'required|string',
            'autmotivo' => 'required|string',            
        ];
        $Mensaje=["required" => 'El :attribute es requerido'];

        $this->validate($request,$campos,$campos);

        $DatosAutorizacion=request()->except('_token');
        ///ddd($DatosAutorizacion);
        if(strcmp($DatosAutorizacion['autvac'],'AFTOSA')==0){
           $DatosAutorizacion['autciclo']=$DatosAutorizacion['autciclo'].'42-2-2021';
        }else {
            $DatosAutorizacion['autciclo']='4-2021';
        }
        $DatosAutorizacion['autstatus']='1';

        if (isset($DatosAutorizacion['autlocal'])) {
           $DatosAutorizacion['autlocal']='LOCAL';
        }else{
            $DatosAutorizacion['autlocal']='GENERAL';
        }

        //ddd($DatosAutorizacion);


        Autorizaciones::insert($DatosAutorizacion);

        //return response()->json($DatosAutorizacion);
        return redirect('autorizaciones')->with('Mensaje','Autorización GENERADA con Éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Autorizaciones  $autorizaciones
     * @return \Illuminate\Http\Response
     */
    public function show(Autorizaciones $autorizaciones)
    {
        //
    }


    /* Show the form for editing the specified resource.

     @param  \App\Models\Autorizaciones  $autorizaciones
     @return \Illuminate\Http\Response
    */

    public function edit($id)
    {
        $autorizacion=Autorizaciones::findOrFail($id);
        $municipios=Municipio::all();
        $provincias=Provincia::all();

        return view('autorizaciones.edit', compact('autorizacion','provincias','municipios'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Autorizaciones  $autorizaciones
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $DatosAutorizacion=request()->except(['_token','_method']);

        if(strcmp($DatosAutorizacion['autvac'],'AFTOSA')==0){
            $DatosAutorizacion['autciclo']='42-2-2021';
        }else {
            $DatosAutorizacion['autciclo']='4-2021';
        }

        


        $DatosAutorizacion['autstatus']='1';
        
        if (isset($DatosAutorizacion['autlocal'])) {
            $DatosAutorizacion['autlocal']='LOCAL';
        }else{
            $DatosAutorizacion['autlocal']='GENERAL';
        }
        
        //ddd($DatosAutorizacion);

        Autorizaciones::where('id','=',$id)->update($DatosAutorizacion);

        //$autorizacion=Autorizaciones::findOrFail($id);

        //return view('autorizaciones.edit', compact('autorizacion'));

        return redirect('autorizaciones')->with('Mensaje','Autorización Nº'. $id .' MODIFICADA con Éxito');
    }

    public function anular($id)
    {
        $datos=Autorizaciones::findOrFail($id);

        $datos['autstatus']= ! $datos['autstatus'];
        $datos['autdosis']=  $datos['autdosis'];

        $data=['autstatus' => $datos['autstatus'],'autdosis' => $datos['autdosis']];
        //dd($datos['autdosis']);
        Autorizaciones::where('id','=',$id)->update($data);
        return redirect('autorizaciones');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Autorizaciones  $autorizaciones
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        //Autorizaciones::destroy($id);
        //Autorizaciones::where('id','=',$id)->update('autstatus','=',0);
        return redirect('autorizaciones');
    }

}
