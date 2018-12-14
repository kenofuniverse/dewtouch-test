<div class="row-fluid">
	<div class="alert alert-info">
		<h3>Migration Question</h3>
	</div>

	<div class="alert">
		<h3>Import Form</h3>
	</div>
	<?php
		echo $this->Form->create('Migrate', array('type' => 'file'));
		echo $this->Form->input('file', array('label' => 'File Upload', 'type' => 'file'));
		echo $this->Form->end('Upload', array('class' => 'btn btn-primary'));
	?>
</div>