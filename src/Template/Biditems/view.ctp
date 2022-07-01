<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Biditem $biditem
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Biditem'), ['action' => 'edit', $biditem->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Biditem'), ['action' => 'delete', $biditem->id], ['confirm' => __('Are you sure you want to delete # {0}?', $biditem->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Biditems'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Biditem'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Bidinfo'), ['controller' => 'Bidinfo', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Bidinfo'), ['controller' => 'Bidinfo', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Bidrequest'), ['controller' => 'Bidrequest', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Bidrequest'), ['controller' => 'Bidrequest', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="biditems view large-9 medium-8 columns content">
    <h3><?= h($biditem->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $biditem->has('user') ? $this->Html->link($biditem->user->id, ['controller' => 'Users', 'action' => 'view', $biditem->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($biditem->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($biditem->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Endtime') ?></th>
            <td><?= h($biditem->endtime) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($biditem->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Finished') ?></th>
            <td><?= $biditem->finished ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Bidinfo') ?></h4>
        <?php if (!empty($biditem->bidinfo)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Biditem Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Price') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($biditem->bidinfo as $bidinfo): ?>
            <tr>
                <td><?= h($bidinfo->id) ?></td>
                <td><?= h($bidinfo->biditem_id) ?></td>
                <td><?= h($bidinfo->user_id) ?></td>
                <td><?= h($bidinfo->price) ?></td>
                <td><?= h($bidinfo->created) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Bidinfo', 'action' => 'view', $bidinfo->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Bidinfo', 'action' => 'edit', $bidinfo->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Bidinfo', 'action' => 'delete', $bidinfo->id], ['confirm' => __('Are you sure you want to delete # {0}?', $bidinfo->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Bidrequest') ?></h4>
        <?php if (!empty($biditem->bidrequest)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Biditem Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Price') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($biditem->bidrequest as $bidrequest): ?>
            <tr>
                <td><?= h($bidrequest->id) ?></td>
                <td><?= h($bidrequest->biditem_id) ?></td>
                <td><?= h($bidrequest->user_id) ?></td>
                <td><?= h($bidrequest->price) ?></td>
                <td><?= h($bidrequest->created) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Bidrequest', 'action' => 'view', $bidrequest->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Bidrequest', 'action' => 'edit', $bidrequest->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Bidrequest', 'action' => 'delete', $bidrequest->id], ['confirm' => __('Are you sure you want to delete # {0}?', $bidrequest->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
