<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
	<meta charset="utf-8" />
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<link rel="icon" type="image/png" href="assets/img/favicon.ico">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>SALE</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
		<meta name="viewport" content="width=device-width" />


		<!-- Bootstrap core CSS     -->
		<link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet" />

		<!-- Animation library for notifications   -->
		<link href="{{asset('css/animate.min.css')}}" rel="stylesheet"/>

		<!--  Light Bootstrap Table core CSS    -->
		<link href="{{asset('css/light-bootstrap-dashboard.css?v=1.4.0')}}" rel="stylesheet"/>


		<!--  CSS for Demo Purpose, don't include it in your project     -->
		<link href="{{asset('css/demo.css')}}" rel="stylesheet" />


		<!--     Fonts and icons     -->
		<link href="{{asset('css/pe-icon-7-stroke.css')}}" rel="stylesheet" />
		<link rel="stylesheet" href="{{ asset('plugins/font-awesome/css/font-awesome.min.css') }}">

		<link rel="stylesheet" href="{{ asset('css/toastr.min.css') }}">

		<link rel="stylesheet" href="{{ asset('css/dataTables.bootstrap.min.css') }}">

		<script src="{{asset('js/jquery.3.2.1.min.js')}}" type="text/javascript"></script>
		<script src="{{asset('js/jquery.dataTables.min.js')}}" type="text/javascript"></script>
		<script src="{{asset('js/dataTables.bootstrap.min.js')}}" type="text/javascript"></script>

</head>
<body>

    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/accueil') }}">
                      <img src="{{asset('/uploads/images/logo1.png')}}" style="width: 80px; height: 45px;"alt="">
                    </a>
                </div>
						    <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav text-center">
											<li><a href="{{ route('reglement.index') }}" class="text-success"> <i class="pe-7s-cash" style="font-size: 40px;"></i> </a></li>

                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->


                            <li><a href="{{ route('accueil.index') }}" class="btn btn-info text-info">Gestion</a></li>
														<li>
																<a href="{{ route('logout') }}" class="btn btn-danger text-danger"

																		onclick="event.preventDefault();
																						 document.getElementById('logout-form').submit();">
																		Deconnexion
																</a>

																<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
																		{{ csrf_field() }}
																</form>
														</li>
                    </ul>
                </div>
            </div>
        </nav>

				<?php $produits = App\Produit::all(); $categories = App\Categorie::all(); ?>
				<section class="content-fluid">
				<div class="row" style="margin: 5px;">
				    <div class="card card-default  col-md-7" style="margin: 10px;">
				      <div class="card-header text-center">
				        <h4>PRODUITS</h4>
				      </div>
				    <div class="row">
				    <br>

				    <div class="card-body">
				      <table id="datatable" class="table table-striped">
				        <thead>
				          <th class="text-center">Libelle</th>
				          <th>Prix(FCFA)</th>
									<th>Categorie</th>
									<th>Place</th>
				          <th>Action</th>
				        </thead>
				        <tbody id="tbody">
				          @if($produits->count() > 0)
				            @foreach($produits as $p)
										  @foreach($categories as $c)
											 @if($c->id == $p->id_categorie)
				                <tr>
				                  <td class="text-center"> {{ $p->libelle }}</td>
				                  <td> {{ $p->prix }}</td>
													<td>{{$c->libelle}}</td>
													<td> {{ $p->lieu }}</td>
				                  <td>

				                  <form >

				                    <select class="form-control form-control-sm" id="{{$p->id}}">
				                      <?php
				                        $i = 1;
				                        while($i <= 100)
				                        {
				                          ?>
				                            <option value="{{$i}}">{{$i}}</option>
				                          <?php
				                          $i++;
				                        }
				                      ?>
				                    </select>

				                    <a onclick="ajouter({{$p->id}})" class="btn btn-primary">
				                        <i class="pe-7s-cart" style="font-size: 16px;"></i>
				                    </a>

				                    </form>
				                  </td>
				                </tr>
												@endif
											 @endforeach
				              @endforeach
				            @else
				              <tr>
				                <td colspan="5" class="text-center"> Aucun produit !</td>
				              </tr>
				            @endif
				        </tbody>

				      </table>
				    </div>
				  </div>
				</div>

				    <div class="card card-default col-md-4" style="margin: 10px;">
				      <div class="card-body">

							<div class="form-group col-md-6">
								<label for="">Serveuse :</label>
								<select class="form-control" name="" id="serveuse">
									@foreach(App\Serveuse::all() as $s)
									<option value="{{$s->prenom}}">{{$s->prenom}}</option>
									@endforeach
								</select>
							</div>

							<div class="form-check col-md-6">
								<input type="radio" id="table" name="table_chaise" value="table">
								<label for="table" class="form-check-label">Table</label>

								<input type="radio" id="chaise" name="table_chaise" value="chaise">
								<label for="chaise" class="form-check-label">Chaise</label>

								<select class="form-control" name="" id="tcs">
									<?php $j = 1;
										while($j <= 30)
										{
											?>
											<option value="{{$j}}">{{$j}}</option>
											<?php
											$j++;
										}
									?>
								</select>
							</div>

				        <table class="table table-striped">
				          <thead>
				            <th>Libelle</th>
				            <th>Prix</th>
				            <th>Quantite</th>
				            <th>Montant</th>
				            <th>Action</th>
				          </thead>
				          <tbody id="tbody-panier">

				          </tbody>
				        </table>
				      </div>
				    </div>

				</section>

				<script>
				  $(document).ready(function(){
				    $("#myInput").on("keyup", function() {
				        var value = $(this).val().toLowerCase();
				        $("#tbody tr").filter(function() {
				        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
				      });
				    });
				  });

				  $('#datatable').DataTable();

					lister();

				  $.ajaxSetup({
				    headers: {
				      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				    }
				  });


				  function ajouter(id)
				  {
				    var qte = $('#'+id).val();
				    $.ajax({
				      type: 'POST',
				      dataType: 'json',
				      data: {id:id, qte:qte},
				      url: '/vente',
				      success: function(response){
								lister();
				      }
				    });

				  }

				  function lister()
				  {
				    $.ajax({
				      type: "GET",
				      dataType: "json",
				      url: "/panier",
				      success: function(response){
				        var rows = "";
				        var total = 0;
				        $.each(response, function(key, value){
				          rows = rows + "<tr>";
				          rows = rows + "<td>"+ value.libelle + "</td>";
				          rows = rows + "<td>"+ value.prix + "</td>";
				          rows = rows + "<td>"+ value.quantite + "</td>";
				          rows = rows + "<td>"+ value.montant+ "</td>";
				          rows = rows + "<td><button class='btn btn-danger' onclick='supprimer(" + value.id +")'>Annuler</button></td>";
				          rows = rows + "</td></tr>";
				          total = total + value.montant;
				        });
				        if(total != 0)
				        {
				          rows = rows + "<tr class='text-center bg-white'><td colspan='5'><h4> TOTAL : "+total+" FCFA</h4></td></tr>";
				          rows = rows + "<tr class='text-center bg-white'><td colspan='5'><a  onclick='redirect();'  class='btn btn-primary text-center'>Confirmer</a></td></tr>";
								}
				        $('#tbody-panier').html(rows);
				      }
				    });

				  }

					function redirect()
					{

						var get_serveuse = document.getElementById('serveuse');
						var serveuse = get_serveuse.options[get_serveuse.selectedIndex].value;

						var get_tcs = document.getElementById('tcs');
						var tcs = get_tcs.options[get_tcs.selectedIndex].value;

						var table_chaise = $("input[name='table_chaise']:checked").val();


						window.location.href = '/facture-pdf/'+ serveuse +'/'+ table_chaise +'-'+ tcs;
					}

				  function supprimer(id)
				  {
				    $.ajax({
				      type: "DELETE",
				      dataType: "json",
				      url: '/panier/'+id,
				      success: function(response){
				        lister();
				      }
				    });
				  }

				</script>
				<!--   Core JS Files   -->
		  <script src="{{asset('js/bootstrap.min.js')}}" type="text/javascript"></script>

			<!--  Charts Plugin -->
			<script src="{{asset('js/chartist.min.js')}}"></script>

		    <!--  Notifications Plugin    -->
		    <script src="{{asset('js/bootstrap-notify.js')}}"></script>

		    <!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
			<script src="{{asset('js/light-bootstrap-dashboard.js?v=1.4.0')}}"></script>

			<!-- Light Bootstrap Table DEMO methods, don't include it in your project! -->
			<script src="{{asset('js/demo.js')}}"></script>


		    <script src="{{ asset('js/toastr.min.js') }}"></script>

				<script type="text/javascript">
						 @if(Session::has('warning'))
								$(document).ready(function(){

										demo.initChartist();

										$.notify({
												icon: 'pe-7s-angle-down-circle',
												message: "{{Session::get('warning')}}"

										},{
												type: 'warning',
												timer: 4000
										});

								});
						@endif

						@if(Session::has('info'))
								$(document).ready(function(){

										demo.initChartist();

										$.notify({
												icon: 'pe-7s-info',
												message: "{{Session::get('info')}}"

										},{
												type: 'info',
												timer: 4000
										});

								});

						@endif
				</script>

    <!-- Scripts -->

		<!--   Core JS Files   -->
	<script src="{{asset('js/bootstrap.min.js')}}" type="text/javascript"></script>
</body>
</html>
