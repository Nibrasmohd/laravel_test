@extends('layout')
@section('content')
  
   @if (session()->has('alertmsg'))
   <div class="alert alert-{{ session('alertcolor') }} alert-dismissible fade show" id="alertmssg" role="alert">
      {{ session('alertmsg') }}
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
      </button>
   </div>
   @endif
 <div id="user_section">
      <header>
             <h2 class="text-light">USER</h2>
             <ul class="admin_name list-unstyled list_inline">
                <li class="list-inline-item me-4 text-light">HI , {{ session('USER_NAME') }}</li>
                <li class="list-inline-item text-light"><a href="{{ url('logout/user') }}">LOGOUT</a></li>
             </ul>
      </header>
      <section>
          <div class="container">
            <div class="row mt-5 justify-content-center">
              <div class="col-10">
                  <div class="card">
                    <div class="card-body">
                        @if (!empty($qus['id']))
                            <h3 class="text-center text-muted">ANSWER IT !!</h3>
                            <h4 id="time" class="text-right text-muted"></h4>
                            <div class="mt-3">
                                <p class="text-muted">question :</p>
                                <h3>{{ $qus['qus'] }} ?</h3>
                            </div>
                            <div class="mt-3">
                                <form action="{{ route('homepage.ansqus') }}" method="post" id="anssubform">
                                    @csrf
                                    <p class="text-muted">answers :</p>
                                    <input type="text" name="enterdans" class="form-control" required>
                                    <input type="text" hidden value="{{ $qus['allotted_time'] }}" id="allottime">
                                    <input type="text" hidden value="{{ $qus['id']  }}" name="qusid">
                                    <div class="d-flex justify-content-center mt-3">
                                        <button type="submit" class="btn  btn-primary">SUBMIT</button>
                                    </div>
                                </form>
                            </div> 
                        @endif
                        @if (isset($qusadmin))
                        <div class="container">
                            <div class="row justify-content-cen">
                              <div class="col" style="margin-top: 150px">
                               <h3 class="text-center text-muted">{{ $qusadmin }}</h3>   
                             </div>  
                           </div> 
                         </div> 
                        @endif
                        @if (isset($score))
                            <div class="container py-5">
                              <div class="row justify-content-center">
                                <div class="col-12 d-flex justify-content-center align-items-center">
                                    @if ($score == $tot)
                                    <h3 class="text-center d-inline  text-success">Congratulations You scored {{ $score }}/{{ $tot }} <h5 class="ml-3"><a href="{{ url('/home/ansqus/tryagain') }}" > Try again!</a></h5></h3>  
                                    @elseif ($score == 0)
                                    <h3 class="text-center d-inline  text-danger">SORRY !!  <h5 class="ml-3"><a href="{{ url('/home/ansqus/tryagain') }}" > Try again!</a></h5></h3> 
                                    @else
                                      <h3 class="text-center d-inline  text-muted">YOUR SCORE IS <h1 class="d-inline ml-3 text-danger"> {{ $score }} </h1> <h5 class="ml-3"><a href="{{ url('/home/ansqus/tryagain') }}" > Try again!</a></h5></h3> 
                                    @endif
                                </div>  
                            </div> 
                            </div>
                        @endif
                        
                        

                    </div>
                  </div>
              </div>
            </div>
          </div>
      </section>
 </div>
 
@endsection
<script>
        function startTimer(duration, display) {
            var timer = duration, minutes, seconds;
            setInt=setInterval(timerfun, 1000);
            function timerfun() {
                minutes = parseInt(timer / 60, 10);
                seconds = parseInt(timer % 60, 10);

                minutes = minutes < 10 ? "0" + minutes : minutes;
                seconds = seconds < 10 ? "0" + seconds : seconds;

                display.textContent = minutes + ":" + seconds;

                if ( --timer < 0) {
                    clearInterval(setInt);
                    $('#anssubform').submit();
                }
            }
       }

    window.onload = function () {
        var fiveMinutes = 60 * $('#allottime').val();
            display = document.querySelector('#time');
        startTimer(fiveMinutes, display);
    };
</script>