<?php get_header(); 
$pid = 0;
if(isset($_GET['productid'])){
    $pid = $_GET['productid'];
}
$url_build = api_url . '/product/detailapi/'.$pid.'?api_token=' . api_token ;
$response = wp_remote_get( esc_url_raw( $url_build ) );
$api_response = json_decode( wp_remote_retrieve_body( $response ));
$images = $api_response->files;
$detail = $api_response->results[0];


$sizes = $api_response->sizes;
$sizes = json_decode(json_encode($sizes),true);

$colors = $api_response->colors;
$colors = json_decode(json_encode($colors),true);

$xtra = json_decode($detail->xtraprice,true);

function sizeColor($string){
    $sc = explode('-',$string);
    $scode = $sc[0];
    $ccode = $sc[1];
    $arr = array(
        'size' => $scode,
        'color' => $ccode
    );
    return $arr;
}

?>

<section id="product-detail" unitid="<?php echo $detail->unt_id; ?>" proid="<?php echo $detail->id; ?>" >
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="progallery">
                    <div class="thumbs">
                        <?php for($i = 0; $i < count($images) ; $i++) {?>
                                <?php if($images[$i]->tag == 'p'){ continue; }?>  
                                <div class="thum-img <?php if($i == 0) echo 'active' ?>">
                                    <img src="<?php echo filelibrary . (($images[$i]->file_name) ? $images[$i]->file_name : no_img) ?>" />
                                </div>
                        <?php } ?>    
                    </div>
                    <div class="viewbox">   
                        <a data-fancybox="product" href="<?php echo filelibrary . (($images[0]->file_name) ? $images[0]->file_name : no_img) ?>">                     
                            <img src="<?php echo filelibrary . (($images[0]->file_name) ? $images[0]->file_name : no_img) ?>" />
                        </a>    
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                 <div class="product-title"><?php echo $detail->title; ?></div>
                 <?php if(isLogin()) { 
                     $proR = $detail;
                     $prices = json_decode($proR->pricing,true);
                     ?>
                 <div class="theprice" dval="<?php echo ($prices[$i]) ? $prices[$i] : 0 ?>" nval="<?php echo ($prices[$i]) ? $prices[$i] : 0 ?>">
                    <?php
                     
                     if($prices[$i] == null){
                         echo '$ ' . number_format(0,2);
                     }else{
                         echo '$ ' . number_format($prices[$i],2);
                     }

                     ?>    
                 </div>
                <?php } ?>  
                 <div class="product-content"><?php 
                    $desc = json_decode($detail->translate);
                    $desc = $desc->des;
                    echo html_entity_decode($desc);
                 ?>

                 <?php if(isLogin()) { ?>
                    <div class="sizecolor">
                        <?php
                        foreach ($xtra as $key => $value){
                            if($key == '-'){ continue; }
                            $sc = sizeColor($key);
                            $scode = $sc['size'];
                            $ccode = $sc['color'];
                            echo '<div class="sc-item" val="'.$value.'" size="'.$scode.'" color="'.$ccode.'">';
                              if($scode == ""){
                                echo $colors[$ccode];
                              }else if($ccode == ""){
                                echo $sizes[$scode];
                              }else{
                                echo $sizes[$scode] . ' - ' . $colors[$ccode];
                              }  
                            echo '</div>';    
                        }
                        ?>    
                    </div>


                    <div class="cart">
                       <input type="number" name="qty" id="cartQty" value="1" min="1"></input>
                       <div class="addtocart"><?php _e("Add to Cart"); ?></div>
                       <div class="buynow"><?php _e('Buy now'); ?></div>
                    </div>

                 <?php } ?>   

            </div>
        </div>
    </div>


    <div class="container">
         <div class="center section-title"><h3><?php _e('PEOPLE WITH PRODUCT')?></h3></div>
         <div class="pwp">
              <div class="row">
                     <?php for($i = 0; $i < count($images) ; $i++) {?>
                            <?php if(!$images[$i]->tag == 'p'){ continue; }?>
                            <div class="col-md-3">
                                <a data-fancybox="galleryP" href="<?php echo filelibrary . (($images[$i]->file_name) ? $images[$i]->file_name : no_img) ?>">
                                    <div class="thum-imgpeople">
                                        <img src="<?php echo filelibrary . (($images[$i]->file_name) ? $images[$i]->file_name : no_img) ?>" />
                                    </div>
                                </a>
                            </div>

                    <?php } ?>    

              </div>          

         </div>
         
    
    </div>


</section>

<script>
    
    jQuery('.thum-img').click(function(){
        var that = this;
        var src = jQuery(this).find('img').attr('src');
        jQuery('.thum-img.active').removeClass('active');
        jQuery(that).addClass('active');
        jQuery('.viewbox').find('img').attr('src',src);
        jQuery('.viewbox').find('a').attr('href',src);
    });
    
    j('.sc-item').click(function(){
        j('.sc-item.active').removeClass('active');
        j(this).addClass('active');
        var myVal = parseInt(j(this).attr('val'));
        var dfp = parseInt(j('.theprice').attr('dval'));
        j('.theprice').attr('nval',(dfp + myVal))
        j('.theprice').text('$ ' + parseFloat(dfp + myVal).toFixed(2));
    });


    x('.addtocart').addEventListener('click',function(){
    var ajaxurl = jQuery('#page').attr('ajax'); var event = this;
    // beforeRequest(event);
    jQuery.ajax({ url : ajaxurl, type : 'post', dataType : 'json',
    data : {  action: 'main_ajax', funct: 'addToCart',
              arrData: {
                 qty: j('#cartQty').val(),
                 name: j('.product-title').text() + ' ' + j('.sc-item.active').text(),
                 price: j('.theprice').attr('nval'),
                 proid: j('#product-detail').attr('proid'),
                 unitid: j('#product-detail').attr('unitid'),
                 size: j('.sc-item.active').attr('size'),
                 color: j('.sc-item.active').attr('color')
              }
            },
            success : function(data) {
                ajaxSuccess(data, event);
            }
        });                                       
    });
   
    ajaxSuccess = (data, event) => {
        j('#cartnum').html(data.carts);
        j('.alertTitle').html('<i class="fas fa-shopping-cart"> Product Added to Cart');
        x('.toast-body').innerText = j('.product-title').text() + ' ' + j('.sc-item.active').text() + ' x ' + j('#cartQty').val();
        $(".toast").toast({ delay: 3000 });
        $(".toast").toast('show');  
        // console.log(data);
    }
    

    j('.buynow').click(function(){
        // x('.addtocart').click();
        setTimeout(x('.addtocart').click(), 3000);
        window.location.replace(x('.header').getAttribute('home') + '/cart');
    });
    


</script>    

<?php get_footer(); ?>