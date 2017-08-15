@extends('front.mainHome')
<br />
<br />
@section('title', trans('userinterface.titles.SELECT_MODULE'))

@section('content')
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-2"></div>
      <div class="col-md-8"><h1>Manufacturing Resources Planning</h1></div>
      <div class="col-md-2"></div>
    </div>
    <div class="row">
      <div class="col-md-2"></div>
      <div class="col-md-4"><a href="{{ route('wms.home') }}" class="btn btn-primary3 button-xlarge btn3d" role="button">Módulo Almacenes</a></div>
      <div class="col-md-4"><a href="{{ route('mms.index') }}" class="btn btn-warning3 button-xlarge btn3d">Módulo Producción</a></div>
      <div class="col-md-2"></div>
    </div>
    <div class="row">
      <div class="col-md-2"></div>
      <div class="col-md-4"><a href="{{ route('tms.index') }}" class="btn btn-success3 button-xlarge btn3d">Módulo Embarques</a></div>
      <div class="col-md-4"><a href="{{ route('qms.home') }}" class="btn btn-info3 button-xlarge btn3d">Módulo Calidad</a></div>
      <div class="col-md-2"></div>
    </div>
  </div>
  <br />
  <br />
@endsection
