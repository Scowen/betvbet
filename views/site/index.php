<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Home';
$matches = array(
    array(
        array(
            'Arsenal',
            'https://upload.wikimedia.org/wikipedia/en/thumb/5/53/Arsenal_FC.svg/870px-Arsenal_FC.svg.png',
        ),
        array(
            'Tottenham',
            'https://upload.wikimedia.org/wikipedia/en/thumb/b/b4/Tottenham_Hotspur.svg/519px-Tottenham_Hotspur.svg.png',
        )
    ),
    array(
        array(
            'Chelsea',
            'https://upload.wikimedia.org/wikipedia/en/thumb/c/cc/Chelsea_FC.svg/768px-Chelsea_FC.svg.png',
        ),
        array(
            'Liverpool',
            'https://upload.wikimedia.org/wikipedia/en/thumb/0/0c/Liverpool_FC.svg/758px-Liverpool_FC.svg.png',
        )
    ),
);

?>
<div class="row">
    <div class="col-md-3 hidden-xs">
        <div class="well">
            <h4>Premier League Top 5</h4>
            <table class="table table-striped">
                <thead>
                    <th>#</th>
                    <th>&nbsp;</th>
                    <th><abbr title="Points"><strong>P</strong></abbr></th>
                </thead>
                <tbody>
                    <?php
                    $premLeague = \app\models\Competition::findOne(1);
                    $i = 0;
                    ?>
                    <?php if ($premLeague && $premLeague->teams): ?>
                        <?php foreach ($premLeague->teams as $team): ?>
                            <tr>
                                <td><?php echo $team->position; ?></td>
                                <td><?php echo $team->name; ?></td>
                                <td><strong><?php echo $team->points; ?></strong></td>
                            </tr>
                            <?php
                            $i++;
                            if ($i >= 5) break;
                            ?>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="100%" class="info text-center">No teams to display</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-xs-12 col-md-9">
        <?php foreach ($matches as $match): ?>
            <div class="row match">
                <div class="col-xs-5 text-right-not-xs match-home">
                    <div class="row">
                        <div class="col-xs-4 text-left">
                            <!-- <a href="#" class="btn btn-xs btn-success">Bet</a> -->
                        </div>
                        <div class="col-xs-1 text-center">
                            <span class="badge badge-inverse-light">1</span>
                        </div>
                        <div class="col-xs-5">
                            <?= Html::encode($match[0][0]); ?>
                        </div>
                        <div class="col-xs-2">
                            <?= Html::img($match[0][1], ['class' => 'img-responsive', 'style' => 'height:30px; margin:auto;']); ?>
                        </div>
                    </div>
                </div>
                <div class="col-xs-2 text-center match-score">
                    3 - 0
                </div>
                <div class="col-xs-5 text-left-not-xs match-away">
                    <div class="row">
                        <div class="col-xs-2">
                            <?= Html::img($match[1][1], ['class' => 'img-responsive', 'style' => 'height:30px; margin:auto;']); ?>
                        </div>
                        <div class="col-xs-5">
                            <?= Html::encode($match[1][0]); ?>
                        </div>
                        <div class="col-xs-1 text-center">
                            <span class="badge badge-inverse-light">1</span>
                        </div>
                        <div class="col-xs-4 text-right">
                            <!-- <a href="#" class="btn btn-xs btn-link">Bet</a> -->
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
