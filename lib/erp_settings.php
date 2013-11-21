<div class="erp_page_settings">
    <h1>Easy Resize Plugin Settings</h1><form name="erp_setting" id="erp_setting" method="post" action="">
        <table>
           <tr><th valign="top" align="left"><label class="erp_setting_label">Window Sizes</label></th>
           <td><textarea name="erp_sizes"><?php echo $erp_sizes?></textarea>
            <br/><small>Enter sizes with comma(,) separation</small></td></tr>
            <tr><th valign="top" align="left"><label class="erp_setting_label">Tool Bar Background Color</label></th>
            <td><input type="text" name="erp_bg_color" class="erpColorSelector" data-default-color="#444444"  value="<?php echo $erp_bg_color; ?>"></td></tr>
            <tr><th valign="top" align="left"><label class="erp_setting_label">Tool Bar Foreground Color</label></th>
            <td><input type="text" name="erp_fg_color" class="erpColorSelector" data-default-color="#ffffff" value="<?php echo $erp_fg_color; ?>"></td></tr>
            <tr><td colspan="2"  align="right"><input type="submit" name="erp_submit" value="Update Settings"></td></tr>
        </table>
        <div style="clear: both;"></div>
        <br />
        <h3 class="ertp_check_site"><a href="<?php echo get_permalink($this->erp_page_id);?>" target="_blank">Check Your Site<?php ?></h3>
    </form>
</div>
