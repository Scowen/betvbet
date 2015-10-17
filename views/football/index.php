<div class="well">
    <h4>Premier League</h4>
    <table class="table table-striped">
        <thead>
            <th>#</th>
            <th>&nbsp;</th>
            <th><abbr title="Games Played"><strong>Pl.</strong></abbr></th>
            <th><abbr title="Wins"><strong>W</strong></abbr></th>
            <th><abbr title="Draws"><strong>D</strong></abbr></th>
            <th><abbr title="Losses"><strong>L</strong></abbr></th>
            <th><abbr title="Goals For (Scored)"><strong>GF</strong></abbr></th>
            <th><abbr title="Goals Against (Conceded)"><strong>GA</strong></abbr></th>
            <th><abbr title="Goal Difference"><strong>GD</strong></abbr></th>
            <th><abbr title="Points"><strong>P</strong></abbr></th>
        </thead>
        <tbody>
            <?php
            $premLeague = \app\models\Competition::findOne(1);
            ?>
            <?php if ($premLeague && $premLeague->teams): ?>
                <?php foreach ($premLeague->teams as $team): ?>
                    <tr>
                        <td><?php echo $team->position; ?></td>
                        <td><?php echo $team->name; ?></td>
                        <td><?php echo $team->overall_gp; ?></td>
                        <td><?php echo $team->overall_w; ?></td>
                        <td><?php echo $team->overall_d; ?></td>
                        <td><?php echo $team->overall_l; ?></td>
                        <td><?php echo $team->overall_gs; ?></td>
                        <td><?php echo $team->overall_ga; ?></td>
                        <td><?php echo $team->gd; ?></td>
                        <td><strong><?php echo $team->points; ?></strong></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="100%" class="info text-center">No teams to display</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
