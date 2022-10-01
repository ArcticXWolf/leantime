<?php

defined('RESTRICTED') or die('Restricted access');
$searchCriteria = $this->get("searchCriteria");

$todoTypeIcons  = $this->get("ticketTypeIcons");

$efforts        = $this->get('efforts');
$priorities     = $this->get('priorities');
$statusLabels   = $this->get('allTicketStates');

//All states >0 (<1 is archive)
$numberofColumns = count($this->get('allTicketStates')) - 1;
$size = floor(100 / $numberofColumns);

?>

<div class="pageheader">
    <div class="pageicon"><span class="<?php echo $this->getModulePicture() ?>"></span></div>
    <div class="pagetitle">
        <h5><?php $this->e($_SESSION['currentProjectClient'] . " // " . $_SESSION['currentProjectName']); ?></h5>
        <h1><?php echo $this->__("headlines.todos"); ?></h1>
    </div>
</div>
<!--pageheader-->

<div class="maincontent">
    <div class="maincontentinner">

        <?php echo $this->displayNotification(); ?>

        <form action="" method="get" id="ticketSearch">
            <input type="hidden" value="1" name="search" />
            <div class="row">
                <div class="col-md-5">
                    <div class="pull-right">

                        <div id="tableButtons" style="display:inline-block"></div>
                        <a onclick="leantime.ticketsController.toggleFilterBar();" class="btn btn-default"><?= $this->__("links.filter") ?></a>
                        <div class="btn-group viewDropDown">

                            <button class="btn dropdown-toggle" type="button" data-toggle="dropdown"><?= $this->__("links.group_by") ?></button>
                            <ul class="dropdown-menu">
                                <li><span class="radio"><input type="radio" name="groupBy" <?php if ($searchCriteria["groupBy"] == "") {
                                                                                                echo "checked='checked'";
                                                                                            } ?> value="" id="groupByNothingLink" onclick="jQuery('#ticketSearch').submit();" /><label for="groupByNothingLink"><?= $this->__("label.no_group") ?></label></span></li>
                                <li><span class="radio"><input type="radio" name="groupBy" <?php if ($searchCriteria["groupBy"] == "status") {
                                                                                                echo "checked='checked'";
                                                                                            } ?> value="status" id="groupByStatusLink" onclick="jQuery('#ticketSearch').submit();" /><label for="groupByStatusLink"><?= $this->__("label.todo_status") ?></label></span></li>
                                <li><span class="radio"><input type="radio" name="groupBy" <?php if ($searchCriteria["groupBy"] == "user") {
                                                                                                echo "checked='checked'";
                                                                                            } ?> value="user" id="groupByUserLink" onclick="jQuery('#ticketSearch').submit();" /><label for="groupByUserLink"><?= $this->__("label.user") ?></label></span></li>
                            </ul>

                        </div>
                    </div>
                </div>

            </div>

            <div class="clearfix"></div>
            <div class="filterBar <?php if (!isset($_GET['search'])) {
                                        echo "hideOnLoad";
                                    } ?>">

                <div class="row-fluid">


                    <div class="filterBoxLeft">
                        <label class="inline"><?= $this->__("label.user") ?></label>
                        <div class="form-group">
                            <select data-placeholder="<?= $this->__("input.placeholders.filter_by_user") ?>" title="<?= $this->__("input.placeholders.filter_by_user") ?>" name="users" multiple="multiple" class="user-select" id="userSelect">
                                <option value=""></option>
                                <?php foreach ($this->get('users') as $userRow) {     ?>

                                    <?php echo "<option value='" . $userRow["id"] . "'";

                                    if ($searchCriteria['users'] !== false && $searchCriteria['users'] !== null && array_search($userRow["id"], explode(",", $searchCriteria['users'])) !== false) echo " selected='selected' ";

                                    echo ">" . sprintf($this->__('text.full_name'), $this->escape($userRow['firstname']), $this->escape($userRow['lastname'])) . "</option>"; ?>

                                <?php }     ?>
                            </select>
                        </div>

                    </div>

                    <div class="filterBoxLeft">

                        <label class="inline"><?= $this->__("label.todo_type") ?></label>
                        <div class="form-group">
                            <select data-placeholder="<?= $this->__("input.placeholders.filter_by_type") ?>" title="<?= $this->__("input.placeholders.filter_by_type") ?>" name="type" id="typeSelect">
                                <option value=""><?= $this->__("label.all_types") ?></option>
                                <?php foreach ($this->get('types') as $type) {     ?>

                                    <?php echo "<option value='" . $type . "'";

                                    if (isset($searchCriteria['type']) && ($searchCriteria['type'] == $type)) echo " selected='selected' ";

                                    echo ">$type</option>"; ?>

                                <?php }     ?>
                            </select>
                        </div>

                    </div>

                    <div class="filterBoxLeft">

                        <label class="inline"><?= $this->__("label.todo_priority") ?></label>
                        <div class="form-group">
                            <select data-placeholder="<?= $this->__("input.placeholders.filter_by_priority") ?>" title="<?= $this->__("input.placeholders.filter_by_priority") ?>" name="type" id="prioritySelect">
                                <option value=""><?= $this->__("label.all_priorities") ?></option>
                                <?php foreach ($this->get('priorities') as $priorityKey => $priorityValue) {     ?>

                                    <?php echo "<option value='" . $priorityKey . "'";

                                    if (isset($searchCriteria['priority']) && ($searchCriteria['priority'] == $priorityKey)) echo " selected='selected' ";

                                    echo ">$priorityValue</option>"; ?>

                                <?php }     ?>
                            </select>
                        </div>
                    </div>


                    <div class="filterBoxLeft">
                        <label class="inline"><?= $this->__("label.todo_status") ?></label>
                        <div class="form-group">

                            <select data-placeholder="<?= $this->__("input.placeholders.filter_by_status") ?>" name="searchStatus" multiple="multiple" class="status-select" id="statusSelect">
                                <option value=""></option>
                                <option value="not_done" <?php if ($searchCriteria['status'] !== false && strpos($searchCriteria['status'], 'not_done') !== false) echo " selected='selected' "; ?>><?= $this->__("label.not_done") ?></option>
                                <?php foreach ($statusLabels as $key => $label) { ?>

                                    <?php echo "<option value='" . $key . "'";

                                    if ($searchCriteria['status'] !== false && array_search((string) $key, explode(",", $searchCriteria['status'])) !== false) echo " selected='selected' ";
                                    echo ">" . $this->escape($label["name"]) . "</option>"; ?>

                                <?php }     ?>
                            </select>
                        </div>

                    </div>

                    <div class="filterBoxLeft">
                        <label class="inline"><?= $this->__("label.search_term") ?></label><br />
                        <input type="text" class="form-control input-default" id="termInput" name="term" placeholder="<?= $this->__("input.placeholders.search") ?>" value="<?php $this->e($searchCriteria['term']); ?>">
                        <input type="submit" value="<?= $this->__("buttons.search") ?>" name="search" class="form-control btn btn-primary" />
                    </div>


                </div>

            </div>
        </form>

        <table id="allTicketsTable" class="table table-bordered display" style="width:100%">
            <colgroup>
                <col class="con1">
                <col class="con0">
                <col class="con1">
                <col class="con0">
                <col class="con1">
                <col class="con0">
                <col class="con1">
                <col class="con0">
                <col class="con1">
                <col class="con0">
                <col class="con1">
            </colgroup>
            <thead>
                <tr>
                    <th><?= $this->__("label.project"); ?></th>
                    <th><?= $this->__("label.title"); ?></th>
                    <th class="status-col"><?= $this->__("label.todo_status"); ?></th>
                    <th><?= $this->__("label.effort"); ?></th>
                    <th><?= $this->__("label.priority"); ?></th>
                    <th class="user-col"><?= $this->__("label.editor"); ?>.</th>
                    <th class="duedate-col"><?= $this->__("label.due_date"); ?></th>
                    <th class="planned-hours-col"><?= $this->__("label.planned_hours"); ?></th>
                    <th class="remaining-hours-col"><?= $this->__("label.estimated_hours_remaining"); ?></th>
                    <th class="booked-hours-col"><?= $this->__("label.booked_hours"); ?></th>

                </tr>
            </thead>
            <tbody>
                <?php foreach ($this->get('allTickets') as $row) { ?>
                    <tr>
                        <td data-order="<?= $this->e($row['headline']); ?>"><a class='ticketModal' href="<?= BASE_URL ?>/tickets/showTicket/<?= $this->e($row['id']); ?>"><?= $this->e($row['projectName']); ?></a></td>
                        <td data-order="<?= $this->e($row['headline']); ?>"><a class='ticketModal' href="<?= BASE_URL ?>/tickets/showTicket/<?= $this->e($row['id']); ?>"><?= $this->e($row['headline']); ?></a></td>
                        <td data-order="<?= $statusLabels[$row['status']]["name"] ?>">
                            <div class="dropdown ticketDropdown statusDropdown colorized show">
                                <a class="dropdown-toggle f-left status <?= $statusLabels[$row['status']]["class"] ?>" href="javascript:void(0);" role="button" id="statusDropdownMenuLink<?= $row['id'] ?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="text">
                                        <?php echo $statusLabels[$row['status']]["name"]; ?>
                                    </span>
                                    &nbsp;<i class="fa fa-caret-down" aria-hidden="true"></i>
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="statusDropdownMenuLink<?= $row['id'] ?>">
                                    <li class="nav-header border"><?= $this->__("dropdown.choose_status") ?></li>
                                    <?php foreach ($statusLabels as $key => $label) {
                                        echo "<li class='dropdown-item'>
                                            <a href='javascript:void(0);' class='" . $label["class"] . "' data-label='" . $this->escape($label["name"]) . "' data-value='" . $row['id'] . "_" . $key . "_" . $label["class"] . "' id='ticketStatusChange" . $row['id'] . $key . "' >" . $this->escape($label["name"]) . "</a>";
                                        echo "</li>";
                                    } ?>
                                </ul>
                            </div>
                        </td>
                        <td data-order="<?= $row['storypoints'] ? $efforts[$row['storypoints']] : $this->__("label.story_points_unkown"); ?>">
                            <div class="dropdown ticketDropdown effortDropdown show">
                                <a class="dropdown-toggle f-left  label-default effort" href="javascript:void(0);" role="button" id="effortDropdownMenuLink<?= $row['id'] ?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="text"><?php
                                                        if ($row['storypoints'] != '' && $row['storypoints'] > 0) {
                                                            echo $efforts[$row['storypoints']];
                                                        } else {
                                                            echo $this->__("label.story_points_unkown");
                                                        } ?>
                                    </span>
                                    &nbsp;<i class="fa fa-caret-down" aria-hidden="true"></i>
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="effortDropdownMenuLink<?= $row['id'] ?>">
                                    <li class="nav-header border"><?= $this->__("dropdown.how_big_todo") ?></li>
                                    <?php foreach ($efforts as $effortKey => $effortValue) {
                                        echo "<li class='dropdown-item'>
                                                                        <a href='javascript:void(0);' data-value='" . $row['id'] . "_" . $effortKey . "' id='ticketEffortChange" . $row['id'] . $effortKey . "'>" . $effortValue . "</a>";
                                        echo "</li>";
                                    } ?>
                                </ul>
                            </div>
                        </td>
                        <td data-order="<?= $row['priority'] ? $priorities[$row['priority']] : $this->__("label.priority_unkown"); ?>">
                            <div class="dropdown ticketDropdown priorityDropdown show">
                                <a class="dropdown-toggle f-left  label-default priority" href="javascript:void(0);" role="button" id="priorityDropdownMenuLink<?= $row['id'] ?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="text"><?php
                                                        if ($row['priority'] != '' && $row['priority'] > 0) {
                                                            echo $priorities[$row['priority']];
                                                        } else {
                                                            echo $this->__("label.priority_unkown");
                                                        } ?>
                                    </span>
                                    &nbsp;<i class="fa fa-caret-down" aria-hidden="true"></i>
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="priorityDropdownMenuLink<?= $row['id'] ?>">
                                    <li class="nav-header border"><?= $this->__("dropdown.select_priority") ?></li>
                                    <?php foreach ($priorities as $priorityKey => $priorityValue) {
                                        echo "<li class='dropdown-item'>
                                                                        <a href='javascript:void(0);' data-value='" . $row['id'] . "_" . $priorityKey . "' id='ticketPriorityChange" . $row['id'] . $priorityKey . "'>" . $priorityValue . "</a>";
                                        echo "</li>";
                                    } ?>
                                </ul>
                            </div>
                        </td>
                        <td data-order="<?= $row["editorFirstname"] != "" ?  $this->escape($row["editorFirstname"]) : $this->__("dropdown.not_assigned") ?>">
                            <div class="dropdown ticketDropdown userDropdown noBg show ">
                                <a class="dropdown-toggle f-left" href="javascript:void(0);" role="button" id="userDropdownMenuLink<?= $row['id'] ?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="text">
                                        <?php if ($row["editorFirstname"] != "") {
                                            echo "<span id='userImage" . $row['id'] . "'><img src='" . BASE_URL . "/api/users?profileImage=" . $row['editorProfileId'] . "' width='25' style='vertical-align: middle; margin-right:5px;'/></span><span id='user" . $row['id'] . "'>" . $this->escape($row["editorFirstname"]) . "</span>";
                                        } else {
                                            echo "<span id='userImage" . $row['id'] . "'><img src='" . BASE_URL . "/api/users?profileImage=false' width='25' style='vertical-align: middle; margin-right:5px;'/></span><span id='user" . $row['id'] . "'>" . $this->__("dropdown.not_assigned") . "</span>";
                                        } ?>
                                    </span>
                                    &nbsp;<i class="fa fa-caret-down" aria-hidden="true"></i>
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="userDropdownMenuLink<?= $row['id'] ?>">
                                    <li class="nav-header border"><?= $this->__("dropdown.choose_user") ?></li>

                                    <?php foreach ($this->get('users') as $user) {
                                        echo "<li class='dropdown-item'>";
                                        echo "<a href='javascript:void(0);' data-label='" . sprintf($this->__("text.full_name"), $this->escape($user["firstname"]), $this->escape($user['lastname'])) . "' data-value='" . $row['id'] . "_" . $user['id'] . "_" . $user['profileId'] . "' id='userStatusChange" . $row['id'] . $user['id'] . "' ><img src='" . BASE_URL . "/api/users?profileImage=" . $user['profileId'] . "' width='25' style='vertical-align: middle; margin-right:5px;'/>" . sprintf($this->__("text.full_name"), $this->escape($user["firstname"]), $this->escape($user['lastname'])) . "</a>";
                                        echo "</li>";
                                    } ?>
                                </ul>
                            </div>
                        </td>

                        <?php
                        if ($row['dateToFinish'] == "0000-00-00 00:00:00" || $row['dateToFinish'] == "1969-12-31 00:00:00") {
                            $date = $this->__("text.anytime");
                        } else {
                            $date = new DateTime($row['dateToFinish']);
                            $date = $date->format($this->__("language.dateformat"));
                        }
                        ?>
                        <td data-order="<?= $date ?>">


                            <?php echo $this->__("label.due_icon"); ?><input type="text" title="<?php echo $this->__("label.due"); ?>" value="<?php echo $date ?>" class="duedates secretInput" data-id="<?php echo $row['id']; ?>" name="date" />

                        </td>
                        <td data-order="<?= $this->e($row['planHours']); ?>">
                            <input type="text" value="<?= $this->e($row['planHours']); ?>" name="planHours" class="small-input" onchange="leantime.ticketsController.updatePlannedHours(this, '<?= $row['id'] ?>'); jQuery(this).parent().attr('data-order',jQuery(this).val());" />
                        </td>
                        <td data-order="<?= $this->e($row['hourRemaining']); ?>">
                            <input type="text" value="<?= $this->e($row['hourRemaining']); ?>" name="remainingHours" class="small-input" onchange="leantime.ticketsController.updateRemainingHours(this, '<?= $row['id'] ?>');" />
                        </td>

                        <td data-order="<?php if ($row['bookedHours'] === null || $row['bookedHours'] == "") echo "0";
                                        else echo $row['bookedHours'] ?>">

                            <?php if ($row['bookedHours'] === null || $row['bookedHours'] == "") echo "0";
                            else echo $row['bookedHours'] ?>
                        </td>

                    </tr>

                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<script type="text/javascript">
    leantime.ticketsController.initTicketSearchSubmit("<?= BASE_URL ?>/tickets/showGlobal");


    leantime.ticketsController.initUserSelectBox();
    leantime.ticketsController.initStatusSelectBox();

    <?php if ($login::userIsAtLeast($roles::$editor)) { ?>
        leantime.ticketsController.initUserDropdown();
        leantime.ticketsController.initEffortDropdown();
        leantime.ticketsController.initPriorityDropdown();
        leantime.ticketsController.initStatusDropdown();
    <?php } else { ?>
        leantime.generalController.makeInputReadonly(".maincontentinner");
    <?php } ?>



    leantime.ticketsController.initTicketsTable("<?= $searchCriteria["groupBy"] ?>");

    <?php if (isset($_SESSION['userdata']['settings']["modals"]["backlog"]) === false || $_SESSION['userdata']['settings']["modals"]["backlog"] == 0) {     ?>
        leantime.helperController.showHelperModal("backlog");
    <?php
        //Only show once per session
        $_SESSION['userdata']['settings']["modals"]["backlog"] = 1;
    } ?>
</script>