<?php
// source: /var/www/html/nette/examples/CD-collection/app/presenters/templates/Dashboard/delete.latte

// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('5402893217', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block content
//
if (!function_exists($_b->blocks['content'][] = '_lbfe44d33106_content')) { function _lbfe44d33106_content($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
;call_user_func(reset($_b->blocks['title']), $_b, get_defined_vars())  ?>

<?php if ($album) { ?>
	<p>Are you sure that you want to delete ‘<?php echo Latte\Runtime\Filters::escapeHtml($album->title, ENT_NOQUOTES) ?>
’ by ‘<?php echo Latte\Runtime\Filters::escapeHtml($album->artist, ENT_NOQUOTES) ?>’?</p>
<?php $_l->tmp = $_control->getComponent("deleteForm"); if ($_l->tmp instanceof Nette\Application\UI\IRenderable) $_l->tmp->redrawControl(NULL, FALSE); $_l->tmp->render() ?>

<?php } else { ?>
	<p>Cannot find album.</p>
<?php } 
}}

//
// block title
//
if (!function_exists($_b->blocks['title'][] = '_lb9d89975102_title')) { function _lb9d89975102_title($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?><h1>Delete Album</h1>
<?php
}}

//
// end of blocks
//

// template extending

$_l->extends = empty($_g->extended) && isset($_control) && $_control instanceof Nette\Application\UI\Presenter ? $_control->findLayoutTemplateFile() : NULL; $_g->extended = TRUE;

if ($_l->extends) { ob_start();}

// prolog Nette\Bridges\ApplicationLatte\UIMacros

// snippets support
if (empty($_l->extends) && !empty($_control->snippetMode)) {
	return Nette\Bridges\ApplicationLatte\UIMacros::renderSnippets($_control, $_b, get_defined_vars());
}

//
// main template
//
?>

<?php if ($_l->extends) { ob_end_clean(); return $template->renderChildTemplate($_l->extends, get_defined_vars()); }
call_user_func(reset($_b->blocks['content']), $_b, get_defined_vars()) ; 