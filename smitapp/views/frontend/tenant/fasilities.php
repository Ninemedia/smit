<?php
    $active_page    = ( $this->uri->segment(1, 0) ? $this->uri->segment(1, 0) : '');
    $active_page2   = ( $this->uri->segment(2, 0) ? $this->uri->segment(2, 0) : '');
?>

<div id="gtco-contentbreadcumb" class="animate-box">
	<div class="gtco-container">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="body pull-left">
                <ol class="breadcrumb">
                    <li>
                        <a href="<?php echo base_url(); ?>">
                            <i class="icon-home"></i> Beranda
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url('tenant/fasilitastenant'); ?>">
                            <i class=""></i> Tenant
                        </a>
                    </li>
                    <li <?php echo ($active_page2 == 'fasilitas' ? 'class="active"' : ''); ?>>
                        <a href="<?php echo base_url('tenant/fasilitastenant'); ?>">
                            <i class=""></i> <strong>Fasilitas Tenant</strong>
                        </a>
                    </li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div id="gtco-content" class="gtco-section border-bottom animate-box">
	<div class="gtco-container">
		<div class="row">
			<div class="col-md-12 text-center gtco-heading">
				<h3>Fasilitas Tenant</h3>
			</div>
            <div class="col-md-12">
                <img class="js-animating-object img-responsive media-object visible-lg visible-md visible-sm" src="<?php echo FE_IMG_PATH; ?>slider/slider3.jpg" alt="" />
            </div>
			<div class="col-md-12">
                <div class="panel-body">
                    <h4>Ruang Kantor</h4>
                    <p align="justify">
                        Ruang Kantor/Ruang Kerja Tenant merupakan tempat tenant melakukan usaha/kegiatan administrasi. Ruangan ini terletak di Lantai 1 Gedung Utama Inkubator LIPI.
                    </p>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="header">
                        <h5>
                            Detail Ruang Kantor Tenant - Inkubator LIPI
                        </h5>
                    </div>
                    <div class="body table-responsive">
                        <table class="table table-bordered">
                            <thead class="bg bg-blue">
                                <tr>
                                    <th><center>NO</center></th>
                                    <th><center>ITEM</center></th>
                                    <th></th>
                                    <th><center>KETERANGAN</center></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">1</th>
                                    <td><strong>Jumlah Ruangan</strong></td>
                                    <td><center>:</center></td>
                                    <td>20 Buah</td>
                                </tr>
                                <tr>
                                    <th scope="row">2</th>
                                    <td><strong>Luas Rerata</strong></td>
                                    <td><center>:</center></td>
                                    <td>24 m<sup>2</sup></td>
                                </tr>
                                 <tr>
                                    <th scope="row">3</th>
                                    <td><strong>Listrik</strong></td>
                                    <td><center>:</center></td>
                                    <td>1300 VA</td>
                                </tr>
                                <tr>
                                    <th scope="row">4</th>
                                    <td><strong>Fasilitas per ruangan</strong></td>
                                    <td><center>:</center></td>
                                    <td>1 buah meja <br />2 buah kursi <br />1 buah AC 0.5 PK</td>
                                </tr>
                                <tr>
                                    <th scope="row">5</th>
                                    <td><strong>Kapasitas</strong></td>
                                    <td><center>:</center></td>
                                    <td>4 - 5 orang</td>
                                </tr>
                                <tr>
                                    <th scope="row">6</th>
                                    <td><strong>Internet</strong></td>
                                    <td><center>:</center></td>
                                    <td>Akses Gratis melalui jaringan Fiberoptic LIPI</td>
                                </tr>
                                <tr>
                                    <th scope="row">7</th>
                                    <td><strong>Telp/Fax</strong></td>
                                    <td><center>:</center></td>
                                    <td>Available,Central</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <hr />
                </div>
            </div>

            <div class="col-md-12">
                <div class="panel-body">
                    <h4>Workshop</h4>
                    <p align="justify">
                        Fasilitas Workshop merupakan fasilitas pendukung yang disediakan untuk Tenant. Fasilitas ini sifatnya kolektif dan dikelola oleh Pengelola Inkubator LIPI.
                    </p>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="header">
                        <h5>
                            Detail Fasilitas Workshop - Incubator LIPI
                        </h5>
                    </div>
                    <div class="body table-responsive">
                        <table class="table table-bordered">
                            <thead class="bg bg-blue">
                                <tr>
                                    <th><center>NO</center></th>
                                    <th><center>ITEM</center></th>
                                    <th></th>
                                    <th><center>KETERANGAN</center></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">1</th>
                                    <td><strong>Luas Bangunan</strong></td>
                                    <td><center>:</center></td>
                                    <td>1000 m3</td>
                                </tr>
                                <tr>
                                    <th scope="row">2</th>
                                    <td><strong>Pintu Masuk</strong></td>
                                    <td><center>:</center></td>
                                    <td>Ruang Lab QC & Ruang Kantor : Keramik <br /> Ruang Proses & Gudang : Beton padat</td>
                                </tr>
                                 <tr>
                                    <th scope="row">3</th>
                                    <td><strong>Listrik</strong></td>
                                    <td><center>:</center></td>
                                    <td>Steel Rolling gate, tinggi 8 m lebar 8 m <br /> 2 buah Alumunium Gate, tinggi 2.5m lebar 3 m</td>
                                </tr>
                                <tr>
                                    <th scope="row">4</th>
                                    <td><strong>Ruangan</strong></td>
                                    <td><center>:</center></td>
                                    <td>
                                        Ruang Proses : 650 m<sup>2</sup> <br />
                                        Ruang Lab QC : 40 m<sup>2</sup> <br />
                                        Ruang Kantor (lantai 2) : 60 m<sup>2</sup> <br />
                                        Gudang : 200 m<sup>2</sup> <br />
                                        Ruang Perawatan : 50 m<sup>2</sup> <br />
                                        Toilet & dapur : 30 m<sup>2</sup>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">5</th>
                                    <td><strong>Toilet & Dapur</strong></td>
                                    <td><center>:</center></td>
                                    <td>
                                        2 buah toilet <br />
                                        2 buah kamar mandi (shower) <br />
                                        1 dapur umum <br />
                                        1 kran wudhu <br />
                                        1 wastafel dilengkapi dengan kaca
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">6</th>
                                    <td><strong>Internet</strong></td>
                                    <td><center>:</center></td>
                                    <td>Akses Gratis melalui jaringan Fiberoptic LIPI</td>
                                </tr>
                                <tr>
                                    <th scope="row">7</th>
                                    <td><strong>Bak Cuci Tangan</strong></td>
                                    <td><center>:</center></td>
                                    <td>2 buah</td>
                                </tr>
                                <tr>
                                    <th scope="row">8</th>
                                    <td><strong>Listrik</strong></td>
                                    <td><center>:</center></td>
                                    <td>Xxx Watt, PLN, multi phase</td>
                                </tr>
                                <tr>
                                    <th scope="row">9</th>
                                    <td><strong>Crane</strong></td>
                                    <td><center>:</center></td>
                                    <td>20 Ton max</td>
                                </tr>
                                <tr>
                                    <th scope="row">10</th>
                                    <td><strong>Exaust Fan</strong></td>
                                    <td><center>:</center></td>
                                    <td>10 exaust fan, Roof top</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <hr />
                </div>
            </div>

            <div class="col-md-12">
                <div class="panel-body">
                    <h4>Syndication Room</h4>
                    <p align="justify">
                        Ruang sindikasi adalah ruang pertemuan kecil yang bisa dimanfaatkan untuk pertemuan-pertemuan tertutup. Spesifikasinya sebagai berikut:
                    </p>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="header">
                        <h5>
                            Ruang Sindikasi
                        </h5>
                    </div>
                    <div class="body table-responsive">
                        <table class="table table-bordered">
                            <thead class="bg bg-blue">
                                <tr>
                                    <th><center>NO</center></th>
                                    <th><center>ITEM</center></th>
                                    <th></th>
                                    <th><center>KETERANGAN</center></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">1</th>
                                    <td><strong>Jumlah Ruang Sindikasi</strong></td>
                                    <td><center>:</center></td>
                                    <td>5 ruangan</td>
                                </tr>
                                <tr>
                                    <th scope="row">2</th>
                                    <td><strong>Kapasitas</strong></td>
                                    <td><center>:</center></td>
                                    <td>5 - 7 orang</td>
                                </tr>
                                 <tr>
                                    <th scope="row">3</th>
                                    <td><strong>Luas</strong></td>
                                    <td><center>:</center></td>
                                    <td>12 m<sup>2</sup></td>
                                </tr>
                                <tr>
                                    <th scope="row">4</th>
                                    <td><strong>Fasilitas per ruangan</strong></td>
                                    <td><center>:</center></td>
                                    <td>1 buah meja <br />4 buah kursi <br /></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <hr />
                </div>
            </div>
            <div class="col-md-12">
                <div class="panel-body">
                    <h4>Meeting Room</h4>
                    <p align="justify">
                        Ruang Rapat adalah ruang pertemuan besar yang bisa dimanfaatkan untuk rapat bersama. Spesifikasinya sebagai berikut:
                    </p>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="header">
                        <h5>
                            Ruang Rapat
                        </h5>
                    </div>
                    <div class="body table-responsive">
                        <table class="table table-bordered">
                            <thead class="bg bg-blue">
                                <tr>
                                    <th><center>NO</center></th>
                                    <th><center>ITEM</center></th>
                                    <th></th>
                                    <th><center>KETERANGAN</center></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">1</th>
                                    <td><strong>Jumlah Ruang Rapat</strong></td>
                                    <td><center>:</center></td>
                                    <td>2 ruangan</td>
                                </tr>
                                <tr>
                                    <th scope="row">2</th>
                                    <td><strong>Kapasitas</strong></td>
                                    <td><center>:</center></td>
                                    <td>7 - 10 orang</td>
                                </tr>
                                 <tr>
                                    <th scope="row">3</th>
                                    <td><strong>Luas</strong></td>
                                    <td><center>:</center></td>
                                    <td>75 m<sup>2</sup></td>
                                </tr>
                                <tr>
                                    <th scope="row">4</th>
                                    <td><strong>Fasilitas per ruangan</strong></td>
                                    <td><center>:</center></td>
                                    <td>1 buah meja <br />10 buah kursi <br /></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <hr />
                </div>
            </div>

		</div>
	</div>
</div>
