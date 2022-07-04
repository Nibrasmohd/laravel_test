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
 <div id="admin_section">
      <header>
             <h2 class="text-light">ADMIN</h2>
             <ul class="admin_name list-unstyled list_inline">
                <li class="list-inline-item me-4 text-light">HI , {{ session('ADMIN_NAME') }}</li>
                <li class="list-inline-item text-light"><a href={{ url('logout/admin') }}>LOGOUT</a></li>
             </ul>
      </header>
      <section id="col-wrap">
         <div class="left-col">
             <ul class="list-unstyled nav  listqus">
                <li class="nav-item" role="presentation">
                    <div class="nav-link" data-toggle="tab" role="tab"   data-target="#qusform">ADD QUESTION</div>
                  </li>
                  <li class="nav-item" role="presentation">
                    <div class="nav-link" data-toggle="tab" role="tab"   data-target="#qusshow">SHOW QUESTION</div>
                  </li>
             </ul>
         </div>
         <div class="right-col">
            <div class="tab-content">
                <div class="tab-pane show fade active" id="qusform" role="tabpanel">
                     <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-8">
                                <form action="{{ route('addqustions') }}" method="post" class="p-3 qus_form" style="height: 500px;overflow-y:auto;">
                                    @csrf
                                    <h4 class="text-center mb-3 text-muted">ADD QUESTION :</h4>
                                    <div class="mb-3 mt-2">
                                     <label for="exampleInputqus" class="form-label d-block">QUESTION :</label>
                                     <textarea name="qus" id="exampleInputqus"  class="form-control" cols="30" rows="2" ></textarea>
                                     @if ($errors->has('qus'))
                                     <p class="text-danger mt-2 ">{{ $errors->first('qus') }}</p>
                                     @endif
                                   </div>
                                   <div class="mb-3">
                                    <label for="exampleInputasn" class="form-label d-block">ANSWER :</label>
                                    <textarea name="ans" id="exampleInputasn"  class="form-control" cols="30" rows="2"></textarea>
                                    @if ($errors->has('ans'))
                                     <p class="text-danger mt-2 ">{{ $errors->first('ans') }}</p>
                                    @endif
                                   </div>
                                 <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Allotted time</label>
                                    <input type="number" class="form-control" placeholder="Eg : 2" name="times" >
                                    @if ($errors->has('times'))
                                     <p class="text-danger mt-2 mb 2">{{ $errors->first('times') }}</p>
                                    @endif
                                 </div>
                                 <div class="d-flex justify-content-center mt-5">
                                    <button type="submit" class="btn  btn-primary">SUBMIT</button>
                                 </div>
                                </form>
                            </div>
                        </div>
                     </div>
                </div>
                <div class="tab-pane fade" id="qusshow" role="tabpanel">
                     @if (isset($data[0]) )
                         <div class="container mt-3"  >
                           <div class="row justify-content-center">
                              <div class="col-10" >
                                 <table class="table table-striped" id="tablequs" >
                                    <thead class="thead-light">
                                       <tr>
                                          <th>NO :</th>
                                          <th>QUS</th>
                                          <th>ANS</th>
                                          <th>TIME (in min)</th>
                                         </tr>
                                    </thead>  
                                    <tbody>
                                       @foreach ($data as $item)
                                          <tr>
                                             <td>{{ $item->id }}</td>
                                             <td>{{ $item->qus }}</td>
                                             <td>{{ $item->ans }}</td>
                                             <td>{{ $item->allotted_time }}</td>
                                          </tr>
                                       @endforeach
                                    </tbody>     
         
                                  </table>
                              </div>
                           </div>
                         </div>
                     @else 
                       <div class="container">
                          <div class="row justify-content-cen">
                            <div class="col" style="margin-top: 150px">
                             <h3 class="text-center text-muted">NO QUESTIONS ARE THERE !!</h3>   
                           </div>  
                         </div> 
                       </div>    
                     @endif
                </div>
            </div>
         </div>
      </section>
 </div>

 
@endsection



