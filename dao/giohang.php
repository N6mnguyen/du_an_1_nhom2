<?php

//insert vao table cart
function cart_insert_id($cart,$user,$idbill)
{
    foreach($cart as $value){
        extract($value);
        $sql = "INSERT INTO cart(idpro,soluong, thanhtien, iduser,size, idbill) VALUES (?, ?, ?, ?,?,?)";
        $hoho= pdo_execute_id($sql, $idpro, $soluong, $thanhtien,  $user['id'], $tien,$idbill);
    }

    return $hoho;
}

function viewcart()
{
    $html_cart = '';
    $i = 1;
    
    foreach ($_SESSION['giohang'] as $sp) {
        extract($sp);
        if ($tien==4000) {
            $size ='M';
        }elseif ($tien==6000) {
            $size ='L';
        }else{
            $size ='S';
        }
        $xoasp = "index.php?pg=viewcart&remove=" . $idpro;
        $tt = ($price+$tien) * $soluong;
        $html_cart .= '
        <tr>
        <td>' . $i . '</td>
        <td><img src="' . IMG_PATH_USER . $img . '" alt="" style="width: 100px;"></td>
        <td>' . $name . '</td>
        <td>' . number_format($price, 0, ',', '.') . ' VNĐ</td>
        <td>
            <div class="quantity">
                <button class="quantity-btn" data-action="decrease" data-id="' . $idpro . '">-</button>
                <span class="quantity-value">' . $soluong . '</span>
                <button class="quantity-btn" data-action="increase" data-id="' . $idpro . '">+</button>
            </div>
        </td>
        <td>'.$size.'</td>
        <td class="total-amount">' . number_format($tt, 0, ',', '.') . ' VNĐ</td>
        <td><a href="'.$xoasp.'">Xóa</a></td>
    </tr>
    ';
        $i++;
    }
    return $html_cart;
}


function get_tongdonhang()
{
    $tong = 0;

    foreach ($_SESSION['giohang'] as $sp) {
        extract($sp);
        $tt = ($price+$tien) * $soluong;
        $tong += $tt;
    }
    return $tong;
}
?>

