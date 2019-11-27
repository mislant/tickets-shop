<?php use yii\helpers\Html; ?>
<div class="container-fluid">
<?php echo Html::a('Create new event', array('event/event-create'), array('class' => 'btn btn-primary pull-right')); ?>
</div> 
<div class="clearfix"></div>
<hr />
<table class="table table-striped table-hover">
    <tr>
        <td>#</td>
        <td>Title</td>
        <td>Adress</td>
        <td>Time</td>
        <td>Amount of tickets</td>
    </tr>
    <?php foreach ($data as $event): ?>
        <tr>
            <td>
                <?php echo $event->id; ?>
            </td>
            <td><?php echo $event->title; ?></td>
            <td><?php echo $event->adress ?></td>
            <td><?php echo $event->date ?></td>
            <td><?php echo $event->amount_of_tickets ?></td>
        </tr>
    <?php endforeach; ?>
</table>
