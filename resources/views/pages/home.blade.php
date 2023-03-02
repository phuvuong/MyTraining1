@extends('welcome')
@section('content')
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Contacts</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{URL::to('/home')}}">Home</a></li>
            <li class="breadcrumb-item active">Contacts</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="card-header">
        <div><a class="alert alert-success btn-small "  role="alert" href="{{ route('add.product') }}">Thêm sản phẩm</a></div>
    </div>
    <!-- Default box -->
    <div class="card card-solid">
     
      <div class="card-body pb-0">
       
        <div class="row">
          @foreach($all_product as $key => $pro)
          <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
            
            <div class="card bg-light d-flex flex-fill">
            
              <div class="card-header text-muted border-bottom-0">
                {{ $pro->category_name }}
              </div>
              
              <div class="card-body pt-0">
                <div class="row">
                  <div class="col-7">
                    <h2 class="lead"><b>{{ $pro->product_name }}</b></h2>
                    
                    <p class="text-muted text-sm"><b>Brand: </b>
                     
                      {{ $pro->brand_name }} 
                      </p>
                     
                       

                    <ul class="ml-4 mb-0 fa-ul text-muted">
                      <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> Price: {{ number_format($pro->product_price,0,',','.')}}VND</li>
                      <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> Content:{{ $pro->product_content }}</li>
                    </ul>
                  </div>
                  <div class="col-5 text-center">
                    <img src="{{ asset('uploads/backend/product/' . $pro->product_image) }}" width="100px" alt="user-avatar" class="img-circle img-fluid">
                  </div>
                </div>
              </div>
              <div class="card-footer">
                <div class="text-right">
                
                   <form action="{{ route('delete.product',['product_id' => $pro->product_id]) }}" method="post" onsubmit="return confirm('Are you sure you want to delete this')">
                    @csrf
                    @method('delete')
                    <button type="submit">
                      <i class="fas fa-trash"></i>
                    </button>
                   </form>
                    
                  </a>
                  <a href="{{ route('show.product',['product_id' => $pro->product_id]) }}" class="btn btn-sm btn-primary">
                    <i class="fas fa-user"></i> View Profile
                  </a>
                  {{--  <a href="{{ route('add.gallery',['product_id' => $pro->product_id]) }}" class="btn btn-sm btn-primary">
                    Up Gallery
                  </a>  --}}
                </div>
              </div>
              
            </div>
            
          </div>
          
          @endforeach
        </div>
        
      </div>
      
      <!-- /.card-body -->
      <div class="card-footer">
        <nav aria-label="Contacts Page Navigation">
          <ul class="pagination justify-content-center m-0">
            {{ $all_product->links() }}
           
          </ul>
        </nav>
      </div>
      <!-- /.card-footer -->
    </div>
    <!-- /.card -->

  </section>
  
@endsection
