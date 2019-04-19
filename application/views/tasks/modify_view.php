<?
$id = $this->input->get('id');
foreach ($res as $line ) {


?>


<div class="formDivAdd">
    <form action="save" method="get">
        <input autocomplete="off" name="id" value="<?= $id ?>" hidden>
        <input autocomplete="off" name="modTask" value="<? if($line->task) echo  $line->task; ?>">
        <input autocomplete="off" type="number" name="modDeadline" value="<?if($line->deadline) echo  $line->deadline;?>">
        <button class="btn btn-success" type="submit">Save</button>
    </form>
</div>
<?}?>