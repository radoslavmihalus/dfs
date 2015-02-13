<?php
// source: /var/www/html/nette/examples/Fifteen/app/components/FifteenControl.latte

// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('5628256262', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block _
//
if (!function_exists($_b->blocks['_'][] = '_lbd7046d6c8d__')) { function _lbd7046d6c8d__($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v; $_control->redrawControl(false, FALSE)
?><table class="fifteen">
<?php for ($y = $width - 1; $y >= 0; $y--) { ?><tr>
<?php for ($x = $width - 1; $x >= 0; $x--) { ?>	<td>
<?php if ($_l->ifs[] = ($clickable = $control->isClickable($x, $y, $rel))) { ?>		<a class="ajax" rel="<?php echo Latte\Runtime\Filters::escapeHtml($rel, ENT_COMPAT) ?>
" href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Click", array($x, $y)), ENT_COMPAT) ?>
">
<?php } ?>
			<img src="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>
/images/game<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($order[$x + $y * $width]), ENT_COMPAT) ?>
.jpg" width="100" height="100" alt="<?php echo Latte\Runtime\Filters::escapeHtml($order[$x + $y * $width]+1, ENT_COMPAT) ?>">
<?php if (array_pop($_l->ifs)) { ?>		</a>
<?php } ?>
	</td>
<?php } ?>
</tr>
<?php } ?>
</table>

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

<?php if ($_l->extends) { ob_end_clean(); return $template->renderChildTemplate($_l->extends, get_defined_vars()); } ?>
<div id="<?php echo $_control->getSnippetId('') ?>"><?php call_user_func(reset($_b->blocks['_']), $_b, $template->getParameters()) ?>
</div>