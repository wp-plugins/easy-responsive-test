<!DOCTYPE html>
<html dir="ltr" lang="en-US" class="no-js">
<head>
    <meta charset="UTF-8">
    <title>ERT Resize</title>
    <link rel="stylesheet" href="<?php echo ERTP_ASSETS_URL.'css/global.css'; ?>">
        <script src="<?php echo  includes_url( '/js/jquery/jquery.js' ); ?>"></script>
        <script src="<?php echo ERTP_ASSETS_URL.'js/jresize.js';?>"></script>
        <?php  $erp_sizes = get_option( 'erp_sizes', ERTP_SIZES);
        $erp_arr= explode(',', $erp_sizes);
        $final_arr=array();
        foreach($erp_arr as $erp){
            $final_arr[].=trim($erp).'px';
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

    <iframe src="<?php echo site_url();?>" style="width:100%;display:block;border:0;height:1000px;"></iframe>

    </body>

    </html>