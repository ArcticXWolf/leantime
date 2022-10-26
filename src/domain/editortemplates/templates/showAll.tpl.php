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
                        <td data-order="<?= $this->e($row['title']); ?>"><?= $this->e($row['title']); ?></td>
                        <td data-order="<?= $this->e($row['description']); ?>"><?= $this->e($row['description']); ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>