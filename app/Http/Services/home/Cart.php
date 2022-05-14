<?php

namespace App\Http\Services\home;
use App\Models\Sizebanh;
use App\Models\Banh;
class Cart
{
    public function HandlingSessionCart($SeesonCart)
    {
        $result = array();
        foreach ($SeesonCart as $key => $value) {
            foreach ($value as $key2 => $value2) {
                $result[$key2] = $value2;              
            }
        }
        return $result;
    }
    public function ArrCartNoSize($value2,$infoCake)
    {
        $arCartID = array();
        $arCartID['mabanh']=$infoCake->mabanh;
        $arCartID['tenbanh']=$infoCake->tenbanh;
        $arCartID['hinhanh']=$infoCake->hinhanh;
        $arCartID['sizebanh']=null;
        $arCartID['soluongmua']=$value2['soluong'];
        $arCartID['giabanh_tamp']=number_format($infoCake->giabanh);
        if ($infoCake->makm != null) {
            //co khuyen mai khong size
            $arCartID['khuyenmai']=$infoCake->khuyenmai->giatri;   
            $gia =number_format(($infoCake->giabanh*((100-$infoCake->khuyenmai->giatri)/100)));                                         
            $arCartID['gia']=$gia;
            $tonggia =number_format((int)$value2['soluong']*(float)$gia);
            $arCartID['tonggia']=$tonggia.',000';
        }else{
             //khong khuyen mai khong size
            $arCartID['khuyenmai']=null;
            $gia =number_format($infoCake->giabanh);
            $arCartID['gia']= $gia; 
            $tonggia =number_format((int)$value2['soluong']*(float)$gia);                                             
            $arCartID['tonggia']=$tonggia.',000';
        } 
        return $arCartID;
    }
    public function ArrCartHaveSize($value2,$infoCakeSize,$infoCake)
    {
        $arCartID = array();
        $arCartID['mabanh']=$infoCake->mabanh;
        $arCartID['tenbanh']=$infoCake->tenbanh;
        $arCartID['hinhanh']=$infoCake->hinhanh;
        $arCartID['masize']=$infoCakeSize->masize;
        $arCartID['sizebanh']=$infoCakeSize->tensize;
        $arCartID['gia_tamp']=$infoCakeSize->gia;
        $arCartID['soluongmua']=$value2;
        if ($infoCake->makm != null) {
            //co khuyen mai khong size
            $arCartID['khuyenmai']=$infoCake->khuyenmai->giatri;   
            $gia =number_format(($infoCakeSize->gia*((100-$infoCake->khuyenmai->giatri)/100)));                                         
            $arCartID['gia']=$gia;
            $tonggia =number_format((int)$value2*(float)$gia);
            $arCartID['tonggia']=$tonggia.',000';
        }else{
             //khong khuyen mai khong size
            $arCartID['khuyenmai']=null;
            $gia =number_format($infoCakeSize->gia);
            $arCartID['gia']= $gia; 
            $tonggia =number_format((int)$value2*(float)$gia);                                             
            $arCartID['tonggia']=$tonggia.',000';
        } 
        return $arCartID;
    }
    public function showItemCart($arCart)
    {
        $arCartID = [];
        $Total = 0;
        foreach ($arCart as $key => $value) {
            $infoCake = Banh::find($key)->load('khuyenmai', 'sizebanh');
            if ($infoCake->sizebanh->isEmpty()) {
                $arrTmp = $this->ArrCartNoSize($value, $infoCake);
                array_push($arCartID, $arrTmp);
            } else {
                foreach ($value['masize'] as $key2 => $value2) {
                    $infoCakeSize = Sizebanh::find($key2);
                    $arrTmp = $this->ArrCartHaveSize($value2, $infoCakeSize, $infoCake);
                    array_push($arCartID, $arrTmp);
                }
            }
        }  
        foreach ($arCartID as $key => $value) {
             $Total += (float)$value['tonggia'];
        }   
        $Total = number_format($Total.'000');
       return array('numberOfItems'=>count($arCartID),'Total'=>$Total);
    }

}
