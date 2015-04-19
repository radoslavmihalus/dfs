<?php
/**
 * Nette Forms & Bootstap 3 rendering example.
 */
if (@!include __DIR__ . '/nette/Nette/loader.php') {
    die('Install packages using `composer update --dev`');
}

session_start();

use Nette\Forms\Form,
    Nette\Forms\Controls,
    Tracy\Debugger,
    Tracy\Dumper;

include __DIR__ . '/functions/translator.php';

Debugger::enable();

$latte = new Latte\Engine;
$latte->setTempDirectory('tmp');

$translator = new DFSTranslator();

$latte->addFilter('translate', $translator === NULL ? NULL : array($translator, 'translate'));

$countries = array(
    'Buranda',
    'Qumran',
    'Saint Georges Island',
    'other',
);


if ($_SESSION['is_logged_in'])
    $latte->render('templates/main.latte.php', $countries);
else
    $latte->render('templates/home.latte.php', $countries);
?>
<script id="template-upload" type="text/x-tmpl">
    {% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-upload fade">
    <td>
    <span class="preview"></span>
    </td>
    <td>
    <p class="name">{%=file.name%}</p>
    <strong class="error text-danger"></strong>
    </td>
    <td>
    <p class="size">Processing...</p>
    <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"><div class="progress-bar progress-bar-success" style="width:0%;"></div></div>
    </td>
    <td>
    {% if (!i && !o.options.autoUpload) { %}
    <button class="btn btn-primary start" disabled>
    <i class="glyphicon glyphicon-upload"></i>
    <span>Start</span>
    </button>
    {% } %}
    {% if (!i) { %}
    <button class="btn btn-warning cancel">
    <i class="glyphicon glyphicon-ban-circle"></i>
    <span>Cancel</span>
    </button>
    {% } %}
    </td>
    </tr>
    {% } %}
</script>
</body>
</html>
