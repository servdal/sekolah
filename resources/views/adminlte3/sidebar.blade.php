<a href="{{url('/')}}" class="brand-link">
    <img src="{{ asset('logo.png') }}" alt="{!! config('global.Title2') !!} Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">
    @if (isset($namaapps01))
        {{ $namaapps01 }}
    @elseif (Session('namaapps01') !== null)
        {{ Session('namaapps01') }}
    @else
        {{ config('global.Title2') }}
    @endif
    </span>
</a>
@if(Session('previlage') == 'level0' OR Session('previlage') == 'level1')
    <li class="nav-item">
        <a class="nav-link {{ isset($sidebar) && $sidebar == 'dashbord' ? 'active' : '' }}" href="/" role="button"><i class="nav-icon fa fa-tachometer"></i><p>Dashboard</p></a>
    </li>
    <li class="nav-item dropdown">
        <a href="#" class="nav-link"><i class="nav-icon fa fa-black-tie"></i><p>Kepegawaian<i class="right fa fa-angle-left"></i></p></a>
        <ul class="nav nav-treeview">
            <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'dataindukstaff' ? 'active' : '' }}" href="{{ url('dataindukstaff') }}"><i class="fa fa-circle-o nav-icon"></i> Data Induk Karyawan</a></li>
            <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'raportguru' ? 'active' : '' }}" href="{{ url('raportguru') }}"><i class="fa fa-circle-o nav-icon"></i> Raport Guru</a></li>
        </ul>
    </li>
    <li class="nav-item dropdown">
        <a href="#" class="nav-link"><i class="nav-icon fa fa-sitemap"></i><p>Kurikulum<i class="right fa fa-angle-left"></i></p></a>
        <ul class="nav nav-treeview">
            <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'rencanapembelajaran' ? 'active' : '' }}" href="{{ url('setrps') }}"><i class="fa fa-circle-o nav-icon"></i> Kurikulum</a></li>
            <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'banksoal' ? 'active' : '' }}" href="{{ url('banksoal') }}"><i class="fa fa-circle-o nav-icon"></i> Bank Soal</a></li>
            <li class="nav-item dropdown">
                <a href="#" class="nav-link"><i class="nav-icon fa fa-graduation-cap"></i><p>Ruang Guru<i class="right fa fa-angle-left"></i></p></a>
                <ul class="nav nav-treeview">
                    <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'konseling' ? 'active' : '' }}" href="{{ url('konseling') }}"><i class="fa fa-circle-o nav-icon"></i> Data Bimbingan dan Konseling</a></li>
                    @if(Session('sekolah_level') == 1)
                        <!--
                        <li class="nav-item dropdown">
                            <a href="#" class="nav-link"><i class="nav-icon fa fa-soccer-ball-o"></i><p>Kelompok Belajar<i class="right fa fa-angle-left"></i></p></a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'gradekba' ? 'active' : '' }}" href="{{ url('tahap/gradekba') }}"><i class="fa fa-circle-o nav-icon"></i> KB A</a></li>
                                <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'gradekba' ? 'active' : '' }}" href="{{ url('tahap/gradekba') }}"><i class="fa fa-circle-o nav-icon"></i> KB B</a></li>
                                <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'gradekbc' ? 'active' : '' }}" href="{{ url('tahap/gradekbc') }}"><i class="fa fa-circle-o nav-icon"></i> KB C</a></li>
                            </ul>
                        </li>
                        -->
                        <li class="nav-item dropdown">
                            <a href="#" class="nav-link"><i class="nav-icon fa fa-star-half-o"></i><p>Tahap 1<i class="right fa fa-angle-left"></i></p></a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == '1A' ? 'active' : '' }}" href="{{ url('tahap/1A') }}"><i class="fa fa-circle-o nav-icon"></i> Tahap 1.A</a></li>
                                <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == '1B' ? 'active' : '' }}" href="{{ url('tahap/1B') }}"><i class="fa fa-circle-o nav-icon"></i> Tahap 1.B</a></li>
                                <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == '1C' ? 'active' : '' }}" href="{{ url('tahap/1C') }}"><i class="fa fa-circle-o nav-icon"></i> Tahap 1.C</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a href="#" class="nav-link"><i class="nav-icon fa fa-star"></i><p>Tahap 2<i class="right fa fa-angle-left"></i></p></a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == '2A' ? 'active' : '' }}" href="{{ url('tahap/2A') }}"><i class="fa fa-circle-o nav-icon"></i> Tahap 2.A</a></li>
                                <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == '2B' ? 'active' : '' }}" href="{{ url('tahap/2B') }}"><i class="fa fa-circle-o nav-icon"></i> Tahap 2.B</a></li>
                                <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == '2C' ? 'active' : '' }}" href="{{ url('tahap/2C') }}"><i class="fa fa-circle-o nav-icon"></i> Tahap 2.C</a></li>
                            </ul>
                        </li>
                    @elseif (Session('sekolah_level') == 2)
                        <li class="nav-item dropdown">
                            <a href="#" class="nav-link"><i class="nav-icon fa fa-battery-0"></i><p>Kelas I<i class="right fa fa-angle-left"></i></p></a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade1A' ? 'active' : '' }}" href="{{ url('kelas/grade1A') }}"><i class="fa fa-circle-o nav-icon"></i> 1 A</a></li>
                                <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade1B' ? 'active' : '' }}" href="{{ url('kelas/grade1B') }}"><i class="fa fa-circle-o nav-icon"></i> 1 B</a></li>
                                <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade1C' ? 'active' : '' }}" href="{{ url('kelas/grade1C') }}"><i class="fa fa-circle-o nav-icon"></i> 1 C</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a href="#" class="nav-link"><i class="nav-icon fa fa-battery-1"></i><p>Kelas II<i class="right fa fa-angle-left"></i></p></a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade2A' ? 'active' : '' }}" href="{{ url('kelas/grade2A') }}"><i class="fa fa-circle-o nav-icon"></i> 2 A</a></li>
                                <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade2B' ? 'active' : '' }}" href="{{ url('kelas/grade2B') }}"><i class="fa fa-circle-o nav-icon"></i> 2 B</a></li>
                                <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade2C' ? 'active' : '' }}" href="{{ url('kelas/grade2C') }}"><i class="fa fa-circle-o nav-icon"></i> 2 C</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a  href="#" class="nav-link"><i class="nav-icon fa fa-battery-2"></i><p>Kelas III<i class="right fa fa-angle-left"></i></p></a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade3A' ? 'active' : '' }}" href="{{ url('kelas/grade3A') }}"><i class="fa fa-circle-o nav-icon"></i> 3 A</a></li>
                                <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade3B' ? 'active' : '' }}" href="{{ url('kelas/grade3B') }}"><i class="fa fa-circle-o nav-icon"></i> 3 B</a></li>
                                <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade3C' ? 'active' : '' }}" href="{{ url('kelas/grade3C') }}"><i class="fa fa-circle-o nav-icon"></i> 3 C</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a href="#" class="nav-link"><i class="nav-icon fa fa-battery-3"></i><p>Kelas IV<i class="right fa fa-angle-left"></i></p></a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade4A' ? 'active' : '' }}" href="{{ url('kelas/grade4A') }}"><i class="fa fa-circle-o nav-icon"></i> 4 A</a></li>
                                <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade4B' ? 'active' : '' }}" href="{{ url('kelas/grade4B') }}"><i class="fa fa-circle-o nav-icon"></i> 4 B</a></li>
                                <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade4C' ? 'active' : '' }}" href="{{ url('kelas/grade4C') }}"><i class="fa fa-circle-o nav-icon"></i> 4 C</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a href="#" class="nav-link"><i class="nav-icon fa fa-battery-4"></i><p>Kelas V<i class="right fa fa-angle-left"></i></p></a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade5A' ? 'active' : '' }}" href="{{ url('kelas/grade5A') }}"><i class="fa fa-circle-o nav-icon"></i> 5 A</a></li>
                                <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade5B' ? 'active' : '' }}" href="{{ url('kelas/grade5B') }}"><i class="fa fa-circle-o nav-icon"></i> 5 B</a></li>
                                <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade5C' ? 'active' : '' }}" href="{{ url('kelas/grade5C') }}"><i class="fa fa-circle-o nav-icon"></i> 5 C</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a href="#" class="nav-link"><i class="nav-icon fa fa-battery-full"></i><p>Kelas VI<i class="right fa fa-angle-left"></i></p></a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade6A' ? 'active' : '' }}" href="{{ url('kelas/grade6A') }}"><i class="fa fa-circle-o nav-icon"></i> 6 A</a></li>
                                <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade6B' ? 'active' : '' }}" href="{{ url('kelas/grade6B') }}"><i class="fa fa-circle-o nav-icon"></i> 6 B</a></li>
                                <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade6C' ? 'active' : '' }}" href="{{ url('kelas/grade6C') }}"><i class="fa fa-circle-o nav-icon"></i> 6 C</a></li>
                            </ul>
                        </li>
                    @elseif (Session('sekolah_level') == 3)
                        <li class="nav-item dropdown">
                            <a href="#" class="nav-link"><i class="nav-icon fa fa-battery-1"></i><p>Kelas VII<i class="right fa fa-angle-left"></i></p></a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade7A' ? 'active' : '' }}" href="{{ url('kelas/grade7A') }}"><i class="fa fa-circle-o nav-icon"></i> 7 A</a></li>
                                <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade7B' ? 'active' : '' }}" href="{{ url('kelas/grade7B') }}"><i class="fa fa-circle-o nav-icon"></i> 7 B</a></li>
                                <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade7C' ? 'active' : '' }}" href="{{ url('kelas/grade7C') }}"><i class="fa fa-circle-o nav-icon"></i> 7 C</a></li>
                                <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade7D' ? 'active' : '' }}" href="{{ url('kelas/grade7D') }}"><i class="fa fa-circle-o nav-icon"></i> 7 D</a></li>
                                <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade7E' ? 'active' : '' }}" href="{{ url('kelas/grade7E') }}"><i class="fa fa-circle-o nav-icon"></i> 7 E</a></li>
                                <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade7F' ? 'active' : '' }}" href="{{ url('kelas/grade7F') }}"><i class="fa fa-circle-o nav-icon"></i> 7 F</a></li>
                                <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade7G' ? 'active' : '' }}" href="{{ url('kelas/grade7G') }}"><i class="fa fa-circle-o nav-icon"></i> 7 G</a></li>
                                <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade7H' ? 'active' : '' }}" href="{{ url('kelas/grade7H') }}"><i class="fa fa-circle-o nav-icon"></i> 7 H</a></li>
                                <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade7I' ? 'active' : '' }}" href="{{ url('kelas/grade7I') }}"><i class="fa fa-circle-o nav-icon"></i> 7 I</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a href="#" class="nav-link"><i class="nav-icon fa fa-battery-2"></i><p>Kelas VIII<i class="right fa fa-angle-left"></i></p></a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade8A' ? 'active' : '' }}" href="{{ url('kelas/grade8A') }}"><i class="fa fa-circle-o nav-icon"></i> 8 A</a></li>
                                <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade8B' ? 'active' : '' }}" href="{{ url('kelas/grade8B') }}"><i class="fa fa-circle-o nav-icon"></i> 8 B</a></li>
                                <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade8C' ? 'active' : '' }}" href="{{ url('kelas/grade8C') }}"><i class="fa fa-circle-o nav-icon"></i> 8 C</a></li>
                                <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade8D' ? 'active' : '' }}" href="{{ url('kelas/grade8D') }}"><i class="fa fa-circle-o nav-icon"></i> 8 D</a></li>
                                <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade8E' ? 'active' : '' }}" href="{{ url('kelas/grade8E') }}"><i class="fa fa-circle-o nav-icon"></i> 8 E</a></li>
                                <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade8F' ? 'active' : '' }}" href="{{ url('kelas/grade8F') }}"><i class="fa fa-circle-o nav-icon"></i> 8 F</a></li>
                                <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade8G' ? 'active' : '' }}" href="{{ url('kelas/grade8G') }}"><i class="fa fa-circle-o nav-icon"></i> 8 G</a></li>
                                <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade8H' ? 'active' : '' }}" href="{{ url('kelas/grade8H') }}"><i class="fa fa-circle-o nav-icon"></i> 8 H</a></li>
                                <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade8I' ? 'active' : '' }}" href="{{ url('kelas/grade8I') }}"><i class="fa fa-circle-o nav-icon"></i> 8 I</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a href="#" class="nav-link"><i class="nav-icon fa fa-battery-4"></i><p>Kelas IX<i class="right fa fa-angle-left"></i></p></a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade9A' ? 'active' : '' }}" href="{{ url('kelas/grade9A') }}"><i class="fa fa-circle-o nav-icon"></i> 9 A</a></li>
                                <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade9B' ? 'active' : '' }}" href="{{ url('kelas/grade9B') }}"><i class="fa fa-circle-o nav-icon"></i> 9 B</a></li>
                                <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade9C' ? 'active' : '' }}" href="{{ url('kelas/grade9C') }}"><i class="fa fa-circle-o nav-icon"></i> 9 C</a></li>
                                <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade9D' ? 'active' : '' }}" href="{{ url('kelas/grade9D') }}"><i class="fa fa-circle-o nav-icon"></i> 9 D</a></li>
                                <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade9E' ? 'active' : '' }}" href="{{ url('kelas/grade9E') }}"><i class="fa fa-circle-o nav-icon"></i> 9 E</a></li>
                                <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade9F' ? 'active' : '' }}" href="{{ url('kelas/grade9F') }}"><i class="fa fa-circle-o nav-icon"></i> 9 F</a></li>
                                <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade9G' ? 'active' : '' }}" href="{{ url('kelas/grade9G') }}"><i class="fa fa-circle-o nav-icon"></i> 9 G</a></li>
                                <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade9H' ? 'active' : '' }}" href="{{ url('kelas/grade9H') }}"><i class="fa fa-circle-o nav-icon"></i> 9 H</a></li>
                                <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade9I' ? 'active' : '' }}" href="{{ url('kelas/grade9I') }}"><i class="fa fa-circle-o nav-icon"></i> 9 I</a></li>
                            </ul>
                        </li>
                    @else
                        <li class="nav-item dropdown">
                            <a href="#" class="nav-link"><i class="nav-icon fa fa-battery-1"></i><p>Kelas X<i class="right fa fa-angle-left"></i></p></a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade10A' ? 'active' : '' }}" href="{{ url('kelas/grade10A') }}"><i class="fa fa-circle-o nav-icon"></i> 10 A</a></li>
                                <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade10B' ? 'active' : '' }}" href="{{ url('kelas/grade10B') }}"><i class="fa fa-circle-o nav-icon"></i> 10 B</a></li>
                                <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade10C' ? 'active' : '' }}" href="{{ url('kelas/grade10C') }}"><i class="fa fa-circle-o nav-icon"></i> 10 C</a></li>
                                <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade10D' ? 'active' : '' }}" href="{{ url('kelas/grade10D') }}"><i class="fa fa-circle-o nav-icon"></i> 10 D</a></li>
                                <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade10E' ? 'active' : '' }}" href="{{ url('kelas/grade10E') }}"><i class="fa fa-circle-o nav-icon"></i> 10 E</a></li>
                                <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade10F' ? 'active' : '' }}" href="{{ url('kelas/grade10F') }}"><i class="fa fa-circle-o nav-icon"></i> 10 F</a></li>
                                <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade10G' ? 'active' : '' }}" href="{{ url('kelas/grade10G') }}"><i class="fa fa-circle-o nav-icon"></i> 10 G</a></li>
                                <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade10H' ? 'active' : '' }}" href="{{ url('kelas/grade10H') }}"><i class="fa fa-circle-o nav-icon"></i> 10 H</a></li>
                                <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade10I' ? 'active' : '' }}" href="{{ url('kelas/grade10I') }}"><i class="fa fa-circle-o nav-icon"></i> 10 I</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a href="#" class="nav-link"><i class="nav-icon fa fa-battery-2"></i><p>Kelas XI<i class="right fa fa-angle-left"></i></p></a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade11A' ? 'active' : '' }}" href="{{ url('kelas/grade11A') }}"><i class="fa fa-circle-o nav-icon"></i> 11 A</a></li>
                                <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade11B' ? 'active' : '' }}" href="{{ url('kelas/grade11B') }}"><i class="fa fa-circle-o nav-icon"></i> 11 B</a></li>
                                <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade11C' ? 'active' : '' }}" href="{{ url('kelas/grade11C') }}"><i class="fa fa-circle-o nav-icon"></i> 11 C</a></li>
                                <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade11D' ? 'active' : '' }}" href="{{ url('kelas/grade11D') }}"><i class="fa fa-circle-o nav-icon"></i> 11 D</a></li>
                                <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade11F' ? 'active' : '' }}" href="{{ url('kelas/grade11F') }}"><i class="fa fa-circle-o nav-icon"></i> 11 F</a></li>
                                <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade11G' ? 'active' : '' }}" href="{{ url('kelas/grade11G') }}"><i class="fa fa-circle-o nav-icon"></i> 11 G</a></li>
                                <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade11H' ? 'active' : '' }}" href="{{ url('kelas/grade11H') }}"><i class="fa fa-circle-o nav-icon"></i> 11 H</a></li>
                                <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade11I' ? 'active' : '' }}" href="{{ url('kelas/grade11I') }}"><i class="fa fa-circle-o nav-icon"></i> 11 I</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a href="#" class="nav-link"><i class="nav-icon fa fa-battery-4"></i><p>Kelas XII<i class="right fa fa-angle-left"></i></p></a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade12A' ? 'active' : '' }}" href="{{ url('kelas/grade12A') }}"><i class="fa fa-circle-o nav-icon"></i> 12 A</a></li>
                                <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade12B' ? 'active' : '' }}" href="{{ url('kelas/grade12B') }}"><i class="fa fa-circle-o nav-icon"></i> 12 B</a></li>
                                <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade12C' ? 'active' : '' }}" href="{{ url('kelas/grade12C') }}"><i class="fa fa-circle-o nav-icon"></i> 12 C</a></li>
                                <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade12D' ? 'active' : '' }}" href="{{ url('kelas/grade12D') }}"><i class="fa fa-circle-o nav-icon"></i> 12 D</a></li>
                                <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade12E' ? 'active' : '' }}" href="{{ url('kelas/grade12E') }}"><i class="fa fa-circle-o nav-icon"></i> 12 E</a></li>
                                <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade12F' ? 'active' : '' }}" href="{{ url('kelas/grade12F') }}"><i class="fa fa-circle-o nav-icon"></i> 12 F</a></li>
                                <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade12G' ? 'active' : '' }}" href="{{ url('kelas/grade12G') }}"><i class="fa fa-circle-o nav-icon"></i> 12 G</a></li>
                                <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade12H' ? 'active' : '' }}" href="{{ url('kelas/grade12H') }}"><i class="fa fa-circle-o nav-icon"></i> 12 H</a></li>
                                <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade12I' ? 'active' : '' }}" href="{{ url('kelas/grade12I') }}"><i class="fa fa-circle-o nav-icon"></i> 12 I</a></li>
                            </ul>
                        </li>
                    @endif
                    <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'lognilai' ? 'active' : '' }}" href="{{ url('lognilai') }}"><i class="fa fa-circle-o nav-icon"></i> Log Perubahan Nilai</a></li>
                </ul>
            </li>
        </ul>
    </li>
    <li class="nav-item dropdown">
        <a href="#" class="nav-link"><i class="nav-icon fa fa-child"></i><p>Kesiswaan<i class="right fa fa-angle-left"></i></p></a>
        <ul class="nav nav-treeview">
            <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'datainduk' ? 'active' : '' }}" href="{{ url('datainduk') }}"><i class="fa fa-circle-o nav-icon"></i> Data Induk Siswa</a></li>
            <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'rencanakegiatan' ? 'active' : '' }}" href="{{ url('rencanakegiatan') }}"><i class="fa fa-circle-o nav-icon"></i> Rencana Kegiatan Tahunan</a></li>
            <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'lapppdb' ? 'active' : '' }}" href="{{ url('lapppdb') }}"><i class="fa fa-circle-o nav-icon"></i> Laporan PPDB</a></li>
            @if(Session('sekolah_level') != 1)
            <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'beasiswa' ? 'active' : '' }}" href="{{ url('beasiswa') }}"><i class="fa fa-circle-o nav-icon"></i> Laporan Beasiswa</a></li>
            <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'lapekskul' ? 'active' : '' }}" href="{{ url('lapekskul') }}"><i class="fa fa-circle-o nav-icon"></i> Laporan Ekstrakulikuler</a></li>
            <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'penilaianekskul' ? 'active' : '' }}" href="{{ url('penilaianekskul') }}"><i class="fa fa-circle-o nav-icon"></i>  Penilaian Ekstrakulikuler</a></li>
            @endif
            <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'rekappresensi' ? 'active' : '' }}" href="{{ url('rekappresensi') }}"><i class="fa fa-circle-o nav-icon"></i> Rekap Presensi Siswa</a></li>
            <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'presensifinger' ? 'active' : '' }}" href="{{ url('presensifinger') }}"><i class="fa fa-circle-o nav-icon"></i> Laporan Presensi</a></li>
            <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'prestasisiswa' ? 'active' : '' }}" href="{{ url('prestasisiswa') }}"><i class="fa fa-circle-o nav-icon"></i> Laporan Prestasi Siswa</a></li>
        </ul>
    </li>
    <li class="nav-item dropdown">
        <a href="#" class="nav-link"><i class="nav-icon fa fa-book"></i><p>AlQuran<i class="right fa fa-angle-left"></i></p></a>
        <ul class="nav nav-treeview">
            <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'dashboardmengaji' ? 'active' : '' }}" href="{{ url('prestasialquran') }}"><i class="fa fa-circle-o nav-icon"></i> Laporan Prestasi Alquran</a></li>
        </ul>
    </li>
    <li class="nav-item dropdown">
        <a href="#" class="nav-link"><i class="nav-icon fa fa-money"></i><p>Keuangan<i class="right fa fa-angle-left"></i></p></a>
        <ul class="nav nav-treeview">
            <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'setkeuangan' ? 'active' : '' }}" href="{{ url('setkeuangan') }}"><i class="fa fa-circle-o nav-icon"></i> Setting Keuangan</a></li>
            <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'lapbayar' ? 'active' : '' }}" href="{{ url('lapbayar') }}"><i class="fa fa-circle-o nav-icon"></i> Laporan SPP dan Insidental</a></li>
            <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'datakeuhptmasuk' ? 'active' : '' }}" href="{{ url('datakeuhptmasuk') }}"><i class="fa fa-circle-o nav-icon"></i> Keuangan Sekolah</a></li>
            <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'laporankeuhpt' ? 'active' : '' }}" href="{{ url('laporankeuhpt') }}"><i class="fa fa-circle-o nav-icon"></i> Laporan Keuangan</a></li>
            <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'lapamil' ? 'active' : '' }}" href="{{ url('lapamil') }}"><i class="fa fa-circle-o nav-icon"></i> Laporan ZIS</a></li>
            <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'laptabungan' ? 'active' : '' }}" href="{{ url('laptabungan') }}"><i class="fa fa-circle-o nav-icon"></i> Laporan Tabungan</a></li>
            <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'logkeuangan' ? 'active' : '' }}" href="{{ url('logkeuangan') }}"><i class="fa fa-circle-o nav-icon"></i> Laporan Perubahan Data Keuangagn</a></li>
        </ul>
    </li>
    <li class="nav-item dropdown">
        <a href="#" class="nav-link"><i class="nav-icon fa fa-wrench"></i><p>Umum<i class="right fa fa-angle-left"></i></p></a>
        <ul class="nav nav-treeview">
            <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'persuratan' ? 'active' : '' }}" href="{{ url('persuratan') }}"><i class="fa fa-circle-o nav-icon"></i> Persuratan</a></li>
            <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'sarpras' ? 'active' : '' }}" href="{{ url('sarpras') }}"><i class="fa fa-circle-o nav-icon"></i> Sarana dan Prasarana</a></li>
            <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'minimi' ? 'active' : '' }}" href="{{ url('minimi') }}"><i class="fa fa-circle-o nav-icon"></i>  Perpustakaan</a></li>
            <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'datakeluhan' ? 'active' : '' }}" href="{{ url('datakeluhan') }}"><i class="fa fa-circle-o nav-icon"></i> Kritik dan Keluhan</a></li>
        </ul>
    </li>
    <li class="nav-item dropdown">
        <a href="#" class="nav-link"><i class="nav-icon fa fa-gear"></i><p>Setting<i class="right fa fa-angle-left"></i></p></a>
        <ul class="nav nav-treeview">
            <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'useranyar' ? 'active' : '' }}" href="{{ url('useranyar') }}"><i class="fa fa-circle-o nav-icon"></i>  Pendaftaran Account</a></li>
            <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'pengumuman' ? 'active' : '' }}" href="{{ url('pengumuman') }}"><i class="fa fa-circle-o nav-icon"></i>  Pengumuman</a></li>
            <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'setting' ? 'active' : '' }}" href="{{ url('setting') }}"><i class="fa fa-circle-o nav-icon"></i> Setting</a></li>
        </ul>
    </li>
@elseif(Session('previlage') == 'Waka Kurikulum')
    <li class="nav-item">
        <a class="nav-link {{ isset($sidebar) && $sidebar == 'dashbord' ? 'active' : '' }}" href="/" role="button"><i class="nav-icon fa fa-tachometer"></i><p>Dashboard</p></a>
    </li>
    <li class="nav-item dropdown">
        <a href="#" class="nav-link"><i class="nav-icon fa fa-child"></i><p>Kesiswaan<i class="right fa fa-angle-left"></i></p></a>
        <ul class="nav nav-treeview">
            <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'rencanakegiatan' ? 'active' : '' }}" href="{{ url('rencanakegiatan') }}"><i class="fa fa-circle-o nav-icon"></i> Rencana Kegiatan Tahunan</a></li>
            <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'rekappresensi' ? 'active' : '' }}" href="{{ url('rekappresensi') }}"><i class="fa fa-circle-o nav-icon"></i> Rekap Presensi Siswa</a></li>
            <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'pengumuman' ? 'active' : '' }}" href="{{ url('pengumuman') }}"><i class="fa fa-circle-o nav-icon"></i> Pengumuman</a></li>
        </ul>
    </li>
    <li class="nav-item dropdown">
        <a href="#" class="nav-link"><i class="nav-icon fa fa-graduation-cap"></i><p>Ruang Guru<i class="right fa fa-angle-left"></i></p></a>
        <ul class="nav nav-treeview">
            <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'rencanapembelajaran' ? 'active' : '' }}" href="{{ url('setrps') }}"><i class="fa fa-circle-o nav-icon"></i> Kurikulum</a></li>
            <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'banksoal' ? 'active' : '' }}" href="{{ url('banksoal') }}"><i class="fa fa-circle-o nav-icon"></i> Bank Soal</a></li>
            <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'lognilai' ? 'active' : '' }}" href="{{ url('lognilai') }}"><i class="fa fa-circle-o nav-icon"></i>  Log Perubahan Nilai</a></li>
            <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'konseling' ? 'active' : '' }}" href="{{ url('konseling') }}"><i class="fa fa-circle-o nav-icon"></i> Data Bimbingan dan Konseling</a></li>
            @if(Session('sekolah_level') == 1)
                <!--
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link"><i class="nav-icon fa fa-soccer-ball-o"></i><p>Kelompok Belajar<i class="right fa fa-angle-left"></i></p></a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'gradekba' ? 'active' : '' }}" href="{{ url('tahap/gradekba') }}"><i class="fa fa-circle-o nav-icon"></i> KB A</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'gradekba' ? 'active' : '' }}" href="{{ url('tahap/gradekba') }}"><i class="fa fa-circle-o nav-icon"></i> KB B</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'gradekbc' ? 'active' : '' }}" href="{{ url('tahap/gradekbc') }}"><i class="fa fa-circle-o nav-icon"></i> KB C</a></li>
                    </ul>
                </li>
                -->
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link"><i class="nav-icon fa fa-star-half-o"></i><p>Tahap 1<i class="right fa fa-angle-left"></i></p></a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == '1A' ? 'active' : '' }}" href="{{ url('tahap/1A') }}"><i class="fa fa-circle-o nav-icon"></i> Tahap 1.A</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == '1B' ? 'active' : '' }}" href="{{ url('tahap/1B') }}"><i class="fa fa-circle-o nav-icon"></i> Tahap 1.B</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == '1C' ? 'active' : '' }}" href="{{ url('tahap/1C') }}"><i class="fa fa-circle-o nav-icon"></i> Tahap 1.C</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link"><i class="nav-icon fa fa-star"></i><p>Tahap 2<i class="right fa fa-angle-left"></i></p></a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == '2A' ? 'active' : '' }}" href="{{ url('tahap/2A') }}"><i class="fa fa-circle-o nav-icon"></i> Tahap 2.A</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == '2B' ? 'active' : '' }}" href="{{ url('tahap/2B') }}"><i class="fa fa-circle-o nav-icon"></i> Tahap 2.B</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == '2C' ? 'active' : '' }}" href="{{ url('tahap/2C') }}"><i class="fa fa-circle-o nav-icon"></i> Tahap 2.C</a></li>
                    </ul>
                </li>
            @elseif (Session('sekolah_level') == 2)
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link"><i class="nav-icon fa fa-battery-0"></i><p>Kelas I<i class="right fa fa-angle-left"></i></p></a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade1A' ? 'active' : '' }}" href="{{ url('kelas/grade1A') }}"><i class="fa fa-circle-o nav-icon"></i> 1 A</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade1B' ? 'active' : '' }}" href="{{ url('kelas/grade1B') }}"><i class="fa fa-circle-o nav-icon"></i> 1 B</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade1C' ? 'active' : '' }}" href="{{ url('kelas/grade1C') }}"><i class="fa fa-circle-o nav-icon"></i> 1 C</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link"><i class="nav-icon fa fa-battery-1"></i><p>Kelas II<i class="right fa fa-angle-left"></i></p></a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade2A' ? 'active' : '' }}" href="{{ url('kelas/grade2A') }}"><i class="fa fa-circle-o nav-icon"></i> 2 A</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade2B' ? 'active' : '' }}" href="{{ url('kelas/grade2B') }}"><i class="fa fa-circle-o nav-icon"></i> 2 B</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade2C' ? 'active' : '' }}" href="{{ url('kelas/grade2C') }}"><i class="fa fa-circle-o nav-icon"></i> 2 C</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a  href="#" class="nav-link"><i class="nav-icon fa fa-battery-2"></i><p>Kelas III<i class="right fa fa-angle-left"></i></p></a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade3A' ? 'active' : '' }}" href="{{ url('kelas/grade3A') }}"><i class="fa fa-circle-o nav-icon"></i> 3 A</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade3B' ? 'active' : '' }}" href="{{ url('kelas/grade3B') }}"><i class="fa fa-circle-o nav-icon"></i> 3 B</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade3C' ? 'active' : '' }}" href="{{ url('kelas/grade3C') }}"><i class="fa fa-circle-o nav-icon"></i> 3 C</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link"><i class="nav-icon fa fa-battery-3"></i><p>Kelas IV<i class="right fa fa-angle-left"></i></p></a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade4A' ? 'active' : '' }}" href="{{ url('kelas/grade4A') }}"><i class="fa fa-circle-o nav-icon"></i> 4 A</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade4B' ? 'active' : '' }}" href="{{ url('kelas/grade4B') }}"><i class="fa fa-circle-o nav-icon"></i> 4 B</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade4C' ? 'active' : '' }}" href="{{ url('kelas/grade4C') }}"><i class="fa fa-circle-o nav-icon"></i> 4 C</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link"><i class="nav-icon fa fa-battery-4"></i><p>Kelas V<i class="right fa fa-angle-left"></i></p></a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade5A' ? 'active' : '' }}" href="{{ url('kelas/grade5A') }}"><i class="fa fa-circle-o nav-icon"></i> 5 A</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade5B' ? 'active' : '' }}" href="{{ url('kelas/grade5B') }}"><i class="fa fa-circle-o nav-icon"></i> 5 B</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade5C' ? 'active' : '' }}" href="{{ url('kelas/grade5C') }}"><i class="fa fa-circle-o nav-icon"></i> 5 C</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link"><i class="nav-icon fa fa-battery-full"></i><p>Kelas VI<i class="right fa fa-angle-left"></i></p></a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade6A' ? 'active' : '' }}" href="{{ url('kelas/grade6A') }}"><i class="fa fa-circle-o nav-icon"></i> 6 A</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade6B' ? 'active' : '' }}" href="{{ url('kelas/grade6B') }}"><i class="fa fa-circle-o nav-icon"></i> 6 B</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade6C' ? 'active' : '' }}" href="{{ url('kelas/grade6C') }}"><i class="fa fa-circle-o nav-icon"></i> 6 C</a></li>
                    </ul>
                </li>
            @elseif (Session('sekolah_level') == 3)
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link"><i class="nav-icon fa fa-battery-1"></i><p>Kelas VII<i class="right fa fa-angle-left"></i></p></a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade7A' ? 'active' : '' }}" href="{{ url('kelas/grade7A') }}"><i class="fa fa-circle-o nav-icon"></i> 7 A</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade7B' ? 'active' : '' }}" href="{{ url('kelas/grade7B') }}"><i class="fa fa-circle-o nav-icon"></i> 7 B</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade7C' ? 'active' : '' }}" href="{{ url('kelas/grade7C') }}"><i class="fa fa-circle-o nav-icon"></i> 7 C</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade7D' ? 'active' : '' }}" href="{{ url('kelas/grade7D') }}"><i class="fa fa-circle-o nav-icon"></i> 7 D</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade7E' ? 'active' : '' }}" href="{{ url('kelas/grade7E') }}"><i class="fa fa-circle-o nav-icon"></i> 7 E</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade7F' ? 'active' : '' }}" href="{{ url('kelas/grade7F') }}"><i class="fa fa-circle-o nav-icon"></i> 7 F</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade7G' ? 'active' : '' }}" href="{{ url('kelas/grade7G') }}"><i class="fa fa-circle-o nav-icon"></i> 7 G</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade7H' ? 'active' : '' }}" href="{{ url('kelas/grade7H') }}"><i class="fa fa-circle-o nav-icon"></i> 7 H</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade7I' ? 'active' : '' }}" href="{{ url('kelas/grade7I') }}"><i class="fa fa-circle-o nav-icon"></i> 7 I</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link"><i class="nav-icon fa fa-battery-2"></i><p>Kelas VIII<i class="right fa fa-angle-left"></i></p></a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade8A' ? 'active' : '' }}" href="{{ url('kelas/grade8A') }}"><i class="fa fa-circle-o nav-icon"></i> 8 A</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade8B' ? 'active' : '' }}" href="{{ url('kelas/grade8B') }}"><i class="fa fa-circle-o nav-icon"></i> 8 B</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade8C' ? 'active' : '' }}" href="{{ url('kelas/grade8C') }}"><i class="fa fa-circle-o nav-icon"></i> 8 C</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade8D' ? 'active' : '' }}" href="{{ url('kelas/grade8D') }}"><i class="fa fa-circle-o nav-icon"></i> 8 D</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade8E' ? 'active' : '' }}" href="{{ url('kelas/grade8E') }}"><i class="fa fa-circle-o nav-icon"></i> 8 E</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade8F' ? 'active' : '' }}" href="{{ url('kelas/grade8F') }}"><i class="fa fa-circle-o nav-icon"></i> 8 F</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade8G' ? 'active' : '' }}" href="{{ url('kelas/grade8G') }}"><i class="fa fa-circle-o nav-icon"></i> 8 G</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade8H' ? 'active' : '' }}" href="{{ url('kelas/grade8H') }}"><i class="fa fa-circle-o nav-icon"></i> 8 H</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade8I' ? 'active' : '' }}" href="{{ url('kelas/grade8I') }}"><i class="fa fa-circle-o nav-icon"></i> 8 I</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link"><i class="nav-icon fa fa-battery-4"></i><p>Kelas IX<i class="right fa fa-angle-left"></i></p></a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade9A' ? 'active' : '' }}" href="{{ url('kelas/grade9A') }}"><i class="fa fa-circle-o nav-icon"></i> 9 A</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade9B' ? 'active' : '' }}" href="{{ url('kelas/grade9B') }}"><i class="fa fa-circle-o nav-icon"></i> 9 B</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade9C' ? 'active' : '' }}" href="{{ url('kelas/grade9C') }}"><i class="fa fa-circle-o nav-icon"></i> 9 C</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade9D' ? 'active' : '' }}" href="{{ url('kelas/grade9D') }}"><i class="fa fa-circle-o nav-icon"></i> 9 D</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade9E' ? 'active' : '' }}" href="{{ url('kelas/grade9E') }}"><i class="fa fa-circle-o nav-icon"></i> 9 E</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade9F' ? 'active' : '' }}" href="{{ url('kelas/grade9F') }}"><i class="fa fa-circle-o nav-icon"></i> 9 F</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade9G' ? 'active' : '' }}" href="{{ url('kelas/grade9G') }}"><i class="fa fa-circle-o nav-icon"></i> 9 G</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade9H' ? 'active' : '' }}" href="{{ url('kelas/grade9H') }}"><i class="fa fa-circle-o nav-icon"></i> 9 H</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade9I' ? 'active' : '' }}" href="{{ url('kelas/grade9I') }}"><i class="fa fa-circle-o nav-icon"></i> 9 I</a></li>
                    </ul>
                </li>
            @else
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link"><i class="nav-icon fa fa-battery-1"></i><p>Kelas X<i class="right fa fa-angle-left"></i></p></a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade10A' ? 'active' : '' }}" href="{{ url('kelas/grade10A') }}"><i class="fa fa-circle-o nav-icon"></i> 10 A</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade10B' ? 'active' : '' }}" href="{{ url('kelas/grade10B') }}"><i class="fa fa-circle-o nav-icon"></i> 10 B</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade10C' ? 'active' : '' }}" href="{{ url('kelas/grade10C') }}"><i class="fa fa-circle-o nav-icon"></i> 10 C</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade10D' ? 'active' : '' }}" href="{{ url('kelas/grade10D') }}"><i class="fa fa-circle-o nav-icon"></i> 10 D</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade10E' ? 'active' : '' }}" href="{{ url('kelas/grade10E') }}"><i class="fa fa-circle-o nav-icon"></i> 10 E</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade10F' ? 'active' : '' }}" href="{{ url('kelas/grade10F') }}"><i class="fa fa-circle-o nav-icon"></i> 10 F</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade10G' ? 'active' : '' }}" href="{{ url('kelas/grade10G') }}"><i class="fa fa-circle-o nav-icon"></i> 10 G</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade10H' ? 'active' : '' }}" href="{{ url('kelas/grade10H') }}"><i class="fa fa-circle-o nav-icon"></i> 10 H</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade10I' ? 'active' : '' }}" href="{{ url('kelas/grade10I') }}"><i class="fa fa-circle-o nav-icon"></i> 10 I</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link"><i class="nav-icon fa fa-battery-2"></i><p>Kelas XI<i class="right fa fa-angle-left"></i></p></a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade11A' ? 'active' : '' }}" href="{{ url('kelas/grade11A') }}"><i class="fa fa-circle-o nav-icon"></i> 11 A</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade11B' ? 'active' : '' }}" href="{{ url('kelas/grade11B') }}"><i class="fa fa-circle-o nav-icon"></i> 11 B</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade11C' ? 'active' : '' }}" href="{{ url('kelas/grade11C') }}"><i class="fa fa-circle-o nav-icon"></i> 11 C</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade11D' ? 'active' : '' }}" href="{{ url('kelas/grade11D') }}"><i class="fa fa-circle-o nav-icon"></i> 11 D</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade11F' ? 'active' : '' }}" href="{{ url('kelas/grade11F') }}"><i class="fa fa-circle-o nav-icon"></i> 11 F</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade11G' ? 'active' : '' }}" href="{{ url('kelas/grade11G') }}"><i class="fa fa-circle-o nav-icon"></i> 11 G</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade11H' ? 'active' : '' }}" href="{{ url('kelas/grade11H') }}"><i class="fa fa-circle-o nav-icon"></i> 11 H</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade11I' ? 'active' : '' }}" href="{{ url('kelas/grade11I') }}"><i class="fa fa-circle-o nav-icon"></i> 11 I</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link"><i class="nav-icon fa fa-battery-4"></i><p>Kelas XII<i class="right fa fa-angle-left"></i></p></a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade12A' ? 'active' : '' }}" href="{{ url('kelas/grade12A') }}"><i class="fa fa-circle-o nav-icon"></i> 12 A</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade12B' ? 'active' : '' }}" href="{{ url('kelas/grade12B') }}"><i class="fa fa-circle-o nav-icon"></i> 12 B</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade12C' ? 'active' : '' }}" href="{{ url('kelas/grade12C') }}"><i class="fa fa-circle-o nav-icon"></i> 12 C</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade12D' ? 'active' : '' }}" href="{{ url('kelas/grade12D') }}"><i class="fa fa-circle-o nav-icon"></i> 12 D</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade12E' ? 'active' : '' }}" href="{{ url('kelas/grade12E') }}"><i class="fa fa-circle-o nav-icon"></i> 12 E</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade12F' ? 'active' : '' }}" href="{{ url('kelas/grade12F') }}"><i class="fa fa-circle-o nav-icon"></i> 12 F</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade12G' ? 'active' : '' }}" href="{{ url('kelas/grade12G') }}"><i class="fa fa-circle-o nav-icon"></i> 12 G</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade12H' ? 'active' : '' }}" href="{{ url('kelas/grade12H') }}"><i class="fa fa-circle-o nav-icon"></i> 12 H</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade12I' ? 'active' : '' }}" href="{{ url('kelas/grade12I') }}"><i class="fa fa-circle-o nav-icon"></i> 12 I</a></li>
                    </ul>
                </li>
            @endif
        </ul>
    </li>
@elseif(Session('previlage') == 'Waka Kesiswaan')
    <li class="nav-item">
        <a class="nav-link {{ isset($sidebar) && $sidebar == 'dashbord' ? 'active' : '' }}" href="/" role="button"><i class="nav-icon fa fa-tachometer"></i><p>Dashboard</p></a>
    </li>
    <li class="nav-item dropdown">
        <a href="#" class="nav-link"><i class="nav-icon fa fa-child"></i><p>Kesiswaan<i class="right fa fa-angle-left"></i></p></a>
        <ul class="nav nav-treeview">
            <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'rencanakegiatan' ? 'active' : '' }}" href="{{ url('rencanakegiatan') }}"><i class="fa fa-circle-o nav-icon"></i> Rencana Kegiatan Tahunan</a></li>
            <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'konseling' ? 'active' : '' }}" href="{{ url('konseling') }}"><i class="fa fa-circle-o nav-icon"></i> Data Bimbingan dan Konseling</a></li>
            <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'lapppdb' ? 'active' : '' }}" href="{{ url('lapppdb') }}"><i class="fa fa-circle-o nav-icon"></i> Laporan PPDB</a></li>
            <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'prestasisiswa' ? 'active' : '' }}" href="{{ url('prestasisiswa') }}"><i class="fa fa-circle-o nav-icon"></i> Laporan Prestasi Siswa</a></li>
            @if(Session('sekolah_level') != 1)
            <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'beasiswa' ? 'active' : '' }}" href="{{ url('beasiswa') }}"><i class="fa fa-circle-o nav-icon"></i> Laporan Beasiswa</a></li>
            <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'lapekskul' ? 'active' : '' }}" href="{{ url('lapekskul') }}"><i class="fa fa-circle-o nav-icon"></i> Laporan Ekstrakulikuler</a></li>
            <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'penilaianekskul' ? 'active' : '' }}" href="{{ url('penilaianekskul') }}"><i class="fa fa-circle-o nav-icon"></i>  Penilaian Ekstrakulikuler</a></li>
            @endif
            <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'rekappresensi' ? 'active' : '' }}" href="{{ url('rekappresensi') }}"><i class="fa fa-circle-o nav-icon"></i> Rekap Presensi Siswa</a></li>
            <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'pengumuman' ? 'active' : '' }}" href="{{ url('pengumuman') }}"><i class="fa fa-circle-o nav-icon"></i> Pengumuman</a></li>
        </ul>
    </li>
    <li class="nav-item dropdown">
        <a href="#" class="nav-link"><i class="nav-icon fa fa-graduation-cap"></i><p>Ruang Guru<i class="right fa fa-angle-left"></i></p></a>
        <ul class="nav nav-treeview">
            <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'rencanapembelajaran' ? 'active' : '' }}" href="{{ url('setrps') }}"><i class="fa fa-circle-o nav-icon"></i> Kurikulum</a></li>
            <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'banksoal' ? 'active' : '' }}" href="{{ url('banksoal') }}"><i class="fa fa-circle-o nav-icon"></i> Bank Soal</a></li>
            @if(Session('sekolah_level') == 1)
                <!--
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link"><i class="nav-icon fa fa-soccer-ball-o"></i><p>Kelompok Belajar<i class="right fa fa-angle-left"></i></p></a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'gradekba' ? 'active' : '' }}" href="{{ url('tahap/gradekba') }}"><i class="fa fa-circle-o nav-icon"></i> KB A</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'gradekba' ? 'active' : '' }}" href="{{ url('tahap/gradekba') }}"><i class="fa fa-circle-o nav-icon"></i> KB B</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'gradekbc' ? 'active' : '' }}" href="{{ url('tahap/gradekbc') }}"><i class="fa fa-circle-o nav-icon"></i> KB C</a></li>
                    </ul>
                </li>
                -->
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link"><i class="nav-icon fa fa-star-half-o"></i><p>Tahap 1<i class="right fa fa-angle-left"></i></p></a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == '1A' ? 'active' : '' }}" href="{{ url('tahap/1A') }}"><i class="fa fa-circle-o nav-icon"></i> Tahap 1.A</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == '1B' ? 'active' : '' }}" href="{{ url('tahap/1B') }}"><i class="fa fa-circle-o nav-icon"></i> Tahap 1.B</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == '1C' ? 'active' : '' }}" href="{{ url('tahap/1C') }}"><i class="fa fa-circle-o nav-icon"></i> Tahap 1.C</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link"><i class="nav-icon fa fa-star"></i><p>Tahap 2<i class="right fa fa-angle-left"></i></p></a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == '2A' ? 'active' : '' }}" href="{{ url('tahap/2A') }}"><i class="fa fa-circle-o nav-icon"></i> Tahap 2.A</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == '2B' ? 'active' : '' }}" href="{{ url('tahap/2B') }}"><i class="fa fa-circle-o nav-icon"></i> Tahap 2.B</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == '2C' ? 'active' : '' }}" href="{{ url('tahap/2C') }}"><i class="fa fa-circle-o nav-icon"></i> Tahap 2.C</a></li>
                    </ul>
                </li>
            @elseif (Session('sekolah_level') == 2)
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link"><i class="nav-icon fa fa-battery-0"></i><p>Kelas I<i class="right fa fa-angle-left"></i></p></a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade1A' ? 'active' : '' }}" href="{{ url('kelas/grade1A') }}"><i class="fa fa-circle-o nav-icon"></i> 1 A</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade1B' ? 'active' : '' }}" href="{{ url('kelas/grade1B') }}"><i class="fa fa-circle-o nav-icon"></i> 1 B</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade1C' ? 'active' : '' }}" href="{{ url('kelas/grade1C') }}"><i class="fa fa-circle-o nav-icon"></i> 1 C</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link"><i class="nav-icon fa fa-battery-1"></i><p>Kelas II<i class="right fa fa-angle-left"></i></p></a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade2A' ? 'active' : '' }}" href="{{ url('kelas/grade2A') }}"><i class="fa fa-circle-o nav-icon"></i> 2 A</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade2B' ? 'active' : '' }}" href="{{ url('kelas/grade2B') }}"><i class="fa fa-circle-o nav-icon"></i> 2 B</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade2C' ? 'active' : '' }}" href="{{ url('kelas/grade2C') }}"><i class="fa fa-circle-o nav-icon"></i> 2 C</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a  href="#" class="nav-link"><i class="nav-icon fa fa-battery-2"></i><p>Kelas III<i class="right fa fa-angle-left"></i></p></a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade3A' ? 'active' : '' }}" href="{{ url('kelas/grade3A') }}"><i class="fa fa-circle-o nav-icon"></i> 3 A</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade3B' ? 'active' : '' }}" href="{{ url('kelas/grade3B') }}"><i class="fa fa-circle-o nav-icon"></i> 3 B</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade3C' ? 'active' : '' }}" href="{{ url('kelas/grade3C') }}"><i class="fa fa-circle-o nav-icon"></i> 3 C</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link"><i class="nav-icon fa fa-battery-3"></i><p>Kelas IV<i class="right fa fa-angle-left"></i></p></a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade4A' ? 'active' : '' }}" href="{{ url('kelas/grade4A') }}"><i class="fa fa-circle-o nav-icon"></i> 4 A</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade4B' ? 'active' : '' }}" href="{{ url('kelas/grade4B') }}"><i class="fa fa-circle-o nav-icon"></i> 4 B</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade4C' ? 'active' : '' }}" href="{{ url('kelas/grade4C') }}"><i class="fa fa-circle-o nav-icon"></i> 4 C</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link"><i class="nav-icon fa fa-battery-4"></i><p>Kelas V<i class="right fa fa-angle-left"></i></p></a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade5A' ? 'active' : '' }}" href="{{ url('kelas/grade5A') }}"><i class="fa fa-circle-o nav-icon"></i> 5 A</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade5B' ? 'active' : '' }}" href="{{ url('kelas/grade5B') }}"><i class="fa fa-circle-o nav-icon"></i> 5 B</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade5C' ? 'active' : '' }}" href="{{ url('kelas/grade5C') }}"><i class="fa fa-circle-o nav-icon"></i> 5 C</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link"><i class="nav-icon fa fa-battery-full"></i><p>Kelas VI<i class="right fa fa-angle-left"></i></p></a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade6A' ? 'active' : '' }}" href="{{ url('kelas/grade6A') }}"><i class="fa fa-circle-o nav-icon"></i> 6 A</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade6B' ? 'active' : '' }}" href="{{ url('kelas/grade6B') }}"><i class="fa fa-circle-o nav-icon"></i> 6 B</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade6C' ? 'active' : '' }}" href="{{ url('kelas/grade6C') }}"><i class="fa fa-circle-o nav-icon"></i> 6 C</a></li>
                    </ul>
                </li>
            @elseif (Session('sekolah_level') == 3)
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link"><i class="nav-icon fa fa-battery-1"></i><p>Kelas VII<i class="right fa fa-angle-left"></i></p></a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade7A' ? 'active' : '' }}" href="{{ url('kelas/grade7A') }}"><i class="fa fa-circle-o nav-icon"></i> 7 A</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade7B' ? 'active' : '' }}" href="{{ url('kelas/grade7B') }}"><i class="fa fa-circle-o nav-icon"></i> 7 B</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade7C' ? 'active' : '' }}" href="{{ url('kelas/grade7C') }}"><i class="fa fa-circle-o nav-icon"></i> 7 C</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade7D' ? 'active' : '' }}" href="{{ url('kelas/grade7D') }}"><i class="fa fa-circle-o nav-icon"></i> 7 D</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade7E' ? 'active' : '' }}" href="{{ url('kelas/grade7E') }}"><i class="fa fa-circle-o nav-icon"></i> 7 E</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade7F' ? 'active' : '' }}" href="{{ url('kelas/grade7F') }}"><i class="fa fa-circle-o nav-icon"></i> 7 F</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade7G' ? 'active' : '' }}" href="{{ url('kelas/grade7G') }}"><i class="fa fa-circle-o nav-icon"></i> 7 G</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade7H' ? 'active' : '' }}" href="{{ url('kelas/grade7H') }}"><i class="fa fa-circle-o nav-icon"></i> 7 H</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade7I' ? 'active' : '' }}" href="{{ url('kelas/grade7I') }}"><i class="fa fa-circle-o nav-icon"></i> 7 I</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link"><i class="nav-icon fa fa-battery-2"></i><p>Kelas VIII<i class="right fa fa-angle-left"></i></p></a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade8A' ? 'active' : '' }}" href="{{ url('kelas/grade8A') }}"><i class="fa fa-circle-o nav-icon"></i> 8 A</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade8B' ? 'active' : '' }}" href="{{ url('kelas/grade8B') }}"><i class="fa fa-circle-o nav-icon"></i> 8 B</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade8C' ? 'active' : '' }}" href="{{ url('kelas/grade8C') }}"><i class="fa fa-circle-o nav-icon"></i> 8 C</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade8D' ? 'active' : '' }}" href="{{ url('kelas/grade8D') }}"><i class="fa fa-circle-o nav-icon"></i> 8 D</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade8E' ? 'active' : '' }}" href="{{ url('kelas/grade8E') }}"><i class="fa fa-circle-o nav-icon"></i> 8 E</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade8F' ? 'active' : '' }}" href="{{ url('kelas/grade8F') }}"><i class="fa fa-circle-o nav-icon"></i> 8 F</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade8G' ? 'active' : '' }}" href="{{ url('kelas/grade8G') }}"><i class="fa fa-circle-o nav-icon"></i> 8 G</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade8H' ? 'active' : '' }}" href="{{ url('kelas/grade8H') }}"><i class="fa fa-circle-o nav-icon"></i> 8 H</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade8I' ? 'active' : '' }}" href="{{ url('kelas/grade8I') }}"><i class="fa fa-circle-o nav-icon"></i> 8 I</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link"><i class="nav-icon fa fa-battery-4"></i><p>Kelas IX<i class="right fa fa-angle-left"></i></p></a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade9A' ? 'active' : '' }}" href="{{ url('kelas/grade9A') }}"><i class="fa fa-circle-o nav-icon"></i> 9 A</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade9B' ? 'active' : '' }}" href="{{ url('kelas/grade9B') }}"><i class="fa fa-circle-o nav-icon"></i> 9 B</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade9C' ? 'active' : '' }}" href="{{ url('kelas/grade9C') }}"><i class="fa fa-circle-o nav-icon"></i> 9 C</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade9D' ? 'active' : '' }}" href="{{ url('kelas/grade9D') }}"><i class="fa fa-circle-o nav-icon"></i> 9 D</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade9E' ? 'active' : '' }}" href="{{ url('kelas/grade9E') }}"><i class="fa fa-circle-o nav-icon"></i> 9 E</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade9F' ? 'active' : '' }}" href="{{ url('kelas/grade9F') }}"><i class="fa fa-circle-o nav-icon"></i> 9 F</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade9G' ? 'active' : '' }}" href="{{ url('kelas/grade9G') }}"><i class="fa fa-circle-o nav-icon"></i> 9 G</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade9H' ? 'active' : '' }}" href="{{ url('kelas/grade9H') }}"><i class="fa fa-circle-o nav-icon"></i> 9 H</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade9I' ? 'active' : '' }}" href="{{ url('kelas/grade9I') }}"><i class="fa fa-circle-o nav-icon"></i> 9 I</a></li>
                    </ul>
                </li>
            @else
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link"><i class="nav-icon fa fa-battery-1"></i><p>Kelas X<i class="right fa fa-angle-left"></i></p></a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade10A' ? 'active' : '' }}" href="{{ url('kelas/grade10A') }}"><i class="fa fa-circle-o nav-icon"></i> 10 A</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade10B' ? 'active' : '' }}" href="{{ url('kelas/grade10B') }}"><i class="fa fa-circle-o nav-icon"></i> 10 B</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade10C' ? 'active' : '' }}" href="{{ url('kelas/grade10C') }}"><i class="fa fa-circle-o nav-icon"></i> 10 C</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade10D' ? 'active' : '' }}" href="{{ url('kelas/grade10D') }}"><i class="fa fa-circle-o nav-icon"></i> 10 D</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade10E' ? 'active' : '' }}" href="{{ url('kelas/grade10E') }}"><i class="fa fa-circle-o nav-icon"></i> 10 E</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade10F' ? 'active' : '' }}" href="{{ url('kelas/grade10F') }}"><i class="fa fa-circle-o nav-icon"></i> 10 F</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade10G' ? 'active' : '' }}" href="{{ url('kelas/grade10G') }}"><i class="fa fa-circle-o nav-icon"></i> 10 G</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade10H' ? 'active' : '' }}" href="{{ url('kelas/grade10H') }}"><i class="fa fa-circle-o nav-icon"></i> 10 H</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade10I' ? 'active' : '' }}" href="{{ url('kelas/grade10I') }}"><i class="fa fa-circle-o nav-icon"></i> 10 I</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link"><i class="nav-icon fa fa-battery-2"></i><p>Kelas XI<i class="right fa fa-angle-left"></i></p></a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade11A' ? 'active' : '' }}" href="{{ url('kelas/grade11A') }}"><i class="fa fa-circle-o nav-icon"></i> 11 A</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade11B' ? 'active' : '' }}" href="{{ url('kelas/grade11B') }}"><i class="fa fa-circle-o nav-icon"></i> 11 B</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade11C' ? 'active' : '' }}" href="{{ url('kelas/grade11C') }}"><i class="fa fa-circle-o nav-icon"></i> 11 C</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade11D' ? 'active' : '' }}" href="{{ url('kelas/grade11D') }}"><i class="fa fa-circle-o nav-icon"></i> 11 D</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade11F' ? 'active' : '' }}" href="{{ url('kelas/grade11F') }}"><i class="fa fa-circle-o nav-icon"></i> 11 F</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade11G' ? 'active' : '' }}" href="{{ url('kelas/grade11G') }}"><i class="fa fa-circle-o nav-icon"></i> 11 G</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade11H' ? 'active' : '' }}" href="{{ url('kelas/grade11H') }}"><i class="fa fa-circle-o nav-icon"></i> 11 H</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade11I' ? 'active' : '' }}" href="{{ url('kelas/grade11I') }}"><i class="fa fa-circle-o nav-icon"></i> 11 I</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link"><i class="nav-icon fa fa-battery-4"></i><p>Kelas XII<i class="right fa fa-angle-left"></i></p></a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade12A' ? 'active' : '' }}" href="{{ url('kelas/grade12A') }}"><i class="fa fa-circle-o nav-icon"></i> 12 A</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade12B' ? 'active' : '' }}" href="{{ url('kelas/grade12B') }}"><i class="fa fa-circle-o nav-icon"></i> 12 B</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade12C' ? 'active' : '' }}" href="{{ url('kelas/grade12C') }}"><i class="fa fa-circle-o nav-icon"></i> 12 C</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade12D' ? 'active' : '' }}" href="{{ url('kelas/grade12D') }}"><i class="fa fa-circle-o nav-icon"></i> 12 D</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade12E' ? 'active' : '' }}" href="{{ url('kelas/grade12E') }}"><i class="fa fa-circle-o nav-icon"></i> 12 E</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade12F' ? 'active' : '' }}" href="{{ url('kelas/grade12F') }}"><i class="fa fa-circle-o nav-icon"></i> 12 F</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade12G' ? 'active' : '' }}" href="{{ url('kelas/grade12G') }}"><i class="fa fa-circle-o nav-icon"></i> 12 G</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade12H' ? 'active' : '' }}" href="{{ url('kelas/grade12H') }}"><i class="fa fa-circle-o nav-icon"></i> 12 H</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade12I' ? 'active' : '' }}" href="{{ url('kelas/grade12I') }}"><i class="fa fa-circle-o nav-icon"></i> 12 I</a></li>
                    </ul>
                </li>
            @endif
        </ul>
    </li>
@elseif(Session('previlage') == 'Waka Kurikulum Al Quran')
    <li class="nav-item">
        <a class="nav-link {{ isset($sidebar) && $sidebar == 'dashbord' ? 'active' : '' }}" href="/" role="button"><i class="nav-icon fa fa-tachometer"></i><p>Dashboard</p></a>
    </li>
    <li class="nav-item dropdown">
        <a href="#" class="nav-link"><i class="nav-icon fa fa-bars"></i><p>Main Menu<i class="right fa fa-angle-left"></i></p></a>
        <ul class="nav nav-treeview">
            <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'dashboardmengaji' ? 'active' : '' }}" href="{{ url('prestasialquran') }}"><i class="fa fa-circle-o nav-icon"></i> Kurikulum Alquran</a></li>
        </ul>
    </li>
    <li class="nav-item dropdown">
        <a href="#" class="nav-link"><i class="nav-icon fa fa-child"></i><p>Kesiswaan<i class="right fa fa-angle-left"></i></p></a>
        <ul class="nav nav-treeview">
            <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'rencanakegiatan' ? 'active' : '' }}" href="{{ url('rencanakegiatan') }}"><i class="fa fa-circle-o nav-icon"></i> Rencana Kegiatan Tahunan</a></li>
            <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'rekappresensi' ? 'active' : '' }}" href="{{ url('rekappresensi') }}"><i class="fa fa-circle-o nav-icon"></i> Rekap Presensi Siswa</a></li>
            <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'pengumuman' ? 'active' : '' }}" href="{{ url('pengumuman') }}"><i class="fa fa-circle-o nav-icon"></i> Pengumuman</a></li>
        </ul>
    </li>
    <li class="nav-item dropdown">
        <a href="#" class="nav-link"><i class="nav-icon fa fa-graduation-cap"></i><p>Ruang Guru<i class="right fa fa-angle-left"></i></p></a>
        <ul class="nav nav-treeview">
            <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'konseling' ? 'active' : '' }}" href="{{ url('konseling') }}"><i class="fa fa-circle-o nav-icon"></i> Data Bimbingan dan Konseling</a></li>
            <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'rencanapembelajaran' ? 'active' : '' }}" href="{{ url('setrps') }}"><i class="fa fa-circle-o nav-icon"></i> Kurikulum</a></li>
            <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'banksoal' ? 'active' : '' }}" href="{{ url('banksoal') }}"><i class="fa fa-circle-o nav-icon"></i> Bank Soal</a></li>
            @if(Session('sekolah_level') == 1)
                <!--
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link"><i class="nav-icon fa fa-soccer-ball-o"></i><p>Kelompok Belajar<i class="right fa fa-angle-left"></i></p></a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'gradekba' ? 'active' : '' }}" href="{{ url('tahap/gradekba') }}"><i class="fa fa-circle-o nav-icon"></i> KB A</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'gradekba' ? 'active' : '' }}" href="{{ url('tahap/gradekba') }}"><i class="fa fa-circle-o nav-icon"></i> KB B</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'gradekbc' ? 'active' : '' }}" href="{{ url('tahap/gradekbc') }}"><i class="fa fa-circle-o nav-icon"></i> KB C</a></li>
                    </ul>
                </li>
                -->
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link"><i class="nav-icon fa fa-star-half-o"></i><p>Tahap 1<i class="right fa fa-angle-left"></i></p></a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == '1A' ? 'active' : '' }}" href="{{ url('tahap/1A') }}"><i class="fa fa-circle-o nav-icon"></i> Tahap 1.A</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == '1B' ? 'active' : '' }}" href="{{ url('tahap/1B') }}"><i class="fa fa-circle-o nav-icon"></i> Tahap 1.B</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == '1C' ? 'active' : '' }}" href="{{ url('tahap/1C') }}"><i class="fa fa-circle-o nav-icon"></i> Tahap 1.C</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link"><i class="nav-icon fa fa-star"></i><p>Tahap 2<i class="right fa fa-angle-left"></i></p></a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == '2A' ? 'active' : '' }}" href="{{ url('tahap/2A') }}"><i class="fa fa-circle-o nav-icon"></i> Tahap 2.A</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == '2B' ? 'active' : '' }}" href="{{ url('tahap/2B') }}"><i class="fa fa-circle-o nav-icon"></i> Tahap 2.B</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == '2C' ? 'active' : '' }}" href="{{ url('tahap/2C') }}"><i class="fa fa-circle-o nav-icon"></i> Tahap 2.C</a></li>
                    </ul>
                </li>
            @elseif (Session('sekolah_level') == 2)
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link"><i class="nav-icon fa fa-battery-0"></i><p>Kelas I<i class="right fa fa-angle-left"></i></p></a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade1A' ? 'active' : '' }}" href="{{ url('kelas/grade1A') }}"><i class="fa fa-circle-o nav-icon"></i> 1 A</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade1B' ? 'active' : '' }}" href="{{ url('kelas/grade1B') }}"><i class="fa fa-circle-o nav-icon"></i> 1 B</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade1C' ? 'active' : '' }}" href="{{ url('kelas/grade1C') }}"><i class="fa fa-circle-o nav-icon"></i> 1 C</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link"><i class="nav-icon fa fa-battery-1"></i><p>Kelas II<i class="right fa fa-angle-left"></i></p></a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade2A' ? 'active' : '' }}" href="{{ url('kelas/grade2A') }}"><i class="fa fa-circle-o nav-icon"></i> 2 A</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade2B' ? 'active' : '' }}" href="{{ url('kelas/grade2B') }}"><i class="fa fa-circle-o nav-icon"></i> 2 B</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade2C' ? 'active' : '' }}" href="{{ url('kelas/grade2C') }}"><i class="fa fa-circle-o nav-icon"></i> 2 C</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a  href="#" class="nav-link"><i class="nav-icon fa fa-battery-2"></i><p>Kelas III<i class="right fa fa-angle-left"></i></p></a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade3A' ? 'active' : '' }}" href="{{ url('kelas/grade3A') }}"><i class="fa fa-circle-o nav-icon"></i> 3 A</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade3B' ? 'active' : '' }}" href="{{ url('kelas/grade3B') }}"><i class="fa fa-circle-o nav-icon"></i> 3 B</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade3C' ? 'active' : '' }}" href="{{ url('kelas/grade3C') }}"><i class="fa fa-circle-o nav-icon"></i> 3 C</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link"><i class="nav-icon fa fa-battery-3"></i><p>Kelas IV<i class="right fa fa-angle-left"></i></p></a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade4A' ? 'active' : '' }}" href="{{ url('kelas/grade4A') }}"><i class="fa fa-circle-o nav-icon"></i> 4 A</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade4B' ? 'active' : '' }}" href="{{ url('kelas/grade4B') }}"><i class="fa fa-circle-o nav-icon"></i> 4 B</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade4C' ? 'active' : '' }}" href="{{ url('kelas/grade4C') }}"><i class="fa fa-circle-o nav-icon"></i> 4 C</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link"><i class="nav-icon fa fa-battery-4"></i><p>Kelas V<i class="right fa fa-angle-left"></i></p></a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade5A' ? 'active' : '' }}" href="{{ url('kelas/grade5A') }}"><i class="fa fa-circle-o nav-icon"></i> 5 A</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade5B' ? 'active' : '' }}" href="{{ url('kelas/grade5B') }}"><i class="fa fa-circle-o nav-icon"></i> 5 B</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade5C' ? 'active' : '' }}" href="{{ url('kelas/grade5C') }}"><i class="fa fa-circle-o nav-icon"></i> 5 C</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link"><i class="nav-icon fa fa-battery-full"></i><p>Kelas VI<i class="right fa fa-angle-left"></i></p></a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade6A' ? 'active' : '' }}" href="{{ url('kelas/grade6A') }}"><i class="fa fa-circle-o nav-icon"></i> 6 A</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade6B' ? 'active' : '' }}" href="{{ url('kelas/grade6B') }}"><i class="fa fa-circle-o nav-icon"></i> 6 B</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade6C' ? 'active' : '' }}" href="{{ url('kelas/grade6C') }}"><i class="fa fa-circle-o nav-icon"></i> 6 C</a></li>
                    </ul>
                </li>
            @elseif (Session('sekolah_level') == 3)
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link"><i class="nav-icon fa fa-battery-1"></i><p>Kelas VII<i class="right fa fa-angle-left"></i></p></a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade7A' ? 'active' : '' }}" href="{{ url('kelas/grade7A') }}"><i class="fa fa-circle-o nav-icon"></i> 7 A</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade7B' ? 'active' : '' }}" href="{{ url('kelas/grade7B') }}"><i class="fa fa-circle-o nav-icon"></i> 7 B</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade7C' ? 'active' : '' }}" href="{{ url('kelas/grade7C') }}"><i class="fa fa-circle-o nav-icon"></i> 7 C</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade7D' ? 'active' : '' }}" href="{{ url('kelas/grade7D') }}"><i class="fa fa-circle-o nav-icon"></i> 7 D</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade7E' ? 'active' : '' }}" href="{{ url('kelas/grade7E') }}"><i class="fa fa-circle-o nav-icon"></i> 7 E</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade7F' ? 'active' : '' }}" href="{{ url('kelas/grade7F') }}"><i class="fa fa-circle-o nav-icon"></i> 7 F</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade7G' ? 'active' : '' }}" href="{{ url('kelas/grade7G') }}"><i class="fa fa-circle-o nav-icon"></i> 7 G</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade7H' ? 'active' : '' }}" href="{{ url('kelas/grade7H') }}"><i class="fa fa-circle-o nav-icon"></i> 7 H</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade7I' ? 'active' : '' }}" href="{{ url('kelas/grade7I') }}"><i class="fa fa-circle-o nav-icon"></i> 7 I</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link"><i class="nav-icon fa fa-battery-2"></i><p>Kelas VIII<i class="right fa fa-angle-left"></i></p></a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade8A' ? 'active' : '' }}" href="{{ url('kelas/grade8A') }}"><i class="fa fa-circle-o nav-icon"></i> 8 A</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade8B' ? 'active' : '' }}" href="{{ url('kelas/grade8B') }}"><i class="fa fa-circle-o nav-icon"></i> 8 B</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade8C' ? 'active' : '' }}" href="{{ url('kelas/grade8C') }}"><i class="fa fa-circle-o nav-icon"></i> 8 C</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade8D' ? 'active' : '' }}" href="{{ url('kelas/grade8D') }}"><i class="fa fa-circle-o nav-icon"></i> 8 D</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade8E' ? 'active' : '' }}" href="{{ url('kelas/grade8E') }}"><i class="fa fa-circle-o nav-icon"></i> 8 E</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade8F' ? 'active' : '' }}" href="{{ url('kelas/grade8F') }}"><i class="fa fa-circle-o nav-icon"></i> 8 F</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade8G' ? 'active' : '' }}" href="{{ url('kelas/grade8G') }}"><i class="fa fa-circle-o nav-icon"></i> 8 G</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade8H' ? 'active' : '' }}" href="{{ url('kelas/grade8H') }}"><i class="fa fa-circle-o nav-icon"></i> 8 H</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade8I' ? 'active' : '' }}" href="{{ url('kelas/grade8I') }}"><i class="fa fa-circle-o nav-icon"></i> 8 I</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link"><i class="nav-icon fa fa-battery-4"></i><p>Kelas IX<i class="right fa fa-angle-left"></i></p></a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade9A' ? 'active' : '' }}" href="{{ url('kelas/grade9A') }}"><i class="fa fa-circle-o nav-icon"></i> 9 A</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade9B' ? 'active' : '' }}" href="{{ url('kelas/grade9B') }}"><i class="fa fa-circle-o nav-icon"></i> 9 B</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade9C' ? 'active' : '' }}" href="{{ url('kelas/grade9C') }}"><i class="fa fa-circle-o nav-icon"></i> 9 C</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade9D' ? 'active' : '' }}" href="{{ url('kelas/grade9D') }}"><i class="fa fa-circle-o nav-icon"></i> 9 D</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade9E' ? 'active' : '' }}" href="{{ url('kelas/grade9E') }}"><i class="fa fa-circle-o nav-icon"></i> 9 E</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade9F' ? 'active' : '' }}" href="{{ url('kelas/grade9F') }}"><i class="fa fa-circle-o nav-icon"></i> 9 F</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade9G' ? 'active' : '' }}" href="{{ url('kelas/grade9G') }}"><i class="fa fa-circle-o nav-icon"></i> 9 G</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade9H' ? 'active' : '' }}" href="{{ url('kelas/grade9H') }}"><i class="fa fa-circle-o nav-icon"></i> 9 H</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade9I' ? 'active' : '' }}" href="{{ url('kelas/grade9I') }}"><i class="fa fa-circle-o nav-icon"></i> 9 I</a></li>
                    </ul>
                </li>
            @else
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link"><i class="nav-icon fa fa-battery-1"></i><p>Kelas X<i class="right fa fa-angle-left"></i></p></a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade10A' ? 'active' : '' }}" href="{{ url('kelas/grade10A') }}"><i class="fa fa-circle-o nav-icon"></i> 10 A</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade10B' ? 'active' : '' }}" href="{{ url('kelas/grade10B') }}"><i class="fa fa-circle-o nav-icon"></i> 10 B</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade10C' ? 'active' : '' }}" href="{{ url('kelas/grade10C') }}"><i class="fa fa-circle-o nav-icon"></i> 10 C</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade10D' ? 'active' : '' }}" href="{{ url('kelas/grade10D') }}"><i class="fa fa-circle-o nav-icon"></i> 10 D</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade10E' ? 'active' : '' }}" href="{{ url('kelas/grade10E') }}"><i class="fa fa-circle-o nav-icon"></i> 10 E</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade10F' ? 'active' : '' }}" href="{{ url('kelas/grade10F') }}"><i class="fa fa-circle-o nav-icon"></i> 10 F</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade10G' ? 'active' : '' }}" href="{{ url('kelas/grade10G') }}"><i class="fa fa-circle-o nav-icon"></i> 10 G</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade10H' ? 'active' : '' }}" href="{{ url('kelas/grade10H') }}"><i class="fa fa-circle-o nav-icon"></i> 10 H</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade10I' ? 'active' : '' }}" href="{{ url('kelas/grade10I') }}"><i class="fa fa-circle-o nav-icon"></i> 10 I</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link"><i class="nav-icon fa fa-battery-2"></i><p>Kelas XI<i class="right fa fa-angle-left"></i></p></a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade11A' ? 'active' : '' }}" href="{{ url('kelas/grade11A') }}"><i class="fa fa-circle-o nav-icon"></i> 11 A</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade11B' ? 'active' : '' }}" href="{{ url('kelas/grade11B') }}"><i class="fa fa-circle-o nav-icon"></i> 11 B</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade11C' ? 'active' : '' }}" href="{{ url('kelas/grade11C') }}"><i class="fa fa-circle-o nav-icon"></i> 11 C</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade11D' ? 'active' : '' }}" href="{{ url('kelas/grade11D') }}"><i class="fa fa-circle-o nav-icon"></i> 11 D</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade11F' ? 'active' : '' }}" href="{{ url('kelas/grade11F') }}"><i class="fa fa-circle-o nav-icon"></i> 11 F</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade11G' ? 'active' : '' }}" href="{{ url('kelas/grade11G') }}"><i class="fa fa-circle-o nav-icon"></i> 11 G</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade11H' ? 'active' : '' }}" href="{{ url('kelas/grade11H') }}"><i class="fa fa-circle-o nav-icon"></i> 11 H</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade11I' ? 'active' : '' }}" href="{{ url('kelas/grade11I') }}"><i class="fa fa-circle-o nav-icon"></i> 11 I</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link"><i class="nav-icon fa fa-battery-4"></i><p>Kelas XII<i class="right fa fa-angle-left"></i></p></a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade12A' ? 'active' : '' }}" href="{{ url('kelas/grade12A') }}"><i class="fa fa-circle-o nav-icon"></i> 12 A</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade12B' ? 'active' : '' }}" href="{{ url('kelas/grade12B') }}"><i class="fa fa-circle-o nav-icon"></i> 12 B</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade12C' ? 'active' : '' }}" href="{{ url('kelas/grade12C') }}"><i class="fa fa-circle-o nav-icon"></i> 12 C</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade12D' ? 'active' : '' }}" href="{{ url('kelas/grade12D') }}"><i class="fa fa-circle-o nav-icon"></i> 12 D</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade12E' ? 'active' : '' }}" href="{{ url('kelas/grade12E') }}"><i class="fa fa-circle-o nav-icon"></i> 12 E</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade12F' ? 'active' : '' }}" href="{{ url('kelas/grade12F') }}"><i class="fa fa-circle-o nav-icon"></i> 12 F</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade12G' ? 'active' : '' }}" href="{{ url('kelas/grade12G') }}"><i class="fa fa-circle-o nav-icon"></i> 12 G</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade12H' ? 'active' : '' }}" href="{{ url('kelas/grade12H') }}"><i class="fa fa-circle-o nav-icon"></i> 12 H</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade12I' ? 'active' : '' }}" href="{{ url('kelas/grade12I') }}"><i class="fa fa-circle-o nav-icon"></i> 12 I</a></li>
                    </ul>
                </li>
            @endif
        </ul>
    </li>
@elseif(Session('previlage') == 'level2')
    <li class="nav-item">
        <a class="nav-link {{ isset($sidebar) && $sidebar == 'dashbord' ? 'active' : '' }}" href="/" role="button"><i class="nav-icon fa fa-tachometer"></i><p>Dashboard</p></a>
    </li>
    <li class="nav-item dropdown">
        <a href="#" class="nav-link"><i class="nav-icon fa fa-child"></i><p>Kesiswaan<i class="right fa fa-angle-left"></i></p></a>
        <ul class="nav nav-treeview">
            <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'rencanakegiatan' ? 'active' : '' }}" href="{{ url('rencanakegiatan') }}"><i class="fa fa-circle-o nav-icon"></i> Rencana Kegiatan Tahunan</a></li>
            <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'pengumuman' ? 'active' : '' }}" href="{{ url('pengumuman') }}"><i class="fa fa-circle-o nav-icon"></i> Pengumuman</a></li>
            @if(Session('sekolah_level') != 1)
            <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'beasiswa' ? 'active' : '' }}" href="{{ url('beasiswa') }}"><i class="fa fa-circle-o nav-icon"></i> Laporan Beasiswa</a></li>
            <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'lapekskul' ? 'active' : '' }}" href="{{ url('lapekskul') }}"><i class="fa fa-circle-o nav-icon"></i> Laporan Ekstrakulikuler</a></li>
            <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'penilaianekskul' ? 'active' : '' }}" href="{{ url('penilaianekskul') }}"><i class="fa fa-circle-o nav-icon"></i>  Penilaian Ekstrakulikuler</a></li>
            @endif
            <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'prestasisiswa' ? 'active' : '' }}" href="{{ url('prestasisiswa') }}"><i class="fa fa-circle-o nav-icon"></i>  Pencatatan Prestasi Siswa</a></li>
            <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'konseling' ? 'active' : '' }}" href="{{ url('konseling') }}"><i class="fa fa-circle-o nav-icon"></i> Data Bimbingan dan Konseling</a></li>
        </ul>
    </li>
    <li class="nav-item dropdown">
        <a href="#" class="nav-link"><i class="nav-icon fa fa-graduation-cap"></i><p>Ruang Guru<i class="right fa fa-angle-left"></i></p></a>
        <ul class="nav nav-treeview">
            <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'rencanapembelajaran' ? 'active' : '' }}" href="{{ url('setrps') }}"><i class="fa fa-circle-o nav-icon"></i> Kurikulum</a></li>
            <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'banksoal' ? 'active' : '' }}" href="{{ url('banksoal') }}"><i class="fa fa-circle-o nav-icon"></i> Bank Soal</a></li>
            @if(Session('sekolah_level') == 1)
                <!--
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link"><i class="nav-icon fa fa-soccer-ball-o"></i><p>Kelompok Belajar<i class="right fa fa-angle-left"></i></p></a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'gradekba' ? 'active' : '' }}" href="{{ url('tahap/gradekba') }}"><i class="fa fa-circle-o nav-icon"></i> KB A</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'gradekba' ? 'active' : '' }}" href="{{ url('tahap/gradekba') }}"><i class="fa fa-circle-o nav-icon"></i> KB B</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'gradekbc' ? 'active' : '' }}" href="{{ url('tahap/gradekbc') }}"><i class="fa fa-circle-o nav-icon"></i> KB C</a></li>
                    </ul>
                </li>
                -->
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link"><i class="nav-icon fa fa-star-half-o"></i><p>Tahap 1<i class="right fa fa-angle-left"></i></p></a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == '1A' ? 'active' : '' }}" href="{{ url('tahap/1A') }}"><i class="fa fa-circle-o nav-icon"></i> Tahap 1.A</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == '1B' ? 'active' : '' }}" href="{{ url('tahap/1B') }}"><i class="fa fa-circle-o nav-icon"></i> Tahap 1.B</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == '1C' ? 'active' : '' }}" href="{{ url('tahap/1C') }}"><i class="fa fa-circle-o nav-icon"></i> Tahap 1.C</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link"><i class="nav-icon fa fa-star"></i><p>Tahap 2<i class="right fa fa-angle-left"></i></p></a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == '2A' ? 'active' : '' }}" href="{{ url('tahap/2A') }}"><i class="fa fa-circle-o nav-icon"></i> Tahap 2.A</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == '2B' ? 'active' : '' }}" href="{{ url('tahap/2B') }}"><i class="fa fa-circle-o nav-icon"></i> Tahap 2.B</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == '2C' ? 'active' : '' }}" href="{{ url('tahap/2C') }}"><i class="fa fa-circle-o nav-icon"></i> Tahap 2.C</a></li>
                    </ul>
                </li>
            @elseif (Session('sekolah_level') == 2)
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link"><i class="nav-icon fa fa-battery-0"></i><p>Kelas I<i class="right fa fa-angle-left"></i></p></a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade1A' ? 'active' : '' }}" href="{{ url('kelas/grade1A') }}"><i class="fa fa-circle-o nav-icon"></i> 1 A</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade1B' ? 'active' : '' }}" href="{{ url('kelas/grade1B') }}"><i class="fa fa-circle-o nav-icon"></i> 1 B</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade1C' ? 'active' : '' }}" href="{{ url('kelas/grade1C') }}"><i class="fa fa-circle-o nav-icon"></i> 1 C</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link"><i class="nav-icon fa fa-battery-1"></i><p>Kelas II<i class="right fa fa-angle-left"></i></p></a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade2A' ? 'active' : '' }}" href="{{ url('kelas/grade2A') }}"><i class="fa fa-circle-o nav-icon"></i> 2 A</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade2B' ? 'active' : '' }}" href="{{ url('kelas/grade2B') }}"><i class="fa fa-circle-o nav-icon"></i> 2 B</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade2C' ? 'active' : '' }}" href="{{ url('kelas/grade2C') }}"><i class="fa fa-circle-o nav-icon"></i> 2 C</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a  href="#" class="nav-link"><i class="nav-icon fa fa-battery-2"></i><p>Kelas III<i class="right fa fa-angle-left"></i></p></a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade3A' ? 'active' : '' }}" href="{{ url('kelas/grade3A') }}"><i class="fa fa-circle-o nav-icon"></i> 3 A</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade3B' ? 'active' : '' }}" href="{{ url('kelas/grade3B') }}"><i class="fa fa-circle-o nav-icon"></i> 3 B</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade3C' ? 'active' : '' }}" href="{{ url('kelas/grade3C') }}"><i class="fa fa-circle-o nav-icon"></i> 3 C</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link"><i class="nav-icon fa fa-battery-3"></i><p>Kelas IV<i class="right fa fa-angle-left"></i></p></a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade4A' ? 'active' : '' }}" href="{{ url('kelas/grade4A') }}"><i class="fa fa-circle-o nav-icon"></i> 4 A</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade4B' ? 'active' : '' }}" href="{{ url('kelas/grade4B') }}"><i class="fa fa-circle-o nav-icon"></i> 4 B</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade4C' ? 'active' : '' }}" href="{{ url('kelas/grade4C') }}"><i class="fa fa-circle-o nav-icon"></i> 4 C</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link"><i class="nav-icon fa fa-battery-4"></i><p>Kelas V<i class="right fa fa-angle-left"></i></p></a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade5A' ? 'active' : '' }}" href="{{ url('kelas/grade5A') }}"><i class="fa fa-circle-o nav-icon"></i> 5 A</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade5B' ? 'active' : '' }}" href="{{ url('kelas/grade5B') }}"><i class="fa fa-circle-o nav-icon"></i> 5 B</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade5C' ? 'active' : '' }}" href="{{ url('kelas/grade5C') }}"><i class="fa fa-circle-o nav-icon"></i> 5 C</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link"><i class="nav-icon fa fa-battery-full"></i><p>Kelas VI<i class="right fa fa-angle-left"></i></p></a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade6A' ? 'active' : '' }}" href="{{ url('kelas/grade6A') }}"><i class="fa fa-circle-o nav-icon"></i> 6 A</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade6B' ? 'active' : '' }}" href="{{ url('kelas/grade6B') }}"><i class="fa fa-circle-o nav-icon"></i> 6 B</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade6C' ? 'active' : '' }}" href="{{ url('kelas/grade6C') }}"><i class="fa fa-circle-o nav-icon"></i> 6 C</a></li>
                    </ul>
                </li>
            @elseif (Session('sekolah_level') == 3)
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link"><i class="nav-icon fa fa-battery-1"></i><p>Kelas VII<i class="right fa fa-angle-left"></i></p></a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade7A' ? 'active' : '' }}" href="{{ url('kelas/grade7A') }}"><i class="fa fa-circle-o nav-icon"></i> 7 A</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade7B' ? 'active' : '' }}" href="{{ url('kelas/grade7B') }}"><i class="fa fa-circle-o nav-icon"></i> 7 B</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade7C' ? 'active' : '' }}" href="{{ url('kelas/grade7C') }}"><i class="fa fa-circle-o nav-icon"></i> 7 C</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade7D' ? 'active' : '' }}" href="{{ url('kelas/grade7D') }}"><i class="fa fa-circle-o nav-icon"></i> 7 D</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade7E' ? 'active' : '' }}" href="{{ url('kelas/grade7E') }}"><i class="fa fa-circle-o nav-icon"></i> 7 E</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade7F' ? 'active' : '' }}" href="{{ url('kelas/grade7F') }}"><i class="fa fa-circle-o nav-icon"></i> 7 F</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade7G' ? 'active' : '' }}" href="{{ url('kelas/grade7G') }}"><i class="fa fa-circle-o nav-icon"></i> 7 G</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade7H' ? 'active' : '' }}" href="{{ url('kelas/grade7H') }}"><i class="fa fa-circle-o nav-icon"></i> 7 H</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade7I' ? 'active' : '' }}" href="{{ url('kelas/grade7I') }}"><i class="fa fa-circle-o nav-icon"></i> 7 I</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link"><i class="nav-icon fa fa-battery-2"></i><p>Kelas VIII<i class="right fa fa-angle-left"></i></p></a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade8A' ? 'active' : '' }}" href="{{ url('kelas/grade8A') }}"><i class="fa fa-circle-o nav-icon"></i> 8 A</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade8B' ? 'active' : '' }}" href="{{ url('kelas/grade8B') }}"><i class="fa fa-circle-o nav-icon"></i> 8 B</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade8C' ? 'active' : '' }}" href="{{ url('kelas/grade8C') }}"><i class="fa fa-circle-o nav-icon"></i> 8 C</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade8D' ? 'active' : '' }}" href="{{ url('kelas/grade8D') }}"><i class="fa fa-circle-o nav-icon"></i> 8 D</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade8E' ? 'active' : '' }}" href="{{ url('kelas/grade8E') }}"><i class="fa fa-circle-o nav-icon"></i> 8 E</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade8F' ? 'active' : '' }}" href="{{ url('kelas/grade8F') }}"><i class="fa fa-circle-o nav-icon"></i> 8 F</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade8G' ? 'active' : '' }}" href="{{ url('kelas/grade8G') }}"><i class="fa fa-circle-o nav-icon"></i> 8 G</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade8H' ? 'active' : '' }}" href="{{ url('kelas/grade8H') }}"><i class="fa fa-circle-o nav-icon"></i> 8 H</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade8I' ? 'active' : '' }}" href="{{ url('kelas/grade8I') }}"><i class="fa fa-circle-o nav-icon"></i> 8 I</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link"><i class="nav-icon fa fa-battery-4"></i><p>Kelas IX<i class="right fa fa-angle-left"></i></p></a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade9A' ? 'active' : '' }}" href="{{ url('kelas/grade9A') }}"><i class="fa fa-circle-o nav-icon"></i> 9 A</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade9B' ? 'active' : '' }}" href="{{ url('kelas/grade9B') }}"><i class="fa fa-circle-o nav-icon"></i> 9 B</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade9C' ? 'active' : '' }}" href="{{ url('kelas/grade9C') }}"><i class="fa fa-circle-o nav-icon"></i> 9 C</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade9D' ? 'active' : '' }}" href="{{ url('kelas/grade9D') }}"><i class="fa fa-circle-o nav-icon"></i> 9 D</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade9E' ? 'active' : '' }}" href="{{ url('kelas/grade9E') }}"><i class="fa fa-circle-o nav-icon"></i> 9 E</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade9F' ? 'active' : '' }}" href="{{ url('kelas/grade9F') }}"><i class="fa fa-circle-o nav-icon"></i> 9 F</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade9G' ? 'active' : '' }}" href="{{ url('kelas/grade9G') }}"><i class="fa fa-circle-o nav-icon"></i> 9 G</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade9H' ? 'active' : '' }}" href="{{ url('kelas/grade9H') }}"><i class="fa fa-circle-o nav-icon"></i> 9 H</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade9I' ? 'active' : '' }}" href="{{ url('kelas/grade9I') }}"><i class="fa fa-circle-o nav-icon"></i> 9 I</a></li>
                    </ul>
                </li>
            @else
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link"><i class="nav-icon fa fa-battery-1"></i><p>Kelas X<i class="right fa fa-angle-left"></i></p></a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade10A' ? 'active' : '' }}" href="{{ url('kelas/grade10A') }}"><i class="fa fa-circle-o nav-icon"></i> 10 A</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade10B' ? 'active' : '' }}" href="{{ url('kelas/grade10B') }}"><i class="fa fa-circle-o nav-icon"></i> 10 B</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade10C' ? 'active' : '' }}" href="{{ url('kelas/grade10C') }}"><i class="fa fa-circle-o nav-icon"></i> 10 C</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade10D' ? 'active' : '' }}" href="{{ url('kelas/grade10D') }}"><i class="fa fa-circle-o nav-icon"></i> 10 D</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade10E' ? 'active' : '' }}" href="{{ url('kelas/grade10E') }}"><i class="fa fa-circle-o nav-icon"></i> 10 E</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade10F' ? 'active' : '' }}" href="{{ url('kelas/grade10F') }}"><i class="fa fa-circle-o nav-icon"></i> 10 F</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade10G' ? 'active' : '' }}" href="{{ url('kelas/grade10G') }}"><i class="fa fa-circle-o nav-icon"></i> 10 G</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade10H' ? 'active' : '' }}" href="{{ url('kelas/grade10H') }}"><i class="fa fa-circle-o nav-icon"></i> 10 H</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade10I' ? 'active' : '' }}" href="{{ url('kelas/grade10I') }}"><i class="fa fa-circle-o nav-icon"></i> 10 I</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link"><i class="nav-icon fa fa-battery-2"></i><p>Kelas XI<i class="right fa fa-angle-left"></i></p></a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade11A' ? 'active' : '' }}" href="{{ url('kelas/grade11A') }}"><i class="fa fa-circle-o nav-icon"></i> 11 A</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade11B' ? 'active' : '' }}" href="{{ url('kelas/grade11B') }}"><i class="fa fa-circle-o nav-icon"></i> 11 B</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade11C' ? 'active' : '' }}" href="{{ url('kelas/grade11C') }}"><i class="fa fa-circle-o nav-icon"></i> 11 C</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade11D' ? 'active' : '' }}" href="{{ url('kelas/grade11D') }}"><i class="fa fa-circle-o nav-icon"></i> 11 D</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade11F' ? 'active' : '' }}" href="{{ url('kelas/grade11F') }}"><i class="fa fa-circle-o nav-icon"></i> 11 F</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade11G' ? 'active' : '' }}" href="{{ url('kelas/grade11G') }}"><i class="fa fa-circle-o nav-icon"></i> 11 G</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade11H' ? 'active' : '' }}" href="{{ url('kelas/grade11H') }}"><i class="fa fa-circle-o nav-icon"></i> 11 H</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade11I' ? 'active' : '' }}" href="{{ url('kelas/grade11I') }}"><i class="fa fa-circle-o nav-icon"></i> 11 I</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link"><i class="nav-icon fa fa-battery-4"></i><p>Kelas XII<i class="right fa fa-angle-left"></i></p></a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade12A' ? 'active' : '' }}" href="{{ url('kelas/grade12A') }}"><i class="fa fa-circle-o nav-icon"></i> 12 A</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade12B' ? 'active' : '' }}" href="{{ url('kelas/grade12B') }}"><i class="fa fa-circle-o nav-icon"></i> 12 B</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade12C' ? 'active' : '' }}" href="{{ url('kelas/grade12C') }}"><i class="fa fa-circle-o nav-icon"></i> 12 C</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade12D' ? 'active' : '' }}" href="{{ url('kelas/grade12D') }}"><i class="fa fa-circle-o nav-icon"></i> 12 D</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade12E' ? 'active' : '' }}" href="{{ url('kelas/grade12E') }}"><i class="fa fa-circle-o nav-icon"></i> 12 E</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade12F' ? 'active' : '' }}" href="{{ url('kelas/grade12F') }}"><i class="fa fa-circle-o nav-icon"></i> 12 F</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade12G' ? 'active' : '' }}" href="{{ url('kelas/grade12G') }}"><i class="fa fa-circle-o nav-icon"></i> 12 G</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade12H' ? 'active' : '' }}" href="{{ url('kelas/grade12H') }}"><i class="fa fa-circle-o nav-icon"></i> 12 H</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade12I' ? 'active' : '' }}" href="{{ url('kelas/grade12I') }}"><i class="fa fa-circle-o nav-icon"></i> 12 I</a></li>
                    </ul>
                </li>
            @endif
        </ul>
    </li>
@elseif(Session('previlage') == 'level3')
    <li class="nav-item">
        <a class="nav-link {{ isset($sidebar) && $sidebar == 'dashbord' ? 'active' : '' }}" href="/" role="button"><i class="nav-icon fa fa-tachometer"></i><p>Dashboard</p></a>
    </li>
    <li class="nav-item dropdown">
        <a href="#" class="nav-link"><i class="nav-icon fa fa-child"></i><p>Kesiswaan<i class="right fa fa-angle-left"></i></p></a>
        <ul class="nav nav-treeview">
            <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'rencanakegiatan' ? 'active' : '' }}" href="{{ url('rencanakegiatan') }}"><i class="fa fa-circle-o nav-icon"></i> Rencana Kegiatan Tahunan</a></li>
        </ul>
    </li>
    <li class="nav-item dropdown">
        <a href="#" class="nav-link"><i class="nav-icon fa fa-graduation-cap"></i><p>Ruang Guru<i class="right fa fa-angle-left"></i></p></a>
        <ul class="nav nav-treeview">
            <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'rencanapembelajaran' ? 'active' : '' }}" href="{{ url('setrps') }}"><i class="fa fa-circle-o nav-icon"></i> Kurikulum</a></li>
            <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'banksoal' ? 'active' : '' }}" href="{{ url('banksoal') }}"><i class="fa fa-circle-o nav-icon"></i> Bank Soal</a></li>
            @if(Session('sekolah_level') == 1)
                <!--
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link"><i class="nav-icon fa fa-soccer-ball-o"></i><p>Kelompok Belajar<i class="right fa fa-angle-left"></i></p></a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'gradekba' ? 'active' : '' }}" href="{{ url('tahap/gradekba') }}"><i class="fa fa-circle-o nav-icon"></i> KB A</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'gradekba' ? 'active' : '' }}" href="{{ url('tahap/gradekba') }}"><i class="fa fa-circle-o nav-icon"></i> KB B</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'gradekbc' ? 'active' : '' }}" href="{{ url('tahap/gradekbc') }}"><i class="fa fa-circle-o nav-icon"></i> KB C</a></li>
                    </ul>
                </li>
                -->
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link"><i class="nav-icon fa fa-star-half-o"></i><p>Tahap 1<i class="right fa fa-angle-left"></i></p></a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == '1A' ? 'active' : '' }}" href="{{ url('tahap/1A') }}"><i class="fa fa-circle-o nav-icon"></i> Tahap 1.A</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == '1B' ? 'active' : '' }}" href="{{ url('tahap/1B') }}"><i class="fa fa-circle-o nav-icon"></i> Tahap 1.B</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == '1C' ? 'active' : '' }}" href="{{ url('tahap/1C') }}"><i class="fa fa-circle-o nav-icon"></i> Tahap 1.C</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link"><i class="nav-icon fa fa-star"></i><p>Tahap 2<i class="right fa fa-angle-left"></i></p></a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == '2A' ? 'active' : '' }}" href="{{ url('tahap/2A') }}"><i class="fa fa-circle-o nav-icon"></i> Tahap 2.A</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == '2B' ? 'active' : '' }}" href="{{ url('tahap/2B') }}"><i class="fa fa-circle-o nav-icon"></i> Tahap 2.B</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == '2C' ? 'active' : '' }}" href="{{ url('tahap/2C') }}"><i class="fa fa-circle-o nav-icon"></i> Tahap 2.C</a></li>
                    </ul>
                </li>
            @elseif (Session('sekolah_level') == 2)
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link"><i class="nav-icon fa fa-battery-0"></i><p>Kelas I<i class="right fa fa-angle-left"></i></p></a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade1A' ? 'active' : '' }}" href="{{ url('kelas/grade1A') }}"><i class="fa fa-circle-o nav-icon"></i> 1 A</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade1B' ? 'active' : '' }}" href="{{ url('kelas/grade1B') }}"><i class="fa fa-circle-o nav-icon"></i> 1 B</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade1C' ? 'active' : '' }}" href="{{ url('kelas/grade1C') }}"><i class="fa fa-circle-o nav-icon"></i> 1 C</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link"><i class="nav-icon fa fa-battery-1"></i><p>Kelas II<i class="right fa fa-angle-left"></i></p></a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade2A' ? 'active' : '' }}" href="{{ url('kelas/grade2A') }}"><i class="fa fa-circle-o nav-icon"></i> 2 A</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade2B' ? 'active' : '' }}" href="{{ url('kelas/grade2B') }}"><i class="fa fa-circle-o nav-icon"></i> 2 B</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade2C' ? 'active' : '' }}" href="{{ url('kelas/grade2C') }}"><i class="fa fa-circle-o nav-icon"></i> 2 C</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a  href="#" class="nav-link"><i class="nav-icon fa fa-battery-2"></i><p>Kelas III<i class="right fa fa-angle-left"></i></p></a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade3A' ? 'active' : '' }}" href="{{ url('kelas/grade3A') }}"><i class="fa fa-circle-o nav-icon"></i> 3 A</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade3B' ? 'active' : '' }}" href="{{ url('kelas/grade3B') }}"><i class="fa fa-circle-o nav-icon"></i> 3 B</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade3C' ? 'active' : '' }}" href="{{ url('kelas/grade3C') }}"><i class="fa fa-circle-o nav-icon"></i> 3 C</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link"><i class="nav-icon fa fa-battery-3"></i><p>Kelas IV<i class="right fa fa-angle-left"></i></p></a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade4A' ? 'active' : '' }}" href="{{ url('kelas/grade4A') }}"><i class="fa fa-circle-o nav-icon"></i> 4 A</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade4B' ? 'active' : '' }}" href="{{ url('kelas/grade4B') }}"><i class="fa fa-circle-o nav-icon"></i> 4 B</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade4C' ? 'active' : '' }}" href="{{ url('kelas/grade4C') }}"><i class="fa fa-circle-o nav-icon"></i> 4 C</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link"><i class="nav-icon fa fa-battery-4"></i><p>Kelas V<i class="right fa fa-angle-left"></i></p></a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade5A' ? 'active' : '' }}" href="{{ url('kelas/grade5A') }}"><i class="fa fa-circle-o nav-icon"></i> 5 A</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade5B' ? 'active' : '' }}" href="{{ url('kelas/grade5B') }}"><i class="fa fa-circle-o nav-icon"></i> 5 B</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade5C' ? 'active' : '' }}" href="{{ url('kelas/grade5C') }}"><i class="fa fa-circle-o nav-icon"></i> 5 C</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link"><i class="nav-icon fa fa-battery-full"></i><p>Kelas VI<i class="right fa fa-angle-left"></i></p></a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade6A' ? 'active' : '' }}" href="{{ url('kelas/grade6A') }}"><i class="fa fa-circle-o nav-icon"></i> 6 A</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade6B' ? 'active' : '' }}" href="{{ url('kelas/grade6B') }}"><i class="fa fa-circle-o nav-icon"></i> 6 B</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade6C' ? 'active' : '' }}" href="{{ url('kelas/grade6C') }}"><i class="fa fa-circle-o nav-icon"></i> 6 C</a></li>
                    </ul>
                </li>
            @elseif (Session('sekolah_level') == 3)
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link"><i class="nav-icon fa fa-battery-1"></i><p>Kelas VII<i class="right fa fa-angle-left"></i></p></a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade7A' ? 'active' : '' }}" href="{{ url('kelas/grade7A') }}"><i class="fa fa-circle-o nav-icon"></i> 7 A</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade7B' ? 'active' : '' }}" href="{{ url('kelas/grade7B') }}"><i class="fa fa-circle-o nav-icon"></i> 7 B</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade7C' ? 'active' : '' }}" href="{{ url('kelas/grade7C') }}"><i class="fa fa-circle-o nav-icon"></i> 7 C</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade7D' ? 'active' : '' }}" href="{{ url('kelas/grade7D') }}"><i class="fa fa-circle-o nav-icon"></i> 7 D</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade7E' ? 'active' : '' }}" href="{{ url('kelas/grade7E') }}"><i class="fa fa-circle-o nav-icon"></i> 7 E</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade7F' ? 'active' : '' }}" href="{{ url('kelas/grade7F') }}"><i class="fa fa-circle-o nav-icon"></i> 7 F</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade7G' ? 'active' : '' }}" href="{{ url('kelas/grade7G') }}"><i class="fa fa-circle-o nav-icon"></i> 7 G</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade7H' ? 'active' : '' }}" href="{{ url('kelas/grade7H') }}"><i class="fa fa-circle-o nav-icon"></i> 7 H</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade7I' ? 'active' : '' }}" href="{{ url('kelas/grade7I') }}"><i class="fa fa-circle-o nav-icon"></i> 7 I</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link"><i class="nav-icon fa fa-battery-2"></i><p>Kelas VIII<i class="right fa fa-angle-left"></i></p></a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade8A' ? 'active' : '' }}" href="{{ url('kelas/grade8A') }}"><i class="fa fa-circle-o nav-icon"></i> 8 A</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade8B' ? 'active' : '' }}" href="{{ url('kelas/grade8B') }}"><i class="fa fa-circle-o nav-icon"></i> 8 B</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade8C' ? 'active' : '' }}" href="{{ url('kelas/grade8C') }}"><i class="fa fa-circle-o nav-icon"></i> 8 C</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade8D' ? 'active' : '' }}" href="{{ url('kelas/grade8D') }}"><i class="fa fa-circle-o nav-icon"></i> 8 D</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade8E' ? 'active' : '' }}" href="{{ url('kelas/grade8E') }}"><i class="fa fa-circle-o nav-icon"></i> 8 E</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade8F' ? 'active' : '' }}" href="{{ url('kelas/grade8F') }}"><i class="fa fa-circle-o nav-icon"></i> 8 F</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade8G' ? 'active' : '' }}" href="{{ url('kelas/grade8G') }}"><i class="fa fa-circle-o nav-icon"></i> 8 G</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade8H' ? 'active' : '' }}" href="{{ url('kelas/grade8H') }}"><i class="fa fa-circle-o nav-icon"></i> 8 H</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade8I' ? 'active' : '' }}" href="{{ url('kelas/grade8I') }}"><i class="fa fa-circle-o nav-icon"></i> 8 I</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link"><i class="nav-icon fa fa-battery-4"></i><p>Kelas IX<i class="right fa fa-angle-left"></i></p></a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade9A' ? 'active' : '' }}" href="{{ url('kelas/grade9A') }}"><i class="fa fa-circle-o nav-icon"></i> 9 A</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade9B' ? 'active' : '' }}" href="{{ url('kelas/grade9B') }}"><i class="fa fa-circle-o nav-icon"></i> 9 B</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade9C' ? 'active' : '' }}" href="{{ url('kelas/grade9C') }}"><i class="fa fa-circle-o nav-icon"></i> 9 C</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade9D' ? 'active' : '' }}" href="{{ url('kelas/grade9D') }}"><i class="fa fa-circle-o nav-icon"></i> 9 D</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade9E' ? 'active' : '' }}" href="{{ url('kelas/grade9E') }}"><i class="fa fa-circle-o nav-icon"></i> 9 E</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade9F' ? 'active' : '' }}" href="{{ url('kelas/grade9F') }}"><i class="fa fa-circle-o nav-icon"></i> 9 F</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade9G' ? 'active' : '' }}" href="{{ url('kelas/grade9G') }}"><i class="fa fa-circle-o nav-icon"></i> 9 G</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade9H' ? 'active' : '' }}" href="{{ url('kelas/grade9H') }}"><i class="fa fa-circle-o nav-icon"></i> 9 H</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade9I' ? 'active' : '' }}" href="{{ url('kelas/grade9I') }}"><i class="fa fa-circle-o nav-icon"></i> 9 I</a></li>
                    </ul>
                </li>
            @else
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link"><i class="nav-icon fa fa-battery-1"></i><p>Kelas X<i class="right fa fa-angle-left"></i></p></a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade10A' ? 'active' : '' }}" href="{{ url('kelas/grade10A') }}"><i class="fa fa-circle-o nav-icon"></i> 10 A</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade10B' ? 'active' : '' }}" href="{{ url('kelas/grade10B') }}"><i class="fa fa-circle-o nav-icon"></i> 10 B</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade10C' ? 'active' : '' }}" href="{{ url('kelas/grade10C') }}"><i class="fa fa-circle-o nav-icon"></i> 10 C</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade10D' ? 'active' : '' }}" href="{{ url('kelas/grade10D') }}"><i class="fa fa-circle-o nav-icon"></i> 10 D</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade10E' ? 'active' : '' }}" href="{{ url('kelas/grade10E') }}"><i class="fa fa-circle-o nav-icon"></i> 10 E</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade10F' ? 'active' : '' }}" href="{{ url('kelas/grade10F') }}"><i class="fa fa-circle-o nav-icon"></i> 10 F</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade10G' ? 'active' : '' }}" href="{{ url('kelas/grade10G') }}"><i class="fa fa-circle-o nav-icon"></i> 10 G</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade10H' ? 'active' : '' }}" href="{{ url('kelas/grade10H') }}"><i class="fa fa-circle-o nav-icon"></i> 10 H</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade10I' ? 'active' : '' }}" href="{{ url('kelas/grade10I') }}"><i class="fa fa-circle-o nav-icon"></i> 10 I</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link"><i class="nav-icon fa fa-battery-2"></i><p>Kelas XI<i class="right fa fa-angle-left"></i></p></a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade11A' ? 'active' : '' }}" href="{{ url('kelas/grade11A') }}"><i class="fa fa-circle-o nav-icon"></i> 11 A</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade11B' ? 'active' : '' }}" href="{{ url('kelas/grade11B') }}"><i class="fa fa-circle-o nav-icon"></i> 11 B</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade11C' ? 'active' : '' }}" href="{{ url('kelas/grade11C') }}"><i class="fa fa-circle-o nav-icon"></i> 11 C</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade11D' ? 'active' : '' }}" href="{{ url('kelas/grade11D') }}"><i class="fa fa-circle-o nav-icon"></i> 11 D</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade11F' ? 'active' : '' }}" href="{{ url('kelas/grade11F') }}"><i class="fa fa-circle-o nav-icon"></i> 11 F</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade11G' ? 'active' : '' }}" href="{{ url('kelas/grade11G') }}"><i class="fa fa-circle-o nav-icon"></i> 11 G</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade11H' ? 'active' : '' }}" href="{{ url('kelas/grade11H') }}"><i class="fa fa-circle-o nav-icon"></i> 11 H</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade11I' ? 'active' : '' }}" href="{{ url('kelas/grade11I') }}"><i class="fa fa-circle-o nav-icon"></i> 11 I</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link"><i class="nav-icon fa fa-battery-4"></i><p>Kelas XII<i class="right fa fa-angle-left"></i></p></a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade12A' ? 'active' : '' }}" href="{{ url('kelas/grade12A') }}"><i class="fa fa-circle-o nav-icon"></i> 12 A</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade12B' ? 'active' : '' }}" href="{{ url('kelas/grade12B') }}"><i class="fa fa-circle-o nav-icon"></i> 12 B</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade12C' ? 'active' : '' }}" href="{{ url('kelas/grade12C') }}"><i class="fa fa-circle-o nav-icon"></i> 12 C</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade12D' ? 'active' : '' }}" href="{{ url('kelas/grade12D') }}"><i class="fa fa-circle-o nav-icon"></i> 12 D</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade12E' ? 'active' : '' }}" href="{{ url('kelas/grade12E') }}"><i class="fa fa-circle-o nav-icon"></i> 12 E</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade12F' ? 'active' : '' }}" href="{{ url('kelas/grade12F') }}"><i class="fa fa-circle-o nav-icon"></i> 12 F</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade12G' ? 'active' : '' }}" href="{{ url('kelas/grade12G') }}"><i class="fa fa-circle-o nav-icon"></i> 12 G</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade12H' ? 'active' : '' }}" href="{{ url('kelas/grade12H') }}"><i class="fa fa-circle-o nav-icon"></i> 12 H</a></li>
                        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'grade12I' ? 'active' : '' }}" href="{{ url('kelas/grade12I') }}"><i class="fa fa-circle-o nav-icon"></i> 12 I</a></li>
                    </ul>
                </li>
            @endif
        </ul>
    </li>
@elseif(Session('previlage') == 'level4')
    <li class="nav-item">
        <a class="nav-link {{ isset($sidebar) && $sidebar == 'dashbord' ? 'active' : '' }}" href="/" role="button"><i class="nav-icon fa fa-tachometer"></i><p>Dashboard</p></a>
    </li>
    <li class="nav-item dropdown">
        <a href="#" class="nav-link"><i class="nav-icon fa fa-bars"></i><p>Main Menu<i class="right fa fa-angle-left"></i></p></a>
        <ul class="nav nav-treeview">
            <li class="nav-item dropdown">
                <a href="#" class="nav-link"><i class="nav-icon fa fa-child"></i><p>Kepegawaian<i class="right fa fa-angle-left"></i></p></a>
                <ul class="nav nav-treeview">
                    <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'dataindukstaff' ? 'active' : '' }}" href="{{ url('dataindukstaff') }}"><i class="fa fa-circle-o nav-icon"></i> Data Induk Karyawan</a></li>
                    <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'presensifinger' ? 'active' : '' }}" href="{{ url('presensifinger') }}"><i class="fa fa-circle-o nav-icon"></i> Presensi Finger</a></li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a href="#" class="nav-link"><i class="nav-icon fa fa-child"></i><p>Kesiswaan<i class="right fa fa-angle-left"></i></p></a>
                <ul class="nav nav-treeview">
                    <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'datainduk' ? 'active' : '' }}" href="{{ url('datainduk') }}"><i class="fa fa-circle-o nav-icon"></i> Data Induk Siswa</a></li>
                    <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'rekappresensi' ? 'active' : '' }}" href="{{ url('rekappresensi') }}"><i class="fa fa-circle-o nav-icon"></i> Rekap Presensi Siswa</a></li>
                    <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'lapppdb' ? 'active' : '' }}" href="{{ url('lapppdb') }}"><i class="fa fa-circle-o nav-icon"></i> Laporan PPDB</a></li>
                    @if(Session('sekolah_level') != 1)
                    <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'beasiswa' ? 'active' : '' }}" href="{{ url('beasiswa') }}"><i class="fa fa-circle-o nav-icon"></i> Laporan Beasiswa</a></li>
                    @endif
                    <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'prestasisiswa' ? 'active' : '' }}" href="{{ url('prestasisiswa') }}"><i class="fa fa-circle-o nav-icon"></i> Laporan Prestasi Siswa</a></li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a href="#" class="nav-link"><i class="nav-icon fa fa-wrench"></i><p>Umum<i class="right fa fa-angle-left"></i></p></a>
                <ul class="nav nav-treeview">
                    <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'persuratan' ? 'active' : '' }}" href="{{ url('persuratan') }}"><i class="fa fa-circle-o nav-icon"></i> Persuratan</a></li>
                    <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'sarpras' ? 'active' : '' }}" href="{{ url('sarpras') }}"><i class="fa fa-circle-o nav-icon"></i> Sarana dan Prasarana</a></li>
                </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ isset($sidebar) && $sidebar == 'prestasialquran' ? 'active' : '' }}" href="{{ url('prestasialquran') }}" role="button"> <i class="nav-icon fa fa-book"></i><p>Cetak Raport Al Quran</p></a>
            </li>
        </ul>
    </li>
    <li class="nav-item dropdown">
        <a href="#" class="nav-link"><i class="nav-icon fa fa-gear"></i><p>Setting<i class="right fa fa-angle-left"></i></p></a>
        <ul class="nav nav-treeview">
            <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'useranyar' ? 'active' : '' }}" href="{{ url('useranyar') }}"><i class="fa fa-circle-o nav-icon"></i>  Account Staf</a></li>
            <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'pengumuman' ? 'active' : '' }}" href="{{ url('pengumuman') }}"><i class="fa fa-circle-o nav-icon"></i>  Pengumuman</a></li>
            <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'setting' ? 'active' : '' }}" href="{{ url('setting') }}"><i class="fa fa-circle-o nav-icon"></i> Setting</a></li>
        </ul>
    </li>
@elseif(Session('previlage') == 'level5')
    <li class="nav-item">
        <a class="nav-link {{ isset($sidebar) && $sidebar == 'dashbord' ? 'active' : '' }}" href="/" role="button"><i class="nav-icon fa fa-tachometer"></i><p>Dashboard</p></a>
    </li>
    <li class="nav-item dropdown">
        <a href="#" class="nav-link"><i class="nav-icon fa fa-bars"></i><p>Main Menu<i class="right fa fa-angle-left"></i></p></a>
        <ul class="nav nav-treeview">
            <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'setkeuangan' ? 'active' : '' }}" href="{{ url('setkeuangan') }}"><i class="fa fa-circle-o nav-icon"></i> Setting Keuangan</a></li>
            <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'lapbayar' ? 'active' : '' }}" href="{{ url('lapbayar') }}"><i class="fa fa-circle-o nav-icon"></i> Laporan SPP dan Insidental</a></li>
            <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'datakeuhptmasuk' ? 'active' : '' }}" href="{{ url('datakeuhptmasuk') }}"><i class="fa fa-circle-o nav-icon"></i> Keuangan Sekolah</a></li>
            <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'laporankeuhpt' ? 'active' : '' }}" href="{{ url('laporankeuhpt') }}"><i class="fa fa-circle-o nav-icon"></i> Laporan Keuangan</a></li>
            <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'lapamil' ? 'active' : '' }}" href="{{ url('lapamil') }}"><i class="fa fa-circle-o nav-icon"></i> Laporan ZIS</a></li>
            <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'laptabungan' ? 'active' : '' }}" href="{{ url('laptabungan') }}"><i class="fa fa-circle-o nav-icon"></i> Laporan Tabungan</a></li>
        </ul>
    </li>
@elseif(Session('previlage') == 'Guru Ekstrakurikuler')
    <li class="nav-item">
        <a class="nav-link {{ isset($sidebar) && $sidebar == 'dashbord' ? 'active' : '' }}" href="/" role="button"><i class="nav-icon fa fa-tachometer"></i><p>Dashboard</p></a>
    </li>
    <li class="nav-item dropdown">
        <a href="#" class="nav-link"><i class="nav-icon fa fa-bars"></i><p>Main Menu<i class="right fa fa-angle-left"></i></p></a>
        <ul class="nav nav-treeview">
            <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'penilaianekskul' ? 'active' : '' }}" href="{{ url('penilaianekskul') }}"><i class="fa fa-circle-o nav-icon"></i>  Penilaian Ekstrakulikuler</a></li>
            <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'prestasisiswa' ? 'active' : '' }}" href="{{ url('prestasisiswa') }}"><i class="fa fa-circle-o nav-icon"></i> Laporan Prestasi Siswa</a></li>
        </ul>
    </li>
@elseif(Session('previlage') == 'Guru AlQuran')
    <li class="nav-item">
        <a class="nav-link {{ isset($sidebar) && $sidebar == 'dashbord' ? 'active' : '' }}" href="/" role="button"><i class="nav-icon fa fa-tachometer"></i><p>Dashboard</p></a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ isset($sidebar) && $sidebar == 'prestasialquran' ? 'active' : '' }}" href="{{ url('prestasialquran') }}" role="button"> <i class="nav-icon fa fa-book"></i><p>Al Quran</p></a>
    </li>
    @if(Session('sekolah_level') == 1)

    @elseif (Session('sekolah_level') == 2)
        <li class="nav-item dropdown">
            <a href="#" class="nav-link"><i class="nav-icon fa fa-battery-0"></i><p>Kelas I<i class="right fa fa-angle-left"></i></p></a>
            <ul class="nav nav-treeview">
                <li class="nav-item"><a class="nav-link {{ isset($setidkelas) && $setidkelas == '1A' ? 'active' : '' }}" href="{{ url('ujianlisan/grade1A') }}"><i class="fa fa-circle-o nav-icon"></i> 1 A</a></li>
                <li class="nav-item"><a class="nav-link {{ isset($setidkelas) && $setidkelas == '1B' ? 'active' : '' }}" href="{{ url('ujianlisan/grade1B') }}"><i class="fa fa-circle-o nav-icon"></i> 1 B</a></li>
                <li class="nav-item"><a class="nav-link {{ isset($setidkelas) && $setidkelas == '1C' ? 'active' : '' }}" href="{{ url('ujianlisan/grade1C') }}"><i class="fa fa-circle-o nav-icon"></i> 1 C</a></li>
            </ul>
        </li>
        <li class="nav-item dropdown">
            <a href="#" class="nav-link"><i class="nav-icon fa fa-battery-1"></i><p>Kelas II<i class="right fa fa-angle-left"></i></p></a>
            <ul class="nav nav-treeview">
                <li class="nav-item"><a class="nav-link {{ isset($setidkelas) && $setidkelas == '2A' ? 'active' : '' }}" href="{{ url('ujianlisan/grade2A') }}"><i class="fa fa-circle-o nav-icon"></i> 2 A</a></li>
                <li class="nav-item"><a class="nav-link {{ isset($setidkelas) && $setidkelas == '2B' ? 'active' : '' }}" href="{{ url('ujianlisan/grade2B') }}"><i class="fa fa-circle-o nav-icon"></i> 2 B</a></li>
                <li class="nav-item"><a class="nav-link {{ isset($setidkelas) && $setidkelas == '2C' ? 'active' : '' }}" href="{{ url('ujianlisan/grade2C') }}"><i class="fa fa-circle-o nav-icon"></i> 2 C</a></li>
            </ul>
        </li>
        <li class="nav-item dropdown">
            <a  href="#" class="nav-link"><i class="nav-icon fa fa-battery-2"></i><p>Kelas III<i class="right fa fa-angle-left"></i></p></a>
            <ul class="nav nav-treeview">
                <li class="nav-item"><a class="nav-link {{ isset($setidkelas) && $setidkelas == '3A' ? 'active' : '' }}" href="{{ url('ujianlisan/grade3A') }}"><i class="fa fa-circle-o nav-icon"></i> 3 A</a></li>
                <li class="nav-item"><a class="nav-link {{ isset($setidkelas) && $setidkelas == '3B' ? 'active' : '' }}" href="{{ url('ujianlisan/grade3B') }}"><i class="fa fa-circle-o nav-icon"></i> 3 B</a></li>
                <li class="nav-item"><a class="nav-link {{ isset($setidkelas) && $setidkelas == '3C' ? 'active' : '' }}" href="{{ url('ujianlisan/grade3C') }}"><i class="fa fa-circle-o nav-icon"></i> 3 C</a></li>
            </ul>
        </li>
        <li class="nav-item dropdown">
            <a href="#" class="nav-link"><i class="nav-icon fa fa-battery-3"></i><p>Kelas IV<i class="right fa fa-angle-left"></i></p></a>
            <ul class="nav nav-treeview">
                <li class="nav-item"><a class="nav-link {{ isset($setidkelas) && $setidkelas == '4A' ? 'active' : '' }}" href="{{ url('ujianlisan/grade4A') }}"><i class="fa fa-circle-o nav-icon"></i> 4 A</a></li>
                <li class="nav-item"><a class="nav-link {{ isset($setidkelas) && $setidkelas == '4B' ? 'active' : '' }}" href="{{ url('ujianlisan/grade4B') }}"><i class="fa fa-circle-o nav-icon"></i> 4 B</a></li>
                <li class="nav-item"><a class="nav-link {{ isset($setidkelas) && $setidkelas == '4C' ? 'active' : '' }}" href="{{ url('ujianlisan/grade4C') }}"><i class="fa fa-circle-o nav-icon"></i> 4 C</a></li>
            </ul>
        </li>
        <li class="nav-item dropdown">
            <a href="#" class="nav-link"><i class="nav-icon fa fa-battery-4"></i><p>Kelas V<i class="right fa fa-angle-left"></i></p></a>
            <ul class="nav nav-treeview">
                <li class="nav-item"><a class="nav-link {{ isset($setidkelas) && $setidkelas == '5A' ? 'active' : '' }}" href="{{ url('ujianlisan/grade5A') }}"><i class="fa fa-circle-o nav-icon"></i> 5 A</a></li>
                <li class="nav-item"><a class="nav-link {{ isset($setidkelas) && $setidkelas == '5B' ? 'active' : '' }}" href="{{ url('ujianlisan/grade5B') }}"><i class="fa fa-circle-o nav-icon"></i> 5 B</a></li>
                <li class="nav-item"><a class="nav-link {{ isset($setidkelas) && $setidkelas == '5C' ? 'active' : '' }}" href="{{ url('ujianlisan/grade5C') }}"><i class="fa fa-circle-o nav-icon"></i> 5 C</a></li>
            </ul>
        </li>
        <li class="nav-item dropdown">
            <a href="#" class="nav-link"><i class="nav-icon fa fa-battery-full"></i><p>Kelas VI<i class="right fa fa-angle-left"></i></p></a>
            <ul class="nav nav-treeview">
                <li class="nav-item"><a class="nav-link {{ isset($setidkelas) && $setidkelas == '6A' ? 'active' : '' }}" href="{{ url('ujianlisan/grade6A') }}"><i class="fa fa-circle-o nav-icon"></i> 6 A</a></li>
                <li class="nav-item"><a class="nav-link {{ isset($setidkelas) && $setidkelas == '6B' ? 'active' : '' }}" href="{{ url('ujianlisan/grade6B') }}"><i class="fa fa-circle-o nav-icon"></i> 6 B</a></li>
                <li class="nav-item"><a class="nav-link {{ isset($setidkelas) && $setidkelas == '6C' ? 'active' : '' }}" href="{{ url('ujianlisan/grade6C') }}"><i class="fa fa-circle-o nav-icon"></i> 6 C</a></li>
            </ul>
        </li>
    @elseif (Session('sekolah_level') == 3)
        <li class="nav-item dropdown">
            <a href="#" class="nav-link"><i class="nav-icon fa fa-battery-1"></i><p>Kelas VII<i class="right fa fa-angle-left"></i></p></a>
            <ul class="nav nav-treeview">
                <li class="nav-item"><a class="nav-link {{ isset($setidkelas) && $setidkelas == '7A' ? 'active' : '' }}" href="{{ url('ujianlisan/grade7A') }}"><i class="fa fa-circle-o nav-icon"></i> 7 A</a></li>
                <li class="nav-item"><a class="nav-link {{ isset($setidkelas) && $setidkelas == '7B' ? 'active' : '' }}" href="{{ url('ujianlisan/grade7B') }}"><i class="fa fa-circle-o nav-icon"></i> 7 B</a></li>
                <li class="nav-item"><a class="nav-link {{ isset($setidkelas) && $setidkelas == '7C' ? 'active' : '' }}" href="{{ url('ujianlisan/grade7C') }}"><i class="fa fa-circle-o nav-icon"></i> 7 C</a></li>
                <li class="nav-item"><a class="nav-link {{ isset($setidkelas) && $setidkelas == '7D' ? 'active' : '' }}" href="{{ url('ujianlisan/grade7D') }}"><i class="fa fa-circle-o nav-icon"></i> 7 D</a></li>
                <li class="nav-item"><a class="nav-link {{ isset($setidkelas) && $setidkelas == '7E' ? 'active' : '' }}" href="{{ url('ujianlisan/grade7E') }}"><i class="fa fa-circle-o nav-icon"></i> 7 E</a></li>
                <li class="nav-item"><a class="nav-link {{ isset($setidkelas) && $setidkelas == '7F' ? 'active' : '' }}" href="{{ url('ujianlisan/grade7F') }}"><i class="fa fa-circle-o nav-icon"></i> 7 F</a></li>
                <li class="nav-item"><a class="nav-link {{ isset($setidkelas) && $setidkelas == '7G' ? 'active' : '' }}" href="{{ url('ujianlisan/grade7G') }}"><i class="fa fa-circle-o nav-icon"></i> 7 G</a></li>
                <li class="nav-item"><a class="nav-link {{ isset($setidkelas) && $setidkelas == '7H' ? 'active' : '' }}" href="{{ url('ujianlisan/grade7H') }}"><i class="fa fa-circle-o nav-icon"></i> 7 H</a></li>
                <li class="nav-item"><a class="nav-link {{ isset($setidkelas) && $setidkelas == '7I' ? 'active' : '' }}" href="{{ url('ujianlisan/grade7I') }}"><i class="fa fa-circle-o nav-icon"></i> 7 I</a></li>
            </ul>
        </li>
        <li class="nav-item dropdown">
            <a href="#" class="nav-link"><i class="nav-icon fa fa-battery-2"></i><p>Kelas VIII<i class="right fa fa-angle-left"></i></p></a>
            <ul class="nav nav-treeview">
                <li class="nav-item"><a class="nav-link {{ isset($setidkelas) && $setidkelas == '8A' ? 'active' : '' }}" href="{{ url('ujianlisan/grade8A') }}"><i class="fa fa-circle-o nav-icon"></i> 8 A</a></li>
                <li class="nav-item"><a class="nav-link {{ isset($setidkelas) && $setidkelas == '8B' ? 'active' : '' }}" href="{{ url('ujianlisan/grade8B') }}"><i class="fa fa-circle-o nav-icon"></i> 8 B</a></li>
                <li class="nav-item"><a class="nav-link {{ isset($setidkelas) && $setidkelas == '8C' ? 'active' : '' }}" href="{{ url('ujianlisan/grade8C') }}"><i class="fa fa-circle-o nav-icon"></i> 8 C</a></li>
                <li class="nav-item"><a class="nav-link {{ isset($setidkelas) && $setidkelas == '8D' ? 'active' : '' }}" href="{{ url('ujianlisan/grade8D') }}"><i class="fa fa-circle-o nav-icon"></i> 8 D</a></li>
                <li class="nav-item"><a class="nav-link {{ isset($setidkelas) && $setidkelas == '8E' ? 'active' : '' }}" href="{{ url('ujianlisan/grade8E') }}"><i class="fa fa-circle-o nav-icon"></i> 8 E</a></li>
                <li class="nav-item"><a class="nav-link {{ isset($setidkelas) && $setidkelas == '8F' ? 'active' : '' }}" href="{{ url('ujianlisan/grade8F') }}"><i class="fa fa-circle-o nav-icon"></i> 8 F</a></li>
                <li class="nav-item"><a class="nav-link {{ isset($setidkelas) && $setidkelas == '8G' ? 'active' : '' }}" href="{{ url('ujianlisan/grade8G') }}"><i class="fa fa-circle-o nav-icon"></i> 8 G</a></li>
                <li class="nav-item"><a class="nav-link {{ isset($setidkelas) && $setidkelas == '8H' ? 'active' : '' }}" href="{{ url('ujianlisan/grade8H') }}"><i class="fa fa-circle-o nav-icon"></i> 8 H</a></li>
                <li class="nav-item"><a class="nav-link {{ isset($setidkelas) && $setidkelas == '8I' ? 'active' : '' }}" href="{{ url('ujianlisan/grade8I') }}"><i class="fa fa-circle-o nav-icon"></i> 8 I</a></li>
            </ul>
        </li>
        <li class="nav-item dropdown">
            <a href="#" class="nav-link"><i class="nav-icon fa fa-battery-4"></i><p>Kelas IX<i class="right fa fa-angle-left"></i></p></a>
            <ul class="nav nav-treeview">
                <li class="nav-item"><a class="nav-link {{ isset($setidkelas) && $setidkelas == '9A' ? 'active' : '' }}" href="{{ url('ujianlisan/grade9A') }}"><i class="fa fa-circle-o nav-icon"></i> 9 A</a></li>
                <li class="nav-item"><a class="nav-link {{ isset($setidkelas) && $setidkelas == '9B' ? 'active' : '' }}" href="{{ url('ujianlisan/grade9B') }}"><i class="fa fa-circle-o nav-icon"></i> 9 B</a></li>
                <li class="nav-item"><a class="nav-link {{ isset($setidkelas) && $setidkelas == '9C' ? 'active' : '' }}" href="{{ url('ujianlisan/grade9C') }}"><i class="fa fa-circle-o nav-icon"></i> 9 C</a></li>
                <li class="nav-item"><a class="nav-link {{ isset($setidkelas) && $setidkelas == '9D' ? 'active' : '' }}" href="{{ url('ujianlisan/grade9D') }}"><i class="fa fa-circle-o nav-icon"></i> 9 D</a></li>
                <li class="nav-item"><a class="nav-link {{ isset($setidkelas) && $setidkelas == '9E' ? 'active' : '' }}" href="{{ url('ujianlisan/grade9E') }}"><i class="fa fa-circle-o nav-icon"></i> 9 E</a></li>
                <li class="nav-item"><a class="nav-link {{ isset($setidkelas) && $setidkelas == '9F' ? 'active' : '' }}" href="{{ url('ujianlisan/grade9F') }}"><i class="fa fa-circle-o nav-icon"></i> 9 F</a></li>
                <li class="nav-item"><a class="nav-link {{ isset($setidkelas) && $setidkelas == '9G' ? 'active' : '' }}" href="{{ url('ujianlisan/grade9G') }}"><i class="fa fa-circle-o nav-icon"></i> 9 G</a></li>
                <li class="nav-item"><a class="nav-link {{ isset($setidkelas) && $setidkelas == '9H' ? 'active' : '' }}" href="{{ url('ujianlisan/grade9H') }}"><i class="fa fa-circle-o nav-icon"></i> 9 H</a></li>
                <li class="nav-item"><a class="nav-link {{ isset($setidkelas) && $setidkelas == '9I' ? 'active' : '' }}" href="{{ url('ujianlisan/grade9I') }}"><i class="fa fa-circle-o nav-icon"></i> 9 I</a></li>
            </ul>
        </li>
    @else
        <li class="nav-item dropdown">
            <a href="#" class="nav-link"><i class="nav-icon fa fa-battery-1"></i><p>Kelas X<i class="right fa fa-angle-left"></i></p></a>
            <ul class="nav nav-treeview">
                <li class="nav-item"><a class="nav-link {{ isset($setidkelas) && $setidkelas == '10A' ? 'active' : '' }}" href="{{ url('ujianlisan/grade10A') }}"><i class="fa fa-circle-o nav-icon"></i> 10 A</a></li>
                <li class="nav-item"><a class="nav-link {{ isset($setidkelas) && $setidkelas == '10B' ? 'active' : '' }}" href="{{ url('ujianlisan/grade10B') }}"><i class="fa fa-circle-o nav-icon"></i> 10 B</a></li>
                <li class="nav-item"><a class="nav-link {{ isset($setidkelas) && $setidkelas == '10C' ? 'active' : '' }}" href="{{ url('ujianlisan/grade10C') }}"><i class="fa fa-circle-o nav-icon"></i> 10 C</a></li>
                <li class="nav-item"><a class="nav-link {{ isset($setidkelas) && $setidkelas == '10D' ? 'active' : '' }}" href="{{ url('ujianlisan/grade10D') }}"><i class="fa fa-circle-o nav-icon"></i> 10 D</a></li>
                <li class="nav-item"><a class="nav-link {{ isset($setidkelas) && $setidkelas == '10E' ? 'active' : '' }}" href="{{ url('ujianlisan/grade10E') }}"><i class="fa fa-circle-o nav-icon"></i> 10 E</a></li>
                <li class="nav-item"><a class="nav-link {{ isset($setidkelas) && $setidkelas == '10F' ? 'active' : '' }}" href="{{ url('ujianlisan/grade10F') }}"><i class="fa fa-circle-o nav-icon"></i> 10 F</a></li>
                <li class="nav-item"><a class="nav-link {{ isset($setidkelas) && $setidkelas == '10G' ? 'active' : '' }}" href="{{ url('ujianlisan/grade10G') }}"><i class="fa fa-circle-o nav-icon"></i> 10 G</a></li>
                <li class="nav-item"><a class="nav-link {{ isset($setidkelas) && $setidkelas == '10H' ? 'active' : '' }}" href="{{ url('ujianlisan/grade10H') }}"><i class="fa fa-circle-o nav-icon"></i> 10 H</a></li>
                <li class="nav-item"><a class="nav-link {{ isset($setidkelas) && $setidkelas == '10I' ? 'active' : '' }}" href="{{ url('ujianlisan/grade10I') }}"><i class="fa fa-circle-o nav-icon"></i> 10 I</a></li>
            </ul>
        </li>
        <li class="nav-item dropdown">
            <a href="#" class="nav-link"><i class="nav-icon fa fa-battery-2"></i><p>Kelas XI<i class="right fa fa-angle-left"></i></p></a>
            <ul class="nav nav-treeview">
                <li class="nav-item"><a class="nav-link {{ isset($setidkelas) && $setidkelas == '11A' ? 'active' : '' }}" href="{{ url('ujianlisan/grade11A') }}"><i class="fa fa-circle-o nav-icon"></i> 11 A</a></li>
                <li class="nav-item"><a class="nav-link {{ isset($setidkelas) && $setidkelas == '11B' ? 'active' : '' }}" href="{{ url('ujianlisan/grade11B') }}"><i class="fa fa-circle-o nav-icon"></i> 11 B</a></li>
                <li class="nav-item"><a class="nav-link {{ isset($setidkelas) && $setidkelas == '11C' ? 'active' : '' }}" href="{{ url('ujianlisan/grade11C') }}"><i class="fa fa-circle-o nav-icon"></i> 11 C</a></li>
                <li class="nav-item"><a class="nav-link {{ isset($setidkelas) && $setidkelas == '11D' ? 'active' : '' }}" href="{{ url('ujianlisan/grade11D') }}"><i class="fa fa-circle-o nav-icon"></i> 11 D</a></li>
                <li class="nav-item"><a class="nav-link {{ isset($setidkelas) && $setidkelas == '11F' ? 'active' : '' }}" href="{{ url('ujianlisan/grade11F') }}"><i class="fa fa-circle-o nav-icon"></i> 11 F</a></li>
                <li class="nav-item"><a class="nav-link {{ isset($setidkelas) && $setidkelas == '11G' ? 'active' : '' }}" href="{{ url('ujianlisan/grade11G') }}"><i class="fa fa-circle-o nav-icon"></i> 11 G</a></li>
                <li class="nav-item"><a class="nav-link {{ isset($setidkelas) && $setidkelas == '11H' ? 'active' : '' }}" href="{{ url('ujianlisan/grade11H') }}"><i class="fa fa-circle-o nav-icon"></i> 11 H</a></li>
                <li class="nav-item"><a class="nav-link {{ isset($setidkelas) && $setidkelas == '11I' ? 'active' : '' }}" href="{{ url('ujianlisan/grade11I') }}"><i class="fa fa-circle-o nav-icon"></i> 11 I</a></li>
            </ul>
        </li>
        <li class="nav-item dropdown">
            <a href="#" class="nav-link"><i class="nav-icon fa fa-battery-4"></i><p>Kelas XII<i class="right fa fa-angle-left"></i></p></a>
            <ul class="nav nav-treeview">
                <li class="nav-item"><a class="nav-link {{ isset($setidkelas) && $setidkelas == '12A' ? 'active' : '' }}" href="{{ url('ujianlisan/grade12A') }}"><i class="fa fa-circle-o nav-icon"></i> 12 A</a></li>
                <li class="nav-item"><a class="nav-link {{ isset($setidkelas) && $setidkelas == '12B' ? 'active' : '' }}" href="{{ url('ujianlisan/grade12B') }}"><i class="fa fa-circle-o nav-icon"></i> 12 B</a></li>
                <li class="nav-item"><a class="nav-link {{ isset($setidkelas) && $setidkelas == '12C' ? 'active' : '' }}" href="{{ url('ujianlisan/grade12C') }}"><i class="fa fa-circle-o nav-icon"></i> 12 C</a></li>
                <li class="nav-item"><a class="nav-link {{ isset($setidkelas) && $setidkelas == '12D' ? 'active' : '' }}" href="{{ url('ujianlisan/grade12D') }}"><i class="fa fa-circle-o nav-icon"></i> 12 D</a></li>
                <li class="nav-item"><a class="nav-link {{ isset($setidkelas) && $setidkelas == '12E' ? 'active' : '' }}" href="{{ url('ujianlisan/grade12E') }}"><i class="fa fa-circle-o nav-icon"></i> 12 E</a></li>
                <li class="nav-item"><a class="nav-link {{ isset($setidkelas) && $setidkelas == '12F' ? 'active' : '' }}" href="{{ url('ujianlisan/grade12F') }}"><i class="fa fa-circle-o nav-icon"></i> 12 F</a></li>
                <li class="nav-item"><a class="nav-link {{ isset($setidkelas) && $setidkelas == '12G' ? 'active' : '' }}" href="{{ url('ujianlisan/grade12G') }}"><i class="fa fa-circle-o nav-icon"></i> 12 G</a></li>
                <li class="nav-item"><a class="nav-link {{ isset($setidkelas) && $setidkelas == '12H' ? 'active' : '' }}" href="{{ url('ujianlisan/grade12H') }}"><i class="fa fa-circle-o nav-icon"></i> 12 H</a></li>
                <li class="nav-item"><a class="nav-link {{ isset($setidkelas) && $setidkelas == '12I' ? 'active' : '' }}" href="{{ url('ujianlisan/grade12I') }}"><i class="fa fa-circle-o nav-icon"></i> 12 I</a></li>
            </ul>
        </li>
    @endif
@elseif(Session('previlage') == 'ortu')
    <li class="nav-item">
        <a class="nav-link {{ isset($sidebar) && $sidebar == 'dashbord' ? 'active' : '' }}" href="/" role="button"><i class="nav-icon fa fa-tachometer"></i><p>Dashboard</p></a>
    </li>
    <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'biodata' ? 'active' : '' }}" href="{{ url('biodata') }}"><i class="fa fa-child nav-icon"></i> Data Siswa</a></li>
    <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'ijinortu' ? 'active' : '' }}" href="{{ url('ijinortu') }}"><i class="fa fa-calendar nav-icon"></i> Presensi Harian</a></li>
    @if(Session('sekolah_level') == 1)
        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'kms' ? 'active' : '' }}" href="{{ url('kms') }}"><i class="fa fa-child nav-icon"></i> Menuju Sehat</a></li>
    @else
        <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'lapnilaiortu' ? 'active' : '' }}" href="{{ url('lapnilaiortu') }}"><i class="fa fa-trophy nav-icon"></i> Laporan Nilai</a></li>
    @endif
    <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'jilid' ? 'active' : '' }}" href="{{ url('faqihkecil') }}"><i class="fa fa-book nav-icon"></i> Halaqoh AlQuran</a></li>
    <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'tagihanrutin' ? 'active' : '' }}" href="{{ url('tagihanrutin') }}"><i class="fa fa-money nav-icon"></i> Tagihan Sekolah</a></li>
    <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'tabungan' ? 'active' : '' }}" href="{{ url('tabungan') }}"><i class="fa fa-google-wallet nav-icon"></i> Tabungan Anak</a></li>
    <li class="nav-item dropdown">
        <a href="#" class="nav-link"><i class="nav-icon fa fa-bank"></i><p>Menu Sekolah<i class="right fa fa-angle-left"></i></p></a>
        <ul class="nav nav-treeview">
            <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'zis' ? 'active' : '' }}" href="{{ url('zis') }}"><i class="fa fa-circle-o nav-icon"></i> Pembayaran Zakat, Infaq dan Shodaqoh</a></li>
            @if(Session('sekolah_level') != 1)
            <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'daftarekskul' ? 'active' : '' }}" href="{{ url('daftarekskul') }}"><i class="fa fa-circle-o nav-icon"></i> Pendaftaran Ekskul</a></li>
            @endif
            <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'minimi' ? 'active' : '' }}" href="{{ url('minimi') }}"><i class="fa fa-circle-o nav-icon"></i> Mini Library</a></li>
        </ul>
    </li>
    @if(Session('spesial') == 'paguyuban')
        <li class="nav-item dropdown">
            <a href="#" class="nav-link"><i class="nav-icon fa fa-users"></i><p>Paguyuban Zone<i class="right fa fa-angle-left"></i></p></a>
            <ul class="nav nav-treeview">
                <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'dashboardpaguyuban' ? 'active' : '' }}" href="{{ url('dashboardpaguyuban') }}"><i class="fa fa-circle-o nav-icon"></i> Main Menu</a></li>
                <li class="nav-item"><a class="nav-link {{ isset($sidebar) && $sidebar == 'laporankeuhpt' ? 'active' : '' }}" href="{{ url('laporankeuhpt') }}"><i class="fa fa-circle-o nav-icon"></i> Keuangan Paguyuban</a></li>
            </ul>
        </li>
    @endif
@else
    @if (Session('sekolah_id_sekolah') !== null)
        <li class="nav-item">
            <a class="nav-link active" href="/frontpage?id={{ Session('sekolah_id_sekolah') }}" role="button"><i class="fa fa-dashboard"></i> {{Session('sekolah_nama_sekolah')}}</a>
        </li>
    @else
    <li class="nav-item">
        <a class="nav-link active" href="/" role="button"><i class="nav-icon fa fa-tachometer"></i><p>Dashboard</p></a>
    </li>
    @endif
@endif
@if (Session('previlage') == 'ortu')
    <li class="nav-item">
        <a class="nav-link {{ isset($sidebar) && $sidebar == 'wbs' ? 'active' : '' }}" href="{{ url('wbs') }}" role="button"><i class="nav-icon fa fa-file-text"></i><p>WBS</p></a>
    </li>
@endif
