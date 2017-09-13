@extends('front.modules')

@section('title', trans('mrp.MODULE'))

@section('content')

  <div class="row">
    @include('front.templates.rapidaccess')
    <?php echo createBlock(asset('images/wms/box.gif'), "#", trans('wms.QRY_INVENTORY'), "success3",trans('wms.QRY_INVENTORY_T'));?>
    <?php echo createBlock(asset('images/wms/movsan.gif'), "#", trans('wms.MOV_WAREHOUSES'), "success3", trans('wms.MOV_WAREHOUSES_T'));?>
  </div>

@endsection
