
@extends('layouts.master')
@section('css')

@section('title')
    empty
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
    empty
@stop
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
{{-- <div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                <p><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br></p>
            </div>
        </div>
    </div>
</div> --}}
    <div class="row">
      <div class="col-xl-12 mb-30">
        <div class="card card-statistics h-100">
          <div class="card-body">
           <h5 class="card-title">Faqs</h5>

     <div class="row">

        <div class="col-lg-12 col-md-12">
            <div class="tab nav-center">

                    <ul class="nav nav-tabs" role="tablist">
                      <li class="nav-item">
                        <a class="nav-link active show" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Url Api</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">integration</a>
                      </li>

                    </ul>

                    <div class="tab-content">
                      <div class="tab-pane fade active show" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <table id="datatable" class="table table-striped table-bordered p-0">
                            <thead>
                                <tr>
                                    <th>Api Name</th>

                                    <th>Function</th>
                                    <th>Data</th>

                                </tr>
                            </thead>


                            <tbody>

                                <tr>
                                    <td>http://localhost/API/api_auth_admin/api/products</td>
                                    <td>GET</td>
                                    <td>index</td>

                                  </tr>
                                <tr>
                                    <td>http://localhost/API/api_auth_admin/api/products</td>
                                    <td>POST</td>
                                    <td>store</td>

                                  </tr>
                                <tr>
                                    <td>http://localhost/API/api_auth_admin/api/products/{$id}</td>
                                    <td>PATCH</td>
                                    <td>update</td>

                                  </tr>
                                <tr>
                                    <td>http://localhost/API/api_auth_admin/api/products{$id}</td>
                                    <td>DELETE</td>
                                    <td>destroy</td>

                                  </tr>

                            </tbody>

                         </table>
                      </div>
                      <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Create New data</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="5" disabled="">
                                $response = Http::withHeaders([
                                    'Authorization' => '{{ Auth::user()->api_key }}'
                                ])->get('http://localhost/API/api_auth_admin/api/products');
                                return response()->json($response->json());
                            </textarea>
                        </div>                      </div>
                      <div class="tab-pane fade" id="portfolio" role="tabpanel" aria-labelledby="portfolio-tab">
                        <p>Benjamin Franklin, inventor, statesman, writer, publisher and economist relates in his autobiography that early in his life he decided to focus on arriving at moral perfection. He made a list of 13 virtues, assigning a page to each. Under each virtue he wrote a summary that gave it fuller meaning. Then he practiced each one for a certain length of time. To make these virtues a habit, Franklin can up with a method to grade himself on his daily actions.</p>
                      </div>
                      <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                        <p>The other virtues practice in succession by Franklin were silence, order, resolution, frugality, industry, sincerity, Justice, moderation, cleanliness, tranquility, chastity and humility. For the summary order he followed a little scheme of employing his time each day. From five to seven each morning he spent in bodily personal attention, saying a short prayer, thinking over the day’s business and resolutions.</p>
                      </div>
                    </div>


            </div>


</div>
     </div>

  </div>
 </div>
</div>
</div>
<!-- row closed -->
@endsection
@section('js')

@endsection
