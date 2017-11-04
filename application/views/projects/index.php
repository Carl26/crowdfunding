<h2><?php echo $title; ?></h2>

<?php foreach ($details as $item_details): ?>

        <h3><?php echo $item_details['title']; ?></h3>
        <h5><?php echo $item_details['start_date'] ?></h5>
        <h5><?php echo $item_details['duration']; ?></h5>
        <h5><?php echo $item_details['category']; ?></h5>
        <h4><?php echo $item_details['aim_amount']; ?></h4>
        <h4><?php echo $item_details['current_amount']; ?></h4>

        <p><?php echo anchor('projects/view', 'View details') ?></p>

<?php endforeach; ?>