<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header"> <button type="button" class="close" data-dismiss="modal">&times;</button> 
		<h4 class="modal-title"><?=lang('delete_file')?></h4>
		</div><?php
			echo form_open(base_url().'collaborator/bug_files/delete'); ?>
		<div class="modal-body">
			<p><?=lang('delete_file_warning')?></p>
			
			<input type="hidden" name="file" value="<?=$file_id?>">
			<input type="hidden" name="bug" value="<?=$bug?>">

		</div>
		<div class="modal-footer"> <a href="#" class="btn btn-default" data-dismiss="modal"><?=lang('close')?></a>
			<button type="submit" class="btn red"><?=lang('delete_button')?></button>
		</form>
	</div>
</div>
<!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->