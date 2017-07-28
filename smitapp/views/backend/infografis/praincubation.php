<!-- Content -->
<div class="row clearfix">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="header"><h2>Infografis Pra-Inkubasi</h2></div>
            <div class="body">
                <p align="justify">
                    Infografis mengenai jumlah kegiatan Pra-Inkubasi per-tahun sesuai dengan kategori
                </p>
                <?php if( !empty($stats) ) : ?>
                <div id="chart-praincubation-year" style="height: 300px;">
    				<span class="data-year hide"><?php echo $chart; ?></span>
    			</div>
                <?php else : ?>
                    <div class="alert alert-info bottom0">Saat ini sedang tidak ada data chart. Silahkan update data terlebih dahulu.</div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<!-- #END# Content -->