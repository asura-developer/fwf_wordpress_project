<?php get_header(); ?>
    <section class="user-infor">
            <div class="center"><h3><?php _e('My Account'); ?></h3></div>  
            <div class="headTab">
                <div class="tab active" order="1">
                    <?php _e('Order History'); ?>
                </div>
                <div class="tab" order="2">
                    <?php _e('Profile'); ?>
                </div>
            </div>

            <!-- Display information -->
            <div class="tabBody">
                <div class="container">
                    <div class="tabContent active" order="1">
                        <?php if(isLogin()){?>
                            <?php
                                $url_build = api_url . '/quotation/indexapi?api_token=' . api_token . '&cm_id=' . $_SESSION['posuser'];
                                $response = wp_remote_get( esc_url_raw( $url_build ) );
                                $api_response = json_decode( wp_remote_retrieve_body( $response ));
                                $quotes = $api_response->results->data;
                            ?>
                            
                            <?php for($i = 0; $i < count($quotes) ; $i++) { ?>

                                  <div class="qts" num="<?php echo $quotes[$i]->id; ?>">
                                        <div class="qtno"><?php echo ($i + 1); ?> </div>
                                        <div class="qtname"><?php echo $quotes[$i]->title; ?></div>
                                        <div class="qtamount"><?php echo '$ ' . $quotes[$i]->gtotal; ?></div>
                                        <div class="qtdate"><?php echo $quotes[$i]->iss_date; ?></div>
                                  </div>

                            <?php } ?>    

                        <?php }?>    
                    </div>
                    <div class="tabContent" order="2" >
                        <?php if(isLogin()) {?>
                        <?php $user = getLoginInfo($_SESSION['posuser']); ?>
                        <div class="form-group">
                             <input class="form-control" type="text" name="username" id="username" placeholder="Your name" value="<?php echo $user->latinname; ?>"></input>
                        </div>
                        <div class="form-group">
                             <input class="form-control" type="text" placeholder="Phonenumber" name="phone" id="phone" value="<?php echo $user->cphone; ?>" /></input>

                        </div>
                        <div class="form-group">
                             <input class="form-control" type="email" placeholder="Email Address" name="email" id="email" value="<?php echo $user->cemail; ?>" /></input>

                        </div>

                        <?php $tags = $user->tag; $sm = json_decode($tags); ?>        

                        <div class="form-group">
                             <input class="form-control" type="text" placeholder="Facebook" name="facebook" id="facebook" value="<?php echo $sm->cfacebook; ?>" /></input>
                        </div>

                        <div class="form-group">
                             <input class="form-control" type="text" placeholder="Line" name="line" id="line" value="<?php echo $sm->cline; ?>" /></input>
                        </div>

                        <div class="form-group">
                             <input class="form-control" type="text" placeholder="Telegram" name="telegram" id="telegram" value="<?php echo $sm->cline; ?>" /></input>
                        </div>

                        <div class="form-group">
                             <input class="form-control" type="text" placeholder="wechat" name="wechat" id="wechat" value="<?php echo $sm->ctelegram; ?>" /></input>
                        </div>

                        <div class="form-group">
                            <textarea class="form-control"  rows="4" placeholder="Address" name="address" id="address" value="<?php echo $user->caddress; ?>"></textarea>
                        </div>

                        <div class="form-group center">
                            <div id="submit"><?php _e('UPDATE'); ?></div>
                        </div>

                        <?php }?>
                    
                    </div>
                </div>    
            </div>


    </section>


    <script>
 
        jQuery('.tab').click(function(){
            var that = this;
            jQuery('.tab.active').removeClass('active');
            jQuery(that).addClass('active');    
            var order = jQuery(that).attr('order');
            var tabs = jQuery('.tabContent');
            tabs.removeClass('active');
            for(var i = 0 ; i < tabs.length ; i++){
                if(jQuery(tabs[i]).attr('order') == order){
                    jQuery(tabs[i]).addClass('active');
                }
            }
        
        });

        jQuery('.qts').click(function(){
            var id = jQuery(this).attr('num');
            var sSrc = 'http://139.59.235.35/laravue/api/snl77/quotation/previewapi?api_token=2fbfa8a2167e2ccd84bc5d16e634cf898a5f9c07477bbada52074b0d0e89a38a&requestid=' + id; 
            jQuery('.modal-content iframe').attr('src',sSrc);
            $('.bd-example-modal-lg').modal('show');
        });    
    </script>    

    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                    <iframe src="#"></iframe>
            </div>
        </div>
    </div>

<?php get_footer(); ?>