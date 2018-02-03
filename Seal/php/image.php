<?php
//header("charset=utf-8");
class SealImage{
    private $kind=0;
    private $width=94;
    private $height=94;
    private $fontsize=28;
    private $angle=0;
    private $offsetx=6;
    private $offsety=2;
    private $img;
    private $color;
    private $name="";
    private $first="张";
    private $second="三";
    private $third="之";
    private $fourth="印";
    private $sealsize=1;
    private $line=2;
    private $column;
    private $base;
    private $style=0;
    private $character=array();
    //0隶书   1 方正姚体  2仿宋  3黑体  4华文仿宋   
    //5华文宋体  6华文细黑    
    //7华文中宋  8 楷体   9 微软雅黑    10微软雅黑(粗)  
    //11 幼圆    12华康少女 /
    //13华文楷体  14华文琥珀  15 华文彩云  16 华文行楷  
    //17华文隶书  18华文新魏 
    //19方正小篆体    20金文大篆体  21方正启体简体  22方正水柱_GBK 23汉仪篆书繁
    //24迷你简娃娃篆    25经典繁方篆   26方正剪紙繁體   
    //27方正细珊瑚繁体  28方正准圆繁体 29方正行楷繁体 
    //
    private $stocks=array("SIMLI.TTF",
    "FZYTK.TTF","SIMFANG.TTF","SIMHEI.TTF","STFANGSO.TTF",
    "STSONG.TTF","STXIHEI.TTF",
    "STZHONGS.TTF","SIMKAI.TTF","MSYH.TTF","MSYHBD.TTF",
    "SIMYOU.TTF","HKSN.TTF",//华康少女 12
     "STKAITI.TTF","STHUPO.TTF","STCAIYUN.TTF","STXINGKA.TTF",
    "STLITI.TTF","STXINWEI.TTF",
     "FZXZ.TTF","JWDZ.TTF",   
    "FZQTJT.TTF","FZSZ_GBK.TTF","HYZSF.TTF",       //21-23 简体
    "MNWWZ.TTF","JDFFZ.TTF","FZJZFT.TTF",
    "FZXSHFT.TTF","FZZYFT.TTF","FZXKFT.TTF");//27-29  繁體
    
    //ZGLJSZ.TTF 
    //
    //
    function __construct($kind,$name,$stock,$sealsize=1,$line=2,$style=0){               
        $this->kind=$this->check_kind($kind);
        $this->name=$name;
        $this->sealsize=$sealsize;
        $this->line=$line;
        $this->style=$style;
        $this->stock="http://pictureofxgl.qiniudn.com/online/fonts/".$this->stocks[$stock];
        $this->stock="../font/".$this->stocks[$stock];
        $this->get_name(); 
        $this->get_fontsize();       
    }
    function get_fontsize(){
        switch($this->sealsize){
            case 1:$this->fontsize=28;break;
            case 2:$this->fontsize=60;break;
            case 3:$this->fontsize=90;break;
        }
    }
    function get_result(){
         $this->get_kind();
         $this->get_img();
          //header('Content-Type:image/png');
        //imagepng($this->img);
        return $this->img;
    }
    function test_name($name){
        if($name!=""&&mb_strlen($name,'utf-8')>=2){
            return true;
        }else {
            return false;
        }
    }
    function check_kind($kind){
        if($kind!=0&&$kind!=1){
            $r=rand(0,2);
            if($r<1){
                return 0;
            }else{
                return 1;
            }
        }else{
            return $kind;
        }
    }

    function get_name(){
        for($i=0;$i<mb_strlen($this->name,'utf-8');$i++){
            $this->character[$i]=mb_substr($this->name, $i ,1 ,'utf-8');
        }
        if(count($this->character)>=1){
            $this->first=$this->character[0];
        }
        if(count($this->character)>=2){
            $this->second=$this->character[1];
        }
        if(count($this->character)>=3){
            $this->third=$this->character[2];
        }
        if(count($this->character)>=4){
            $this->fourth=$this->character[3];
        }
        //echo $this->first."-".$this->second."-".$this->third."-".$this->fourth;
     }
    function get_kind(){
        if($this->kind==0){
             $this->img=imagecreatefrompng("../img/first.png");
              $this->color=imagecolorallocate($this->img, 255, 255, 255);
    
         }else if($this->kind==1){
               $this->img=imagecreatefrompng("../img/second.png");
               $this->color=imagecolorallocate($this->img, 0xe3, 0x11, 0x11);
         }
        
    }
    function get_img(){
        //echo $this->size.'-'.$this->kind.'-'.$this->first;
        imagettftext($this->img, $this->fontsize, $this->angle, 1.5*$this->offsetx, $this->height/2-$this->offsetx, $this->color, $this->stock, $this->third);
        imagettftext($this->img, $this->fontsize, $this->angle, $this->width/2+$this->offsety, $this->height/2-$this->offsetx, $this->color, $this->stock, $this->first);
        imagettftext($this->img, $this->fontsize, $this->angle, 1.5*$this->offsetx, $this->height-3*$this->offsetx, $this->color, $this->stock, $this->fourth);
        imagettftext($this->img, $this->fontsize, $this->angle, $this->width/2+$this->offsety, $this->height-3*$this->offsetx, $this->color, $this->stock, $this->second);      
    }
    
    function get_kind_diy(){
        $base=$this->width/2*$this->sealsize;
        $this->base=$base;
        $count=count($this->character);
        $h=$base*$this->line;
        $this->column=ceil($count/$this->line);
        $w=$base*$this->column;
        $this->img=imagecreatetruecolor($w, $h);
        $res_width=188;
        $res_img;
        //echo $this->column;
        if($this->kind==0){
            $res_img=imagecreatefrompng("../img/first_src.png");
            $this->color=imagecolorallocate($this->img, 255, 255, 255);
           
        }else if($this->kind==1){
            $res_img=imagecreatefrompng("../img/second_src.png");
            $this->color=imagecolorallocate($this->img, 0xe3, 0x11, 0x11);
        }
         for($i=0;$i<2*$this->line;$i++){
                for($j=0;$j<2*$this->column;$j++){
                    $ww=$base/2;
                    $x=10;
                    $y=10;
                    if($i==0){
                        $y=0;
                        if($j==0){
                            $x=0;
                        }else if($j==2*$this->column-1){
                            $x=$res_width-($w-$j*$ww);
                            //$x=round($res_width*2/$base-1);
                        }else{
                            $x=10;
                        }
                    }else if($i==2*$this->line-1){
                        $y=$res_width-$base/2;
                        //$y=round($res_width*2/$base-1);
                        if($j==0){
                            $x=0;
                        }else if($j==2*$this->column-1){
                            $x=$res_width-$base/2;
                            //$x=round($res_width*2/$base-1);
                        }else{
                            $x=10;
                        }
                    }
                    if($j==0){
                        $x=0;
                        if($i==0){
                            $y=0;
                        }else if($i==2*$this->line-1){
                            $y=$res_width-$base/2;
                            //$y=round($res_width*2/$base-1);
                        }else{
                            $y=10;
                        }
                    }else if($j==2*$this->column-1){
                         $x=$res_width-$base/2;
                        // $x=round($res_width*2/$base-1);
                         if($i==0){
                            $y=0;
                        }else if($i==2*$this->line-1){
                            $y=$res_width-$base/2;
                            //$y=round($res_width*2/$base-1);
                        }else{
                            $y=10;
                        }
                    }
                    imagecopyresized($this->img,$res_img,$j*$ww,$i*$ww,$x,$y,ceil($ww),ceil($ww),ceil($ww),ceil($ww));
                }
            }
    }
    function get_img_diy(){
        for($i=0;$i<$this->line;$i++){
            for($j=0;$j<$this->column;$j++){
                $offsety=$this->sealsize*10;
                $offsetx=$this->sealsize*3;
                $y=($i+1)*$this->base-$offsety;
                $x=$j*$this->base+$offsetx;
                $index=$this->get_index($i,$j);                
                if($index<count($this->character)){
                   $text=$this->character[$index];                    
                   imagettftext($this->img,$this->fontsize,$this->angle,$x,$y,$this->color,$this->stock,$text);                  
                }
            }
        }
    }
    function get_index($i,$j){
        $r=0;
        switch($this->style){
            case 0:$r= $this->line*($this->column-1-$j)+$i;break;
            case 1:$r=$this->column*$i+$j;break;
        }
        return $r;
    }
    function get_result_diy(){
        $this->get_kind_diy();
        $this->get_img_diy();
        return $this->img;
    }
  
}

/*
header("Content-Type: image/png");
$t=new SealImage(1,"肖国梁很",0, 1 ,2,0);
//kind name font  sealsize line style
$img=$t->get_result_diy();
imagepng($img);
*/



?>