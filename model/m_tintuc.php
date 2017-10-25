<?php
include ('database.php');
class M_tintuc extends database{
function getSlide (){
    $sql = "SELECT * FROM slide";
    $this->setQuery($sql);
    return $this->loadAllRows(); //lấy ra tất cả dữ liệu và trở về
}
function getMenu ()
{
   $sql=" select tl. * ,GROUP_CONCAT(DISTINCT lt.id,':',lt.Ten,':',lt.TenKhongDau ) AS LoaiTin,tt.id as idTin, tt.TieuDe as TieuDeTin, tt.Hinh as HinhTin,tt.TomTat as TomTatTin, tt.TieuDeKhongDau as TieuDeTinKhongDau FROM theloai tl INNER JOIN loaitin lt ON lt.idTheLoai = tl.id INNER JOIN tintuc tt ON tt.idLoaiTin= lt.id  GROUP BY tl.id";

   $this->setQuery($sql);
    return $this->loadAllRows();


}
function getTintucByIdLoai($id_Loaitin,$vitri= -1, $limit= -1)
{
    $sql = "SELECT * FROM tintuc WHERE idLoaiTin = $id_Loaitin";
    if($vitri>-1 && $limit>1)
    {
        $sql .= " limit $vitri,$limit";
    }
    $this->setQuery($sql);

    return $this->loadAllRows(array($id_Loaitin));

}

function getIdTheLoai($id){
    $sql="SELECT idLoaiTin FROM tintuc WHERE id=$id";
    $this->setQuery($sql);
    return $this->loadRow(array($id));
}


function getTitle($id_Loaitin)
{
    $sql = "SELECT Ten FROM loaitin WHERE id =  $id_Loaitin";
    $this->setQuery($sql);
    return $this->loadRow(array($id_Loaitin));
}
function getChitiettin($id)
{
    $sql = "SELECT * FROM tintuc WHERE id = $id";
    $this->setQuery($sql);
    return $this->loadRow(array($id));
}
function getComment ($id_tin)
{
    $sql= "SELECT * FROM comment WHERE idTinTuc = $id_tin";
    $this->setQuery($sql);
    return $this->loadAllRows(array($id_tin));
}
function getRelateNews($alias)
{
    $sql= "SELECT tt.*,lt.TenKhongDau as TenKhongDau,lt.id as idLoaTin
         FROM tintuc tt INNER JOIN loaitin lt ON tt.idLoaiTin = lt.id WHERE lt.TenKhongDau='$alias' limit 0,5";
         $this->setQuery($sql);
    return $this->loadAllRows(array($alias));

}

        function addcoment($id_user,$id_Tintuc,$id_Noidung)
        {
            $sql ="INSERT INTO comment(idUser,idTinTuc,NoiDung) VALUES (?,?,?)";
            $this->setQuery($sql);
            return $this-> execute(array($id_user,$id_Tintuc,$id_Noidung));
        }
        function Search($key)
        {
            $sql = "SELECT tt.*,lt.TenKhongDau as ten_khong_dau FROM tintuc tt 
                    INNER JOIN loaitin lt on tt.idLoaitin = lt.id where tt.TieuDe like '%$key%' or tt.TomTat like '%$key%' ";
            $this->setQuery($sql);
            return $this->loadAllRows(array($sql));

        }

        function getAliasLoaitin($id_LoaiTin)
        {
            $sql= "SELECT TenKhongDau FROM  loaitin WHERE id = $id_LoaiTin";
            $this->setQuery($sql);
            return $this->loadRow(array($id_LoaiTin));
        }
    function getTinnoibat()
    {
        $sql= "SELECT tt.*,lt.TenKhongDau as TenKhongDau,lt.id as idLoaTin
         FROM tintuc tt INNER JOIN loaitin lt ON tt.idLoaiTin = lt.id WHERE tt.NoiBat=1 limit 0,5";
        $this->setQuery($sql);
        return $this->loadAllRows();

    }

}


?>