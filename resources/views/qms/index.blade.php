@extends('front.modules')

@section('title', trans('tms.MODULE'))

@section('content')

  <div class="row">
    @include('front.templates.rapidaccess')
    <?php echo createBlock(asset('images/wms/whss.gif'), "#", trans('wms.QRY_INVENTORY'), "warning3", trans('wms.QRY_INVENTORY_T'));?>
    <?php echo createBlock(asset('images/wms/movsan.gif'), "#", trans('wms.MOV_WAREHOUSES'), "warning3", trans('wms.MOV_WAREHOUSES_T'));?>
  </div>
  <div class="row">
    <?php echo createBlock(asset('images/wms/movs.gif'), "#", trans('wms.DOC_ASSORTMENT'), "warning3", trans('wms.DOC_ASSORTMENT_T'));?>
    <?php echo createBlock(asset('images/wms/movss.gif'), "#", trans('wms.DOC_RETURNS'), "warning3", trans('wms.DOC_RETURNS_T'));?>
  </div>
  <div class="row">
    <?php echo createBlock(asset('images/wms/barcode.gif'), "#", trans('wms.LBL_GENERATION'), "warning3", trans('wms.LBL_GENERATION_T'));?>
    <?php echo createBlock(asset('images/wms/reports.gif'), "#", trans('wms.REPORTS'), "warning3", trans('wms.REPORTS_T'));?>
  </div>

@endsection
