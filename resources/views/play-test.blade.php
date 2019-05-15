@extends('layouts.form')
@section('title', $story->title)
@section('page:styles')
<style>
{{-- #regForm {
    background-color: #ffffff;
    margin: 100px auto;
    padding: 40px;
    width: 70%;
    min-width: 300px;
  } --}}

  /* Style the input fields */
  {{-- input {
    padding: 10px;
    width: 100%;
    font-size: 17px;
    font-family: Raleway;
    border: 1px solid #aaaaaa;
  } --}}

  /* Mark input boxes that gets an error on validation: */
  input.invalid {
    background-color: #ffdddd;
  }

  /* Hide all steps by default: */
  .tab {
    display: none;
  }

  /* Make circles that indicate the steps of the form: */
  .step {
    height: 15px;
    width: 15px;
    margin: 0 2px;
    background-color: #bbbbbb;
    border: none;
    border-radius: 50%;
    display: inline-block;
    opacity: 0.5;
  }

  /* Mark the active step: */
  .step.active {
    opacity: 1;
  }

  /* Mark the steps that are finished and valid: */
  .step.finish {
    background-color: #4CAF50;
  }

  /* Toggle switch */
  /* The switch - the box around the slider */
.switch {
    position: relative;
    display: inline-block;
    width: 60px;
    height: 34px;
  }

  /* Hide default HTML checkbox */
  .switch input {
    opacity: 0;
    width: 0;
    height: 0;
  }

  /* The slider */
  .slider {
    position: absolute;
    cursor: pointer;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #ccc;
    -webkit-transition: .4s;
    transition: .4s;
  }

  .slider:before {
    position: absolute;
    content: "";
    height: 26px;
    width: 26px;
    left: 4px;
    bottom: 4px;
    background-color: white;
    -webkit-transition: .4s;
    transition: .4s;
  }

  input:checked + .slider {
    background-color: #2196F3;
  }

  input:focus + .slider {
    box-shadow: 0 0 1px #2196F3;
  }

  input:checked + .slider:before {
    -webkit-transform: translateX(26px);
    -ms-transform: translateX(26px);
    transform: translateX(26px);
  }

  /* Rounded sliders */
  .slider.round {
    border-radius: 34px;
  }

  .slider.round:before {
    border-radius: 50%;
  }

  /* Loader */

  .loader {
    border: 4px solid #f3f3f3; /* Light grey */
    /*border-top: 4px solid #3498db; /* Blue */
    border-top: 4px solid #bbb;
    border-radius: 50%;
    width: 15px;
    height: 15px;
    animation: spin 2s linear infinite;
    position: absolute;
    right: -30px;
    bottom: 7.5px;
    display: none;
  }

  @keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
  }

  /* Preference */
  .bord-round {
    border-radius: 30px !important;
  }

  .font-massive {
      font-size: 1.4em !important;
  }
</style>
@endsection

@section('content')

<section class="py-6 form-bg">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 mx-auto text-center text-white">
                        <h2>{{ $story->title }}</h2>
                        <p class="lead">
                            FILL THIS FORM, MAKE IT AS SILLY AS YOU CAN
                        </p>
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col-md-8 mx-auto">
                    <form class="play-game text-white" action="{{ route('story.generate', $story->id) }}" id="regForm" method="post">

                           {{ csrf_field() }}

                            <div class="row">
                                @foreach($formInputs as $key => $formInput)
                                <div class="col-md-12">
                                    <div class="form-group tab">

                                        <div>
                                            {{-- Rounded switch  --}}
                                            <label class="switch" title="Click to toggle wereywords hint">
                                                <input type="checkbox" id="hint" onchange="javascript:loadHints( '{{ $key }}', '{{ $formInput['wordgroup'] }}', '{{ $loop->index }}' )">
                                                <span class="slider round"></span>
                                                <div class="loader"></div>
                                            </label>

                                            <div style="display:inline-block; text-align:center; width:80%">
                                                <label for="{{ $key }}" class="font-massive">
                                                    <strong>{{ $formInput['wordgroup'] }}</strong>
                                                </label>
                                            </div>
                                        </div>
                                        <div id={{ 'div_'. $key }}>
                                            <input type="text" id="{{ $key }}" name="{{ $key }}" class="form-control bord-round font-massive" placeholder="{{ $formInput['placeholder'] }}" required>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>

                            <div style="overflow:auto;">
                                <div class="mt-3 text-center">
                                    <button class="btn btn-pink bord-round" data-size="sm" data-effect-parameter="horz-side" type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
                                    <button class="btn btn-info bord-round" data-size="sm" data-effect-parameter="horz-side"type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
                                </div>
                            </div>

                            <!-- Circles which indicates the steps of the form: -->
                            <div style="text-align:center;margin-top:40px;">
                                @for ($i = 0; $i < count($formInputs); $i++)
                                    <span class="step"></span>
                                @endfor
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
@endsection

@section('vendor:styles')
    <link rel="stylesheet" href="{{ asset('assets/front/css/foxholder.min.css') }}">
@endsection

@section('vendor:scripts')
    <script src="{{ asset('assets/front/js/foxholder.min.js') }}"></script>
@endsection

@section('page:scripts')
<script type="text/javascript">
$(document).ready(function(){
    jQuery('.play-game').foxholder({
    placeholderDemo: 6,
    buttonDemo: 6
  });
});

var currentTab = 0; // Current tab is set to be the first tab (0)
showTab(currentTab); // Display the current tab

function showTab(n) {
  // This function will display the specified tab of the form ...
  var x = document.getElementsByClassName("tab");
  x[n].style.display = "block";
  // ... and fix the Previous/Next buttons:
  if (n == 0) {
    document.getElementById("prevBtn").style.display = "none";
  } else {
    document.getElementById("prevBtn").style.display = "inline";
  }
  if (n == (x.length - 1)) {
    document.getElementById("nextBtn").textContent = "See your story!";
  } else {
    document.getElementById("nextBtn").textContent = "Next";
  }
  // ... and run a function that displays the correct step indicator:
  fixStepIndicator(n)
}

function nextPrev(n) {
  // This function will figure out which tab to display
  var x = document.getElementsByClassName("tab");
  // Exit the function if any field in the current tab is invalid:
  if (n == 1 && !validateForm()) return false;
  // Hide the current tab:
  x[currentTab].style.display = "none";
  // Increase or decrease the current tab by 1:
  currentTab = currentTab + n;
  // if you have reached the end of the form... :
  if (currentTab >= x.length) {
    //...the form gets submitted:
    document.getElementById("regForm").submit();
    return false;
  }
  // Otherwise, display the correct tab:
  showTab(currentTab);
}

function validateForm() {
  // This function deals with validation of the form fields
  var x, y, i, valid = true;
  x = document.getElementsByClassName("tab");
  y = x[currentTab].getElementsByTagName("input");
  // A loop that checks every input field in the current tab:
  for (i = 0; i < y.length; i++) {
    // If a field is empty...
    if (y[i].value == "") {
      // add an "invalid" class to the field:
      y[i].className += " invalid";
      // and set the current valid status to false:
      valid = false;
    }
  }
  // If the valid status is true, mark the step as finished and valid:
  if (valid) {
    document.getElementsByClassName("step")[currentTab].className += " finish";
  }
  return valid; // return the valid status
}

function fixStepIndicator(n) {
  // This function removes the "active" class of all steps...
  var i, x = document.getElementsByClassName("step");
  for (i = 0; i < x.length; i++) {
    x[i].className = x[i].className.replace(" active", "");
  }
  //... and adds the "active" class to the current step:
  x[n].className += " active";
}

function loadHints (fieldName, wordgroupName, currentIteration)
{
    let hintToggle = $('#hint');
    let parentDiv = $('#div_' + fieldName);
    let loader = $('.loader')
    loader.fadeIn()
    //alert($('#hint:checked').length)

    if ($("#hint:checked").length == 0) {
        let inputString = '<input type="text" id="'+ fieldName +'" name="'+ fieldName +'" class="form-control bord-round font-massive" placeholder="Type your own silly '+ wordgroupName.toLowerCase() +'" required>'
        parentDiv.html( inputString )
        loader.fadeOut()
        return
    }

    $.get(
        "{{ route('game.loadHints') }}",
        {
            fieldName: fieldName,
            wordgroupName: wordgroupName
        },
        function (data) {
            // debugger
            parentDiv.html(data)
            loader.fadeOut()
        }
    )
}
</script>
@endsection
