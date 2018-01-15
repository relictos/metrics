<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Workers\Core\MetricsFactory;

class MetricsController extends Controller
{
    protected $metrics;

    public function __construct(MetricsFactory $metrics)
    {
      $this->metrics = $metrics;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $class = $this->metrics->getListWorker();
        $result = $class->displayList();
        return response()->json($result);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($filename)
    {
        try{
          $class = $this->metrics->getRecWorker($filename);
          $result = $class->displayInfo();
        }
        catch (\Exception $e){
          return response()->json(['code' => 500, 'message' => 'Error reading file'], 500);
        }

        return response()->json($result);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
           'file' => 'required'
        ]);

        $class = $this->metrics->getListWorker();
        $result = $class->uploadFile($request->file);
        if(!$result)
          die('Error while uploading file');

        //Возвращает обновленный список после загрузки файла
        $result = $class->displayList();
        return response()->json($result);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($filename)
    {
        $class = $this->metrics->getListWorker();
        $result = $class->removeFile($filename);
        if(!$result)
          die('Cannot remove file');

        //Возвращает обновленный список после удаления файла
        $result = $class->displayList();
        return response()->json($result);
    }
}
