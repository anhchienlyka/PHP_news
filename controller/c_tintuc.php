  <?php
include ('model/m_tintuc.php');
include ('model/pager.php');
 class C_tintuc{
   public  function index()
   {
       $m_tintuc = new M_tintuc(); // lay du lieu tu model
       $slide = $m_tintuc->getSlide();
       $menu = $m_tintuc->getMenu();
       return array('slide'=>$slide,'menu'=>$menu);
   }
        function loaitin()
        {
            $id_loai = $_GET['id_loai'];
            $m_tintuc = new M_tintuc();
            $alias = $m_tintuc->getAliasLoaitin($id_loai);
            $danhmuctin =  $m_tintuc->getTintucByIdLoai($id_loai);
            $trang_hientai = (isset($_GET['page']))?$_GET['page']: 1;
            $pagination = new pagination(count($danhmuctin),$trang_hientai,4,2);
            $paginationHTML= $pagination->showPagination();
           $limit = $pagination->_nItemOnPage;
            $vitri = ($trang_hientai-1)*$limit;
            $danhmuctin= $m_tintuc->getTintucByIdLoai($id_loai,$vitri,$limit);
            $menu = $m_tintuc->getMenu();
            $ten = $m_tintuc->getTitle($id_loai);
            return array('danhmuctin'=>$danhmuctin,'menu'=>$menu,'ten'=>$ten,'thanh_phantrang'=>$paginationHTML,'alias'=>$alias);
        }



        function chitietin()
        {
            $idTin = $_GET['id_tin'];
            $alias = $_GET['loai_tin'];
            $m_tintuc= new M_tintuc();
            $chitietTin = $m_tintuc->getChitiettin($idTin);
            $comment = $m_tintuc->getComment($idTin);
            $relatednews= $m_tintuc->getRelateNews($alias);
            $tinnoibat = $m_tintuc->getTinnoibat();
            return array('chitietin'=>$chitietTin,'commnet'=>$comment,'relatednews'=>$relatednews,'tinnoibat'=>$tinnoibat);

        }
        function thembinhluan($id_user,$id_tin,$noidung)
        {
            $m_tintuc = new M_tintuc();
            $binhluan= $m_tintuc->addcoment($id_user,$id_tin,$noidung);
            header('location:'.$_SERVER['HTTP_REFERER']);

        }
        function timkiem($key){

            $m_tintuc = new M_tintuc();
            $timkiem = $m_tintuc->Search($key);
            return $timkiem;
        }

 }
?>