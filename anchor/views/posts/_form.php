<?php 
	echo $header;
	$values=[];
	if(isset($article) && $article){
		$values=[
			'title'=>$article->title,
			'html'=>$article->html,
			'slug'=>$article->slug,
			'description'=>$article->description,
			'status'=>$article->status,
			'category'=>$article->category,
			'comments'=>$article->comments==1,
			'css'=>$article->css,
			'js'=>$article->css,
		];
	}
	else{
		$values=[
			'title'=>null,
			'html'=>null,
			'slug'=>null,
			'description'=>null,
			'status'=>null,
			'category'=>null,
			'comments'=>0,
			'css'=>null,
			'js'=>null,
		];
	}
 ?>

<form method="post" action="<?php echo $uri;?>" enctype="multipart/form-data" novalidate>

	<input name="token" type="hidden" value="<?php echo $token; ?>">

	<fieldset class="header">
		<div class="wrap">
			<?php echo $messages; ?>

			<?php echo Form::text('title', Input::previous('title',$values['title']), array(
				'placeholder' => __('posts.title'),
				'autocomplete'=> 'off',
				'autofocus' => 'true'
			)); ?>

			<aside class="buttons">
				<?php 
					echo Form::button(__('global.save'), array(
						'type' => 'submit',
						'class' => 'btn'
					)); 
					if(isset($isEdit) && $isEdit){
						echo Html::link('admin/posts/delete/' . $article->id, __('global.delete'), array(
							'class' => 'btn delete red'
						));
					}
				?>

			</aside>
		</div>
	</fieldset>

	<fieldset class="main">
		<div class="wrap">
			<?php echo Form::textarea('html', Input::previous('html',$values['html']), array(
				'placeholder' => __('posts.content_explain')
			)); ?>

			<?php echo $editor; ?>
		</div>
	</fieldset>

	<fieldset class="meta split">
		<div class="wrap">
			<p>
				<label><?php echo __('posts.language','Language'); ?>:</label>
				<?php  echo Form::select('language',$languages); ?>
			</p>
			<p>
				<label><?php echo __('posts.slug'); ?>:</label>
				<?php echo Form::text('slug', Input::previous('slug',$values['slug'])); ?>
				<em><?php echo __('posts.slug_explain'); ?></em>
			</p>
			<p>
				<label for="description"><?php echo __('posts.description'); ?>:</label>
				<?php echo Form::textarea('description', Input::previous('description',$values['description'])); ?>
				<em><?php echo __('posts.description_explain'); ?></em>
			</p>
			<p>
				<label><?php echo __('posts.status'); ?>:</label>
				<?php echo Form::select('status', $statuses, Input::previous('status',$values['status'])); ?>
				<em><?php echo __('posts.status_explain'); ?></em>
			</p>
			<p>
				<label><?php echo __('posts.category'); ?>:</label>
				<?php echo Form::select('category', $categories, Input::previous('category',$values['category'])); ?>
				<em><?php echo __('posts.category_explain'); ?></em>
			</p>
			<p>
				<label><?php echo __('posts.allow_comments'); ?>:</label>
				<?php echo Form::checkbox('comments', 1, Input::previous('comments', $values['comments']) == 1); ?>
				<em><?php echo __('posts.allow_comments_explain'); ?></em>
			</p>
			<p>
				<label><?php echo __('posts.custom_css'); ?>:</label>
				<?php echo Form::textarea('css', Input::previous('css',$values['css'])); ?>
				<em><?php echo __('posts.custom_css_explain'); ?></em>
			</p>
			<p>
				<label for="js"><?php echo __('posts.custom_js', 'Custom JS'); ?>:</label>
				<?php echo Form::textarea('js', Input::previous('js',$values['js'])); ?>
				<em><?php echo __('posts.custom_js_explain'); ?></em>
			</p>
		
			<?php foreach($fields as $field): ?>
			<p>
				<label for="extend_<?php echo $field->key; ?>"><?php echo $field->label; ?>:</label>
				<?php echo Extend::html($field); ?>
			</p>
			<?php endforeach; ?>
		</div>
	</fieldset>
</form>
<?php 
	if(isset($isEdit) && $isEdit){
?>
	<script src="<?php echo asset('anchor/views/assets/js/slug.js'); ?>"></script>
<?php
	}
 ?>
<script src="<?php echo asset('anchor/views/assets/js/slug.js'); ?>"></script>
<script src="<?php echo asset('anchor/views/assets/js/dragdrop.js'); ?>"></script>
<script src="<?php echo asset('anchor/views/assets/js/upload-fields.js'); ?>"></script>
<script src="<?php echo asset('anchor/views/assets/js/text-resize.js'); ?>"></script>
<script src="<?php echo asset('anchor/views/assets/js/editor.js'); ?>"></script>
<script>
	$('textarea[name=html]').editor();
</script>

<?php echo $footer; ?>