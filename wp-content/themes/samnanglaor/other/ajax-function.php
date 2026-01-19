<?php
// Main ajax ( all ajax will call trought this function )
add_action('wp_ajax_nopriv_main_ajax', 'main_ajax');
add_action('wp_ajax_main_ajax', 'main_ajax');

function main_ajax(){
    $callFunction = $_POST['funct']; 
    $data = $_POST['arrData'];
    $result = call_user_func($callFunction, $data);
    wp_send_json($result);
    die();
}



function posLogout($arrData){
    session_start();
    unset($_SESSION['posuser']);
}
// End Call Ajax function dynamic

// below are all sub function call by main ajax
function sampleFuntion($arrData){   
    return $arrData[a] + $arrData[b];
}


function posLogin($arrData){
    $api_url = api_url . '/customer/loginapi' . '?api_token=' . api_token;
    $data = [
        'username' => $arrData['user'],
        'password' => $arrData['password'],
        
    ];
    
    $data_string = json_encode($data);
    
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => $api_url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => $data_string,
        CURLOPT_HTTPHEADER => array(
            "Cache-Control: no-cache",
            "Content-Type: application/json",
        ),
    ));
    
    $response = curl_exec($curl);
    $result = json_decode($response);
    $err = curl_error($curl);
    curl_close($curl);
    return posLogin_afterGotResult($result) ;
    
}

function posLogin_afterGotResult($result){
    $user = $result->customerinfo;
    
    if($user){
        global $wpdb;
        $table_name = $wpdb->prefix.'posuser';
        $status =  $wpdb->insert(
                            $table_name,
                            array(
                                'id'     => $user->cm_id,  
                                'data'   => json_encode($user)
                            ),
                        array( '%d', '%s')
                    );
        if(!status){
        // wpdb::update( ‘table’, array( ‘column’ => ‘foo’, ‘field’ => 1337 ), array( ‘ID’ => 1 ), array( ‘%s’, ‘%d’ ), array( ‘%d’ ) )
        global $wpdb;
        $table_name = $wpdb->prefix.'posuser';
        $updated = $wpdb->update($table_name,
                        array('data'   => json_encode($user)),
                        array('id' => $user->cm_id),
                        array('%s'),array('%d')
                    );

        } 
        session_start();
        $_SESSION['posuser'] = $user->cm_id;
    }

    return $user;
    
}


function addToCart($arrData){
    // id	name	price	proid	user	qty	size	color	unitid	
    session_start();
    $checkCart = isCartItemExist($arrData);
    if(count($checkCart) < 1){
        global $wpdb;
        $table_name = $wpdb->prefix.'carts';
        $status =  $wpdb->insert(
                            $table_name,
                            array(
                                
                                'name'   => $arrData['name'],
                                'price' => $arrData['price'],
                                'proid' => $arrData['proid'],
                                'user' => $_SESSION['posuser'],
                                'qty' => $arrData['qty'],
                                'size' => $arrData['size'],
                                'color' => $arrData['color'],
                                'unitid' => $arrData['unitid']

                            ),
                        array('%s','%f', '%d' , '%d', '%d', '%d', '%d', '%d')
                    );
        // return $status; 
    }else{
        global $wpdb;
        $table_name = $wpdb->prefix.'carts';
        $updated = $wpdb->update($table_name,
                        array('qty'   => ($checkCart[0]->qty + $arrData['qty'])),
                        array('name' => $arrData['name'], 'user' => $_SESSION['posuser']),
                        array('%d'), // qty
                        array('%s','%d') // where
                        
                    );

        
        // return $updated;
    }

    $results = array('carts' => countCarts() , 'sent' => $arrData);
     return $results;
     

}

function isCartItemExist($arrData){
    session_start();
    // wpdb::query( string $query )
    global $wpdb;
    $table_name = $wpdb->prefix.'carts';
    $name = $arrData['name']; $user =   $_SESSION['posuser'];
    $queryStr = "SELECT * from $table_name where name = '$name' AND user = $user";
    $results =  $wpdb->get_results($queryStr);
    return $results;
}


function countCarts(){
    session_start();
    global $wpdb;
    $number = 0;
    $table_name = $wpdb->prefix.'carts';
    $user =   $_SESSION['posuser'];
    $queryStr = "SELECT * from $table_name where user = $user";
    $results =  $wpdb->get_results($queryStr);
    for($i = 0; $i < count($results) ; $i ++){
         $number += $results[$i]->qty;   
    }

    return $number;
}


function getCartObject(){
    session_start();
    global $wpdb;
    $number = 0;
    $table_name = $wpdb->prefix.'carts';
    $user =   $_SESSION['posuser'];
    $queryStr = "SELECT * from $table_name where user = $user";
    $results =  $wpdb->get_results($queryStr);
    return  $results;
}



function getProLink($id){
    return get_home_url() . '/singleproduct/?productid=' . $id;

}


function updateQty($arrData){
    session_start();
    global $wpdb;
    $table_name = $wpdb->prefix.'carts';
    $updated = $wpdb->update($table_name,
                    array('qty'   => $arrData['qty']),
                    array('id' => $arrData['id']),
                    array('%d'), // qty
                    array('%d') // where
                    
    );   
     
    $results = array(
        'carts' => countCarts(),
        'ctpr' => cartTotalPerRow($arrData['id']),
        'gtotal' => gCartTotal()
    );
    return $results;

}

function gCartTotal(){
    session_start();
    global $wpdb;
    $gt = 0;
    $table_name = $wpdb->prefix.'carts';
    $user =   $_SESSION['posuser'];
    $queryStr = "SELECT * from $table_name where user = $user";
    $results =  $wpdb->get_results($queryStr);
    for($i = 0; $i < count($results) ; $i++){
        $gt += ($results[$i]->qty * $results[$i]->price);    
    }
    return  $gt;

}

function removeCartById($arrData){
    // wpdb::delete( 'table', array( 'ID' => 1 ), array( '%d' ) )
    global $wpdb;
    $id = $arrData['id'];
    $table_name = $wpdb->prefix.'carts';
    $result = $wpdb->delete($table_name,
              array('id' => $id),
              array('%d')  
    );
    return cartsHtml();
}


function cartTotalPerRow($id){
    global $wpdb;
    $table_name = $wpdb->prefix.'carts';
    $queryStr = "SELECT * from $table_name where id = $id";
    $results =  $wpdb->get_results($queryStr);
    return  $results[0]->qty * $results[0]->price;

}


function isLogin(){
    if($_SESSION['posuser']){
        return true;
    }else{
        return false;
    }
}

function getLoginInfo($id){
    global $wpdb;
    $table_name = $wpdb->prefix.'posuser';
    $queryStr = 'SELECT * from ' . $table_name . ' WHERE id = ' . $id;
    $myrows = $wpdb->get_results($queryStr);
    return json_decode($myrows[0]->data);
}

function getCatLink($id){

    return get_home_url() . '/store/?cat=' . $id;

}

function loadMore($arrData){
    session_start();
    $url_build = $arrData['next'] . '&api_token=' . api_token;
    $response = wp_remote_get( esc_url_raw( $url_build ) );
    $api_response = json_decode( wp_remote_retrieve_body( $response ));
    ob_start();
    require get_template_directory() . '/reuse/productlist.php';
    $html = ob_get_clean();
    $next = $api_response->results->next_page_url;
    return array('html' => $html, 'next' => $next);
}

function cartsHtml(){
    ob_start(); ?>
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

        <div class="center padding5"><button id="checkout"><?php echo _e('CHECKOUT'); ?></button></div>

        <div class="center">
                        <div class="lds-ripple" style="display: none;"><div></div><div></div></div>
        </div>

    <?php

    $result = array('carts' => countCarts(),'html' => ob_get_clean());

    return $result;

}

function clearCarts(){
    session_start();
    global $wpdb;
    $table_name = $wpdb->prefix.'carts';
    $result = $wpdb->delete($table_name,
              array('user' => $_SESSION['posuser']),
              array('%d')  
    );

}


function checkout(){
    session_start();
    $api_url = api_url . '/quotation/storeapi' . '?api_token=' . api_token;
    $cm_id = $_SESSION['posuser'];
   
    $pd_id = array();
    $description_title = array();
    $subsize = array();
    $subcolor = array();
    $subqty = array();
    $subunit = array();
    $unitprice = array();
    $mt_string = array();
    $mt_zero = array();
    $mt_false = array();
    
    $carts = getCartObject();
    for( $i = 0; $i < count($carts) ; $i++){   
       $pd_id[$i] = $carts[$i]->proid;
       $description_title[$i] = $carts[$i]->name;
       $subsize[$i] = ($carts[$i]->size) ? $carts[$i]->size : '0';
       $subcolor[$i] = ($carts[$i]->color) ? $carts[$i]->color : '0';
       $subqty[$i] = $carts[$i]->qty;
       $subunit[$i] = $carts[$i]->unitid;
       $unitprice[$i] = $carts[$i]->price;
       $mt_string[$i] = "";
       $mt_zero[$i] = 0;
       $mt_false[$i] = 'false';
    }
   
    $pd_id[count($carts)] = '0';
   
   
   
    $data = [
   
        'cm_id' => $cm_id,
        'branch_id' =>1 ,
        'title' => 'General sale order',
        'stage' => 1,
        'inv_date' => date("Y-m-d"),
        'due_date' => date('Y-m-d', strtotime("+30 days")),
        'fter_note' => '',
        'sale_id' => 1,
        'mainvat' => 0,
        'maindiscount' => 0,
        'inv_cycle' => 1,
        'trash' => 'no',
        'add_date' => date("Y-m-d"),
        'blongto' => 1,
       
   
   
        'subpd_id' => $pd_id,
        'description' => $description_title,
        'subsize' => $subsize,
        'subcolor' => $subcolor,
        'subqty' => $subqty,
        'subunit' => $subunit,
        'unitprice' => $unitprice,
        'subdiscount' => $mt_zero,
        'subvat' => $mt_string,
        'cycle' => $mt_false,
        'ordering' =>$mt_zero,
        'subnote' => $mt_string,
        'costdetail'=> $mt_zero,
        
   
        
    ];
    
    $data_string = json_encode($data); 
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => $api_url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => $data_string,
        CURLOPT_HTTPHEADER => array(
            "Cache-Control: no-cache",
            "Content-Type: application/json",
        ),
    ));
    
    $response = curl_exec($curl);
    $result = json_decode($response);
    $err = curl_error($curl);
    curl_close($curl);

    if($result->act){
        clearCarts();
    }

    return $result;
   
}

