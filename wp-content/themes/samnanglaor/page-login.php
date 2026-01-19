<?php get_header(); ?>

    <div class="center box-styler">
        <div class="login-box">
            <div class="center"><h3><?php _e('Login'); ?></h3></div>   
            
                <input type="text" class="form-control" placeholder="username" name="uname" id="uname">
                <input type="password" class="form-control" placeholder="password" name="pwd" id="upass">
                <button id="signin" class="btn btn-primary"><i class="fas fa-key"></i> Login</button>
                <div class="center">
                     <div class="lds-ripple" style="display: none;"><div></div><div></div></div>
                </div>

          
        </div>
    </div>



<script>

x('#signin').addEventListener('click',function(){
    var ajaxurl = jQuery('#page').attr('ajax'); var event = this;
    beforeRequest(event);
    jQuery.ajax({ url : ajaxurl, type : 'post', dataType : 'json',
    data : {  action: 'main_ajax', funct: 'posLogin',
              arrData: {
                             user: x('#uname').value,
                             password: x('#upass').value
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
    
    if(data === null){
        x('.alertTitle').innerText = "Incorrect information";
        x('.toast-body').innerText = 'Please, check username and password, then try again';
        $(".toast").toast({ delay: 3000 });
        $(".toast").toast('show');
        
    }else{
        if(data == false){
            x('.alertTitle').innerText = "Incorrect information";
            x('.toast-body').innerText = 'Please, check username and password, then try again';
            $(".toast").toast({ delay: 3000 });
            $(".toast").toast('show');
        } else{
            window.location.replace(x('.header').getAttribute('home'));
        }   
    }
    console.log(data);
    event.style.display = 'initial';
    x('.lds-ripple').style.display = 'none';
}

</script>


<?php get_footer(); ?>