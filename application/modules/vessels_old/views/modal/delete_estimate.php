<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header"> <button type="button" class="close" data-dismiss="modal">&times;</button> 
		<h4 class="modal-title"><?=lang('delete_estimate')?> EST #<?=$estimate_ref?></h4>
		</div><?php
			echo form_open(base_url().'estimates/action/delete'); ?>
		<div class="modal-body">
			<p><?=lang('delete_estimate_warning')?></p>
			
			<input type="hidden" name="estimate" value="<?=$estimate?>">

		</div>
		<div class="modal-footer"> <a href="#" class="btn btn-default" data-dismiss="modal"><?=lang('close')?></a>
			<button type="submit" class="btn red"><?=lang('delete_button')?></button>
		</form>
	</div>
</div>
<!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->