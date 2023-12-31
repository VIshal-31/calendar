@extends('components.layout')

@section('title', 'Home')

@section('slot')


<div class="container my-4">
  <h2>Contact Form</h2>
  @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
  @endif
  @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
  @endif

  <form action="{{ route('submit.form') }}" method="POST">
    <!-- Form fields -->
    @csrf
    <div class="form-group">
      <label for="name">Name</label>
      <input type="text" class="form-control" name="name" id="name" placeholder="Enter your name">
    </div>
    <div class="form-group">
      <label for="email">Email</label>
      <input type="email" class="form-control" name="email" id="email" placeholder="Enter your email">
    </div>
    <div class="form-group">
      <label for="category">Category</label>
      <select class="form-control" id="category" name="category">
        <option value="">Please Select Category</option>
        @foreach ($categories as $category)
        <option id="{{ $category->id }}" value="{{ $category->name }}">{{ $category->name }}</option>
       @endforeach
      </select>
    </div>
    <div class="form-group">
      <label for="service">Service</label>
      <select class="form-control" id="service" name="service">
        <option value="">Select service</option>
      </select>
    </div>
    <div class="form-group">
      <label for="date">Date</label>
      <input type="date" class="form-control" id="date" name="date">
    </div>
    <div class="form-group">
      <label for="time">Time</label>
      <input type="time" class="form-control" id="time" name="time">
    </div>
    <div class="form-group">
      <label for="message">Message</label>
      <textarea class="form-control" id="message" name="message" rows="3" placeholder="Enter your message"></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
  
</div>

<!-- JavaScript -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#category').change(function() {
          var categoryId = $(this).find(':selected').attr('id');
        
            
            if (categoryId) {
                $.ajax({
                    type: "GET",
                    url: "/get-services/" + categoryId,
                    success: function(data) {
                        $('#service').empty();
                        $('#service').append('<option value="">Select service</option>');
                        $.each(data, function(key, value) {
                            $('#service').append('<option value="' + value.name + '">' + value.name + '</option>');
                        });
                    }
                });
            } else {
                $('#service').empty();
                $('#service').append('<option value="">Select service</option>');
            }
        });
    });
</script>



@endsection

