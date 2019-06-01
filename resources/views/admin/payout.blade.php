@extends('admin.layout.base')

@section('title', $page)

@section('content')
<?php //print_r($providers); die;?>
    <div class="content-area py-1">
        <div class="container-fluid">
            <div class="box box-block bg-white">
            	<h3>{{$page}}</h3>

            
            	<div class="row">


						<div class="row row-md mb-2" style="padding: 15px;">
							<div class="col-md-12">
									<div class="box bg-white">
										<div class="box-block clearfix">
											<h5 class="float-xs-left">Payout</h5>
											<div class="float-xs-right">
											</div>
										</div>

										@if(count($providers) != 0)
								            <table class="table table-striped table-bordered dataTable" id="table-2">
								                <thead>
								                   <tr>
														<td>Provider ID</td>
														<td>Provider Name</td>
														<td>Admin Commission</td>
														<td>Provider Commission</td>
														<td>Admin Collected</td>
														<td>Provider Collected</td>
														
													</tr>
								                </thead>
								                <tbody>
								                <?php $diff = ['-success','-info','-warning','-danger']; ?>
														@foreach($providers as $provider)
														<?php //print_r($provider); die; ?>
															<tr>
																<td><a href="payout_details/{{$provider->id}}">{{$provider->id}}</a></td>
																<td>
																	{{$provider->first_name ." ".$provider->last_name  }}
																</td>
																<td>
																	{{$provider->admin_comm  }}
																</td>
																<td>
																	{{$provider->prov_comm  }}									
																</td>
																<td>{{$provider->with_admin  }}</td>
																<td>
																	{{$provider->with_provider  }}
																</td>
																

															</tr>
														@endforeach
															
								                <tfoot>
								                    <tr>
														<td>Provider ID</td>
														<td>Provider Name</td>
														<td>Admin Commission</td>
														<td>Provider Commission</td>
														<td>Admin Collected</td>
														<td>Provider Collected</td>
														
													</tr>
								                </tfoot>
								            </table>
								            @else
								            <h6 class="no-result">No results found</h6>
								            @endif 

									</div>
								</div>

							</div>

            	</div>

            </div>
        </div>
    </div>

@endsection
