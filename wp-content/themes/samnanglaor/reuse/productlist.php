<?php
            
            $pros = $api_response->results->data;
            
            $userType = 0;
            if(isLogin()){
                $userType = getLoginInfo($_SESSION['posuser'])->ct_id;
            } 

            for($i = 0 ; $i < count($pros) ; $i++){
                $imgobj = json_decode($pros[$i]->imginfo);
                echo '<div class="col-md-3 col-6">';
                    echo '<a href="'.getProLink($pros[$i]->id).'">';
                        echo '<div class="catbox">';
                            echo '<div class="cat-img">';
                                echo '<img src="' . filelibrary . (($imgobj->file_name) ? $imgobj->file_name : no_img) . '">';
                            echo '</div>';      
                            echo $pros[$i]->title;
                            if(isLogin()){ 

                                echo '<div class="price"> ';

                                $proR = $api_response->results->data[$i];
                                $prices = json_decode($proR->pricing,true);
                                if($prices[$i] == null){
                                    echo '$ ' . number_format(0,2);
                                }else{
                                    echo '$ ' . number_format($prices[$i],2);
                                }
                                
                                echo ' </div>' ;
                            }
                        echo '</div>';  
                    echo '</a>'; 
                echo '</div>';         
                
            }

            if(count($pros) < 1){
                echo '<div class="text-center">'; _e('No products found!'); echo '</div>';
            }
            
?>