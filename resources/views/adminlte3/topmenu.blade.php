
@if(Session('previlage') == 'level0' OR Session('previlage') == 'level1')
    <li class="nav-item">
        <a class="nav-link" href="/" role="button"> Dashboard</a>
    </li>
    <li class="nav-item dropdown">
        <a id="suratmenu" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Main Menu</a>
        <ul aria-labelledby="suratmenu" class="dropdown-menu border-0 shadow">
            <li class="dropdown-submenu dropdown-hover">
                <a id="group01" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Kepegawaian</a>
                <ul aria-labelledby="group01" class="dropdown-menu border-0 shadow">
                    <li><a class="dropdown-item" href="{{ url('dataindukstaff') }}">Data Induk Karyawan</a></li>
                    <li><a class="dropdown-item" href="{{ url('raportguru') }}">Raport Guru</a></li>
                    <li class="dropdown-submenu dropdown-hover">
                        <a id="groupruangguru" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Ruang Guru</a>
                        <ul aria-labelledby="groupruangguru" class="dropdown-menu border-0 shadow">
                            <li><a class="dropdown-item" href="{{ url('konseling') }}">Data Bimbingan dan Konseling</a></li>
                            <li><a class="dropdown-item" href="{{ url('setrps') }}">Kurikulum</a></li>
                            <li><a class="dropdown-item" href="{{ url('banksoal') }}">Bank Soal</a></li>
                            @if(Session('sekolah_level') == 1)
                                <li class="dropdown-submenu dropdown-hover">
                                    <a id="groupmenukelaskb" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Kelompok Belajar</a>
                                    <ul aria-labelledby="groupmenukelaskb" class="dropdown-menu border-0 shadow">
                                        <li><a class="dropdown-item" href="{{ url('kelas/gradekba') }}">KB A</a></li>
                                        <li><a class="dropdown-item" href="{{ url('kelas/gradekbb') }}">KB B</a></li>
                                        <li><a class="dropdown-item" href="{{ url('kelas/gradekbc') }}">KB C</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown-submenu dropdown-hover">
                                    <a id="groupmenukelastaa" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">TA/TK A</a>
                                    <ul aria-labelledby="groupmenukelastaa" class="dropdown-menu border-0 shadow">
                                        <li><a class="dropdown-item" href="{{ url('kelas/gradeTA-A.1') }}">TA A 1</a></li>
                                        <li><a class="dropdown-item" href="{{ url('kelas/gradeTA-A.2') }}">TA A 2</a></li>
                                        <li><a class="dropdown-item" href="{{ url('kelas/gradeTA-A.3') }}">TA A 3</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown-submenu dropdown-hover">
                                    <a id="groupmenukelastab" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">TA/TK B</a>
                                    <ul aria-labelledby="groupmenukelastab" class="dropdown-menu border-0 shadow">
                                        <li><a class="dropdown-item" href="{{ url('kelas/gradeTA-B.1') }}">TA B 1</a></li>
                                        <li><a class="dropdown-item" href="{{ url('kelas/gradeTA-B.2') }}">TA B 2</a></li>
                                        <li><a class="dropdown-item" href="{{ url('kelas/gradeTA-B.3') }}">TA B 3</a></li>
                                    </ul>
                                </li>
                            @elseif (Session('sekolah_level') == 2)
                                <li class="dropdown-submenu dropdown-hover">
                                    <a id="groupmenukelas1" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Kelas I</a>
                                    <ul aria-labelledby="groupmenukelas1" class="dropdown-menu border-0 shadow">
                                        <li><a class="dropdown-item" href="{{ url('kelas/grade1A') }}">1 A</a></li>
                                        <li><a class="dropdown-item" href="{{ url('kelas/grade1B') }}">1 B</a></li>
                                        <li><a class="dropdown-item" href="{{ url('kelas/grade1C') }}">1 C</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown-submenu dropdown-hover">
                                    <a id="groupmenukelas2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Kelas 2</a>
                                    <ul aria-labelledby="groupmenukelas2" class="dropdown-menu border-0 shadow">
                                        <li><a class="dropdown-item" href="{{ url('kelas/grade2A') }}">2 A</a></li>
                                        <li><a class="dropdown-item" href="{{ url('kelas/grade2B') }}">2 B</a></li>
                                        <li><a class="dropdown-item" href="{{ url('kelas/grade2C') }}">2 C</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown-submenu dropdown-hover">
                                    <a id="groupmenukelas3" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Kelas 3</a>
                                    <ul aria-labelledby="groupmenukelas3" class="dropdown-menu border-0 shadow">
                                        <li><a class="dropdown-item" href="{{ url('kelas/grade3A') }}">3 A</a></li>
                                        <li><a class="dropdown-item" href="{{ url('kelas/grade3B') }}">3 B</a></li>
                                        <li><a class="dropdown-item" href="{{ url('kelas/grade3C') }}">3 C</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown-submenu dropdown-hover">
                                    <a id="groupmenukelas4" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Kelas 4</a>
                                    <ul aria-labelledby="groupmenukelas4" class="dropdown-menu border-0 shadow">
                                        <li><a class="dropdown-item" href="{{ url('kelas/grade4A') }}">4 A</a></li>
                                        <li><a class="dropdown-item" href="{{ url('kelas/grade4B') }}">4 B</a></li>
                                        <li><a class="dropdown-item" href="{{ url('kelas/grade4C') }}">4 C</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown-submenu dropdown-hover">
                                    <a id="groupmenukelas5" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Kelas 5</a>
                                    <ul aria-labelledby="groupmenukelas5" class="dropdown-menu border-0 shadow">
                                        <li><a class="dropdown-item" href="{{ url('kelas/grade5A') }}">5 A</a></li>
                                        <li><a class="dropdown-item" href="{{ url('kelas/grade5B') }}">5 B</a></li>
                                        <li><a class="dropdown-item" href="{{ url('kelas/grade5C') }}">5 C</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown-submenu dropdown-hover">
                                    <a id="groupmenukelas6" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Kelas 6</a>
                                    <ul aria-labelledby="groupmenukelas6" class="dropdown-menu border-0 shadow">
                                        <li><a class="dropdown-item" href="{{ url('kelas/grade6A') }}">6 A</a></li>
                                        <li><a class="dropdown-item" href="{{ url('kelas/grade6B') }}">6 B</a></li>
                                        <li><a class="dropdown-item" href="{{ url('kelas/grade6C') }}">6 C</a></li>
                                    </ul>
                                </li>
                            @elseif (Session('sekolah_level') == 3)
                                <li class="dropdown-submenu dropdown-hover">
                                    <a id="groupmenukelas7" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Kelas VII</a>
                                    <ul aria-labelledby="groupmenukelas7" class="dropdown-menu border-0 shadow">
                                        <li><a class="dropdown-item" href="{{ url('kelas/grade7A') }}">7 A</a></li>
                                        <li><a class="dropdown-item" href="{{ url('kelas/grade7B') }}">7 B</a></li>
                                        <li><a class="dropdown-item" href="{{ url('kelas/grade7C') }}">7 C</a></li>
                                        <li><a class="dropdown-item" href="{{ url('kelas/grade7D') }}">7 D</a></li>
                                        <li><a class="dropdown-item" href="{{ url('kelas/grade7E') }}">7 E</a></li>
                                        <li><a class="dropdown-item" href="{{ url('kelas/grade7F') }}">7 F</a></li>
                                        <li><a class="dropdown-item" href="{{ url('kelas/grade7G') }}">7 G</a></li>
                                        <li><a class="dropdown-item" href="{{ url('kelas/grade7H') }}">7 H</a></li>
                                        <li><a class="dropdown-item" href="{{ url('kelas/grade7I') }}">7 I</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown-submenu dropdown-hover">
                                    <a id="groupmenukelas8" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Kelas VIII</a>
                                    <ul aria-labelledby="groupmenukelas8" class="dropdown-menu border-0 shadow">
                                        <li><a class="dropdown-item" href="{{ url('kelas/grade8A') }}">8 A</a></li>
                                        <li><a class="dropdown-item" href="{{ url('kelas/grade8B') }}">8 B</a></li>
                                        <li><a class="dropdown-item" href="{{ url('kelas/grade8C') }}">8 C</a></li>
                                        <li><a class="dropdown-item" href="{{ url('kelas/grade8D') }}">8 D</a></li>
                                        <li><a class="dropdown-item" href="{{ url('kelas/grade8E') }}">8 E</a></li>
                                        <li><a class="dropdown-item" href="{{ url('kelas/grade8F') }}">8 F</a></li>
                                        <li><a class="dropdown-item" href="{{ url('kelas/grade8G') }}">8 G</a></li>
                                        <li><a class="dropdown-item" href="{{ url('kelas/grade8H') }}">8 H</a></li>
                                        <li><a class="dropdown-item" href="{{ url('kelas/grade8I') }}">8 I</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown-submenu dropdown-hover">
                                    <a id="groupmenukelas9" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Kelas IX</a>
                                    <ul aria-labelledby="groupmenukelas9" class="dropdown-menu border-0 shadow">
                                        <li><a class="dropdown-item" href="{{ url('kelas/grade9A') }}">9 A</a></li>
                                        <li><a class="dropdown-item" href="{{ url('kelas/grade9B') }}">9 B</a></li>
                                        <li><a class="dropdown-item" href="{{ url('kelas/grade9C') }}">9 C</a></li>
                                        <li><a class="dropdown-item" href="{{ url('kelas/grade9D') }}">9 D</a></li>
                                        <li><a class="dropdown-item" href="{{ url('kelas/grade9E') }}">9 E</a></li>
                                        <li><a class="dropdown-item" href="{{ url('kelas/grade9F') }}">9 F</a></li>
                                        <li><a class="dropdown-item" href="{{ url('kelas/grade9G') }}">9 G</a></li>
                                        <li><a class="dropdown-item" href="{{ url('kelas/grade9H') }}">9 H</a></li>
                                        <li><a class="dropdown-item" href="{{ url('kelas/grade9I') }}">9 I</a></li>
                                    </ul>
                                </li>
                            @else
                                <li class="dropdown-submenu dropdown-hover">
                                    <a id="groupmenukelas10" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Kelas X</a>
                                    <ul aria-labelledby="groupmenukelas10" class="dropdown-menu border-0 shadow">
                                        <li><a class="dropdown-item" href="{{ url('kelas/grade10A') }}">10 A</a></li>
                                        <li><a class="dropdown-item" href="{{ url('kelas/grade10B') }}">10 B</a></li>
                                        <li><a class="dropdown-item" href="{{ url('kelas/grade10C') }}">10 C</a></li>
                                        <li><a class="dropdown-item" href="{{ url('kelas/grade10D') }}">10 D</a></li>
                                        <li><a class="dropdown-item" href="{{ url('kelas/grade10E') }}">10 E</a></li>
                                        <li><a class="dropdown-item" href="{{ url('kelas/grade10F') }}">10 F</a></li>
                                        <li><a class="dropdown-item" href="{{ url('kelas/grade10G') }}">10 G</a></li>
                                        <li><a class="dropdown-item" href="{{ url('kelas/grade10H') }}">10 H</a></li>
                                        <li><a class="dropdown-item" href="{{ url('kelas/grade10I') }}">10 I</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown-submenu dropdown-hover">
                                    <a id="groupmenukelas11" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Kelas XI</a>
                                    <ul aria-labelledby="groupmenukelas11" class="dropdown-menu border-0 shadow">
                                        <li><a class="dropdown-item" href="{{ url('kelas/grade11A') }}">11 A</a></li>
                                        <li><a class="dropdown-item" href="{{ url('kelas/grade11B') }}">11 B</a></li>
                                        <li><a class="dropdown-item" href="{{ url('kelas/grade11C') }}">11 C</a></li>
                                        <li><a class="dropdown-item" href="{{ url('kelas/grade11D') }}">11 D</a></li>
                                        <li><a class="dropdown-item" href="{{ url('kelas/grade11E') }}">11 E</a></li>
                                        <li><a class="dropdown-item" href="{{ url('kelas/grade11F') }}">11 F</a></li>
                                        <li><a class="dropdown-item" href="{{ url('kelas/grade11G') }}">11 G</a></li>
                                        <li><a class="dropdown-item" href="{{ url('kelas/grade11H') }}">11 H</a></li>
                                        <li><a class="dropdown-item" href="{{ url('kelas/grade11I') }}">11 I</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown-submenu dropdown-hover">
                                    <a id="groupmenukelas12" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Kelas XII</a>
                                    <ul aria-labelledby="groupmenukelas12" class="dropdown-menu border-0 shadow">
                                        <li><a class="dropdown-item" href="{{ url('kelas/grade12A') }}">12 A</a></li>
                                        <li><a class="dropdown-item" href="{{ url('kelas/grade12B') }}">12 B</a></li>
                                        <li><a class="dropdown-item" href="{{ url('kelas/grade12C') }}">12 C</a></li>
                                        <li><a class="dropdown-item" href="{{ url('kelas/grade12D') }}">12 D</a></li>
                                        <li><a class="dropdown-item" href="{{ url('kelas/grade12E') }}">12 E</a></li>
                                        <li><a class="dropdown-item" href="{{ url('kelas/grade12F') }}">12 F</a></li>
                                        <li><a class="dropdown-item" href="{{ url('kelas/grade12G') }}">12 G</a></li>
                                        <li><a class="dropdown-item" href="{{ url('kelas/grade12H') }}">12 H</a></li>
                                        <li><a class="dropdown-item" href="{{ url('kelas/grade12I') }}">12 I</a></li>
                                    </ul>
                                </li>
                            @endif
                            <li><a class="dropdown-item" href="{{ url('lognilai') }}"> Log Perubahan Nilai</a></li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li class="dropdown-submenu dropdown-hover">
                <a id="groupkesiswaan" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Kesiswaan</a>
                <ul aria-labelledby="groupkesiswaan" class="dropdown-menu border-0 shadow">
                    <li><a class="dropdown-item" href="{{ url('datainduk') }}">Data Induk Siswa</a></li>
                    <li><a class="dropdown-item" href="{{ url('lapppdb') }}">Laporan PPDB</a></li>
                    <li><a class="dropdown-item" href="{{ url('lapekskul') }}">Laporan Ekstrakulikuler</a></li>
                    <li><a class="dropdown-item" href="{{ url('penilaianekskul') }}"> Penilaian Ekstrakulikuler</a></li>
                    <li><a class="dropdown-item" href="{{ url('presensifinger') }}">Laporan Presensi</a></li>
                    <li><a class="dropdown-item" href="{{ url('prestasisiswa') }}">Laporan Prestasi Siswa</a></li>
                </ul>
            </li>
            <li class="dropdown-submenu dropdown-hover">
                <a id="groupkesiswaan" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">AlQuran</a>
                <ul aria-labelledby="groupkesiswaan" class="dropdown-menu border-0 shadow">
                    <li><a class="dropdown-item" href="{{ url('prestasialquran') }}">Laporan Prestasi Alquran</a></li>
                </ul>
            </li>
            <li class="dropdown-submenu dropdown-hover">
                <a id="groupkesiswaan" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Keuangan</a>
                <ul aria-labelledby="groupkesiswaan" class="dropdown-menu border-0 shadow">
                    <li><a class="dropdown-item" href="{{ url('setkeuangan') }}">Setting Keuangan</a></li>
                    <li><a class="dropdown-item" href="{{ url('lapbayar') }}">Laporan SPP dan Insidental</a></li>
                    <li><a class="dropdown-item" href="{{ url('datakeuhptmasuk') }}">Keuangan Sekolah</a></li>
                    <li><a class="dropdown-item" href="{{ url('laporankeuhpt') }}">Laporan Keuangan</a></li>
                    <li><a class="dropdown-item" href="{{ url('lapamil') }}">Laporan ZIS</a></li>
                    <li><a class="dropdown-item" href="{{ url('laptabungan') }}">Laporan Tabungan</a></li>
                </ul>
            </li>
            <li class="dropdown-submenu dropdown-hover">
                <a id="groupkesiswaan" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Sarana dan Prasarana</a>
                <ul aria-labelledby="groupkesiswaan" class="dropdown-menu border-0 shadow">
                    <li><a class="dropdown-item" href="{{ url('persuratan') }}">Persuratan</a></li>
                    <li><a class="dropdown-item" href="{{ url('sarpras') }}">Sarana dan Prasarana</a></li>
                    <li><a class="dropdown-item" href="{{ url('minimi') }}"> Perpustakaan</a></li>
                    <li><a class="dropdown-item" href="{{ url('datakeluhan') }}">Kritik dan Keluhan</a></li>
                </ul>
            </li>
        </ul>
    </li>
    <li class="nav-item dropdown">
        <a id="groupmenusetting" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Setting</a>
        <ul aria-labelledby="groupmenusetting" class="dropdown-menu border-0 shadow">
            <li><a class="dropdown-item" href="{{ url('useranyar') }}"> Pendaftaran Account</a></li>
            <li><a class="dropdown-item" href="{{ url('pengumuman') }}"> Pengumuman</a></li>
            <li><a class="dropdown-item" href="{{ url('setting') }}">Setting</a></li>
            @if (Session('username') == 'admin')
            <li><a class="dropdown-item" href="{{ url('sekolah') }}"><i class="fa fa-database text-green"></i> Master Sekolah</a></li>
            @endif
        </ul>
    </li>
@elseif(Session('previlage') == 'level2')
    <li class="nav-item">
        <a class="nav-link" href="/" role="button"> Dashboard</a>
    </li>
    <li class="nav-item dropdown">
        <a id="groupmenuguru" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Ruang Guru</a>
        <ul aria-labelledby="groupmenuguru" class="dropdown-menu border-0 shadow">
            <li><a class="dropdown-item" href="{{ url('pengumuman') }}">Pengumuman</a></li>
            <li><a class="dropdown-item" href="{{ url('konseling') }}">Data Bimbingan dan Konseling</a></li>
            <li><a class="dropdown-item" href="{{ url('setrps') }}">Kurikulum</a></li>
            <li><a class="dropdown-item" href="{{ url('banksoal') }}">Bank Soal</a></li>
            @if(Session('sekolah_level') == 1)
                <li class="dropdown-submenu dropdown-hover">
                    <a id="groupmenukelaskb" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Kelompok Belajar</a>
                    <ul aria-labelledby="groupmenukelaskb" class="dropdown-menu border-0 shadow">
                        <li><a class="dropdown-item" href="{{ url('kelas/gradekba') }}">KB A</a></li>
                        <li><a class="dropdown-item" href="{{ url('kelas/gradekbb') }}">KB B</a></li>
                        <li><a class="dropdown-item" href="{{ url('kelas/gradekbc') }}">KB C</a></li>
                    </ul>
                </li>
                <li class="dropdown-submenu dropdown-hover">
                    <a id="groupmenukelastaa" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">TA/TK A</a>
                    <ul aria-labelledby="groupmenukelastaa" class="dropdown-menu border-0 shadow">
                        <li><a class="dropdown-item" href="{{ url('kelas/gradeTA-A.1') }}">TA A 1</a></li>
                        <li><a class="dropdown-item" href="{{ url('kelas/gradeTA-A.2') }}">TA A 2</a></li>
                        <li><a class="dropdown-item" href="{{ url('kelas/gradeTA-A.3') }}">TA A 3</a></li>
                    </ul>
                </li>
                <li class="dropdown-submenu dropdown-hover">
                    <a id="groupmenukelastab" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">TA/TK B</a>
                    <ul aria-labelledby="groupmenukelastab" class="dropdown-menu border-0 shadow">
                        <li><a class="dropdown-item" href="{{ url('kelas/gradeTA-B.1') }}">TA B 1</a></li>
                        <li><a class="dropdown-item" href="{{ url('kelas/gradeTA-B.2') }}">TA B 2</a></li>
                        <li><a class="dropdown-item" href="{{ url('kelas/gradeTA-B.3') }}">TA B 3</a></li>
                    </ul>
                </li>
            @elseif (Session('sekolah_level') == 2)
                <li class="dropdown-submenu dropdown-hover">
                    <a id="groupmenukelas1" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Kelas I</a>
                    <ul aria-labelledby="groupmenukelas1" class="dropdown-menu border-0 shadow">
                        <li><a class="dropdown-item" href="{{ url('kelas/grade1A') }}">1 A</a></li>
                        <li><a class="dropdown-item" href="{{ url('kelas/grade1B') }}">1 B</a></li>
                        <li><a class="dropdown-item" href="{{ url('kelas/grade1C') }}">1 C</a></li>
                    </ul>
                </li>
                <li class="dropdown-submenu dropdown-hover">
                    <a id="groupmenukelas2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Kelas 2</a>
                    <ul aria-labelledby="groupmenukelas2" class="dropdown-menu border-0 shadow">
                        <li><a class="dropdown-item" href="{{ url('kelas/grade2A') }}">2 A</a></li>
                        <li><a class="dropdown-item" href="{{ url('kelas/grade2B') }}">2 B</a></li>
                        <li><a class="dropdown-item" href="{{ url('kelas/grade2C') }}">2 C</a></li>
                    </ul>
                </li>
                <li class="dropdown-submenu dropdown-hover">
                    <a id="groupmenukelas3" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Kelas 3</a>
                    <ul aria-labelledby="groupmenukelas3" class="dropdown-menu border-0 shadow">
                        <li><a class="dropdown-item" href="{{ url('kelas/grade3A') }}">3 A</a></li>
                        <li><a class="dropdown-item" href="{{ url('kelas/grade3B') }}">3 B</a></li>
                        <li><a class="dropdown-item" href="{{ url('kelas/grade3C') }}">3 C</a></li>
                    </ul>
                </li>
                <li class="dropdown-submenu dropdown-hover">
                    <a id="groupmenukelas4" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Kelas 4</a>
                    <ul aria-labelledby="groupmenukelas4" class="dropdown-menu border-0 shadow">
                        <li><a class="dropdown-item" href="{{ url('kelas/grade4A') }}">4 A</a></li>
                        <li><a class="dropdown-item" href="{{ url('kelas/grade4B') }}">4 B</a></li>
                        <li><a class="dropdown-item" href="{{ url('kelas/grade4C') }}">4 C</a></li>
                    </ul>
                </li>
                <li class="dropdown-submenu dropdown-hover">
                    <a id="groupmenukelas5" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Kelas 5</a>
                    <ul aria-labelledby="groupmenukelas5" class="dropdown-menu border-0 shadow">
                        <li><a class="dropdown-item" href="{{ url('kelas/grade5A') }}">5 A</a></li>
                        <li><a class="dropdown-item" href="{{ url('kelas/grade5B') }}">5 B</a></li>
                        <li><a class="dropdown-item" href="{{ url('kelas/grade5C') }}">5 C</a></li>
                    </ul>
                </li>
                <li class="dropdown-submenu dropdown-hover">
                    <a id="groupmenukelas6" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Kelas 6</a>
                    <ul aria-labelledby="groupmenukelas6" class="dropdown-menu border-0 shadow">
                        <li><a class="dropdown-item" href="{{ url('kelas/grade6A') }}">6 A</a></li>
                        <li><a class="dropdown-item" href="{{ url('kelas/grade6B') }}">6 B</a></li>
                        <li><a class="dropdown-item" href="{{ url('kelas/grade6C') }}">6 C</a></li>
                    </ul>
                </li>
            @elseif (Session('sekolah_level') == 3)
                <li class="dropdown-submenu dropdown-hover">
                    <a id="groupmenukelas7" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Kelas VII</a>
                    <ul aria-labelledby="groupmenukelas7" class="dropdown-menu border-0 shadow">
                        <li><a class="dropdown-item" href="{{ url('kelas/grade7A') }}">7 A</a></li>
                        <li><a class="dropdown-item" href="{{ url('kelas/grade7B') }}">7 B</a></li>
                        <li><a class="dropdown-item" href="{{ url('kelas/grade7C') }}">7 C</a></li>
                        <li><a class="dropdown-item" href="{{ url('kelas/grade7D') }}">7 D</a></li>
                        <li><a class="dropdown-item" href="{{ url('kelas/grade7E') }}">7 E</a></li>
                        <li><a class="dropdown-item" href="{{ url('kelas/grade7F') }}">7 F</a></li>
                        <li><a class="dropdown-item" href="{{ url('kelas/grade7G') }}">7 G</a></li>
                        <li><a class="dropdown-item" href="{{ url('kelas/grade7H') }}">7 H</a></li>
                        <li><a class="dropdown-item" href="{{ url('kelas/grade7I') }}">7 I</a></li>
                    </ul>
                </li>
                <li class="dropdown-submenu dropdown-hover">
                    <a id="groupmenukelas8" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Kelas VIII</a>
                    <ul aria-labelledby="groupmenukelas8" class="dropdown-menu border-0 shadow">
                        <li><a class="dropdown-item" href="{{ url('kelas/grade8A') }}">8 A</a></li>
                        <li><a class="dropdown-item" href="{{ url('kelas/grade8B') }}">8 B</a></li>
                        <li><a class="dropdown-item" href="{{ url('kelas/grade8C') }}">8 C</a></li>
                        <li><a class="dropdown-item" href="{{ url('kelas/grade8D') }}">8 D</a></li>
                        <li><a class="dropdown-item" href="{{ url('kelas/grade8E') }}">8 E</a></li>
                        <li><a class="dropdown-item" href="{{ url('kelas/grade8F') }}">8 F</a></li>
                        <li><a class="dropdown-item" href="{{ url('kelas/grade8G') }}">8 G</a></li>
                        <li><a class="dropdown-item" href="{{ url('kelas/grade8H') }}">8 H</a></li>
                        <li><a class="dropdown-item" href="{{ url('kelas/grade8I') }}">8 I</a></li>
                    </ul>
                </li>
                <li class="dropdown-submenu dropdown-hover">
                    <a id="groupmenukelas9" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Kelas IX</a>
                    <ul aria-labelledby="groupmenukelas9" class="dropdown-menu border-0 shadow">
                        <li><a class="dropdown-item" href="{{ url('kelas/grade9A') }}">9 A</a></li>
                        <li><a class="dropdown-item" href="{{ url('kelas/grade9B') }}">9 B</a></li>
                        <li><a class="dropdown-item" href="{{ url('kelas/grade9C') }}">9 C</a></li>
                        <li><a class="dropdown-item" href="{{ url('kelas/grade9D') }}">9 D</a></li>
                        <li><a class="dropdown-item" href="{{ url('kelas/grade9E') }}">9 E</a></li>
                        <li><a class="dropdown-item" href="{{ url('kelas/grade9F') }}">9 F</a></li>
                        <li><a class="dropdown-item" href="{{ url('kelas/grade9G') }}">9 G</a></li>
                        <li><a class="dropdown-item" href="{{ url('kelas/grade9H') }}">9 H</a></li>
                        <li><a class="dropdown-item" href="{{ url('kelas/grade9I') }}">9 I</a></li>
                    </ul>
                </li>
            @else
                <li class="dropdown-submenu dropdown-hover">
                    <a id="groupmenukelas10" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Kelas X</a>
                    <ul aria-labelledby="groupmenukelas10" class="dropdown-menu border-0 shadow">
                        <li><a class="dropdown-item" href="{{ url('kelas/grade10A') }}">10 A</a></li>
                        <li><a class="dropdown-item" href="{{ url('kelas/grade10B') }}">10 B</a></li>
                        <li><a class="dropdown-item" href="{{ url('kelas/grade10C') }}">10 C</a></li>
                        <li><a class="dropdown-item" href="{{ url('kelas/grade10D') }}">10 D</a></li>
                        <li><a class="dropdown-item" href="{{ url('kelas/grade10E') }}">10 E</a></li>
                        <li><a class="dropdown-item" href="{{ url('kelas/grade10F') }}">10 F</a></li>
                        <li><a class="dropdown-item" href="{{ url('kelas/grade10G') }}">10 G</a></li>
                        <li><a class="dropdown-item" href="{{ url('kelas/grade10H') }}">10 H</a></li>
                        <li><a class="dropdown-item" href="{{ url('kelas/grade10I') }}">10 I</a></li>
                    </ul>
                </li>
                <li class="dropdown-submenu dropdown-hover">
                    <a id="groupmenukelas11" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Kelas XI</a>
                    <ul aria-labelledby="groupmenukelas11" class="dropdown-menu border-0 shadow">
                        <li><a class="dropdown-item" href="{{ url('kelas/grade11A') }}">11 A</a></li>
                        <li><a class="dropdown-item" href="{{ url('kelas/grade11B') }}">11 B</a></li>
                        <li><a class="dropdown-item" href="{{ url('kelas/grade11C') }}">11 C</a></li>
                        <li><a class="dropdown-item" href="{{ url('kelas/grade11D') }}">11 D</a></li>
                        <li><a class="dropdown-item" href="{{ url('kelas/grade11E') }}">11 E</a></li>
                        <li><a class="dropdown-item" href="{{ url('kelas/grade11F') }}">11 F</a></li>
                        <li><a class="dropdown-item" href="{{ url('kelas/grade11G') }}">11 G</a></li>
                        <li><a class="dropdown-item" href="{{ url('kelas/grade11H') }}">11 H</a></li>
                        <li><a class="dropdown-item" href="{{ url('kelas/grade11I') }}">11 I</a></li>
                    </ul>
                </li>
                <li class="dropdown-submenu dropdown-hover">
                    <a id="groupmenukelas12" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Kelas XII</a>
                    <ul aria-labelledby="groupmenukelas12" class="dropdown-menu border-0 shadow">
                        <li><a class="dropdown-item" href="{{ url('kelas/grade12A') }}">12 A</a></li>
                        <li><a class="dropdown-item" href="{{ url('kelas/grade12B') }}">12 B</a></li>
                        <li><a class="dropdown-item" href="{{ url('kelas/grade12C') }}">12 C</a></li>
                        <li><a class="dropdown-item" href="{{ url('kelas/grade12D') }}">12 D</a></li>
                        <li><a class="dropdown-item" href="{{ url('kelas/grade12E') }}">12 E</a></li>
                        <li><a class="dropdown-item" href="{{ url('kelas/grade12F') }}">12 F</a></li>
                        <li><a class="dropdown-item" href="{{ url('kelas/grade12G') }}">12 G</a></li>
                        <li><a class="dropdown-item" href="{{ url('kelas/grade12H') }}">12 H</a></li>
                        <li><a class="dropdown-item" href="{{ url('kelas/grade12I') }}">12 I</a></li>
                    </ul>
                </li>
            @endif
            <li><a class="dropdown-item" href="{{ url('prestasisiswa') }}"> Pencatatan Prestasi Siswa</a></li>
            <li><a class="dropdown-item" href="{{ url('penilaianekskul') }}"> Penilaian Ekstrakulikuler</a></li>
        </ul>
    </li>
@elseif(Session('previlage') == 'level3')
    <li class="nav-item">
        <a class="nav-link" href="/" role="button"> Dashboard</a>
    </li>
    <li class="nav-item dropdown">
        <a id="groupmenuguru" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Ruang Guru</a>
        <ul aria-labelledby="groupmenuguru" class="dropdown-menu border-0 shadow">
            <li><a class="dropdown-item" href="{{ url('pengumuman') }}">Pengumuman</a></li>
            <li><a class="dropdown-item" href="{{ url('setrps') }}">Kurikulum</a></li>
            <li><a class="dropdown-item" href="{{ url('banksoal') }}">Bank Soal</a></li>
            @if(Session('sekolah_level') == 1)
                <li class="dropdown-submenu dropdown-hover">
                    <a id="groupmenukelaskb" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Kelompok Belajar</a>
                    <ul aria-labelledby="groupmenukelaskb" class="dropdown-menu border-0 shadow">
                        <li><a class="dropdown-item" href="{{ url('kelas/gradekba') }}">KB A</a></li>
                        <li><a class="dropdown-item" href="{{ url('kelas/gradekbb') }}">KB B</a></li>
                        <li><a class="dropdown-item" href="{{ url('kelas/gradekbc') }}">KB C</a></li>
                    </ul>
                </li>
                <li class="dropdown-submenu dropdown-hover">
                    <a id="groupmenukelastaa" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">TA/TK A</a>
                    <ul aria-labelledby="groupmenukelastaa" class="dropdown-menu border-0 shadow">
                        <li><a class="dropdown-item" href="{{ url('kelas/gradeTA-A.1') }}">TA A 1</a></li>
                        <li><a class="dropdown-item" href="{{ url('kelas/gradeTA-A.2') }}">TA A 2</a></li>
                        <li><a class="dropdown-item" href="{{ url('kelas/gradeTA-A.3') }}">TA A 3</a></li>
                    </ul>
                </li>
                <li class="dropdown-submenu dropdown-hover">
                    <a id="groupmenukelastab" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">TA/TK B</a>
                    <ul aria-labelledby="groupmenukelastab" class="dropdown-menu border-0 shadow">
                        <li><a class="dropdown-item" href="{{ url('kelas/gradeTA-B.1') }}">TA B 1</a></li>
                        <li><a class="dropdown-item" href="{{ url('kelas/gradeTA-B.2') }}">TA B 2</a></li>
                        <li><a class="dropdown-item" href="{{ url('kelas/gradeTA-B.3') }}">TA B 3</a></li>
                    </ul>
                </li>
            @elseif (Session('sekolah_level') == 2)
                <li class="dropdown-submenu dropdown-hover">
                    <a id="groupmenukelas1" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Kelas I</a>
                    <ul aria-labelledby="groupmenukelas1" class="dropdown-menu border-0 shadow">
                        <li><a class="dropdown-item" href="{{ url('kelas/grade1A') }}">1 A</a></li>
                        <li><a class="dropdown-item" href="{{ url('kelas/grade1B') }}">1 B</a></li>
                        <li><a class="dropdown-item" href="{{ url('kelas/grade1C') }}">1 C</a></li>
                    </ul>
                </li>
                <li class="dropdown-submenu dropdown-hover">
                    <a id="groupmenukelas2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Kelas 2</a>
                    <ul aria-labelledby="groupmenukelas2" class="dropdown-menu border-0 shadow">
                        <li><a class="dropdown-item" href="{{ url('kelas/grade2A') }}">2 A</a></li>
                        <li><a class="dropdown-item" href="{{ url('kelas/grade2B') }}">2 B</a></li>
                        <li><a class="dropdown-item" href="{{ url('kelas/grade2C') }}">2 C</a></li>
                    </ul>
                </li>
                <li class="dropdown-submenu dropdown-hover">
                    <a id="groupmenukelas3" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Kelas 3</a>
                    <ul aria-labelledby="groupmenukelas3" class="dropdown-menu border-0 shadow">
                        <li><a class="dropdown-item" href="{{ url('kelas/grade3A') }}">3 A</a></li>
                        <li><a class="dropdown-item" href="{{ url('kelas/grade3B') }}">3 B</a></li>
                        <li><a class="dropdown-item" href="{{ url('kelas/grade3C') }}">3 C</a></li>
                    </ul>
                </li>
                <li class="dropdown-submenu dropdown-hover">
                    <a id="groupmenukelas4" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Kelas 4</a>
                    <ul aria-labelledby="groupmenukelas4" class="dropdown-menu border-0 shadow">
                        <li><a class="dropdown-item" href="{{ url('kelas/grade4A') }}">4 A</a></li>
                        <li><a class="dropdown-item" href="{{ url('kelas/grade4B') }}">4 B</a></li>
                        <li><a class="dropdown-item" href="{{ url('kelas/grade4C') }}">4 C</a></li>
                    </ul>
                </li>
                <li class="dropdown-submenu dropdown-hover">
                    <a id="groupmenukelas5" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Kelas 5</a>
                    <ul aria-labelledby="groupmenukelas5" class="dropdown-menu border-0 shadow">
                        <li><a class="dropdown-item" href="{{ url('kelas/grade5A') }}">5 A</a></li>
                        <li><a class="dropdown-item" href="{{ url('kelas/grade5B') }}">5 B</a></li>
                        <li><a class="dropdown-item" href="{{ url('kelas/grade5C') }}">5 C</a></li>
                    </ul>
                </li>
                <li class="dropdown-submenu dropdown-hover">
                    <a id="groupmenukelas6" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Kelas 6</a>
                    <ul aria-labelledby="groupmenukelas6" class="dropdown-menu border-0 shadow">
                        <li><a class="dropdown-item" href="{{ url('kelas/grade6A') }}">6 A</a></li>
                        <li><a class="dropdown-item" href="{{ url('kelas/grade6B') }}">6 B</a></li>
                        <li><a class="dropdown-item" href="{{ url('kelas/grade6C') }}">6 C</a></li>
                    </ul>
                </li>
            @elseif (Session('sekolah_level') == 3)
                <li class="dropdown-submenu dropdown-hover">
                    <a id="groupmenukelas7" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Kelas VII</a>
                    <ul aria-labelledby="groupmenukelas7" class="dropdown-menu border-0 shadow">
                        <li><a class="dropdown-item" href="{{ url('kelas/grade7A') }}">7 A</a></li>
                        <li><a class="dropdown-item" href="{{ url('kelas/grade7B') }}">7 B</a></li>
                        <li><a class="dropdown-item" href="{{ url('kelas/grade7C') }}">7 C</a></li>
                        <li><a class="dropdown-item" href="{{ url('kelas/grade7D') }}">7 D</a></li>
                        <li><a class="dropdown-item" href="{{ url('kelas/grade7E') }}">7 E</a></li>
                        <li><a class="dropdown-item" href="{{ url('kelas/grade7F') }}">7 F</a></li>
                        <li><a class="dropdown-item" href="{{ url('kelas/grade7G') }}">7 G</a></li>
                        <li><a class="dropdown-item" href="{{ url('kelas/grade7H') }}">7 H</a></li>
                        <li><a class="dropdown-item" href="{{ url('kelas/grade7I') }}">7 I</a></li>
                    </ul>
                </li>
                <li class="dropdown-submenu dropdown-hover">
                    <a id="groupmenukelas8" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Kelas VIII</a>
                    <ul aria-labelledby="groupmenukelas8" class="dropdown-menu border-0 shadow">
                        <li><a class="dropdown-item" href="{{ url('kelas/grade8A') }}">8 A</a></li>
                        <li><a class="dropdown-item" href="{{ url('kelas/grade8B') }}">8 B</a></li>
                        <li><a class="dropdown-item" href="{{ url('kelas/grade8C') }}">8 C</a></li>
                        <li><a class="dropdown-item" href="{{ url('kelas/grade8D') }}">8 D</a></li>
                        <li><a class="dropdown-item" href="{{ url('kelas/grade8E') }}">8 E</a></li>
                        <li><a class="dropdown-item" href="{{ url('kelas/grade8F') }}">8 F</a></li>
                        <li><a class="dropdown-item" href="{{ url('kelas/grade8G') }}">8 G</a></li>
                        <li><a class="dropdown-item" href="{{ url('kelas/grade8H') }}">8 H</a></li>
                        <li><a class="dropdown-item" href="{{ url('kelas/grade8I') }}">8 I</a></li>
                    </ul>
                </li>
                <li class="dropdown-submenu dropdown-hover">
                    <a id="groupmenukelas9" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Kelas IX</a>
                    <ul aria-labelledby="groupmenukelas9" class="dropdown-menu border-0 shadow">
                        <li><a class="dropdown-item" href="{{ url('kelas/grade9A') }}">9 A</a></li>
                        <li><a class="dropdown-item" href="{{ url('kelas/grade9B') }}">9 B</a></li>
                        <li><a class="dropdown-item" href="{{ url('kelas/grade9C') }}">9 C</a></li>
                        <li><a class="dropdown-item" href="{{ url('kelas/grade9D') }}">9 D</a></li>
                        <li><a class="dropdown-item" href="{{ url('kelas/grade9E') }}">9 E</a></li>
                        <li><a class="dropdown-item" href="{{ url('kelas/grade9F') }}">9 F</a></li>
                        <li><a class="dropdown-item" href="{{ url('kelas/grade9G') }}">9 G</a></li>
                        <li><a class="dropdown-item" href="{{ url('kelas/grade9H') }}">9 H</a></li>
                        <li><a class="dropdown-item" href="{{ url('kelas/grade9I') }}">9 I</a></li>
                    </ul>
                </li>
            @else
                <li class="dropdown-submenu dropdown-hover">
                    <a id="groupmenukelas10" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Kelas X</a>
                    <ul aria-labelledby="groupmenukelas10" class="dropdown-menu border-0 shadow">
                        <li><a class="dropdown-item" href="{{ url('kelas/grade10A') }}">10 A</a></li>
                        <li><a class="dropdown-item" href="{{ url('kelas/grade10B') }}">10 B</a></li>
                        <li><a class="dropdown-item" href="{{ url('kelas/grade10C') }}">10 C</a></li>
                        <li><a class="dropdown-item" href="{{ url('kelas/grade10D') }}">10 D</a></li>
                        <li><a class="dropdown-item" href="{{ url('kelas/grade10E') }}">10 E</a></li>
                        <li><a class="dropdown-item" href="{{ url('kelas/grade10F') }}">10 F</a></li>
                        <li><a class="dropdown-item" href="{{ url('kelas/grade10G') }}">10 G</a></li>
                        <li><a class="dropdown-item" href="{{ url('kelas/grade10H') }}">10 H</a></li>
                        <li><a class="dropdown-item" href="{{ url('kelas/grade10I') }}">10 I</a></li>
                    </ul>
                </li>
                <li class="dropdown-submenu dropdown-hover">
                    <a id="groupmenukelas11" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Kelas XI</a>
                    <ul aria-labelledby="groupmenukelas11" class="dropdown-menu border-0 shadow">
                        <li><a class="dropdown-item" href="{{ url('kelas/grade11A') }}">11 A</a></li>
                        <li><a class="dropdown-item" href="{{ url('kelas/grade11B') }}">11 B</a></li>
                        <li><a class="dropdown-item" href="{{ url('kelas/grade11C') }}">11 C</a></li>
                        <li><a class="dropdown-item" href="{{ url('kelas/grade11D') }}">11 D</a></li>
                        <li><a class="dropdown-item" href="{{ url('kelas/grade11E') }}">11 E</a></li>
                        <li><a class="dropdown-item" href="{{ url('kelas/grade11F') }}">11 F</a></li>
                        <li><a class="dropdown-item" href="{{ url('kelas/grade11G') }}">11 G</a></li>
                        <li><a class="dropdown-item" href="{{ url('kelas/grade11H') }}">11 H</a></li>
                        <li><a class="dropdown-item" href="{{ url('kelas/grade11I') }}">11 I</a></li>
                    </ul>
                </li>
                <li class="dropdown-submenu dropdown-hover">
                    <a id="groupmenukelas12" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Kelas XII</a>
                    <ul aria-labelledby="groupmenukelas12" class="dropdown-menu border-0 shadow">
                        <li><a class="dropdown-item" href="{{ url('kelas/grade12A') }}">12 A</a></li>
                        <li><a class="dropdown-item" href="{{ url('kelas/grade12B') }}">12 B</a></li>
                        <li><a class="dropdown-item" href="{{ url('kelas/grade12C') }}">12 C</a></li>
                        <li><a class="dropdown-item" href="{{ url('kelas/grade12D') }}">12 D</a></li>
                        <li><a class="dropdown-item" href="{{ url('kelas/grade12E') }}">12 E</a></li>
                        <li><a class="dropdown-item" href="{{ url('kelas/grade12F') }}">12 F</a></li>
                        <li><a class="dropdown-item" href="{{ url('kelas/grade12G') }}">12 G</a></li>
                        <li><a class="dropdown-item" href="{{ url('kelas/grade12H') }}">12 H</a></li>
                        <li><a class="dropdown-item" href="{{ url('kelas/grade12I') }}">12 I</a></li>
                    </ul>
                </li>
            @endif
        </ul>
    </li>
@elseif(Session('previlage') == 'level4')
    <li class="nav-item">
        <a class="nav-link" href="/" role="button"> Dashboard</a>
    </li>
    <li class="nav-item dropdown">
        <a id="suratmenu" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Main Menu</a>
        <ul aria-labelledby="suratmenu" class="dropdown-menu border-0 shadow">
            <li class="dropdown-submenu dropdown-hover">
                <a id="groupkesiswaan" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Kesiswaan</a>
                <ul aria-labelledby="groupkesiswaan" class="dropdown-menu border-0 shadow">
                    <li><a class="dropdown-item" href="{{ url('datainduk') }}">Data Induk Siswa</a></li>
                    <li><a class="dropdown-item" href="{{ url('lapppdb') }}">Laporan PPDB</a></li>
                    <li><a class="dropdown-item" href="{{ url('lapekskul') }}">Laporan Ekstrakulikuler</a></li>
                    <li><a class="dropdown-item" href="{{ url('penilaianekskul') }}"> Penilaian Ekstrakulikuler</a></li>
                    <li><a class="dropdown-item" href="{{ url('presensifinger') }}">Laporan Presensi</a></li>
                    <li><a class="dropdown-item" href="{{ url('prestasisiswa') }}">Laporan Prestasi Siswa</a></li>
                </ul>
            </li>
            <li class="dropdown-submenu dropdown-hover">
                <a id="groupkesiswaan" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">AlQuran</a>
                <ul aria-labelledby="groupkesiswaan" class="dropdown-menu border-0 shadow">
                    <li><a class="dropdown-item" href="{{ url('prestasialquran') }}">Laporan Prestasi Alquran</a></li>
                </ul>
            </li>
            <li class="dropdown-submenu dropdown-hover">
                <a id="groupkesiswaan" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Sarana dan Prasarana</a>
                <ul aria-labelledby="groupkesiswaan" class="dropdown-menu border-0 shadow">
                    <li><a class="dropdown-item" href="{{ url('persuratan') }}">Persuratan</a></li>
                    <li><a class="dropdown-item" href="{{ url('sarpras') }}">Sarana dan Prasarana</a></li>
                    <li><a class="dropdown-item" href="{{ url('minimi') }}"> Perpustakaan</a></li>
                    <li><a class="dropdown-item" href="{{ url('datakeluhan') }}">Kritik dan Keluhan</a></li>
                </ul>
            </li>
        </ul>
    </li>
    <li class="nav-item dropdown">
        <a id="groupmenusetting" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Setting</a>
        <ul aria-labelledby="groupmenusetting" class="dropdown-menu border-0 shadow">
            <li><a class="dropdown-item" href="{{ url('useranyar') }}"> Pendaftaran Account</a></li>
            <li><a class="dropdown-item" href="{{ url('pengumuman') }}"> Pengumuman</a></li>
            <li><a class="dropdown-item" href="{{ url('setting') }}">Setting</a></li>
        </ul>
    </li>
@elseif(Session('previlage') == 'adminzis' OR Session('previlage') == 'level5')
    <li class="nav-item">
        <a class="nav-link" href="/" role="button"> Dashboard</a>
    </li>
    <li class="nav-item dropdown">
        <a id="suratmenu" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Main Menu</a>
        <ul aria-labelledby="suratmenu" class="dropdown-menu border-0 shadow">
            <li class="dropdown-submenu dropdown-hover">
                <a id="groupkesiswaan" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Keuangan</a>
                <ul aria-labelledby="groupkesiswaan" class="dropdown-menu border-0 shadow">
                    <li><a class="dropdown-item" href="{{ url('setkeuangan') }}">Setting Keuangan</a></li>
                    <li><a class="dropdown-item" href="{{ url('lapbayar') }}">Laporan SPP dan Insidental</a></li>
                    <li><a class="dropdown-item" href="{{ url('datakeuhptmasuk') }}">Keuangan Sekolah</a></li>
                    <li><a class="dropdown-item" href="{{ url('laporankeuhpt') }}">Laporan Keuangan</a></li>
                    <li><a class="dropdown-item" href="{{ url('lapamil') }}">Laporan ZIS</a></li>
                    <li><a class="dropdown-item" href="{{ url('laptabungan') }}">Laporan Tabungan</a></li>
                </ul>
            </li>
        </ul>
    </li>
@elseif(Session('previlage') == 'ortu')
    <li class="nav-item">
        <a class="nav-link" href="/" role="button"> Dashboard</a>
    </li>
    <li class="nav-item dropdown">
        <a id="groupmenuortu" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Main Menu</a>
        <ul aria-labelledby="groupmenuortu" class="dropdown-menu border-0 shadow">
            <li><a class="dropdown-item" href="{{ url('biodata') }}">Siswa / Anak Asuh</a></li>
            <li><a class="dropdown-item" href="{{ url('ijinortu') }}">Ijin Tidak Masuk Anak</a></li>
            <li><a class="dropdown-item" href="{{ url('lapnilaiortu') }}">Laporan Nilai</a></li>
            <li><a class="dropdown-item" href="{{ url('faqihkecil') }}">Setoran Tahfid/Tahsin/Murojaah</a></li>
            <li><a class="dropdown-item" href="{{ url('tagihanrutin') }}">Tagihan Sekolah</a></li>
            <li><a class="dropdown-item" href="{{ url('tabungan') }}">Tabungan Anak</a></li>
        </ul>
    </li>
    <li class="nav-item dropdown">
        <a id="groupmenuortu" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Menu Sekolah</a>
        <ul aria-labelledby="groupmenuortu" class="dropdown-menu border-0 shadow">
            <li><a class="dropdown-item" href="{{ url('zis') }}">Pembayaran Zakat, Infaq dan Shodaqoh</a></li>
            <li><a class="dropdown-item" href="{{ url('daftarekskul') }}">Pendaftaran Ekskul</a></li>
            <li><a class="dropdown-item" href="{{ url('minimi') }}">Mini Library</a></li>
        </ul>
    </li>
    @if(Session('spesial') == 'paguyuban')
        <li class="nav-item dropdown">
            <a id="groupmenuortu" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Paguyuban Zone</a>
            <ul aria-labelledby="groupmenuortu" class="dropdown-menu border-0 shadow">
                <li><a class="dropdown-item" href="{{ url('dashboardpaguyuban') }}">Main Menu</a></li>
                <li><a class="dropdown-item" href="{{ url('laporankeuhpt') }}">Keuangan Paguyuban</a></li>
            </ul>
        </li>
    @endif
@else
    @if (Session('sekolah_id_sekolah') !== null)
        <li class="nav-item">
            <a class="nav-link" href="/frontpage?id={{ Session('sekolah_id_sekolah') }}" role="button"><i class="fa fa-dashboard"></i> {{Session('sekolah_nama_sekolah')}}</a>
        </li>
    @else
        <li class="nav-item">
            <a class="nav-link" href="/" role="button"><i class="fa fa-dashboard"></i> Dashboard</a>
        </li>
    @endif
@endif
