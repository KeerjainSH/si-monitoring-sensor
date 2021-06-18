@extends('adminlte::page', ['loggedin' => $loggedin])

@section('title', 'Monitoring')

@section('content_header')
    
<div class='card'>
<div class='card-header bg-primary'><b><i class="fas fa-satellite-dish"></i></b> Real Time Monitoring</div>
</div>

@stop

@section('content')
    
<div class='card'>
    <div class='card-header border'>
        <i class="fas fa-download"></i> Export PDF
    </div>
    <div class='card-body border'>
        <form action='/sensor/export' method='get'>
            <div class="container p-3">
                <label>Tanggal Awal</label>
                <input class="form-control mb-5" id='datepicker' type="text" name='tglawal' autocomplete='off' required>
                <label>Tanggal Akhir</label>
                <input class="form-control mb-3" id='datepicker2' type="text" name='tglakhir' autocomplete='off' required>
                <button class='btn btn-primary' type='submit'>Export</button>
            </div>
        </form>
    </div>
    <div class='card-footer border'>

    </div>
</div>
<!-- @if ($loggedin->level == 'admin')
<div class='card'>
    <div class='card-header border'>
        <i class="fas fa-upload"></i> Import Excel
    </div>
    <div class='card-body border'>
        @if (session('status'))
            <div class="alert alert-success mt-3" role='alert'>
                {{ session('status') }}
            </div>
        @endif
        <form action="{{ route('sensor.import') }}" method='post' enctype='multipart/form-data'>
        @csrf
            <div class="container p-3">
                <div class="custom-file mb-3">
                    <input type="file" name='excelFile' class="custom-file-input" id="customFile">
                    <label class="custom-file-label" for="customFile"></label>
                </div>
                
                <button class='btn btn-primary' type='submit'>Import</button>
            </div>
        </form>
    </div>
    <div class='card-footer border'>

    </div>
</div>
@endif -->
@stop

@section('css')
    
@stop

@section('js')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="/resources/demos/style.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
  $( function() {
      $( "#datepicker" ).datepicker({ dateFormat: 'yy-mm-dd' });
  } );

  $( function() {
      $( "#datepicker2" ).datepicker({ dateFormat: 'yy-mm-dd' });
  } );

  $(".custom-file-input").on("change", function() {
      var fileName = $(this).val().split("\\").pop();
      $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
  });

  var sync = function() {
    $.post("{{ route('syncExcel') }}") ;
  }
  setInterval(() => {
    sync();
  }, 5000);
</script>
@stop