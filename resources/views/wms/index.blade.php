@extends('front.modules')

@section('title', trans('wms.MODULE'))

@section('content')

  <div class="row">
    @include('front.templates.rapidaccess')
    <?php echo createBlock(asset('images/wms/warehouses.gif'), "#", trans('wms.QRY_INVENTORY'), trans('wms.QRY_INVENTORY_T'));?>
    <?php echo createBlock(asset('images/wms/movsan.gif'), "#", trans('wms.MOV_WAREHOUSES'), trans('wms.MOV_WAREHOUSES_T'));?>
  </div>
  <div class="row">
    <?php echo createBlock(asset('images/wms/movs.gif'), "#", trans('wms.DOC_ASSORTMENT'),  trans('wms.DOC_ASSORTMENT_T'));?>
    <?php echo createBlock(asset('images/wms/movss.gif'), "#", trans('wms.DOC_RETURNS'), trans('wms.DOC_RETURNS_T'));?>
  </div>
  <div class="row">
    <?php echo createBlock(asset('images/wms/barcode.gif'), "#", trans('wms.LBL_GENERATION'), trans('wms.LBL_GENERATION_T'));?>
    <?php echo createBlock(asset('images/wms/reports.gif'), "#", trans('wms.REPORTS'), trans('wms.REPORTS_T'));?>
  </div>

@endsection
