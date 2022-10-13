@extends('layouts.main')

@section('content')
        {{-- {{auth()->user()->id}} --}}
        
         <div class="row">
          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{$user}}</h3>

                <p>User</p>
              </div>
              <div class="icon">
                <i class="ion ion-android-person"></i>
              </div>
              <a href="{{route('user.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>{{$kiriman}}</h3>

                <p>Kiriman</p>
              </div>
              <div class="icon">
                <i class="ion ion-chatbox-working"></i>
              </div>
              <a href="{{route('kiriman.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-warning" style="color:white">
              <div class="inner">
                <h3>{{$layanan}}</h3>

                <p>Layanan</p>
              </div>
              <div class="icon">
                <i class="ion ion-clipboard"></i>
              </div>
              <a href="{{route('layananWeb.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>{{$produk}}</h3>

                <p>Produk</p>
              </div>
              <div class="icon">
                <i class="ion ion-social-dropbox"></i>
              </div>
              <a href="{{route('produkWeb.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-primary">
              <div class="inner">
                <h3>{{$agenda}}</h3>

                <p>Agenda</p>
              </div>
              <div class="icon">
                <i class="ion ion-android-calendar"></i>
              </div>
              <a href="{{route('agendaWeb.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!--<div class="row d-flex justify-content-around">-->
        <!--    <div class="card alert-success col-md-2 mr-1 mt-3" >-->
        <!--        <div class="card-body">-->
        <!--            <h4 style="text-align: center">-->
        <!--                <i class="fas fa-user nav-icon"></i>-->
        <!--                <h4 style="text-align: center">User</h4>-->
        <!--            <h4 style="text-align: center">{{$user}}</h4>-->
        <!--            </h4>-->
        <!--        </div>-->
        <!--    </div>-->
        <!--    <div class="card alert-success col-md-2 mr-1 mt-3" >-->
        <!--        <div class="card-body">-->
        <!--            <h4 style="text-align: center">-->
        <!--                <i class="fas fa-comment-alt nav-icon"></i>-->
        <!--                <h4 style="text-align: center">Kiriman</h4>-->
        <!--            <h4 style="text-align: center">{{$kiriman}}</h4>-->
        <!--            </h4>-->
        <!--        </div>-->
        <!--    </div>-->
        <!--    <div class="card alert-success col-md-2 mr-1 mt-3" >-->
        <!--        <div class="card-body">-->
        <!--            <h4 style="text-align: center">-->
        <!--                <i class="fas fa-list nav-icon"></i>-->
        <!--                <h4 style="text-align: center">Layanan</h4>-->
        <!--            <h4 style="text-align: center">{{$layanan}}</h4>-->
        <!--            </h4>-->
        <!--        </div>-->
        <!--    </div>-->
        <!--    <div class="card alert-success col-md-2 mr-1 mt-3" >-->
        <!--        <div class="card-body">-->
        <!--            <h4 style="text-align: center">-->
        <!--                <i class="fas fa-box-open nav-icon"></i>-->
        <!--                <h4 style="text-align: center">Produk</h4>-->
        <!--            <h4 style="text-align: center">{{$produk}}</h4>-->
        <!--            </h4>-->
        <!--        </div>-->
        <!--    </div>-->
        <!--    <div class="card alert-success col-md-2 mr-1 mt-3" >-->
        <!--        <div class="card-body">-->
        <!--            <h4 style="text-align: center">-->
        <!--                <i class="fas fa-calendar-alt nav-icon"></i>-->
        <!--                <h4 style="text-align: center">Agenda</h4>-->
        <!--            <h4 style="text-align: center">{{$agenda}}</h4>-->
        <!--            </h4>-->
        <!--        </div>-->
        <!--    </div>-->
        <!--</div>-->


        {{-- <div class="alert alert-success" role="alert">
            <h3><i class="fas fa-exclamation-circle"></i>&nbsp;Pengumuman</h3>
                <hr>
            Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ab nulla iusto maiores esse quis temporibus hic illo delectus nostrum molestias, fugiat non impedit doloremque laboriosam in minus, illum iste deleniti!
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Sapiente animi itaque laboriosam cupiditate saepe dicta eveniet delectus quasi quod ad esse repellat, molestias praesentium cumque labore a recusandae corporis ullam?
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aspernatur natus ex facilis expedita qui consectetur minus unde voluptates consequuntur fugit assumenda aliquid soluta quae eligendi, quisquam accusantium! Qui, deleniti obcaecati.
        </div>
        <br>
        <div class="alert alert-info" role="alert">
            <h3><i class="fas fa-info-circle"></i>&nbsp;Informasi</h3>
                <hr>
            Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ab nulla iusto maiores esse quis temporibus hic illo delectus nostrum molestias, fugiat non impedit doloremque laboriosam in minus, illum iste deleniti!
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Sapiente animi itaque laboriosam cupiditate saepe dicta eveniet delectus quasi quod ad esse repellat, molestias praesentium cumque labore a recusandae corporis ullam?
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aspernatur natus ex facilis expedita qui consectetur minus unde voluptates consequuntur fugit assumenda aliquid soluta quae eligendi, quisquam accusantium! Qui, deleniti obcaecati.
      </div> --}}


@endsection
