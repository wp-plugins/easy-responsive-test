<div class="erp_page_settings">
    <h1>Easy Resize Plugin Settings</h1><form name="erp_setting" id="erp_setting" method="post" action="">
        <table width="50%">
           <tr>
               <th valign="top" align="left" style="width:20%"><label class="erp_setting_label">Window Sizes</label></th>

               <td style="width:20%">
                   <textarea name="erp_sizes" cols="35 rows="25"><?php echo $erp_sizes?></textarea>
                   <br/><small>You can set both height and width, separated by : .eg. height:width. To enter multiple sizes use comma(,) separated values such as 200:100, 500:300 etc.</small>
               </td>

           </tr>
            <tr><th valign="top" align="left"><label class="erp_setting_label">Tool Bar Background Color</label></th>
            <td><input type="text" name="erp_bg_color" class="erpColorSelector" data-default-color="#444444"  value="<?php echo $erp_bg_color; ?>"></td></tr>
            <tr><th valign="top" align="left"><label class="erp_setting_label">Tool Bar Foreground Color</label></th>
            <td><input type="text" name="erp_fg_color" class="erpColorSelector" data-default-color="#ffffff" value="<?php echo $erp_fg_color; ?>"></td></tr>
            <tr><td colspan="2"  align="right"><input type="submit" name="erp_submit" value="Update Settings"></td></tr>
        </table>
        <div style="clear: both;"></div>
        <br />
        <h3 class="ertp_check_site"><a href="<?php echo get_permalink($this->erp_page_id);?>" target="_blank">Check Your Site</a><?php ?></h3>
    </form>
</div>

