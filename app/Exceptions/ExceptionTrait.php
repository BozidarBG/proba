<?php
namespace App\Exceptions;

use Illuminate\Http\Request;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpFoundation\Response; //mora ovaj simfoni
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

trait ExceptionTrait{

    public function apiException(Request $request, $e){
        //id modela ne postoji
        if($this->isModel($e)){
            return $this->model($e);
        }

        //loša ruta
        if($this->isHttp($e)){
            return $this->HttpResponse();
        }

        return parent::render($request, $e);
    }

    protected function isModel($e){
        return $e instanceof ModelNotFoundException;
    }

    protected function isHttp($e){
        return $e instanceof NotFoundHttpException;
    }

    protected function model(){
        return response()->json([
            'errors'=>'Model not found'
        ], Response::HTTP_NOT_FOUND);
    }

    protected function HttpResponse(){
        return response()->json([
            'errors'=>'Incorrect route'
        ], Response::HTTP_NOT_FOUND);
    }
}