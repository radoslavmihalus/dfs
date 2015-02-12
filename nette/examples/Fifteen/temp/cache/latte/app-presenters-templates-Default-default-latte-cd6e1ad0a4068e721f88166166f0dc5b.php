<?php
// source: /var/www/html/nette/examples/Fifteen/app/presenters/templates/Default.default.latte

// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('7418792515', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block _round
//
if (!function_exists($_b->blocks['_round'][] = '_lbccae0b729c__round')) { function _lbccae0b729c__round($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v; $_control->redrawControl('round', FALSE)
?>round #<?php echo Latte\Runtime\Filters::escapeHtml($presenter['fifteen']->round + 1, ENT_NOQUOTES) ;
}}

//
// block _flash
//
if (!function_exists($_b->blocks['_flash'][] = '_lbcc115ac0bd__flash')) { function _lbcc115ac0bd__flash($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v; $_control->redrawControl('flash', FALSE)
;if (isset($flash)) { ?><h2><?php echo Latte\Runtime\Filters::escapeHtml($flash, ENT_NOQUOTES) ?>
</h2><?php } 
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
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Fifteen - Nette Framework example</title>
	<link rel="stylesheet" media="screen" href="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>/css/style.css">
</head>

<body>
	<h1>Fifteen example &ndash; <?php if ($_l->extends) { ob_end_clean(); return $template->renderChildTemplate($_l->extends, get_defined_vars()); } ?>
<span id="<?php echo $_control->getSnippetId('round') ?>"><?php call_user_func(reset($_b->blocks['_round']), $_b, $template->getParameters()) ?>
</span></h1>

	<div id="<?php echo $_control->getSnippetId('flash') ?>"><?php call_user_func(reset($_b->blocks['_flash']), $_b, $template->getParameters()) ?>
</div>
	<p><a class="ajax" href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("fifteen:shuffle!"), ENT_COMPAT) ?>
">Shuffle!</a></p>

<?php $_l->tmp = $_control->getComponent("fifteen"); if ($_l->tmp instanceof Nette\Application\UI\IRenderable) $_l->tmp->redrawControl(NULL, FALSE); $_l->tmp->render() ?>

	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8/jquery.min.js" type="text/javascript"></script>
	<script src="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>/js/fifteen.js" type="text/javascript"></script>
	<script src="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>/js/jquery.nette.js" type="text/javascript"></script>
</body>
</html>
