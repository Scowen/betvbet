<?php
use yii\helpers\Html;

$this->title = 'Activate Account';
$user = Yii::$app->user->getIdentity();
?>
<div class="well">
    <h1>Activate Account</h1>
    <div id="divResult"></div>
    <?php if ($user): ?>
        <div class="row">
            <div class="col-md-12">
                <?php if ($activate = $user->activate): ?>
                    <?php if ($activate->expires < time()): ?>
                        The activation code sent to <strong><?php echo Html::encode($user->email); ?></strong> has expired and you will require a new one.
                    <?php else: ?>
                        An activation code has been sent to <strong><?php echo Html::encode($user->email); ?></strong>, make sure you check your spam/junk folder.
                    <?php endif; ?>
                <?php else: ?>
                    You need to send an activation email to <strong><?php echo Html::encode($user->email); ?></strong>.
                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>
    <br />
    <div class="row">
        <div class="col-xs-12">
            <div class="form-group">
                <label class="col-xs-12 col-md-2 control-label" for="inputCode">Activation Code</label>
                <div class="col-xs-12 col-md-3">
                    <input type="text" name="code" id="inputCode" class="form-control" placeholder="Example: 123456" maxlength="6" />
                </div>
            </div>
        </div>
    </div>
    <br />
    <div class="row">
        <div class="col-md-3">
            <?php echo Html::a("Activate Account", '#', ['class' => 'btn btn-success', 'id' => 'buttonActivate']); ?>
        </div>
        <?php if ($user): ?>
            <div class="col-md-3">
                <?php echo Html::a("Send Activation Email", '#', ['class' => 'btn btn-primary', 'id' => 'buttonSendCode']); ?>
            </div>
        <?php endif; ?>
    </div>
</div>

<script>
$(document).ready( function() {
    $("#buttonActivate").click( function() {
        var code = $("#inputCode").val();
        if (code && code != "undefined" && code.length == 6)
            $("#divResult").load("<?php echo Yii::getAlias('@web'); ?>/site/activate?code=" + code);
    })

    <?php if ($user): ?>
        $("#buttonSendCode").click( function() {
            $("#divResult").load("<?php echo Yii::getAlias('@web'); ?>/site/activate?send=<?php echo $user->id ?>");
        })
    <?php endif; ?>
})
</script>
