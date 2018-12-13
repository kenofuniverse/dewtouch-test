
<div id="message1">


<?php echo $this->Form->create(
	'Type',
	array(
		'id'=>'form_type',
		'type'=>'file',
		'class'=>'',
		'method'=>'POST',
		'autocomplete'=>'off',
		'inputDefaults'=>array(
			'label'=>false,
			'div'=>false,
			'type'=>'text',
			'required'=>false
		)
	)
); ?>
	
<?php echo __("Hi, please choose a type below:")?>
<br><br>

<?php
$data = array(
	array(
		'title' => 'Type1',
		'content' => __('
			<span style="display:inline-block">
				<ul>
					<li>Description .......</li>
 					<li>Description 2</li>
				</ul>
			</span>')
	),
	array(
		'title' => 'Type2',
		'content' => __('
			<span style="display:inline-block">
				<ul>
					<li>Desc 1 .......</li>
 					<li>Desc 2</li>
				</ul>
			</span>')
	)
);
?>

<?php
$options_new = array();

foreach ($data as $index => $option) {
	$options_new[$option['title']] = '<span class="show-popover" data-id="popover_' . $index . '">' . $option['title'] . '</span><div class="custom-popover-wrapper" id="popover_' . $index . '">' . $option['content'] . '</div>';
}
?>

<?php echo $this->Form->input(
	'type',
	array(
		'legend'=>false,
		'type' => 'radio',
		'options'=>$options_new,
		'before'=>'<label class="radio line notcheck">',
		'after'=>'</label>',
		'separator'=>'</label><label class="radio line notcheck">'
	)); ?>


<?php echo $this->Form->end();?>

</div>

<style>

.custom-popover-wrapper {
	display: none;
}

.show-popover {
	color: blue;
}
.show-popover:hover{
	text-decoration: underline;
}

#message1 .radio{
	vertical-align: top;
	font-size: 13px;
	position: relative;
}

.control-label{
	font-weight: bold;
}

.wrap {
	white-space: pre-wrap;
}

</style>

<?php $this->start('script_own')?>
<script>

$(document).ready(function(){
	$(".show-popover").popover({
		container: 'body',
		content: function() {
			var dataId = $(this).data('id');
			return $('#' + dataId).html();
		},
		trigger: 'hover',
		html: true
	});
})


</script>
<?php $this->end()?>