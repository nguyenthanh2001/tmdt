<?php
namespace App\Http\Services\home;

class Detail
{
     public function CheckPriceCake($detail)
    {
        $customDetail = Array();
        
       if(empty($detail->khuyenmai)){ 
        if(collect($detail->sizebanh)->isEmpty()){        
            $customDetail['giabanh'][0]['giagoc']=number_format($detail->giabanh);
        }else{
            foreach ($detail->sizebanh as $key => $value) {
                $customDetail['giabanh'][$key]['masize']=$value->masize;
                $customDetail['giabanh'][$key]['tensize']=$value->tensize;
                $customDetail['giabanh'][$key]['giagoc']=number_format($value->gia);
            }
        }
       }
       else{
        if(collect($detail->sizebanh)->isEmpty()){    
            $customDetail['giabanh'][0]['giagoc']=number_format(($detail->giabanh));
            $customDetail['giabanh'][0]['giagiam']=number_format(($detail->giabanh*((100-$detail->khuyenmai->giatri)/100)));
        }else{    
            foreach ($detail->sizebanh as $key => $value) {
            $customDetail['giabanh'][$key]['masize']=$value->masize;
            $customDetail['giabanh'][$key]['tensize']=$value->tensize;
            $customDetail['giabanh'][$key]['giagoc']=number_format(($value->gia));
            $customDetail['giabanh'][$key]['giagiam']=number_format(($value->gia*((100-$detail->khuyenmai->giatri)/100)));
            }
        }
       }
       return $customDetail;
    }
}
?>