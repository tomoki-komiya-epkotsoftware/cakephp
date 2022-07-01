<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit User'), ['action' => 'edit', $user->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete User'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Bidinfo'), ['controller' => 'Bidinfo', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Bidinfo'), ['controller' => 'Bidinfo', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Biditems'), ['controller' => 'Biditems', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Biditem'), ['controller' => 'Biditems', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Bidmessage'), ['controller' => 'Bidmessage', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Bidmessage'), ['controller' => 'Bidmessage', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Bidrequest'), ['controller' => 'Bidrequest', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Bidrequest'), ['controller' => 'Bidrequest', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="users view large-9 medium-8 columns content">
    <h3><?= h($user->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Username') ?></th>
            <td><?= h($user->username) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Password') ?></th>
            <td><?= h($user->password) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Role') ?></th>
            <td><?= h($user->role) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($user->id) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Bidinfo') ?></h4>
        <?php if (!empty($user->bidinfo)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Biditem Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Price') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($user->bidinfo as $bidinfo): ?>
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
        <h4><?= __('Related Biditems') ?></h4>
        <?php if (!empty($user->biditems)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Name') ?></th>
                <th scope="col"><?= __('Finished') ?></th>
                <th scope="col"><?= __('Endtime') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($user->biditems as $biditems): ?>
            <tr>
                <td><?= h($biditems->id) ?></td>
                <td><?= h($biditems->user_id) ?></td>
                <td><?= h($biditems->name) ?></td>
                <td><?= h($biditems->finished) ?></td>
                <td><?= h($biditems->endtime) ?></td>
                <td><?= h($biditems->created) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Biditems', 'action' => 'view', $biditems->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Biditems', 'action' => 'edit', $biditems->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Biditems', 'action' => 'delete', $biditems->id], ['confirm' => __('Are you sure you want to delete # {0}?', $biditems->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Bidmessage') ?></h4>
        <?php if (!empty($user->bidmessage)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Bidinfo Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Message') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($user->bidmessage as $bidmessage): ?>
            <tr>
                <td><?= h($bidmessage->id) ?></td>
                <td><?= h($bidmessage->bidinfo_id) ?></td>
                <td><?= h($bidmessage->user_id) ?></td>
                <td><?= h($bidmessage->message) ?></td>
                <td><?= h($bidmessage->created) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Bidmessage', 'action' => 'view', $bidmessage->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Bidmessage', 'action' => 'edit', $bidmessage->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Bidmessage', 'action' => 'delete', $bidmessage->id], ['confirm' => __('Are you sure you want to delete # {0}?', $bidmessage->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Bidrequest') ?></h4>
        <?php if (!empty($user->bidrequest)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Biditem Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Price') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($user->bidrequest as $bidrequest): ?>
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
