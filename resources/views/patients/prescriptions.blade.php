@extends('layouts.patients-master')
@section('title', 'My Prescriptions')
@section('csslinks')
<link rel="stylesheet" href="/css/patients-prescription.css">
@endsection
@section('content')
<br>
<div class="container" id="parentcontainer">
  @if(session()->has('custommsg'))
  <p class="{{session()->get('classes')}} card custommsgs"><span>{{ session()->get('custommsg') }}</span><i class="material-icons small">{{ session()->get('icon') }}</i></p>
  @endif
  <div class="row">
    @forelse($consultations as $consultation)
    <div class="col s12 card">
      <div class="card-content row nomarginbottom">
        <div class="col s12">
          <span class="card-title">Illness: {{$consultation->illness_title}}</span>
          <p><b class="blue-grey-text">Prescription by - Dr. {{ $consultation->doctor()->first()->name }}</b></p>
        </div>
        @if($consultation->prescription_given == 0)
        <p class="margintop col s12"><small class="grey-text">Waiting for prescription*</small></p>
        @else
        @php
        $prescription = $consultation->prescription()->first();
        @endphp
        <div class="col s12">
          <div class="divider">

          </div>
        </div>
        <div class="col s12 l6 marginbottom pdivs">
          <p><b>Illness Description:</b></p>
          <p class="small-text">
            {!! nl2br($consultation->illness_description) !!}
          </p>
        </div>
        <div class="col s12 l6 marginbottom pdivs">
          <p><b>Surgery Details:</b></p>
          <p class="small-text">
            {!! nl2br($consultation->surgery_details) !!}
          </p>
        </div>
        <div class="col s12 marginbottom pdivs">
          <p><b>Illness timespan:</b></p>
          <p class="small-text">
            {!! nl2br($consultation->time_span) !!}
          </p>
        </div>
        <div class="col s12">
          <br>
        </div>
        <div class="col s12 zeropadding">
          <div class="col s12 l6 marginbottom pdivs">
            <p><b class="blue-grey-text">Care to be taken:</b></p>
            <p>
              {!! nl2br($prescription->care_taken) !!}
            </p>
          </div>
          <div class="col s12 l6 marginbottom pdivs">
              <p><b>Medicines:</b></p>
              @php
                $medicines = json_decode($prescription->medicines,true);
              @endphp
              <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Timeline</th>
                        <th>schedule</th>
                    </tr>
                </thead>
                <tbody>
                    @if( !empty( $medicines ) )
                    @foreach( $medicines as $target)
                        <tr>
                            <td>
                                {{ $target['medicine'] ?? '' }}
                            </td>
                            <td>
                                {{ $target['timeline'] ?? '' }}
                            </td>
                            <td>
                                @if($target['schedule'])
                                {{ implode(", ", $target['schedule'])  }}
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    @endif
                </tbody>
              </table>
            </div>
        </div>
        @php
        $consultdate = $consultation->created_at;
        $consultdate = date_create($consultdate);
        $consultdate = date_format($consultdate, "jS F Y");
        $prescriptiondate = $prescription->updated_at;
        $prescriptiondate = date_create($prescriptiondate);
        $prescriptiondate = date_format($prescriptiondate, "jS F Y");
        $prescriptionLink = $prescription->prescription_link;
        @endphp
        <div class="col s12 marginbottom pdivs">
          <br>
          <p><a href="{{ asset($prescriptionLink) }}" class="underlined">Download PDF</a></p>
        </div>
        <div class="col s12 l6 marginbottom pdivs">
          <small class="grey-text">Consulted At: {{ $consultdate }}</small>
        </div>
        <div class="col s12 l6">
          <small class="grey-text">Prescription Given At: {{ $prescriptiondate }}</small>
        </div>
        @endif
      </div>
    </div>
    @empty
    <p class="flow-text" id="emptymsg">No Prescriptions Found!</p>
    @endforelse
  </div>
</div>
@endsection
@section('scripts')
<!-- <script src="/js/patients-index.js" charset="utf-8"></script> -->
@endsection
