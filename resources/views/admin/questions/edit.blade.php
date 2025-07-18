@extends('layouts.backend.master') 
@push('styles')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/select2/select2.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/tagify/tagify.css')}}" />  
<link rel="stylesheet" href="{{asset('assets/vendor/libs/bootstrap-select/bootstrap-select.css')}}" />  
<link rel="stylesheet" href="{{asset('assets/vendor/libs/animate-css/animate.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/sweetalert2/sweetalert2.css')}}" />
@endpush
@section('page-content')
<div class="row justify-content-center mt-5">
      <div class="col-md-8 col-lg-6">
        <div class="card border-0 shadow rounded-3">
          <div class="card-header text-white text-center rounded-top ">
            <h5>Edit Question for: {{ $question->test->title ?? 'Test' }}</h5>
            <small class="text-light">Update question and answers below</small>
          </div>
    
          <div class="card-body p-4">
            <form method="POST" action="{{ route('admin.questions.update', $question->id) }}">
              @csrf
              @method('PUT')
    
              <div class="mb-3">
                <label class="form-label">Question Text</label>
                <textarea name="question_text" class="form-control" required>{{ $question->question }}</textarea>
              </div>
    
              <div class="mb-3">
                <label class="form-label">Options (mark the correct one)</label>
                @foreach ($question->options as $index => $option)
                  <div class="input-group mb-2">
                    <span class="input-group-text">
                      <input type="radio" name="correct_option" value="{{ $index }}"
                        {{ ($option->flags & \App\Models\Option::FLAG_IS_CORRECT) ? 'checked' : '' }}>
                    </span>
                    <input type="hidden" name="options[{{ $index }}][id]" value="{{ $option->id }}">
                    <input type="text" name="options[{{ $index }}][text]" class="form-control"
                      placeholder="Option {{ $index + 1 }}" value="{{ $option->option_text }}" required>
                  </div>
                @endforeach
              </div>
    
              <button type="submit" class="btn btn-primary">Update Question</button>
            </form>
          </div>
        </div>
      </div>
    </div>
    @endsection 
@push('scripts')
@endpush