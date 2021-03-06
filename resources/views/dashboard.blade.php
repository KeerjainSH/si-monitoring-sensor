@extends('adminlte::page', ['loggedin' => $loggedin])

@section('title', 'Dashboard')

@section('content_header')
<div class='card'>
<div class='card-header bg-primary'><b><i class="fas fa-satellite-dish"></i></b> Real Time Monitoring</div>
</div>
@stop

@section('content')

<div class='card'>
    <div class='card-body bg-light border'>
        <table class='table table-striped table-hover table-bordered mb-sm-3'>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Sensor 1</th>
                    <th>Sensor 2</th>
                    <th>Sensor 3</th>
                    <th>Sensor 4</th>
                </tr>
            </thead>
            <tbody class='sensorTable'>
                <div class="">
                    <!-- <tr>
                        <td>No</td>
                        <td>Sensor 1</td>
                        <td>Sensor 2</td>
                        <td>Sensor 3</td>
                        <td>Sensor 4</td>
                        <td>Sensor 5</td>
                    </tr> -->
                </div>
            </tbody>
        </table>
        
    </div>
    @if ($loggedin->level == 'admin')
    <div class='card-footer border' style='background-color:#f7f7f7'>
        @if (session('status'))
            <div class="alert alert-success my-3" role='alert'>
                {{ session('status') }}
            </div>
        @endif
        <div class="card-columns">
        @forelse($sensorstatus as $sensor)
            <div class='card bg-light align-items-center'>
                <div class='card-header'>
                    {{$sensor->name}}
                    <button class="btn btn-sm btn-primary float-right disabled">
                        {{ $sensor->status == 1 ? 'On' : 'Off' }}
                    </button>
                </div>
                <div class='card-body'>
                    <div class="btn-group">
                        <a type='button' href="{{ route('sensor.status', [$sensor->id, '1']) }}" class='btn btn-success'>ON</a>
                        <a type='button' href="{{ route('sensor.status', [$sensor->id, '0']) }}" class='btn btn-warning'>OFF</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="alert alert-warning my-3" role='alert'>
                Status Table is Empty
            </div>
        @endforelse
            
        </div>
    </div>
    @endif
</div>
@stop

@section('css')
    
@stop

@section('js')
    
<script>
  var data
  var updateData = function() {
    $.post("{{ route('syncExcel') }}") ;
    $.ajax({
      url: "{{ route('fetchData') }}",
      type: 'GET',
      dataType: 'json',
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      success: function(data) {

        var resultTag = "" ;
        var i = 0 ;
        var len = data.length ;
        
        $.each(data, function(){
            var j = len-i ;
            resultTag += 
            "<tr>" +
                "<td>" + j + "</td>" +
                "<td>" + data[i]['sensor1'].toFixed(2) + "</td>" +
                "<td>" + data[i]['sensor2'].toFixed(2) + "</td>" +
                "<td>" + data[i]['sensor3'].toFixed(2) + "</td>" +
                "<td>" + data[i]['sensor4'].toFixed(2) + "</td>" +
            "</tr>"
            i += 1 ;
        }) ;
        $('.sensorTable').html(resultTag) ;
      },
      error: function(data){
        console.log(data);
      }
    });
  }
  
  updateData();
  setInterval(() => {
    updateData();
  }, 5000);
</script>
@stop