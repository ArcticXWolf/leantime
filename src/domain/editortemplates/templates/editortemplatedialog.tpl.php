<?php
$currentEditortemplate = $this->get('editortemplate');
?>

<h4 class="widgettitle title-light"><i class="fa fa-rocket"></i> <?= $this->__('label.editortemplate') ?> <?php echo $currentEditortemplate->title ?></h4>

<?php echo $this->displayNotification();

$id = "";
if (isset($currentEditortemplate->id)) {
    $id = $currentEditortemplate->id;
}
?>

<form class="formModal" method="post" action="<?= BASE_URL ?>/editortemplates/edit/<?php echo $id; ?>">

    <label><?= $this->__('label.editortemplate_title') ?></label>
    <input type="text" name="title" value="<?php echo $currentEditortemplate->title ?>" placeholder="<?= $this->__('input.placeholders.editortemplate_title') ?>" /><br />

    <label><?= $this->__('label.editortemplate_description') ?></label>
    <input type="text" name="description" value="<?php echo $currentEditortemplate->description ?>" placeholder="<?= $this->__('input.placeholders.editortemplate_description') ?>" /><br />

    <label><?= $this->__('label.editortemplate_content') ?></label>
    <input type="text" name="content" value="<?php echo $currentEditortemplate->content ?>" placeholder="<?= $this->__('input.placeholders.editortemplate_content') ?>" /><br />

    <br />

    <div class="row">
        <div class="col-md-6">
            <input type="submit" value="<?= $this->__('buttons.save') ?>" />
        </div>
        <div class="col-md-6 align-right padding-top-sm">
            <?php if (isset($currentEditortemplate->id) && $currentEditortemplate->id != '') { ?>
                <a href="<?= BASE_URL ?>/editortemplates/del/<?php echo $currentEditortemplate->id; ?>" class="delete formModal editortemplateModal"><i class="fa fa-trash"></i> <?= $this->__('links.delete') ?></a>
            <?php } ?>
        </div>
    </div>

</form>