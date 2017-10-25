<?php
session_start();
include ('model/M_user.php');

class C_user
{
    function dangkyTaiKhoan($name,$mail,$password){
        $c_user = new M_user();

            $id_user = $c_user->dangky($name,$mail,$password);
            if ($id_user>0)
            {
                $_SESSION['sesssion'] =  "Đăng ký thành công";
                header('location:index.php');// sau khi hiện thông bao thanh cong thi cho nguoi dung tro ve trang chu
                if (isset($_SESSION['error'])){
                    unset($_SESSION['error']);
                }

            }
            else
            {
                $_SESSION['error'] = "Đăng ký không thành công";
                header('location:dangki.php');
            }



    }
        function dangnhapTaiKhoan($email,$password)
        {
            $c_user = new M_user();
            $id_user = $c_user->dangnhap($email,$password);
            if($id_user==true)
            {

                $_SESSION['user_name'] = $id_user[0]->name;
                $_SESSION['id_user'] = $id_user[0] ->id;
                header('location:index.php');
                if(isset($_SESSION['user_error'])){
                    unset($_SESSION['user_error']);
                }
                if (isset($_SESSION['chua_dang_nhap']))
                {
                    unset($_SESSION['chua_dang_nhap']);
                }
            }
            else{
                $_SESSION['user_error'] = "Đăng nhập không thành công";
                header('location:dangnhap.php');
            }

        }

        function dangxuatTaiKhoan()
        {
            session_destroy();
            header('location:dangnhap.php');
        }
}
?>