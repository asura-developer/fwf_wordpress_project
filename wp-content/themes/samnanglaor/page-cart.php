<?php get_header(); ?>
<section id="carts">
    <div class="section-title"><h3><?php _e('My Carts'); ?></h3></div>
    <div class="cart-display">
        <div class="container">
           <div class="cartItem head" >
                        <div class="cartNo"><?php _e('No') ?></div>
                        <div class="cartName"><?php _e('Product name'); ?></div>
                        <div class="cartQty"><?php _e('Quantity'); ?></div>
                        <div class="cartUnitprice"><?php _e('Unit price') ?></div>
                        <div class="cartTotal"><?php _e('Total') ?></div>
                        <div class="cartRemovehead"> <?php _e('remove'); ?></div>
                        <?php $grandTotal += ($carts[$i]->qty * $carts[$i]->price); ?>
            </div>   
            <?php $carts = getCartObject();
                  $grandTotal = 0;
                    for($i = 0; $i < count($carts) ; $i ++){
            ?>      
                    <div class="cartItem" cartid="<?php echo $carts[$i]->id;?>">
                        <div class="cartNo"><?php echo $i; ?></div>
                        <div class="cartName"><?php echo $carts[$i]->name; ?></div>
                        <div class="cartQty"><input class="cqty" type="number" min="1" value="<?php echo $carts[$i]->qty; ?>"></input></div>
                        <div class="cartUnitprice"><?php  echo '$ ' . number_format($carts[$i]->price,2); ?></div>
                        <div class="cartTotal"><?php echo '$ ' . number_format(($carts[$i]->qty * $carts[$i]->price),2); ?></div>
                        <div class="cartRemove"> <?php _e('remove'); ?></div>
                        <?php $grandTotal += ($carts[$i]->qty * $carts[$i]->price); ?>
                    </div>      

            <?php  } ?>
        </div>
    </div>

    <div class="center padding5"><?php _e('Grand Total = ');?><span id="gTotal"><?php echo '$ ' . number_format($grandTotal,2); ?></span></div>

    <div class="center padding5"><button id="checkout"><?php echo _e('CHECKOUT')?></button></div>

    <div class="center">
                     <div class="lds-ripple" style="display: none;"><div></div><div></div></div>
    </div>


</section>

<script>
    j( "body" ).delegate( ".cqty", "change", function( event ) {
    var ajaxurl = jQuery('#page').attr('ajax'); var event = this;
    jQuery.ajax({ url : ajaxurl, type : 'post', dataType : 'json',
    data : {  action: 'main_ajax', funct: 'updateQty',
              arrData: {
                qty: j(this).val(),
                id: j(this).parent().parent().attr('cartid')
              }
            },
            success : function(data) {
                ajaxSuccess(data, event);
            }
        });                                       
    });
   
    ajaxSuccess = (data, event) => {
      j('#cartnum').html(data.carts);
       var parentJ = j(event).parent().parent();
       parentJ.find('.cartTotal').text('$ ' + parseFloat(data.ctpr).toFixed(2));
       j('#gTotal').text('$ ' + parseFloat(data.gtotal).toFixed(2));

    }
    // cartRemove
    j( "body" ).delegate( ".cartRemove", "click", function( event ) {
    var ajaxurl = jQuery('#page').attr('ajax'); var event = this;
    jQuery.ajax({ url : ajaxurl, type : 'post', dataType : 'json',
    data : {  action: 'main_ajax', funct: 'removeCartById',
              arrData: {
                id: j(this).parent().attr('cartid')
              }
            },
            success : function(data) {
                ajaxDeleted(data, event);
            }
        });                                       
    });
   
    ajaxDeleted = (data, event) => {
        // j(event).parent().remove();
        j('#carts').html(data.html);
        j('#cartnum').html(data.carts);
    }



    j( "body" ).delegate( "#checkout", "click", function( event ) {
    var ajaxurl = jQuery('#page').attr('ajax'); var event = this;
    beforeChekout(event);
    jQuery.ajax({ url : ajaxurl, type : 'post', dataType : 'json',
    data : {  action: 'main_ajax', funct: 'checkout',
              arrData: {
                
              }
            },
            success : function(data) {
                ajaxChekout(data, event);
            }
        });                                       
    });

    beforeChekout = (event)=>{
        event.style.display = 'none';
        x('.lds-ripple').style.display = 'flex';
    }
   
    ajaxChekout = (data, event) => {
       event.style.display = 'flex';
       x('.lds-ripple').style.display = 'none';
       if(data.act){
            window.location.replace(x('.header').getAttribute('home') + '/checkoutsucess');
       }else{
            x('.alertTitle').innerText = "Something went wrong!";
            x('.toast-body').innerText = 'Make sure that you are login, and have items in your carts';
            $(".toast").toast({ delay: 3000 });
            $(".toast").toast('show');
       }
    }



</script>    



<?php get_footer(); ?>