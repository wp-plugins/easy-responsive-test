<!DOCTYPE html>
<html dir="ltr" lang="en-US" class="no-js">
<head>
    <meta charset="UTF-8">
    <title>ERT Resize</title>
    <link rel="stylesheet" href="<?php echo ERTP_ASSETS_URL.'css/global.css'; ?>">
    <link rel="stylesheet" href="<?php echo ERTP_ASSETS_URL.'css/demo.css'; ?>">
    <link rel="stylesheet" href="<?php echo ERTP_ASSETS_URL.'css/style.css'; ?>">
    <script src="<?php echo  includes_url( '/js/jquery/jquery.js' ); ?>"></script>

    <script src="<?php echo ERTP_ASSETS_URL.'js/jresize.js';?>"></script>
    <script src="<?php echo ERTP_ASSETS_URL.'js/jbar.js';?>"></script>

    <?php  $erp_sizes = get_option( 'erp_sizes', ERTP_SIZES);
    $erp_arr= explode(',', $erp_sizes);
    $final_arr=array();
    foreach($erp_arr as $erp){
        if(trim($erp)){
            $erp=explode(':', $erp);
            if(!trim($erp[1])){
                $erp[1]=trim($erp[0]);
            }
            $final_arr[].=trim($erp[0]).'-'.trim($erp[1]);
        }
    }
    $final_arr=json_encode($final_arr);
    $erp_bg_color = substr(trim(get_option( 'erp_bg_color', ERTP_BG )),1);
    $erp_fg_color= substr(trim(get_option( 'erp_fg_color',  ERTP_FG )),1);?>
    <!-- Demo Script -->
    <script>


        jQuery(document).ready(function() {
            var arr=jQuery.parseJSON('<?php echo $final_arr?>')
            jQuery.jResize({
                viewPortSizes   :arr, // ViewPort Widths
                backgroundColor : '<?php echo $erp_bg_color?>', // HEX Code
                fontColor       : '<?php echo $erp_fg_color?>' // HEX Code
            });

        });

    </script>
</head>

<body>
    <div class="viewports jbar" data-init="jbar" data-jbar='{"state"   : "open"}'>
        <ul class="viewlist"></ul>
        <div style="clear:both;"></div>
    </div>
<div id="resizer">
<iframe id="ert_frame" name="ert_frame" src="<?php echo site_url().'?ert=1';?>" style="width: 100%;height: 100%"   marginheight="0" frameborder="0" ></iframe>
</div>
<script type="text/javascript">
   jQuery('#ert_frame').load(function(){
      jQuery("#ert_frame").contents().find("#wpadminbar").hide();
     if(jQuery("#ert_frame").contents().find("#wpadminbar").length==1){
        jQuery("#ert_frame").contents().find("html").css({'position':'relative',
        'top':'-28px'});
     }
    });

</script>
</body>
</html>
