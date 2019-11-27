<?php use yii\helpers\Html; ?>
<div class="container-fluid">
<?php echo Html::a('Create new ticket type', array('event/ticket_type-create'), array('class' => 'btn btn-primary pull-right')); ?>
</div> 
<div class="clearfix"></div>
<hr />
<table class="table table-striped table-hover">
    <tr>
        <td>#</td>
        <td>Ticket type</td>
    </tr>
    <?php foreach ($data as $ticket_type): ?>
        <tr>
            <td><?php echo $ticket_type->id; ?></td>
            <td><?php echo $ticket_type->type; ?></td>
        </tr>
    <?php endforeach; ?>
</table>