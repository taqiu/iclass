<?php $this->beginContent('//layouts/main'); ?>
<!--  <div class="container">-->
<div class="row">
	<div class="span3" >
		<?php
			foreach ($this->menu as &$item) {
				$item['label'] = $item['label'].'<i class="icon-chevron-right pull-right"></i>';
			}
			$this->beginWidget('zii.widgets.CPortlet', array(
				'title'=>'Menu',
			));
			$this->widget('zii.widgets.CMenu', array(
				'items'=>$this->menu,
				'encodeLabel' => false,
				'htmlOptions'=>array('class'=>'sidebar'),
			));
			$this->endWidget();
		?>
	</div>
	<div class="span9">
		<div id="content">
			<?php echo $content; ?>
		</div><!-- content -->
	</div>
</div>
<?php $this->endContent(); ?>