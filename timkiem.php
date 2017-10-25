<?php
include ('controller/c_tintuc.php');
$c_tintuc = new C_tintuc();
if (isset($_POST['tukhoa']))
{
    $key = $_POST['tukhoa'];
    $tintuc = $c_tintuc->timkiem($key);
    
    ?>
    <div>Tìm thấy <b><?= count($tintuc)?></b> nội dung cho <b><?=$key?></b></div>

    <div class="panel panel-default">

        <?php
            foreach($tintuc as $tin)
            {
                ?>
                <div class="row-item row">
                    <div class="col-md-3">

                        <a href="chitiet.php?loai_tin=<?=$tin->ten_khong_dau?>&id_tin=<?=$tin->id?>">
                            <br>
                            <img width="200px" height="200px" class="img-responsive" src="public/image/tintuc/<?=$tin->Hinh?>" alt="">
                        </a>
                    </div>

                    <div class="col-md-9">
                        <h3><?=$tin->TieuDe?></h3>
                        <p><?=$tin->TomTat?></p>
                        <a class="btn btn-primary" href="chitiet.php?loai_tin=<?=$tin->ten_khong_dau?>&id_tin=<?=$tin->id?>">Xem chi tiết <span class="glyphicon glyphicon-chevron-right"></span></a>
                    </div>
                    <div class="break"></div>
                </div>
                <?php
            }
            ?>

    </div>
<?php

}


?>



