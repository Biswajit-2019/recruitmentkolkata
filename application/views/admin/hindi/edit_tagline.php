
<?php echo form_open_multipart('admin/hindi/tagline/edit');


?>
<table  class="formRight ckedit" id="tableForm">

<tr><th colspan="2" class="add-menu"> Edit Tagline</th>

</tr>

<input type="hidden" name="id" value="<?php echo $single[0]->id; ?>">
<tr>
<td width="61" align="right"><label>Tagline :</label></td>
<td width="240">
<textarea name="metadesc" cols="100">
	<?php echo  $single[0]->tagline_text; ?>

</textarea>

</td>
</tr>

<tr>

<td align="right">&nbsp;</td>

<td><input type="submit" name="edit_page" value="Edit Tagline" class="add_menu"></td>

</tr>



</table>
</form>






