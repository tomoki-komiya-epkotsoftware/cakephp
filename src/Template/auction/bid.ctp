<h2>「<?=$biditem->name ?> 」の情報</h2>
<?= $this->Form->create($bidrequest) ?>
<fieldset>
  <?php
   echo $this->Form->hidden('biditem_id', ['value' => $bidrequest->biditems_id]);
   echo $this->Form->hidden('user_id', ['value' => $bidrequest->user_id]);
   echo $this->Form->control('price');
   ?>
</fieldset>
<?= $this->Form->button(__('SIbmit')) ?>
<?= $this->Form->end() ?>