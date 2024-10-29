<?php if($_POST['bbssave_setting']) :
		extract($_POST);
		update_option('bbsbanner_width', $bbsbanner_width);
		update_option('bbsbanner_height', $bbsbanner_height);
		update_option('bbsbutton_width', $bbsbutton_width);
		update_option('bbsbutton_height', $bbsbutton_height);
		update_option('bbsbutton_margin', $bbsbutton_margin);
		update_option('bbsauto_start', $bbsauto_start);
		update_option('bbsdelay', $bbsdelay);
		update_option('bbstransition', $bbstransition);
		update_option('bbstransition_speed', $bbstransition_speed);
		update_option('bbsblock_size', $bbsblock_size);
		update_option('bbstimer_align', $bbstimer_align);
		update_option('bbsdisplay_thumbs', $bbsdisplay_thumbs);
		update_option('bbsdisplay_dbuttons', $bbsdisplay_dbuttons);
		update_option('bbsdisplay_playbutton', $bbsdisplay_playbutton);
		update_option('bbsdisplay_numbers', $bbsdisplay_numbers);
		update_option('bbsdisplay_timer', $bbsdisplay_timer);
		update_option('bbsmouseover_pause', $bbsmouseover_pause);
		update_option('bbstext_mouseover', $bbstext_mouseover);
		update_option('bbstext_effect', $bbstext_effect);
		update_option('bbsshuffle', $bbsshuffle);
		$msg = "Settings saved successfully.";
	endif; ?>

<div id="bbs_list_banner">
<div class="wrap">
<div class="bbs_32x32"></div>
<h2><?php echo __( 'Settings', 'bbs' ); ?></h2><br />
<?php //if(isset($msg)) : echo $msg; endif; ?>

<form name="bbs_settings" action="?page=B-Banner-Slider/settings.php" method="post">
<table class="form-table">
<tbody>
<tr valign="top">
    <th scope="row"><label>Banner Width</label></th>
    <td><input type="text" value="<?php echo get_option('bbsbanner_width'); ?>" name="bbsbanner_width" /><span class="description">Please Specify Banner Width.</span></td>
</tr>
<tr valign="top">
    <th scope="row"><label>Banner Height</label></th>
    <td><input type="text" value="<?php echo get_option('bbsbanner_height'); ?>" name="bbsbanner_height" /><span class="description">Please Specify Banner Height.</span></td>
</tr>
<tr valign="top">
    <th scope="row"><label>Button Width</label></th>
    <td><input type="text" value="<?php echo get_option('bbsbutton_width'); ?>" name="bbsbutton_width" /></td>
</tr>
<tr valign="top">
    <th scope="row"><label>Button Height</label></th>
    <td><input type="text" value="<?php echo get_option('bbsbutton_height'); ?>" name="bbsbutton_height" /></td>
</tr>
<tr valign="top">
    <th scope="row"><label>Button Margin</label></th>
    <td><input type="text" value="<?php echo get_option('bbsbutton_margin'); ?>" name="bbsbutton_margin" /></td>
</tr>
<tr valign="top">
    <th scope="row"><label>Auto Start</label></th>
    <td><select name="bbsauto_start">
<?php 
$option = array('true'=>'True', 'false'=>'False');
foreach($option as  $val=>$op) :
	if($val == get_option('bbsauto_start')){
        $selected = "selected='selected'";
    }else{
    	$selected = "";
    }
	echo '<option value="'.$val.'" '.$selected.'>'.$op.'</option>';
endforeach;
?>
</select></td>
</tr>

<tr valign="top">
    <th scope="row"><label>Delay</label></th>
    <td><input type="text" value="<?php echo get_option('bbsdelay'); ?>" name="bbsdelay" /></td>
</tr>
<tr valign="top">
    <th scope="row"><label>Transition</label></th>
    <td><?php $option = array('none'=>'none', 'fade'=>'fade', 'random'=>'random', 'block.top'=>'block.top', 'block.bottom'=>'block.bottom', 'block.left'=>'block.left', 'block.right'=>'block.right', 'diag.fade'=>'diag.fade', 'diag.exp'=>'diag.exp', 'rev.diag.fade'=>'rev.diag.fade', 'rev.diag.exp'=>'rev.diag.exp', 'block.fade'=>'block.fade', 'block.exp'=>'block.exp', 'block.drop'=>'block.drop', 'block.top.zz'=>'block.top.zz', 'block.bottom.zz'=>'block.bottom.zz', 'block.left.zz'=>'block.left.zz', 'block.right.zz'=>'block.right.zz', 'spiral.in'=>'spiral.in', 'spiral.out'=>'spiral.out', 'vert.random.fade'=>'vert.random.fade', 'vert.tl'=>'vert.tl', 'vert.tr'=>'vert.tr', 'vert.bl'=>'vert.bl', 'vert.br'=> 'vert.br', 'fade.left'=> 'fade.left', 'fade.right'=>'fade.right', 'alt.left'=>'alt.left', 'alt.right'=>'alt.right', 'blinds.left'=>'blinds.left', 'blinds.right'=>'blinds.right', 'horz.random.fade'=>'horz.random.fade', 'horz.tl'=>'horz.tl', 'horz.tr'=>'horz.tr', 'horz.bl'=>'horz.bl', 'horz.br'=>'horz.br', 'fade.top'=>'fade.top', 'fade.bottom'=>'fade.bottom', 'alt.top'=>'alt.top', 'alt.bottom'=>'alt.bottom', 'blinds.top'=>'blinds.top', 'blinds.bottom'=>'blinds.bottom');
echo '<select name="bbstransition">';
foreach($option as $val=>$op) :
	if($val == get_option('bbstransition')){
        $selected = "selected='selected'";
    }else{
    	$selected = "";
    }
	echo '<option value="'.$val.'" '.$selected.'>'.$op.'</option>';
endforeach;
echo '</select>';
?><span class="description">Select effect you want to apply in banner during slideshow.</span></td>
</tr>
<tr valign="top">
    <th scope="row"><label>Transition Speed</label></th>
    <td><input type="text" value="<?php echo get_option('bbstransition_speed'); ?>" name="bbstransition_speed" /><span class="description">In milliseconds.</span></td>
</tr>
<tr valign="top">
    <th scope="row"><label>Block Size</label></th>
    <td><input type="text" value="<?php echo get_option('bbsblock_size'); ?>" name="bbsblock_size" /></td>
</tr>
<tr valign="top">
    <th scope="row"><label>Timer Align</label></th>
    <td><select name="bbstimer_align">
<?php 
$option = array('top'=>'Top', 'right'=>'Right', 'bottom'=>'Bottom', 'left'=>'Left');
foreach($option as $val=>$op) :
	if($val == get_option('bbstimer_align')){
        $selected = "selected='selected'";
    }else{
    	$selected = "";
    }
	echo '<option value="'.$val.'" '.$selected.'>'.$op.'</option>';
endforeach;
?>
</select><span class="description">Set Timer Position Top, Right, Bottom, Left.</span></td>
</tr>
<tr valign="top">
    <th scope="row"><label>Display Thumbs</label></th>
    <td><select name="bbsdisplay_thumbs">
<?php 
$option = array('true'=>'True', 'false'=>'False');
foreach($option as $val=>$op) :
	if($val == get_option('bbsdisplay_thumbs')){
        $selected = "selected='selected'";
    }else{
    	$selected = "";
    }
	echo '<option value="'.$val.'" '.$selected.'>'.$op.'</option>';
endforeach;
?>
</select></td>
</tr>
<tr valign="top">
    <th scope="row"><label>Display DButtons</label></th>
    <td><select name="bbsdisplay_dbuttons">
<?php 
$option = array('true'=>'True', 'false'=>'False');
foreach($option as $val=>$op) :
	if($val == get_option('bbsdisplay_dbuttons')){
        $selected = "selected='selected'";
    }else{
    	$selected = "";
    }
	echo '<option value="'.$val.'" '.$selected.'>'.$op.'</option>';
endforeach;
?>
</select></td>
</tr>

<tr valign="top">
    <th scope="row"><label>Display Playbutton</label></th>
    <td><select name="bbsdisplay_playbutton">
<?php 
$option = array('true'=>'True', 'false'=>'False');
foreach($option as $val=>$op) :
	if($val == get_option('bbsdisplay_playbutton')){
        $selected = "selected='selected'";
    }else{
    	$selected = "";
    }
	echo '<option value="'.$val.'" '.$selected.'>'.$op.'</option>';
endforeach;
?>
</select></td>
</tr>
<tr valign="top">
    <th scope="row"><label>Display Numbers</label></th>
    <td><select name="bbsdisplay_numbers">
<?php 
$option = array('true'=>'True', 'false'=>'False');
foreach($option as  $val=>$op) :
	if($val == get_option('bbsdisplay_numbers')){
        $selected = "selected='selected'";
    }else{
    	$selected = "";
    }
	echo '<option value="'.$val.'" '.$selected.'>'.$op.'</option>';
endforeach;
?>
</select></td>
</tr>
<tr valign="top">
    <th scope="row"><label>Display Timer</label></th>
    <td><select name="bbsdisplay_timer">
<?php 
$option = array('true'=>'True', 'false'=>'False');
foreach($option as  $val=>$op) :
	if($val == get_option('bbsdisplay_timer')){
        $selected = "selected='selected'";
    }else{
    	$selected = "";
    }
	echo '<option value="'.$val.'" '.$selected.'>'.$op.'</option>';
endforeach;
?>
</select></td>
</tr>
<tr valign="top">
    <th scope="row"><label>Mouseover Pause</label></th>
    <td><select name="bbsmouseover_pause">
<?php 
$option = array('true'=>'True', 'false'=>'False');
foreach($option as  $val=>$op) :
	if($val == get_option('bbsmouseover_pause')){
        $selected = "selected='selected'";
    }else{
    	$selected = "";
    }
	echo '<option value="'.$val.'" '.$selected.'>'.$op.'</option>';
endforeach;
?>
</select></td>
</tr>
<tr valign="top">
    <th scope="row"><label>Text Mouseover</label></th>
    <td><select name="bbstext_mouseover">
<?php 
$option = array('true'=>'True', 'false'=>'False');
foreach($option as  $val=>$op) :
	if($val == get_option('bbstext_mouseover')){
        $selected = "selected='selected'";
    }else{
    	$selected = "";
    }
	echo '<option value="'.$val.'" '.$selected.'>'.$op.'</option>';
endforeach;
?>
</select></td>
</tr>

<tr valign="top">
    <th scope="row"><label>Text Effect</label></th>
    <td><input type="text" name="bbstext_effect" value="<?php echo get_option('bbstext_effect'); ?>"></td>
</tr>
<tr valign="top">
    <th scope="row"><label>Shuffle</label></th>
    <td><select name="bbsshuffle"><?php 
$option = array('true'=>'True', 'false'=>'False');
foreach($option as  $val=>$op) :
	if($val == get_option('bbsshuffle')){
        $selected = "selected='selected'";
    }else{
    	$selected = "";
    }
	echo '<option value="'.$val.'" '.$selected.'>'.$op.'</option>';
endforeach;
?></select></td>
</tr>
<tr><th></th><td align="left"><input type="submit" name="bbssave_setting" class="button-primary" value="Save" /></td></tr>

</tbody>
</table>
</form>
</div>
</div>