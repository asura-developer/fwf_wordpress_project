<?php
get_header();
$url_build = api_url . '/product/indexapi?api_token=' . api_token . '&perpage=16' . '&c_id=' . $_GET['cat'];
$response = wp_remote_get( esc_url_raw( $url_build ) );
$api_response = json_decode(wp_remote_retrieve_body( $response ));

?>

<div class="bread">
    <div class="container">
        <div class="left">
            <?php $catTitle = $api_response->lookingforcategory->title; $catTitle = json_decode($catTitle); ?> 
            <a href="<?php echo get_home_url() ?>">Home</a> | 
            <?php
              if($api_response->lookingforcategory->parent_id != 0){ 
                  $pCats = $api_response->cat_tree;
                  for($x = 0 ; $x < count($pCats) ; $x++){
                      if($pCats[$x]->c_id == $api_response->lookingforcategory->parent_id){
                          echo '<a href="' . getCatLink($pCats[$x]->c_id) . '">' .$pCats[$x]->title . '<a> | ';
                      }
                  }
              }
            ?>
            <?php  echo $catTitle->en; ?>
        </div>   

        <div class="right">
            
            <?php _e('Found: ');  echo $api_response->results->total; ?>  
        </div> 
    </div>
</div>
<?php  if($api_response->lookingforcategory->parent_id == 0){ ?>
    <div class="subCatList">
        <?php  $allCats = $api_response->cat_tree; 
         for($i = 0 ; $i < count($allCats) ; $i++){
            if($allCats[$i]->c_id == $_GET['cat']){
                $catChilds = $allCats[$i]->children;
                if($catChilds){
                ?>
                <div class="container sub-title"><?php _e('Sub Categories'); ?></div>
                    <div class="container">
                            <?php
                            
                                for($j = 0 ; $j < count($catChilds) ; $j++){                           
                                    echo '<a href="'. getCatLink($catChilds[$i]->c_id).'">';
                                        echo '<div class="catChild">';
                                            echo $catChilds[$j]->title;
                                        echo '</div>';
                                    echo '</a>';     
                                }
                            
                    } 
                } ?>
        </div>
        <?php  } ?>
    </div>  
<?php } ?>      

<div class="container">
        <div class="row" id="prolist"> 
            <?php
               require get_template_directory() . '/reuse/productlist.php';
            ?>
        </div>
    </div>
    <?php if($api_response->results->next_page_url){ ?>
        <div class="center" >
            <div class="loadmore" next="<?php echo $api_response->results->next_page_url; ?>" > <?php _e('loadmore products') ?> </div>       
        </div> 
        <div class="center">
                     <div class="lds-ripple" style="display: none;"><div></div><div></div></div>
        </div>  
    <?php } ?>  


<script>

x('.loadmore').addEventListener('click',function(){
    var ajaxurl = jQuery('#page').attr('ajax'); var event = this;
    beforeRequest(event);
    jQuery.ajax({ url : ajaxurl, type : 'post', dataType : 'json',
    data : {  action: 'main_ajax', funct: 'loadMore',
              arrData: {
                  next : x('.loadmore').getAttribute('next'),         
              }
            },
            success : function(data) {
                ajaxSuccess(data, event);
            }
    });                                       
});

beforeRequest = (event) => {
    event.style.display = 'none';
    x('.lds-ripple').style.display = 'initial';
}
    
ajaxSuccess = (data, event) => {
    x('#prolist').insertAdjacentHTML('beforeend',data.html);
    if(data.next != ""){
        event.setAttribute('next',data.next);
        event.style.display = 'initial';
    }
    x('.lds-ripple').style.display = 'none';
    
}

</script>

<?php

get_footer();
