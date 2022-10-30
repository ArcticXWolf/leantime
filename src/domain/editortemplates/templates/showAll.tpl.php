<?php
defined('RESTRICTED') or die('Restricted access');
?>

<div class="pageheader">
    <div class="pageicon"><span class="fa fa-fw fa-thumb-tack"></span></div>
    <div class="pagetitle">
        <h1><?php echo $this->__("headlines.editortemplates"); ?></h1>
    </div>
</div>
<!--pageheader-->

<div class="maincontent">
    <div class="maincontentinner">

        <?php echo $this->displayNotification(); ?>
        <div class="row">
            <div class="col-md-5">
                <div class="btn-group">
                    <a href="<?= BASE_URL ?>/editortemplates/edit/" class="btn btn-primary formModal editortemplateModal"><?= $this->__("links.new_with_icon") ?></a>
                </div>
            </div>
        </div>

        <table id="allEditortemplatesTable" class="table table-bordered display" style="width:100%">
            <colgroup>
                <col class="con1">
                <col class="con0">
            </colgroup>
            <thead>
                <tr>
                    <th><?= $this->__("label.title"); ?></th>
                    <th><?= $this->__("label.description"); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($this->get('allEditortemplates') as $row) { ?>
                    <tr>
                        <td data-order="<?= $this->e($row['title']); ?>">
                            <a href="<?= BASE_URL ?>/editortemplates/edit/<?php echo $row['id']; ?>" class="formModal editortemplateModal">
                                <?= $this->e($row['title']); ?>
                            </a>
                        </td>
                        <td data-order="<?= $this->e($row['description']); ?>"><?= $this->e($row['description']); ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>