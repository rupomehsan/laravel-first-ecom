<section id="slider"><!--slider-->
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<div id="slider-carousel" class="carousel slide" data-ride="carousel">

						<ol class="carousel-indicators">
							<li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
							<li data-target="#slider-carousel" data-slide-to="1"></li>
							<li data-target="#slider-carousel" data-slide-to="2"></li>
						</ol>

						<div class="carousel-inner" style="border: 5px solid #07d6502e;">
							@if (count($sliders))
							  @for ($i = 0; $i <= 2; $i++)
								<div class="item {{$i === 0 ? 'active' : ''}}">
									@for ($j=0; $j<3; $j++)
									<div class="col-sm-6">
										<h1>{{$sliders[$j]->heading}}</h1>
										<h2>{{$sliders[$j]->tiele}}</h2>
										<p>{{$sliders[$j]->descripsion}} </p>
										<button type="button" class="btn btn-default get">Get it now</button>
									</div>
									<div class="col-sm-6">
										<img src="{{asset($sliders[$j]->image)}}" class="girl img-responsive" alt="" />
										<img src="{{asset('client/images/home/pricing.png')}}"  class="pricing" alt="" />
									</div>
						        @endfor		
					          </div>
							  @endfor
							@endif
						</div>
						
						<a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
							<i class="fa fa-angle-left"></i>
						</a>
						<a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
							<i class="fa fa-angle-right"></i>
						</a>
					</div>
					
				</div>
			</div>
		</div>
</section><!--/slider-->