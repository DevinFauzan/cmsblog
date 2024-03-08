@extends('layouts.welcome')

@section('content')

<section class="page-wrapper">
	<div class="container">
		<button onclick="goBack()" class="page-title-icon bg-gradient-primary me-2">
			<i class="mdi mdi-arrow-left"></i>
			Go Back
		</button>
		<div class="row">
			<div class="col-md-12">
				<div class="post post-single">
					<h2 class="post-title">{{ $blogPost->judul }}</h2>
					<div class="post-meta">
			            <ul>
							<li>
								<i class="ion-calendar"></i> {{ $blogPost->created_at->format('l, d F Y') }}

							  </li>
			              <li>
			                <i class="ion-android-people"></i>POSTED BY <b>{{ $blogPost->user->name }}
			              </li>
			              {{-- <li>
			                <a href=""><i class="ion-pricetags"></i> LIFESTYLE</a>,<a href=""> TRAVEL</a>, <a
			                href="">FASHION</a>
			              </li> --}}
			              
			            </ul>
		          	</div>
					<div class="post-thumb">
						<img src="{{ asset('storage/' . $blogPost->media_nama) }}" alt="{{ $blogPost->judul }}" />
					</div>
					<div class="post-content post-excerpt">
						{!! $blogPost->deskripsi !!}
				    </div>
				    <div class="post-comments-form">
				    	<h3 class="post-sub-heading">Leave You Comments</h3>
				    	<form method="post" action="#" id="form" role="form" >

				            <div class="row">

				                <div class="col-md-6 form-group">
				                    <!-- Name -->
				                    <input type="text" name="name" id="name" class=" form-control" placeholder="Name *" maxlength="100" required="">
				                </div>

				                <div class="col-md-6 form-group">
				                    <!-- Email -->
				                    <input type="email" name="email" id="email" class=" form-control" placeholder="Email *" maxlength="100" required="">
				                </div>


				                <div class="form-group col-md-12">
				                    <!-- Website -->
				                    <input type="text" name="website" id="website" class=" form-control" placeholder="Website" maxlength="100">
				                </div>

				                <!-- Comment -->
				                <div class="form-group col-md-12">
				                    <textarea name="text" id="text" class=" form-control" rows="6" placeholder="Comment" maxlength="400"></textarea>
				                </div>

				                <!-- Send Button -->
				                <div class="form-group col-md-12">
				                    <button type="submit" class="btn btn-main ">
				                        Send comment
				                    </button>
				                </div>


				            </div>

				        </form>
				    </div>


				</div>

			</div>
		</div>
	</div>
</section>
@endsection

<script>
	function goBack() {
    window.history.back();
}

</script>