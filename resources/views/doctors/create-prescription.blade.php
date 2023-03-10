@extends('layouts.doctors-master')
@section('title', 'Create Prescription')
@section('csslinks')
<style media="screen">
  .smallmargintop{
    margin-top: 10px;
  }

  .checkbox{
    opacity: unset !important;
    position: unset !important;
    width: 20px;
    pointer-events: unset !important;
  }
</style>
<link rel="stylesheet" href="/css/prescription-modal.css">
@endsection
@section('content')
<br>
<div class="container">
  <div class="row">
    <br>
    <div class="card col-8 s12 l6 offset-8">
      <form class="row nomarginbottom card-content" id="prescription-form" action="{{ route('doctors.prescriptions.store') }}" method="post">
        @csrf
        <input type="hidden" name="consultation_id" value="{{ $consultation->id }}">
        <p class="red-text col s12">{{$errors->first() ?? ''}}</p>
        <p class="flow-text center">Prescription for: {{ $consultation->patient()->first()->name }}</p>
        <h6 class="center">Illness: {{ $consultation->illness_title }}</h6>
        <div class="divider">

        </div>
        <div class="input-field col s12">
          <textarea name="care_taken" id="care_taken" class="materialize-textarea validate" data-length="500"></textarea>
          <label for="care_taken">Care To Be Taken</label>
          <span class="helper-text" data-error="Required*" data-success="">@error('care_taken') {{$message}} @enderror</span>
        </div>
        <!-- <div class="input-field col s12">
          <textarea name="medicines" id="medicines" class="materialize-textarea validate"></textarea>
          <label for="medicines">Medicines to be used</label>
          <span class="helper-text" data-error="Required*" data-success="">@error('medicines') {{$message}} @enderror</span>
        </div> -->
        @for($i=0; $i<=2; $i++)
        <div class="input-field col s12">
          <input type="text" name="medicines[{{$i}}][medicine]" id="medicines_{{$i}}">
          <label for="medicines_{{$i}}">Medicines</label>
        </div>
        <div class="input-field col s6">
            <input type="text" name="medicines[{{$i}}][timeline]" id="timeline_{{$i}}">
            <label for="timeline_{{$i}}">Timeline</label>
        </div>
        <div class="col s6">
            <p>Schedule</p>
            <input type="checkbox" class="checkbox" name="medicines[{{$i}}][schedule][morning]" value="morning" id="schedule_morning_{{$i}}">
            <label for="schedule_morning_{{$i}}">Morning</label>
            <input type="checkbox" class="checkbox" name="medicines[{{$i}}][schedule][midday]" value="midday" id="schedule_midday_{{$i}}">
            <label for="schedule_midday_{{$i}}">Midday</label>
            <input type="checkbox" class="checkbox" name="medicines[{{$i}}][schedule][night]" value="night" id="schedule_night_{{$i}}">
            <label for="schedule_night_{{$i}}">Night</label>
        </div>
        @endfor
        <div class="input-field col s12 center">
          <!-- <button type="button" class="btn blue longbuttons" id="previewprescription">Preview</button> -->
          <button type="button" id="submitbutton" class="btn blue waves-effect">Submit</button>
        </div>
        <div class="col s12 center small-text margintop">
          <a href="{{ route('doctors.index') }}" class="underlined">&larr; Back To Consultations</a>
        </div>
      </form>
      <div class="modal" id="prescriptionmodal">
        <div class="modal-content">
          <div class="row">
            <h5 class="center">{{ env('APP_NAME') }}</h5>
            <div class="divider">

            </div>
            <div class="col s12 l6">
              <p><b class="blue-grey-text">Doctor: </b>Dr. {{ $consultation->doctor()->first()->name }}</p>
            </div>
            <div class="col s12 l6">
              <p><b class="blue-grey-text">For Patient: </b>{{ $consultation->patient()->first()->name }}</p>
            </div>
            <div class="col s12">
              <p><b class="blue-grey-text">Illness: </b>{{ $consultation->illness_title }}</p>
            </div>
            <div class="col s12">
              <p class="nomarginbottom"><b class="blue-grey-text">Care to be taken:</b></p>
              <p class="smallmargintop" id="care_taken_holder">

              </p>
            </div>
            <div class="col s12">
              <p class="nomarginbottom"><b class="blue-grey-text">Medicines to be used:</b></p>
              <p class="smallmargintop" id="medicines_holder">

              </p>
            </div>
            <div class="col s12">
              <p class="grey-text"><small>Date: <span id="date_holder"></span></small> </p>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" id="submitbutton" class="btn blue waves-effect">Submit</button>
          <a href="#!" class="modal-close btn-flat waves-effect">Cancel</a>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@section('scripts')
<script src="/js/doctors-create-prescription.js" charset="utf-8"></script>
@endsection
