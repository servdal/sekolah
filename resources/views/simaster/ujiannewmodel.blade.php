@extends('adminlte3.layoutujian')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6"><h1>Online Based Test</h1></div>
                <div class="col-sm-6 pull-right">{{$jenisujian}}</div>
            </div>
        </div>
    </section>
    <section class="content">
        
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary shadow">
                    <div class="card-header">
                        <h3 class="card-title">Click Pada Nomor Soal di Bawah ini Untuk Memulai</h3>
                        <div class="card-tools">
                            <h5 id="timeremaining"><i class="fa fa-info"></i> Note:</h5>
                        </div>
                    </div>
                    <div class="card-body" id="listsoal">
                        @php
                            $urutan 	= 1;
                            $i 			= 0;
                            $sebelumnya = 0;
                            $setelahnya = 0;
                            $soal 		= 0;
                            $acaknum 	= 0;
                            $mulai      = date('Y-m-d H:i:s');
                            $akhir      = date('Y-m-d H:i:s');
                            $timer      = 0;     
                            $listsoalkb	= [];
                        @endphp
                        @if(isset($listsoal) && !empty($listsoal))
                            @foreach($listsoal as $getsoal)
                                @php
                                    if ($timer == 0){
                                        $mulai 	= $getsoal->mulai;
                                        $akhir 	= $getsoal->selesai;
                                        $timer 	= $getsoal->timer;
                                    }
                                    $listsoalkb[$i]['id']   		= $getsoal->id;
                                    $listsoalkb[$i]['deskripsi']   	= $getsoal->deskripsi;
                                    $listsoalkb[$i]['lampiran']   	= $getsoal->lampiran;
                                    $listsoalkb[$i]['lampiran2']   	= $getsoal->lampiran2;
                                    $listsoalkb[$i]['lampiran3']   	= $getsoal->lampiran3;
                                    $listsoalkb[$i]['lampiran4']   	= $getsoal->lampiran4;
                                    $listsoalkb[$i]['lampiran5']   	= $getsoal->lampiran5;
                                    $listsoalkb[$i]['lampiran6']   	= $getsoal->lampiran6;
                                    $listsoalkb[$i]['idsebelum']   	= $sebelumnya;
                                    $listsoalkb[$i]['sudah']   		= 0;
                                    $listsoalkb[$i]['urutan']  		= $urutan;
                                    $listsoalkb[$i]['seta']  		= $getsoal->opsia;
                                    $listsoalkb[$i]['setb']  		= $getsoal->opsib;
                                    $listsoalkb[$i]['setc']  		= $getsoal->opsic;
                                    $listsoalkb[$i]['setd']  		= $getsoal->opsid;
                                    $listsoalkb[$i]['sete']  		= $getsoal->opsie;
                                    $listsoalkb[$i]['jawaban']  	= $getsoal->jawaban;
                                    $listsoalkb[$i]['tipesoal']  	= $getsoal->tipesoal;
                                    $sebelumnya 					= $getsoal->id;
                                    if ($i == 0){
                                        $setelahnya 				= $getsoal->id;
                                    } else {
                                        $nodesebelum 								= $i - 1;
                                        $listsoalkb[$nodesebelum]['idsetelah']   	= $getsoal->id;
                                    }
                                    $i++;
                                    $urutan++;
                                @endphp
                            @endforeach
                            @php
                                $nodesebelum 								        = $i - 1;
                                $listsoalkb[$nodesebelum]['idsetelah']   	        = 0;
                            @endphp
                        @endif
                        @if(isset($listsoalkb) && !empty($listsoalkb))
                            @foreach($listsoalkb as $row)
                                @php 
                                    if (isset($row['idsebelum'])){
                                        $idsebelum = $row['idsebelum'];
                                    } else {
                                        $idsebelum = 0;
                                    }
                                    if (isset($row['idsetelah'])){
                                        $idsetelah = $row['idsetelah'];
                                    } else {
                                        $idsetelah = 0;
                                    }
                                @endphp
                                @if($row['jawaban'] == '')
                                    <a href="#" id="{{$row['id']}}" urutan="{{$row['urutan']}}" idsebelum="{{$idsebelum}}" idsetelah="{{$idsetelah}}" class="btnpill"><span class="bs-stepper-circle" id="step-{{$row['id']}}">{{ $row['urutan'] }}</span></a>
                                @else
                                    <a href="#" id="{{$row['id']}}" urutan="{{$row['urutan']}}" idsebelum="{{$idsebelum}}" idsetelah="{{$idsetelah}}" class="btnpill"><span class="bs-stepper-circle btn-success" id="step-{{$row['id']}}">{{ $row['urutan'] }}</span></a>
                                @endif
                                <input type="hidden" class="jawaban" id="jawaban_{{$row['id']}}" value="{{$row['jawaban']}}">
                                <input type="hidden" id="tipesoal_{{$row['id']}}" value="{{$row['tipesoal']}}">
                                <input type="hidden" id="lampiran_{{$row['id']}}" value="{{$row['lampiran']}}">
                                <input type="hidden" id="lampiran2_{{$row['id']}}" value="{{$row['lampiran2']}}">
                                <input type="hidden" id="lampiran3_{{$row['id']}}" value="{{$row['lampiran3']}}">
                                <input type="hidden" id="lampiran4_{{$row['id']}}" value="{{$row['lampiran4']}}">
                                <input type="hidden" id="lampiran5_{{$row['id']}}" value="{{$row['lampiran5']}}">
                                <input type="hidden" id="lampiran6_{{$row['id']}}" value="{{$row['lampiran6']}}">
                                <div style="overflow: hidden; display: none;">
                                    <textarea id="deksripsi_{{$row['id']}}">{{$row['deskripsi']}}</textarea>
                                    @if ($row['tipesoal'] == 'esay')
                                    <textarea id="opsia_{{$row['id']}}"></textarea>
                                    @else 
                                    <textarea id="opsia_{{$row['id']}}">{{$row['seta']}}</textarea>
                                    @endif
                                    <textarea id="opsib_{{$row['id']}}">{{$row['setb']}}</textarea>
                                    <textarea id="opsic_{{$row['id']}}">{{$row['setc']}}</textarea>
                                    <textarea id="opsid_{{$row['id']}}">{{$row['setd']}}</textarea>
                                    <textarea id="opsie_{{$row['id']}}">{{$row['sete']}}</textarea>
                                </div>
                            @endforeach
                        @endif
                    </div>
                    <div class="card-footer">
                        <a href="#" class="btn btn-danger pull-right btnlogout"> <i class="fa fa-sign-out"></i> Click Untuk Akhiri Ujian</a><br />
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card card-success shadow">
                    <div class="card-header">
                        <h3 class="card-title" id="judul">Case Description</h3>
                        <div class="card-tools"><span id="min">00</span>:<span id="sec">00</span></div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <p id="deskripsi"></p>
                            </div>
                            <div class="col-md-6">
                                <table width="100%" border="0" class="table table-striped" cellpadding="0" cellspacing="0" id="divawal">
                                    <tr>
                                        <td width="5%" valign="top" align="center">A</td>
                                        <td width="30%" valign="top"><p id="opsia"></p></td>
                                        <td width="3%">&nbsp;</td>
                                        <td width="5%" valign="top" align="center">B</td>
                                        <td width="30%" valign="top"><p id="opsib"></p></td>
                                    </tr>
                                    <tr>
                                        <td colspan="5">&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td valign="top" align="center">C</td>
                                        <td valign="top"><p id="opsic"></p></td>
                                        <td>&nbsp;</td>
                                        <td valign="top" align="center">D</td>
                                        <td valign="top"><p id="opsid"></p></td>
                                    </tr>
                                    <tr>
                                        <td colspan="5">&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td valign="top" align="center">E</td>
                                        <td valign="top"><p id="opsie"></p></td>
                                        <td colspan="3">
                                            <div class="input-group input-group-lg">
                                                <select id="id_jawaban" class="form-control-lg">
                                                    <option value="">Jawaban Anda .?</option>
                                                    <option value="A">Option A</option>
                                                    <option value="B">Option B</option>
                                                    <option value="C">Option C</option>
                                                    <option value="D">Option D</option>
                                                    <option value="E">Option E</option>
                                                </select>
                                                <input type="hidden" id="idne">
                                                <div class="input-group-append">
                                                    <div class="btn btn-primary btn-lg" id="btn-simpan">
                                                        <i class="fa fa-pencil"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="btn btn-warning btn-lg pull-left" id="btnprevious">
                                                <i class="fa fa fa-arrow-circle-left"></i>
                                            </div>
                                        </div>
                                        <div class="col-md-8 center">
                                            
                                        </div>
                                        <div class="col-md-2">
                                            <div class="btn btn-info btn-lg pull-right" id="btnnext">
                                                <i class="fa fa fa-arrow-circle-right"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="divesay">
                                    <div class="form-group">
                                        <label for="esay_jawaban">Tulis Jawaban Anda di Bawah Ini</label>
                                        <textarea id="esay_jawaban" rows="10" cols="20"></textarea>
                                    </div>
                                    <button class="btn btn-warning pull-left" type="button" id="btnopenpaper">Buka Kertas Kosong</button>
                                    <button class="btn btn-success pull-right" type="button" id="btnupdatedataps">Simpan</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card card-info card-outline" id="divpaper">
                    <div class="card-header">
                        <h3 class="card-title">Paper</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" id="btntutupkertas"><i class="fa fa-ban"></i></button>
                            <button type="button" class="btn btn-tool" id="btnclearttd"><i class="fa fa-magic"></i></button>
                            <button type="button" class="btn btn-tool" id="btnundo"><i class="fa fa-mail-reply"></i></button>
                            <button type="button" class="btn btn-tool" id="btnredo"><i class="fa fa-mail-forward"></i></button>
                            <button type="button" class="btn btn-tool btnsavefrompaper"><i class="fa fa-save"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row col-12 kotakttd">
                            <div class="signature-pad">
                                <div id="canvas-wrapper" class="signature-pad--body">
                                    <canvas id="signature-pad"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <canvas id="signature-blank" style='display:none'></canvas>
                        <button type="button" class="btn btn-primary btnsavefrompaper"><i class="fa fa-save"></i> Save</button>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                
                <div class="card card-warning card-outline" id="divcanvas">
                    <div class="card-header">
                        <h3 class="card-title">Image Viewer</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-2" >
                                            <a href="#" id="esayimagenumber1" data-toggle="lightbox" data-title="Picture 01" data-gallery="gallery">
                                                <img id="esaypreview" src="{{ url('/') }}//dist/img/takadagambar.png?text=Pic1" class="img-fluid mb-2" alt="white sample" />
                                            </a>
                                        </div>
                                        <div class="col-sm-2" >
                                            <a href="#" id="esayimagenumber2" data-toggle="lightbox" data-title="Picture 02" data-gallery="gallery">
                                                <img id="esaypreview2" src="{{ url('/') }}//dist/img/takadagambar.png?text=Pic2" class="img-fluid mb-2" alt="white sample" />
                                            </a>
                                        </div>
                                        <div class="col-sm-2" >
                                            <a href="#" id="esayimagenumber3" data-toggle="lightbox" data-title="Picture 03" data-gallery="gallery">
                                                <img id="esaypreview3" src="{{ url('/') }}//dist/img/takadagambar.png?text=Pic3" class="img-fluid mb-2" alt="white sample" />
                                            </a>
                                        </div>
                                        <div class="col-sm-2" >
                                            <a href="#" id="esayimagenumber4" data-toggle="lightbox" data-title="Picture 04" data-gallery="gallery">
                                                <img id="esaypreview4" src="{{ url('/') }}//dist/img/takadagambar.png?text=Pic4" class="img-fluid mb-2" alt="white sample" />
                                            </a>
                                        </div>
                                        <div class="col-sm-2" >
                                            <a href="#" id="esayimagenumber5" data-toggle="lightbox" data-title="Picture 05" data-gallery="gallery">
                                                <img id="esaypreview5" src="{{ url('/') }}//dist/img/takadagambar.png?text=Pic5" class="img-fluid mb-2" alt="white sample" />
                                            </a>
                                        </div>
                                        <div class="col-sm-2" >
                                            <a href="#" id="esayimagenumber6" data-toggle="lightbox" data-title="Picture 06" data-gallery="gallery">
                                                <img id="esaypreview6" src="{{ url('/') }}//dist/img/takadagambar.png?text=Pic6" class="img-fluid mb-2" alt="white sample" />
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <label class="inline">
                                    <small class="lighter">Width:</small>
                                </label>
                                <div id="btnslider"></div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <img class="media-object" id="preview" src="{{ url('/') }}/dist/img/takadagambar.png?text=Pic1" />
                    </div>
                </div>
                
            </div>
            <div class="col-md-12" id="divselesai">
                <div class="error-page">
                    <h2 class="headline text-danger"><i class="fa fa-warning"></i></h2>
                    <div class="error-content">
                        <h3><strong>Waktu Habis</strong></h3>
                        <p id="waktuserver"></p>
                        Ujian Ini Hanya Bisa di Kerjakan di Rentang {{$mulai}} s/d {{$akhir}} dengan Durasi {{$timer}} menit sejak pertama kali laman ini dibuka
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<div id="tempatctk" style="overflow: hidden; display: none;">
    <div id="tabel_cetak"></div>
    <input type="text" class="form-control" id="id_mahasiswa" value="{{$idmahasiswa}}">
    <button class="btn btn-success pull-right" type="button" id="btnsimpanesaiauto">Simpan</button>

</div>
<style>
    .kotakttd {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-pack: center;
        -ms-flex-pack: center;
        justify-content: center;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
        height: 100vh;
        width: 100%;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        margin: 0;
        padding: 3px 3px;
        background: url('data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAGQAAABkCAYAAABw4pVUAAAb1UlEQVR4nHXdy3Xj2BJE0TuGCXSDdtAN2kE3aAfcgB10g2+gOtBWNt5AS1USeD/5iYwIsqvX+/3ens/ndr/ft/v9vh3Hse37vt1ut23f9+31em33+3273W7b4/HYjuPY7vf79nq9trXWdrvdttfrdX7dbrftOI7t+Xxu7/d7O45jezwe2+fz2R6Px7bv+7nf6/XaHo/H9nq9tn3ft/f7vd3v9+3z+Wzf7/dc6/1+/zlLa38+n+04ju3z+Wz3+/187jiO89njOLa11vb9frfH47Hdbrft+/1un8/nPO/tdtuez+e27/v5zOv12j6fz/b5fLa11rbv+/nnz+ezPZ/P7fP5bO/3+z8xejwe2/P53NZa5/fu9P1+t+M4zvh2tu63SkgPtZkXaKPP53M+836/z8U7eJftciWhNdq4RBWIEl2iuuRa69y3Ink+n+d5S2pJN6Ez0T1fMgv6WusspvYtMcXi+Xyed9j3/bx365q0+Xx3KiHv9/v8ut1u555nguZDVkkbFuTb7XZeqtdVSWutc5MC2SHrhIJilVRRVbJdZ/ANYs8XgIqk4Bd0O6R9u2N/L6EVUK+tqAro4/E416s7SqLdUDF414qjovl+v2fhFYu6ZQUjQpYHr6pboCSVAKt13/ezkgusXVLAvZRd2QWsxqq/S5mQEl9Aqm6LQggySc/nc3u9Xtv3+z3PZUKs9tbp2aCneBTDCrPk1SE9I5J0fiH99Xr9dEiBrBI6kD8r4AWyaqyjSoDzqNd3qTC/IHYxX1/FFtyCV+IMpu1eURSIgl3BTPiqc+vSnmvP0KDAi/ndyfnVWq7fa01K56hL+vMZh4Jblm3vWTVt3ldBLtNVn8F6v99nVXWJhmqBrsJ7fWdybpS0gic2m5gSHZQ2JwyqUNi+xaDnSnKJqSvbv3Xba862irWzdV6humQZi1UAOmyJCdtsNTcr8LWybd3vCkhBs7qFkw5TMKykOkZmJnMpafMc3ctkVaUGVnyXjMzZcxzHnzUjKc5VmWDrzucqiO4uo308HttyILahENWB+ioQBrALGNDWqiK6UAeps6yWukBKWsWbyF5bxcmyhAThpUqcRRWstKczpnPWDXVkv694pbrd23VLaPct1pf370JN/DZusR6UiXUQ4aUKqcJKaHgqM7JrpMDhf4XgbKhICrh02TPHdrqog7Vua73OUteJ7RWA0CxpkKj0u/btzyKPFN15VgdVbKtLK8S6qGyipAVfUuECfvX3mM0cvl6qJPeznu/ndYnVLv+vALrDLBjXdn07WFp7BucfbbfzhZ9mp/FpXsmg2sP1ZH3F+H6//ySkVuxiVpEqsuzLz6v6Lmm1FYDw1A5osDskxVYrs0NXcSY/OBF2dQik5AVRyip0OEtmR9jJfjkbFc/OxpLdeYpFQ92CW11UmHK4CUcOOAd12S8YsTAZj5S2TinRvkaxNoWVMyKoLXjiducRGq/0hbaFVF5i4PC1Wwq4RKX9LFY7p4LsTsqIczYqCEvMhBKrr4VlIFWFynjaDSVAPq54qkJUzlPrqG7tPl2DIGNqjumB6Ux0lpIjCakQtDrsttadJMWzTWtGVBICP5/PthROYZz4W0Bn56gvPLywMqm0B+rZLqcN0uVV7xZOVTddBqHIWSLUFpjOeWXNOCPUGuqGuloUmBTWGaGa904K0Ofz+cOyelAlLe5qtmkN6KK2RhVeAoUNkxV02SleUqjpmS7t8xVRFab+mVUvztdJkz1aFHXDJAp1qnNC6JP2m2SFt6xPRraEqCpWuhvsqOidAZpsLV6SotG9Xt0ifBXYXiOEtr/BEuZMiN6UuKyqL1ESALWOToRU2g7rrCVtdts0JOfAVwLo7621fiBLauqQrgOELeeEl9a7kSF18QJdUDpUMyGodGAbUOdIAXIu9NXanaEBbgfKbhz0dq0zTHe2gOsiqPrtIuM5Z5Po45lWQe7iwZammW1vVjtEl1IJ6x9ZhXaGs8dOqq21M9IFfbVfwVK8/T8l3vo6AYo1v19pCTtJZjgLQXgs6NJzY1zBN/hXEORgUijOi0qDO4hdU4JU7jGOLmH1ddCeV4tYsSXYrmvPzq23JcSozDX75sxyyJaUU7BRYL6+RM/4aaxKUHrWc5jAVXXbAVbPbPEy3N+1JcTvKmpaEHaWyttDBX9qFZV/GkLu3zknVKjWhRih0IQbeB0DtVd76h4It+0TIkjrS4qWSvsdx/E3IQUrPBWLlf4FRCYiBE0qWyUHZ0Hk9IUm9Y4c6O46MLVj6mIv3h7OQhnWHOomt8KTWPi8SXVGKGztMJlhRSBROmGyIKgy28DLay+0uTaLbqwaxAsYQN8TcaB6eFW+1ozus6q8100WVwBKdM8pgH3GuSEJ0eZplvS9GHnOEmuBOEtN+Pm2dxcuUIqvAl97TidU1duM6OC2sFhdZVrlUt8Oro1jgOviOSSnVnEQ20UWkpClU2BRTCGoe9AdvF/3La7t6b0rdqH4hCxhQGo6/RnFVcmQ/eg/6dfYHXVByVUhe6nW03q4EqMmtmT3/GRpkgQFrJTcPQvclaHpm3D9XBNWZW+haiuJDNLkNU0/Z4Hm4vR/CmAD3BkjpsqyumTwp7nn4KwQdAiuFLRzQBPSewSZFZwdJUOad7XAjIf7q4GuCnh6ZxWHDkJrnZDV5ucPxvvPXdA37L2swZv2SRsbICvTpMo2pJayuyvRpmNgRcrgptEp5qtPVOpVfWfvfBWX8GrhtY4sMng0OUJid/l8Ptsq6FLaqq02MvsGukO2WFWkop/JsnquWIuB1cJQV+ghNa8UkMGFsGHROX8MePea76ELO7HFK/o/9VTQZfdOV9tu3ff9NyGKHAfuZEC2Z1jfYdzYznHg2lVd1sSLqbWy7Ky9pZV2lsxKpT7NReeCbyVMShq81o1CeneWDOhwSE66n3ZMBSupOs3FMF+RYguaiDSC8CX9FBocplosVlvBswOEu/bR0JOlVNV1SBBb1+tpdS5hRVbkXPgTKIiLRSgKeO/gb+oN46Br0ZnPhLh4wVVV2iUOuF4z+bo4q7jsmQIlY2qdimEGWPWvmu7yWjUluMQIj86T1i2h3c+3mKW7fYUQ7S1c9XvZndptCldft6SUZV7hdGXaaabZXYqxgqc1rZBUmYfH2iZ1jYO8YKppeq3Y7p1Krup82iiKQuHFedO9petBmrqm32sTqbEsDIuzYlxtYjYdqh2sQIiLtrpBN0AdTNNvDvESWTvPgelAnV7TtCim5SN11Reza+2ukiYcO5N6tkS5j5pHS8ozlTBn9R/hW2XqN9nOVoZ0V7GoptCL8mBzxliRUk55vhS15Kjs1Up2yvzgRl/CsEGw85wBE1JU5u3XgHdOSmzsJtexkILI4zh+3sKt0n2nT/tDHPx/lFCF3/NnG67fT4z3vKo/JqOeaE3fydPwk810UYuryvT3zaKetfvFd+HOu8r06twpBB38nUNV7vysMITQVcWIk3P6i7EeoEWsYiFLiLCznAlaLwa/v/shg87aRat6u+qsNIaswqvASMNLfEES3kxQ553zrDtaiNo6EqEKvvN6l+fz+ZOQHiw4siyzP2miargFrfqJv76BZfAdeLV+pKJuukp+3aQXZlUGKecnOnj7QIo9mZOCU19PLeYbUsXN+JWckEH06AzO5JMk2OotrqjSLEzFmwSxuMzLJFpT2mtCZUZBRp0pAyq4MRshojNYrTIY1b/ve/hmmtWuFaIqdzbVCcJmRdH80MoRNVrDOdyaS2yrQjqMlsW0PhQ3Zb/vqtA5zObsKAl6W8JmFVx16Q64lvCjkKzr7No6rfVcR9XdGlMYO6eExhKta24S6xZ1m1C91vr5KGlVICzZjnLlkqOd0aXsKiujNTxAF2lvK632l10VALFdJd48KQBXbK5ElBjXnkreypXWS3/dcxIhxaoEQCfAvUKXVeU4M1SOBUBI0i6p+rQ0ZsUXfB1bHVaHuupYBS9dLVEyGbtJM7COnszHJHV+dcjUWwXU10/2pLWk6PU8dmsx/6P4C9wUhVJIcbTqKyFu0t+nrR12T2uhPVW66gedgKBCgVnXtYddUNAmMwxSJSoSB4PaOSyuXifUdf/mZLDf69RfziVp9jln5PQGqIvLVKY5KGzIsFTxao6GpR/dkZL2bHtMlaugE0KmKq6ip4AU2uZ80ypSTFb5Ehs1ltAk/DvgjVvncSZr9yxnhGJl4qmfGmkBLRf9rysbWmfXtzGtsmaHM8bOmDrGgSvkdIdmlo6BbE4rRp/qqnqFFe/oDOguFpfOgsRDQd1z3+/3x8vqYRWjw0vGpMCTKsv/rbICX/uXBAfvDHzB8rNZwuB0D/THglLfQHPuqGGqbElMiVEHCaHOtJ6fat/nfJ1wL+ss/vu+/9BeRZcHkAZ6UCFOvt9a4bQtqbk24cU2d8jrCJtwz9fezagp9ubv2sMgSQbqjF4bLCsInW0VijOvGaKu0VKZg94z/PkoqfxdiuZFHfwKxF6n43ri4vr9DyOdN+Fo7VrQHX7TILS6Ta5uc/v0nA5Bz3jXOT/by+JTCF8J2CBM/0xB7HeJhLpn3/dfHaJl0Vdw1EJl2Xb3QNowXt5BVvd0aH2r9rOtLZA560674d8cmN6RnpJB9UN/Ogcqe/0z56nao+KQAgs/Mr7m6AlNfDix+O/7/tMh+jxVlMJFLHTQ9zotFA+nJSJj0xNypsw/O1Mm9jtQr7Beqly39foJGULHdAS6U3GRQsuU5gccnEu6xv1dGBXalhcWqmwzu6eqkwVpHfSc3lGQoe1iB1mpwqGqX6qoHTKZ05XtUfdZPKd3xDuNOq/SXAtIiOx7RaRtolA84Wit/xSieuf5/PeftE0+f6pG3hFT9MiwprXQRlOz9GftGZVxAdLv8m1XLRrXsdqaXVJo3QSh1E6r8qt+g29hSAL8u5rM85cUR8Ic7ML07Xb7nSFlsj9baVJH6aHeTr8TNrqUw9HusBKdF4q3zqCV4dwKqoQj59n82KlzxQ7RhzPoJb+fqZm6V8+WBAWxzLRzCF0lrb+vxJFQJKOq+q2CMuvBrBAhQejTPpCrF2z9KOeWtr5moYXjvjoCik/hTYYlxW+dXi90VSizAIXjzt/rJuO8YmGd6ziO338NyAOfqnH9/udjXcyF/fLDBylXPS8vKzTM+TVtDpW4Ca+iJRp+4lKhpi6SqFS5rj/9NdmZnRrtVpHLrHqtbkJnswmaSafbO9WpLSXzqFo6TPDQYs2PrGh1ga15ZTtUBF5IjJcJCp3BhZZElVlnqYbtuAkzqn8tkAKlHTIT0R7ete/dTwE5tYxzb51/WL//lZGzomqU8jXce+7M7r8uETe7YBCgJ1WV98zUGNLvLi9Tc3b8vyEaHAlvrSOzkwQ4N+ywgm7hSAx6nWva8cKsZq1uxDIYMqUu2KWmKi7bHWwyJ404fTHb9mQW4/33qcy7dEmYgsvfCRFXg1ibQ7p5BZkVqZCqmNP/q4Bda67fWWWidsnj8e8/+pTnGzR/11eZn8NQ2my3CU1aGdLJAtU6+lHCToFqPk0HQShtTqgVCu60bSZhqGK1jYqNhuKksvOtW2ekdlEFWmId+ssWLOC+DVoAJtY2dLukFaIQOlsRrl/nWQBB1wxWl1YTlYzgRGdAXWPRzM61ExziU9VLAISvnm+dYiiCiD76aVOM/zEmVbhWqmxDKml7mQxFky1a67excFHiHKiK0PbqfHpH/WwyNOl1BWax6dWpjVpvkhbP5J991t/PTnI+d686vDv5PszycuKefo5WyKxyW9FB24F1YkuKXamYqyCmqWggbX8TpDugiu+rAuh1zQKVthReQSyBmZ3r3rK+YMwO8q42gCJ0zUA2vLuEh/ODEHNAy0gcnn58VLgRSnwPuoBOvWLnVBQl2stdJcN9hCghKzguAQa8AjJ5siQDrAPRmhWD8ak7nKnHcfx+UM4f6slIhc10l+iwBaagdiirotfbHTKo6QJUza0pRNYpXlSImj+vEruTc8SuUCMomp2N7VOhVFDaT1o1xkzSoS46G6CHCqAV5xxJuff3AjsDHD42L0qKyvjK7iiZtb7sp8BWTVW9882ZYNfbNXV5HWqgheoSrhMr4xJiNFjtOAu8bjJhxVwmeBzHz+eypJElQwVtVruQrMP2bp4IDa3rs7NyDWKvCbq0UXRHC+CEg7rHAtNjuhrEk1nZsRbb1ZllS1LxSc0b8MWwEVBs9n3//feyDJY2RjhZden3eEgrTjtFCCtw08uZNLRDyrz0iApqzxRsK7OkTqU+/TGr+s9wHcrbDlQ4T9HoTCjBxdSPlfqupaRoKYr0ZibWlVGf0QKpNavgabR5WBMhRE0C0GVUuXlltntdoIelDihgEg4xvo7SKQgZ1F4Vp3d2Ztg1QlznlrgU78k2lx0RJjbIVZ4FtTbzIHpBbe77DD0jjZT+Gnjn07QVZuJ0mKdbYFJV1FoWU9/Y6ToQ2jEVmfRWyFI7GTv3lc1qjh4Hn35XDEr3xGId0EkTe43VfwVRBkJImn6ULd4l21sLpUSqiAuyTMyKFiKcJVJhZ6KJ6M8m0A5x9gWhxUMbqS6cxGf5kK0rzetCXbSLeFCVcNBghznwS67sSLUc/On6luhavE6VDTobrjpwqmgHawEUugz61GtCZbDksJY+hwzFUee4Lv9jLorB0yMqc9ohXtoETEUqnjp466SJq9Jv6XVnmFAgbZ1Ucs6Gfq5SPw299d9/fagvvTvhp+eKWYkombJItVj7VVTBew1xfnJxMoUuXGBbvGpQAU8HtMGr9uiyBbBDavhJaYMyXVPJR1Xbs64bFPTdj+iUYOm1GN/Z6za1xnQZTKo+nwm0iCzGziUBWGv9QNb0XdQOYrTDtdfYslMMdhg1xKSj87BCpu+l64v5d5PU2aWXV3pKC0f6KtZ7pmnj9LOZNOF27ueMlSBV1D1z/u8qZDZi5qzILqyVMumcVFfC4MDuZ356w/2seGfW/NxTA3VWZzBgt14VQJUvFXad7mOnFjPFpIk3Rp2jGRNUKTPUa+e/5KAeceAGadLIkiDbKvhqFTWJHzfq0OcgW78fzSx4Dl49JOGpJFUszjJxW91kx0pa/DBHz185C3W9glB2V/xKih6fFNv5pj93/ksOVYBYOytGT6nkNCRLrIJysiRJg7pEeixsOoyr6l4jA2pvL9jeFpLJ0cPS2ih4czBbdP3+9J9wedVC7SXKCGGd188VrCrUTQtmQbKtG9xVW61dAt3ACtHr0b6okhRYYm4/16JXHIrVYna4PyGwbu8MUubOqSapW6fnVQF7t6re+akmExYtzGD5OI7f99TVIgqVOHwV6nsK0karREVuC1ddQlYJn6Zha2ubSGGtUL0i6a8wYVf2GsmJFslMUPfve50uI5VUWFCtWVJKZjHXtXi9/v2PJdUEihXhQRyXaqpQ1RDTARBHrUQtkC7mxf2ZBaLBJ6sR81u3fTqfLsG+/34Iu25XvEkEJnuTKisoS76itZ/3TAkp9sVlVZFt4Ixw+jtUw9sOWZc1vDUdDeqcC5PNTaiYLEtTTrgrkFWfLNDu0uIQFbpTZ/Z13V+fqljFEkMG6bW6TfVeAdRRrXMyMbXElejre5cKeqqIgjyho8BbJVcMS+2ibujPBsxZ5hw42533caZn5J97NpWs86BzIXEoidLZglos/Jmf4AwRdAiKqcj0eDx+/4MdeXYX8qM3VphWhbqlwIupMjhtAw/qXOr1DVw/kmTnVVUKR3VD+yhG9bVU53a2r50Q6ufNlAoTqiYz6/nuWNzUI2fHVRVWigPHICuM5vvSHb6WDBclAwXOWTC7K7ppddopfoJSeqp+kR1Je4Uo7aAr306xWjyqcKWBndjPRJfW8fyhg3E5ddzk4LqsdUMXFrLCU4ez360cCYJzSiHZPNCicJ51wbrWS/QaHYCely1Kgzt/Q7lE2hme244tMa3jG2ZSdOm9jNKYFqcQaAU1KsYWbBB1kapAKLPCZ0WL224qc5GdTNVdYsJaSUYtrmOs3SJFdi2LSUuj4dxcdI5V8QXes1dQsqcgOPrbPOmM3s+3ir/f7+//T902llGopsVY4aiqElLERw07L6MlM5Os51RRVDDODgWl80+Bd8VoJuQWKCmwKNBrtEXqcN/38Rl1meRCsfgf+11888CTxtWyBlIFqh9Tcidrc6gXKA/vMJTWuk5JV+Q1w6ryCkEm1x5aFpqZJt6i88tZYgeIEN1LR0IyUeE0t5tv5ywPh+XrqscOYAWogn1zpwvPqpmV2rrtp/3R+l1KptTZHKbT5CzImnoFZs4BnWFp/fxsWZ0bhHVGP13izNAJcN65Znfu3J33/JCDGNjGBcjB2cayogIgU/F3+lpaCUJWAdEsnPS2itRRnlRb8apl4htmwpZr2d3tJZxOAS2R0UyVmlt0vr47K4Rfr9fv/4PK4Wswa80yr2p2mHrRAp+G6EBeJkbX4U1KzzhE+3mBjg22v8n2mc4r+SjIdv+cfVWvwfY+kpYKtTtYSCWi7yaqgviDLuJXVVSlOjDNqvohqJEeKrb0xvS7HM5TYKoD5uDt8ApCqWXB7TmHq79zhukOlKRJOjqHhaenFew1I2VxEiJpvPsVh1VganMtDB1SKyO4KSC1nIyhdZ0jVV3BdF7oEXn4AqiT0MVNhlqj4uq57jRFcIU0GY96qYBWRLrTFqOD3diIMt2tP89R8Xw+f/81II0wA1UGtRqkvIq6Ai8kiefzMAVDYiETEVa64NQ/+kP9TFZWwIQ4PbQCPgmCiSoOxkSdJjt0zrZ3nT1JhOyrdZbZl510QDHf74q6cNALWmF2jZBT5duyCr8SI6wU7II83z4oudLYYHAyLrtYUVhR6nU5L0uqH1JwaLuunTStEgVuBbhq36q+yxWwLlD3OLB7jS07Kaqisd9P3i7UVbkd0jP0/PxYj8LPmTGD1Zka+GoACYkmYr9XzXuHztvrZpeGHBWf1pJk5RTIXbBMeXi1QslQnc5Ocv7I668UuzZNh5bbq/rF2qlN5sCtirUlmj+t5WBXJ7XupOAyL8Vk9/OOQVlFJqmRmak9WvM4/v33ITIcLYcOKC9XwbdhVVPFhY+TLqoZpMqSBf0fBWgXl3JLRhRdwVn36jVXtlCF4YwoBsHo9OlKrtBlkYoodreiVY2isFxWeMEoy23mBwpauE7xwMGOA9KWNLAyqypNDVGAZERXdLX15oBUeHrW1vE54cpurCt8b2VaISawewufQmhrtl/r1dHf7/fXfg8DtTZ6UYf08gZQhdzPNB6tQCFDNqSAE/unkakVYVdWLCZ8GotdXqEr6yuYQrGzcFox2k12RcUgiREVphPS8/u+//67vZOadREv7PvHvs6Bq84Q7qTO7XVy7/X7b6RMJaw14UB1Hk0NVcdZ3eJ2AbIzTGrfpa8OZoeyRTjhVRng28VaNhVNhbcULg6nNncI93vfaFGMdfAu6gC2gmz9qkUR1kVP5rH+/r8Efabhb8fIWpwxQqLWjmq6eMz55lB3Fsy5IgTGIO1SZ7D0vXj/D1qZ7VFrqtW0AAAAAElFTkSuQmCC')
            repeat scroll center center #b3b3b3;
    }
    .signature-pad {
        position: relative;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-orient: vertical;
        -webkit-box-direction: normal;
        -ms-flex-direction: column;
        flex-direction: column;
        font-size: 10px;
        width: 100%;
        height: 100%;
        max-width: 1024px;
        max-height: 460px;
        border: 1px solid #e8e8e8;
        background-color: #fff;
        box-shadow: 0 1px 4px rgba(0, 0, 0, 0.27), 0 0 40px rgba(0, 0, 0, 0.08) inset;
        border-radius: 4px;
        padding: 16px;
    }
    #canvas-wrapper {
        width: 100%;
        height: 100%;
        position: relative; /* Untuk positioning absolut pada canvas */
    }

    #canvas-wrapper canvas {
        width: 100%;
        height: 100%;
        display: block;
    }

</style>
<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
<input type="hidden" name="set_jenis" id="set_jenis" value="1">
<input type="hidden" name="skorecount" id="skorecount" value="0">
<input type="hidden" name="set_sebelumnya" id="set_sebelumnya" value="{{$sebelumnya}}">
<input type="hidden" name="set_selanjutnya" id="set_selanjutnya" value="{{$setelahnya}}">
<input type="hidden" name="set_jenissoal" id="set_jenissoal" value="choice">
@endsection
@push('script')
<script src="{{ asset('plugins/signature_pad/signature_pad.umd.min.js') }}"></script>

<script type="text/javascript">
    var mstjenissoal= document.getElementById('set_jenissoal').value;
    var Clock = {
        totalSeconds: 0,
        start: function () {
            if (!this.interval) {
                var self = this;
                function pad(val) { return val > 9 ? val : "0" + val; }
                this.interval = setInterval(function () {
                    self.totalSeconds += 1;
                    var mstjenissoal= document.getElementById('set_jenissoal').value;
                    if (mstjenissoal == 'esay'){
                        if (self.totalSeconds == 60 || self.totalSeconds == 120 || self.totalSeconds == 180 || self.totalSeconds == 240 || self.totalSeconds == 300){
                            $('#btnsimpanesaiauto').click();
                        }
                    }
                    if (self.totalSeconds > 60){
                        document.getElementById("min").innerHTML = pad(Math.floor(self.totalSeconds / 60 % 60));
                        document.getElementById("sec").innerHTML = pad(parseInt(self.totalSeconds % 60));
                        document.getElementById("min").style.color = '#e74c3c';
                        document.getElementById("sec").style.color = '#e74c3c';
                    } else {
                        document.getElementById("min").innerHTML = pad(Math.floor(self.totalSeconds / 60 % 60));
                        document.getElementById("sec").innerHTML = pad(parseInt(self.totalSeconds % 60));
                        document.getElementById("min").style.color = '#17202a';
                        document.getElementById("sec").style.color = '#17202a';
                    }
                }, 1000);
            }
        },
        reset: function () {
            Clock.totalSeconds = null; 
            clearInterval(this.interval);
            document.getElementById("min").innerHTML = "00";
            document.getElementById("sec").innerHTML = "00";
            delete this.interval;
        },
        pause: function () {
            clearInterval(this.interval);
            delete this.interval;
        },
        resume: function () {
            this.start();
        },
        restart: function () {
            this.reset();
            Clock.start();
        }
    };
    $(function () {
        $('#listsoal').on('click', '.btnpill', function () {
            var ceksaatini  = document.getElementById('set_jenissoal').value;
            var idsaatini   = document.getElementById('idne').value;
            var mahasiswaini= document.getElementById('id_mahasiswa').value;
            var boxjawaban  = '';
            if (ceksaatini == 'esay'){
                if (idsaatini == null || idsaatini == ''){
                    var sudahok = 'OK';
                } else {
                    var boxjawaban  = $('#esay_jawaban').summernote('code');
                    var jawaban     = document.getElementById('jawaban_'+idsaatini).value;
                    if (boxjawaban == jawaban){
                    } else {
                        $.post('{{ route("exSimpanJawaban") }}', { set01: idsaatini, set02: mahasiswaini, set03: boxjawaban, _token: '{{ csrf_token() }}' },function(data){
                            $("#jawaban_"+idsaatini).val(boxjawaban);
                        });
                    }
                }
            }
            $("#id_jawaban").val('');
            $("#idne").val('');
            $('#opsia').html('');
            $('#opsib').html('');
            $('#opsic').html('');
            $('#opsid').html('');
            $('#opsie').html('');
            $('#preview').attr('src', '{{URL::to("/")}}/dist/img/takadagambar.png');
            $('#esaypreview').attr('src', '{{URL::to("/")}}/dist/img/takadagambar.png');
            $('#esaypreview2').attr('src', '{{URL::to("/")}}/dist/img/takadagambar.png');
            $('#esaypreview3').attr('src', '{{URL::to("/")}}/dist/img/takadagambar.png');
            $('#esaypreview4').attr('src', '{{URL::to("/")}}/dist/img/takadagambar.png');
            $('#esaypreview5').attr('src', '{{URL::to("/")}}/dist/img/takadagambar.png');
            $('#esaypreview6').attr('src', '{{URL::to("/")}}/dist/img/takadagambar.png');
            $('#deskripsi').html('');
            var set01 = $(this).attr('id');	
            var set02 = $(this).attr('idsebelum');	
            var set03 = $(this).attr('idsetelah');
            var set04 = $(this).attr('urutan');
            var judul = 'Case Number '+set04;
            $("#idne").val(set01);
            $("#set_sebelumnya").val(set02);
            $("#set_selanjutnya").val(set03);
            $("#judul").html(judul);
            var deskripsi = document.getElementById('deksripsi_'+set01).value;
            var opsia     = document.getElementById('opsia_'+set01).value;
            var opsib     = document.getElementById('opsib_'+set01).value;
            var opsic     = document.getElementById('opsic_'+set01).value;
            var opsid     = document.getElementById('opsid_'+set01).value;
            var opsie     = document.getElementById('opsie_'+set01).value;
            var jawaban   = document.getElementById('jawaban_'+set01).value;
            var lampiran  = document.getElementById('lampiran_'+set01).value;
            var lampiran2 = document.getElementById('lampiran2_'+set01).value;
            var lampiran3 = document.getElementById('lampiran3_'+set01).value;
            var lampiran4 = document.getElementById('lampiran4_'+set01).value;
            var lampiran5 = document.getElementById('lampiran5_'+set01).value;
            var lampiran6 = document.getElementById('lampiran6_'+set01).value;
            var jenissoal = document.getElementById('tipesoal_'+set01).value;

            $("#set_jenissoal").val(jenissoal);
            if (lampiran == ''){
                $('#esaypreview').attr('src', "{{url('/')}}/dist/img/takadagambar.png");
            } else {
                $('#esaypreview').attr('src', lampiran);
            }
            if (lampiran2 == ''){
                $('#esaypreview2').attr('src', "{{url('/')}}/dist/img/takadagambar.png");
            } else {
                $('#esaypreview2').attr('src', lampiran2);
            }
            if (lampiran3 == ''){
                $('#esaypreview3').attr('src', "{{url('/')}}/dist/img/takadagambar.png");
            } else {
                $('#esaypreview3').attr('src', lampiran3);
            }
            if (lampiran4 == ''){
                $('#esaypreview4').attr('src', "{{url('/')}}/dist/img/takadagambar.png");
            } else {
                $('#esaypreview4').attr('src', lampiran4);
            }
            if (lampiran5 == ''){
                $('#esaypreview5').attr('src', "{{url('/')}}/dist/img/takadagambar.png");
            } else {
                $('#esaypreview5').attr('src', lampiran5);
            }
            if (lampiran6 == ''){
                $('#esaypreview6').attr('src', "{{url('/')}}/dist/img/takadagambar.png");
            } else {
                $('#esaypreview6').attr('src', lampiran6);
            }
            $('#deskripsi').html(deskripsi);
            if (jenissoal == 'esay'){
                $('#divesay').show();
                $('#divawal').hide();
                $('#esay_jawaban').summernote('code', jawaban);
            } else {
                $('#timepercase').html('');
                $('#divesay').hide();
                $('#divawal').show();
                if (lampiran == ''){
                    $('#preview').attr('src', "{{url('/')}}/dist/img/takadagambar.png");
                } else {
                    $('#preview').attr('src', lampiran);
                }
                if (jawaban == 'A'){
                    var opsia = '<div class="card bg-gradient-success"><div class="card-header"><h3 class="card-title">Jawaban Anda</h3></div><div class="card-body">'+opsia+'</div></div>';
                } else if (jawaban == 'B'){
                    var opsib = '<div class="card bg-gradient-success"><div class="card-header"><h3 class="card-title">Jawaban Anda</h3></div><div class="card-body">'+opsib+'</div></div>';
                } else if (jawaban == 'C'){
                    var opsic = '<div class="card bg-gradient-success"><div class="card-header"><h3 class="card-title">Jawaban Anda</h3></div><div class="card-body">'+opsic+'</div></div>';
                } else if (jawaban == 'D'){
                    var opsid = '<div class="card bg-gradient-success"><div class="card-header"><h3 class="card-title">Jawaban Anda</h3></div><div class="card-body">'+opsid+'</div></div>';
                } else if (jawaban == 'E'){
                    var opsie = '<div class="card bg-gradient-success"><div class="card-header"><h3 class="card-title">Jawaban Anda</h3></div><div class="card-body">'+opsie+'</div></div>';
                } else {
                }
                $('#opsia').html(opsia);
                $('#opsib').html(opsib);
                $('#opsic').html(opsic);
                $('#opsid').html(opsid);
                $('#opsie').html(opsie);
            }
            Clock.reset();
            Clock.start();
        
            
        });
        $('.select2').select2({width: '100%'});
    });
    const mulai = '{{$mulai}}';
    let dateTimeParts= mulai.split(/[- :]/);
    dateTimeParts[1]--;
    var start = new Date(...dateTimeParts);
    CountDownTimer(start, 'timeremaining');
    function CountDownTimer(dt, id)
    {
        //var end 	= new Date(dt.getTime() + 60000);
        var _second = 1000;
        var _minute = _second * 60;
        var _hour 	= _minute * 60;
        var _day 	= _hour * 24;
        var waktu	= '{{$timer}}';
        var total   = waktu * 1000 * 60;
        var end 	= new Date(dt.getTime() + total);
        
        var timer;
        function showRemaining() {
            var now = new Date();
            var distance = end - now;
            if (distance < 0) {
                var username = "{{ $jenisujian }}";
                if (username == 'tryout'){
                    $('#divselesai').hide();
                } else {
                    $('#waktuserver').html(now);
                    $('#divcanvas').hide();
                    $('#divesay').hide();
                    $('#divawal').hide();
                    $('#listsoal').hide();
                    $('#divselesai').show();
                    return;
                }
            }
            var days = Math.floor(distance / _day);
            var hours = Math.floor((distance % _day) / _hour);
            var minutes = Math.floor((distance % _hour) / _minute);
            var seconds = Math.floor((distance % _minute) / _second);
            document.getElementById(id).innerHTML =' Test Ended in ';
            document.getElementById(id).innerHTML += hours + ' hours, '+ minutes + ' minutes, '+ seconds + ' secs';
        }
        timer = setInterval(showRemaining, 1000);
    }
    function spinner_update() {
        var angka = $('#btnslider').jqxSlider('value').toString();
        document.getElementById("preview").style.width=angka+'%';
    }
    window.addEventListener("keydown", (event) => {
        switch (true) {
            case event.key === "z" && event.ctrlKey:
                $('#btnundo').click();
            break;
            case event.key === "y" && event.ctrlKey:
                $('#btnredo').click();
            break;
        }
    });
    $(document).ready(function() {
        $('#btnslider').jqxSlider({
            showTickLabels: true, tooltip: true, mode: "fixed", height: 60, min: 0, max: 200, ticksFrequency: 10, value: 100, step: 10,
            tickLabelFormatFunction: function (value)
            {
                if (value == 0) return value;
                if (value == 200) return value;
                return "";
            }
        });
        $('#btnslider').on('change', function (event) {
            spinner_update();
        });
        $('#esay_jawaban').summernote()
        $('#esayimagenumber1').click(function (e) {
            var images = $('#esaypreview').attr('src');
            $('#preview').attr('src', images);
        });
        $('#esayimagenumber2').click(function (e) {
            var images = $('#esaypreview2').attr('src');
            $('#preview').attr('src', images);
        });
        $('#esayimagenumber3').click(function (e) {
            var images = $('#esaypreview3').attr('src');
            $('#preview').attr('src', images);
        });
        $('#esayimagenumber4').click(function (e) {
            var images = $('#esaypreview4').attr('src');
            $('#preview').attr('src', images);
        });
        $('#esayimagenumber5').click(function (e) {
            var images = $('#esaypreview5').attr('src');
            $('#preview').attr('src', images);
        });
        $('#esayimagenumber6').click(function (e) {
            var images = $('#esaypreview6').attr('src');
            $('#preview').attr('src', images);
        });
        $('#divpaper').hide();
        $('#divselesai').hide();
        $('#divesay').hide();
        $("#id_jawaban").val('');
        $("#idne").val('');
        $('#opsia').html('');
        $('#opsib').html('');
        $('#opsic').html('');
        $('#opsid').html('');
        $('#opsie').html('');
        $('#preview').attr('src', "{{url('/')}}/dist/img/takadagambar.png");
        $('#deskripsi').html('');
        $("#btnnext").click(function(){
            var val01=document.getElementById('set_selanjutnya').value;
            if (val01 == '0'){
                swal({
                    title	: 'Stop',
                    text	: 'Last Page',
                    type	: 'warning',
                })
            } else {
                $('#step-'+val01).click();
            }
        });
        $("#btnprevious").click(function(){
            var val01=document.getElementById('set_sebelumnya').value;
            if (val01 == '0'){
                swal({
                    title	: 'Stop',
                    text	: 'Last Page',
                    type	: 'warning',
                })
            } else {
                $('#step-'+val01).click();
            }
        });
        $("#btn-simpan").click(function(){
            var val01=document.getElementById('idne').value;
            var val02=document.getElementById('id_mahasiswa').value;
            var val03=document.getElementById('id_jawaban').value;
            if (val01 == '' || val02 == '' || val03 == ''){
                swal({
                    title	: 'Stop',
                    text	: 'Mohon Lengkapi Isian Bapak/Ibu, Apabila Melewati Waktu Idle, maka Laman ini perlu di Refresh',
                    type	: 'warning',
                })
            } else {
                $.post('{{ route("exSimpanJawaban") }}', { set01: val01, set02: val02, set03: val03, _token: '{{ csrf_token() }}' },function(data){
                    var status = data.status;
                    $("#jawaban_"+val01).val(val03);
                    if (status == 'Gagal'){
                        swal({
                            title	: status,
                            text	: data.message,
                            type	: data.icon,
                        })
                    } else if (status == 'Close'){
                        swal({
                            title	: status,
                            text	: data.message,
                            type	: data.icon,
                        })
                    } else {
                        $('#step-'+val01).removeClass('bs-stepper-circle').addClass('bs-stepper-circle btn-success');
                        $.post('{{ route("getFirstDataUjian") }}', { val01: val01, _token: '{{ csrf_token() }}' },function(data){
                            var deskripsi = data.deskripsi;
                            var opsia     = data.opsia;
                            var opsib     = data.opsib;
                            var opsic     = data.opsic;
                            var opsid     = data.opsid;
                            var opsie     = data.opsie;
                            var lampiran  = data.lampiran;
                            if (lampiran == ''){
                            $('#preview').attr('src', "{{url('/')}}/dist/img/takadagambar.png");
                            } else {
                            $('#preview').attr('src', lampiran);
                            }
                            $('#deskripsi').html(deskripsi);
                            $('#opsia').html(opsia);
                            $('#opsib').html(opsib);
                            $('#opsic').html(opsic);
                            $('#opsid').html(opsid);
                            $('#opsie').html(opsie);
                        });
                        $.toast({
                            heading     : status,
                            text        : data.message,
                            position    : 'top-right',
                            loaderBg    : data.warna,
                            icon        : data.icon,
                            hideAfter   : 3000,
                            stack       : 1
                        });
                    }
                });
            }
        });
        $('#id_jawaban').change(function () {
            var val01=document.getElementById('idne').value;
            var val02=document.getElementById('id_mahasiswa').value;
            var val03=document.getElementById('id_jawaban').value;
            if (val01 == '' || val02 == '' || val03 == ''){
                swal({
                    title	: 'Stop',
                    text	: 'Mohon Lengkapi Isian Bapak/Ibu, Apabila Melewati Waktu Idle, maka Laman ini perlu di Refresh',
                    type	: 'warning',
                })
            } else {
                $.post('{{ route("exSimpanJawaban") }}', { set01: val01, set02: val02, set03: val03, _token: '{{ csrf_token() }}' },function(data){
                    var status = data.status;
                    $("#jawaban_"+val01).val(val03);
                    if (status == 'Gagal'){
                        swal({
                            title	: status,
                            text	: data.message,
                            type	: data.icon,
                        })
                    } else if (status == 'Close'){
                        swal({
                            title	: status,
                            text	: data.message,
                            type	: data.icon,
                        })
                    } else {
                        $('#step-'+val01).removeClass('bs-stepper-circle').addClass('bs-stepper-circle btn-success');
                        $.post('{{ route("getFirstDataUjian") }}', { val01: val01, _token: '{{ csrf_token() }}' },function(data){
                            var deskripsi = data.deskripsi;
                            var opsia     = data.opsia;
                            var opsib     = data.opsib;
                            var opsic     = data.opsic;
                            var opsid     = data.opsid;
                            var opsie     = data.opsie;
                            var lampiran  = data.lampiran;
                            if (lampiran == ''){
                            $('#preview').attr('src', "{{url('/')}}/dist/img/takadagambar.png");
                            } else {
                            $('#preview').attr('src', lampiran);
                            }
                            $('#deskripsi').html(deskripsi);
                            $('#opsia').html(opsia);
                            $('#opsib').html(opsib);
                            $('#opsic').html(opsic);
                            $('#opsid').html(opsid);
                            $('#opsie').html(opsie);
                        });
                        $.toast({
                            heading     : status,
                            text        : data.message,
                            position    : 'top-right',
                            loaderBg    : data.warna,
                            icon        : data.icon,
                            hideAfter   : 3000,
                            stack       : 1
                        });
                    }
                });
            }
        });
        $('#sliderzoom').change(function () {
            spinner_update();
        });
        $("#btnupdatedataps").click(function(){
            var val01=document.getElementById('idne').value;
            var val02=document.getElementById('id_mahasiswa').value;
            var val03=$('#esay_jawaban').summernote('code');
            if (val01 == '' || val02 == '' || val03 == ''){
                swal({
                    title	: 'Stop',
                    text	: 'Mohon Lengkapi Isian Bapak/Ibu, Apabila Melewati Waktu Idle, maka Laman ini perlu di Refresh',
                    type	: 'warning',
                })
            } else {
                $.post('{{ route("exSimpanJawaban") }}', { set01: val01, set02: val02, set03: val03, _token: '{{ csrf_token() }}' },function(data){
                    var status = data.status;
                    $("#jawaban_"+val01).val(val03);
                    if (status == 'Gagal'){
                        swal({
                            title	: status,
                            text	: data.message,
                            type	: data.icon,
                        })
                    } else if (status == 'Close'){
                        swal({
                            title	: status,
                            text	: data.message,
                            type	: data.icon,
                        })
                    } else {
                        $('#step-'+val01).removeClass('bs-stepper-circle').addClass('bs-stepper-circle btn-success');
                        $.toast({
                            heading     : status,
                            text        : data.message,
                            position    : 'top-right',
                            loaderBg    : data.warna,
                            icon        : data.icon,
                            hideAfter   : 3000,
                            stack       : 1
                        });
                    }
                });
            }
        });
        $("#btnsimpanesaiauto").click(function(){
            var val01=document.getElementById('idne').value;
            var val02=document.getElementById('id_mahasiswa').value;
            var val03=$('#esay_jawaban').summernote('code');
            if (val01 == '' || val02 == '' || val03 == ''){
                
            } else {
                $.post('{{ route("exSimpanJawaban") }}', { set01: val01, set02: val02, set03: val03, _token: '{{ csrf_token() }}' },function(data){
                    var status = data.status;
                    $("#jawaban_"+val01).val(val03);
                    if (status == 'Gagal'){
                        swal({
                            title	: status,
                            text	: data.message,
                            type	: data.icon,
                        })
                    } else if (status == 'Close'){
                        swal({
                            title	: status,
                            text	: data.message,
                            type	: data.icon,
                        })
                    } else {
                        $('#step-'+val01).removeClass('bs-stepper-circle').addClass('bs-stepper-circle btn-success');
                        $.toast({
                            heading     : status,
                            text        : data.message,
                            position    : 'top-right',
                            loaderBg    : data.warna,
                            icon        : data.icon,
                            hideAfter   : 3000,
                            stack       : 1
                        });
                    }
                });
            }
        });
        $('.btnlogout').click(function () {
            var token = '{{ csrf_token() }}';
            $.post('{{ route("exInputBankSoal") }}', { set01: 'akhiriujian', set02: 'akhiriujian', _token: token },
            function(data){
                $.toast({
                    heading     : 'Info',
                    text        : data,
                    position    : 'top-right',
                    loaderBg    : '#5ba035',
                    icon        : 'info',
                    hideAfter   : 3000,
                    stack       : 1
                });
                setTimeout(function () { 
                    window.location.href = '/';
                }, 3000);
                return false;
            });	
        });
        let undoData    = [];
        var signaturePad = new SignaturePad(document.getElementById('signature-pad'), {
            backgroundColor: 'rgba(0, 0, 0, 0)',
            penColor: 'rgb(0, 0, 0)'
        });
        $('#btnopenpaper').click(function () {
            signaturePad.clear();
            $('#divpaper').show();
        });
        $('#btnclearttd').click(function () {
            signaturePad.clear();
        });
        $('#btntutupkertas').click(function () {
            $('#divpaper').hide();
        });
        
        $('#btnundo').click(function () {
            const data = signaturePad.toData();
            if (data && data.length > 0) {
                const removed = data.pop();
                undoData.push(removed);
                signaturePad.fromData(data);
            }
        });
        $('#btnredo').click(function () {
            if (undoData.length > 0) {
                const data = signaturePad.toData();
                data.push(undoData.pop());
                signaturePad.fromData(data);
            }
        });
        $('.btnsavefrompaper').click(function () {
            var gambar 	= signaturePad.toDataURL('image/png');
            var teksawal= $('#esay_jawaban').summernote('code');
            var teks    = teksawal + '<img src="'+gambar+'" width="100%">';
            $('#esay_jawaban').summernote('code', teks);

        });
    });
</script>
@endpush