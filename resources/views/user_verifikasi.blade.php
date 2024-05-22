@extends('layout.master')

@section('subheader')
	<div class="kt-subheader   kt-grid__item" id="kt_subheader">
		<div class=" kt-container  d-flex align-items-stretch justify-content-between ">
			<div class="kt-subheader__main">
				<h3 class="kt-subheader__title">
					Verifikasi User </h3>
				{{-- <div class="kt-subheader__breadcrumbs">
					<a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
					<span class="kt-subheader__breadcrumbs-separator"></span>
					<a href="" class="kt-subheader__breadcrumbs-link">
						Main Dashboard </a>
				</div> --}}
			</div>
			{{-- <div class="kt-subheader__toolbar">
				<div class="kt-subheader__wrapper">
					<a href="#" class="btn kt-subheader__btn-secondary">
						Pengajuan Penelitian
					</a>
				</div>
			</div> --}}
		</div>
	</div>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-2"></div>
    <div class="col-lg-8">

        <!--begin::Portlet-->
        <div class="kt-portlet">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title">
                        Aktivasi User <small>Verifikasi dan aktivasi user</small>
                    </h3>
                </div>
            </div>

            <div class="kt-portlet__body">
                <div class="kt-demo-icon">
                    <div class="kt-demo-icon__preview">
                        @if ($validasi)	
                            <i class="flaticon2-checkmark"></i>
                        @else
                            <i class="flaticon2-cancel"></i>	
                        @endif
                    </div>
                    <div class="kt-demo-icon__class">
                        {{$message}} </div>
                </div>
            </div>
            
            <!--end::Form-->
        </div>

        <!--end::Portlet-->
    </div>
    <div class="col-lg-2"></div>

</div>

@endsection


