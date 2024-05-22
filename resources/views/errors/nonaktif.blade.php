@extends('base.aceadminlayout')
@section('content')
    <div class="page-content">
        <div class="user-profile row">
            <div class="col-xs-12">
				<div class="error-container">
					<div class="well">
						<h1 class="grey lighter smaller">
							<span class="blue bigger-125">
								<i class="ace-icon fa fa-random"></i>
								Please wait....
							</span>
						</h1>

						<hr />
						<h3 class="lighter smaller">
							Your account is not active, please wait until administrator is activated your account
							<i class="ace-icon fa fa-hourglass icon-animated-vertical bigger-125"></i>
						</h3>
						<div class="space"></div>
						<div>
							<h4 class="lighter smaller">Meanwhile, please watch our promotion below:</h4>
						    <a href="{{url('/')}}/format/duidev_profile.gif" target="_blank"><img src="{{url('/')}}/format/swandhana.gif" alt="Company Profile" width="100%"></a>
                        </div>
					</div>
				</div>
			</div>
        </div>
    </div>
@endsection